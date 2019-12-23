@extends('layouts.admin')
@section('content')
<h1>Chỉnh sửa chi tiết địa điểm </h1>
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

@if(Session::has('success'))
<div class="alert alert-success">
  {{Session::get('success')}}
</div>
@endif

<form id="accecptform" action="{{route('admin.detail.edit', $detail->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="row">
    <div class="form-group col-md-6">
      <label>Địa điểm </label>
      <input type="text"  class="form-control" name="peopleNumber" value="{{$detail->restaurant->name}}"disabled="">
    </div>
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
      
        <div class="input-group control-group  form-row" >
      
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="room" value="{{$detail->room}}" placeholder="Tên khu" required="" >
          </div>
          <div class="form-group col-md-3">
            
            <input type="text" class="form-control" name="service" value="{{$detail->service}}" placeholder="Dịch vụ" required="" >
          </div>
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="peopleNumber" value="{{$detail->people_number}}" placeholder="Sức chứa của phòng" required="" >
          </div>
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="price" value="{{$detail->price}}" placeholder="Giá mỗi bàn" required="" >
          </div>
        </div>
       
        <button id="buttonsave" type="submit" class="btn btn-success"  >Chỉnh sửa</button>
        </form>
      </div>
    </div>
  </div>
</div>
 
  
@endsection



