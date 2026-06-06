@extends('welcome')
@section('title','Gallery')
@section('content')
<style>
	.gallery-card {
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    height: 280px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    cursor: pointer;
}

.gallery-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: 0.5s ease;
}

/* Zoom effect */
.gallery-card:hover img {
    transform: scale(1.1);
}

/* Dark overlay */
.gallery-card .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.7),
        rgba(0,0,0,0.1)
    );
    opacity: 0;
    transition: 0.4s ease;
    display: flex;
    align-items: flex-end;
    padding: 20px;
}

/* Show overlay on hover */
.gallery-card:hover .overlay {
    opacity: 1;
}

/* Text content */
.gallery-card .content {
    color: white;
}

.gallery-card .content h5 {
    font-weight: 600;
    margin-bottom: 10px;
}

/* Button */
.btn-view {
    display: inline-block;
    padding: 6px 14px;
    background: #ff5a5f;
    color: white;
    border-radius: 20px;
    font-size: 13px;
    text-decoration: none;
}

.btn-view:hover {
    background: #ff2e34;
}
</style>
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

@forelse($galleries as $gallery)

    <div class="col-lg-4 col-md-6 ftco-animate mb-4">

        <div class="gallery-card">

            <!-- Image -->
            <img src="{{ asset($gallery->image) }}" alt="{{ $gallery->title }}">

            <!-- Overlay -->
            <div class="overlay">
                <div class="content">
                    <h5>{{ $gallery->title }}</h5>

                    <a href="{{ asset($gallery->image) }}"
                       class="btn-view image-popup">
                        View Photo
                    </a>
                </div>
            </div>

        </div>

    </div>

@empty

    <div class="col-12 text-center py-5">
        <p class="text-muted">No gallery images available yet.</p>
    </div>

@endforelse

</div>
	</div>
</section>

@endsection
