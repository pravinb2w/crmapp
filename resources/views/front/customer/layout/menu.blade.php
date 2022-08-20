<div class="collapse navbar-collapse" id="navbarNavDropdown">

    <ul class="navbar-nav ms-auto py-2 align-items-center" id="nav-landing">
        @if( isset( $not_home ) && $not_home != 'auth')
            <li class="nav-item mx-lg-1">
                <a class="nav-link text-white" href="#LandingBannnerSliders">Home</a>
            </li>
            <li class="nav-item mx-lg-1">
                <a class="nav-link text-white" href="#about-us">About</a>
            </li>
            <li class="nav-item mx-lg-1">
                <a class="nav-link text-white" href="#crm-features">Services</a>
            </li>
            @if (csettings('show_products'))
                @if (isset($products) && !empty($products))
                    <li class="nav-item mx-lg-1">
                        <a class="nav-link text-white" href="#products">Products</a>
                    </li>
                @endif
            @endif
            
            <li class="nav-item mx-lg-1">
                <a class="nav-link text-white" href="#contact-us">Contact</a>
            </li>
          
            @if( session('client') ) 
            
            <li class="dropdown notification-list">
                <a class="nav-link nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{ session('client')->logo ?? asset('assets/images/users/avatar-2.jpg') }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span onclick="goToProfile()">
                        <span class="account-user-name"> {{ session('client')->first_name }}</span>
                        <span class="account-position"> {{ session('client')->company->name ?? '' }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" style="">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>
    
                    <!-- item-->
                    <a href="javascript:void(0)" onclick="return get_tabs('account')" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-edit me-1"></i>
                        <span>My Account</span>
                    </a>
                    <a  href="javascript:void(0)" onclick="return get_tabs('account')" class="dropdown-item notify-item">
                        <i class="uil-shield me-1"></i>
                        <span>Change Password</span>
                    </a>
                    <!-- item-->
                    <a class="dropdown-item notify-item" href="{{ route('customer-logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('customer-logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @else 
           
            <li class="nav-item me-0 ms-3">
                <a href="{{ route('customer-login') }}" target="_blank" class="btn btn-sm btn-primary rounded-pill d-none d-lg-inline-flex" style="font-size: var(--bs-body-font-size) !important;"> 
                    <i class="mdi mdi-login-variant"></i> &nbsp; Login
                </a>
            </li>
            @endif
        @else
        <li class="nav-item mx-lg-1">
            <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
        </li>
            @if( session('client') ) 
        
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{ session('client')->logo ?? asset('assets/images/users/avatar-2.jpg') }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span onclick="goToProfile()">
                        <span class="account-user-name"> {{ session('client')->first_name }}</span>
                        <span class="account-position"> {{ session('client')->company->name ?? '' }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" style="">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0)" onclick="return get_tabs('account')" class="dropdown-item notify-item">
                        <i class="mdi mdi-account-edit me-1"></i>
                        <span>My Account</span>
                    </a>
                    <a  href="javascript:void(0)" onclick="return get_tabs('account')" class="dropdown-item notify-item">
                        <i class="uil-shield me-1"></i>
                        <span>Change Password</span>
                    </a>
                    <!-- item-->
                    <a class="dropdown-item notify-item" href="{{ route('customer-logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('customer-logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
            @else 
        
            <li class="nav-item me-0 ms-3">
                <a href="{{ route('customer-login') }}" target="_blank" class="btn btn-sm btn-primary rounded-pill d-none d-lg-inline-flex" style="font-size: var(--bs-body-font-size) !important;"> 
                    <i class="mdi mdi-login-variant"></i> &nbsp; Login
                </a>
            </li>
            @endif
        @endif
    </ul>
    
      
</div>