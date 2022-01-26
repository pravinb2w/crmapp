@extends('crm.layouts.template')

@section('content')
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Account</li>
                    </ol>
                </div>
                <h4 class="page-title">Personal Preference</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preference</h4> --}}

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#horizontal-form-profile" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-company" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                Company
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-api" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                Api
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-link" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                Link
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                Change Password
                            </a>
                        </li>
                    </ul> <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="horizontal-form-profile">
                            <form class="form-horizontal">
                                <div class="row mb-3">
                                    <label for="inputname3" class="col-3 col-form-label">First Name</label>
                                    <div class="col-9">
                                        <input type="text" name="first_name" class="form-control" id="inputname3" placeholder="Name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="last_name" class="col-3 col-form-label">Last Name</label>
                                    <div class="col-9">
                                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-3 col-form-label">Email</label>
                                    <div class="col-9">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="mobile_number" class="col-3 col-form-label">Mobile Number</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="mobile_number" placeholder="Email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="profile_image" class="col-3 col-form-label">Profile Image</label>
                                    <div class="col-3">
                                        <input type="file" class="form-control" id="profile_image" >
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
                        </div> <!-- end preview-->
                    
                        <div class="tab-pane" id="horizontal-form-company">
                           
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
                        </div> <!-- end preview code-->

                        <div class="tab-pane" id="horizontal-form-api">
                            <form class="form-horizontal">
                                <div class="row mb-3">
                                    <label for="aws_access_key" class="col-3 col-form-label">Aws Access Key</label>
                                    <div class="col-9">
                                        <input type="text" name="aws_access_key" class="form-control" id="aws_access_key" placeholder="Aws access key">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="aws_secret_key" class="col-3 col-form-label">Aws Secret Key</label>
                                    <div class="col-9">
                                        <input type="text" name="aws_secret_key" class="form-control" id="aws_secret_key" placeholder="Aws secret key">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="fcm_token" class="col-3 col-form-label">FCM Token</label>
                                    <div class="col-9">
                                        <input type="text" name="fcm_token" class="form-control" id="fcm_token" placeholder="Fcm Token">
                                    </div>
                                </div>
                                <div class="justify-content-end row">
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>  
                        </div> <!-- end preview code-->

                        <div class="tab-pane" id="horizontal-form-link">
                            <form class="form-horizontal">
                                <div class="row mb-3">
                                    <label for="facebook_url" class="col-3 col-form-label">Facebook Url</label>
                                    <div class="col-9">
                                        <input type="text" name="facebook_url" class="form-control" id="facebook_url" placeholder="Facebook Url">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="twitter_url" class="col-3 col-form-label">Twitter Url</label>
                                    <div class="col-9">
                                        <input type="text" name="twitter_url" class="form-control" id="twitter_url" placeholder="Twitter Url">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="instagram_url" class="col-3 col-form-label">Instagram Url</label>
                                    <div class="col-9">
                                        <input type="text" name="instagram_url" class="form-control" id="instagram_url" placeholder="Instagram Url">
                                    </div>
                                </div>
                                <div class="justify-content-end row">
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>  
                        </div> <!-- end preview code-->

                        <div class="tab-pane" id="horizontal-form-code">
                            <form class="form-horizontal">
                                <div class="row mb-3">
                                    <label for="current_password" class="col-3 col-form-label">Current Password</label>
                                    <div class="col-9">
                                        <input type="password" name="current_password" class="form-control" id="current_password" placeholder="Current Password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="new_password" class="col-3 col-form-label">New Password</label>
                                    <div class="col-9">
                                        <input type="text" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="confirm_password" class="col-3 col-form-label">Confirm Password</label>
                                    <div class="col-9">
                                        <input type="text" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="justify-content-end row">
                                    <div class="col-9">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </form>  
                        </div> <!-- end preview code-->

                    </div> <!-- end tab-content-->
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div>
</div>
@endsection