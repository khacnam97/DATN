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
  <script src="{{asset('js/index.js')}}"></script>
  

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  

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
            <li><a class="nav-link  border-0" style="cursor:pointer;  " id="scr2" href="{{route('index')}}" > Trang chủ </a></li>
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
            <li class="nav-item dropdown" style="">
              <a id="" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;font-size: 13px;" v-pre>
                <i class="fa fa-bell fa-2x" style="margin-top: 0%;"></i>
                <span class="badge badge-light">{{Auth::user()->unreadNotifications->count()}}</span>
              </a>
              @if(Auth::user()->Notifications->count()>0)
              <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdown">
                @foreach(Auth::user()->unreadNotifications as $notification)
                <a href="{{$notification->data['link']}}" id="notify" class="dropdown-item"> {{$notification->data['message']}}</a>
                @endforeach
                @foreach(Auth::user()->Notifications as $notification)
                @if($notification->read_at !=NULL)
                <a href="{{$notification->data['link']}}" id="notify" class="dropdown-item" style="background-color:lightgrey"> {{$notification->data['message']}}</a>
                @endif
                @endforeach
                 <a href="" class="dropdown-item" style="color:black; text-decoration:underline; background-color: #e0e0e0">Xem thêm</a>
              </div>
              @endif
            </li>
            <li class="nav-item dropdown" >
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
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #e9ecef">

                <a class="dropdown-item" href="{{route('profile')}}">Trang cá nhân
                  <span class="badge badge-danger" style="">
                    @if (empty(Auth::user()->name)|| empty(Auth::user()->avatar) || empty(Auth::user()->email))
                    1+
                    @endif
                  </span>
                </a>
                
                <a class="dropdown-item" href="{{route('show_changePass')}}">Đổi mật khẩu</a>
                <a class="dropdown-item" href="{{route('myorder')}}">Lịch đặt của tôi</a>
                @if (Auth::user()->role == 1)
                <a class="dropdown-item" href="{{route('manage.order')}}">Quản lí đặt lịch</a>
                <a class="dropdown-item" href="{{route('mypost')}}">Bài đăng của tôi</a>
                <a class="dropdown-item" href="{{route('admin.index')}}"><span style="font-weight: bold;">Trang quản lí</span></a>


                @elseif (Auth::user()->role == 2)
                <a class="dropdown-item" href="{{route('manage.order')}}">Quản lí đặt lịch</a>
                <a class="dropdown-item" href="{{route('mypost')}}">Bài đăng của tôi</a>
                @else
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#upgradeModal">Cập nhật tài khoản</a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" style="background-color: #e0e0e0" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Đăng xuất') }}
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
    <!-- MOdal upgrade -->
    <div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Xác nhận trở thành người quản lí địa điểm?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <form id="upgrade-form" action="{{route('upgrade')}}" method="post">
              @csrf
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary" id="accept">Accept</button>
            </form>

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
