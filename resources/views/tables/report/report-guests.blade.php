<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row link-report mb-1 mr-auto d-flex mt-auto px-0">
            <div class="col-12 pr-0">
                <div class="ml-auto choosetime" style="bottom: -35px !important">
                    <div class="col d-flex px-0" style="position: relative; width: auto">
                        <div class="dropdown w-100" style="z-index:999">
                            <button class="btn w-100 btn-light border rounded dropdown-toggle" id="orders"
                                style="display: flex;
                        justify-content: space-between;
                        align-items: center;"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{-- All orders --}}
                                <div id="all-orders">
                                    <div class="d-flex flex-column all-orders">
                                        <div class="ca d-flex">
                                            <div class="it0">{{ $mindate }}</div>
                                            @if ($mindate)
                                                <div class="muiten-all">-></div>
                                            @endif
                                            <div class="id0">{{ $maxdate }}</div>
                                        </div>
                                        <div class="ca text-left">Tất cả</div>
                                    </div>
                                </div>
                                {{-- Năm nay --}}
                                <div id="this-year-orders" style="display: none">
                                    <div class="d-flex flex-column all-orders">
                                        <div class="ca d-flex">
                                            <div class="it4"></div>->
                                            <div class="id4"></div>
                                        </div>
                                        <div class="ca text-left">Năm nay</div>
                                    </div>
                                </div>
                                {{-- Tháng này Orders --}}
                                <div id="this-month-orders" style="display: none">
                                    <div class="d-flex flex-column all-orders">
                                        <div class="ca d-flex">
                                            <div class="it1"></div>->
                                            <div class="id1"></div>
                                        </div>
                                        <div class="ca text-left">Tháng này</div>
                                    </div>
                                </div>
                                {{-- Tháng trước đây Orders --}}
                                <div id="last-month-orders" style="display: none">
                                    <div class="d-flex flex-column all-orders">
                                        <div class="ca d-flex">
                                            <div class="it2"></div>->
                                            <div class="id2"></div>
                                        </div>
                                        <div class="ca text-left">Tháng trước</div>
                                    </div>
                                </div>
                                {{-- 3 Tháng trước đây Orders --}}
                                <div id="3last-month-orders" style="display: none">
                                    <div class="d-flex flex-column all-orders">
                                        <div class="ca d-flex">
                                            <div class="it3"></div>->
                                            <div class="id3"></div>
                                        </div>
                                        <div class="ca text-left">3 tháng trước</div>
                                    </div>
                                </div>
                                {{-- Khoảng thời gian Orders --}}
                                <div id="time-orders" style="display: none">
                                    <div class="d-flex flex-column all-orders">
                                        <div class="ca d-flex">
                                            <div class="start_order"></div>
                                            <div class="muitenorder"></div>
                                            <div class="end_order"></div>
                                        </div>
                                        <div class="ca text-left">Khoảng thời gian</div>
                                    </div>
                                </div>

                            </button>
                            @if ($mindate)
                                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item dropdown-item-orders" id="btn-all-orders" href="#"
                                        data-value="0">Tất cả</a>
                                    <a class="dropdown-item dropdown-item-orders" id="btn-this-year-orders"
                                        href="#" data-value="4">Năm nay</a>
                                    <a class="dropdown-item dropdown-item-orders" id="btn-this-month-orders"
                                        href="#" data-value="1">Tháng này</a>
                                    <a class="dropdown-item dropdown-item-orders" id="btn-last-month-orders"
                                        href="#" data-value="2">Tháng trước</a>
                                    <a class="dropdown-item dropdown-item-orders" id="btn-3last-month-orders"
                                        href="#" data-value="3">3 tháng trước</a>
                                    <a class="dropdown-item dropdown-item-orders" id="btn-time-orders"
                                        href="#">Khoảng
                                        thời
                                        gian</a>
                                </div>
                            @endif
                        </div>
                        {{-- Chọn khoảng --}}
                        <div class="block-optionss" id="times-orders-options" style="display:none">
                            <div class="wrap w-100">
                                <div class="input-group p-2 justify-content-around">
                                    <div class="start">
                                        <label for="start">Từ ngày</label>
                                        <input type="date" name="date_start" class="date_start rounded">
                                    </div>
                                    <div class="end">
                                        <label for="start">Đến ngày</label>
                                        <input type="date" name="date_end" class="date_end rounded">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                <button type="button" class="suscess btn btn-primary btn-block mr-2"
                                    value="5">Xác
                                    nhận</button>
                                <button type="button" id="cancel-times-orders"
                                    class="btn btn-default btn-block">Hủy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="{{ route('indexImport') }}" class="title mr-2 pt-2 px-1 before" href="">
                    Nhập hàng
                </a>
                <a href="{{ route('indexExport') }}" class="title mr-2 pt-2 px-1 before">
                    Xuất hàng
                </a>
                <a href="{{ route('indexGuest') }}" class="title mr-2 pt-2 px-1 active">
                    Doanh số bán hàng
                </a>
            </div>

        </div>
        <hr class="hr">
        <div class="container-fluided">
            <div class="row m-auto filter">
                <div class="col-md-5 p-0">
                    <input type="text" id="search" placeholder="Tìm kiếm tên công ty" name="keywords"
                        class="pr-4 form-control input-search w-100 searchkeyword" value="">
                    <span id="search-icon" class="search-icon"><i class="fas fa-search sort-link"></i></span>
                    <input class="sort-link" type="submit" id="hidden-submit" name="hidden-submit"
                        style="display: none;">
                </div>
                <div class="col-2 d-none">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="d-flex justify-contents-center align-items-center mr-auto row-filter my-3 m-0">
                        <div class="icon-filter mr-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z"
                                    fill="#555555" />
                            </svg>
                        </div>
                        {{-- String --}}
                        <?php
                        session_start();
                        
                        $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        if ($fullUrl === route('exports.index')) {
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

                            <span class="filter-group" style="order:1;display:none">
                                <div class="filter-text"></div>
                                <a class="delete-item delete-btn-name">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </span>


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
                                    @if ($item['label'] === 'Công nợ:')
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
                            @endforeach
                            {{-- Tổng doanh số --}}
                            <div class="filter-admin">
                                <button class="btn btn-filter btn-light mr-2" id="btn-sales" type="button">
                                    <span>
                                        Tổng doanh số
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z"
                                                fill="#555555" />
                                        </svg>
                                    </span>
                                </button>
                                {{-- Tổng doanh số --}}
                                <div class="block-options-admin" id="sales-options" style="display:none">
                                    <div class="wrap w-100">
                                        <div class="heading-title title-wrap">
                                            <h5>Tổng doanh số</h5>
                                        </div>
                                        <div class="input-group p-2 justify-content-around">
                                            <select class="sales_operator input-so" name="sales_operator"
                                                style="width: 40%">
                                                <option value=">=">
                                                    >=
                                                </option>
                                                <option value="<=">
                                                    <= </option>
                                            </select>
                                            <input class="w-50 input-quantity sales-input" type="text"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                name="sales-input" value="" placeholder="Nhập giá">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-contents-center align-items-baseline p-2">
                                        <button type="submit" class="sort-link btn btn-primary btn-block mr-2">Xác
                                            Nhận</button>
                                        <button type="button" id="cancel-sales"
                                            class="btn btn-default btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>

                            <div class="class" style="order:999">
                                <div class="filter-options">
                                    <div class="dropdown">
                                        {{-- <button class="btn btn-filter btn-light" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <span><svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                                        fill="#555555" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                                        fill="#555555" />
                                                </svg>
                                                Thêm bộ lọc
                                            </span>
                                        </button> --}}
                                        <div class="dropdown-menu" id="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton">
                                            <div class="search-container px-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput"
                                                    onkeyup="filterFunction()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <button class="dropdown-item" id="btn-company">Tên công ty</button>
                                            {{-- <button class="dropdown-item" id="btn-roles">Vai trò</button> --}}
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter" href="{{ route('indexGuest') }}"><span>Tắt
                                                    bộ
                                                    lọc</span></a>
                                        @endif
                                    </div>
                                    <?php $roles = [];
                                    if (isset(request()->roles)) {
                                        $roles = request()->roles;
                                    } else {
                                        $roles = [];
                                    }
                                    $guest = [];
                                    if (isset(request()->guest)) {
                                        $guest = request()->guest;
                                    } else {
                                        $guest = [];
                                    }
                                    $nhanvien = [];
                                    if (isset(request()->nhanvien)) {
                                        $nhanvien = request()->nhanvien;
                                    } else {
                                        $nhanvien = [];
                                    }
                                    $sale_operator = null;
                                    $sum = null;
                                    //Tổng tiền
                                    if (isset(request()->sale_operator) && isset(request()->sum_sale)) {
                                        $sale_operator = request()->sale_operator;
                                        $sum = request()->sum_sale;
                                    } else {
                                        $sale_operator = null;
                                        $sum = null;
                                    }
                                    $import_operator = null;
                                    $sum = null;
                                    //Tổng tiền
                                    if (isset(request()->import_operator) && isset(request()->sum_import)) {
                                        $import_operator = request()->import_operator;
                                        $sum = request()->sum_import;
                                    } else {
                                        $import_operator = null;
                                        $sum = null;
                                    }
                                    $fee_operator = null;
                                    $sum = null;
                                    //Tổng tiền
                                    if (isset(request()->fee_operator) && isset(request()->sum_fee)) {
                                        $fee_operator = request()->fee_operator;
                                        $sum = request()->sum_fee;
                                    } else {
                                        $fee_operator = null;
                                        $sum = null;
                                    }
                                    $difference_operator = null;
                                    $sum = null;
                                    //Tổng tiền
                                    if (isset(request()->difference_operator) && isset(request()->sum_difference)) {
                                        $difference_operator = request()->difference_operator;
                                        $sum = request()->sum_difference;
                                    } else {
                                        $difference_operator = null;
                                        $sum = null;
                                    }
                                    // Công nợ
                                    if (isset(request()->debt_operator) && isset(request()->debt)) {
                                        $debt_operator = request()->debt_operator;
                                        $sum = request()->debt;
                                    } else {
                                        $debt_operator = null;
                                        $sum = null;
                                    }
                                    ?>

                                    <div class="block-options" id="company-options"
                                        style="display:none;width: 310px">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tên công ty</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-creator"
                                                    class="pr-4 w-100 input-search" onkeyup="filterCreator()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-creator mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-creator">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-creator p-0 mb-1 px-2">
                                                    @if (!empty($companyName))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($companyName as $value)
                                                            @if (!in_array($value->guest_name, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="name_active"
                                                                        {{ in_array($value->guest_name, $nhanvien) ? 'checked' : '' }}
                                                                        name="nhanvien[]"
                                                                        value="{{ $value->guest_name }}">
                                                                    <label id="nhanvien"
                                                                        for="">{{ $value->guest_name }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->guest_name;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-creator"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

    </section>
    <!-- Main content -->
    <div id="section_products">
        <section class="multiple_action">
            <div class="d-flex justify-content-between align-items-center">
                <span class="count_checkbox mr-5"></span>
                <div class="row action">
                    <div class="btn-taodon my-2 ml-3">
                        <button type="button" class="btn-group btn btn-light d-flex align-items-center"
                            id="paymentdebt">
                            <svg width="18" height="13" viewBox="0 0 18 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M17.2803 0.21967C17.5732 0.512563 17.5732 0.987437 17.2803 1.28033L6.28033 12.2803C5.98744 12.5732 5.51256 12.5732 5.21967 12.2803L0.21967 7.28033C-0.0732233 6.98744 -0.0732233 6.51256 0.21967 6.21967C0.512563 5.92678 0.987437 5.92678 1.28033 6.21967L5.75 10.6893L16.2197 0.21967C16.5126 -0.0732233 16.9874 -0.0732233 17.2803 0.21967Z"
                                    fill="#555555" />
                            </svg>
                            <span class="ml-2">Thanh toán</span>
                        </button>
                    </div>
                </div>
                <div class="cancal_action btn ml-auto">
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
        <div class="">
            <div class="row">
                <div class="col col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-hover">
                                <thead>
                                    <input type="hidden" id="perPageinput" name="perPageinput"
                                        value="{{ request()->perPageinput ?? 25 }}">
                                    <input type="hidden" id="sortByInput" name="sort-by" value="">
                                    <input type="hidden" id="sortTypeInput" name="sort-type"
                                        value="{{ $sortType }}">
                                    <tr>
                                        <th scope="col"><span class="d-flex justify-content-start">
                                                <a href="#" class="sort-link" data-sort-by="guest_name"
                                                    data-sort-type="ASC"><button class="btn-sort" type="submit">Tên
                                                        công ty
                                                    </button></a>
                                                <div class="icon" id="icon-guest_name"></div>
                                            </span></th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="totaltong"
                                                    data-sort-type="ASC"><button class="btn-sort" type="submit">Tổng
                                                        doanh số
                                                    </button></a>
                                                <div class="icon" id="icon-totaltong"></div>
                                            </span>
                                        </th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody id="yourTableId">
                                    <?php $stt = 1; ?>
                                    {{-- @foreach ($tableorders as $item)
                                        <tr id="guest_{{ $item->guest_id }}">
                                            <td class="text-left">{{ $item->guest_name }}</td>
                                            <td class="text-right"id="congno{{ $item->guest_id }}">
                                                {{ number_format($item->totaltong) }}
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    @foreach ($tableorders as $item)
                                        <tr id="guest_{{ $item->guest_id }}">
                                            <td class="text-left">{{ $item->guest_name }}</td>
                                            <td class="text-right" id="congno{{ $item->guest_id }}">
                                                {{ number_format($item->totaltong) }}
                                            </td>
                                            @foreach ($duplicateNames as $duplicate)
                                                @if ($item->guest_name === $duplicate->guest_name)
                                                    <input type="hidden" name="duplicate_id[]"
                                                        value="{{ $duplicate->ids }}">
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex row justify-content-between">
                        <div class="paginator mt-2 d-flex justify-content-start">
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
                        <div class="paginator mt-2 d-flex justify-content-end">
                            @if (Auth::user()->can('isAdmin'))
                                {{-- {{ $debts->appends(request()->except('page'))->links() }} --}}
                            @else
                                {{-- {{ $debtsCreator->appends(request()->except('page'))->links() }} --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</div>
</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    $('#perPage').on('change', function(e) {
        e.preventDefault();
        var perPageValue = $(this).val();
        $('#perPageinput').val(perPageValue);
        $('#search-filter').submit();
    });
    // Tất cả
    $("#btn-all-orders").click(function() {
        $("#all-orders").show();
        $("#this-month-orders").hide();
        $("#this-year-orders").hide();
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Năm nay
    $("#btn-this-year-orders").click(function() {
        $("#this-year-orders").show();
        $("#this-month-orders").hide();
        $("#all-orders").hide();
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Tháng này
    $("#btn-this-month-orders").click(function() {
        $("#this-month-orders").show();
        $("#all-orders").hide();
        $("#this-year-orders").hide();
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Tháng trước
    $("#btn-last-month-orders").click(function() {
        $("#last-month-orders").show();
        $("#all-orders").hide();
        $("#this-year-orders").hide();
        $("#this-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // 3 tháng trc
    $("#btn-3last-month-orders").click(function() {
        $("#3last-month-orders").show();
        $("#all-orders").hide();
        $("#this-year-orders").hide();
        $("#this-month-orders").hide();
        $("#last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Khoảng time
    $("#btn-time-orders").click(function() {
        $("#time-orders").show();
        $("#times-orders-options").show();
        $("#this-year-orders").hide();
        $("#all-orders").hide();
        $("#this-month-orders").hide();
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
        $('#orders').prop('disabled', true);
    });
    $('#cancel-times-orders').click(function(event) {
        event.preventDefault();
        $('#times-orders-options').hide();
        $('#orders').prop('disabled', false);
    });
    $('.suscess').click(function(event) {
        event.preventDefault();
        $('#times-orders-options').hide();
        $('#orders').prop('disabled', false);
    });
    $(document).on('change', '.date_start', function(e) {
        e.preventDefault();
        $('.start_order').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muitenorder').text('->');
    })
    $(document).on('change', '.date_end', function(e) {
        e.preventDefault();
        $('.end_order').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muitenorder').text('->');
    })
    $(document).on('click', '#btn-all-orders', function(e) {
        e.preventDefault();
        $('.muiten-all').text('->');
    })
    $(document).on('click', '#btn-all-orders', function(e) {
        e.preventDefault();
        $('.muiten-all').text('->');
    })

    function formatDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1; // Tháng tính từ 0 đến 11, cần +1
        var year = date.getFullYear();

        // Đảm bảo hiển thị 2 chữ số cho ngày và tháng
        day = (day < 10) ? '0' + day : day;
        month = (month < 10) ? '0' + month : month;

        return day + '-' + month + '-' + year;
    }

    function formatCurrency(value) {
        // Làm tròn đến số nguyên (bỏ qua phần thập phân)
        value = Math.round(value);

        // Check if the value is negative
        var isNegative = value < 0;
        value = Math.abs(value); // Get the absolute value for formatting

        // Xử lý phần nguyên
        var formattedValue = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Nếu là số âm, thêm dấu "-" vào đầu chuỗi
        if (isNegative) {
            formattedValue = "-" + formattedValue;
        }

        // Trả về kết quả đã định dạng
        return formattedValue;
    }
    $(document).ready(function() {
        // Guest
        // Khởi tạo mảng để lưu trữ các phần đuôi của ID
        var guestIds = [];
        var datestart;
        var dateend;
        // Lặp qua các phần tử <tr> để lấy phần đuôi của ID và lưu vào mảng guestIds
        var trElements = document.querySelectorAll('tr[id^="guest_"]');
        trElements.forEach(function(element) {
            var idParts = element.id.split('_'); // Tách chuỗi ID bằng dấu '_'
            if (idParts.length === 2) { // Kiểm tra nếu có đúng hai phần tử sau khi tách
                var idSuffix = idParts[1]; // Lấy phần tử thứ hai (phần đuôi)
                guestIds.push(idSuffix); // Thêm phần đuôi vào mảng guestIds
            }
        });

        // Xử lý dữ liệu trùng tên khách hàng thì lấy các id trùng của các khách hàng ra
        $('input[name="duplicate_id[]"]').each(function() {
            var duplicateIdValue = $(this).val();
            var idsArray = duplicateIdValue.split(',');
            for (var i = 0; i < idsArray.length; i++) {
                guestIds.push(idsArray[i]);
            }
        });

        var dataID;
        $(document).on('click', '.dropdown-item-orders', function() {
            var dataid = $(this).data('value');
            var search = $('#search').val();
            dataID = dataid;
            var sales_operator = $('select[name="sales_operator"]').val();
            var sales_input = $('input[name="sales-input"]').val();
            console.log('dasjldjaskd');
            if (sales_input != '' && sales_operator != '') {
                $('.filter-text').text('Tổng doanh thu ' + sales_operator +
                    sales_input);
                $('.filter-group').show();
            }
            $('.block-options-admin').hide();
            $('.btn-filter').prop('disabled', false);


            $.ajax({
                url: "{{ route('timeGuest') }}",
                type: "get",
                data: {
                    data: dataid,
                    guestIds: guestIds,
                    search: search,
                    sales_operator: sales_operator,
                    sales_input: sales_input,
                },
                success: function(data) {
                    if (data.start_date && data.end_date) {
                        var stId = '.it' + dataid;
                        var edId = '.id' + dataid;
                        $(stId).text(data.start_date)
                        $(edId).text(data.end_date)
                    }
                    datestart = data.start_date;
                    dateend = data.end_date;
                    data.test.sort(function(a, b) {
                        return b.totaltong - a
                            .totaltong;
                    });
                    var tbody = $('#yourTableId');
                    tbody.empty();
                    data.test.forEach(function(item) {
                        var rowHtml = `<tr id="guest_${item.guest_id}">
        <td class="text-left">${item.guest_name}</td>
        <td class="text-right">${formatCurrency(item.totaltong)}</td>
    </tr>`;
                        // Thêm hàng vào tbody
                        tbody.append(rowHtml);
                    });



                }
            })
        })
        $(document).on('click', '.suscess', function() {
            var data = $(this).val();
            var date_start = $('.date_start').val();
            var date_end = $('.date_end').val();
            var search = $('#search').val();
            dataID = data;
            var sales_operator = $('select[name="sales_operator"]').val();
            var sales_input = $('input[name="sales-input"]').val();

            if (sales_input != '' && sales_operator != '') {
                $('.filter-text').text('Tổng doanh thu ' + sales_operator +
                    sales_input);
                $('.filter-group').show();
            }
            $('.block-options-admin').hide();
            $('.btn-filter').prop('disabled', false);


            $.ajax({
                url: "{{ route('timeGuest') }}",
                type: "get",
                data: {
                    data: data,
                    date_start: date_start,
                    date_end: date_end,
                    guestIds: guestIds,
                    search: search,
                    sales_operator: sales_operator,
                    sales_input: sales_input,
                },
                success: function(data) {
                    datestart = data.start_date;
                    dateend = data.end_date;
                    data.test.sort(function(a, b) {
                        return b.totaltong - a
                            .totaltong;
                    });
                    var tbody = $('#yourTableId');
                    tbody.empty();
                    data.test.forEach(function(item) {
                        var rowHtml = `<tr>
        <td class="text-left">${item.guest_name}</td>
        <td class="text-right">${formatCurrency(item.totaltong)}</td>
    </tr>`;
                        // Thêm hàng vào tbody
                        tbody.append(rowHtml);
                    });
                }
            })
        })

        $('.sort-link').on('click', function(event) {
            event.preventDefault();
            // Get dữ liệu
            var sort_by = $(this).data('sort-by');
            var sort_type = $(this).data('sort-type');
            var search = $('.searchkeyword').val();
            var sales_operator = $('select[name="sales_operator"]').val();
            var sales_input = $('input[name="sales-input"]').val();

            if (sales_input != '' && sales_operator != '') {
                $('.filter-text').text('Tổng doanh thu ' + sales_operator +
                    sales_input);
                $('.filter-group').show();
            }
            $('.block-options-admin').hide();
            $('.btn-filter').prop('disabled', false);

            sort_type = (sort_type === 'ASC') ? 'DESC' : 'ASC';
            $(this).data('sort-type', sort_type);
            $('.icon').text('');
            var iconId = 'icon-' + sort_by;
            var iconDiv = $('#' + iconId);
            var svgtop =
                "<svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 19.0009C11.6332 19.0009 11.7604 18.9482 11.8542 18.8544C11.9480 18.7607 12.0006 18.6335 12.0006 18.5009V6.70789L15.1466 9.85489C15.2405 9.94878 15.3679 10.0015 15.5006 10.0015C15.6334 10.0015 15.7607 9.94878 15.8546 9.85489C15.9485 9.76101 16.0013 9.63367 16.0013 9.50089C16.0013 9.36812 15.9485 9.24078 15.8546 9.14689L11.8546 5.14689C11.8082 5.10033 11.7530 5.06339 11.6923 5.03818C11.6315 5.01297 11.5664 5 11.5006 5C11.4349 5 11.3697 5.01297 11.3090 5.03818C11.2483 5.06339 11.1931 5.10033 11.1466 5.14689L7.14663 9.14689C7.10014 9.19338 7.06327 9.24857 7.03811 9.30931C7.01295 9.37005 7 9.43515 7 9.50089C7 9.63367 7.05274 9.76101 7.14663 9.85489C7.24052 9.94878 7.36786 10.0015 7.50063 10.0015C7.63341 10.0015 7.76075 9.94878 7.85463 9.85489L11.0006 6.70789V18.5009C11.0006 18.6335 11.0533 18.7607 11.1471 18.8544C11.2408 18.9482 11.3680 19.0009 11.5006 19.0009Z' fill='#555555'/></svg>";
            var svgbot =
                "<svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z' fill='#555555'/></svg>"

            iconDiv.html((sort_type === 'ASC') ? svgtop : svgbot);
            // Gửi dữ liệu qua Ajax
            $.ajax({
                type: 'get',
                url: '{{ URL::to('searchGuestAjax') }}',
                data: {
                    'sort_by': sort_by,
                    'sort_type': sort_type,
                    'guestIds': guestIds,
                    'date_start': datestart,
                    'date_end': dateend,
                    'search': search,
                    'sales_operator': sales_operator,
                    'sales_input': sales_input,
                },
                success: function(data) {
                    $('tbody').html(data.output);
                }
            });
        });
        //Xóa filter
        $('.filter-results').on('click', '.delete-item', function() {
            $('.filter-group').hide();
            $('input[name="sales-input"]').val(null);
            var search = $('.searchkeyword').val();
            $.ajax({
                type: 'get',
                url: '{{ URL::to('searchGuestAjax') }}',
                data: {
                    'guestIds': guestIds,
                    'search': search,
                },
                success: function(data) {
                    $('tbody').html(data.output);
                }
            });
        });
    });


    //Doanh số
    $('#btn-sales').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#sales-options').toggle();
    });
    $('#cancel-sales').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.sales-input').val('');
        $('#sales-options').hide();
    });

    function filterCreator() {
        var input = $("#myInput-creator");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-creator li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Xử lí filter ngày tháng
    $(document).ready(function() {
        $('#end').blur(function() {
            var startValue = $('#start').val();
            var endValue = $(this).val();

            if (startValue && endValue) { // Kiểm tra cả hai trường đã được nhập đầy đủ
                var startDate = new Date(startValue);
                var endDate = new Date(endValue);

                // Kiểm tra ngày, tháng và năm trước khi thực hiện so sánh
                if (
                    endDate.getFullYear() < startDate.getFullYear() ||
                    (endDate.getFullYear() === startDate.getFullYear() &&
                        endDate.getMonth() < startDate.getMonth()) ||
                    (endDate.getFullYear() === startDate.getFullYear() &&
                        endDate.getMonth() === startDate.getMonth() &&
                        endDate.getDate() < startDate.getDate())
                ) {
                    alert('Ngày kết thúc không được nhỏ hơn ngày bắt đầu!');
                    $(this).val('');
                }
            }
        });
    });
    $('.ks-cboxtags-creator li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    // company
    $('#btn-company').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#company-options').toggle();
    });
    $('#cancel-company').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.company-input').val('');
        $('#company-options').hide();
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-company', function() {
            $('.company-input').val('');
            document.getElementById('search-filter').submit();
        });
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
    $('#btn-creator').click(function(event) {
        event.preventDefault();
        $('#creator-options input').addClass('creator-checkbox');
        $('.btn-filter').prop('disabled', true);
        $('#creator-options').toggle();
    });
    $('#cancel-creator').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#company-options input[type="checkbox"]').prop('checked', false);
        $('#company-options').hide();
    });

    $(document).ready(function() {
        $(".company-input").on("keypress", function(event) {
            if (event.which === 13) {
                event.preventDefault();
                $("#submit-company").click();
            }
        });
    });
    // Check box
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-creator').click(function() {
            $('#company-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-creator').click(function() {
            $('#company-options input[type="checkbox"]').prop('checked', false);
        });
    });


    // Checkbox
    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
        updateMultipleActionVisibility()
    });
    $('.cb-element').change(function() {
        updateMultipleActionVisibility()
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
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

    function filterGuest() {
        var input = $("#myInput-guest");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-guest li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }


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
