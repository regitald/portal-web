@extends('admin.template.main')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form role="form" method="post" action="{{ url('admin/user/create') }}">
                {{ csrf_field() }}
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputText">Firstname</label>
                    <input type="text" name="first_name" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Lastname</label>
                    <input type="text" name="last_name" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputText">Account Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputText" required>
                  </div>
                  <div class="form-group">
                      <label>Account Status</label>
                      <select class="custom-select" name="status">
                        <option value="true">Active</option>
                        <option value="false">Deadactivated</option>
                      </select>
                  </div>
                </div>
                <input type="text" name="role_id" class="form-control" value="8" style="display: none;">
                <input type="text" name="phone_number" class="form-control" value="<?php echo mt_rand(0, 9); ?>" style="display: none;">
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection