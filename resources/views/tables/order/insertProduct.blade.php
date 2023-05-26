<x-navbar :title="$title"></x-navbar>
@if (Auth::check() != null)
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if (Session::has('section'))
            {{ Session::get('section') }}
        @endif
        <section class="content-header">
            <div class="container-fluid">
                <a href="{{ route('insertProduct.create') }}">
                    <div class="btn btn-primary">Tạo đơn</div>
                </a>
                <div class="btn">Xuất Excel</div>
                <div class="row m-auto filter pt-2">
                    <form class="w-100" action="" method="get" id='search-filter'>
                        <div class="row">
                            <div class="col-5">
                                <input type="text"
                                    placeholder="Tìm kiếm theo mã sản phẩm, nhà cung cấp hoặc tên người tạo"
                                    name="keywords" class="pr-4 form-control input-search w-100"
                                    value="{{ request()->keywords }}">
                                <span class="search-icon"><i class="fas fa-search"></i></span>
                            </div>
                            <div class="col-2 d-none">
                                <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                            </div>
                            <a class="btn ml-auto btn-delete-filter" href="{{ route('insertProduct.index') }}"><span><svg
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z"
                                            fill="#555555" />
                                    </svg>
                                </span>Tắt bộ lọc</a>
                        </div>
                        <div class="row d-flex justify-contents-center align-items-center mr-auto pt-2">
                            <?php
                            session_start();
                            
                            $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                            if ($fullUrl === route('insertProduct.index')) {
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
                            <div class="row filter-results d-flex">
                                <div class="icon-filter mr-3 ml-3">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z"
                                            fill="#555555" />
                                    </svg>
                                </div>
                                <input id="delete-item-input" type="hidden" name="delete_item" value="">
                                @foreach ($string as $item)
                                    <span class="filter-group"
                                        style="order: 
                                    @php
$index = array_search($item['label'], $numberedLabels);
                                        if ($index !== false) {
                                            echo $index + 1;
                                        } else {
                                            echo 0;
                                        } @endphp">
                                        {{ $item['label'] }}
                                        @if ($item['label'] === 'Chỉnh sửa cuối:')
                                     {{ $item['values'][0] }} đến {{ $item['values'][1] }}
                                    @else
                                    <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                                    @endif
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
                                </button>
                                <div class="dropdown-menu" id="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="search-container px-2">
                                        <input type="text" placeholder="Tìm thuộc tính lọc" id="myInput" onkeyup="filterFunction()">
                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                    </div>
                                    <button class="dropdown-item" id="btn-id">Mã đơn hàng</button>
                                    <button class="dropdown-item" id="btn-provide_name">Nhà cung cấp</button>
                                    <button class="dropdown-item" id="btn-update_at">Chỉnh sửa cuối</button>
                                    <button class="dropdown-item" id="btn-creator">Người tạo</button>
                                    <button class="dropdown-item" id="btn-sum">Tổng tiền</button>
                                    <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                </div>
                            </div>
                            <?php $status = [];
                            if (isset(request()->status)) {
                                $status = request()->status;
                            } else {
                                $status = [];
                            }

                            $name = [];
                            if (isset(request()->name)) {
                                $name = request()->name;
                            } else {
                                $name = [];
                            }
                            $provide_namearr = [];
                            if (isset(request()->provide_namearr)) {
                                $provide_namearr = request()->provide_namearr;
                            } else {
                                $provide_namearr = [];
                            }
                            $comparison_operator = null;
                            $sum = null;
                            //Tổng tiền
                            if (isset(request()->comparison_operator) && isset(request()->sum)) {
                                $comparison_operator = request()->comparison_operator;
                                $sum = request()->sum;
                            } else {
                                $comparison_operator = null;
                                $sum = null;
                            }
                            ?>

                            {{-- Tìm mã đơn hàng --}}
                            <div class="block-options" id="id-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Mã đơn hàng:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>
                                        <input type="search" name="id" class="form-control id-input" value="{{ request()->id }}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                        Nhận</button>
                                    <button type="button" id="cancel-id" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Tìm nhà cung cấp --}}
                            <div class="block-options" id="provide_name-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Nhà cung cấp:</h5>
                                    </div>
                                    <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all-provide_name mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all-provide_name">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags-provide_name p-0 m-0 px-2">
                                        @if (!empty($provides))
                                        @foreach ($provides as $value)
                                        <li>
                                            <input type="checkbox" id="roles_active" {{ in_array($value->id, $provide_namearr) ? 'checked' : '' }} name="provide_namearr[]" value="{{ $value->id }}">
                                            <label for="roles_active">{{ $value->provide_name }}</label>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                        Nhận</button>
                                    <button type="button" id="cancel-provide_name" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Status --}}
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
                                            <input type="checkbox" id="status_active" {{ in_array(0, $status) ? 'checked' : '' }} name="status[]" value="0">
                                            <label for="status_active">Chờ duyệt</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="status_inactive" {{ in_array(1, $status) ? 'checked' : '' }} name="status[]" value="1">
                                            <label for="status_inactive">Đã nhập hàng</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="status_inactive" {{ in_array(2, $status) ? 'checked' : '' }} name="status[]" value="2">
                                            <label for="status_inactive">Đã hủy</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                        Nhận</button>
                                    <button type="button" id="cancel-status" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Creator --}}
                            <div class="block-options" id="creator-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Người tạo:</h5>
                                    </div>
                                    <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all-creator mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all-creator">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags-name p-0 m-0 px-2">
                                        @if (!empty($ordersNameAndProvide))
                                        @php
                                        $seenValues = [];
                                        @endphp
                                        @foreach ($ordersNameAndProvide as $value)
                                        @if (!in_array($value->name, $seenValues))
                                        <li>
                                            <input type="checkbox" id="name_active" {{ in_array($value->name, $name) ? 'checked' : '' }} name="name[]" value="{{ $value->name }}">
                                            <label id="name" for="name">{{ $value->name }}</label>
                                        </li>
                                        @php
                                        $seenValues[] = $value->name;
                                        @endphp
                                        @endif
                                        @endforeach
                                        @endif
                                    </ul>
                                    <div class="d-flex justify-contents-center align-items-baseline px-2">
                                        <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                            Nhận</button>
                                        <button type="button" id="cancel-creator" class="btn btn-secondary btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <input type="hidden" id="sortByInput" name="sort-by" value="id">
                            <input type="hidden" id="sortTypeInput" name="sort-type"
                                value="{{ $sortType }}">
                            <th><input type="checkbox"></th>
                            <th scope="col">
                                <span class="d-flex">
                                    <a href="#" class="sort-link" data-sort-by="id"
                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                            type="submit">Mã đơn</button></a>
                                    <div class="icon" id="icon-id"></div>
                                </span>
                            </th>
                            <th scope="col">
                                <span class="d-flex">
                                    <a href="#" class="sort-link" data-sort-by="provide_name"
                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                            type="submit">Nhà cung cấp</button></a>
                                    <div class="icon" id="icon-provide_name"></div>
                                </span>
                            </th>
                            <th scope="col">
                                <span class="d-flex">
                                    <a href="#" class="sort-link" data-sort-by="updated_at"
                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                            type="submit">Chỉnh sửa cuối</button></a>
                                    <div class="icon" id="icon-updated_at"></div>
                                </span>
                            </th>
                            <th scope="col">
                                <span class="d-flex">
                                    <a href="#" class="sort-link" data-sort-by="name"
                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                            type="submit">Người tạo</button></a>
                                    <div class="icon" id="icon-name"></div>
                                </span>
                            </th>
                            <th scope="col">
                                <span class="d-flex">
                                    <a href="#" class="sort-link" data-sort-by="total"
                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                            type="submit">Tổng tiền</button></a>
                                    <div class="icon" id="icon-total"></div>
                                </span>
                            </th>
                            <th scope="col">
                                <span class="d-flex">
                                    <a href="#" class="sort-link" data-sort-by="order_status"
                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                            type="submit">Trạng thái</button></a>
                                    <div class="icon" id="icon-export_status"></div>
                                </span>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 1; ?>
                        @foreach ($orders as $va)
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>{{ $va->id }}</td>
                                <td>{{ $va->provide_name }}</td>
                                <td>{{ $va->updated_at }}</td>
                                <td>{{ $va->name }}</td>
                                <td>{{ number_format($va->total) }}</td>
                                <td>
                                    @if ($va->order_status == 0)
                                        <span class="p-2 bg-warning rounded">Chờ duyệt</span>
                                    @elseif($va->order_status == 1)
                                        <span class="p-2 bg-success rounded">Đã nhập hàng</span>
                                    @elseif($va->order_status == 2)
                                        <span class="p-2 bg-danger rounded">Đã hủy</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-between">
                                    <div class="edit">
                                        <a href="{{ route('insertProduct.edit', $va->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 32 32" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M18.7833 6.79458C18.9872 6.71003 19.2058 6.6665 19.4265 6.6665C19.6472 6.6665 19.8658 6.71003 20.0697 6.79458C20.2736 6.87914 20.4588 7.00306 20.6147 7.15927L21.9609 8.50539C22.117 8.66141 22.241 8.84668 22.3255 9.05063C22.41 9.25457 22.4536 9.47318 22.4536 9.69394C22.4536 9.9147 22.41 10.1333 22.3255 10.3373C22.241 10.5412 22.117 10.7265 21.9609 10.8825L20.281 12.5623C20.2712 12.5734 20.2611 12.5842 20.2505 12.5948C20.2399 12.6054 20.2291 12.6155 20.218 12.6253L11.5609 21.2825C11.4259 21.4175 11.2427 21.4933 11.0518 21.4933H8.34662C7.94899 21.4933 7.62665 21.171 7.62665 20.7734V18.0682C7.62665 17.8772 7.70251 17.6941 7.83755 17.5591L16.489 8.90836C16.5005 8.89507 16.5126 8.88211 16.5252 8.86949C16.5378 8.85686 16.5508 8.84479 16.5641 8.8333L18.2383 7.15927C18.3941 7.00328 18.5797 6.87905 18.7833 6.79458ZM17.0356 10.3981L9.0666 18.3664V20.0534H10.7536L18.7222 12.0847L17.0356 10.3981ZM19.7404 11.0665L18.0539 9.37997L19.2574 8.1766C19.2796 8.15436 19.3059 8.13672 19.3349 8.12468C19.364 8.11265 19.3951 8.10645 19.4265 8.10645C19.4579 8.10645 19.4891 8.11265 19.5181 8.12468C19.5471 8.13672 19.5739 8.1548 19.5961 8.17704L20.9429 9.52386C20.9653 9.54615 20.9832 9.57291 20.9953 9.60204C21.0074 9.63117 21.0136 9.6624 21.0136 9.69394C21.0136 9.72549 21.0074 9.75671 20.9953 9.78584C20.9832 9.81498 20.9653 9.84173 20.9429 9.86402L19.7404 11.0665ZM6.66669 24.6132C6.66669 24.2156 6.98903 23.8932 7.38666 23.8932H24.666C25.0636 23.8932 25.386 24.2156 25.386 24.6132C25.386 25.0108 25.0636 25.3332 24.666 25.3332H7.38666C6.98903 25.3332 6.66669 25.0108 6.66669 24.6132Z"
                                                    fill="#555555" />
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="input-group pt-2 justify-content-around">
                                        <select class="comparison_operator" name="comparison_operator" style="width: 40%">
                                            <option value=">=" {{ request('comparison_operator') === '>=' ? 'selected' : '' }}>>=
                                            </option>
                                            <option value="<=" {{ request('comparison_operator') === '<=' ? 'selected' : '' }}>
                                                <=< /option>
                                        </select>
                                        <input class="w-50 input-quantity sum-input" type="number" name="sum" value="{{ request()->sum }}" placeholder="Số lượng">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                        Nhận</button>
                                    <button type="button" id="cancel-sum" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Chỉnh sửa cuối --}}
                            <div class="block-options" id="update_at-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Chỉnh sửa cuối:</h5>
                                    </div>
                                    <div class="input-group pt-2 justify-content-around">
                                        <label for="start">Từ ngày:</label>
                                        <input type="date" id="start" name="trip_start" value="{{ request()->start }}" min="2018-01-01" max="2050-12-31">
                                        <label for="start">Đến ngày:</label>
                                        <input type="date" id="end" name="trip_end" value="{{ request()->end }}" min="2018-01-01" max="2050-12-31">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                        Nhận</button>
                                    <button type="button" id="cancel-update_at" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                        <input type="hidden" id="sortTypeInput" name="sort-type" value="{{ $sortType }}">
                        <th><input type="checkbox" name="all" id="checkall"></th>
                        <th scope="col">
                            <span class="d-flex">
                                <a href="#" class="sort-link" data-sort-by="id" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Mã đơn</button></a>
                                <div class="icon" id="icon-id"></div>
                            </span>
                        </th>
                        <th scope="col">
                            <span class="d-flex">
                                <a href="#" class="sort-link" data-sort-by="provide_name" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Nhà cung cấp</button></a>
                                <div class="icon" id="icon-provide_name"></div>
                            </span>
                        </th>
                        <th scope="col">
                            <span class="d-flex">
                                <a href="#" class="sort-link" data-sort-by="updated_at" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Chỉnh sửa cuối</button></a>
                                <div class="icon" id="icon-updated_at"></div>
                            </span>
                        </th>
                        <th scope="col">
                            <span class="d-flex">
                                <a href="#" class="sort-link" data-sort-by="name" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Người tạo</button></a>
                                <div class="icon" id="icon-name"></div>
                            </span>
                        </th>
                        <th scope="col">
                            <span class="d-flex">
                                <a href="#" class="sort-link" data-sort-by="total" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Tổng tiền</button></a>
                                <div class="icon" id="icon-total"></div>
                            </span>
                        </th>
                        <th scope="col">
                            <span class="d-flex">
                                <a href="#" class="sort-link" data-sort-by="order_status" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Trạng thái</button></a>
                                <div class="icon" id="icon-export_status"></div>
                            </span>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach ($orders as $va)
                    <tr class="{{$va->id}}">
                        <td><input type="checkbox" class="cb-element" name="ids[]" value="{{$va->id}}"></td>
                        <td>{{ $va->id }}</td>
                        <td>{{ $va->provide_name }}</td>
                        <td>{{ $va->updated_at }}</td>
                        <td>{{ $va->name }}</td>
                        <td>{{ number_format($va->total) }}</td>
                        <td>
                            @if ($va->order_status == 0)
                            <span class="p-2 bg-warning rounded">Chờ duyệt</span>
                            @elseif($va->order_status == 1)
                            <span class="p-2 bg-success rounded">Đã nhập hàng</span>
                            @elseif($va->order_status == 2)
                            <span class="p-2 bg-danger rounded">Đã hủy</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-between">
                            <div class="edit">
                                <a href="{{ route('insertProduct.edit', $va->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7833 6.79458C18.9872 6.71003 19.2058 6.6665 19.4265 6.6665C19.6472 6.6665 19.8658 6.71003 20.0697 6.79458C20.2736 6.87914 20.4588 7.00306 20.6147 7.15927L21.9609 8.50539C22.117 8.66141 22.241 8.84668 22.3255 9.05063C22.41 9.25457 22.4536 9.47318 22.4536 9.69394C22.4536 9.9147 22.41 10.1333 22.3255 10.3373C22.241 10.5412 22.117 10.7265 21.9609 10.8825L20.281 12.5623C20.2712 12.5734 20.2611 12.5842 20.2505 12.5948C20.2399 12.6054 20.2291 12.6155 20.218 12.6253L11.5609 21.2825C11.4259 21.4175 11.2427 21.4933 11.0518 21.4933H8.34662C7.94899 21.4933 7.62665 21.171 7.62665 20.7734V18.0682C7.62665 17.8772 7.70251 17.6941 7.83755 17.5591L16.489 8.90836C16.5005 8.89507 16.5126 8.88211 16.5252 8.86949C16.5378 8.85686 16.5508 8.84479 16.5641 8.8333L18.2383 7.15927C18.3941 7.00328 18.5797 6.87905 18.7833 6.79458ZM17.0356 10.3981L9.0666 18.3664V20.0534H10.7536L18.7222 12.0847L17.0356 10.3981ZM19.7404 11.0665L18.0539 9.37997L19.2574 8.1766C19.2796 8.15436 19.3059 8.13672 19.3349 8.12468C19.364 8.11265 19.3951 8.10645 19.4265 8.10645C19.4579 8.10645 19.4891 8.11265 19.5181 8.12468C19.5471 8.13672 19.5739 8.1548 19.5961 8.17704L20.9429 9.52386C20.9653 9.54615 20.9832 9.57291 20.9953 9.60204C21.0074 9.63117 21.0136 9.6624 21.0136 9.69394C21.0136 9.72549 21.0074 9.75671 20.9953 9.78584C20.9832 9.81498 20.9653 9.84173 20.9429 9.86402L19.7404 11.0665ZM6.66669 24.6132C6.66669 24.2156 6.98903 23.8932 7.38666 23.8932H24.666C25.0636 23.8932 25.386 24.2156 25.386 24.6132C25.386 25.0108 25.0636 25.3332 24.666 25.3332H7.38666C6.98903 25.3332 6.66669 25.0108 6.66669 24.6132Z" fill="#555555" />
                                    </svg>
                                </a>
                            </div>
                            <div id="dropdown_item{{ $va->id }}" data-toggle="collapse" data-target="#product-details-<?php echo $va->id; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.64162 12.3083C10.0527 11.8972 10.7192 11.8972 11.1303 12.3083L16 17.178L20.8697 12.3083C21.2808 11.8972 21.9473 11.8972 22.3583 12.3083C22.7694 12.7194 22.7694 13.3859 22.3583 13.797L16.7443 19.411C16.3332 19.8221 15.6667 19.8221 15.2557 19.411L9.64162 13.797C9.23054 13.3859 9.23054 12.7194 9.64162 12.3083Z" fill="#555555" />
                                </svg>
                            </div>
                        </td>
                    </tr>
                    @foreach ($product as $item)
                    <tr id="product-details-{{ $va->id }}" class="collapse">
                        @if ($va->id == $item->id)
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span>{{ $item->product_name }}</span></td>
                        <td><span>Số lượng</span>
                            <p>{{ $item->product_qty }}</p>
                        </td>
                        <td><span>Tổng tiên</span>
                            <p>{{ number_format($item->product_qty * $item->product_price) }}</p>
                        </td>
                        <td></td>
                        @endif
                    </tr>
                    @endforeach
                    <?php $stt++; ?>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" name="deleteOrder" id="deleteOrder" class="btn btn-danger">Xóa nhiều</button>
            <div class="paginator mt-4 d-flex justify-content-end">
                {{ $orders->appends(request()->except('page'))->links() }}
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    // AJAX Xóa Order by Order_id
    $(document).on('click', '#deleteOrder', function(e) {
        e.preventDefault();
        const list_id = [];
        $('input[name="ids[]"]').each(function() {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                list_id.push(value);

            }
        });
        $.ajax({
            url: "{{ route('deleteOrder') }}",
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
                }
            }
        })
    })

    // Checkbox
    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
    });

    $('.cb-element').change(function() {
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    });


    $('#btn-update_at').click(function(event) {
        event.preventDefault();
        $('#update_at-options').toggle();
    });
    $('#cancel-update_at').click(function(event) {
        event.preventDefault();
        $('#update_at-options').hide();
    });
    $('#btn-sum').click(function(event) {
        event.preventDefault();
        $('#sum-options').toggle();
    });
    $('#cancel-sum').click(function(event) {
        event.preventDefault();
        $('#sum-options').hide();
    });
    $('#btn-creator').click(function(event) {
        event.preventDefault();
        $('#creator-options').toggle();
    });
    $('#cancel-creator').click(function(event) {
        event.preventDefault();
        $('#creator-options').hide();
    });
    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('#status-options').toggle();
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('#status-options').hide();
    });
    $('#btn-id').click(function(event) {
        event.preventDefault();
        $('#id-options').toggle();
    });
    $('#cancel-id').click(function(event) {
        event.preventDefault();
        $('#id-options').hide();
    });

    $('#cancel-provide_name').click(function(event) {
        event.preventDefault();
        $('#provide_name-options').hide();
    });

    // Check box
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-provide_name').click(function() {
            $('#provide_name-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-provide_name').click(function() {
            $('#provide_name-options input[type="checkbox"]').prop('checked', false);
        });
        $('.select-all-creator').click(function() {
            $('#creator-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-creator').click(function() {
            $('#creator-options input[type="checkbox"]').prop('checked', false);
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

    //Xóa filter
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status', function() {
            $('.deselect-all').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-name', function() {
            $('.deselect-all-creator').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-id', function() {
            $('.id-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-guest', function() {
            $('.guest-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum', function() {
            $('.sum-input').val('');
            document.getElementById('search-filter').submit();
        });
    });

    $('#btn-provide_name').click(function(event) {
        event.preventDefault();
        $('#provide_name-options').toggle();
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


    //Sort
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
</script>
</body>

</html>