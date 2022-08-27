@extends('front.customer.layout.template')
@section('add_on_style')
 <!-- third party css -->
 <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/buttons.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/select.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/fixedHeader.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/vendor/fixedColumns.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
        .blur {
            filter: blur(4px);
        }
    </style>
@endsection
@section('content')
<script src="https://unpkg.com/vue@next"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue-router"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>


<div class="topnav" id="app">
   
    <div class="container-fluid p-3">

        
        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            <li class="nav-item">
                <a href="#account" data-id="account" @click="getCustomerTab" data-bs-toggle="tab" aria-expanded="false" :class="[activeMenu == 'account' ? 'active': '', 'nav-link rounded-0 customer-tab']">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">My account</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#kyc" data-id="kyc" @click="getCustomerTab" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 customer-tab">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">KYC</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#orders" data-id="orders" @click="getCustomerTab" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 customer-tab">
                    <i class="mdi mdi-cart-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings" data-id="settings" @click="getCustomerTab" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 customer-tab">
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

<script>
// swal.fire("Good job!", "You clicked the button!", "success", {
//   button: "Aww yiss!",
// });

    var customerdetails = '{!! $customerInfo !!}';
    var companyDetails = '{!! $companyInfo !!}';
   
    customerdetails = JSON.parse( customerdetails );
    companyDetails = JSON.parse( companyDetails );
    
    const { createApp } = Vue
    var activemenu = "{{ $activeMenu ?? 'account' }}";
    var profileImage = "{{ $info->logo ? asset('storage/'.$info->logo) : asset('assets/images/users/noimaged.png') }}";
    createApp({
      data() {
        return {
            formError: '',
            formSuccess: '',
            gotCustomerResponse: true,
            gotProfilePicResponse: true,
            validClass: 'is-valid',
            inValidClass: 'is-invalid',
            noImage: "{{ asset('assets/images/users/noimaged.png') }}",
            activeMenu: activemenu,
            activeProfileMenu : '',
            profileImage: profileImage,
            customerInfo: customerdetails,
            companyInfo: companyDetails,
        }
      },
      methods: {
        addSecondaryMobileNumberField(index) {
            var phone_object = {phoneNumber: '', delete:false};
            return this.customerInfo[index].secondaryMobileData.push(phone_object);
        },
        addSecondaryEmailField(index) {
            var email_object = {email: '', delete:false, emailClass: 'is-invalid form-control'};
            return this.customerInfo[index].secondaryEmailData.push(email_object);
        },
        deleteSecondaryMobileNumberField(kindex,index) {
            this.customerInfo[kindex].secondaryMobileData.splice(index,1);
        },
        deleteSecondaryEmailField(kindex,index) {
            this.customerInfo[kindex].secondaryEmailData.splice(index,1);
        },
        validateEmail: function(items) {
            let emailData = items;
            let checkEmail = emailData.email;

            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(checkEmail)) {
                emailData.emailClass = this.validClass+' form-control';
            } else {
                emailData.emailClass = this.inValidClass+' form-control';
            }

        },
        acceptNumber: function(event) {
            let keyCode = event.keyCode;
            if (keyCode < 48 || keyCode > 57) {
                event.preventDefault();
            }
        },
        customerForm: function(e) {
            e.preventDefault();
            this.gotCustomerResponse = false;
            var form = e.target || e.srcElement;
            const formData = $(form).serialize();
            axios.post("{{ route('customer-save') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    this.gotCustomerResponse = true;
                    if( response.data.status == 0 ) {
                        toastr.success( message.join(',') );
                    } else {
                        toastr.error( message.join(',') );

                    }
                }
                
            })
            .catch(function (error) {
                this.formError = error;

            });
        },
        changeProfilePicture: function(e) {

            const file = e.target.files[0];
            this.profileImage = URL.createObjectURL(file);

            let formData = new FormData();
            formData.append('image', file);
            this.gotProfilePicResponse = false;
            axios.post("{{ route('customer-pic-change') }}", formData,{
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    this.gotProfilePicResponse = true;
                    if( response.data.status == 0 ) {
                        toastr.success( message.join(',') );
                    } else {
                        toastr.error( message.join(',') );
                    }
                }
                
            })
            .catch(function (error) {
                this.formError = error;
            });
        },
        removeProfilePicture: function(e){
            this.gotProfilePicResponse = false;
            this.profileImage = this.noImage;
            axios.post("{{ route('customer-pic-remove') }}")            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    this.gotProfilePicResponse = true;
                    if( response.data.status == 0 ) {
                        toastr.success( message.join(',') );
                    } else {
                        toastr.error( message.join(',') );
                    }
                }
                
            })
            .catch(function (error) {
                this.formError = error;
            });
        }

      },
      
    }).mount('#app')

   
</script>
  
    
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