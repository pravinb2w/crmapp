<div class="modal-dialog modal-md modal-right">
    <form id="status-form" method="POST" action="{{ route('activity-status.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3" style="width:400px">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <div>
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <input type="hidden" name="type" value="{{ $type ?? '' }}">
                <div class="mb-3">
                    <label for="status_name" class="col-3 col-form-label"> Status Name <span class="text-danger">*</span></label>
                    <div>
                        <input type="text" name="status_name" class="form-control" id="status_name" placeholder="Name" value="{{ $info->status_name ?? '' }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="color" class="col-3 col-form-label"> Color <span class="text-danger">*</span></label>
                    <div>
                        <input type="color" name="color" class="form-control" id="color" placeholder="Colour" value="{{ $info->color ?? '' }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="order" class="col-3 col-form-label"> Order<span class="text-danger">*</span></label>
                    <div>
                        <input type="number" name="order" min="1" class="form-control" id="order" placeholder="Order Number" value="{{ $info->order ?? '' }}" required>
                    </div>
                </div>
               <div class="d-flex align-items-center">
                    <label for="description" class="me-2 col-form-label">Status</label>
                    <div>
                        <input type="checkbox" name="is_active" id="switch3" {{ (isset($info->is_active) && $info->is_active == '1' )  ? 'checked' : ((isset($info->is_active) && $info->is_active == '0' ) ? '':'checked')}} data-switch="success"/>
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
               </div> 
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-info" id="save">Save</button>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
        $("#status-form").validate({
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
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            let tableurl = '{{ $type }}-status-datatable';
                            ReloadDataTableModal(tableurl);
                        }
                    }            
                });
            }
        });

        
</script>