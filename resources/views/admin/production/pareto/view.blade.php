@extends('admin.template.main')
@section('content')
<style>
    .highcharts-figure,
    .highcharts-data-table table {
    min-width: 320px;
    max-width: 800px;
    margin: 1em auto;
    }

    .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
    }

    .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
    }

    .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
    padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
    background: #f1f7ff;
    }
    .multiselect {
        width: 100%;
        }

        .selectBox {
        position: relative;
        }

        .selectBox select {
        width: 100%;
        }

        .overSelect {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        }

        #mySelectOptions2 {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions2 label {
        display: block;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1.2em;
        background-color: #ffffff00;
        padding: 0 2.25rem 0 .75rem;
        /* padding: .375rem 2.25rem .375rem .75rem; */
        }

        #mySelectOptions2 label:hover {
        background-color: #1e90ff;
        }
        #mySelectOptions1 {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions1 label {
        display: block;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1.2em;
        background-color: #ffffff00;
        padding: 0 2.25rem 0 .75rem;
        /* padding: .375rem 2.25rem .375rem .75rem; */
        }

        #mySelectOptions1 label:hover {
        background-color: #1e90ff;
        }
        #mySelectOptions3 {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions3 label {
        display: block;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1.2em;
        background-color: #ffffff00;
        padding: 0 2.25rem 0 .75rem;
        /* padding: .375rem 2.25rem .375rem .75rem; */
        }

        #mySelectOptions3 label:hover {
        background-color: #1e90ff;
        }
        #mySelectOptions4 {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions4 label {
        display: block;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1.2em;
        background-color: #ffffff00;
        padding: 0 2.25rem 0 .75rem;
        /* padding: .375rem 2.25rem .375rem .75rem; */
        }

        #mySelectOptions4 label:hover {
        background-color: #1e90ff;
        }
        #mySelectOptions5 {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions5 label {
        display: block;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1.2em;
        background-color: #ffffff00;
        padding: 0 2.25rem 0 .75rem;
        /* padding: .375rem 2.25rem .375rem .75rem; */
        }

        #mySelectOptions5 label:hover {
        background-color: #1e90ff;
        }
        #mySelectOptions6 {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions6 label {
        display: block;
        font-weight: normal;
        display: block;
        white-space: nowrap;
        min-height: 1.2em;
        background-color: #ffffff00;
        padding: 0 2.25rem 0 .75rem;
        /* padding: .375rem 2.25rem .375rem .75rem; */
        }

        #mySelectOptions6 label:hover {
        background-color: #1e90ff;
        }
