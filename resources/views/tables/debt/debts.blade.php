<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="d-flex mb-1">
                @can('view-guests')
                    <div class="class">
                        <button type="button" id="EXPORT_DEBT"
                            class="custom-btn btn btn-outline-primary d-flex align-items-center">
                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M15.0003 7.80054H16.5001C16.8979 7.80054 17.2794 7.95857 17.5607 8.23984C17.842 8.52112 18 8.9026 18 9.30039V17.1006C18 17.4983 17.842 17.8798 17.5607 18.1611C17.2794 18.4424 16.8979 18.6004 16.5001 18.6004H7.49986C7.10207 18.6004 6.72058 18.4424 6.4393 18.1611C6.15802 17.8798 6 17.4983 6 17.1006V9.30039C6 8.9026 6.15802 8.52112 6.4393 8.23984C6.72058 7.95857 7.10207 7.80054 7.49986 7.80054H8.99972"
                                    stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.99976 11.3997L11.9995 14.3994L15.0003 11.3997" stroke="#0095F6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.0006 3V13.7999" stroke="#0095F6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span>Xuất Excel</span>
                        </button>
                    </div>
                @endcan
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row mr-0">
                        <div class="col-md-5">
                            <input type="text" placeholder="Tìm kiếm theo mã hóa đơn và khách hàng" name="keywords"
                                class="pr-4 input-search w-100 form-control searchkeyword"
                                value="{{ request()->keywords }}">
                            <span id="search-icon" class="search-icon"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="col-2 d-none">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>

                        <div class="ml-auto">
                            <button class="btn btn-light" id="expandall" type="button" onclick="expand()"><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z"
                                        fill="#555555" />
                                </svg>
                                Mở rộng tất
                                cả</button>
                            <button class="btn btn-light" style="display: none" id="collapseall" type="button"
                                onclick="collapse()"><svg width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.7688 14.7688C16.4605 15.0771 15.9606 15.0771 15.6523 14.7688L12 11.1165L8.34772 14.7688C8.03941 15.0771 7.53954 15.0771 7.23123 14.7688C6.92292 14.4605 6.92292 13.9606 7.23123 13.6523L11.4418 9.44176C11.7501 9.13345 12.2499 9.13345 12.5582 9.44176L16.7688 13.6523C17.0771 13.9606 17.0771 14.4605 16.7688 14.7688Z"
                                        fill="#555555" />
                                </svg>
                                Thu gọn tất cả</button>
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
                            @if (Auth::user()->can('isAdmin'))
                                @php $nhanvien = [];
                                    if (isset(request()->nhanvien)) {
                                        $nhanvien = request()->nhanvien;
                                    } else {
                                        $nhanvien = [];
                                } @endphp
                                <div class="filter-admin">
                                    <button class="btn btn-filter btn-light mr-2" id="btn-nhanvien" type="button">
                                        <span>
                                            Nhân viên
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z"
                                                    fill="#555555" />
                                            </svg>

                                        </span>
                                    </button>
                                    {{-- Nhân viên admin --}}
                                    <div class="block-options-admin" id="creator-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Nhân viên</h5>
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
                                                    @if (!empty($debtsSale))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($debtsSale as $value)
                                                            @if (!in_array($value->name, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="name_active"
                                                                        {{ in_array($value->name, $nhanvien) ? 'checked' : '' }}
                                                                        name="nhanvien[]" value="{{ $value->name }}">
                                                                    <label id="nhanvien"
                                                                        for="">{{ $value->name }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->name;
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
                            @endif
                            <div class="class" style="order:999">
                                <div class="filter-options">
                                    <div class="dropdown">
                                        <button class="btn btn-filter btn-light" type="button"
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
                                        </button>
                                        <div class="dropdown-menu" id="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton">
                                            <div class="search-container px-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput"
                                                    onkeyup="filterFunction()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <button class="dropdown-item" id="btn-id">Hóa đơn ra</button>
                                            <button class="dropdown-item" id="btn-guest">Khách hàng</button>
                                            @if (!Auth::user()->can('isAdmin'))
                                                <button class="dropdown-item" id="btn-creator">Nhân viên</button>
                                            @endif
                                            <button class="dropdown-item" id="btn-sum-sale">Tổng tiền bán</button>
                                            <button class="dropdown-item" id="btn-sum-import">Tổng tiền nhập</button>
                                            <button class="dropdown-item" id="btn-sum-fee">Phí vận chuyển</button>
                                            <button class="dropdown-item" id="btn-sum-difference">Tổng tiền chênh
                                                lệch</button>
                                            <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter" href="{{ route('debt.index') }}"><span>Tắt
                                                    bộ
                                                    lọc</span></a>
                                        @endif
                                    </div>
                                    <?php $status = [];
                                    if (isset(request()->status)) {
                                        $status = request()->status;
                                    } else {
                                        $status = [];
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

                                    {{-- Tìm hóa đơn ra --}}
                                    <div class="block-options" id="id-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Hóa đơn ra</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="id" class="form-control id-input"
                                                    value="{{ request()->id }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-id"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm khách hàng --}}
                                    <div class="block-optionsss" id="guest-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Khách hàng</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-guest"
                                                    class="pr-4 w-100 input-search" onkeyup="filterGuest()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-guest mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-guest">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-guest p-0 mb-1 px-2">
                                                    @if (!empty($guests))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($guests as $value)
                                                            @if (!in_array($value->guests, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="name_active"
                                                                        {{ in_array($value->guests, $guest) ? 'checked' : '' }}
                                                                        name="guest[]" value="{{ $value->guests }}">
                                                                    <label id="guest"
                                                                        for="name">{{ $value->guests }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->guests;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>

                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-guest"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Status --}}
                                    <div class="block-options" id="status-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trạng thái</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-status"
                                                    class="input-search w-100 pr-4" onkeyup="filterStatus()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-status p-0 mb-1 px-2">
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(4, $status) ? 'checked' : '' }}
                                                            name="status[]" value="4">
                                                        <label for="">Chưa thanh toán</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(1, $status) ? 'checked' : '' }}
                                                            name="status[]" value="1">
                                                        <label for="">Thanh toán đủ</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(3, $status) ? 'checked' : '' }}
                                                            name="status[]" value="3">
                                                        <label for="">Công nợ</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(2, $status) ? 'checked' : '' }}
                                                            name="status[]" value="2">
                                                        <label for="">Gần đến hạn</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(0, $status) ? 'checked' : '' }}
                                                            name="status[]" value="0">
                                                        <label for="">Quá hạn</label>
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
                                    </div>
                                    {{-- Creator --}}
                                    <div class="block-options" id="creator-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Nhân viên</h5>
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
                                                    @if (!empty($debtsSale))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($debtsSale as $value)
                                                            @if (!in_array($value->name, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="name_active"
                                                                        {{ in_array($value->name, $nhanvien) ? 'checked' : '' }}
                                                                        name="nhanvien[]"
                                                                        value="{{ $value->name }}">
                                                                    <label id="nhanvien"
                                                                        for="">{{ $value->name }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->name;
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
                                    {{-- Tổng tiền bán --}}
                                    <div class="block-options" id="sale-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tổng tiền bán</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="sale_operator input-so" name="sale_operator"
                                                    style="width: 40%">
                                                    <option value=">="
                                                        {{ request('sale_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('sale_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity sale-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="sum_sale" value="{{ request()->sum_sale }}"
                                                    placeholder="Tổng tiền bán">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-sum-sale"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tổng tiền nhập --}}
                                    <div class="block-options" id="import-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tổng tiền nhập</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="import_operator input-so" name="import_operator"
                                                    style="width: 40%">
                                                    <option value=">="
                                                        {{ request('import_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('import_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity import-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="sum_import" value="{{ request()->sum_import }}"
                                                    placeholder="Tổng tiền nhập">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-sum-import"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Phí vận chuyển --}}
                                    <div class="block-options" id="fee-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Phí vận chuyển</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="fee_operator input-so" name="fee_operator"
                                                    style="width: 40%">
                                                    <option value=">="
                                                        {{ request('fee_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('fee_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity fee-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="sum_fee" value="{{ request()->sum_fee }}"
                                                    placeholder="Phí vận chuyển">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-sum-fee"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Chênh lệch --}}
                                    <div class="block-options" id="difference-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tổng tiền chênh lệch</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="difference_operator input-so"
                                                    name="difference_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('difference_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('difference_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity difference-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="sum_difference" value="{{ request()->sum_difference }}"
                                                    placeholder="Chênh lệch">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-sum-difference"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Công nợ --}}
                                    <div class="block-options" id="debt-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Công nợ</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <div class="start">
                                                    <label for="start">Từ ngày:</label>
                                                    <input type="date" id="start" name="date_start"
                                                        value="{{ request()->date_start }}" min="2018-01-01"
                                                        max="2050-12-31">
                                                </div>
                                                <div class="end">
                                                    <label for="start">Đến ngày:</label>
                                                    <input type="date" id="end" name="date_end"
                                                        value="{{ request()->date_end }}" min="2018-01-01"
                                                        max="2050-12-31">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-debt"
                                                class="btn btn-default btn-block">Hủy</button>
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
                    <div class="card scroll-custom">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-hover">
                                <thead class="sticky-head">
                                    {{-- SortType --}}
                                    <input type="hidden" id="perPageinput" name="perPageinput"
                                        value="{{ request()->perPageinput ?? 10 }}">
                                    <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                    <input type="hidden" id="sortTypeInput" name="sort-type">
                                    <tr>
                                        @can('view-guests')
                                            <th scope="col" style="width:2%">
                                                <span class="d-flex align-items-center">
                                                    <input type="checkbox" id="checkall">
                                                </span>
                                            </th>
                                        @endcan
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">HĐ ra</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="guest_id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Khách
                                                        hàng</button></a>

                                                <div class="icon" id="icon-guest_id"></div>
                                            </span>
                                        </th>
                                        @if (Auth::user()->can('isAdmin'))
                                            <th scope="col">
                                                <span class="d-flex align-items-center">
                                                    <a href="#" class="sort-link" data-sort-by="user_id"
                                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                            type="submit">Nhân
                                                            viên</button></a>
                                                    <div class="icon" id="icon-user_id"></div>
                                                </span>
                                            </th>
                                        @endif
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="total_sales"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng
                                                        tiền bán</button></a>
                                                <div class="icon" id="icon-total_sales"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="total_import"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng
                                                        tiền nhập</button></a>
                                                <div class="icon" id="icon-total_import"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="debt_transport_fee"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Phí vận
                                                        chuyển</button></a>
                                                <div class="icon" id="icon-debt_transport_fee"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="total_difference"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng
                                                        tiền chênh lệch</button></a>
                                                <div class="icon" id="icon-total_difference"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-start align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="debt"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Công
                                                        nợ</button></a>
                                                <div class="icon" id="icon-debt"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex justify-content-center align-items-center"
                                                style="width:135px;">
                                                <a href="#" class="sort-link" data-sort-by="debt_status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trạng
                                                        thái</button></a>
                                                <div class="icon" id="icon-debt_status"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-start align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="debt_note"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Ghi
                                                        chú</button></a>
                                                <div class="icon" id="icon-debt_note"></div>
                                            </span>
                                        </th>
                                        <th scope="col"></th>
                                        <th></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($debts as $value)
                                        @if (Auth::user()->id == $value->user_id || Auth::user()->can('isAdmin'))
                                            <tr class="{{ $value->id }}">
                                                @can('view-guests')
                                                    <td><input type="checkbox" name="ids[]" class="cb-element"
                                                            value="{{ $value->id }}"></td>
                                                @endcan
                                                <td class="text-left">{{ $value->hdr }}</td>
                                                <td class="">
                                                    {{ $value->khachhang }}
                                                </td>
                                                @if (Auth::user()->can('isAdmin'))
                                                    <td class="text-left">{{ $value->nhanvien }}</td>
                                                @endif
                                                <td class="text-right">
                                                    {{ number_format($value->total_sales) }}
                                                </td>
                                                <td class="text-right">{{ number_format($value->total_import) }}</td>
                                                <td class="text-right">
                                                    {{ number_format($value->debt_transport_fee) }}
                                                </td>
                                                <td class="text-right">{{ number_format($value->total_difference) }}
                                                </td>
                                                <td class="text-left" style="width: 125px">
                                                    @if ($value->debt != 0 && $value->debt_status != 1)
                                                        {{ $value->debt . ' ' }}ngày
                                                        <span>
                                                            <br>
                                                            {{ date_format(new DateTime($value->date_start), 'd-m-Y') }}
                                                            <br>

                                                            {{ date_format(new DateTime($value->date_end), 'd-m-Y') }}
                                                        </span>
                                                    @elseif($value->debt_status == 4)
                                                        <div id="payment" class="payment">Thanh toán tiền mặt</div>
                                                    @elseif($value->debt_status == 1)
                                                        Đã thanh toán ngày <br>
                                                        {{ date_format(new DateTime($value->updated_at), 'd-m-Y') }}
                                                    @endif
                                                    @php
                                                        $input_value = request('payment');
                                                    @endphp
                                                </td>
                                                <td class="text-center">
                                                    @if ($value->debt_status == 1)
                                                        <span class="p-2 bg-success rounded">Thanh toán đủ</span>
                                                    @elseif ($value->debt_status == 2)
                                                        <span class="p-2 bg-warning rounded">Gần đến hạn</span>
                                                    @elseif ($value->debt_status == 3)
                                                        <span class="p-2 bg-secondary rounded">Công nợ</span>
                                                    @elseif($value->debt_status == 0)
                                                        <span class="p-2 bg-danger rounded">Quá hạn</span>
                                                    @elseif($value->debt_status == 4)
                                                        <span class="p-2 bg-danger rounded">Chưa thanh toán</span>
                                                    @elseif($value->debt_status == 5)
                                                        <span class="p-2 bg-warning rounded">Đến hạn</span>
                                                    @endif
                                                </td>
                                                <td class="text-left">{{ $value->debt_note }}</td>
                                                <td class="text-center">
                                                    <div class="icon">
                                                        @if (Auth::user()->can('view-guests'))
                                                            <a href="{{ route('debt.edit', $value->id) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                    height="32" viewBox="0 0 32 32"
                                                                    fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                        fill="#555555" />
                                                                </svg>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('data.edit', $value->id) }}">
                                                                <svg width="32" height="32"
                                                                    viewBox="0 0 32 32" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M24.9033 14.1636V7.89258C24.9033 7.33819 24.6831 6.8065 24.2911 6.41449C23.8991 6.02248 23.3674 5.80225 22.813 5.80225H9.22583C8.67144 5.80225 8.13976 6.02248 7.74774 6.41449C7.35573 6.8065 7.1355 7.33819 7.1355 7.89258V22.5249C7.1355 23.0793 7.35573 23.611 7.74774 24.003C8.13976 24.395 8.67144 24.6152 9.22583 24.6152H14.4517"
                                                                        stroke="#555555" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M13.6678 18.3442H14.4517"
                                                                        stroke="#555555" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M13.6678 14.1631H17.5872"
                                                                        stroke="#555555" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path d="M13.6678 10.1133H20.7227"
                                                                        stroke="#555555" stroke-width="1.5"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />
                                                                    <path
                                                                        d="M11.0549 10.8187C11.2099 10.8187 11.3615 10.7727 11.4904 10.6866C11.6193 10.6005 11.7197 10.4781 11.7791 10.3348C11.8384 10.1916 11.8539 10.034 11.8237 9.88192C11.7934 9.72987 11.7188 9.59019 11.6092 9.48057C11.4995 9.37094 11.3599 9.29629 11.2078 9.26604C11.0557 9.23579 10.8981 9.25131 10.7549 9.31064C10.6117 9.36997 10.4892 9.47044 10.4031 9.59935C10.317 9.72826 10.271 9.87981 10.271 10.0349C10.271 10.2427 10.3536 10.4421 10.5006 10.5891C10.6476 10.7361 10.847 10.8187 11.0549 10.8187Z"
                                                                        fill="#555555" />
                                                                    <path
                                                                        d="M11.0549 14.9994C11.2099 14.9994 11.3615 14.9534 11.4904 14.8673C11.6193 14.7811 11.7197 14.6587 11.7791 14.5155C11.8384 14.3723 11.8539 14.2146 11.8237 14.0626C11.7934 13.9105 11.7188 13.7709 11.6092 13.6612C11.4995 13.5516 11.3599 13.477 11.2078 13.4467C11.0557 13.4165 10.8981 13.432 10.7549 13.4913C10.6117 13.5506 10.4892 13.6511 10.4031 13.78C10.317 13.9089 10.271 14.0605 10.271 14.2155C10.271 14.4234 10.3536 14.6228 10.5006 14.7698C10.6476 14.9168 10.847 14.9994 11.0549 14.9994Z"
                                                                        fill="#555555" />
                                                                    <path
                                                                        d="M11.0549 19.0756C11.2099 19.0756 11.3615 19.0296 11.4904 18.9435C11.6193 18.8573 11.7197 18.7349 11.7791 18.5917C11.8384 18.4484 11.8539 18.2908 11.8237 18.1388C11.7934 17.9867 11.7188 17.847 11.6092 17.7374C11.4995 17.6278 11.3599 17.5531 11.2078 17.5229C11.0557 17.4926 10.8981 17.5081 10.7549 17.5675C10.6117 17.6268 10.4892 17.7273 10.4031 17.8562C10.317 17.9851 10.271 18.1367 10.271 18.2917C10.271 18.4996 10.3536 18.699 10.5006 18.846C10.6476 18.993 10.847 19.0756 11.0549 19.0756Z"
                                                                        fill="#555555" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M24.2994 17.5757C22.6613 15.9376 20.0054 15.9376 18.3672 17.5757C16.7291 19.2139 16.7291 21.8698 18.3672 23.5079C20.0054 25.1461 22.6613 25.1461 24.2994 23.5079C25.9376 21.8698 25.9376 19.2139 24.2994 17.5757ZM25.1046 16.7706C23.0218 14.6878 19.6449 14.6878 17.5621 16.7706C15.4793 18.8534 15.4793 22.2303 17.5621 24.3131C19.6449 26.3959 23.0218 26.3959 25.1046 24.3131C27.1874 22.2303 27.1874 18.8534 25.1046 16.7706Z"
                                                                        fill="#555555" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M24.1834 24.1834C24.428 23.9389 24.8246 23.9389 25.0692 24.1834L27.8166 26.9308C28.0611 27.1754 28.0611 27.572 27.8166 27.8166C27.572 28.0611 27.1754 28.0611 26.9308 27.8166L24.1834 25.0692C23.9389 24.8246 23.9389 24.428 24.1834 24.1834Z"
                                                                        fill="#555555" />
                                                                </svg>
                                                            </a>
                                                        @endif

                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div id="dropdown_item{{ $value->id }}" data-toggle="collapse"
                                                        class="dropdownitem"
                                                        data-target="#product-details-<?php echo $value->id; ?>">
                                                        <svg width="32" height="32" viewBox="0 0 32 32"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M9.6418 12.3083C10.0529 11.8972 10.7194 11.8972 11.1305 12.3083L16.0002 17.178L20.8699 12.3083C21.281 11.8972 21.9474 11.8972 22.3585 12.3083C22.7696 12.7194 22.7696 13.3859 22.3585 13.797L16.7445 19.411C16.3334 19.8221 15.6669 19.8221 15.2558 19.411L9.6418 13.797C9.23073 13.3859 9.23073 12.7194 9.6418 12.3083Z"
                                                                fill="#555555" />
                                                        </svg>
                                                    </div>
                                                    <?php $stt = 0; ?>
                                                    @foreach ($product as $item)
                                                        @if ($value->export_id == $item->export_id)
                                            <tr id="product-details-{{ $value->id }}"
                                                class="collapse product-details">
                                                @can('view-guests')
                                                @endcan
                                                <td class="text-left"><?php echo $stt += 1; ?>
                                                </td>
                                                <td class="text-left w-auto">
                                                    <p>Tên sản phẩm</p>{{ $item->tensanpham }}
                                                </td>
                                                <td class="text-right">
                                                    <p>Số lượng</p>{{ $item->soluong }}
                                                </td>
                                                @if (Auth::user()->can('isAdmin'))
                                                    <td></td>
                                                @endif
                                                <td class="text-right">
                                                    <p>Giá bán</p>{{ number_format($item->giaban) }}
                                                </td>
                                                <td class="text-right">
                                                    <p>Giá nhập</p>
                                                    {{ number_format($item->gianhap) }}
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <p>Chênh lệch</p>
                                                    {{ number_format($item->giaban * $item->soluong - $item->gianhap * $item->soluong) }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    <div class="paginator mt-4 d-flex justify-content-end">
                        @if (Auth::user()->can('isAdmin'))
                            {{ $debts->appends(request()->except('page'))->links() }}
                        @else
                            {{ $debtsCreator->appends(request()->except('page'))->links() }}
                        @endif
                    </div>
                    {{-- @php
                        use App\Helpers\PaginationHelper;
                        
                        $debtsPagination = Auth::user()->can('isAdmin') ? $debts : $debtsCreator;
                        $paginationRange = PaginationHelper::calculatePaginationRange($debtsPagination->currentPage(), $debtsPagination->lastPage());
                        
                        $showFirstEllipsis = $paginationRange['start'] > 2;
                        $showLastEllipsis = $paginationRange['end'] < $debtsPagination->lastPage() - 1;
                    @endphp

                    @if ($debtsPagination->count() > 0)
                        <div class="pagination mt-4 d-flex justify-content-end">
                            <ul>
                                @if ($paginationRange['start'] > 1)
                                    <li><a href="{{ $debtsPagination->url(1) }}">1</a></li>
                                    @if ($showFirstEllipsis)
                                        <li><span>...</span></li>
                                    @endif
                                @endif

                                @for ($i = $paginationRange['start']; $i <= $paginationRange['end']; $i++)
                                    <li class="{{ $i == $debtsPagination->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $debtsPagination->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($paginationRange['end'] < $debtsPagination->lastPage())
                                    @if ($showLastEllipsis)
                                        <li><span>...</span></li>
                                    @endif
                                    <li><a
                                            href="{{ $debtsPagination->url($debtsPagination->lastPage()) }}">{{ $debtsPagination->lastPage() }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </section>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</div>
</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    $('#search-icon').on('click', function(e) {
        e.preventDefault();
        $('#search-filter').submit();
    });
    // Show all hide all
    function expand() {
        $('#expandall').hide();
        $('#collapseall').show();
        $(".product-details").addClass("show");
        var dropdownItems = $('[id^="dropdown_item"]');
        dropdownItems.addClass("dropdown-item-active");
        dropdownItems.attr("aria-expanded", "true");
        var svgs = dropdownItems.find('svg');
        svgs.addClass("svgactive")
        svgs.removeClass("svginative")
        var parentElement = dropdownItems.parent().parent();
        parentElement.css('background', '#ADB5BD');
    }

    function collapse() {
        $('#expandall').show();
        $('#collapseall').hide();
        $(".product-details").removeClass("show");
        var dropdownItems = $('[id^="dropdown_item"]');
        dropdownItems.removeClass("dropdown-item-active");
        dropdownItems.attr("aria-expanded", "false");
        var svgs = dropdownItems.find('svg');
        var parentElement = dropdownItems.parent().parent();
        parentElement.css('background', '#E9ECEF');
        svgs.removeClass("svgactive")
        svgs.addClass("svginative")
    }

    var dropdownItems = $('[id^="dropdown_item"]');

    function checkActiveItems() {
        var activeItemCount = dropdownItems.filter('.dropdown-item-active').length;
        return activeItemCount;
    }
    dropdownItems.each(function() {
        $(this).on('click', function() {
            var isActive = $(this).hasClass('dropdown-item-active');
            var svgElement = $(this).find('svg');
            var parentElement = $(this).parent().parent();
            console.log(parentElement);
            if (isActive) {
                $(this).removeClass('dropdown-item-active');
                parentElement.css('background', '#E9ECEF');
                svgElement.removeClass("svgactive")
                svgElement.addClass("svginative")
            }
            if (!isActive) {
                $(this).addClass('dropdown-item-active');
                parentElement.css('background', '#ADB5BD');
                svgElement.addClass("svgactive")
                svgElement.removeClass("svginative")
            }
            if (checkActiveItems() > 0) {
                $('#expandall').hide();
                $('#collapseall').show();

            } else {
                $('#expandall').show();
                $('#collapseall').hide();
            }
        });
    });
    $('#perPage').on('change', function(e) {
        e.preventDefault();
        var perPageValue = $(this).val();
        $('#perPageinput').val(perPageValue);
        $('#search-filter').submit();
    });

    // Xử lí filter ngày tháng
    $(document).ready(function() {
        $('#end').change(function() {
            var startDate = new Date($('#start').val());
            var endDate = new Date($(this).val());

            if (endDate < startDate) {
                alert('Ngày kết thúc không được nhỏ hơn ngày bắt đầu!');
                $(this).val('');
            }
        });
    });
    $('.ks-cboxtags-guest li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-status li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-creator li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('#btn-update_at').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#update_at-options').toggle();
    });
    $('#cancel-update_at').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#start').val('');
        $('#end').val('');
        $('#update_at-options').hide();
    });
    //Bán
    $('#btn-sum-sale').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#sale-options').toggle();
    });
    $('#cancel-sum-sale').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.sale-input').val('');
        $('#sale-options').hide();
    });
    // Nhập
    $('#btn-sum-import').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#import-options').toggle();
    });
    $('#cancel-sum-import').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.import-input').val('');
        $('#import-options').hide();
    });
    // Phí
    $('#btn-sum-fee').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#fee-options').toggle();
    });
    $('#cancel-sum-fee').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.fee-input').val('');
        $('#fee-options').hide();
    });
    // Chênh lệch
    $('#btn-sum-difference').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#difference-options').toggle();
    });
    $('#cancel-sum-difference').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.difference-input').val('');
        $('#difference-options').hide();
    });
    // Công nợ
    $('#btn-debt').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#debt-options').toggle();
    });
    $('#cancel-debt').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.debt-input').val('');
        $('#debt-options').hide();
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
        $('#creator-options input[type="checkbox"]').prop('checked', false);
        $('#creator-options').hide();
    });
    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('#status-options input').addClass('status-checkbox');
        $('.btn-filter').prop('disabled', true);
        $('.btn-filter').prop('disabled', true);
        $('#status-options').toggle();
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#status-options input[type="checkbox"]').prop('checked', false);
        $('#status-options').hide();
    });
    $('#btn-id').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#id-options').toggle();
    });
    $('#cancel-id').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.id-input').val('');
        $('#id-options').hide();
    });

    $('#btn-guest').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#guest-options').toggle();
    });
    $('#cancel-guest').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.guest-input').val('');
        $('#guest-options').hide();
    });

    // Check box
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-creator').click(function() {
            $('#creator-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-creator').click(function() {
            $('#creator-options input[type="checkbox"]').prop('checked', false);
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
        // Chọn tất cả các checkbox
        $('.select-all-guest').click(function() {
            $('#guest-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-guest').click(function() {
            $('#guest-options input[type="checkbox"]').prop('checked', false);
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
            $('.deselect-all-guest').click();
            document.getElementById('search-filter').submit();
        });
    });
    // bán
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum-sale', function() {
            $('.sale-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Nhập
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum-import', function() {
            $('.import-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // phí
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum-fee', function() {
            $('.fee-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Chênh lệch
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum-difference', function() {
            $('.difference-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Công nợ
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-debt', function() {
            $('#start').val('');
            $('#end').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $('#btn-nhanvien').click(function(event) {
        event.preventDefault();
        $('#creator-options input').addClass('creator-checkbox');
        $('.btn-filter').prop('disabled', true);
        $('#creator-options').toggle();
    });
    $('#cancel-creator').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#creator-options input[type="checkbox"]').prop('checked', false);
        $('#creator-options').hide();
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



    // Xuất file excel
    function exportToExcel() {
        // Lấy dữ liệu từ bảng HTML
        var table = document.getElementById("example2");

        // Tạo một workbook mới
        var wb = XLSX.utils.table_to_book(table);

        // Chuyển đổi workbook thành dạng tệp Excel
        var wbout = XLSX.write(wb, {
            bookType: "xlsx",
            type: "array"
        });

        // Tạo một Blob từ dữ liệu Excel
        var blob = new Blob([wbout], {
            type: "application/octet-stream"
        });

        // Tạo URL tạm thời và tải xuống tệp Excel
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "data.xlsx";
        a.click();

        // Giải phóng URL tạm thời
        setTimeout(function() {
            URL.revokeObjectURL(url);
        }, 1000);
    }

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

    $(document).on('click', '.cancal_action', function(e) {
        e.preventDefault();
        $('.cb-element:checked').prop('checked', false);
        $('#checkall').prop('checked', false);
        updateMultipleActionVisibility()
    })

    // Hiển thị form multiple action
    function updateMultipleActionVisibility() {
        if ($('.cb-element:checked').length > 0) {
            $('.multiple_action').show();
            $('.count_checkbox').text('Đã chọn ' + $('.cb-element:checked').length);
        } else {
            $('.multiple_action').hide();
        }
    }

    $('.product_category').change(function() {
        var product_id = $(this).attr('id');
        var category_id = $(this).val();
        var newRow = $('<tr>');
        newRow.attr('id', 'newRow');
        $('#example2').append(newRow);
        $.ajax({
            url: "{{ route('ajax') }}",
            type: "get",
            data: {
                product_id: product_id,
                category_id: category_id
            },
            success: function(data) {
                alert('Thay đổi thành công');
            }
        });
    })



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

    function filterTrademark() {
        var input = $("#myInput-trademark");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-trademark li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterCategory() {
        var input = $("#myInput-category");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-category li");

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


    function filterStatus() {
        var input = $("#myInput-status");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-status li");

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


    function myFunction() {
        let text = "Bạn có chắc chắn thanh toán các đơn đã chọn không?";
        if (confirm(text) == true) {
            return true
        } else {
            return false
        }

    }
    // AJAX Thanh toán Payment
    $(document).on('click', '#paymentdebt', function(e) {
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
                url: "{{ route('paymentdebt') }}",
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

    $(document).on('click', '#EXPORT_DEBT', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('exportDebt') }}",
            type: "get",
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    var products = response.data;
                    // Create a new workbook
                    var workbook = XLSX.utils.book_new();
                    // Create a new worksheet
                    var worksheet = XLSX.utils.json_to_sheet(products);
                    // Modify the column headers
                    var headers = [
                        'ID',
                        'HĐ ra',
                        'Khách hàng',
                        'Nhân viên',
                        'Tổng tiền bán',
                        'Tổng tiền nhập',
                        'Phí vận chuyển',
                        'Tổng tiền chênh lệch',
                        'Công nợ',
                        'Trạng thái',
                        'Ghi chú',
                    ];
                    // Update the column headers in the worksheet
                    worksheet['A1'].v = headers[0];
                    worksheet['B1'].v = headers[1];
                    worksheet['C1'].v = headers[2];
                    worksheet['D1'].v = headers[3];
                    worksheet['E1'].v = headers[4];
                    worksheet['F1'].v = headers[5];
                    worksheet['G1'].v = headers[6];
                    worksheet['H1'].v = headers[7];
                    worksheet['I1'].v = headers[8];
                    worksheet['J1'].v = headers[9];
                    worksheet['K1'].v = headers[10];

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Debt');

                    // Convert the workbook to a binary Excel file
                    var excelFile = XLSX.write(workbook, {
                        bookType: 'xlsx',
                        type: 'binary'
                    });

                    // Convert the binary Excel file to a Blob
                    var blob = new Blob([s2ab(excelFile)], {
                        type: 'application/octet-stream'
                    });

                    // Create a temporary <a> element to trigger the file download
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = 'CongNoXuat.xlsx';
                    link.click();
                } else {
                    console.log(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    })

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
        return buf;
    }
</script>
</body>

</html>
