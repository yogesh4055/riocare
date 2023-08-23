<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
      <a class="navbar-brand brand-logo" href="{{ route("home") }}"><img src="{{ asset('assets/img/rio_care_logo.png') }}" class="mr-2" alt="logo"/><span class="sys-logo align-self-center">Inventory and Stock Management</span></a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/img/rio_care_small_logo.png') }}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center d-md-none d-lg-block" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <!--<ul class="navbar-nav mr-lg-2">
        <li class="nav-item nav-search d-none d-lg-block">
          <div class="input-group">
            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
              <span class="input-group-text" id="search">
                <button type="search"><i class="icon-search" data-feather="search"></i></button>
              </span>
            </div>
          </div>
        </li>
      </ul>-->
      <ul class="navbar-nav navbar-nav-right">


        <li class="nav-item nav-profile dropdown">
          @guest

          @else
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <img src="{{ asset('assets/img/user_img.png') }}" alt="profile"/>
            <span class="username">
              <h6>{{ Auth::user()->name }}</h6>
            </span>
            <i class="align-self-center ml-1" data-feather="chevron-down"></i>
          </a>


          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item">
              <i class="text-danger mr-2" data-feather="settings"></i>
              Settings
            </a>

            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                 <i class="text-danger mr-2" data-feather="power"></i>{{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
          @endguest
        </li>
        <!-- <li class="nav-item nav-settings d-none d-lg-flex"> -->
          <!-- <a class="nav-link" href="#"> -->
            <!-- <i class="icon-ellipsis"></i> -->
          <!-- </a> -->
        <!-- </li> -->
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="sidebar">
        <span class="icon-menu"></span>
      </button>
    </div>
  </nav>
