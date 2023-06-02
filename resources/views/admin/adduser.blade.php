<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluided">
      <div class="row mb-2">
      </div>
    </div><!-- /.container-fluided -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluided">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            @if ($errors->any())
            <div class="alert alert-danger">Dữ liệu nhập vào không đúng</div>
            @endif

            <div class="card-body p-3">
              <form action="" method="post">
                @csrf
                <div class="mb-3">
                  <label for="">Họ và tên</label>
                  <input type="text" class="form-control" name="name" placeholder="Họ và tên" value="{{old('name')}}">
                  @error('name')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Nhập email" value="{{old('email')}}">
                  @error('email')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Mật khẩu</label>
                  <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                  @error('password')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Vai trò</label>
                  <select class="form-control" name="role" id="">
                    <option value="0">Chọn chức vụ</option>
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" {{old('role')==$role->id?'selected':false}}>{{$role->name}}</option>
                    @endforeach
                  </select>
                  @error('role')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Số điện thoại</label>
                  <input type="number" class="form-control" name="phonenumber" placeholder="Số điện thoại" value="{{old('phonenumber')}}">
                  @error('phonenumber')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="pwd">Trạng thái:</label>
                  <select name="status" class="form-control">
                      <option value="1">Active</option>
                      <option value="0">Disable</option>
                  </select>
              </div>
              <div class="btn-fixed">
                <button type="submit" class="btn btn-primary">Thêm</button>
                <a href="{{route('admin.userslist')}}" class="btn btn-default">Quay lại</a>
              </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluided -->
  </section>
  <!-- /.content -->
</div>
</body>

</html>