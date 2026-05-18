@extends('welcome')
@section('title','Destination')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('images/nungwi_beach.jpg') }});">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Packages List <i class="fa fa-chevron-right"></i></span></p>
          <marquee behavior="scroll" direction="left"> <h2 class="mb-3 bread" style="color: white">Enjoy the Ngey Tour & Safari</h2></marquee>
         <h1 class="mb-0 bread">Packages List</h1>
     </div>
 </div>
</div>
</section>

<section class="ftco-section ftco-no-pb">
   <div class="container">
      <div class="row">
       <div class="col-md-12">
          <div class="search-wrap-1 ftco-animate">
             <form action="#" class="search-property-1">
                <div class="row no-gutters">
                   <div class="col-lg d-flex">
                      <div class="form-group p-4 border-0">
                         <label for="#">Destination</label>
                         <div class="form-field">
                           <div class="icon"><span class="fa fa-search"></span></div>
                           <input type="text" class="form-control" placeholder="Search place">
                       </div>
                   </div>
               </div>
               <div class="col-lg d-flex">
                  <div class="form-group p-4">
                     <label for="#">Check-in date</label>
                     <div class="form-field">
                       <div class="icon"><span class="fa fa-calendar"></span></div>
                       <input type="text" class="form-control checkin_date" placeholder="Check In Date">
                   </div>
               </div>
           </div>
           <div class="col-lg d-flex">
              <div class="form-group p-4">
                 <label for="#">Check-out date</label>
                 <div class="form-field">
                   <div class="icon"><span class="fa fa-calendar"></span></div>
                   <input type="text" class="form-control checkout_date" placeholder="Check Out Date">
               </div>
           </div>
       </div>
       <div class="col-lg d-flex">
          <div class="form-group p-4">
             <label for="#">Price Limit</label>
             <div class="form-field">
               <div class="select-wrap">
                <div class="icon"><span class="fa fa-chevron-down"></span></div>
                <select name="" id="" class="form-control">
                  <option value="">$5,000</option>
                  <option value="">$10,000</option>
                  <option value="">$50,000</option>
                  <option value="">$100,000</option>
                  <option value="">$200,000</option>
                  <option value="">$300,000</option>
                  <option value="">$400,000</option>
                  <option value="">$500,000</option>
                  <option value="">$600,000</option>
                  <option value="">$700,000</option>
                  <option value="">$800,000</option>
                  <option value="">$900,000</option>
                  <option value="">$1,000,000</option>
                  <option value="">$2,000,000</option>
              </select>
          </div>
      </div>
  </div>
</div>
<div class="col-lg d-flex">
  <div class="form-group d-flex w-100 border-0">
     <div class="form-field w-100 align-items-center d-flex">
        <input type="submit" value="Search" class="align-self-stretch form-control btn btn-primary">
    </div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</section>

<section class="ftco-section">
   <div class="container">
  <div class="row">
    @forelse($packages as $package)
      <div class="col-md-4 ftco-animate">
        <div class="project-wrap">
          <a href="#" class="img" style="background-image: url({{ asset($package->image ?: 'images/tour_box_1.webp') }});">
            <span class="price">${{ number_format($package->price, 2) }}/person</span>
          </a>
          <div class="text p-4">
            <span class="days">{{ $package->duration ?: 'Tour Package' }}</span>
            <h3><a href="#">{{ $package->title }}</a></h3>
            <p class="location"><span class="fa fa-map-marker"></span> {{ $package->location ?: 'Zanzibar, Tanzania' }}</p>
            <ul>
              <li><span class="flaticon-shower"></span>{{ $package->highlights[0] ?? 'Adventure' }}</li>
              <li><span class="flaticon-king-size"></span>{{ $package->highlights[1] ?? 'Comfort' }}</li>
              <li><span class="flaticon-mountains"></span>{{ $package->highlights[2] ?? 'Escape' }}</li>
            </ul>
            <p><strong>Highlights:</strong> {{ implode(', ', array_filter($package->highlights ?? [])) }}</p>
            <button class="btn btn-primary btn-book-now" data-tour="{{ $package->slug }}">Book Now</button>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center">
          <h2 class="text-xl font-semibold text-gray-900">No packages available yet</h2>
          <p class="mt-2 text-sm text-gray-600">Use the admin panel to create destination packages for this page.</p>
        </div>
      </div>
    @endforelse
  </div>
   </div>
