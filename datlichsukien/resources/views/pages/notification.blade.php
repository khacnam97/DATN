@extends('layouts.app')
@section('content')
<div class="container"  id="show_profile" style="margin-top: 100px; margin-bottom: 230px;display:flex; justify-content: center;">
<div style="width: 800px; background-color: #ffffff; -webkit-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);-moz-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);
        box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);">
<h2 style="text-align: center;">Thông báo </h2>
@foreach(Auth::user()->unreadNotifications as $notification)
    <a href="{{$notification->data['link']}}" id="notify" class="dropdown-item" style="text-align: center; "> <span style="font-size:20px;">{{$notification->data['message']}}</span></a>
 @endforeach
  @foreach(Auth::user()->Notifications as $notification)
  @if($notification->read_at !=NULL)
  <a href="{{$notification->data['link']}}"  id="notify" class="dropdown-item" style="background-color:lightgrey;text-align: center;"> {{$notification->data['message']}}</a>
  @endif
    @endforeach
</div>
</div>
@endsection