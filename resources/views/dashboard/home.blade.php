@extends('crm.layouts.template')

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <style>
        .mdi-drag {
            cursor: move;
            font-size: 18px
        }

        #sortable .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px 10px !important
        }

        #sortable .card-header .header-title {
            margin: 0 !important
        }

        #sortable li {
            list-style: none !important;
            padding:  !important
        }

        .bar-select {
            border: 1px solid lightgray !important;
            outline: none !important;
            margin-right: 10px
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
                            <h3 class="mt-0">{{ $open_task ?? 0 }}</h3>
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
                            <h3 class="mt-0">{{ $today_count ?? 0 }}</h3>
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
                            <h3 class="mt-0">{{ $closed_count ?? '' }}</h3>
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
                            <h3 class="mt-0">{{ $planned_count ?? 0 }}</h3>
                            <h5 class="m-0 text-dark" title="Total Tasks">Planned Tasks</h5>
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
    @php
    $enc = json_encode($close_week);
    $done = json_encode($planned_done);
    $conversion = json_encode($conversion);
    $overall_collection = json_encode($overall_collection);
    $deal_progress = json_encode($deal_progress);

    @endphp
@endsection

@section('add_on_script')
    <script src="{{ asset('assets/js/vendor/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.dragula.js') }}"></script>

    <!-- third party:js -->
    <script src="{{ asset('assets/js/vendor/apexcharts.min.js') }}"></script>
    <!-- third party end -->
    <!-- demo:js -->
    <script>
        var cweek = '<?= $enc ?>';
        var cdone = '<?= $done ?>';
        var conversion = '<?= $conversion ?>';
        var deal_progress = '<?= $deal_progress ?>';
        cweek = JSON.parse(cweek);
        cdone = JSON.parse(cdone);
        var colors = ["#727cf5", "#0acf97", "#fa5c7c"],
            dataColors = $("#basic-column").data("colors");
        dataColors && (colors = dataColors.split(","));
        var options = {
                chart: {
                    height: 250,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        endingShape: "rounded",
                        columnWidth: "55%"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    colors: ["transparent"]
                },
                colors: colors,
                series: [{
                        name: "Tasks",
                        data: cweek.task
                    },
                    {
                        name: "Leads",
                        data: cweek.lead
                    },
                    {
                        name: "Deals",
                        data: cweek.deal
                    }
                ],
                xaxis: {
                    categories: cweek.month
                },
                legend: {
                    offsetY: 7
                },
                yaxis: {
                    title: {
                        text: "Count"
                    }
                },
                fill: {
                    opacity: 1
                },
                grid: {
                    row: {
                        colors: ["transparent", "transparent"],
                        opacity: .2
                    },
                    borderColor: "#f1f3fa",
                    padding: {
                        bottom: 5
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(o) {
                            return o
                        }
                    }
                }
            },
            chart = new ApexCharts(document.querySelector("#basic-column"), options);
        chart.render();
        // 
        $('#close_week_type').change(function() {
            var close_week_type = $('#close_week_type').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('get-closeweek-data', $companyCode) }}",
                method: 'POST',
                data: {
                    close_week_type: close_week_type
                },
                success: function(response) {
                    chart.updateSeries([{
                        name: 'Tasks',
                        data: response.task
                    }, {
                        name: 'Leads',
                        data: response.lead
                    }, {
                        name: 'Deals',
                        data: response.deal
                    }])
                }
            });
        });

        $('#from_type').change(function() {
            var from_type = $('#from_type').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('get-planned-data', $companyCode) }}",
                method: 'POST',
                data: {
                    from_type: from_type
                },
                success: function(response) {
                    $('#planned_done').html(response);
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $("#sortable").sortable({
                update: function(event, ui) {
                    let $lis = $(this).children('li');
                    let sortableOrder = [];
                    let columnClass = [];
                    $lis.each(function() {
                        var $li = $(this).attr('id');
                        var $class = ($(this).hasClass('col-12')) ? "col-12" : "col-6";
                        sortableOrder.push($li);
                        columnClass.push($class)
                    });
                    $.post('{{ route('save.dashboard_position', $companyCode) }}', {
                        data: [sortableOrder, columnClass]
                    })
                }
            });
        });

        function change_view_length(prams) {
            $(`#${prams}`).toggleClass("col-12")
        }
    </script>
    <script>
        cconversion = JSON.parse(conversion);
        progreass = JSON.parse(deal_progress);
        //   Deals Started
        var xValues = cconversion.month;
        var yValues = cconversion.started;
        var barColors = ["#10B9F1", "lightgray", "#10B9F1", "lightgray", "#10B9F1", "lightgray", "#10B9F1", "lightgray",
            "#10B9F1", "lightgray", "#10B9F1", "lightgray"
        ];

        //  Deals Wond
        var DealConversionXvalues = cconversion.month
        var DealConversinYvalues = progreass.yvalues;
        var DWbarColors = ["#10B9F1", "lightgray", "#10B9F1", "lightgray", "#10B9F1", "lightgray", "#10B9F1", "lightgray",
            "#10B9F1", "lightgray", "#10B9F1", "lightgray"
        ];

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
                legend: {
                    display: false
                },
            }
        });

        new Chart("myChart-deals-won", {
            type: "bar",
            data: {
                labels: cconversion.month,
                datasets: [{
                    backgroundColor: DWbarColors,
                    data: cconversion.won
                }]
            },
            options: {
                legend: {
                    display: false
                },
            }
        });

        var progressData = new Chart("myChart-deals-progress", {
            type: "bar",
            data: {
                labels: DealConversionXvalues,
                datasets: [{
                    backgroundColor: DWbarColors,
                    data: DealConversinYvalues
                }]
            },
            options: {
                legend: {
                    display: false
                },
            }
        });

        $('#deal_stages').change(function() {
            var deal_stages = $('#deal_stages').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('get-dealProgress-data', $companyCode) }}",
                method: 'POST',
                data: {
                    deal_stages: deal_stages
                },
                success: function(response) {
                    console.log(response.yvalues);
                    progressData.data.datasets[0].data = response.yvalues;
                    progressData.update();

                }
            });
        });

        new Chart("myChart-deals-conversion", {
            type: "bar",
            data: {
                labels: cconversion.month,
                datasets: [{
                    backgroundColor: DWbarColors,
                    data: cconversion.conversion
                }]
            },
            options: {
                legend: {
                    display: false
                },
            }
        });
    </script>
    <script>
        var overall_collection = '<?= $overall_collection ?>';
        overall_collection = JSON.parse(overall_collection);

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Collection', 'Mhl'],
                ['Deal', overall_collection.deal],
                ['Lead', overall_collection.lead],
                ['Task', overall_collection.task],

            ]);

            var chart = new google.visualization.PieChart(document.getElementById('myChart-pie'));
            chart.draw(data);
        }
    </script>
@endsection
