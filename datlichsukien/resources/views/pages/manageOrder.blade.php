@extends('layouts.app')
@section('content')
<script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>
<div class="card mb-3">
	
	@if($order->count() == 0)
		<h1 style=" text-align: center; margin-top:100px;margin-bottom: 300px; font-size: 35px;">Bạn chưa có lịch đặt nào!!</h1>
	

	@else
	<h1 style="margin-top:100px;margin-bottom: 50px; text-align: center;">Danh sách lịch đặt</h1>
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
	<div class="card-body">
		
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" >
				<thead>
					<tr>
						<th >ID</th>
						<th >Tên người đặt</th>
						<th>Số điện thoại người đặt</th>
						<th>Thời gian tổ chức</th>
						<th>Ngày tổ chức</th>
						<th>Số lương người</th>
						<th>Giá mỗi bàn </th>
						<th>More</th>
					</tr>
				</thead>

				<tbody>
	@endif 
			    @foreach ($order as $key=> $o)
					<tr >
						<td >{{$o->id}}</td>
						<td>{{$o->user->name}}</td>
						<td>{{$o->phone}}</td>
						<td>{{$o->order_time}}</td>
						<td>{{$o->order_date}}</td>
						<td>{{$o->people_number}}</td>
						<td>{{$o->price_table}}</td>
						<td>

						@if($o->status ==1)
		                      <button class="btn-danger" >
		                       
		                      <a   role="button"  style="color: white;text-decoration: none;" >Đã xác nhận</a>
		                    </button>
		                    @else 
		                    <button type="button" class="btn-info" data-toggle="modal" data-target="#detailModal2" data-date="{{$o->order_date}}"   data-address="{{$o->address}}" data-time="{{$o->order_time}}" data-id="{{$o->id}}" data-peonumber="{{$o->people_number}}" data-price="{{$o->price_table}}" data-email="{{$o->user->email}}"> 
								Xác nhận
							</button>
                        @endif
							<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal">
								<a href="" style="color: white;text-decoration: none;">Detail</a>
							</button>
 
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="detailModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
         <h5>Chi tiết lịch đặt</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <h5 style="text-align: center;"></h5>
      	
      	
      	<form id="accecptform" action="{{route('myorder.accept')}}" method="POST">
		{{ csrf_field() }}
      	<input type="hidden" name="id" class="form-control" id="id" readonly>
      	<input type="text" name="email" class="form-control" id="email" readonly >
      	<label for="address" class="col-form-label"> Địa chỉ địa điểm tổ chức </label>
      	<input type="text" name="address" class="form-control" id="address" readonly >
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
      	
      	<button id="buttonsave" type="button" class="btn btn-success" onclick="return confirm('Xác nhận?')" >Xác nhận</button>
      	<button id="buttoncancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	
      </div>
    </div>
  </div>
</div>
<script>
	$('#detailModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		
		var email = button.data('email')
		var time = button.data('time')
		var id = button.data('id')
		var peonumber = button.data('peonumber')
		var price = button.data('price')
		var date = button.data('date')
		var address = button.data('address')

		var modal = $(this)
		modal.find('#idedit').val(id);
		modal.find('#email').val(email);
		
		modal.find('#time').val(time)
		modal.find('#id').val(id)
		modal.find('#peonumber').val(peonumber)
		modal.find('#price').val(price)
		modal.find('#date').val(date)
		modal.find('#address').val(address)
	})
</script>
<script type="text/javascript">
	let textinput2 = document.querySelector('#time');
	let textinput3 = document.querySelector('#peonumber');
	let textinput4 = document.querySelector('#price');
	let textinput5 = document.querySelector('#address');
	let textinput6 = document.querySelector('#email');
    
	let savebutton = document.querySelector('#buttonsave');
	
    savebutton.addEventListener('click', submitform);

	let accecptform = document.querySelector('#accecptform');
	
	savebutton.addEventListener('click', submitform);

	

	function submitform() {
		accecptform.submit();
	}
</script>
@endsection