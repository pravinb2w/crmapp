@extends('front.customer.layout.template')
@section('add_on_style')
 
@endsection
@section('content')
<script src="https://unpkg.com/vue@3"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue-router"></script>


<div class="" id="app">
    <div class="container-fluid p-5">
        <div class="tab-content">
            <div class="tab-pane show active" id="account">
                <div class="row" v-if="pagetype == 'password'">
                   <div class="col-sm-4 card offset-sm-4 p-3">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div v-if="formError" class="alert alert-danger" role="alert">
                            @{{ formError }}
                        </div>
                        <form class="p-3" v-on:submit="submitLoginPassword" >
                            @csrf
                            <h5 class="mb-4 text-uppercase text-center">
                                Login </h5>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="email_id" class="form-label">Email Id</label>
                                    <input id="email" type="email" @blur="validateEmail" :class="[isValidEmail ? validClass : inValidClass, 'form-control' ]" @keypress="validateEmail" :class="[isValidEmail ? validClass : inValidClass, 'form-control' ]" v-model="email" name="email" required autocomplete="email" autofocus>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label w-100">Password
                                        <a href="#" class="float-end"  > Forgot Password </a>
                                    </label>
                                    <div class="input-group input-group-merge">
                                        <input id="password" type="password" :class="[password.length < 8 ? inValidClass : validClass, 'form-control']" v-model="password"  name="password" required >
                                        
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                      
                                    </div>
                                   
                                </div>
                               
                                <div class="text-end pt-3">
                                    <a href="javascript:void(0)" @click="switchPage('otp')" class="float-start mt-3">Signin using OTP</a>
                                    <button type="submit" class="btn btn-success mt-2">
                                        Login
                                    </button>
                                </div>
                            </div> <!-- end row -->
                        </form>
                   </div>
                </div>

                <div class="row" v-if="pagetype == 'otp'">
                    <div class="col-sm-4 card offset-sm-4 p-3">
                         @if (Session::has('message'))
                             <div class="alert alert-success" role="alert">
                                 {{ Session::get('message') }}
                             </div>
                         @endif
                         @if (Session::has('error'))
                             <div class="alert alert-danger" role="alert">
                                 {{ Session::get('error') }}
                             </div>
                         @endif
                         <form class="p-3" :submit="submitLoginPassword" action="{{ route('customer-login-check') }}" method="POST">
                             @csrf
                             <h5 class="mb-4 text-uppercase text-center">
                                 Login using OTP  </h5>
                             <div class="row">
                                 <div class="mb-3">
                                    <label for="mobile_no" class="form-label">Mobile Number</label>
                                    <input type="text" maxlength="10" class="form-control" name="mobile_no" @keypress="acceptNumber" id="mobile_no">
                                 </div>
                                
                                 <div class="text-end pt-3">
                                    <a href="javascript:void(0)" class="float-start mt-3" @click="switchPage('password')">Signin using Password</a>
                                     <button type="button" onclick="return check();" class="btn btn-success mt-2">
                                         Login
                                     </button>
                                 </div>
                             </div> <!-- end row -->
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>       
</div>
<script >
    const { createApp } = Vue

    createApp({
      data() {
        return {
            pagetype: 'password',
            email: '',
            password: '',
            mobile_number: '',
            otp: '',
            isValidEmail: false,
            validClass: 'is-valid',
            inValidClass: 'is-invalid',
            formError: '',
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

            let currentObj = this;
            var form = e.target || e.srcElement;
            const formData = $(form).serialize();
            axios.post("{{ route('customer-login-check') }}", formData)            
            .then( response => {
                if (response.status == 200 ) {
                    this.formError = (response.data.status == 0) ? response.data.message : '';
                    if( response.data.status == 1 ) {
                        location.href= response.data.url;
                    }
                // show the redirected response
                }
                if (response.status === 301 || response.status === 302) {
                    // show the redirecting response
                }
                
            })

            .catch(function (error) {
                currentObj.output = error;
            });
        },
        validateEmail: function() {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) {
                this.isValidEmail = true;
            } else {
                this.isValidEmail = false;
            }
        }

      }
    }).mount('#app')
  </script>
@endsection
@section('add_on_script')
<script>
    function check() {
        alert();
    }
</script>
  
@endsection