</style>
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
          <div class="col-3">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            <!-- general form elements -->
            <div class="card card-primary" onload="myFunction()">
                
              <!-- form start -->
             
                
                <div class="card-body">
                  <div class="form-group">
                            <label for="no_mo">Select X axis</label>
                            <select class="form-control" name="list_x" required="required" id="selectaxis"> 
                                
                                <option value="1">NG Type</option>
                                <option value="2">Machine Name</option>
                                <option value="3">Time (Hour) </option>
                                <option value="4">Part No</option>
                            </select>
                            </div>
                  
                  <div id="line_form" style="display: block">
                    <form  role="form" method="post" action="{{ url('admin/production-analytic') }}">
                        {{ csrf_field() }}
                            <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                            
                            <div class="form-group">
                                <label for="production_date">Production Date Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="date_start" type="date" class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="date_end" type="date"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="production_date">Time Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="time_start" type="time"  class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="time_end" type="time"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect1">Select Line Number</label>
                                <div id="myMultiselect1" class="multiselect">
                                <div id="mySelectLabel1" class="selectBox" onclick="toggleCheckboxArea1()">
                                    <select class="form-control">
                                    <option>No data Add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions1">
                                     <label for="allline"><input type="checkbox" id="allline"  name="line_numbers[]" onchange="checkboxStatusChange1()" value="All"/> All</label>
                                    @foreach ($lm as $lm)
                                    <label for="{{$lm->type}}/{{$lm->name}}"><input type="checkbox" id="{{$lm->type}}/{{$lm->name}}"  name="line_numbers[]" onchange="checkboxStatusChange1()" value="{{$lm->type}}/{{$lm->name}}"/> {{$lm->type}}/{{$lm->name}}</label>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect2">Select NG Reason</label>
                                <div id="myMultiselect2" class="multiselect">
                                <div id="mySelectLabel2" class="selectBox" onclick="toggleCheckboxArea2()">
                                    <select class="form-control">
                                    <option>No data add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions2">
                                    <label for="n17"><input type="checkbox" id="n17"  name="ng[]" onchange="checkboxStatusChange2()" value="All"/> All</label>
                                    <label for="n18"><input type="checkbox" id="n18"  name="ng[]" onchange="checkboxStatusChange2()" value="Others Only"/> Others Only</label>
                                    @foreach ($ln as $ln)
                                   
                                    <label for="{{$ln->name}}"><input type="checkbox" id="{{$ln->name}}"  name="ng[]" onchange="checkboxStatusChange2()" value="{{$ln->name}}"/> {{$ln->name}}</label>
                                    
                                    @endforeach
                                    
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect5">OP NPK</label>
                                <div id="myMultiselect5" class="multiselect">
                                <div id="mySelectLabel5" class="selectBox" onclick="toggleCheckboxArea5()">
                                    <select class="form-control">
                                    <option>No data add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions5">
                                    <label for="user17"><input type="checkbox" id="user17"  name="alluser" onchange="checkboxStatusChange5()" value="All"/> All</label>
                                    
                                    @foreach ($userhmi as $uh)
                                    <label for="{{$uh->username}}"><input type="checkbox" id="{{$uh->username}}"  name="u{{$uh->username}}" onchange="checkboxStatusChange5()" value="{{$uh->username}}"/> {{$uh->username}}({{$uh->name}})</label>
                                    
                                    @endforeach
                                    
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect6">Area NG</label>
                                <div id="myMultiselect6" class="multiselect">
                                <div id="mySelectLabel6" class="selectBox" onclick="toggleCheckboxArea6()">
                                    <select class="form-control">
                                    <option>No data add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions6">
                                    <label for="areaa"><input type="checkbox" id="areaa"  name="area[]" onchange="checkboxStatusChange6()" value="All"/> All</label>
                                    
                                    @foreach ($area as $ar)
                                    <label for="{{$ar->test}}"><input type="checkbox" id="{{$ar->test}}"  name="area[]" onchange="checkboxStatusChange6()" value="{{$ar->test}}"/> {{$ar->test}}</label>
                                    
                                    @endforeach
                                    
                                </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"  style="background-color: #3BB873;border:none">Submit</button>
                    </form>
                  </div>
                  <div id="name_form" style="display: none">
                    <form  role="form" method="post" action="{{ url('admin/production-analytic/ng/line') }}">
                        {{ csrf_field() }}
                            <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                            
                            <div class="form-group">
                                <label for="production_date">Production Date Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="date_start" type="date" class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="date_end" type="date"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="production_date">Time Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="time_start" type="time"  class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="time_end" type="time"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect3">Select Line Number</label>
                                <div id="myMultiselect3" class="multiselect">
                                <div id="mySelectLabel3" class="selectBox" onclick="toggleCheckboxArea3()">
                                    <select class="form-control">
                                    <option>No data Add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions3">
                                    @foreach ($lm1 as $lm1)
                                    <label for="{{$lm1->type}}/{{$lm1->name}}"><input type="checkbox" id="{{$lm1->type}}/{{$lm1->name}}"  name="{{$lm1->name}}" onchange="checkboxStatusChange3()" value="{{$lm1->type}}/{{$lm1->name}}"/> {{$lm1->type}}/{{$lm1->name}}</label>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect4">Select NG Reason</label>
                                <div id="myMultiselect4" class="multiselect">
                                <div id="mySelectLabel4" class="selectBox" onclick="toggleCheckboxArea4()">
                                    <select class="form-control">
                                    <option>No data add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions4">
                                    <label for="n17"><input type="checkbox" id="n17"  name="n16" onchange="checkboxStatusChange4()" value="All"/> All</label>
                                    <label for="n18"><input type="checkbox" id="n18"  name="n16" onchange="checkboxStatusChange4()" value="Others Only"/> Others Only</label>
                                    @foreach ($ln1 as $ln1)
                                    <label for="{{$ln1->name}}"><input type="checkbox" id="{{$ln1->name}}"  name="n{{$ln1->id}}" onchange="checkboxStatusChange4()" value="{{$ln1->name}}"/> {{$ln1->name}}</label>
                                    
                                    @endforeach
                                    
                                </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary"  style="background-color: #3BB873;border:none">Submit</button>
                    </form>
                  </div>
                   <div id="time_form" style="display: none">
                    <form  role="form" method="post" action="{{ url('admin/planning-daily/store') }}">
                        {{ csrf_field() }}
                            <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                            <div class="form-group">
                                <label for="production_date">Production Date Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="date_start" type="date" class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="date_end" type="date"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="production_date">Time Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="time_start" type="time"  class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="time_end" type="time"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>
                    </form>
                  </div>
                   <div id="lph_form" style="display: none">
                    <form  role="form" method="post" action="{{ url('admin/planning-daily/store') }}">
                        {{ csrf_field() }}
                            <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                            <div class="form-group">
                                <label for="production_date">Production Date Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="date_start" type="date" class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="date_end" type="date"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="production_date">Time Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input name="time_start" type="time"  class="form-control" placeholder=".col-3">
                                    </div>
                                    <div class="col-6">
                                        <input name="time_end" type="time"  class="form-control" placeholder=".col-4">
                                    </div>
                                </div>
                            </div>
                    </form>
                  </div>
                    
                </div>        <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              
            </div>
            <!-- /.card -->
          </div>
          <div class="col-9">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h1 class="card-title">@foreach ($list_machine as $item)
                        {{$item->desc}}
                    @endforeach
                </h1><br>
                </div>
                <div class="card-body">
                    <div id="chart"></div>
                </div>
                <hr>
                <div class="card-body">

                    <a href="#"  type="button" class="btn btn-primary" style="background-color: #3BB873;border:none">Export Excel</a>
                    <a href="#"  type="button" class="btn btn-danger" style="background-color: red;border:none">Export PDF</a>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    document.getElementById('selectaxis').addEventListener('change', function () {
        var style = this.value == 1 ? 'block' : 'none';
        var style1 = this.value == 2 ? 'block' : 'none';
        var style2 = this.value == 3 ? 'block' : 'none';
        var style3 = this.value == 4 ? 'block' : 'none';
        document.getElementById('line_form').style.display = style;
        document.getElementById('name_form').style.display = style1;
        document.getElementById('time_form').style.display = style2;
        document.getElementById('lph_form').style.display = style3;
    });
