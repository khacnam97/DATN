@extends('layouts.admin')
<!-- @section('title', '/ User') -->
@section('content')



<div class="card mb-3">
  <div class="card-header">
    <em class="fas fa-table"></em>
  Data Table User </div>

  <div class="container">

    <!-- The Modal -->
    <div class="modal" id="myModal1">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Thêm User </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          

          <!-- Modal body -->
          <div class="modal-body">
            <form action="" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token()}}">
              <div class="form-group">
                <label for="">Username </label>
                <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}"    required autofocus >
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  >
              </div>
              <div class="form-group">
                <label for="">Passwword</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   >
              </div>
              <div class="form-row">
                
                <div class="form-group col-md-5">
                  <label for="inputState">Role</label>
                  <select id="inputState" class="form-control" name="role">
                    <option selected value="3">Người xem</option>
                    <option value="2">Người đăng bài</option>
                    <option value="1">admin</option>
                  </select>
                </div>
                
              </div>
              
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              
            </form>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            
          </div>

        </div>
      </div>
    
    </div>
  </div>
    
  <div class="card-body">
    <div style="margin-bottom: 15px">
      <button data-toggle="modal" data-target="#myModal1" class="btn btn-success "><i class="fas fa-plus"></i> ADD</button>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Create day</th>
            <th>Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>Create day</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
       
        <tr>
         
            <td align="center">
              
              
                      <button class="btn-success">
                       
                      <a href="" onclick="return confirm('Bạn có muốn block user này?')" role="button"  style="color: white;text-decoration: none;" > Block</a>
                    </button>
                   
                    <button class="btn-success">
                     
                      <a href="" onclick="return confirm('Bạn có muốn unblock user này??')" role="button" style="color: white;text-decoration: none;" > UnBlock</a>
                    </button>
                    
                
              <button type="button" class="btn-info " data-toggle="modal" data-target="#myModal">
                 <a class="btn-info" href="" style="color: white;text-decoration: none;">Edit</a>
              </button>

              <!-- The Modal -->
              
              <button type="button" class="btn-danger" >
              <a href="" style="color: white;text-decoration: none;" onclick="return confirm ('bạn có muốn xóa user ')">Delete</a>
              </button>
                            
              
            
            </td>
        </tr>
       
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection