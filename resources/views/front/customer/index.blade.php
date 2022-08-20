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
                <a href="#account" data-id="account" onclick="return getCustomerTab(this)" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active customer-tab">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">My account</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#kyc" data-id="kyc" onclick="return getCustomerTab(this)" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 customer-tab">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">KYC</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#orders" data-id="orders" onclick="return getCustomerTab(this)" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 customer-tab">
                    <i class="mdi mdi-cart-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings" data-id="settings" onclick="return getCustomerTab(this)" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 customer-tab">
                    <i class="mdi mdi-cog-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('customer-logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link rounded-0">
                    <i class="mdi mdi-exit-to-app d-md-none d-block"></i>
                    <span class="d-none d-md-block">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('customer-logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane show active" id="customer-tab-view">
                @include('front.customer.myaccount.index')
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