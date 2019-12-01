<head>
	<title>Thêm bài viết</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.css')}}">
	<style type="text/css">
		.gallery img{
			margin-top: 20px;
			width: 200px;
			height: 200px;
			padding-right: 20px;
		}
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
</head>

@extends('layouts.app')
@section('content')

<div class="container" style="margin-top: 60px; text-align: left;">


	<h3 class="text-center"> Thêm bài viết </h3>
	@if (session('success'))
	<div class="alert alert-success">
		{{ session('success') }}
	</div>
	@endif
	@if (session('error'))
	<div class="alert alert-danger">
		{{ session('error') }}
	</div>
	@endif
	<form action="{{route('account.addpost')}}" method="post" enctype="multipart/form-data">
		<input type="hidden" name="_token" value="{{ csrf_token()}}">

		<div class="input-group control-group increment form-row" >
			<div class="form-group col-md-4">
				<input type="text"  class="form-control" name="room" placeholder="Tên phòng" required="" >
			</div>
            <div class="form-group col-md-4">
            	<input type="text" class="form-control" name="service" placeholder="Dịch vụ" required="">
            </div>
            <div class="form-group col-md-3">
            	<input type="text"  class="form-control" name="peopleNumber" placeholder="Sức chứa của phòng" required="">
            </div>
          
          <div class="input-group-btn">  
            <button class="btn btn-primary add" type="button"><i class="glyphicon glyphicon-plus" id="add"></i>Thêm </button>
          </div>
        </div>
        <div class=" clone" style="overflow: hidden;">
          <div class="control-group input-group form-row" style="margin-top:10px">
            <div class="form-group col-md-4">
				<input type="text" name="room" class="form-control"   >
			</div>
            <div class="form-group col-md-4">
            	<input type="text" name="service" class="form-control" >
            </div>
            <div class="form-group col-md-3">
            	<input type="text" name="peopleNumber" class="form-control" >
            </div>
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove" id="removed"></i> Xóa</button>
            </div>
          </div>
        </div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label  for="name" class="col-form-label" > Tên địa điểm(<span style="color: red">*</span>) </label>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required="" value="{{ old('name') }}" placeholder="Tên địa điểm" autocomplete="off">
				@error('name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>

			<div class="form-group col-md-6">
				<label  for="name" class="col-form-label" > Địa chỉ(<span style="color: red">*</span>) </label>
				<input type="text"  class="form-control @error('address') is-invalid @enderror" placeholder="Full address" name="address" id="address" required="" value="{{ old('address') }}">
				@error('address')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror

			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6"  >
				<label  for="name" class="col-form-label" > Quận - Huyện (<span style="color: red">*</span>)</label>
				<select class="custom-select" name="district_id" id="district">
				
					@if($district)
					@foreach ($district as  $record)
					<option value="{{$record->id}}">{{$record->name}}</option>
					@endforeach
					@endif
					
			   </select>
			</div>
			<div class="form-group col-md-6">
				<label  for="name" class="col-form-label" > Tỉnh - Thành phố (<span style="color: red">*</span>) </label>
				<input type="text" autocomplete="off"  class="form-control" name="city" id="city" required="" value="Đà Nẵng " placeholder="Tỉnh-Thành phố" disabled="">
			</div>
		</div>

		
		<div class="form-row">
			<div class="form-group col-md-3">
				<input type="hidden"  class="form-control input-sm" name="lat" id="lat" required="">
			</div>
			<div class="form-group col-md-3">
				<input type="hidden" class="form-control input-sm" name="lng" id="lng" required="">
			</div>
		</div>
		<div class="form-group">
			<label class="col-form-label "> Số điện thoại (<span style="color: red">*</span>) </label>
			<input type="tel" class="form-control col-md-8 @error('phone') is-invalid @enderror "  placeholder="034567890" name="phone" id="phone" value="{{ old('phone') }}">
			@error('phone')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
		<div class="form-group">
			<label class=" col-form-label @error('title') is-invalid @enderror">Title bài đăng (<span style="color: red">*</span>)</label>
			<input type="text" class="form-control col-md-8" placeholder="Tiêu đề bài viết" name="title" id="title" required="" value="{{ old('title') }}" >
			@error('title')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
		<div class="form-group">
			<label for="textarea"> Mô tả chi tiết (<span style="color: red">*</span>)</label>
			<textarea class="form-control" rows="10" id="editor1" name="descrice" required>{{ old('descrice') }}</textarea>
			@error('descrice')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
        <div class="form-group ">
			<label for="">Bản đồ</label>
			<input id="pac-input" style="width: 500px;" class="controls" type="text" placeholder="Search Box" >
			<div id="map"></div>
		</div>

		<h5 class="form-control-label"> Thêm ảnh cho bài viết (<span style="color: red">*</span>)</h5>
		<div class="form-control-file">
			<input multiple type="file"  id="gallery-photo-add" class="form-control" name="filename[]" required="" accept="image/x-png,image/jpeg">
			@error('filename')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
			<div class="gallery" style="display: flex; width: 200px;height: 200px;">
			</div>	
		</div>				

		<div style=" margin-top: 100px; margin-bottom: 50px;">
			<button type="submit" class="btn btn-primary" style="width: 100px;" >Đăng bài</button>
			<button type="reset" class="btn btn-dark" style="width: 100px;" id="reset"> Reset</button>
		</div>
	</form>


</div>


<script type="text/javascript">

	$(document).ready(function() {

		$('#reset').on('click', function(){
			$('.gallery img').hide();		
		})

		
	    
	});
	$('#gallery-photo-add').on('click', function() {
		$('.gallery img').hide();
	});

	$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

    	if (input.files) {
    		var filesAmount = input.files.length;

    		for (i = 0; i < filesAmount; i++) {
    			var reader = new FileReader();

    			reader.onload = function(event) {
    				$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
    			}

    			reader.readAsDataURL(input.files[i]);
    		}
    	}

    };


    $('#gallery-photo-add').on('change', function() {
    	var a = $('div.gallery img');
    	a.hide();
    	imagesPreview(this, 'div.gallery');
    });
    //add ck editor
    CKEDITOR.replace('editor1');
	});
	

</script>

{{-- gg map by nam --}}
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
							infowindow.open(marker.get('map'), marker);
                  }
				});			
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
         

		}
	}
</script>
        <script type="text/javascript" src="{{asset('ckeditor/adapters/jquery.js') }}"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt5tJTim4lOO3ojbGARhPd1Z3O3CnE-C8&libraries=places&callback=initAutocomplete"async defer></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
	//autocomplete địa điểm
    var routes = "{{ route('post.autocomplete')}}";
    $('#name').typeahead({
        source:  function (term, process) {
        return $.get(routes, { term: term }, function (data) {
                return process(data);
            });
        },
        //auto điền thông tin nếu place trùng
        afterSelect: function(place){
        	var place = $('#name').val();
        	$.ajax({
        		url: "{{route('post.autocompleteAddress')}}",
        		type: 'get',
        		dataType: 'json',
        		data: {term:place},
        		success: function(data){
	        		if(data.length !=0){
	    				$("#showquan").css({'display':'block'});
	        			$('#district').val(data.districtname);
	        			$('#address').val(data.address)
        			}
        		}
        	})
        }
    });
       
</script>
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

      

    });
</script>
@endsection
