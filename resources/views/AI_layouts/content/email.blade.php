<html>
<head></head>
<body style="background: black; color: white">
<h1>Welcome to IAMT, {{$user->last_name}}!</h1>
<p>Your username is : {{$user->email}}</p>
<p>To set your password, visit the following address:
	<a href="{{ url('password/reset/'.$token) }}"> Link </a>
</body>
</html>