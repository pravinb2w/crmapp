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
                        <li class="breadcrumb-item active">Activiy Logs</li>
                    </ol>
                </div>
                <h4 class="page-title">Activiy Logs </h4>
            </div>
        </div>
    </div>     
    <div class="card">
        {{-- <div class="card-header text-end bg-light">
            <a href="{{ route("create.announcement") }}" class="btn btn-danger">Clear Logs</a>
        </div> --}}
        <div class="card-body">
            
            <table class="table table-centered w-100" id="log-datatable">
                <thead class="table-light">
                    <tr>
                        <th>Log Date</th>
                        <th>Logged By</th>
                        <th>Operation</th>
                        <th>Module</th>
                        <th>Old Values</th>
                        <th>New Values</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="card-footer bg-light">
            
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.checkboxes.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/pages/demo.products.js') }}"></script> --}}
<script>
    $(document).ready(function(){"use strict";
    
    const roletable = $('#log-datatable').DataTable( {
            
            "processing"    : true,
            "serverSide"    : true, 
            "ajax"          : {
                "url"       : "<?= route( 'activity_log.log' ); ?>",
                "dataType"  : "json",
                "type"      : "POST",
                "data"      : { "_token" : "<?=csrf_token();?>" }
            },
            "columns"       : [
                {"data" : "log_date"},
                {"data" : "logged_by"},
                {"data" : "operation"},
                {"data" : "module"},
                {"data" : "old_values"},
                {"data" : "new_values" },
                {'data' : "action"}
            ],
            
        } );
    });

    function ReloadDataTableModal(id) {
        var roletable = $('#'+id).DataTable();
        roletable.ajax.reload();
    }

    function get_log_view(log_id){
        var ajax_url = "{{ route('activity_log.view') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {log_id:log_id},
            success:function(res){
                $('#Mymodal').html(res);
                $('#Mymodal').modal('show');
            }
        })
        return false;
    }
</script>
@endsection