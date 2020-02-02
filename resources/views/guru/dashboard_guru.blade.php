@extends('layouts.layout')
@section('content')
<title>
Dashboard Guru | BKP Online
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
                      <p class="card-title text-uppercase mb-0 mt-2 text-bold">{{$hari_ini}}, &nbsp; {{$date}}</p>
                   
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
                        <th> NIS</th>
                        <th> Nama</th>
                        <th> Rombel</th>
                        <th> Rayon</th>
                        <th> Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($siswa as $s)
                    <tr class="data-row">
                        <td class="align-middle iteration">1</td>
                        <td class="align-middle nis">{{$s->nis}} </td>
                        <td class="align-middle nama">{{$s->nama}} </td>
                        <td class="align-middle nama_rombel">{{$s->nama_rombel}} </td>
                        <td class="align-middle nama_rayon">{{$s->nama_rayon}} </td>
                        <td class="align-middle">
                        <button type="button" class="btn btn-danger btn-md" id="edit-item" data-item-id="{{$s->id}}">P</button>
                        
                        <button type="button" class="btn btn-primary btn-md" id="edit-item2" data-item-id="{{$s->id}}">H</button>
                        </td>
                    @endforeach
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
  
  

<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Beri Punishment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/punishment/murid/store" method="POST">
         {{csrf_field()}}
              <div class="form-group">
              <input type="hidden" value="{{Auth::user()->id}}" name="guru_id" class="form-control" readonly>
                <input type="hidden" name="siswa_id" class="form-control" id="modal_input_id" required readonly>
              </div>
              <!-- /id -->
              <!-- name -->
              <div class="form-group">
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
                <label for="punishment_id">Punishment</label>
                @foreach($punishment as $p)   
              <input type="hidden" value="{{$p->point_1}}" name="point_1" class="form-control" readonly>                
              <input type="hidden" value="{{$p->point_2}}" name="point_2" class="form-control" readonly>                
              <input type="hidden" value="{{$p->point_3}}" name="point_3" class="form-control" readonly>             
                @endforeach
                <select name="id_punishment" id="id_punishment" class="form-control text-dark text-bold">
                @foreach($punishment as $p)   
                    <option value="{{$p->id_punishment}}">{{$p->kode_punishment}} &nbsp; || &nbsp;{{$p->keterangan_punishment}}</option>
                @endforeach
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Selesai</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>
<!-- /Attachment Modal -->



<!-- Attachment Modal -->
<div class="modal fade" id="edit-modal2" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Beri Reward</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/reward/murid/store" method="POST">
         {{csrf_field()}}
              <div class="form-group">
              <input type="hidden" value="{{Auth::user()->id}}" name="guru_id" class="form-control" readonly>
                <input type="hidden" name="siswa_id" class="form-control" id="modal_input_id_2" required readonly>
              </div>
              <!-- /id -->
              <!-- name -->
              <div class="form-group">
                <label class="col-form-label" for="modal_input_nis">NIS</label>
                <input type="text" name="modal_input_nis" class="form-control" id="modal_input_nis_2" required readonly>
              </div>
              <!-- /name -->
               <!-- name -->
               <div class="form-group">
                <label class="col-form-label" for="modal_input_nama">Nama</label>
                <input type="text" name="modal_input_nama" class="form-control" id="modal_input_nama_2" required readonly>
              </div>
              <!-- /name -->
               <!-- name -->
               <div class="form-group">
                <label class="col-form-label" for="modal_input_nama_rombel">Rombel</label>
                <input type="text" name="modal_input_nama_rombel" class="form-control" id="modal_input_nama_rombel_2" required readonly>
              </div>
              <!-- /name -->
               <!-- name -->
               <div class="form-group">
                <label class="col-form-label" for="modal_input_nama_rayon">Rayon</label>
                <input type="text" name="modal_input_nama_rayon" class="form-control" id="modal_input_nama_rayon_2" required readonly>
              </div>
              <!-- /name -->
              <div class="form-group">
                <label for="punishment_id">Reward</label>
                @foreach($reward as $p)   
              <input type="hidden" value="{{$p->point}}" name="point" class="form-control" readonly>             
                @endforeach
                <select name="id_reward" id="id_reward" class="form-control text-dark text-bold">
                @foreach($reward as $p)   
                    <option value="{{$p->id_reward}}">{{$p->kode_reward}} &nbsp; || &nbsp;{{$p->keterangan_reward}}</option>
                @endforeach
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Selesai</button>
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

    // fill the data in the input fields
    $("#modal_input_id").val(id);
    $("#modal_input_nis").val(nis);
    $("#modal_input_nama").val(nama);
    $("#modal_input_nama_rombel").val(nama_rombel);
    $("#modal_input_nama_rayon").val(nama_rayon);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })
})

$(document).ready(function() {
  /**
   * for showing edit item popup
   */

  $(document).on('click', "#edit-item2", function() {
    $(this).addClass('edit-item2-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#edit-modal2').modal(options)
  })

  // on modal show
  $('#edit-modal2').on('show.bs.modal', function() {
    var el = $(".edit-item2-trigger-clicked"); // See how its usefull right here? 
    var row = el.closest(".data-row");

    // get the data
    var id = el.data('item-id');
    var nis = row.children(".nis").text();
    var nama = row.children(".nama").text();
    var nama_rombel = row.children(".nama_rombel").text();
    var nama_rayon = row.children(".nama_rayon").text();

    // fill the data in the input fields
    $("#modal_input_id_2").val(id);
    $("#modal_input_nis_2").val(nis);
    $("#modal_input_nama_2").val(nama);
    $("#modal_input_nama_rombel_2").val(nama_rombel);
    $("#modal_input_nama_rayon_2").val(nama_rayon);

  })

  // on modal hide
  $('#edit-modal2').on('hide.bs.modal', function() {
    $('.edit-item2-trigger-clicked').removeClass('edit-item2-trigger-clicked')
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