@push('css')
<link href="{{asset('css/custom/front.css')}}" rel="stylesheet">
@extends('pages.home')
@section('content-section')
<style type="text/css" media="screen"></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8&libraries=places&callback=initMap"async defer></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
    
    <div class=""  id="demo" style="background-image:url(/picture/anhnen.jpg);
    height: 300px; " >
    <div class ="" style="padding-top: 150px;display: inline-block;display: flex;justify-content: center;">
      <form class="form-inline" action="{{route('search.list')}}" method="get">   
        <div class="row ">        
          <div style="padding-bottom: 10px; padding-right:10px">
           <input class="typeahead form-control"  type="text" placeholder="Nhập địa điểm tìm kiếm " name="search" required="" id="input" autocomplete="off" style="margin-bottom: 10px;width: 400px;">
         </div>

         <div>
          <button class="btn btn-success" type="submit" id="btnsearch" style=""> <span class="font-weight-bold" >Tìm kiếm </span></button>
          </div>
        </div>
        </form>
      </div>

    </div>
<div class="row">
   
    <div class="col-9">
      <div class="" id="topplace">
        @if($top_rating->count() == 0)
        @else
         <div style="text-align: center;margin-top:50px;color: #b3b3ba;" ><h4>NHỮNG ĐỊA ĐIỂM TỔ CHỨC ĐƯỢC ĐÁNH GIÁ CAO</h4></div>
        @endif
        <div class="row" style="justify-content: center; margin-left: 5px;">
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
        <div class="row" style="justify-content: center; margin-left: 5px;">
            @if($all_post->count() !== 0)
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
       <div style="display: inline-block;display: flex;justify-content: center;">{!!$all_post->links()!!}</div>
    @endif
    </div>
    <div class="col-3"  style="background-color:  #f8f9fa" >
        <div id="map" style="width:97%; margin-right: 3%;height: 300px;margin-top: 10px;"  >
          
        </div>       
        
    </div>
 </div>   
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
@endsection