<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Medical Help</title>

<link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="icon" type="image/png" href="{{ asset('dist/img/logoo.png') }}">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
 
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>
    <!-- Right navbar links -->
    
     <style>  
    .user-email {
    margin-right: 10px; /* Ajusta el valor según la separación deseada */
}
</style>

<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <span class="user-email">{{ auth()->user()->name }}</span>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt" id="logout-icon"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>








       
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        
      </li>

      

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: #fff;">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
         <img src="{{ asset('dist/img/enfermero.png') }}"  alt="User Image">
        </div>
        <div class="info">
        <a href="/inicio" class="d-block">My Medical Help</a>

        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <script>
    document.addEventListener('DOMContentLoaded', function() {
        var navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(function(link) {
            if (link.getAttribute('href') === window.location.pathname) {
                link.classList.add('active');
            }
        });
    });
</script>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="/inicio" class="nav-link">
            <i class="fa-solid fa-house"></i>    
                <p>Inicio</p>
            </a>
        </li> 

        <!-- Si idRol no es 3, muestra estos links -->
        @if(auth()->user()->idRol != 3)
            <li class="nav-item">
                <a href="/Rol" class="nav-link">
                <i class="fa-solid fa-chess"></i>
                    <p>Roles</p>
                </a>
            </li>  
            
            <li class="nav-item">
                <a href="/Ep" class="nav-link">
                <i class="fa-sharp fa-solid fa-building"></i>
                    <p>Eps</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="/Contrato" class="nav-link">
                <i class="fa-solid fa-file-contract"></i>
                    <p>Contratos</p>
                </a>
            </li>
        @endif 

              <li class="nav-item">
                <a href="/User" class="nav-link">
                <i class="fa-solid fa-user-nurse"></i>
                  <p>Usuario</p>
                </a>
              </li>  
            <li class="nav-item">
                    <a href="/Paciente" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>Pacientes</p>
                    </a>
                </li>
              <li class="nav-item">
                <a href="/Agenda" class="nav-link">
                <i class="fa-solid fa-calendar-days"></i>
                                    <p>Agenda</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/Historia" class="nav-link">
                <i class="fa-solid fa-notes-medical"></i>
                                  <p>Historia</p>
                </a>
              </li>
  
              
        
        </ul>
        
      </nav>

      <!-- /.sidebar-menu -->
    </div>

  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer>
     <!-- Main content -->
     </section>
    <!-- /.content -->
  </div>
 

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script src="{{ asset('js/Spanish.json') }}"></script>



<!-- Agrega estos scripts al final del body del layout principal -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>


</body>
</html>

