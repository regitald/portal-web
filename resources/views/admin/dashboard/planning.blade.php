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
<script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="https://code.highcharts.com/gantt/modules/accessibility.js"></script>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">TimeChart Manufacturing Order</h3>
              </div>
              <div class="card-body">
                <div id="container"></div>
                <div id="button-container">
                    <button id="pdf">
                        <i class="fa fa-download"></i> Download PDF
                    </button>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
          @endif
            <div class="card">
              <div class="card-header">
                <h1 class="card-title">Planning MO</h1><br>
              </div>
              <!-- /.card-header -->
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
                    <th>Action</th>
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
                    <td>{{ucwords(str_replace('_', ' ', $key['status']))}}</td>
                    <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Update Status
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="planning-daily/status/OPEN/{{$key['id']}}" value ="OPEN">Open</a>
                            <a class="dropdown-item" href="planning-daily/status/ON_PROGRESS/{{$key['id']}}" value ="ON_PROGRESS">On Progress</a>
                            <a class="dropdown-item" href="planning-daily/status/CLOSED/{{$key['id']}}" value ="CLOSED">Closed</a>
                        </div>
                    </div>
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
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

const date = new Date();

let day = date.getDate();
let month = date.getMonth()+1;
let year = date.getFullYear();
let lastday = new Date(year, month, 0).getDate();
let currentDate = `${year}-0${month}-01`;
let endDate = `${year}-0${month}-${lastday}`;

let url = `http://103.214.112.156:3000/api/planning/daily/graphic?production_date_from=${currentDate}&production_date_to=${endDate}`;
const machine = fetch(url)
  .then((response) => response.json())
  .then((grafik) => {
    return grafik;
  });

const getData = async () => {
  const data = await machine;
  console.log(data.content);
};

getData();

Highcharts.ganttChart('container', {
    title: {
        text: 'Manufacturing Order Timechart'
    },

    yAxis: {
        uniqueNames: true
    },


    lang: {
        accessibility: {
            axis: {
                xAxisDescriptionPlural: 'The chart has a two-part X axis showing time in both week numbers and days.'
            }
        }
    },

    series: [{
        name: 'Project 1',
        data: [{
            start: Date.UTC(2020, 09, 03, 21),
            end: Date.UTC(2020, 09, 04, 7, 00),
            name: 'INJECTION/MC06 N',
            color: '#000'
        }, {
            start: Date.UTC(2020, 09, 04, 21),
            end: Date.UTC(2020, 09, 05, 7, 00),
            name: 'INJECTION/MC07 N',
            color: '#000'
        }, {
            start: Date.UTC(2020, 09, 04, 7),
            end: Date.UTC(2020, 09, 04, 20, 00),
            name: 'INJECTION/MC07 M',
            color: '#3BB873'
        },{
            start: Date.UTC(2020, 09, 04, 21),
            end: Date.UTC(2020, 09, 05, 7, 00),
            name: 'INJECTION/MC07 N',
            color: 'rgb(124, 181, 236)'
        }, {
            start: Date.UTC(2020, 09, 06, 21),
            end: Date.UTC(2020, 09, 07, 7, 00),
            name: 'INJECTION/MC03 N',
            color: '#000'
        }, {
            start: Date.UTC(2020, 09, 07, 21),
            end: Date.UTC(2020, 09, 08, 7, 00),
            name: 'INJECTION/MC03 N',
            color: '#3BB873'
        }]
    }]
    });

    // Activate the custom button
    document.getElementById('pdf').addEventListener('click', function () {
    Highcharts.charts[0].exportChart({
        type: 'application/pdf'
    });
});
    function refresh()
    {
        var div = $('container'),
        divHtml = div.html();
        div.html(divHtml);
    }

    setInterval(function()
    {
        console.log("refreshed")
        refresh()
    }, 6000); //300000 is 5minutes in ms

  </script>
@endsection

