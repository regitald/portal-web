@extends('admin.template.main')
@section('content')
  <link rel="stylesheet" href="{{url('sites/fullcalendar/fonts/icomoon/style.css')}}">
  <link href="{{url('sites/fullcalendar/packages/core/main.css')}}" rel='stylesheet' />
  <link href="{{url('sites/fullcalendar/packages/daygrid/main.css')}}" rel='stylesheet' />
  <style>
    .tooltipevent{
        width:200px;/*
        height:100px;*/
        background:#ccc;
        position:absolute;
        z-index:10001;
        transform:translate3d(-50%,-100%,0);
        font-size: 0.8rem;
        box-shadow: 1px 1px 3px 0px #888888;
        line-height: 1rem;
    }
    .tooltipevent div{
        padding:10px;
    }
    .tooltipevent div:first-child{
        font-weight:bold;
        color:White;
        background-color:#888888;
        border:solid 1px black;
    }
    .tooltipevent div:last-child::after, .tooltipevent div:last-child::before{
        width:0;
        height:0;
        border:solid 5px transparent;/*
        box-shadow: 1px 1px 2px 0px #888888;*/
        border-bottom:0;
        border-top-color:whitesmoke;
        position: absolute;
        display: block;
        content: "";
        bottom:-4px;
        left:50%;
        transform:translateX(-50%);
    }
    .tooltipevent div:last-child::before{
        border-top-color:#888888;
        bottom:-5px;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Maintenance</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Maintenance</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row">
          <div class="col-4">
            @if($errors->any())
              <div class="alert alert-success">
              {{$errors->first()}}
              </div>
            @endif
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Maintenance Event</h3>
                </div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ url('admin/maintenance/store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="line_number">Line Number</label>
                            <select class="form-control" name="line_number" required="required">
                                <option value="">Select Line Number</option>
                                @foreach($list_machine as $key)
                                <option value="{{$key}}">{{$key}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Event:</label>
                            <input type="text" class="form-control" name="desc" required="required">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="maintenance_date">
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <select class="form-control" name="status" required="required">
                                <option value="">Select Status</option>
                                <option value="open">Open</option>
                                <option value="on_progress">On Progress</option>
                                <option value="done">Done</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Create</button>
                </form>
                </div>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-8">

            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Maintenance Events Board</h3>
                </div>
                <div class="card-body">
                    <div id='calendar' style="width: 800px;height:800px;box-shadow: 3px 3px 3px 3px #ccd0d6;padding:10px"></div>
                    <div class="modal fade" id="schedule-edit">
                        <form role="form" method="post" action="{{ url('admin/maintenance/update') }}">
                        {{ csrf_field() }}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Maintenance Schedule</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <input type="text" name="id" id="id" value="" style="display: none"/>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form></form>
                                            <div class="form-group">
                                                <label>Line Number:</label>
                                                <input type="text" class="form-control" name="line_number" id="line_number" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Event:</label>
                                                <input type="text" class="form-control" name="desc" id="event" required="required">
                                            </div>
                                            <div class="form-group">
                                                <label>Status:</label>
                                                <select class="form-control" name="status" id="status" required="required">
                                                    <option value="">Select Status</option>
                                                    <option value="open">Open</option>
                                                    <option value="on_progress">On Progress</option>
                                                    <option value="done">Done</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
    <script src="{{url('sites/fullcalendar/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('sites/fullcalendar/js/popper.min.js')}}"></script>
    <script src="{{url('sites/fullcalendar/js/bootstrap.min.js')}}"></script>

    <script src="{{url('sites/fullcalendar/packages/core/main.js')}}"></script>
    <script src="{{url('sites/fullcalendar/packages/interaction/main.js')}}"></script>
    <script src="{{url('sites/fullcalendar/packages/daygrid/main.js')}}"></script>
    <script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
    <script>
      var data = @json($data['content']);
      document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            plugins: [ 'interaction', 'dayGrid' ],
            defaultDate: '2022-10-12',
            timeZone: 'America/New_York',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: data,
            eventMouseEnter: function(info) {
            var tis=info.el;
            var title=info.event._def.title;
            var event=info.event._def.extendedProps.tooltip;
            var desc=info.event.extendedProps.tooltip;
            var tooltip = '<div class="tooltipevent" style="top:'+($(tis).offset().top-5)+'px;left:'+($(tis).offset().left+($(tis).width())/2)+'px"><div>' + title + ' ' + event +'</div></div>';
            var $tooltip = $(tooltip).appendTo('body');

//            If you want to move the tooltip on mouse movement then you can uncomment it
//            $(tis).mouseover(function(e) {
//                $(tis).css('z-index', 10000);
//                $tooltip.fadeIn('500');
//                $tooltip.fadeTo('10', 1.9);
//            }).mousemove(function(e) {
//                $tooltip.css('top', e.pageY + 10);
//                $tooltip.css('left', e.pageX + 20);
//            });
            },
            eventMouseLeave: function(info) {
                console.log('eventMouseLeave');
                $(info.el).css('z-index', 8);
                $('.tooltipevent').remove();
            },
            eventClick: function(info) {
                console.log(info.event._def)
                var id=info.event.id;
                var line_number=info.event._def.title;
                var status=info.event._def.extendedProps.status;
                var event=info.event._def.extendedProps.tooltip;
                console.log(info.event)

                $("#schedule-edit #id").val( id );
                $("#schedule-edit #line_number").val( line_number );
                $("#schedule-edit #event").val( event );
                $("#schedule-edit #status").val( status ).change();
                var modal = $("#schedule-edit");
                modal.modal();
            }
            });

            calendar.render();
        });

    </script>
<script src="{{url('sites/fullcalendar/js/main.js')}}"></script>
</body>
</html>
