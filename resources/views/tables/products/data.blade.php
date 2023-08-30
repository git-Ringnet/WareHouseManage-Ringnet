<x-navbar :title="$title">
</x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="d-flex mb-1">
                @can('view-provides')
                    <div class="class">
                        <button type="button" class="custom-btn btn btn-outline-primary d-flex align-items-center"
                            id="EXPORT">
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
                    </div>
                @endcan
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row mr-0">
                        <div class="col-md-5">
                            <input type="text" placeholder="Tìm kiếm tên sản phẩm hoặc nhà cung cấp" name="keywords"
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

                        <?php
                        session_start();
                        
                        $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        if ($fullUrl === route('data.index')) {
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

                        <div class="filter-results d-flex row m-0">
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
                                    @if ($item['label'] === 'Thuế:')
                                        <span
                                            class="filter-values">{{ implode(
                                                ', ',
                                                array_map(function ($value) {
                                                    if ($value == 99) {
                                                        $value = 'NOVAT';
                                                    } else {
                                                        $value = $value . '%';
                                                    }
                                                    return $value;
                                                }, $item['values']),
                                            ) }}
                                        </span>
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
                            <span class="" style="order: 999;">
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
                                                <button class="dropdown-item" id="btn-id">Tên sản phẩm</button>
                                                <button class="dropdown-item" id="btn-category">Nhà cung cấp</button>
                                                <button class="dropdown-item" id="btn-trademark">Đơn vị tính</button>
                                                <button class="dropdown-item" id="btn-quantity">Số lượng</button>
                                                <button class="dropdown-item" id="btn-trade">Đang giao dịch</button>
                                                <button class="dropdown-item" id="btn-avg">Đơn giá nhập</button>
                                                <button class="dropdown-item" id="btn-price_inven">Trị tồn
                                                    kho</button>
                                                <button class="dropdown-item" id="btn-tax">Thuế</button>
                                                <button class="dropdown-item" id="btn-hdv">Hóa đơn vào</button>
                                                <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                            </div>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter" href="{{ route('data.index') }}"><span>Tắt bộ
                                                    lọc</span></a>
                                        @endif
                                    </div>
                                    <?php
                                    $unitarr = [];
                                    $status = [];
                                    if (isset(request()->status)) {
                                        $status = request()->status;
                                    } else {
                                        $status = [];
                                    }
                                    if (isset(request()->unitarr)) {
                                        $unitarr = request()->unitarr;
                                    } else {
                                        $unitarr = [];
                                    }
                                    $providearr = [];
                                    
                                    if (isset(request()->providearr)) {
                                        $providearr = request()->providearr;
                                    } else {
                                        $providearr = [];
                                    }
                                    // Thuế
                                    $taxarr = [];
                                    
                                    if (isset(request()->taxarr)) {
                                        $taxarr = request()->taxarr;
                                    } else {
                                        $taxarr = [];
                                    }
                                    $comparison_operator = null;
                                    $quantity = null;
                                    //Số lượng
                                    if (isset(request()->comparison_operator) && isset(request()->quantity)) {
                                        $comparison_operator = request()->comparison_operator;
                                        $quantity = request()->quantity;
                                    } else {
                                        $comparison_operator = null;
                                        $quantity = null;
                                    }
                                    $trade_operator = null;
                                    $quantity = null;
                                    //Đang giao dịch
                                    if (isset(request()->trade_operator) && isset(request()->quantity)) {
                                        $trade_operator = request()->trade_operator;
                                        $quantity = request()->quantity;
                                    } else {
                                        $trade_operator = null;
                                        $quantity = null;
                                    }
                                    //Đơn giá nhập
                                    $avg_operator = null;
                                    $avg = null;
                                    if (isset(request()->avg_operator) && isset(request()->avg)) {
                                        $avg_operator = request()->avg_operator;
                                        $avg = request()->avg;
                                    } else {
                                        $avg_operator = null;
                                        $avg = null;
                                    }
                                    //Trị tồn kho
                                    $price_inven_operator = null;
                                    $price_inven = null;
                                    if (isset(request()->price_inven_operator) && isset(request()->price_inven)) {
                                        $price_inven_operator = request()->price_inven_operator;
                                        $price_inven = request()->price_inven;
                                    } else {
                                        $price_inven_operator = null;
                                        $price_inven = null;
                                    }
                                    ?>
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
                                    <div class="block-options" id="id-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tên sản phẩm</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="products_name"
                                                    class="form-control  products_name-input"
                                                    value="{{ request()->products_name }}"
                                                    placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-id"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter Status --}}
                                    <div class="block-options" id="status-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trạng thái</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-status"
                                                    class="pr-4 w-100 input-search" onkeyup="filterStatus()">
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
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(2, $status) ? 'checked' : '' }} name="status[]"
                                                            value="2">
                                                        <label id="status_value" for="">Sẵn hàng</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(1, $status) ? 'checked' : '' }}
                                                            name="status[]" value="1">
                                                        <label id="status_value" for="">Gần hết</label>
                                                    </li>
                                                    {{-- <li>
                                                        <input type="checkbox" id="status"
                                                            {{ in_array(0, $status) ? 'checked' : '' }}
                                                            name="status[]" value="0">
                                                        <label for="">Hết hàng</label>
                                                    </li> --}}
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
                                    {{-- filter Nhà cung cấp --}}
                                    <div class="block-optionsss" id="category-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Nhà cung cấp</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-category"
                                                    class="pr-4 w-100" onkeyup="filterCategory()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-category mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-category">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-category p-0 mb-1 px-2">
                                                    @if (!empty($provide))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($provide as $value)
                                                            @if (!in_array($value->provide_name, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="roles_active"
                                                                        class="category-checkbox"
                                                                        {{ in_array($value->provide_name, $providearr) ? 'checked' : '' }}
                                                                        name="providearr[]"
                                                                        value="{{ $value->provide_name }}">
                                                                    <label id="category_value"
                                                                        for="">{{ $value->provide_name }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->provide_name;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-category"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- filter Đơn vị tính --}}
                                    <div class="block-options" id="trademark-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Đơn vị tính</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-trademark"
                                                    class="pr-4 w-100" onkeyup="filterTrademark()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-trademark mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-trademark">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-trademark p-0 mb-1 px-2">
                                                    @if (!empty($unit))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($unit as $value)
                                                            @if (!in_array($value->product_unit, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="unit_active"
                                                                        {{ in_array($value->product_unit, $unitarr) ? 'checked' : '' }}
                                                                        name="unitarr[]"
                                                                        value="{{ $value->product_unit }}">
                                                                    <label id="trademark_value"
                                                                        for="">{{ $value->product_unit }}</label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->product_unit;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>

                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-trademark"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- filter Thuế --}}
                                    <div class="block-options" id="tax-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Thuế</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-tax"
                                                    class="pr-4 w-100 input-search" onkeyup="filterTax()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-tax mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-tax">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-tax p-0 mb-1 px-2">
                                                    @if (!empty($unit))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($unit as $value)
                                                            @if (!in_array($value->product_tax, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="unit_active"
                                                                        {{ in_array($value->product_tax, $taxarr) ? 'checked' : '' }}
                                                                        name="taxarr[]"
                                                                        value="{{ $value->product_tax }}">
                                                                    <label id="tax_value" for="">
                                                                        @if ($value->product_tax === 99 || $value->product_tax === null)
                                                                            NOVAT
                                                                        @else
                                                                            {{ $value->product_tax }}%
                                                                        @endif
                                                                    </label>
                                                                </li>
                                                                @php
                                                                    $seenValues[] = $value->product_tax;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>

                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-tax"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- filter Số lượng --}}
                                    <div class="block-options" id="quantity-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Số lượng</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="comparison_operator" name="comparison_operator"
                                                    style="width: 40%">
                                                    <option value=">="
                                                        {{ request('comparison_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('comparison_operator') === '<=' ? 'selected' : '' }}>
                                                        <=< /option>
                                                </select>
                                                <input class="w-50 quantity-input input-so" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="quantity" value="{{ request()->quantity }}"
                                                    placeholder="Số lượng">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-quantity"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter Trade --}}
                                    <div class="block-options" id="trade-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Đang giao dịch</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="trade_operator input-operator" name="trade_operator"
                                                    style="width: 40%">
                                                    <option value=">="
                                                        {{ request('trade_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('trade_operator') === '<=' ? 'selected' : '' }}>
                                                        <=< /option>
                                                </select>
                                                <input class="w-50 trade-input input-so" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="trade" value="{{ request()->trade }}"
                                                    placeholder="Số lượng">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-trade"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter đơn giá nhập --}}
                                    <div class="block-options" id="avg-options" style="display:none">
                                        <div class="wrap w-100">
                                            </option>
                                            <div class="heading-title title-wrap">
                                                <h5>Đơn giá nhập</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="avg_operator" name="avg_operator" style="width: 40%">
                                                    <option value=">="
                                                        {{ request('avg_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('avg_operator') === '<=' ? 'selected' : '' }}>
                                                        <=< /option>
                                                </select>
                                                <input class="w-50 avg-input" type="text" name="avg"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    value="{{ request()->avg }}" placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-avg"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter trị tồn kho --}}
                                    <div class="block-options" id="price_inven-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trị tồn kho</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="price_inven_operator" name="price_inven_operator"
                                                    style="width: 40%">
                                                    <option value=">="
                                                        {{ request('price_inven_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('price_inven_operator') === '<=' ? 'selected' : '' }}>
                                                        <=< /option>
                                                </select>
                                                <input class="w-50 price_inven-input input-so" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="price_inven" value="{{ request()->price_inven }}"
                                                    placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-price_inven"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            </span>
                        </div>


                    </div>
            </div><!-- /.container-fluided -->
    </section>
    <!-- Main content -->
    <div id="section_products">
        <section class="multiple_action">
            <div class="d-flex justify-content-between align-items-center">
                <span class="count_checkbox mr-5"></span>
                <div class="row action">
                    <div class="btn-taodon my-2 ml-3">
                        <button type="button" class="btn-group btn btn-light d-flex align-items-center"
                            id="createOrderBtn">
                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                    fill="#555555" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                    fill="#555555" />
                            </svg>
                            <span>Tạo đơn bán</span>
                        </button>
                    </div>
                    <div class="btn-nhaphang my-2">
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
                                    <input type="hidden" id="perPageinput" name="perPageinput"
                                        value="{{ request()->perPageinput ?? 25 }}">
                                    <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                    <input type="hidden" id="sortTypeInput" name="sort-type" value="">
                                    <tr>
                                        @can('view-guests')
                                            <th scope="col" style="width:2%">
                                                <span class="d-flex">
                                                    <input type="checkbox" id="checkall">
                                                </span>
                                            </th>
                                        @endcan
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ID</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col" style="width:300px">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="product_name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tên sản
                                                        phẩm</button></a>

                                                <div class="icon" id="icon-product_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="provide"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Nhà
                                                        cung
                                                        cấp</button></a>
                                                <div class="icon" id="icon-provide"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex align-items-center justify-content-center">
                                                <a href="#" class="sort-link" data-sort-by="product_unit"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ĐVT</button></a>
                                                <div class="icon" id="icon-product_unit"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_qty"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Số
                                                        lượng</button></a>

                                                <div class="icon" id="icon-product_qty"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_trade"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Đang
                                                        giao dịch</button></a>
                                                <div class="icon" id="icon-product_trade"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_price"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Đơn giá
                                                        nhập</button></a>
                                                <div class="icon" id="icon-product_price"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_total"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trị tồn
                                                        kho</button></a>
                                                <div class="icon" id="icon-product_total"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-center">
                                                <a href="#" class="sort-link" data-sort-by="product_tax"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thuế
                                                    </button></a>
                                                <div class="icon" id="icon-product_tax"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_code"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">HĐ vào
                                                    </button></a>
                                                <div class="icon" id="icon-product_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="soluong"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trạng
                                                        thái</button></a>
                                                <div class="icon" id="icon-soluong"></div>
                                            </span>
                                        </th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($products as $value)
                                        <tr onclick="handleRowClick('checkbox-{{ $value->id }}', event);">
                                            @can('view-guests')
                                                <td><input type="checkbox" class="cb-element" name="product[]"
                                                        id="checkbox-{{ $value->id }}"
                                                        onclick="event.stopPropagation();" value="{{ $value->id }}">
                                                </td>
                                            @endcan
                                            <td class="text-left">{{ $value->id }}</td>
                                            <td class="text-left">{{ $value->product_name }}</td>
                                            <td class="text-left">{{ $value->provide }}</td>
                                            <td class="text-center">{{ $value->product_unit }}</td>
                                            <td class="text-right">{{ $value->product_qty }}</td>
                                            <td class="text-right">
                                                {{ $value->product_trade == null ? 0 : $value->product_trade }}
                                            </td>
                                            <td class="text-right">
                                                @if (fmod($value->product_price, 1) > 0)
                                                    {{ number_format($value->product_price, 2, '.', ',') }}
                                                @else
                                                    {{ number_format($value->product_price) }}
                                                @endif
                                            </td>
                                            <td class="text-right">{{ number_format($value->product_total) }}</td>
                                            <td class="text-center">
                                                @if ($value->product_tax === 99 || $value->product_tax === null)
                                                    NOVAT
                                                @else
                                                    {{ $value->product_tax }}%
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                {{ $value->product_code }}
                                            </td>
                                            <td class="text-center">
                                                @if ($value->product_qty == 0)
                                                    <div class="py-1 rounded pb-1 bg-danger">
                                                        <span class="text-light">Hết hàng</span>
                                                    </div>
                                                @elseif($value->product_qty < 6)
                                                    <div class="py-1 rounded pb-1 bg-warning">
                                                        <span class="text-light">Gần hết</span>
                                                    </div>
                                                @else
                                                    <div class="py-1 rounded pb-1 bg-success">
                                                        <span class="text-light">Sẵn hàng</span>
                                                    </div>
                                                @endif
                                            </td>
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
                            {{ $products->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                    {{-- @if ($products->count() > 0)
                        @php
                            $paginationRange = App\Helpers\PaginationHelper::calculatePaginationRange($products->currentPage(), $products->lastPage());
                        @endphp
                        <div class="pagination mt-4 d-flex justify-content-end">
                            <ul>
                                @if ($paginationRange['start'] > 1)
                                    <li><a href="{{ $products->url(1) }}">1</a></li>
                                    @if ($paginationRange['start'] > 2)
                                        <li><span>...</span></li>
                                    @endif
                                @endif

                                @for ($i = $paginationRange['start']; $i <= $paginationRange['end']; $i++)
                                    <li class="{{ $i == $products->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($paginationRange['end'] < $products->lastPage())
                                    @if ($paginationRange['end'] < $products->lastPage() - 1)
                                        <li><span>...</span></li>
                                    @endif
                                    <li><a
                                            href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
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
    $('#perPage').on('change', function(e) {
        e.preventDefault();
        var perPageValue = $(this).val();
        $('#perPageinput').val(perPageValue);
        $('#search-filter').submit();
    });
    $('#search-icon').on('click', function(e) {
        e.preventDefault();
        $('#search-filter').submit();
    });
    $('.ks-cboxtags-trademark li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-category li').on('click', function() {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-status li').on('click', function() {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-tax li').on('click', function() {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
        return buf;
    }


    // Checkbox
    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
        updateMultipleActionVisibility()
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

    // Hiển thị form multiple action
    function updateMultipleActionVisibility() {
        if ($('.cb-element:checked').length > 0) {
            $('.multiple_action').show();
            $('.count_checkbox').text('Đã chọn ' + $('.cb-element:checked').length);
        } else {
            $('.multiple_action').hide();
        }
    }

    $(document).on('click', '#deleteProducts', function(e) {
        e.preventDefault();
        const list_id = [];
        $('input[name="ids[]"]').each(function() {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                list_id.push(value);

            }
        });
        $.ajax({
            url: "{{ route('deleteProducts') }}",
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
    })
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
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-hdv', function() {
            $('.hdv-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Tên sản phẩm
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

    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options').toggle();
        $('#category-options').hide();
        $('#status-options input').addClass('status-checkbox');
    });
    //Trademarks
    $('#btn-trademark').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#trademark-options').toggle();
        $('#trademark-options input').addClass('trademark-checkbox');
    });
    $('#cancel-trademark').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#trademark-options input[type="checkbox"]').prop('checked', false);
        $('#trademark-options').hide();
    });
    // Thuế
    $('#btn-tax').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#tax-options').toggle();
        $('#tax-options input').addClass('tax-checkbox');
    });
    $('#cancel-tax').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#tax-options input[type="checkbox"]').prop('checked', false);
        $('#tax-options').hide();
    });
    $('#btn-price_inven').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#price_inven-options').toggle();
    });
    $('#cancel-price_inven').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.price_inven-input').val('');
        $('#price_inven-options').hide();
    });
    $('#btn-avg').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#avg-options').toggle();
    });
    $('#cancel-avg').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.avg-input').val('');
        $('#avg-options').hide();
    });
    $('#btn-quantity').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#quantity-options').toggle();
    });
    $('#cancel-quantity').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.quantity-input').val('');
        $('#quantity-options').hide();
    });
    // Đang giao dịch Trade
    $('#btn-trade').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#trade-options').toggle();
    });
    $('#cancel-trade').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.trade-input').val('');
        $('#trade-options').hide();
    });
    $('#btn-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#category-options').toggle();
        $('#category-options input').addClass('category-checkbox');
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#status-options input[type="checkbox"]').prop('checked', false);
        $('#status-options').hide();
    });
    $('#cancel-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#category-options input[type="checkbox"]').prop('checked', false);
        $('#category-options').hide();
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

    $(document).ready(function() {
        // Chức năng filterStatus
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

        // Gọi hàm filterStatus khi nhập vào input
        $("#myInput-status").on("keyup", filterStatus);

        // Chọn tất cả các checkbox
        $('.select-all').click(function() {
            $(".ks-cboxtags-status input[type='checkbox']:visible").prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all').click(function() {
            $(".ks-cboxtags-status input[type='checkbox']:visible").prop('checked', false);
        });
    });

    function filterTax() {
        var input = $("#myInput-tax");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-tax li");

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

    // Tắt bộ lọc commit by nqv
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-category').click(function() {
            $('#category-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-category').click(function() {
            $('#category-options input[type="checkbox"]').prop('checked', false);
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
        // Chọn tất cả các checkbox
        $('.select-all-trademark').click(function() {
            $('#trademark-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-trademark').click(function() {
            $('#trademark-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-tax').click(function() {
            $('#tax-options input[type="checkbox"]:visible').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-tax').click(function() {
            $('#tax-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status', function() {
            $('.deselect-all').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-provide', function() {
            $('.deselect-all-category').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-unit', function() {
            $('.deselect-all-trademark').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-tax', function() {
            $('.deselect-all-tax').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-quantity', function() {
            $('.quantity-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-trade', function() {
            $('.trade-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-avg', function() {
            $('.avg-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-price_inven', function() {
            $('.price_inven-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-products_name', function() {
            $('.products_name-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    //Tạo đơn bán
    $(document).ready(function() {
        $('#createOrderBtn').click(function() {
            var selectedProducts = [];
            $('input[name="product[]"]:checked').each(function() {
                selectedProducts.push($(this).val());
            });

            if (selectedProducts.length > 0) {
                var url = 'exports/create'; // Thay thế bằng URL của trang nhận id sản phẩm

                // Chuyển hướng đến trang mới với id sản phẩm được gửi đi
                window.location.href = url + '?products=' + selectedProducts.join(',');
            }
        });
    });


    $(document).on("click", '#EXPORT', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('export') }}",
            type: "get",
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var products = response.data;

                    // Create a new workbook
                    var workbook = XLSX.utils.book_new();

                    // Create a new worksheet
                    var worksheet = XLSX.utils.json_to_sheet(products);

                    // Modify the column headers
                    var headers = [
                        'ID',
                        'Tên sản phẩm',
                        'Nhà cung cấp',
                        'Đơn vị tính',
                        'Số lượng',
                        'Đang giao dịch',
                        'Giá nhập',
                        'Trị tồn kho',
                        'Thuế',
                        'HD vào',
                        'Tình trạng',
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
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'product');

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
                    link.download = 'TonKho.xlsx';
                    link.click();
                } else {
                    console.log(response.msg);
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    //checkbox
    function toggleCheckbox(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        if (checkbox) {
            checkbox.checked = !checkbox.checked; // Đảo ngược trạng thái của checkbox
        }
    }

    function triggerChange(checkboxId) {
        var checkbox = document.getElementById(checkboxId);
        if (checkbox) {
            var event = new Event('change', {
                bubbles: true,
                cancelable: true,
            });
            checkbox.dispatchEvent(event);
        }
    }

    function handleRowClick(checkboxId, event) {
        // Lấy target của sự kiện click
        var target = event.target;

        // Kiểm tra nếu target không có class "dropdown"
        if (!target.closest('.dropdown') && !target.closest('.editEx')) {
            var checkbox = document.getElementById(checkboxId);
            if (checkbox) {
                toggleCheckbox(checkboxId); // Thay đổi trạng thái checkbox
                triggerChange(checkboxId); // Kích hoạt sự kiện change của checkbox
            }
        }
    }
</script>
</body>

</html>
