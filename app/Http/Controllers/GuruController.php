<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Alert;
use Datatables;

class GuruController extends Controller
{
	public function usersList()
    {   
		$siswa = DB::table('users')->where('level','Siswa')
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })->get();
	}
    public function dashboard_guru()
    {
		if(Auth::user()->level != 'Guru'){
			return redirect()->back();
		 }
        $date = date('d-m-Y');
        $hari = date ("D");
 
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
        $siswa = DB::table('users')->where('level','Siswa')
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })->get();

        $punishment = DB::table('tb_punishment')->get();
        $reward = DB::table('tb_reward')->get();
        return view('/guru/dashboard_guru',compact('siswa','date','hari_ini','punishment','reward'));
	}
	
	

    public function punishment_murid_store(Request $request)
    { 
        $tb_kebijakan_punishment = DB::table('tb_kebijakan_punishment')->where('siswa_id',$request['siswa_id'])->count();
        $punishment = DB::table('tb_punishment')->where('id_punishment',$request['id_punishment'])->get();
        foreach($punishment as $p)
        {
            $point1 = $p->point_1;
            $point2 = $p->point_2;
            $point3 = $p->point_3;
            $date = date('Y-m-d');
           
            
            if($tb_kebijakan_punishment < 1)
            {
			
                $hitung =  DB::table('users')->where('id',$request['siswa_id'])->first();
				$hasil = $hitung->skor_punishment + $point1;
				DB::table('tb_kebijakan_punishment')->insert([
                    'siswa_id' => $request['siswa_id'],
                    'guru_id' => $request['guru_id'],
                    'punishment_kebijakan_id' => $request['id_punishment'],
                    'tgl_dapat_punishment' => $date,
                    'point_punishment' => $point1,
            ]);
                DB::table('users')->where('id',$request['siswa_id'])->update([
                
                    'skor_punishment' =>$hasil
                ]);
            }
            else if($tb_kebijakan_punishment == 1)
            {
                $hitung =  DB::table('users')->where('id',$request['siswa_id'])->first();
				$hasil = $hitung->skor_punishment + $point2;
				DB::table('tb_kebijakan_punishment')->insert([
                    'siswa_id' => $request['siswa_id'],
                    'guru_id' => $request['guru_id'],
                    'punishment_kebijakan_id' => $request['id_punishment'],
                    'tgl_dapat_punishment' => $date,
                    'point_punishment' => $point2,
            ]);
                DB::table('users')->where('id',$request['siswa_id'])->update([
                
                    'skor_punishment' => $hasil
                ]);
            }
            else if($tb_kebijakan_punishment >= 2)
            {
                $hitung =  DB::table('users')->where('id',$request['siswa_id'])->first();
				$hasil = $hitung->skor_punishment + $point3;
				DB::table('tb_kebijakan_punishment')->insert([
                    'siswa_id' => $request['siswa_id'],
                    'guru_id' => $request['guru_id'],
                    'punishment_kebijakan_id' => $request['id_punishment'],
                    'tgl_dapat_punishment' => $date,
                    'point_punishment' => $point3,
            ]);
                DB::table('users')->where('id',$request['siswa_id'])->update([
                
                    'skor_punishment' => $hasil
                ]);
            }
        }
    return redirect()->back()->withSuccessMessage('Punishment Berhasil Diberikan');;
    }

    
    public function reward_murid_store(Request $request)
    { 
      
            $date = date('Y-m-d');
            DB::table('tb_kebijakan_reward')->insert([
                    'siswa_id' => $request['siswa_id'],
                    'guru_id' => $request['guru_id'],
                    'reward_kebijakan_id' => $request['id_reward'],
                    'tgl_dapat_reward' => $date,
            ]);
            $hitung =  DB::table('users')->where('id',$request['siswa_id'])->first();
            $reward =  DB::table('tb_reward')->where('id_reward',$request['id_reward'])->first();
                $hasil = $hitung->skor_reward +  $reward->point;
                DB::table('users')->where('id',$request['siswa_id'])->update([
                
                    'skor_reward' => $hasil
                ]);
        
       
       
    return redirect()->back()->withSuccessMessage('Reward Berhasil Diberikan');;
    }

	
	
	public function history_memberi_reward()
    {

		if(Auth::user()->level != 'Guru'){
			return redirect()->back();
		 }
		$reward = DB::table('tb_kebijakan_reward')->where('guru_id',Auth::user()->id)
		->join('users', function ($join) {
            $join->on('tb_kebijakan_reward.siswa_id', '=', 'users.id');
		})
		->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
		})
		->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_guru', function ($join) {
			$join->on('tb_kebijakan_reward.guru_id', '=', 'tb_guru.id_guru');
		})
       
		->join('tb_reward', function ($join) {
            $join->on('tb_kebijakan_reward.reward_kebijakan_id', '=', 'tb_reward.id_reward');
        })->get();

	

        return view('/guru/history_memberi_reward',compact('reward'));
	}
	
   
	
		 public function filter_reward(Request $request)
		 {
			if(Auth::user()->level == 'Siswa'){
				return redirect()->back();
			 }
			
				$reward = DB::table('tb_kebijakan_reward')->where('guru_id',Auth::user()->id)
				->join('users', function ($join) {
					$join->on('tb_kebijakan_reward.siswa_id', '=', 'users.id');
				})
				->join('tb_rombel', function ($join) {
					$join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
				})
				->join('tb_rayon', function ($join) {
					$join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
				})
				->join('tb_guru', function ($join) {
					$join->on('tb_kebijakan_reward.guru_id', '=', 'tb_guru.id_guru');
				})
			   
				->join('tb_reward', function ($join) {
					$join->on('tb_kebijakan_reward.reward_kebijakan_id', '=', 'tb_reward.id_reward');
				})
			  ->when($request->dari,function ($query) use ($request) {
				$dari = $request->dari;
				$ke = $request->ke;   
				  $query
				  ->whereBetween('tgl_dapat_reward',[$dari,$ke]);
			  })->paginate($request->limit ?  $request->limit : 10);
			  $reward->appends($request->only('dari','ke'));
			  return view('/guru/history_memberi_reward',compact('reward'));
			
			
		}

		

		
	public function history_memberi_punishment()
    {
		if(Auth::user()->level != 'Guru'){
			return redirect()->back();
		 }
		$punishment = DB::table('tb_kebijakan_punishment')->where('guru_id',Auth::user()->id)
		->join('users', function ($join) {
            $join->on('tb_kebijakan_punishment.siswa_id', '=', 'users.id');
		})
		->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
		})
		->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_guru', function ($join) {
			$join->on('tb_kebijakan_punishment.guru_id', '=', 'tb_guru.id_guru');
		})
       
		->join('tb_punishment', function ($join) {
            $join->on('tb_kebijakan_punishment.punishment_kebijakan_id', '=', 'tb_punishment.id_punishment');
        })->get();

		$tb_punishment = DB::table('tb_punishment')->first();


        return view('/guru/history_memberi_punishment',compact('punishment','tb_punishment'));
	}
	
   
	
		 public function filter_punishment(Request $request)
		 {
			if(Auth::user()->level == 'Siswa'){
				return redirect()->back();
			 }
			
				$punishment = DB::table('tb_kebijakan_punishment')->where('guru_id',Auth::user()->id)
				->join('users', function ($join) {
					$join->on('tb_kebijakan_punishment.siswa_id', '=', 'users.id');
				})
				->join('tb_rombel', function ($join) {
					$join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
				})
				->join('tb_rayon', function ($join) {
					$join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
				})
				->join('tb_guru', function ($join) {
					$join->on('tb_kebijakan_punishment.guru_id', '=', 'tb_guru.id_guru');
				})
			   
				->join('tb_punishment', function ($join) {
					$join->on('tb_kebijakan_punishment.punishment_kebijakan_id', '=', 'tb_punishment.id_punishment');
				})
			  ->when($request->dari,function ($query) use ($request) {
				$dari = $request->dari;
				$ke = $request->ke;   
				  $query
				  ->whereBetween('tgl_dapat_punishment',[$dari,$ke]);
			  })->paginate($request->limit ?  $request->limit : 10);
			  $punishment->appends($request->only('dari','ke'));
			  return view('/guru/history_memberi_punishment',compact('punishment'));
		}

		public function guru_hapus_punishment($id)
		{
			$ambil_1 = DB::table('tb_kebijakan_punishment')->where('id_kebijakan_punishment',$id)->first();
			$ambil_2 = DB::table('users')->where('id',$ambil_1->siswa_id)->first();
			$kurang = $ambil_2->skor_punishment - $ambil_1->point_punishment;
			DB::table('tb_kebijakan_punishment')->where('id_kebijakan_punishment',$id)->delete();
			DB::table('users')->where('id',$ambil_1->siswa_id)->update([
				'skor_punishment'=>$kurang
			]);
			return redirect()->back()->withSuccessMessage('Punishment Berhasil Dihapus');
		}

		public function guru_hapus_reward($id)
		{
			$ambil_1 = DB::table('tb_kebijakan_reward')->where('id_kebijakan_reward',$id)
			->join('tb_reward', function ($join) {
				$join->on('tb_kebijakan_reward.reward_kebijakan_id', '=', 'tb_reward.id_reward');
			})
			->first();
			$ambil_2 = DB::table('users')->where('id',$ambil_1->siswa_id)->first();
			$kurang = $ambil_2->skor_reward - $ambil_1->point;
			DB::table('tb_kebijakan_reward')->where('id_kebijakan_reward',$id)->delete();
			DB::table('users')->where('id',$ambil_1->siswa_id)->update([
				'skor_reward'=>$kurang
			]);
			return redirect()->back()->withSuccessMessage('Reward Berhasil Dihapus');
		}
}

