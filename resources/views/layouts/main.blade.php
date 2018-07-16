<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel 5.6 - {{ config('app.name') }} </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet"
          type="text/css">
    <link href="{{ asset('assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
    <link href="{{asset("assets/styles/toastr.min.css")}}" rel="stylesheet">


    @yield('css')

    <script>
        window.csrfToken = "{{ csrf_token() }}"
    </script>
</head>

<body data-status="{{Session::get("status")}}">

<div class="super_container">

    <!-- Header -->

    <header class="header trans_300">

        <!-- Top Navigation -->

        <div class="top_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top_nav_left">Laravel E-Commerce + Iyzico</div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="top_nav_right">

                            <ul class="top_nav_menu">

                                <!-- Currency / Language / My Account -->
                                @if(Auth::guest())
                                    <li class="language">
                                        <a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                            Sign In</a>
                                    </li>
                                    <li class="language">
                                        <a href="{{ route('register') }}"><i class="fa fa-user-plus"
                                                                             aria-hidden="true"></i> Register</a>
                                    </li>
                                @else
                                    <li class="account">
                                        <a href="#">
                                            {{ Auth::user()->name }}
                                            <i class="fa fa-angle-down"></i>
                                        </a>

                                        <ul class="account_selection">
                                            @if(Auth::user()->isItAuthorized("admin"))
                                                <li><b>ADMIN</b></li>
                                                <li><a href="{{ url('/admin-users') }}"><i
                                                                class="fa fa-btn fa-users"></i>Users</a>
                                                </li>
                                                <li><a href="{{ url('/admin-category') }}"><i
                                                                class="fa fa-btn fa-list-ul"></i>Category</a></li>
                                                <li><a href="{{ url('/admin-products') }}"><i
                                                                class="fa fa-btn fa-cubes"></i>Products</a>
                                                </li>
                                                <li><a href="{{ url('/admin-orders') }}"><i
                                                                class="fa fa-btn fa-cogs"></i>Orders</a></li>
                                                <li class="divider"></li>
                                            @endif

                                            @if(Auth::user())
                                                <li><b>USER</b></li>
                                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a>
                                                </li>
                                                <li><a href="{{ url('/orders') }}"><i class="fa fa-btn fa-list-alt"></i>Orders</a>
                                                </li>
                                            @endif
                                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                            </li>
                                        </ul>


                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->

        <div class="main_nav_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <div class="logo_container">
                            <a href="/"><span>{{ config('app.name') }}</span></a>
                        </div>
                        <nav class="navbar">
                            <ul class="navbar_menu">
                                <li><a href="/">HOMEPAGE</a></li>

                                @foreach($categoryMenu as $menu)
                                    <li><a href="/category/{{ $menu->slug }}">{{ $menu->category_name }}</a>
                                    </li>
                                @endforeach

                                <li><a href="{{ route('contact') }}">CONTACT</a></li>

                            </ul>
                            <ul class="navbar_user">

                                <li class="checkout">
                                    <a href="{{route('basket')}}">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="checkout_items" class="checkout_items">{{ Cart::count() }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="hamburger_container">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <div class="fs_menu_overlay"></div>
    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">
                <li class="menu_item"><a href="{{ route('home') }}">HOMEPAGE</a></li>
                @foreach($categoryMenu as $menu)
                    <li class="menu_item"><a href="/category/{{ $menu->slug }}">{{ $menu->category_name }}</a>
                    </li>
                @endforeach
                <li class="menu_item"><a href="{{ route('contact') }}">CONTACT</a></li>


                @if(Auth::guest())
                    <li class="menu_item">
                        <a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>
                            Sign In</a>
                    </li>
                    <li class="menu_item">
                        <a href="{{ route('register') }}"><i class="fa fa-user-plus"
                                                             aria-hidden="true"></i> Register</a>
                    </li>
                @else
                    <li class="menu_item has-children">
                        <a href="#">
                            {{ Auth::user()->name }} {{ Auth::user()->surname}}
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="menu_selection">
                            @if(Auth::user()->isItAuthorized("admin"))
                                <li><b>ADMIN</b></li>
                                <li><a href="{{ url('/admin-users') }}">Users</a></li>
                                <li><a href="{{ url('/admin-category') }}">Category</a></li>
                                <li><a href="{{ url('/admin-products') }}">Products</a>
                                </li>
                                <li><a href="{{ url('/admin-orders') }}">Orders</a></li>
                            @endif

                            @if(Auth::user())
                                <li><b>USER</b></li>
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                <li><a href="{{ url('/orders') }}"><i class="fa fa-btn fa-list-alt"></i>Orders</a></li>
                            @endif
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                            </li>
                        </ul>


                    </li>
                @endif


            </ul>
        </div>
    </div>


@yield('content')

<!-- Footer -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6">
                    <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                        <ul>
                            <li><a href="http://www.facebook.com/anil.ozmen.35"><i class="fa fa-facebook"
                                                                                   aria-hidden="true"></i></a>
                            </li>
                            <li><a href="http://www.twitter.com/Anilozmenn"><i class="fa fa-twitter"
                                                                               aria-hidden="true"></i></a>
                            </li>
                            <li><a href="http://www.instagram.com/anilozmen"><i class="fa fa-instagram"
                                                                                aria-hidden="true"></i></a></li>
                            <li><a href="http://www.github.com/anilozmen"><i class="fa fa-github"
                                                                             aria-hidden="true"></i></a></li>
                            <li><a href="http://www.gitlab.com/anilozmen"><i class="fa fa-gitlab"
                                                                             aria-hidden="true"></i></a></li>
                            <li><a href="@anilozmen35"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer_nav_container">
                        <div class="cr">©2018 All Rights Reserved. This template is made with <i class="fa fa-heart-o"
                                                                                                 aria-hidden="true"></i>
                            by <a href="#">Colorlib</a></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>


<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{asset("assets/js//toastr.min.js")}}"></script>

@yield('js')


</body>

</html>
