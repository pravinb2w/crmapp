@extends('crm.layouts.template')

@section('content')
<div class="container-fluid"> 
    <!-- start page title --> 
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Phoenix</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">DEALS</li>
                    </ol>
                </div>
                <h4 class="page-title">CRM</h4>
            </div>
        </div>
    </div>  
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    var DWyValues = [0,0,0,0,0,0,0,0,0,0,0,0];
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