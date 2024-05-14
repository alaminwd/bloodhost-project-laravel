<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donate</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700;800;900&family=Roboto+Condensed:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    
    @yield('links')
</head>

<body>

    <!-- preloader -->
    <!--<div id="preloader">-->
    <!--    <div id="loading-center">-->
    <!--        <div id="loading-center-absolute">-->
    <!--            <div class="object" id="object_one"></div>-->
    <!--            <div class="object" id="object_two"></div>-->
    <!--            <div class="object" id="object_three"></div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- preloader-end -->


    <!-- ===================== navbar start ======================-->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            @php
            $logos = App\Models\Logo::where('status', 1)->get();
            @endphp
            @foreach ($logos as $logo)
            <a class="navbar-brand" href="{{route('index')}}"><img style="max-width: 100px;"
                    src="{{asset('upload/logo')}}/{{$logo->logo}}" alt=""></a>
            @endforeach
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-lg-auto">
                    @php
                    $menus = App\Models\Menu::all();
                    @endphp
                    @foreach ($menus as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route($menu->menu_link)}}">{{$menu->menu_name}}</a>
                    </li>
                    @endforeach
                    <div class="login_btn ms-5 d-flex">
                        <a href="{{route('ssl.commerz')}}" class="help_us">Help Us</a>
                        
                        @auth('donorlogin')
                        <div class="dropdown">
                            <a style="cursor: pointer;" class="login_regis" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::guard('donorlogin')->user()->name}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('donor.profile')}}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('edit.donor.profile')}}">Edit Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('donor.logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        @else
                        <a href="{{route('donor.login.page')}}" class="login_regis">Login</a>
                        @endauth
    
    
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ===================== navbar End ======================-->
    @yield('content')
    <!-- ===========================================
                 Footer Part Start 
  ================================================-->
    <footer id="footer"
        style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(68, 1, 1, 0.8)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover;">
        <div class="footer_top">
            <div class="container">
                <div class="footer_top_main">
                    <div class="row">
                        <!-- footer first content -->
                        <div class="col-xl-4 col-lg-4 ">
                            <div class="footer_item">
                                @php
                                $footers = App\Models\Footer::all();
                                @endphp
                                @foreach ($footers as $footer)
                               <a href="{{route('index')}}">
                                <img src="{{asset('upload/footer')}}/{{$footer->footer_logo}}" width="100" alt="">
                               </a>
                                <p>{{$footer->desp}}</p>
                                @endforeach
                            </div>
                        </div>
                        <!-- footer second content -->
                        <div class="col-xl-3 col-lg-3 col-md-5  col-sm-5 col-7">
                            <div class="footer_item footer_contact">
                                <h3>Contact us</h3>
                                <div class="footer_item_content">
                                    <a href="#"><i class="fas fa-phone-alt"></i>{{$footer->number}}</a>
                                </div>
                                <div class="footer_item_content">
                                    <a href="#"><i class="fas fa-envelope"></i>{{$footer->email}}</a>
                                </div>
                                <div class="footer_item_content">
                                    <a href="{{$footer->website}}"><i
                                            class="fas fa-globe-asia"></i>{{$footer->website}}</a>
                                </div>
                                <div class="footer_item_icon">
                                    @php
                                    $footer_icons = App\Models\FooterIcon::all();
                                    @endphp
                                    @foreach ($footer_icons as $footer_icon)
                                    <a href="{{$footer_icon->icon_link}}"><i class="{{$footer_icon->icon}}"></i></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- footer Third content -->
                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-5 ">
                            <div class="footer_item footer_item3">
                                <h3>Support</h3>
                                <ul>
                                    <li><a href="{{route('contact')}}"><i class="fa-solid fa-check"></i>Support Center</a></li>
                                    <li><a href="{{route('blog')}}"><i class="fa-solid fa-check"></i>Our Blog</a></li>
                                    <li><a href="{{route('term')}}"><i class="fa-solid fa-check"></i>Terms of Use</a></li>
                                    <li><a href="{{route('policy')}}"><i class="fa-solid fa-check"></i>Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- footer Third content -->
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4">
                            <div class="footer_item">
                                <h3>Sponsored</h3>
                                <div class="footer_last">
                                    <div class="row">
                                        @php
                                        $footerimgs = App\Models\FooterImage::all();
                                        @endphp
                                        @foreach ($footerimgs as $foot_img)
                                        <div class="col-lg-4 col-4">
                                            <a href="{{$foot_img->foot_img_link}}"><img src="{{asset('upload/footer')}}/{{$foot_img->foot_img}}"
                                                class="w-100 img-fluid" alt=""></a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_btm">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="foot_btm_content">
                        <p>Copyright © 2023 <a href="http://www.dominytech.com/">Dominytech</a> Biggest Directory All
                            Right Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- back to top button -->
    <button class="backToTopBtn"><i class="fa fa-arrow-up"></i></button>
    <!-- ===========================================
                 Footer Part Start 
  ================================================-->
                 

    <!-- Font Awesome icon -->
  
    <script src="https://kit.fontawesome.com/80bacdb160.js" crossorigin="anonymous"></script>
    <script src="{{asset('frontend/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/counterup.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('frontend/js/script.js')}}"></script>
    @yield('footer_script')

</body>

</html>
