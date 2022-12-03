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
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"> {{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"> {{ __('register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">個人檔案</a>
                    <a class="dropdown-item" href="{{ url('my-order') }}">我的訂單</a>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">後臺管理</a>
                    <a class="dropdown-item" href="#">設置</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
        @endguest
        <a href="about.html" class="nav-item nav-link">About</a>
        <a href="{{ url('wishlist') }}" class="nav-item nav-link">Wishlist
            <span class="badge badge-pill bg-primary wish-count">0</span>
        </a>
        <a href="{{ url('cart') }}" class="nav-item nav-link">購物車
            <span class="badge badge-pill bg-success cart-count">0</span>
        </a>
        <a href="{{ url('category') }}" class="nav-item nav-link">商品目錄</a>
          <!--<div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
              <div class="dropdown-menu shadow-sm m-0">
                  <a href="feature.html" class="dropdown-item">Feature</a>
                  <a href="token.html" class="dropdown-item">Token Sale</a>
                  <a href="faq.html" class="dropdown-item">FAQs</a>
                  <a href="404.html" class="dropdown-item">404 Page</a>
              </div>
          </div>-->
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