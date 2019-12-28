<head>
	<title>edit post</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.css')}}">
	<style type="text/css">
		.gallery img{
			margin-top: 20px;
			width: 150px;
			height: 150px;
			padding-right: 20px;
		}
	</style>
</head>

@extends('layouts.app')
	@section('content')
		<div class="container" style="margin-top: 100px; text-align: left;">
			<h3 class="text-center"> Chỉnh sửa bài đăng</h3>
			  	@if(count($errors)>0)
			   		<div class="alert alert-danger">
			    	@foreach($errors->all() as $err)
			    		{{$err}} <br>
			    	@endforeach
			    	</div>
			  	@endif
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
			<FORM   action="{{route('account.editpost', [$idpost=$post->id] )}}" method="post" enctype="multipart/form-data" id="formedit">
				@csrf
				

				<div class="form-row " >
					<div class="form-group col-md-6">
						<label  for="address" class="col-form-label  "> Tên địa điểm </label>
						<input type="text"  class="form-control "  value="{{$post->restaurant->name}}" placeholder="Tên đại điểm" name="name" id="name" required="" >
					
					</div>
					<div class="form-group col-md-6">
						<label  for="address" class="col-form-label  "> Địa chỉ cụ thể</label>
						<input type="text"  class="form-control  @error('address') is-invalid @enderror"    value="{{$post->restaurant->address}}" placeholder="Phường(Xã)-Quận(Huyện)-Tỉnh(ThànhPhố)" name="address" id="address" required="" >
							@error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
					
					</div>
					<div class="form-group col-md-6">
						<label  for="name" class="col-form-label" > Quận - Huyện </label>
						
						<select class="custom-select" name="district_id" id="district">
				        <option value="{{$post->restaurant->district_id}}">{{$post->restaurant->district->name}}</option>
				        @if($district)
				        @foreach ($district as $ca)
				        <option value="{{$ca->id}}">{{$ca->name}}</option>
				        @endforeach
				        @endif
				      	</select>
					</div>
					<div class="form-group col-md-6">
						<label  for="name" class="col-form-label" > Tỉnh - Thành phố </label>
						<input type="text" autocomplete="off"  class="form-control" name="city" id="city" required="" value="Đà Nẵng" placeholder="Tỉnh-Thành phố" disabled="">
						
					</div>
					

				</div>
				<label  for="name" class="col-form-label" >Điền thông tin (<span style="color: red">*</span>) </label>
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
				 
				<div class="input-group control-group increment form-row" >
		          
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
		            <div class="form-group col-md-3">
		            	<input type="text" name="price[]" class="form-control" placeholder="Giá mỗi bàn">
		            </div>
		            <div class="input-group-btn"> 
		              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove" id="removed"></i> Xóa</button>
		            </div>
		          </div>
		        </div>
				<div class="form-group">
					<label class="col-form-label "> Số điện thoại </label>
					<input type="tel" class="form-control col-md-8 @error('phone') is-invalid @enderror "  placeholder="034567890"  value="{{$post->restaurant->phone}}" name="phone" id="phone">
						@error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-form-label @error('title') is-invalid @enderror"> Title bài đăng </label>
					<input type="text" class="form-control col-md-8" placeholder="" name="title" id="title" required=""  value="{{$post->title}}">
						@error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
				</div>
				<div class="form-group">
					<label for="textarea"> Mô tả chi tiết </label>
					<textarea class="form-control" rows="15" id="editor1" name="descrice" required>{{ $post->describer }}</textarea >
						
				</div>

				<h5 class="form-control-label"> Thêm ảnh khác cho bài viết</h5>
				<div class="form-control-file">
					<input multiple type="file"  id="gallery-photo-add" class="form-control" name="filename[]" accept="image/x-png,image/jpeg" >

								<div class="gallery" style="display: flex; width: 200px;height: 200px;">
								</div>	
				</div>
				<h5> Chỉnh sửa các ảnh cũ</h5>		
				<div class="form-group">
			       <input type="text" value="" style="display: none ;"  class="form-control" id="p1" name="p1">
			    </div>		
				<div class="form-group">
					<div class="form-group d-flex" >
					 @foreach($post->photos as $p)
			          	<div id="{{$p->id}}" class="{{$p->id}}" style="display: flex; width: 150px; height: 150px; background-image: url({{"/".$p->photo_path}}); background-repeat: no-repeat; background-size: cover; margin-left: 10px;" >
				            <button id="{{$p->id}}" class="{{$p->id}} btn-success"   type="button"  style="background-image:url('https://png.pngtree.com/svg/20170521/cancle_1301160.png') ; width: 25px; height: 25px; background-repeat: no-repeat; margin: 0; padding: 0; " >
				            	X
				            </button>
				            <script type="text/javascript">
				            	$(document).ready(function(){
	                			$(".{{$p->id}}").click(function(){
					                var x =$(".{{$p->id}}");	
					                x.hide();
					                var t = document.getElementById("p1").value;
					                document.getElementById("p1").value = t +  "{{$p->id}}/";
					            });  
					            }) 
			                </script>
			              	
			          </div>
			        @endforeach
			        </div>

				</div>
				<div class="d-flex">
					<div class="justify-content-center" style="margin-left: 45% ; margin-bottom: 50px;">
						<button type="submit" class="btn btn-primary text-center"  id="submit">Lưu lại</button>
						<button type="reset" class="btn btn-dark" id="btnreset" onclick="return confirm('Có thay đổi cần lưu, bạn có chắc chắn thoát?')">Reset</button>

					</div>
				</div>
			</FORM>

		</div>


<script type="text/javascript">

    $(document).ready(function() {

	    //ckeditor
	    CKEDITOR.replace('editor1');

	    //reset all form
	    $("#btnreset").click(function(){
	    	var t = document.getElementById("p1").value;
	    	$('#formedit').trigger("reset");
	    	$('.gallery img').hide();
	    	var splitted = t.split("/");
	    	for(i=0; i<splitted.length; i++){
	    		var xmt = splitted[i];
				 //$("#splitted[i]").css("display", "block");
				 document.getElementById(xmt).style.display = 'flex';
	    	}

	    })
	    $("#city").on('click',function(){
	    	$('#district').val('');
	    	$('#district').prop('readonly', false);
	    })

	    //ckeck lỗi nhập trk khi submit
	    $('#submit').on('click', function(){
	    	$('#errotinh').css('display') ;
	    	if($('#errotinh').css('display') == "block" || $('#errohuyen').css('display') == 'block'){
	    		alert("Erro, vui lòng kiểm tra lại thông tin");
	    		return false;
	    	}
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
        imagesPreview(this, 'div.gallery');
    });
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




