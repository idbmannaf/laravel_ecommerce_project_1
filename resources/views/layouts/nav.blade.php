@php
$title= basename( $_SERVER['PHP_SELF'],'/');
@endphp
<!-- ########## START: LEFT PANEL ########## -->
<div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> Admin-Panel</a></div>
<div class="sl-sideleft">
<label class="sidebar-label text-center">Menu</label>
<div class="sl-sideleft-menu">
  <a href="{{ url('home') }}" class="sl-menu-link @if($title == 'home') active @endif">
    <div class="sl-menu-item">
      <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>

      <span class="menu-item-label">Dashboard</span>
    </div>
    </a>

    @if (Auth::user()->role == 2)
            <a href="{{ url('category') }}" class="sl-menu-link @if($title == 'category') active @endif">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon fas fa-list-alt tx-20"></i>
                    {{-- <i class="fas fa-list-alt " aria-hidden="true"></i> --}}
                    <span class="menu-item-label">Categories</span>
                </div>
            </a>
            <a href="{{ url('subcategory') }}" class="sl-menu-link @if($title == 'subcategory') active @endif">
                <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Sub Categories</span>
                </div>
            </a>

            <a href="{{ url('product') }}" class="sl-menu-link   @if($title == 'product') active @endif">
                <div class="sl-menu-item">
                <i class="menu-item-icon icon fab fa-product-hunt tx-20"></i>
                <span class="menu-item-label">Product</span>
                </div>
            </a>

            <a href="{{ url('testimonial') }}" class="sl-menu-link   @if($title == 'testimonial') active @endif">
                <div class="sl-menu-item">
                <i class="menu-item-icon icon fab fa-product-hunt tx-20"></i>
                <span class="menu-item-label">Testimonial</span>
                </div>
            </a>
            <a href="{{ url('coupon') }}" class="sl-menu-link @if($title == 'coupon') active @endif" target="_blank">
                <div class="sl-menu-item">
                <i class="menu-item-icon icon fab fa-product-hunt tx-20"></i>
                <span class="menu-item-label">Coupon</span>
                </div>
            </a>
            <a href="{{ url('mail') }}" class="sl-menu-link @if($title == 'mail') active @endif">
                <div class="sl-menu-item">
                <i class="menu-item-icon icon far fa-envelope-open tx-20"></i>
                <span class="menu-item-label">Send Email</span>
                </div>
            </a>


        @endif



        <a href="{{ url('/') }}" class="sl-menu-link "target="_blank">
            <div class="sl-menu-item">
            <i class="menu-item-icon icon fab fa-product-hunt tx-20"></i>
            <span class="menu-item-label">Vew Website</span>
            </div>
        </a>


</div><!-- sl-sideleft-menu -->
</div><!-- sl-sideleft -->

<!-- ########## END: LEFT PANEL ########## -->

  <!-- ########## START: HEAD PANEL ########## -->
  <div class="sl-header">
    <div class="sl-header-left">
      <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
      <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    </div><!-- sl-header-left -->
    <div class="sl-header-right">
      <nav class="nav">
        <div class="dropdown">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <span class="logged-name">{{ Auth::user()->name }}</span></span>
            <img src="{{ asset('uploads/profile_photos') }}/{{ Auth::user()->photo }}" class="wd-32 rounded-circle" alt="">
          </a>
          <div class="dropdown-menu dropdown-menu-header wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="{{ url('profile') }}"><i class="icon ion-ios-person-outline"></i> View Profile</a></li>
              <li><a href="{{ url('profile/editprofile') }}"><i class="icon ion-ios-gear-outline"></i> Edit Profile</a></li>
              <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </nav>
    </div><!-- sl-header-right -->
  </div><!-- sl-header -->
  <!-- ########## END: HEAD PANEL ########## -->

