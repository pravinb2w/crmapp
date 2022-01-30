<form class="form-horizontal">
    <div class="row mb-3">
        <label for="inputname3" class="col-3 col-form-label">Site Name</label>
        <div class="col-9">
            <input type="text" name="site_name" class="form-control" id="inputname3" placeholder="Site name">
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_url" class="col-3 col-form-label">Site Url</label>
        <div class="col-9">
            <input type="text" name="site_url" class="form-control" id="site_url" placeholder="Site url">
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_logo" class="col-3 col-form-label">Site Logo</label>
        <div class="col-3">
            <input type="file" class="form-control" id="site_logo" >
        </div>
        <div class="col-6 text-center">
            <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="Profile Image">
        </div>
    </div>
    <div class="row mb-3">
        <label for="site_favicon" class="col-3 col-form-label">Site Favicon</label>
        <div class="col-3">
            <input type="file" class="form-control" id="site_favicon" >
        </div>
        <div class="col-6 text-center">
            <img class="img-fluid avatar-xl rounded-circle" src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="Profile Image">
        </div>
    </div>
    <div class="justify-content-end row">
        <div class="col-9">
            <button type="submit" class="btn btn-info">Update</button>
        </div>
    </div>
</form> 