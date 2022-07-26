@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
    <style>
        .calendar-table .table-condensed thead, tbody, tfoot, tr, td, th {
            padding: 0px;
        }
    </style>           
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $title }} </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body bg-light">
                    <div class="row">
                        <div class="col-12">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success mt-2">{{ Session::get('success') }} 
                                </div>
                            @endif
                        </div>
                        <div class="col-9">
                            <div class="row">
    
                                @csrf
                                <div class="col-3 mb-3">
                                    <label class="form-label">Date Range</label>
                                    <input type="text" autocomplete="off" class="form-control date" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning">
                                    <input type="hidden" name="search" id="search" value="">
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="form-label"> Type</label>
                                    <select name="task_type" id="task_type" class="form-control mt-2">
                                        <option value="">--select--</option>
                                        <option value="activity">Activity</option>
                                        <option value="task">Task</option>
                                    </select>
                                </div>

                                <div class="col-2 mb-3">
                                    <label for="form-label"> Planned or Done </label>
                                    <select name="planned_done" id="planned_done" class="form-control mt-2">
                                        <option value="">--select--</option>
                                        <option value="planned">Planned</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                                
                                <div class="col-2 mt-3">
                                    <label for=""> </label>
                                    <a href="javascript:;" class="btn btn-primary btn-sm mt-1" onclick="return start_datatable('search')"> Generate Report </a>
                                </div>
                                <div class="col-1 mt-1">
                                    <a href="javascript:;" class="btn btn-secondary btn-sm mt-3" onclick="return clear_search()">Clear</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 text-end mt-3">
                            <a href="javascript:;" onclick="return download_planned_excel()" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Excel </a>
                            <a href="javascript:;" onclick="return download_planned_pdf()" class="btn btn-danger btn-sm"> <i class="fa fa-download"></i> Pdf </a>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preferences</h4> --}}
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="reports-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>Title </th>
                                    <th>Type</th>
                                    <th>Customer</th>
                                    <th>User</th>
                                    <th>Lead / Deal </th>
                                    <th>Assigned Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
               
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div>
</div>
@endsection
@section('add_on_script')
<!-- third party js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.checkboxes.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/pages/demo.products.js') }}"></script> --}}
    <script>
        $(document).ready(function(){"use strict";
            start_datatable();
        });
    
        function clear_search() {
            $('#singledaterange').val('');
            var task_type = $('#task_type').val('');
            var planned_done = $('#planned_done').val('');
            start_datatable();
        }

    function start_datatable(type='') {
        var date = $('#singledaterange').val();
        var search = $('#search').val();
        var task_type = $('#task_type').val();
        var planned_done = $('#planned_done').val();

        const roletable = $('#reports-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true,

            "ajax"          : {
                "url"       : "<?= route( 'reports.planned.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>", "date":date,"search":search, "task_type":task_type, "planned_done":planned_done }
            },
            "columns"       : [
                {"data" : "title"},
                {"data" : "type"},
                {"data" : "customer"},
                {"data" : "user" },
                {"data" : "lead_deal" },
                {"data" : "assigned_date" },
                {"data" : "status" },
            ],
            "bDestroy": true,
            "pageLength": 100
        } );
    }

    $('#singledaterange').daterangepicker();
    $('#singledaterange').val('');
    function download_planned_excel() {
        var date = $('#singledaterange').val();
        var task_type = $('#task_type').val();
        var planned_done = $('#planned_done').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('reports.planned.download') }}",
            method:'POST',
            xhrFields: {
                responseType: 'blob',
            },
            data: {date:date,task_type:task_type,planned_done:planned_done},
            // dataType:'json',
            success:function(result, status, xhr){
                var disposition = xhr.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : 'planedvsdone.xlsx');

                // The actual download
                var blob = new Blob([result], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;

                document.body.appendChild(link);

                link.click();
                document.body.removeChild(link);
            }
        })
        return false;
    }

    function download_planned_pdf() {
        var date = $('#singledaterange').val();
        var task_type = $('#task_type').val();
        var planned_done = $('#planned_done').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('reports.planned_pdf.download') }}",
            method:'POST',
            data: {date:date,type:task_type,status:planned_done},
            xhrFields: {
                responseType: 'blob'
            },
            // dataType:'json',
            success:function(result){
                var blob = new Blob([result]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "plannedvsdone.pdf";
                link.click();
            }
        })
        return false;
    }
    </script>
@endsection