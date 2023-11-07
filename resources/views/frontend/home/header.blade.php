@php
    $sitesetting = App\Models\Sitesetting::find(1);
@endphp
<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{ $sitesetting->company_address }}</li>
                    <li><i class="far fa-clock"></i>Mon - Sat 9.00 - 18.00</li>
                    <li><i class="far fa-phone"></i><a href="tel:2512353256">{{ $sitesetting->support_phone }}</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="{{ $sitesetting->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ $sitesetting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="index.html"><i class="fab fa-vimeo-v"></i></a></li>
                </ul>
                @auth
                    <div class="sign-box">
                        <span>{{ Auth::user()->name }}</span>
                        @if (Auth::user()->role == 'user')
                            <a href="{{ route('dashboard') }}"><i class="fa fa-user-circle"></i>Dashboard</a>
                        @elseif (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}"><i class="fa fa-superpowers" aria-hidden="true">
                                </i>Dashboard</a>
                        @elseif (Auth::user()->role == 'agent')
                            <a href="{{ route('agent.dashboard') }}"><i class="fa fa-superpowers"></i>Dashboard</a>
                        @endif

                        <a href="{{ route('user.logout') }}"><i class="fa fa-sign-out"></i>logout</a>
                    </div>
                @else
                    <div class="sign-box">
                        <a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>Sign In</a>
                    </div>
                @endauth

            </div>
        </div>
    </div>
    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img style="width: 180px; height: 80px; "
                                src="{{ asset($sitesetting->logo) }}" alt=""></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->
                    <div class="mobile-nav-toggler">
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                        <i class="icon-bar"></i>
                    </div>
                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="{{ url('/') }}"><span>Home</span></a>

                                </li>
                                <li><a href="{{ url('/') }}"><span>About us</span></a>

                                </li>
                                <li class="dropdown"><a href="index.html"><span>Property</span></a>
                                    <ul>
                                        <li><a href="{{ route('rent.property') }}">Rent property</a></li>
                                        <li><a href="{{ route('buy.property') }}">buy Grid</a></li>

                                    </ul>
                                </li>
                                <li><a href="{{ url('agent.details') }}"><span>Agent list</span></a>

                                </li>

                                <li><a href="{{ route('blog.list') }}"><span>Blog</span></a>

                                </li>
                                <li><a href="contact.html"><span>Contact</span></a></li>

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="{{ route('agent.login') }}" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div>
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset($sitesetting->logo) }}"
                                alt=""></a>
                    </figure>
                </div>
                <div class="menu-area clearfix">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
                <div class="btn-box">
                    <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                </div>
            </div>
        </div>
    </div>
</header>
