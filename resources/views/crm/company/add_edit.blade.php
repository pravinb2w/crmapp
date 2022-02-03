<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <form class="form-horizontal modal-body" id="csubscription-form" method="POST" action="{{ route('roles.save') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                
                <div class="row mb-3">
                    <label for="subscription_id" class="col-4 col-form-label">Subscription <span class="text-danger">*</span></label>
                    <div class="col-8">
                        <select name="subscription_id" id="subscription_id" class="form-control" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="company_id" class="col-4 col-form-label">Company <span class="text-danger">*</span></label>
                    <div class="col-8">
                        <select name="company_id" id="company_id" class="form-control" required>
                            <option value="">--Select--</option>
                        </select>
                    </div>
                </div>
               
                <div class="row mb-3 position-relative" id="datepicker4">
                    <label class="form-label col-4">Start Date <span class="text-danger">*</span></label>
                    <div class="col-8">
                        <input type="text" required name="start_date" id="start_date" class="form-control" data-provide="datepicker" data-date-autoclose="true" data-date-container="#datepicker4">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-4 col-form-label">Status</label>
                    <!-- Success Switch-->
                    <div class="col-8">
                        <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-info" id="save">Save</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                    </div>
                </div>
            </form> 
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
        $("#csubscription-form").validate({
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
                            ReloadDataTableModal('roles-datatable');
                        }
                    }            
                });
            }
        });

        
</script>