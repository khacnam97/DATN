@extends('layouts.admin')
@section('title', '/ Chi tiết')
@section('content')
<div class="card mb-3">
	<div class="card-header">

		<em class="fas fa-table"></em>
	Bảng dử liệu Chi tiết địa điểm </div>

<div class="card-body">
	
	<div class="table-responsive">
		@if (session('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria_label="Close">
				<span aria_hidden= "true">&times;</span>
			</button>
			{{ session('success') }}
		</div>
		@endif
		@if (session('error'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria_label="Close">
				<span aria_hidden= "true">&times;</span>
			</button>
			{{ session('error') }}
		</div>
		@endif
		<table class="table table-bordered" id="dataTable" style="width: 100%;">
			<thead>
				<tr>
					<th>ID</th>
					<th>Địa điểm</th>
					<th>Phòng</th>
					<th>Dịch vụ</th>
					<th>Số chứa của phòng</th>
					<th>Giá mỗi bàn</th>
					<th>Thời gian tạo</th>
					<th>Thời gian sửa</th>
					<th>Khác</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Địa điểm</th>
					<th>Phòng</th>
					<th>Dịch vụ</th>
					<th>Số chứa của phòng</th>
					<th>Giá mỗi bàn</th>
					<th>Thời gian tạo</th>
					<th>Thời gian sửa</th>
					<th>Khác</th>
				</tr>
			</tfoot>
			<tbody>
				@if($detail)
				@foreach ($detail as $record)
				<tr>
					<td>{{$record->id}}</td>
					<td>{{$record->restaurant->name}}</td>
					<td>{!! $record->room !!}</td>
					<td>{{$record->service}}</td>
					<td>{{$record->people_number}}</td>
					<td>{{$record->price}}</td>
					<td>{{$record->created_at}}</td>
					<td>{{$record->updated_at}}</td>
					<td style="display: flex;">
						<a href="{{route('admin.detail.edit',$record->id)}}" class="btn-info nav-link" role='button'> Sữa</a>
						<button type="button" class="btn-danger" >
							<a href="{{route('admin.detail.delete', $record->id)}}" style="color: white;text-decoration: none;" onclick="return confirm ('bạn có muốn xóa lịch đặt này')">Xóa</a>
						</button>
					</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
	<form method="post" id="formDel" hidden>
		@csrf
	</form>
</div>
<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

@endsection


