@extends('welcome')
@section('title','Safari Blue - Zanzibar Day Tour')
@section('content')

<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url({{ asset('images/tour_box_1.webp') }});">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
         <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span class="mr-2"><a href="{{ route('tours') }}">Tours <i class="fa fa-chevron-right"></i></a></span> <span>Safari Blue <i class="fa fa-chevron-right"></i></span></p>
         <marquee behavior="scroll" direction="left"> <h2 class="mb-3 bread" style="color: white">Enjoy the Ngey Tour & Safari</h2></marquee>
         <h1 class="mb-3 bread">Zanzibar Safari Blue Trip</h1>
         <p class="mb-0"><span class="fa fa-star" style="color: #FFD700;"></span><span class="fa fa-star" style="color: #FFD700;"></span><span class="fa fa-star" style="color: #FFD700;"></span><span class="fa fa-star" style="color: #FFD700;"></span><span class="fa fa-star" style="color: #FFD700;"></span> 5 Stars Rated | Best Prices | Online Booking!</p>
     </div>
 </div>
</div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h2 class="mb-4">Overview</h2>
        <p>Safari Blue trip is a full day tour along Menai bay, which is one of the best coral reefs in Zanzibar. Main activities in the tour includes visit to naturally occurring sandbanks, Swimming & Snorkeling in the crystal clear waters, visiting Kwale island with its natural green lagoon and Climbing the old Baobab tree for spectacular view of the Island.</p>

        <p>If you love ocean, this tour for you. You will witness countless colourful fishes and other sea creatures that survive among the coral reefs and underwater plants which together form the barrier reef ecosystem in the bay.</p>

        <p>During the tour enjoy the fresh seafood barbeque; Octopus, Lobsters, squids, Calamaris, Fishes. Exotic fresh fruit tasting like Banana, Watermelon, Pineapple, Mangoes. This will be the best adventurous day for your stay in Zanzibar Islands, and you will understand why we call this "Blue Safari"</p>

        <hr class="my-5">

        <h3 class="mb-4">Safari Blue Highlights!</h3>
        <ul class="tour-highlights list-unstyled">
          <li><i class="fa fa-check"></i> Swimming and Snorkeling around Menai Bay area</li>
          <li><i class="fa fa-check"></i> Seafoods BBQ Lunch; Octopus, Lobsters, Squids, Prawns, etc.</li>
          <li><i class="fa fa-check"></i> Tropical Fruits; Mangoes, Bananas, Pineapple, Watermelon etc.</li>
          <li><i class="fa fa-check"></i> Sailing with Traditional boat</li>
          <li><i class="fa fa-check"></i> Visit Kwale Island, natural Lagoon & Sandbank</li>
        </ul>

        <hr class="my-5">

        <h3 class="mb-4">Price Includes</h3>
        <div class="row">
          <div class="col-md-6">
            <ul class="list-unstyled">
              <li><i class="fa fa-check text-primary"></i> English Speaking Guide</li>
              <li><i class="fa fa-check text-primary"></i> Sailing Boat</li>
              <li><i class="fa fa-check text-primary"></i> Snorkeling Equipments</li>
              <li><i class="fa fa-check text-primary"></i> Lunch (Seafood BBQ, Chicken, or Vegetarian options)</li>
            </ul>
          </div>
          <div class="col-md-6">
            <ul class="list-unstyled">
              <li><i class="fa fa-check text-primary"></i> Tropical Fruits</li>
              <li><i class="fa fa-check text-primary"></i> Soft Drinks</li>
              <li><i class="fa fa-check text-primary"></i> All government fees</li>
              <li><i class="fa fa-check text-primary"></i> Hotel Pick up/ Drop-off (extra charge)</li>
            </ul>
          </div>
        </div>

        <hr class="my-5">

        <h3 class="mb-4">Explore Zanzibar Blue Safari Today!</h3>
        <p>Safari blue is one among the best enjoyable things you can do in your Zanzibar vacation. It is called Blue Safari because of the ocean blueness that you feel during the tour.</p>

        <p>It is totally a whole day playing with the ocean in Menai bay conservation area. The Menai Bay Conservation Area is located in Menai Bay, west south coast of Unguja Zanzibar.</p>

        <p>This is the largest marine conserved area with 470 square kilometres (180 sq mi), comprising extensive coral reefs, colorful tropical fish, a lot of sea creatures, and mangrove forests.</p>

        <p>All together make the best tourists experience when they visit Zanzibar islands.</p>

        <hr class="my-5">

        <h3 class="mb-4">Safari Blue Trip FAQs</h3>
        <div class="accordion" id="safariBlueFAQ">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">
                  Do you provide transport from my Hotel?
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Yes, we provide hotel pick-up and drop-off service for an additional charge. Please inform us of your hotel location during booking.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo">
                  Where do I start booking the tour?
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                You can book directly through our website using the booking button below, or contact us via email or phone for personalized assistance.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree">
                  What to bring for Safari Blue trip?
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Bring sunscreen, a towel, swimwear, light clothing, and a camera. We provide snorkeling equipment. It's also recommended to bring a waterproof bag for personal items.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour">
                  How much is Zanzibar Safari Blue?
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Safari Blue starts from $49 per person for a full day tour. Prices may vary based on group size and additional services like hotel transfers.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingFive">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive">
                  Can I pay by Card?
                </button>
              </h5>
            </div>
            <div id="collapseFive" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Yes, we accept all major credit cards and online payment methods. You can pay securely during the booking process.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingSix">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSix">
                  How long Safari Blue trip?
                </button>
              </h5>
            </div>
            <div id="collapseSix" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Safari Blue is a full day tour, typically lasting 8-10 hours including hotel pick-up and drop-off.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingSeven">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseSeven">
                  Can I combine Safari blue with other Tours?
                </button>
              </h5>
            </div>
            <div id="collapseSeven" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Yes, Safari Blue can be combined with other tours. We offer customized packages. Contact us for more information.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingEight">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEight">
                  What are the main Activities In Safari Blue?
                </button>
              </h5>
            </div>
            <div id="collapseEight" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Main activities include snorkeling, swimming, visiting sandbanks, island hopping, climbing the Baobab tree, and enjoying fresh seafood lunch.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingNine">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseNine">
                  Is Safari Blue Best For Snorkeling?
                </button>
              </h5>
            </div>
            <div id="collapseNine" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Yes, Safari Blue is excellent for snorkeling. Menai Bay has beautiful coral reefs and abundant marine life, making it one of the best snorkeling destinations in Zanzibar.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingTen">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTen">
                  Is Safari Blue Private or Sharing boat?
                </button>
              </h5>
            </div>
            <div id="collapseTen" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                We offer both private and shared boat options. Private boats are available for larger groups or those preferring exclusive experiences.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header" id="headingEleven">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseEleven">
                  What is the best time to go Blue Safari Zanzibar?
                </button>
              </h5>
            </div>
            <div id="collapseEleven" class="collapse" data-parent="#safariBlueFAQ">
              <div class="card-body">
                Safari Blue is available year-round. The best time is during the dry season (June to October) for optimal weather and visibility. However, tours operate throughout the year.
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-4">
        <!-- Tour Image Gallery -->
        <div class="tour-gallery mb-5">
          <img src="{{ asset('images/tours/safari-blue-1.jpg') }}" alt="Safari Blue" class="img-fluid rounded mb-3">
          <img src="{{ asset('images/tours/safari-blue-2.jpg') }}" alt="Safari Blue Snorkeling" class="img-fluid rounded mb-3">
          <img src="{{ asset('images/tours/safari-blue-3.jpg') }}" alt="Safari Blue Beach" class="img-fluid rounded">
        </div>

        <!-- Tour Summary Card -->
        <div class="card border-0 shadow mb-4">
          <div class="card-body">
            <h4 class="card-title">Zanzibar Safari Blue</h4>
            <div class="rating mb-3">
              <span class="fa fa-star" style="color: #FFD700;"></span>
              <span class="fa fa-star" style="color: #FFD700;"></span>
              <span class="fa fa-star" style="color: #FFD700;"></span>
              <span class="fa fa-star" style="color: #FFD700;"></span>
              <span class="fa fa-star" style="color: #FFD700;"></span>
              <span class="ml-2">(250+ Reviews)</span>
            </div>

            <div class="tour-info mb-4">
              <div class="d-flex justify-content-between mb-3">
                <span><strong>Duration:</strong></span>
                <span>Full Day (8-10 hrs)</span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span><strong>Difficulty:</strong></span>
                <span>Easy - Moderate</span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span><strong>Group Size:</strong></span>
                <span>2-30 People</span>
              </div>
              <div class="d-flex justify-content-between mb-3">
                <span><strong>Languages:</strong></span>
                <span>English, Swahili</span>
              </div>
            </div>

            <div class="price-section mb-4 p-3 bg-light rounded">
              <h5>Starting from:</h5>
              <h2 class="text-primary">$49 <small>/person</small></h2>
              <small class="text-muted">All fees included</small>
            </div>

            <button type="button" class="btn btn-primary btn-block btn-lg mb-2" data-toggle="modal" data-target="#bookingModal">
              <i class="fa fa-calendar mr-2"></i> Book Now
            </button>
            <button type="button" class="btn btn-outline-primary btn-block">
              <i class="fa fa-envelope mr-2"></i> Contact Us
            </button>

            <div class="mt-4">
              <h5>What to Bring</h5>
              <ul class="list-unstyled">
                <li><i class="fa fa-check text-success mr-2"></i> Swimwear</li>
                <li><i class="fa fa-check text-success mr-2"></i> Sunscreen</li>
                <li><i class="fa fa-check text-success mr-2"></i> Towel</li>
                <li><i class="fa fa-check text-success mr-2"></i> Camera</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Location Info -->
        <div class="card border-0 shadow">
          <div class="card-body">
            <h5>Tour Location</h5>
            <p><strong>Menai Bay Conservation Area</strong></p>
            <p>Menai Bay, West South Coast<br>Unguja, Zanzibar, Tanzania</p>
            <p class="text-muted small">470 sq km marine conserved area with coral reefs and marine wildlife</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Book Safari Blue Tour</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="bookingTourInfo" class="mb-4">
          <h4>Zanzibar Safari Blue</h4>
          <p><strong>Price:</strong> $49/person</p>
          <p><strong>Duration:</strong> Full Day (8-10 hours)</p>
          <p><strong>Location:</strong> Menai Bay Conservation Area</p>
        </div>
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
            <label for="travelDate">Preferred Travel Date</label>
            <input type="date" class="form-control" id="travelDate" required>
          </div>
          <div class="form-group">
            <label for="numberOfPeople">Number of People</label>
            <input type="number" class="form-control" id="numberOfPeople" min="1" value="2" required>
          </div>
          <div class="form-group">
            <label for="specialRequests">Special Requests (Optional)</label>
            <textarea class="form-control" id="specialRequests" rows="3" placeholder="Vegetarian meals, hotel pickup, etc."></textarea>
          </div>
          <input type="hidden" id="selectedTour" value="safari-blue">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitBooking">Complete Booking</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
  $('#submitBooking').click(function() {
    const formData = {
      tour: 'safari-blue',
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
    alert('Thank you for booking Safari Blue! We will contact you soon to confirm your reservation.');
    $('#bookingModal').modal('hide');
    $('#bookingForm')[0].reset();
  });
});
</script>
@endsection