</script>

@foreach ($loopaja as $loopaja)
   
<script>

        window.onload = (event) => {
            initMultiselect{{$loopaja->id}}();
        };
        ///lm Start
        function initMultiselect{{$loopaja->id}}() {
        checkboxStatusChange{{$loopaja->id}}();

        document.addEventListener("click", function(evt) {
            var flyoutElement = document.getElementById('myMultiselect{{$loopaja->id}}'),
            targetElement = evt.target; // clicked element

            do {
            if (targetElement == flyoutElement) {
                // This is a click inside. Do nothing, just return.
                //console.log('click inside');
                return;
            }

            // Go up the DOM
            targetElement = targetElement.parentNode;
            } while (targetElement);

            // This is a click outside.
            toggleCheckboxArea{{$loopaja->id}}(true);
            //console.log('click outside');
        });
        }

        function checkboxStatusChange{{$loopaja->id}}() {
        var multiselect = document.getElementById("mySelectLabel{{$loopaja->id}}");
        var multiselectOption = multiselect.getElementsByTagName('option')[0];

        var values = [];
        var checkboxes = document.getElementById("mySelectOptions{{$loopaja->id}}");
        var checkedCheckboxes = checkboxes.querySelectorAll('input[type=checkbox]:checked');

        for (const item of checkedCheckboxes) {
            var checkboxValue = item.getAttribute('value');
            values.push(checkboxValue);
        }

        var dropdownValue = "Nothing is selected";
        if (values.length > 0) {
            dropdownValue = values.join(', ');
        }

        multiselectOption.innerText = dropdownValue;
        }

        function toggleCheckboxArea{{$loopaja->id}}(onlyHide = false) {
        var checkboxes = document.getElementById("mySelectOptions{{$loopaja->id}}");
        var displayValue = checkboxes.style.display;

        if (displayValue != "block") {
            if (onlyHide == false) {
            checkboxes.style.display = "block";
            }
        } else {
            checkboxes.style.display = "none";
        }
        }
        //LM end
        
</script>
@endforeach
<script>

                    var options = {
                    series: [],
                    chart: {
                    height: 500,
                    type: 'line',
                    stacked: true,
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
                    export: {
                        csv: {
                            filename: undefined,
                            columnDelimiter: ',',
                            headerCategory: 'category',
                            headerValue: 'value',
                            dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                            }
                        },
                        svg: {
                            filename: undefined,
                        },
                        png: {
                            filename: undefined,
                        }
                    },
                    
                    xaxis: {
                        labels: {
                            rotate: -45,
                            rotateAlways: true,
                            trim: false,
                            minHeight: 100,
                            maxHeight: 180,
                        },
                        tickPlacement: 'on'
                    }
                    };

                var chart = new ApexCharts(
                document.querySelector("#chart"),
                options
                );

                chart.render();
                 function myFunction() {            
            }
                $( document ).ready(function() {
                a = @json($list_machine);
                b = [];
                b1 = [];
                b = [];
                ap1 = [];
                ap2 = []; 
                ap3 = [];
                ap4 = [];
                ap5 = [];
                ap6 = [];
                ap7 = [];
                ap8 = [];
                ap9 = [];
                ap10 = [];
                ap11 = [];
                ap12 = []; 
                ap13 = [];
                ap14 = [];
                ap15 = [];
                ap16 = [];
                ap17 = [];
                ap18 = [];
                ap19 = [];
                ap20 = [];
                ap21 = [];
                ap22 = [];
                ap23 = [];
                ap24 = [];
                ap25 = [];
                console.log(a);
                var total = 0
                for (let i = 0; i < a.length; i++) {
                  total  += parseInt(a[i].total);
                }
                var t = total;
                for (let i = 0; i < a.length; i++) {
                  c = a[i].total;
                  s11 = a[i].a1;
                  s12 = a[i].a2;
                  s13 = a[i].a3;
                  s14 = a[i].a4;
                  s15 = a[i].a5;
                  s21 = a[i].b1;
                  s22 = a[i].b2;
                  s23 = a[i].b3;
                  s24 = a[i].b4;
                  s25 = a[i].b5;
                  s31 = a[i].c1;
                  s32 = a[i].c2;
                  s33 = a[i].c3;
                  s34 = a[i].c4;
                  s35 = a[i].c5;
                  s41 = a[i].d1;
                  s42 = a[i].d2;
                  s43 = a[i].d3;
                  s44 = a[i].d4;
                  s45 = a[i].d5;
                  s51 = a[i].e1;
                  s52 = a[i].e2;
                  s53 = a[i].e3;
                  s54 = a[i].e4;
                  s55 = a[i].e5;
                  
                  d = a[i].desc;
                //   console.log(i);
                  var totalloop = 0;
                  for (let loop = i; loop >= 0; loop--) {
                    totalloop  += parseInt(a[loop].total);
                    
                    }
                  cur = totalloop;
                  p1 = (totalloop/t) * 100; 
                  p2 = parseFloat(p1).toFixed(1);
                  e = d.replace(/\0[\s\S]*$/g,'');
                  f = {"x" : e, "y" :c}
                  g = {"x" : e, "y" :p2}
                 
                  f1 = {"x" : e, "y" :s11}
                  f2 = {"x" : e, "y" :s12}
                  f3 = {"x" : e, "y" :s13}
                  f4 = {"x" : e, "y" :s14}
                  f5 = {"x" : e, "y" :s15}

                  f11 = {"x" : e, "y" :s21}
                  f12 = {"x" : e, "y" :s22}
                  f13 = {"x" : e, "y" :s23}
                  f14 = {"x" : e, "y" :s24}
                  f15 = {"x" : e, "y" :s25}

                  f21 = {"x" : e, "y" :s31}
                  f22 = {"x" : e, "y" :s32}
                  f23 = {"x" : e, "y" :s33}
                  f24 = {"x" : e, "y" :s34}
                  f25 = {"x" : e, "y" :s35}

                  f31 = {"x" : e, "y" :s41}
                  f32 = {"x" : e, "y" :s42}
                  f33 = {"x" : e, "y" :s43}
                  f34 = {"x" : e, "y" :s44}
                  f35 = {"x" : e, "y" :s45}

                  f41 = {"x" : e, "y" :s51}
                  f42 = {"x" : e, "y" :s52}
                  f43 = {"x" : e, "y" :s53}
                  f44 = {"x" : e, "y" :s54}
                  f45 = {"x" : e, "y" :s55}


                  
                  b.push(f);
                  b1.push(g);
                  
                  

                  console.log(totalloop)
                }
                
                chart.updateSeries([{
                    name: 'NG QTY',
                    data: b,
                    type: 'bar'
                },{
                    name: 'NG Paretto',
                    data: b1,
                    type: 'line'
                }])
                chart.updateOptions({
                tooltip: {
                        custom: function({series, seriesIndex, dataPointIndex, w}){
                            var element = '<div class="card-header p-1 m-1">'+a[dataPointIndex].desc+'</div>';
                            element += '<div class="card-body">'
                            element += '<div> Total NG =&nbsp' + a[dataPointIndex].total +'</div>';
                            if (a[dataPointIndex].a1>0){
                                element += '<div> Area A1=&nbsp' + a[dataPointIndex].a1 +'</div>';
                            }
                            if (a[dataPointIndex].a2>0){
                                element += '<div> Area A2=&nbsp' + a[dataPointIndex].a2 +'</div>';
                            }
                            if (a[dataPointIndex].a3>0){
                                element += '<div> Area A3=&nbsp' + a[dataPointIndex].a3 +'</div>';
                            }
                            if (a[dataPointIndex].a4>0){
                                element += '<div> Area A4=&nbsp' + a[dataPointIndex].a4 +'</div>';
                            }
                            if (a[dataPointIndex].a5>0){
                                element += '<div> Area A5=&nbsp' + a[dataPointIndex].a5 +'</div>';
                            }
                            
                            if (a[dataPointIndex].b1>0){
                                element += '<div> Area B1=&nbsp' + a[dataPointIndex].b1 +'</div>';
                            }
                            if (a[dataPointIndex].b2>0){
                                element += '<div> Area B2=&nbsp' + a[dataPointIndex].b2 +'</div>';
                            }
                            if (a[dataPointIndex].b3>0){
                                element += '<div> Area B3=&nbsp' + a[dataPointIndex].b3 +'</div>';
                            }
                            if (a[dataPointIndex].b4>0){
                                element += '<div> Area B4=&nbsp' + a[dataPointIndex].b4 +'</div>';
                            }
                            if (a[dataPointIndex].b5>0){
                                element += '<div> Area B5=&nbsp' + a[dataPointIndex].b5 +'</div>';
                            }

                            if (a[dataPointIndex].c1>0){
                                element += '<div> Area C1=&nbsp' + a[dataPointIndex].c1 +'</div>';
                            }
                            if (a[dataPointIndex].c2>0){
                                element += '<div> Area C2=&nbsp' + a[dataPointIndex].c2 +'</div>';
                            }
                            if (a[dataPointIndex].c3>0){
                                element += '<div> Area C3=&nbsp' + a[dataPointIndex].c3 +'</div>';
                            }
                            if (a[dataPointIndex].c4>0){
                                element += '<div> Area C4=&nbsp' + a[dataPointIndex].c4 +'</div>';
                            }
                            if (a[dataPointIndex].c5>0){
                                element += '<div> Area C5=&nbsp' + a[dataPointIndex].c5 +'</div>';
                            }

                            if (a[dataPointIndex].d1>0){
                                element += '<div> Area D1=&nbsp' + a[dataPointIndex].d1 +'</div>';
                            }
                            if (a[dataPointIndex].d2>0){
                                element += '<div> Area D2=&nbsp' + a[dataPointIndex].d2 +'</div>';
                            }
                            if (a[dataPointIndex].d3>0){
                                element += '<div> Area D3=&nbsp' + a[dataPointIndex].d3 +'</div>';
                            }
                            if (a[dataPointIndex].d4>0){
                                element += '<div> Area D4=&nbsp' + a[dataPointIndex].d4 +'</div>';
                            }
                            if (a[dataPointIndex].d5>0){
                                element += '<div> Area D5=&nbsp' + a[dataPointIndex].d5 +'</div>';
                            }

                            if (a[dataPointIndex].e1>0){
                                element += '<div> Area E1=&nbsp' + a[dataPointIndex].e1 +'</div>';
                            }
                            if (a[dataPointIndex].e2>0){
                                element += '<div> Area E2=&nbsp' + a[dataPointIndex].e2 +'</div>';
                            }
                            if (a[dataPointIndex].e3>0){
                                element += '<div> Area E3=&nbsp' + a[dataPointIndex].e3 +'</div>';
                            }
                            if (a[dataPointIndex].e4>0){
                                element += '<div> Area E4=&nbsp' + a[dataPointIndex].e4 +'</div>';
                            }
                            if (a[dataPointIndex].e5>0){
                                element += '<div> Area E5=&nbsp' + a[dataPointIndex].e5 +'</div>';
                            }



                            
                            
                            element += '</div">'  
                            return '<div class="card">'+element+'</div>';
                             
                        }},
                yaxis: [{   
                            min: (min)=>{
                                console.log(min);
                                return min;    
                            },
                            max: () => {
                            return parseInt(a[0].total) + 10;
                            }
                            
                        },{
                            opposite : true,
                            min : 0,
                            max : 100
                        }]
                })
                
                });
                

</script>
@endsection

