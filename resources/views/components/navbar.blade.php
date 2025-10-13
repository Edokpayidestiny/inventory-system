<div class="header">
    <div class="header-left active">
        @if (Auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
            </a>
            <a href="{{ route('admin.dashboard') }}" class="logo-small">
                <img src="{{ asset('assets/img/logo-small.png') }}" alt="">
            </a>
        @elseif(Auth()->user()->role === 'staff')
            <a href="{{ route('staff.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
            </a>
            <a href="{{ route('staff.dashboard') }}" class="logo-small">
                <img src="{{ asset('assets/img/logo-small.png') }}" alt="">
            </a>
        @endif
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="{{ asset('assets/img/icons/search.svg') }}"
                            alt="img"></a>
                </form>
            </div>
        </li>


        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('assets/img/profiles/avatar-13.jpg') }}" alt="">
                    <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="{{ asset('assets/img/profiles/avatar-13.jpg') }}"
                                alt="">
                            <span class="status online"></span></span>
                        <div class="profilesets">
                            <h6>{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                    <hr class="m-0">

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item logout pb-0">
                            <img src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2"
                                alt="img">Logout
                        </button>
                    </form>
                </div>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            {{-- <a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a> --}}
            <a class="dropdown-item" href="">Settings</a>
            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

</div>
