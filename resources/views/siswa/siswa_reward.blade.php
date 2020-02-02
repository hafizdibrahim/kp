@extends('layouts.layout')
@section('content')
<title>
Jumlah Reward  | BKP Online
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
                      <p class="card-title text-uppercase mb-0 mt-2 text-bold">Reward</p>
                   
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
            <div class="card-body">
            <div style="overflow-x:auto;">
            <table class="table table-striped table-bordered" id="example"  cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th> Kode Reward</th>
                    <th> Point</th>
                    <th> Tanggal</th>
                    <th> Keterangan </th>
                    <th> Nama Guru </th>
                    <th> Mapel </th>
                </tr>
                </thead>
                <tbody>
                    
                @foreach($siswa as $s)
                <tr class="data-row">
                    <td class="align-middle iteration">1</td>
                    <td class="align-middle">{{$s->kode_reward}}</td>
                    <td class="align-middle">{{$s->point}}</td>
                    <td class="align-middle">{{$s->tgl_dapat_reward}}</td>
                    <td class="align-middle">{{$s->keterangan_reward}}</td>
                    <td class="align-middle">{{$s->nama_guru}}</td>
                    <td class="align-middle">{{$s->nama_mapel}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2" class="text-center">Total Reward</th>
                    <td>{{$s->skor_reward}} </td>
                </tr>
                </tbody>
            </table>
            </div>
            </div>
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