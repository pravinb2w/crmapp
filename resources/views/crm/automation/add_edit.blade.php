<div class="modal-dialog modal-lg modal-right">
    
        <form id="automation-form" method="POST" action="{{ route('automation.save') }}" autocomplete="off" class="modal-content h-100">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center h-100 p-3" style="width: 790px">
                <div class="w-100">
                    <div class="row">
                        <div class="col-12" id="error">
                        </div>
                    </div>
                    <div>
                        @csrf
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                        <div class="mb-1">
                            <label for="task_name" class="col-form-label">Type of Activity <span class="text-danger">*</span></label>
                            <div>
                                <select name="activity_type" id="activity_type" class="form-control">
                                    <option value="">--select--</option>
                                    @if(isset($workflow_type) && !empty($workflow_type))
                                        @foreach ($workflow_type as $item)
                                            <option value="{{ $item }}" @if( isset( $info->activity_type ) && $info->activity_type == $item ) selected @endif>{{ $item }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">
                                <label for="description" class="col-form-label"> Mail to Customer </label>
                                <div>
                                    <div>
                                        <input type="checkbox" name="is_mail_to_customer" id="is_mail_to_customer" {{ (isset($info->is_mail_to_customer) && $info->is_mail_to_customer == '1' )  ? 'checked' : ''}} data-switch="success"/>
                                        <label for="is_mail_to_customer" data-on-label="" data-off-label=""></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8" id="customer_template">
                                <label class="mt-3" for=""> Email Templates are available</label>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-4">
                                <label for="description" class="col-form-label"> Mail to Team </label>
                                <div>
                                    <div>
                                        <input type="checkbox" name="is_mail_to_team" id="is_mail_to_team" {{ (isset($info->is_mail_to_team) && $info->is_mail_to_team == '1' )  ? 'checked' : ''}} data-switch="success"/>
                                        <label for="is_mail_to_team" data-on-label="" data-off-label=""></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 " id="mail_template">
                                <label class="mt-3" for=""> Email Templates are available</label>
                            </div>
                        </div>
                        <div class="mb-1">
                            <label for="description" class="col-form-label">Notification to Team</label>
                            <div>
                                <div>
                                    <input type="checkbox" name="is_notification_to_team" id="is_notification_to_team" {{ (isset($info->is_notification_to_team) && $info->is_notification_to_team == '1' )  ? 'checked' : ''}} data-switch="success"/>
                                    <label for="is_notification_to_team" data-on-label="" data-off-label=""></label>
                                </div>
                            </div>
                        </div>
                        <div id="notification_pane">
                        </div>
                        
    
                        <div class="mb-1">
                            <label for="description" class="col-form-label">Status</label>
                            <!-- Success Switch-->
                            <div>
                                <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-info" id="save">Save</button>
            </div>
        </form><!-- /.modal-content -->
    </div>
        <!-- SimpleMDE demo -->
    <script>
        var template = JSON.parse('{!!  $template !!}');
        var template_id = '{{ $info->template_id ?? '' }}';
        var team_template_id = '{{ $info->team_template_id ?? '' }}';
        var notification_title = '{{ $info->notification_title ?? '' }}';
        var notification_message = '{{ $info->notification_message ?? '' }}';
        
        var template_dropdown = '<div class="mb-3">';
            template_dropdown += '<label for="task_name" class="col-form-label">Email Template <span class="text-danger">*</span></label>';
            template_dropdown += '<div><select name="team_template_id" id="team_template_id" class="form-control"><option value="">--select--</option>';
                if( template.length > 0 ) {
                    for (let index = 0; index < template.length; index++) {
                        let team_selected = '';
                        if( team_template_id == template[index].id){
                            team_selected = 'selected';
                        }
                        template_dropdown += '<option value="'+template[index].id+'" '+team_selected+'>'+template[index].title+'</option>';
                        
                    }
                }
            template_dropdown += '</select></div></div>';
        
        var cust_template_dropdown = '<div class="mb-3">';
            cust_template_dropdown += '<label for="task_name" class="col-form-label">Email Template <span class="text-danger">*</span></label>';
            cust_template_dropdown += '<div><select name="customer_template_id" id="customer_template_id" class="form-control"><option value="">--select--</option>';
                if( template.length > 0 ) {
                    for (let index = 0; index < template.length; index++) {
                        let selected = '';
                        if( template_id == template[index].id){
                            selected = 'selected';
                        }
                        cust_template_dropdown += '<option value="'+template[index].id+'" '+selected+'>'+template[index].title+'</option>';
                        
                    }
                }
            cust_template_dropdown += '</select></div></div>';
                            

        var notification = '<div class="mb-1">';
            notification += '<label for="notification_title" class="col-form-label"> Notification Title </label>';
            notification += '<div><input type="text" name="notification_title" id="notification_title" class="form-control" value="'+notification_title+'" required></div>';
            notification += '</div><div class="">';
            notification += '<label for="notification_message" class="col-form-label"> Notification Message </label>';
            notification += '<div><textarea name="notification_message" class="form-control" id="notification_message" cols="30" rows="2" required>'+notification_message+'</textarea></div>';
            notification += '</div>';
        
        if( team_template_id ) {
            $('#mail_template').html(template_dropdown);
        }
        if( template_id ) {
            $('#customer_template').html(cust_template_dropdown);
        }
        if( notification_title ) {
            $('#notification_pane').html(notification);
        }

        $('#is_notification_to_team').change(function(){
            const cb = document.querySelector('#is_notification_to_team');
            
            if( cb.checked ) {
                $('#notification_pane').html(notification);
            } else {
                $('#notification_pane').html('');
            }

        })

        $('#is_mail_to_team').change(function(){
            const mt = document.querySelector('#is_mail_to_team');
            if( mt.checked ) {
                $('#mail_template').html(template_dropdown);
            } else {
                $('#mail_template').html(' <label class="mt-3" for=""> Email Templates are available</label>');

            }
        })

        $('#is_mail_to_customer').change(function(){
            const mt = document.querySelector('#is_mail_to_customer');
            if( mt.checked ) {
                $('#customer_template').html(cust_template_dropdown);
            } else {
                $('#customer_template').html('<label class="mt-3" for=""> Email Templates are available</label>');

            }
        })
        
       
        $("#automation-form").validate({
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
                        var from = $('#from').val();
                        if(response.error.length > 0 && response.status == "1" ) {
                            console.log(response.error);
                            var err = response.error;
                            err = err.toString().split(",");
                            if( err.length > 0 ) {
                                err.forEach(display_toast);
                            }
                        } else {
                            toastr.success('success', response.error );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            
                            ReloadDataTableModal('automation-datatable');
                            
                        }
                    }            
                });
            }
        });
    
            
    </script>
    
    @section('add_on_script')
        <script>
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    @endsection