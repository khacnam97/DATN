<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div style="margin-bottom: 80px;background-color: #dae0e5;height:300px;justify-content: center;align-items: center; margin-left: 100px;margin-right: 100px;-webkit-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);-moz-box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);box-shadow: 11px -8px 5px -2px rgba(0,0,0,1);">
	<h1 style="text-align: center;">{{$accept->restaurant}}</h1>
	<div style="text-align: center;"><h4>{{$accept->nameuserOrder}} thân mến!</h4></div>
	<div style="text-align: center;">
		Lịch đặt ngày "{{$accept->order_date}}"của bạn đã được xác nhận từ địa điểm "{{$accept->restaurant}}" 
	</div >
	<div>
		<h4><i class="fa fa-calendar"></i> Lịch đặt của bạn</h4>
		<div>Thời gian đặt lịch {{$accept->order_time}} vào ngày {{$accept->order_date}}</div>
		<div>
			<button class="btn-info"><a href="http://127.0.0.1:8000/account/myorder">Chi tiết lịch đặt</a></button>
		</div>
	</div>
	
</div>