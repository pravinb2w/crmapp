<div class="collapse navbar-collapse" id="navbarNavDropdown">

    <ul class="navbar-nav ms-auto py-2 align-items-center" id="nav-landing">

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
        <li class="nav-item me-0 ms-3">
            <a href="login" target="_blank" class="btn btn-sm btn-primary rounded-pill d-none d-lg-inline-flex" style="font-size: var(--bs-body-font-size) !important;"> 
                <i class="mdi mdi-login-variant"></i> &nbsp; Login
            </a>
        </li>
    </ul>

</div>