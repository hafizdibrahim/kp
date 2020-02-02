@extends('layouts.layout')
@section('content')
<title>
Dashboard Siswa  | BKP Online
</title>
  <!-- Content Wrapper. Contains page content -->
  <!-- Header -->
  <style>
  .centered {
     float: none !important;
     margin: auto !important;
}

  </style>
  <div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
          <div class="col-xl-6 col-sm-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Reward</h5>
                      <span class="h2 font-weight-bold mb-0">@foreach($siswa as $s) {{$s->skor_reward}} @endforeach </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    @foreach($tb_kebijakan_reward as $tb)
                  <div class="card bg-primary text-white mt-2 text-center">
                    <div class="card-body"><span class="float-left">{{$tb->kode_reward}}</span>  <span>{{$tb->point}}</span> <span class="float-right">{{$tb->tgl_dapat_reward}}</span></div>
                  </div>
                  @endforeach
                  </p>
                </div>
              </div>
            </div>
           
            <div class="col-xl-6 col-sm-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Punishment</h5>
                      <span class="h2 font-weight-bold mb-0">@foreach($siswa as $s) {{$s->skor_punishment}} @endforeach </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                  
                  @foreach($tb_kebijakan_punishment as $tb)
                  <div class="card bg-primary text-white mt-2 text-center">
                    <div class="card-body"><span class="float-left">{{$tb->kode_punishment}}</span>  <span>{{$tb->point_punishment}}</span> <span class="float-right">{{$tb->tgl_dapat_punishment}}</span></div>
                  </div>
                  @endforeach
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
     
  </div>
  @endsection