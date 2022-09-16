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
                        <div class="col-6">
                            <div class="row">
    
                                @csrf
                                <div class="col-3 mb-3">
                                    <label class="form-label">Date Range</label>
                                    <input type="text" autocomplete="off" class="form-control date" id="singledaterange" data-toggle="date-picker" data-cancel-class="btn-warning">
                                    <input type="hidden" name="search" id="search" value="">
                                </div>
                                
                                <div class="col-3 mt-1">
                                    <label for=""> </label>
                                    <a href="javascript:;" class="btn btn-primary btn-sm mt-3" onclick="return start_datatable('search')"> Generate Report </a>
                                </div>
                                <div class="col-3 mt-1">
                                    <a href="javascript:;" class="btn btn-secondary btn-sm mt-3" onclick="return clear_search()">Clear All</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-end mt-3">
                            <a href="javascript:;" onclick="return download_sales_excel()" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Excel </a>
                            <a href="javascript:;" onclick="return download_sales_pdf()" class="btn btn-danger btn-sm"> <i class="fa fa-download"></i> Pdf </a>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preferences</h4> --}}
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="reports-datatable">
                            <thead class="table-primary">
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Payment Mode</th>
                                    <th>Customer</th>
                                    <th>Deal</th>
                                    <th>Order Id</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Cheque No</th>
                                    <th>Cheque Date</th>
                                    <th>Reference No</th>
                                    <th>Payment Status</th>
                                    <th>Description</th>
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
            start_datatable();
        }

    function start_datatable(type='') {
        var date = $('#singledaterange').val();
        var search = $('#search').val();
        const roletable = $('#reports-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true,

            "ajax"          : {
                "url"       : "<?= route( 'reports.sales.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>", "date":date,"search":search }
            },
            "columns"       : [
                {"data" : "payment_date"},
                {"data" : "payment_mode"},
                {"data" : "customer"},
                {"data" : "deal" },
                {"data" : "order_id" },
                {"data" : "currency" },
                {"data" : "amount" },
                {"data" : "payment_method" },
                {"data" : "cheque_no" },
                {"data" : "cheque_date" },
                {"data" : "reference_no" },
                {"data" : "status" },
                {"data" : "description" },
            ],
            "bDestroy": true
        } );
    }

    $('#singledaterange').daterangepicker();
    $('#singledaterange').val('');
    function download_sales_excel() {
        var date = $('#singledaterange').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('reports.sales.download') }}",
            method:'POST',
            xhrFields: {
                responseType: 'blob',
            },
            data: {date:date},
            // dataType:'json',
            success:function(result, status, xhr){
                var disposition = xhr.getResponseHeader('content-disposition');
                var matches = /"([^"]*)"/.exec(disposition);
                var filename = (matches != null && matches[1] ? matches[1] : 'sales.xlsx');

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

    function download_sales_pdf() {
        var date = $('#singledaterange').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('reports.sales_pdf.download') }}",
            method:'POST',
            data: {date:date},
            xhrFields: {
                responseType: 'blob'
            },
            // dataType:'json',
            success:function(result){
                var blob = new Blob([result]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Sales.pdf";
                link.click();
                console.log(result);
            }
        })
        return false;
    }
    </script>
@endsection