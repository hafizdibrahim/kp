@extends('layouts.layout')
@section('content')
<title>
Data Guru | BKP Online
</title>
  <!-- Content Wrapper. Contains page content -->
  <!-- Header -->
  <div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
       
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header bg-transparent">
            <button type="button" class="btn btn-md btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                Tambah Guru
                </button>
            </div>
            <div class="card-body">
                
            <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Nama Guru</th>
                    <th> Nama Mapel</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    
                @foreach($guru as $r)
                <tr class="data-row">
                    <td class="align-middle iteration">1</td>
                    <td class="align-middle name">{{$r->nama_guru}} </td>
                    <td class="align-middle name">{{$r->nama_mapel}} </td>
                    <td class="align-middle">
                    <a href="detail_guru/{{$r->id_guru}}" class="btn btn-primary btn-sm">Detail</a>
                    <!-- <a href="/guru/hapus/{{$r->id_guru}}" onclick="return confirm('Anda Yakin ?')" class="btn btn-danger">Hapus</a> -->
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            </div>
          </div>
        </div>
        
      </div>
     
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/tambah_guru">
                        @csrf
                        

                        <div class="form-group">
                            <label for="nik">NIK</label>

                            <div class="">
                                <input id="nik" type="number" min="13" onKeyPress="if(this.value.length==13) return false;" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>

                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="nama">Nama</label>

                            <div class="">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama">Mata Pelajaran </label>
                        <div class="">
                                <select name="mapel_id" id="mapel_id" class="form-control">
                                @foreach($mapel as $m)
                                    <option value="{{$m->id_mapel}}">{{$m->nama_mapel}}</option>
                                @endforeach
                                </select>
                               
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="username">Username</label>

                            <div class="">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                                    Tambah
                                </button>
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
      </div>
    </div>
  </div>
</div>
</div>

  @push('scripts')
  
    <script>


$(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
    </script>
    @endpush
  @endsection