</section>



<!-- Booking Form Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Complete Your Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="bookingTourInfo" class="mb-4"></div>
        <form id="bookingForm">
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" class="form-control" id="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" class="form-control" id="phone" required>
          </div>
          <div class="form-group">
            <label for="travelDate">Travel Date</label>
            <input type="date" class="form-control" id="travelDate" required>
          </div>
          <div class="form-group">
            <label for="numberOfPeople">Number of People</label>
            <input type="number" class="form-control" id="numberOfPeople" min="1" value="2" required>
          </div>
          <div class="form-group">
            <label for="specialRequests">Special Requests (Optional)</label>
            <textarea class="form-control" id="specialRequests" rows="3"></textarea>
          </div>
          <input type="hidden" id="selectedTour" name="selectedTour">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitBooking">Submit Booking</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// Tour details data
const tourDetails = {
  'zanzibar-luxury': {
    title: '5 DAYS LUXURY ZANZIBAR TOUR',
    price: 370,
    duration: '5 Days',
    location: 'Zanzibar, Tanzania',
    description: 'Experience the ultimate luxury in Zanzibar with this comprehensive 5-day tour covering the best attractions.',
    itinerary: `
      <h6>DAY 01</h6>
      <p>Pick up at the hotel 🏨 8:30am back to hotel 5:00pm.</p>
      <ul>
        <li>📍 Spice Farm</li>
        <li>📍 Local lunch</li>
        <li>📍 Stone Town visit</li>
        <li>📍 Tour in the evening in the old town</li>
        <li>📍 Nakupenda island</li>
      </ul>

      <h6>DAY 02 - RELAXING 😌 AT HOTEL 🏨</h6>

      <h6>DAY 03</h6>
      <p>Pick up at hotel 🏨 8:00 am. Back to hotel 4:00pm.</p>
      <ul>
        <li>📍 Jozani Forest</li>
        <li>📍 The Rock restaurant</li>
        <li>📍 Sunset at Michamvi Kae Beach</li>
        <li>📍 Paje beach 🏝️ relax 😌</li>
      </ul>

      <h6>DAY 04 – April 23, 2026</h6>
      <p>Pick up at the hotel 🏨 7:00am back to hotel 5:00pm</p>
      <ul>
        <li>📍 Safari Blue</li>
        <li>📍 Sailing on a traditional dhow</li>
        <li>📍 Snorkeling</li>
        <li>📍 Relaxing on the sandbank</li>
        <li>📍 Fresh fruits</li>
        <li>📍 Lunch (BBQ of fresh seafood or chicken)</li>
        <li>📍 Swimming in the mangrove lagoon</li>
        <li>📍 Unique baobab tree</li>
      </ul>

      <h6>DAY 05</h6>
      <p>Pick up at the hotel 🏨 7:30 am back to hotel 4:00 pm</p>
      <ul>
        <li>📍 Mnemba Island</li>
        <li>📍 Snorkeling 🤿🦪</li>
        <li>📍 Swimming with dolphins</li>
        <li>📍 Relaxing on the sandbank</li>
        <li>📍 Seafood lunch</li>
        <li>📍 Non-alcoholic beverages</li>
        <li>📍 Fresh fruits</li>
        <li>📍 Relaxing at Kendwa Beach</li>
        <li>📍 Swimming with turtles</li>
      </ul>
    `,
    includes: [
      'Hotel pick-up and drop-off',
      'Entrance fees',
      'Guide',
      'Seafood lunch during sea cruises',
      'Water and snacks on all excursions'
    ]
  },
  'serengeti-ngorongoro': {
    title: '3-DAYS,2NIGHT SERENGETI&NGORONGORO CRATER FROM ZANZIBAR 🇹🇿✈️',
    price: 1700,
    duration: '3 Days',
    location: 'From Zanzibar to Mainland Tanzania',
    description: 'An incredible safari experience combining the world-famous Serengeti and Ngorongoro Crater.',
    itinerary: `
      <h6>🦁 DAY 01:</h6>
      <p>Pick up from your hotel in Zanzibar, transfer to the airport, and fly to Arusha Airport. Upon arrival, transfer to the Serengeti and enjoy a full day of safari, dinner, and overnight stay in a tented camp.</p>

      <h6>🦒 DAY 02:</h6>
      <p>Full day in the Serengeti, dinner, and overnight stay at the Heritage tented camp.</p>

      <h6>🦏 DAY 03:</h6>
      <p>After breakfast, depart from the Serengeti to Ngorongoro, descend into the crater for a safari, lunch at the Hippo Pool picnic site, and return to Arusha in the afternoon for your flight back to Zanzibar.</p>
    `,
    includes: [
      'All park fees',
      'Full board accommodation during the safari',
      'Guide costs',
      'Meals (breakfast, lunch, and dinner)',
      'Safari cruiser',
      'Drinking water / soft drinks',
      'Airfare',
      'Airport transfer',
      'Tips for the guide',
      'Personal items'
    ]
  },
  'mikumi': {
    title: '3 DAYS, 2 NIGHTS TO MIKUMI NATIONAL PARK',
    price: 450,
    duration: '3 Days',
    location: 'From Zanzibar to Mainland Tanzania',
    description: 'A perfect introduction to Tanzania\'s wildlife with this 3-day adventure to Mikumi National Park.',
    itinerary: `
      <h6>Day 01: Zanzibar to Mikumi National Park</h6>
      <p><strong>Morning:</strong> Pick up from the hotel in Zanzibar, transfer to the ferry terminal.</p>
      <p><strong>Ferry Ride:</strong> Depart by ferry from Zanzibar to Dar es Salaam (approximately 1.5 hours).</p>
      <p><strong>Arrival in Dar:</strong> Meet and greet with the driver, transfer to the train station for the journey to Morogoro.</p>
      <p><strong>Train Ride:</strong> Enjoy the scenic train ride to Morogoro (approximately 1.5 hours).</p>
      <p><strong>Transfer to Mikumi:</strong> Drive directly to Mikumi National Park (about 1.5 hours).</p>
      <p><strong>Afternoon Game Drive:</strong> Embark on an afternoon game drive in Mikumi National Park.</p>
      <p><strong>Overnight:</strong> Check into Bandas within the park for dinner and overnight stay.</p>

      <h6>Day 02: Half Day in Mikumi National Park</h6>
      <p><strong>Morning:</strong> Early morning game drive (starting at sunrise).</p>
      <p><strong>Midday:</strong> Return to the Bandas for lunch and relaxation.</p>
      <p><strong>Afternoon:</strong> Continue with a half-day game drive until 1:00 PM.</p>
      <p><strong>Transfer to Morogoro:</strong> Drive back to Morogoro for dinner and overnight stay.</p>

      <h6>Day 03: Return to Zanzibar</h6>
      <p><strong>Morning:</strong> Breakfast in Morogoro, depart for the train station.</p>
      <p><strong>Train Ride:</strong> Take the train back to Dar es Salaam.</p>
      <p><strong>Ferry Ride:</strong> Transfer to the ferry terminal, depart by ferry from Dar to Zanzibar.</p>
      <p><strong>Afternoon:</strong> Arrive in Zanzibar and transfer back to the hotel.</p>
    `,
    includes: [
      'Transportation (ferry, train, and vehicle)',
      'Game drives in Mikumi National Park',
      'Accommodation (Bandas and hotel in Morogoro)',
      'Meals (as per itinerary)',
      'Park entrance fees',
      'Pick up and drop off'
    ]
  },
  'zanzibar-luxury-4days': {
    title: '4 DAYS ZANZIBAR LUXURY TOUR',
    price: 520,
    duration: '4 Days',
    location: 'Zanzibar, Tanzania',
    description: 'A perfect 4-day luxury tour covering the best of Zanzibar\'s attractions.',
    itinerary: `
      <h6>🏝 DAY 01: Mnemba Island, Dolphin & Snorkeling + fishing 🎣 tour + Turtles Sanctuary & Kendwa Beach</h6>
      <ul>
        <li>07:00 AM: Pick up at your hotel for Muyuni Beach</li>
        <li>Enjoy a boat ride to dolphin spots; swim with and touch dolphins</li>
        <li>Fishing 🎣 tour</li>
        <li>Snorkeling at Mnemba Island, then BBQ</li>
        <li>Swim with turtles in a natural lagoon; feed and touch them</li>
        <li>Swim in natural caves with fresh water</li>
        <li>Seafood lunch with drinks on the beach</li>
        <li>Transfer back to the hotel</li>
      </ul>

      <h6>🏝 DAY 02: Jozani Forest Tour & Rock Restaurant + paje beach</h6>
      <ul>
        <li>07:30 AM: Pick up at your hotel and transfer to Jozani Forest</li>
        <li>Explore the only national park in Zanzibar with friendly monkeys</li>
        <li>Visit the Rock Restaurant for meals (reservation required) or photo opportunities</li>
        <li>Sunset view at Kae Beach with refreshments and entertainment</li>
        <li>Paje beach</li>
        <li>Transfer back to the hotel</li>
      </ul>

      <h6>🏝 DAY 03: Spice Tour, Stone Town & Prison Island</h6>
      <ul>
        <li>08:00 AM: Pick up at your hotel; transfer to the Spice Farm for your tour</li>
        <li>Boat ride to Nakupenda, followed by a city tour of Stone Town</li>
        <li>Discover the history, culture, Zanzibar</li>
      </ul>

      <h6>🏝 DAY 04: Safari Blue Sea Adventure</h6>
      <ul>
        <li>08:00 AM: Pick up at your hotel; transfer to safari blue fumba</li>
        <li>Full-day adventure at Safariblue: snorkeling, sandbathing, and BBQ seafood lunch on a sandbank</li>
        <li>Transfer back to the hotel</li>
      </ul>
    `,
    includes: [
      'Private hotel pickup and drop-off',
      'Entrance fees',
      'Professional tour guide',
      'Water during travel',
      'Boat and snorkeling gear for sea adventures',
      'Seafood lunch on boat trips'
    ]
  },
  'kilimanjaro': {
    title: 'MOUNT KILIMANJARO TANZANIA 🇹🇿',
    price: 1950,
    duration: '6 Days',
    location: 'Mount Kilimanjaro, Tanzania',
    description: 'Conquer the highest standalone mountain in the world and the highest peak in Africa!',
    itinerary: `
      <h6>Marangu Route - 6 Days / 5 Nights</h6>
      <p>Mount Kilimanjaro is the highest standalone mountain in the World and the highest peak in Africa at elevation 5895m ASL. It is every hiker\'s delight to conquer Uhuru Peak.</p>

      <h6>What\'s Included:</h6>
      <ul>
        <li>3 meals a day</li>
        <li>Accommodation on the mountain</li>
        <li>Personal guides</li>
        <li>A chef and team of porters to carry your belongings</li>
        <li>Achievement certificate upon successful completion</li>
      </ul>

      <p><strong>Note:</strong> Make sure to offer tips to porters who carry your belongings up on the mountain.</p>
    `,
    includes: [
      '3 meals a day',
      'Accommodation on the mountain',
      'Personal guides',
      'Chef and porters team',
      'Achievement certificate',
      'All necessary permits and arrangements'
    ]
  }
};

