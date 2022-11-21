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

        #mySelectOptions {
        display: none;
        border: 0.5px #7c7c7c solid;
        background-color: #ffffff;
        max-height: 150px;
        overflow-y: scroll;
        }

        #mySelectOptions label {
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
                  
                  <div id="line_form" style="display: none">
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
                                <label for="myMultiselect">Select Line Number</label>
                                <div id="myMultiselect" class="multiselect">
                                <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea()">
                                    <select class="form-control">
                                    <option>No data Add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions">
                                    @foreach ($lm as $lm)
                                    <label for="{{$lm->type}}/{{$lm->name}}"><input type="checkbox" id="{{$lm->type}}/{{$lm->name}}"  name="{{$lm->name}}" onchange="checkboxStatusChange()" value="{{$lm->type}}/{{$lm->name}}"/> {{$lm->type}}/{{$lm->name}}</label>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect1">Select NG Reason</label>
                                <div id="myMultiselect1" class="multiselect">
                                <div id="mySelectLabel1" class="selectBox" onclick="toggleCheckboxArea1()">
                                    <select class="form-control">
                                    <option>No data add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions1">
                                    <label for="n17"><input type="checkbox" id="n17"  name="n16" onchange="checkboxStatusChange1()" value="All"/> All</label>
                                    <label for="n18"><input type="checkbox" id="n18"  name="n16" onchange="checkboxStatusChange1()" value="Others Only"/> Others Only</label>
                                    @foreach ($ln as $ln)
                                    <label for="{{$ln->name}}"><input type="checkbox" id="{{$ln->name}}"  name="n{{$ln->id}}" onchange="checkboxStatusChange1()" value="{{$ln->name}}"/> {{$ln->name}}</label>
                                    
                                    @endforeach
                                    
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Select Line Name</label>
                                <select multiple class="form-control" name="list[]" id="exampleFormControlSelect2">
                                 
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"  style="background-color: #3BB873;border:none">Submit</button>
                    </form>
                  </div>
                  <div id="name_form">
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
                                <label for="myMultiselect">Select Line Number</label>
                                <div id="myMultiselect" class="multiselect">
                                <div id="mySelectLabel" class="selectBox" onclick="toggleCheckboxArea()">
                                    <select class="form-control">
                                    <option>No data Add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions">
                                    @foreach ($lm1 as $lm1)
                                    <label for="{{$lm1->type}}/{{$lm1->name}}"><input type="checkbox" id="{{$lm1->type}}/{{$lm1->name}}"  name="{{$lm1->name}}" onchange="checkboxStatusChange()" value="{{$lm1->type}}/{{$lm1->name}}"/> {{$lm1->type}}/{{$lm1->name}}</label>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="myMultiselect1">Select NG Reason</label>
                                <div id="myMultiselect1" class="multiselect">
                                <div id="mySelectLabel1" class="selectBox" onclick="toggleCheckboxArea1()">
                                    <select class="form-control">
                                    <option>No data add</option>
                                    </select>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="mySelectOptions1">
                                    <label for="n17"><input type="checkbox" id="n17"  name="n16" onchange="checkboxStatusChange1()" value="All"/> All</label>
                                    <label for="n18"><input type="checkbox" id="n18"  name="n16" onchange="checkboxStatusChange1()" value="Others Only"/> Others Only</label>
                                    @foreach ($ln1 as $ln1)
                                    <label for="{{$ln1->name}}"><input type="checkbox" id="{{$ln1->name}}"  name="n{{$ln1->id}}" onchange="checkboxStatusChange1()" value="{{$ln1->name}}"/> {{$ln1->name}}</label>
                                    
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
                        {{$item->line_name}}
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
        window.onload = (event) => {
            initMultiselect();
            initMultiselect1();
        };
        ///lm Start
        function initMultiselect() {
        checkboxStatusChange();

        document.addEventListener("click", function(evt) {
            var flyoutElement = document.getElementById('myMultiselect'),
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
            toggleCheckboxArea(true);
            //console.log('click outside');
        });
        }

        function checkboxStatusChange() {
        var multiselect = document.getElementById("mySelectLabel");
        var multiselectOption = multiselect.getElementsByTagName('option')[0];

        var values = [];
        var checkboxes = document.getElementById("mySelectOptions");
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

        function toggleCheckboxArea(onlyHide = false) {
        var checkboxes = document.getElementById("mySelectOptions");
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
        ///lm Start
        function initMultiselect1() {
        checkboxStatusChange1();

        document.addEventListener("click", function(evt) {
            var flyoutElement = document.getElementById('myMultiselect1'),
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
            toggleCheckboxArea1(true);
            //console.log('click outside');
        });
        }

        function checkboxStatusChange1() {
        var multiselect = document.getElementById("mySelectLabel1");
        var multiselectOption = multiselect.getElementsByTagName('option')[0];

        var values = [];
        var checkboxes = document.getElementById("mySelectOptions1");
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

        function toggleCheckboxArea1(onlyHide = false) {
        var checkboxes = document.getElementById("mySelectOptions1");
        var displayValue = checkboxes.style.display;

        if (displayValue != "block") {
            if (onlyHide == false) {
            checkboxes.style.display = "block";
            }
        } else {
            checkboxes.style.display = "none";
        }
        }
        // //LM end
        // </script>
<script>
                    var options = {
                    series: [],
                    chart: {
                    height: 500,
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
                 function myFunction() {
                
                
                
            }
                $( document ).ready(function() {
                a = @json($list_machine);
                b = [];
                b1 = [];
                var total = 0
                for (let i = 0; i < a.length; i++) {
                  total  += parseInt(a[i].total);
                }
                var t = total;
                for (let i = 0; i < a.length; i++) {
                  c = a[i].total;
                  d = a[i].line_name;
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
                });

</script>

@endsection

