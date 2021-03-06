@extends('layouts.app')
@push('css')
<link href="{{asset('css/custom/front.css')}}" rel="stylesheet">
@endpush
@section('content')
<div class="container" style="margin-top: 100px;">
	@if (session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif
	@if (session('error'))
	<div class="alert alert-danger">
		{{ session('error') }}
	</div>
	@endif
	@if($data->count() == 0)
		<h1 style="margin-top:150px;margin-bottom: 100px; font-size: 35px;text-align: center;">Bạn chưa đăng kí địa điểm nào !! <br>Hãy đăng kí địa điểm của bạn .<a href="{{route('account.addpost')}}" title="" class="" style=""> Tại đây</a></h1>
		

	@else
		<h1 style="margin-top:50px;margin-bottom: 50px; text-align: center;">Những địa điểm của tôi</h1>
		<a href="{{route('account.addpost')}}" title="" class="btn btn-info" style="display: table;justify-content: left;margin-bottom: 50px;">Đăng kí địa điểm mới</a>
	@endif	
	@foreach ($data as $key=>$value)
	<div class="row" style="margin-bottom: 50px;background-color: #ffffff;width: 100%;justify-content: center;align-items: center;-webkit-box-shadow: 11px 11px 5px -2px rgba(0,0,0,1);-moz-box-shadow: 11px 11px 5px -2px rgba(0,0,0,1);box-shadow: 11px 11px 5px -2px rgba(0,0,0,1)">
		<div class="col-sm-6">
			<img class="card-img-top" src="/{{$value->photo_path}}" alt="Card image cap" style="height: 280px;">
		</div>
		<div class="col-sm-6">
			<div class="text">
				<h5>{{$value->title}}</h5>
				<p class="created">Created: {{$value->created_at}}</p>
				<div>
					{!!Str::limit($value->describer, 100, ' ...')!!}
				</div>
				<a href="{{route('detail',$value->post_id)}}" title="" class="btn btn-danger" style="border-radius: 50px;padding: 6px 20px;margin-top: 15px;margin-bottom: 15px;width: 145px;">Xem chi tiết</a>
				<p class="created">Trạng thái:
					@if($value->is_approved == 1)
					Đã phê duyệt
					@else
					Chưa phê duyệt
					@endif
				</p>
			</div>
			<div class="row" style="display: table;text-align: left;">
				<form>
					@csrf
					<a href="{{route('account.editpost', [$idPost = $value->post_id])}}" title="" class="btn btn-info" style="width: 75px;margin-right: 10px;">Sửa</a>
					<button  formaction="{{route('mypost.delete', $id = $value->post_id)}}" title="" class="btn btn-danger " style="width: 75px;" onclick="return confirm('Bạn có muốn xoa bài đăng này?')" formmethod="post">Xóa</button>
				</form>
			</div>
		</div>
	</div>
	@endforeach

</div>

<div style="display: flex; justify-content: center;">{{$data->links()}}</div>

@endsection