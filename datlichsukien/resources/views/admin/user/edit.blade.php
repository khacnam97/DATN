@extends('layouts.admin')
@section('content')
<h1>CHỉnh sửa người dùng</h1>
 @if (session('thongbao'))
  {{session('thongbao')}}

 @endif

 @if(count($errors)>0)
 <div class="alert alert-danger">
  @foreach($errors->all() as $err)
  {{$err}} <br>
  @endforeach
</div>
@endif

@if(Session::has('message'))
<div class="alert alert-success">
  {{Session::get('message')}}
</div>
@endif

<form action="{{route('admin.user.edit1', $user->id)}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="row">
    <div class="form-group col-md-4">
    <label for="name">Tên người dùng</label>
    <input type="text" name="name" value="{{ $user->name }}" class="form-control" required autocomplete="name">
  </div>
  <div class="form-group col-md-4">
    <label for="inputEmail4">Email</label>
    <input id="email" type="email" name="email" value="{{ $user->email }}" class="form-control" disabled="">
  </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-4">
      <input type="checkbox" name="changePassword" id=changePasword >
      <label for="">Mật khẩu</label>
      <input  type="password" name="password" value="" class="form-control password" disabled="" placeholder="Password" required>
    </div>
    <div class="form-group col-md-4">
      <label for="">Nhập lại mật khẩu</label>
      <input  type="password" name="passwordAgain" value="" class="form-control password" disabled="" placeholder="Confirm Password" required>
    </div>
  </div>
  <div class="row">
  <div class="form-group col-md-4">
    <label for="">Số điện thoại</label>
    <input type="phone" name="phone" value="{{ $user->phone }}" class="form-control" required autocomplete="phone">
  </div>
  <div class="form-group col-md-8">
    <label for="">Địa chỉ</label>
    <input type="address" name="address" value="{{ $user->address }}" class="form-control" required autocomplete="address">
  </div>
  </div>
  <div class="row">
  <div class="form-group col-md-4 ">
    <label for="">Ngày sinh:</label>
    <input id="datepicker" name="birthday" value="{{ $user->birthday }}" required autocomplete="birthday">
  </div>
  </div>
  @if($user->role !=1 )
  <div class="form-group ">
    <label for="">Trạng thái:</label>
    <label class="radio-inline">
      <input  name="status" value="0" @if($user->status == 0)
      {{"checked"}}
      @endif
      type="radio">Chặn
      <input type="radio" name="status" value="1" @if($user->status == 1)
      {{"checked"}}
      @endif>Bỏ chặn
    </label>
  </div>
  @endif
  <h5>Ảnh đại diện</h5>
  <div class="form-group">
      <img src="{{  $user->avatar }}" alt="{{ $user->avatar }}" id="output" style="width: 100px; height: 100px; background-repeat: no-repeat;" />
  </div>
   <div class="form-group">
    <label for="">Chọn một ảnh mới</label>
    <input  type="file" name="avatar" value="{{$user->avatar}}" accept="image/x-png,image/jpeg"   autocomplete="file" onchange="loadFile(event)">
  </div>
  <script>
  
</script>
  @if($user->role !=1 )
  <div class="form-group">
    <label for="">Vai trò:</label>
    <label class="radio-inline">
      <input  name="role" value="1" @if($user->role == 1)
      {{"checked"}}
      @endif
      type="radio">Admin
      <input type="radio" name="role" value="2" @if($user->role == 2)
      {{"checked"}}
      @endif>Người đăng bài
      <input type="radio" name="role" value="3" @if($user->role == 3)
      {{"checked"}}
      @endif>Người xem
    </label>
  </div>
  @endif
  <button type="submit" class="btn btn-primary">
    <i class="fa fa-btn fa-sign-in"></i>Cập nhật
  </button>
  
    <a href="/admin/user" class="btn btn-danger" style="color: white">Hủy</a>
  
</form>
 <script>
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            uiLibrary: 'bootstrap4'
        });
    </script>
<script>
  $(document).ready(function(){
   $("#changePasword").change(function(){
    if($(this).is(":checked"))
    {
      $(".password").removeAttr('disabled');
    }
    else{
      $(".password").attr('disabled','');
    }
  });
 });
</script>
@endsection



