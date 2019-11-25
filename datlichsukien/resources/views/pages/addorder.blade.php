<div class="modal fade" id="exampleModal22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5 style="text-align: center;">{{$data[0]->restaurant}}</h5>
        <form action="{{route('order.add')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token()}}">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Thời gian tổ chức</label>
            
              <div class="col-sm-6" >
                 <input class="form-control" type="text" name="order_date" id="test" readonly>
              </div>    
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Thời gian tổ chức</label>
            
              <div class="col-sm-6" >
                <input type="text" class="form-control" name="time" required="" id="timepicker" style="height: 30px;">
              </div>
           
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Mức độ</label>
            <span>
                <input type="radio" name="gender" value="male"> Lớn
                <input type="radio" name="gender" value="female"> Vừa
                <input type="radio" name="gender" value="other"> Nhỏ
            </span>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Số lượng người</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="people_number" value="" required="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Mức giá mỗi bàn</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" value="" name="price_table" required="">
            </div>
          </div>
          @if(Auth::check()) 
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Địa chỉ</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" required="" >
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Số điện thoại</label>
            <div class="col-sm-6">
              <input class="form-control" name="phone" type="text" value="{{Auth::user()->phone}}" required="">
            </div>
          </div>
          @else
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Địa chỉ</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="address" value="" required="" >
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Số điện thoại</label>
            <div class="col-sm-6">
              <input class="form-control" name="phone" type="text" value="" required="">
            </div>
          </div>
          @endif
            <input class="form-control" name="restaurant_id" type="text" value="{{$data[0]->restaurant_id}}" required="" hidden="">
          <div class="form-group row" style="margin-bottom: 30px;">
            <div class="col" style="display: flex;justify-content: center;" >
              <button class="btn btn-info" type="submit" >Đặt lịch</button>
            </div>
          </div>   
        </form>      
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
 $('#timepicker').timepicker({
    format: 'h:m'
  });
</script>
