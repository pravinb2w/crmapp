@php
    $user = \DB::table('users')->where('is_dev', 1)->whereNotNull('sorting_order')->first();
    // dd( $meta_data );
@endphp
<head>
    <meta charset="utf-8" />
    @if ($result)
        <title>{{ $result->page_title }}</title>
        <link rel="shortcut icon" href="{{ asset('storage/' . $result->page_logo) }}">
    @endif
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@if( isset($meta_data) && !empty($meta_data))
@foreach ($meta_data as $item)
    <meta content="{{ $item->description }}" name="{{ $item->name }}" />
@endforeach
@endif
   
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="canonical" href="{{ $_SERVER['HTTP_REFERER'] ?? '' }}" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/custom/css/effect.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    @if (empty($result))
        <link rel="stylesheet" href="https://getbootstrap.com/docs/5.1/examples/cover/cover.css">
    @endif
    @if (!empty($result))
        {!! $result->other_tags !!}
    @endif
    <style>
        :root {
            --bs-primary-light: #0088EA8c;
            --bs-primary: {{ $user->primary_color }};
            --bs-secondary: {{ $user->secondary_color }};
            --bs-blue: #00BFFF;
            --bs-indigo: #727cf5;
            --bs-purple: #6b5eae;
            --bs-pink: #ff679b;
            --bs-red: #fa5c7c;
            --bs-orange: #fd7e14;
            --bs-yellow: #ffbc00;
            --bs-green: #0acf97;
            --bs-teal: #02a8b5;
            --bs-cyan: #39afd1;
            --bs-white: #fff;
            --bs-gray: #98a6ad;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f1f3fa;
            --bs-gray-200: #eef2f7;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #98a6ad;
            --bs-gray-700: #6c757d;
            --bs-gray-800: #343a40;
            --bs-gray-900: #313a46;
           
            --bs-success: #0acf97;
            --bs-info: #39afd1;
            --bs-warning: #ffbc00;
            --bs-danger: #fa5c7c;
            --bs-light: #eef2f7;
            --bs-dark: #313a46;
            --bs-primary-rgb: 114, 124, 245;
            --bs-secondary-rgb: 108, 117, 125;
            --bs-success-rgb: 10, 207, 151;
            --bs-info-rgb: 57, 175, 209;
            --bs-warning-rgb: 255, 188, 0;
            --bs-danger-rgb: 250, 92, 124;
            --bs-light-rgb: 238, 242, 247;
            --bs-dark-rgb: 49, 58, 70;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-body-color-rgb: 108, 117, 125;
            --bs-body-bg-rgb: 250, 251, 254;
            --bs-font-sans-serif: "Nunito", sans-serif;
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: Nunito, sans-serif;
            --bs-body-font-size: 13px;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #6c757d;
            --bs-body-bg: #fafbfe;

            --side-bar-bg : var(--bs-primary);
            --side-bar-text : white;
            --side-bar-size : 220px;
        }
        div#notification_tab{
            overflow-y: auto;
        }
        div#notification_tab::-webkit-scrollbar {width: 5px;/* color: darkred; */background: #70c0dbe0;}

        div#notification_tab::-webkit-scrollbar-thumb {background: lightgray;}
    </style>

    @if (!empty($result))

        @yield('add_on_style')
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
       
    }

    .m-div {
        display: inline-flex;
        margin-top: 15px;
        padding-right: 30px;
    }
</style>

