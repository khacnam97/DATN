@extends('layouts.admin')
@section('title', '/ restaurant')
@section('content')
<div class="card mb-3">
	<div class="card-header">
		<em class="fas fa-table"></em>
	Data Table restaurant </div>
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
			
			<a href="{{route('admin.restaurant.add')}}" class="btn btn-success" style="color: white"><em class="fas fa-plus"></em> ADD</a>
			
		</div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" >
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Time create</th>
						<th>Time modify</th>
						<th>More</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Time create</th>
						<th>Time modify</th>
						<th>More</th>
					</tr>
				</tfoot>
				<tbody>

					@foreach ($restaurant as $key=> $p)
					<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->name}}</td>
						<td>{{$p->phone}}</td>
						
						<td>{{$p->address}}</td>
						<td>{{$p->created_at}}</td>
						<td>{{$p->updated_at}}</td>
						<td>

							<button type="button" class="btn-success" data-toggle="modal" data-target="#myModal">
								<a href="{{route('admin.restaurant.detail', $p->id)}}" style="color: white;text-decoration: none;">Detail</a>
							</button>
							<button type="button" class="btn-info" data-toggle="modal" data-target="#myModal">
								<a href="{{route('admin.restaurant.edit', $p->id )}}" style="color: white;text-decoration: none;">Edit</a>
							</button>

							<button type="button" class="btn-danger" >
								<a href="{{route('admin.restaurant.delete', $p->id)}}" style="color: white;text-decoration: none;" onclick="return confirm ('Bạn có muốn xóa {{$p->name}}')">Delete</a>
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