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
                            <input type="text" placeholder="Tìm kiếm theo mã hóa đơn vào hoặc nhà cung cấp"
                                name="keywords" class="pr-4 input-search w-100 form-control searchkeyword"
                                value="{{ request()->keywords }}">
                            <span id="search-icon" class="search-icon"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="col-2 d-none">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                        @if (empty($debts))
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
                        @endif
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
                                    @if ($item['label'] === 'Ngày nhập hóa đơn:')
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
                                            <button class="dropdown-item" id="btn-id">Hóa đơn vào</button>
                                            <button class="dropdown-item" id="btn-update_at">Ngày nhập hóa
                                                đơn</button>
                                            <button class="dropdown-item" id="btn-provide_name">Nhà cung cấp</button>
                                            @if (Auth::user()->can('isAdmin'))
                                                <button class="dropdown-item" id="btn-creator">Nhân viên</button>
                                            @endif
                                            <button class="dropdown-item" id="btn-sum-import">Tổng tiền
                                                nhập(+VAT)</button>
                                            <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter"
                                                href="{{ route('debt_import.index') }}"><span>Tắt bộ lọc</span></a>
                                        @endif
                                    </div>
                                    <?php $status = [];
                                    if (isset(request()->status)) {
                                        $status = request()->status;
                                    } else {
                                        $status = [];
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
                                    $provide_namearr = [];
                                    if (isset(request()->provide_namearr)) {
                                        $provide_namearr = request()->provide_namearr;
                                    } else {
                                        $provide_namearr = [];
                                    }
                                    ?>

                                    {{-- Tìm Hđ vào --}}
                                    <div class="block-options" id="id-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Hóa đơn vào</h5>
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
                                            <ul class="ks-cboxtags-provide_name p-0 mb-1 px-2">
                                                @if (!empty($provides))
                                                    @foreach ($provides as $value)
                                                        <li>
                                                            <input type="checkbox" id="roles_active"
                                                                {{ in_array($value->id, $provide_namearr) ? 'checked' : '' }}
                                                                name="provide_namearr[]" value="{{ $value->id }}">
                                                            <label for="">{{ $value->provide_name }}</label>
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
                                            <ul class="ks-cboxtags-status p-0 mb-1 px-2">
                                                <li>
                                                    <input type="checkbox" id="status_inactive"
                                                        {{ in_array(4, $status) ? 'checked' : '' }} name="status[]"
                                                        value="4">
                                                    <label for="">Chưa thanh toán</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_active"
                                                        {{ in_array(1, $status) ? 'checked' : '' }} name="status[]"
                                                        value="1">
                                                    <label for="">Thanh toán đủ</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_inactive"
                                                        {{ in_array(3, $status) ? 'checked' : '' }} name="status[]"
                                                        value="3">
                                                    <label for="">Công nợ</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_inactive"
                                                        {{ in_array(2, $status) ? 'checked' : '' }} name="status[]"
                                                        value="2">
                                                    <label for="">Gần đến hạn</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_inactive"
                                                        {{ in_array(0, $status) ? 'checked' : '' }} name="status[]"
                                                        value="0">
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
                                                <a class="cursor select-all-creator mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-creator">Hủy chọn</a>
                                            </div>
                                            <ul class="ks-cboxtags-creator p-0 mb-1 px-2">
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
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-creator"
                                                    class="btn btn-default btn-block">Hủy</button>
                                            </div>
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
                                                        <=< /option>
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
                                    {{-- Ngày nhập hóa đơn --}}
                                    <div class="block-options" id="update_at-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Ngày nhập hóa đơn</h5>
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
                                    <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                    <input type="hidden" id="sortTypeInput" name="sort-type">
                                    <tr>
                                        <th scope="col" style="width:2%">
                                            <span class="d-flex align-items-center">
                                                STT
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thời gian</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-left">
                                            <span class="d-flex justify-content-start">
                                                <a href="#" class="sort-link" data-sort-by="nhacungcap"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">NCC</button></a>
                                                <div class="icon" id="icon-nhacungcap"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-left">
                                            <span class="d-flex justify-content-start">
                                                <a href="#" class="sort-link" data-sort-by="nhacungcap"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Mặt hàng</button></a>
                                                <div class="icon" id="icon-nhacungcap"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">SL</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ĐVT</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Giá nhập</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-end">
                                                <a href="#" class="sort-link" data-sort-by="total_import"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thành tiền</button></a>
                                                <div class="icon" id="icon-total_import"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="product_code"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">HĐ vào</button></a>
                                                <div class="icon" id="icon-product_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="debt_status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tình trạng</button></a>
                                                <div class="icon" id="icon-debt_status"></div>
                                            </span>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <span class="d-flex justify-content-center align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="debt_status"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Khách hàng</button></a>
                                                <div class="icon" id="icon-debt_status"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">SL</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ĐVT</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Giá bán</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thành tiền</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">HĐ ra</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tình trạng</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Lợi nhuận</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tồn</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex align-items-center">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Chi phí VC</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end align-items-center">
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
                                    {{-- foreach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="paginator mt-4 d-flex justify-content-end">
                        @if (Auth::user()->can('isAdmin'))
                            {{ $debts->appends(request()->except('page'))->links() }}
                        @else
                            {{ $debtsCreator->appends(request()->except('page'))->links() }}
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
    // Nhập
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
