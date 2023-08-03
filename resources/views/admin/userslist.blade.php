<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-1 m-0">
                <a href="{{ route('admin.add') }}">
                    <button type="button" class="custom-btn btn btn-primary d-flex align-items-center">
                        <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                fill="#ffff" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                fill="#ffff" />
                        </svg>
                        <span>Thêm nhân viên</span>
                    </button>
                </a>
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" name="keywords" class="form-control searchkeyword"
                                value="{{ request()->keywords }}" placeholder="Tìm kiếm nhân viên">
                            <span id="search-icon" class="search-icon"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="col-2 d-none">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>

                        </div>
                    </div>
                    <div class="d-flex justify-contents-center align-items-center mr-auto row-filter my-3 m-0">
                        <div class="icon-filter mr-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z"
                                    fill="#555555" />
                            </svg>
                        </div>
                        <?php
                        session_start();
                        
                        $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        if ($fullUrl === route('admin.userslist')) {
                            // Xử lý khi route hiện tại bằng route('data.index')
                            unset($_SESSION['labels']); // Xóa session
                        }
                        if (!isset($_SESSION['labels'])) {
                            $_SESSION['labels'] = [];
                        }
                        
                        // Lấy mảng labels từ nguồn dữ liệu hoặc quá trình xử lý khác
                        $labelsToAdd = [];
                        foreach ($string as $item) {
                            $labelsToAdd[] = $item['label'];
                        }
                        
                        $deleteItem = request()->delete_item;
                        // var_dump($deleteItem);
                        // echo '<br>';
                        if (($key = array_search($deleteItem, $_SESSION['labels'])) !== false) {
                            unset($_SESSION['labels'][$key]);
                        }
                        // Kiểm tra từng giá trị trong mảng labelsToAdd và thêm vào cuối mảng nếu giá trị đó chưa tồn tại trong mảng labels
                        foreach ($labelsToAdd as $label) {
                            if (!in_array($label, $_SESSION['labels'])) {
                                $_SESSION['labels'][] = $label; // Thêm vào cuối mảng
                            }
                        }
                        
                        // Đánh số vị trí cho từng phần tử trong mảng session
                        $numberedLabels = array_values($_SESSION['labels']);
                        // var_dump(request()->delete_item);
                        
                        // var_dump($_SESSION['labels']);
                        ?>
                        <div class="row filter-results d-flex row m-0">
                            <input id="delete-item-input" type="hidden" name="delete_item" value="">
                            @foreach ($string as $item)
                                <span class="filter-group"
                                    style="order: @php
