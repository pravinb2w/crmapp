<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <!-- App favicon -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/custom/css/effect.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />        
      
        <style>
            .btn-primary {
                background-image: linear-gradient(to right, #00c6ff 0%, #006BDF 51%, #00c6ff 100%);
                background-size: 200% auto;
                color: white !important;
                box-shadow: 2px 4px 10px 0px rgb(0 0 0 / 20%);
                transition: all .5s !important;
                font-weight: 500 !important;
                padding: 11px 25px !important;
                font-size: 1rem !important;
                }
                .btn-primary:hover {
                background-position: right center;
                transition: 0.5s;
                }

                .btn-dark {
                background-image: linear-gradient(to right, #517fa4 0%, #243949 51%, #517fa4 100%);
                background-size: 200% auto;
                color: white !important;
                box-shadow: 2px 4px 10px 0px rgb(0 0 0 / 20%);
                transition: all .5s !important;
                font-weight: 500 !important;
                padding: 11px 25px !important;
                font-size: 1rem !important;

                }
                .btn-dark:hover {
                background-position: right center;
                transition: 0.5s;
                }
            @media screen and (max-width: 980px) {
                .contact-card {
                    position: unset !important;
                    transform: translate(0,0) !important;
                    width: 100% !important;
                }
                .padding-left-250 {
                    padding-left: 35px !important
                }
            }
            .contact-card {
                transform: translate(-240px,80px);
                z-index: 1;
                color: white;
                width: 450px;
                top:0%;
                left: 0%
            }
            .padding-left-250 {
                padding:35px 35px 35px 250px ;
            }
            .bg-trans {
                background:  transparent !important;
            }
            .fa-lg {
                font-size: 28px;
                padding: 5px;
                border: 2px solid;
                margin-right: 15px;
                border-radius: 10px
            }
            .border-bottom-input {
                border-top: none !important;
                border-right: none !important;
                border-left: none !important;
                border-radius: 0 !important;
                border-bottom: 1px solid #ffffff17 !important
            }
            label.error {
                font-size: 10px;
                color: red;
                position: absolute;
                right: 0%;
                bottom: -21px
            }
            .rounded-5 {
                border-radius: 30px !important
            }
           .carousel-caption {
               left: 50% !important;
               top: 50% !important;
               transform: translate(-50%,-50%) !important;
               width: 100%;
               text-align: center !important
           }
        </style>
    </head>
    <body class="loading" data-layout-config='{"darkMode":false}'>
        
        <!-- NAVBAR START -->
        <nav class="navbar navbar-expand-lg p-0 bg-dark-50 sticky-top w-100" id="top-navbar-animated">
            <div class="container">
                <!-- logo -->
                <a href="#" class="navbar-brand me-lg-5 ">
                    <img src="{{ asset('/assets/images/logo/logo-color.png') }}"  class="logo-dark" height="60" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi text-white mdi-menu" style="text-shadow: 0 2px black;"></i>
                </button>

                <!-- menus -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
        
                    <ul class="navbar-nav ms-auto py-2 align-items-center"> 
                    
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white active" href="#">Home</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="#about-us">About</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="#contact-us">contact</a>
                        </li>
                        <li class="nav-item me-0 ms-3">
                            <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" target="_blank" class="nav-link d-lg-none">Purchase now</a>
                            <a href="login" target="_blank" class="btn btn-sm btn-primary rounded-pill d-none d-lg-inline-flex">
                                <i class="mdi mdi-login-variant me-2"></i> LOGIN
                            </a>
                        </li>
                    </ul> 

                </div>
            </div>
        </nav>
        <!-- NAVBAR END --> 
        <section style="min-height: 500px" class="bg-light d-flex justify-content-center align-items-center">
            @if( isset( $status ) && $status == 0 )
            <div class="card m-3 ">
                <div class="card-body text-center p-4">
                    <h1 class="display-1 mb-3 bi bi-check-circle-fill text-success"></h1>
                    <h1 class="text-dark">Proposal Aprroved !</h1>
                    <p class="lead">{{ $message }}</p>
                    {{-- <a href="{{ route('landing.index') }}" class="mt-3 btn btn-success px-4 rounded-pill">Continue</a>
                     --}}
                     <p> You will redirect to Razorpay payment gateway!</p>
                </div>
            </div>
            @elseif( isset($status) && $status == 2)
            <div class="card m-3 ">
                <div class="card-body text-center p-4">
                    <h1 class="display-1 mb-3 bi bi-exclamation-circle-fill text-danger"></h1>
                    <h1 class="text-dark">Session Expired!</h1>
                    <p class="lead">{{ $message }}</p>
                </div>
            </div>
            @else
            <div class="card m-3 ">
                <div class="card-body text-center p-4">
                    <h1 class="display-1 mb-3 bi bi-exclamation-circle-fill text-danger"></h1>
                    <h1 class="text-dark">Proposal Denied !</h1>
                    <p class="lead">{{ $message }}</p>
                </div>
            </div>
            @endif
        </section>
        <section class="py-5 ">
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-md">
                        <h3 class="h3"  class="aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                            Subscribe with us get the newsletter
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group border shadow-sm rounded w-100 aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                            <div class="w-100 bg-white">
                                <input class="form-control  border-0 rounded-0  w-100 p-3" type="text" id="subject" placeholder="Enter your email...">
                            </div>
                            <div class="">
                                <button type="submit" class=" border-0 rounded-0 btn h-100 btn-primary p-3">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="py-5 text-center " style="background: linear-gradient(#020202e0 50%, #00d9ff34) , url('https://images.unsplash.com/photo-1587560699334-cc4ff634909a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');background-size:cover;backdrop-filter:blur(5px)">
            <div class="container">
                <div class="row justify-content-center align-items-center" >
                    <div class="col-md-12 text-center">
                        {{-- <img src="assets/images/logo.png" alt="" class="logo-dark" height="18" /> --}}
                        
                        <div class="aos-init"  data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1400">
                            <strong class="text-white"> PHOENIX</strong>
                        </div>
                        <p class="text-white mt-4 aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1500">PHOENIX TECH makes it easier to build better websites with
                            <br> great speed. Save hundreds of hours of design
                            <br> and development by using it.</p> 
                    </div>  
                    
                    <div class="col-12 text-center">
                        <div class="aos-init"  data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="2400">
                            <ul class="list-unstyled justify-content-center d-flex ps-0 mb-0 mt-3">
                                <li class="m-2"><a href="#about-us" class="text-light">Home</a></li> 
                                <li class="m-2"><a href="#about-us" class="text-light">About Us</a></li> 
                                <li class="m-2"><a href="#contact-us" class="text-light">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                    
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mt-5">
                            <p class="text-light mt-4 text-center mb-0">© 2022 - 2023 PHOENIX. Design and coded by
                                DuraiBytes</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        @if( isset($route) && !empty($route))
        <script>
            var redirectUrl = "{{ $route }}";
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 500);
        </script>
        @endif
        
        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            $(".enquiry-form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    beforeSend: function() {
                        $('#error').removeClass('alert alert-danger');
                        $('#error').html('');
                        $('#error').removeClass('alert alert-success');
                        $('#save').html('Loading...');
                    },
                    success: function(response) {
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            $('#error').addClass('alert alert-success');
                            response.error.forEach(display_errors);
                            setTimeout(function(){
                                location.reload();
                            },100);
                        }
                    }            
                });
            }
        });

        function display_errors( item, index) {
            $('#error').append('<div>'+item+'</div>');
        }
        </script>
        <script>
            $(window).scroll(function(){
                if ($(this).scrollTop() > 50) {
                $('#top-navbar-animated').addClass('bg-dark-50');
                } else {
                $('#top-navbar-animated').removeClass('bg-dark-50');
                }
            });
        </script>
        <script>
            AOS.init();
        </script>
    </body>
</html>