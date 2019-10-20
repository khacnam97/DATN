<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->

<!-- Mirrored from eazzy.me/html/imevent-multipage/event-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2015 01:32:10 GMT -->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>im Event</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <!-- CSS Global -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/fontawesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="assets/plugins/owlcarousel2/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/plugins/owlcarousel2/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="assets/plugins/prettyphoto/css/prettyPhoto.css" rel="stylesheet">
    <link href="assets/plugins/animate/animate.min.css" rel="stylesheet">
    <link href="assets/plugins/countdown/jquery.countdown.css" rel="stylesheet">

    <link href="assets/css/theme.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="assets/plugins/iesupport/html5shiv.js"></script>
    <script src="assets/plugins/iesupport/respond.min.js"></script>
    <![endif]-->
</head>
<body id="home" class="wide body-light multipage multipage-sub">

<!-- Preloader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Wrap all content -->
<div class="wrapper">

    <!-- HEADER -->
    <header class="header fixed">

        <div class="container">
            <div class="header-wrapper clearfix">

            <!-- Logo -->
            <div class="logo">
                <a href="index.html" class="scroll-to">
                    <span class="fa-stack">
                        <i class="fa logo-hex fa-stack-2x"></i>
                        <i class="fa logo-fa fa-map-marker fa-stack-1x"></i>
                    </span>
                    Nam Event
                </a>
            </div>
            <!-- /Logo -->

            <!-- Navigation -->
            <div id="mobile-menu"></div>
            <nav class="navigation closed clearfix">
                <a href="#" class="menu-toggle btn"><i class="fa fa-bars"></i></a>
                <ul class="sf-menu nav">
                    <li>
                        <a href="index.html">Home</a>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="index-2.html">Home 2</a></li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="event-list.html">Events</a>
                        <ul>
                            <li><a href="event-list.html">Event List</a></li>
                            <li><a href="event-grid.html">Event Grid</a></li>
                            <li><a href="event-single.html">Single Event</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="blog.html">Pages</a>
                        <ul>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-single.html">Blog Single</a></li>
                            <li><a href="coming-soon-1.html">Coming Soon 1</a></li>
                            <li><a href="coming-soon-2.html">Coming Soon 2</a></li>
                            <li><a href="coming-soon-3.html">Coming Soon 3</a></li>
                            <li><a href="error-page.html">404</a></li>
                        </ul>
                    </li>
                    <li><a href="contact-us.html">Contact Us</a></li>
                    <li class="header-search-wrapper">
                        <form action="#" class="header-search-form">
                            <input type="text" class="form-control header-search" placeholder="Search"/>
                            <input type="submit" hidden="hidden"/>
                        </form>
                    </li>
                    <li><a href="#" class="btn-search-toggle"><i class="fa fa-search"></i></a></li>
                    <li><a href="#" class="btn btn-theme btn-submit-event">SUBMIT EVENT <i class="fa fa-plus-circle"></i></a></li>
                    <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
  Launch Register
