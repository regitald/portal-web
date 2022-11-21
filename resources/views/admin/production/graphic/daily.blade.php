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
                <div class="bg-primary text-center">GRAPHIC LINE BY DATE - INJECTION</div>
            </div>
            <div class="col-12">
                <div id="chartACH"></div>
            </div>
            <div class="col-12">
                <div class="bg-primary text-center">GRAPHIC LINE BY MACJINE - INJECTION</div>
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
                    enabledOnSeries: [1]
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
                
            $(document).ready(function() {
                var a = @json($yearly_query);
                console.log(a);
                
               
                b = [];
                b1 = [];
                
                for (let is = 0; is < a.length; is++) {
                  ctot = a[is].total;
                  d = a[is].xa;
                  cng = a[is].ng;
                  dasli = d;
                  
                  cper = parseFloat(ctot)/(parseFloat(ctot) + parseFloat(cng)) *100;
                  c = parseFloat(cper).toFixed(2);
                  f = {"x" : dasli, "y" :c};
                  f1 = {"x" : dasli, "y" : 100}
                    console.log(c);
                    console.log(d);
                  b.push(f);
                  b1.push(f1);
                 
                  
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
                
                
            });
var optionsACH2 = {
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
                    enabledOnSeries: [1]
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

                var chartACH2 = new ApexCharts(
                document.querySelector("#chartACH2"),
                optionsACH2
                );

                chartACH2.render();
                
            $(document).ready(function() {
                var aach2 = @json($machine_query);
                console.log(aach2);
                
               
                bach2 = [];
                bach21 = [];
                
                for (let isach2 = 0; isach2 < aach2.length; isach2++) {
                  ctotach2 = aach2[isach2].total;
                  dach2 = aach2[isach2].xa;
                  cngach2 = aach2[isach2].ng;
                  dasliach2 = dach2;
                  
                  cperach2 = parseFloat(ctotach2)/(parseFloat(ctotach2) + parseFloat(cngach2)) *100;
                  cach2 = parseFloat(cperach2).toFixed(2);
                  fach2 = {"x" : dasliach2, "y" :cach2};
                  f1ach2 = {"x" : dasliach2, "y" : 100}
                    
                  bach2.push(fach2);
                  bach21.push(f1ach2);
                 
                  
                }
                
                chartACH2.updateSeries([{
                    name: 'Achievement',
                    data: bach2,
                    type: 'column'
                },{
                    name: 'Target',
                    data: bach21,
                    type: 'line'
                }])

                chartACH2.updateOptions({
                tooltip: {
                        custom: function({series, seriesIndex, dataPointIndex, w}){

                            
                            var elementach2 = '<div class="card-header text-center p-1 m-1">Detail Data on&nbsp'+w.config.series[0].data[dataPointIndex].x+' </div>';
                            elementach2 += '<div class="card-body">'
                            
                            
                                elementach2 += '<div> Actual Production =&nbsp' + (parseInt(aach2[dataPointIndex].total) + parseInt(aach2[dataPointIndex].ng)) +' Pcs</div>';
                                elementach2 += '<div> Good Product =&nbsp' + aach2[dataPointIndex].total +' Pcs</div>';
                                elementach2 += '<div> NG Product =&nbsp' + aach2[dataPointIndex].ng +' Pcs</div>';
                                             
                            
                            elementach2 += '</div">'  
                            return elementach2+'</div>';
                             
                        }}
                    })
                
                
            });


</script>

@endsection


