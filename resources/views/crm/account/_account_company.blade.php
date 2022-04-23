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
    <div class="row mb-3">
        <label for="site_email" class="col-3 col-form-label">Site Email</label>
        <div class="col-9">
            <input type="text" name="site_email" class="form-control" value="{{ $info->company->site_email ?? '' }}" id="site_email" placeholder="Site email">
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_phone" class="col-3 col-form-label">Site Phone Number</label>
        <div class="col-9">
            <input type="text" name="site_phone" class="form-control" value="{{ $info->company->site_phone ?? '' }}" id="site_phone" placeholder="Copyrights">
        </div>
    </div>
    <div class="row mb-3">
        <label for="office_time" class="col-3 col-form-label">Office Time</label>
        <div class="col-9">
            <input type="text" name="office_time" class="form-control" value="{{ $info->company->office_time ?? '' }}" id="office_time" placeholder="10:00 AM - 7:00 PM">
        </div>
    </div>
    <div class="row mb-3">
        <label for="address" class="col-3 col-form-label">Site Address</label>
        <div class="col-9">
            <input type="text" name="address" class="form-control" value="{{ $info->company->address ?? '' }}" id="address" placeholder="Address">
        </div>
    </div>
    <div class="row mb-3">
        <label for="copyrights" class="col-3 col-form-label">Copyrights</label>
        <div class="col-9">
            <input type="text" name="copyrights" class="form-control" value="{{ $info->company->copyrights ?? '' }}" id="copyrights" placeholder="Copyrights">
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_phone" class="col-3 col-form-label"> GSTIN Number </label>
        <div class="col-9">
            <input type="text" name="gstin_no" class="form-control" value="{{ $info->company->gstin_no ?? '' }}" id="gstin_no" placeholder="GstinNo">
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
                        get_settings_tab('company');
                    },100);
                }
            },
        });
        return false;
    });
</script>