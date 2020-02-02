@extends('layouts.layout')
@section('content')
<title>
History Memberi Punishment | BKP Online
</title>
  <!-- Content Wrapper. Contains page content -->
  <!-- Header -->
  <style>
  .modal-body {
    max-height: calc(100vh - 210px);
    overflow-x: auto;
}
  </style>
  
  <div class="header bg-gradient-warning pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
          <div class="col-xl-6 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="input-daterange datepicker row align-items-center">
                            <div class="col">
                            <form action="/filter_punishment" method="GET">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        @if( request('dari') !='' )
                                        <input type="text" name="dari" class="form-control datepicker" placeholder="Start date" tooltip="Dari Tanggal" required value="{{request('dari')}}">
                                        @else
                                        <input type="text" name="dari" class="form-control datepicker" placeholder="Start date" tooltip="Dari Tanggal" value="<?php echo date('Y-m-d')?>" id="aktif" required>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        @if( request('ke') !='' )
                                        <input type="text" name="ke" class="form-control datepicker" placeholder="Start date" tooltip="ke Tanggal" required value="{{request('ke')}}">
                                        @else
                                        <input type="text" name="ke" class="form-control datepicker" placeholder="Start date" tooltip="ke Tanggal" value="<?php echo date('Y-m-d')?>" id="aktif" required>
                                        @endif
                                       
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Filter Punishment</button>
                            </form>
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
              
            <div class="card-body">
               
            <div style="overflow-x:auto;">
                <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    <th>#</th>
                        <th> NIS</th>
                        <th> Nama</th>
                        <th class="d-none"> Rombel</th>
                        <th> Rayon</th>
                        <th>Tanggal</th>
                        <th> Kode Punishment</th>
                        <th> Point</th>
                        <th class="d-none">Penghargaan</th>
                        <th> Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($punishment as $r)
                    <tr class="data-row">
                        <td class="align-middle iteration">1</td>
                        <td class="align-middle nis">{{$r->nis}} </td>
                        <td class="align-middle nama">{{$r->nama}}</td>
                        <td class="align-middle nama_rombel d-none"> {{$r->nama_rombel}}</td>
                        <td class="align-middle nama_rayon"> {{$r->nama_rayon}}</td>
                        <td class="align-middle tgl_dapat_punishment"> {{$r->tgl_dapat_punishment}}</td>
                        <td class="align-middle kode_punishment"> {{$r->kode_punishment}}</td>
                        <td class="align-middle point_punishment"> {{$r->point_punishment}}</td>
                        <td class="align-middle keterangan_punishment d-none"> {{$r->keterangan_punishment}}</td>
                        <td class="align-middle">
                        <button type="button" class="btn btn-primary btn-sm" id="edit-item" data-item-id="{{$r->id_kebijakan_punishment}}">Detail</button>
                        <a href="guru_hapus_punishment/{{$r->id_kebijakan_punishment}}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    @if($punishment->sum('point_punishment') =="")
                  
                  @else
                  <tr>
                      <th colspan="6" class="text-center">Total Memberi Punishment</th>
                      <td>{{$punishment->sum('point_punishment')}}</td>
                      <td></td>
                  </tr>
                  @endif
                </table>
            </div>
            </div>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
  
  

<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail punishment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
              <div class="form-group">
              <form action="/punishment/murid/store" method="POST">
         {{csrf_field()}}
              <input type="hidden" value="{{Auth::user()->id}}" name="guru_id" class="form-control" readonly>
                <input type="hidden" name="siswa_id" class="form-control" id="modal_input_id" required readonly>
                <label class="col-form-label" for="modal_input_nis">NIS</label>
                <input type="text" name="modal_input_nis" class="form-control" id="modal_input_nis" required readonly>
              </div>
              <!-- /name -->
               <!-- name -->
               <div class="form-group">
                <label class="col-form-label" for="modal_input_nama">Nama</label>
                <input type="text" name="modal_input_nama" class="form-control" id="modal_input_nama" required readonly>
              </div>
              <!-- /name -->
               <!-- name -->
               <div class="form-group">
                <label class="col-form-label" for="modal_input_nama_rombel">Rombel</label>
                <input type="text" name="modal_input_nama_rombel" class="form-control" id="modal_input_nama_rombel" required readonly>
              </div>
              <!-- /name -->
               <!-- name -->
               <div class="form-group">
                <label class="col-form-label" for="modal_input_nama_rayon">Rayon</label>
                <input type="text" name="modal_input_nama_rayon" class="form-control" id="modal_input_nama_rayon" required readonly>
              </div>
              <!-- /name -->
              <div class="form-group">
                <label class="col-form-label" for="modal_input_tgl_dapat_punishment">Tanggal</label>
                <input type="text" name="modal_input_tgl_dapat_punishment" class="form-control" id="modal_input_tgl_dapat_punishment" required readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal_input_kode_punishment">Kode Punishment</label>
                <input type="text" name="modal_input_kode_punishment" class="form-control" id="modal_input_kode_punishment" required readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal_input_point_punishment">Point Punishment</label>
                <input type="text" name="modal_input_point_punishment" class="form-control" id="modal_input_point_punishment" required readonly>
              </div>
              <div class="form-group">
                <label class="col-form-label" for="modal_input_keterangan_punishment">Pelanggaran</label>
                <input type="text" name="modal_input_keterangan_punishment" class="form-control" id="modal_input_keterangan_punishment" required readonly>
              </div>
           
            
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<!-- /Attachment Modal -->



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
    var nis = row.children(".nis").text();
    var nama = row.children(".nama").text();
    var nama_rombel = row.children(".nama_rombel").text();
    var nama_rayon = row.children(".nama_rayon").text();
    var kode_punishment = row.children(".kode_punishment").text();
    var point_punishment = row.children(".point_punishment").text();
    var tgl_dapat_punishment = row.children(".tgl_dapat_punishment").text();
    var keterangan_punishment = row.children(".keterangan_punishment").text();
    
    // fill the data in the input fields
    $("#modal_input_id").val(id);
    $("#modal_input_nis").val(nis);
    $("#modal_input_nama").val(nama);
    $("#modal_input_nama_rombel").val(nama_rombel);
    $("#modal_input_nama_rayon").val(nama_rayon);
    $("#modal_input_kode_punishment").val(kode_punishment);
    $("#modal_input_point_punishment").val(point_punishment);
    $("#modal_input_tgl_dapat_punishment").val(tgl_dapat_punishment);
    $("#modal_input_keterangan_punishment").val(keterangan_punishment);

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

$('.datepicker').datepicker({
    locale:'id',
   format:'yyyy-m-d',
    autoclose:true
});
    </script>
    @endpush
  @endsection