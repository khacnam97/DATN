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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body id="home" class="wide body-light multipage multipage-sub">

<!-- Wrap all content -->
<div class="wrapper">
      
    <nav class="navbar navbar-expand-md navbar-light bg-inverse shadow-sm  fixed-top" style="font-family: 'Roboto', sans-serif; background-size: cover;   background-color: #6cb2eb;height: 60px; width: 100%; padding: 0px; box-sizing: border-box;"  id="nav-top">

      <div class="container-fluid" style="color: white; margin: 0px; padding: 0; width: 100%">
        <a href="{{route('index')}}"><img src="/picture/front/logo.png" style="" id="logo5" alt="avatar"></a>
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
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;font-size: 13px;" v-pre>

                <img @if(!empty(Auth::user()->avatar)) src="{{Auth::user()->avatar}}" @else src="/picture/images.png" @endif alt="Avatar" style="border-radius: 50%;margin-right: 10px; width: 30px; height: 30px;">
                @if (!empty(Auth::user()->name))
                {{Auth::user()->name}}
                @else
                Noname
                @endif
                @if (empty(Auth::user()->name)|| empty(Auth::user()->avatar) || empty(Auth::user()->email))
                <span class="badge badge-danger">1+</span>
                @endif
                <span class="caret"> </span>

              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="{{route('profile')}}">Trang cá nhân
                  <span class="badge badge-danger" style="">
                    @if (empty(Auth::user()->name)|| empty(Auth::user()->avatar) || empty(Auth::user()->email))
                    1+
                    @endif
                  </span>
                </a>
                <a class="dropdown-item" href="">Quản lí đặt lịch</a>
                <a class="dropdown-item" href="{{route('show_changePass')}}">Đổi mật khẩu</a>
                @if (Auth::user()->role == 1)
                <a class="dropdown-item" href="">Bài đăng của tôi</a>
                <a class="dropdown-item" href="">Phê duyệt bài đăng</a>
                <a class="dropdown-item" href="">Quản lí user</a>
                <a class="dropdown-item" href="{{route('admin.index')}}"><span style="font-weight: bold;">Trang quản lí</span></a>


                @elseif (Auth::user()->role == 2)
                <a class="dropdown-item" href="">Bài đăng của tôi</a>
                @else
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#upgradeModal">Cập nhật tài khoản</a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item"  href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
        </li>
        @endguest

          </ul>
        </div>
      </div>
    </nav>
    <!-- HEADER -->
   
    <!-- /HEADER -->
  
    <!-- Content area -->
    <div class="">

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

   

</div>


</body>

</html>
