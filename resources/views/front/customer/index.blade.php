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
    @if ( session('razorpay_response' ) )
    @php
        $response = session('razorpay_response');
    @endphp
    @if( $response['erorr'] == 'success')
       
        <div class=" text-center alert alert-success payment-error" v-show="elementVisible" class="hideElement">
            <h5>
                Your order Payment Successfully done
            </h5>
            <p class="w-100 text-center">
                Order No: {{ $response['order_no'] ?? 'N/A' }}
            </p>
        </div>
            
    @else
        <div class=" text-center alert alert-danger payment-error" v-show="elementVisible" class="hideElement">
            <h5>
                Your order Payment Failed
            </h5>
            <p class="w-100 text-center">
                Order No: {{ $response['order_no'] ?? 'N/A' }}
            </p>
        </div>
    @endif
   
   
@endif

    <div class="container-fluid p-3">
        
        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
            <li class="nav-item">
                <a href="#account" data-id="profile" @click="testTab('account')" data-bs-toggle="tab" aria-expanded="false" :class="[activeMenu == 'account' ? 'active': '', 'nav-link rounded-0 customer-tab']">
                    <i class="mdi mdi-home-variant d-md-none d-block"></i>
                    <span class="d-none d-md-block">My Account</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#kyc" data-id="kyc" @click="testTab('kyc')" data-bs-toggle="tab" aria-expanded="true" :class="[activeMenu == 'kyc' ? 'active': '', 'nav-link rounded-0 customer-tab']">
                    <i class="mdi mdi-account-circle d-md-none d-block"></i>
                    <span class="d-none d-md-block">KYC</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#orders" data-id="orders" @click="testTab('orders')" data-bs-toggle="tab" aria-expanded="false" :class="[activeMenu == 'orders' ? 'active': '', 'nav-link rounded-0 customer-tab']">
                    <i class="mdi mdi-cart-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#settings" data-id="settings" @click="testTab('settings')" data-bs-toggle="tab" aria-expanded="false" :class="[activeMenu == 'settings' ? 'active': '', 'nav-link rounded-0 customer-tab']">
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
            <div :class="[activeMenu == 'account' ? 'show active': '', 'tab-pane']" id="account">
                @include('front.customer.myaccount.index')
            </div>
            <div :class="[activeMenu == 'kyc' ? 'show active': '', 'tab-pane']" id="kyc">
                @include('front.customer.kyc.index')
            </div>
            <div :class="[activeMenu == 'orders' ? 'show active': '', 'tab-pane']" id="orders">
                @include('front.customer.orders.index')
            </div>
            <div :class="[activeMenu == 'settings' ? 'show active': '', 'tab-pane']" id="settings">
                @include('front.customer.settings.index')
            </div>
        </div>

    </div>       
</div>
<div class="modal fade show" id="Mymodal" tabindex="-1" aria-labelledby="myLargeModalLabel"
    aria-modal="true" role="dialog">
    <!-- /.modal-dialog -->
