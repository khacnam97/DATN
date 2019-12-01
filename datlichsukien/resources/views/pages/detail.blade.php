@extends('layouts.app')
@section('header')
<link rel="stylesheet" type="text/css" href="/css/custom/rating.css">
<link rel="stylesheet" type="text/css" href="/css/custom/front.css">
/* Bootstrap css */
@import "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css";

/* Google Material icons */
@import "http://fonts.googleapis.com/icon?family=Material+Icons";

/* Propeller css */
@import "dist/css/propeller.min.css";

/* Bootstrap datetimepicker */
@import "datetimepicker/css/bootstrap-datetimepicker.css";

/* Propeller datetimepicker */
@import "datetimepicker/css/pmd-datetimepicker.css";
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Bootstrap js -->
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<!-- Propeller textfield js --> 
<script type="text/javascript" src="dist/js/propeller.min.js"></script>

<!-- Datepicker moment with locales -->
<script type="text/javascript" language="javascript" src="datetimepicker/js/moment-with-locales.js"></script>

<!-- Propeller Bootstrap datetimepicker -->
<script type="text/javascript" language="javascript" src="datetimepicker/js/bootstrap-datetimepicker.js"></script>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8&callback=initMap" async defer></script>

<?php
$photo_path = $data->unique('photo_path')->values();
?>
<div class="container" style='text-align:left;margin-top:100px;'>
  @if (session('success'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria_label="Close">
          <span aria_hidden="true">&times;</span>
        </button>
        {{ session('success') }}
      </div>
      @endif
  @if (session('error'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria_label="Close">
          <span aria_hidden="true">&times;</span>
        </button>
        {{ session('error') }}
      </div>
      @endif
  <h1 class="my-4" style="margin-bottom: 0px;">{{$data[0]->title}}</h1>

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
      
      <div>
        <div class="row" style="justify-content: flex-end;margin-right: 5px;">
          <div class="fb-share-button" data-href="{{url()->current()}}" data-layout="button" data-size="large">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" class="fb-xfbml-parse-ignore">Chia sẻ</a>
          </div>
        </div>
      </div>

    </div>
    @if(Auth::check())
        <div style="margin-left: 12px; "><h4>Đặt lịch</h4></div> 
        <div class="col-12" >
               
               
                 @if(!empty($result))            
                    <button type="button" style="height: 40px; font-size: 12px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate1" value="{{$strDay7}}">{{$weekday1}}  ({{$strDay7}})  </button>
                 @else 
                        <button type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday1}}  ({{$strDay7}}) </button>
                  @endif
                  @if(!empty($result2))            
                    <button type="button" style="height: 40px; font-size: 12px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate2" value="{{$strDay8}}">{{$weekday2}}({{$strDay8}}) </button>
                 @else 
                        <button type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday2}}({{$strDay8}})</button>
                  @endif
                  @if(!empty($result3))            
                    <button type="button" style="height: 40px; font-size: 12px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate3" value="{{$strDay9}}">{{$weekday3}}({{$strDay9}})</button>
                 @else 
                        <button type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday3}}({{$strDay9}})</button>
                  @endif
                   @if(!empty($result4))            
                    <button type="button" style="height: 40px; font-size: 12px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate4" value="{{$strDay10}}">{{$weekday4}}({{$strDay10}}) </button>
                 @else 
                        <button type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday4}}({{$strDay10}})</button>
                  @endif
                  @if(!empty($result5))            
                    <button type="button" style="height: 40px; font-size: 12px;"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate5" value="{{$strDay11}}">{{$weekday5}}({{$strDay11}}) </button>
                 @else 
                        <button type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday5}}({{$strDay11}})</button>
                  @endif
                  @if(!empty($result6))            
                    <button type="button" style="height: 40px; font-size: 12px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate6" value="{{$strDay12}}">{{$weekday6}}({{$strDay12}}) </button>
                 @else 
                        <button  type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday6}}({{$strDay12}}) </button>
                  @endif
                    @if(!empty($result7))            
                    <button type="button" style="height: 40px; font-size: 12px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal22" id="btnDate7" value="{{$strDay13}}">{{$weekday7}}({{$strDay13}}) </button>
                 @else 
                        <button type="button" style="height: 40px; font-size: 12px;" disabled="" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal22" >{{$weekday7}}({{$strDay13}}) </button>
                  @endif
               
               
          
        </div>
        
        <div class="col-6" style="margin-left: 12px; margin-top: 10px;">
            <form action="{{route('order.add.date')}}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token()}}">
             <div class="row">
               <input type="hidden" value="{{$data[0]->id}}" name="idpost">
               <input type="hidden" value="{{$data[0]->restaurant_id}}" name="restaurantid">
               <input type="hidden" value="{{$data[0]->restaurant}}" name="restaurantdate">
               <input required="" id="datepicker" name="order_date" width="276" placeholder="Chọn ngày đặt lịch" />
               <button type="submit" class="btn btn-success">Đặt lịch</button>
             </div>
              
            </form> 
            <script>
              $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
              });
            </script>
        </div> 
         @else

         <a style="width:200px;" class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="{{ route('login') }}">Đặt lịch</a>
        @endif

    <div style="margin: 20px 0 100px 0;width: 100%;">
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#description">Mô tả</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#location">Vị trí</a>
        </li>

      </ul>

      <!-- Tab panes -->
      <div style="height:500px;" class="tab-content">
        <div id="description" class="container tab-pane active"><br>
          <h3>{{$data[0]->restaurant}}</h3>
          <h5 style="color: #3490dc;"> <i class="fas fa-map-marker-alt " style="color: red;"></i> {{$data[0]->address}}</h5>
             {!!($data[0]->describer)!!}
        </div>
        <div id="location" class="container tab-pane fade"><br>    
          <div id="map" style="height: 400px;"></div>
        </div>

      </div>
    </div>
  </div>
  <div class="container">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" style="margin-bottom: 20px;">
      Bình luận
    </button>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">

        @if(Auth::check())
        @if($user_rate)
        <p>Đánh giá của bạn:
          @for($i=1;$i<= $user_rate->rating;$i++) <span style="color:orange;font-size: 30px" class="fa fa-star "></span>
            @if($user_rate->rating -$i >= 0.5 && $user_rate->rating -$i < 1)<span style="color:orange;font-size: 30px" class="fa fa-star-half-alt "></span>

              @endif
              @endfor
              <span>{{$user_rate->rating}}</span></p>
        @endif
        <form action="/detail/rate" method="POST" onsubmit="myButton.disabled = true; return true;">
          @csrf
          <label for="">Đánh giá của bạn về địa điểm này:</label>
          <?php session(['post_id' => $data[0]->id]); ?>

            <div class='rating-stars '>
              <ul id='stars'>
                <li class='star' title='Poor' data-value='1'>
                  <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star' title='Fair' data-value='2'>
                  <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star' title='Good' data-value='3'>
                  <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star' title='Excellent' data-value='4'>
                  <i class='fa fa-star fa-fw'></i>
                </li>
                <li class='star' title='WOW!!!' data-value='5'>
                  <i class='fa fa-star fa-fw'></i>
                </li>
              </ul>
            </div>
            <input type="" name="inputHidenRating" value="" id="inputHidenRating" hidden="">
  

          <div class="form-group">
            <label for="">Bình luận:</label>
            <textarea class="form-control" rows="5" id="" name="commentarea" required></textarea>
          </div>
          <button name="myButton" class="btn btn-primary" type="submit" id="btnRating">Gửi</button>
        </form>
        @else
        <a style="width: 300px;" class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="{{ route('login') }}">Vui lòng đăng nhập để đánh giá</a>
        @endif
      </div>
    </div>
  </div>
  <div class="container" style="margin-bottom: 50px;">
    @if($data[0]->cmt !=NULL || $data[0]->rate != NUll)
    @foreach ($data as $key=>$value)
    <div class="media border p-3">

      @if($value->avatar)
      <img style="width:40px; height: 40px;" class="mr-3 mt-3 rounded-circle" src="{{$value->avatar}}" alt="">
      @else
      <img style="width:40px; height: 40px;" class="mr-3 mt-3 rounded-circle" src="/picture/images.png" alt="">
      @endif
      <div class="media-body">

        <h5 style='padding-top:20px;display:inline-block;' class="mt-0"><a href="/user/{{$value->cmtid}}">{{$value->cmtname}}</a></h5>

        <small>{{ date('d-m-Y', strtotime($value->created_at)) }}</small>

        @for($i=1;$i<= $value->rate;$i++)
          <span style="color:orange" class="fa fa-star "></span>

          @endfor

         {!!$value->cmt!!}
      </div>
    </div>
    @endforeach
    @endif
  </div>

  

</div>
<!-- Modal -->
@include('pages.addorder')

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3"></script>
<script async defer crossorigin="anonymous" src="{{asset('js/front/cmt.js')}}"></script>
@endsection