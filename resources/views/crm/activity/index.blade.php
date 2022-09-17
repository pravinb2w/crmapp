@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
    <style>
        .status-dropdown {
            border-color: #ddd;
            background: aliceblue;
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
                        <li class="breadcrumb-item active">Activity</li>
                    </ol>
                </div>
                <h4 class="page-title"> Activity </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preferences</h4> --}}
                    @include('crm.common.common_add_btn')

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="activities-datatable">
                            <thead class="table-primary">
                                <tr>
                                    {{-- <th> Subject </th> --}}
                                    <th> Type </th>
                                    <th >Lead / Deal</th>
                                    <th > Customer </th>
                                    <th > Start Date</th>
                                    <th >Due</th>
                                    <th> Progress Status</th>
                                    <th> Assigned To </th>
                                    <th> Assigned By </th>
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
        
        const roletable = $('#activities-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                "url"       : "<?= route( 'activities.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>" }
            },
            "columns"       : [
                // {"data" : "subject"},
                {"data" : "type"},
                {"data" : "lead"},
                {"data" : "customer"},
                {"data" : "startAt"},
                {"data" : "dueAt"},
                {"data" : "done"},
                {"data" : "assigned_to"},
                {"data" : "assigned_by"},
                {"data" : "status" },
                {"data" : "action" },
            ],
            "pageLength":25,
            columnDefs: [
                { orderable: false, targets: -1 }
            ]
                            
        } );
    });

    function ReloadDataTableModal(id) {
        var roletable = $('#'+id).DataTable();
        roletable.ajax.reload();
    }

    function change_act_status(activity_id, status_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You try to change status!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var ajax_url = "{{ route('activities.status') }}"
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: {activity_id:activity_id, status_id:status_id},
                        success:function(response){
                            if( response.status == "1" ) {
                                Swal.fire( response.error, '', 'error')
                            } else {
                                ReloadDataTableModal('activities-datatable');
                                Swal.fire('Changed!', '', 'success')
                            }
                        }      
                    });
                } 
            })
            return false;
    }

    </script>
@endsection