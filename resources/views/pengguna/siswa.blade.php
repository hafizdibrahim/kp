@extends('layouts.layout')
@section('content')
<title>
Data Siswa | BKP Online
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
                Tambah Siswa
                </button>
            </div>
            <div class="card-body">
                
            <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> NIS</th>
                    <th> Nama</th>
                    <th> Username</th>
                    <th> Email</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    
                @foreach($siswa as $r)
                <tr class="data-row">
                    <td class="align-middle iteration">1</td>
                    <td class="align-middle nis">{{$r->nis}}</td>
                    <td class="align-middle name">{{$r->nama}}</td>
                    <td class="align-middle username">{{$r->username}}</td>
                    <td class="align-middle email">{{$r->email}}</td>
                    <td class="align-middle">
                    <a href="detail_siswa/{{$r->id}}" class="btn btn-primary btn-sm">Detail</a>
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
  
<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form" class="form-horizontal" method="POST" action="/siswa/update">
         {{csrf_field()}}
                <input type="hidden" name="modal_input_id" class="form-control" id="modal_input_id" required>
              <!-- /id -->
              <!-- name -->
              <div class="form-group">
                <label class="col-form-label" for="modal_input_name">Nama Siswa</label>
                <input type="text" name="modal_input_name" class="form-control" id="modal_input_name" required autofocus>
              </div>
              <!-- /name -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Attachment Modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="/tambah_siswa">
                        @csrf
                        

                        <div class="form-group">
                            <label for="nis">NIS</label>

                            <div class="">
                                <input id="nis" type="number" min="13" onKeyPress="if(this.value.length==13) return false;" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis') }}" required autocomplete="nis" autofocus>

                                @error('nis')
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
                        <div class="form-group">
                            <label for="rombel">Rombel</label>

                            <div class="">
                                <select class="form-control" name="rombel">
                                  @foreach($rombel as $r)
                                    <option value="{{$r->id_rombel}}">{{$r->nama_rombel}} </option>
                                  @endforeach
                                </select>
                                @error('rombel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="rayon">rayon</label>

                            <div class="">
                                <select class="form-control" name="rayon">
                                  @foreach($rayon as $r)
                                    <option value="{{$r->id_rayon}}">{{$r->nama_rayon}} </option>
                                  @endforeach
                                </select>
                                @error('rayon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="jurusan">jurusan</label>

                            <div class="">
                                <select class="form-control" name="jurusan">
                                  @foreach($jurusan as $r)
                                    <option value="{{$r->id_jurusan}}">{{$r->nama_jurusan}} </option>
                                  @endforeach
                                </select>
                                @error('jurusan')
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
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#edit-modal').modal(options)
  })

  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('item-id');
    var name = row.children(".name").text();
    var description = row.children(".description").text();

    // fill the data in the input fields
    $("#modal_input_id").val(id);
    $("#modal_input_name").val(name);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})




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