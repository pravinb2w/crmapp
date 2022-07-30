@php
    $user = \DB::table('users')->find(Auth()->user()->id);
    // dd( $meta_data );
@endphp
<head>
    <meta charset="utf-8" />
    <title>CRM {{ ucwords(Request::segment(1) ) ?? '' }}</title>
    <link rel="canonical" href="{{ $_SERVER['HTTP_REFERER'] ?? '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@if( isset($meta_data) && !empty($meta_data))
@foreach ($meta_data as $item)
    <meta content="{{ $item->description }}" name="{{ $item->name }}" />
@endforeach
@endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    {{-- {{ dd($cm_favicon) }} --}}
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/'.$cm_favicon) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- <link href="{{ asset('assets/custom/css/variable.css') }}" rel="stylesheet" type="text/css" id="light-style" /> --}}

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

    <link href="{{ asset('assets/custom/css/effect.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('assets/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" />

    <!-- third party css -->
    <link href="{{ asset('assets/css/vendor/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/vendor/responsive.bootstrap5.css') }}" rel="stylesheet" type="text/css" />
    
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/vendor/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/sweetalert2.all.min.css') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    
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
        .typeahead-custom {
        border: 1px dotted #ccc;
        padding: 3px;
        }
        .typeahead-custom ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        }
        .typeahead-custom ul li {
        padding: 5px 0;
        cursor: pointer;
        }
        .typeahead-custom ul li:hover {
        background: #eee;
        }
        .CodeMirror.cm-s-paper.CodeMirror-wrap {
            height: 50px !important;
            min-height: 50px !important;
        }
        .w-30 {
            width:30% !important;
        }
        .w-15 {
            width:15% !important;
        }
        .w-10 {
            width:10% !important;
        }
        .w-40 {
            width:40% !important;
        }
        .w-20 {
            width:20% !important;
        }
        .float-right {
            float: right;
        }
        table.dataTable.nowrap th, table.dataTable.nowrap td {
            white-space: nowrap;
            padding: 1px 15px;
        }
        th {
            padding: 10px !important;
        }
        .custom-content {
            width:700px;
        }
    </style>
</head>

<!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
 
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
        
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');

            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            
            @elseif(Session::has('warning'))
                toastr.warning('{{ Session::get('warning') }}');

        @endif 

        @if ($errors->any())
            @if( isset($message) )
                toastr.info('{{ $message }}');
            @endif
        @endif
    });

</script>
