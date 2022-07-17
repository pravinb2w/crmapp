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
                        <li class="breadcrumb-item active">Announcement</li>
                    </ol>
                </div>
                <h4 class="page-title">Announcement </h4>
            </div>
        </div>
    </div>     
    <div class="card">
        <div class="card-header text-end bg-light">
            <a href="{{ route("create.announcement") }}" class="btn btn-primary">New Announcement</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered w-100 dt-responsive nowrap" id="announcement-datatable">
                    <thead class="table-light">
                        <tr>
                            <th class="all">Subject</th>
                            <th>Page</th>
                            <th> Message </th>
                            <th style="width: 80px;">Action</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
        
    </div>
</div>
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.checkboxes.min.js') }}"></script>
    <script>
        $(document).ready(function(){"use strict";
        
        const roletable = $('#announcement-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true,
            "ajax"          : {
                "url"       : "<?= route( 'announcement.list' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>" }
            },
            "columns"       : [
                {"data" : "subject"},
                {"data" : "page"},
                {"data" : "message" },
                {"data" : "action" },
            ],
            "pageLength":25,
            
        } );
    });

    function ReloadDataTableModal(id) {
        var roletable = $('#'+id).DataTable();
        roletable.ajax.reload();
    }

    function announce_delete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                   
                    var ajax_url = "{{ route('destroy.announcement') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: {id:id},
                        success:function(response){
                            if( response.status == "1" ) {
                                Swal.fire( response.error, '', 'error')
                            } else {
                                $('#error').addClass('alert alert-success');
                                response.error.forEach(display_errors);
                                    window.location.href = "{{ route('announcement.index') }}";
                                Swal.fire('Deleted!', '', 'success')
                            }
                        }      
                    });
                    
                } 
            })
            return false;
    }

    </script>
@endsection