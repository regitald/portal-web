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
<script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.36.0/apexcharts.min.js"></script>
<script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
<script src="https://code.highcharts.com/gantt/modules/exporting.js"></script>
<script src="https://code.highcharts.com/gantt/modules/accessibility.js"></script>
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
    <section class="mr-5 ml-5">
      <div class="row flex">
        <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC01">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-01</b>
                </div>
                <div class="col-6 text-start" >
                    <b id="INJECTION/MC01_status">Running</b>
                </div>
                </div>
            </div>
            <div class="card-body" id="card_body_INJECTION/MC01">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC01">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC01" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC01">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC01">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC01">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC01">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC01">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC02">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-02</b>
                </div>
                <div class="col-6 text-start" >
                     <b id="INJECTION/MC02_status" >Running</b>
                </div>
            </div>
            </div>
            <div class="card-body" id="card_body_INJECTION/MC02">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC02">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC02"/>
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC02">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC02">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC02">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC02">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC02">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC03">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-03</b>
                </div>
                <div class="col-6 text-start" >
                     <b id="INJECTION/MC03_status" >Running</b>
                </div>
            </div>
            </div>
            <div class="card-body" id="card_body_INJECTION/MC03">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC03">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC03" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC03">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC03">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC03">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC03">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered mb-0" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC03">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC04">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-04</b>
                </div>
                <div class="col-6 text-start">
                     <b id="INJECTION/MC04_status" >Running</b>
                </div>
            </div>
        </div>
            <div class="card-body" id="card_body_INJECTION/MC04">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC04">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC04" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC04">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC04">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC04">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC04">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC04">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC05">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-05</b>
                </div>
                <div class="col-6 text-start">
                     <b id="INJECTION/MC05_status" >Running</b>
                </div>
            </div>            </div>
            <div class="card-body" id="card_body_INJECTION/MC05">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC05">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC05" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC05">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC05">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC05">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC05">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC05">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC06">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-06</b>
                </div>
                <div class="col-6 text-start">
                     <b id="INJECTION/MC06_status" >Running</b>
                </div>
            </div>            </div>
            <div class="card-body" id="card_body_INJECTION/MC06">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC06">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC06" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC06">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC06">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC06">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC06">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC06">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC07">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-07</b>
                </div>
                <div class="col-6 text-start">
                     <b id="INJECTION/MC07_status" >Running</b>
                </div>
            </div>            </div>
            <div class="card-body" id="card_body_INJECTION/MC07">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC07">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC07" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC07">
            <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC07">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC07">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC07">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC07">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC08">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-08</b>
                </div>
                <div class="col-6 text-start">
                     <b id="INJECTION/MC08_status" >Running</b>
                </div>
            </div>
            </div>
            <div class="card-body" id="card_body_INJECTION/MC08">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC08">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC08" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC08">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC08">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC08">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC08">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC08">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC11">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-11</b>
                </div>
                <div class="col-6 text-start">
                     <b id="INJECTION/MC11_status" >Running</b>
                </div>
            </div>
            </div>
            <div class="card-body" id="card_body_INJECTION/MC11">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC11">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC11" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC11">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC11">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC11">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC11">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC11">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_INJECTION/MC12">
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>MC-12</b>
                </div>
                <div class="col-6 text-start" >
                     <b id="INJECTION/MC12_status" >Running</b>
                </div>
            </div>
            </div>
            <div class="card-body" id="card_body_INJECTION/MC12">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_INJECTION/MC12">
                50%
               </span>
              </div>
              <canvas id="INJECTION/MC12" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_INJECTION/MC12">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_INJECTION/MC12">0</span></<td>
                            <td class="text-center" ><span id="perf_INJECTION/MC12">0</span></td>
                            <td class="text-center"><span id="qua_INJECTION/MC12">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_INJECTION/MC12">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
         <div class="col-sm-2">
          <div class="card">
            <div class="card-header" style="padding:0.5rem" id="card_header_ASSEMBLY/HPW03" >
            <div class="row ">
                <div class="col-6 text-start">
                    <i class="fas fa-th-large"></i> <b>HP03</b>
                </div>
                <div class="col-6 text-start">
                    <b id="ASSEMBLY/HPW03_status" >Running</b>
                </div>
            </div>
            </div>
            <div class="card-body" id="card_body_ASSEMBLY/HPW03">
            <div style="width: 100%; height: 100%; float: left; position: relative;">
              <div style="width: 100%; height: 40px; position: absolute; top: 50%; left: 0; margin-top: -15px; line-height:19px; text-align: center; z-index: 999999999999999">
                OEE <br/>
               <span id="oee_ASSEMBLY/HPW03">
                50%
               </span>
              </div>
              <canvas id="ASSEMBLY/HPW03" />
            </div>
            </div>
            <div class="card-footer" style="padding:0.5rem" id="card_footer_ASSEMBLY/HPW03">
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="table-primary text-center" >AVA</<td>
                            <td class="table-secondary text-center" >PERF</td>
                            <td class="table-warning text-center">QUA</td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="ava_ASSEMBLY/HPW03">0</span></<td>
                            <td class="text-center" ><span id="perf_ASSEMBLY/HPW03">0</span></td>
                            <td class="text-center"><span id="qua_ASSEMBLY/HPW03">0</span></td>
                        </tr>
                    </thead>
                </table>
                <table class="table table-sm table-bordered" style="font-size:12px;font-weight:bold;margin-bottom:0rem">
                    <thead>
                        <tr>
                            <td class="bg-success text-center" >TotalRuningTime</<td>
                        </tr>
                        <tr>
                            <td class="text-center" ><span id="runtime_ASSEMBLY/HPW03">0</span></<td>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
         </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
