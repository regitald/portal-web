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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('sites/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('sites/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->

  <div class="card">
    <div class="card-header">
      <a href="#" class="h2"><b>{{ $title }}</b></a>
    </div>
    <div class="card-body login-card-body">

    <p style="font-size: 12px;">Lengkapi data dibawah ini.</p>
    @if($errors->any())
      <div class="alert alert-danger">
      {{$errors->first()}}
      </div>
    @endif
      <form method="POST" action="{{ route('user') }}">
       {{ csrf_field() }}
        <div class="input-group mb-3">
          <input name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="first_name" class="form-control" placeholder="Firstname">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="last_name" class="form-control" placeholder="Lastname">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="email" class="form-control" placeholder="Mail">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <input type="text" name="role_id" class="form-control" value="8" style="display: none;">
        <input type="text" name="phone_number" class="form-control" value="0" style="display: none;">
        <div class="row">
          <!-- /.col -->
          <div class="col-12" style="margin-top: 10px;">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: #3BB873;border:none">Request Account</button>
            <p style="font-size: 12px;margin-top: 10px;">Sudah memiliki akun ? <a href="{{ route('/') }}">Login</a></p>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('sites/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('sites/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('sites/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
