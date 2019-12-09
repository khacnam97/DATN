@extends('layouts.admin')
@section('title', '/ Đánh giá')
@section('content')
<div class="card mb-3">
	<div class="card-header">

		<em class="fas fa-table"></em>
	Bảng dữ liệu đánh giá</div>

	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				@if ($errors->count() > 0)
				<script type="text/javascript">
					$(window ).on("load", function() {
						$('#addModal').modal('show');
                  //$("#myModal").modal("toggle");
                  console.log("zz");
              });
          </script>
          
          @endif
          @include('admin.rating.add')
      </div>
  </div>
</div>

<div class="card-body">
	<div style="margin-bottom: 15px">
		<button data-toggle="modal" data-target="#addModal" class="btn btn-success "><em class="fas fa-plus"></em> Thêm</button>
	</div>
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
					<th>Đánh giá</th>
					<th>Bình luận</th>
					<th>Người đánh giá</th>
					<th>Địa điểm</th>
					<th>Khác</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Đánh giá</th>
					<th>Bình luận</th>
					<th>Người đánh giá</th>
					<th>Địa điểm</th>
					<th>Khác</th>
				</tr>
			</tfoot>
			<tbody>
				@if($rating)
				@foreach ($rating as $record)
				<tr>
					<td>{{$record->id}}</td>
					<td>{{$record->rating}}</td>
					<td>{!! $record->cmt !!}</td>
					<td>{{$record->user->name}}</td>
					<td>{{$record->post->restaurant->name}}</td>
					<td style="display: flex;">
						<a href="{{route('admin.rating.edit',$record->id)}}" class="btn-info nav-link" role='button'> Sửa</a>
						<button form= "formDel" formaction ="{{route('admin.rating.delete',$record->id)}}" class="btn-danger nav-link" role='button' onclick="return confirm('Bạn có muốn xóa bản ghi này?')" style="margin-left: 5px;"> Xóa</button>
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