<script>
    var mock = [
        {
            lineNumber : "INJECTION/MC01",
            oee:90,
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [90,100-90],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC02",
            oee:90,
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [40,100-40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC03",
            oee:90,
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC04",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC05",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC06",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC07",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC08",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC11",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "INJECTION/MC12",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 47
                }
            }
        },
        {
            lineNumber : "ASSEMBLY/HPW03",
            config : {
                type: 'doughnut',
                data: {
                    datasets: [{data: [(100-40),40],
                        backgroundColor: ['#8e1e29','#ee576f'],
                        offset: 0,
                        borderWidth:0
                    }]
                },
                options: {
                    cutout: 80
                }
            }
        }
    ]
</script>

<script>
  var charts = []
    for(let m of mock){
        var oee = "oee" + "_" + m.lineNumber
        if(m.oee != undefined){
            document.getElementById(oee).innerHTML = m.oee + "%"
        }else{
            document.getElementById(oee).innerHTML = "0%"
        }
        charts.push(new Chart(
        document.getElementById(m.lineNumber),
        m.config));
    }
</script>
<sctipt ></script>
<script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script><script>
    // var socket = io("http://103.214.112.156:3000/machines");

    var socket = io("127.0.0.1:3000/machines");

    const statusGreenColor = ['#1ba60b','#5dc150','#196110']
    const statusRedColor = ['#e52337','#f05871','#8f1d29']
    const statusGreyColor = ['#595959','#8b8b8b']

    const statusColor = ['#8b8b8b','#ee5770','#84cf9d']

    socket.on("kpi",(data)=>{
      console.log(data);
      for(chart of charts){
        var oee = "oee" + "_" + data[chart.id].lineNumber
        var ava = "ava" + "_" + data[chart.id].lineNumber
        var perf = "perf" + "_" + data[chart.id].lineNumber
        var qua = "qua" + "_" + data[chart.id].lineNumber
        var runtime = "runtime" + "_" + data[chart.id].lineNumber
        var cardHeader = "card_header_" + data[chart.id].lineNumber
        var cardBody = "card_body_" + data[chart.id].lineNumber
        var cardFooter = "card_footer_" + data[chart.id].lineNumber
        var status = data[chart.id].lineNumber + "_status";

        document.getElementById(oee).innerHTML = data[chart.id].oee + " %"
        document.getElementById(ava).innerHTML = data[chart.id].ava + " %"
        document.getElementById(perf).innerHTML = data[chart.id].perf +" %"
        document.getElementById(qua).innerHTML = data[chart.id].qua + " %"
        let hour = data[chart.id].runtime > 1 ? " hours" : " hour"
        document.getElementById(runtime).innerHTML = data[chart.id].runtime + hour

        chart.data.datasets.forEach((dataset) => {

            dataset.data = [data[chart.id].oee,100-data[chart.id].oee]

            if(data[chart.id].status == 0){
                document.getElementById(cardHeader).style.backgroundColor = statusGreyColor[1]
                document.getElementById(cardBody).style.backgroundColor = statusGreyColor[0]
                document.getElementById(cardFooter).style.backgroundColor = statusGreyColor[1]
                document.getElementById(status).innerHTML = "Stopped"

                dataset.backgroundColor = [statusGreyColor[1],statusGreyColor[1]]
                dataset.borderColor = statusGreyColor[1]


            }else if(data[chart.id].status == 1){
                document.getElementById(cardHeader).style.backgroundColor = statusGreenColor[1]
                document.getElementById(cardBody).style.backgroundColor = statusGreenColor[0]
                document.getElementById(cardFooter).style.backgroundColor = statusGreenColor[1]
                document.getElementById(status).innerHTML = "Running"

                dataset.backgroundColor = [statusGreenColor[2],statusGreenColor[1]]
                dataset.borderColor = statusGreenColor[1]
            }
        });

        console.log(Chart.element);

        chart.update()
      }

    })
</script>
<!-- <script>
        //
        var optionsoee = {
            series: [1,2],
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
                        size: '50%',
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

        const statusColor = {
            2 : '#1ca70f',
            1 : '#e40d2e',
            0 : '#565656'
        }

        var chartoee = new ApexCharts(document.querySelector("#chartoee"), optionsoee);
        chartoee.render();

        function getFeed1() {
            chartoee.updateSeries(
                [40,60]
           )
        }

        $(document).ready(function() {
          setInterval(getFeed1, 1000);
        });
    </script> -->

@endsection
