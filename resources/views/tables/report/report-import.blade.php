<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="link-report mb-1 mr-auto d-flex mt-auto">
            <a href="{{ route('indexImport') }}" class="title mr-2 pt-2 px-1 active" href="">
                Nhập hàng
            </a>
            <a href="{{ route('indexExport') }}" class="title mr-2 pt-2 px-1 before">
                Xuất hàng
            </a>
            <div class="ml-auto choosetime">
                <div class="col d-flex" style="position: relative; width: 280px">
                    <div class="dropdown w-100">
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
                                        <div class="it0"></div>
                                        <div class="id0"></div>
                                    </div>
                                    <div class="ca text-left">Tất cả</div>
                                </div>
                            </div>
                            {{-- Tháng này Orders --}}
                            <div id="this-month-orders" style="display: none">
                                <div class="d-flex flex-column all-orders">
                                    <div class="ca d-flex">
                                        <div class="it1"></div>
                                        <div class="id1"></div>
                                    </div>
                                    <div class="ca text-left">Tháng này</div>
                                </div>
                            </div>
                            {{-- Tháng trước đây Orders --}}
                            <div id="last-month-orders" style="display: none">
                                <div class="d-flex flex-column all-orders">
                                    <div class="ca d-flex">
                                        <div class="it2"></div>
                                        <div class="id2"></div>
                                    </div>
                                    <div class="ca text-left">Tháng trước</div>
                                </div>
                            </div>
                            {{-- 3 Tháng trước đây Orders --}}
                            <div id="3last-month-orders" style="display: none">
                                <div class="d-flex flex-column all-orders">
                                    <div class="ca d-flex">
                                        <div class="it3"></div>
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
                        <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item dropdown-item-orders" id="btn-all-orders" href="#"
                                data-value="0">Tất cả</a>
                            <a class="dropdown-item dropdown-item-orders" id="btn-this-month-orders" href="#"
                                data-value="1">Tháng này</a>
                            <a class="dropdown-item dropdown-item-orders" id="btn-last-month-orders" href="#"
                                data-value="2">Tháng trước</a>
                            <a class="dropdown-item dropdown-item-orders" id="btn-3last-month-orders" href="#"
                                data-value="3">3 tháng trước</a>
                            <a class="dropdown-item dropdown-item-orders" id="btn-time-orders" href="#">Khoảng
                                thời
                                gian</a>
                        </div>
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
                            <button type="button" class="suscess btn btn-primary btn-block mr-2" value="4">Xác
                                nhận</button>
                            <button type="button" id="cancel-times-orders"
                                class="btn btn-default btn-block">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr">
        <div class="container-fluided">
            <div class="">
                <div class="row">
                    <div class="col-md-3">
                        <div class="bg-white rounded">
                            <div class="d-flex p-2">
                                <div class="rounded p-2 background-blue-light">
                                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_7866_242716)">
                                            <path
                                                d="M33.3333 18.3333V8.33333C33.3333 7.44928 32.9821 6.60143 32.357 5.97631C31.7319 5.35119 30.8841 5 30 5H8.33333C7.44928 5 6.60143 5.35119 5.97631 5.97631C5.35119 6.60143 5 7.44928 5 8.33333V31.6667C5 32.5507 5.35119 33.3986 5.97631 34.0237C6.60143 34.6488 7.44928 35 8.33333 35H16.6667"
                                                stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M15.4167 25H16.6667" stroke="#0095F6" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M29.1667 23.0293V28.3326" stroke="#0095F6" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M35 36.666H23.5417C23.0444 36.666 22.5675 36.4684 22.2159 36.1168C21.8642 35.7652 21.6667 35.2882 21.6667 34.791V27.611C21.667 27.1607 21.7583 26.7151 21.935 26.301L22.8467 24.1676C22.9912 23.8299 23.2317 23.542 23.5384 23.3396C23.845 23.1373 24.2043 23.0294 24.5717 23.0293H33.7617C34.1288 23.0295 34.4879 23.1374 34.7942 23.3398C35.1006 23.5422 35.3408 23.83 35.485 24.1676L36.3984 26.3043C36.5754 26.7184 36.6666 27.164 36.6667 27.6143V34.9993C36.6667 35.4413 36.4911 35.8653 36.1785 36.1778C35.866 36.4904 35.442 36.666 35 36.666Z"
                                                stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M36.6667 30.0007C36.6667 29.5586 36.4911 29.1347 36.1785 28.8221C35.866 28.5096 35.442 28.334 35 28.334H23.3334C22.8913 28.334 22.4674 28.5096 22.1548 28.8221C21.8423 29.1347 21.6667 29.5586 21.6667 30.0007"
                                                stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M15.4167 18.334H21.6667" stroke="#0095F6" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M15.4167 11.875H26.6667" stroke="#0095F6" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M11.25 13C11.4972 13 11.7389 12.9267 11.9445 12.7893C12.15 12.652 12.3102 12.4568 12.4048 12.2284C12.4995 11.9999 12.5242 11.7486 12.476 11.5061C12.4278 11.2637 12.3087 11.0409 12.1339 10.8661C11.9591 10.6913 11.7363 10.5723 11.4939 10.524C11.2514 10.4758 11.0001 10.5005 10.7716 10.5951C10.5432 10.6898 10.348 10.85 10.2107 11.0555C10.0733 11.2611 10 11.5028 10 11.75C10 12.0815 10.1317 12.3995 10.3661 12.6339C10.6005 12.8683 10.9185 13 11.25 13Z"
                                                fill="#0095F6" />
                                            <path
                                                d="M11.25 19.666C11.4972 19.666 11.7389 19.5927 11.9445 19.4553C12.15 19.318 12.3102 19.1228 12.4048 18.8944C12.4995 18.666 12.5242 18.4146 12.476 18.1722C12.4278 17.9297 12.3087 17.7069 12.1339 17.5321C11.9591 17.3573 11.7363 17.2383 11.4939 17.19C11.2514 17.1418 11.0001 17.1666 10.7716 17.2612C10.5432 17.3558 10.348 17.516 10.2107 17.7215C10.0733 17.9271 10 18.1688 10 18.416C10 18.7475 10.1317 19.0655 10.3661 19.2999C10.6005 19.5343 10.9185 19.666 11.25 19.666Z"
                                                fill="#0095F6" />
                                            <path
                                                d="M11.25 26.166C11.4972 26.166 11.7389 26.0927 11.9445 25.9553C12.15 25.818 12.3102 25.6228 12.4048 25.3944C12.4995 25.166 12.5242 24.9146 12.476 24.6722C12.4278 24.4297 12.3087 24.2069 12.1339 24.0321C11.9591 23.8573 11.7363 23.7383 11.4939 23.69C11.2514 23.6418 11.0001 23.6666 10.7716 23.7612C10.5432 23.8558 10.348 24.016 10.2107 24.2215C10.0733 24.4271 10 24.6688 10 24.916C10 25.2475 10.1317 25.5655 10.3661 25.7999C10.6005 26.0343 10.9185 26.166 11.25 26.166Z"
                                                fill="#0095F6" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_7866_242716">
                                                <rect width="40" height="40" rx="4" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="m-0">Tổng đơn nhập</p><b class="m-0" id="import_id">{{ $orders }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-white rounded">
                            <div class="d-flex p-2">
                                <div class="rounded p-2 background-blue-light">
                                    <svg width="40" height="40" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.0416 5.75C22.7221 5.75 23.2737 6.34408 23.2737 7.07692V9.72619H23.8963C26.2114 9.74349 28.3465 11.0742 29.514 13.2274C29.8571 13.8602 29.6589 14.6728 29.0713 15.0424C28.4836 15.4119 27.7291 15.1984 27.386 14.5656C26.6579 13.2227 25.3269 12.3923 23.8832 12.38H22.1446C22.1107 12.3831 22.0763 12.3846 22.0416 12.3846C22.0069 12.3846 21.9726 12.3831 21.9386 12.38L19.8376 12.38C19.8375 12.38 19.8378 12.38 19.8376 12.38C17.8393 12.382 16.1551 13.9873 15.911 16.1233C15.6669 18.2594 16.9391 20.2567 18.8775 20.7803L25.8054 22.6546C25.8052 22.6546 25.8055 22.6547 25.8054 22.6546C28.95 23.5043 31.0142 26.7445 30.6181 30.2099C30.222 33.6755 27.49 36.28 24.2478 36.2828L23.2737 36.2828V38.9231C23.2737 39.6559 22.7221 40.25 22.0416 40.25C21.3612 40.25 20.8095 39.6559 20.8095 38.9231V36.2828H20.1851C17.8663 36.2615 15.7299 34.9247 14.5641 32.7659C14.222 32.1324 14.4215 31.3202 15.0097 30.9518C15.598 30.5833 16.3521 30.7982 16.6942 31.4317C17.4218 32.779 18.7544 33.6138 20.2012 33.629H21.8648C21.9225 33.62 21.9816 33.6154 22.0416 33.6154C22.1017 33.6154 22.1607 33.62 22.2185 33.629H24.2458C26.2443 33.6272 27.9283 32.0219 28.1724 29.8857C28.4165 27.7496 27.1443 25.7523 25.2059 25.2287L18.278 23.3544C18.2779 23.3543 18.2782 23.3544 18.278 23.3544C15.1335 22.5047 13.0692 19.2645 13.4653 15.7991C13.8614 12.3335 16.5934 9.72901 19.8356 9.72619L20.8095 9.72619V7.07692C20.8095 6.34408 21.3612 5.75 22.0416 5.75Z"
                                            fill="#0095F6" />
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="m-0">Tổng tiền nhập (+VAT)</p><b
                                        class="m-0" id="import_total">{{ number_format($sumTotalOrders) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bg-white rounded">
                            <div class="d-flex p-2">
                                <div class="rounded p-2 background-red-light">
                                    <svg width="40" height="40" viewBox="0 0 46 46" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M22.0416 5.75C22.7221 5.75 23.2737 6.34408 23.2737 7.07692V9.72619H23.8963C26.2114 9.74349 28.3465 11.0742 29.514 13.2274C29.8571 13.8602 29.6589 14.6728 29.0713 15.0424C28.4836 15.4119 27.7291 15.1984 27.386 14.5656C26.6579 13.2227 25.3269 12.3923 23.8832 12.38H22.1446C22.1107 12.3831 22.0763 12.3846 22.0416 12.3846C22.0069 12.3846 21.9726 12.3831 21.9386 12.38L19.8376 12.38C19.8375 12.38 19.8378 12.38 19.8376 12.38C17.8393 12.382 16.1551 13.9873 15.911 16.1233C15.6669 18.2594 16.9391 20.2567 18.8775 20.7803L25.8054 22.6546C25.8052 22.6546 25.8055 22.6547 25.8054 22.6546C28.95 23.5043 31.0142 26.7445 30.6181 30.2099C30.222 33.6755 27.49 36.28 24.2478 36.2828L23.2737 36.2828V38.9231C23.2737 39.6559 22.7221 40.25 22.0416 40.25C21.3612 40.25 20.8095 39.6559 20.8095 38.9231V36.2828H20.1851C17.8663 36.2615 15.7299 34.9247 14.5641 32.7659C14.222 32.1324 14.4215 31.3202 15.0097 30.9518C15.598 30.5833 16.3521 30.7982 16.6942 31.4317C17.4218 32.779 18.7544 33.6138 20.2012 33.629H21.8648C21.9225 33.62 21.9816 33.6154 22.0416 33.6154C22.1017 33.6154 22.1607 33.62 22.2185 33.629H24.2458C26.2443 33.6272 27.9283 32.0219 28.1724 29.8857C28.4165 27.7496 27.1443 25.7523 25.2059 25.2287L18.278 23.3544C18.2779 23.3543 18.2782 23.3544 18.278 23.3544C15.1335 22.5047 13.0692 19.2645 13.4653 15.7991C13.8614 12.3335 16.5934 9.72901 19.8356 9.72619L20.8095 9.72619V7.07692C20.8095 6.34408 21.3612 5.75 22.0416 5.75Z"
                                            fill="#b23333" />
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="m-0">Tổng công nợ (+VAT)</p><b
                                        class="m-0" id="countDebtImport">{{ number_format($sumDebtImportVAT) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <div class="row m-auto filter pt-2">
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
                            @php  $nhanvien = [];
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
                                            @if (!Auth::user()->can('isAdmin'))
                                                <button class="dropdown-item" id="btn-creator">Nhân viên</button>
                                            @endif
                                            <button class="dropdown-item" id="btn-email">Email</button>
                                            <button class="dropdown-item" id="btn-roles">Vai trò</button>
                                        </div>
                                        @if (!empty($string))
                                            <a class="btn-delete-filter" href="{{ route('indexImport') }}"><span>Tắt
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
                                            <button type="submit" id="submit-email"
                                                class="btn btn-primary btn-block mr-2">Xác
                                                Nhận</button>
                                            <button type="button" id="cancel-email"
                                                class="btn btn-default btn-block">Hủy</button>
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
                                    {{-- Vai trò --}}
                                    <div class="block-options" id="role-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Vai trò</h5>
                                            </div>
                                            <div class="search-container px-2 mt-2">
                                                <input type="text" placeholder="Tìm kiếm" id="myInput-roles"
                                                    class="pr-4 w-100 input-search" onkeyup="filterRoles()">
                                                <span class="search-icon"><i class="fas fa-search"></i></span>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all-roles mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all-roles">Hủy chọn</a>
                                            </div>
                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags-roles p-0 mb-1 px-2">
                                                    @if (!empty($allRoles))
                                                        @foreach ($allRoles as $role)
                                                            <li>
                                                                <input type="checkbox" id="roles_active"
                                                                    {{ in_array($role->id, $roles) ? 'checked' : '' }}
                                                                    name="roles[]" value="{{ $role->id }}">
                                                                <label for="">{{ $role->name }}</label>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-contents-center align-items-baseline p-2">
                                                <button type="submit" class="btn btn-primary btn-block mr-2">Xác
                                                    Nhận</button>
                                                <button type="button" id="cancel-roles"
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
                                    <input type="hidden" id="perPageinput" name="perPageinput" value="{{request()->perPageinput}}">
                                    <input type="hidden" id="sortByInput" name="sort-by" value="">
                                    <input type="hidden" id="sortTypeInput" name="sort-type"
                                        value="{{ $sortType }}">
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col"><span class="d-flex justify-content-start">
                                                <a href="#" class="sort-link" data-sort-by="nhanvien"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Nhân viên</button></a>
                                                <div class="icon" id="icon-nhanvien"></div>
                                            </span></th>
                                        <th scope="col"><span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="email"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Email</button></a>
                                                <div class="icon" id="icon-email"></div>
                                            </span></th>
                                        <th scope="col"><span class="d-flex justify-content-center">
                                                <a href="#" class="sort-link" data-sort-by="vaitro"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Vai trò</button></a>
                                                <div class="icon" id="icon-vaitro"></div>
                                            </span></th>
                                        <th scope="col" class="text-right"><span
                                                class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="product_qty_count"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng đơn nhập</button></a>
                                                <div class="icon" id="icon-product_qty_count"></div>
                                            </span></th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="total_sum"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng tiền nhập(+VAT)</button></a>
                                                <div class="icon" id="icon-total_sum"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="total_debt"
                                                    data-sort-type="{{ $sortType }}"><button class="btn-sort"
                                                        type="submit">Tổng công nợ(+VAT)</button></a>
                                                <div class="icon" id="icon-total_debt"></div>
                                            </span>
                                        </th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    <?php $stt = 1; ?>
                                    @foreach ($tableorders as $item)
                                        <tr>
                                            <td><?php echo $stt++; ?></td>
                                            <td class="text-left">{{ $item->nhanvien }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td class="text-center">{{ $item->vaitro }}</td>
                                            <td class="text-right">{{ $item->product_qty_count }}</td>
                                            <td class="text-right">{{ number_format($item->total_sum) }}</td>
                                            <td class="text-right">{{ number_format($item->total_debt) }}
                                            </td>
                                        </tr>
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
                            {{-- {{ $debts->appends(request()->except('page'))->links() }} --}}
                        @else
                            {{-- {{ $debtsCreator->appends(request()->except('page'))->links() }} --}}
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
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Tháng này
    $("#btn-this-month-orders").click(function() {
        $("#this-month-orders").show();
        $("#all-orders").hide();
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Tháng trước
    $("#btn-last-month-orders").click(function() {
        $("#last-month-orders").show();
        $("#all-orders").hide();
        $("#this-month-orders").hide();
        $("#3last-month-orders").hide();
        $("#time-orders").hide();
    });
    // 3 tháng trc
    $("#btn-3last-month-orders").click(function() {
        $("#3last-month-orders").show();
        $("#all-orders").hide();
        $("#this-month-orders").hide();
        $("#last-month-orders").hide();
        $("#time-orders").hide();
    });
    // Khoảng time
    $("#btn-time-orders").click(function() {
        $("#time-orders").show();
        $("#times-orders-options").show();
        $("#all-orders").hide();
        $("#this-month-orders").hide();
        $("#last-month-orders").hide();
        $("#3last-month-orders").hide();
    });
    $('#cancel-times-orders').click(function(event) {
        event.preventDefault();
        $('#times-orders-options').hide();
    });
    $('.suscess').click(function(event) {
        event.preventDefault();
        $('#times-orders-options').hide();
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
        // Làm tròn đến 2 chữ số thập phân
        value = Math.round(value * 100) / 100;

        // Check if the value is negative
        var isNegative = value < 0;
        value = Math.abs(value); // Get the absolute value for formatting

        // Xử lý phần nguyên
        var parts = value.toFixed(2).toString().split(".");
        var integerPart = parts[0];
        var formattedValue = "";

        // Định dạng phần nguyên
        var count = 0;
        for (var i = integerPart.length - 1; i >= 0; i--) {
            formattedValue = integerPart.charAt(i) + formattedValue;
            count++;
            if (count % 3 === 0 && i !== 0) {
                formattedValue = "," + formattedValue;
            }
        }

        // Nếu có phần thập phân, thêm vào sau phần nguyên
        if (parts.length > 1) {
            formattedValue += "." + parts[1];
        } else {
            // Always ensure two decimal places
            formattedValue += ".00";
        }

        // Nếu là số âm, thêm dấu "-" vào đầu chuỗi
        if (isNegative) {
            formattedValue = "-" + formattedValue;
        }

        // Trả về kết quả đã định dạng
        return formattedValue;
    }
    // Nhập hàng
    $(document).on('click', '.dropdown-item-orders', function() {
        var dataid = $(this).data('value');
        $.ajax({
            url: "{{ route('timeImport') }}",
            type: "get",
            data: {
                data: dataid
            },
            success: function(data) {
                    $('#import_id').text(data.countID);
                if (data.sumTotal > 0) {
                    $('#import_total').text(formatCurrency(data.sumTotal));
                }else{
                    $('#import_total').text(0);
                }
                if (data.countDebtImport > 0) {
                    $('#countDebtImport').text(formatCurrency(data.countDebtImport));
                }
                else{
                    $('#countDebtImport').text(0);
                }
                if (data.start_date && data.end_date) {
                    var stId = '.it' + dataid;
                    var edId = '.id' + dataid;
                    $(stId).text(data.start_date)
                    $(edId).text(data.end_date)
                }
            }
        })
    })
    $(document).on('click', '.suscess', function() {
        var data = $(this).val();
        var date_start = $('.date_start').val();
        var date_end = $('.date_end').val();
        $.ajax({
            url: "{{ route('timeImport') }}",
            type: "get",
            data: {
                data: data,
                date_start: date_start,
                date_end: date_end
            },
            success: function(data) {
                $('#import_id').text(data[0].countID);
                if (data[0].sumTotal > 0) {
                    $('#import_total').text(formatCurrency(data[0].sumTotal));
                }else{
                    $('#import_total').text(formatCurrency(0));
                }
                if (data[1].countDebtImport > 0) {
                    $('#countDebtImport').text(formatCurrency(data[1].countDebtImport));
                }
                else{
                    $('#countDebtImport').text(0);
                }
            }
        })
    })
    
    $('#search-icon').on('click', function(e) {
        e.preventDefault();
        $('#search-filter').submit();
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
    function filterRoles() {
        var input = $("#myInput-roles");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-roles li");

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
        $('#end').change(function() {
            var startDate = new Date($('#start').val());
            var endDate = new Date($(this).val());

            if (endDate < startDate) {
                alert('Ngày kết thúc không được nhỏ hơn ngày bắt đầu!');
                $(this).val('');
            }
        });
    });
    $('.ks-cboxtags-creator li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    // Email
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
        $('.filter-results').on('click', '.delete-btn-email', function() {
            $('.email-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    // Vai trò
    $('#btn-roles').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options input').addClass('status-checkbox');
        $('#role-options').toggle();
        $('#status-options').hide();
    });
    $('#cancel-roles').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#role-options input[type="checkbox"]').prop('checked', false);
        $('#role-options').hide();
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-roles', function() {
            $('.deselect-all-roles').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-roles').click(function() {
            $('#role-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-roles').click(function() {
            $('#role-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $('.ks-cboxtags-roles li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
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

    $(document).ready(function() {
        $(".email-input").on("keypress", function(event) {
            if (event.which === 13) {
                event.preventDefault();
                $("#submit-email").click();
            }
        });
    });
    // Check box
    $(document).ready(function() {
        // Chọn tất cả các checkbox
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
        // Chọn tất cả các checkbox
        $('.select-all-guest').click(function() {
            $('#guest-options input[type="checkbox"]').prop('checked', true);
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
