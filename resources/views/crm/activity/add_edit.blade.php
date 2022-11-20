<div class="modal-dialog modal-lg modal-right">
    <form id="activites-form" method="POST" action="{{ route('activities.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
            <div class="row m-0">
                <div class="col-12" id="error">
                </div>
            </div> 
            <style>
                @media (min-width: 992px) {
                    .modal-right .modal-body {
                        margin: 0rem auto;
                        max-height: 110vh !important;
                    }
                }

                /* width */
                .modal-right .modal-body::-webkit-scrollbar {
                    width: 4px;
                }

                /* Track */
                .modal-right .modal-body::-webkit-scrollbar-track {
                background: #f1f1f1; 
                }
                
                /* Handle */
                .modal-right .modal-body::-webkit-scrollbar-thumb {
                background: #00bfff3b; 
                }

                /* Handle on hover */
                .modal-right .modal-body::-webkit-scrollbar-thumb:hover {
                background: rgb(0, 149, 255); 
                }
            </style>
            <div class="p-3" >
                <div class="w-100" id="activitiy-icon">
                    <label for="">Title</label>
                    <div class="form-group">
                        <input type="text" name="activity_title" value="{{ $info->subject ?? '' }}" id="activity_title" placeholder="CALL" class="form-control" required>
                    </div>
                    <div class="btn-group mt-3">
                        <label>
                            <input type="radio" class="activity-title" name="activity_type" value="call" @if(isset($info->activity_type) && $info->activity_type == 'call') checked @endif>
                            <i class="btn btn-light px-2 mx-1 dripicons-phone" title="Call"></i>
                        </label>
                        
                        <label>
                            <input type="radio" class="activity-title" name="activity_type" value="meeting" @if(isset($info->activity_type) && $info->activity_type == 'meeting') checked @endif>
                            <i class="btn btn-light px-2 mx-1 dripicons-user-group" title="Meeting"></i>
                        </label>
                        <label>
                            <input type="radio" class="activity-title" name="activity_type" value="deadline" @if(isset($info->activity_type) && $info->activity_type == 'deadline') checked @endif>
                            <i class="btn btn-light px-2 mx-1 dripicons-flag" title="Deadline"></i>
                        </label>
                        <label>
                            <input type="radio" class="activity-title"  name="activity_type" value="task" @if(isset($info->activity_type) && $info->activity_type == 'task') checked @endif>
                            <i class="btn btn-light px-2 mx-1 dripicons-time-reverse" title="Task"></i>
                        </label>
                        <label>
                            <input type="radio" class="activity-title"  name="activity_type" value="email" @if(isset($info->activity_type) && $info->activity_type == 'email') checked @endif>
                            <i class="btn btn-light px-2 mx-1 dripicons-mail" title="Email"></i>
                        </label>
                        <label>
                            <input type="radio" class="activity-title"  name="activity_type" value="lunch" @if(isset($info->activity_type) && $info->activity_type == 'lunch') checked @endif>
                            <i class="btn btn-light px-2 mx-1 mdi mdi-food" title="Lunch"></i>
                        </label>
                    </div> 
                    <div class="form-group mt-3 timeinput">
                        {{-- ------------- --}}
                            <span><i class="dripicons-time-reverse"></i></span>
                            <input type="text" required name="start_date" id="start_date" class="form-control datepicker" value="<?= isset($info->started_at) ? date('d-m-Y', strtotime($info->started_at)): date('M d,Y')?>">
                            <input type="time" name="start_time" id="start_time" class="form-control" value="<?= isset($info->started_at) ? date('h:i', strtotime($info->started_at)) : ''?>" required>
                        {{-- ------------- --}}
                            <span><i class="dripicons-time-reverse"></i></span>
                            <input type="time" name="due_time" id="due_time" class="form-control" value="<?= isset($info->due_at) ? date('h:i', strtotime($info->due_at)) : ''?>" required readonly>
                            <input type="text" required name="due_date" id="due_date" class="form-control datepicker" value="<?= isset($info->due_at) ? date('d-m-Y', strtotime($info->due_at)): date('M d,Y')?>">
                        {{-- ------------- --}}
                    </div>
                    
                    {{-- if user login only then hide user dropdown, show only admin login --}}
                    @if(Auth::user()->hasAccess('activities', 'is_assign'))
                    <div class="form-group mt-3">
                        <span><i class="dripicons-user"></i></span>
                            <label for=""> User </label>
                        <select name="user_id" id="user_id" class="form-control">
                            <option value="" >--select User -- </option>

                            @if( isset($users) && !empty($users))
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}" @if( isset($info->user_id) && $info->user_id == $item->id) selected @endif > {{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @else
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
                    @endif
                    <div class="form-group mt-3">
                        <span><i class="dripicons-user"></i></span>
                        <label for="name" class="col-form-label"> Lead / Deal </label>                   
                        <input type="text" name="lead_deal" id="lead_deal" value="{{ $info->lead->lead_subject ?? '' }}" class="form-control" autocomplete="off" required>
                        <input type="hidden" name="lead_id" id="lead_id" value="{{ $info->lead_id ?? '' }}">
                        <input type="hidden" name="deal_id" id="deal_id" value="{{ $info->deal_id ?? '' }}">
                        <div id="lead-result" class="typeahead-custom"></div>
                        
                    </div>
                    <div class="form-group mt-3">
                        <span><i class="dripicons-user"></i></span>
                        <label for="name" class="col-form-label">Customer </label>                   
                        <input type="text" name="customer" id="customer" class="form-control" value="{{ $info->customer->first_name ?? '' }}" autocomplete="off">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $info->customer_id ?? '' }}">
                        <div id="result" class="typeahead-custom"></div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Notes</label>
                        <textarea name="notes" id="notes" cols="30" rows="1">{{ $info->notes ?? '' }}</textarea>
                    </div>
                    <input type="hidden" name="id" value="{{ $info->id ?? '' }}">
                    <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}"> 
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit"  class="btn btn-info" id="save"> Save </button>
        </div>
    </form><!-- /.modal-content -->
</div>

<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
<style>
   
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

    #activitiy-icon>div>label>i {
        padding: 5px;
        border: 0.5px solid #ddd;
        font-size: 20px;
    }
    #lead-activity {
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
    .w-20 {
        width: 20% !important;
    }

    .timeline-item-left>.timeline-desk>.timeline-box {
        background: rgb(255, 252, 220);
    }
    
</style>
<script>
    $(function(){
        $('.datepicker').datepicker({
            format: 'M dd,yyyy',
            // endDate: '+0d',
            autoclose: true
        });
    });
</script>
<script src="{{ asset('assets/js/vendor/simplemde.min.js') }}"></script>
    <!-- SimpleMDE demo -->
<script src="{{ asset('assets/js/pages/demo.simplemde.js') }}"></script>
<script>
    $('textarea').each(function() {
        var simplemde = new SimpleMDE({
            element: this,
        });
    });

    $('#result').hide();
    $('#lead-result').hide();
    
    $('.activity-title').click(function(){  
        var title = $(this).val();
        $('#activity_title').attr('placeholder', title.toUpperCase());
    });

    $('#start_time').change(function(){
        $('#due_time').attr('readonly', false);
        var times = $(this).val();

        time = times.split(':');
       
        var hour = time[0];
        var minutes = time[1];
        minutes = parseInt(time[1]) + 10;
        if( minutes >= 60){
            minutes = minutes - 60;
            minutes = '0'+minutes;
            if( hour >= 23 ) {
                hour = '00';
            } else {
                hour = parseInt(hour) + 1;
            }
        }
        var due_time = hour+':'+minutes;
        $('#due_time').val(due_time );
    })
   

        $("#activites-form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    beforeSend: function() {
                        $('#error').removeClass('alert alert-danger');
                        $('#error').html('');
                        $('#error').removeClass('alert alert-success');
                        $('#save').html('Loading...');
                    },
                    success: function(response) {
                        var from = $('#from').val();
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            if( from == 'dashboard' ) {
                                window.location.href="{{ route('activities', $companyCode) }}";
                            } else {
                                ReloadDataTableModal('activities-datatable');
                            }
                            
                        }
                    }            
                });
            }
        });

        $('#customer').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_customer', $companyCode) }}",
                    method:'POST',
                    data: {org:inputs},
                    success:function(response){
                        $('#result').html(response);
                        $('#result').show();
                    }      
                });
        })

        $('#lead_deal').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_lead_deal', $companyCode) }}",
                    method:'POST',
                    data: {org:inputs},
                    success:function(response){
                        $('#lead-result').html(response);
                        $('#lead-result').show();
                    }      
                });
        })  
</script>