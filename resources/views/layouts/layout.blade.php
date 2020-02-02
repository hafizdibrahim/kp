
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700')}}" rel="stylesheet">
  <link href="{{('/assets/js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{('/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">

<link rel="stylesheet" href="{{url('/assets/css/argon-dashboard.css')}}">
<style>
 @media screen and (min-width: 700px) {
  .geser_atas {
    margin-top: 20px !important;
  }
 }
</style>
</head>

<body class="">
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      
      @if(Auth::user()->level == 'Admin')
      <a class="navbar-brand pt-0" href="/dashboard_admin">
      @elseif(Auth::user()->level == 'Guru')
      <a class="navbar-brand pt-0" href="/dashboard_guru">
      @else
      <a class="navbar-brand pt-0" href="/dashboard_siswa ">
      @endif
      <img src="{{url('/assets/img/smk.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-1"
           style="opacity: .8">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              {{Auth::user()->nama}}
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
            @if(Auth::user()->level == 'Admin')
            <a href="/dashboard_admin">
              <img src="{{url('/assets/img/smk.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-1"
           style="opacity: .8">
            </a>
          @elseif(Auth::user()->level == 'Guru')
            <a href="/dashboard_guru">
              <img src="{{url('/assets/img/smk.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-1"
           style="opacity: .8">
            </a>
          @else
            <a href="/dashboard_siswa">
              <img src="{{url('/assets/img/smk.jpg')}}" alt="AdminLTE Logo" class="brand-image elevation-1"
           style="opacity: .8">
            </a>
          @endif
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
       
        <!-- Navigation -->
        <ul class="navbar-nav">
        @if(Auth::user()->level == 'Admin')
        <li class="nav-item">
            <a class="nav-link " href="/dashboard_admin">
              <i class="ni ni-planet text-blue"></i> Dashboard
            </a>
          </li>
          @elseif(Auth::user()->level == 'Guru')
          <li class="nav-item">
            <a class="nav-link " href="/dashboard_guru">
              <i class="ni ni-planet text-blue"></i> Dashboard
            </a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link " href="/dashboard_siswa">
              <i class="ni ni-planet text-blue"></i> Dashboard
            </a>
          </li>
          
          @endif
          @if(Auth::user()->level != 'Admin')
          @else
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-ungroup text-orange"></i>
                <span class="nav-link-text">Data Master</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/rombel" class="nav-link">Rombel</a>
                  </li>
                  <li class="nav-item">
                    <a href="/rayon" class="nav-link">Rayon</a>
                  </li>
                  <li class="nav-item">
                    <a href="/jurusan" class="nav-link">Jurusan</a>
                  </li>
                  <li class="nav-item">
                    <a href="/mapel" class="nav-link">Mata Pelajaran</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples5" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples5">
                <i class="fas fa-users text-orange"></i>
                <span class="nav-link-text">Data User</span>
              </a>
              <div class="collapse" id="navbar-examples5">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/guru" class="nav-link">Guru</a>
                  </li>
                  <li class="nav-item">
                    <a href="/admin" class="nav-link">Admin</a>
                  </li>
                  <li class="nav-item">
                    <a href="/siswa" class="nav-link">Siswa</a>
                  </li>
                </ul>
              </div>
            </li>
          @endif
          @if(Auth::user()->level == 'Guru')
          <li class="nav-item">
              <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-ungroup text-orange"></i>
                <span class="nav-link-text">History</span>
              </a>
              <div class="collapse" id="navbar-examples">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/history_memberi_punishment" class="nav-link">Memberi Punishment</a>
                  </li>
                  <li class="nav-item">
                    <a href="/history_memberi_reward" class="nav-link">Memberi Reward</a>
                  </li>
                </ul>
              </div>
            </li>
            @else
            @endif
            @if(Auth::user()->level == 'Siswa')
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-spaceship text-success"></i>
                <span class="nav-link-text">Data Point</span>
              </a>
              <div class="collapse" id="navbar-examples3">
                <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                  <a class="nav-link " href="/siswa_punishment">
                     Jumlah Punishment
                  </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="/siswa_reward">
                       Jumlah Reward
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            
            @else
            @endif
          
            <li class="nav-item">
              <a class="nav-link" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="ni ni-spaceship text-orange"></i>
                <span class="nav-link-text">Data Kebijakan</span>
              </a>
              <div class="collapse" id="navbar-examples2">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                    <a href="/punishment" class="nav-link">Punishment</a>
                  </li>
                  <li class="nav-item">
                    <a href="/reward" class="nav-link">Reward</a>
                  </li>
                </ul>
              </div>
            </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="/dashboard_admin">Dashboard</a>
     
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">{{Auth::user()->nama}}</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
   
    @include('sweetalert::alert')
  @yield('content')
  
  

 <!--   Core   -->
 <script src="{{url('/assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{url('/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Optional JS   -->
  <script src="{{url('/assets/js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{url('/assets/js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
  <!--   Argon JS   -->
  <script src="{{url('/assets/js/argon-dashboard.min.js?v=1.1.0')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


 <!-- MODAL EDIT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!-- AKHIR MODAL EDIT -->
@stack('scripts')
</body>