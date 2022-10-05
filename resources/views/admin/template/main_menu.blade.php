<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('sites/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('sites/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('sites/dist/css/adminlte.min.css')}}">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar/main.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar-daygrid/main.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar-timegrid/main.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar-bootstrap/main.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Navbar -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <span class="brand-text font-weight-light">Porting</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto" style="color:black">
        <li class="nav-item dropdown">
            <a  href="{{ url('admin/profile') }}" style="text-decoration: none;color:black">
                <i class="fas fa-user"></i>
            </a>
        </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a  href="{{ url('/admin/logout') }}" style="text-decoration: none;color:black">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </ul>
    </div>
  </nav>
  <!-- /.navbar -->
  @section('content')
  @show
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2022 <a href="#">-</a>.</strong> All rightsreserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('sites/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('sites/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('sites/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('sites/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('sites/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('sites/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('sites/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('sites/dist/js/demo.js')}}"></script>

<!-- fullCalendar 2.2.5 -->
<script src="{{url('sites/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
