@extends('front.customer.layout.template')
@section('add_on_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    .announcement-pane {
        position: absolute;
        top: 0;
        background: linear-gradient(358deg, {{ $result->primary_color }}, {{ $result->primary_color }});
        width: 100%;
        height: 10%;
        text-align: center;
        vertical-align: middle;
        color: white;
       
    }

    .m-div {
        display: inline-flex;
        margin-top: 15px;
        padding-right: 30px;
    }
</style>
@endsection
@section('content')
    <!--  Razorpay succes and fail messages are shows here   -->
    @if (!empty($result))
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
                                        href={{ Storage::url('public/invoice'). '/' . str_replace('/', '_', $payment_invoice_no ?? '') . '.pdf' }}>Download
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
                                    <span class="ms-1">{{ $banner->sub_title }} <span
                                            class="badge bg-danger rounded-pill">{{ $banner->tags }}</span></span>
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
        <style>
            .rightchat {
                position: fixed;
                top: 50%;
                transform: translateY(-50%);
                right: 0;
                z-index: 1;
            }
            .callus-app {
                width: 50px;
                height: 50px;
                background-color: #3396d6;
                text-align: center;
                cursor: pointer;
                padding: 5px 10px;
                margin-bottom: 10px;
                transition: all .5s linear 0s;
            }
            .callus-app a, .callus-app a img {
                width: 30px;
                height: 30px;
                font-size: 30px;
                color: #fff;
                display: inline-block;
                position: relative;
                top: 40%;
                transform: translateY(-50%);
            }
        </style>
        <div class="rightchat">
            <div class="callus-app">
              <a href="{{ csettings('whatsapp_chat_link') }}" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
            </div>
            <div class="callus-app">
              <a href="{{ csettings('instagram_chat_link') }}" target="_blank">
                <i class="fa fa-telegram"></i>
              </a>
            </div>
        </div>

        {!! $result->iframe_tags !!}

        <style>

            .loader {
            width: 60px;
            position: absolute;
                z-index: 9;
                top: 20%;
                left: 50%;
            }
            
            .loader-wheel {
            animation: spin 1s infinite linear;
            border: 2px solid rgba(30, 30, 30, 0.5);
            border-left: 4px solid #fff;
            border-radius: 50%;
            height: 50px;
            margin-bottom: 10px;
            width: 50px;
            }
            
            .loader-text {
            color: #fff;
            font-family: arial, sans-serif;
            }
            
            .loader-text:after {
            content: 'Loading';
            animation: load 2s linear infinite;
            }
            
            @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
            }
            
            @keyframes load {
            0% {
                content: 'Loading';
            }
            33% {
                content: 'Loading.';
            }
            67% {
                content: 'Loading..';
            }
            100% {
                content: 'Loading...';
            }
            }
            </style>
        <section class="py-3" style="position: relative;">
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-md">
                        <h3 class="h3" class="aos-init" data-aos="fade-up"
                            data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                            Subscribe with us get the newsletter
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <form id="subscription_form">
                            @csrf
                            <div class="loader" style="display: none;">
                                <div class="loader-wheel"></div>
                                <div class="loader-text"></div>
                            </div>
                            <div class="btn-group border shadow-sm rounded w-100 aos-init" data-aos="fade-up"
                            data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
                            <div class="w-100 bg-white" id="subscripe-input">
                                <input class="form-control  border-0 rounded-0  w-100 p-3" type="email"
                                    id="subscribe_email" name="subscribe_email" placeholder="Enter your email..." autocomplete="off">
                            </div>
                            <div class="">
                                <button type="button"
                                    class=" border-0 rounded-0 btn h-100 btn-primary p-3" id="subscribe-btn">Subscribe</button>
                            </div>
                        </div>
                        </form>
                    
                    </div>
                </div>
            </div>
        </section>
        @else
        <div class="container d-flex w-100 h-100 p-3 mx-auto justify-content-center align-items-center text-center"
            style="min-height: 100vh">
            <main class="px-4">
                <h1>There is no, <br> Published landing page here!</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum laboriosam
                    facilis animi recusandae voluptates quisquam itaque numquam et voluptate fugit aperiam labore
                    accusantium beatae aspernatur ab, nobis neque vel nostrum.</p>
            </main>
        </div>
    @endif


  
  
@endsection
@section('add_on_script')
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
                url: "{{ route('get.buy.form', $companyCode) }}",
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

        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('#top-navbar-animated').addClass('bg-dark-50');
            } else {
                $('#top-navbar-animated').removeClass('bg-dark-50');
            }
        });

        AOS.init();

        $('#nav-landing .nav-item a').on('click', function(event) {
            $('#nav-landing .nav-item a').removeClass('active');

            setTimeout(function(){
                $(this).addClass('active');
            }, 500);
            
        });

        $(window).on('scroll', function() {
            $('.target').each(function() {
                // console.log( 'window top ', $(window).scrollTop() );
                // console.log( 'position top', $(this).position().top );
                // console.log( ' id', $(this).attr('id') );
                var window_top = parseInt($(window).scrollTop());
                var position_top = parseInt($(this).position().top);
                if( window_top >= position_top ) {
                    var id = $(this).attr('id');
                    $('#nav-landing .nav-item a').removeClass('active');
                    $('#nav-landing .nav-item a[href="#'+ id +'"]').addClass('active');
                }
            });
        });

        $('#subscribe-btn').click(function(){
            $('#subscripe-input').removeClass('border border-danger');

            var subscribe_email = $('#subscribe_email').val();
            if( subscribe_email == '' || subscribe_email == undefined || subscribe_email == null ) {
                $('#subscripe-input').addClass('border border-danger');
                $('#subscribe_email').focus();
                return false;
            }
            var form = $('#subscription_form').serialize();
            $.ajax({
                url:"{{ route('subscribe.newsletter', $companyCode) }}",
                type: "POST",
                data: form,
                beforeSend: function(){
                    $('.loader').show();
                    $('#subscribe-btn').prop('disabled', true);
                },
                success: function(response) {
                    $('.loader').hide();
                    $('#error').show();
                    $('#error').html('');

                    $('#subscribe-btn').prop('disabled', false);
                    if( response.status == 1 ) {
                        $('#error').removeClass('alert alert-success');
                        $('#error').addClass('alert alert-danger');
                        response.error.forEach(display_errors);
                    } else {
                        $('#error').removeClass('alert alert-danger');
                        $('#error').addClass('alert alert-success');
                        response.error.forEach(display_errors);
                        $('#subscription_form')[0].reset();

                    }
                    $('#error').fadeOut(5000);
                    
                }

            });
        });

        $('#subscribe_email').keyup(function(){
            if( this.value.length > 0 ){
                $('#subscripe-input').removeClass('border border-danger');

            } else {
                $('#subscripe-input').addClass('border border-danger');
            }
        });
    </script>
@endsection
    