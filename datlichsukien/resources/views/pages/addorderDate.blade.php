@extends('layouts.app')
@section('header')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<div class="container"  id="show_profile" style="margin-top: 100px; margin-bottom: 50px;display:flex; justify-content: center;">
	<div style="width: 800px; height: 800px;background-color: #ffffff; -webkit-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);-moz-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);
        box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);">
		
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
						
                        <label class="col-sm-3 col-form-label form-control-label" style="width: 150px;background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Ngày tổ chức</label>
						<div class="col-sm-8" >
							<input class="form-control" type="text" name="order_date" id="test" value="{{$orderdate}}" readonly>
						</div>    
					</div>
					<div class="form-group row">
						
                       <label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Thời gian tổ chức</label>
						<div class="col-sm-8" >
							<input type="text" class="form-control" name="time" required="" id="timepicker" >
						</div>

					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label"  style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);height: 40px;">Chọn loại phòng</label>
						<div class="col">

							<div class="col-sm-10">
								    <div > 
					                  <label style="width: 110px;">Tên khu</label> 
					                  <label style="width: 100px;">Dịch vụ</label>
					                  <label style="width: 90px;">Sức chứa</label></div>
									<div class="dropdown-divider"></div>
									@foreach ($detail as $record)
									<div>
										<input type="radio" name="detail_id" required=""  value="{{$record->id}}">
										<label style="width: 110px;">{{$record->room}}</label> 
										<label style="width: 100px;">{{$record->service}}</label>
										<label style="width: 90px;">{{$record->people_number}}</label>
									</div>
									@endforeach

								</div>

							</div>

						</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Số lượng người</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="people_number" value="" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Mức giá mỗi bàn</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" value="" placeholder="VNĐ" name="price_table" required="">
						</div>
					</div>
					@if(Auth::check()) 
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Địa chỉ</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" required="" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Số điện thoại</label>
						<div class="col-sm-8">
							<input class="form-control" name="phone" type="text" value="{{Auth::user()->phone}}" required="">
						</div>
					</div>
					@else
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Địa chỉ</label>
						<div class="col-sm-8">
							<input class="form-control" type="text" name="address" value="" required="" >
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label" style="width: 150px; background-color: #e0e0e0; -webkit-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);-moz-box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);box-shadow: 7px -3px 5px 0px rgba(0,0,0,0.75);">Số điện thoại</label>
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

