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
    <section class="mr-5 ml-5">
      <div class="row flex">
        <div class="col-sm-2">
          <div class="card">
            <div class="card-header">
              <h6>KPI ALL MACHINE</h6>
            </div>
            <div class="card-body">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC01">
                50%
               </span>
              </div>
              <canvas id="ava" />
            </div>
            </div>
            <div class="card-footer">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC01">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC01">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC01">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >Total Running Time</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC01">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
    </section>
    <!-- /.content -->
  </div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var mock = [
        {
            lineNumber : "INJECTION/MC01",
            oee:90,
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [90,100-90],
                        backgroundColor: ['rgb(0, 255, 0)','#f7f7f7'],
                        offset: 0
                    }]
                },
                options: {
                    cutout: 40
                }
            }
        }]
</script>

<script>
  var charts = []
    for(let m of mock){
        var oee = "oee" + "_" + m.lineNumber
        if(m.oee != undefined){
            document.getElementById(oee).innerHTML = m.oee + "%"
        }else{
            document.getElementById(oee).innerHTML = "0%"
        }
        charts.push(new Chart(
        document.getElementById(m.lineNumber),
        m.config));
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script><script>
    var socket = io("http://103.214.112.156:3000/machines");
    socket.on("kpi",(data)=>{
      console.log(data);
      for(chart of charts){
        var oee = "oee" + "_" + data[chart.id].lineNumber
        var ava = "ava" + "_" + data[chart.id].lineNumber
        var perf = "perf" + "_" + data[chart.id].lineNumber
        var qua = "qua" + "_" + data[chart.id].lineNumber
        var runtime = "runtime" + "_" + data[chart.id].lineNumber

        document.getElementById(oee).innerHTML = data[chart.id].oee + "%"
        document.getElementById(ava).innerHTML = data[chart.id].ava + "%"
        document.getElementById(perf).innerHTML = data[chart.id].perf + "%"
        document.getElementById(qua).innerHTML = data[chart.id].qua + "%"
        document.getElementById(runtime).innerHTML = data[chart.id].runtime + " hour"

        chart.data.datasets.forEach((dataset) => {
           dataset.data = [data[chart.id].oee,100-data[chart.id].oee]
        });
        chart.update()
      }

    })
</script>

@endsection
