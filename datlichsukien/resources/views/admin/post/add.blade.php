<div class="container">
    @if(count($errors) >0)
      <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          <li> {{$error}} </li>

        @endforeach
      </div>
      <script>
        $(document).ready(function(){
            $('#myModal3').modal('show')
        }
      </script>
    @endif
    @if(Session::has('errors'))
    <script>
        $(document).ready(function(){
            $('#myModal3').modal({show: true});
        }
    </script>
  @endif

  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
	<FORM method="post" class="" action="{{route('admin.post.add')}}" enctype="multipart/form-data">
	@csrf

	<div style="display: flex;" class="form-row">
		<div class="form-group col-md-6">
	    	<label >Tên người dùng :</label>
	    	@error('userid')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        <input class="form-control" type="text" name="userid" id="userid" value="{{old('userid')}}" required="">
        <div id="errouser" style="display: none;"> <span style="color: red"> Không tồn tại user </span></div>
	  	</div>
  	<div class="form-group col-md-6">
        <label for="">Số điện thoại</label>
        <input class="form-control" type="text" name="phone" id="phone" value="{{old('phone')}}" required="">  
    </div>
	</div>

	<div class="form-group">
    	<label for="">Địa điểm</label>
      <input class="form-control" type="text" name="restaurantid"  value="{{old('restaurantid')}}" required="">
      
  </div>
  <div class="form-group">
      <label for="">Địa chỉ</label>
      <input class="form-control" type="text" name="address" id="address" value="{{old('address')}}" required="">  
  </div>
 <div class="form-row">
    
     <div class="form-group col-md-6"  >
      <label for="">Quận ,huyện</label>
      <select class="custom-select" name="district_id" id="district">
        @if($district)
        @foreach ($district as  $record)
        <option value="{{$record->id}}">{{$record->name}}</option>
        @endforeach
        @endif   
      </select> 
     </div>
     <div class="form-group col-md-6"  >
       <label for="">Thành phố</label>
       <input class="form-control" type="text" name="" id="" value="Đà Nẵng" disabled=""> 
      </div>
  </div>
  <label  for="name" class="col-form-label" >Điền thông tin (<span style="color: red">*</span>) </label>
        
        <div class="input-group control-group increment form-row" >

      <div class="form-group col-md-3">
        <input type="text"  class="form-control" name="room[]" placeholder="Tên khu" value="{{ old('room[]') }}" required="" >
      </div>
            <div class="form-group col-md-3">
              <input type="text" class="form-control" name="service[]" placeholder="Dịch vụ" required="" value="{{ old('service[]]') }}">
            </div>
            <div class="form-group col-md-3">
              <input type="text"  class="form-control" name="peopleNumber[]" placeholder="Sức chứa của phòng" required="" value="{{ old('peopleNumber[]') }}">
            </div>
            <div class="form-group col-md-2">
              <input type="text"  class="form-control" name="price[]" placeholder="Giá mỗi bàn" required="" value="{{ old('price[]') }}">
            </div>
          
          <div class="input-group-btn">  
            <button class="btn btn-primary add" type="button"><i class="glyphicon glyphicon-plus" id="add"></i>Thêm </button>
          </div>
        </div>
        <div class=" clone" style="overflow: hidden;">
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
            <div class="form-group col-md-2">
              <input type="text" name="price[]" class="form-control" placeholder="Giá mỗi bàn">
            </div>
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove" id="removed"></i> Xóa</button>
            </div>
          </div>
        </div>
	<div class="form-group">
    	<label for="">Tiêu đề:</label>
    	<input type="text" class="form-control" id="title" name="title" required="" value="{{old('title')}}">
  	</div>
	<div class="form-group">
    	<label for="">Mô tả:</label>
      <textarea class="form-control" rows="3" id="describer" name="describer" required>{{old('describer')}}</textarea>
  	</div>
  <div class="form-group ">
    <label for="">Bản đồ</label>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map"> </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <input type="hidden" class="form-control input-sm" name="lat" id="lat" required="">
    </div>
    <div class="form-group col-md-3">
      <input type="hidden" class="form-control input-sm" name="lng" id="lng" required="">
    </div>
  </div>
	<div class="form-group form-check" style="display: flex;">
     	<input class="form-check-input" type="checkbox" name="checkbox" value="1">Đăng ngay:
  	</div>
  	<div class="custom-file" style="height: auto;">

 		<h5>Chọn ảnh</h5>
        <div class="input-group control-group increment" >
          <input type="file" name="filename[]" class="form-control" accept="image/x-png,image/jpeg" required="" accept="image|jpeg|x-png">
          <div class="input-group-btn">  
            <button class="btn btn-primary add" type="button"><i class="glyphicon glyphicon-plus" id="add"></i>Thêm</button>
          </div>
        </div>
        <div class=" clone" style="overflow: hidden;">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="filename[]" class="form-control" accept="image/x-png,image/jpeg">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove" id="removed"></i> Xóa</button>
            </div>
          </div>
        </div>


  	</div> 
  	<div class="">
      <div class="text-center" style="margin-top: 20px;">
  		  <button class="btn btn-success align-middle" type="submit" id="submit"> Xác nhận thêm</button>
      </div>
  	</div>
	</FORM>

{{-- script add muti image --}}
</div>
    {{-- include typeahead --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

      $(".add").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

      var ab=$(".clone");
      ab.hide();

      CKEDITOR.replace('describer');

      $("#submit").on('click',function(){
        if($("#errouser").css('display') == 'block' || $("#erroplace").css('display') == 'block'){
            alert("Erros! Vui lòng kiểm tra lại thông tin");
            return false;
          }
      }) 

    });

    $('#userid').typeahead({
        source:  function (term, process) {
        return $.get("{{ route('post.autocompleteUser')}}", { term: term }, function (data) {
            if(data.length == 0){
              $('#errouser').css('display', 'block');
            }
            else{
              $('#errouser').css('display','none');
            }
                return process(data);
            });
        }
    });

</script>
<style type="text/css">
  #map{
    border:1px solid red;
    
    height: 200px;
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
  var infowindow = new google.maps.InfoWindow;
  function initAutocomplete() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        $('#lat').val(position.coords.latitude);
        $('#lng').val(position.coords.longitude);
  
        var map = new google.maps.Map(document.getElementById('map'), {
          center: pos,
          zoom: 16,
          mapTypeId: 'roadmap'
        });
        // var marker = new google.maps.Marker({position: pos, map: map,draggable: true });
                
        var marker = new google.maps.Marker({
          position: pos,
          draggable: true,  
          map: map
        });
                var infowindow = new google.maps.InfoWindow({
            content: 'Vị trí của bạn ' +'<br>Latitude: ' + position.coords.latitude+
            '<br>Longitude: ' + position.coords.longitude
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
           lat =marker.getPosition().lat();
           lng =marker.getPosition().lng();

          $('#lat').val(lat);
          $('#lng').val(lng);
          if ( position.coords.latitude!=lat ||position.coords.longitude!=lng) {
            infowindow.close();
            infowindow = new google.maps.InfoWindow({
              content: 'Vị trí bạn muốn chọn' +'<br>Latitude: ' + lat+
            '<br>Longitude: ' + lng
            });
            // marker.addListener('click', function() {
              infowindow.open(marker.get('map'), marker);
            //});
                  }
        });
        
        
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
         

    }
  }
</script>