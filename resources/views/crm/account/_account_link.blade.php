<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <div class="row mb-3">
        <label for="facebook_url" class="col-3 col-form-label">Facebook Url</label>
        <div class="col-9">
            <input type="text" name="facebook_url" class="form-control" value="{{ $info->company->facebook_url ?? '' }}"  id="facebook_url" placeholder="Facebook Url">
        </div>
        <input type="hidden" name="type" value="{{ $type ?? '' }}">
    </div>
    <div class="row mb-3">
        <label for="twitter_url" class="col-3 col-form-label">Twitter Url</label>
        <div class="col-9">
            <input type="text" name="twitter_url" value="{{ $info->company->twitter_url ?? '' }}"  class="form-control" id="twitter_url" placeholder="Twitter Url">
        </div>
    </div>
    <div class="row mb-3">
        <label for="instagram_url" class="col-3 col-form-label">Instagram Url</label>
        <div class="col-9">
            <input type="text" name="instagram_url" value="{{ $info->company->instagram_url ?? '' }}" class="form-control" id="instagram_url" placeholder="Instagram Url">
        </div>
    </div>
    <hr>
    <h4>Chat Link</h4>
    <div class="row mb-3">
        <label for="instagram_chat_link" class="col-3 col-form-label">Instagram Chat Url</label>
        <div class="col-9">
            <input type="text" name="instagram_chat_link" value="{{ $info->company->instagram_chat_link ?? '' }}" class="form-control" id="instagram_chat_link" placeholder="Instagram Chat Url">
        </div>
    </div>
    <div class="row mb-3">
        <label for="whatsapp_chat_link" class="col-3 col-form-label">Whatsapp Chat Url</label>
        <div class="col-9">
            <input type="text" name="whatsapp_chat_link" value="{{ $info->company->whatsapp_chat_link ?? '' }}" class="form-control" id="whatsapp_chat_link" placeholder="Whatsapp Chat Url">
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
            url: '{{ route("account.company.save", $companyCode) }}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if(response.error.length > 0 && response.status == "1" ) {
                    toastr.error(response.error);
                } else {
                    toastr.success(response.error);
                    setTimeout(function(){
                        get_settings_tab('link');
                    },100);
                }
            },
            
        });
        return false;
    });
</script> 