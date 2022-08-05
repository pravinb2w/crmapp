@extends('front.customer.layout.template')

@section('content')
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="dashboard-analytics.html" class="dropdown-item">Analytics</a>
                            {{-- <a href="dashboard-crm.html" class="dropdown-item">CRM</a>
                            <a href="index.html" class="dropdown-item">Ecommerce</a>
                            <a href="dashboard-projects.html" class="dropdown-item">Projects</a> --}}
                    </li>
                    <li class="nav-item">
                            <a href="dashboard-crm.html" class="dropdown-item">CRM</a>
                    </li>
                   
                </ul>
            </div>
        </nav>
    </div>
</div>
  <!-- Start Content-->
  <div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <section class="myaccount pt-0">
        <div class="container">
           <div class="row">
              <div class="col">
                 <div class="maroon-bg-lite pad-30 bor-rad-20 mar-top-30">
                     <h3>Durai raj</h3>
                     <h5 class="text-white mar-bot-20">Personal Information</h5>
                       <form class="editform" action="" id="editmyaccount">
                          <div class="row">						 
                             <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                             <p class="text-style2 mb-0">First Name</p>
                                <input type="text" class="form-control required" id="firstname" placeholder="First Name" name="firstname" value="Durai" required="">
                             </div>
                             <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                             <p class="text-style2 mb-0">Last Name</p>
                                <input placeholder="Last Name" type="text" class="form-control required" id="lastname" name="lastname" value="raj">
                             </div>
                          </div>
                          <div class="row">
                             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                 <p class="text-style2 mb-0">Email Address</p>
                                <input type="email" placeholder="Email Address" class="form-control required" id="emailid" name="emailid" value="sdurairaj@yopmail.com">
                             </div>
                             <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                             <p class="text-style2 mb-0">Mobile Number</p>
                                <input type="text" disabled="" readonly="" placeholder="Mobile Number" class="form-control numericvalidate required" id="mobilenumber" name="mobilenumber" value="9551706025">
                             </div>
                          </div>
                          
                       <!--   <div class="row">
                             <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-gender mt-3 mb-3">
                                <p class="text-style2 mb-0">Gender</p>
                                   <div class="form-check-inline mar-bot-20">
                                      <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" checked>
                                      <label for="customRadio1">Male</label>
                                   </div>
                                   <div class="form-check-inline mar-bot-20">
                                      <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                      <label for="customRadio2">Female</label>
                                   </div>
                                </div>
                             </div>
                          </div> -->
                          <div class="row">
                             <div class="col-6">
                                <button type="submit" class="black-btn">Cancel</button>
                             </div>
                             <div class="col-6 text-right">
                                <button type="button" name="button" onclick="javascript:myaccountupdate('frmmyaccount','https://armaanibiryani.com/ajax/updatemyaccount','editmyaccount','Myaccount','https://armaanibiryani.com/my-account');" class="yellow-btn"><span>Save Changes</span></button> 
                             </div>
                          </div>
                       </form>
                 </div>
              </div>
           </div>
        </div>
        <img src="https://armaanibiryani.com/static/images/home-page-scroll-image3.svg" alt="" class="cart-scroll-image">
     </section>
@endsection
@section('add_on_script')
    <script>
         AOS.init();
    </script>
@endsection