@extends('welcome')
@section('title','Contact US')
@section('content')

 <!-- Hero section with background image same style -->
  <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/Spice-farm-Tour-from-stone-town.webp');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
        <div class="col-md-9 ftco-animate pb-5 text-center">
          <p class="breadcrumbs"><span class="mr-2"><a href="/">Home <i class="fa fa-chevron-right"></i></a></span> <span>Login </span></p>
          <h1 class="mb-0 bread">Welcome Back</h1>
        </div>
      </div>
    </div>
  </section>

   <!-- Main Login Section - Matches contact section style but adapted for login/register -->
  <section class="ftco-section contact-section ftco-no-pb">
    <div class="container">
      <div class="row block-9 justify-content-center">
        <!-- Login / Register Card with Tabs (similar to the contact form style but modern) -->
        <div class="col-md-8 col-lg-7 d-flex">
          <div class="login-card w-100">
            <!-- Tabs navigation (Login & Register) -->
            <ul class="nav nav-tabs" id="loginTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-toggle="tab" data-target="#loginPane" type="button" role="tab" aria-controls="loginPane" aria-selected="true">Sign In</button>
              </li>
            </ul>
            <div class="tab-content" id="loginTabContent">
              <!-- LOGIN FORM PANEL -->
              <div class="tab-pane fade show active" id="loginPane" role="tabpanel" aria-labelledby="login-tab"></div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>

    </div>
    </div>
  </section>

@endsection
