@extends('crm.layouts.template')

@section('content')
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .CodeMirror, .editor-toolbar, #notes {
        background: rgb(255, 252, 220);
    }
    .notes-pane {
        position: absolute;
        bottom: 46px;
        right: 8px;
        z-index: 9;
    }
/* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + i {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + i {
  outline: 2px solid #10b9f1;
}

form#activites-form>div>label>i {
    padding: 5px;
    border: 0.5px solid #ddd;
    font-size: 20px;
}
#activites-form {
    padding:15px;
}
.timeinput {
    display: inline-flex;
    width: 100%;
}
.timeinput > span {
    padding: 10px;
}
.w-35 {
    width: 35% !important;
}
.w-80 {
    width: 80% !important;
}

.timeline-item-left>.timeline-desk>.timeline-box {
    background: rgb(255, 252, 220);
}
.history-dropdown {
    position: absolute;
    right: 0;
    top: 0;
}
</style>
<style>
    .loader{
    position: absolute;
    top:0px;
    right:0px;
    border: 10px solid #f3f3f3; /* Light grey */
    border-top: 10px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 75px;
    height: 75px;
    animation: spin 0.5s linear infinite;
    background-position:center;
    z-index:10000000;
    opacity: 0.4;
    filter: alpha(opacity=40);
    left: 50%;
    top: 30%;
    display: none;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Leads </li>
                    </ol>
                </div>
                <h4 class="page-title">Lead Info</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-12">
                            <div class="row card px-4 mb-3">
                                <div class="col-12">
                                    @include('crm.lead._info')
                                </div>
                            </div>
                        </div>
                        <div class="col-12"> 
                            <div class="card shadow-sm">
                                <ul class="nav nav-pills bg-nav-pills nav-justified custom">
                                    @if( isset( $info->status ) && $info->status != 2 )

                                        @if( (Auth::user()->hasAccess('leads', 'is_edit') && ( Auth::id() == $info->assigned_to || $info->assigned_to == null ) ) || superadmin() )
                                        <li class="nav-item">
                                            <a href="#Notes" data-bs-toggle="tab" data-id="note" aria-expanded="false" class="nav-link rounded-0 active lead-tab">
                                                <i class="uil uil-pen"></i>
                                                <span>Notes</span>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#Activity" data-bs-toggle="tab" data-id="activity" aria-expanded="true" class="nav-link rounded-0 lead-tab">
                                                <i class="uil uil-user"></i>
                                                <span >Activity</span>
                                            </a>
                                        </li>  
                                        @endif
                                    @endif
                                    <li class="nav-item">
                                        <a href="#History" data-bs-toggle="tab" data-id="history" aria-expanded="true" class="nav-link rounded-0 lead-tab">
                                            <i class="uil uil-envelope-alt"></i>
                                            <span>History</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content p-3">
                                    <div class="tab-pane active" id="leadstab" >
                                        @if( ( Auth::user()->hasAccess('leads', 'is_edit') && ( Auth::id() == $info->assigned_to || $info->assigned_to == null )) || superadmin() )
                                        @include('crm.lead._note_form')
                                        @else
                                        @include('crm.lead._history_form')
                                        @endif
                                    </div>
                                    <div class="loader"></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
            {{-- <div class="card">
                <div class="card-body" id="lead_timeline">
                    @include('crm.lead._timeline')
                </div>
            </div> --}}
        </div>
    </div> 
</div>

      
<script>
    function get_tab(tab, lead_id){
        var ajax_url = "{{ route('leads.get_tab') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {lead_id:lead_id, tab:tab},
            beforeSend:function(){
                $('.loader').show();
            },
            success:function(response){
               $('#leadstab').html(response);
               $('.loader').hide();
            }      
        });
    }
    $('.lead-tab').click(function(){
        var tab = $(this).attr('data-id');
        var lead_id = '{{ $id }}';
        get_tab(tab, lead_id);
    })

    function insert_notes() {
       
        var form_data = $('#lead-insert-notes').serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('leads.save-notes') }}",
            type: 'POST',
            data: form_data,
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('.loader').hide();
                if(response.error.length > 0 && response.status == "1" ) {
                    toastr.error('Errors', response.error );
                } else {
                    $('#notes').val('');
                    toastr.success('Success', response.error );
                }
            }            
        });
    }

    function change_activity_status( lead_id, activity_id, lead_type = '' ) {
        var ttt = 'You are trying to delete activity';

        Swal.fire({
            title: 'Are you sure?',
            text: ttt,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var ajax_url = "{{ route('leads.activity-delete') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: ajax_url,
                        method:'POST',
                        data: {lead_id:lead_id, activity_id:activity_id, lead_type:lead_type},
                        success:function(response){
                            if(response.lead_id ) {
                                get_tab('history',response.lead_id);
                            }
                        }      
                    });
                    Swal.fire('Updated!', '', 'success')
                } 
            })
            return false;
    }
</script>
<!-- SimpleMDE js -->
@endsection


 