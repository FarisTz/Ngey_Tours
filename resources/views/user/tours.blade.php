@extends('welcome')
@section('title','Tours')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('images/dhow_boat.jpg') }});">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Tours <i class="fa fa-chevron-right"></i></span></p>
         <marquee behavior="scroll" direction="left"> <h2 class="mb-3 bread" style="color: white">Enjoy the Ngey Tour & Safari</h2></marquee>
         <h1 class="mb-0 bread">Zanzibar Best Day Tours & Excursions!</h1>
     </div>
 </div>
</div>
</section>

<section class="ftco-section">
   <div class="container">
    <div class="row">
        @forelse($tours as $tour)
            <div class="col-md-4 ftco-animate">
                <div class="project-wrap">
                    <a href="{{ route('tour.detail', $tour->slug) }}" class="img" style="background-image: url({{ asset($tour->image ?: 'images/tour_box_1.webp') }});">
                        <span class="price">Starts ${{ number_format($tour->price, 2) }}</span>
                    </a>
                    <div class="text p-4">
                        <span class="days">{{ $tour->duration ?: 'Full Day' }}</span>
                        <h3><a href="{{ route('tour.detail', $tour->slug) }}">{{ $tour->title }}</a></h3>
                        <p>{{ $tour->short ?: \Illuminate\Support\Str::limit($tour->description, 120) }}</p>
                        <a href="{{ route('tour.detail', $tour->slug) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center">
                    <h2 class="text-xl font-semibold text-gray-900">No tours available yet</h2>
                    <p class="mt-2 text-sm text-gray-600">Create your first tour from the admin panel to populate this page.</p>
                </div>
            </div>
        @endforelse
    </div>
   </div>
</section>
@endsection

       