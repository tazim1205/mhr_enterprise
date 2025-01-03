    <!-- Start Footer Section -->
    @php
    $path = public_path().'/Backend/settings/'.$settings->logo;
    @endphp
    <footer class="footer-section">
			<div class="container relative">

				<!-- <div class="sofa-img">
					<img src="images/sofa.png" alt="Image" class="img-fluid">
				</div> -->

				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="{{ asset('') }}frontend/assets/img/images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>SUBSCRIBE TO OUR NEW OFFERS</span>
						</h3>
						<span >Enter your e-mail address to receive regular updates, as well asnews on upcoming events and special offers.</span>
							<br><br>
							<form action="#" class="row g-3">
								<div class="col-auto">
									<input type="text" class="form-control" placeholder="Enter your name">
								</div>
								<div class="col-auto">
									<input type="email" class="form-control" placeholder="Enter your email">
								</div>
								<div class="col-auto">
									<button class="btn btn-primary">
										<span class="fa fa-paper-plane"></span>
									</button>
								</div>
							</form>

						</div>
					</div>
				</div>

				<div class="row g-5 mb-5">
					<div class="col-lg-4">
						<div class="mb-4 footer-logo-wrap">
							<a href="#" class="footer-logo">
								@if(file_exists($path))
								<img src="{{asset('Backend/settings')}}/{{$settings->logo}}" alt="" class="img-fluid" style="height: 130px;">
								@else
								@lang('settings.logo')
								@endif
							</a>
						</div>
						<p class="mb-4"></p>

						<ul class="list-unstyled custom-social">
							<li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-twitter"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>
							<li><a href="#"><span class="fa fa-brands fa-linkedin"></span></a></li>
						</ul>
					</div>

					<div class="col-lg-8">
						<div class="row links-wrap">
							<div class="col-6 col-sm-6 col-md-4">
								<ul class="list-unstyled">
									<li><a href="#">About us</a></li>
									<li><a href="#">Services</a></li>
									<li><a href="#">Blog</a></li>
									<li><a href="#">Contact us</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-4">
								<ul class="list-unstyled">
									<li><a href="#">Support</a></li>
									<li><a href="#">Knowledge base</a></li>
									<li><a href="#">Live chat</a></li>
								</ul>
							</div>

							<div class="col-6 col-sm-6 col-md-4">
								<ul class="list-unstyled">
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Leadership</a></li>
									<li><a href="#">Privacy Policy</a></li>
								</ul>
							</div>
						</div>
					</div>

				</div>

				<div class="border-top copyright">
					<div class="row pt-4">
						<div class="col-lg-6">
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. </a>
                            </p>
						</div>

						<div class="col-lg-6 text-center text-lg-end">
							<ul class="list-unstyled d-inline-flex ms-auto">
								<li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>

					</div>
				</div>

			</div>
		</footer>
		<!-- End Footer Section -->	


		<script src="{{ asset('') }}frontend/assets/js/bootstrap.bundle.min.js"></script>
		<script src="{{ asset('') }}frontend/assets/js/tiny-slider.js"></script>
		<script src="{{ asset('') }}frontend/assets/js/custom.js"></script>
		
		<!-- UIkit JS -->
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.16.22/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.16.22/dist/js/uikit-icons.min.js"></script>
		<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

		@stack('footer_scripts')
	</body>

</html>