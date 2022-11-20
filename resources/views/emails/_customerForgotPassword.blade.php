<h1>Forget Password Email</h1>
   
You can reset password from bellow link:
<a href="{{ route('customer.password.get', ['token' => $token, 'companyCode' => $companyCode ]) }}">Reset Password</a>