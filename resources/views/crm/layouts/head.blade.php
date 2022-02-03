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
    <!-- third party css -->
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
    
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