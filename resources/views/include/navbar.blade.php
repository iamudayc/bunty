<div class="container-fluid nav-bar bg-transparent">
  <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
      <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center text-center">
          <!-- <div class="icon p-2 me-2">
              <img class="img-fluid" src="{{ asset('assets/img/icon-deal.png') }}" alt="Icon" style="width: 30px; height: 30px;">
          </div> -->
          <!-- <h1 class="m-0 text-primary font-effect-outline blue-text">Kalpataru</h1> -->
          <h1 class="m-0 text-primary font-effect-outline blue-text">
            <img class="img-fluid" src="{{ asset('assets/img/logo.jpeg') }}" style="width: 240px;" alt="Kalpataru" >
          </h1>
      </a>
      <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <div class="navbar-nav ms-auto">
              <a href="{{ url('/') }}" class="nav-item nav-link {{ (request()->is('/')) ? 'active' : '' }}">Home</a> 
              <a href="{{ url('/services') }}" class="nav-item nav-link {{ (request()->is('services*')) ? 'active' : '' }}">Services</a>
              <a href="{{ url('/gallery') }}" class="nav-item nav-link {{ (request()->is('gallery*')) ? 'active' : '' }}">Gallery</a> 
              <a href="{{ url('/career') }}" class="nav-item nav-link {{ (request()->is('career*')) ? 'active' : '' }}">Career</a>
              <a href="{{ url('/contact') }}" class="nav-item nav-link {{ (request()->is('contact*')) ? 'active' : '' }}">Contact</a>
              @if(Auth::check())
                <a href="{{ url('/user/listing') }}" class="nav-item nav-link {{ (request()->is('user/listing')) ? 'active' : '' }}">Dashboard</a>
              @else
                <a href="{{ url('/user/login') }}" class="nav-item nav-link {{ (request()->is('user/*')) ? 'active' : '' }}">Login</a>
              @endif
          </div>
      </div>
  </nav>
</div>