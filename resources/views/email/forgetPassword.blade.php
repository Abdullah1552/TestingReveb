<h1>Forget Password Email</h1>

Your OTP is {{$OTP}}

Or You can reset password from bellow link:

<a href="{!! request()->getSchemeAndHttpHost()."/reset-password?token=". $token !!}">Reset Password</a>
