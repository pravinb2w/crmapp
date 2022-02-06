<div class="modal-dialog modal-lg">
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
            <form class="form-horizontal modal-body"> 
                <div class="row mb-3">
                    <label for="name" class="col-2 col-form-label">First Name <span class="text-danger">*</span></label>
                    <div class="col-4">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="" required="">
                    </div>
                
                    <label for="last_name" class="col-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                    <div class="col-4">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="" required="">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-2 col-form-label"> Phone Number<span class="text-danger">*</span></label>
                    <div class="col-4">
                        <div class="btn-group w-100 align-items-center">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Phone Number" value="" required="">
                            <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                        </div>
                        <div class="btn-group w-100 align-items-center mt-2">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Phone Number" value="" required="">
                            <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                        </div>
                        <div class="text-start mt-2">
                            <a href="#" class="link ">+ Add phone number</a>
                        </div>
                    </div>
                
                    <label for="email" class="col-2 col-form-label"> Email<span class="text-danger">*</span></label>
                    <div class="col-4">
                        <div class="btn-group w-100 align-items-center">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="" required="">
                            <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                        </div>
                        <div class="btn-group w-100 align-items-center mt-2">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="" required="">
                            <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                        </div>
                        <div class="text-start mt-2">
                            <a href="#" class="link ">+ Add email</a>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="mobile_no" class="col-2 col-form-label">Organization<span class="text-danger">*</span></label>
                    <div class="col-4">
                        <input list="Organization" name="browser" id="browser" class="form-control">
                        <datalist id="Organization">
                            <option value="Pixel Studio">
                            <option value="MK Studio">
                            <option value="RG Studio">
                            <option value="Ej Studio">
                        </datalist>
                    </div>
                
                    <label for="mobile_no" class="col-2 col-form-label">Role<span class="text-danger">*</span></label>
                    <div class="col-4">
                        <input list="mobile_no" name="browser" id="browser" class="form-control">
                        <datalist id="mobile_no">
                            <option value="Admin">
                            <option value="User">
                        </datalist>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-3 col-form-label">Status</label>
                    <!-- Success Switch-->
                    <div class="col-9">
                        <input type="checkbox" name="status" id="switch3" data-switch="success">
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
                </div>
                
                <div class=" row">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                        <button type="submit" class="btn btn-success" id="save">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
        $("#country-form").validate({
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
                            ReloadDataTableModal('country-datatable');
                        }
                    }            
                });
            }
        });

        
</script>