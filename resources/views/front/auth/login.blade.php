@extends('front.customer.layout.template')
@section('add_on_style')
 
@endsection
@section('content')

<div class="">
    <div class="container-fluid p-5">
        <div class="tab-content">
            <div class="tab-pane show active" id="account">
                <div class="row">
                   <div class="col-sm-4 card offset-sm-4 p-3">
                        @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <form class="p-3" action="{{ route('customer-login-check') }}" method="POST">
                            @csrf
                            <h5 class="mb-4 text-uppercase text-center">
                                Login</h5>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="email_id" class="form-label">Email Id</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label w-100">Password
                                        <a href="#" class="float-end"  > Forgot Password </a>
                                    </label>
                                    <div class="input-group input-group-merge">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                      
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                               
                                <div class="text-end pt-3">
                                    <button type="submit" class="btn btn-success mt-2">
                                        Login
                                    </button>
                                </div>
                            </div> <!-- end row -->
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>       
</div>
    
@endsection
@section('add_on_script')
   
@endsection