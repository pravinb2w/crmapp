@extends('front.customer.layout.template')
@section('add_on_style')
 <!-- third party css -->
 <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/buttons.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/select.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/fixedHeader.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/fixedColumns.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .container-fluid {
            padding-right: 24px;
            padding-left: 24px;
        }
        @media (min-width: 1400px) {
            .container-fluid {
                max-width: 85%;
            }
        }
        @media (min-width: 992px) {
            .container-fluid {
                max-width: 90%;
            }
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #fff;
            background: linear-gradient(to right, #00bfff 0%, #0088ea 51%, #00bfff 100%);
        }
        .nav-pills .nav-link {
            background: #ffffffba;
        }

        .img-border {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            max-width: 100%;
            height: auto;
        }

        .avatar-xxl {
            height: 13.5rem;
            width: 13.5rem;
        }

        .profile .active {
            background: linear-gradient(to right, #cadadf29 0%, #00aef8 51%, #bedbe542 100%) !important;
        }

        .valid-doc {
            position: relative;
            left: 6px;
        }
        #scroll-horizontal-datatable_filter {
            position: absolute;
            top: 75px;
            right: 27px;
        }
    </style>
@endsection
@section('content')

<div class="topnav">
    <div class="container-fluid p-3">

        
        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            <li class="nav-item">
                <a href="#account" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">My account</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#kyc" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">KYC</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#orders" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-cart-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-cog-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#logout" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-exit-to-app d-md-none d-block"></i>
                    <span class="d-none d-md-block">Logout</span>
                </a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane show active" id="account">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xxl img-border" alt="profile-image">

                                <h4 class="mb-0 mt-2">Customer Name</h4>
                                <p class="text-muted font-14">Company Name</p>

                                <button type="button" class="btn btn-success btn-sm mb-2">Change Profile Image</button>
                                <button type="button" class="btn btn-danger btn-sm mb-2">Remove Image</button>

                                <div class="text-start mt-3">
                                    <h4 class="font-13 text-uppercase">About Me :</h4>
                                  
                                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">Geneva
                                            D. McKnight</span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">(123)
                                            123 1234</span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">user@email.domain</span></p>

                                    <p class="text-muted mb-1 font-13"><strong>Address :</strong> <span class="ms-2">USA</span></p>
                                </div>
                                
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col-->

                    <div class="col-xl-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item profile">
                                        <a href="#profile" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item profile">
                                        <a href="#company" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                                            Company
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    
                                    <!-- end timeline content-->

                                    <div class="tab-pane  show active" id="profile">
                                        <form>
                                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">First Name</label>
                                                        <input type="text" class="form-control" id="firstname" placeholder="Enter first name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" id="lastname" placeholder="Enter last name">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="useremail" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" id="useremail" placeholder="Enter email" value="test@gmail.com" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="usermobile" class="form-label">Mobile Number</label>
                                                        <input type="password" class="form-control" id="usermobile" placeholder="9754212312" disabled>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="userbio" class="form-label">Address</label>
                                                        <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->

                                           

                                            <h5 class="mb-3 text-uppercase bg-light p-2">
                                                <i class="mdi mdi-phone me-1"></i> 
                                                Secondary Mobile Number

                                                <button type="button" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div> <!-- end row -->

                                            <h5 class="mb-3 text-uppercase bg-light p-2">
                                                <i class="mdi mdi-email me-1"></i> 
                                                Secondary Email
                                                <button type="button" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Email here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Email here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Email here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Email here..">
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div> <!-- end row -->
                                            
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end settings content-->
                                    <div class="tab-pane" id="company">
                                        <form>

                                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> Company Info</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="companyname" class="form-label">Company Name</label>
                                                        <input type="text" class="form-control" id="companyname" placeholder="Enter company name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="cwebsite" class="form-label">Website</label>
                                                        <input type="text" class="form-control" id="cwebsite" placeholder="Enter website url">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="useremail" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" id="useremail" placeholder="Enter email" value="test@gmail.com" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="usermobile" class="form-label">Mobile Number</label>
                                                        <input type="password" class="form-control" id="usermobile" placeholder="9754212312" disabled>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="userbio" class="form-label">Address</label>
                                                        <textarea class="form-control" id="userbio" rows="4" placeholder="Write something..."></textarea>
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
                                                            <input type="text" class="form-control" id="social-fb" placeholder="Url">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="social-tw" class="form-label">Twitter</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                                                            <input type="text" class="form-control" id="social-tw" placeholder="Username">
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
                                                            <input type="text" class="form-control" id="social-insta" placeholder="Url">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="social-lin" class="form-label">Linkedin</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                                                            <input type="text" class="form-control" id="social-lin" placeholder="Url">
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
                                                            <input type="text" class="form-control" id="social-sky" placeholder="@username">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="social-gh" class="form-label">Github</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-github"></i></span>
                                                            <input type="text" class="form-control" id="social-gh" placeholder="Username">
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                            
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>

                                </div> <!-- end tab-content -->
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div>
            <div class="tab-pane" id="kyc">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xxl img-border" alt="profile-image">

                                <h4 class="mb-0 mt-2">Customer Name</h4>
                                <p class="text-muted font-14">Company Name</p>

                                <button type="button" class="btn btn-success btn-sm mb-2">Change Profile Image</button>
                                <button type="button" class="btn btn-danger btn-sm mb-2">Remove Image</button>

                                <div class="text-start mt-3">
                                    <h4 class="font-13 text-uppercase">About Me :</h4>
                                  
                                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">Geneva
                                            D. McKnight</span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">(123)
                                            123 1234</span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">user@email.domain</span></p>

                                    <p class="text-muted mb-1 font-13"><strong>Address :</strong> <span class="ms-2">USA</span></p>
                                </div>

                               
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col-->

                    <div class="col-xl-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- end timeline content-->
                                    <div class="tab-pane show active" id="kyc">
                                        <form>
                                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                                                KYC DOCUMENTS
                                                <button type="button" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
                                            </h5>
                                           
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <select name="kyc" id="" class="form-control">
                                                            <option value="">--select--</option>
                                                            <option value="driving_licence">Driving License</option>
                                                            <option value="pan_card">PAN Card</option>
                                                            <option value="aadhar">Aadhar</option>
                                                            <option value="voter_id">Voter Id</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="file" name="file" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex" id="tooltip-container2">
                                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Verification Rejected">
                                                        <i class="mdi mdi-close valid-doc"></i>
                                                    </a>
                                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger mx-2"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Delete Document">
                                                        <i class="mdi mdi-delete valid-doc"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <select name="kyc" id="" class="form-control">
                                                            <option value="">--select--</option>
                                                            <option value="driving_licence">Driving License</option>
                                                            <option value="pan_card">PAN Card</option>
                                                            <option value="aadhar">Aadhar</option>
                                                            <option value="voter_id">Voter Id</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="file" name="file" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex" id="tooltip-container">
                                                    <a href="javascript: void(0);" class="social-list-item border-warning text-warning" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Verification Pending">
                                                        <i class="mdi mdi-refresh valid-doc"></i>
                                                    </a>
                                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger mx-2" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Delete Document">
                                                        <i class="mdi mdi-delete valid-doc"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <select name="kyc" id="" class="form-control">
                                                            <option value="">--select--</option>
                                                            <option value="driving_licence">Driving License</option>
                                                            <option value="pan_card">PAN Card</option>
                                                            <option value="aadhar">Aadhar</option>
                                                            <option value="voter_id">Voter Id</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="mb-3">
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                                            <input type="file" name="file" class="form-control" id="social-fb" placeholder="Number here..">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 d-flex" id="tooltip-container1">
                                                    <a href="javascript: void(0);" class="social-list-item border-success text-success" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Document verified successfully">
                                                        <i class="mdi mdi-check valid-doc"></i>
                                                    </a>
                                                </div>
                                            </div>
                                               
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end settings content-->
                                    
                                </div> <!-- end tab-content -->
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div>
            <div class="tab-pane" id="orders">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Last Order Summary</h4>
    
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Description</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Product :</td>
                                                <td> Premium</td>
                                            </tr>
                                        <tr>
                                            <td>Grand Total :</td>
                                            <td>INR 1641</td>
                                        </tr>
                                        <tr>
                                            <td>Invoice No</td>
                                            <td>INV/2022/1020</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Status </td>
                                            <td>Pending</td>
                                        </tr>
                                        <tr>
                                            <th>Order Status :</th>
                                            <th>Pending</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Payment Pending Order</h4>
    
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Order Info</th>
                                            <th>Price</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> 25/06/2022 :</td>
                                                <td> INV/2022/1020</td>
                                                <td> INR 1020</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="header-title mb-3">Pending Approval</h4>
    
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Order Info</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> 25/06/2022 :</td>
                                                <td> INV/2022/1020</td>
                                                <td> INR 1020</td>
                                                <td> 
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-success"> Approve</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col-->

                    <div class="col-xl-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                                    Customer Orders
                                </h5>
                                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Invoice Date</th>
                                            <th>Due Date</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th>Payment Status</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>INV/2022/0098</td>
                                            <td>25/6/2022</td>
                                            <td>25/12/2022</td>
                                            <td>Premium</td>
                                            <td>1</td>
                                            <td>500</td>
                                            <td>Pending</td>
                                            <td>Approved</td>
                                        </tr>
                                        <tr>
                                            <td>INV/2022/0102</td>
                                            <td>25/6/2022</td>
                                            <td>25/12/2022</td>
                                            <td>Standard</td>
                                            <td>1</td>
                                            <td>500</td>
                                            <td>Failed</td>
                                            <td>Cancelled</td>
                                        </tr>
                                        <tr>
                                            <td>INV/2022/0098</td>
                                            <td>25/6/2022</td>
                                            <td>25/12/2022</td>
                                            <td>Mega </td>
                                            <td>1</td>
                                            <td>500</td>
                                            <td>Failed</td>
                                            <td>Cancelled</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div>
            <div class="tab-pane" id="settings">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-xxl img-border" alt="profile-image">

                                <h4 class="mb-0 mt-2">Customer Name</h4>
                                <p class="text-muted font-14">Company Name</p>

                                <button type="button" class="btn btn-success btn-sm mb-2">Change Profile Image</button>
                                <button type="button" class="btn btn-danger btn-sm mb-2">Remove Image</button>

                                <div class="text-start mt-3">
                                    <h4 class="font-13 text-uppercase">About Me :</h4>
                                  
                                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2">Geneva
                                            D. McKnight</span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ms-2">(123)
                                            123 1234</span></p>

                                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">user@email.domain</span></p>

                                    <p class="text-muted mb-1 font-13"><strong>Address :</strong> <span class="ms-2">USA</span></p>
                                </div>

                               
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col-->

                    <div class="col-xl-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- end timeline content-->
                                    <div class="tab-pane show active" id="kyc">
                                        <form>
                                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                                                Change Password
                                            </h5>
                                           
                                            <div class="row">
                                               
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <input type="text" name="password" class="form-control" id="social-fb" placeholder="New Password">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <input type="text" name="password" class="form-control" id="social-fb" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            
                                               
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end settings content-->
                                    
                                </div> <!-- end tab-content -->
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
            </div>
        </div>

    </div>       
</div>


  
    
@endsection
@section('add_on_script')
    <script>
         AOS.init();

      
    </script>
    <!-- third party js -->
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js"') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/fixedColumns.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/fixedHeader.bootstrap5.min.js') }}"></script>
    <!-- third party js ends -->

    <!-- demo app -->
    <script src="{{ asset('assets/js/pages/demo.datatable-init.js') }}"></script>
@endsection