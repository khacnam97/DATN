@extends('layouts.admin')
@section('content')
<h1>Chi tiết Địa điểm</h1>


<form action="{{route('admin.restaurant.detail', $restaurant->id)}}" method="get">
	{{csrf_field()}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label for="name">Tên địa điểm tổ chức</label>
    <input type="text" name="name" value="{{ $restaurant->name }}" disabled="" class="form-control" required autocomplete="name">
  </div>
  
  
    <div class="form-group">
      <label for="">Địa chỉ địa điểm</label>
      <input id="text" type="text" name="address" value="{{ $restaurant->address }}" class="form-control" required autocomplete="address" disabled="">
    </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="">Số điện thoại</label>
      <input type="text" class="form-control" name="phone" disabled="" value="{{$restaurant->phone}}">

    </div>

       @foreach ($detail as $record)
        <div class="input-group control-group  form-row" >
      
          <div class="form-group col-md-3">
             <label>Tên khu</label>
            <input type="text"  class="form-control" name="room[]" value="{{$record->room}}" placeholder="Tên khu" required="" disabled="">
          </div>
          <div class="form-group col-md-3">
             <label>Dịch vụ</label>
            <input type="text" class="form-control" name="service[]" value="{{$record->service}}" placeholder="Dịch vụ" required="" disabled="">
          </div>
          <div class="form-group col-md-3">
             <label>Sức chứa</label>
            <input type="text"  class="form-control" name="peopleNumber[]" value="{{$record->people_number}}" placeholder="Sức chứa của phòng" required="" disabled="">
          </div>
          <div class="form-group col-md-3">
             <label>Giá mỗi bàn</label>
            <input type="text"  class="form-control" name="price[]" value="{{$record->price}}" placeholder="Giá mỗi bàn" required="" disabled="">
          </div>
        </div>
        @endforeach
    <div class="form-group col-md-3">
      <label for="">Quận,huyện</label>
      <input type="text" class="form-control" name="district_id" disabled="" value="{{$restaurant->district->name}}">

    </div>
    <div class="form-group col-md-3">
      <label for="">Thành phố</label>
      <input type="text" name="" class="form-control" value="Đà Nẵng" disabled="" disabled="">
    </div>
    
  </div>
  <div class="form-group ">
    <label for="">Bản đồ</label>
    
    <div id="map"> </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <input type="hidden" value="{{$restaurant->lat}}" class="form-control input-sm" name="lat" id="lat" required="" disabled="">
    </div>
    <div class="form-group col-md-3">
      <input type="hidden" value="{{$restaurant->longt}}" class="form-control input-sm" name="lng" id="lng" required="" disabled="">
    </div>
  </div> 
  <a href="/admin/restaurant"  class="btn btn-danger" style="color: white">Thoát</a>
  
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
    var marker = new google.maps.Marker({position: pos, map: map });
    var infowindow = new google.maps.InfoWindow({
      content:'<b>Tên địa điểm:</b> '+namevalue+ '<br><b>Địa chỉ:</b>'+addressvalue+ '<br>Vị trí địa điểm: ' +'Lat :' + latvalue+
      ' Longt: ' + lngvalue
    });
    infowindow.open(map,marker); 

  }

</script>
@endsection
