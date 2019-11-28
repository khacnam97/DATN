@extends('layouts.admin')
@section('content')
<h1>Edit Order</h1>
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
      <label for="Name" class="col-form-label">Name </label>
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
      <label for="Restaurant" class="col-form-label">Restaurant </label>
          <select class="custom-select" name="restaurant_id" id="restaurant_id">
          <option value="{{$order->restaurant_id}}">{{$order->restaurant->name}}</option>
          @if($restaurant)
          @foreach ($restaurant as  $record)
          <option value="{{$record->id}}">{{$record->name}}</option>
          @endforeach
          @endif
          
      </select>
       </div>
    </div>
        <label for="address" class="col-form-label">Address </label>
        <input type="text" name="address" class="form-control" id="address" value="{{$order->address}}" required="" >
        <div class="row">
          <div class="form-group col-md-6">
            <label for="name" class="col-form-label">Time </label>
            <input type="text" name="order_time" class="form-control" id="timepicker" value="{{$order->order_time}}" required="">
          </div>
          <div class="form-group col-md-6">
            <label for="name" class="col-form-label"> Date</label>
            <input type="text" name="order_date" class="form-control" id="datepicker" value="{{$order->order_date}}" required=""> 
          </div>
          
        </div> 
        <div class="row">
          
          <div class="form-group col-md-4">
            <label for="name" class="col-form-label"> Number people  </label>
            <input type="text" name="people_number" class="form-control" id="peonumber" value="{{$order->people_number}}" required=""> 
          </div>
          <div class="form-group col-md-4">
            <label for="name" class="col-form-label"> Price  </label>
            <input type="text" name="price_table" class="form-control" id="price" value="{{$order->price_table}}" required=""> 
          </div>
          <div class="form-group col-md-4">
            <label for="name" class="col-form-label"> Phone  </label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{$order->phone}}" required=""> 
          </div>
        </div> 
        <button id="buttonsave" type="submit" class="btn btn-success"  >Edit</button>
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
  $(document).ready(function(){
   $("#changePasword").change(function(){
    if($(this).is(":checked"))
    {
      $(".password").removeAttr('disabled');
    }
    else{
      $(".password").attr('disabled','');
    }
  });
 });
</script>
<script>
        $('#timepicker').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection



