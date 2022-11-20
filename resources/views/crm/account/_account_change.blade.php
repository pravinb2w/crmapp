<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">    
    <div class="row mb-3">
        <label for="current_password" class="col-3 col-form-label">Current Password</label>
        <div class="col-9">
            <input type="password" required name="current_password" class="form-control" id="current_password" placeholder="Current Password">
        </div>
        <input type="hidden" name="type" value="{{ $type ?? '' }}">
    </div>
    <div class="row mb-3">
        <label for="password" class="col-3 col-form-label">New Password</label>
        <div class="col-9">
            <input type="password" required name="password" class="form-control" id="password" placeholder="New Password">
        </div>
    </div>
    <div class="row mb-3">
        <label for="password_confirmation" class="col-3 col-form-label">Confirm Password</label>
        <div class="col-9">
            <input type="password" required name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
        </div>
    </div>
    <div class="justify-content-end row">
        <div class="col-9">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </div>
</form>  
<script>
     $("#company_setting_form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: '{{ route("account.company.save", $companyCode) }}',
                    type: 'POST',
                    data: $(form).serialize(),
                    beforeSend: function() {
                        $('#error').removeClass('alert alert-danger');
                        $('#error').html('');
                        $('#error').removeClass('alert alert-success');
                        $('.loader').show();
                    },
                    success: function(response) {
                        $('.loader').hide();
                        if(response.error.length > 0 && response.status == "1" ) { 
                            response.error.forEach(msg => toastr.error(msg) ); 
                        } else { 
                            response.error.forEach(msg => toastr.success(msg) );
                            setTimeout(function(){
                                get_settings_tab('change');
                            },100);
                        }
                    }            
                });
            }
        });
</script> 