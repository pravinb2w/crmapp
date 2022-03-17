<div class="modal-dialog modal-md modal-right">
    <form  id="dealstage-form" method="POST" action="{{ route('dealstages.save') }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3" style="width:400px">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div> 
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <div class="mb-3">
                    <label for="stages" class="col-form-label">Stage <span class="text-danger">*</span></label>
                    <div>
                        <input type="text" name="stages" id="stages" class="form-control" value="{{ $info->stages ?? '' }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="order_by" class="col-form-label">Order <span class="text-danger">*</span></label>
                    <div>
                        <input type="number" name="order_by" id="order_by" class="form-control" value="{{ $info->order_by ?? '' }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label"> Description </label>
                    <div>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $info->description ?? '' }}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <label for="description" class="col-form-label me-2">Status</label>
                        <!-- Success Switch-->
                        <div>
                            <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                            <label for="switch3" data-on-label="" data-off-label=""></label>
                        </div>
                    </div>
                </div> 
            </div>
        <div class="modal-footer">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-info" id="save">Save</button>
            </div>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
        $("#dealstage-form").validate({
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
                            ReloadDataTableModal('dealstages-datatable');
                        }
                    }            
                });
            }
        });

        
</script>