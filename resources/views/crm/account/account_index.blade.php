@extends('crm.layouts.template')

@section('content')
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
                <h4 class="page-title">Personal Preference</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Personal Preference</h4> --}}

                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#horizontal-form-profile" data-bs-toggle="tab" onclick="return get_settings_tab('profile')" aria-expanded="false" class="nav-link active">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-company" data-bs-toggle="tab" onclick="return get_settings_tab('company')" aria-expanded="false" class="nav-link">
                                Company
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-api" data-bs-toggle="tab" onclick="return get_settings_tab('api')" aria-expanded="true" class="nav-link">
                                Api
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-link" data-bs-toggle="tab" onclick="return get_settings_tab('link')" aria-expanded="true" class="nav-link">
                                Link
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#horizontal-form-code" data-bs-toggle="tab" onclick="return get_settings_tab('change')" aria-expanded="true" class="nav-link">
                                Change Password
                            </a>
                        </li>
                    </ul> 
                    <!-- end nav-->
                    <div class="tab-content">
                        <div class="tab-pane show active" id="horizontal-form-profile">
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div>
</div>
@endsection
@section('add_on_script')
<script>
    get_settings_tab('profile');
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
            },
            success: function(response) {
                $('#horizontal-form-profile').html(response);
            }            
        });
    }

    
</script>
    
@endsection