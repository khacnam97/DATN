<!DOCTYPE html>
<html lang="en"><!--<![endif]-->


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

    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!--Custom styles-->
    <link rel="stylesheet" href="css/fontawesome.css">
    
    
</head>
<body id="home" class="wide body-light coming-soon">

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
                 <a href="{{route('index')}}" class="scroll-to">
                    <span class="fa-stack">
                        <i class="fa logo-hex fa-stack-2x"></i>
                        <i class="fa logo-fa fa-map-marker fa-stack-1x"></i>
                    </span>
                    im Event
                </a>
            </div>
            <!-- /Logo -->

            </div>
        </div>
    </header>
    <!-- /HEADER -->

    <!-- Content area -->
    <div class="content-area">

        <div id="main">
        <!-- SLIDER -->
        <section class="page-section no-padding background-img-slider">
            <div class="container">

            <div id="main-slider" class="owl-carousel owl-theme">

                <!-- Slide -->
                <div class="item page slide2 slide3">
                    <div class="caption">
                        <div class="container">
                            <div class="div-table">
                                <div class="div-cell">

                                    <div class="form-background">
                                        <div class="form-header color">
                                            <h1 class="section-title">
                                                <span class="icon-inner"><span class="fa-stack"><i class="fa rhex fa-stack-2x"></i><i class="fa fa-ticket fa-stack-1x"></i></span></span>
                                                <span class="title-inner"> Login</span>
                                            </h1>
                                        </div>
                                        @if(count($errors)>0)
                                        <div class="alert alert-danger">
                                          @foreach($errors->all() as $err)
                                          {{$err}} <br>
                                          @endforeach
                                      </div>
                                      @endif
                                        <form   action="{{ route('auth.login') }}" method="post">
                                             <input type="hidden" name="_token" value="{{ csrf_token()}}">
                                            <div class="row">
                                                <!-- <div class="col-sm-12 form-alert"></div> -->
                                                
                                                <div class="col-sm-12">
                                                     <div class="form-group">
                                                        <input type="email" id="inputEmail" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email " required >
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  placeholder=" Password">

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                         <button class="btn btn-theme btn-block "  type="submit">Login</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>


                                    <!-- Event description -->
                                    <!-- /Event description -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            </div>

        </section>
        <!-- /SLIDER -->
        </div>

    </div>
    <!-- /Content area -->

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

<script src="assets/js/theme-ajax-mail.js"></script>
<script src="assets/js/theme.js"></script>
<script src="assets/js/custom.js"></script>

<!-- <script type="text/javascript">
    "use strict";
    jQuery(document).ready(function () {
        theme.init();
    });

    jQuery(document).ready(function () { theme.onResize(); });
    jQuery(window).load(function(){ theme.onResize(); });
    jQuery(window).resize(function(){ theme.onResize(); });

</script> -->

</body>

<!-- Mirrored from eazzy.me/html/imevent-multipage/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Sep 2015 01:30:47 GMT -->
</html>
