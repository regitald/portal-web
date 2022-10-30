@extends('admin.template.main')
@section('content')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
    }

    .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
    }

    .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
    }

    .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
    padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
    background: #f1f7ff;
    }
</style>
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
          <div class="col-4">
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
                    <label for="production_date">Production Date Range</label>
                    <div class="row">
                        <div class="col-6">
                            <input name="date_start" type="date" class="form-control" placeholder=".col-3">
                        </div>
                        <div class="col-6">
                            <input name="date_end" type="date"  class="form-control" placeholder=".col-4">
                        </div>
                    </div>
                </div>

                  <div class="form-group">
                    <label for="line_number">Member npk</label>
                    <input type="text" required name="line_number"  class="form-control" id="line_number">
                  </div>

                  <div class="form-group">
                    <label for="no_mo">Machine Name</label>
                    <select class="form-control" name="line_name" required="required">
                        <option value="">Select Part Category</option>
                        <option value="RH">RH</option>
                        <option value="LH">LH</option>
                        <option value="MID">MID</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="part_name">Part Name</label>
                    <input type="text" required name="part_name"  class="form-control" id="part_name">
                  </div>

                  <div class="form-group">
                    <label for="part_category">NG Name</label>
                    <select class="form-control" name="desc" required="required">
                        <option value="">Select Part NG Name</option>
                        <option value="RH">RH</option>
                        <option value="LH">LH</option>
                        <option value="MID">MID</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="part_category">NG Area</label>
                    <select class="form-control" name="desc" required="required">
                        <option value="">Select Part NG Area</option>
                        <option value="RH">RH</option>
                        <option value="LH">LH</option>
                        <option value="MID">MID</option>
                    </select>
                  </div>

                <div class="form-group">
                    <label for="production_date">Time Range</label>
                    <div class="row">
                        <div class="col-6">
                            <input name="time_start" type="time"  class="form-control" placeholder=".col-3">
                        </div>
                        <div class="col-6">
                            <input name="time_end" type="time"  class="form-control" placeholder=".col-4">
                        </div>
                    </div>
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
          <div class="col-8">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h1 class="card-title">{{$title}}</h1><br>
                </div>
                <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                    <div id="customLegend"></div>
                    <div id="customLegendx"></div>
                </figure>
                </div>


                <hr>
                <div class="card-body">

                    <a href="#"  type="button" class="btn btn-primary" style="background-color: #3BB873;border:none">Export Excel</a>
                    <a href="#"  type="button" class="btn btn-danger" style="background-color: red;border:none">Export PDF</a>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/pareto.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>

    var title = <?php echo json_encode($title) ?>;
    var list_ng = <?php echo json_encode($list_ng) ?>;
    var list_machine = <?php echo json_encode($list_machine) ?>;

    var arr = [];
    for (let i = 0; i < list_ng.length; i++) {
        arr.push(list_ng[i]['name']);
    }
    var arr_machine = [];
    for (let i = 0; i < list_machine.length; i++) {
        arr_machine.push(list_machine[i]['name']+'-'+list_machine[i]['type']);
    }

    Highcharts.chart('container', {
        legend: {
            enabled:false
        },
        title: {
            text:  <?php echo json_encode($title) ?>,
            align: 'center'
        },

        xAxis: [{
            categories: arr,
            crosshair: true
        },
        {
            categories: arr_machine,
            crosshair: true,
            visible: false,
        }],
        series: [{
            name: 'Tokyo',
            type : "pareto",
            id: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            id: 'New York',
            type : "pareto",
            data: [2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5],
            visible: false,
        }, {
            name: 'Berlin',
            id: 'Berlin',
            type : "column",
            data: [9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            id: 'London',
            type : "column",
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8],
            visible: false,
        }]
    },function(chart){
        console.log(chart.xAxis)
        var $customLegend = $('#customLegend').append('<select id="customSelect"></select>').find('select'),
                            $option,
                            serie;
        var $customLegendx = $('#customLegendX').append('<select id="select"></select>').find('select'),
            $options,
            x;

        $customLegend.append('<option>Select serie</option>');
        $.each(chart.series, function(i, serie){
            $customLegend.append('<option>' + serie.name + '</option>');
        });

        $customLegendx.append('<option>Select serie</option>');
        $.each(chart.xAxis, function(i, xAxis){
            $customLegendx.append('<option>' + xAxis.categories + '</option>');
        });

        $customLegend.change(function(){
            $option = $(this).val();
            serie = chart.get($option);
            if(!serie.visible) {
                serie.show();
            } else {
                serie.hide();
            }

        })

        $customLegendx.change(function(){
            $options = $(this).val();
            x = chart.get($options);
            if(!x.visible) {
                x.show();
            } else {
                x.hide();
            }

        })
});
</script>
<!-- <script>
    var title = <?php echo json_encode($title) ?>;
    var list_ng = <?php echo json_encode($list_ng) ?>;
    var arr = [];
    for (let i = 0; i < list_ng.length; i++) {
        arr.push(list_ng[i]['name']);
    }
    console.log(arr)
    Highcharts.chart('container', {
    chart: {
        renderTo: 'container',
        type: 'column'
    },
    title: {
        text:  <?php echo json_encode($title) ?>,
        align: 'center'
    },
    xAxis: [{
        categories: arr,
        crosshair: true
    }],
    yAxis: [{ // Primary yAxis
        labels: {
            format: '{value}%',
            style: {
                color: Highcharts.getOptions().colors[2]
            }
        },
        opposite: true

    }, { // Secondary yAxis
        gridLineWidth: 0,
        title: {
            text: '',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        },
        labels: {
            format: '{value} mm',
            style: {
                color: Highcharts.getOptions().colors[0]
            }
        }

    }, { // Tertiary yAxis
        gridLineWidth: 0,
        title: {
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        labels: {
            style: {
                color: Highcharts.getOptions().colors[1]
            }
        },
        opposite: true,
        visible: false
    }],
    tooltip: {
        shared: true
    },
    legend: {
        align: 'center',
        verticalAlign: 'bottom',
        x: 0,
        y: 0,
        floating: true,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || // theme
            'rgba(255,255,255,0.25)'
    },
    series: [{
        name: 'Data 1',
        type: 'pareto',
        yAxis: 1,
        data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]

    }, {
        name: 'Data 2',
        type: 'pareto',
        yAxis: 2,
        data: [3,2,3,10,5,11,7,16,9,10,11,12,13,3,5,16]

    }, {
        name: 'Data 3',
        type: 'pareto',
        data: [16,12,10,4,5,6,7,8,9,10,11,12,13,4,1,2]
    },{
        name: 'X 1',
        type: 'column',
        zIndex: 2,
        data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
    },{
        name: 'X 2',
        type: 'column',
        zIndex: 2,
        data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
    },{
        name: 'X 3',
        type: 'column',
        zIndex: 2,
        data: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
    }],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 800
            },
            chartOptions: {
                legend: {
                    floating: false,
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    x: 0,
                    y: 0
                },
                yAxis: [{
                    labels: {
                        align: 'right',
                        x: 0,
                        y: -6
                    },
                    showLastLabel: false
                }, {
                    labels: {
                        align: 'left',
                        x: 0,
                        y: -6
                    },
                    showLastLabel: false
                }, {
                    visible: false
                }]
            }
        }]
    },function(chart){
    var $customLegend = $('#customLegend').append('<select id="customSelect"></select>').find('select'),
        $option,
        serie;

    $customLegend.append('<option>Select serie</option>');

    $.each(chart.series, function(i, serie){
        $customLegend.append('<option>' + serie.name + '</option>');
    });

    $customLegend.change(function(){

        $option = $(this).val();

        serie = chart.get($option);

        if(serie.visible) {
            serie.hide();
        } else {
            serie.show();
        }
    });
}});

</script> -->
@endsection

