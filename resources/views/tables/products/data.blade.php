<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-1 m-0">
                @can('view-provides')
                <a href="{{ route('insertProducts') }}">
                    <button type="button" class="btn btn-primary d-flex align-items-center">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0C6.38791 -1.97352e-08 6.70237 0.314463 6.70237 0.702373L6.70237 11.2976C6.70237 11.6855 6.38791 12 6 12C5.61209 12 5.29763 11.6855 5.29763 11.2976V0.702373C5.29763 0.314463 5.61209 -1.97352e-08 6 0Z" fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C12 6.38791 11.6855 6.70237 11.2976 6.70237H0.702373C0.314463 6.70237 -1.38146e-07 6.38791 0 6C-5.13115e-07 5.61209 0.314463 5.29763 0.702373 5.29763H11.2976C11.6855 5.29763 12 5.61209 12 6Z" fill="white" />
                        </svg>
                        <span class="ml-2">Thêm sản phẩm</span>
                    </button>
                </a>
                <div class="class">
                <button type="button" class="btn btn-outline-primary mx-3 d-flex align-items-center">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15.0003 7.80054H16.5001C16.8979 7.80054 17.2794 7.95857 17.5607 8.23984C17.842 8.52112 18 8.9026 18 9.30039V17.1006C18 17.4983 17.842 17.8798 17.5607 18.1611C17.2794 18.4424 16.8979 18.6004 16.5001 18.6004H7.49986C7.10207 18.6004 6.72058 18.4424 6.4393 18.1611C6.15802 17.8798 6 17.4983 6 17.1006V9.30039C6 8.9026 6.15802 8.52112 6.4393 8.23984C6.72058 7.95857 7.10207 7.80054 7.49986 7.80054H8.99972" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M8.99976 11.3997L11.9995 14.3994L15.0003 11.3997" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12.0006 3V13.7999" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <span>Xuất Excel</span>
                </button>
            </div>
                <div class="btn btn-outline-primary btn-file d-flex align-items-center">
                    <div>
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M8.99972 15.7999H7.49986C7.10207 15.7999 6.72058 15.6419 6.4393 15.3606C6.15802 15.0793 6 14.6979 6 14.3001L6 6.49991C6 6.10212 6.15802 5.72062 6.4393 5.43934C6.72058 5.15806 7.10207 5.00003 7.49986 5.00003L16.5001 5.00003C16.8979 5.00003 17.2794 5.15806 17.5607 5.43934C17.842 5.72062 18 6.10212 18 6.49991V14.3001C18 14.6979 17.842 15.0793 17.5607 15.3606C17.2794 15.6419 16.8979 15.7999 16.5001 15.7999H15.0003" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15.0005 12.2006L12.0008 9.20092L8.99994 12.2006" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M11.9995 20.6003L11.9995 9.80045" stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <span>Nhập Excel</span> <input type="file" id="import_file" onchange="importExcel()">
                </div>

                @endcan
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row mr-0">
                        <div class="col-5">
                            <input type="text" placeholder="Tìm kiếm theo mã sản phẩm hoặc tên sản phẩm" name="keywords" class="pr-4 input-search w-100 form-control" value="{{ request()->keywords }}">
                            <span class="search-icon"><i class="fas fa-search"></i></span>
                        </div>
                        <div class="col-2 d-none">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                        <a class="btn ml-auto btn-delete-filter btn-light" href="{{ route('data.index') }}"><span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z" fill="#555555" />
                                </svg>
                            </span>Tắt bộ lọc</a>
                    </div>
                    <div class="d-flex justify-contents-center align-items-center mr-auto row-filter my-3 m-0">
                        <div class="icon-filter mr-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z" fill="#555555" />
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
                            <span class="filter-group" style="order: 
                                            @php
