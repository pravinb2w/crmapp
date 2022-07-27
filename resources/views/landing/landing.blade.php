<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    @if ($result)
        <title>{{ $result->page_title }}</title>
        <link rel="shortcut icon" href="{{ asset('storage/' . $result->page_logo) }}">
    @endif
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ $result->meta_description ?? '' }}" name="{{ $result->meta_title ?? '' }}" />
   
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/custom/css/effect.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    @if (empty($result))
        <link rel="stylesheet" href="https://getbootstrap.com/docs/5.1/examples/cover/cover.css">
    @endif
    @if (!empty($result))
        {!! $result->other_tags !!}
    @endif
    @if (!empty($result))
        <style>
            #top-navbar-animated .nav-link.active {
                color: {{ $result->primary_color }} !important
            }

            .bg-dark-50 {
                border-bottom: 2px solid {{ $result->primary_color }} !important
            }

            iframe {
                min-height: 50vh !important;
                width: 100% !important
            }

            .text-primary {
                color: {{ $result->primary_color }} !important;
            }

            .btn-outline-primary {
                color: {{ $result->primary_color }} !important;
                border-color: {{ $result->primary_color }} !important;
            }

            .btn-outline-primary:hover {
                background-image: linear-gradient(to right, {{ $result->primary_color }} 0%, {{ $result->secondary_color }} 51%, {{ $result->primary_color }} 100%);
                background-size: 200% auto;
                color: white !important;
                border-color: {{ $result->primary_color }} !important;
            }

            .btn-primary {
                background-image: linear-gradient(to right, {{ $result->primary_color }} 0%, {{ $result->secondary_color }} 51%, {{ $result->primary_color }} 100%);
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
                    transform: translate(0, 0) !important;
                    width: 100% !important;
                }

                .padding-left-250 {
                    padding-left: 35px !important
                }
            }

            .contact-card {
                transform: translate(-240px, 80px);
                z-index: 1;
                color: white;
                width: 450px;
                top: 0%;
                left: 0%
            }

            .padding-left-250 {
                padding: 35px 35px 35px 250px;
            }

            .bg-trans {
                background: transparent !important;
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
                transform: translate(-50%, -50%) !important;
                width: 100%;
                text-align: center !important
            }
        </style>
    @endif
</head>
<style>
    .announcement-pane {
        position: absolute;
        top: 0;
        background: linear-gradient(358deg, {{ $result->primary_color }}, {{ $result->primary_color }});
        width: 100%;
        height: 10%;
        text-align: center;
        vertical-align: middle;
        color: white;
        /* animation: shake 5s; */
        /* animation-iteration-count: infinite; */
        /* border-radius: 5px;

        }
        @keyframes shake {
            0%   {transform: translate(0px, 1px) rotate(0deg);}
            25%  {transform: translate(5px, 3px) rotate(0deg);}
            50%  {transform: translate(10px, 3px) rotate(0deg);}
            100% {transform: translate(0px, 1px) rotate(0deg);}
        }
        .marquee-text {
            /*font-size: 18px;
            font-weight: 700;*/
    }

    .m-div {
        display: inline-flex;
        margin-top: 15px;
        padding-right: 30px;
    }
</style>
@if (!empty($result))

    <body class="loading" data-layout-config='{"darkMode":false}'>

        <!-- NAVBAR START -->
        <nav class="navbar navbar-expand-lg p-0 bg-dark-50 sticky-top w-100" id="top-navbar-animated">
            <div class="container">
                <!-- logo -->
                <a href="#contact-us" class="navbar-brand me-lg-5 ">
                    <img src="{{ $result->page_logo }}" alt="{{ $result->page_title }}" class="logo-dark"
                        height="60" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="mdi text-white mdi-menu" style="text-shadow: 0 2px black;"></i>
                </button>

                <!-- menus -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <ul class="navbar-nav ms-auto py-2 align-items-center" id="nav-landing">

                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="#LandingBannnerSliders">Home</a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="#about-us">About</a>
                        </li>
						 <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="#crm-features">Services</a>
                        </li>
						 @if (csettings('show_products'))
							@if (isset($products) && !empty($products))
				                <li class="nav-item mx-lg-1">
                                    <a class="nav-link text-white" href="#products">Products</a>
                                </li>
							@endif
						@endif
						
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="#contact-us">Contact</a>
                        </li>
                        {{-- <li class="nav-item me-0 ms-3">
                                <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" target="_blank" class="nav-link d-lg-none">Purchase now</a>
                                <a href="login" target="_blank" class="btn btn-sm btn-primary rounded-pill d-none d-lg-inline-flex">
                                    <i class="mdi mdi-login-variant me-2"></i> LOGIN
                                </a>
                            </li> --}}
                    </ul>

                </div>
            </div>
        </nav>
        <!-- NAVBAR END -->
        <!--  Razorpay succes and fail messages are shows here   -->

        @if (isset($payment_error) && !empty($payment_error))
            {{-- @include('front.razor_pay_response') --}}
            <section class="py-3" id="about-us1">
                <div class="container">
                    @php
                        
                    @endphp
                    @if ($payment_error == 'success')
                        <div class="row pb-3 pt-3 align-items-center bg-success">
                            <div class="col-lg-12 col-md-12">
                                <div class=" text-center">
                                    <h2 class="text-white mb-2 w-100 aos-init"data-aos="fade-up"
                                        data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                                        Your order Payment Successfully done
                                    </h2>
                                    <p class="w-100 text-center text-white">
                                        Order No: {{ $payment_order_no ?? 'N/A' }}
                                    </p>
                                    <a class="btn btn-primary btn-sm" target="_blank"
                                        href="{{ asset('invoice') . '/' . str_replace('/', '_', $payment_invoice_no ?? '') . '.pdf' }}">Download
                                        Invoice</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($payment_error == 'error')
                        <div class="row pb-3 pt-3 align-items-center bg-danger">
                            <div class="col-lg-12 col-md-12">
                                <div class=" text-center">
                                    <h2 class="text-white mb-2 w-100 aos-init"data-aos="fade-up"
                                        data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                                        {{ $payment_message ?? 'Your order Payment has Failed' }}
                                    </h2>
                                    <p class="w-100 text-center text-white">
                                        Order No: {{ $payment_order_no ?? 'N/A' }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        @endif
        <!-- START HERO -->
        <div id="LandingBannnerSliders" class="carousel slide target" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                @if ($result->LandingPageBannerSliders)
                    @foreach ($result->LandingPageBannerSliders as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="slider-img w-100"
                                style="min-height: 70vh;background: linear-gradient( #020202c9 50%, #00d9ff34) , url('{{ $banner->image }}');background-size:cover">
                            </div>
                            <div class="carousel-caption">
                                <div>
                                    <span class="ms-1">Welcome to Brand <span
                                            class="badge bg-danger rounded-pill">New</span></span>
                                </div>
                                <h2 class="fw-normal text-white mb-4 mt-3 hero-title">
                                    {{ $banner->title }}
                                </h2>
                                <p class="mb-4  w-75 mx-auto font-16 text-light">{{ $banner->content }}</p>
                                <!--<a href="#contact-us" class="btn btn-primary rounded-pill">Get Started</a>-->
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#LandingBannnerSliders" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#LandingBannnerSliders" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        <!-- END HERO -->
        <!-- START FEATURES 2 -->

        <section class="py-3 target" id="about-us" style="position: relative">
            @if (isset($announcements) && !empty($announcements) && count($announcements) > 0)
                <div class="announcement-pane">
                    <marquee class="marquee-text">
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($announcements as $ment)
                            <div class="m-div">
                               
                                @if( $count != 0 )
                                <span class="px-3"> | </span>
                                @endif
								 {!! $ment->message !!}
                            </div>
                            @php
                                $count++;
                            @endphp
                        @endforeach
                    </marquee>

                </div>
            @endif
            <div class="container">
                <div class="row pb-3 pt-5 align-items-center">
                    <div class="col-lg-6 col-md-5">
                        <h3 class="aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="1000">{{ $result->about_title }}</h3>
                        <div class="mt-4">
                            <p class="text-muted mb-3 aos-init"data-aos="fade-up"
                                data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                                {!! $result->about_content !!}
                            </p>
                        </div>
                        <a href="#contact-us" class="btn btn-primary rounded-pill mt-3 aos-init" data-aos="fade-up"
                            data-aos-anchor-placement="top-bottom" data-aos-duration="2000">Know More <i
                                class="mdi mdi-arrow-right ms-1"></i></a>
                    </div>
                    <div class="col-lg-5 col-md-6 offset-md-1">
                        <div class="aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="2000">
                            <img src="{{ $result->file_about }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END FEATURES 2 -->

        <section class="py-3 bg-light target"  id="crm-features">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-head text-center">
                            <h1 class="text-primary">CRM Features</h1>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($result->LandingPageFeatures as $key => $row)
                        <div class="col-md-4">
                            <!-- InfoBox Center  <Start> -->
                            <div class="text-center mt-4 aos-init" data-aos="fade-up"
                                data-aos-anchor-placement="top-bottom" data-aos-duration="{{ $key + 1 }}000">
                                <img src="{{ $row->icon }}" width="45px" class="img-fluid">
                                <h4 class="text-primary">{{ $row->title }}</h4>
                                <p>{{ $row->content }}</p>
                            </div>
                            <!-- InfoBox Center </End> -->
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="py-3 text-center "
            style="background: linear-gradient(30deg, {{ $result->primary_color }} ,{{ $result->secondary_color }}">
            <div class="media-body">
                <h3 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000"
                    class="aos-init text-white display-5">Want to try CRM Software for Free?</h3>
                <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1400"
                    class="text-light my-4 mt-3 lead">Close more deals than ever, automatice lead captures,in-built
                    phone,smart alerts with push notifcations.</p>
                <div class="aos-init " data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="1800">
                    <a href="#contact-us" style="border-width: 2px"
                        class="aos-init btn btn-outline-light px-md-5 shadow py-2 rounded-pill"><b
                            class="lead"><strong>Contact Now !</strong></b></a>
                </div>
            </div>
        </section>
        @if (csettings('show_products'))
            @if (isset($products) && !empty($products))
                <link rel="stylesheet" href="{{ asset('assets/custom/css/product-list.css') }}">
                <section class="py-3 target" id="products">
                    <div class="row bg-white">
                        <div class="col-12 text-center p-2">
                            <h1 class="text-primary w-100 product-head"> Explore our Products </h1>
                        </div>
                        <div class="listing-section bg-white row">
                            @foreach ($products as $item)
                                <div class="col-sm-3 col-md-4 col-lg-6 col-xl-3 p-pane">
                                    <div class="image-box">
                                        @if ($item->image)
                                            <div class="images" id="image-1"
                                                style="background-image: url('{{ $item->image }}')"></div>
                                        @else
                                            <div class="images" id="image-1"
                                                style="background-image: url('{{ asset('assets/images/products/noimage.png') }}')">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-box">
                                        <h2 class="item product-head">{{ $item->product_name }}</h2>
                                        <h3 class="price product-head">INR {{ $item->price }}</h3>
                                        <p class="description">
                                            {{ mb_strimwidth($item->description ?? '', 0, 100, '...') }}</p>
                                        <button type="button" name="item-1-button"
                                            class="btn btn-primary product-head"
                                            onclick="return get_buy_form('{{ $item->id }}')">Buy Now</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @endif

        <section class=" py-3 bg-light target" id="contact-us">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-9 h-100 ms-auto position-relative p-0">
                        <div class="card position-absolute contact-card rounded-5"
                            style="background: linear-gradient( #020202c9 50%, #00d9ff34) , url('https://poetsandquants.com/wp-content/uploads/sites/5/2021/12/analytics.jpg');background-size:cover">
                            <div class="card-body p-4">
                                <h1>Request a call back</h1>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae optio, maxime illo
                                    nisi distinctio, error temporibus</p>
                                <div class="py-4">
                                    <a href="tel:{{ $result->call_us }}" class="d-flex align-items-center mb-3">
                                        <div class="text-primary mdi mdi-phone-in-talk fa-lg"></div>
                                        <div class="text-white">
                                            <strong>Call US</strong>
                                            <div>{{ $result->call_us }}</div>
                                        </div>
                                    </a>
                                    <a href="mailto:{{ $result->mail_us }}" class="d-flex align-items-center mb-3">
                                        <div class="text-primary mdi mdi-email fa-lg"></div>
                                        <div class="text-white">
                                            <strong>Mail US</strong>
                                            <div>{{ $result->mail_us }}</div>
                                        </div>
                                    </a>
                                    <div class="d-flex align-items-center">
                                        <div class="text-primary mdi mdi-map-marker fa-lg"></div>
                                        <div>
                                            <strong>Call US</strong>
                                            <div>{{ $result->contact_us }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card h-100 padding-left-250" style="min-height: 80vh">
                            <div class="card-body py-lg-5" style="position: relative;">
                                <div class="px-2">
                                    <h3 class="h3">CONTACT US</h3>
                                    <p>Enter your details to receive a call back from us</p>
                                </div>
                                @include('landing.enquiry')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {!! $result->iframe_tags !!}

        <section class="py-3">
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-md">
                        <h3 class="h3" class="aos-init" data-aos="fade-up"
                            data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                            Subscribe with us get the newsletter
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group border shadow-sm rounded w-100 aos-init" data-aos="fade-up"
                            data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                            <div class="w-100 bg-white">
                                <input class="form-control  border-0 rounded-0  w-100 p-3" type="text"
                                    id="subject" placeholder="Enter your email...">
                            </div>
                            <div class="">
                                <button type="submit"
                                    class=" border-0 rounded-0 btn h-100 btn-primary p-3">Subscribe</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="py-3 text-center "
            style="background: linear-gradient(#020202e0 50%, #00d9ff34) , url('https://images.unsplash.com/photo-1587560699334-cc4ff634909a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');background-size:cover;backdrop-filter:blur(5px)">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-12 text-center">
                        {{-- <img src="assets/images/logo.png" alt="" class="logo-dark" height="18" /> --}}

                        <div class="aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="1400">
                            <strong class="text-white"> {{ $site_name ?? '' }}</strong>
                        </div>
                        <p class="text-white mt-4 aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="1500">{{ $site_name ?? '' }} makes it easier to build better websites
                            with
                            <br> great speed. Save hundreds of hours of design
                            <br> and development by using it.
                        </p>

                        <div class="aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="2000">
                            @if ($result->LandingPageSocialMedias == [])
                                <strong class="text-primary">Follow Us On Social...</strong>
                            @endif
                            <ul class="social-list list-inline mt-3">
                                @if ($result->LandingPageSocialMedias)
                                    @foreach ($result->LandingPageSocialMedias as $media)
                                        <li class="list-inline-item text-center">
                                            <a href="{{ $media->link }}"
                                                class="social-list-item border-primary text-white btn-outline-primary">
                                                @if ($media->name == 'Gmail')
                                                    <i class="mdi mdi-google"></i>
                                                @endif
                                                @if ($media->name == 'Whatsapp')
                                                    <i class="mdi mdi-whatsapp"></i>
                                                @endif
                                                @if ($media->name == 'Instagram')
                                                    <i class="mdi mdi-instagram"></i>
                                                @endif
                                                @if ($media->name == 'Reddit')
                                                    <i class="mdi mdi-reddit"></i>
                                                @endif
                                                @if ($media->name == 'Snapchat')
                                                    <i class="mdi mdi-snapchat"></i>
                                                @endif
                                                @if ($media->name == 'YouTube')
                                                    <i class="mdi mdi-youtube"></i>
                                                @endif
                                                @if ($media->name == 'Facebook')
                                                    <i class="mdi mdi-facebook"></i>
                                                @endif
                                                @if ($media->name == 'Twitter')
                                                    <i class="mdi mdi-twitter"></i>
                                                @endif
                                                @if ($media->name == 'LinkedIn')
                                                    <i class="mdi mdi-linkedin"></i>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <div class="aos-init" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="2400">
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
                            <p class="text-light mt-4 text-center mb-0">
                                {{ $copyrights ??
                                    '© 2022 - 2023 PHOENIX TECHNOLOGIES.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="modal fade show" id="Mymodal" tabindex="-1" aria-labelledby="myLargeModalLabel"
            aria-modal="true" role="dialog">
            <!-- /.modal-dialog -->
        </div>

        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            $(".enquiry-form").validate({
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        beforeSend: function() {
                            $('#error').removeClass('alert alert-danger');
                            $('#error').html('');
                            $('#error').removeClass('alert alert-success');
                            $('.loader').show();
                            $('#send_msg').prop('disabled', true);
                        },
                        success: function(response) {
                            $('.loader').hide();
                            $('#send_msg').prop('disabled', false);

                            if (response.error.length > 0 && response.status == "1") {
                                $('#error').addClass('alert alert-danger');
                                response.error.forEach(display_errors);
                            } else {
                                $('#error').addClass('alert alert-success');
                                response.error.forEach(display_errors);
                                setTimeout(function() {
                                    location.reload();
                                }, 100);
                            }
                        }
                    });
                }
            });

            function get_buy_form(product_id) {
                $.ajax({
                    url: "{{ route('get.buy.form') }}",
                    type: 'GET',
                    data: {
                        product_id: product_id
                    },
                    success: function(res) {
                        $('#Mymodal').html(res);
                        $('#Mymodal').modal('show');
                    }
                });
            }

            function display_errors(item, index) {
                $('#error').append('<div>' + item + '</div>');
            }
        </script>
        <script>
            $(window).scroll(function() {
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
@else

    <body class="h-100">
        <div class="container d-flex w-100 h-100 p-3 mx-auto justify-content-center align-items-center text-center"
            style="min-height: 100vh">
            <main class="px-4">
                <h1>There is no, <br> Published landing page here!</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum laboriosam
                    facilis animi recusandae voluptates quisquam itaque numquam et voluptate fugit aperiam labore
                    accusantium beatae aspernatur ab, nobis neque vel nostrum.</p>
            </main>
        </div>
    </body>
@endif

</html>
<script>
    $('#nav-landing .nav-item a').on('click', function(event) {
        $(this).parent().find('a').removeClass('active');
        $(this).addClass('active');
    });

$(window).on('scroll', function() {
    $('.target').each(function() {
        if($(window).scrollTop() >= $(this).position().top) {
            var id = $(this).attr('id');
            $('#nav-landing .nav-item a').removeClass('active');
            $('#nav-landing .nav-item a[href="#'+ id +'"]').addClass('active');
        }
    });
});
</script>