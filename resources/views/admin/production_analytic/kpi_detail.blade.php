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
                {{-- End Card Col-3 --}}
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

    </script>


@endsection
