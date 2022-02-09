<div class="modal-dialog modal-lg modal-right">
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
            <form class="form-horizontal modal-body" id="organizations-form" method="POST" action="{{ route('organizations.save') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                
                <div class="row mb-3">
                    <label for="name" class="col-3 col-form-label">Organization Name <span class="text-danger">*</span></label>
                    <div class="col-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $info->name ?? '' }}" required>
                    </div>
                </div>
               
                <div class="row mb-3">
                    <label for="email" class="col-3 col-form-label"> Email</label>
                    <div class="col-9">
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $info->email ?? '' }}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mobile_no" class="col-3 col-form-label">Mobile Number </label>
                    <div class="col-9">
                        <input type="text" name="mobile_no" class="form-control mobile" id="mobile_no" placeholder="Mobile Number" value="{{ $info->mobile_no ?? '' }}" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mobile_no" class="col-3 col-form-label"> Address </label>
                    <div class="col-9">
                        <textarea name="address" id="address"  class="form-control" cols="30" rows="3">{{ $info->address ?? '' }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-3 col-form-label">Status</label>
                    <!-- Success Switch-->
                    <div class="col-9">
                        <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
                </div>
                <div class=" row">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                        <button type="submit" class="btn btn-info" id="save">Save</button>
                    </div>
                </div>
            </form> 
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
        $("#organizations-form").validate({
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
                            ReloadDataTableModal('organizations-datatable');
                        }
                    }            
                });
            }
        });

        
</script>