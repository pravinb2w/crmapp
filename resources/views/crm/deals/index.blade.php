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
                        <li class="breadcrumb-item active">Deals</li>
                    </ol>
                </div>
                <h4 class="page-title">Deals </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a href="{{ route('create-deal') }}" class="btn btn-secondary mb-2" >
                                <i class="mdi mdi-plus-circle me-2"></i> Add Deal
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="text-sm-end"> 
                            </div>
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>Conact Person</th>
                                    <th>Organization</th>
                                    <th>Phone </th>
                                    <th>email</th>
                                    <th style="width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($key=0; $key<5; $key++)
                                    <tr>
                                        <td></td>
                                        <td>Mr. alan</td>
                                        <td>Alan group of company</td>
                                        <td>9874584125</td>
                                        <td>alan@gmail.com</td>
                                        <td><a href="{{ route('view-deal') }}" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"  > <i class="mdi mdi-square-edit-outline"></i></a>
                                            <a href="javascript:void(0);" class="action-icon"  > <i class="mdi mdi-delete"></i></a></td>
                                    </tr>
                                @endfor
                            </tbody>
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
        
        const roletable = $('#products-datatable').DataTable();
          // const roletable = $('#products-datatable').DataTable( {
            
        //     "processing"    : true,
        //     "serverSide"    : true,
        //     "ajax"          : {
        //         "url"       : "<?= route( 'products.list' ); ?>",
        //         "dataType"  : "json",
        //         "type"      : "POST",
        //         "data"      : { "_token" : "<?=csrf_token();?>" }
        //     },
        //     "columns"       : [
        //         {"data" : "id"},
        //         {"data" : "product_name"},
        //         {"data" : "product_code"},
        //         {"data" : "added"},
        //         {"data" : "status" },
        //         {"data" : "action" },
        //     ],
            
        // } );
    });

    function ReloadDataTableModal(id) {
        var roletable = $('#'+id).DataTable();
        roletable.ajax.reload();
    }

    </script>
@endsection