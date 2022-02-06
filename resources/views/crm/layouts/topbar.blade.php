<div class="navbar-custom align-tems-center">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list ">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>
 
        <li class="dropdown notification-list d-none d-sm-inline-block">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="mdi mdi-notebook-plus-outline noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-md p-0">
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Enquiry</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Deals</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Leads</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Activity</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Tasks</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Notes</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Product</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Organization</span>
                </a>
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="dripicons-plus"></i>
                    <span class="align-middle">Add Contact</span>
                </a>
            </div>
        </li>
         
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                aria-expanded="false">
                <span class="account-user-avatar"> 
                    {{-- <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle"> --}}
                    @if($cm_profile_image)
                    <img src="{{ asset('storage/'.$cm_profile_image) }}" alt="user-image" class="rounded-circle">
                    @else
                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                    @endif
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                    <span class="account-position">{{ $cm_role }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="{{ route('account') }}" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-edit me-1"></i>
                    <span>My Account</span>
                </a>
                <a href="{{ route('change_password') }}" class="dropdown-item notify-item">
                    <i class="uil-shield me-1"></i>
                    <span>Change Password</span>
                </a>
                <!-- item-->
                <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="d-none d-lg-block  mt-md-3 text-center">
        <div class="btn-group">
            <a class="btn-sm btn" href="">Deals</a>
            <a class="btn-sm btn poniter-0" href="#">|</a>
            <a class="btn-sm btn" href="">Contacts</a>
            <a class="btn-sm btn poniter-0" href="#">|</a>

            <a class="btn-sm btn" href="">Organization</a>
            <a class="btn-sm btn poniter-0" href="#">|</a>

            <a class="btn-sm btn" href="">Activities</a>
            <a class="btn-sm btn poniter-0" href="#">|</a>

            <a class="btn-sm btn" href="">Notes</a>
        </div>
    </div>
</div>