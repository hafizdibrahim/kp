@extends('layouts.layout')
@section('content')
<title>
    Detail Data Guru  | BKP Online
 </title>
<!-- Header -->
<div class="header pb-6 d-flex align-items-center" style="min-height: 300px; background-image: url(../../assets/img/brand/1.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-primary opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid">
        <div class="col-auto">
        </div>
    </div>
</div>
    
<br>
<br>
<div class="container-fluid mt--7">

  <div class="row">
  <div class="col-xl-8 order-xl-2 offset-2">
    <div class="card shadow">
                    <div class="card-body">
                    @foreach($guru as $p)
                    <form method="POST" action="/guru_update">
                    {{csrf_field()}}
                    <input type="hidden" class="form-control" id="id_guru" name="id_guru" value="{{$p->id_guru}}">

                    <div class="form-group">
                      <div class="form-group">
                        <label for="nama" class="col-sm-4 control-label">Nama</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="{{$p->nama_guru}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Username</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name="username" value="{{$p->username_guru}}">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="form-group">
                        <label for="mapel" class="col-sm-4 control-label">Mapel</label>
                            <div class="col-sm-10">
                                <select name="mapel" id="mapel" class="form-control">
                                    @foreach($mapel as $m)
                                    @if($p->mapel_id == $m->id_mapel)
                                        <option value="{{$m->id_mapel}}" selected>{{$m->nama_mapel}}</option>
                                        @else
                                        <option value="{{$m->id_mapel}}">{{$m->nama_mapel}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email</label>

                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" name="email" value="{{$p->email_guru}}" readonly>
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