</div>
<script>

    var customerdetails = '{!! $customerInfo !!}';
    var companyDetails = '{!! $companyInfo !!}';
    var documentTypes = '{!! $documentTypes !!}';
    
    var kycDocuments = '{!! $kycDocuments !!}';
    var orderInfo = '{!! $orderInfo !!}';
   
    customerdetails = JSON.parse( customerdetails );
    companyDetails = JSON.parse( companyDetails );
    documentTypes = JSON.parse( documentTypes );
    kycDocuments = JSON.parse( kycDocuments );
    orderInfo = JSON.parse( orderInfo );
    const { createApp } = Vue
    var activemenu = "{{ $activeMenu ?? 'account' }}";
    var profileImage = "{{ $info->logo ? asset('storage/'.$info->logo) : asset('assets/images/users/noimaged.png') }}";
    createApp({
      data() { 
        return {
            formError: '',
            formSuccess: '',
            gotCustomerResponse: true,
            gotCompanyResponse: true,
            gotProfilePicResponse: true,
            gotPasswordResponse: true,
            gotkycFormResponse: true,

            validClass: 'is-valid',
            inValidClass: 'is-invalid',
            noImage: "{{ asset('assets/images/users/noimaged.png') }}",
            activeMenu: activemenu,
            activeProfileMenu : '',
            profileImage: profileImage,
            customerInfo: customerdetails,
            companyInfo: companyDetails,
            kycDocument: kycDocuments,
            documentTypes:[],
            passwordFields: {'password' :'', 'confirmPassword':''},
            orderDetails: orderInfo,
            elementVisible: true,
        }
    },
    computed: {
        kycValidateForm() {
           console.log( 'its is running' );
           return this.gotkycFormResponse;
        },
    },
    mounted() {
        this.documentTypes = documentTypes;
    },
    methods: {
        reuploadDocument: function(kycindex) {
            
            swal.fire({
                title: "Are you sure?",
                text: "You want to change this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Change it!",
                closeOnConfirm: false
            }).then((result) => {
                if( result.isConfirmed) {
                    let oldObject = this.kycDocument[kycindex];
                    this.kycDocument[kycindex].image_url= '';
                    this.kycDocument[kycindex].document_status= false;
                }

            }); 
        },  
        getBuyForm: function(invoiceId) {
            console.log( 'invoiceid', invoiceId );
            $.ajax({
                url: "{{ route('get.invoice.buy.form') }}",
                type: 'GET',
                data: {
                    invoiceId: invoiceId
                },
                success: function(res) {
                    $('#Mymodal').html(res);
                    $('#Mymodal').modal('show');
                }
            });
        },
        changeDocumentStatus: function(invoiceId, status) {
            if( status == 'approved' ) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are trying to Approve Invoice',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, do it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.getBuyForm(invoiceId);
                    }
                })
            } else {

                Swal.fire({
                    title: "Are you sure to Reject ?",
                    text: "Add Reject reason here",
                    input: 'text',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Reason is required!'
                        }
                    }        
                }).then((result) => {
                    if (result.value) {
                        var reason = result.value;
                        let formData = {status:status, id:invoiceId,reason:reason};
                        axios.post("{{ route('orders.reject') }}", formData)            
                        .then( response => {
                            
                            if (response.status == 200 ) {
                                let message = response.data.error;
                                if( response.data.status == 0 ) {
                                    toastr.success( message.join(',') );
                                    var orders = response.data.orderInfo;
                                    orders = JSON.parse(orders);
                                    this.orderDetails = orders;
                                } else {
                                    toastr.error( message.join(',') );

                                }
                            }
                            
                        })
                        .catch(function (error) {
                            this.formError = error;
                        });
                        return false;

                    }
                });
            }

        },  
        isDisabled: function(doc) {
            return this.kycDocument.map(item => item.document_id).includes(doc.id);
        },
        testTab(tab_name) {
            var url = "{{ URL::to('profile') }}/"+tab_name;
            history.replaceState( url, '', url);
        },
        submitPassword(e) {
            e.preventDefault();
            var form = e.target || e.srcElement;
            const formData = $(form).serialize();

            axios.post("{{ route('customer-password-save') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    this.gotCustomerResponse = true;
                    if( response.data.status == 0 ) {
                        toastr.success( message.join(',') );
                        this.$refs.passForm.reset();
                    } else {
                        toastr.error( message.join(',') );

                    }
                }
                
            })
            .catch(function (error) {
                this.formError = error;
            });
            return false;
        },
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
        addRowDocument() {
            var kycObject = {document:'',document_type:'',image_url:'',document_id:'', customerDocumentId:'', document_status: false, reject_reason:null};
            return this.kycDocument.push(kycObject);
        },
        deleteRowDocument(kycindex) {
            this.kycDocument.splice(kycindex,1);
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
        companyForm: function(e) {
            e.preventDefault();

            this.gotCompanyResponse = false;
            var form = e.target || e.srcElement;
            const formData = $(form).serialize();
            axios.post("{{ route('customer-company-save') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;
                    this.gotCompanyResponse = true;
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
        },
        submitKycForm: function(e) {
            e.preventDefault();
            var form = e.target || e.srcElement;
            let formData = new FormData(form);
            
            this.gotkycFormResponse = false;
          
            axios.post("{{ route('kyc-submit') }}", formData,{
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    this.gotkycFormResponse = true;
                    if( response.data.status == 0 ) {
                        toastr.success( message.join(',') );
                    } else {
                        toastr.error( message.join(',') );
                    }
                    if( response.data.kycDocuments ) {
                        let types = response.data.kycDocuments;
                        types = JSON.parse( types );
                        this.kycDocument = types;
                    }
                }
                
            })
            .catch(function (error) {
                this.formError = error;
            });
        },
        fileChange(event, kycindex) {
            if( !event.target.files.length ) {
                this.kycDocument[kycindex].document = false;
            } else {
                this.kycDocument[kycindex].document = true;
            }
        }
        

      },
        created() {
            setTimeout(() => this.elementVisible = false, 3000)
        }
        
      
       
       
      
    }).mount('#app')

</script>
  
@php
// unset(session('razorpay_response'));
Illuminate\Support\Facades\Session::forget('razorpay_response'); 

@endphp
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