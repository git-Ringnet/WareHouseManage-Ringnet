<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row m-0 mb-1">
                <a href="{{ route('exports.create') }}">
                    <button type="button" class="custom-btn btn btn-primary d-flex align-items-center h-100"
                        style="margin-right:24px">
                        <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                fill="#ffff" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                fill="#ffff" />
                        </svg>
                        <span>Tạo đơn</span>
                    </button>
                </a>
                <button type="button" id="exportExcelOrder"
                    class="custom-btn btn btn-outline-primary border-primary d-flex align-items-center">
                    <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none">
                        <path
                            d="M15.0003 7.80054H16.5001C16.8979 7.80054 17.2794 7.95857 17.5607 8.23984C17.842 8.52112 18 8.9026 18 9.30039V17.1006C18 17.4983 17.842 17.8798 17.5607 18.1611C17.2794 18.4424 16.8979 18.6004 16.5001 18.6004H7.49986C7.10207 18.6004 6.72058 18.4424 6.4393 18.1611C6.15802 17.8798 6 17.4983 6 17.1006V9.30039C6 8.9026 6.15802 8.52112 6.4393 8.23984C6.72058 7.95857 7.10207 7.80054 7.49986 7.80054H8.99972"
                            stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.99976 11.3997L11.9995 14.3994L15.0003 11.3997" stroke="#0095F6"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.0006 3V13.7999" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Xuất excel</span>
                </button>
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row  mr-0">
                        <div class="col-md-5">
                            <input type="text" placeholder="Tìm kiếm theo số hóa đơn hoặc tên khách hàng"
                                name="keywords" class="pr-4 form-control input-search w-100 searchkeyword"
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
                                    @if ($item['label'] === 'Ngày tạo:')
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
                                            <button class="dropdown-item" id="btn-id">Số hóa đơn</button>
                                            {{-- <button class="dropdown-item" id="btn-id">ID</button> --}}
                                            <button class="dropdown-item" id="btn-guest">Khách hàng</button>
                                            <button class="dropdown-item" id="btn-update_at">Ngày tạo</button>
                                            @if (Auth::user()->can('isAdmin'))
                                                <button class="dropdown-item" id="btn-creator">Người tạo</button>
                                            @endif
                                            <button class="dropdown-item" id="btn-sum">Tổng tiền</button>
                                            <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter" href="{{ route('exports.index') }}"><span>Tắt
                                                    bộ lọc</span></a>
                                        @endif
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
                                    
                                    $guest = [];
                                    if (isset(request()->guest)) {
                                        $guest = request()->guest;
                                    } else {
                                        $guest = [];
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

                                    {{-- Tìm Số hóa đơn --}}
                                    <div class="block-options" id="id-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Số hóa đơn</h5>
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
                                                    @if (!empty($exports))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($exports as $value)
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
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(0, $status) ? 'checked' : '' }}
                                                            name="status[]" value="0">
                                                        <label for="">Đã hủy</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(1, $status) ? 'checked' : '' }}
                                                            name="status[]" value="1">
                                                        <label for="">Đã báo giá</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(2, $status) ? 'checked' : '' }}
                                                            name="status[]" value="2">
                                                        <label for="">Đã chốt</label>
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
                                                <h5>Người tạo</h5>
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
                                                    @if (!empty($exports))
                                                        @php
                                                            $seenValues = [];
                                                        @endphp
                                                        @foreach ($exports as $value)
                                                            @if (!in_array($value->name, $seenValues))
                                                                <li>
                                                                    <input type="checkbox" id="name_active"
                                                                        {{ in_array($value->name, $name) ? 'checked' : '' }}
                                                                        name="name[]" value="{{ $value->name }}">
                                                                    <label id="name"
                                                                        for="name">{{ $value->name }}</label>
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
                                    {{-- Tổng tiền --}}
                                    <div class="block-options" id="sum-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tổng tiền</h5>
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
                                                        <=</option>
                                                </select>
                                                <input class="w-50 input-quantity sum-input" type="text"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    name="sum" value="{{ request()->sum }}"
                                                    placeholder="Số lượng">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-sum"
                                                class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Ngày tạo --}}
                                    <div class="block-options" id="update_at-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Ngày tạo</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <div class="start">
                                                    <label for="start">Từ ngày:</label>
                                                    <input type="date" id="start" name="trip_start"
                                                        value="{{ request()->trip_start }}" min="2018-01-01"
                                                        max="2050-12-31">
                                                </div>
                                                <div class="end">
                                                    <label for="start">Đến ngày:</label>
                                                    <input type="date" id="end" name="trip_end"
                                                        value="{{ request()->trip_end }}" min="2018-01-01"
                                                        max="2050-12-31">
                                                </div>
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

                    </div><!-- /.container-fluided -->
    </section>

    <!-- Main content -->
    <div class="order_content">
        <section class="multiple_action">
            <div class="d-flex justify-content-between align-items-center">
                <span class="count_checkbox mr-5"></span>
                <div class="row action">
                    <div class="btn-chotdon my-2 ml-3">
                        <button type="button" id="btn-chot"
                            class="btn btn-group btn-light d-flex align-items-center h-100">
                            <svg class="mr-1" width="24" height="24" viewBox="0 0 18 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M17.2803 0.21967C17.5732 0.512563 17.5732 0.987437 17.2803 1.28033L6.28033 12.2803C5.98744 12.5732 5.51256 12.5732 5.21967 12.2803L0.21967 7.28033C-0.0732233 6.98744 -0.0732233 6.51256 0.21967 6.21967C0.512563 5.92678 0.987437 5.92678 1.28033 6.21967L5.75 10.6893L16.2197 0.21967C16.5126 -0.0732233 16.9874 -0.0732233 17.2803 0.21967Z"
                                    fill="#555555">
                                </path>
                            </svg>
                            <span>Chốt đơn</span>
                        </button>
                    </div>
                    <div class="btn-xoahang my-2 ml-3">
                        <button id="deleteExports" type="button"
                            class="btn btn-group btn-light d-flex align-items-center h-100">
                            <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.5454 5C10.2442 5 9.99999 5.24421 9.99999 5.54545C9.99999 5.8467 10.2442 6.09091 10.5454 6.09091H13.4545C13.7558 6.09091 14 5.8467 14 5.54545C14 5.24421 13.7558 5 13.4545 5H10.5454ZM6 7.72726C6 7.42601 6.24421 7.18181 6.54545 7.18181H7.63637H16.3636H17.4545C17.7558 7.18181 18 7.42601 18 7.72726C18 8.02851 17.7558 8.27272 17.4545 8.27272H16.9091V17C16.9091 18.2113 15.9118 19.1818 14.7135 19.1818H9.25891C8.97278 19.1816 8.68906 19.1247 8.42499 19.0145C8.16092 18.9044 7.92126 18.7431 7.71979 18.5399C7.51833 18.3367 7.35905 18.0957 7.25112 17.8307C7.14347 17.5664 7.08903 17.2834 7.09091 16.9981V8.27272H6.54545C6.24421 8.27272 6 8.02851 6 7.72726ZM8.18182 17.0041V8.27272H15.8182V17C15.8182 17.5966 15.3216 18.0909 14.7135 18.0909H9.25938C9.11713 18.0908 8.97632 18.0625 8.84503 18.0077C8.71375 17.953 8.5946 17.8728 8.49444 17.7718C8.39429 17.6707 8.3151 17.5509 8.26144 17.4192C8.20779 17.2874 8.18074 17.1464 8.18182 17.0041ZM13.4545 10.0909C13.7558 10.0909 14 10.3351 14 10.6364V15.7273C14 16.0285 13.7558 16.2727 13.4545 16.2727C13.1533 16.2727 12.9091 16.0285 12.9091 15.7273V10.6364C12.9091 10.3351 13.1533 10.0909 13.4545 10.0909ZM11.0909 10.6364C11.0909 10.3351 10.8467 10.0909 10.5454 10.0909C10.2442 10.0909 9.99999 10.3351 9.99999 10.6364V15.7273C9.99999 16.0285 10.2442 16.2727 10.5454 16.2727C10.8467 16.2727 11.0909 16.0285 11.0909 15.7273V10.6364Z"
                                    fill="#555555" />
                            </svg>
                            <span>Xóa đơn</span>
                        </button>
                    </div>
                    <div class="btn-huy my-2 ml-4">
                        <button id="cancelBillExport" class="btn btn-group btn-light d-flex align-items-center h-100">
                            <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="px-1">Hủy đơn</span>
                        </button>
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
                    <div class="card scroll-custom">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-hover">
                                <thead class="sticky-head">
                                    <tr>
                                        <input type="hidden" id="perPageinput" name="perPageinput"
                                            value="{{ request()->perPageinput ?? 25 }}">
                                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                        <input type="hidden" id="sortTypeInput" name="sort-type"
                                            value="{{ $sortType }}">
                                        <th><input type="checkbox" name="all" id="checkall"></th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ID</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col" style="width: 10%;">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="export_code"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Số hóa đơn</button></a>
                                                <div class="icon" id="icon-export_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col" style="width: 300px">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="guest_receiver"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Khách hàng</button></a>
                                                <div class="icon" id="icon-guest_receiver"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="created_at"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Ngày tạo</button></a>
                                                <div class="icon" id="icon-created_at"></div>
                                            </span>
                                        </th>
                                        @if (Auth::user()->can('isAdmin'))
                                            <th scope="col">
                                                <span class="d-flex">
                                                    <a href="#" class="sort-link" data-sort-by="name"
                                                        data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                            type="submit">Người tạo</button></a>
                                                    <div class="icon" id="icon-name"></div>
                                                </span>
                                            </th>
                                        @endif
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="total"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng tiền</button></a>
                                                <div class="icon" id="icon-total"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-center">
                                                <a href="#" class="sort-link d-flex justify-content-center"
                                                    data-sort-by="export_status" style="width:130px"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trạng thái</button></a>
                                                <div class="icon" id="icon-export_status"></div>
                                            </span>
                                        </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    <input type="hidden" id="isUserAdmin"
                                        value="{{ Auth::user()->roleid == 1 ? 'true' : 'false' }}">
                                    @foreach ($export as $value)
                                        {{-- @if (Auth::user()->name == $value->name || Auth::user()->can('isAdmin')) --}}
                                        <tr onclick="handleRowClick('checkbox-{{ $value->id }}', event);">
                                            <td><input type="checkbox" class="cb-element" name="ids[]"
                                                    id="checkbox-{{ $value->id }}" value="{{ $value->id }}"
                                                    onclick="event.stopPropagation();"></td>
                                            <td >{{ $value->id }}</td>
                                            <td >{{ $value->export_code }}</td>
                                            <td>{{ $value->guest_name }}</td>
                                            <td style="width: 10%;">
                                                {{ date_format(new DateTime($value->created_at), 'd-m-Y') }}</td>
                                            @if (Auth::user()->can('isAdmin'))
                                                <td style="width: 10%;">{{ $value->name }}</td>
                                            @endif
                                            <td class="text-right">
                                                {{ number_format($value->total) }}
                                            </td>
                                            <td class="text-center">
                                                @if ($value->export_status == 0)
                                                    <span class="p-2 bg-danger rounded">Đã hủy</span>
                                                @elseif($value->export_status == 1)
                                                    <span class="p-2 bg-warning rounded">Đã báo giá</span>
                                                @elseif($value->export_status == 2)
                                                    <span class="p-2 bg-success rounded">Đã chốt</span>
                                                @endif
                                            </td>
                                            <td class="editEx">
                                                @if ($value->export_status == 1 && (Auth::user()->name == $value->name || Auth::user()->can('isAdmin')))
                                                    <a href="{{ route('exports.edit', $value->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" viewBox="0 0 32 32" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                fill="#555555"></path>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="{{ route('exports.edit', $value->id) }}">
                                                        <svg width="32" height="32" viewBox="0 0 32 32"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M24.9033 14.1636V7.89258C24.9033 7.33819 24.6831 6.8065 24.2911 6.41449C23.8991 6.02248 23.3674 5.80225 22.813 5.80225H9.22583C8.67144 5.80225 8.13976 6.02248 7.74774 6.41449C7.35573 6.8065 7.1355 7.33819 7.1355 7.89258V22.5249C7.1355 23.0793 7.35573 23.611 7.74774 24.003C8.13976 24.395 8.67144 24.6152 9.22583 24.6152H14.4517"
                                                                stroke="#555555" stroke-width="1.5"
                                                                stroke-linecap="round" stroke-linejoin="round" />
                                                            <path d="M13.6678 18.3442H14.4517" stroke="#555555"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M13.6678 14.1631H17.5872" stroke="#555555"
                                                                stroke-width="1.5" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <path d="M13.6678 10.1133H20.7227" stroke="#555555"
                                                                stroke-width="1.5" stroke-linecap="round"
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
                                            </td>
                                            <td class="text-center dropdown">
                                                <div id="dropdown_item{{ $value->id }}"
                                                    class="dropdownitem collapsed" data-toggle="collapse"
                                                    data-target="#product-details-<?php echo $value->id; ?>"
                                                    aria-expanded="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                        height="32" viewBox="0 0 32 32" fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M9.64162 12.3083C10.0527 11.8972 10.7192 11.8972 11.1303 12.3083L16 17.178L20.8697 12.3083C21.2808 11.8972 21.9473 11.8972 22.3583 12.3083C22.7694 12.7194 22.7694 13.3859 22.3583 13.797L16.7443 19.411C16.3332 19.8221 15.6667 19.8221 15.2557 19.411L9.64162 13.797C9.23054 13.3859 9.23054 12.7194 9.64162 12.3083Z"
                                                            fill="#555555"></path>
                                                    </svg>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- @endif --}}
                                        <?php $count = 1; ?>
                                        @foreach ($productEx as $item)
                                            @if ($value->id == $item->export_id)
                                                <tr id="product-details-{{ $value->id }}"
                                                    class="collapse product-details">
                                                    <td><?php echo $count++; ?></td>
                                                    <td class="text-left w-auto">
                                                        <p>Tên sản phẩm</p>{{ $item->product_name }}
                                                    </td>
                                                    @if (Auth::user()->can('isAdmin'))
                                                        <td></td>
                                                    @endif
                                                    <td></td>
                                                    <td class="text-right">
                                                        <p>Số lượng</p>{{ $item->product_qty }}
                                                    </td>
                                                    <td class="text-right">
                                                        <p>Giá bán</p>
                                                        {{ number_format($item->product_price) }}
                                                    </td>
                                                    <td class="text-right">
                                                        <p>Thành tiền</p>
                                                        {{ number_format($item->product_price * $item->product_qty) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <p>Thuế</p>
                                                        @if ($item->product_tax == 99 || $item->product_tax === null)
                                                            NOVAT
                                                        @else
                                                            {{ $item->product_tax }}%
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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
                            {{ $export->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                    {{-- @if ($export->count() > 0)
                        @php
                            $paginationRange = App\Helpers\PaginationHelper::calculatePaginationRange($export->currentPage(), $export->lastPage());
                        @endphp
                        <div class="pagination mt-4 d-flex justify-content-end">
                            <ul>
                                @if ($paginationRange['start'] > 1)
                                    <li><a href="{{ $export->url(1) }}">1</a></li>
                                    @if ($paginationRange['start'] > 2)
                                        <li><span>...</span></li>
                                    @endif
                                @endif

                                @for ($i = $paginationRange['start']; $i <= $paginationRange['end']; $i++)
                                    <li class="{{ $i == $export->currentPage() ? 'active' : '' }}">
                                        <a href="{{ $export->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($paginationRange['end'] < $export->lastPage())
                                    @if ($paginationRange['end'] < $export->lastPage() - 1)
                                        <li><span>...</span></li>
                                    @endif
                                    <li><a
                                            href="{{ $export->url($export->lastPage()) }}">{{ $export->lastPage() }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif --}}
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
    $('#btn-sum').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#sum-options').toggle();
    });
    $('#cancel-sum').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.sum-input').val('');
        $('#sum-options').hide();
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
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-sum', function() {
            $('.sum-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-date', function() {
            $('#start').val('');
            $('#end').val('');
            document.getElementById('search-filter').submit();
        });
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
    //xuất excel
    function exportToExcel() {
        // Ẩn các dòng của dropdown và các phần tử khác cần ẩn khi xuất Excel
        $('#example2 tbody tr.collapse.product-details').addClass('d-none');
        $('.cb-element').addClass('d-none');
        $('#checkall').addClass('d-none');

        // Chờ 1 giây và sau đó hiển thị lại các dòng và phần tử đã ẩn
        setTimeout(function() {
            $('#example2 tbody tr.collapse.product-details').removeClass('d-none');
            $('.cb-element').removeClass('d-none');
            $('#checkall').removeClass('d-none');
        }, 1000); // 1000ms tương đương 1 giây

        var table = document.getElementById('example2');
        var tableData = [];

        for (var i = 0, row; row = table.rows[i]; i++) {
            // Kiểm tra và bỏ qua các dòng đã ẩn (d-none) khi chuyển đổi thành dữ liệu Excel
            if (!$(row).hasClass('d-none')) {
                var rowData = [];
                for (var j = 1, cell; cell = row.cells[j]; j++) { // Chỉ lấy từ cột thứ hai trở đi
                    rowData.push(cell.innerText);
                }
                tableData.push(rowData);
            }
        }

        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.aoa_to_sheet(tableData);
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

        var wbout = XLSX.write(wb, {
            bookType: 'xlsx',
            type: 'array'
        });
        saveAsExcel(wbout, 'export.xlsx');
    }

    function saveAsExcel(data, filename) {
        var blob = new Blob([data], {
            type: 'application/octet-stream'
        });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');

        a.href = url;
        a.download = filename;
        a.click();

        URL.revokeObjectURL(url);
    }

    // AJAX Hủy bill
    $(document).on('click', '#cancelBillExport', function(e) {
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
                url: "{{ route('cancelBillExport') }}",
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

    function myFunction() {
        let text = "Bạn có muốn xóa dữ liệu đã chọn không?";
        if (confirm(text) == true) {
            return true
        } else {
            return false
        }

    }

    function myFunctionCancel() {
        let text = "Bạn có chắc chắn hủy các đơn hàng đã chọn không?";
        if (confirm(text) == true) {
            return true
        } else {
            return false
        }

    }

    // AJAX Xóa Exports
    $(document).on('click', '#deleteExports', function(e) {
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
                url: "{{ route('deleteExports') }}",
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

    //Chốt đơn
    $(document).on('click', '#btn-chot', function(e) {
        e.preventDefault();
        const list_id = [];
        $('input[name="ids[]"]').each(function() {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                list_id.push(value);
            }
        });
        $.ajax({
            url: "{{ route('chotDonCheckBox') }}",
            type: "get",
            data: {
                list_id: list_id,
            },
            success: function(data) {
                if (data.success == true) {
                    updateMultipleActionVisibility();
                    location.reload();
                }
            }
        })
    })

    // Checkbox
    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
        updateMultipleActionVisibility();
    });

    $('.cb-element').change(function() {
        updateMultipleActionVisibility();
        if ($('.cb-element:checked').length === $('.cb-element').length) {
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
    var isUserAdmin = document.getElementById('isUserAdmin').value === 'true';
    function updateMultipleActionVisibility() {
        if ($('.cb-element:checked').length > 0) {
            $('.multiple_action').show();
            $('.count_checkbox').text('Đã chọn ' + $('.cb-element:checked').length);
        } else {
            $('.multiple_action').hide();
        }
        var selectedStates = []; // Mảng lưu trữ các trạng thái đã chọn
        $('input[name="ids[]"]').each(function() {
            if ($(this).is(':checked')) {
                if (isUserAdmin) {
                    var data = $(this).closest('tr').find('td:eq(7)').text().trim();
                    selectedStates.push(data); // Thêm trạng thái vào mảng
                } else {
                    var data = $(this).closest('tr').find('td:eq(6)').text().trim();
                    selectedStates.push(data); // Thêm trạng thái vào mảng
                }
            }
        });

        var isDaBaoGia = selectedStates.includes("Đã báo giá");
        var isDaChot = selectedStates.includes("Đã chốt");
        var isDaHuy = selectedStates.includes("Đã hủy");

        if (isDaBaoGia && isDaChot && isDaHuy) {
            $('.multiple_action').hide();
        } else if (isDaBaoGia && isDaChot) {
            $('.btn-xoahang').hide();
            $('.btn-huy').show();
            $('.btn-chotdon').hide();
        } else if (isDaBaoGia && isDaHuy) {
            $('.multiple_action').hide();
        } else if (isDaChot && isDaHuy) {
            $('.multiple_action').hide();
        } else if (isDaBaoGia) {
            $('.btn-xoahang').hide();
            $('.btn-chotdon').show();
            $('.btn-huy').show();
        } else if (isDaChot) {
            $('.btn-xoahang').hide();
            $('.btn-chotdon').hide();
            $('.btn-huy').show();
        } else if (isDaHuy) {
            $('.btn-xoahang').show();
            $('.btn-chotdon').hide();
            $('.btn-huy').hide();
        } else {
            $('.multiple_action').hide();
        }
    }

    //xuất excel all
    $(document).on('click', '#exportExcelOrder', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('export_excel') }}",
            type: "get",
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var data = response.data;

                    // Create a new array of objects with properties in the desired order
                    var modifiedData = data.map(function(item) {
                        return {
                            'ID': item.id,
                            'Số hóa đơn': item['sohoadon'],
                            'Khách hàng': item['guest_id'],
                            'Ngày tạo': item['formatted_created_at'],
                            'Người tạo': item['users_id'],
                            'Tổng tiền': item['total'],
                            'Trạng thái': item['export_status'],
                        };
                    });

                    var workbook = XLSX.utils.book_new();
                    var worksheet = XLSX.utils.json_to_sheet(modifiedData);

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Data');

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
                    link.download = 'xuatHang.xlsx';
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

    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
        return buf;
    }

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
