<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration Form</title>
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
				<form  method="post" action="{{url('register_guest')}}" enctype="multipart/form-data">
                    @csrf
					<h3>Registration Form</h3>
					<div class="form-group">
						<input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
						<input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
					</div>
					<div class="form-wrapper">
						<input type="email" name="email" id="email"placeholder="Email Address" class="form-control">
						<i class="zmdi zmdi-email"></i>
					</div>
					<div class="form-wrapper">
						<input type="file" name="image" id="image" class="form-control">
						<i class="zmdi zmdi-image"></i>
					</div>
					<div class="form-wrapper">
						<input type="text" name="mobile" id="mobile" placeholder="Mobile Number" class="form-control">
						<i class="zmdi zmdi-phone"></i>
					</div>
					<div class="form-wrapper">
						<input type="password" name="password" id="password" class="form-control">
						<i class="zmdi zmdi-lock"></i>
					</div>
					<button type="submit" >Register
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>
	</body>
</html>