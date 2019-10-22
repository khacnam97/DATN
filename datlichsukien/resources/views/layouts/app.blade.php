<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>im Event</title>

    <!-- Favicons -->
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap&subset=vietnamese" rel="stylesheet">
      <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="shortcut icon" type="image/png" href="/picture/front/favicon.png">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap&subset=latin-ext,vietnamese" rel="stylesheet">

  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


  <link rel="stylesheet" href=" {{ asset('fonts/fontawesome/css/font-awesome.min.css') }}">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>

  <!-- Rating -->
  <link href="{{ asset('css/bootstrap-rating.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ asset('js/bootstrap-rating.js') }}"></script>
  @stack('css')

  {{-- multi up image --}}
  <script src="{{asset('js/dropzone.js')}}"></script>
  <script src="{{asset('js/index.js')}}"></script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script type="text/javascript" src="{{asset('ckeditor/adapters/jquery.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body id="home" class="wide body-light multipage multipage-sub">

<!-- Wrap all content -->
<div class="wrapper">
      <!-- Modal login -->
    <nav class="navbar navbar-expand-md navbar-light bg-inverse shadow-sm  fixed-top" style="font-family: 'Roboto', sans-serif; background-size: cover;   background-color: rgba(0,0,0,0.6);height: 60px; width: 100%; padding: 0px; box-sizing: border-box;"  id="nav-top">

      <div class="container-fluid" style="color: white; margin: 0px; padding: 0; width: 100%">
        <a href=" "><img src="/picture/front/logo5.png" style="" id="logo5" alt="avatar"></a>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li><a class="nav-link  border-0" style="cursor:pointer; " id="scr2"> About Us </a></li>
            <li><a class="nav-link  border-0" style=" cursor:pointer;" id="scr3"> Địa điểm </a></li>
            <li><a class="nav-link  border-0" style=" cursor:pointer;" id="scr1"> Liên hệ </a></li>

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav ml-auto " style="display: flex; justify-content:flex-end; margin-left: 2000px">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#myModal" href="{{ route('login') }}" style="color: white; ">{{ __('Đăng nhập') }}</a>

            </li>

            @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" data-target="#myModal2" href="{{ route('register') }}" style="color: white; ">{{ __('Đăng kí') }} </a>
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
    <!-- HEADER -->
   
    <!-- /HEADER -->
  
    <!-- Content area -->
    <div class="content-area">

     @yield('content')

    </div>
    <!-- /Content area -->
    
    <!-- MOdal login -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Sign in</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            
            @include('auth.login')
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
          </div>

        </div>
      </div>
    </div>
    <!-- Modal register -->
   <div class="modal" id="myModal2">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title ">Sign up</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
           
            @include('auth.register')
          </div>
         

          <!-- Modal footer -->
          <div class="modal-footer">
          </div>

        </div>
      </div>
    </div>



{{-- @yield('content')
@yield('content2') --}}

    <!-- FOOTER -->
    @include('includes.footer')
    <!-- /FOOTER -->

    <div class="to-top"><i class="fa fa-angle-up"></i></div>

</div>


</body>

</html>
