<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Provides</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ asset('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Provides</li>
                    </ol>
                </div>
            </div>
            <a href="{{ route('provides.create') }}">
                <button type="button" class="btn btn-primary d-flex align-items-center">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6 0C6.38791 -1.97352e-08 6.70237 0.314463 6.70237 0.702373L6.70237 11.2976C6.70237 11.6855 6.38791 12 6 12C5.61209 12 5.29763 11.6855 5.29763 11.2976V0.702373C5.29763 0.314463 5.61209 -1.97352e-08 6 0Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 6C12 6.38791 11.6855 6.70237 11.2976 6.70237H0.702373C0.314463 6.70237 -1.38146e-07 6.38791 0 6C-5.13115e-07 5.61209 0.314463 5.29763 0.702373 5.29763H11.2976C11.6855 5.29763 12 5.61209 12 6Z"
                            fill="white" />
                    </svg>
                    <span class="ml-2">Thêm nhà cung cấp</span>
                </button>
            </a>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row">
                        <div class="col-5">
                            <input type="search" name="keywords" class="form-control" value="{{request()->keywords}}"
                                placeholder="Tìm kiếm đơn vị, đại diện hoặc email">
                        </div>
                        <div class="col-2">
                            
                        </div>
                        <a class="btn ml-auto btn-delete-filter" href="{{route('provides.index')}}"><span><svg width="24"
                            height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z"
                              fill="#555555" />
                          </svg>
                        </span>Tắt bộ lọc</a>
                    </div>
                    <div class="row d-flex justify-contents-center align-items-center mr-auto pt-2">
                        <div class="icon-filter mr-3 ml-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z"
                                    fill="#555555" />
                            </svg>
                        </div>
                        <div class="filter-results">
                            @foreach ($string as $item)
                            <span class="filter-group">
                                {{ $item['label'] }}
                                <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                                <a class="delete-item delete-btn-{{ $item['class'] }}"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                <button class="ml-2 btn btn-filter" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
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
                                    <button class="dropdown-item" id="btn-name">Đơn vị</button>
                                    <button class="dropdown-item" id="btn-represent">Đại diện</button>
                                    <button class="dropdown-item" id="btn-phonenumber">Số điện thoại</button>
                                    <button class="dropdown-item" id="btn-email">email</button>
                                    <button class="dropdown-item" id="btn-status">Status</button>
                                </div>
                            </div>
                            <?php  $status = [];
                if (isset(request()->status)) {
                  $status= request()->status;
                }
                else {
                  $status = [];
                }
              ?>
                            <div class="block-options" id="status-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Trạng thái:</h5>
                                    </div>
                                    <div
                                        class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags p-0 m-0 px-2">
                                        <li>
                                            <input type="checkbox" id="status_active" {{ in_array(1, $status)
                                                ? 'checked' : '' }} name="status[]" value="1">
                                            <label for="status_active">Active</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="status_inactive" {{ in_array(0, $status)
                                                ? 'checked' : '' }} name="status[]" value="0">
                                            <label for="status_inactive">Disable</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-status"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Tìm đơn vị --}}
                            <div class="block-options" id="name-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Đơn vị:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>
                                        <input type="search" name="name" class="form-control name-input"
                                            value="{{request()->name}}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-name"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Tìm đại diện --}}
                            <div class="block-options" id="represent-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Đại diện:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>
                                        <input type="search" name="represent" class="form-control represent-input"
                                            value="{{request()->represent}}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-represent"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Tìm số điện thoại --}}
                            <div class="block-options" id="phonenumber-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Số điện thoại:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>
                                        <input type="number" name="phonenumber" class="form-control phonenumber-input"
                                            value="{{request()->phonenumber}}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-phonenumber"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Tìm Email --}}
                            <div class="block-options" id="email-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Email:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>
                                        <input type="search" name="email" class="form-control email-input"
                                            value="{{request()->email}}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-email"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
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
                                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                        <input type="hidden" id="sortTypeInput" name="sort-type" value="{{$sortType}}">
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{$sortType}}"><button class="btn-sort"
                                                        type="submit">Mã nhân viên</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="provide_name"
                                                    data-sort-type="{{$sortType}}"><button class="btn-sort"
                                                        type="submit">Đơn vị</button></a>
                                                <div class="icon" id="icon-provide_name"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="provide_represent"
                                                    data-sort-type="{{$sortType}}"><button class="btn-sort"
                                                        type="submit">Đại diện</button></a>
                                                <div class="icon" id="icon-provide_represent"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="provide_phone"
                                                    data-sort-type="{{$sortType}}"><button class="btn-sort"
                                                        type="submit">Số điện thoại</button></a>
                                                <div class="icon" id="icon-provide_phone"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="provide_email"
                                                    data-sort-type="{{$sortType}}"><button class="btn-sort"
                                                        type="submit">Email</button></a>
                                                <div class="icon" id="icon-provide_email"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="provide_status"
                                                    data-sort-type="{{$sortType}}"><button class="btn-sort"
                                                        type="submit">Trạng thái</button></a>
                                                <div class="icon" id="icon-provide_status"></div>
                                            </span>
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($provides as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->provide_name }}</td>
                                        <td>{{ $item->provide_represent }}</td>
                                        <td>{{ $item->provide_phone }}</td>
                                        <td>{{ $item->provide_email }}</td>
                                        <td>
                                            <select class="p-1 px-2 status-select" style="border: 1px solid #D6D6D6; <?php if ($item->provide_status == 1) {
                                                        echo 'color:#09BD3C;';
                                                    } else {
                                                        echo 'color:#D6D6D6';
                                                    }
                                                    ?>" id="{{ $item->id }}" name="status-select">
                                                <option value="1" <?php if ($item->provide_status == 1) {
                                                    echo 'selected';
                                                    } ?>>Active</option>
                                                <option value="0" <?php if ($item->provide_status == 0) {
                                                    echo 'selected';
                                                    } ?>>Disable</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('provides.edit', $item->id) }}">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <form onclick="return confirm('Are you sure?')" action="{{ route('provides.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginator mt-4 d-flex justify-content-end">
                                {{ $provides->links() }}
                            </div>
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
<script>
    $(document).ready(function() {
        $('.status-select').change(function() {
            var newStatus = $(this).val();
            var idProvide = $(this).attr('id');
            $.ajax({
                url: '{{ route('update') }}',
                type: 'GET',
                data: {
                    newStatus: newStatus,
                    idProvide: idProvide
                },
                success: function() {
                    alert('Cập nhật tình trạng thành công!');
                }
            });
            location.reload();
        });
    });
    $('#btn-status').click(function(event) {
    event.preventDefault();
    $('#status-options').toggle();
    
$('#cancel-status').click(function(event) {
    event.preventDefault();
    $('#status-options').hide();
});
});
$('#btn-name').click(function(event) {
    event.preventDefault();
    $('#name-options').toggle();
});
$('#cancel-name').click(function(event) {
    event.preventDefault();
    $('#name-options').hide();
});
$('#btn-represent').click(function(event) {
    event.preventDefault();
    $('#represent-options').toggle();
});
$('#cancel-represent').click(function(event) {
    event.preventDefault();
    $('#represent-options').hide();
});
$('#btn-phonenumber').click(function(event) {
    event.preventDefault();
    $('#phonenumber-options').toggle();
});
$('#cancel-phonenumber').click(function(event) {
    event.preventDefault();
    $('#phonenumber-options').hide();
});
$('#btn-email').click(function(event) {
    event.preventDefault();
    $('#email-options').toggle();
});
$('#cancel-email').click(function(event) {
    event.preventDefault();
    $('#email-options').hide();
});

$(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-name', function() {
            $('.name-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-represent', function() {
            $('.represent-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-phonenumber', function() {
            $('.phonenumber-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-email', function() {
            $('.email-input').val('');
            document.getElementById('search-filter').submit();
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