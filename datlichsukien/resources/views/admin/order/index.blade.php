@extends('layouts.admin')
@section('title', '/ order')
@section('content')
<div class="card mb-3">
	<div class="card-header">
		<em class="fas fa-table"></em>
	Data Table order </div>
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
		<div style="margin-bottom: 15px">
			
			<a href="" class="btn btn-success" style="color: white" data-toggle="modal" data-target="#detailModal3"><em class="fas fa-plus"></em> ADD</a>
			
		</div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" >
				<thead>
					<tr>
						<th >ID</th>
						<th >Name order</th>
						<th >Restaurant</th>
						<th>Phone</th>
						<th>Time</th>
						<th>Date</th>
						<th>People number</th>
						<th>Price </th>
						<th>More</th>
					</tr>
				</thead>
				<tbody>
			    @foreach ($order as $key=> $o)
					<tr >
						<td >{{$o->id}}</td>
						<td>{{$o->user->name}}</td>
						<td>{{$o->restaurant->name}}</td>
						<td>{{$o->phone}}</td>
						<td>{{$o->order_time}}</td>
						<td>{{$o->order_date}}</td>
						<td>{{$o->people_number}}</td>
						<td>{{$o->price_table}}</td>
						<td>

						@if($o->status ==1)
		                     <button class="btn-success" >
		                       
		                      <a href="{{route('admin.order.cancel', $o->id)}}" onclick="return confirm('Cancel order?')" role="button"  style="color: white;text-decoration: none;" >Confirmed</a>
		                    </button>
		                    @else 
		                    <button class="btn-danger">
		                     
		                      <a  href="{{route('admin.order.accept', $o->id)}}" onclick="return confirm('accept?')"  style="color: white;text-decoration: none;" >Waiting</a>
		                    </button>
                        @endif
							<button type="button" class="btn-info" >
								<a href="{{route('admin.order.edit', $o->id)}}" style="color: white;text-decoration: none;">Edit</a>
							</button>

							<button type="button" class="btn-danger" >
								<a href="{{route('admin.order.delete', $o->id)}}" style="color: white;text-decoration: none;" onclick="return confirm ('bạn có muốn xóa lịch đặt này')">Delete</a>
							</button>
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>
		</div>
	</div>
	<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
<div class="modal fade" id="detailModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
         <h5>Add Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> <h5 style="text-align: center;"></h5>
      	
      	
      	<form id="accecptform" action="{{route('admin.order.addOrder')}}" method="POST">
		{{ csrf_field() }}
		<div class="form-row">
		  <div class="form-group col-md-6">
			<label for="Name" class="col-form-label">Name </label>
	      	<select class="custom-select" name="user_id" id="user_id">
					
					@if($user)
					@foreach ($user as  $record)
					<option value="{{$record->id}}">{{$record->name}}</option>
					@endforeach
					@endif
					
			</select>
		   </div>
		   <div class="form-group col-md-6">
			<label for="Restaurant" class="col-form-label">Restaurant </label>
	      	<select class="custom-select" name="restaurant_id" id="restaurant_id">
					
					@if($restaurant)
					@foreach ($restaurant as  $record)
					<option value="{{$record->id}}">{{$record->name}}</option>
					@endforeach
					@endif
					
			</select>
		   </div>
		</div>
      	<label for="address" class="col-form-label">Address </label>
      	<input type="text" name="address" class="form-control" id="address" required="" >
      	<div class="row">
      		<div class="form-group col-md-6">
      			<label for="name" class="col-form-label">Time </label>
      			<input type="text" name="order_time" class="form-control" id="time" required="">
      		</div>
      		<div class="form-group col-md-6">
      			<label for="name" class="col-form-label"> Date</label>
      			<input type="text" name="order_date" class="form-control" id="datepicker" required=""> 
      		</div>
      		
      	</div> 
      	<div class="row">
      		
      		<div class="form-group col-md-4">
      			<label for="name" class="col-form-label"> Number people  </label>
      			<input type="text" name="people_number" class="form-control" id="peonumber" required=""> 
      		</div>
      		<div class="form-group col-md-4">
      			<label for="name" class="col-form-label"> Price  </label>
      			<input type="text" name="price_table" class="form-control" id="price" required=""> 
      		</div>
      		<div class="form-group col-md-4">
      			<label for="name" class="col-form-label"> Phone  </label>
      			<input type="text" name="phone" class="form-control" id="phone" required=""> 
      		</div>
      	</div> 
      	<button id="buttonsave" type="submit" class="btn btn-success"  >Add</button>
      	</form>
      </div>
      <div class="modal-footer">
      	<button id="buttoncancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	
      </div>
    </div>
  </div>
</div>
<script>
    $('#datepicker').datepicker({
      uiLibrary: 'bootstrap4',
      format: 'yyyy-mm-dd'
    });
</script>
<script>
        $('#time').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection