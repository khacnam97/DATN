@extends('layouts.admin')
@section('content')
<div class="container">
   @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
	<FORM >
	@csrf
	<div style="display: flex;">
		<div class="form-group">
	    	<label >Id:</label>
	    	<input type="number"  value="{{$post->id}}" disabled="true" class="form-control" id="userid " name="userid">

	  	</div>
		<div class="form-group " style="margin-left: 50px;" >
	    	<label >User:</label>
	    	<input type="" value="{{$post->user->name}}" disabled="true" class="form-control @error('userid') is-invalid @enderror" id="userid " name="userid">
	  	</div>
      <div class="form-group" style="margin-left: 50px;">
        <label >Is Approved:</label>
         @if($post->is_approved==1)
        <input type="" value="Approved" disabled="true" class="form-control" id="userid " name="userid">
        @else
         <input type="" value="UnApproved" disabled="true" class="form-control" id="userid " name="userid">
        @endif
      </div>
      <div class="form-group col-sm-5"  style="margin-left: 50px";>
        <label >Restaurant:</label>
        <input type="" value="{{$post->restaurant->name}}" disabled="true" class="form-control" id="restaurantid" name="restaurantid">
      </div>
	</div>
  <div class="col-form-label  form-row" >
          <div class="form-group col-md-4">
            <label>Tên khu</label>
          </div>
          <div class="form-group col-md-4">
            <label>Dịch vụ</label>
          </div>
          <div class="form-group col-md-4">
            <label>Sức chứa</label>
          </div>
          </div>
       @foreach ($detail as $record)
        <div class="input-group control-group  form-row" >
      
          <div class="form-group col-md-4">
            
            <input type="text"  class="form-control" name="room[]" value="{{$record->room}}" placeholder="Tên khu" required="" disabled="">
          </div>
          <div class="form-group col-md-4">
            
            <input type="text" class="form-control" name="service[]" value="{{$record->service}}" placeholder="Dịch vụ" required="" disabled="">
          </div>
          <div class="form-group col-md-4">
            
            <input type="text"  class="form-control" name="peopleNumber[]" value="{{$record->people_number}}" placeholder="Sức chứa của phòng" required="" disabled="">
          </div>
        </div>
        @endforeach
	<div class="form-group">
    	<label for="">Title:</label>
    	<input type="text" value="{{$post->title}}" disabled="true" class="form-control" id="title" name="title">
  	</div>
	<div class="form-group">
    	<label for="">Descrice:</label>
  		<textarea class="form-control" disabled="true" rows="5" id="descrice" name="descrice">{!!$post->describer!!} </textarea> 
  	</div>

    {{-- show all photo --}}
   	<h5>All photo</h5>
    <div class="form-group">
    	<div >

    		@foreach($post->photos as $p)
    		<img src="{{"/".$p->photo_path}}" alt="{{"/".$p->photo_path}}" style="width: 100px; height: 100px; background-repeat: no-repeat;">
    		@endforeach

    	</div>

    </div>

  
	</FORM>
    <div class="row" style="margin: 50px 40% 50px ">
      <div class="">
        <a href="{{route('admin.post.showedit',$post->id)}}" class="btn  btn-info nav-link"> Edit</a>
        
      </div>
      <form method="post" action="{{ route('admin.post.delete', $post->id)}}" class="">
          @csrf
          <button type="submit" class="btn btn-danger nav-link" role='button' onclick="return confirm('Bạn có muốn xóa bản ghi này?')" style="margin-left: 10px;"> Delete</button>
      </form>
    </div>

{{-- script add muti image --}}
</div>
<script type="text/javascript">

    $(document).ready(function() {

      $(".add").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>
@endsection