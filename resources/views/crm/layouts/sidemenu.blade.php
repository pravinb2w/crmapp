<div class="leftside-menu">
    <style>
        .help-box {
            border-radius: 5px;
            padding: 10px;
            margin: 65px 20px 25px;
            position: relative;
            background-color: rgb(181 55 55 / 49%);
        }
    </style>
    <!-- LOGO -->
    <a href="{{ route('dashboard', $companyCode) }}" class="logo text-center logo-light">
        <span class="logo-lg">
            @if($cm_logo)
            <img src="{{ asset('storage/'.$cm_logo) }}" alt="" height="16">
            @else
           <img src="{{ asset('assets/images/logo/logo-color.png') }}" height="30">
           @endif
        </span>
        <span class="logo-sm">
            @if($cm_logo)
            <img src="{{ asset('storage/'.$cm_favicon) }}" alt="" height="16">
            @else
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="" height="16">
            @endif
        </span>
    </a>

    <!-- LOGO -->
    <a href="{{ route('dashboard', $companyCode) }}" class="logo text-center logo-dark">
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
                            <a href="{{ route('dashboard', $companyCode) }}">CRM</a>
                        </li>
                        <li>
                            <a href="{{ route('deals-pipeline', $companyCode) }}">Deals</a>
                        </li>
                    </ul>
                </div>
            </li>
            @if(Auth::user()->hasAccess('account', 'is_view') || Auth::user()->hasAccess('pages', 'is_view') )

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#Accounts" aria-expanded="false" aria-controls="Accounts" class="side-nav-link">
                    <i class="mdi mdi-account-settings"></i>
                    <span> Accounts </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="Accounts">
                    <ul class="side-nav-second-level">
                        @if(Auth::user()->hasAccess('account', 'is_view'))
                        <li>
                            <a href="{{ route('account', $companyCode) }}">Configuration</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasAccess('pages', 'is_view'))
                        <li>
                            <a href="{{ route('pages', $companyCode) }}">Pages</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif
            @php
                $route = Route::currentRouteName();
                // print_r( $route );
            @endphp
            @if(Auth::user()->hasAccess('customers', 'is_view') || Auth::user()->hasAccess('organizations', 'is_view') || Auth::user()->hasAccess('customer_document_approval', 'is_view') )
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="@if($route=='customer_document_approval.customer.view') true @else false @endif" aria-controls="sidebarEmail" class="side-nav-link">
                    <i class="mdi mdi-account-tie"></i>
                    <span> People </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if($route=='customer_document_approval.customer.view') show @endif" id="sidebarEmail">
                    <ul class="side-nav-second-level">
                        @if(Auth::user()->hasAccess('organizations', 'is_view'))
                        <li >
                            <a href="{{ route('organizations', $companyCode) }}">Organizations</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasAccess('customers', 'is_view'))
                        <li>
                            <a href="{{ route('customers', $companyCode) }}">Customers</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasAccess('customer_document_approval', 'is_view'))
                        <li class="@if($route=='customer_document_approval.customer.view') menuitem-active @endif">
                            <a href="{{ route('customer_document_approval', $companyCode) }}" class="@if($route=='customer_document_approval.customer.view') active @endif">Customers Document Approval</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasAccess('document_type', 'is_view'))
                        <li>
                            <a href="{{ route('document_types', $companyCode) }}" >
                                Document Types
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if(Auth::user()->hasAccess('leads', 'is_view'))
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarLeades" aria-expanded="false" aria-controls="sidebarLeades" class="side-nav-link">
                    <i class="mdi mdi-frequently-asked-questions"></i>
                    <span> Leads </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarLeades">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('leads', $companyCode) }}">Leads</a>
                        </li>
                        @if(Auth::user()->hasAccess('leadsource', 'is_view'))
                        <li>
                            <a href="{{ route('leadsource', $companyCode) }}">Lead Source</a>
                        </li>
                        @endif
                        @if(Auth::user()->hasAccess('leadstage', 'is_view'))
                        <li>
                            <a href="{{ route('leadstage', $companyCode) }}">Lead Stage</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if(Auth::user()->hasAccess('deals', 'is_view')) 
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebardeals" aria-expanded="false" aria-controls="sidebardeals" class="side-nav-link">
                    <i class="mdi mdi-thumbs-up-down"></i>
                    <span> Deals </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebardeals">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('deals', $companyCode) }}">Deals</a>
                        </li>
                        @if(Auth::user()->hasAccess('dealstages', 'is_view'))
                        <li>
                            <a href="{{ route('dealstages', $companyCode) }}">Deal Stages</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if(Auth::user()->hasAccess('invoices', 'is_view') || Auth::user()->hasAccess('payments', 'is_view') )
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail_new" aria-expanded="false" aria-controls="sidebarEmail_new" class="side-nav-link">
                    <i class="mdi mdi-sale"></i>
                    <span> Sales </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail_new">
                    <ul class="side-nav-second-level">
                        @if(Auth::user()->hasAccess('invoices', 'is_view'))
                            <li>
                                <a href="{{ route('invoices', $companyCode) }}">Invoices</a>
                            </li>
                        @endif
                        @if(Auth::user()->hasAccess('payments', 'is_view'))    
                            <li>
                                <a href="{{ route('payments', $companyCode) }}">Payments</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif 
            @if(Auth::user()->hasAccess('products', 'is_view')) 

            <li class="side-nav-item">
                <a href="{{ route('products', $companyCode) }}" class="side-nav-link">
                    <i class="mdi mdi-archive"></i>
                    <span> Products </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('activities', 'is_view') && hasPlanSettings('activities'))

            <li class="side-nav-item">
                <a href="{{ route('activities', $companyCode) }}" class="side-nav-link">
                    <i class="mdi mdi-elevation-rise"></i>
                    <span> Activities </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('tasks', 'is_view') && hasPlanSettings('tasks'))

            <li class="side-nav-item">
                <a href="{{ route('tasks', $companyCode) }}" class="side-nav-link">
                    <i class="mdi mdi-progress-clock"></i>
                    <span> Tasks </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('notes', 'is_view'))

            <li class="side-nav-item">
                <a href="{{ route('notes', $companyCode) }}" class="side-nav-link">
                    <i class="mdi mdi-note-text"></i>
                    <span> Notes </span>
                </a>
            </li>
            @endif
            @if( hasPlanSettings('newletter_subscriptions') )
            <li class="side-nav-item">
                <a href="{{ route('newsletter.index', $companyCode) }}" class="side-nav-link">
                    <i class="mdi mdi-note-text"></i>
                    <span> News Letter </span>
                </a>
            </li>
            @endif
            @if(Auth::user()->hasAccess('bulk_import', 'is_view') || Auth::user()->hasAccess('bulk_import', 'is_view') || hasPlanSettings('work_automation') || hasPlanSettings('announcements') )


            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarProjects" aria-expanded="false" aria-controls="sidebarProjects" class="side-nav-link">
                    <i class="mdi mdi-apps"></i>
                    <span> Utilities </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ Route::is(['create.email_template','edit.email_template']) ? "show" : ""}}" id="sidebarProjects">
                    <ul class="side-nav-second-level">
                        <li class="{{ Route::is(['create.email_template','edit.email_template']) ? "menuitem-active" : ""}}" >
                            <a class="{{ Route::is(['create.email_template','edit.email_template']) ? "active" : ""}}" href="{{ route('email.index', $companyCode) }}">Email Template</a>
                        </li>
                        <li>
                            <a href="{{ route("bulk_import.index", $companyCode) }}"> Bulk Import </a>
                        </li>
                        @if(!Auth::user()->role_id)
                        <li>
                            <a href="{{ route("activity_log.index", $companyCode) }}"> Activity Log </a>
                        </li>
                        @endif
                        @if(hasPlanSettings('announcements'))
                        <li>
                            <a href="{{ route("announcement.index", $companyCode) }}">Announcement</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('db-backup.index', $companyCode) }}">Database Backup</a>
                        </li>
                        @if( hasPlanSettings('work_automation') )
                        <li>
                            <a href="{{ route('automation', $companyCode) }}"> Workflow Automation </a>
                        </li>
                        @endif
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
                            <a href="{{ route('reports.sales', $companyCode) }}">Sales</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.started', $companyCode) }}">Deals Started/Conversion</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.planned', $companyCode) }}">Activities Planned Vs Done</a>
                        </li>
                        <li>
                            <a href="{{ route('reports.forecast', $companyCode) }}">Revenue Forecast</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
            @if(Auth::user()->hasAccess('settings', 'is_view'))

            <li class="side-nav-title side-nav-item">Setup</li>

            <li class="side-nav-item">
                <a href="{{ route('users', $companyCode) }}" class="side-nav-link">
                    <i class="mdi mdi-cog"></i>
                    <span> Settings </span>
                </a>
            </li>
            @endif
            <li>
                <div class="help-box text-white text-center">
                    <h5 class="mt-3">Server Space</h5>
                    <p class="mb-3">Upgrade plan to get access to unlimited Storage</p>
                    <a href="javascript: void(0);" class="btn btn-secondary btn-sm">{{ number_format( checkServerSpace() / 1024 , 4) }} GB / {{ planSettings('server_space') }} GB</a>
                </div>
            </li>

        </ul>
        <!-- End Sidebar -->
        
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>