</button> --}}

                    {{-- SYY-- --}}
                     @guest
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="modal" data-target="#exampleModalCenter2">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                </ul>
            </nav>
            <!-- /Navigation -->

            </div>
        </div>
    </header>
    <!-- /HEADER -->

    <!-- Content area -->
    <div class="content-area">

        <section class="page-section image breadcrumbs overlay">
            <div class="container">
                <h1>EVENT DETAIL PAGE</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Events</a></li>
                    <li class="active">Event Detail Page</li>
                </ul>
            </div>
        </section>


        <!-- PAGE -->
        <section class="page-section with-sidebar sidebar-right first-section">
            <div class="container">

                <!-- Sidebar -->
                <aside id="sidebar" class="sidebar col-sm-4 col-md-3">

                    <div class="widget google-map-widget">
                        <!-- Google map -->
                        <div class="google-map">
                            <div id="map-canvas"></div>
                        </div>
                        <!-- /Google map -->
                        <a href="#" class="link"><i class="fa fa-map-marker"></i> ISTANBUL,TURKEY</a>
                    </div>

                    <div class="widget">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <!--div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Category
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div-->
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Category
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Event Type
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Date
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Price
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </aside>
                <!-- /Sidebar -->

                <hr class="page-divider transparent visible-xs"/>

                <!-- Content -->
                <section id="content" class="content col-sm-8 col-md-9">

                    <div class="listing-meta">

                        <div class="filters">
                            <a href="#">Business <i class="fa fa-times"></i></a>
                            <a href="#">Networking <i class="fa fa-times"></i></a>
                            <a href="#">Free <i class="fa fa-times"></i></a>
                        </div>

                        <div class="options">
                            <a class="byrevelance" href="#">Revelance</a>
                            <a class="bydate active" href="#">DATE</a>
                            <a class="view-list" href="#"><i class="fa fa-th-list"></i></a>
                            <a class="view-th active" href="#"><i class="fa fa-th"></i></a>
                        </div>

                    </div>

                    <div class="row thumbnails events">

                        <div class="col-md-4 col-sm-6 isotope-item festival">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item conference">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item miscellaneous">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item festival playground">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item festival conference">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item conference playground">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item festival conference">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 isotope-item playground">
                            <div class="thumbnail no-border no-padding">
                                <div class="media">
                                    <a href="#" class="like"><i class="fa fa-heart-o"></i></a>
                                    <div class="date">
                                        <span>25</span>
                                        <span>Jan</span>
                                    </div>
                                    <img src="assets/img/preview/hotel-1.jpg" alt="">
                                    <div class="caption hovered"></div>
                                </div>
                                <div class="caption">
                                    <h3 class="caption-title"><a href="#">Standart Event Name Here</a></h3>
                                    <p class="caption-category"><i class="fa fa-file-text-o"></i> 15 October <i class="fa fa-map-marker"></i> Manhattan / New York</p>
                                    <p class="caption-price">Tickets from $49,99</p>
                                    <p class="caption-text">Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi. </p>
                                    <p class="caption-more"><a href="#" class="btn btn-theme">Tickets &amp; details</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <li class="disabled"><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
                        </ul>
                    </div>
                    <!-- /Pagination -->

                </section>
                <!-- /Content -->

            </div>
        </section>
        <!-- /PAGE -->

    </div>
    <!-- /Content area -->

    {{-- SYY-2019 --}}
    <!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>      
    </div>
      
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>      
                </div>
            </div>
        </div>
    </div>      
    </div>
      
    </div>
  </div>
