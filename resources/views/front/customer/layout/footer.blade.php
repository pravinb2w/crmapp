<footer class="py-3 text-center "
            style="background: linear-gradient(#020202e0 50%, #00d9ff34) , url('http://images.unsplash.com/photo-1587560699334-cc4ff634909a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');background-size:cover;backdrop-filter:blur(5px)">
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
            @if( !isset($not_home) )
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
            @endif
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