$index = array_search($item['label'], $numberedLabels);
                                                if ($index !== false) {
                                                    echo $index + 1;
                                                } else {
                                                    echo 0;
                                                } @endphp">
                                    {{ $item['label'] }}
                                    <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                                    <a class="delete-item delete-btn-{{ $item['class'] }}"
                                        onclick="updateDeleteItemValue('{{ $item['label'] }}')">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                </span>
                            @endforeach
                            <div class="" style="order:999">
                                <div class="filter-options">
                                    <div class="dropdown">
                                        <button class="btn btn-filter btn-light" type="button" id="dropdownMenuButton"
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
                                        <div class="dropdown-menu" id="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton">
                                            <div class="search-container px-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput"
                                                    onkeyup="filterFunction()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div class="scrollbar">
                                                <button class="dropdown-item" id="btn-name">Tên nhân viên</button>
                                                <button class="dropdown-item" id="btn-roles">Vai trò</button>
                                                <button class="dropdown-item" id="btn-phonenumber">Số điện
                                                    thoại</button>
                                                <button class="dropdown-item" id="btn-email">Email</button>
                                                <button class="dropdown-item d-none" id="btn-status">Trạng
                                                    thái</button>
                                            </div>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter"
                                                href="{{ route('admin.userslist') }}"><span>Tắt bộ lọc</span></a>
                                        @endif
                                    </div>
                                    <?php $status = [];
                                    $roles = [];
                                    if (isset(request()->status)) {
                                        $status = request()->status;
                                    } else {
                                        $status = [];
                                    }
                                    if (isset(request()->roles)) {
                                        $roles = request()->roles;
                                    } else {
                                        $roles = [];
                                    }
                                    ?>
                                    {{-- Tìm tên nhân viên --}}
                                    <div class="block-options" id="name-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tên nhân viên</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="name" class="form-control name-input"
                                                    value="{{ request()->name }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-name"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm số điện thoại --}}
                                    <div class="block-options" id="phonenumber-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Số điện thoại</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Nhập số điện thoại</label>
                                                <input type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="phonenumber" class="form-control phonenumber-input"
                                                    value="{{ request()->phonenumber }}"
                                                    placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-phonenumber"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm Email --}}
                                    <div class="block-options" id="email-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Email</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="email" class="form-control email-input"
                                                    value="{{ request()->email }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-email"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    <div class="block-options" id="status-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trạng thái</h5>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all">Hủy chọn</a>
                                            </div>

                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-status p-0 mb-1 px-2">
                                                    <li>
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(1, $status) ? 'checked' : '' }}
                                                            name="status[]" value="1">
                                                        <label for="">Active</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(0, $status) ? 'checked' : '' }}
                                                            name="status[]" value="0">
                                                        <label for="">Disable</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-status"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    <div class="block-options" id="role-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Vai trò</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-roles"
                                                    class="pr-4 w-100 input-search" onkeyup="filterRoles()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-roles mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-roles">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-roles p-0 mb-1 px-2">
                                                    @if (!empty($allRoles))
                                                        @foreach ($allRoles as $role)
                                                            <li>
                                                                <input type="checkbox" id="roles_active"
                                                                    {{ in_array($role->id, $roles) ? 'checked' : '' }}
                                                                    name="roles[]" value="{{ $role->id }}">
                                                                <label for="">{{ $role->name }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-roles"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{--
        </form> --}}
                    </div>
            </div><!-- /.container-fluided -->
    </section>
    {{-- @if (session('msg'))
  <div class="alert alert-success">{{session('msg')}}</div>
  @endif --}}
    <!-- Main content -->

    <div class="order_content">
        <section class="multiple_action">
            <div class="d-flex justify-content-between align-items-center">
                <span class="count_checkbox mr-5"></span>
                <div class="row action">
                    <div class="btn-nhanvien my-2 ml-3">
                        <button id="deleteListUser" type="button"
                            class="btn btn-group btn-light d-flex align-items-center h-100">
                            <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.5454 5C10.2442 5 9.99999 5.24421 9.99999 5.54545C9.99999 5.8467 10.2442 6.09091 10.5454 6.09091H13.4545C13.7558 6.09091 14 5.8467 14 5.54545C14 5.24421 13.7558 5 13.4545 5H10.5454ZM6 7.72726C6 7.42601 6.24421 7.18181 6.54545 7.18181H7.63637H16.3636H17.4545C17.7558 7.18181 18 7.42601 18 7.72726C18 8.02851 17.7558 8.27272 17.4545 8.27272H16.9091V17C16.9091 18.2113 15.9118 19.1818 14.7135 19.1818H9.25891C8.97278 19.1816 8.68906 19.1247 8.42499 19.0145C8.16092 18.9044 7.92126 18.7431 7.71979 18.5399C7.51833 18.3367 7.35905 18.0957 7.25112 17.8307C7.14347 17.5664 7.08903 17.2834 7.09091 16.9981V8.27272H6.54545C6.24421 8.27272 6 8.02851 6 7.72726ZM8.18182 17.0041V8.27272H15.8182V17C15.8182 17.5966 15.3216 18.0909 14.7135 18.0909H9.25938C9.11713 18.0908 8.97632 18.0625 8.84503 18.0077C8.71375 17.953 8.5946 17.8728 8.49444 17.7718C8.39429 17.6707 8.3151 17.5509 8.26144 17.4192C8.20779 17.2874 8.18074 17.1464 8.18182 17.0041ZM13.4545 10.0909C13.7558 10.0909 14 10.3351 14 10.6364V15.7273C14 16.0285 13.7558 16.2727 13.4545 16.2727C13.1533 16.2727 12.9091 16.0285 12.9091 15.7273V10.6364C12.9091 10.3351 13.1533 10.0909 13.4545 10.0909ZM11.0909 10.6364C11.0909 10.3351 10.8467 10.0909 10.5454 10.0909C10.2442 10.0909 9.99999 10.3351 9.99999 10.6364V15.7273C9.99999 16.0285 10.2442 16.2727 10.5454 16.2727C10.8467 16.2727 11.0909 16.0285 11.0909 15.7273V10.6364Z"
                                    fill="#555555" />
                            </svg>
                            <span>Xóa nhân viên</span>
                        </button>
                    </div>
                    {{-- <div class="dropdown my-2 ml-4">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span> Thay đổi trạng thái</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button id="activeStatusUser" class="dropdown-item">Active</button>
                            <button id="disableStatusUser" class="dropdown-item">Disable</button>
                        </div>
                    </div> --}}
                </div>
                <div class="btn ml-auto cancal_action">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M18 18L6 6" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M18 6L6 18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </section>
    </div>
    <section class="content">
        <div class="container-fluided">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <input type="hidden" id="perPageinput" name="perPageinput" value="{{ request()->perPageinput ?? 10 }}">
                                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                        <input type="hidden" id="sortTypeInput" name="sort-type"
                                            value="{{ $sortType }}">
                                        <th><input type="checkbox" name="all" id="checkall"></th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Mã nhân viên</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Họ tên nhân viên</button></a>
                                                <div class="icon" id="icon-name"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="roleid"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Vai trò</button></a>
                                                <div class="icon" id="icon-roleid"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="phonenumber"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Số điện thoại</button></a>
                                                <div class="icon" id="icon-phonenumber"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="email"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Email</button></a>
                                                <div class="icon" id="icon-email"></div>
                                            </span>
                                        </th>
                                        <th class="d-none">
                                            <span class="d-flex  justify-content-center d-none">
                                                <a href="#" class="sort-link" data-sort-by="status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trạng thái</button></a>
                                                <div class="icon" id="icon-status"></div>
                                            </span>
                                        </th>
                                        </form>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersList as $value)
                                        <tr>
                                            <td>
                                                @if ($value->id != Auth::user()->id)
                                                    <input type="checkbox" class="cb-element" name="ids[]"
                                                        value="{{ $value->id }}">
                                                @endif
                                            </td>
                                            <td>{{ $value->id }}</td>
                                            <td>{{ $value->name }}
                                            </td>
                                            <td>{{ $value->role_name }}</td>
                                            <td>{{ $value->phonenumber }}</td>
                                            <td>{{ $value->email }}</td>
                                            {{-- <td>{!!$value->status==0?'<button type="submit"
                        class="btn btn-sm btn-secondary">Active</button>':' <button type="submit"
                        class="btn btn-sm btn-primary">Disable</button>'!!}</td> --}}
                                            <td class="text-center d-none">
                                                @if ($value->id != Auth::user()->id)
                                                    <select class="p-1 px-2 status-select"
                                                        style="border: 1px solid #D6D6D6; <?php if ($value->status == 1) {
                                                            echo 'color:#09BD3C;';
                                                        } else {
                                                            echo 'color:#D6D6D6';
                                                        }
                                                        ?>"
                                                        id="{{ $value->id }}" name="status-select">
                                                        <option value="1" <?php if ($value->status == 1) {
                                                            echo 'selected';
                                                        } ?>>Active</option>
                                                        <option value="0" <?php if ($value->status == 0) {
                                                            echo 'selected';
                                                        } ?>>Disable</option>
                                                    </select>
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td>
                                                <a>
                                                    <form action="{{ route('admin.edit') }}" method="get"
                                                        enctype="multipart/form">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                height="32" viewBox="0 0 32 32" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                    fill="#555555"></path>
                                                            </svg></button>
                                                        <input type="hidden" name="id"
                                                            value="{{ $value->id }}" />
                                                    </form>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($value->id != Auth::user()->id)
                                                    <form onclick="return confirm('Bạn có chắc chắn muốn xoá !!')"
                                                        action="{{ route('admin.delete') }}" method="get"
                                                        enctype="multipart/form">
                                                        @csrf
                                                        <button type="submit" class="btn ml-1 btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                height="32" viewBox="0 0 32 32" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z"
                                                                    fill="#555555"></path>
                                                            </svg></button>
                                                        <input type="hidden" name="id"
                                                            value="{{ $value->id }}" />
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="paginator mt-4 d-flex justify-content-start">
                        <span class="text-perpage">
                            Số hàng mỗi trang:
                            <select name="perPage" id="perPage">
                                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </span>
                    </div>
                    {{-- <div class="paginator mt-4 d-flex justify-content-end">
                        {{ $usersList->appends(request()->except('page'))->links() }}
                    </div> --}}
                    @if ($usersList->count() > 0)
                        @php
                            $paginationRange = App\Helpers\PaginationHelper::calculatePaginationRange($usersList->currentPage(), $usersList->lastPage());
                        @endphp
                        <div class="pagination mt-4 d-flex justify-content-end">
                            <ul>
                                @if ($paginationRange['start'] > 1)
                                    <li><a href="{{ $usersList->url(1) }}">1</a></li>
                                    @if ($paginationRange['start'] > 2)
                                        <li><span>...</span></li>
                                    @endif
                                @endif

                                @for ($i = $paginationRange['start']; $i <= $paginationRange['end']; $i++)
                                    <li class="{{ $i == $usersList->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $usersList->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($paginationRange['end'] < $usersList->lastPage())
                                    @if ($paginationRange['end'] < $usersList->lastPage() - 1)
                                        <li><span>...</span></li>
                                    @endif
                                    <li><a
                                            href="{{ $usersList->url($usersList->lastPage()) }}">{{ $usersList->lastPage() }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluided -->
    </section>
    <!-- /.content -->
</div>
<script>
    $('#search-icon').on('click', function(e) {
        e.preventDefault();
        $('#search-filter').submit();
    });
    $('#perPage').on('change', function(e) {
        e.preventDefault();
        var perPageValue = $(this).val();
        $('#perPageinput').val(perPageValue);
        $('#search-filter').submit();
    });
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

    $('.ks-cboxtags-status li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-roles li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options input').addClass('status-checkbox');
        $('#status-options').toggle();
        $('#role-options').hide();

    });

    $('#btn-name').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#name-options').toggle();
    });
    $('#cancel-name').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.name-input').val('');
        $('#name-options').hide();
    });
    $('#btn-phonenumber').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('.phonenumber-input').val('');
        $('#phonenumber-options').toggle();
    });
    $('#cancel-phonenumber').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#phonenumber-options').hide();
    });
    $('#btn-email').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#email-options').toggle();
    });
    $('#cancel-email').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.email-input').val('');
        $('#email-options').hide();
    });

    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-name', function() {
            $('.name-input').val('');
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


    $('#btn-roles').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options input').addClass('status-checkbox');
        $('#role-options').toggle();
        $('#status-options').hide();
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#status-options input[type="checkbox"]').prop('checked', false);
        $('#status-options').hide();
    });
    $('#cancel-roles').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#role-options input[type="checkbox"]').prop('checked', false);
        $('#role-options').hide();
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-roles').click(function() {
            $('#role-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-roles').click(function() {
            $('#role-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all').click(function() {
            $('#status-options input[type="checkbox"]:visible').prop('checked', true);
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

            var svgHTML =
                "<svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>";
            if (sortType === 'desc') {
                svgHTML +=
                    "<path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z' fill='#555555'/>";
            } else {
                svgHTML +=
                    "<path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 19.0009C11.6332 19.0009 11.7604 18.9482 11.8542 18.8544C11.948 18.7607 12.0006 18.6335 12.0006 18.5009V6.70789L15.1466 9.85489C15.2405 9.94878 15.3679 10.0015 15.5006 10.0015C15.6334 10.0015 15.7607 9.94878 15.8546 9.85489C15.9485 9.76101 16.0013 9.63367 16.0013 9.50089C16.0013 9.36812 15.9485 9.24078 15.8546 9.14689L11.8546 5.14689C11.8082 5.10033 11.753 5.06339 11.6923 5.03818C11.6315 5.01297 11.5664 5 11.5006 5C11.4349 5 11.3697 5.01297 11.309 5.03818C11.2483 5.06339 11.1931 5.10033 11.1466 5.14689L7.14663 9.14689C7.10014 9.19338 7.06327 9.24857 7.03811 9.30931C7.01295 9.37005 7 9.43515 7 9.50089C7 9.63367 7.05274 9.76101 7.14663 9.85489C7.24052 9.94878 7.36786 10.0015 7.50063 10.0015C7.63341 10.0015 7.76075 9.94878 7.85463 9.85489L11.0006 6.70789V18.5009C11.0006 18.6335 11.0533 18.7607 11.1471 18.8544C11.2408 18.9482 11.368 19.0009 11.5006 19.0009Z' fill='#555555'/>"
            }
            svgHTML += "</svg>";
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

    function updateDeleteItemValue(label) {
        document.getElementById('delete-item-input').value = label;
    }

    //Xử lí tìm kiếm bộ lọc tổng
    function filterFunction() {
        var input = $("#myInput");
        var filter = input.val().toUpperCase();
        var buttons = $("#dropdown-menu button");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterRoles() {
        var input = $("#myInput-roles");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-roles li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // AJAX disable user
    $(document).on('click', '#disableStatusUser', function(e) {
        e.preventDefault();
        if (myFunctionCancel()) {
            const list_id = [];
            $('input[name="ids[]"]').each(function() {
                if ($(this).is(':checked')) {
                    var value = $(this).val();
                    list_id.push(value);
                }
            });
            $.ajax({
                url: "{{ route('admin.disableStatusUser') }}",
                type: "get",
                data: {
                    list_id: list_id,
                },
                success: function(data) {
                    location.reload();
                }
            })
        }
    })
    // AJAX disable user
    $(document).on('click', '#activeStatusUser', function(e) {
            e.preventDefault();
            if (myFunctionCancel()) {
                const list_id = [];
                $('input[name="ids[]"]').each(function() {
                    if ($(this).is(':checked')) {
                        var value = $(this).val();
                        list_id.push(value);
                    }
                });
                $.ajax({
                    url: '{{ route('admin.activeStatusUser') }}',
                    type: "GET",
                    data: {
                        list_id: list_id,
                    },
                    success: function(data) {
                        location.reload();
                    },
                })
            }
        }

    )

    function myFunction() {
        let text = "Bạn có muốn xóa nhân viên đã chọn không?";
        if (confirm(text) == true) {
            return true
        } else {
            return false
        }

    }

    function myFunctionCancel() {
        let text = "Bạn có chắc chắn thay đổi trạng thái đã chọn không?";
        if (confirm(text) == true) {
            return true
        } else {
            return false
        }

    }

    // AJAX Xóa Exports
    $(document).on('click', '#deleteListUser', function(e) {
        e.preventDefault();
        if (myFunction()) {
            const list_id = [];
            $('input[name="ids[]"]').each(function() {
                if ($(this).is(':checked')) {
                    var value = $(this).val();
                    list_id.push(value);
                }
            });
            $.ajax({
                url: "{{ route('admin.deleteListUser') }}",
                type: "get",
                data: {
                    list_id: list_id,
                },
                success: function(data) {
                    if (data.success == true) {
                        var id = data.ids;
                        for (let i = 0; i < id.length; i++) {
                            $('.' + id[i]).remove();
                        }
                        updateMultipleActionVisibility();
                        location.reload();
                    } else {
                        location.reload();
                    }
                }

            })
        }
    })

    // Checkbox
    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
        updateMultipleActionVisibility();
    });

    $('.cb-element').change(function() {
        updateMultipleActionVisibility();
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    });


    $(document).on('click', '.cancal_action', function(e) {
        e.preventDefault();
        $('.cb-element:checked').prop('checked', false);
        $('#checkall').prop('checked', false);
        updateMultipleActionVisibility()
    })

    function updateMultipleActionVisibility() {
        if ($('.cb-element:checked').length > 0) {
            $('.multiple_action').show();
            $('.count_checkbox').text('Đã chọn ' + $('.cb-element:checked').length);
        } else {
            $('.multiple_action').hide();
        }
    }
</script>
</body>

</html>
