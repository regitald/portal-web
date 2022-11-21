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
        .vertical-text {
        writing-mode: vertical-lr;
        text-orientation: sideways-left;
        transform: scale(-1, -1);
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
          <div class="col-2">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif
            <!-- general form elements -->
            <div class="card card-primary" onload="myFunction()">
                
              <!-- form start -->
             
                
                <div class="card-body">
                  
                  
                  <div id="line_form" style="display: block">
                    <form  role="form" method="post" action="{{ url('admin/daily-report') }}">
                        {{ csrf_field() }}
                            <input type="text" name="user_id" value="{{Session::get('Users.id')}}" style="display:none">
                            
                            <div class="form-group">
                                <label for="production_date">Production Date</label>
                                <div class="row">
                                    <div class="col-12">
                                        <input name="date_start" type="date" class="form-control" placeholder=".col-3">
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="myMultiselect">Select Line Number</label>
                                <select class="custom-select" name="line_name">
                                    @foreach ($lm as $lm)
                                    
                                    <option value="{{$lm->type}}/{{$lm->name}}">{{$lm->type}}/{{$lm->name}}</option>
                                    
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mode">Mode</label>
                                <select class="custom-select" id="mode" name="mode">
                                    
                                    
                                    <option value="1">07:00 - 19:30</option>
                                    <option value="2">07:30 - 20:00</option>
                                    
                                </select>
                            </div>
                            
                            
                            <button type="submit" class="btn btn-primary"  style="background-color: #3BB873;border:none">Submit</button>
                    </form>
                  </div>                    
                </div>        <!-- /.card-body -->
                <div class="card-footer">
                  
                </div>
              
            </div>
            <!-- /.card -->
          </div>
          <div class="col-10">
            @if($errors->any())
              <div class="alert alert-danger">
              {{$errors->first()}}
              </div>
            @endif

            <div class="card">

                <div class="card-header">
                    <h1 class="card-title">
                </h1><br>
                </div>
                <div class="card-body">
                    <table class='table table-bordered text-center'>
                        <thead>
                            <tr>
                                <td colspan="2">Time</td>
                                <td>PLAN</td>
                                <td rowspan="2">RH/LH</td>
                                <td colspan="3">Actual</td>
                                <td colspan="16">Jenis NG</td>
                            </tr> 
                            <tr>
                                <td>Start</td>
                                <td>Stop</td>
                                <td>QTY</td>
                                <td>OK</td>
                                <td>NG</td>
                                <td>TOTAL</td>
                                <td class="vertical-text">Sink Mark</td>
                                <td class="vertical-text">Silver</td>
                                <td class="vertical-text">Dented</td>
                                <td class="vertical-text">Short Mold</td>
                                <td class="vertical-text">Jetting</td>
                                <td class="vertical-text">Kontaminasi</td>
                                <td class="vertical-text">Bubble</td>
                                <td class="vertical-text">NG Setting</td>
                                <td class="vertical-text">Weld Line</td>
                                <td class="vertical-text">Black dot</td>
                                <td class="vertical-text">Setting</td>
                                <td class="vertical-text">Flowmark</td>
                                <td class="vertical-text">Oil</td>
                                <td class="vertical-text">Flek</td>
                                <td class="vertical-text">Scracth</td>
                                <td class="vertical-text">Crack</td>
                                
                                

                            </tr>  
                        </thead>
                    <tbody>
                        @foreach ($list_machine as $it)
                            <tr>
                                <td rowspan="2">  {{$it->st}}</td>
                                 <td rowspan="2">  {{$it->ft}}</td>
                                <td> {{$it->sampai}}</td>
                                <td> RH </td>
                                <td> {{$it->total_ok_rh}}</td>
                                <td> {{$it->total_ng_rh}}</td>
                                <td> {{$it->total_rh}}</td>
                                <td> {{$it->ngr1}}</td>
                                <td> {{$it->ngr2}}</td>
                                <td> {{$it->ngr3}}</td>
                                <td> {{$it->ngr4}}</td>
                                <td> {{$it->ngr5}}</td>
                                <td> {{$it->ngr6}}</td>
                                <td> {{$it->ngr7}}</td>
                                <td> {{$it->ngr8}}</td>
                                <td> {{$it->ngr9}}</td>
                                <td> {{$it->ngr10}}</td>
                                <td> {{$it->ngr11}}</td>
                                <td> {{$it->ngr12}}</td>
                                <td> {{$it->ngr13}}</td>
                                <td> {{$it->ngr14}}</td>
                                <td> {{$it->ngr15}}</td>
                                <td> {{$it->ngr16}}</td>
                                
                            </tr>
                            <tr>
                               
                                <td> {{$it->sampai}}</td>
                                <td> LH </td>
                                <td> {{$it->total_ok_lh}}</td>
                                <td> {{$it->total_ng_lh}}</td>
                                <td> {{$it->total_lh}}</td>
                                <td> {{$it->ngl1}}</td>
                                <td> {{$it->ngl2}}</td>
                                <td> {{$it->ngl3}}</td>
                                <td> {{$it->ngl4}}</td>
                                <td> {{$it->ngl5}}</td>
                                <td> {{$it->ngl6}}</td>
                                <td> {{$it->ngl7}}</td>
                                <td> {{$it->ngl8}}</td>
                                <td> {{$it->ngl9}}</td>
                                <td> {{$it->ngl10}}</td>
                                <td> {{$it->ngl11}}</td>
                                <td> {{$it->ngl12}}</td>
                                <td> {{$it->ngl13}}</td>
                                <td> {{$it->ngl14}}</td>
                                <td> {{$it->ngl15}}</td>
                                <td> {{$it->ngl16}}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                    
                    </table>
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
    $(document).ready(function() {
    var b = @json($list_machine);
    console.log(b);
    })
</script>
@endsection

