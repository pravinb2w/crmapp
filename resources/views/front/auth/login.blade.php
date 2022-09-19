@extends('front.customer.layout.template')
@section('add_on_style')
 <style>
   input.otp {
        padding: 13px;
        box-shadow: 1px 1px 1px 1px #ddd;
        border: 1px solid #ddd;
    }
 </style>
@endsection
@section('content')
<script src="https://unpkg.com/vue@next"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue-router"></script>
<script src="https://unpkg.com/vue3-otp-input"></script>


<div class="" id="app">
    <div class="container-fluid p-3">
        <div class="tab-content">
            <div class="tab-pane show active" id="account">
                <div v-if="formError" class="alert alert-danger" role="alert">
                    @{{ formError }}
                </div>
                <div v-if="formSuccess" class="alert alert-success" role="alert">
                    @{{ formSuccess }}
                </div>
                <div class="row" v-if="pagetype == 'password'">
                   <div class="col-sm-12 col-md-8 col-lg-4 card offset-lg-4 offset-md-2 p-3">
                        @include('front.auth.login_with_password')
                   </div>
                </div>

                <div class="row" v-if="pagetype == 'otp'">
                    <div class="col-sm-12 col-md-8 col-lg-4 card offset-lg-4 offset-md-2 p-3">
                        @include('front.auth.login_with_otp')
                    </div>
                </div>
                <div class="row" v-if="pagetype == 'verify_otp'">
                    <div class="col-sm-12 col-md-8 col-lg-4 card offset-lg-4 offset-md-2 p-3">
                        @include('front.auth.otp_verify')
                    </div>
                </div>

                <div class="row" v-if="pagetype == 'reset'">
                    <div class="col-sm-12 col-md-8 col-lg-4 card offset-lg-4 offset-md-2 p-3">
                        @include('front.auth.forgot_password')
                    </div>
                </div>
                <div class="row" v-if="pagetype == 'link'">
                    <div class="col-sm-12 col-md-8 col-lg-4 card offset-lg-4 offset-md-2 p-3">
                        @include('front.auth.reset_password')
                    </div>
                </div>
            </div>
        </div>
    </div>       
</div>
<script >
    var page_type = '{{ $page_type ?? "password" }}';
    
    const { createApp } = Vue
    
    createApp({
      data() {
        return {
            pagetype: page_type,
            email: '',
            password: '',
            mobile_number: '',
            otp: '',
            isValidEmail: false,
            validClass: 'is-valid',
            inValidClass: 'is-invalid',
            formError: '',
            formSuccess: '',
            gotResponsePassword: false,
            gotResetResponse: true,
            gotOtpResponse: true,
            password_confirmation: '',
            resetErrors: [],
            errors: [],
            otp1: '',
            otp2: '',
            otp3: '',
            otp4: '',
            otp5: '',
            otp6: '',
            otp: '',
            isOtpVerified: true,
        }
      },
      methods: {
        switchPage(types) {
            return this.pagetype = types;
        },
        acceptNumber: function(event) {
            let keyCode = event.keyCode;
            if (keyCode < 48 || keyCode > 57) {
                event.preventDefault();
            }
        },
        submitLoginPassword: function(e) {
            e.preventDefault();

            var form = e.target || e.srcElement;
            const formData = $(form).serialize();
            axios.post("{{ route('customer-login-check') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    this.formError = (response.data.status == 0) ? response.data.message : '';
                    if( response.data.status == 1 ) {
                        location.href= response.data.url;
                    }
                }
                
            })

            .catch(function (error) {
                this.formError = error;
            });
        },
        validateEmail: function() {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
                this.isValidEmail = true;
            } else {
                this.isValidEmail = false;
            }
        },
        submitForgotPassword: function(e) {
            e.preventDefault();
           
            this.gotResponsePassword = true;
            var form = e.target || e.srcElement;
            const formData = $(form).serialize();
            axios.post("{{ route('customer.password.link') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    if( response.data.status == 1 ) {
                        this.gotResponsePassword = false;

                        this.formError = message.join(',');
                    } else {
                        this.formSuccess = message.join(',');
                        this.switchPage('password');
                    }
                    
                }
                
            })

            .catch(function (error) {
              
            });
        },
      
        resetForgotPassword: function(e) {
            e.preventDefault(); 
            this.formError = '';
            this.formSuccess = '';
            this.gotResetResponse = true;
            var form = e.target || e.srcElement;
            const formData = $(form).serialize();

            axios.post("{{ route('customer.password.post') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    let message = response.data.error;

                    if( response.data.status == 1 ) {
                        this.gotResetResponse = false;
                        this.formError = message.join(',');
                    } else {
                        this.formSuccess = message.join(',');
                        setTimeout(() => {
                            location.href="{{ route('customer-login') }}";
                        }, 500);
                    }
                    
                }
                
            })
            .catch(function (error) {
              
            });
        },

        submitLoginOtp: function(e) {
            e.preventDefault();

            this.gotOtpResponse = false;
            var form = e.target || e.srcElement;
            this.formError = '';
            this.formSuccess = '';
            const formData = $(form).serialize();
            
            axios.post("{{ route('customer-login-otp') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    if( response.data.status == 1 ) {
                        this.gotOtpResponse = true;
                        this.formError = response.data.message;
                    } else {
                        this.formSuccess = response.data.message;
                        this.otp = response.data.otp;
                        this.switchPage('verify_otp');
                    }
                    
                }
                
            })

            .catch(function (error) {
              
            });
        },
        verifyOtpLogin: function(e) {
            e.preventDefault();

            this.isOtpVerified = false;
            var form = e.target || e.srcElement;
            this.formError = '';
            this.formSuccess = '';
            const formData = $(form).serialize();
            axios.post("{{ route('customer-verity-otp') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    if( response.data.status == 1 ) {
                        this.isOtpVerified = true;
                        this.formError = response.data.message;
                    } else {
                        this.formSuccess = response.data.message;
                        location.href="{{ route('profile') }}";
                    }
                    
                }
                
            })

            .catch(function (error) {
              
            });
        },
        tabChange: function(val){
            let ele = document.querySelectorAll('.input-otp');
            if(ele[val-1].value != ''){
            ele[val].focus()
            }else if(ele[val-1].value == ''){
            ele[val-2].focus()
            }   
        }

      }
    }).mount('#app')
  </script>
@endsection
@section('add_on_script')
<script>
    let digitValidate = function(ele){
        ele.value = ele.value.replace(/[^0-9]/g,'');
    }

        
</script>
  
@endsection