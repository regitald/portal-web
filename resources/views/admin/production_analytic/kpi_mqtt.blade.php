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
            <div class="row">
                @foreach ($listmachine as $item)
                   <div class="col-xl-2 col-lg-3 col-md-6 col-12 col-sm-12">
                        <div id="card_{{$item->name}}" class="card rounded-0" style="background-color: rgb(80, 80, 80)">
                            <div class="card-header pl-2 py-2 pr-2" style="background-color: rgba(228, 228, 228, 0.3);">
                               <div class="row">
                                    <div class="col-6 pl-2 py-1" style="font-size: 18px"><i class="far fa-square" style="color:rgb(255, 255, 255)"> </i> <b> &nbsp;{{$item->name}}</b> </div>
                                    <div class="col-6" align="right" ><a class="btn p-1" href="kpi-dashboard/detail/{{$item->id}}" role="button" style="width: 90%;background-color: rgba(228, 228, 228, 0.5);">Show Detail</a></div>
                               </div>
                            </div>
                            <div class="card-body p-0 m-0">
                                <div class="row p-0 m-0">
                                    <div class="col-12 text-center">
                                        <center>
                                            <div id="chart_{{$item->name}}" style="max-width: 400px"></div>
                                        </center>
                                            
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <h5>Part Number : </h5>
                                            <div id="part_no_{{$item->name}}" style="height: 60px"> No Data</div>
                                        </div>
                                    </div>
                                    <div class="col-4 p-0 m-0">
                                        <div class="card rounded-0 p-0 m-0" style="background-color: rgba(228, 228, 228, 0.3);">
                                            <div class="card-header p-1 text-center">
                                                AVA
                                            </div>
                                            <div class="card-body text-center p-2">
                                                <div id="ava_num_{{$item->name}}">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-4 p-0 m-0" >
                                        <div class="card rounded-0 p-0 m-0" style="background-color: rgba(228, 228, 228, 0.3);">
                                            <div class="card-header p-1 text-center">
                                                PERF
                                            </div>
                                            <div class="card-body text-center p-2">
                                                <div id="perf_num_{{$item->name}}">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 p-0 m-0">
                                        <div class="card rounded-0 p-0 m-0" style="background-color: rgba(228, 228, 228, 0.3);">
                                            <div class="card-header p-1 text-center">
                                                QUA
                                            </div>
                                            <div class="card-body text-center p-2">
                                                <div id="qua_num_{{$item->name}}">0</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 p-0 m-0">
                                        <div class="card  rounded-0 p-0 m-0">
                                            <div class="card-header p-1 text-center" >
                                               <b>Total Running Time </b> 
                                            </div>
                                            <div class="card-body text-center p-2">
                                                <div id="run_num_{{$item->name}}">0</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                   
                @endforeach
                @foreach ($listmachine as $item1)
                    <script>
                    var optionsCircle{{$item1->id}} = {
                        chart: {
                            type: "radialBar",
                            height: 250,
                            offsetX: 0
                        },
                        plotOptions: {
                            radialBar: {
                            inverseOrder: false,
                            hollow: {
                                margin: 5,
                                size: "70%",
                                background: "transparent"
                            },
                            track: {
                                show: true,
                                background: "#ffffff",
                                opacity: 0.9,
                                strokeWidth: "100%",
                                opacity: 0.6,
                                margin: 3 // margin is in pixels
                            },
                            dataLabels: {
                                    show: true,
                                    name: {
                                        offsetY: -20,
                                        show: true,
                                        color: '#e8eaed',
                                        fontSize: '12px'
                                    },
                                    value: {
                                        formatter: function(val) {
                                        return parseFloat(val).toFixed(1) + '%';
                                        },
                                        offsetY: 5,
                                        color: 'white',
                                        fontSize: '36px',
                                        show: true,
                                        }
                                },  
                            }
                        },
                        series: [0],
                        labels: ["OEE"],
                        legend: {
                            show: false,
                            position: "left",
                            
                        },
                        fill: {
                             colors: '#48494a'
                        }
                        };
                        
                        var chartCircle{{$item1->id}} = new ApexCharts(
                        document.querySelector("#chart_{{$item1->name}}"),
                        optionsCircle{{$item1->id}}
                        );

                        chartCircle{{$item1->id}}.render();
                        
                        /// MQTT 
                        client{{$item1->id}} = new Paho.MQTT.Client('10.14.189.133', Number('9001'), "clientId{{$item1->name}}{{Str::random(9)}}");

                         // set callback handlers
                                client{{$item1->id}}.onConnectionLost = onConnectionLost{{$item1->id}};
                                client{{$item1->id}}.onMessageArrived = onMessageArrived{{$item1->id}};

                                // connect the client
                                client{{$item1->id}}.connect({onSuccess:onConnect{{$item1->id}}});


                                // called when the client connects
                                function onConnect{{$item1->id}}() {
                                // Once a connection has been made, make a subscription and send a message.
                                console.log("onConnect");
                                client{{$item1->id}}.subscribe("{{$item1->type}}/{{$item1->name}}/realtime");
                                
                                }
                                // called when the client loses its connection
                                function onConnectionLost{{$item1->id}}(responseObject) {
                                if (responseObject.errorCode !== 0) {
                                    console.log("onConnectionLost:"+responseObject.errorMessage);
                                }
                                }
                        ///end MQTT
                        
                        // window.setInterval(function () {
                            
                        //     }, 3000);
                        function onMessageArrived{{$item1->id}}(message) {
                                    a = JSON.parse(message.payloadString);
                                    var ava = parseFloat(a.d.ava[0]).toFixed(2);
                                    var perf = parseFloat(a.d.perf[0]).toFixed(2);
                                    var qua = parseFloat(a.d.qua[0]).toFixed(2);
                                    var part_l = a.d.ok_lh[0];
                                    var part_r = a.d.ok_rh[0];
                                    var part_m = a.d.ok_mid[0];
                                    var run = a.d.run[0];
                                    var pd = a.d.pd[0];
                                    var dt= a.d.dt[0];

                                    if (run ==  true){
                                        document.getElementById("card_{{$item1->name}}").style.backgroundColor = "rgb(0, 173, 0)";
                                    }
                                    if (pd == true){
                                        document.getElementById("card_{{$item1->name}}").style.backgroundColor = "rgb(255, 255, 0)";
                                    }
                                    if (dt == true){
                                        document.getElementById("card_{{$item1->name}}").style.backgroundColor = "rgb(255, 0, 0)";
                                    }
                                    if(run == false && pd == false && dt == false){
                                        document.getElementById("card_{{$item1->name}}").style.backgroundColor = "rgb(80, 80, 80)";
                                    }
                                    var c;
                                    if (part_l > 0 && part_r > 0){
                                        c = "LH :"+ a.d.part_name_lh[0] +"<br>  RH :"+ a.d.part_name_lh[0]+"";
                                        
                                    } else if (part_l > 0 && part_r == 0){
                                        c ="LH :"+a.d.part_name_lh[0];
                                        
                                    } else if (part_l == 0 && part_r > 0){
                                        c = "RH :"+a.d.part_name_rh[0];
                                        
                                    } else if (part_m > 0) {
                                        c = "MID :" +a.d.part_name_mid[0];
                                       
                                    } else{
                                        c = "no data";
                                        
                                    }
                                    jQuery('#ava_num_{{$item1->name}}').html(ava +"%");
                                    jQuery('#perf_num_{{$item1->name}}').html(perf +"%");
                                    jQuery('#qua_num_{{$item1->name}}').html(qua +"%");
                                    jQuery('#part_no_{{$item1->name}}').html(c);
                                    chartCircle{{$item1->id}}.updateSeries([
                                        a.d.oee[0]
                                    ]);
                                    
                                    console.log(a);
                                    
                                    
                                   

                                    }

                   </script>
                @endforeach


            </div>
        </div>
        
    
   
    {{-- END OF CONTENT --}}
    </div>


@endsection
