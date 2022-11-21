@extends('admin.template.main_menu')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row justify-content-center" style="margin: 0;">
          <div class="col-lg-3">
            <div class="card" style="height: 250px;width: 250px;">
              <div class="card-body text-center"><br>
                <a href="{{ url('admin/menu/1') }}" class="card-link" style="text-decoration: none;color:#000;font-weight:bold;">
                    <img src="{{url('sites/dist/img/logo1.png')}}" style="height: 150px;width: 150px;">
                    <br>Manufacturing Order
                </a>
              </div>
            </div>
            <div class="card" style="height: 250px;width: 250px;">
              <div class="card-body text-center"><br>
                <a href="{{ url('admin/menu/3') }}" class="card-link" style="text-decoration: none;color:#000;font-weight:bold;">
                    <img src="{{ url('sites/dist/img/logo1.png') }}"" style="height: 150px;width: 150px;">
                    <br>Preventive Maintenance
                </a>
              </div>
            </div><!-- /.card -->
          </div>

          <div class="col-lg-4">
          <div class="card" style="height: 250px;width: 250px;">
              <div class="card-body text-center"><br>
                <a href="{{ url('admin/menu/2') }}" class="card-link" style="text-decoration: none;color:#000;font-weight:bold;">
                    <img src="{{url('sites/dist/img/logo1.png')}}" style="height: 150px;width: 150px;">
                    <br>Production Analytic
                </a>
              </div>
            </div>
            <div class="card" style="height: 250px;width: 250px;">
              <div class="card-body text-center"><br>
                <a href="{{ url('admin/daily-report') }}" class="card-link" style="text-decoration: none;color:#000;font-weight:bold;">
                    <img src="{{url('sites/dist/img/logo1.png')}}" style="height: 150px;width: 150px;">
                    <br>Daily Report
                </a>
              </div>
              </div>
            </div><!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  @endsection
