<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <input type="hidden" name="type" value="{{ $type ?? '' }}">
    <div class="row mb-3">
        <label for="aws_access_key" class="col-3 col-form-label">Aws Access Key</label>
        <div class="col-9">
            <input type="text" name="aws_access_key" value="{{ $info->company->aws_access_key ?? '' }}" class="form-control" id="aws_access_key" placeholder="Aws access key">
        </div>
    </div>
    <div class="row mb-3">
        <label for="aws_secret_key" class="col-3 col-form-label">Aws Secret Key</label>
        <div class="col-9">
            <input type="text" name="aws_secret_key" class="form-control" value="{{ $info->company->aws_secret_key ?? '' }}"  id="aws_secret_key" placeholder="Aws secret key">
        </div>
    </div>
    <div class="row mb-3">
        <label for="fcm_token" class="col-3 col-form-label">FCM Token</label>
        <div class="col-9">
            <input type="text" name="fcm_token" value="{{ $info->company->fcm_token ?? '' }}"  class="form-control" id="fcm_token" placeholder="Fcm Token">
        </div>
    </div>
    <hr>
    
    <div class="row mb-3">
        <label for="enable_twilio" class="col-3 col-form-label">Enable Twilio Sms</label>
        <!-- Success Switch-->
        <div class="col-8">
            <input type="checkbox" name="enable_twilio" id="switch3" {{ (isset($sms->enable_twilio) && $sms->enable_twilio == 'yes' )  ? 'checked' : ((isset($sms->enable_twilio) && $sms->enable_twilio == 'no' ) ? '':'checked')}} data-switch="success"/>
            <label for="switch3" data-on-label="" data-off-label=""></label>
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-3 col-form-label">Twilio SID</label>
        <!-- Success Switch-->
        <div class="col-8">
            <input type="text" name="twilio_sid" id="twilio_sid" value="{{ $sms->twilio_sid ?? '' }}" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-3 col-form-label">Twilio Auth Token</label>
        <!-- Success Switch-->
        <div class="col-8">
            <input type="text" name="twilio_auth_token" id="twilio_auth_token" value="{{ $sms->twilio_auth_token ?? '' }}" class="form-control">
        </div>
    </div>
    <div class="row mb-3">
        <label for="description" class="col-3 col-form-label">Twilio Number</label>
        <!-- Success Switch-->
        <div class="col-8">
            <input type="text" name="twilio_number" id="twilio_number" value="{{ $sms->twilio_number ?? '' }}" class="form-control">
        </div>
    </div>
    <div class="justify-content-end row">
        <div class="col-9">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </div>
</form> 
<script>
    $('#company_setting_form').submit(function(e) {
        e.preventDefault();
       
        let formData = new FormData(this);
        $('#error').removeClass("alert alert-danger");
        $('#error').removeClass("alert alert-success");

        $.ajax({
            type:'POST',
            url: '{{ route("account.company.save") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if(response.error.length > 0 && response.status == "1" ) {
                    response.error.forEach(msg => toastr.error(msg) ); 
                } else {
                    response.error.forEach(msg => toastr.success(msg) ); 
                    setTimeout(function(){
                        get_settings_tab('api');
                    },100);
                }
            },
            
        });
        return false;
    });
</script>