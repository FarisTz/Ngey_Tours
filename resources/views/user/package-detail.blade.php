@extends('welcome')
@section('title', $package->title)
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset($package->image ?: 'images/tour_box_1.webp') }});">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('home') }}">Home <i class="fa fa-chevron-right"></i></a></span> <span><a href="{{ route('destination') }}">Packages <i class="fa fa-chevron-right"></i></a></span> <span>{{ $package->title }} <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">{{ $package->title }}</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-4">
          <img src="{{ asset($package->image ?: 'images/tour_box_1.webp') }}" alt="{{ $package->title }}" class="img-fluid rounded shadow-sm w-100" />
        </div>
        <div class="mb-4">
          <h2 class="mb-3">About this package</h2>
          <p>{{ $package->description }}</p>
          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="border p-3 rounded">
                <strong>Price</strong>
                <p>${{ number_format($package->price, 2) }} / person</p>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="border p-3 rounded">
                <strong>Duration</strong>
                <p>{{ $package->duration ?: 'N/A' }}</p>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="border p-3 rounded">
                <strong>Location</strong>
                <p>{{ $package->location ?: 'Zanzibar, Tanzania' }}</p>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="border p-3 rounded">
                <strong>Highlights</strong>
                <ul class="list-disc list-inside">
            @foreach($package->highlights ?? [] as $highlight)
              <li>{{ $highlight }}</li>
            @endforeach
          </ul>
              </div>
            </div>
          </div>
        </div>
        
      </div>
       <div class=" col-md-6">
            <form action="#" class="bg-light p-5 contact-form">
                <input type="hidden" name="tour_id" value="{{ $package->id }}">
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Full Name">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Email Address">
                </div>
                Tour Date

                <div class="form-group">
                <input type="date" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                <input type="number" min="0" class="form-control" placeholder="Number of Adults">
                </div>
                <div class="form-group">
                <input type="number" min="0" class="form-control" placeholder="Number of Children">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Pickup Location">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Destination">
                </div>
                <div class="form-group">
                <input type="text" class="form-control" placeholder="Pickup Location">
                </div>
                <div class="form-group">
                <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Special Requests"></textarea>
                </div>
                <div class="form-group">
                <input type="submit" value="Request Quote" class="btn btn-primary py-3 px-5">
                </div>
            </form>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
