@extends('layouts.app')
@section('header')

@endsection
@section('content')

<div class="container"  id="show_profile" style="margin-top: 100px; margin-bottom: 50px;display:flex;justify-content: center;">
	<div style="width: 800px; height: 500px; border-style: ridge;">
		
		<div class="row" style="justify-content: center;">
			<div class="col-9">
				<form class="form" role="form" autocomplete="off" style="margin-bottom: 30px;">
					<div >
						<h1 style="text-align: center;">Tên địa điểm tổ chức </h1>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Mức độ</label>
						<span>
							  <input type="radio" name="gender" value="male"> Lớn
							  <input type="radio" name="gender" value="female"> Vừa
							  <input type="radio" name="gender" value="other"> Nhỏ

						</span>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Số lượng người</label>
						<div class="col-sm-6">
							<select class="custom-select" name="" id="">
						        <option value="">>100 người</option> 
						        <option value=""><100 người</option>
						       
					      </select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Mức giá mỗi bàn</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" value="{{Auth::user()->birthday}}" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Addess</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" value="{{Auth::user()->address}}"  >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Phone</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" value="{{Auth::user()->phone}}" >
						</div>
					</div>
					<div class="form-group row" style="margin-bottom: 30px;">
						<div class="col" style="margin-left: 150px;">
							<button class="btn btn-info" >Đặt lịch</button>
							<a href="" title=""  id="edit"class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection