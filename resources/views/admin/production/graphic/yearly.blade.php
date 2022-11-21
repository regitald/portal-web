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
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
        <div class="row">
            <div class="col-12">
                <div class="bg-primary text-center">GRAPHIC ACHIEVEMENT LINE INJECTION</div>
            </div>
            <div class="col-12">
                <div id="chartACH"></div>
            </div>
            <div class="col-12">
                <div class="bg-primary text-center">GRAPHIC REJECTION LINE INJECTION</div>
            </div>
            <div class="col-12">
                <div id="chartACH2"></div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
<script>
  

var optionsACH = {
                    series: [],
                    chart: {
                    height: 600,
                    type: 'line',
                     events: {
                    click: function(event, chartContext, config,dataPointIndex) {
                        console.log(chartContext.series.w.config.series[0].data[config.dataPointIndex].x);
                        window.location = 'data/'+chartContext.series.w.config.series[0].data[config.dataPointIndex].x+'';
                    }
                    }
                    },
                    stroke: {
                    width: [0, 4]
                    },
                    title: {
                    text: 'Traffic Sources'
                    },
                    dataLabels: {
                    enabled: true,
                    enabledOnSeries: [0,1]
                    },
                    
                    yaxis: [{
                    title: {
                        text: 'Achievement',
                    },
                    
                    }, {
                    opposite: true,
                    min : 0,
                    max : 100,
                    title: {
                        text: 'Percentage'
                    }
                    }]
                    };

                var chartACH = new ApexCharts(
                document.querySelector("#chartACH"),
                optionsACH
                );

                chartACH.render();

                var optionsACH2 = {
                    series: [],
                    chart: {
                    height: 600,
                    type: 'line',
                     events: {
                    click: function(event, chartContext, config,dataPointIndex) {
                        console.log(chartContext.series.w.config.series[0].data[config.dataPointIndex].x);
                        window.location = 'ng/'+chartContext.series.w.config.series[0].data[config.dataPointIndex].x+'';
                    }
                    }
                    },
                    stroke: {
                    width: [0, 4]
                    },
                    title: {
                    text: 'Traffic Sources'
                    },
                    dataLabels: {
                    enabled: true,
                    enabledOnSeries: [0,1]
                    },
                    
                    yaxis: [{
                      min : 0,
                    max : 10,
                    title: {
                        text: 'Achievement',
                    },
                    
                    }, {
                    opposite: true,
                    min : 0,
                    max : 10,
                    title: {
                        text: 'Percentage'
                    }
                    }]
                    };

                var chartACH2 = new ApexCharts(
                document.querySelector("#chartACH2"),
                optionsACH2
                );

                chartACH2.render();
                
            $(document).ready(function() {
                var a = @json($yearly_query);
                console.log(a);
                
               
                b = [];
                b1 = [];
                bach = [];
                bach1 = [];
                
                for (let is = 0; is < a.length; is++) {
                  ctot = a[is].total;
                  d = a[is].xa;
                  cng = a[is].ng;
                  dasli = d;
                  
                  cper = parseFloat(ctot)/(parseFloat(ctot) + parseFloat(cng)) *100;
                  c = parseFloat(cper).toFixed(2);
                  nper = parseFloat(cng)/(parseFloat(ctot) + parseFloat(cng)) *100
                  nc = parseFloat(nper).toFixed(2);

                  f = {"x" : dasli, "y" :c};
                  fach = {"x" : dasli, "y" :nc};
                  f1 = {"x" : dasli, "y" : 100};
                  fach1 = {"x" : dasli, "y" : 4.5};
                    console.log(c);
                    console.log(d);
                  b.push(f);
                  b1.push(f1);
                  bach.push(fach);
                  bach1.push(fach1);
                 
                  
                }
                
                chartACH.updateSeries([{
                    name: 'Achievement',
                    data: b,
                    type: 'column'
                },{
                    name: 'Target',
                    data: b1,
                    type: 'line'
                }])

                chartACH.updateOptions({
                tooltip: {
                        custom: function({series, seriesIndex, dataPointIndex, w}){

                            
                            var element = '<div class="card-header text-center p-1 m-1">Detail Data on&nbsp'+w.config.series[0].data[dataPointIndex].x+' </div>';
                            element += '<div class="card-body">'
                            
                            
                                element += '<div> Actual Production =&nbsp' + (parseInt(a[dataPointIndex].total) + parseInt(a[dataPointIndex].ng)) +' Pcs</div>';
                                element += '<div> Good Product =&nbsp' + a[dataPointIndex].total +' Pcs</div>';
                                element += '<div> NG Product =&nbsp' + a[dataPointIndex].ng +' Pcs</div>';
                                             
                            
                            element += '</div">'  
                            return element+'</div>';
                             
                        }}
                    })
                    chartACH2.updateSeries([{
                    name: 'REJECTION %',
                    data: bach,
                    type: 'column'
                },{
                    name: 'Target',
                    data: bach1,
                    type: 'line'
                }])

                chartACH2.updateOptions({
                tooltip: {
                        custom: function({series, seriesIndex, dataPointIndex, w}){

                            
                            var element = '<div class="card-header text-center p-1 m-1">Detail Data on&nbsp'+w.config.series[0].data[dataPointIndex].x+' </div>';
                            element += '<div class="card-body">'
                            
                            
                                element += '<div> Actual Production =&nbsp' + (parseInt(a[dataPointIndex].total) + parseInt(a[dataPointIndex].ng)) +' Pcs</div>';
                                element += '<div> Good Product =&nbsp' + a[dataPointIndex].total +' Pcs</div>';
                                element += '<div> NG Product =&nbsp' + a[dataPointIndex].ng +' Pcs</div>';
                                             
                            
                            element += '</div">'  
                            return element+'</div>';
                             
                        }}
                    })
                
                
            });

</script>
@endsection


