<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-1 m-0">
                <a href="{{ route('guests.create') }}">
                    <button type="button" class="btn btn-primary d-flex align-items-center">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6 0C6.38791 -1.97352e-08 6.70237 0.314463 6.70237 0.702373L6.70237 11.2976C6.70237 11.6855 6.38791 12 6 12C5.61209 12 5.29763 11.6855 5.29763 11.2976V0.702373C5.29763 0.314463 5.61209 -1.97352e-08 6 0Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 6C12 6.38791 11.6855 6.70237 11.2976 6.70237H0.702373C0.314463 6.70237 -1.38146e-07 6.38791 0 6C-5.13115e-07 5.61209 0.314463 5.29763 0.702373 5.29763H11.2976C11.6855 5.29763 12 5.61209 12 6Z"
                                fill="white" />
                        </svg>
                        <span class="ml-2">Thêm khách hàng</span>
                    </button>
                </a>
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row mr-0">
                        <div class="col-5">
                            <input type="text" name="keywords" class="form-control" value="{{ request()->keywords }}"
                                placeholder="Tìm kiếm đơn vị, đại diện hoặc email">
                            <span class="search-icon"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="col-2 d-none">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                        <a class="btn ml-auto btn-delete-filter btn-light" href="{{ route('guests.index') }}"><span><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z"
                                        fill="#555555" />
                                </svg>
                            </span>Tắt bộ lọc</a>
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
                        <div class="row filter-results d-flex row m-0">
                            <?php
                            session_start();
                            
                            $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            if ($fullUrl === route('guests.index')) {
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
                            <div class="class" style="order:999">
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
                                                <button class="dropdown-item" id="btn-name">Đơn vị</button>
                                                {{-- <button class="dropdown-item" id="btn-represent">Đại diện</button> --}}
                                                @if(Auth::user()->can('isAdmin'))
                                                <button class="dropdown-item" id="btn-users_name">Người phụ
                                                    trách</button>
                                                    @endif
                                                <button class="dropdown-item" id="btn-phonenumber">Số điện
                                                    thoại</button>
                                                <button class="dropdown-item" id="btn-email">Email</button>
                                                <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                            </div>
                                        </div>
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
                                    $users_name = [];
                                    if (isset(request()->users_name)) {
                                        $users_name = request()->users_name;
                                    } else {
                                        $users_name = [];
                                    }
                                    ?>
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
                                            <ul class="ks-cboxtags-status p-0 mb-1 px-2">
                                                <li>
                                                    <input type="checkbox" id="status_active"
                                                        {{ in_array(1, $status) ? 'checked' : '' }} name="status[]"
                                                        value="1">
                                                    <label for="">Active</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_inactive"
                                                        {{ in_array(0, $status) ? 'checked' : '' }} name="status[]"
                                                        value="0">
                                                    <label for="">Disable</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-status"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm đơn vị --}}
                                    <div class="block-options" id="name-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Đơn vị</h5>
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
                                    {{-- Người phụ trách --}}
                                    <div class="block-options" id="users_name-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Người tạo</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-users_name"
                                                    class="pr-4 w-100 input-search" onkeyup="filterCreator()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-users_name mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-users_name">Hủy chọn</a>
                                            </div>
                                            <ul class="ks-cboxtags-users_name p-0 mb-1 px-2">
                                                @if (!empty($users))
                                                    @php
                                                        $seenValues = [];
                                                    @endphp
                                                    @foreach ($users as $value)
                                                        @if (!in_array($value->name, $seenValues))
                                                            <li>
                                                                <input type="checkbox" id="name_active"
                                                                    {{ in_array($value->name, $users_name) ? 'checked' : '' }}
                                                                    name="users_name[]"
                                                                    value="{{ $value->name }}">
                                                                <label id="users_name"
                                                                    for="">{{ $value->name }}</label>
                                                            </li>
                                                            @php
                                                                $seenValues[] = $value->name;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-users_name"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Tìm đại diện --}}
                                    <div class="block-options" id="represent-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Đại diện</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="represent"
                                                    class="form-control represent-input"
                                                    value="{{ request()->represent }}"
                                                    placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-represent"
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
                                                <input type="number" name="phonenumber"
                                                    class="form-control phonenumber-input"
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
                                </div>
                            </div>
                        </div>

                    </div>
            </div><!-- /.container-fluided -->
    </section>

    <!-- Main content -->
    <div class="order_content">
        <section class="multiple_action">
            <div class="d-flex justify-content-between align-items-center">
                <span class="count_checkbox mr-5"></span>
                <div class="row action">
                    <div class="btn-nhanvien my-2 mx-3">
                        <button id="deleteListGuest" type="button"
                            class="btn btn-group btn-light d-flex align-items-center">
                            <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em"
                                width="1em" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            <span>Xóa khách hàng đã chọn</span>
                        </button>
                    </div>
                    <div class="dropdown my-2">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Thay đổi trạng thái
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button id="activeStatusGuest" class="dropdown-item">Active</button>
                            <button id="disableStatusGuest" class="dropdown-item">Disable</button>
                        </div>
                    </div>
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
                                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                        <input type="hidden" id="sortTypeInput" name="sort-type"
                                            value="{{ $sortType }}">
                                        <th><input type="checkbox" name="all" id="checkall"></th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Mã khách hàng</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="guest_name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Đơn vị</button></a>
                                                <div class="icon" id="icon-guest_name"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="user_id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Người phụ trách</button></a>
                                                <div class="icon" id="icon-user_id"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="guest_phone"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Số điện thoại</button></a>
                                                <div class="icon" id="icon-guest_phone"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="guest_email"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Email</button></a>
                                                <div class="icon" id="icon-guest_email"></div>
                                            </span>
                                        </th>
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="guest_status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trạng thái</button></a>
                                                <div class="icon" id="icon-guest_status"></div>
                                            </span>
                                        </th>
                                        <th></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $item)
                                        @if (Auth::user()->id == $item->user_id || Auth::user()->can('isAdmin'))
                                            <tr>
                                                <td><input type="checkbox" class="cb-element" name="ids[]"
                                                        value="{{ $item->id }}"></td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->guest_name }}</td>
                                                <td>{{ $item->users_name }}</td>
                                                <td>{{ $item->guest_phone }}</td>
                                                <td>{{ $item->guest_email }}</td>
                                                <td>
                                                    <select class="p-1 px-2 status-select"
                                                        style="border: 1px solid #D6D6D6; <?php if ($item->guest_status == 1) {
                                                            echo 'color:#09BD3C;';
                                                        } else {
                                                            echo 'color:#D6D6D6';
                                                        }
                                                        ?>"
                                                        id="{{ $item->id }}" name="status-select">
                                                        <option value="1" <?php if ($item->guest_status == 1) {
                                                            echo 'selected';
                                                        } ?>>Active</option>
                                                        <option value="0" <?php if ($item->guest_status == 0) {
                                                            echo 'selected';
                                                        } ?>>Disable</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm"
                                                        href="{{ route('guests.edit', $item->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" viewBox="0 0 32 32" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                fill="#555555"></path>
                                                        </svg>
                                                    </a>
                                                    <form onclick="return confirm('Bạn có chắc chắn muốn xóa?')"
                                                        action="{{ route('guests.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="32"
                                                                height="32" viewBox="0 0 32 32" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z"
                                                                    fill="#555555"></path>
                                                            </svg></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="paginator mt-4 d-flex justify-content-end">
                        {{ $guests->appends(request()->except('page'))->links() }}
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
<script>
    $('.ks-cboxtags-users_name li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('#btn-users_name').click(function(event) {
        event.preventDefault();
        $('#users_name-options input').addClass('users_name-checkbox');
        $('.btn-filter').prop('disabled', true);
        $('#users_name-options').toggle();
    });
    $('#cancel-users_name').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#users_name-options input[type="checkbox"]').prop('checked', false);
        $('#users_name-options').hide();
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-users_name').click(function() {
            $('#users_name-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-users_name').click(function() {
            $('#users_name-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-users_name', function() {
            $('.deselect-all-users_name').click();
            document.getElementById('search-filter').submit();
        });
    });

    function filterCreator() {
        var input = $("#myInput-users_name");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-users_name li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }


    $(document).ready(function() {
        $('.status-select').change(function() {
            var newStatus = $(this).val();
            var idGuest = $(this).attr('id');
            $.ajax({
                url: '{{ route('updateKH') }}',
                type: 'GET',
                data: {
                    newStatus: newStatus,
                    idGuest: idGuest
                },
                success: function() {
                    alert('Cập nhật tình trạng thành công!');
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
    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options').toggle();
        $('#status-options input').addClass('status-checkbox');
    });

    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);

        $('#status-options input[type="checkbox"]').prop('checked', false);
        $('#status-options').hide();
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
    $('#btn-represent').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);

        $('#represent-options').toggle();
    });
    $('#cancel-represent').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);

        $('.represent-input').val('');
        $('#represent-options').hide();
    });
    $('#btn-phonenumber').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);

        $('#phonenumber-options').toggle();
    });
    $('#cancel-phonenumber').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);

        $('.phonenumber-input').val('');
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

    function updateDeleteItemValue(label) {
        document.getElementById('delete-item-input').value = label;
    }



    // AJAX disable user
    $(document).on('click', '#disableStatusGuest', function(e) {
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
                url: "{{ route('disableStatusGuest') }}",
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
    $(document).on('click', '#activeStatusGuest', function(e) {
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
                    url: '{{ route('activeStatusGuest') }}',
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
    $(document).on('click', '#deleteListGuest', function(e) {
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
                url: "{{ route('deleteListGuest') }}",
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
