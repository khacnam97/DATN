
<div class="modal fade" id="exampleModal22" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
        <h5 style="text-align: center;">{{$data[0]->restaurant}}</h5>
        <form action="{{route('order.add')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token()}}">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Thời gian tổ chức</label>
            
              <div class="col-sm-8" >
                 <input class="form-control" type="text" name="order_date" id="test" readonly>
              </div>    
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Chọn loại phòng</label>
            <div class="col-8">
              
              <div class="col-sm-12">
                <div > 
                  <label style="width: 110px; ">Tên khu</label> 
                  <label style="width: 110px;">Dịch vụ</label>
                  <label style="width: 110px;">Sức chứa</label>
                  <label style="width: 110px;">Giá mỗi bàn</label></div>
                <div class="dropdown-divider col-sm-12"></div>
                <div id="arrdetail">
                  s
                </div>
                <div id="arrdetail1" style="opacity: 0.6;filter: alpha(opacity=20);">
                  s
                </div>
              </div>
             
            </div>
            
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Thời gian tổ chức</label>
            
              <div class="col-sm-8" >
                <input type="text" class="form-control" name="time" required="" id="timepicker" >
              </div>
           
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Số lượng người</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" name="people_number" value="" placeholder="Số lượng người tham dự" required="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Mức giá mỗi bàn</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" value="" name="price_table" placeholder="VNĐ" required="">
            </div>
          </div>
          @if(Auth::check()) 
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Địa chỉ</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" name="address" placeholder="Địa chỉ của bạn"  value="{{Auth::user()->address}}" required="" >
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Số điện thoại</label>
            <div class="col-sm-8">
              <input class="form-control" name="phone" type="text" placeholder="Số điện thoại "  value="{{Auth::user()->phone}}" required="">
            </div>
          </div>
          @else
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Địa chỉ</label>
            <div class="col-sm-8">
              <input class="form-control" type="text" name="address" placeholder="Địa chỉ của bạn" value="" required="" >
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label form-control-label">Số điện thoại</label>
            <div class="col-sm-8">
              <input class="form-control" name="phone" type="text" placeholder="Số điện thoại " value="" required="">
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
<script>
        $('#timepicker').timepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
