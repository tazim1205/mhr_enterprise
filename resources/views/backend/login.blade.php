<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.adminkit.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Oct 2023 08:47:42 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    @stack('header_script')

    @include('backend.layouts.header')

    @if(config('app.locale') == 'bn')
    <style>
        body {
            font-family: 'Hind Siliguri', sans-serif !important;
        }
    </style>
    @endif

    <style>
        .form-control:focus{
            box-shadow: none !important;
        }
    </style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

	<!-- BEGIN SETTINGS -->
	<!-- Remove this after purchasing -->
	<link href="{{asset('Backend')}}/css/light.css" rel="stylesheet">

	<!-- END SETTINGS -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-10"></script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120946860-10', { 'anonymize_ip': true });
</script></head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post" action="{{ route('login') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter your email" value="{{old('email')}}" />
                                            @error('email')
                                            <span class="text-danger">These Credentials Does Not Match To Our Record</span>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" />
											<small>
												<a href='{{route('user.reset_pass')}}'>Forgot password?</a>
											</small>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button type="submit" class='btn btn-lg btn-primary'>Sign In</button>
                                            <br>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="text-center mb-3 d-none">
							Don't have an account? <a href='pages-sign-up.html'>Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{asset('Backend')}}/js/app.js"></script>

    <script src="{{asset('Backend')}}/js/datatables.js"></script>




<script>
function Sure()
{
    if(confirm("Are Your Sure To Delete?"))
    {
        return ture;
    }
    else
    {
        return false;
    }

}
</script>


<script>
    $('#submitLoacaleEn').on('click',function(){
        $('#locale').val('en');
        $('#changeLocale').submit();
    });
    $('#submitLoacaleBn').on('click',function(){
        $('#locale').val('bn');
        $('#changeLocale').submit();
    });

    function submitLoacle()
    {

    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Choices.js
        new Choices(document.querySelector(".choices-single"));
        new Choices(document.querySelector(".choices-single2"));
        new Choices(document.querySelector(".choices-single3"));
        new Choices(document.querySelector(".choices-multiple"));
        // Flatpickr
        flatpickr(".flatpickr-minimum");
        flatpickr(".flatpickr-datetime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        flatpickr(".flatpickr-human", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
        flatpickr(".flatpickr-multiple", {
            mode: "multiple",
            dateFormat: "Y-m-d"
        });
        flatpickr(".flatpickr-range", {
            mode: "range",
            dateFormat: "Y-m-d"
        });
        flatpickr(".flatpickr-time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
</script>

@stack('footer_script')



</body>


<!-- Mirrored from demo.adminkit.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Oct 2023 08:48:38 GMT -->
</html>
