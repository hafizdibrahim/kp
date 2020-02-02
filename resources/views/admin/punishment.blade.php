
@extends('layouts.layout')
@section('content')
<title>
Punishment | BKP Online
</title>
  <!-- Content Wrapper. Contains page content -->
  <!-- Header -->
  <div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body mt-5">
          <!-- Card stats -->
          <div class="row">
          <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <p class="card-title text-uppercase mb-0 mt-2 text-bold">Data Punishment</p>
                   
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
          @if(Auth::user()->level != 'Admin')
          @else
            <div class="card-header bg-transparent">
            <button type="button" class="btn btn-md btn-primary " data-toggle="modal" data-target="#exampleModal">
                Tambah Punishment
                </button>
            </div>
            @endif
            <div class="card-body">
                
            <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Kode Punishment</th>
                    <th>  Pelanggaran</th>
                    <th> Point 1</th>
                    <th>  Point 2</th>
                    <th>  Point 3</th>
                    @if(Auth::user()->level !='Admin')
                    @else
                    <th>Aksi</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    
                @foreach($punishment as $r)
                <tr class="data-row">
                    <td class="align-middle iteration">1</td>
                    <td class="align-middle kode_punishment">{{$r->kode_punishment}} </td>
                    <td class="align-middle keterangan_punishment">{{$r->keterangan_punishment}} </td>
                    <td class="align-middle point_1">{{$r->point_1}}</td>
                    <td class="align-middle point_2">{{$r->point_2}}</td>
                    <td class="align-middle point_3">{{$r->point_3}}</td>
                    @if(Auth::user()->level !='Admin')
                    @else
                    <td class="align-middle">
                    <button type="button" class="btn btn-primary" id="edit-item" data-item-id="{{$r->id_punishment}} ">Edit</button>
                    <!-- <a href="/punishment/hapus/{{$r->id_punishment}}" onclick="return confirm('Anda Yakin ?')" class="btn btn-danger">Hapus</a> -->
                    </td>
                    @endif
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Punishment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form" class="form-horizontal" method="POST" action="/punishment/update">
         {{csrf_field()}}
              <div class="form-group">
                <input type="hidden" name="modal_input_id" class="form-control" id="modal_input_id" required>
              </div>
              <!-- /id -->
              <!-- kode -->
              <div class="form-group">
                <label class="col-form-label" for="modal_input_kode_punishment">Kode Punishment</label>
                <input type="text" name="modal_input_kode_punishment" class="form-control" id="modal_input_kode_punishment" required autofocus>
              </div>
              <!-- /kode -->
                 <!-- kode -->
                <div class="form-group">
                <label class="col-form-label" for="modal_input_point_1">Point 1</label>
                <input type="number" name="modal_input_point_1" class="form-control" id="modal_input_point_1" required autofocus>
              </div>
              <!-- /kode -->
                 <!-- kode -->
                 <div class="form-group">
                <label class="col-form-label" for="modal_input_point_2">Point 2</label>
                <input type="number" name="modal_input_point_2" class="form-control" id="modal_input_point_2" required autofocus>
              </div>
              <!-- /kode -->
                 <!-- kode -->
                 <div class="form-group">
                <label class="col-form-label" for="modal_input_point_3">Point 3</label>
                <input type="number" name="modal_input_point_3" class="form-control" id="modal_input_point_3" required autofocus>
              </div>
              <!-- /kode -->
                 <!-- kode -->
                <div class="form-group">
                <label class="col-form-label" for="modal_input_keterangan_punishment">Keterangan Punishment</label>
                <input type="text" name="modal_input_keterangan_punishment" class="form-control" id="modal_input_keterangan_punishment" required autofocus>
              </div>
              <!-- /kode -->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Done</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Punishment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/punishment/store" method="POST">
        {{csrf_field()}}
            <div class="form-group">
                <label for="kode_punishment">Kode Punishment</label>
                <input type="text" class="form-control" name="kode_punishment">
            </div>
            <div class="form-group">
                <label for="keterangan_punishment">Keterangan Punishment</label>
                <input type="text" class="form-control" name="keterangan_punishment">
            </div>
            <div class="form-group">
                <label for="point_1">Point 1</label>
                <input id="point_1" type="text" class="form-control @error('point_1') is-invalid @enderror" name="point_1" value="{{ old('point_1') }}" required autocomplete="point_1" autofocus>
                @error('point_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="point_2">Point 2</label>
                <input type="number" class="form-control" name="point_2">
            </div>
            <div class="form-group">
                <label for="point_3">Point 3</label>
                <input type="number" class="form-control" name="point_3">
            </div>
            
          
      </div>
      <div class="modal-footer">
      <button class="btn btn-md btn-primary">Tambah</button>
        </form>
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>
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
    var kode_punishment = row.children(".kode_punishment").text();
    var keterangan_punishment = row.children(".keterangan_punishment").text();
    var point_1 = row.children(".point_1").text();
    var point_2 = row.children(".point_2").text();
    var point_3 = row.children(".point_3").text();

    // fill the data in the input fields
    $("#modal_input_id").val(id);
    $("#modal_input_kode_punishment").val(kode_punishment);
    $("#modal_input_keterangan_punishment").val(keterangan_punishment);
    $("#modal_input_point_1").val(point_1);
    $("#modal_input_point_2").val(point_2);
    $("#modal_input_point_3").val(point_3);

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