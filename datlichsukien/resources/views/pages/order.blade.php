@extends('layouts.app')
@section('header')

@endsection
@section('content')

<div class="container"  id="show_profile" style="margin-top: 100px; margin-bottom: 50px;display:flex; justify-content: center;">
	<div style="width: 800px; height: 500px; border-style: ridge;background-color: #dee2e6;">
		
		<div class="row" style="justify-content: center;">
			<div class="col-9">
				<form class="form" role="form" action="{{route('order.add',$restaurant->id)}}" method="post" autocomplete="off" style="margin-bottom: 30px;">
					<div >
						<h1 style="text-align: center;"></h1>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Ngày tổ chức </label>
						
						<div class='col-sm-6' id='datetimepicker1'>
		                    <input id="datepicker" name="date" value=""  required autocomplete="">
                		</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Thời gian tổ chức</label>
						<div class="col-sm-6">
							<select class="custom-select" name="" id="">
						        @if($order_time)
								@foreach ($order_time as  $record)
								<option value="{{$record->id}}">{{$record->time}}</option>
								@endforeach
								@endif
						       
					      </select>
						</div>
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
							<input class="form-control" type="text" name="people_number" value="" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Mức giá mỗi bàn</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" value="" name="price_table" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Địa chỉ</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" required="" >
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3 col-form-label form-control-label">Số điện thoại</label>
						<div class="col-sm-6">
							<input class="form-control" name="phone" type="text" value="{{Auth::user()->phone}}" required="">
						</div>
					</div>
					<div class="form-group row" style="margin-bottom: 30px;">
						<div class="col" style="margin-left: 150px;">
							<button class="btn btn-info" type="submit" >Đặt lịch</button>
							<a href="" title=""  id="edit"class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
        $('#datepicker').datepicker({
            format: 'mm-dd-yyyy  ',
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection