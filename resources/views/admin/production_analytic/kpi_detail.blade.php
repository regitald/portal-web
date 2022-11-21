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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <div class="row p-0 m-0">
                {{-- Start Card col-4 --}}
                <div class="col-4 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0">
                        <div class="card-body text-center bg-primary py-2">
                            <b class=""><h3>{{$lm->type}}/{{$lm->name}}</h3></b>
                        </div>
                    </div>
                </div>
                {{-- End Card Col-4 --}}
                {{-- Start Card col-4 --}}
                <div class="col-4 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0">
                        <div class="card-body text-center bg-primary py-2">
                            <b class=""><h3>{{$lm->type}}/{{$lm->name}}</h3></b>
                        </div>
                    </div>
                </div>
                {{-- End Card Col-4 --}}
                {{-- Start Card col-4 --}}
                <div class="col-4 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0">
                        <div class="card-body text-center bg-primary py-2">
                            <b class=""><h3 id="time"></h3></b>
                        </div>
                    </div>
                </div>
                {{-- End Card Col-4 --}}
                {{-- Start Card col-3 --}}
                <div class="col-3 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0 bg-transparent">
                        <div class="card-header text-center bg-transparent">
                            <h5><b class="">Availability</b></h5>
                        </div>
                        <div class="card-body text-center bg-transparent py-2">
                            <b id="ava_num" style="font-size: 70px">0.0 %</b>

                        </div>
                    </div>
                </div>
                {{-- End Card Col-3 --}}
                
                {{-- Start Card col-3 --}}
                <div class="col-3 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0 bg-transparent">
                        <div class="card-header text-center bg-transparent">
                            <h5><b class="">Performance</b></h5>
                        </div>
                        <div class="card-body text-center bg-transparent py-2">
                            <b id="perf_num" style="font-size: 70px">0.0 %</b>

                        </div>
                    </div>
                </div>
                {{-- End Card Col-3 --}}
                {{-- Start Card col-3 --}}
                <div class="col-3 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0 bg-transparent">
                        <div class="card-header text-center bg-transparent">
                            <h5><b class="">Quality</b></h5>
                        </div>
                        <div class="card-body text-center bg-transparent py-2">
                            <b id="qua_num" style="font-size: 70px">0.0 %</b>

                        </div>
                    </div>
                </div>
                {{-- End Card Col-3 --}}
                {{-- Start Card col-3 --}}
                <div class="col-3 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0 bg-transparent">
                        <div class="card-header text-center bg-transparent">
                            <h5><b class="">OEE</b></h5>
                        </div>
                        <div class="card-body text-center bg-transparent py-2">
                            <b id="oee_num" style="font-size: 70px">0.0 %</b>

                        </div>
                    </div>
                </div>
                {{-- End Card Col-12-6 --}}
                <div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0 bg-transparent">
                        <div class="card-header text-center bg-transparent">
                            <h5><b class="">NG Paretto</b></h5>
                        </div>
                        <div class="card-body text-center bg-transparent py-2">
                            <div id="chart" width = "80%"></div>
                        </div>
                    </div>
                </div>
                {{-- End Card Col-12-6 --}}
                {{-- End Card Col-12-6 --}}
                <div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12 p-0 m-0">
                    <div class="card border-1 rounded-0 p-0 m-0 bg-transparent">
                        <div class="card-header text-center bg-transparent">
                            <h5><b class="">Achievement</b></h5>
                        </div>
                        <div class="card-body text-center bg-transparent py-2">
                            <div id="chartACH" width = "80%"></div>
                        </div>
                    </div>
                </div>
                {{-- End Card Col-12-6 --}}

            </div>
        </div>
        
    
   
    {{-- END OF CONTENT --}}
    </div>

    <script>
       setInterval(() => {
         var waktu = new Date().toString();
         var indo_t = waktu.split("GMT")[0];
         
         document.getElementById("time").innerHTML = indo_t; 
       }, 1000); 

        /// MQTT 
        client = new Paho.MQTT.Client('10.14.189.133', Number('9001'), "clientId{{Str::random(9)}}");
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;
        client.connect({onSuccess:onConnect});
        function onConnect() {
            console.log("onConnect");
            client.subscribe("{{$lm->type}}/{{$lm->name}}/realtime");                              
            }
                                // called when the client loses its connection
        function onConnectionLost(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("onConnectionLost:"+responseObject.errorMessage);
                }
             }
        function onMessageArrived(message) {
            a = JSON.parse(message.payloadString);

            var ava = parseFloat(a.d.ava[0]).toFixed(2);
            var perf = parseFloat(a.d.perf[0]).toFixed(2);
            var qua = parseFloat(a.d.qua[0]).toFixed(2);
            var oee = parseFloat(a.d.oee[0]).toFixed(2);

            jQuery('#ava_num').html(ava +"%");
            jQuery('#perf_num').html(perf +"%");
            jQuery('#qua_num').html(qua +"%");
            jQuery('#oee_num').html(oee +"%");
            
         
        }

        /// MQTT 
        clientparetto = new Paho.MQTT.Client('10.14.189.133', Number('9001'), "clientId{{Str::random(9)}}");
        clientparetto.onConnectionLost = onConnectionLostparetto ;
        clientparetto.onMessageArrived = onMessageArrivedparetto ;
        clientparetto.connect({onSuccess :onConnectparetto });
        function onConnectparetto () {
            console.log("onConnectparetto ");
            clientparetto.subscribe("{{$lm->type}}/{{$lm->name}}/NG/PARETTO");                              
            }
                                // called when the client loses its connection
        function onConnectionLostparetto(responseObject) {
            if (responseObject.errorCode !== 0) {
                console.log("onConnectionLost:"+responseObject.errorMessage);
                }
             }
        function onMessageArrivedparetto(message) {
            a = JSON.parse(message.payloadString);
        }
            
        
                 var options = {
                    series: [],
                    chart: {
                    height: 350,
                    type: 'line',
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
                        text: 'Qty(pcs)',
                    },
                    
                    }, {
                    opposite: true,
                    title: {
                        text: 'Percentage'
                    }
                    }]
                    };

                var chart = new ApexCharts(
                document.querySelector("#chart"),
                options
                );

                chart.render();

         

            function onMessageArrivedparetto(message) {
                a = JSON.parse(message.payloadString);
                b = [];
                b1 = [];
                var total = 0
                for (let i = 0; i < a.length; i++) {
                  total  += a[i][0];
                }
                var t = total;
                for (let i = 0; i < a.length; i++) {
                  c = a[i][0];
                  d = a[i][1];
                //   console.log(i);
                  var totalloop = 0;
                  for (let loop = i; loop >= 0; loop--) {
                    totalloop  += a[loop][0];
                    
                    }
                  cur = totalloop;
                  p1 = (cur/t) * 100; 
                  p2 = parseFloat(p1).toFixed(1);
                  e = d.replace(/\0[\s\S]*$/g,'');
                  f = {"x" : e, "y" :c}
                  g = {"x" : e, "y" :p2}
                  b.push(f);
                  b1.push(g);
                  console.log(totalloop)
                }
                
                chart.updateSeries([{
                    name: 'NG QTY',
                    data: b,
                    type: 'column'
                },{
                    name: 'NG Paretto',
                    data: b1,
                    type: 'line'
                }])
                
                
            }
            
            clientach = new Paho.MQTT.Client('10.14.189.133', Number('9001'), "clientId{{Str::random(9)}}");
            clientach.onConnectionLost = onConnectionLostach ;
            clientach.onMessageArrived = onMessageArrivedach ;
            clientach.connect({onSuccess :onConnectach });
            function onConnectach () {
                console.log("onConnectach ");
                clientach.subscribe("{{$lm->type}}/{{$lm->name}}/NG/ACHIEVEMENT");                              
                }
                                    // called when the client loses its connection
            function onConnectionLostach(responseObject) {
                if (responseObject.errorCode !== 0) {
                    console.log("onConnectionLost:"+responseObject.errorMessage);
                    }
                }
            function onMessageArrivedach(message) {
                a = JSON.parse(message.payloadString);
            }

            var optionsACH = {
                    series: [],
                    chart: {
                    height: 350,
                    type: 'line',
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
                        text: 'Qty(pcs)',
                    },
                    
                    }, {
                    opposite: true,
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
                function onMessageArrivedach(message) {
                a = JSON.parse(message.payloadString);
                b = [];
                b1 = [];
                
                for (let is = 0; is < a.length; is++) {
                  c = a[is][0].total;
                  d = a[is][0].intervals;
                  c1 = a[is][0].target;
                  f = {"x" : d, "y" :c};
                  f1 = {"x" : d, "y" :c1}
                    console.log(c);
                    console.log(d);
                  b.push(f);
                  b1.push(f1);
                 
                  
                }
                console.log(a[0][0].intervals);
                chartACH.updateSeries([{
                    name: 'Achievement',
                    data: b,
                    type: 'column'
                },{
                    name: 'Target',
                    data: b1,
                    type: 'column'
                }])
                
                
            }

    </script>


@endsection
