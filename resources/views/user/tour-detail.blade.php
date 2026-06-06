@extends('welcome')
@section('title', $tour->title)
@section('content')


<section class="tour-hero hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset($tour->image ?: 'images/tour_box_1.webp') }}');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate hero-content text-center">
                <h1 class="mb-3 bread">{{ $tour['title'] }}</h1>
            </div>
        </div>
    </div>
</section>

<section class="tour-section ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div>
                    <img src="{{ asset($tour->image ?: 'images/tour_box_1.webp') }}" class="img-fluid" alt="{{ $tour->title }}" style="width:100%; height:auto; object-fit:cover;">
                </div>
                <div >
                    <h3 class="mb-4">About this tour</h3>
                    <p>{{ $tour->description }}</p>
                    <h4 class="mt-4">Highlights</h4>
                    <ul class="tour-highlights list-unstyled">
                        @foreach($tour->highlights ?? [] as $highlight)
                            <li><i class="fa fa-check"></i> {{ $highlight }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('tours.index') }}" class="btn btn-back mt-3">
                        <i class="fa fa-arrow-left mr-2"></i>Back to Tours
                    </a>
                </div>
            </div>
        <div class=" col-md-6">
            <form action="#" class="bg-light p-5 contact-form">
                <input type="hidden" name="tour_id" value="{{ $tour->id }}">
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
                <div class="form-group
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
</section>




@endsection
