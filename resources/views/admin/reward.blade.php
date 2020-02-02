@extends('layouts.layout')
@section('content')
<title>
Reward | BKP Online
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
                      <p class="card-title text-uppercase mb-0 mt-2 text-bold">Data Reward</p>
                   
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
        <div class="justify-content-center">
      <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
          @if(Auth::user()->level != 'Admin')
          @else
            <div class="card-header bg-transparent">
            <button type="button" class="btn btn-md btn-primary " data-toggle="modal" data-target="#exampleModal">
                Tambah Reward
                </button>
            </div>
            @endif
            <div class="card-body">
                
            <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Kode Reward</th>
                    <th> Point</th>
                    <th> Penghargaan</th>
                    @if(Auth::user()->level !='Admin')
                    @else
                    <th>Aksi</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                    
                @foreach($reward as $r)
                <tr class="data-row">
                    <td class="align-middle iteration">1</td>
                    <td class="align-middle kode">{{$r->kode_reward}} </td>
                    <td class="align-middle point">{{$r->point}} </td>
                    <td class="align-middle keterangan_reward">{{$r->keterangan_reward}} </td>
                    @if(Auth::user()->level !='Admin')
                    @else
                    <td class="align-middle">
                    <button type="button" class="btn btn-primary" id="edit-item" data-item-id="{{$r->id_reward}} ">Edit</button>
                    <!-- <a href="/reward/hapus/{{$r->id_reward}}" onclick="return confirm('Anda Yakin ?')" class="btn btn-danger">Hapus</a> -->
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
  
<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Reward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-form" class="form-horizontal" method="POST" action="/reward/update">
         {{csrf_field()}}
              <div class="form-group">
                <input type="hidden" name="modal_input_id" class="form-control" id="modal_input_id" required>
              </div>
              <!-- /id -->
              <!-- name -->
              <div class="form-group">
                <label class="col-form-label" for="modal_input_kode">Kode Reward</label>
                <input type="text" name="modal_input_kode" class="form-control" id="modal_input_kode" required autofocus>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal_input_point">Point</label>
                <input type="text" name="modal_input_point" class="form-control" id="modal_input_point" required autofocus>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal_input_keterangan_reward">Keterangan</label>
                <input type="text" name="modal_input_keterangan_reward" class="form-control" id="modal_input_keterangan_reward" required autofocus>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Reward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/reward/store" method="POST">
        {{csrf_field()}}
            <div class="form-group">
                <label for="Nama">Kode Reward</label>
                <input type="text" class="form-control" name="kode_reward">
            </div>
            <div class="form-group">
                <label for="point">Point</label>
                <input type="text" class="form-control" name="point">
            </div>
            <div class="form-group">
                <label for="keterangan_reward">Keterangan Reward</label>
                <input type="text" class="form-control" name="keterangan_reward">
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
    var kode = row.children(".kode").text();
    var point = row.children(".point").text();
    var keterangan_reward = row.children(".keterangan_reward").text();

    // fill the data in the input fields
    $("#modal_input_id").val(id);
    $("#modal_input_kode").val(kode);
    $("#modal_input_point").val(point);
    $("#modal_input_keterangan_reward").val(keterangan_reward);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})




$(document).ready(function() {
    var t = $('#example').DataTable( {
        responsive: true,
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
    new $.fn.dataTable.FixedHeader( t );
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
    </script>
    @endpush
  @endsection