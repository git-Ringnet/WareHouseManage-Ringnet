<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            @if ($errors->any())
            <div class="alert alert-danger">Dữ liệu nhập vào không đúng</div>
            @endif
            <div class="card-body">
              <form action="" method="post">
                @csrf
                <div class="mb-3">
                  <label for="">Họ và tên</label>
                  <input type="text" class="form-control" name="name" placeholder="Họ và tên" value="{{old('name')?? }}">
                  @error('name')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Họ và tên">
                  @error('email')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                  @error('password')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Role</label>
                  <select class="form-control" name="role" id="">
                    @foreach($roles as $role)
                    <option value="{{$role->id}}" >{{$role->name}}</option>
                    @endforeach
                  </select>
                  @error('role')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="">Phone</label>
                  <input type="text" class="form-control" name="phonenumber" placeholder="Số điện thoại">
                  @error('phonenumber')
                  <span style="color:red">{{$message}}</span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{route('admin.userslist')}}" class="btn btn-warning">Quay lại</a>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
</body>

</html>