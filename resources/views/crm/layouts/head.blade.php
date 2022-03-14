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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <!-- App css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/custom/css/variable.css') }}" rel="stylesheet" type="text/css" id="light-style" />
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