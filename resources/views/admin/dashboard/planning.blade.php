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
                <div id="chart"></div>

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
                    <th>Update</th>
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
                    <td>
                    <a class="btn btn-warning" href='{{ url('/admin/planning-daily/edit')}}/{{$key['id'] }}')"><i class="fa fa-edit"></i></a></td>
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
                    <th>Update</th>
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
          chart: {
          height: 350,
          type: 'rangeBar'
        },
        plotOptions: {
          bar: {
            horizontal: true
          }
        },
        xaxis: {
          type: 'datetime'
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
        var fr = new Date();
        var fro = new Date(fr.getTime() - ((3600*24*1000)*15) + (5*60*1000));
        var from = fro.toISOString().split('T')[0]
        var offset = 5;
        var t= new Date(fr.getTime() + (offset*60*1000) + ((3600*24*1000)*15))
        var to = t.toISOString().split('T')[0]
        console.log(from , to);
        var url = 'http://103.214.112.156:3000/api/planning/:period/graphic?production_date_from='+from+'&production_date_to='+to+'';

            axios({
              method: 'GET',
              url: url,
            }).then(function(response) {
                  //// BATAS
                  var json = "remove" ;
                  var json1;
                  var s1;
                  var e1;
                  var p1;
                  var a11;
                  var a = response.data.content[0].data;
                  ////
                  var json2 = "remove" ;
                  var json12;
                  var s12;
                  var e12;
                  var p12;
                  var a112;
                  var a2 = response.data.content[1].data;
                  //// BATAS
                  var json3 = "remove" ;
                  var json13;
                  var s13;
                  var e13;
                  var p13;
                  var a113;
                  var a3 = response.data.content[2].data;
                  //// BATAS
                  var json4 = "remove" ;
                  var json14;
                  var s14;
                  var e14;
                  var p14;
                  var a114;
                  var a4 = response.data.content[3].data;
                  //// BATAS
                  var json5 = "remove" ;
                  var json15;
                  var s15;
                  var e15;
                  var p15;
                  var a115;
                  var a5 = response.data.content[4].data;
                  //// BATAS
                  var json6 = "remove" ;
                  var json16;
                  var s16;
                  var e16;
                  var p16;
                  var a116;
                  var a6 = response.data.content[5].data;
                  //// BATAS
                  var json7 = "remove" ;
                  var json17;
                  var s17;
                  var e17;
                  var p17;
                  var a117;
                  var a7 = response.data.content[6].data;
                  //// BATAS
                  var json8 = "remove" ;
                  var json18;
                  var s18;
                  var e18;
                  var p18;
                  var a118;
                  var a8 = response.data.content[7].data;
                  //// BATAS
                  var json9 = "remove" ;
                  var json19;
                  var s19;
                  var e19;
                  var p19;
                  var a119;
                  var a9 = response.data.content[8].data;
                  //// BATAS
                  var json10 = "remove" ;
                  var json110;
                  var s110;
                  var e110;
                  var p110;
                  var a1110;
                  var a10 = response.data.content[9].data;
                  //// BATAS
                  var json11 = "remove" ;
                  var json111;
                  var s111;
                  var e111;
                  var p111;
                  var a111;
                  var a11 = response.data.content[10].data;


                  // BATAS
                  for (let i = 0; i < a.length; i++) {
                    s1 = String(a[i].start_production);
                    e1 = String(a[i].finish_production);
                    p1 = String(a[i].production_date);
                    var w1 = a[i].status.toUpperCase();
                    console.log(w1)
                    var o1;
                    if (w1 == 'OPEN') {
                          o1 = '#008FFB';
                        }else if(w1 == "ONPROGESS"){
                          o1 = '#00E396';
                        } else {
                          o1 = '#FF4560';
                        }

                    l1 = p1.substring(0, 10)
                    s11 = l1 +' '+ s1;
                    e11 = l1 +' '+ e1.replace('.',':');
                    json += JSON.stringify({
                             'x' : 'INJECTION/MC01',
                             'y' : [new Date (s11).getTime() , new Date(e11).getTime() ],
                             'fillColor': o1
                                 }) + ',';
                    }

                    for (let i = 0; i < a2.length; i++) {
                    s12 = String(a2[i].start_production);
                    e12 = String(a2[i].finish_production);
                    p12 = String(a2[i].production_date);
                    var w12 = a2[i].status.toUpperCase();
                    var o12;
                    if (w12 == 'OPEN') {
                          o12 = '#008FFB';
                        }else if(w12 == "ONPROGESS"){
                          o12 = '#00E396';
                        } else {
                          o12 = '#FF4560';
                        }


                    l12 = p12.substring(0, 10)
                    s112 = l12 +' '+ s12;
                    e112 = l12 +' '+ e12.replace('.',':');
                    json2 += JSON.stringify({
                             'x' : 'INJCETION/MC02',
                             'y' : [new Date (s112).getTime() , new Date(e112).getTime() ],
                             'fillColor': o12
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a3.length; i++) {
                    s13 = String(a3[i].start_production);
                    e13 = String(a3[i].finish_production);
                    p13 = String(a3[i].production_date);
                    var w13 = a3[i].status.toUpperCase();
                    var o13;
                    if (w13 == 'OPEN') {
                          o13 = '#008FFB';
                        }else if(w13 == "ONPROGESS"){
                          o13 = '#00E396';
                        } else {
                          o13 = '#FF4560';
                        }


                    l13 = p13.substring(0, 10)
                    s113 = l13 +' '+ s13;
                    e113 = l13 +' '+ e13.replace('.',':');
                    json3 += JSON.stringify({
                             'x' : 'INJECTION/MC03',
                             'y' : [new Date (s113).getTime() , new Date(e113).getTime() ],
                             'fillColor' : o13
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a4.length; i++) {
                    s14 = String(a4[i].start_production);
                    e14 = String(a4[i].finish_production);
                    p14 = String(a4[i].production_date);
                    var w14 = a4[i].status.toUpperCase();
                    var o14;
                    if (w14 == 'OPEN') {
                          o14 = '#008FFB';
                        }else if(w14 == "ONPROGESS"){
                          o14 = '#00E396';
                        } else {
                          o14 = '#FF4560';
                        }


                    l14 = p14.substring(0, 10)
                    s114 = l14 +' '+ s14;
                    e114 = l14 +' '+ e14.replace('.',':');
                    json4 += JSON.stringify({
                             'x' : 'INJECTION/MC04',
                             'y' : [new Date (s114).getTime() , new Date(e114).getTime() ],
                             'fillColor' : o14
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a5.length; i++) {
                    s15 = String(a5[i].start_production);
                    e15 = String(a5[i].finish_production);
                    p15 = String(a5[i].production_date);
                    var w15 = a5[i].status.toUpperCase();
                    var o15;
                    if (w15 == 'OPEN') {
                          o15 = '#008FFB';
                        }else if(w15 == "ONPROGESS"){
                          o15 = '#00E396';
                        } else {
                          o15 = '#FF4560';
                        }


                    l15 = p15.substring(0, 10)
                    s115 = l15+' '+ s15;
                    e115 = l15 +' '+ e15.replace('.',':');
                    json5 += JSON.stringify({
                             'x' : 'INJECTION/MC05',
                             'y' : [new Date (s115).getTime() , new Date(e115).getTime() ],
                             'fillColor' : o15
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a6.length; i++) {
                    s16 = String(a6[i].start_production);
                    e16 = String(a6[i].finish_production);
                    p16 = String(a6[i].production_date);
                    var w16 = a6[i].status.toUpperCase();
                    var o16;
                    if (w16 == 'OPEN') {
                          o16 = '#008FFB';
                        }else if(w16 == "ONPROGESS"){
                          o16 = '#00E396';
                        } else {
                          o16 = '#FF4560';
                        }

                    l16 = p16.substring(0, 10)
                    s116 = l16 +' '+ s16;
                    e116 = l16 +' '+ e16.replace('.',':');
                    json6 += JSON.stringify({
                             'x' : 'INJECTION/MC06',
                             'y' : [new Date (s116).getTime() , new Date(e116).getTime() ],
                             'fillColor' : o16
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a7.length; i++) {
                    s17 = String(a7[i].start_production);
                    e17 = String(a7[i].finish_production);
                    p17 = String(a7[i].production_date);
                    var w17 = a7[i].status.toUpperCase();
                    var o17;
                    if (w17 == 'OPEN') {
                          o17 = '#008FFB';
                        }else if(w17 == "ONPROGESS"){
                          o17 = '#00E396';
                        } else {
                          o17 = '#FF4560';
                        }

                    l17 = p17.substring(0, 10)
                    s117 = l17 +' '+ s17;
                    e117 = l17 +' '+ e17.replace('.',':');
                    json7 += JSON.stringify({
                             'x' : 'INJECTION/MC07',
                             'y' : [new Date (s117).getTime() , new Date(e117).getTime() ],
                             'fillColor' : o17
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a8.length; i++) {
                    s18 = String(a8[i].start_production);
                    e18 = String(a8[i].finish_production);
                    p18 = String(a8[i].production_date);
                    var w18 = a8[i].status.toUpperCase();
                    var o18;
                    if (w18 == 'OPEN') {
                          o18 = '#008FFB';
                        }else if(w18 == "ONPROGESS"){
                          o18 = '#00E396';
                        } else {
                          o18 = '#FF4560';
                        }

                    l18 = p18.substring(0, 10)
                    s118 = l18 +' '+ s18;
                    e118 = l18 +' '+ e18.replace('.',':');
                    json8 += JSON.stringify({
                             'x' : 'INJECTION/MC08',
                             'y' : [new Date (s118).getTime() , new Date(e118).getTime() ],
                             'fillColor' : o18
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a9.length; i++) {
                    s19 = String(a9[i].start_production);
                    e19 = String(a9[i].finish_production);
                    p19 = String(a9[i].production_date);
                    var w19 = a9[i].status.toUpperCase();
                    var o19;
                    if (w19 == 'OPEN') {
                          o19 = '#008FFB';
                        }else if(w19 == "ONPROGESS"){
                          o19 = '#00E396';
                        } else {
                          o19 = '#FF4560';
                        }

                    l19 = p19.substring(0, 10)
                    s119 = l19 +' '+ s19;
                    e119 = l19 +' '+ e19.replace('.',':');
                    json9 += JSON.stringify({
                             'x' : 'INJECTION/MC11',
                             'y' : [new Date (s119).getTime() , new Date(e119).getTime() ],
                             'fillColor' : o19
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a10.length; i++) {
                    s110 = String(a10[i].start_production);
                    e110 = String(a10[i].finish_production);
                    p110 = String(a10[i].production_date);
                    var w110 = a10[i].status.toUpperCase();
                    var o110;
                    if (w110 == 'OPEN') {
                          o110 = '#008FFB';
                        }else if(w110 == "ONPROGESS"){
                          o110 = '#00E396';
                        } else {
                          o110 = '#FF4560';
                        }

                    l110 = p110.substring(0, 10)
                    s1110 = l110 +' '+ s110;
                    e1110 = l110 +' '+ e110.replace('.',':');
                    json10 += JSON.stringify({
                             'x' : 'INJECTION/MC12',
                             'y' : [new Date (s1110).getTime() , new Date(e1110).getTime() ],
                             'fillColor' : o110
                                 }) + ',';
                    }
                    // BATAS
                  for (let i = 0; i < a11.length; i++) {
                    s111 = String(a11[i].start_production);
                    e111 = String(a11[i].finish_production);
                    p111 = String(a11[i].production_date);
                    var w111 = a11[i].status.toUpperCase();
                    var o111;
                    if (w111 == 'OPEN') {
                          o111 = '#008FFB';
                        }else if(w111 == "ONPROGESS"){
                          o111 = '#00E396';
                        } else {
                          o111 = '#FF4560';
                        }

                    l111 = p111.substring(0, 10)
                    s1111 = l111 +' '+ s111;
                    e1111 = l111 +' '+ e111.replace('.',':');
                    json11 += JSON.stringify({
                             'x' : 'ASSY/HPW03',
                             'y' : [new Date (s1111).getTime() , new Date(e1111).getTime() ],
                             'fillColor' : o111
                                 }) + ',';
                    }
                    // BATAS

                  ////////////////
                  a1 = json.replace('remove','');

                  json1 = a1.substring('', a1.length - 1)
                  a11 =  '[' + json1 + ']' ;

                  a12 = json2.replace('remove','');

                  json12 = a12.substring('', a12.length - 1)
                  a112 =  '[' + json12 + ']' ;
                  ////////////////
                  a13 = json3.replace('remove','');

                  json13 = a13.substring('', a13.length - 1)
                  a113 =  '[' + json13 + ']' ;
                  ////////////////
                  a14 = json4.replace('remove','');

                  json14 = a14.substring('', a14.length - 1)
                  a114 =  '[' + json14 + ']' ;
                  ////////////////
                  a15 = json5.replace('remove','');

                  json15 = a15.substring('', a15.length - 1)
                  a115 =  '[' + json15 + ']' ;
                  ////////////////
                  a16 = json6.replace('remove','');

                  json16 = a16.substring('', a16.length - 1)
                  a116 =  '[' + json16 + ']' ;
                  ////////////////
                  a17 = json7.replace('remove','');

                  json17 = a17.substring('', a17.length - 1)
                  a117 =  '[' + json17 + ']' ;
                  ////////////////
                  a18 = json8.replace('remove','');

                  json18 = a18.substring('', a1.length - 1)
                  a118 =  '[' + json18 + ']' ;
                  ////////////////
                  a19 = json9.replace('remove','');

                  json19 = a19.substring('', a19.length - 1)
                  a119 =  '[' + json19 + ']' ;
                  ////////////////
                  a110 = json10.replace('remove','');

                  json110 = a110.substring('', a110.length - 1)
                  a1110 =  '[' + json110 + ']' ;
                  ////////////////
                  a111 = json11.replace('remove','');

                  json111 = a111.substring('', a111.length - 1)
                  a1111 =  '[' + json111 + ']' ;
                  /////////////////
                  console.log(a11);
                  console.log(a111);
                  console.log(a112);
                  console.log(a113);
                  console.log(a114);
                  console.log(a115);
                  console.log(a116);
                  console.log(a117);
                  console.log(a118);
                  console.log(a119);

              chart.updateSeries([{
                 name: 'MC-01',
                 data: $.parseJSON(a11)
                },{
                 name: 'MC-02',
                 data: $.parseJSON(a112)
                },{
                 name: 'MC-03',
                 data: $.parseJSON(a113)
                },{
                 name: 'MC-04',
                 data: $.parseJSON(a114)
                },{
                 name: 'MC-05',
                 data: $.parseJSON(a115)
                },{
                 name: 'MC-06',
                 data: $.parseJSON(a116)
                },{
                 name: 'MC-07',
                 data: $.parseJSON(a117)
                },{
                 name: 'MC-08',
                 data: $.parseJSON(a118)
                },{
                 name: 'MC-11',
                 data: $.parseJSON(a119)
                },{
                 name: 'MC-12',
                 data: $.parseJSON(a1110)
                },{
                 name: 'HPW-03',
                 data: $.parseJSON(a1111)
                }])
            })
  </script>
@endsection

