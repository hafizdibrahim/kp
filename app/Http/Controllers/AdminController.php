<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use Alert;
use Validator;
class AdminController extends Controller
{
    
    public function dashboard_admin()
    {
        $banyak_siswa = DB::table('users')->where('level','Siswa')->get();
        $sp1 = DB::table('users')->where('level','Siswa')->where('skor_punishment','>=','250')->where('skor_punishment','<','500')->get();
        $sp2 = DB::table('users')->where('level','Siswa')->where('skor_punishment','>=','500')->where('skor_punishment','<','750')->get();
        $sp3 = DB::table('users')->where('level','Siswa')->where('skor_punishment','>=','750')->get();
        $r1 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','1000')->where('skor_reward','<','2000')->get();
        $r2 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','2000')->where('skor_reward','<','2500')->get();
        $r3 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','2500')->get();
        return view('/admin/dashboard_admin',compact('banyak_siswa','sp1','sp2','sp3','r1','r2','r3'));
    }
    
    
    public function rombel()
    {
        $rombel = DB::table('tb_rombel')->get();
      
        return view('admin/rombel',compact('rombel'));
  
    }
    
    public function rombel_hapus($id)
    {
       
        $rombel = DB::table('tb_rombel')->where('id_rombel',$id)->delete();
        
        return redirect()->back()->withSuccessMessage('Data Berhasil Dihapus');
    }
    
