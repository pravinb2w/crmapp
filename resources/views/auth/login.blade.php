@extends('layouts.auth')

@section('content')
<div class="row justify-content-center">
    <div class="col-xxl-4 col-lg-5">
        <div class="card">

            <!-- Logo -->
            <div class="card-header py-3 text-center bg-primary">
                <a href="/">
                    <span><img src="{{ asset('assets/images/logo/logo.png') }}" width="120px"></span>
                </a>
            </div>

            <div class="card-body p-4 py-3">
                
                <div class="text-center w-75 m-auto">
                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? 'admin@yopmail.com' }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @if (Route::has('password.request'))
                            <a class="text-muted float-end" href="{{ route('password.request') }}">
                                <small> {{ __('Forgot Your Password?') }} </small>
                            </a>
                        @endif
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group input-group-merge">
                            <input id="password" type="password" value="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>


                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="mb-3 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                        </div>
                    </div>

                    <div class="mb-0 text-end">
                        <button class="btn btn-primary px-3" type="submit"><i class="fa fa-user"></i> Log In </button>
                    </div>

                </form>
            </div> <!-- end card-body -->
            <div class="card-footer py-2 bg-primary"></div>
        </div>
        <!-- end card -->

        {{-- <div class="row mt-3">
            <div class="col-12 text-center">
                <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-muted ms-1"><b>Sign Up</b></a></p>
            </div> <!-- end col -->
        </div> --}}
        <!-- end row -->

    </div> <!-- end col -->
</div>
@endsection