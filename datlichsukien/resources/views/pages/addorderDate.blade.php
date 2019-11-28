@extends('layouts.app')
@section('header')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<div class="container"  id="show_profile" style="margin-top: 100px; margin-bottom: 50px;display:flex; justify-content: center;">
	<div style="width: 800px; height: 600px; ">
		
		<div class="row" style="justify-content: center;">
			<div class="col-9">
			@if(count($errors)>0)
			        <div class="alert alert-danger">
			          @foreach($errors->all() as $err)
			          {{$err}} <br>
			          @endforeach
			      </div>
			     @endif 
			  @if(Session::has('success'))
			  <div class="alert alert-success">
			    {{Session::get('success')}}
			  </div>
			  @endif
                 <h3 style="text-align: center;">{{$restaurantdate}}</h3>
				<form action="{{route('order.add')}}" method="post">
					 {{csrf_field()}}
					<div class="form-group row">
						
                        <label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Ngày tổ chức</label>
						<div class="col-sm-8" >
							<input class="form-control" type="text" name="order_date" id="test" value="{{$orderdate}}" readonly>
						</div>    
					</div>
					<div class="form-group row">
						
                       <label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Thời gian tổ chức</label>
						<div class="col-sm-8" >
							<input type="text" class="form-control" name="time" required="" id="timepicker" >
						</div>

					</div>
					<div class="form-group row">
						
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Quy mô</label>
						<span style="margin-left: 20px;">
							<input type="radio" name="gender" value="male"> Lớn
							<input type="radio" name="gender" value="female"> Vừa
							<input type="radio" name="gender" value="other"> Nhỏ
						</span>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Số lượng người</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="people_number" value="" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Mức giá mỗi bàn</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" value="" name="price_table" required="">
						</div>
					</div>
					@if(Auth::check()) 
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Địa chỉ</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" required="" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Số điện thoại</label>
						<div class="col-sm-8">
							<input class="form-control" name="phone" type="text" value="{{Auth::user()->phone}}" required="">
						</div>
					</div>
					@else
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Địa chỉ</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="address" value="" required="" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #6cb2eb; color: #212529;">Số điện thoại</label>
						<div class="col-sm-8">
							<input class="form-control" name="phone" type="text" value="" required="">
						</div>
					</div>
					@endif
                     <input class="form-control" name="restaurant_id" type="hidden" value="{{$restaurant_id}}" required="" >
					<div class="form-group row" style="margin-bottom: 30px;">
						<div class="col" style="display: flex;justify-content: center;" >
							<button class="btn btn-info" type="submit" >Đặt lịch</button>
						</div>
					</div>   
				</form>      
			</div>

		</div>
	</div>
</div>
<script>
        $('#timepicker').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>

