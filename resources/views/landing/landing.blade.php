<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Phonix CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/icons.min.css' ) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />        

    </head>

    <body class="loading" data-layout-config='{"darkMode":false}'>

        <!-- NAVBAR START -->
        <nav class="navbar navbar-expand-lg bg-primary p-0 navbar-dark">
            <div class="container">

                <!-- logo -->
                <a href="index.html" class="navbar-brand me-lg-5 ">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" style="filter:brightness(10);transform:scale(.8)" class="logo-dark" width="100px"  />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <!-- menus -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                    <!-- left menu -->
                    <ul class="navbar-nav ms-auto py-2 align-items-center"> 
                        <li class="nav-item mx-lg-1 text-center">
                            <a href="javascript: void(0);" class="social-list-item border text-white"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="nav-item mx-lg-1 text-center">
                            <a href="javascript: void(0);" class="social-list-item border text-white"><i class="mdi mdi-instagram"></i></a>
                        </li>
                        <li class="nav-item mx-lg-1 text-center">
                            <a href="javascript: void(0);" class="social-list-item border text-white"><i class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="nav-item mx-lg-1 text-center">
                            <a href="javascript: void(0);" class="social-list-item border text-white"><i class="mdi mdi-google"></i></a>
                        </li>
                        <li class="nav-item mx-lg-1">
                            <a class="nav-link text-white" href="">Contact us</a>
                        </li>
                        <li class="nav-item me-0 ms-3">
                            <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/" target="_blank" class="nav-link d-lg-none">Purchase now</a>
                            <a href="login" target="_blank" class="btn btn-sm btn-light rounded-pill d-none d-lg-inline-flex">
                                <i class="mdi mdi-login-variant me-2"></i> LOGIN
                            </a>
                        </li>
                    </ul> 

                </div>
            </div>
        </nav>
        <!-- NAVBAR END -->

        <!-- START HERO --> 
        <div id="carouselExampleCaption" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="slider-img w-100" style="min-height: 90vh;background: linear-gradient(#02020285, #000000) , url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1115&q=80');background-size:cover"></div>
                    <div class="carousel-caption p-0  d-none d-md-block">
                        <div class="row m-0 align-items-center" style="min-height: 90vh">
                            <div class="col-md-7 h-100 text-start">
                                <div>
                                    <span class="text-white-50 ms-1">Welcome to Brand <span class="badge bg-danger rounded-pill">New</span></span>
                                </div>
                                <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                                   Phoenix - Customer relationship management system 
                                </h2>
                                <p class="mb-4 font-16 text-white-50">Phoenix CRM is a fully featured  with business or other organization administers its interactions with customers, typically using data analysis to study large amounts of information.</p>
                            </div>
                            <div class="col-md-5 h-100 p-4 border rounded shadow" style="backdrop-filter: blur(20px)">
                                <form id="enquiry-form" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
                                    <div id="error"></div>
                                    <h3 class="h3 text-center">
                                        Reach us
                                    </h3>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="fullname" class="form-label">Your Name</label>
                                                <input class="form-control form-control-light" type="text" id="fullname" name="fullname" placeholder="Name..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="emailaddress" class="form-label">Your Email</label>
                                                <input class="form-control form-control-light" name="email" type="email" required id="emailaddress" placeholder="Enter you email...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Mobile Number</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Company</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Remarks</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-2">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">Send a Message <i
                                                class="mdi mdi-telegram ms-1"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-img w-100" style="min-height: 90vh;background: linear-gradient(#02020285, #000000) , url('https://images.unsplash.com/photo-1599658880436-c61792e70672?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');background-size:cover"></div>
                    <div class="carousel-caption p-0  d-none d-md-block">
                        <div class="row m-0 align-items-center" style="min-height: 90vh">
                            <div class="col-md-7 text-start">
                                <div>
                                    <span class="text-white-50 ms-1">Welcome to Brand <span class="badge bg-danger rounded-pill">New</span></span>
                                </div>
                                <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                                   Phoenix - Customer relationship management system 
                                </h2>
                                <p class="mb-4 font-16 text-white-50">Phoenix CRM is a fully featured  with business or other organization administers its interactions with customers, typically using data analysis to study large amounts of information.</p>
                            </div>
                            <div class="col-md-5 p-4 border rounded shadow" style="backdrop-filter: blur(20px)">
                                <form id="enquiry-form" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
                                    <div id="error"></div>
                                    <h3 class="h3 text-center">
                                        Reach us
                                    </h3>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="fullname" class="form-label">Your Name</label>
                                                <input class="form-control form-control-light" type="text" id="fullname" name="fullname" placeholder="Name..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="emailaddress" class="form-label">Your Email</label>
                                                <input class="form-control form-control-light" name="email" type="email" required id="emailaddress" placeholder="Enter you email...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Mobile Number</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Company</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Remarks</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-2">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">Send a Message <i
                                                class="mdi mdi-telegram ms-1"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-img w-100" style="min-height: 90vh;background: linear-gradient(#02020285, #000000) , url('https://images.unsplash.com/photo-1504868584819-f8e8b4b6d7e3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1176&q=80');background-size:cover"></div>
                    <div class="carousel-caption p-0  d-none d-md-block">
                        <div class="row m-0 align-items-center" style="min-height: 90vh">
                            <div class="col-md-7 text-start">
                                <div>
                                    <span class="text-white-50 ms-1">Welcome to Brand <span class="badge bg-danger rounded-pill">New</span></span>
                                </div>
                                <h2 class="text-white fw-normal mb-4 mt-3 hero-title">
                                   Phoenix - Customer relationship management system 
                                </h2>
                                <p class="mb-4 font-16 text-white-50">Phoenix CRM is a fully featured  with business or other organization administers its interactions with customers, typically using data analysis to study large amounts of information.</p>
                            </div>
                            <div class="col-md-5 p-4 border rounded shadow" style="backdrop-filter: blur(20px)">
                                <form id="enquiry-form" method="POST" action="{{ route('enquiry.save') }}" autocomplete="off">
                                    <div id="error"></div>
                                    <h3 class="h3 text-center">
                                        Reach us
                                    </h3>
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="fullname" class="form-label">Your Name</label>
                                                <input class="form-control form-control-light" type="text" id="fullname" name="fullname" placeholder="Name..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="emailaddress" class="form-label">Your Email</label>
                                                <input class="form-control form-control-light" name="email" type="email" required id="emailaddress" placeholder="Enter you email...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Mobile Number</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Company</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2 text-start">
                                                <label for="subject" class="form-label">Remarks</label>
                                                <input class="form-control form-control-light" required name="subject" type="text" id="subject" placeholder="Enter subject...">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row mt-2">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">Send a Message <i
                                                class="mdi mdi-telegram ms-1"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaption" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaption" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
        <!-- END HERO -->

       <!-- START FEATURES 2 -->
         <section class="py-5">
            <div class="container"> 
                <div class="row pb-3 pt-5 align-items-center">
                    <div class="col-lg-6 col-md-5">
                        <h3 class="fw-normal">Who We are?</h3>
                        <div class="mt-4">
                            <p class="text-muted mb-3">Phoenix  CRM was originally designed to minimize the pain points of managing Small and Medium-Sized Companies with regards to Clients, Employees, and Finances.</p>
                            <p class="text-muted mb-3"> The Core Brain behind the development of Phoenix  CRM is having a huge experience in handling clients with regards to multiple industries and he found that most of the startup, small and medium scale companies are lagging in maintaining their own customers, new leads, followups with them, invoice tracking, finances and many other minor things which are affecting their business in a huge way. They are losing so many potential clients as well as their existing clients in the long run.</p>
                            <p class="text-muted mb-3"> Hence, we produced a system that will help them to overcome all these growth hurdles in their business and help them to reach the next level in their Business.</p>
                            <p class="text-muted mb-3"> Phoenix  CRM CRM(solidperformers.com) is owned by Phoenix  CRM Private Limited. We are a B2B Platform offering solutions only to Corporate Businesses of all sizes.</p>
                        </div>

                        <a href="" class="btn btn-primary rounded-pill mt-3">Read More <i class="mdi mdi-arrow-right ms-1"></i></a>

                    </div>
                    <div class="col-lg-5 col-md-6 offset-md-1">
                        <img src="{{ asset('assets/images/about-us.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div> 
            </div>
            </section>
        <!-- END FEATURES 2 -->   
 
        {{-- SERVICE --}}
            <section class="py-5 bg-light">
                <div class="container">
                    <div class="row pb-3 pt-5 align-items-center">
                        <div class="col-lg-8">
                            <h3 class="fw-normal">Our services</h3>
                            <p class="text-muted mt-3">
                                In recent years, there has been a growing number of independent writers who are making a living by connecting directly with their readers. That’s why we’re launching Bulletin, a set of publishing and subscription tools to support creators in the US. And today, we’re sharing Bulletin’s first wave of writers.
                                Through Bulletin, we want to support these creators, and unify our existing tools with something that could more directly support great writing and audio content — from podcasts to Live Audio Rooms — all in one place. We respect the work of writers and want to be clear that anyone who partners with us will have complete editorial independence.
                            </p>
                            <a href="" class="btn btn-primary rounded-pill mt-3">Know More <i class="mdi mdi-arrow-right ms-1"></i></a>
                        </div>
                        <div class="col-lg-4">
                            <div class="border rounded bg-white shadow p-4">
                                <h3 class="fw-normal">Features</h3> 
                                <div class="mt-4">
                                    <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Drag and Drop Interface CRM</p>
                                    <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Dynamic Data Management</p>
                                    <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i> Email Automation</p>
                                    <p class="text-muted"><i class="mdi mdi-circle-medium text-primary"></i>  Follow-Up Management</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-5">
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-md">
                            <h3 class="h3">
                                Subscribe with us get the newsletter
                            </h3>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group border shadow-sm rounded w-100">
                                <div class="w-100">
                                    <input class="form-control border-0 rounded-0  form-control-light w-100 p-3" type="text" id="subject" placeholder="Enter your e   mail...">
                                </div>
                                <div class="">
                                    <button type="submit" class=" border-0 rounded-0 btn btn-primary p-3">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="bg-primary py-5">
                <div class="container">
                    <div class="row justify-content-center" >
                        <div class="col-md-4 text-center">
                            {{-- <img src="assets/images/logo.png" alt="" class="logo-dark" height="18" /> --}}
                            <strong class="text-white"> PHOENIX</strong>
                            <p class="text-white mt-4">PHOENIX TECH makes it easier to build better websites with
                                <br> great speed. Save hundreds of hours of design
                                <br> and development by using it.</p>
    
                            <ul class="social-list list-inline mt-3">
                                <li class="list-inline-item text-center">
                                    <a href="javascript: void(0);" class="social-list-item border-white text-white"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item text-center">
                                    <a href="javascript: void(0);" class="social-list-item border-white text-white"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item text-center">
                                    <a href="javascript: void(0);" class="social-list-item border-white text-white"><i class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item text-center">
                                    <a href="javascript: void(0);" class="social-list-item border-white text-white"><i class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div>  
                        <div class="col-12 text-center">
                            <ul class="list-unstyled justify-content-center d-flex ps-0 mb-0 mt-3">
                                <li class="m-2"><a href="javascript: void(0);" class="text-light">About Us</a></li>
                                <li class="m-2"><a href="javascript: void(0);" class="text-light">Price</a></li>
                                <li class="m-2"><a href="javascript: void(0);" class="text-light">Blog</a></li>
                                <li class="m-2"><a href="javascript: void(0);" class="text-light">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-5">
                                <p class="text-light mt-4 text-center mb-0">{{ $copyrights ?? '© 2022 - 2023 PHOENIX. Design and coded by
                                    DuraiBytes' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <!-- bundle -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.min.js') }}"></script>

    </body>

</html>