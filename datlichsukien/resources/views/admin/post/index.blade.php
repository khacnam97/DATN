@extends('layouts.admin')
@section('title', '/ Địa điểm')
@section('content')
 @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
	Bảng dữ liệu bài viết</div>
	<div class="card-body">
		<div style="margin-bottom: 15px">
			<button data-toggle="modal" data-target="#myModal3" class="btn btn-success "><i class="fas fa-plus"></i> Thêm</button>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Mô tả</th>
						<th>Người đăng kí</th>
						<th>Trạng thái</th>
						<th>Địa điểm</th>
						<th>Khác</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Mô tả</th>
						<th>Người đăng kí</th>
						<th>Trạng thái</th>
						<th>Địa điểm</th>
						<th>Khác</th>
					</tr>
				</tfoot>
				<tbody style="font-weight: normal;">
					
					@foreach($posts as $post)
					<tr style="font-weight: normal;">
						<th style="font-weight: normal;">{{ $post-> id }}</th>
						<th style="font-weight: normal;">{{ $post->title }}</th>
						<th style="font-weight: normal;">{{ $post->user->name}}</th>
						<th style="font-weight: normal;">@if($post->is_approved ==1)
							<div style="display: flex;">
								Chấp nhận  
								<a href="{{route('admin.post.unapproved', $post->id)}}" onclick="return confirm('Xác nhận hủy đăng bài này?')" role="button" class="btn btn-danger nav-link" style="width: 50px; height: 40px; margin-left: 10px;" > Un</a>
							</div>
							@else 
							<div style="display: flex;">
								Từ chối  
								<a href="{{route('admin.post.approved', $post->id)}}" onclick="return confirm('Xác nhận đăng bài này?')" role="button" class="btn btn-success nav-link" style="width: 50px; height: 40px; margin-left: 10px;" > En</a>
							</div>
						@endif </th>
						<th style="font-weight: normal;">{{ $post->restaurant->name }}</th>

						<td align="center" style="display: flex;">
							<a href="{{route('admin.post.detail', $post->id)}}" class=" btn btn-success nav-link"> Chi tiết</a>

							<a href="{{route('admin.post.showedit', $post->id)}}" class="btn btn-info nav-link " role='button' style="margin-left: 5px;"> Sửa</a>
							<form method="post" action="{{ route('admin.post.delete', $post->id)}}">
								@csrf
								<button class="btn btn-danger nav-link" role='button' onclick="return confirm('Bạn có muốn xóa bản ghi này?')" style="margin-left: 5px;"> Xóa</button>
							</form>
						</td>
					</tr>

					@endforeach
					

				</tbody>
			</table>
		</div>
	</div>
	<div class="modal fade" id="myModal3" >
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header" style="">
					<h4 class="modal-title " style="width: 100%; text-align: center;">Thêm một địa điểm</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				@if ($errors->count() > 0)
	              <script type="text/javascript">
	                $( window ).on("load", function() {
	                  $("#myModal3").modal("toggle");
	                });
	              </script>
	                
	            @endif
				@include('admin.post.add')
				<!-- Modal body -->
				<div class="modal-body">
					<div></div>
				</div>

				<!-- Modal footer -->
{{--       <div class="modal-footer">
        <a type="button" class="btn btn-success" href="{{route('admin.post.add')}}">Add</a>
    </div> --}}

</div>
</div>
</div>

<div class="modal" id="myModal4">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="">
				<h4 class="modal-title">Detail</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
{{--       		@include('admin.post.detail')
--}}      <!-- Modal body -->
<div class="modal-body">
	<div></div>
</div>

<!-- Modal footer -->
{{--       <div class="modal-footer">
        <a type="button" class="btn btn-success" href="{{route('admin.post.add')}}">Add</a>
    </div> --}}

</div>
</div>
</div>
<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{asset('ckeditor/adapters/jquery.js') }}"></script>
@endsection