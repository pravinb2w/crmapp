@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
                <h4 class="page-title">Invoice </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="invoice-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th> Invoice No </th>
                                    <th> Deal </th>
                                    <th> invoice Date </th>
                                    <th> Status </th>
                                    <th style="width: 80px;">Action</th>
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
    {{-- <script src="{{ asset('assets/js/pages/demo.deals.js') }}"></script> --}}
    <script>
        $(document).ready(function(){"use strict";
        
          const roletable = $('#invoice-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                "url"       : "<?= route( 'invoices.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>" }
            },
            "columns"       : [
                {"data" : "invoice_no"},
                {"data" : "deal"},
                {"data" : "invoice_date"},
                {"data" : "status" },
                {"data" : "action" },
            ],
            "pageLength": 25,
            order: [[0, 'desc']]
            
        } );
    });

    function ReloadDataTableModal(id) {
        var roletable = $('#'+id).DataTable();
        roletable.ajax.reload();
    }

    function view_invoice(id) {
        var ajax_url = "{{ route('invoices.view') }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {id:id},
            // dataType:'json',
            success:function(res){
                $('#Mymodal').html(res);
                $('#Mymodal').modal('show');
            }
        })
        return false;
        
    }

    </script>
@endsection