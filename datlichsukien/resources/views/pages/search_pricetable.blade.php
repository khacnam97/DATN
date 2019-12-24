@extends('layouts.app')
@push('css')
<link href="{{asset('css/custom/front.css')}}" rel="stylesheet">
@endpush
@section('content')

@if(count($post)==0)
<div class="container" style="margin-top: 200px;">
	<div style="margin-bottom: 200px; margin-top: 200px;">
		<p style="font-size: 30px;text-align: center;">Không Tìm thấy địa điểm có mức giá dưới 2 triệu </p>
	</div>
</div>
@endif
@if(count($post)!=0)
<h1 style="margin-top:100px;margin-bottom: 50px; text-align: center;">Danh sách kết quả tìm kiếm </h1>
	<div style="text-align: center;">
		<span >Tìm thấy <strong>{{count($post)}}</strong> địa điểm có mức giá dưới 2 triệu </span>
	</div>
@endif
<div class="container" style="margin-top: 50px;">
	
	
	@foreach ($post as $record)
	<div class="row" style="margin-bottom: 50px;background-color: #dee2e6;width: 100%;height:300px;justify-content: center;align-items: center;-webkit-box-shadow: 11px 11px 5px -2px rgba(0,0,0,1);-moz-box-shadow: 11px 11px 5px -2px rgba(0,0,0,1);box-shadow: 11px 11px 5px -2px rgba(0,0,0,1)">
	<div class="col-sm-6">
		<img class="card-img-top" src="{{$record->photo_path}}" alt="{{$record->title}}" style="height: 280px;">
	</div>
	<div class="col-sm-6">
		<div class="text">
			<h5>{{$record->title}}</h5>
			<div >
				{!!Str::limit($record->describer, 100, ' ...')!!}
			</div>
			<div class="rating">
				@for($i=0;$i< ceil($record->avg_rating);$i++)
				<span class="fa fa-star checked"></span>
				@endfor
				@for($i=ceil($record->avg_rating);$i< 5;$i++)
				<span class="fa fa-star unchecked"></span>
				@endfor
			</div>
			<div> <h5><i class="fas fa-map-marker-alt " style="color: blue;"></i> {{$record->address}}</h5></div>
			<a href="/detail/{{$record->id}}" title="" class="btn btn-danger" style="border-radius: 50px;padding: 6px 20px;margin-top: 15px;margin-bottom: 15px;">Xem chi tiết</a>
			
		</div>
		
	</div>
</div>
@endforeach

</div>
<div style="display: flex;justify-content: center;">{!!$post->links()!!}</div>


@endsection