    public function rombel_detail($id)
    {
        $siswa = DB::table('users')->where('rombel_id',$id)
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
       
        $rombel = DB::table('tb_rombel')->where('id_rombel','!=',$id)->get();
        $nama_rombel = DB::table('users')->where('rombel_id',$id)
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel')->select('nama_rombel');
        })->first();
        return view('admin/rombel_detail',compact('siswa','nama_rombel','rombel'));
    }

    public function rombel_edit($id)
    {
        $rombel = DB::table('tb_rombel')->where('id_rombel',$id)->get();
     
        return view('admin/rombel_edit',compact('rombel'));
    }

    public function rombel_store(Request $request)
    { 
        $cek = $this->validate($request, [
            'nama_rombel' => ['required', 'string', 'max:255', 'unique:tb_rombel'],
        ]);
        if($cek > 0)
        {
            DB::table('tb_rombel')->insert([
                'nama_rombel'=>$request->nama_rombel
            ]);
            return redirect()->back()->withSuccessMessage('Data Berhasil Ditambahkan');
        }
        else if( $cek < 0)
        {
            
            return redirect()->back()->withErrorMessage('Data yang anda masukkan sudah ada');
        }
        
    }
    public function rombel_update(Request $request)
    { 
        DB::table('tb_rombel')->where('id_rombel',$request->modal_input_id)->update([
            'nama_rombel'=>$request->modal_input_name
        ]);
        return redirect('/rombel')->withSuccessMessage('Data Berhasil Diubah');
    }

    
    public function pindahkan_rombel(Request $request)
    {
        DB::table('users')->where('id',$request->modal_input_id)->update([
            'rombel_id'=>$request->rombelAkhir            
        ]);
        return redirect()->back()->withSuccessMessage('Siswa Berhasil Dipindahkan');
    }

    // Akhir Rombel Controller ==================================

    public function rayon()
    {
        $rayon = DB::table('tb_rayon')->get();
      
        return view('admin/rayon',compact('rayon'));
  
    }
    
    public function rayon_hapus($id)
    {
        $rayon = DB::table('tb_rayon')->where('id_rayon',$id)->delete();
      
        return redirect()->back()->withSuccessMessage('Data Berhasil dihapus');;;
    }

    public function rayon_edit($id)
    {
        $rayon = DB::table('tb_rayon')->where('id_rayon',$id)->get();
     
        return view('admin/rayon_edit',compact('rayon'));
    }

    public function rayon_store(Request $request)
    { 
        DB::table('tb_rayon')->insert([
            'nama_rayon'=>$request->nama_rayon
        ]);
        
        return redirect()->back()->withSuccessMessage('Data Berhasil ditambahkan');
    }
    public function rayon_update(Request $request)
    { 
        DB::table('tb_rayon')->where('id_rayon',$request->modal_input_id)->update([
            'nama_rayon'=>$request->modal_input_name
        ]);
        return redirect('/rayon')->withSuccessMessage('Data Berhasil diubah');
    }
    // Akhir Rayon Controller =======================================================================


    public function jurusan()
    {
        $jurusan = DB::table('tb_jurusan')->get();
      
        return view('admin/jurusan',compact('jurusan'));
  
    }
    
    public function jurusan_hapus($id)
    {
        $jurusan = DB::table('tb_jurusan')->where('id_jurusan',$id)->delete();
      
        return redirect()->back()->withSuccessMessage('Data Berhasil dihapus');;;
    }

    public function jurusan_edit($id)
    {
        $jurusan = DB::table('tb_jurusan')->where('id_jurusan',$id)->get();
     
        return view('admin/jurusan_edit',compact('jurusan'));
    }

    public function jurusan_store(Request $request)
    { 
        DB::table('tb_jurusan')->insert([
            'nama_jurusan'=>$request->nama_jurusan
        ]);
        
        return redirect()->back()->withSuccessMessage('Data Berhasil ditambahkan');
    }
    public function jurusan_update(Request $request)
    { 
        DB::table('tb_jurusan')->where('id_jurusan',$request->modal_input_id)->update([
            'nama_jurusan'=>$request->modal_input_name
        ]);
        return redirect('/jurusan')->withSuccessMessage('Data Berhasil diubah');
    }
    // Akhir Jurusan Controller =======================================================================

    public function reward()
    {
      
        $reward = DB::table('tb_reward')->get();
      
        return view('admin/reward',compact('reward'));
  
    }
    
    public function reward_hapus($id)
    {
        $reward = DB::table('tb_reward')->where('id_reward',$id)->delete();
        
        return redirect()->back()->withSuccessMessage('Data Berhasil Dihapus');
    }

    public function reward_edit($id)
    {
        $reward = DB::table('tb_reward')->where('id_reward',$id)->get();
     
        return view('admin/reward_edit',compact('reward'));
    }

    public function reward_store(Request $request)
    { 
        DB::table('tb_reward')->insert([
            'kode_reward'=>$request->kode_reward,
            'point'=>$request->point,
            'keterangan_reward'=>$request->keterangan_reward
        ]);
        
        return redirect()->back()->withSuccessMessage('Data Berhasil Ditambahkan');
    }
    public function reward_update(Request $request)
    { 
        DB::table('tb_reward')->where('id_reward',$request->modal_input_id)->update([
            'kode_reward'=>$request->modal_input_kode,
            'point'=>$request->modal_input_point,
            'keterangan_reward'=>$request->modal_input_keterangan_reward
        ]);
        return redirect('/reward')->withSuccessMessage('Data Berhasil Diubah');
    }

    // Akhir Reward Controller ==================================

    public function punishment()
    {
      
        $punishment = DB::table('tb_punishment')->get();
      
        return view('admin/punishment',compact('punishment'));
  
    }
    
    public function punishment_hapus($id)
    {
        $punishment = DB::table('tb_punishment')->where('id_punishment',$id)->delete();
        
        return redirect()->back()->withSuccessMessage('Data Berhasil Dihapus');
    }

    public function punishment_edit($id)
    {
        $punishment = DB::table('tb_punishment')->where('id_punishment',$id)->get();
     
        return view('admin/punishment_edit',compact('punishment'));
    }

    public function punishment_store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kode_punishment'=>'required|unique:tb_punishment',
        ]);
        if($validator->fails()){
            return back()->withErrorMessage('Kode punishment sudah dipakai');
        }
        
        DB::table('tb_punishment')->insert([
            'kode_punishment'=>$request->kode_punishment,
            'point_1'=>$request->point_1,
            'point_2'=>$request->point_2,
            'point_3'=>$request->point_3,
            'keterangan_punishment'=>$request->keterangan_punishment
        ]);
        
        return redirect()->back()->withSuccessMessage('Data Berhasil Ditambahkan');
    }
    public function punishment_update(Request $request)
    { 
        DB::table('tb_punishment')->where('id_punishment',$request->modal_input_id)->update([
            'kode_punishment'=>$request->modal_input_kode_punishment,
            'point_1'=>$request->modal_input_point_1,
            'point_2'=>$request->modal_input_point_2,
            'point_3'=>$request->modal_input_point_3,
            'keterangan_punishment'=>$request->modal_input_keterangan_punishment
        ]);
        return redirect('/punishment')->withSuccessMessage('Data Berhasil Diubah');
    }

    // Akhir Punishment Controller ==================================

    // Data Users
    public function mapel()
    {
        $mapel = DB::table('tb_mapel')->get();
      
        return view('admin/mapel',compact('mapel'));
  
    }
    
    public function mapel_hapus($id)
    {
        $mapel = DB::table('tb_mapel')->where('id_mapel',$id)->delete();
      
        return redirect()->back()->withSuccessMessage('Data Berhasil dihapus');;;
    }

    public function mapel_edit($id)
    {
        $mapel = DB::table('tb_mapel')->where('id_mapel',$id)->get();
     
        return view('admin/mapel_edit',compact('mapel'));
    }

    public function mapel_store(Request $request)
    { 
        DB::table('tb_mapel')->insert([
            'nama_mapel'=>$request->nama_mapel
        ]);
        
        return redirect()->back()->withSuccessMessage('Data Berhasil ditambahkan');
    }
    public function mapel_update(Request $request)
    { 
        DB::table('tb_mapel')->where('id_mapel',$request->modal_input_id)->update([
            'nama_mapel'=>$request->modal_input_name
        ]);
        return redirect('/mapel')->withSuccessMessage('Data Berhasil diubah');
    }
    // Akhir mapel Controller =======================================================================

    public function guru()
    {
        $mapel = DB::table('tb_mapel')->get();
        $guru = DB::table('tb_guru')
        ->join('tb_mapel', function($join){
            $join->on('tb_guru.mapel_id','=','tb_mapel.id_mapel');
        })
        ->get();
        return view('pengguna/guru',compact('mapel','guru'));
    }
    public function detail_guru($id)
    {
        $mapel = DB::table('tb_mapel')->get();
        $guru = DB::table('tb_guru')->where('id_guru',$id)
        ->join('tb_mapel', function($join){
            $join->on('tb_guru.mapel_id','=','tb_mapel.id_mapel');
        })
        ->get();
        return view('pengguna/detail_guru',compact('mapel','guru'));
    }
    public function guru_update(Request $request)
    {
        $cek = DB::table('users')->where('id',$request->id_guru)->first();
        if($cek->username != $request->username)
        {
            $validator = Validator::make($request->all(),[
                'username'=>'required|unique:users',
            ]);
            if($validator->fails()){
                return back()->withErrorMessage('Gagal,Username sudah terpakai');
            }
            
        }
        DB::table('users')->where('id',$request->id_guru)->update([
            'nama'=>$request->nama,
            'username'=>$request->username
        ]);
        DB::table('tb_guru')->where('id_guru',$request->id_guru)->update([
            'nama_guru'=>$request->nama,
            'username_guru'=>$request->username,
            'mapel_id'=>$request->mapel
        ]);
        return back()->withSuccessMessage('Data berhasil diubah');
    }

    public function tambah_guru_store(Request $request)
    { 
        $this->validate($request, [
            'nik' => ['required', 'string', 'min:13', 'unique:tb_guru'],
            'username' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'string', 'unique:users'],
        ]);
        DB::table('users')->insert([
            
                'nama' => $request['nama'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['username']),
                'level' => 'Guru',
        ]);
        $id_akhir = DB::table('users')->where('id', \DB::raw("(select max(`id`) from users)"))->first();
         
        DB::table('tb_guru')->insert([
            'id_guru'=> $id_akhir->id,
            'nik' => $request['nik'],
            'nama_guru' => $request['nama'],
            'username_guru' => $request['username'],
            'email_guru' => $request['email'],
            'password_guru' => Hash::make($request['username']),
            'mapel_id' => $request['mapel_id'],
    ]);
    return redirect()->back()->withSuccessMessage('Guru Berhasil Ditambah');

    }

    public function admin()
    {
        $mapel = DB::table('tb_mapel')->get();
        $admin = DB::table('users')->where('level','Admin')
        ->get();
        return view('pengguna/admin',compact('mapel','admin'));
    }

    public function detail_admin($id)
    {
        $admin = DB::table('users')->where('id',$id)
        ->get();
        return view('pengguna/detail_admin',compact('admin'));
    }
    public function admin_update(Request $request)
    {
        $cek = DB::table('users')->where('id',$request->id)->first();
        if($cek->username != $request->username)
        {
            $validator = Validator::make($request->all(),[
                'username'=>'required|unique:users',
            ]);
            if($validator->fails()){
                return back()->withErrorMessage('Gagal,Username sudah terpakai');
            }
            
        }
        DB::table('users')->where('id',$request->id)->update([
            'nama'=>$request->nama,
            'username'=>$request->username
        ]);
        return back()->withSuccessMessage('Data berhasil diubah');
    }
    public function tambah_admin_store(Request $request)
    { 
        $this->validate($request, [
            'nik' => ['required', 'string', 'min:13', 'unique:users'],
            'username' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'string', 'unique:users'],
        ]);
        DB::table('users')->insert([
            
                'nik' => $request['nik'],
                'nama' => $request['nama'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['username']),
                'level' => 'Admin',
        ]);
    return redirect()->back()->withSuccessMessage('Admin Berhasil Ditambah');

    }

    public function siswa()
    {
        $siswa = DB::table('users')->where('level','siswa')->get();
        $rombel = DB::table('tb_rombel')->get();
        $rayon = DB::table('tb_rayon')->get();
        $jurusan = DB::table('tb_jurusan')->get();
        return view('pengguna/siswa',compact('siswa','rombel','rayon','jurusan'));
    }
    public function detail_siswa($id)
    {
        $rombel = DB::table('tb_rombel')->get();
        $rayon = DB::table('tb_rayon')->get();
        $jurusan = DB::table('tb_jurusan')->get();

        $siswa = DB::table('users')->where('id',$id)
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        return view('pengguna/detail_siswa',compact('siswa','rombel','rayon','jurusan'));
    }

    public function siswa_update(Request $request)
    {
        $cek = DB::table('users')->where('id',$request->id)->first();
        if($cek->nis != $request->nis)
        {
            $validator = Validator::make($request->all(),[
                'nis'=>'required|unique:users',
            ]);
            if($validator->fails()){
                return back()->withErrorMessage('Gagal,NIS sudah terpakai');
            }
            
        }
        
        if($cek->username != $request->username)
        {
            $validator = Validator::make($request->all(),[
                'username'=>'required|unique:users',
            ]);
            if($validator->fails()){
                return back()->withErrorMessage('Gagal,Username sudah terpakai');
            }
            
        }
        DB::table('users')->where('id',$request->id)->update([
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'rombel_id'=>$request->nama_rombel,
            'rayon_id'=>$request->nama_rayon,
            'jurusan_id'=>$request->nama_jurusan,
            'username'=>$request->username
        ]);
        return back()->withSuccessMessage('Data berhasil diubah');
    }
    // Akhir Data Users

    public function tambah_siswa(Request $request)
    {
        DB::table("users")->insert([
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>bcrypt($request->username),
            'rombel_id'=>$request->rombel,
            'rayon_id'=>$request->rayon,
            'jurusan_id'=>$request->jurusan,
            'level'=>'siswa',
        ]);
        return back()->withSuccessMessage('Siswa berhasil ditambahkan');


    }
}
