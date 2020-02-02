<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use Alert;
use Validator;
class DashboardAdminController extends Controller
{
    public function banyak_siswa()
    {
        $siswa = DB::table('users')->where('level','Siswa')->get();
        return view('dashboard_admin/banyak_siswa',compact('siswa'));
  
    }
    public function siswa_sp1()
    {
        $sp1 = DB::table('users')->where('level','Siswa')->where('skor_punishment','>=','250')->where('skor_punishment','<','500')
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        return view('/dashboard_admin/siswa_sp1',compact('sp1'));
    }
    public function siswa_sp2()
    {
        $sp2 = DB::table('users')->where('level','Siswa')->where('skor_punishment','>=','500')->where('skor_punishment','<','750')
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        return view('/dashboard_admin/siswa_sp2',compact('sp2'));
    }
    public function siswa_sp3()
    {
        $sp3 = DB::table('users')->where('level','Siswa')->where('skor_punishment','>=','750')
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        $r1 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','1000')->where('skor_reward','<','2000')->get();
        $r2 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','2000')->where('skor_reward','<','2500')->get();
        $r3 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','2500')->get();
        return view('/dashboard_admin/siswa_sp3',compact('sp3'));
    }
    public function siswa_r1()
    {
        $r1 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','1000')->where('skor_reward','<','2000')
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        return view('/dashboard_admin/siswa_r1',compact('r1'));
    }
    public function siswa_r2()
    {
        $r2 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','2000')->where('skor_reward','<','2500')
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        return view('/dashboard_admin/siswa_r2',compact('r2'));
    }
    public function siswa_r3()
    {
        $r3 = DB::table('users')->where('level','Siswa')->where('skor_reward','>=','2500')
        ->join('tb_rombel', function ($join) {
            $join->on('users.rombel_id', '=', 'tb_rombel.id_rombel');
        })
        ->join('tb_rayon', function ($join) {
            $join->on('users.rayon_id', '=', 'tb_rayon.id_rayon');
        })
        ->join('tb_jurusan', function ($join) {
            $join->on('users.jurusan_id', '=', 'tb_jurusan.id_jurusan');
        })->get();
        return view('/dashboard_admin/siswa_r3',compact('r3'));
    }
}