$index = array_search($item['label'], $numberedLabels);
                                                if ($index !== false) {
                                                    echo $index + 1;
                                                } else {
                                                    echo 0;
                                                } @endphp">
                                {{ $item['label'] }}
                                <span class="filter-values">{{ implode(',', $item['values']) }}</span>
                                <a class="delete-item delete-btn-{{ $item['class'] }}" onclick="updateDeleteItemValue('{{ $item['label'] }}')">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </span>
                            @endforeach
                            <span class="" style="order: 999;">
                                <div class="filter-options">
                                    <div class="dropdown">
                                        <button class="btn btn-filter btn-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z" fill="#555555" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z" fill="#555555" />
                                                </svg>
                                                Thêm bộ lọc
                                            </span>
                                        </button>
                                        <div class="dropdown-menu" id="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="search-container px-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput" onkeyup="filterFunction()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div class="scrollbar">
                                                <button class="dropdown-item" id="btn-code">Mã sản phẩm</button>
                                                <button class="dropdown-item" id="btn-id">Tên sản phẩm</button>
                                                <button class="dropdown-item" id="btn-category">Danh mục</button>
                                                <button class="dropdown-item" id="btn-trademark">Thương hiệu</button>
                                                <button class="dropdown-item" id="btn-quantity">Tồn kho</button>
                                                <button class="dropdown-item" id="btn-avg">Trị trung bình</button>
                                                <button class="dropdown-item" id="btn-price_inven">Trị tồn
                                                    kho</button>
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
                                            <div class="heading-title title-wrap">
                                                <h5>Tên sản phẩm</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>
                                                <input type="search" name="products_name" class="form-control  products_name-input" value="{{ request()->products_name }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-id" class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- Tìm mã sản phẩm --}}
                                    <div class="block-options" id="code-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Mã sản phẩm</h5>
                                            </div>
                                            <div class="input-group p-2">
                                                <label class="title" for="">Chứa kí tự</label>

                                                <input type="search" name="code" class="form-control code-input" value="{{ request()->code }}" placeholder="Nhập thông tin..">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-code" class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter Status --}}
                                    <div class="block-options" id="status-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trạng thái</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-status" class="pr-4 w-100 input-search" onkeyup="filterStatus()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all">Hủy chọn</a>
                                            </div>
                                            <ul class="ks-cboxtags-status p-0 m-0 px-2">
                                                <li>
                                                    <input type="checkbox" id="status_active" {{ in_array(2, $status) ? 'checked' : '' }} name="status[]" value="2">
                                                    <label for="status_active">Sẵn hàng</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_inactive" {{ in_array(1, $status) ? 'checked' : '' }} name="status[]" value="1">
                                                    <label for="status_inactive">Gần hết</label>
                                                </li>
                                                <li>
                                                    <input type="checkbox" id="status_inactive" {{ in_array(0, $status) ? 'checked' : '' }} name="status[]" value="0">
                                                    <label for="status_inactive">Hết hàng</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-status" class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter danh mục --}}
                                    <div class="block-options" id="category-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Danh mục</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-category" class="pr-4 w-100" onkeyup="filterCategory()">
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
                                                    <input type="checkbox" id="roles_active" {{ in_array($category->id, $categoryarr) ? 'checked' : '' }} name="categoryarr[]" value="{{ $category->id }}">
                                                    <label for="roles_active">{{ $category->category_name }}</label>
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-category" class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- filter thương hiệu --}}
                                    <div class="block-options" id="trademark-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Thương hiệu</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-trademark" class="pr-4 w-100" onkeyup="filterTrademark()">
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
                                                    <input type="checkbox" id="trademark_active" {{ in_array($value->products_trademark, $trademarkarr) ? 'checked' : '' }} name="trademarkarr[]" value="{{ $value->products_trademark }}">
                                                    <label id="trademark_value" for="trademark_active">{{ $value->products_trademark }}</label>
                                                </li>
                                                @php
                                                $seenValues[] = $value->products_trademark;
                                                @endphp
                                                @endif
                                                @endforeach
                                                @endif
                                            </ul>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-trademark" class="btn btn-default btn-block">Hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- filter tồn kho --}}
                                    <div class="block-options" id="quantity-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Tồn kho</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="comparison_operator" name="comparison_operator" style="width: 40%">
                                                    <option value=">=" {{ request('comparison_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('comparison_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 quantity-input" class="form-control" type="number" name="quantity"
                                                    value="{{ request()->quantity }}" placeholder="Số lượng">

                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-quantity" class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter trị trung bình --}}
                                    <div class="block-options" id="avg-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trị trung bình</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="avg_operator" name="avg_operator" style="width: 40%">
                                                    <option value=">=" {{ request('avg_operator') === '>=' ? 'selected' : '' }}>>=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('avg_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 avg-input" type="number" name="avg" value="{{ request()->avg }}" placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-avg" class="btn btn-default btn-block">Hủy</button>
                                        </div>
                                    </div>
                                    {{-- filter trị tồn kho --}}
                                    <div class="block-options" id="price_inven-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trị tồn kho</h5>
                                            </div>
                                            <div class="input-group p-2 justify-content-around">
                                                <select class="price_inven_operator" name="price_inven_operator" style="width: 40%">
                                                    <option value=">=" {{ request('price_inven_operator') === '>=' ? 'selected' : '' }}>
                                                        >=
                                                    </option>
                                                    <option value="<="
                                                        {{ request('price_inven_operator') === '<=' ? 'selected' : '' }}>
                                                        <=</option>
                                                </select>
                                                <input class="w-50 price_inven-input" type="number" name="price_inven" value="{{ request()->price_inven }}" placeholder="Nhập giá trị">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-contents-center align-items-baseline p-2">
                                            <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-price_inven" class="btn btn-default btn-block">Hủy</button>
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
                    <div class="btn-taodon my-2">
                        <button type="button" class="btn-group btn btn-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z" fill="#555555" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z" fill="#555555" />
                            </svg>
                            <span>Tạo đơn bán</span>
                        </button>
                    </div>
                    <div class="btn-nhaphang my-2">
                        <button type="button" class="btn-group btn btn-light mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z" fill="#555555" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z" fill="#555555" />
                            </svg>
                            <span>Nhập hàng</span>
                        </button>
                    </div>
                    <div class="dropdown my-2">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hành động khác
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="#" id="deleteProducts" class="dropdown-item">Xóa nhiều</a>
                        </div>
                    </div>
                </div>
                <div class="cancal_action btn ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M18 18L6 6" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18 6L6 18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
                                    <tr>
                                        <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                        <input type="hidden" id="sortTypeInput" name="sort-type" value="{{ $sortType }}">
                                        <th scope="col" style="width:2%">
                                            <span class="d-flex">
                                                <input type="checkbox" id="checkall">
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">ID</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_code" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Mã sản phẩm</button></a>
                                                <div class="icon" id="icon-products_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_name" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Tên sản phẩm</button></a>

                                                <div class="icon" id="icon-products_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="ID_category" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Danh mục</button></a>
                                                <div class="icon" id="icon-ID_category"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_trademark" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Thương hiệu</button></a>
                                                <div class="icon" id="icon-products_trademark"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="inventory" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Tồn kho</button></a>

                                                <div class="icon" id="icon-inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="price_avg" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Trị trung bình</button></a>

                                                <div class="icon" id="icon-price_avg"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="price_inventory" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Trị tồn kho</button></a>
                                                <div class="icon" id="icon-price_inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="inventory" data-sort-type="{{ $sortType }}"><button class="btn-sort" type="submit">Trạng thái</button></a>
                                                <div class="icon" id="icon-status_"></div>
                                            </span>
                                        </th>
                                        <th scope="col"></th>
                                        <th></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($products as $value)
                                    <tr class="{{ $value->id }}">
                                        <td><input type="checkbox" name="ids[]" class="cb-element" value="{{ $value->id }}"></td>
                                        <td scope="row">{{ $value->id }}</td>
                                        <td>
                                            <!-- <a href="{{ route('data.show', $value->id) }}"> -->
                                            {{ $value->products_code }}
                                            <!-- </a> -->
                                        </td>
                                        <td>{{ $value->products_name }}</td>
                                        <td>
                                            {{ $value->ID_category }}
                                        </td>
                                        <td class="text-left">{{ $value->products_trademark }}</td>
                                        <td class="text-right">
                                            @if ($value->inventory == 0)
                                            0
                                            @else
                                            {{ $value->inventory }}
                                            @endif

                                            </td>
                                            <td class="text-right">{{ number_format($value->price_avg) }}</td>
                                            <td class="text-right">{{ number_format($value->price_inventory) }}</td>
                                            <td class="p-0 text-center">
                                                @if ($value->inventory == 0)
                                                    <div class="py-1 rounded  pb-1 bg-danger">
                                                        <span class="text-light">Hết hàng</span>
                                                    </div>
                                                @elseif($value->inventory < 6)
                                                    <div class="py-1 rounded  pb-1 bg-warning">
                                                        <span class="text-light">Gần hết</span>
                                                    </div>
                                                @else
                                                    <div class="py-1 rounded  pb-1 bg-success">
                                                        <span class="text-light">Sẵn hàng</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="icon">
                                                    @if (Auth::user()->can('view-provides'))
                                                        <a href="{{ route('data.edit', $value->id) }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                height="32" viewBox="0 0 32 32" fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                    fill="#555555" />
                                                            </svg>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('data.edit', $value->id) }}">
                                                            <svg width="32" height="32" viewBox="0 0 32 32"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M18.6775 10.6226V5.91937C18.6775 5.50358 18.5123 5.10482 18.2183 4.81081C17.9243 4.5168 17.5255 4.35162 17.1097 4.35162H6.91937C6.50358 4.35162 6.10482 4.5168 5.81081 4.81081C5.5168 5.10482 5.35162 5.50358 5.35162 5.91937V16.8936C5.35162 17.3094 5.5168 17.7082 5.81081 18.0022C6.10482 18.2962 6.50358 18.4614 6.91937 18.4614H10.8387"
                                                                    stroke="#555555" stroke-width="1.5"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M10.2509 13.7581H10.8388" stroke="#555555"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M10.2509 10.6226H13.1904" stroke="#555555"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path d="M10.2509 7.58511H15.542" stroke="#555555"
                                                                    stroke-width="1.5" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                                <path
                                                                    d="M8.29115 8.11423C8.40743 8.11423 8.52109 8.07975 8.61778 8.01515C8.71446 7.95055 8.78981 7.85873 8.83431 7.7513C8.8788 7.64388 8.89045 7.52567 8.86776 7.41163C8.84508 7.29758 8.78909 7.19283 8.70687 7.11061C8.62465 7.02839 8.51989 6.9724 8.40585 6.94971C8.29181 6.92703 8.1736 6.93867 8.06617 6.98317C7.95875 7.02766 7.86693 7.10302 7.80233 7.1997C7.73773 7.29638 7.70325 7.41004 7.70325 7.52632C7.70325 7.68224 7.76519 7.83178 7.87544 7.94203C7.98569 8.05229 8.13523 8.11423 8.29115 8.11423Z"
                                                                    fill="#555555" />
                                                                <path
                                                                    d="M8.29115 11.2497C8.40743 11.2497 8.52109 11.2152 8.61778 11.1506C8.71446 11.086 8.78981 10.9942 8.83431 10.8868C8.8788 10.7794 8.89045 10.6612 8.86776 10.5471C8.84508 10.4331 8.78909 10.3283 8.70687 10.2461C8.62465 10.1639 8.51989 10.1079 8.40585 10.0852C8.29181 10.0625 8.1736 10.0742 8.06617 10.1187C7.95875 10.1632 7.86693 10.2385 7.80233 10.3352C7.73773 10.4319 7.70325 10.5455 7.70325 10.6618C7.70325 10.8177 7.76519 10.9673 7.87544 11.0775C7.98569 11.1878 8.13523 11.2497 8.29115 11.2497Z"
                                                                    fill="#555555" />
                                                                <path
                                                                    d="M8.29115 14.3069C8.40743 14.3069 8.52109 14.2724 8.61778 14.2078C8.71446 14.1432 8.78981 14.0514 8.83431 13.9439C8.8788 13.8365 8.89045 13.7183 8.86776 13.6043C8.84508 13.4902 8.78909 13.3855 8.70687 13.3032C8.62465 13.221 8.51989 13.165 8.40585 13.1423C8.29181 13.1197 8.1736 13.1313 8.06617 13.1758C7.95875 13.2203 7.86693 13.2956 7.80233 13.3923C7.73773 13.489 7.70325 13.6027 7.70325 13.7189C7.70325 13.8749 7.76519 14.0244 7.87544 14.1347C7.98569 14.2449 8.13523 14.3069 8.29115 14.3069Z"
                                                                    fill="#555555" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M18.2246 13.1819C16.996 11.9533 15.004 11.9533 13.7754 13.1819C12.5468 14.4105 12.5468 16.4025 13.7754 17.6311C15.004 18.8597 16.996 18.8597 18.2246 17.6311C19.4532 16.4025 19.4532 14.4105 18.2246 13.1819ZM18.8284 12.5781C17.2663 11.016 14.7337 11.016 13.1716 12.5781C11.6095 14.1402 11.6095 16.6728 13.1716 18.2349C14.7337 19.797 17.2663 19.797 18.8284 18.2349C20.3905 16.6728 20.3905 14.1402 18.8284 12.5781Z"
                                                                    fill="#555555" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M18.1376 18.1376C18.321 17.9541 18.6184 17.9541 18.8019 18.1376L20.8624 20.1981C21.0459 20.3816 21.0459 20.679 20.8624 20.8624C20.679 21.0459 20.3816 21.0459 20.1981 20.8624L18.1376 18.8019C17.9541 18.6184 17.9541 18.321 18.1376 18.1376Z"
                                                                    fill="#555555" />
                                                            </svg>
                                                        </a>
                                                    @endif

                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if ($value->inventory != 0)
                                                    <div id="dropdown_item{{ $value->id }}" data-toggle="collapse"
                                                        class="dropdownitem"
                                                        data-target="#product-details-<?php echo $value->id; ?>">
                                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <rect width="32" height="32" rx="4" fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.3582 19.6917C21.9471 20.1028 21.2806 20.1028 20.8695 19.6917L15.9998 14.822L11.1301 19.6917C10.719 20.1028 10.0526 20.1028 9.64148 19.6917C9.2304 19.2806 9.2304 18.6141 9.64148 18.203L15.2555 12.589C15.6666 12.1779 16.3331 12.1779 16.7442 12.589L22.3582 18.203C22.7693 18.6141 22.7693 19.2806 22.3582 19.6917Z" fill="#555555" />
                                </svg> --}}
                                                        <svg width="32" height="32" viewBox="0 0 32 32"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M9.6418 12.3083C10.0529 11.8972 10.7194 11.8972 11.1305 12.3083L16.0002 17.178L20.8699 12.3083C21.281 11.8972 21.9474 11.8972 22.3585 12.3083C22.7696 12.7194 22.7696 13.3859 22.3585 13.797L16.7445 19.411C16.3334 19.8221 15.6669 19.8221 15.2558 19.411L9.6418 13.797C9.23073 13.3859 9.23073 12.7194 9.6418 12.3083Z"
                                                                fill="#555555" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @foreach ($product as $item)
                                            <tr id="product-details-{{ $value->id }}"
                                                class="collapse product-details">
                                                @if ($value->id == $item->products_id)
                                                    <td></td>
                                                    <td>{{ $value->id }} - {{ $item->id }}</td>
                                                    <td>{{ $value->products_code }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>
                                                        <p>Loại hàng</p>{{ $item->product_category }}
                                                    </td>
                                                    <td>{{ $item->product_trademark }}</td>
                                                    <td class="text-right">
                                                        <p>Tồn kho</p>{{ $item->product_qty }}
                                                    </td>
                                                    <td class="text-right">
                                                        <p>Đơn giá nhập</p>{{ number_format($item->product_price) }}
                                                    </td>
                                                    <td class="text-right">
                                                        <p>Trị tồn kho</p>{{ number_format($item->total) }}
                                                    </td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <form action="{{ route('editProduct', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                style="background: transparent; border:none;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                    height="32" viewBox="0 0 32 32"
                                                                    fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                        fill="#555555"></path>
                                                                </svg>
                                                            </button>

                                                        </form>
                                                    </td>

                                                    <td class="text-center">
                                                        <form action="{{ route('delete_product', $item->id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                style="background: transparent; border:none;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                                    height="32" viewBox="0 0 32 32"
                                                                    fill="none">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z"
                                                                        fill="#555555"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="paginator mt-4 d-flex justify-content-end">
                        {{ $products->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>

</div>
</section>
</div>
</div>

<script>
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

    // Import file excel
    function importExcel() {
        var input = document.getElementById("import_file");
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, {
                type: "array"
            });
            var worksheet = workbook.Sheets[workbook.SheetNames[0]];
            var jsonData = XLSX.utils.sheet_to_json(worksheet, {
                header: 1
            });

            var formattedData = [];
            var headers = jsonData[0];

            for (var i = 1; i < jsonData.length; i++) {
                var row = jsonData[i];
                var formattedRow = {};
                for (var j = 0; j < headers.length; j++) {
                    var header = headers[j];
                    formattedRow[header] = row[j];
                }
                formattedData.push(formattedRow);
            }
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch("/import_products", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": csrfToken
                    },
                    body: JSON.stringify(formattedData),
                })
                .then(function(response) {
                    if (response.ok) {
                        location.reload();
                    } else {
                        console.log("Có lỗi xảy ra trong quá trình import.");
                    }
                })
                .catch(function(error) {
                    console.log("Lỗi: " + error);
                });
        };
        reader.readAsArrayBuffer(file);
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
                } else {
                    $('.alert-success').append(data.msg)
                    // location.reload();
                }
            }
        })
    })


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
        $('.btn-filter').prop('disabled', true);
        $('#status-options').toggle();
        $('#category-options').hide();
    });
    //Trademarks
    $('#btn-trademark').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#trademark-options').toggle();
    });
    $('#cancel-trademark').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#trademark-options input[type="checkbox"]').prop('checked', false);
        $('#trademark-options').hide();
    });

    $('#btn-id').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#id-options').toggle();
    });
    $('#cancel-id').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.products_name-input').val('');
        $('#id-options').hide();
    });
    //Code
    $('#btn-code').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#code-options').toggle();
    });
    $('#cancel-code').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.code-input').val('');
        $('#code-options').hide();
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
    $('#btn-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#category-options').toggle();
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
                svgElement.css({
                    transform: 'rotate(0deg)',
                    transition: 'transform 0.3s ease'
                });
            }
            if (!isActive) {
                $(this).addClass('dropdown-item-active');
                parentElement.css('background', '#ADB5BD');
                svgElement.css({
                    transform: 'rotate(180deg)',
                    transition: 'transform 0.3s ease'
                });
            }
        });
    });
</script>
</body>

</html>