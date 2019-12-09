<head>
    <title>Đăng kí</title>
    <link rel="stylesheet" type="text/css" href="/css/custom/login.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">

<!--Fontawesome CDN-->
<link rel="stylesheet" href="/css/bootstrap-social.css">
<!--Custom styles-->
<link rel="stylesheet" href="/css/fontawesome.min.css">
</head>

<body class="text-center">
    <div class="body">
    <form class="form-signin" action="{{route('signup')}}" method="post" id="formregister" style="background-color: #dee2e6;">
        <input type="hidden" name="_token" value="{{ csrf_token()}}">
       <!--  <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
 -->
        @if(count($errors)>0)
        @if($errors->all()[0] == "The password must be at least 8 characters.")
        <div class="alert alert-danger">
          @foreach($errors->all() as $err)
          {{$err}} <br>
          @endforeach
        </div>
        @endif
        @endif
        <!-- <a class="btn btn-block btn-social btn-google"  href="" >

        <i class="fab fa-google"></i>

            Sign in with Google
        </a>
        <a class="btn btn-block btn-social btn-facebook">
        <i class="fab fa-facebook-f"></i>
            Sign in with Facebook
        </a>
        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p> -->
        <label for="inputName" class="">Họ và tên</label>
        <input type="text" id="inputName" class="form-control" name="name" value="{{old('name')}}" placeholder="Họ và tên" required autofocus>
        <label for="inputEmail" class="" >Email </label>
        <input type="email" id="inputEmail" class="form-control" name="email" value="{{old('email')}}" placeholder="Email address" required >
        <label for="inputPassword" class="">Mật khẩu</label>
        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
        <div class="form-group ">
            <label for="inputState">Vai trò</label>
            <select id="inputState" class="form-control" name="role" style="height: 50px;">
                <option selected value="3">Người dùng</option>
                <option  value="2">Người quản lí địa điểm</option>
                
                
            </select>
        </div>
        <button class="btn btn-lg btn-primary btn-block" form="formregister" type="submit">Đăng kí</button>
        <hr id="hr1">
        <p>Đã có tài khoản? <button type="button" class="btn-link btn" id="signin">Đâng nhập</button></p>
    </form>
   
    </div>
</body>
