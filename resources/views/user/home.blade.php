@extends('welcome')
@section('title', 'Home')
@section('content')




<div id="hero-slideshow" class="hero-wrap js-fullheight" style="background-image: url('/images/beach_hero.jpg'); transition: background-image 1.5s ease-in-out;">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
				<div class="col-md-7 ftco-animate">

					<h1 class="mb-0 bread">Welcome to Ngey
                    <span >Tours & Safari</span></h1>

				</div>

			</div>
		</div>
	</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = [
            '/images/beach_hero.jpg',
            '/images/dhow_boat.jpg',
            '/images/car.jpg',
            '/images/bg_4.jpg'
        ];
        let currentIndex = 0;
        const heroWrap = document.getElementById('hero-slideshow');

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            heroWrap.style.backgroundImage = `url('${images[currentIndex]}')`;
        }, 5000); // 5000ms = 5 seconds
    });
</script>
		<section class="ftco-section services-section">
			<div class="container">
				<div class="row d-flex">
					<div class="col-md-6 order-md-last heading-section pl-md-5 ftco-animate d-flex align-items-center">
						<div class="w-100">
							<span class="subheading">Welcome to Ngey Tours & Safari</span>
							<h2 class="mb-4">Start Your Zanzibar Adventure with Ngey Tours & Safari</h2>
							<p style="color: black">Discover the beauty of Zanzibar with unforgettable tours, spice, and island experiences designed for travelers who love adventure, culture, and relaxation. From the white sandy beaches of Nungwi and Kendwa to the historic streets of Stone Town and the breathtaking Safari Blue experience, we make every journey memorable.</p>
							<p style="color: black">
                                Whether you are looking for dolphin tours, spice farm visits, snorkeling trips, romantic getaways, or wildlife safaris, our professional team is ready to guide you through the best destinations in Zanzibar and Tanzania.

                                Create lasting memories with comfortable transport, experienced local guides, and personalized travel packages made for solo travelers, couples, families, and groups. Your dream holiday starts here with Ngey Tours & Safari.
                            </p>
							<p><a href="{{ route('destination') }}" class="btn btn-primary py-3 px-4">Search Destination</a></p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-1 d-block img" style="background-image: url(images/services-1.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-paragliding"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Activities</h3>
									<p>Enjoy exciting Zanzibar experiences including snorkeling, dolphin tours, spice farm visits, island hopping, cultural tours, and unforgettable beach adventures for all travelers.</p>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-2 d-block img" style="background-image: url(images/services-2.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Travel Arrangements</h3>
										<p>We provide comfortable transportation, hotel bookings, airport transfers, tour planning, and customized travel packages to make your journey smooth and stress-free.</p>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-3 d-block img" style="background-image: url(images/stone-town-tour.png);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-tour-guide"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Private Guide</h3>
										<p>Explore Zanzibar with experienced local guides who offer friendly assistance, historical knowledge, and personalized tours tailored to your interests and schedule.</p>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-lg-6 d-flex align-self-stretch ftco-animate">
								<div class="services services-1 color-4 d-block img" style="background-image: url(images/zanzibar-red-monkey-Jozani-forest.jpg);">
									<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-map"></span></div>
									<div class="media-body">
										<h3 class="heading mb-3">Location Manager</h3>
										<p>Our team carefully selects the best destinations, attractions, and tour locations to ensure you enjoy safe, beautiful, and memorable experiences across Zanzibar and Tanzania.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection
