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
			
			<a href="" class="btn btn-success" style="color: white"><em class="fas fa-plus"></em> ADD</a>
			
		</div>
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
			    @foreach ($order as $key=> $o)
					<tr >
						<td >{{$o->id}}</td>
						<td>{{$o->user->name}}</td>
						<td>{{$o->phone}}</td>
						<td>{{$o->order_time->time}}</td>
						<td>{{$o->order_date}}</td>
						<td>{{$o->people_number}}</td>
						<td>{{$o->price_table}}</td>
						<td>

						@if($o->status ==1)
		                     <button class="btn-danger" >
		                       
		                      <a href="" onclick="return confirm('Bạn có muốn block user này?')" role="button"  style="color: white;text-decoration: none;" >Cancel</a>
		                    </button>
		                    @else 
		                    <button class="btn-success">
		                     
		                      <a data-toggle="modal" data-target="#myModal3" href=""  style="color: white;text-decoration: none;" >Accept</a>
		                    </button>
                        @endif
							<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal">
								<a href="" style="color: white;text-decoration: none;">Detail</a>
							</button>

							<button type="button" class="btn-danger" >
								<a href="" style="color: white;text-decoration: none;" onclick="return confirm ('Bạn có muốn xóa ')">Delete</a>
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
@endsection