$(document).ready(function() {
  $('.btn-book-now').click(function() {
    const tourType = $(this).data('tour');
    const tour = tourDetails[tourType] || {
      title: tourType.replace(/-/g, ' ').toUpperCase(),
      price: 'TBD',
      duration: 'Custom request',
      location: 'Tanzania',
    };

    $('#selectedTour').val(tourType);
    $('#bookingTourInfo').html(`
      <div>
        <h4>${tour.title}</h4>
        <p><strong>Price:</strong> ${tour.price === 'TBD' ? tour.price : '$' + tour.price + '/person'}</p>
        <p><strong>Duration:</strong> ${tour.duration}</p>
        <p><strong>Location:</strong> ${tour.location}</p>
      </div>
    `);
    $('#bookingModalLabel').text('Book ' + tour.title);
    $('#bookingModal').modal('show');
  });

  $('#submitBooking').click(function() {
    const formData = {
      tour: $('#selectedTour').val(),
      name: $('#name').val(),
      email: $('#email').val(),
      phone: $('#phone').val(),
      travelDate: $('#travelDate').val(),
      numberOfPeople: $('#numberOfPeople').val(),
      specialRequests: $('#specialRequests').val()
    };
    if (!formData.name || !formData.email || !formData.phone || !formData.travelDate) {
      alert('Please fill in all required fields.');
      return;
    }
    console.log('Booking data:', formData);
    alert('Thank you for your booking! We will contact you soon to confirm your reservation.');
    $('#bookingModal').modal('hide');
    $('#bookingForm')[0].reset();
  });
});
 </script>
@endsection
