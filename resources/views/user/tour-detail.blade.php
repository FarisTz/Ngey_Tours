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
            <div class="col-md-6 tour-img">
                <img src="{{ asset($tour->image ?: 'images/tour_box_1.webp') }}" class="img-fluid" alt="{{ $tour->title }}" style="width:100%; height:auto; object-fit:cover;">
            </div>
            <div class="col-md-6">
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
    </div>
</section>
@endsection