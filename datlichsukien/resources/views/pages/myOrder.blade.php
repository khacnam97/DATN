@extends('layouts.app')
@section('content')

<div class="card mb-3">
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
	@if($order->count() == 0)
		<h1 style="margin-top:100px;margin-bottom: 100px; font-size: 35px;">Bạn chưa có lịch đặt nào </h1>
	

	@else
	<h1 style="margin-top:100px;margin-bottom: 50px; text-align: center;">Lịch đặt của tôi</h1>
	
	<div class="card-body">
		
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" >
				<thead>
					<tr>
						<th >Địa điểm đặt lịch</th>
						<th>Số điện thoại </th>
						<th>Thời gian tổ chức</th>
						<th>Ngày tổ chức</th>
						<th>More</th>
					</tr>
				</thead>
				<tbody>
    @endif
			    @foreach ($order as $key=> $o)
					<tr >
						<td >{{$o->restaurant->name}}</td>
						<td>{{$o->restaurant->phone}}</td>
						<td>{{$o->order_time}}</td>
						<td>{{$o->order_date}}</td>
						<td>

						@if($o->status ==1)
		                      <button class="btn-danger" >
		                       
		                      <a href="" onclick="return confirm('Bạn có muốn block user này?')" role="button"  style="color: white;text-decoration: none;" >Hủy</a>
		                    </button>
		                    @else 
		                    <button class="btn-success">
		                     
		                      <a data-toggle="modal" data-target="#myModal3" href=""  style="color: white;text-decoration: none;" >Đang chờ </a>
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
</div>

@endsection