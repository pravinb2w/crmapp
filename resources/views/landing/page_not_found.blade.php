@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-5 col-lg-6">
        <div class="card">

            <!-- Logo -->
            <div class="card-header py-3 text-center bg-light">
                <a href="/">
                    @if( isset($cm_logo) && !empty($cm_logo))
                        <img src="{{ asset('storage/'.$cm_logo) }}" alt="" width="350px;">
                    @else
                        <span><img src="{{ asset('assets/images/logo/logo-xl.png') }}" width="320px"></span>
                    @endif
                </a>
            </div>
            
            <div class="card-body p-4 py-3">
                <div class="text-cente w-75 m-auto">
                    <h4 class="text-dark-50 text-danger text-center pb-0 fw-bold">{{ $error_title }}</h4>
                    <p class="text-danger mb-4">{{ $error_message }}</p>
                </div>
               
            </div> <!-- end card-body -->
        </div>

    </div> <!-- end col -->
</div>
@endsection