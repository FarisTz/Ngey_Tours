@extends('welcome')
@section('title','Gallery')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('images/nungwi_beach.jpg') }});">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				 <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Gallery <i class="fa fa-chevron-right"></i></span></p>
                 <marquee behavior="scroll" direction="left"> <h2 class="mb-3 bread" style="color: white">Enjoy the Ngey Tour & Safari</h2></marquee>
				 <h1 class="mb-3 bread">Gallery</h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center mb-5">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<span class="subheading">Our Moments</span>
				<h2 class="mb-4">Explore Zanzibar Through Our Gallery</h2>
				<p>Browse the best places, trips and experiences from our tours.</p>
			</div>
		</div>
		<div class="row">
			@foreach(range(1, 9) as $index)
				<div class="col-md-4 ftco-animate">
					<div class="gallery-entry" style="background-image: url({{ asset('images/gallery-' . $index . '.jpg') }});">
						<a href="{{ asset('images/safari_blue.jpg') }}" class="icon image-popup d-flex justify-content-center align-items-center">
							<span class="fa fa-search"></span>
						</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
</section>

@endsection
