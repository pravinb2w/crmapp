<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="account_form">
    @csrf
    
    <div class="row mb-3">
        <label for="inputname3" class="col-3 col-form-label">First Name</label>
        <div class="col-9">
            <input type="text" name="first_name" class="form-control" id="inputname3" value="{{ $info->name ?? '' }}" placeholder="Name">
        </div>
    </div>
    <input type="hidden" name="type" value="{{ $type ?? '' }}">
    <div class="row mb-3">
        <label for="last_name" class="col-3 col-form-label">Last Name</label>
        <div class="col-9">
            <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $info->last_name ?? '' }}" placeholder="Last Name">
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-3 col-form-label">Email</label>
        <div class="col-9">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $info->email ?? '' }}">
        </div>
    </div>
    <div class="row mb-3">
        <label for="mobile_number" class="col-3 col-form-label">Mobile Number</label>
        <div class="col-9">
            <input type="text" class="form-control" name="mobile_no" id="mobile_number" placeholder="Mobile number" value="{{ $info->mobile_no }}">
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputname3" class="col-3 col-form-label">Theam Colors</label>
        <div class="col-9">
            <small>Primary Color</small>
            <input type="color" name="primary_color" class="mx-2" id="inputname3" value="{{ $info->primary_color ?? '' }}" placeholder="Name">
            <small>Secondary Color</small>
            <input type="color" name="secondary_color" class="mx-2" id="inputname3" value="{{ $info->secondary_color ?? '' }}" placeholder="Name">
        </div>
    </div>
   
    <div class="row mb-3">
        <label for="profile_image" class="col-3 col-form-label">Profile Image</label>
        <div class="col-3">
            <input type="file" name="profile_image" class="form-control" id="profile_image" >
        </div>
        <div class="col-6 text-center">
            @if( isset( $info->image ) && !empty($info->image ) ) 
                <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('storage/'.$info->image) }}" alt="Profile Image">
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
    $('#account_form').submit(function(e) {
        e.preventDefault(); 
       
        let formData = new FormData(this);
        $('#error').html("");
        $('#error').removeClass("alert alert-danger");
        $('#error').removeClass("alert alert-success");
        $.ajax({
            type:'POST',
            url: '{{ route("account.save") }}',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.loader').show();
            },
            success: (response) => {
                if( response.status == '1') { 
                    toastr.error(response.error);
                } else {
                    toastr.success(response.error);
                    get_settings_tab('profile');
                }
                $('.loader').hide();
            },
            error: function(response){
                
            }
        });
        return false;
    })
</script>