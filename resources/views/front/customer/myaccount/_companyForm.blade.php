<form v-on:submit="companyForm" v-for="(item, kindex) in companyInfo">
    @csrf
    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-office-building me-1"></i> Company Info</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="companyname" class="form-label">Company Name</label>
                <input type="text" class="form-control" name="name" v-model="item.name" id="companyname" placeholder="Enter company name">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="cwebsite" class="form-label">Website</label>
                <input type="text" class="form-control" name="website" v-model="item.website" id="cwebsite" placeholder="Enter website url">
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="useremail" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" v-model="item.email">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="usermobile" class="form-label">Mobile Number</label>
                <input type="text" name="mobile_no" class="form-control" id="usermobile" placeholder="" v-model="item.mobile_no">
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="item.address" rows="4" placeholder="Write something..." v-model="item.address"></textarea>
            </div>
        </div> <!-- end col -->
    </div> 

    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Social</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="social-fb" class="form-label">Facebook</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                    <input type="text" class="form-control" v-model="item.links.facebook_url" name="facebook_url" id="facebook_url" placeholder="Url">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="social-tw" class="form-label">Twitter</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                    <input type="text" class="form-control" v-model="item.links.twitter_url" name="twitter_url" id="twitter_url" placeholder="Url">
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="social-insta" class="form-label">Instagram</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>
                    <input type="text" class="form-control" v-model="item.links.instagram_url" name="instagram_url" id="instagram_url" placeholder="Url">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="social-lin" class="form-label">Linkedin</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                    <input type="text" class="form-control" v-model="item.links.linkedin_url" name="linkedin_url" id="linkedin_url" placeholder="Url">
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="social-sky" class="form-label">Skype</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-skype"></i></span>
                    <input type="text" class="form-control" v-model="item.links.skype_url" name="skype_url" id="skype_url" placeholder="Url">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="social-gh" class="form-label">Github</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                    <input type="text" class="form-control" v-model="item.links.github_url" name="github_url" id="github_url" placeholder="Username">
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    
    <div class="text-end">
        <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
    </div>
</form>