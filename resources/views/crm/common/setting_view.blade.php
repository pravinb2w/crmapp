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
                        <li class="breadcrumb-item active">Company Subscriptions</li>
                    </ol>
                </div>
                <h4 class="page-title">Settings </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    <div class="row">
        <div class="col-lg-2">
            <div>
                @include('crm.layouts.setup_menu')             
            </div>
        </div>
        <div class="col-lg-10" id="setup_menu_view">
            
        </div>
    </div>
</div>


@endsection
