@extends('layouts.layout')
@section('content')
<title>
    Detail Data siswa  | BKP Online
 </title>
  <!-- Content Wrapper. Contains page content -->
  <!-- Header -->
  <div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body mt-5">
          <!-- Card stats -->
          <div class="row">
          @foreach($siswa as $s)
          <div class="col-xl-3 col-lg-6 offset-3">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Punishment</h5>
                      <span class="h2 font-weight-bold mb-0">{{$s->skor_punishment}}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Reward</h5>
                      <span class="h2 font-weight-bold mb-0">{{$s->skor_reward}} </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">

  <div class="row">
  <div class="col-xl-8 order-xl-2 offset-2">
    <div class="card shadow">
                    <div class="card-body">
                    @foreach($siswa as $p)
                    <form method="POST" action="/siswa_update">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" id="id" name="id" value="{{$p->id}}">

                    <div class="form-group">
                      <div class="form-group">
                        <label for="nis" class="col-sm-4 control-label">NIS</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nis" name="nis" value="{{$p->nis}}">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label">Nama</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$p->nama}}">
                        </div>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="form-group">
                        <label for="nama_rombel" class="col-sm-4 control-label">Rombel</label>

                        <div class="col-sm-10">
                            <select name="nama_rombel" id="nama_rombel" class="form-control">
                                @foreach($rombel as $r)
                                @if($p->rombel_id == $r->id_rombel)
                                    <option value="{{$r->id_rombel}}" selected>{{$r->nama_rombel}}</option>
                                    @else
                                    <option value="{{$r->id_rombel}}">{{$r->nama_rombel}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                    
                    <div class="form-group">
                      <div class="form-group">
                        <label for="rayon" class="col-sm-4 control-label">Rayon</label>

                        <div class="col-sm-10">
                            <select name="nama_rayon" id="nama_rayon" class="form-control">
                                @foreach($rayon as $r)
                                @if($p->rayon_id == $r->id_rayon)
                                    <option value="{{$r->id_rayon}}" selected>{{$r->nama_rayon}}</option>
                                    @else
                                    <option value="{{$r->id_rayon}}">{{$r->nama_rayon}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                    
                    <div class="form-group">
                      <div class="form-group">
                        <label for="jurusan" class="col-sm-4 control-label">Jurusan</label>

                        <div class="col-sm-10">
                            <select name="nama_jurusan" id="nama_jurusan" class="form-control">
                                @foreach($jurusan as $r)
                                @if($p->jurusan_id == $r->id_jurusan)
                                    <option value="{{$r->id_jurusan}}" selected>{{$r->nama_jurusan}}</option>
                                    @else
                                    <option value="{{$r->id_jurusan}}">{{$r->nama_jurusan}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Username</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="{{$p->username}}">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="{{$p->email}}" readonly>
                        </div>
                      </div>
                    </div>


                      <div class="form-group">
                        <div class="form-group">
                          <div class="col-sm-10">
                          <button class="btn btn-primary btn-md">Ubah</button>
                          </div>
                      </div>

                      </form>
                      @endforeach
            </div>
        </div>
    </div>

    </div>
  </div>
</div>

</body>
@endsection