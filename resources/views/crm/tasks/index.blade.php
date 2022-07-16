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
                        <li class="breadcrumb-item active">Tasks</li>
                    </ol>
                </div>
                <h4 class="page-title">Tasks </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
       
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preference</h4> --}}
                    @include('crm.common.common_add_btn')

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="tasks-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th class="">Task</th>
                                    <th>Assigned To</th>
                                    <th>Assigned By</th>
                                    <th>Assigned Date</th>
                                    <th>Due Date</th>
                                    <th>Progress Status</th>
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
        
        const roletable = $('#tasks-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true, 
            "ajax"          : {
                "url"       : "<?= route( 'tasks.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>" }
            },
            "columns"       : [
                {"data" : "id"},
                {"data" : "task_name"},
                {"data" : "assigned_to"},
                {"data" : "assigned_by"},
                {"data" : "assigned_date"},
                {"data" : "due_date"},
                {"data" : "progress_status"},
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

    function complete_task(task_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are trying to complete the task',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var ajax_url = "{{ route('tasks.complete') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: { id:task_id},
                        success:function(response){
                            if(response.error.length > 0 && response.status == "1" ) {
                                Swal.fire( response.error, '', 'error')
                            } else {
                                Swal.fire('Updated!', '', 'success')
                                ReloadDataTableModal('tasks-datatable');
                            }
                        }      
                    });
                   
                } 
            })
            return false;
    }

    function change_act_status(task_id, status_id) {
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
                    var ajax_url = "{{ route('tasks.status') }}"
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: {task_id:task_id, status_id:status_id},
                        success:function(response){
                            if( response.status == "1" ) {
                                Swal.fire( response.error, '', 'error')
                            } else {
                                ReloadDataTableModal('tasks-datatable');
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