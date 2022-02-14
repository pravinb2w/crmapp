<head>
    <meta charset="utf-8" />
    <title>CRM Dashboard | DuraiBytes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    
    {{-- {{ dd($cm_favicon) }} --}}
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/'.$cm_favicon) }}">
    
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/custom/css/variable.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/custom/css/effect.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    <!-- third party css -->
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/sweetalert2.all.min.css') }}">



    
    <style>
        input.error, textarea.error,select.error {
            border: 1px solid #fa5c7c;
        }
        .error {
            color:#fa5c7c;
        }
        .datepicker {
            width: fit-content;
        }
    </style>
</head>