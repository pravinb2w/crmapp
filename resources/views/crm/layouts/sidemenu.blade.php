<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm.png') }}" alt="" height="16">
        </span>
    </a>

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('assets/images/logo_sm_dark.png') }}" alt="" height="16">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="javascript:void(0)" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="mdi mdi-account-settings"></i>
                    <span> Accounts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascipt:void(0)">Configuration</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Pages</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="javascript:void(0)" class="side-nav-link">
                    <i class="mdi mdi-account-tie"></i>
                    <span> Customers </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="mdi mdi-sale"></i>
                    <span> Sales </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javscript:void(0);">Leads</a>
                        </li>
                        <li>
                            <a href="javascipt:void(0)">Deals</a>
                        </li>
                        <li>
                            <a href="javascipt:void(0)">Invoices</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Payments</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="javascipt:void(0)" class="side-nav-link">
                    <i class="mdi mdi-archive"></i>
                    <span> Products </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="javascipt:void(0)" class="side-nav-link">
                    <i class="mdi mdi-elevation-rise"></i>
                    <span> Activities </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="javascipt:void(0)" class="side-nav-link">
                    <i class="mdi mdi-progress-clock"></i>
                    <span> Tasks </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="javascipt:void(0)" class="side-nav-link">
                    <i class="mdi mdi-note-text"></i>
                    <span> Notes </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a href="javascipt:void(0)" class="side-nav-link">
                    <i class="mdi mdi-cart-check"></i>
                    <span> Subscription </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
                    <i class="mdi mdi-apps"></i>
                    <span> Utilities </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarProjects">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascript:void(0)">Email Template</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Bulk Import</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Calendar </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Activity Log</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Announcement</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Database Backup</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks" class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Reports </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTasks">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascipt:void(0);">Sales</a>
                        </li>
                        <li>
                            <a href="javascipt:void(0);">Deals Started/Convertion</a>
                        </li>
                        <li>
                            <a href="javascipt:void(0);">Activities Planned Vs Done</a>
                        </li>
                        <li>
                            <a href="javascipt:void(0);">Revenue Forecast</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-title side-nav-item">Setup</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="mdi mdi-cog-outline"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="javascript: void(0);">Users</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Roles</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Teams</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Organization</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Country</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Lead Source</a>
                        </li>
                        
                        <li>
                            <a href="javascript: void(0);">Lead Type</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Deal Stages</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);">Permission</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a href="javascript:void(0);" class="side-nav-link">
                    <i class="uil-globe"></i>
                    <span> Landing </span>
                </a>
            </li>

        </ul>

        <!-- Help Box -->
        <div class="help-box text-white text-center">
            <a href="javascript: void(0);" class="float-end close-btn text-white">
                <i class="mdi mdi-close"></i>
            </a>
            <img src="assets/images/help-icon.svg" height="90" alt="Helper Icon Image" />
            <h5 class="mt-3">Unlimited Access</h5>
            <p class="mb-3">Upgrade to plan to get access to unlimited reports</p>
            <a href="javascript: void(0);" class="btn btn-outline-light btn-sm">Upgrade</a>
        </div>
        <!-- end Help Box -->
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>