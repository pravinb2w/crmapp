@extends('crm.layouts.template')

@section('content')
<style>
    .loader{
    position: absolute;
    top:0px;
    right:0px;
    border: 10px solid #f3f3f3; /* Light grey */
    border-top: 10px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 75px;
    height: 75px;
    animation: spin 0.5s linear infinite;
    background-position:center;
    z-index:10000000;
    opacity: 0.4;
    filter: alpha(opacity=40);
    left: 50%;
    top: 30%;
    display: none;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Account</li>
                    </ol>
                </div>
                <h4 class="page-title">Personal Preferences</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preferences</h4> --}}

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#horizontal-form-profile" data-bs-toggle="tab" onclick="return get_settings_tab('profile')" aria-expanded="false" class="nav-link @if($type=='profile')active @endif">
                                Profile
                            </a>
                        </li>
                        @if(Auth::user()->hasAccess('account', 'is_edit'))

                        <li class="nav-item">
                            <a href="#horizontal-form-company" data-bs-toggle="tab" onclick="return get_settings_tab('company')" aria-expanded="false" class="nav-link">
                                Company
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-api" data-bs-toggle="tab" onclick="return get_settings_tab('sms')" aria-expanded="true" class="nav-link">
                                SMS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-api" data-bs-toggle="tab" onclick="return get_settings_tab('api')" aria-expanded="true" class="nav-link">
                                API
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#horizontal-form-link" data-bs-toggle="tab" onclick="return get_settings_tab('link')" aria-expanded="true" class="nav-link">
                                Link
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-mail" data-bs-toggle="tab" onclick="return get_settings_tab('mail')" aria-expanded="true" class="nav-link">
                                Mail
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-subscription" data-bs-toggle="tab" onclick="return get_settings_tab('subscription')" aria-expanded="true" class="nav-link">
                                Subscription
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-prefix" data-bs-toggle="tab" onclick="return get_settings_tab('prefix')" aria-expanded="true" class="nav-link">
                                Prefix
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-code" data-bs-toggle="tab" onclick="return get_settings_tab('common')" aria-expanded="true" class="nav-link @if($type=='common') active @endif">
                                Common
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-code" data-bs-toggle="tab" onclick="return get_settings_tab('payment')" aria-expanded="true" class="nav-link @if($type=='payment') active @endif">
                                Payment
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="#horizontal-form-code" data-bs-toggle="tab" onclick="return get_settings_tab('change')" aria-expanded="true" class="nav-link @if($type=='change') active @endif">
                                Change Password
                            </a>
                        </li>
                    </ul> 
                    <!-- end nav-->
                    <div class="tab-content" style="position: relative">
                        <div class="tab-pane show active" id="horizontal-form-profile">
                        </div> <!-- end preview-->
                        <div class="loader"></div>

                    </div> <!-- end tab-content-->
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div>
</div>
<!-- Pre-loader -->
<!-- End Preloader-->
@endsection
@section('add_on_script')
<script>
    get_settings_tab('{{ $type }}');
    function get_settings_tab(type) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{ route("settings.tab") }}',
            type: 'POST',
            data: {type:type},
            beforeSend: function() {
                $('.loader').show();
            },
            success: function(response) {
                $('#horizontal-form-profile').html(response);
                $('.loader').hide();
            }            
        });
    }

    
</script>
    
@endsection