<div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo"><a href="{{ url('/') }}" class="simple-text logo-normal">
        回官網
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <li class="nav-item {{Request::is('admin/categories')? 'active':'' }}" >
            <a class="nav-link" href="{{ url('admin/categories') }}">
              <i class="material-icons">library_books</i>
              <p>類別</p>
            </a>
          </li>
        <li class="nav-item {{ Request::is('admin/add-categories')?'active':''}}">
          <a class="nav-link" href="{{ url('admin/add-categories') }}">
            <i class="material-icons">library_books</i>
            <p>增加類別</p>
          </a>
        </li>
        <li class="nav-item {{Request::is('admin/products')? 'active':'' }}" >
          <a class="nav-link" href="{{ url('admin/products') }}">
            <i class="material-icons">content_paste</i>
            <p>商品</p>
          </a>
        </li>
      <li class="nav-item {{ Request::is('admin/add-products')?'active':''}}">
        <a class="nav-link" href="{{ url('admin/add-products') }}">
          <i class="material-icons">content_paste</i>
          <p>增加商品</p>
        </a>
      </li>
        
        <li class="nav-item {{ Request::is('admin/orders')?'active':''}}">
          <a class="nav-link" href="{{ url('admin/orders') }}">
            <i class="material-icons">library_books</i>
            <p>訂單</p>
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/users')?'active':''}}">
          <a class="nav-link" href="{{ url('admin/users') }}">
            <i class="material-icons">bubble_chart</i>
            <p>使用者名單</p>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="./map.html">
            <i class="material-icons">location_ons</i>
            <p>Maps</p>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="./notifications.html">
            <i class="material-icons">notifications</i>
            <p>Notifications</p>
          </a>
        </li>
        <!-- <li class="nav-item active-pro ">
              <a class="nav-link" href="./upgrade.html">
                  <i class="material-icons">unarchive</i>
                  <p>Upgrade to PRO</p>
              </a>
          </li> -->
      </ul>
    </div>
  </div>