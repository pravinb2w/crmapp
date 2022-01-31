<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <div class="row mb-3">
        <label for="inputname3" class="col-3 col-form-label">Site Name</label>
        <div class="col-9">
            <input type="text" name="site_name" value="{{ $info->company->site_name ?? '' }}" class="form-control" id="inputname3" placeholder="Site name">
        </div>
        <input type="hidden" name="type" value="{{ $type ?? '' }}">
    </div>
    <div class="row mb-3">
        <label for="site_url" class="col-3 col-form-label">Site Url</label>
        <div class="col-9">
            <input type="text" name="site_url" class="form-control" value="{{ $info->company->site_url ?? '' }}" id="site_url" placeholder="Site url">
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_logo" class="col-3 col-form-label">Site Logo</label>
        <div class="col-3">
            <input type="file" name="site_logo" class="form-control" id="site_logo" >
        </div>
        <div class="col-6 text-center">
            @if( isset( $info->company->site_logo ) && !empty($info->company->site_logo ) ) 
                <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('storage/'.$info->company->site_logo) }}" alt="Profile Image">
            @else
                <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="Profile Image">
            @endif
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_favicon" class="col-3 col-form-label">Site Favicon</label>
        <div class="col-3">
            <input type="file" name="site_favicon" class="form-control" id="site_favicon" >
        </div>
        <div class="col-6 text-center">
        @if( isset( $info->company->site_favicon ) && !empty($info->company->site_favicon ) ) 
            <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('storage/'.$info->company->site_favicon) }}" alt="Profile Image">
        @else
            <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="Profile Image">
        @endif
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
                    $('#error').addClass('alert alert-danger');
                    response.error.forEach(display_errors);
                } else {
                    $('#error').addClass('alert alert-success');
                    response.error.forEach(display_errors);
                    setTimeout(function(){
                        get_settings_tab('company');
                    },100);
                }
            },
            
        });
        return false;
    });
</script>