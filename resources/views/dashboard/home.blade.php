@extends('crm.layouts.template')

@section('content')
<style>
    .bar-select {
        position: absolute;
        right: 45px;
        top: 20px;
        width: 100px;
        border: none;
        color: #10b9f1;
        border-bottom: 1px solid;
    }

    .task-pane {
        height: 323px;
        overflow: auto;
    }

        /* width */
    .task-pane::-webkit-scrollbar {
        width: 3px;
    }

    /* Track */
    .task-pane::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }
    
    /* Handle */
    .task-pane::-webkit-scrollbar-thumb {
    background: rgb(89, 198, 202); 
    }

    /* Handle on hover */
    .task-pane::-webkit-scrollbar-thumb:hover {
    background: #555; 
    }
</style>
<div class="container-fluid">
                        
    <!-- start page title --> 
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Phoenix</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">CRM</li>
                    </ol>
                </div>
                <h4 class="page-title">CRM</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    {{-- <button class="btn btn-primary" type="submit">.ripple</button> --}}

    <div class="row">
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Open Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Today Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Closed Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Planed Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row --> 
    <!-- end row-->
    @include('dashboard.drag._dragula')
</div> 
<div class="container-fluid"> 
    <div class="row m-0">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5"><i class="uil-usd-circle uil"></i> Deals Started</h3>
                    <div>
                        <small class="muted">This Year</small>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart" style="width:100%;max-width:100%"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5"><i class="uil-usd-circle uil"></i> Deals lost by resions</h3>
                    <div>
                        <small class="muted">This Year</small>
                    </div>
                </div>
                <div class="card-body p-0" style="overflow: hidden">
                    <div id="myChart-pie" style="width:100%;height:300px;transform:scale(1.1)"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5"><i class="uil-usd-circle uil"></i> Deals Won over time</h3>
                    <div>
                        <small class="muted">This Year</small>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart-deals-won" style="width:100%;max-width:100%"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5"><i class="uil-usd-circle uil"></i> Deals progress</h3>
                    <div>
                        <small class="muted">This Year</small>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart-deals-progress" style="width:100%;max-width:100%"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="h5"><i class="uil-usd-circle uil"></i> Deals Conversion</h3>
                    <div>
                        <small class="muted">This Year</small>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart-deals-conversion" style="width:100%;max-width:100%"></canvas>
                </div>
            </div>
        </div>
    </div>    
</div> 
@endsection

