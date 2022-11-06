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
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row">
          <div class="col-5">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            <!-- general form elements -->
            <div class="card card-primary">

              <!-- form start -->
              <form role="form" method="post" action="{{ url('admin/planning-daily/store') }}">
                {{ csrf_field() }}
                <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                <input type="text" name="status" value="open" style="display:none">
                <div class="card-body">
                  <div class="form-group">
                    <label for="production_date">Production Date</label>
                    <input type="date" required name="production_date"  class="form-control" id="production_date">
                  </div>

                  <!-- <div class="form-group">
                    <label for="line_number">Line Number</label>
                    <input type="text" required name="line_number"  class="form-control" id="line_number">
                  </div> -->
                  <div class="form-group">
                    <label for="line_number">Line Number</label>
                    <select class="form-control" name="line_number" required="required">
                        <option value="">Select Line Number</option>
                        <option value="INJECTION/MC01">INJECTION/MC01</option>
                        <option value="INJECTION/MC02">INJECTION/MC02</option>
                        <option value="INJECTION/MC03">INJECTION/MC03</option>
                        <option value="INJECTION/MC04">INJECTION/MC04</option>
                        <option value="INJECTION/MC05">INJECTION/MC05</option>
                        <option value="INJECTION/MC06">INJECTION/MC06</option>
                        <option value="INJECTION/MC08">INJECTION/MC08</option>
                        <option value="INJECTION/MC11">INJECTION/MC11</option>
                        <option value="INJECTION/MC12">INJECTION/MC12</option>
                        <option value="ASSY/HPW03">ASSY/HPW03</option>
                        
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="no_mo">No MO</label>
                    <input type="text" required name="no_mo"  class="form-control" id="no_mo">
                  </div>

                  <div class="form-group">
                    <label for="part_mo">Part MO</label>
                    <input type="text" required name="part_mo"  class="form-control" id="part_mo">
                  </div>

                  <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" required name="part_name"  class="form-control" id="part_name">
                  </div>

                  <div class="form-group">
                    <label for="part_category">Part Category</label>
                    <select class="form-control" name="part_category" required="required">
                        <option value="">Select Part Category</option>
                        <option value="RH">RH</option>
                        <option value="LH">LH</option>
                        <option value="MID">MID</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="target_production">Target Production</label>
                    <input type="number" required name="target_production"  class="form-control" id="target_production">
                  </div>

                  <div class="form-group">
                    <label for="cycle_time">Cycle Time</label>
                    <input type="text" required name="cycle_time"  class="form-control" id="cycle_time">
                  </div>

                  <div class="form-group">
                    <label for="start_production">Start Production</label>
                    <input type="time" required name="start_production"  class="form-control" id="start_production">
                  </div>

                  <div class="form-group">
                    <label for="finish_production">Finish Production</label>
                    <input type="time" required name="finish_production"  class="form-control" id="finish_production">
                  </div>

                  <div class="form-group">
                    <label for="work_hours">Work Hours</label>
                    <input type="text" required name="work_hours"  class="form-control" id="work_hours">
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
          <div class="col-7">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h1 class="card-title">Import Excel</h1><br>
                </div>

                <div class="card-body">
                    <form role="form" method="post" action="{{ url('admin/planning-daily/import') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" name="module" value="daily" style="display:none">
                        <div class="card-body">
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" required name="file"  class="form-control" id="file" placeholder="File Import">
                        </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="background-color: #3BB873;border:none">Import</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="card-header">
                    <h1 class="card-title">Planning MO<br>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Prodution Date</th>
                        <th>Line Number</th>
                        <th>Part Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key)
                    <tr>
                        <td>{{$key['production_date']}}</td>
                        <td>{{$key['line_number']}}</td>
                        <td>{{$key['part_name']}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Prodution Date</th>
                        <th>Line Number</th>
                        <th>Part Name</th>
                    </tr>
                    </tfoot>
                    </table>
                </div>
                <!-- /.card -->
            </div>
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

