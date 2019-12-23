@extends('layouts.admin')
@section('content')
<h1>Chỉnh sửa lịch đặt</h1>
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

<form id="accecptform" action="{{route('admin.order.edit', $order->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="form-row">
      <div class="form-group col-md-6">
      <label for="Name" class="col-form-label">Tên người đặt </label>
          <select class="custom-select" name="user_id" id="user_id">
          <option value="{{$order->user_id}}">{{$order->user->name}}</option>
          @if($user)
          @foreach ($user as  $record)
          <option value="{{$record->id}}">{{$record->name}}</option>
          @endforeach
          @endif
          
      </select>
       </div>
       <div class="form-group col-md-6">
      <label for="Restaurant" class="col-form-label">Địa điểm  </label>
        <input type="text" name="price_table" class="form-control" disabled="" value="{{$order->restaurant->name}}">
      </select>
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
            
            <input type="text"  class="form-control" name="room" value="{{$order->detail->room}}" placeholder="Tên khu" required="" disabled="">
          </div>
          <div class="form-group col-md-3">
            
            <input type="text" class="form-control" name="service" value="{{$order->detail->service}}" placeholder="Dịch vụ" required="" disabled="">
          </div>
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="peopleNumber" value="{{$order->detail->people_number}}" placeholder="Sức chứa của phòng" required="" disabled="">
          </div>
          <div class="form-group col-md-3">
            
            <input type="text"  class="form-control" name="peopleNumber" value="{{$order->detail->price}}" placeholder="Giá mỗi bàn" required="" disabled="">
          </div>
        </div>
        <label for="address" class="col-form-label">Địa chỉ người đặt </label>
        <input type="text" name="address" class="form-control" id="address" value="{{$order->address}}" required="" >
        <div class="row">
          <div class="form-group col-md-6">
            <label for="name" class="col-form-label">Thời gian tổ chức </label>
            <input type="text" name="order_time" class="form-control" id="timepicker" value="{{$order->order_time}}" required="">
          </div>
          <div class="form-group col-md-6">
            <label for="name" class="col-form-label"> Ngày tổ chức</label>
            <input type="text" name="order_date" class="form-control" id="datepicker" value="{{$order->order_date}}" required=""> 
          </div>
          
        </div> 
        <div class="row">
          
          <div class="form-group col-md-4">
            <label for="name" class="col-form-label"> Số lượng lượng người </label>
            <input type="text" name="people_number" class="form-control" id="peonumber" value="{{$order->people_number}}" required=""> 
          </div>
          <div class="form-group col-md-4">
            <label for="name" class="col-form-label"> Giá mỗi bàn  </label>
            <input type="text" name="price_table" class="form-control" id="price" value="{{$order->price_table}}" required=""> 
          </div>
          <div class="form-group col-md-4">
            <label for="name" class="col-form-label"> Số điện thoại người đặt  </label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{$order->phone}}" required=""> 
          </div>
        </div> 
        <button id="buttonsave" type="submit" class="btn btn-success"  >Chỉnh sửa</button>
        </form>
      </div>
    </div>
  </div>
</div>
 <script>
        $('#datepicker').datepicker({
            format: 'yyyy-dd-mm',
            uiLibrary: 'bootstrap4'
        });
    </script>
<script>
        $('#timepicker').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection



