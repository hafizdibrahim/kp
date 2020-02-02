@extends('layouts.layout')
@section('content')
<title>
Rombel | BKP Online
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
            <button type="button" class="btn btn-sm btn-primary " data-toggle="modal" data-target="#exampleModal">
                Tambah Rombel
                </button>
            </div>
            <div class="card-body">
            <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Nama Rombel</th>
                    <th> Aksi</th>
                </tr>
                </thead>
                <tbody>
                    
                @foreach($rombel as $r)
                <tr class="data-row">
                    <td class="align-middle iteration">1</td>
                    <td class="align-middle name">{{$r->nama_rombel}} </td>
                    <td class="align-middle">
                    <a href="/rombel/detail/{{$r->id_rombel}}" class="btn btn-info btn-sm">Detail</a>
                    <button type="button" class="btn btn-primary btn-sm" id="edit-item" data-item-id="{{$r->id_rombel}} ">Edit</button>
                    <!-- <a href="/rombel/hapus/{{$r->id_rombel}}" onclick="return confirm('Anda Yakin ?')" class="btn btn-danger btn-sm">Hapus</a> -->
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Rombel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form" class="form-horizontal" method="POST" action="/rombel/update">
         {{csrf_field()}}
                <input type="hidden" name="modal_input_id" class="form-control" id="modal_input_id" required>
              <!-- /id -->
              <!-- name -->
              <div class="form-group">
                <label class="col-form-label" for="modal_input_name">Nama Rombel</label>
                <input type="text" name="modal_input_name" class="form-control" id="modal_input_name" required autofocus>
              </div>
              <!-- /name -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ubah</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Rombel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/rombel/store" method="POST">
        {{csrf_field()}}
            <div class="form-group">
                <label for="nama_rombel">Rombel</label>
                <input type="text" id="nama_rombel" class="form-control{{ $errors->has('nama_rombel') ? ' is-invalid' : '' }}" name="nama_rombel" value="{{ old('nama_rombel') }}" >
                
                @if ($errors->has('nama_rombel'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> Nama rombel sudah terpakai</strong>
                                    </span>
                                @endif
            </div>
            
      </div>
      <div class="modal-footer">
      <button class="btn btn-sm btn-primary">Tambah</button>
        </form>
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
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