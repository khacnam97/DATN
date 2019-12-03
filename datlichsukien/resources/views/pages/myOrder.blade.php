@extends('layouts.app')
@section('content')
<script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script src="{{asset('js/bootstrap.min.js')}}"></script>
	
	@if($order->count() == 0)
		<h1 style="margin-top:200px;margin-bottom: 200px;text-align: center; font-size: 35px;">Bạn chưa có lịch đặt nào </h1>
	@else
	<h1 style="margin-top:100px;margin-bottom: 50px; text-align: center;">Lịch đặt của tôi</h1>
	@if(Session::has('message'))
	<div class="alert alert-success">
		{{Session::get('message')}}
	</div>
	@endif
    @if(Session::has('success'))
	<div class="alert alert-success">
		{{Session::get('success')}}
	</div>
	@endif

	@foreach ($order as $key=> $record)
		<div class="row" style="margin-bottom: 80px;background-color: #ffffff;height:200px;justify-content: center;align-items: center; margin-left: 100px;margin-right: 100px;-webkit-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);-moz-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);
            box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);">
			<div class="col-sm-6">
                <img class="card-img-top" src="/{{$record->photo_path}}" alt="{{$record->title}}" style="height: 200px; ">
			</div>
		<div class="col-sm-6">
			<div class="text">
				<h5>{{$record->name}}</h5>
				
				<div> <p><i class="fas fa-map-marker-alt " style="color: blue;"></i> {{$record->addressrestaurant}}</p></div>
				<p><i class="fa fa-calendar"></i> Thời gian {{$record->order_time}} Ngày {{$record->order_date}}</p>
				<button type="button" class="btn-info" data-toggle="modal" data-target="#detailModal" data-date="{{$record->order_date}}" data-namerestaurant="{{$record->restaurant->name}}" data-phone="{{$record->restaurant->phone}}" data-address="{{$record->addressrestaurant}}" data-time="{{$record->order_time}}" data-id="{{$record->id}}" data-peonumber="{{$record->people_number}}" data-price="{{$record->price_table}}" data-room="{{$record->room}}" data-service="{{$record->service}}" data-detailpeonumber="{{$record->detailpeonumber}}"> 
					Chi tiết
				</button>
				@if($record->status ==1)
				<button class="btn-danger" >

					<a href=""  role="button"  style="color: white;text-decoration: none;" >Đã chấp nhận</a>
				</button>
				@elseif($record->status ==0) 
				<button class="btn-success">

					<a data-toggle="modal" data-target="#myModal3" href=""  style="color: white;text-decoration: none;" >Đang chờ phê duyệt </a>
				</button>
				@else
				<button class="btn-success">

					<a data-toggle="modal" data-target="#myModal3" href=""  style="color: white;text-decoration: none;" >Đã từ bị chối </a>
				</button> 
				@endif
				@if($record->status !==1)
				<button type="button" class="btn-danger" >
					<a href="{{route('myorder.delete', $record->id)}}" style="color: white;text-decoration: none;" onclick="return confirm ('Bạn có muốn xóa ??')">Xóa</a>
				</button>
				@endif
				</div>
				
			</div>
		</div>
	@endforeach
	<div style="display: flex; justify-content: center;">{{$order->links()}}</div>
    @endif

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
         <h5>Chi tiết lịch đặt</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <h5 style="text-align: center;"></h5>
      	<input name="id" type="hidden" id="idedit">
      	<label for="category-name" class="col-form-label"> Tên nhà hàng </label>
      	<input type="text" name="name" class="form-control" id="restaurant-name" readonly>
      	<form id="detailform" action="{{route('myorder.edit')}}" method="POST">
		{{ csrf_field() }}
      	<input type="hidden" name="id" class="form-control" id="id" readonly>
      	<label for="address" class="col-form-label"> Địa chỉ địa điểm tổ chức </label>
      	<input type="text" name="address" class="form-control" id="address" readonly>
      	<div class="input-group control-group  form-row" >
			<div class="form-group col-md-4">
			    <label>Tên khu</label>			
				<input type="text"  class="form-control" name="room" id="room" placeholder="Tên khu" disabled="" >
			</div>
			<div class="form-group col-md-4">
			    <label>Dịch vụ</label>				
				<input type="text" class="form-control" name="service" id="service" placeholder="Dịch vụ" disabled="">
			</div>
			<div class="form-group col-md-4">	
			    <label>Sức chứa</label>			
				<input type="text"  class="form-control" name="detailpeonumber" id="detailpeonumber" placeholder="Sức chứa của phòng" disabled="">
			</div>
		</div>
      	<div class="row">
      		<div class="form-group col-md-6">
      			<label for="name" class="col-form-label">Thời gian tổ chức </label>
      			<input type="text" name="order_time" class="form-control" id="time" readonly>
      		</div>
      		<div class="form-group col-md-6">
      			<label for="name" class="col-form-label"> Ngày tổ chức  </label>
      			<input type="text" name="order_date" class="form-control" id="date" readonly> 
      		</div>
      		
      	</div> 
      	<div class="row">
      		<div class="form-group col-md-4">
      			<label for="name" class="col-form-label"> Số điện thoại </label>
      			<input type="text" name="phone" class="form-control" id="phone" readonly>
      		</div>
      		<div class="form-group col-md-4">
      			<label for="name" class="col-form-label"> Số lượng người  </label>
      			<input type="text" name="people_number" class="form-control" id="peonumber" readonly> 
      		</div>
      		<div class="form-group col-md-4">
      			<label for="name" class="col-form-label"> Mức giá mỗi bàn  </label>
      			<input type="text" name="price_table" class="form-control" id="price" readonly> 
      		</div>
      		
      	</div> 
      	</form>
      </div>
      <div class="modal-footer">
      	<button id="buttonedit" type="button" class="btn btn-primary">Edit</button>
      	<button id="buttonsave" type="button" class="btn btn-success" onclick="return confirm('Save?')" disabled>Save</button>
      	<button id="buttoncancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	
      </div>
    </div>
  </div>
</div>

<script>
	$('#detailModal').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var namerestaurant = button.data('namerestaurant')
		var phone = button.data('phone')
		var time = button.data('time')
		var id = button.data('id')
		var peonumber = button.data('peonumber')
		var price = button.data('price')
		var date = button.data('date')
		var address = button.data('address')
		var room = button.data('room')
		var service = button.data('service')
		var detailpeonumber= button.data('detailpeonumber')

		var modal = $(this)
		modal.find('#idedit').val(id);
		modal.find('#restaurant-name').val(namerestaurant)
		modal.find('#phone').val(phone)
		modal.find('#time').val(time)
		modal.find('#id').val(id)
		modal.find('#peonumber').val(peonumber)
		modal.find('#price').val(price)
		modal.find('#date').val(date)
		modal.find('#address').val(address)
		modal.find('#room').val(room)
		modal.find('#service').val(service)
		modal.find('#detailpeonumber').val(detailpeonumber)
	})
</script>
<script>
	let editbutton = document.querySelector('#buttonedit');
	let savebutton = document.querySelector('#buttonsave');
	let cancelbutton = document.querySelector('#buttoncancel');
	let textinput1 = document.querySelector('#phone');
	let textinput2 = document.querySelector('#time');
	let textinput3 = document.querySelector('#peonumber');
	let textinput4 = document.querySelector('#price');
	let textinput5 = document.querySelector('#address');
	

	let detailform = document.querySelector('#detailform');
	editbutton.addEventListener('click', enableButton);
	cancelbutton.addEventListener('click', disableButton);
	savebutton.addEventListener('click', submitform);

	function enableButton() {
		editbutton.disabled = true;
		savebutton.disabled = false;
		textinput1.readOnly = false;
		textinput1.autofocus = true;
		textinput2.readOnly = false;
		textinput2.autofocus = true;
		textinput3.readOnly = false;
		textinput3.autofocus = true;
		textinput4.readOnly = false;
		textinput4.autofocus = true;
		textinput5.readOnly = false;
		textinput5.autofocus = true;
	}

	function disableButton() {
		editbutton.disabled = false;
		savebutton.disabled = true;
		textinput1.readOnly = true;
		textinput2.readOnly = true;
		textinput3.readOnly = true;
		textinput4.readOnly = true;
		textinput5.readOnly = true;
	}

	function submitform() {
		detailform.submit();
	}
</script>
 <script>
    $('#time').timepicker({
        uiLibrary: 'bootstrap4'
     });
 </script>
@endsection