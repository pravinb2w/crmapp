<div class="modal-dialog modal-lg modal-right">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
            <style>
                .CodeMirror, .editor-toolbar {
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
                .dropdown {
                    position: absolute;
                    right: 0;
                    top: 0;
                }
                .editor-statusbar {
                    display: none;
                }
            </style>
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <form class="form-horizontal" id="activites-form" method="POST" action="{{ route('activities.save') }}" autocomplete="off">
                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100" id="activitiy-icon">
                        <label for="">Title</label>
                        <div class="form-group">
                            <input type="text" name="activity_title" value="{{ $info->subject ?? '' }}" id="activity_title" placeholder="CALL" class="form-control" required>
                        </div>
                        <div class="form-group mt-3">
                            <label>
                                <input type="radio" class="activity-title" name="activity_type" value="call" @if(isset($info->activity_type) && $info->activity_type == 'call') checked @endif>
                                <i class="dripicons-phone" title="Call"></i>
                            </label>
                            
                            <label>
                                <input type="radio" class="activity-title" name="activity_type" value="meeting" @if(isset($info->activity_type) && $info->activity_type == 'meeting') checked @endif>
                                <i class="dripicons-user-group" title="Meeting"></i>
                            </label>
                            <label>
                                <input type="radio" class="activity-title" name="activity_type" value="deadline" @if(isset($info->activity_type) && $info->activity_type == 'deadline') checked @endif>
                                <i class="dripicons-flag" title="Deadline"></i>
                            </label>
                            <label>
                                <input type="radio" class="activity-title"  name="activity_type" value="task" @if(isset($info->activity_type) && $info->activity_type == 'task') checked @endif>
                                <i class="dripicons-time-reverse" title="Task"></i>
                            </label>
                            <label>
                                <input type="radio" class="activity-title"  name="activity_type" value="email" @if(isset($info->activity_type) && $info->activity_type == 'email') checked @endif>
                                <i class="dripicons-mail" title="Email"></i>
                            </label>
                            <label>
                                <input type="radio" class="activity-title"  name="activity_type" value="lunch" @if(isset($info->activity_type) && $info->activity_type == 'lunch') checked @endif>
                                <i class="mdi mdi-food" title="Lunch"></i>
                            </label>
                        </div>
                        <div class="form-group mt-3 timeinput">
                            <div class="timeinput w-50">
                                <span><i class="dripicons-time-reverse"></i></span>
                                <input type="text" required name="start_date" id="start_date" class="form-control datepicker w-50" value="<?= isset($info->started_at) ? date('d-m-Y', strtotime($info->started_at)): date('M d,Y')?>">
                                <input type="time" name="start_time" id="start_time" class="form-control w-50" value="<?= isset($info->started_at) ? date('h:i', strtotime($info->started_at)) : ''?>" required>
                            </div>
                            <div class="timeinput w-50 mt-3">
                                <span><i class="dripicons-time-reverse"></i></span>
                                <input type="time" name="due_time" id="due_time" class="form-control w-50" value="<?= isset($info->due_at) ? date('h:i', strtotime($info->due_at)) : ''?>" required readonly>
                                <input type="text" required name="due_date" id="due_date" class="form-control datepicker w-50" value="<?= isset($info->due_at) ? date('d-m-Y', strtotime($info->due_at)): date('M d,Y')?>">
                            </div>
                        </div>
                        
                        {{-- if user login only then hide user dropdown, show only admin login --}}
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
                        <div class="form-group mt-3">
                            <span><i class="dripicons-user"></i></span>
                            <label for="name" class="col-form-label"> Lead / Deal </label>                   
                            <input type="text" name="lead_deal" id="lead_deal" value="{{ $info->lead->lead_subject ?? '' }}" class="form-control" autocomplete="off">
                            <input type="hidden" name="lead_id" id="lead_id" value="{{ $info->lead_id ?? '' }}">
                            <input type="hidden" name="deal_id" id="deal_id">
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
                        <div class="form-group mt-3 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                            <button type="submit"  class="btn btn-info"> Save </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>
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
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            $('#error').addClass('alert alert-success');
                            response.error.forEach(display_errors);
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            ReloadDataTableModal('activities-datatable');
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
                    url: "{{ route('autocomplete_customer') }}",
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
                    url: "{{ route('autocomplete_lead_deal') }}",
                    method:'POST',
                    data: {org:inputs},
                    success:function(response){
                        $('#lead-result').html(response);
                        $('#lead-result').show();
                    }      
                });
        })  
</script>