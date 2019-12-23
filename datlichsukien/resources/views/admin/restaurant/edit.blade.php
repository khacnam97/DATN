@extends('layouts.admin')
@section('content')
<h1>Chỉnh sửa địa điểm tổ chức</h1>
 @if (session('thongbao'))

 	{{session('thongbao')}}

 @endif

 @if(count($errors)>0)
 <div class="alert alert-danger">
  @foreach($errors->all() as $err)
  {{$err}} <br>
  @endforeach
</div>
@endif
@if(Session::has('message'))
<div class="alert alert-success">
	{{Session::get('message')}}
</div>
@endif

<form action="{{route('admin.restaurant.edit', $restaurant->id)}}" method="post">
	{{csrf_field()}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
  
  <div class="form-group">
    <label for="name">Tên địa điểm</label>
    <input type="text" name="name" value="{{ $restaurant->name }}" class="form-control" required autocomplete="name">
  </div>
  
  <div class="form-group">
    <label for="">Địa chỉ</label>
    <input id="text" type="text" name="address" value="{{ $restaurant->address }}" class="form-control" required autocomplete="address">
  </div>
  <div class="col-form-label  form-row" >
          <div class="form-group col-md-3">
            <label>Tên khu</label>
          </div>
          <div class="form-group col-md-3">
            <label>Dịch vụ</label>
          </div>
          <div class="form-group col-md-3">
            <label>Sức chứa</label>
          </div>
          <div class="form-group col-md-3">
            <label>Giá mỗi bàn</label>
          </div>
          </div>
          <div class="dropdown-divider"></div>
        @foreach ($detail as $record)
        <div class="input-group control-group  form-row" >
      
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="room[]" value="{{$record->room}}" placeholder="Tên khu" required="" >
          </div>
          <div class="form-group col-md-3">
            
            <input type="text" class="form-control" name="service[]" value="{{$record->service}}" placeholder="Dịch vụ" required="">
          </div>
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="peopleNumber[]" value="{{$record->people_number}}" placeholder="Sức chứa của phòng" required="">
          </div>
           <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="price[]" value="{{$record->price}}" placeholder="Giá mỗi bàn" required="">
          </div>
        </div>
        @endforeach
         
        <div class="input-group control-group increment1 form-row" >
              
              <div class="input-group-btn">  
                <button class="btn btn-primary addDetail" type="button"><i class="glyphicon glyphicon-plus" id="addDetail"></i>Thêm khu</button>
              </div>
            </div>
            <div class=" clone1" style="overflow: hidden;">
              <div class="control-group input-group form-row" style="margin-top:10px">
                <div class="form-group col-md-3">
            <input type="text" name="room[]" class="form-control"  placeholder="Tên khu"  >
          </div>
                <div class="form-group col-md-3">
                  <input type="text" name="service[]" class="form-control" placeholder="Dịch vụ" >
                </div>
                <div class="form-group col-md-3">
                  <input type="text" name="peopleNumber[]" class="form-control" placeholder="Sức chứa của phòng">
                </div>
                <div class="form-group col-md-3">
                  <input type="text" name="price[]" class="form-control" placeholder="Giá mỗi bàn">
                </div>
                <div class="input-group-btn"> 
                  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove" id="removed"></i> Xóa</button>
                </div>
              </div>
            </div>
  <div class="form-row">
   
    <div class="form-group col-md-3">
      <label for="">Số điện thoại</label>
       <input id="text" type="text" name="phone" value="{{ $restaurant->phone }}" class="form-control" required autocomplete="address">
    </div>

    <div class="form-group col-md-3">
      <label for="">Quận, huyện</label>
      <select class="custom-select" name="district_id" id="district">
        <option value="{{$restaurant->district_id}}">{{$restaurant->district->name}}</option>
        @if($district)
        @foreach ($district as $ca)
        <option value="{{$ca->id}}">{{$ca->name}}</option>
        @endforeach
        @endif
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="">Thành phố</label>
       <input id="text" type="text" name="city" value="Đà Nẵng" class="form-control" disabled="">
    </div>
  </div>
  <div class="form-group ">
    <label for="">Bản đồ</label>
    <input id="pac-input" class="controls" type="text" restaurantholder="Search Box">
    <div id="map"> </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <input type="hidden" value="{{$restaurant->lat}}" class="form-control input-sm" name="lat" id="lat" required="">
    </div>
    <div class="form-group col-md-3">
       <input type="hidden" value="{{$restaurant->longt}}" class="form-control input-sm" name="lng" id="lng" required="">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">
    <i class="fa fa-btn fa-sign-in"></i>Cập nhật
  </button>
    <a href="/admin/restaurant" class="btn btn-danger" style="color: white">Thoát</a>
</form>
<style type="text/css">
  #map{
    border:1px solid red;
    
    height: 500px;
  }
   #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }
      
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8&libraries=places&callback=initAutocomplete"
async defer></script>


<script type="text/javascript">
  var latvalue = {!! json_encode($restaurant->lat) !!}; 
  var lngvalue = {!! json_encode($restaurant->longt) !!};
  var namevalue = {!! json_encode($restaurant->name) !!};
  var addressvalue = {!! json_encode($restaurant->address) !!};
  var infowindow = new google.maps.InfoWindow;
  
  function initAutocomplete() {
   
    var pos = {
      lat: latvalue,
      lng: lngvalue
    };
        var map = new google.maps.Map(document.getElementById('map'), {
          center: pos,
          zoom: 16,
          mapTypeId: 'roadmap'
        });
        var marker = new google.maps.Marker({
          position: pos,
          draggable: true,  
          map: map
        });
        var infowindow = new google.maps.InfoWindow({
           content:'<b>Tên địa điểm:</b> '+namevalue+ '<br><b>Địa chỉ:</b>'+addressvalue+ '<br>Vị trí địa điểm: ' +'Lat :' + latvalue+
          ' Long: ' + lngvalue
        });
        infowindow.open(map,marker);
        
        

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
                
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                map.addListener('bounds_changed', function() {
                 searchBox.setBounds(map.getBounds());
                  });


        google.maps.event.addListener(searchBox,'places_changed',function(){
          var places = searchBox.getPlaces();
          var bounds = new google.maps.LatLngBounds();

          var i,place;
          for (i=0;place=places[i];i++){
            bounds.extend(place.geometry.location);
              marker.setPosition(place.geometry.location);//set marker position new
            }
            map.fitBounds(bounds);
            map.setZoom(16);
        });
        google.maps.event.addListener(marker,'position_changed',function(){
          var lat =marker.getPosition().lat();
          var lng =marker.getPosition().lng();

          $('#lat').val(lat);
          $('#lng').val(lng);
          if ( latvalue!=lat ||lngvalue!=lng) {
            infowindow.close();
            infowindow = new google.maps.InfoWindow({
              content: 'Vị trí bạn muốn chọn' +'<br>Latitude: ' + lat+
              '<br>Longitude: ' + lng
            });
            // marker.addListener('click', function() {
              infowindow.open(marker.get('map'), marker);
            }
        });
       }
   
</script>
<script type="text/javascript">
  $(document).ready(function() {

    $(".addDetail").click(function(){ 
      var html = $(".clone1").html();
      $(".increment1").after(html);
    });

    $("body").on("click",".btn-danger",function(){ 
      $(this).parents(".control-group").remove();
    });

    var a=$(".clone1");
    a.hide();
  });
</script>
@endsection
