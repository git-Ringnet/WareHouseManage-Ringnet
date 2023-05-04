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
      <div class="row m-auto filter">
        <form class="w-100" action="" method="get">
            <div class="row">
              <div class="col-2 d-none">
                <select class="form-control" name="roleid" id="">
                    <option value="0">Vai trò</option>
                    @if(!empty($roles))
                    @foreach($roles as $role)
                    <option value="{{$role->id}}"{{request()->roleid==$role->id?'selected':false}} {{old('role')==$role->id?'selected':false}}>{{$role->name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-2 d-none">
              <select class="form-control" name="status" id="">
                  <option value="">Trạng thái</option>
                  <option value="0"{{request()->status==0?'selected':false}}>Active</option>
                  <option value="1"{{request()->status==1?'selected':false}}>Disable</option>
              </select>
          </div>
                <div class="col-5">
                    <input type="search" name="keywords" class="form-control" value="{{request()->keywords}}" placeholder="Tìm kiếm sản phẩm">
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
        </form>
        
    </div>
    </div><!-- /.container-fluid -->
  </section>
  @if (session('msg'))
  <div class="alert alert-success">{{session('msg')}}</div>
  @endif
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
                    <th>Mã nhân viên<a href="?sort-by=id&sort-type={{$sortType}}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z" fill="#555555"/>
                      </svg>
                      </a></th>
                    <th> Họ tên nhân viên<a href="?sort-by=name&sort-type={{$sortType}}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z" fill="#555555"/>
                      </svg>
                      </a></th>
                    <th>Vai trò</th>
                    <th>Số điện thoại<a href="?sort-by=phonenumber&sort-type={{$sortType}}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z" fill="#555555"/>
                      </svg>
                      </a></th>
                    <th>Email<a href="?sort-by=email&sort-type={{$sortType}}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z" fill="#555555"/>
                      </svg>
                      </a></th>
                    <th>Trạng thái<a href="?sort-by=status&sort-type={{$sortType}}"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z" fill="#555555"/>
                      </svg>
                      </a></th>
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
                    {{-- <td>{!!$value->status==0?'<button type="submit" class="btn btn-sm btn-secondary">Active</button>':' <button type="submit" class="btn btn-sm btn-primary">Disable</button>'!!}</td> --}}
                    <td>
                      <select class="p-1 px-2 status-select"
                          style="border: 1px solid #D6D6D6; <?php if ($value->status == 0) {
                              echo 'color:#09BD3C;';
                          } else {
                              echo 'color:#D6D6D6';
                          }
                          ?>"
                          id="{{$value->id }}" name="status-select">
                          <option value="0" <?php if ($value->status == 0) {
                              echo 'selected';
                          } ?>>Active</option>
                          <option value="1" <?php if ($value->status == 1) {
                              echo 'selected';
                          } ?>>Disable</option>
                      </select>
                  </td>
                    <td class="text-center"><span><a> <form action="{{route('admin.edit')}}" method="get" enctype="multipart/form">
                      @csrf
                      <button type="submit" class="btn btn-info btn-sm"> Edit</button>   
                      <input type="hidden" name="id" value="{{$value->id}}" />   
                      </form></a><form onclick="return confirm('Bạn có chắc chắn muốn xoá !!')" action="{{route('admin.delete')}}" method="get" enctype="multipart/form">
									@csrf
                             <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
                              <input type="hidden" name="id" value="{{$value->id}}" />
                              </form></span></td>
                  </tr>
                  @endforeach
              </table>
            </div>
            {{ $usersList->links() }}
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
<script>
  $(document).ready(function() {
      $('.status-select').change(function() {
          var newStatus = $(this).val();
          var idStatus = $(this).attr('id');
          $.ajax({
              url: '{{ route('admin.update') }}',
              type: 'GET',
              data: {
                  newStatus: newStatus,
                  idStatus: idStatus
              },
              success: function(data) {
                  alert('Cập nhật tình trạng thành công!');
                  console.log(data);
              }
          
          });
          location.reload();
      });
  });
</script>
</body>

</html>