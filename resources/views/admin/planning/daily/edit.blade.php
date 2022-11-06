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
              <form role="form" method="post" action="{{ url('admin/planning-daily/update/'.$data['id']) }}">
                {{ csrf_field() }}
                <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                <div class="card-body">
                  <div class="form-group">
                    <label for="production_date">Production Date</label>
                    <input type="date" required name="production_date"  class="form-control" id="production_date" value="{{ \Carbon\Carbon::parse($data['production_date'])->format('Y-m-d') }}" >
                  </div>

                  <div class="form-group">
                    <label for="line_number">Line Number</label>
                    <input type="text" required name="line_number"  class="form-control" id="line_number" value="{{$data['line_number']}}" readonly>
                  </div>

                  <div class="form-group">
                    <label for="no_mo">No MO</label>
                    <input type="text" required name="no_mo"  class="form-control" id="no_mo" value="{{$data['no_mo']}}">
                  </div>

                  <div class="form-group">
                    <label for="part_mo">Part NO</label>
                    <input type="text" required name="part_no"  class="form-control" id="part_no" value="{{$data['part_no']}}">
                  </div>

                  <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" required name="part_name"  class="form-control" id="part_name" value="{{$data['part_name']}}">
                  </div>

                  <div class="form-group">
                    <label for="part_category">Part Category</label>
                    <select class="form-control" name="part_category" required="required">
                        <option value="">Select Part Category</option>
                        <option value="RH" @if($data['part_category']=='RH') selected @endif>RH</option>
                        <option value="LH" @if($data['part_category']=='LH') selected @endif>LH</option>
                        <option value="MID" @if($data['part_category']=='MID') selected @endif>MID</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="target_production">Target Production</label>
                    <input type="number" required name="target_production"  class="form-control" id="target_production" value="{{$data['target_production']}}">
                  </div>

                  <div class="form-group">
                    <label for="cycle_time">Cycle Time</label>
                    <input type="text" required name="cycle_time"  class="form-control" id="cycle_time" value="{{$data['cycle_time']}}">
                  </div>

                  <div class="form-group">
                    <label for="start_production">Start Production</label>
                    <input type="time" required name="start_production"  class="form-control" id="start_production" value="{{$data['start_production']}}">
                  </div>

                  <div class="form-group">
                    <label for="finish_production">Finish Production</label>
                    <input type="time" required name="finish_production"  class="form-control" id="finish_production"  value="{{$data['finish_production']}}">
                  </div>

                  <div class="form-group">
                    <label for="work_hours">Work Hours</label>
                    <input type="text" required name="work_hour"  class="form-control" id="work_hour" value="{{$data['work_hour']}}">
                  </div>

                  <div class="form-group">
                    <label for="part_category">Status</label>
                    <select class="form-control" name="status" required="required">
                        <option value="">Select Status</option>
                        <option value="open" @if($data['status']=='OPEN') selected @endif>Open</option>
                        <option value="onprogress" @if($data['status']=='ON_PROGRESS') selected @endif>On Progress</option>
                        <option value="done" @if($data['status']=='done') selected @endif>Done</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="background-color: #3BB873;border:none">Submit</button>
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
