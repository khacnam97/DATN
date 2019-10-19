@extends('layouts.admin')
@section('content')
<h1>Detail Restaurant</h1>


<form action="{{route('admin.restaurant.detail', $restaurant->id)}}" method="get">
	{{csrf_field()}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label for="name">Tên địa điểm tổ chức</label>
    <input type="text" name="name" value="{{ $restaurant->name }}" disabled="" class="form-control" required autocomplete="name">
  </div>
  
  
    <div class="form-group">
      <label for="">Address</label>
      <input id="text" type="text" name="address" value="{{ $restaurant->address }}" class="form-control" required autocomplete="address" disabled="">
    </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="">Phone</label>
      <input type="text" class="form-control" name="phone" disabled="" value="{{$restaurant->phone}}">

    </div>
    <div class="form-group col-md-3">
      <label for="">District</label>
      <input type="text" class="form-control" name="district_id" disabled="" value="{{$restaurant->district->name}}">

    </div>
    <div class="form-group col-md-3">
      <label for="">City</label>
      <input type="text" name="" class="form-control" value="Đà Nẵng" disabled="" disabled="">
    </div>
    
  </div>
  <div class="form-group ">
    <label for="">Map</label>
    
    <div id="map"> </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <input type="hidden" value="{{$restaurant->lat}}" class="form-control input-sm" name="lat" id="lat" required="" disabled="">
    </div>
    <div class="form-group col-md-3">
      <input type="hidden" value="{{$restaurant->lng}}" class="form-control input-sm" name="lng" id="lng" required="" disabled="">
    </div>
  </div> 
  <a href="/admin/restaurant"  class="btn btn-danger" style="color: white">Cancel</a>
  
</form>




<style type="text/css">
  #map{
    border:1px solid red;
    
    height: 500px;
  }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8&libraries=places&callback=initAutocomplete"
async defer></script>

<script type="text/javascript">

  var latvalue = {!! json_encode($restaurant->lat) !!}; 
  var lngvalue = {!! json_encode($restaurant->lng) !!};
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
    var marker = new google.maps.Marker({position: pos, map: map });
    var infowindow = new google.maps.InfoWindow({
      content:'<b>Tên địa điểm:</b> '+namevalue+ '<br><b>Địa chỉ:</b>'+addressvalue+ '<br>Vị trí địa điểm: ' +'Lat :' + latvalue+
      ' Longt: ' + lngvalue
    });
    infowindow.open(map,marker); 

  }

</script>
@endsection
