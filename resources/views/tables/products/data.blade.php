<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><a href="{{ route('insertProducts') }}" class="btn btn-primary">Thêm</a></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row">
                        <div class="col-5">
                            <input type="text" placeholder="Tìm kiếm theo mã sản phẩm hoặc tên sản phẩm"
                                name="keywords" class="pr-4 input-search w-100" value="{{ request()->keywords }}">
                            <span class="search-icon"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="col-2 d-none">
                  <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>

                        </div>
                        <a class="btn ml-auto btn-delete-filter" href="{{ route('data.index') }}"><span><svg
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z"
                                        fill="#555555" />
                                </svg>
                            </span>Tắt bộ lọc</a>
                    </div>
                    <div class="row d-flex justify-contents-center align-items-center mr-auto pt-2">
                        <div class="icon-filter mr-3 ml-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z" fill="#555555" />
                            </svg>
                        </div>
                        <?php
                        session_start();
                        
                        $fullUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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

                        <div class="filter-results d-flex">
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
                        </div>

                        <div class="filter-options">
                            <div class="dropdown">
                                <button class="ml-2 btn btn-filter" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z" fill="#555555" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z" fill="#555555" />
                                        </svg>
                                        Thêm bộ lọc
                                    </span>
                                </button>
                                <div class="dropdown-menu" id="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="search-container px-2">
                                        <input type="text" placeholder="Tìm thuộc tính lọc" id="myInput" onkeyup="filterFunction()">
                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                    </div>
                                    <div class="scrollbar">
                                        <button class="dropdown-item" id="btn-code">Mã sản phẩm</button>
                                        <button class="dropdown-item" id="btn-id">Tên sản phẩm</button>
                                        <button class="dropdown-item" id="btn-category">Danh mục</button>
                                        <button class="dropdown-item" id="btn-trademark">Thương hiệu</button>
                                        <button class="dropdown-item" id="btn-quantity">Tồn kho</button>
                                        <button class="dropdown-item" id="btn-avg">Trị trung bình</button>
                                        <button class="dropdown-item" id="btn-price_inven">Trị tồn kho</button>
                                        <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $categoryarr = [];
                            $status = [];
                            if (isset(request()->status)) {
                                $status = request()->status;
                            } else {
                                $status = [];
                            }
                            if (isset(request()->categoryarr)) {
                                $categoryarr = request()->categoryarr;
                            } else {
                                $categoryarr = [];
                            }
                            $trademarkarr = [];

                            if (isset(request()->trademarkarr)) {
                                $trademarkarr = request()->trademarkarr;
                            } else {
                                $trademarkarr = [];
                            }
                            $comparison_operator = null;
                            $quantity = null;
                            //Tồn kho
                            if (isset(request()->comparison_operator) && isset(request()->quantity)) {
                                $comparison_operator = request()->comparison_operator;
                                $quantity = request()->quantity;
                            } else {
                                $comparison_operator = null;
                                $quantity = null;
                            }
                            //Trị trung bình
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
                            <div class="block-options" id="id-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Tên:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>
                                        <input type="search" name="products_name"
                                            class="form-control  products_name-input"
                                            value="{{ request()->products_name }}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-id" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- Tìm mã sản phẩm --}}
                            <div class="block-options" id="code-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Mã sản phẩm:</h5>
                                    </div>
                                    <div class="input-group px-2">
                                        <label class="title" for="">Chứa kí tự</label>

                                        <input type="search" name="code" class="form-control code-input"
                                            value="{{ request()->code }}" placeholder="Nhập thông tin..">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-code" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- filter Status --}}
                            <div class="block-options" id="status-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Trạng thái:</h5>
                                    </div>
                                    <div class="search-container px-2 mt-1">
                                        <input type="text" placeholder="Tìm thuộc tính lọc" id="myInput-status" class="pr-4 input-search" onkeyup="filterStatus()">
                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                    </div>
                                    <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags-status p-0 m-0 px-2">
                                        <li>
                                            <input type="checkbox" id="status_active"
                                                {{ in_array(2, $status) ? 'checked' : '' }} name="status[]"
                                                value="2">
                                            <label for="status_active">Sẵn hàng</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="status_inactive"
                                                {{ in_array(1, $status) ? 'checked' : '' }} name="status[]"
                                                value="1">
                                            <label for="status_inactive">Gần hết</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="status_inactive"
                                                {{ in_array(0, $status) ? 'checked' : '' }} name="status[]"
                                                value="0">
                                            <label for="status_inactive">Hết hàng</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-status" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- filter danh mục --}}
                            <div class="block-options" id="category-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Danh mục:</h5>
                                    </div>
                                    <div class="search-container px-2 mt-1">
                                        <input type="text" placeholder="Tìm thuộc tính lọc" id="myInput-category" class="pr-4" onkeyup="filterCategory()">
                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                    </div>
                                    <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all-category mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all-category">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags-category p-0 m-0 px-2">

                                        @if (!empty($categories))
                                            @foreach ($categories as $category)
                                                <li>
                                                    <input type="checkbox" id="roles_active"
                                                        {{ in_array($category->id, $categoryarr) ? 'checked' : '' }}
                                                        name="categoryarr[]" value="{{ $category->id }}">
                                                    <label for="roles_active">{{ $category->category_name }}</label>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="d-flex justify-contents-center align-items-baseline px-2">
                                        <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                            Nhận</button>
                                        <button type="button" id="cancel-category"
                                            class="btn btn-secondary btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                            {{-- filter thương hiệu --}}
                            <div class="block-options" id="trademark-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Thương hiệu</h5>
                                    </div>
                                    <div class="search-container px-2 mt-1">
                                        <input type="text" placeholder="Tìm thuộc tính lọc" id="myInput-trademark" class="pr-4" onkeyup="filterTrademark()">
                                        <span class="search-icon"><i class="fas fa-search"></i></span>
                                    </div>
                                    <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all-trademark mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all-trademark">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags-trademark p-0 m-0 px-2">
                                        @if (!empty($trademarks))
                                            @php
                                                $seenValues = [];
                                            @endphp
                                            @foreach ($trademarks as $value)
                                                @if (!in_array($value->products_trademark, $seenValues))
                                                    <li>
                                                        <input type="checkbox" id="trademark_active"
                                                            {{ in_array($value->products_trademark, $trademarkarr) ? 'checked' : '' }}
                                                            name="trademarkarr[]"
                                                            value="{{ $value->products_trademark }}">
                                                        <label id="trademark_value"
                                                            for="trademark_active">{{ $value->products_trademark }}</label>
                                                    </li>
                                                    @php
                                                        $seenValues[] = $value->products_trademark;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="d-flex justify-contents-center align-items-baseline px-2">
                                        <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                            Nhận</button>
                                        <button type="button" id="cancel-trademark"
                                            class="btn btn-secondary btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                            {{-- filter tồn kho --}}
                            <div class="block-options" id="quantity-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Tồn kho:</h5>
                                    </div>
                                    <div class="input-group pt-2 justify-content-around">
                                        <select class="comparison_operator" name="comparison_operator" style="width: 40%">
                                            <option value=">=" {{ request('comparison_operator') === '>=' ? 'selected' : '' }}>>=</option>
                                            <option value="<=" {{ request('comparison_operator') === '<=' ? 'selected' : '' }}><=</option>
                                        </select>
                                        <input class="w-50 quantity-input" type="number" name="quantity"
                                            value="{{ request()->quantity }}" placeholder="Số lượng">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-quantity" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- filter trị trung bình --}}
                            <div class="block-options" id="avg-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Trị trung bình:</h5>
                                    </div>
                                    <div class="input-group pt-2 justify-content-around">
                                        <select class="avg_operator" name="avg_operator" style="width: 40%">
                                            <option value=">=" {{ request('avg_operator') === '>=' ? 'selected' : '' }}>>=</option>
                                            <option value="<=" {{ request('avg_operator') === '<=' ? 'selected' : '' }}>
                                                <=</option>
                                        </select>
                                        <input class="w-50 avg-input" type="number" name="avg"
                                            value="{{ request()->avg }}" placeholder="Nhập giá trị">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-avg" class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            {{-- filter trị tồn kho --}}
                            <div class="block-options" id="price_inven-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Trị tồn kho:</h5>
                                    </div>
                                    <div class="input-group pt-2 justify-content-around">
                                        <select class="price_inven_operator" name="price_inven_operator"
                                            style="width: 40%">
                                            <option value=">="{{ request('price_inven_operator') === '>=' ? 'selected' : '' }}>>=</option>
                                            <option value="<=" {{ request('price_inven_operator') === '<=' ? 'selected' : '' }}>
                                                <=</option>
                                        </select>
                                        <input class="w-50 price_inven-input" type="number" name="price_inven"
                                            value="{{ request()->price_inven }}" placeholder="Nhập giá trị">
                                    </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-price_inven" class="btn btn-secondary btn-block">Hủy</button>
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
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                        <input type="hidden" id="sortTypeInput" name="sort-type"
                                            value="{{ $sortType }}">
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">ID</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_code"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Mã sản phẩm</button></a>
                                                <div class="icon" id="icon-products_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_name"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tên sản phẩm</button></a>

                                                <div class="icon" id="icon-products_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="ID_category"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Danh mục</button></a>
                                                <div class="icon" id="icon-ID_category"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_trademark"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Thương hiệu</button></a>
                                                <div class="icon" id="icon-products_trademark"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="inventory"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tồn kho</button></a>

                                                <div class="icon" id="icon-inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="price_avg"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trị trung bình</button></a>

                                                <div class="icon" id="icon-price_avg"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="price_inventory"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trị tồn kho</button></a>
                                                <div class="icon" id="icon-price_inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="inventory"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Trạng thái</button></a>
                                                <div class="icon" id="icon-status_inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">Action</th>
                                        <th></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($products as $value)
                                        <tr>
                                            <td scope="row">{{ $value->id }}</td>
                                            <th><a
                                                    href="{{ route('data.show', $value->id) }}">{{ $value->products_code }}</a>
                                            </th>
                                            <td>{{ $value->products_name }}</td>
                                            <td>
                                                <select class="product_category" name="product_category"
                                                    id="{{ $value->id }}">
                                                    @foreach ($categories as $va)
                                                        <option value="{{ $va->id }}"
                                                            {{ $va->id == $value->ID_category ? 'selected' : '' }}>
                                                            {{ $va->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>{{ $value->products_trademark }}</td>
                                            <td>
                                                @if ($value->inventory == 0)
                                                    0
                                                @else
                                                    {{ $value->inventory }}
                                                @endif

                                            </td>
                                            <td>{{ number_format($value->price_avg) }}</td>
                                            <td>{{ number_format($value->price_inventory) }}</td>
                                            <td class="p-0 text-center">
                                                @if ($value->inventory == 0)
                                                    <div class="py-1 rounded mt-3 pb-1 bg-danger">
                                                        <span class="text-light">Hết hàng</span>
                                                    </div>
                                                @elseif($value->inventory < 5)
                                                    <div class="py-1 rounded mt-3 pb-1 bg-warning">
                                                        <span class="text-light">Gần hết</span>
                                                    </div>
                                                @else
                                                    <div class="py-1 rounded mt-3 pb-1 bg-success">
                                                        <span class="text-light">Sẵn hàng</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="icon">
                                                    <a href="{{ route('data.edit', $value->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" viewBox="0 0 32 32" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                fill="#555555" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="dropdown_item{{ $value->id }}" data-toggle="collapse"
                                                    data-target="#product-details-<?php echo $value->id; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                        height="32" viewBox="0 0 32 32" fill="none">
                                                        <rect width="32" height="32" rx="4"
                                                            fill="white" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.3582 19.6917C21.9471 20.1028 21.2806 20.1028 20.8695 19.6917L15.9998 14.822L11.1301 19.6917C10.719 20.1028 10.0526 20.1028 9.64148 19.6917C9.2304 19.2806 9.2304 18.6141 9.64148 18.203L15.2555 12.589C15.6666 12.1779 16.3331 12.1779 16.7442 12.589L22.3582 18.203C22.7693 18.6141 22.7693 19.2806 22.3582 19.6917Z"
                                                            fill="#555555" />
                                                    </svg>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($product as $item)
                                            <tr id="product-details-{{ $value->id }}" class="collapse">
                                                @if ($value->id == $item->products_id)
                                                    <td>{{ $value->id }} - {{ $item->id }}</td>
                                                    <td>{{ $value->products_code }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>
                                                        <p>Loại hàng</p>{{ $item->product_category }}
                                                    </td>
                                                    <td>{{ $item->product_trademark }}</td>
                                                    <td>{{ $item->product_qty }}</td>
                                                    <td>{{ number_format($item->product_price) }}</td>
                                                    <td>{{ number_format($item->total) }}</td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginator mt-4 d-flex justify-content-end">
                                {{ $products->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
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

    //xóa tất cả thẻ tr rỗng
    const rows = document.querySelectorAll('tr');
    rows.forEach(row => {
        if (row.innerHTML.trim() === '') {
            row.remove();
        }
    });

    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('#status-options').toggle();
        $('#category-options').hide();

    });
    //Trademarks
    $('#btn-trademark').click(function(event) {
        event.preventDefault();
        $('#trademark-options').toggle();
    });
    $('#cancel-trademark').click(function(event) {
        event.preventDefault();
        $('#trademark-options').hide();
    });

    $('#btn-id').click(function(event) {
        event.preventDefault();
        $('#id-options').toggle();
    });
    $('#cancel-id').click(function(event) {
        event.preventDefault();
        $('#id-options').hide();
    });
    //Code
    $('#btn-code').click(function(event) {
        event.preventDefault();
        $('#code-options').toggle();
    });
    $('#cancel-code').click(function(event) {
        event.preventDefault();
        $('#code-options').hide();
    });
    $('#btn-price_inven').click(function(event) {
        event.preventDefault();
        $('#price_inven-options').toggle();
    });
    $('#cancel-price_inven').click(function(event) {
        event.preventDefault();
        $('#price_inven-options').hide();
    });
    $('#btn-avg').click(function(event) {
        event.preventDefault();
        $('#avg-options').toggle();
    });
    $('#cancel-avg').click(function(event) {
        event.preventDefault();
        $('#avg-options').hide();
    });
    $('#btn-quantity').click(function(event) {
        event.preventDefault();
        $('#quantity-options').toggle();
    });
    $('#cancel-quantity').click(function(event) {
        event.preventDefault();
        $('#quantity-options').hide();
    });
    $('#btn-category').click(function(event) {
        event.preventDefault();
        $('#category-options').toggle();
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('#status-options').hide();
    });
    $('#cancel-category').click(function(event) {
        event.preventDefault();
        $('#category-options').hide();
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-category').click(function() {
            $('#category-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-category').click(function() {
            $('#category-options input[type="checkbox"]').prop('checked', false);
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
        // Chọn tất cả các checkbox
        $('.select-all-trademark').click(function() {
            $('#trademark-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-trademark').click(function() {
            $('#trademark-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status', function() {
            $('.deselect-all').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-category', function() {
            $('.deselect-all-category').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-trademark', function() {
            $('.deselect-all-trademark').click();
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
        $('.filter-results').on('click', '.delete-btn-id', function() {
            $('.deselect-all-id').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-code', function() {
            $('.code-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-products_name', function() {
            $('.products_name-input').val('');
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
</script>
</body>

</html>
