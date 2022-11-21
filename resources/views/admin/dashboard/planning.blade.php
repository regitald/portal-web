@extends('admin.template.main')
@section('content')
<style>
#container{
    max-width: 100%;
}
#button-container {
    max-width: 800px;
    margin: 1em auto;
}

#pdf {
    border: 1px solid silver;
    border-radius: 3px;
    background: #a4edba;
    padding: 0.5em 1em;
}

#pdf i {
    margin-right: 1em;
}

</style>
{{-- <script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="https://code.highcharts.com/gantt/modules/accessibility.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
        @if($errors->any())
            <div class="alert alert-danger">
            {{$errors->first()}}
            </div>
        @endif
        @if (Session::has('success'))
          <div class="alert alert-success">
            {{Session::get('success')}}
            </div>
        @endif
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TimeChart Manufacturing Order</h3>
              </div>
              <div class="card-body">
                <div id="chart" style="height: 80vh"></div>

              </div>
              <!-- /.card-body -->
            </div>
             <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Prodution Date</th>
                    <th>No MO</th>
                    <th>Line Number</th>
                    <th>Part Name</th>
                    <th>Part Category</th>
                    <th>Cycle Time</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach($data as $key)
                <tr>
                    <td>{{$key['id']}}</td>
                    <td>{{$key['production_date']}}</td>
                    <td>{{$key['no_mo']}}</td>
                    <td>{{$key['line_number']}}</td>
                    <td>{{$key['part_name']}}</td>
                    <td>{{$key['part_category']}}</td>
                    <td>{{$key['cycle_time']}}</td>
                    <td>{{$key['status']}}</td>
                </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Prodution Date</th>
                    <th>No MO</th>
                    <th>Line Number</th>
                    <th>Part Name</th>
                    <th>Part Category</th>
                    <th>Cycle Time</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
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
  <script>



  </script>
  <script>
      var options = {
          series: [],
          columnWidth: '700',
          zoom: {
            enabled: true,
            type: 'x'
          },
          
          
          chart: {
          height: 600,
          type: 'rangeBar'
        },
        dataLabels: {
          enabled: true,
          formatter: function (val, opt) {
            console.log(opt.w.globals);
            return opt.w.globals.seriesNames[opt.dataPointIndex]
          }
        },
        plotOptions: {
          bar: {
            horizontal: true,
            columnWidth: '700',
            barHeight: '70'
          }
        },
        xaxis: {
          type: 'datetime',
          min: new Date(new Date().toLocaleDateString()).getTime() + (3600*14.5*1000),
          max: new Date(new Date().toLocaleDateString()).getTime() + (3600*38.5*1000)
          
        }
        };
        
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        var fr = new Date();
        var fro = new Date(fr.getTime() - ((3600*24*1000)*10) + (5*60*1000));
        var from = fro.toISOString().split('T')[0]
        var offset = 5;
        var t= new Date(fr.getTime() + (offset*60*1000) + ((3600*24*1000)*2))
        var to = t.toISOString().split('T')[0]
        console.log(new Date().toLocaleDateString());
        var url = 'http://103.214.112.156:3000/api/planning/:period/graphic?production_date_from='+from+'&production_date_to='+to+'';

            axios({
              method: 'GET',
              url: url,
              }).then(function(response) {
                  var a = response.data.content;
                  var b =[] ;
                  for (let i= 0; i < a.length; i++) {
                    var a1 = a[i].line_number;
                    var a2 = a[i].data;
                    for (let i1 =0; i1 < a2.length; i1++) {
                      var b1 = a2[i1].start_production;
                      var b2 = a2[i1].finish_production;
                      var b3 = a2[i1].production_date.split('T')[0];
                      var b4 = a2[i1].no_mo;
                      var y1 = [];
                      var bb1 = new Date(''+b3+' '+b1+':00').getTime()+ (3600*31*1000);
                      var bb2 = new Date(''+b3+' '+b1+':00').getTime()+ (3600*39*1000);
                      y1.push(bb1);
                      y1.push(bb2);
                      var y2 = [];
                      var y3 = {'x' : a1, 'y' : y1};
                      y2.push(y3)
                      
                      var y4 = {'name' :  b4  , 'data' : y2}
                      b.push(y4); 
                      }

                  }
                  console.log(a);
                  chart.updateSeries(b)
              })
  </script>
@endsection

