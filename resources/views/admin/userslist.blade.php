<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a href="{{route('admin.add')}}" class="btn btn-primary">
            Thêm nhân viên
          </a>
        </div>
      </div>
      <div class="row m-auto filter">
        <form class="w-100" action="" method="get" id='search-filter'>
          <div class="row">
            <div class="col-5">
              <input type="search" name="keywords" class="form-control" value="{{request()->keywords}}"
                placeholder="Tìm kiếm nhân viên">
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
            </div>
            <a class="btn btn-primary ml-auto delete-filter" href="{{route('admin.userslist')}}">Tắt bộ lọc</a>
          </div>
          <div class="row d-flex justify-contents-center align-items-center mr-auto pt-2">
            <div class="icon-filter mr-3 ml-1">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z"
                  fill="#555555" />
              </svg>
            </div>
            <div class="filter-results">
              @foreach ($string as $item)
              <span class="filter-group">
                {{ $item['label'] }}:
                <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                <a class="delete-item delete-btn-{{ $item['class'] }}"><svg width="24" height="24" viewBox="0 0 24 24"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                    <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                </a>
              </span>
              @endforeach
            </div>
            <div class="filter-options">
              <div class="dropdown">
                <button class="ml-2 btn btn-filter" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                        fill="#555555" />
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                        fill="#555555" />
                    </svg>
                    Thêm bộ lọc
                  </span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <button class="dropdown-item" id="btn-status">Status</button>
                  <button class="dropdown-item" id="btn-roles">Roles</button>
                </div>
              </div>
              <?php  $status = [];
          $roles=[];
        if (isset(request()->status)) {
          $status= request()->status;
        }
        else {
          $status = [];
        }
        if (isset(request()->roles)) {
          $roles= request()->roles;
        }
        else {
          $roles = [];
        }
      ?>
              <div class="block-options" id="status-options" style="display:none">
                <div class="wrap w-100">
                  <div class="heading-title py-3 px-2">
                    <h5>Trạng thái:</h5>
                  </div>
                  <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                    <a class="cursor select-all mr-auto">Chọn tất cả</a>
                    <a class="cursor deselect-all">Hủy chọn</a>
                  </div>
                  <ul class="ks-cboxtags p-0 m-0 px-2">
                    <li>
                      <input type="checkbox" id="status_active" {{ in_array(1, $status) ? 'checked' : '' }}
                        name="status[]" value="1">
                      <label for="status_active">Active</label>
                    </li>
                    <li>
                      <input type="checkbox" id="status_inactive" {{ in_array(0, $status) ? 'checked' : '' }}
                        name="status[]" value="0">
                      <label for="status_inactive">Disable</label>
                    </li>
                  </ul>
                </div>
                <div class="d-flex justify-contents-center align-items-baseline px-2">
                  <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                  <button type="button" id="cancel-status" class="btn btn-secondary btn-block">Hủy</button>
                </div>
              </div>
              <div class="block-options" id="role-options" style="display:none">
                <div class="wrap w-100">
                  <div class="heading-title py-3 px-2">
                    <h5>Vai trò:</h5>
                  </div>
                  <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                    <a class="cursor select-all-roles mr-auto">Chọn tất cả</a>
                    <a class="cursor deselect-all-roles">Hủy chọn</a>
                  </div>
                  <ul class="ks-cboxtags p-0 m-0 px-2">
                    @if(!empty($allRoles))
                    @foreach($allRoles as $role)
                    <li>
                      <input type="checkbox" id="roles_active" {{ in_array($role->id, $roles) ? 'checked' : '' }}
                      name="roles[]" value="{{$role->id}}">
                      <label for="roles_active">{{$role->name}}</label>
                    </li>
                    @endforeach
                    @endif
                  </ul>
                  <div class="d-flex justify-contents-center align-items-baseline px-2">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                    <button type="button" id="cancel-roles" class="btn btn-secondary btn-block">Hủy</button>
                  </div>
                </div>
              </div>
            </div>
            {{--
        </form> --}}
      </div>
    </div><!-- /.container-fluid -->
  </section>
  {{-- @if (session('msg'))
  <div class="alert alert-success">{{session('msg')}}</div>
  @endif --}}
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
                    <input type="hidden" id="sortByInput" name="sort-by" value="id">
                    <input type="hidden" id="sortTypeInput" name="sort-type" value="{{$sortType}}">
                    <th>
                      <span class="d-flex">
                        <a href="#" class="sort-link" data-sort-by="id" data-sort-type="{{$sortType}}"><button class="btn-sort"
                            type="submit">Mã nhân viên</button></a>
                            <div class="icon" id="icon-id"></div>
                      </span>
                    </th>
                    <th>
                      <span class="d-flex">
                        <a href="#" class="sort-link" data-sort-by="name" data-sort-type="{{$sortType}}"><button class="btn-sort"
                            type="submit">Họ tên nhân viên</button></a>
                            <div class="icon" id="icon-name"></div>
                      </span>
                    </th>
                    <th>
                      <span class="d-flex">
                        <a href="#" class="sort-link" data-sort-by="roleid" data-sort-type="{{$sortType}}"><button class="btn-sort"
                            type="submit">Vai trò</button></a>
                            <div class="icon" id="icon-roleid"></div>
                      </span>
                    </th>
                    <th>
                      <span class="d-flex">
                        <a href="#" class="sort-link" data-sort-by="phonenumber" data-sort-type="{{$sortType}}"><button class="btn-sort"
                            type="submit">Số điện thoại</button></a>
                            <div class="icon" id="icon-phonenumber"></div>
                      </span>
                    </th>
                    <th>
                      <span class="d-flex">
                        <a href="#" class="sort-link" data-sort-by="email" data-sort-type="{{$sortType}}"><button class="btn-sort"
                            type="submit">Email</button></a>
                            <div class="icon" id="icon-email"></div>
                      </span>
                    </th>
                    <th>
                      <span class="d-flex">
                        <a href="#" class="sort-link" data-sort-by="status" data-sort-type="{{$sortType}}"><button class="btn-sort"
                            type="submit">Trạng thái</button></a>
                            <div class="icon" id="icon-status"></div>
                      </span>
                    </th>
                    </form>
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
                    {{-- <td>{!!$value->status==0?'<button type="submit"
                        class="btn btn-sm btn-secondary">Active</button>':' <button type="submit"
                        class="btn btn-sm btn-primary">Disable</button>'!!}</td> --}}
                    <td>
                      <select class="p-1 px-2 status-select" style="border: 1px solid #D6D6D6; <?php if ($value->status == 1) {
                              echo 'color:#09BD3C;';
                          } else {
                              echo 'color:#D6D6D6';
                          }
                          ?>" id="{{$value->id }}" name="status-select">
                        <option value="1" <?php if ($value->status == 1) {
                          echo 'selected';
                          } ?>>Active</option>
                        <option value="0" <?php if ($value->status == 0) {
                          echo 'selected';
                          } ?>>Disable</option>
                      </select>
                    </td>
                    <td class="text-center"><span><a>
                          <form action="{{route('admin.edit')}}" method="get" enctype="multipart/form">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm"> Edit</button>
                            <input type="hidden" name="id" value="{{$value->id}}" />
                          </form>
                        </a>
                        <form onclick="return confirm('Bạn có chắc chắn muốn xoá !!')"
                          action="{{route('admin.delete')}}" method="get" enctype="multipart/form">
                          @csrf
                          <button type="submit" class="btn btn-danger btn-sm"> Delete</button>
                          <input type="hidden" name="id" value="{{$value->id}}" />
                        </form>
                      </span></td>
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
  $('#btn-status').click(function(event) {
    event.preventDefault();
    $('#status-options').toggle();
    $('#role-options').hide();

});
$('#btn-roles').click(function(event) {
    event.preventDefault();
    $('#role-options').toggle();
    $('#status-options').hide();
});
$('#cancel-status').click(function(event) {
    event.preventDefault();
    $('#status-options').hide();
});
$('#cancel-roles').click(function(event) {
    event.preventDefault();
    $('#role-options').hide();
});
$(document).ready(function() {
  // Chọn tất cả các checkbox
  $('.select-all-roles').click(function() {
    $('#role-options input[type="checkbox"]').prop('checked', true);
  });

  // Hủy tất cả các checkbox
  $('.deselect-all-roles').click(function() {
    $('#role-options input[type="checkbox"]').prop('checked', false);
  });
});
$(document).ready(function() {
  // Chọn tất cả các checkbox
  $('.select-all').click(function() {
    $('#status-options input[type="checkbox"]').prop('checked', true);
  });

  // Hủy tất cả các checkbox
  $('.deselect-all').click(function() {
    $('#status-options input[type="checkbox"]').prop('checked', false);
  });
});

$(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status', function() {
            $('.deselect-all').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-roles', function() {
            $('.deselect-all-roles').click();
            document.getElementById('search-filter').submit();
        });
    });

    $(document).ready(function() {
    // Khôi phục trạng thái icon khi tải lại trang
    restoreIconState();
    localStorage.clear();
    $('.sort-link').on('click', function() {
      var sortBy = $(this).data('sort-by');
      var sortType = $(this).data('sort-type');
      var iconId = 'icon-' + sortBy;
      var iconElement = $('#' + iconId);
      
      var svgHTML = "<svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>";
        if (sortType === 'desc') {
          svgHTML += "<path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z' fill='#555555'/>";
        }else {
          svgHTML += "<path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 19.0009C11.6332 19.0009 11.7604 18.9482 11.8542 18.8544C11.948 18.7607 12.0006 18.6335 12.0006 18.5009V6.70789L15.1466 9.85489C15.2405 9.94878 15.3679 10.0015 15.5006 10.0015C15.6334 10.0015 15.7607 9.94878 15.8546 9.85489C15.9485 9.76101 16.0013 9.63367 16.0013 9.50089C16.0013 9.36812 15.9485 9.24078 15.8546 9.14689L11.8546 5.14689C11.8082 5.10033 11.753 5.06339 11.6923 5.03818C11.6315 5.01297 11.5664 5 11.5006 5C11.4349 5 11.3697 5.01297 11.309 5.03818C11.2483 5.06339 11.1931 5.10033 11.1466 5.14689L7.14663 9.14689C7.10014 9.19338 7.06327 9.24857 7.03811 9.30931C7.01295 9.37005 7 9.43515 7 9.50089C7 9.63367 7.05274 9.76101 7.14663 9.85489C7.24052 9.94878 7.36786 10.0015 7.50063 10.0015C7.63341 10.0015 7.76075 9.94878 7.85463 9.85489L11.0006 6.70789V18.5009C11.0006 18.6335 11.0533 18.7607 11.1471 18.8544C11.2408 18.9482 11.368 19.0009 11.5006 19.0009Z' fill='#555555'/>"
        }svgHTML += "</svg>";
          // Hiển thị icon tương ứng
      iconElement.html(svgHTML);
      // Hiển thị icon tương ứng
      iconElement.html(svgHTML);
      
      // Lưu trạng thái của mũi tên vào localStorage
      localStorage.setItem(iconId, svgHTML);

      // Cập nhật giá trị sort-by và sort-type
      $('#sortByInput').val(sortBy);
      $('#sortTypeInput').val(sortType);
    });

    function restoreIconState() {
      // Khôi phục trạng thái của mũi tên từ localStorage
      $('.icon').each(function() {
        var iconId = $(this).attr('id');
        var iconHTML = localStorage.getItem(iconId);
        if (iconHTML) {
          $(this).html(iconHTML);
        }
      });
    }
  });

  // Xóa tất cả các dữ liệu trong Local Storage
  $('.delete-filter').on('click', function() {
  localStorage.clear();
});
</script>
</body>

</html>