@push('css')
<link href="{{asset('css/custom/front.css')}}" rel="stylesheet">
@extends('pages.home')
@section('content-section')
<style type="text/css" media="screen"></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8&libraries=places&callback=initMap"async defer></script>
<script type="text/javascript">
   var map, infoWindow;
   var markers = [];
   function initMap(){
     map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -34.397, lng: 150.644},
      zoom: 16,
    });
     infoWindow = new google.maps.InfoWindow;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
             var restaurant = <?php print_r(json_encode($restaurant)) ?>;
             var marker = new GMaps({
              el: '#map',
              center: pos,
              zoom:12
            });
            
            marker.addMarker({
             position: pos,
             title:'vị trí của bạn',
             infoWindow: {
              content: 'vị trí của bạn'
            }  
          });
            $.each( restaurant, function( index, value ){
              marker.addMarker({
                lat: value.lat,
                lng: value.longt,
                title: value.name,
                infoWindow: {
                  content: 'Tên địa điểm :'+value.name+'<br>Địa chỉ :'+value.address
                }       
              });
             });
            
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }
      
    </script>
    
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
<div class="row">
    <div class="col-3"  style="background-color:  #f8f9fa" >
        <div id="map" style="width:96%; margin-left: 3%;height: 300px;margin-top: 10px;"  >
          
        </div>       
        <div style="width: 100%; margin-left: 10px; margin-top: 30px;">
            <form class="form-inline" action="{{route('search.list')}}" method="get">   
            <div class="">        
            <div>
               <input class="typeahead form-control" type="text" placeholder="Search" name="search" required="" id="inputsearch" autocomplete="off" style="margin-bottom: 10px">
            </div>
                 
            <div>
              <button class="btn btn-success" type="submit" id="btnsearch"> Search </button>
            </div>
            </div>
          </form>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
      var path = "{{ route('autocomplete') }}";
      $('input.typeahead').typeahead({
        source:  function (query, process) {
          return $.get(path, { query: query }, function (data) {
            return process(data);
          });
        }
      });
    </script>
    <div class="col-9">
      <div class="" id="topplace">
        <div style="text-align: center;margin-top:50px;color: #b3b3ba;" ><h4>NHỮNG ĐỊA ĐIỂM TỔ CHỨC ĐƯỢC ĐÁNH GIÁ CAO</h4></div>

        <div class="row" style="justify-content: center;">
            @if($top_rating->count() !== 0)
            @foreach ($top_rating as $record)
            <div class="col-sm-3" style="margin:50px 0;">
                <div class="card-img" style="height:300px;" id="card-img" >
                    <a href='{{route("detail",$record->id)}}' title="" style="text-decoration: none;">
                        <div style="height: 200px;">
                            <img class="card-img-top list_images" src="{{ $record->photo_path }}" alt="{{$record->title}}" style="height: 200px;" alt="avatar">
                        </div>

                        <div class="card-body">

                            <h5 class="card-title">

                                <span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap; font-size: 16px;color: black;">
                                    {{$record->name}}
                                </span>
                                <div><span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap; font-size: 16px; "> <i class="fas fa-map-marker-alt " style="color: red;"></i> {{$record->address}}</span></div>
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
            @endif
        </div>
    </div>
        <div style="text-align: center;margin-top:50px;color: #b3b3ba;"><h2>NHỮNG BÀI VIẾT MỚI NHẤT</h2></div>
        <div class="row" style="justify-content: center;">
            
            @foreach ($all_post as $record)
            <div class="col-sm-4" style="margin:50px 0;">
                <div class="card-img" id="card-img" style="height:300px;" >
                    <a href='{{route("detail",$record->id)}}' title="" style="text-decoration: none;"id="pic">
                        <div style="height: 200px;">
                            <img class="card-img-top list_images" src="{{ $record->photo_path }}" alt="{{$record->title}} " >
                        </div>

                        <div class="card-body">

                            <h5 class="card-title text-primary">

                                <span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap;font-size: 16px;color: black;">
                                    {{$record->name}}
                                </span>
                                <div><span style="display:block;text-overflow: ellipsis;overflow: hidden; white-space: nowrap; font-size: 16px; "> <i class="fas fa-map-marker-alt " style="color: red;"></i> {{$record->address}}</span></div>
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
<!-- <div class="container">
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
</div> -->
@endsection
