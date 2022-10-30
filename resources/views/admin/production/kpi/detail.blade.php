@extends('admin.template.main')
@section('content')
<style>
    #container {
        min-width: 310px;
        height: 400px;
        max-width: 600px;
        margin: 0 auto;
    }
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
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
          <div class="col-10">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{$title}}</h1><br>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div id="ava" style="width: 900px;"></div>
                        <div id="perf"></div>
                        <div id="qua"></div>
                        <div id="oee"></div>
                        <div id="acv"></div>

                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->
          </div>
          <div class="col-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Filter</h1><br>
                </div>
                <div class="card-body">
                </div>
                <!-- /.card -->
            </div>
          </div>

          <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Grafik</h1><br>
                </div>
                <div class="card-body">
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
<script>
    const ava = 75;
    const perf = 50;
    const qua = 95;
    // Highcharts.chart('ava', {
    //     colors: ['#9E9BA1', '#85B6FF'],
    //     chart: { type: 'pie' },exporting: { enabled: false },credits: { enabled: false },legend:{ enabled:false },
    //     title: { text: ava + '%', verticalAlign: 'middle'},
    //     plotOptions: {pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: false } }},
    //     series: [{
    //         type: 'pie',
    //         name: 'AVA',
    //         innerSize: '70%',
    //         data: [100-ava,100]
    //     }]
    // });

    const data = [
        {
            "name": "AVA",
            "innerSize": '70%',
            "data": [100-ava,100],
        },
        {
            "name": "PERF",
            "innerSize": '70%',
            "data": [100-perf,100],
        },
        {
            "name": "QUA",
            "innerSize": '70%',
            "data": [100-qua,100],
        },
        {
            "name": "OEE",
            "innerSize": '70%',
            "data": [100-qua,100],
        },
        {
            "name": "ACV",
            "innerSize": '70%',
            "data": [100-qua,100],
        }
    ]

        const mainContainer = document.getElementById('ava');

        data.forEach(function(dataEl) {
        const createdDiv = document.createElement('div');
        createdDiv.style.display = 'inline-block';
        createdDiv.style.width = '10%'

        mainContainer.appendChild(createdDiv);

        Highcharts.chart(createdDiv, {
            colors: ['#9E9BA1', '#85B6FF'],
            chart: { type: 'pie' },exporting: { enabled: false },credits: { enabled: false },legend:{ enabled:false },
            title: { text: ava + '%', verticalAlign: 'middle'},
            plotOptions: {pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: false } }},
            series: [dataEl]
        });
        });

</script>
@endsection

