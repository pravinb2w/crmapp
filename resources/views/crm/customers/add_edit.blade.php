<div class="modal-dialog modal-lg modal-right">
    <div class="modal-content">
        <div class="modal-header px-3" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
            <div class="w-100">
                <div class="row">
                    <div class="col-12" id="error"></div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="col-form-label">First Name <span class="text-danger">*</span></label>                   
                        <input type="text" name="name" class="form-control" id="name" placeholder="Type here.." value="" required>        
                    </div>     
                    <div class="col-md-6 mb-3">
                        <label for="name" class="col-form-label">Last Name  </label>                   
                        <input type="text" name="name" class="form-control" id="name" placeholder="Type here.." >        
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="name" class="col-form-label">Organization<span class="text-danger">*</span></label>                   
                        <input list="Organization" name="browser" id="browser" class="form-control">
                        <datalist id="Organization">
                            <option value="Pixel Studio">
                            <option value="MK Studio">
                            <option value="RG Studio">
                            <option value="Ej Studio">
                        </datalist>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="name" class="col-form-label">Role<span class="text-danger">*</span></label>                   
                        <input list="Role" name="browser" id="browser" class="form-control">
                        <datalist id="Role">
                            <option value="Admin">
                            <option value="User">
                        </datalist>
                    </div> 
                    <div class="col-6 mb-4">
                        <label for="email" class="col-form-label">  Phone Number<span class="text-danger">*</span></label>
                        <div>
                            <div class="input-group border rounded mb-3">
                                <input type="text" class="form-control border-0"placeholder="Type here..">
                                <button class="btn text-secondary btn-light" type="button"><i class="mdi mdi-delete"></i></button>
                            </div>
                            <div class="input-group border rounded mb-3">
                                <input type="text" class="form-control border-0" placeholder="Type here..">
                                <button class="btn text-secondary btn-light" type="button"><i class="mdi mdi-delete"></i></button>
                            </div>
                            <div class="text-end">
                                <a href="#" class="link ">+ Add phone number</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <label for="email" class="col-form-label"> Email Id<span class="text-danger">*</span></label>
                        <div>
                            <div class="input-group border rounded mb-3">
                                <input type="text" class="form-control border-0"placeholder="Type here..">
                                <button class="btn text-secondary btn-light" type="button"><i class="mdi mdi-delete"></i></button>
                            </div>
                            <div class="input-group border rounded mb-3">
                                <input type="text" class="form-control border-0" placeholder="Type here..">
                                <button class="btn text-secondary btn-light" type="button"><i class="mdi mdi-delete"></i></button>
                            </div>
                            <div class="text-end">
                                <a href="#" class="link ">+ Add Email</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <label for="description" class="col-form-label me-2">Status</label>
                            <div>
                                <input type="checkbox" name="status" id="switch3" data-switch="primary">
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>  
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        
        <div class="modal-footer px-3">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-primary" id="save">Save</button>
            </div>
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