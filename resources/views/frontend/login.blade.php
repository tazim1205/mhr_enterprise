<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{ asset('') }}frontend/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('') }}frontend/assets/css/regi.css">
	</head>

	<body>

		<div class="wrapper" style="background: #cbd1d1;">
			<div class="inner">
				<div class="image-holder">
					<img src="{{ asset('') }}frontend/assets/img/Crown-AW-Trends-21-Layers-405x530-2.jpg" alt="">
				</div>
                <form method="post" action="{{url('guestLoginAttempt')}}" >
                    @csrf
					<h4><a href="{{('/')}}"><i class="zmdi zmdi-long-arrow-return"></i> Back Home</a></h4>
					<br><br>
					<h3>Login Form</h3>
					<div class="form-wrapper">
						<input type="email" name="email" id="email"placeholder="Email Address" class="form-control">
						<i class="zmdi zmdi-email"></i>
					</div>
					<div class="form-wrapper">
						<input type="password" name="password" id="password" class="form-control">
						<i class="zmdi zmdi-lock"></i>
					</div>
					<button type="submit" >Login
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
					<br>
					<br>
					<center>
						<span>Don't have an account? <a href="{{url('registration')}}" class="text-warning">Sign up</a></span>
					</center>
				</form>
			</div>
		</div>
	</body>
</html>