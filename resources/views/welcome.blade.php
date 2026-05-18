<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ngey Tours - @yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    {{-- Add favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('logo.png') }}">

	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">

	<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="/"> <img width="45px" src="{{ asset('logo.png') }}" alt="Ngey Tours"> Ngey Tour & Safari</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="/" class="nav-link">Home</a></li>
					<li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="{{ route('about') }}" class="nav-link">About</a></li>
					<li class="nav-item {{ request()->is('destination') ? 'active' : '' }}"><a href="{{ route('destination') }}" class="nav-link">Packages</a></li>
                    <li class="nav-item {{ request()->is('tours') ? 'active' : '' }}"><a href="{{ route('tours.index') }}" class="nav-link">Tours</a></li>
					<li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                    <li class="nav-item {{ request()->is('gallery') ? 'active' : '' }}"><a href="{{ route('gallery') }}" class="nav-link">Gallery</a></li>


            @if (Route::has('login'))

                    @auth
                    <li class="nav-item">
                        <a
                            href="{{ url('/dashboard') }}"
                            class="btn btn-primary mt-3"
                        >
                            Dashboard
                        </a> </li>
                    @else
                        <li class="nav-item">
                        <a
                            href="{{ route('login') }}"
                            class="btn btn-primary mt-3 mr-2"

                        >
                            Log in
                        </a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a
                                    href="{{ route('register') }}"
                                    class="btn btn-primary mt-3 "
                                >
                                    Register
                                </a>
                            </li>

                        @endif
                    @endauth

            @endif




				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->



@yield('content')

<section class="ftco-intro ftco-section ftco-no-pt">
 <div class="container">
  <div class="row justify-content-center">
   <div class="col-md-12 text-center">
			<div class="img"  style="background-image: url({{ asset('images/beach_hero.jpg') }});">
     <div class="overlay"></div>
     <h2>We Are Ngey Tours & Safari</h2>
     <p>We create unforgettable travel experiences across Zanzibar and Tanzania. From relaxing beach holidays to exciting safaris and cultural adventures, our team is dedicated to making your dream vacation comfortable, enjoyable, and memorable. Explore the beauty of nature, history, and island life with trusted local travel experts.</p>
     <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Ask For A Quote</a></p>
   </div>
 </div>
</div>
</div>
</section>

			<footer class="ftco-footer bg-bottom ftco-no-pt" style="background-color: #f8f9fa;">
			<div class="container">
				<div class="row mb-5">
					<div class="col-md pt-5">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">About</h2>
							<p>Feel free to contact Ngey Tours & Safari for tour bookings, safari packages, airport transfers, hotel reservations, and any travel inquiries across Zanzibar and Tanzania.</p>
							<ul class="ftco-footer-social list-unstyled float-md-left float-lft">
								<li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
								<li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4 ml-md-5">
							<h2 class="ftco-heading-2">Infromation</h2>
							<ul class="list-unstyled">

								<li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
								<li><a href="#" class="py-2 d-block">Refund Policy</a></li>

							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">Experience</h2>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">Adventure</a></li>
								<li><a href="#" class="py-2 d-block">Hotel and Restaurant</a></li>
								<li><a href="#" class="py-2 d-block">Beach</a></li>
								<li><a href="#" class="py-2 d-block">Nature</a></li>
								<li><a href="#" class="py-2 d-block">Camping</a></li>
								<li><a href="#" class="py-2 d-block">Party</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md pt-5 border-left">
						<div class="ftco-footer-widget pt-md-5 mb-4">
							<h2 class="ftco-heading-2">Have a Questions?</h2>
							<div class="block-23 mb-3">
								<ul>
									<li><span class="icon fa fa-map-marker"></span><span class="text">Zanzibar, Tanzania</span></li>
									<li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+255392 3929 210</span></a></li>
									<li><a href="#"><span class="icon fa fa-paper-plane"></span><span class="text">info@ngeytoursandsafari.com</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">

						<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved |<a href="/" target="_blank"> Ngey Tour $ Safaris </a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						</div>
					</div>
				</div>
			</footer>



			<!-- loader -->
			<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


			<script src="{{ asset('js/jquery.min.js') }}"></script>
			<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
			<script src="{{ asset('js/popper.min.js') }}"></script>
			<script src="{{ asset('js/bootstrap.min.js') }}"></script>
			<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
			<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
			<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
			<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
			<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
			<script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>
			<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
			<script src="{{ asset('js/scrollax.min.js') }}"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
			<script src="{{ asset('js/google-map.js') }}"></script>
			<script src="{{ asset('js/main.js') }}"></script>
			@yield('scripts')

		</body>
		</html>