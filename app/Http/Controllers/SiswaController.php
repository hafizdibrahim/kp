<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Alert;
class SiswaController extends Controller
{
    public function dashboard_siswa()
    {
        if(Auth::user()->level !='Siswa')
        {
            return redirect()->back();
        }
        $siswa = DB::table('users')->where('id',Auth::user()->id)
       ->get();

        $tb_kebijakan_punishment = DB::table('tb_kebijakan_punishment')->where('siswa_id',Auth::user()->id)
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
       
        ->get();
        $tb_kebijakan_reward = DB::table('tb_kebijakan_reward')->where('siswa_id',Auth::user()->id)
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
       ->get();
        return view('/siswa/dashboard_siswa',compact('siswa','tb_kebijakan_punishment','tb_kebijakan_reward'));
    }

    public function siswa_punishment()
    {
        $siswa = DB::table('tb_kebijakan_punishment')->where('siswa_id',Auth::user()->id)
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
        ->join('tb_mapel', function ($join) {
            $join->on('tb_guru.mapel_id', '=', 'tb_mapel.id_mapel');
        })
        ->join('tb_punishment', function ($join) {
            $join->on('tb_kebijakan_punishment.punishment_kebijakan_id', '=', 'tb_punishment.id_punishment');
        })->get();
        return view('siswa/siswa_punishment',compact('siswa'));
    }
    public function siswa_reward()
    {
        $siswa = DB::table('tb_kebijakan_reward')->where('siswa_id',Auth::user()->id)
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
        ->join('tb_mapel', function ($join) {
            $join->on('tb_guru.mapel_id', '=', 'tb_mapel.id_mapel');
        })
        ->join('tb_reward', function ($join) {
            $join->on('tb_kebijakan_reward.reward_kebijakan_id', '=', 'tb_reward.id_reward');
        })->get();
        return view('siswa/siswa_reward',compact('siswa'));
    }
}
