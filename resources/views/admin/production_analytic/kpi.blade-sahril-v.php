<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Job</title>
</head>
<style>
    body{
        font-family: 'Poppins', sans-serif!important;
    }
    .bg-card-nav{
        background-color: #71f5c9;
    }
    .nav-pills .active{
        background-color: #71f5c9!important;
        color: black!important;
        border-bottom: 4px solid black;
    }
    .nav-item a{
        color: black!important;
    }
     .hideung{
        color: white!important;
    }
    .bodas{
        color: white!important;
    }
    .f-small{
        font-size: 12px!important;
    }
    .hejo{
        background-color: #45B140!important;
    }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.0/apexcharts.min.js">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 pb-1 col-lg-12 bg-card-nav" style="color:white!important">
            <ul class="nav pt-1 nav-pills justify-content-start">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" >Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=work_add">Add Data</a>
                </li>

            </ul>

        </div>
    </div>
</div>

<body>
    <div class="container-fluid">
        <div class="row pt-4 no-gutters">
            <div class="col-12 col-md-12 col-lg-2 col-xl-2">

                    <div class="card py-0">
                        <div class="card-header" style="background-color: #84cf9d">
                            <div class="row ">
                                <div class="col-6 text-start">
                                    <i class="fas fa-th-large"></i> <b>MC-03</b>
                                </div>
                                <div class="col-6 text-start">
                                    Status : Running
                                </div>

                            </div>
                        </div>
                        <div class="card-body hejo px-0 py-0">
                            <div class="row pt-2">
                                <div class="col-6 f-small text-end px-1" style="color: white">
                                    Prod Id :
                                </div>
                                <div class="col-6 f-small px-0" style="color: white">
                                    A000003
                                </div>
                                <div class="col-12" align="center">
                                    <div id="chartoee" style="width:85%"></div>
                                </div>
                                <div class="col-3 f-small text-end px-1" style="color: white">
                                    Runtime :
                                </div>
                                <div class="col-3 f-small px-0" style="color: white">
                                    10h 2m 3s
                                </div>
                                <div class="col-3 f-small text-end px-1" style="color: white">
                                     Downtime:
                                </div>
                                <div class="col-3 f-small px-0" style="color: white">
                                    1h 2m 3s
                                </div>

                            </div>
                        </div>

                        <div class="card-footer no-gutters px-0 py-0" style="height: 135px; background-color: #84cf9d; margin-bottom: -0px" >
                            <div id="chartbar" style="width:100%"></div>
                        </div>
                        <div class="card-footer px-0 py-0 bg-success text-white text-center">
                            Hourly Rate
                        </div>
                    </div>
            </div>
        </div>
    </div>
</body>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.0/apexcharts.min.js"></script>
     <script>
        //
        var optionsoee = {
            series: [1,2,3],
            chart: {
                type: 'donut',
                animations: {
                enabled: false
                }
            },
            legend:{
                show: false
            },
            stroke: {
                show: true,
                colors: '#b2cfbb',
                width:1
            },
            dataLabels:{
                enabled: false
            },
            fill: {
              colors: ['#4aff62', '#E91E63', '#bfbfbf']
            },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                         labels: {
                            show: true,
                            name: {
                                show: true,
                            },
                            value: {
                                show: true,
                            },
                         total: {
                            show: true,
                            label: 'Ach (%)',
                            formatter: function getFeed() {
                                var temp = 100;
                                var temp1;
                                var ajaxResp =  $.ajax({
                                url: 'data.php',
                                type: 'GET',
                                async: false,
                                success: function(respone) {
                                }
                                });
                                return ajaxResp.responseJSON[0].x;
                            }
                        }
                    }
                }
            }
            },
            responsive: [{
              breakpoint: 480,
              options: {
                chart: {
                  width: 200
              },
              legend: {
                  enabled: false,
                  show: false
              }
            }
            }]
        };

        var chartoee = new ApexCharts(document.querySelector("#chartoee"), optionsoee);
        chartoee.render();

        function getFeed1() {
          $.ajax({
              url: 'data.php',
              type: 'GET',
              success: function(respone) {
                  var resp = JSON.parse(respone[0].x);
                  var resp1 = JSON.parse(respone[1].x);
                  var resp2 = JSON.parse(respone[0].x);

                  out = [resp,resp1,resp2]
                  chartoee.updateSeries(
                    out
                    )
                  console.log(out)
              }
          });
        }

        $(document).ready(function() {
          setInterval(getFeed1, 1000);
        });

        var optionsbar = {
                series: [],
                chart: {
                    height: 160,
                    padiing:{
                        left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0

                    },
                    type: 'bar',
                    stacked: true,
                    toolbar: {
                        enabled : false,
                        show: false
                        },
                    },
            dataLabels: {
                enabled: false
                },
            title: {
                text: '',
                },

            legend: {
              enabled: false,
              show: false
            },
            grid:{
                show:false,
            },

            noData: {
                text: 'Loading...'
            },
            yaxis:{
                grid:{
                    show: false
                }
            },
            xaxis: {
                grid: {
                    show: false
                },
                type: 'category',
                tickPlacement: 'off',
                range: 10,
                labels: {
                    show: false,
                    enabled: false,
                    rotate: -45,
                    rotateAlways: true
                }
            }
        };

        var chartbar = new ApexCharts(document.querySelector("#chartbar"), optionsbar);
        chartbar.render();


        function getFeed() {
          $.ajax({
              url: 'data.php',
              type: 'GET',
              success: function(respone) {
                  chartbar.updateSeries([{
                  name: 'Sales',
                  data: respone
                },{name: 'Sales',
                  data: respone}])
                  console.log(respone)
                }
            });
        }
        $(document).ready(function() {
            setInterval(getFeed, 1000);
        });

    </script>

</html>