@section('add_on_script')
    <script src="{{ asset('assets/js/vendor/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.dragula.js') }}"></script>

    <!-- third party:js -->
    <script src="assets/js/vendor/apexcharts.min.js"></script>
    <!-- third party end -->
    <!-- demo:js -->
    <script>
        var colors=["#727cf5","#0acf97","#fa5c7c"],dataColors=$("#basic-column").data("colors");
        dataColors&&(colors=dataColors.split(","));
        var options={chart:{height:250,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!1,endingShape:"rounded",columnWidth:"55%"}},dataLabels:{enabled:!1},stroke:{show:!0,width:2,colors:["transparent"]},colors:colors,series:[{name:"Tasks",data:[44,55,57,56,61,58,63,60,66]},{name:"Leads",data:[76,85,101,98,87,105,91,114,94]},{name:"Deals",data:[35,41,36,26,45,48,52,53,41]}],xaxis:{categories:["Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct"]},legend:{offsetY:7},yaxis:{title:{text:"Count"}},fill:{opacity:1},grid:{row:{colors:["transparent","transparent"],opacity:.2},borderColor:"#f1f3fa",padding:{bottom:5}},tooltip:{y:{formatter:function(o){return"$ "+o+" thousands"}}}},chart=new ApexCharts(document.querySelector("#basic-column"),options);
        chart.render();
    

    !function(o){"use strict";
    function e(){this.$body=o("body"),this.charts=[]}e.prototype.initCharts=function(){window.Apex={chart:{parentHeightOffset:0,toolbar:{show:!1}},grid:{padding:{left:0,right:0}},colors:["#727cf5","#0acf97","#fa5c7c","#ffbc00"]};
    var e=["#727cf5","#0acf97","#fa5c7c","#ffbc00"],t=o("#revenue-chart").data("colors");
    t&&(e=t.split(","));
    var r={chart:{height:364,type:"line",dropShadow:{enabled:!0,opacity:.2,blur:7,left:-7,top:7}},dataLabels:{enabled:!1},stroke:{curve:"smooth",width:4},series:[{name:"Current Week",data:[10,20,15,25,20,30,20]},{name:"Previous Week",data:[0,15,10,30,15,35,25]}],colors:e,zoom:{enabled:!1},legend:{show:!1},xaxis:{type:"string",categories:["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],tooltip:{enabled:!1},axisBorder:{show:!1}},yaxis:{labels:{formatter:function(e){return e+"k"},offsetX:-15}}};
    new ApexCharts(document.querySelector("#revenue-chart"),r).render();
    var e=["#727cf5","#e3eaef"];
    (t=o("#high-performing-product").data("colors"))&&(e=t.split(","));
    var r={
        chart:{height:257,type:"bar",stacked:!0},
        plotOptions:{bar:{horizontal:!1,columnWidth:"20%"}},
        dataLabels:{enabled:!1},
        stroke:{show:!0,width:2,colors:["transparent"]},
        series:[{name:"Done",data:[65,59,80,81,56,89,40,32,65,59,80,81]},{name:"Planned",data:[89,40,32,65,59,80,81,56,89,40,65,59]}],
        zoom:{enabled:!1},
        legend:{show:!1},
        colors:e,
        xaxis:{categories:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],axisBorder:{show:!1}},
        yaxis:{labels:{formatter:function(e){return e+"k"},offsetX:-15}},
        fill:{opacity:1},
        tooltip:{y:{formatter:function(e){return"$"+e+"k"}}}
    };
    new ApexCharts(document.querySelector("#high-performing-product"),r).render();
    
    },e.prototype.init=function(){o("#dash-daterange").daterangepicker({singleDatePicker:!0}),this.initCharts(),this.initMaps()},o.Dashboard=new e,o.Dashboard.Constructor=e
}
    
    (window.jQuery),function(t){"use strict";
    t(document).ready(function(e){t.Dashboard.init()})
}(window.jQuery);

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
   function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  alert('stete');
}

</script>
<script>
    //   Deals Started
    var xValues = ["0", "1", "2", "3", "4"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = ["#10B9F1", "lightgray","#10B9F1","lightgray","#10B9F1"];
 
    //  Deals Wond
    var DWxValues = [
        "JAN",
        "FEB",
        "MAR",
        "APRL",
        "MAY",
        "JUN",
        "JUL",
        "AUG",
        "SEP",
        "OCT",
        "NOV",
        "DEC"
    ];
    var DWyValues = [22,45,87,22,44,99,44,35,15,99,20,70];
    var DWbarColors = ["#10B9F1", "lightgray","#10B9F1","lightgray","#10B9F1", "lightgray","#10B9F1","lightgray","#10B9F1", "lightgray","#10B9F1","lightgray"];


    
    new Chart("myChart", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {display: false}, 
      }
    });
    new Chart("myChart-deals-won", {
      type: "bar",
      data: {
        labels: DWxValues,
        datasets: [{
          backgroundColor: DWbarColors,
          data: DWyValues
        }]
      },
      options: {
        legend: {display: false}, 
      }
    });
    new Chart("myChart-deals-progress", {
      type: "bar",
      data: {
        labels: DWxValues,
        datasets: [{
          backgroundColor: DWbarColors,
          data: DWyValues
        }]
      },
      options: {
        legend: {display: false}, 
      }
    });
    new Chart("myChart-deals-conversion", {
      type: "bar",
      data: {
        labels: DWxValues,
        datasets: [{
          backgroundColor: DWbarColors,
          data: DWyValues
        }]
      },
      options: {
        legend: {display: false}, 
      }
    });
</script>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Contry', 'Mhl'],
      ['Italy',54.8],
      ['France',48.6],
      ['Spain',44.4],
      ['USA',23.9],
      ['Argentina',14.5]
    ]); 
    
    var chart = new google.visualization.PieChart(document.getElementById('myChart-pie'));
      chart.draw(data);
    }
    </script>
@endsection