<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <h4> Whatsapp Chat Api</h4>
    <div class="row mb-1">
        <label for="access_token" class="col-3 col-form-label">Access Token</label>
        <div class="col-9">
            <input type="text" name="access_token" class="form-control" value="{{ capi('whatsapp', 'access_token') ?? '' }}"  id="access_token" placeholder="Access Token">
        </div>
        <input type="hidden" name="type" value="{{ $type ?? '' }}">
        <input type="hidden" name="api_type" value="whatsapp">
    </div>
    <div class="row mb-3">
        <label for="instance_id" class="col-3 col-form-label">Instance Id</label>
        <div class="col-9">
            <input type="text" name="instance_id" value="{{ capi('whatsapp', 'instance_id') ?? '' }}"  class="form-control" id="instance_id" placeholder="Instance ID">
        </div>
    </div>
    <hr>
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
                    toastr.error(response.error);
                } else {
                    toastr.success(response.error);
                    setTimeout(function(){
                        get_settings_tab('api');
                    },100);
                }
            },
            
        });
        return false;
    });
</script> 