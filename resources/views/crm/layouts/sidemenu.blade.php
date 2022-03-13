<div class="leftside-menu">
    
    <!-- LOGO -->
    <a href="#" class="logo text-center logo-light">
        <span class="logo-lg">
           
           <img src="{{ asset('assets/images/logo/logo-color.png') }}" height="50">
           

        </span>
        <span class="logo-sm">
            @if($cm_logo)
            <img src="{{ asset('storage/'.$cm_logo) }}" alt="" height="16">
            @else
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" height="16">
            @endif
        </span>
    </a>

    <!-- LOGO -->
    <a href="#" class="logo text-center logo-dark">
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
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboards </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('dashboard') }}">CRM</a>
                        </li>
                        <li>
                            <a href="{{ route('deals-pipeline') }}">Deals</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#Accounts" aria-expanded="false" aria-controls="Accounts" class="side-nav-link">
                    <i class="mdi mdi-account-settings"></i>
                    <span> Accounts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="Accounts">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('account') }}">Configuration</a>
                        </li>
                        <li>
                            <a href="{{ route('pages') }}">Pages</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="mdi mdi-account-tie"></i>
                    <span> People </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('customers') }}">Customers</a>
                        </li>
                        <li>
                            <a href="{{ route('organizations') }}">Organizations</a>
                        </li>
                       
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLeades" aria-expanded="false" aria-controls="sidebarLeades" class="side-nav-link">
                    <i class="mdi mdi-frequently-asked-questions"></i>
                    <span> Leads </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLeades">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('leads') }}">Leads</a>
                        </li>
                        <li>
                            <a href="{{ route('leadsource') }}">Lead Source</a>
                        </li>
                        <li>
                            <a href="{{ route('leadstage') }}">Lead Stage</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebardeals" aria-expanded="false" aria-controls="sidebardeals" class="side-nav-link">
                    <i class="mdi mdi-thumbs-up-down"></i>
                    <span> Deals </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebardeals">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('deals') }}">Deals</a>
                        </li>
                        <li>
                            <a href="{{ route('dealstages') }}">Deal Stages</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail_new" aria-expanded="false" aria-controls="sidebarEmail_new" class="side-nav-link">
                    <i class="mdi mdi-sale"></i>
                    <span> Sales </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail_new">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('invoices') }}">Invoices</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Payments</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(Auth::user()->hasAccess('products', 'is_view'))

            <li class="side-nav-item">
                <a href="{{ route('products') }}" class="side-nav-link">
                    <i class="mdi mdi-archive"></i>
                    <span> Products </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('activities', 'is_view'))

            <li class="side-nav-item">
                <a href="{{ route('activities') }}" class="side-nav-link">
                    <i class="mdi mdi-elevation-rise"></i>
                    <span> Activities </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('tasks', 'is_view'))

            <li class="side-nav-item">
                <a href="{{ route('tasks') }}" class="side-nav-link">
                    <i class="mdi mdi-progress-clock"></i>
                    <span> Tasks </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('notes', 'is_view'))

            <li class="side-nav-item">
                <a href="{{ route('notes') }}" class="side-nav-link">
                    <i class="mdi mdi-note-text"></i>
                    <span> Notes </span>
                </a>
            </li>
            @endif
            @if(!Auth::user()->role_id)

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
            @endif
            @if(Auth::user()->hasAccess('reports', 'is_view'))
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
            @endif
            @if(!Auth::user()->role_id)

            <li class="side-nav-title side-nav-item">Setup</li>

            <li class="side-nav-item">
                <a href="{{ route('users') }}" class="side-nav-link">
                    <i class="mdi mdi-cog"></i>
                    <span> Settings </span>
                </a>
            </li>
            @endif

        </ul>

       
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>