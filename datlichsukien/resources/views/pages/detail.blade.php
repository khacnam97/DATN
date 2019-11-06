@extends('layouts.app')
@section('header')
<link rel="stylesheet" type="text/css" href="/css/custom/rating.css">
<link rel="stylesheet" type="text/css" href="/css/custom/front.css">

<style>
  #map {
    height: 500px;
  }
 
</style>

@endsection
@section('content')

<script>
  var map;
  // var infoWindow = new google.maps.InfoWindow();
  var latvalue = {{json_encode($data[0]->lat)}};
  var longvalue = {{json_encode($data[0]->longt)}};
  var namevalue = {!! json_encode($data[0]->restaurant) !!};
  var addressvalue = {!! json_encode($data[0]->address) !!};
  var directionsDisplay;
  var directionsService;
  var stepDisplay;
  var markerArray = [];
  function initMap() {

    var uluru = {
      lat: latvalue,
      lng: longvalue
    };

    var map = new google.maps.Map(
      document.getElementById('map'), {
        zoom: 16,
        center: uluru
      });

    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
    var infowindow = new google.maps.InfoWindow({
      content: 'Tên địa điểm: ' + namevalue+
      '<br>Địa chỉ: ' + addressvalue
    });
    infowindow.open(map,marker);
    
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxqyb5cmgcv7j9hY-GcPZYcNQlwyfWaT0&callback=initMap" async defer></script>

<?php
$photo_path = $data->unique('photo_path')->values();
?>
<div class="container" style='text-align:left;margin-top:100px;'>
  <h1 class="my-4" style="margin-bottom: 0px;">{{$data[0]->title}}</h1>

    <small style="text-align:right;font-size: 18px; margin-bottom: 20px;">By <a style="color: blue;text-decoration: none;" href="/user/{{$data[0]->user_id}}"> {{$data[0]->name}}</a> Ngày {{ date('d-m-Y', strtotime($data[0]->create_at)) }}  </small>

  
  <div class="row">

    <div class="col">

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">

          <div class="carousel-item active">

            <img height="500px" class="d-block w-100" src="/{{$photo_path[0]->photo_path}}" alt="">

          </div>

          @for ($i=1;$i<$photo_path->count();$i++)
            <div class="carousel-item">

              <img height="500px" class="d-block w-100" src="/{{$photo_path[$i]->photo_path}}" alt="">

            </div>
            @endfor
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>

  </div>

  <div class="row">
    <div class="col-6">
      <div style="margin: 20px 0;" class="rating">
        @for($i=1;$i<= $rating;$i++) <span style="color:orange;font-size: 30px" class="fa fa-star "></span>
          @if($rating -$i >= 0.5 && $rating -$i < 1)<span style="color:orange;font-size: 30px" class="fa fa-star-half-alt "></span>

            @endif
            @endfor
            <span>{{$rating}}</span>
      </div>
    </div>
    <div class="col-6" style="text-align: end;margin: 30px 0;">
      @if (session('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria_label="Close">
          <span aria_hidden="true">&times;</span>
        </button>
        {{ session('success') }}
      </div>
      @endif
      <div>
        <div class="row" style="justify-content: flex-end;margin-right: 5px;">
          <div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button" data-size="large">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="fb-xfbml-parse-ignore">Chia sẻ</a>
          </div>
        </div>
      </div>

    </div>
 
        <div class="row">
            <div class="form-group col-md-4" >
               @if(Auth::check())
              <a href="{{route('order',$data[0]->restaurant_id)}}" class="btn btn-primary"  style="width: 200px;"> Đặt lịch</a>
                @else

                <a style="width:200px;" class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="{{ route('login') }}">Đặt lịch</a>
                @endif
           </div>
        </div>

    <div style="margin: 20px 0 100px 0;width: 100%;">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#location">Location</a>
        </li>

      </ul>

      <!-- Tab panes -->
      <div style="height:500px;" class="tab-content">
        <div id="description" class="container tab-pane active"><br>
          <h3>{{$data[0]->restaurant}}</h3>
             {!!($data[0]->describer)!!}
        </div>
        <div id="location" class="container tab-pane fade"><br>
          <h3>Location</h3>         
          <div id="map"></div>
        </div>

      </div>
    </div>
  </div>
  <div class="container">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" style="margin-bottom: 20px;">
      Comment
    </button>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">

        @if(Auth::check())
        @if($user_rate)
        <p>Your rate:
          @for($i=1;$i<= $user_rate->rating;$i++) <span style="color:orange;font-size: 30px" class="fa fa-star "></span>
            @if($user_rate->rating -$i >= 0.5 && $user_rate->rating -$i < 1)<span style="color:orange;font-size: 30px" class="fa fa-star-half-alt "></span>

              @endif
              @endfor
              <span>{{$user_rate->rating}}</span></p>
        @endif
        <form action="/detail/rate" method="POST" onsubmit="myButton.disabled = true; return true;">
          @csrf
          <label for="">Rating:</label>
          <?php session(['post_id' => $data[0]->id]); ?>

            <span class="star-rating">
              <!-- <ul id='stars'>
                <li class='star' name="rating" title='Poor' value='1'>
                  <i class='fa fa-star fa-fw' name="rating"></i>
                </li>
                <li class='star' title='Fair' name="rating" value='2'>
                  <i class='fa fa-star fa-fw' name="rating"></i>
                </li>
                <li class='star' title='Good' name="rating" value='3'>
                  <i class='fa fa-star fa-fw' name="rating"></i>
                </li>
                <li class='star' title='Excellent' name="rating" value='4'>
                  <i class='fa fa-star fa-fw' name="rating"></i>
                </li>
                <li class='star' title='WOW!!!' name="rating" value='5'>
                  <i class='fa fa-star fa-fw' name="rating"></i>
                </li>
              </ul> -->
              <input  class='fa fa-star fa-fw' type="radio" name="rating" value="1">
              <input  class='fa fa-star fa-fw' type="radio" name="rating" value="2">
              <input  class='fa fa-star fa-fw' type="radio" name="rating" value="3">
              <input  class='fa fa-star fa-fw' type="radio" name="rating" value="4">
              <input  class='fa fa-star fa-fw' type="radio" name="rating" value="5">
            </span>
  

          <div class="form-group">
            <label for="">Comment:</label>


            <textarea class="form-control" rows="5" id="" name="commentarea" required></textarea>


          </div>
          <button name="myButton">Send</button>
        </form>
        @else
        <a style="width:150px;" class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="{{ route('login') }}">Please Login</a>
        @endif
      </div>
    </div>
  </div>


  @if($post_relate->count() !== 0)
  <div class="container-fluid">
    <div style="text-align: center;margin-top:50px;">
      <h2>Những bài viết liên quan</h2>
    </div>

    <div class="row" style="justify-content: center;">
      @foreach ($post_relate as $record)
      <div class="col-sm-3" style="margin:50px 0;">
        <div class="card-img" style="height:280px;">
          <a href="{{route('detail',$record->id)}}" title="" style="text-decoration: none;">
            <div style="height: 200px;">
              <img class="card-img-top list_images" src="/{{ $record->photo_path }}" alt="{{$record->title}}" style="height: 200px;">
            </div>

            <div class="card-body">

              <h5 class="card-title text-primary">

                <span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap;font-size: 16px;color:black;">
                  {{$record->title}}
                </span>
              </h5>
              <div class="rating">
                @for($i=0;$i< ceil($record->rate);$i++)
                  <span class="fa fa-star checked"></span>
                  @endfor
                  @for($i=ceil($record->rate);$i< 5;$i++) <span class="fa fa-star unchecked"></span>
                    @endfor
              </div>

              <p class="card-text">
              </p>

            </div>
          </a>

        </div>
      </div>
      @endforeach
      @endif
    </div>
  </div>

</div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3"></script>
<script async defer crossorigin="anonymous" src="{{asset('js/front/cmt.js')}}"></script>
@endsection
