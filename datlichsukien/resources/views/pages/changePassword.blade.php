@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px;" >
  <div class="row justify-content-center" >
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h3>Thay đổi mật khẩu</h3></div>

        <div class="card-body">
          @if (session('error'))
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria_label="Close">
              <span aria_hidden= "true">&times;</span>
            </button>
            {{ session('error') }}
          </div>
          @endif
          @if (session('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria_label="Close">
              <span aria_hidden= "true">&times;</span>
            </button>
            {{ session('success') }}
          </div>
          @endif
          <form class="form-horizontal" method="POST" action="{{ route('update_changePass') }}">
            {{ csrf_field() }}

            <div class="form-group row{{ $errors->has('current_password') ? ' has-error' : '' }}">
              <label for="current_password" class="col-md-4 control-label">Mật khẩu hiện tại</label>

              <div class="col-md-6">
                <input id="current_password" type="password" class="form-control" name="current_password" required="">

                @if ($errors->has('current_password'))
                <span class="help-block">
                  <strong>{{ $errors->first('current_password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row{{ $errors->has('new_password') ? ' has-error' : '' }}">
              <label for="new_password" class="col-md-4 control-label">Mật khẩu mới</label>

              <div class="col-md-6">
                <input id="new_password" type="password" class="form-control" name="new_password" required="">

                @if ($errors->has('new_password'))
                <span class="help-block">
                  <strong>{{ $errors->first('new_password') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password_confirmation" class="col-md-4 control-label">Xác nhận lại mật khẩu</label>

              <div class="col-md-6">
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required="">
              </div>
            </div>

            <div class="form-group" style="display: flex;justify-content: center;">
              <button type="submit" class="btn btn-primary" style="margin-right: 10px; width: 100px;">
                Lưu
              </button>
              <a href="{{ url('/') }}" title="" style="width: 100px;" id="edit_button"class="btn btn-danger">Thoát</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection