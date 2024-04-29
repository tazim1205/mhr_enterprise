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
							<h1 class="h2">@lang('user.reset_your_pass')</h1>
							<p class="lead">
								@lang('user.enter_otp')
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post" action="{{route('user.submit_otp',$email)}}" enctype="multipart/form-data">
                                        @csrf
										<div class="mb-3">
											<label class="form-label">@lang('user.email')</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="" / value="{{$email}}" id="email" readonly>
										</div>
										<div class="mb-3">
											<label class="form-label">@lang('user.otp')</label>
											{{-- <input class="form-control form-control-lg" type="text" name="otp" placeholder="" / maxlength="6" required> --}}
                                            <table>
                                                <tr>
                                                    <td><input onkeyup="checkHasSix()" type="text" name="otp[]" class="form-control inputs" id="otp0" maxlength="1" data-next="1" autofocus></td>
                                                    <td><input onkeyup="checkHasSix()" type="text" name="otp[]" class="form-control inputs" id="otp1" maxlength="1" data-next="2"></td>
                                                    <td><input onkeyup="checkHasSix()" type="text" name="otp[]" class="form-control inputs" id="otp2" maxlength="1" data-next="3"></td>
                                                    <td><input onkeyup="checkHasSix()" type="text" name="otp[]" class="form-control inputs" id="otp3" maxlength="1" data-next="4"></td>
                                                    <td><input onkeyup="checkHasSix()" type="text" name="otp[]" class="form-control inputs" id="otp4" maxlength="1" data-next="5"></td>
                                                    <td><input onkeyup="checkHasSix()" type="text" name="otp[]" class="form-control inputs" id="otp5" maxlength="1" data-next="6"></td>
                                                </tr>
                                            </table>
                                            <span class="text-success d-none" id="otp_matched">@lang('user.otp_matched')</span>
                                            <span class="text-danger d-none" id="otp_not_matched">@lang('user.otp_not_matched')</span>
                                            <span class="text-danger d-none" id="otp_expired">@lang('user.otp_expired')</span>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button id="submit_otp" type="submit" class='btn btn-lg btn-primary d-none'>@lang('user.submit_otp')</button>
                                            <a id="resend_otp" href="{{route('user.resend_otp',$email)}}" class="d-none btn btn-success btn-lg  resend_code">@lang('user.resend_otp')</a>
                                            <div style="text-align: center">
                                                <span id="timer">
                                                  <span id="time">60</span>Seconds
                                                </span>
                                              </div>
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
$('.inputs').keyup(function(e) {
    if (this.value.length === this.maxLength) {
        let next = $(this).data('next');
        // alert(next);
        $('#otp' + next).focus();
    }
});
</script>

<script>
 var counter = 60;
    var interval = setInterval(function() {
        counter--;
        // Display 'counter' wherever you want to display it.
        if (counter <= 0) {
            clearInterval(interval);
            $('#time').text(counter);
            // $('#submit_otp').hide();
            $('.resend_code').removeClass('d-none');
            return;
        }else{
            $('#time').text(counter);
    //   console.log("Timer --> " + counter);
        }
    }, 1000);
</script>



    {{-- <script>
        $('#submit_otp').hide();
        $('#resend_otp').hide();
    </script> --}}


    <script>

        function checkHasSix()
        {
            var arrayotp = $('input[name="otp[]"]').map(function(){
                return this.value;
            }).get();

            // console.log(arrayotp);

            const otp = arrayotp[0]+''+arrayotp[1]+''+arrayotp[2]+''+arrayotp[3]+''+arrayotp[4]+''+arrayotp[5];

            var email = $('#email').val();

            // alert(email);

            if(otp.length == 6)
            {
                $.ajax({
                    headers : {
                        'X-CSRF-TOKEN' : '{{csrf_token()}}'
                    },
                    url : '{{url('checkingOtp')}}/'+otp+'/'+email,
                    type :'GET',
                    success : function(r)
                    {
                        if(r == 1)
                        {
                            $('#otp_matched').removeClass('d-none');
                            $('#otp_expired').addClass('d-none');
                            $('#otp_not_matched').addClass('d-none');
                            $('#submit_otp').removeClass('d-none');
                        }
                        else if(r == 2)
                        {
                            $('#otp_expired').removeClass('d-none');
                            $('#otp_matched').addClass('d-none');
                            $('#otp_not_matched').addClass('d-none');
                            $('#resend_otp').removeClass('d-none');
                            $('#submit_otp').addClass('d-none');
                        }
                        else
                        {
                            $('#otp_not_matched').removeClass('d-none');
                            $('#otp_expired').addClass('d-none');
                            $('#otp_matched').addClass('d-none');
                            $('#resend_otp').removeClass('d-none');
                        }
                    }
                });
            }


        }

    </script>




</body>


<!-- Mirrored from demo.adminkit.io/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 14 Oct 2023 08:48:38 GMT -->
</html>
