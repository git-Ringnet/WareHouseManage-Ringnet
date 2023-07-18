<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="d-flex mb-1">
                @can('view-guests')
                    <div class="class">
                        <button onclick="exportToExcel()" type="button"
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
                        <div class="col-5">
                            <input type="text" placeholder="Tìm kiếm" name="keywords"
                                class="pr-4 input-search w-100 form-control searchkeyword"
                                value="{{ request()->keywords }}">
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
                                    @if ($item['label'] === 'Thời gian:')
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
                                                <button class="dropdown-item" id="btn-creator">Nhân viên</button>
                                                <button class="dropdown-item" id="btn-update_at">Thời gian</button>
                                                <button class="dropdown-item" id="btn-provide_name">Nhà cung
                                                    cấp</button>
                                                <button class="dropdown-item" id="btn-id">Mặt hàng</button>
                                                <button class="dropdown-item" id="btn-product_qty">Số lượng
                                                    nhập</button>
                                                <button class="dropdown-item" id="btn-price_import">Giá nhập</button>
                                                <button class="dropdown-item" id="btn-sum-import">Thành tiền
                                                    nhập</button>
                                                <button class="dropdown-item" id="btn-hdv">Hóa đơn vào</button>
                                                <button class="dropdown-item" id="btn-status">Tình trạng nhập</button>
                                                <button class="dropdown-item" id="btn-guest">Khách hàng</button>
                                                <button class="dropdown-item" id="btn-export_qty">Số lượng
                                                    xuất</button>
                                                <button class="dropdown-item" id="btn-unit">Đơn vị tính</button>
                                                <button class="dropdown-item" id="btn-sum-sale">Giá bán</button>
                                                <button class="dropdown-item" id="btn-total-sale">Thành tiền
                                                    xuất</button>
                                                <button class="dropdown-item" id="btn-hdr">Hóa đơn ra</button>
                                                <button class="dropdown-item" id="btn-status_export">Tình trạng
                                                    xuất</button>
                                                <button class="dropdown-item" id="btn-total_difference">Lợi
                                                    nhuận</button>
                                                <button class="dropdown-item" id="btn-tranport_fee">Chi phí vận
                                                    chuyển</button>
                                            </div>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter" href="{{ route('history.index') }}"><span>Tắt
                                                    bộ lọc</span></a>
                                        @endif
                                    </div>
                                    <?php $status = [];
                                    if (isset(request()->status)) {
                                        $status = request()->status;
                                    } else {
                                        $status = [];
                                    }
                                    $status_export = [];
                                    if (isset(request()->status_export)) {
                                        $status_export = request()->status_export;
                                    } else {
                                        $status_export = [];
                                    }
                                    $unitarr = [];
                                    
                                    if (isset(request()->unitarr)) {
                                        $unitarr = request()->unitarr;
                                    } else {
                                        $unitarr = [];
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
                                    //giá bán
                                    if (isset(request()->sale_operator) && isset(request()->sum_sale)) {
                                        $sale_operator = request()->sale_operator;
                                        $sum = request()->sum_sale;
                                    } else {
                                        $sale_operator = null;
                                        $sum = null;
                                    }
                                    $total_sale_operator = null;
                                    $sum = null;
                                    //Thành tiền xuất
                                    if (isset(request()->total_sale_operator) && isset(request()->total_sum_sale)) {
                                        $total_sale_operator = request()->total_sale_operator;
                                        $sum = request()->total_sum_sale;
                                    } else {
                                        $total_sale_operator = null;
                                        $sum = null;
                                    }
                                    $total_difference_operator = null;
                                    $sum = null;
                                    //Lợi nhuận
                                    if (isset(request()->total_difference_operator) && isset(request()->total_difference)) {
                                        $total_difference_operator = request()->total_difference_operator;
                                        $sum = request()->total_difference;
                                    } else {
                                        $total_difference_operator = null;
                                        $sum = null;
                                    }
                                    $tranport_fee_operator = null;
                                    $sum = null;
                                    //Chi phí vận chuyển
                                    if (isset(request()->tranport_fee_operator) && isset(request()->tranport_fee)) {
                                        $tranport_fee_operator = request()->tranport_fee_operator;
                                        $sum = request()->tranport_fee;
                                    } else {
                                        $tranport_fee_operator = null;
                                        $sum = null;
                                    }
                                    $product_qty = null;
                                    $sum_product_qty_operator = null;
                                    //Số lượng nhập
                                    if (isset(request()->product_qty) && isset(request()->product_qty)) {
                                        $product_qty_operator = request()->product_qty_operator;
                                        $sum_product_qty_operator = request()->product_qty;
                                    } else {
                                        $product_qty_operator = null;
                                        $sum_product_qty_operator = null;
                                    }
                                    //Số lượng xuất
                                    $export_qty = null;
                                    $sum_export_qty_operator = null;
                                    if (isset(request()->export_qty) && isset(request()->export_qty)) {
                                        $export_qty_operator = request()->export_qty_operator;
                                        $sum_export_qty_operator = request()->export_qty;
                                    } else {
                                        $export_qty_operator = null;
                                        $sum_export_qty_operator = null;
                                    }
                                    // Giá nhập
                                    $price_import = null;
                                    $sum_price_import_operator = null;
                                    if (isset(request()->price_import) && isset(request()->price_import)) {
                                        $price_import_operator = request()->price_import_operator;
                                        $sum_price_import_operator = request()->price_import;
                                    } else {
                                        $price_import_operator = null;
                                        $sum_price_import_operator = null;
                                    }
                                    
                                    $import_operator = null;
                                    $sum = null;
                                    //Tổng tiền nhập
                                    if (isset(request()->import_operator) && isset(request()->sum_import)) {
                                        $import_operator = request()->import_operator;
                                        $sum = request()->sum_import;
                                    } else {
                                        $import_operator = null;
                                        $sum = null;
                                    }
                                    $provide_namearr = [];
                                    if (isset(request()->provide_namearr)) {
                                        $provide_namearr = request()->provide_namearr;
                                    } else {
                                        $provide_namearr = [];
                                    }
                                    ?>

                                    {{-- Tìm mặt hàng --}}
                                    <div class="block-options" id="id-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Mặt hàng</h5>
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
                                    {{-- Tìm hóa đơn vào --}}
                                    <div class="block-options" id="hdv-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Hóa đơn vào</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="hdv" class="form-control hdv-input"
                                                    value="{{ request()->hdv }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-hdv"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm hóa đơn ra --}}
                                    <div class="block-options" id="hdr-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Hóa đơn ra</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="hdr" class="form-control hdr-input"
                                                    value="{{ request()->hdr }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-hdr"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm nhà cung cấp --}}
                                    <div class="block-options" id="provide_name-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Nhà cung cấp</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm"
                                                    id="myInput-provide-name" class="pr-4 w-100 input-search"
                                                    onkeyup="filterProvidename()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-provide_name mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-provide_name">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-provide_name p-0 mb-1 px-2">
                                                    @if (!empty($provides))
                                                        @foreach ($provides as $value)
                                                            <li>
                                                                <input type="checkbox" id="roles_active"
                                                                    {{ in_array($value->id, $provide_namearr) ? 'checked' : '' }}
                                                                    name="provide_namearr[]"
                                                                    value="{{ $value->id }}">
                                                                <label
                                                                    for="">{{ $value->provide_name }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-provide_name"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Status nhập --}}
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
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(5, $status) ? 'checked' : '' }}
                                                            name="status[]" value="5">
                                                        <label for="">Đến hạn</label>
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
                                    {{-- Status xuất --}}
                                    <div class="block-options" id="status_export-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tình trạng xuất</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm"
                                                    id="myInput-status_export" class="input-search w-100 pr-4"
                                                    onkeyup="filterStatus_export()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-status-export">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-status_export p-0 mb-1 px-2">
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(4, $status_export) ? 'checked' : '' }}
                                                            name="status_export[]" value="4">
                                                        <label for="">Chưa thanh toán</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(1, $status_export) ? 'checked' : '' }}
                                                            name="status_export[]" value="1">
                                                        <label for="">Thanh toán đủ</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(3, $status_export) ? 'checked' : '' }}
                                                            name="status_export[]" value="3">
                                                        <label for="">Công nợ</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(2, $status_export) ? 'checked' : '' }}
                                                            name="status_export[]" value="2">
                                                        <label for="">Gần đến hạn</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(0, $status_export) ? 'checked' : '' }}
                                                            name="status_export[]" value="0">
                                                        <label for="">Quá hạn</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(5, $status_export) ? 'checked' : '' }}
                                                            name="status_export[]" value="5">
                                                        <label for="">Đến hạn</label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-status_export"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Nhân viên --}}
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
                                                <a class="cursor select-all-creator mr-auto">Chọn tất
                                                    cả</a>
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
                                    {{-- Số lượng nhập --}}
                                    <div class="block-options" id="product_qty-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Số lượng nhập</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="product_qty_operator input-so"
                                                    name="product_qty_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('product_qty_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('product_qty_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity product_qty-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="product_qty" value="{{ request()->product_qty }}"
                                                    placeholder="Số lượng">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-product_qty"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Số lượng xuất --}}
                                    <div class="block-options" id="export_qty-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Số lượng xuất</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="export_qty_operator input-so"
                                                    name="export_qty_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('export_qty_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('export_qty_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity export_qty-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="export_qty" value="{{ request()->export_qty }}"
                                                    placeholder="Số lượng">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-export_qty"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm khách hàng --}}
                                    <div class="block-options" id="guest-options" style="display:none">
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
                                                <a class="cursor select-all-guest mr-auto">Chọn tất
                                                    cả</a>
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
                                    {{-- Giá nhập --}}
                                    <div class="block-options" id="price_import-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Giá nhập</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="price_import_operator input-so"
                                                    name="price_import_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('price_import_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('price_import_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity price_import-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="price_import" value="{{ request()->price_import }}"
                                                    placeholder="Nhập giá">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-price_import"
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
                                    {{-- Giá bán --}}
                                    <div class="block-options" id="sale-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Giá bán</h5>
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
                                                    placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-sum-sale"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Thành tiền xuất --}}
                                    <div class="block-options" id="total-sale-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Thành tiền xuất</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="total_sale_operator input-so"
                                                    name="total_sale_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('total_sale_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('total_sale_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity total-sale-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="total_sum_sale" value="{{ request()->total_sum_sale }}"
                                                    placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-total-sale"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Lợi nhuận --}}
                                    <div class="block-options" id="total_difference-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Lợi nhuận</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="total_difference_operator input-so"
                                                    name="total_difference_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('total_difference_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('total_difference_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity total_difference-input"
                                                    type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="total_difference" value="{{ request()->total_difference }}"
                                                    placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-total_difference"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Chi phí vận chuyển --}}
                                    <div class="block-options" id="tranport_fee-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Chi phí vận chuyển</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="tranport_fee_operator input-so"
                                                    name="tranport_fee_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('tranport_fee_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('tranport_fee_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity tranport_fee-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="tranport_fee" value="{{ request()->tranport_fee }}"
                                                    placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-tranport_fee"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Đơn vị tính --}}
                                    <div class="block-options" id="unit-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Đơn vị tính</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-unit"
                                                    class="pr-4 w-100 input-search" onkeyup="filterUnit()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-unit mr-auto">Chọn tất
                                                    cả</a>
                                                <a class="cursor deselect-all-unit">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-unit p-0 mb-1 px-2">
                                                    @if (!empty($guests))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($guests as $value)
                                                            @if (!in_array($value->unit, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="unit_active"
                                                                        {{ in_array($value->unit, $unitarr) ? 'checked' : '' }}
                                                                        name="unitarr[]" value="{{ $value->unit }}">
                                                                    <label id="unit_value"
                                                                        for="">{{ $value->unit }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->unit;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>

                                                <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                        Nhận</button>
                                                    <button type="button" id="cancel-unit"
                                                        class="btn btn-default btn-block">Hủy</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Thời gian --}}
                                        <div class="block-options" id="update_at-options" style="display:none">
                                            <div class="wrap w-100">
                                                <div class="heading-title title-wrap">
                                                    <h5>Thời gian</h5>
                                                </div>
                                                <div class="input-group p-2 justify-content-around">
                                                    <label for="start">Từ ngày:</label>
                                                    <input type="date" id="start" name="trip_start"
                                                        value="{{ request()->trip_start }}" min="2018-01-01"
                                                        max="2050-12-31">
                                                    <label for="start">Đến ngày:</label>
                                                    <input type="date" id="end" name="trip_end"
                                                        value="{{ request()->trip_end }}" min="2018-01-01"
                                                        max="2050-12-31">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-update_at"
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
                            id="paymentdebtimport">
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
                                    {{-- SortType --}}
                                    <input type="hidden" id="sortByInput" name="sort-by" value="history.id">
                                    <input type="hidden" id="sortTypeInput" name="sort-type">
                                    <tr>
                                        <th scope="col" style="width:2%">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="history.id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">STT</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Nhân viên</button></a>
                                                <div class="icon" id="icon-name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center" style="width:110px;">
                                                <a href="#" class="sort-link" data-sort-by="date_time"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thời gian</button></a>
                                                <div class="icon" id="icon-date_time"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-left">
                                            <span class="d-flex justify-content-start" style="width:100px;">
                                                <a href="#" class="sort-link" data-sort-by="provide_name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">NCC</button></a>
                                                <div class="icon" id="icon-provide_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-left">
                                            <span class="d-flex justify-content-start" style="width:110px;">
                                                <a href="#" class="sort-link" data-sort-by="product_name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Mặt hàng</button></a>
                                                <div class="icon" id="icon-product_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_qty"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">SL nhập</button></a>
                                                <div class="icon" id="icon-product_qty"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="price_import"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Giá nhập</button></a>
                                                <div class="icon" id="icon-price_import"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-end">
                                                <a href="#" class="sort-link" data-sort-by="product_total"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thành tiền nhập</button></a>
                                                <div class="icon" id="icon-product_total"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="import_code"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">HĐ vào</button></a>
                                                <div class="icon" id="icon-import_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex justify-content-center align-items-center"
                                                style="width:125px;">
                                                <a href="#" class="sort-link" data-sort-by="debt_import"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Công nợ nhập</button></a>
                                                <div class="icon" id="icon-debt_import"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex justify-content-center align-items-center"
                                                style="width:135px;">
                                                <a href="#" class="sort-link" data-sort-by="import_status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tình trạng nhập</button></a>
                                                <div class="icon" id="icon-import_status"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex justify-content-center align-items-center"
                                                style="width:110px;">
                                                <a href="#" class="sort-link" data-sort-by="guest_name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Khách hàng</button></a>
                                                <div class="icon" id="icon-guest_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="export_qty"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">SL xuất</button></a>
                                                <div class="icon" id="icon-export_qty"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="export_unit"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ĐVT</button></a>
                                                <div class="icon" id="icon-export_unit"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="price_export"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Giá bán</button></a>
                                                <div class="icon" id="icon-price_export"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="export_total"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thành tiền xuất</button></a>
                                                <div class="icon" id="icon-export_total"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="export_code"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">HĐ ra</button></a>
                                                <div class="icon" id="icon-export_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-left">
                                            <span class="d-flex justify-content-center align-items-start"
                                                style="width:125px;">
                                                <a href="#" class="sort-link" data-sort-by="debt_export"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Công nợ xuất</button></a>
                                                <div class="icon" id="icon-debt_export"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center" style="width:135px;">
                                                <a href="#" class="sort-link" data-sort-by="export_status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tình trạng xuất</button></a>
                                                <div class="icon" id="icon-export_status"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="total_difference"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Lợi nhuận</button></a>
                                                <div class="icon" id="icon-total_difference"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="tranport_fee"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Chi phí VC</button></a>
                                                <div class="icon" id="icon-tranport_fee"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="history_note"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Ghi
                                                        chú</button></a>
                                                <div class="icon" id="icon-history_note"></div>
                                            </span>
                                        </th>
                                        <th scope="col"></th>
                                        <th></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    <?php $stt = 1; ?>
                                    @foreach ($history as $item)
                                        <tr>
                                            <td><?php echo $stt++; ?></td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ date_format(new DateTime($item->date_time), 'd-m-Y') }}</td>
                                            <td>{{ $item->provide_name }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->product_qty }}</td>
                                            <td>{{ number_format($item->price_import) }}</td>
                                            <td>{{ number_format($item->product_total) }}</td>
                                            <td>{{ $item->import_code }}</td>
                                            <td class="text-left" style="width: 125px">
                                                @if ($item->debt_import != 0 && $item->import_status != 1)
                                                    {{ $item->debt_import . ' ' }}ngày
                                                    <span>
                                                        <br>
                                                        {{ date_format(new DateTime($item->debt_import_start), 'd-m-Y') }}
                                                        <br>

                                                        {{ date_format(new DateTime($item->debt_import_end), 'd-m-Y') }}
                                                    </span>
                                                @elseif($item->import_status == 4)
                                                    <div id="payment" class="payment">Thanh toán tiền mặt</div>
                                                @elseif($item->import_status == 1)
                                                    Đã thanh toán ngày <br>
                                                    {{ date_format(new DateTime($item->updated_at), 'd-m-Y') }}
                                                @endif
                                                @php
                                                    $input_value = request('payment');
                                                @endphp
                                            </td>
                                            <td class="text-center">
                                                @if ($item->import_status == 1)
                                                    <span class="p-2 bg-success rounded">Thanh toán đủ</span>
                                                @elseif ($item->import_status == 2)
                                                    <span class="p-2 bg-warning rounded">Gần đến hạn</span>
                                                @elseif ($item->import_status == 3)
                                                    <span class="p-2 bg-secondary rounded">Công nợ</span>
                                                @elseif($item->import_status == 0)
                                                    <span class="p-2 bg-danger rounded">Quá hạn</span>
                                                @elseif($item->import_status == 4)
                                                    <span class="p-2 bg-danger rounded">Chưa thanh toán</span>
                                                @elseif($item->import_status == 5)
                                                    <span class="p-2 bg-warning rounded">Đến hạn</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->guest_name }}</td>
                                            <td>{{ $item->export_qty }}</td>
                                            <td>{{ $item->export_unit }}</td>
                                            <td>{{ number_format($item->price_export) }}</td>
                                            <td>{{ number_format($item->export_total) }}</td>
                                            <td>{{ $item->export_code }}</td>
                                            <td class="text-left" style="width: 125px">
                                                @if ($item->debt_export != 0 && $item->export_status != 1)
                                                    {{ $item->debt_export . ' ' }}ngày
                                                    <span>
                                                        <br>
                                                        {{ date_format(new DateTime($item->debt_export_start), 'd-m-Y') }}
                                                        <br>
                                                        {{ date_format(new DateTime($item->debt_export_end), 'd-m-Y') }}
                                                    </span>
                                                @elseif($item->export_status == 4)
                                                    <div id="payment" class="payment">Thanh toán tiền mặt</div>
                                                @elseif($item->export_status == 1)
                                                    Đã thanh toán ngày <br>
                                                    {{ date_format(new DateTime($item->updated_at), 'd-m-Y') }}
                                                @endif
                                                @php
                                                    $input_value = request('payment');
                                                @endphp
                                            </td>
                                            <td class="text-center" style="width:125px">
                                                @if ($item->export_status == 1)
                                                    <span class="p-2 bg-success rounded">Thanh toán đủ</span>
                                                @elseif ($item->export_status == 2)
                                                    <span class="p-2 bg-warning rounded">Gần đến hạn</span>
                                                @elseif ($item->export_status == 3)
                                                    <span class="p-2 bg-secondary rounded">Công nợ</span>
                                                @elseif($item->export_status == 0)
                                                    <span class="p-2 bg-danger rounded">Quá hạn</span>
                                                @elseif($item->export_status == 4)
                                                    <span class="p-2 bg-danger rounded">Chưa thanh toán</span>
                                                @elseif($item->export_status == 5)
                                                    <span class="p-2 bg-warning rounded">Đến hạn</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->total_difference) }}</td>
                                            <td>{{ number_format($item->tranport_fee) }}</td>
                                            <td>{{ $item->history_note }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="paginator mt-4 d-flex justify-content-end">
                        @if (Auth::user()->can('isAdmin'))
                            {{ $history->appends(request()->except('page'))->links() }}
                        @else
                            {{ $history->appends(request()->except('page'))->links() }}
                        @endif
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
    // AJAX Thanh toán Payment
    $(document).on('click', '#paymentdebtimport', function(e) {
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
                url: "{{ route('paymentdebtimport') }}",
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
    }

    function collapse() {
        $('#expandall').show();
        $('#collapseall').hide();
        $(".product-details").removeClass("show");
        var dropdownItems = $('[id^="dropdown_item"]');
        dropdownItems.removeClass("dropdown-item-active");
        dropdownItems.attr("aria-expanded", "false");
        var svgs = dropdownItems.find('svg');
        svgs.removeClass("svgactive")
        svgs.addClass("svginative")
    }

    var dropdownItems = $('[id^="dropdown_item"]');
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
        });
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
    $('.ks-cboxtags-provide_name li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-unit li').on('click', function(event) {
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
    $('.ks-cboxtags-guest li').on('click', function(event) {
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
    //Số lượng nhập
    $('#btn-product_qty').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#product_qty-options').toggle();
    });
    $('#cancel-product_qty').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.product_qty-input').val('');
        $('#product_qty-options').hide();
    });
    //Số lượng xuất
    $('#btn-export_qty').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#export_qty-options').toggle();
    });
    $('#cancel-export_qty').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.export_qty-input').val('');
        $('#export_qty-options').hide();
    });
    //Giá nhập
    $('#btn-price_import').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#price_import-options').toggle();
    });
    $('#cancel-price_import').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.price_import-input').val('');
        $('#price_import-options').hide();
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
    // Thành tiền xuất
    $('#btn-total-sale').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#total-sale-options').toggle();
    });
    $('#cancel-total-sale').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.total-sale-input').val('');
        $('#total-sale-options').hide();
    });
    // Lợi nhuận
    $('#btn-total_difference').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#total_difference-options').toggle();
    });
    $('#cancel-total_difference').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.total_difference-input').val('');
        $('#total_difference-options').hide();
    });
    // Chi phí vận chuyển
    $('#btn-tranport_fee').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#tranport_fee-options').toggle();
    });
    $('#cancel-tranport_fee').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.tranport_fee-input').val('');
        $('#tranport_fee-options').hide();
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
    // tình trạng nhập
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
    // tình trạng xuất
    $('#btn-status_export').click(function(event) {
        event.preventDefault();
        $('#status_export-options input').addClass('status-checkbox');
        $('.btn-filter').prop('disabled', true);
        $('.btn-filter').prop('disabled', true);
        $('#status_export-options').toggle();
    });
    $('#cancel-status_export').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#status_export-options input[type="checkbox"]').prop('checked', false);
        $('#status_export-options').hide();
    });
    // Mặt hàng
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
    // Đơn vị tính
    $('#btn-unit').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#unit-options').toggle();
    });
    $('#cancel-unit').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.unit-input').val('');
        $('#unit-options').hide();
    });

    // Hóa đơn vào
    $('#btn-hdv').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#hdv-options').toggle();
    });
    $('#cancel-hdv').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.hdv-input').val('');
        $('#hdv-options').hide();
    });
    // Hóa đơn ra
    $('#btn-hdr').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#hdr-options').toggle();
    });
    $('#cancel-hdr').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.hdr-input').val('');
        $('#hdr-options').hide();
    });

    $('#btn-provide_name').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#provide_name-options input').addClass('provide_name-checkbox');
        $('#provide_name-options').toggle();
    });
    $('#cancel-provide_name').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.deselect-all-provide_name').click();
        $('#provide_name-options').hide();
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
        $('.select-all-provide_name').click(function() {
            $('#provide_name-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-provide_name').click(function() {
            $('#provide_name-options input[type="checkbox"]').prop('checked', false);
        });
        // Chọn tất cả các checkbox
        $('.select-all-creator').click(function() {
            $('#creator-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-creator').click(function() {
            $('#creator-options input[type="checkbox"]').prop('checked', false);
        });
        // Chọn tất cả các checkbox
        $('.select-all').click(function() {
            $('#status-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all').click(function() {
            $('#status-options input[type="checkbox"]').prop('checked', false);
        });
        // Hủy tất cả các checkbox
        $('.deselect-all-status-import').click(function() {
            $('#status-import-options input[type="checkbox"]').prop('checked', false);
        });
        // Chọn tất cả các checkbox
        $('.select-all-guest').click(function() {
            $('#guest-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-guest').click(function() {
            $('#guest-options input[type="checkbox"]').prop('checked', false);
        });
        $('.select-all-unit').click(function() {
            $('#unit-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-unit').click(function() {
            $('#unit-options input[type="checkbox"]').prop('checked', false);
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
        $('.filter-results').on('click', '.delete-btn-guest', function() {
            $('.deselect-all-guest').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status-import', function() {
            $('.deselect-all-status-import').click();
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
    // Số lượng nhập
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-product_qty', function() {
            $('.product_qty-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-export_qty', function() {
            $('.export_qty-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Giá nhập
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-price_import', function() {
            $('.price_import-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Thành tiền nhập
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum-import', function() {
            $('.import-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Ngày nhập hóa đơn
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-date', function() {
            $('#start').val('');
            $('#end').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Nhà cung cấp
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-provide_name', function() {
            $('.deselect-all-provide_name').click();
            document.getElementById('search-filter').submit();
        });
    });
    // Giá bán
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum-sale', function() {
            $('.sale-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Thành tiền xuất
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-total_sum_sale', function() {
            $('.total-sale-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Lợi nhuận
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-total_difference', function() {
            $('.total_difference-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Chi phí vận chuyển
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-tranport_fee', function() {
            $('.tranport_fee-input').val('');
            document.getElementById('search-filter').submit();
        });
    });




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

    function filterProvidename() {
        var input = $("#myInput-provide-name");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-provide_name li");

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

    function filterUnit() {
        var input = $("#myInput-unit");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-unit li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterStatus_export() {
        var input = $("#myInput-status_export");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-status_export li");

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
</script>
</body>

</html>
