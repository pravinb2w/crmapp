@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">

            <!-- Logo -->
            <div class="card-header py-3 text-center bg-light">
                <a href="/">
                    @if( isset($cm_logo) && !empty($cm_logo))
                        <img src="{{ asset('storage/'.$cm_logo) }}" alt="" width="350px;">
                    @else
                        <span><img src="{{ asset('assets/images/logo/logo-xl.png') }}" width="120px"></span>
                    @endif
                </a>
            </div>
            
            <div class="card-body p-4 py-3">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Reset Password</h4>
                </div>

                <form action="{{ route('forget.password.post') }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="mb-0 text-end">
                        <button class="btn btn-primary px-3" type="submit"><i class="fa fa-user"></i> Send Password Link </button>
                    </div>

                </form>
            </div> <!-- end card-body -->
            <div class="card-footer py-2 bg-light"></div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>
@endsection