</div>
    

            {{-- @yield('content')
            @yield('content2') --}}
    {{-- SYY-2019 --}}
    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">

                    <div class="col-md-3">
                        <div class="widget widget-about">
                            <h4 class="widget-title">About Us</h4>
                            <p>Fusce pellentesque velvitae tincidunt egestas. Pellentesque habitant morbi.Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.</p>
                            <address>
                                <div><i class="fa fa-phone"></i>+90 555 55 55</div>
                                <div><i class="fa fa-envelope"></i> <a href="mailto:info@example.com">info@example.com</a></div>
                            </address>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget widget-categories">
                            <h4 class="widget-title">Popular searches</h4>
                            <ul>
                            <li><a href="#">Online Registration</a></li>
                            <li><a href="#">Sell Event Tickets</a></li>
                            <li><a href="#">Post Events</a></li>
                            <li><a href="#">Event Planning Software</a></li>
                            <li><a href="#">Online Event Management</a></li>
                            <li><a href="#">Event Management Software</a></li>
                            <li><a href="#">Event Payment</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget widget-twitter">
                            <h4 class="widget-title">Recent Tweets</h4>
                            <ul>
                                <li>
                                    <a href="#">@isamercan</a> Cupcake chocolate cake sweet roll. Gummies macaroon biscuit cupcake candy dragée. <a href="#">#Conference about 2 hours ago</a>
                                </li>
                                <li>
                                    <a href="#">@isamercan</a> Cupcake chocolate cake sweet roll. Gummies macaroon biscuit cupcake candy dragée. <a href="#">#Conference about 2 hours ago</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget widget-flickr-feed">
                            <h4 class="widget-title"><span>Instagram Photos</span></h4>
                            <ul>
                                <li><a href="#"><img src="assets/img/preview/sidebar-1.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/preview/sidebar-2.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/preview/sidebar-3.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/preview/sidebar-4.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/preview/sidebar-5.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/preview/sidebar-6.jpg" alt=""></a></li>
                                <!--li><a href="#"><img src="assets/img/preview/sidebar-7.jpg" alt=""></a></li>
                                <li><a href="#"><img src="assets/img/preview/sidebar-8.jpg" alt=""></a></li-->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-meta footer-meta-alt">
            <div class="container">

                <div class="row">
                    <div class="col-md-9 col-sm-6">
                        <ul class="footer-menu">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Press</a></li>
                            <li><a href="#">Developers</a></li>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Cookies</a></li>
                            <li>All Rights Reserved</li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <form action="#" class="country-select">
                            <div class="form-group">
                                <select class="selectpicker" data-width="100%">
                                    <option>Select Your Country</option>
                                    <option>Select Your Country</option>
                                    <option>Select Your Country</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

    <div class="to-top"><i class="fa fa-angle-up"></i></div>

</div>
<!-- /Wrap all content -->

<!-- JS Global -->

<!--[if lt IE 9]><script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script><![endif]-->
<!--[if gte IE 9]><!--><script src="assets/plugins/jquery/jquery-2.1.1.min.js"></script><!--<![endif]-->
<script src="assets/plugins/modernizr.custom.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/plugins/superfish/js/superfish.js"></script>
<script src="assets/plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
<script src="assets/plugins/placeholdem.min.js"></script>
<script src="assets/plugins/jquery.smoothscroll.min.js"></script>
<script src="assets/plugins/jquery.easing.min.js"></script>
<script src="assets/plugins/smooth-scrollbar.min.js"></script>

<!-- JS Page Level -->
<script src="assets/plugins/owlcarousel2/owl.carousel.min.js"></script>
<script src="assets/plugins/waypoints/waypoints.min.js"></script>
<script src="assets/plugins/countdown/jquery.plugin.min.js"></script>
<script src="assets/plugins/countdown/jquery.countdown.min.js"></script>
<script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

<script src="assets/js/theme-ajax-mail.js"></script>
<script src="assets/js/theme.js"></script>
<script src="assets/js/custom.js"></script>

<script type="text/javascript">
    "use strict";
    jQuery(document).ready(function () {
        theme.init();
        theme.initMainSlider();
        theme.initCountDown();
        theme.initPartnerSlider2();
        theme.initImageCarousel();
        theme.initTestimonials();
        theme.initGoogleMap();
    });
    jQuery(window).load(function () {
        theme.initAnimation();
    });

    jQuery(window).load(function () { jQuery('body').scrollspy({offset: 100, target: '.navigation'}); });
    jQuery(window).load(function () { jQuery('body').scrollspy('refresh'); });
    jQuery(window).resize(function () { jQuery('body').scrollspy('refresh'); });

    jQuery(document).ready(function () { theme.onResize(); });
    jQuery(window).load(function(){ theme.onResize(); });
    jQuery(window).resize(function(){ theme.onResize(); });

    jQuery(window).load(function() {
        if (location.hash != '') {
            var hash = '#' + window.location.hash.substr(1);
            if (hash.length) {
                jQuery('html,body').delay(0).animate({
                    scrollTop: jQuery(hash).offset().top - 44 + 'px'
                }, {
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
            }
        }
    });

</script>

</body>

<!-- Mirrored from eazzy.me/html/imevent-multipage/event-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2015 01:32:10 GMT -->
</html>
{{-- 
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
 --}}