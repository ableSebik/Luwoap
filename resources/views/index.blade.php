@extends("layouts.app")

@section("content")
  <div class="home-refresh">
    <section class="home-hero" id="banner">
      <div id="boxgallery" class="home-hero-gallery home-fade-slider boxgallery" aria-hidden="true">
        <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-3.jpg") }}" alt=""></div>
        <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-2.jpg") }}" alt=""></div>
        <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-1.jpg") }}" alt=""></div>
        <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-5.jpg") }}" alt=""></div>
      </div>

      <div class="container home-hero-inner">
        <div class="home-hero-copy">
          <h1>Find Your Next Place in Ghana</h1>
          <p>Houses, hostels, and Airbnb stays. Verified listings. Trusted by many.</p>
        </div>

        <form class="home-search-card" action="{{ route("search") }}" method="get">
          <div class="home-search-field">
            <label for="home-property-type">What are you looking for?</label>
            <select id="home-property-type" name="type" aria-label="Property type">
              <option value="">All Types</option>
              <option value="house">Houses</option>
              <option value="hostel">Hostels</option>
              <option value="airbnb">Airbnb</option>
              <option value="apartment">Apartments</option>
            </select>
          </div>
          <div class="home-search-field home-search-field-wide">
            <label for="home-location">Location</label>
            <input id="home-location" name="query" type="search" placeholder="Enter location or area" required>
          </div>
          <div class="home-search-field">
            <label for="home-min-price">Min Price</label>
            <input id="home-min-price" name="min_price" type="number" min="0" placeholder="Min Price">
          </div>
          <div class="home-search-field">
            <label for="home-max-price">Max Price</label>
            <input id="home-max-price" name="max_price" type="number" min="0" placeholder="Max Price">
          </div>
          <button class="home-search-button" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
            <span>Search</span>
          </button>
        </form>
      </div>
    </section>

    <section class="home-section home-categories">
      <div class="container">
        <div class="home-section-heading">
          <h2>Browse by Category</h2>
        </div>
        <div class="home-category-grid">
          <a href="{{ route("house.prop") }}" class="home-category-card">
            <img loading="lazy" src="{{ asset("assets/img/banner/img-5.jpg") }}" alt="Modern house with pool">
            <div>
              <h3>Houses</h3>
              <p>Find your perfect home for sale or rent across Ghana.</p>
              <span>Explore Houses <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </div>
          </a>
          <a href="{{ route("hostel.prop") }}" class="home-category-card">
            <img loading="lazy" src="{{ asset("assets/img/img-3.jpg") }}" alt="Hostel apartment building">
            <div>
              <h3>Hostels</h3>
              <p>Affordable and comfortable hostel accommodations.</p>
              <span>Explore Hostels <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </div>
          </a>
          <a href="{{ route("airbnb.prop") }}" class="home-category-card">
            <img loading="lazy" src="{{ asset("assets/img/banner/img-1.jpg") }}" alt="Comfortable short stay bedroom">
            <div>
              <h3>Airbnb</h3>
              <p>Short stays, cozy spaces, anytime you need.</p>
              <span>Explore Airbnb <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </div>
          </a>
        </div>
      </div>
    </section>

    <section class="home-section home-properties">
      <div class="container">
        <div class="home-section-heading home-section-heading-row">
          <h2>Latest Properties</h2>
          <a href="{{ route("all-properties") }}">View all properties <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="home-property-grid">
          @forelse ($props->take(4) as $prop)
            <x-property-box :prop="$prop" />
          @empty
            <p class="home-empty-state">No properties are live yet.</p>
          @endforelse
        </div>
      </div>
    </section>

    <section class="home-section home-reasons">
      <div class="container">
        <div class="home-section-heading home-section-heading-center">
          <h2>Why Choose LUWOAP Properties?</h2>
        </div>
        <div class="home-reason-grid">
          <div class="home-reason">
            <i class="bi bi-shield-check" aria-hidden="true"></i>
            <h3>Verified Listings</h3>
            <p>Every property is reviewed for your peace of mind.</p>
          </div>
          <div class="home-reason">
            <i class="bi bi-hand-thumbs-up" aria-hidden="true"></i>
            <h3>Trusted Service</h3>
            <p>We are committed to honesty and reliability.</p>
          </div>
          <div class="home-reason">
            <i class="bi bi-house-heart" aria-hidden="true"></i>
            <h3>Wide Range</h3>
            <p>From homes to hostels and shortlets, we have you covered.</p>
          </div>
          <div class="home-reason">
            <i class="bi bi-headset" aria-hidden="true"></i>
            <h3>Customer Support</h3>
            <p>Our team is here to assist every step of the way.</p>
          </div>
        </div>
      </div>
    </section>

    <div class="action-bar container d-md-none">
      <a href="tel:+233201492986">
        <div class="call-action action-group">
          <span class="fa fa-phone-alt"></span>
          <p>CALL</p>
        </div>
      </a>
      <a href="https://wa.me/233201492986">
        <div class="whatsapp-action action-group">
          <span class="fab fa-whatsapp"></span>
          <p>WHATSAPP</p>
        </div>
      </a>
      <a href="mailto:info@luwoap.com">
        <div class="sms-action action-group">
          <span class="fas fa-envelope"></span>
          <p>EMAIL</p>
        </div>
      </a>
    </div>
  </div>
@endsection
