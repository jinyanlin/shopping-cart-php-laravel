<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
  <a href="{{ url('/')}}" class="navbar-brand d-flex align-items-center">
      <h2 class="m-0 text-primary"><img class="img-fluid me-2" src="img/icon-1.png" alt=""
              style="width: 45px;">JIN 購物商城</h2>
  </a>
  <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto py-4 py-lg-0">
        @if (Route::has('login'))

            @auth
                <a href="{{ url('/home') }}" class="nav-item nav-link">Home</a>
            @else
                <a href="{{ route('login') }}" class="nav-item nav-link">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-item nav-link ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
  
        @endif
          <a href="about.html" class="nav-item nav-link">About</a>
          <a href="service.html" class="nav-item nav-link">Service</a>
          <a href="{{ url('category') }}" class="nav-item nav-link">Category</a>
          <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
              <div class="dropdown-menu shadow-sm m-0">
                  <a href="feature.html" class="dropdown-item">Feature</a>
                  <a href="token.html" class="dropdown-item">Token Sale</a>
                  <a href="faq.html" class="dropdown-item">FAQs</a>
                  <a href="404.html" class="dropdown-item">404 Page</a>
              </div>
          </div>
          <a href="contact.html" class="nav-item nav-link">Contact</a>
      </div>
      
      <div class="h-100 d-lg-inline-flex align-items-center d-none">
          <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i
                  class="fab fa-facebook-f"></i></a>
          <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i
                  class="fab fa-twitter"></i></a>
          <a class="btn btn-square rounded-circle bg-light text-primary me-0" href=""><i
                  class="fab fa-linkedin-in"></i></a>
      </div>
  </div>
</nav>