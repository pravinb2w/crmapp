@extends('layouts.auth')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<style>
    #myProgress {
      width: 100%;
      background-color: #ddd;
    }
    
    #myBar {
      width: 1%;
      height: 30px;
      background-color: #04AA6D;
    }
    </style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3">Register to start your free trial</h4>

                    <form id="registerForm">
                        <div id="progressbarwizard">

                            <ul class="nav nav-pills nav-justified form-wizard-header mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#account-2" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 py-2 active" aria-selected="false" role="tab" tabindex="-1">
                                        <i class="mdi mdi-account-circle font-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">Account</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#profile-tab-2" data-bs-toggle="tab" onclick="return validateTabForm()" data-toggle="tab" class="nav-link rounded-0 py-2" aria-selected="false" role="tab" tabindex="-1">
                                        <i class="mdi mdi-face-man-profile font-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">Credentials</span>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#finish-2" data-bs-toggle="tab" data-toggle="tab" onclick="return validateAuthForm()" class="nav-link rounded-0 py-2" aria-selected="true" role="tab">
                                        <i class="mdi mdi-checkbox-marked-circle-outline font-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">Finish</span>
                                    </a>
                                </li>
                            </ul>
                        
                            <div class="tab-content b-0 mb-0">

                                <div id="bar" class="progress mb-3" style="height: 7px;">
                                    <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 100%;"></div>
                                </div>
                        
                                <div class="tab-pane active show" id="account-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="company_name"> Company Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="company_name" name="company_name" class="form-control" value="" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="company_code"> Company Code</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="company_code" name="company_code" class="form-control" value="" required>
                                                </div>
                                            </div>
                    
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="email1">Company Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email" name="email" class="form-control" value="" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="contact">Company Contact</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="contact" name="contact" class="form-control" maxlength="10" value="" required>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->

                                    <ul class="list-inline wizard mb-0" id="account_more" onclick="return validateTabForm()">
                                        <li class="next list-inline-item float-end disabled">
                                            <a href="javascript:void(0);" class="btn btn-info" >Add Credentials <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="profile-tab-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="admin_email">Admin Login Email</label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" id="admin_email" name="admin_email" value="">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="password" class="col-form-label col-md-3">Password</label>
                                                <div class="col-md-9">
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    
                                    <ul class="pager wizard mb-0 list-inline">
                                        <li class="previous list-inline-item">
                                            <button type="button" class="btn btn-light"><i class="mdi mdi-arrow-left me-1"></i> Back to Account</button>
                                        </li>
                                        <li class="next list-inline-item float-end disabled" >
                                            <button type="button" class="btn btn-info" onclick="return validateAuthForm()"> Next <i class="mdi mdi-arrow-right ms-1"></i></button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="finish-2" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="stepLoader" style="display: none;">
                                                <div id="myProgress">
                                                    <div id="myBar"></div>
                                                </div>
                                                <div>Please wait preparing your platform...</div>
                                            </div>
                                            <div class="text-center">
                                                <h2 class="mt-0"><i class="mdi mdi-check-all"></i></h2>
                                                <h3 class="mt-0">Thank you !</h3>

                                                <p class="w-75 mb-2 mx-auto">
                                                    Your details are valid. You can click start trail button to create your crm with free trial.
                                                </p>

                                                {{-- <div class="mb-3">
                                                    <div class="form-check d-inline-block">
                                                        <input type="checkbox" class="form-check-input" id="customCheck3">
                                                        <label class="form-check-label" for="customCheck3">I agree with the Terms and Conditions</label>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                    <ul class="pager wizard mb-0 list-inline mt-1">
                                        <li class="previous list-inline-item">
                                            <button type="button" class="btn btn-light"><i class="mdi mdi-arrow-left me-1"></i> Back to Credentials</button>
                                        </li>
                                        <li class="next list-inline-item float-end disabled">
                                            <button type="button" class="btn btn-info" onclick="return submitForm()">Start Trial</button>
                                        </li>
                                    </ul>
                                </div>

                            </div> <!-- tab-content -->
                        </div> <!-- end #progressbarwizard-->
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script src="{{ asset('assets/js/pages/demo.form-wizard.js') }}"></script>
<script>
    var accountError = true;
    var passwordError = false;
    $('#company_name' ).change(function(){
        
        $.ajax({
            url:"{{ route('checkCompanyCode') }}",
            type: "get",
            data: {companyName:$(this).val()},
            success:function(res) {
                $('#company_code').val(res);
            }
        });

    })

    $('#company_code' ).change(function(){
        
        $.ajax({
            url:"{{ route('checkCompanyCode') }}",
            type: "get",
            data: {companyCode:$(this).val()},
            success:function(res) {
                if( res == 1 ) {
                    //error already exists
                    toastr.error('Errors', 'Company Code already exists.' );
                }
            }
        });

    })

    $('#email' ).change(function(){
        
        $.ajax({
            url:"{{ route('checkCompanyCode') }}",
            type: "get",
            data: {email:$(this).val()},
            success:function(res) {
                if( res == 1 ) {
                    //error already exists
                    toastr.error('Errors', 'Email already exists.' );
                    $('#email').val('');
                }
            }
        });

    })

    function validateTabForm() {
        $(".validation").remove();
        
        var company_name = $('#company_name').val();
        var company_code = $('#company_code').val();
        var email = $('#email').val();
        var contact = $('#contact').val();
        if (company_name == '') {
            $('input[name="company_name"]').css("border", "2px solid red");
            $("#company_name").parent().after("<div class='company_name_validation validation' style='color:red;margin-left:93px;'><center>Please enter Company name</center></div>");
            accountError = false;
        } else {
            $('input[name="company_name"]').css("border", "1px solid #ddd");
            $(".company_name_validation").remove();
        }
        if (company_code == '') {
            $('input[name="company_code"]').css("border", "2px solid red");
            $("#company_code").parent().after("<div class='company_code_validation validation' style='color:red;margin-left:93px;'><center>Please enter Company Code</center></div>");
            accountError = false;
        } else {
            $('input[name="company_code"]').css("border", "1px solid #ddd");
            $(".company_code_validation").remove();
        }
        if (email == '') {
            $('input[name="email"]').css("border", "2px solid red");
            $("#email").parent().after("<div class='email_validation validation' style='color:red;margin-left:93px;'><center>Please enter email address</center></div>");
            accountError = false;
        } else {
            $('input[name="email"]').css("border", "1px solid #ddd");
            $(".email_validation").remove();
        }
        if (contact == '') {
            $('input[name="contact"]').css("border", "2px solid red");
            $("#contact").parent().after("<div class='contact_validation validation' style='color:red;margin-left:93px;'><center>Please enter Contact number</center></div>");
            accountError = false;
        } else {
            $('input[name="contact"]').css("border", "1px solid #ddd");
            $(".contact_validation").remove();
        }

        if( company_code != '' && company_code != '' && email != '' && contact != '' ) {
            accountError = true;
        } else {
            accountError = false;
        }
        console.log(accountError, 'accountError');
        if( accountError ) {
            $('#account_more').addClass('wizard');
            $('#account_more').click();
        }
    }
        
    $('input[name="company_name"]').keydown(function () {
            $('#company_name').css("border-color", "1px solid #ddd");
        $(".company_name_validation").remove();
    });
    $('input[name="company_code"]').keydown(function () {
        $('input[name="company_code"]').css("border", "1px solid #ddd");
        $(".company_code_validation").remove();
    });
    $('input[name="email"]').keydown(function () {
        $('input[type="email"]').css("border", "1px solid #ddd");
        $(".email_validation").remove();
    });
    $('input[name="contact"]').keydown(function () {
        $('input[name="contact"]').css("border", "1px solid #ddd");
        $(".contact_validation").remove();
    });

    function validateAuthForm() {

        $(".authValidation").remove();
        
        var admin_email = $('#admin_email').val();
        var password = $('#password').val();
        if (admin_email == '') {
            $('input[name="admin_email"]').css("border", "2px solid red");
            $("#admin_email").parent().after("<div class='admin_email_validation authValidation' style='color:red;margin-left:93px;'><center>Please enter Admin Email to login Crm</center></div>");
            passwordError = false;
        } else {
            $('input[name="admin_email"]').css("border", "1px solid #ddd");
            $(".admin_email_validation").remove();
        }
        if (password == '') {
            $('input[name="password"]').css("border", "2px solid red");
            $("#password").parent().after("<div class='password_validation validation' style='color:red;margin-left:93px;'><center>Please enter password</center></div>");
            passwordError = false;
        } else {
            $('input[name="password"]').css("border", "1px solid #ddd");
            $(".password_validation").remove();
        }

        if( admin_email != '' && password != '' ) {
            passwordError = true;
        } else {
            passwordError = false;
        }

        console.log(passwordError, 'passwordError');
        
    }

    function submitForm() {
        if( passwordError && accountError ) {
            $.ajax({
                url:"{{ route('register.save') }}",
                type:'GET',
                data: $('#registerForm').serialize(),
                beforeSend: function() {
                    $('#stepLoader').show();
                    move();
                },
                success: function(res) {
                    if( res ) {
                        setTimeout(() => {
                            window.location.href= res;
                        }, 500);
                    }
                }
            });
        } else {
            toastr.error('Errors', 'Please fill all fields to continue');
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
    $(document).ready(function() {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "slideDown",
            "hideMethod": "slideUp",
            "closeButton": true,
        }
    });
</script>
<script>
    var i = 0;
    function move() {
      if (i == 0) {
        i = 1;
        var elem = document.getElementById("myBar");
        var width = 1;
        var id = setInterval(frame, 30);
        function frame() {
          if (width >= 100) {
            clearInterval(id);
            i = 0;
          } else {
            width++;
            elem.style.width = width + "%";
          }
        }
      }
    }
    </script>
@endsection
