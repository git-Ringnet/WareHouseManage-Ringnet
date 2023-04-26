<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
          <a href="{{route('admin.add')}}" class="btn btn-primary">
            Thêm nhân viên
          </a>
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
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Mã nhân viên</th>
                    <th>Họ tên nhân viên</th>
                    <th>Vai trò</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($usersList as $value)
                  <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}
                    </td>
                    <td>{{$value->role_name}}</td>
                    <td>{{$value->phonenumber}}</td>
                    <td>{{$value->email}}</td>
                    <td>{!!$value->status==0?'<button type="submit" class="btn btn-sm btn-secondary">Active</button>':' <button type="submit" class="btn btn-sm btn-primary">Disable</button>'!!}</td>
                    <td class="text-center"><span><a class="btn btn-primary" href="{{route('admin.edit',['id'=>$value->id])}}">Edit</a><form style="margin-left: 20px;"  onclick="return confirm('Bạn có chắc chắn muốn xoá !!')" action="{{route('admin.delete')}}" method="get" enctype="multipart/form">
									@csrf
                             <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
                              <input type="hidden" name="id" value="{{$value->id}}" />
                              </form></span></td>
                  </tr>
                  @endforeach
              </table>
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