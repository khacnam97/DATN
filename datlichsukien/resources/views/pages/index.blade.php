@push('css')
<link href="{{asset('css/custom/front.css')}}" rel="stylesheet">
@extends('pages.home')
@section('content-section')
<style type="text/css" media="screen"></style>

<div class="carousel slide" data-ride="carousel" id="demo"  >
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li class="active" data-slide-to="0" data-target="#demo">
        </li>
        <li data-slide-to="1" data-target="#demo">
        </li>
        <li data-slide-to="2" data-target="#demo">
        </li>
    </ul>
    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img alt="Los Angeles" height="500" src="https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2017/12/22223742/Events-1200x630.jpg" width="1100">
            </img>
        </div>
        <div class="carousel-item">
            <img alt="Chicago" height="500" src="https://www.ucb.ac.uk/content/images/courses/hospitality-tourism-events/events-management-3.jpg" width="1100">
            </img>
        </div>
        <div class="carousel-item">
            <img alt="New York" height="500" src="https://d3vhc53cl8e8km.cloudfront.net/hello-staging/wp-content/uploads/2017/12/22223742/Events-1200x630.jpg" width="1100">
            </img>
        </div>
    </div>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" data-slide="prev" href="#demo">
        <span class="carousel-control-prev-icon">
        </span>
    </a>
    <a class="carousel-control-next" data-slide="next" href="#demo">
        <span class="carousel-control-next-icon">
        </span>
    </a>
</div>
<div class="row" style=" width: 100%; margin-top: 20px;  " >
    <div class="col-3" style="background-color:  #f8f9fa; " >
        <div style="background-color: #e9ecef; height: 500px;" >
        <div  style="width:150px; margin-left: 5%; ">
            <div class="map-responsive">
                <iframe allowfullscreen="" frameborder="0" height="200" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=ĐaNang" style="border:0" width="300">
                </iframe>
            </div>
        </div>
        <div style="width: 90%; margin-left: 5%; margin-top: 30px;">
            <form class="form-inline">
                <input aria-label="Search" class="form-control" placeholder="Search" type="search">
                    <button class="btn btn-outline-success " type="submit">
                        Search
                    </button>
                </input>
            </form>
        </div>
        </div>
    </div>
    <div class="col-9">
    	<div class="container-fluid" id="topplace">
        <div style="text-align: center;margin-top:50px;color: #b3b3ba;" ><h2>NHỮNG ĐỊA ĐIỂM TỔ CHỨC ĐƯỢC ĐÁNH GIÁ CAO</h2></div>

        <div class="row" style="justify-content: center;">
            @if($top_rating->count() !== 0)
            @foreach ($top_rating as $record)
            <div class="col-sm-3" style="margin:50px 0;">
                <div class="card-img" style="height:280px;" id="card-img" >
                    <a href='{{route("detail",$record->id)}}' title="" style="text-decoration: none;">
                        <div style="height: 200px;">
                            <img class="card-img-top list_images" src="{{ $record->photo_path }}" alt="{{$record->title}}" style="height: 200px;" alt="avatar">
                        </div>

                        <div class="card-body">

                            <h5 class="card-title">

                                <span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap; font-size: 16px;color: black;">
                                    {{$record->title}}
                                </span>
                            </h5>
                            <div class="rating">
                                @for($i=0;$i< ceil($record->avg_rating);$i++)
                                <span class="fa fa-star checked"></span>
                                @endfor
                                @for($i=ceil($record->avg_rating);$i< 5;$i++)
                                <span class="fa fa-star unchecked"></span>
                                @endfor
                            </div>

                            <p class="card-text">
                            </p>

                        </div>
                    </a>

                </div>
            </div>
            @endforeach
            @else
            <div class="col-sm">
                <p>Không có dữ liệu</p>
            </div>
            @endif
        </div>
    </div>
        <div class="row" style="justify-content: center;">
            
            @foreach ($new_post as $record)
            <div class="col-sm-4" style="margin:50px 0;">
                <div class="card-img" id="card-img" >
                    <a href='{{route("detail",$record->id)}}' title="" style="text-decoration: none;"id="pic">
                        <div style="height: 200px;">
                            <img class="card-img-top list_images" src="{{ $record->photo_path }}" alt="{{$record->title}} " >
                        </div>

                        <div class="card-body">

                            <h5 class="card-title text-primary">

                                <span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap;font-size: 16px;color: black;">
                                    {{$record->title}}
                                </span>
                            </h5>
                            <div class="rating">
                                @for($i=0;$i< ceil($record->avg_rating);$i++)
                                <span class="fa fa-star checked" ></span>
                                @endfor
                                @for($i=ceil($record->avg_rating);$i< 5;$i++)
                                <span class="fa fa-star unchecked" ></span>
                                @endfor
                            </div>

                            <p class="card-text">
                            </p>

                        </div>
                    </a>

                </div>
            </div>
            @endforeach
        </div>

    </div>
 </div>   
<div class="container">
	<div style="text-align: center;margin-top:50px;" id="contact">
		<h2 class="section-heading" style="color: #b3b3ba;">Contact Us</h2>
		<hr align="content" width="20%" color="#3997A6" size="0.1px" style="padding-bottom: 1px; margin-bottom: 40px;"> 
	</div>
	<div class="row"  style="justify-content: center;">
		<div class="col-sm-4 text-center">
			<a href="tel:+91-8238566835"><em style="color: #3997A6;" class="fa fa-phone fa-3x sr-contact"></em></a>
			<p>+84-199001950</p>
		</div>
		<div class="col-sm-4 text-center">
			<a href="info@travelbrewery.com"><em style="color: #3997A6;" class="fa fa-envelope fa-3x sr-contact"></em></a>
			<p>Nam@gmail.com</p>
		</div>
	</div>
</div>
@endsection
