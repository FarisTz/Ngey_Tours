@extends('welcome')
@section('title','Contact US')
@section('content')

 <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/image_2.jpg ');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate pb-5 text-center">
       <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Contact us <i class="fa fa-chevron-right"></i></span></p>
       <marquee behavior="scroll" direction="left"> <h2 class="mb-3 bread" style="color: white">Enjoy the Ngey Tour & Safari</h2></marquee>
       <h1 class="mb-0 bread">Contact us</h1>
     </div>
   </div>
 </div>
</section>

<section class="ftco-section ftco-no-pb contact-section mb-4">
  <div class="container">
    <div class="row d-flex contact-info">
      <div class="col-md-3 d-flex">
       <div class="align-self-stretch box p-4 text-center">
        <div class="icon d-flex align-items-center justify-content-center">
         <span class="fa fa-map-marker"></span>
       </div>
       <h3 class="mb-2">Address</h3>
       <p>Mbweni Zanzibar</p>
     </div>
   </div>
   <div class="col-md-3 d-flex">
     <div class="align-self-stretch box p-4 text-center">
      <div class="icon d-flex align-items-center justify-content-center">
       <span class="fa fa-phone"></span>
     </div>
     <h3 class="mb-2">Contact Number</h3>
     <p><a href="tel://+255 718 940 807">+255 718 940 807</a></p>
   </div>
 </div>
 <div class="col-md-3 d-flex">
   <div class="align-self-stretch box p-4 text-center">
    <div class="icon d-flex align-items-center justify-content-center">
     <span class="fa fa-paper-plane"></span>
   </div>
   <h3 class="mb-2">Email Address</h3>
   <p><a href="mailto:ngeytour@gmail.com">ngeytour@gmail.com</a></p>
 </div>
</div>
<div class="col-md-3 d-flex">
 <div class="align-self-stretch box p-4 text-center">
  <div class="icon d-flex align-items-center justify-content-center">
   <span class="fa fa-globe"></span>
 </div>
 <h3 class="mb-2">Website</h3>
 <p><a href="#">ngeytours.com</a></p>
</div>
</div>
</div>
</div>
</section>

<section class="ftco-section contact-section ftco-no-pt">
  <div class="container">
    <div class="row block-9">
      <div class="col-md-6 order-md-last d-flex">
        <form action="{{ route('contact.store') }}" method="POST" class="bg-light p-5 contact-form">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name" name="name">
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Your Email" name="email">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Subject" name="subject">
          </div>
          <div class="form-group">
            <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
          </div>
          <div class="form-group">
            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
          </div>
        </form>

      </div>

        <div class="col-md-6 d-flex">
         <!-- Map container -->
         <div id="map" class="bg-white" style="width:100%; height:420px; border-radius:8px;"></div>
       </div>
   </div>
 </div>
</section>

    @section('scripts')
      <!-- Leaflet CSS & JS (OpenStreetMap) - reliable CDN links -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          // Mbweni Zanzibar coordinates (lat, lon)
          const lat = -6.2124521331104035;
          const lon = 39.20905320828166;

          try {
            const map = L.map('map', { scrollWheelZoom: false }).setView([lat, lon], 17);

            // Base layers: Streets and Satellite (Esri World Imagery)
            const streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              maxZoom: 19,
              attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            });

            const satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
              maxZoom: 19,
              attribution: 'Tiles &copy; Esri &mdash; Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community'
            });

            // Add default layer
            streets.addTo(map);

            // Marker and popup
            const marker = L.marker([lat, lon]).addTo(map);
            marker.bindPopup('<strong>Ngey Tour & Safari</strong><br>Office: Mbweni, Zanzibar');

            // Layer control to toggle between base maps
            const baseMaps = {
              'Streets': streets,
              'Satellite': satellite,
            };
            L.control.layers(baseMaps, null, { position: 'topright' }).addTo(map);

            // Ensure map renders correctly if container was hidden or resized
            setTimeout(() => { map.invalidateSize(); marker.openPopup(); }, 200);

          } catch (err) {
            console.error('Leaflet initialization error:', err);
          }
        });
      </script>
    @endsection


@endsection
