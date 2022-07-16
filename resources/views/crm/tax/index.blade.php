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
                        <li class="breadcrumb-item active">Tax Group</li>
                    </ol>
                </div>
                <h4 class="page-title">Settings </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-2">
            <div>
                @include('crm.layouts.setup_menu')             
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preference</h4> --}}
                    @include('crm.common.common_add_btn')

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="tax-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="all">Tax Group</th>
                                    <th>Status</th>
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
    {{-- <script src="{{ asset('assets/js/pages/demo.products.js') }}"></script> --}}
    <script>
        $(document).ready(function(){"use strict";
        
        const roletable = $('#tax-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                "url"       : "<?= route( 'tax.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>" }
            },
            "columns"       : [
                {"data" : "id"},
                {"data" : "tax"},
                {"data" : "status" },
                {"data" : "action" },
            ],
            "pageLength":25,
            
        } );
    });

    function ReloadDataTableModal(id) {
        var roletable = $('#'+id).DataTable();
        roletable.ajax.reload();
    }

    </script>
@endsection