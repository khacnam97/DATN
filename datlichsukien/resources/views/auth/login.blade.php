<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" type="text/css" href="/css/custom/login.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap&subset=latin-ext,vietnamese" rel="stylesheet">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="/css/bootstrap-social.css">
<!--Custom styles-->
<link rel="stylesheet" href="/css/fontawesome.min.css">
</head>

@section('content')
<div class="card-body" >

    <form method="POST" action="{{ route('login') }}" id="formlogin"  class="form-signin" style="background-color: #dee2e6;">
        @csrf
        <!-- <a href="" class="btn btn-block btn-social btn-google">
            <i class="fab fa-google"></i>

            Sign in with Google
        </a>
        <a href="" class="btn btn-block btn-social btn-facebook">
            <i class="fab fa-facebook-f"></i>
            Sign in with Facebook
        </a>

        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p> -->
        <div class="">
                <label for="inputEmail" class="" >Email </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
        </div>

        <div class="" style="margin-top: 10px;">
                 <label for="" class="" >Mật khẩu </label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Mật khẩu ">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            
        </div>

       <!--  <div class="form-group row">
            <div class="col-md-6 offset-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div> -->

        <div class="form-group row mb-0" >
            <div class="col-md-8 offset-md-2" style="text-align:center;">
                <button type="submit" class="btn btn-lg btn-primary btn-block" form="formlogin" >
                    {{ __('Đăng nhập') }}
                </button>

                   @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
                @endif 
            </div>
        </div>
        <!-- <div class="form-group row mb-0" style="text-align:center;">
            <div class="col-md-8 offset-md-2">


                @if (Route::has('password.request'))
                <a class="btn btn-link" href="">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div> -->
        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-2">
                
                <button class="btn btn-link" type="button"  id="createacc">

                    {{ __('Chưa có tài khoản?') }}
                </button>
                
            </div>
        </div>
    </form>
</div>
