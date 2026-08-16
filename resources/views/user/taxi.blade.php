@extends('welcome')
@section('title', 'Taxi')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('images/car.jpg') }}');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
      <div class="col-md-10 text-center">
        <span class="subheading text-white">Airport Transfers · Hotel Transfers · Beach-to-Beach Transfers · 24/7 Taxi Service</span>
        <h1 class="mb-4 text-white">Reliable Taxi Services Across Zanzibar – Airport, Hotels & Beaches</h1>
        <p class="mb-4 text-white">Comfortable and dependable taxi transfers with professional drivers, fixed prices, and easy online booking.</p>
        <p>
          <a href="#booking" class="btn btn-primary me-2" style="width:150px; height:50px; display:inline-flex; align-items:center; justify-content:center;">Book Now</a>
          <a style="background-color:#eb6434; color:white; width:150px; height:50px; display:inline-flex; align-items:center; justify-content:center;" href="https://wa.me/255718940807?text=Hello%2C%20I%20want%20to%20book%20a%20taxi.%0A%0APickup%20location%3A%20%0ADestination%3A%20%0ATime%3A%20%0ANumber%20of%20passengers%3A%20"
            class="btn btn-outline-secondary"
            target="_blank">
            Book Taxi
          </a>
        </p>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h2 class="mb-3">Why Choose Us?</h2>
        <p>Experience seamless taxi transfers around Zanzibar with quality service, honest pricing, and complete peace of mind.</p>
      </div>
    </div>
    <div class="row g-4">
      @foreach($features as $feature)
        <div class="col-md-4">
          <div class="service text-center p-4 rounded shadow-sm h-100 bg-white">
            <span class="icon d-flex align-items-center justify-content-center mb-3"><span class="fa fa-check"></span></span>
            <h3>{{ $feature }}</h3>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="ftco-section" id="booking">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div class="booking-form bg-white p-5 rounded shadow-sm">
          <h2 class="mb-4">Get a Taxi Quote</h2>
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          <form action="{{ route('user.booking.car.store') }}" method="POST">
            @csrf

              @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li class="text-danger" >{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

            <div class="mb-3 mt-3">
              <label class="form-label">Full name</label>
              <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3 mt-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
            </div>
            <div class="mb-3 mt-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Include country code" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Pickup Location</label>
              <input type="text" name="pickup_location" class="form-control" value="{{ old('pickup_location') }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Destination</label>
              <input type="text" name="destination" class="form-control" value="{{ old('destination') }}" required>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Date</label>
                <input type="date" name="pickup_date" class="form-control" value="{{ old('travel_date') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Time</label>
                <input type="time" name="pickup_time" class="form-control" value="{{ old('travel_time') }}" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Return Date</label>
              <input type="date" name="return_date" class="form-control" value="{{ old('return_date') }}">
            </div>
            <div class="row g-3 mt-3">
              <div class="col-md-6">
                <label class="form-label">Number of Passengers</label>
                <input type="number" name="num_passengers" class="form-control" min="1" max="50" value="{{ old('num_passengers', 1) }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Vehicle Type</label>
                <select name="vehicle_type" class="form-control" required>
                  <option value="standard">Standard</option>
                  <option value="premium">Premium</option>
                  <option value="luxury">Luxury</option>
                  <option value="minivan">Minivan</option>
                  <option value="minibus">Minibus</option>
                </select>
              </div>
            </div>

            <div class="mt-3 d-flex gap-2">
              <button type="submit" class="btn btn-primary">Get Quote</button>
              <a href="https://wa.me/255718940807" target="_blank" class="btn btn-outline-secondary">Book Taxi</a>
              <a href="https://payments.pesapal.com/ngeytourandsafari" target="_blank" class="btn btn-success">Continue to Payment</a>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="route-overview p-5 rounded shadow-sm bg-white">
          <h2 class="mb-4">Popular Routes</h2>
          @forelse($popularRoutes as $route)
            <div class="route-card mb-3 p-3 border rounded">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <strong>{{ $route->pickup_location }} → {{ $route->destination }}</strong>
                <span class="text-primary">{{ $route->price }}</span>
              </div>
              <div class="d-flex justify-content-between text-muted small">
                <span>{{ $route->distance }}</span>
                <span>{{ $route->duration }}</span>
              </div>
            </div>
          @empty
            <div class="route-card p-3 border rounded text-center text-slate-500">No popular routes configured yet.</div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h2 class="mb-3">Our Vehicle Fleet</h2>
        <p>Choose a vehicle that fits your group and travel style.</p>
      </div>
    </div>
    <div class="row g-4">
      @forelse($fleet as $vehicle)
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            @if($vehicle->image)
              <img src="{{ asset($vehicle->image) }}" class="card-img-top" alt="{{ $vehicle->name }}">
            @else
              <div class="card-img-top bg-slate-200 h-48 d-flex align-items-center justify-content-center">No Image</div>
            @endif
            <div class="card-body">
              <h3 class="card-title">{{ $vehicle->name }}</h3>
              <p class="mb-2"><strong>Capacity:</strong> {{ $vehicle->capacity }}</p>
              <p class="mb-2"><strong>Type:</strong> {{ $vehicle->type }}</p>
              <p class="text-muted">{{ $vehicle->tag }}</p>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center text-slate-500">No vehicles available.</div>
      @endforelse
    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h2 class="mb-3">Airport Transfer Services</h2>
        <p>Efficient transfers from Abeid Amani Karume International Airport with a meet & greet experience.</p>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="bg-white rounded shadow-sm p-4">
          <h3>Why book airport transfers?</h3>
          <ul class="list-unstyled mb-0">
            <li>No Waiting Fees</li>
            <li>Meet & Greet Service</li>
            <li>Flight Monitoring</li>
            <li>Name Board Pickup</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-white rounded shadow-sm p-4">
          <h3>Airport Information</h3>
          <p><strong>Location:</strong> Abeid Amani Karume International Airport, Zanzibar</p>
          <p><strong>Facilities:</strong> Restaurants, shops, lounges, car rental, medical assistance</p>
          <p><strong>Airlines:</strong> Qatar Airways, Turkish Airlines, Ethiopian Airlines, Kenya Airways, KLM</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-8 text-center">
        <h2 class="mb-3">Hotel-to-Hotel Transfers</h2>
        <p>Affordable transfers between Zanzibar hotels and beach resorts.</p>
      </div>
    </div>
    <div class="row g-4">
      @foreach($hotelTransfers as $transfer)
        <div class="col-md-4">
          <div class="bg-white rounded shadow-sm p-4 h-100">
            <h4>{{ $transfer['route'] }}</h4>
            <p class="mb-2"><strong>Distance:</strong> {{ $transfer['distance'] }}</p>
            <p class="mb-2"><strong>Travel Time:</strong> {{ $transfer['time'] }}</p>
            <p class="mb-0"><strong>Price Estimate:</strong> {{ $transfer['price'] }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const whatsappButtons = document.querySelectorAll('.btn-whatsapp-book');
    whatsappButtons.forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        window.open(this.href, '_blank');
      });
    });
  });
</script>
@endsection
