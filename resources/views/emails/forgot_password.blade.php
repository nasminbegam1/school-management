<p>Hello {{ $to_name }},</p>

<p>
You have requested for new password. Please find the below password
</p>
<p><h1>{{ $password }}</h1></p>
<p> <a href="{{ URL::route('login') }}">Click Here</a> to login with new password</p>
<p>Thanks</p>