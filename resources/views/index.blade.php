<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="padding-top:35px !important">
    <!-- Content Header (Page header) -->
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content index-dashboard">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row box-details justify-content-between pt-4 m-0">
                {{-- Nhập hàng --}}
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light pt-2">
                        <div class="row px-3 py-3">
                            <div class="col">
                                <div class="title-index">Thông tin nhập hàng</div>
                            </div>
                            <div class="col d-flex" style="position: relative;height:60px;">
                                <div class="dropdown w-100">
                                    <button class="btn w-100 btn-light border rounded dropdown-toggle" id="orders"
                                        style="display: flex;
                                        justify-content: space-between;
                                        align-items: center;"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{-- All orders --}}
                                        <div id="all-orders">
                                            <div class="d-flex flex-column all-orders">
                                                <div class="ca d-flex">
                                                    <div id="it0">{{ $ordersAll['start_date'] }}</div>->
                                                    <div id="id0">{{ $ordersAll['end_date'] }}</div>
                                                </div>
                                                <div class="ca text-left">Tất cả</div>
                                            </div>
                                        </div>
                                        {{-- Tháng này Orders --}}
                                        <div id="this-month-orders" style="display: none">
                                            <div class="d-flex flex-column all-orders">
                                                <div class="ca d-flex">
                                                    <div id="it1"></div>->
                                                    <div id="id1"></div>
                                                </div>
                                                <div class="ca text-left">Tháng này</div>
                                            </div>
                                        </div>
                                        {{-- Tháng trước đây Orders --}}
                                        <div id="last-month-orders" style="display: none">
                                            <div class="d-flex flex-column all-orders">
                                                <div class="ca d-flex">
                                                    <div id="it2"></div>->
                                                    <div id="id2"></div>
                                                </div>
                                                <div class="ca text-left">Tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- 3 Tháng trước đây Orders --}}
                                        <div id="3last-month-orders" style="display: none">
                                            <div class="d-flex flex-column all-orders">
                                                <div class="ca d-flex">
                                                    <div id="it3"></div>->
                                                    <div id="id3"></div>
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
                                        <a class="dropdown-item dropdown-item-orders" id="btn-this-month-orders"
                                            href="#" data-value="1">Tháng này</a>
                                        <a class="dropdown-item dropdown-item-orders" id="btn-last-month-orders"
                                            href="#" data-value="2">Tháng trước</a>
                                        <a class="dropdown-item dropdown-item-orders" id="btn-3last-month-orders"
                                            href="#" data-value="3">3 tháng trước</a>
                                        <a class="dropdown-item dropdown-item-orders" id="btn-time-orders"
                                            href="#">Khoảng thời
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
                                        <button type="button" class="suscess btn btn-primary btn-block mr-2"
                                            value="4">Xác nhận</button>
                                        <button type="button" id="cancel-times-orders"
                                            class="btn btn-default btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row px-3 pt-2 pb-5 info-index">
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#E4F5FF" />
                                            <g clip-path="url(#clip0_7857_238972)">
                                                <path
                                                    d="M48.3333 33.3333V23.3333C48.3333 22.4493 47.9821 21.6014 47.357 20.9763C46.7319 20.3512 45.8841 20 45 20H23.3333C22.4493 20 21.6014 20.3512 20.9763 20.9763C20.3512 21.6014 20 22.4493 20 23.3333V46.6667C20 47.5507 20.3512 48.3986 20.9763 49.0237C21.6014 49.6488 22.4493 50 23.3333 50H31.6667"
                                                    stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M30.4167 40H31.6667" stroke="#0095F6" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M44.1667 38.0293V43.3326" stroke="#0095F6" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M50 51.666H38.5417C38.0444 51.666 37.5675 51.4684 37.2159 51.1168C36.8642 50.7652 36.6667 50.2882 36.6667 49.791V42.611C36.667 42.1607 36.7583 41.7151 36.935 41.301L37.8467 39.1676C37.9912 38.8299 38.2317 38.542 38.5384 38.3396C38.845 38.1373 39.2043 38.0294 39.5717 38.0293H48.7617C49.1288 38.0295 49.4879 38.1374 49.7942 38.3398C50.1006 38.5422 50.3408 38.83 50.485 39.1676L51.3984 41.3043C51.5754 41.7184 51.6666 42.164 51.6667 42.6143V49.9993C51.6667 50.4413 51.4911 50.8653 51.1785 51.1778C50.866 51.4904 50.442 51.666 50 51.666Z"
                                                    stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M51.6667 45.0007C51.6667 44.5586 51.4911 44.1347 51.1785 43.8221C50.866 43.5096 50.442 43.334 50 43.334H38.3334C37.8913 43.334 37.4674 43.5096 37.1548 43.8221C36.8423 44.1347 36.6667 44.5586 36.6667 45.0007"
                                                    stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M30.4167 33.334H36.6667" stroke="#0095F6" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M30.4167 26.875H41.6667" stroke="#0095F6" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M26.25 28C26.4972 28 26.7389 27.9267 26.9445 27.7893C27.15 27.652 27.3102 27.4568 27.4048 27.2284C27.4995 26.9999 27.5242 26.7486 27.476 26.5061C27.4278 26.2637 27.3087 26.0409 27.1339 25.8661C26.9591 25.6913 26.7363 25.5723 26.4939 25.524C26.2514 25.4758 26.0001 25.5005 25.7716 25.5951C25.5432 25.6898 25.348 25.85 25.2107 26.0555C25.0733 26.2611 25 26.5028 25 26.75C25 27.0815 25.1317 27.3995 25.3661 27.6339C25.6005 27.8683 25.9185 28 26.25 28Z"
                                                    fill="#0095F6" />
                                                <path
                                                    d="M26.25 34.666C26.4972 34.666 26.7389 34.5927 26.9445 34.4553C27.15 34.318 27.3102 34.1228 27.4048 33.8944C27.4995 33.666 27.5242 33.4146 27.476 33.1722C27.4278 32.9297 27.3087 32.7069 27.1339 32.5321C26.9591 32.3573 26.7363 32.2383 26.4939 32.19C26.2514 32.1418 26.0001 32.1666 25.7716 32.2612C25.5432 32.3558 25.348 32.516 25.2107 32.7215C25.0733 32.9271 25 33.1688 25 33.416C25 33.7475 25.1317 34.0655 25.3661 34.2999C25.6005 34.5343 25.9185 34.666 26.25 34.666Z"
                                                    fill="#0095F6" />
                                                <path
                                                    d="M26.25 41.166C26.4972 41.166 26.7389 41.0927 26.9445 40.9553C27.15 40.818 27.3102 40.6228 27.4048 40.3944C27.4995 40.166 27.5242 39.9146 27.476 39.6722C27.4278 39.4297 27.3087 39.2069 27.1339 39.0321C26.9591 38.8573 26.7363 38.7383 26.4939 38.69C26.2514 38.6418 26.0001 38.6666 25.7716 38.7612C25.5432 38.8558 25.348 39.016 25.2107 39.2215C25.0733 39.4271 25 39.6688 25 39.916C25 40.2475 25.1317 40.5655 25.3661 40.7999C25.6005 41.0343 25.9185 41.166 26.25 41.166Z"
                                                    fill="#0095F6" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7857_238972">
                                                    <rect x="15" y="15" width="40" height="40" rx="4"
                                                        fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="pl-2">
                                        <h5>Tổng đơn nhập</h5>
                                        <div class="value text-left" id="import_id">
                                            {{ number_format($ordersAll['countID']) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#E4F5FF" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M34.0416 17.75C34.7221 17.75 35.2737 18.3441 35.2737 19.0769V21.7262H35.8963C38.2114 21.7435 40.3465 23.0742 41.514 25.2274C41.8571 25.8602 41.6589 26.6728 41.0713 27.0424C40.4836 27.4119 39.7291 27.1984 39.386 26.5656C38.6579 25.2227 37.3269 24.3923 35.8832 24.38H34.1446C34.1107 24.3831 34.0763 24.3846 34.0416 24.3846C34.0069 24.3846 33.9726 24.3831 33.9386 24.38L31.8376 24.38C31.8374 24.38 31.8377 24.38 31.8376 24.38C29.8393 24.382 28.1551 25.9873 27.911 28.1233C27.6668 30.2594 28.9391 32.2567 30.8775 32.7803L37.8054 34.6546C37.8052 34.6546 37.8055 34.6547 37.8054 34.6546C40.9499 35.5043 43.0142 38.7445 42.6181 42.2099C42.222 45.6755 39.49 48.28 36.2478 48.2828L35.2737 48.2828V50.9231C35.2737 51.6559 34.7221 52.25 34.0416 52.25C33.3611 52.25 32.8095 51.6559 32.8095 50.9231V48.2828H32.1851C29.8663 48.2615 27.7299 46.9247 26.5641 44.7659C26.222 44.1324 26.4215 43.3202 27.0097 42.9518C27.5979 42.5833 28.3521 42.7982 28.6942 43.4317C29.4218 44.779 30.7544 45.6138 32.2012 45.629H33.8647C33.9225 45.62 33.9816 45.6154 34.0416 45.6154C34.1017 45.6154 34.1607 45.62 34.2185 45.629H36.2458C38.2443 45.6272 39.9282 44.0219 40.1724 41.8857C40.4165 39.7496 39.1443 37.7523 37.2059 37.2287L30.278 35.3544C30.2779 35.3543 30.2781 35.3544 30.278 35.3544C27.1334 34.5047 25.0692 31.2645 25.4653 27.7991C25.8613 24.3335 28.5934 21.729 31.8356 21.7262L32.8095 21.7262V19.0769C32.8095 18.3441 33.3611 17.75 34.0416 17.75Z"
                                                fill="#0095F6" />
                                        </svg>
                                    </div>
                                    <div class="pl-2">
                                        <h5>Tổng tiền nhập(+VAT)</h5>
                                        <div class="value text-left" id="import_total">
                                            {{ number_format($ordersAll['sumTotal']) }}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- Xuất hàng --}}
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-light pt-2">
                        <div class="row px-3 py-3">
                            <div class="col">
                                <div class="title-index">Thông tin xuất hàng</div>
                            </div>
                            <div class="col d-flex" style="position: relative;height:60px;">
                                <div class="dropdown w-100">
                                    <button class="btn w-100 btn-light border rounded dropdown-toggle" id="exports"
                                        style="display: flex;
                                        justify-content: space-between;
                                        align-items: center;"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{-- All Export --}}
                                        <div id="all-exports">
                                            <div class="d-flex flex-column all-exports">
                                                <div class="ca d-flex">
                                                    <div id="et0">{{ $exportAll['start_date'] }}</div>->
                                                    <div id="ed0">{{ $exportAll['end_date'] }}</div>
                                                </div>
                                                <div class="ca text-left">Tất cả</div>
                                            </div>
                                        </div>
                                        {{-- Tháng này Export --}}
                                        <div id="this-month-exports" style="display: none">
                                            <div class="d-flex flex-column all-exports">
                                                <div class="ca d-flex">
                                                    <div id="et1"></div>->
                                                    <div id="ed1"></div>
                                                </div>
                                                <div class="ca text-left">Tháng này</div>
                                            </div>
                                        </div>
                                        {{-- Tháng trước đây Export --}}
                                        <div id="last-month-exports" style="display: none">
                                            <div class="d-flex flex-column all-exports">
                                                <div class="ca d-flex">
                                                    <div id="et2"></div>->
                                                    <div id="ed2"></div>
                                                </div>
                                                <div class="ca text-left">Tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- 3 Tháng trước đây Export --}}
                                        <div id="3last-month-exports" style="display: none">
                                            <div class="d-flex flex-column all-exports">
                                                <div class="ca d-flex">
                                                    <div id="et3"></div>->
                                                    <div id="ed3"></div>
                                                </div>
                                                <div class="ca text-left">3 tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- Khoảng thời gian Export --}}
                                        <div id="time-exports" style="display: none">
                                            <div class="d-flex flex-column all-exports">
                                                <div class="ca d-flex">
                                                    <div class="start_exports"></div>
                                                    <div class="muiten"></div>
                                                    <div class="end_exports"></div>
                                                </div>
                                                <div class="ca text-left">Khoảng thời gian</div>
                                            </div>
                                        </div>

                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item dropdown-item-export " id="btn-all-exports"
                                            href="#" data-value="0">Tất cả</a>
                                        <a class="dropdown-item dropdown-item-export" id="btn-this-month-exports"
                                            href="#" data-value="1">Tháng này</a>
                                        <a class="dropdown-item dropdown-item-export" id="btn-last-month-exports"
                                            href="#" data-value="2">Tháng trước</a>
                                        <a class="dropdown-item dropdown-item-export" id="btn-3last-month-exports"
                                            href="#" data-value="3">3 tháng trước</a>
                                        <a class="dropdown-item dropdown-item-export" id="btn-time-exports"
                                            href="#">Khoảng thời
                                            gian</a>
                                    </div>
                                </div>
                                {{-- Chọn khoảng --}}
                                <div class="block-optionss" id="times-exports-options" style="display:none">
                                    <div class="wrap w-100">

                                        <div class="input-group p-2 justify-content-around">
                                            <div class="start">
                                                <label for="start">Từ ngày</label>
                                                <input type="date" name="date_start"
                                                    class="date_start_export rounded">
                                            </div>
                                            <div class="end">
                                                <label for="start">Đến ngày</label>
                                                <input type="date" name="date_end"
                                                    class="date_end_export rounded">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-contents-center align-items-baseline p-2">
                                        <button type="button" class="success btn btn-primary btn-block mr-2"
                                            value="4">Xác nhận</button>
                                        <button type="button" id="cancel-times-exports"
                                            class="btn btn-default btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 pt-2 pb-5 info-index">
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#EBEFFF" />
                                            <g clip-path="url(#clip0_7866_241710)">
                                                <path
                                                    d="M48.3333 33.3333V23.3333C48.3333 22.4493 47.9821 21.6014 47.357 20.9763C46.7319 20.3512 45.8841 20 45 20H23.3333C22.4493 20 21.6014 20.3512 20.9763 20.9763C20.3512 21.6014 20 22.4493 20 23.3333V46.6667C20 47.5507 20.3512 48.3986 20.9763 49.0237C21.6014 49.6488 22.4493 50 23.3333 50H31.6667"
                                                    stroke="#556AEB" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M30.4167 40H31.6667" stroke="#556AEB" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M44.1667 38.0293V43.3326" stroke="#556AEB" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M50 51.666H38.5417C38.0444 51.666 37.5675 51.4684 37.2158 51.1168C36.8642 50.7652 36.6667 50.2882 36.6667 49.791V42.611C36.667 42.1607 36.7583 41.7151 36.935 41.301L37.8467 39.1676C37.9912 38.8299 38.2317 38.542 38.5384 38.3396C38.845 38.1373 39.2043 38.0294 39.5717 38.0293H48.7617C49.1288 38.0295 49.4879 38.1374 49.7942 38.3398C50.1006 38.5422 50.3408 38.83 50.485 39.1676L51.3983 41.3043C51.5754 41.7184 51.6666 42.164 51.6667 42.6143V49.9993C51.6667 50.4413 51.4911 50.8653 51.1785 51.1778C50.866 51.4904 50.442 51.666 50 51.666Z"
                                                    stroke="#556AEB" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M51.6667 45.0007C51.6667 44.5586 51.4911 44.1347 51.1785 43.8221C50.866 43.5096 50.442 43.334 50 43.334H38.3333C37.8913 43.334 37.4674 43.5096 37.1548 43.8221C36.8423 44.1347 36.6667 44.5586 36.6667 45.0007"
                                                    stroke="#556AEB" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M30.4167 33.334H36.6667" stroke="#556AEB" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M30.4167 26.875H41.6667" stroke="#556AEB" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M26.25 28C26.4972 28 26.7389 27.9267 26.9445 27.7893C27.15 27.652 27.3102 27.4568 27.4048 27.2284C27.4995 26.9999 27.5242 26.7486 27.476 26.5061C27.4278 26.2637 27.3087 26.0409 27.1339 25.8661C26.9591 25.6913 26.7363 25.5723 26.4939 25.524C26.2514 25.4758 26.0001 25.5005 25.7716 25.5951C25.5432 25.6898 25.348 25.85 25.2107 26.0555C25.0733 26.2611 25 26.5028 25 26.75C25 27.0815 25.1317 27.3995 25.3661 27.6339C25.6005 27.8683 25.9185 28 26.25 28Z"
                                                    fill="#556AEB" />
                                                <path
                                                    d="M26.25 34.666C26.4972 34.666 26.7389 34.5927 26.9445 34.4553C27.15 34.318 27.3102 34.1228 27.4048 33.8944C27.4995 33.666 27.5242 33.4146 27.476 33.1722C27.4278 32.9297 27.3087 32.7069 27.1339 32.5321C26.9591 32.3573 26.7363 32.2383 26.4939 32.19C26.2514 32.1418 26.0001 32.1666 25.7716 32.2612C25.5432 32.3558 25.348 32.516 25.2107 32.7215C25.0733 32.9271 25 33.1688 25 33.416C25 33.7475 25.1317 34.0655 25.3661 34.2999C25.6005 34.5343 25.9185 34.666 26.25 34.666Z"
                                                    fill="#556AEB" />
                                                <path
                                                    d="M26.25 41.166C26.4972 41.166 26.7389 41.0927 26.9445 40.9553C27.15 40.818 27.3102 40.6228 27.4048 40.3944C27.4995 40.166 27.5242 39.9146 27.476 39.6722C27.4278 39.4297 27.3087 39.2069 27.1339 39.0321C26.9591 38.8573 26.7363 38.7383 26.4939 38.69C26.2514 38.6418 26.0001 38.6666 25.7716 38.7612C25.5432 38.8558 25.348 39.016 25.2107 39.2215C25.0733 39.4271 25 39.6688 25 39.916C25 40.2475 25.1317 40.5655 25.3661 40.7999C25.6005 41.0343 25.9185 41.166 26.25 41.166Z"
                                                    fill="#556AEB" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7866_241710">
                                                    <rect x="15" y="15" width="40" height="40" rx="4"
                                                        fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="pl-2">
                                        <h5>Tổng đơn xuất</h5>
                                        <div class="value text-left" id="export_id">
                                            {{ number_format($exportAll['countExport']) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#EBEFFF" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M34.0416 17.75C34.7221 17.75 35.2737 18.3441 35.2737 19.0769V21.7262H35.8963C38.2114 21.7435 40.3465 23.0742 41.514 25.2274C41.8571 25.8602 41.6589 26.6728 41.0713 27.0424C40.4836 27.4119 39.7291 27.1984 39.386 26.5656C38.6579 25.2227 37.3269 24.3923 35.8832 24.38H34.1446C34.1107 24.3831 34.0763 24.3846 34.0416 24.3846C34.0069 24.3846 33.9726 24.3831 33.9386 24.38L31.8376 24.38C31.8374 24.38 31.8377 24.38 31.8376 24.38C29.8393 24.382 28.1551 25.9873 27.911 28.1233C27.6668 30.2594 28.9391 32.2567 30.8775 32.7803L37.8054 34.6546C37.8052 34.6546 37.8055 34.6547 37.8054 34.6546C40.9499 35.5043 43.0142 38.7445 42.6181 42.2099C42.222 45.6755 39.49 48.28 36.2478 48.2828L35.2737 48.2828V50.9231C35.2737 51.6559 34.7221 52.25 34.0416 52.25C33.3611 52.25 32.8095 51.6559 32.8095 50.9231V48.2828H32.1851C29.8663 48.2615 27.7299 46.9247 26.5641 44.7659C26.222 44.1324 26.4215 43.3202 27.0097 42.9518C27.5979 42.5833 28.3521 42.7982 28.6942 43.4317C29.4218 44.779 30.7544 45.6138 32.2012 45.629H33.8647C33.9225 45.62 33.9816 45.6154 34.0416 45.6154C34.1017 45.6154 34.1607 45.62 34.2185 45.629H36.2458C38.2443 45.6272 39.9282 44.0219 40.1724 41.8857C40.4165 39.7496 39.1443 37.7523 37.2059 37.2287L30.278 35.3544C30.2779 35.3543 30.2781 35.3544 30.278 35.3544C27.1334 34.5047 25.0692 31.2645 25.4653 27.7991C25.8613 24.3335 28.5934 21.729 31.8356 21.7262L32.8095 21.7262V19.0769C32.8095 18.3441 33.3611 17.75 34.0416 17.75Z"
                                                fill="#556AEB" />
                                        </svg>
                                    </div>
                                    <div class="pl-2">
                                        <h5>Tổng tiền xuất</h5>
                                        <div class="value text-left" id="export_total">
                                            {{ number_format($exportAll['sumExport']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row box-details justify-content-between pt-4 m-0">
                {{-- Tồn kho --}}
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light pt-2">
                        <div class="row px-3 py-3">
                            <div class="col">
                                <div class="title-index">Thông tin tồn kho</div>
                            </div>
                            <div class="col d-flex" style="position: relative;height:60px;">
                                <div class="dropdown w-100">
                                    <button class="btn w-100 btn-light border rounded dropdown-toggle" id="invento"
                                        style="display: flex;
                                        justify-content: space-between;
                                        align-items: center;"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{-- All inventory --}}
                                        <div id="all-inventory">
                                            <div class="d-flex flex-column all-inventory">
                                                <div class="ca d-flex">
                                                    <div id="ivent0">{{ $inventAll['start_date'] }}</div>->
                                                    <div id="ivend0">{{ $inventAll['end_date'] }}</div>
                                                </div>
                                                <div class="ca text-left">Tất cả</div>
                                            </div>
                                        </div>
                                        {{-- Tháng này inventory --}}
                                        <div id="this-month-inventory" style="display: none">
                                            <div class="d-flex flex-column all-inventory">
                                                <div class="ca d-flex">
                                                    <div id="ivent1"></div>->
                                                    <div id="ivend1"></div>
                                                </div>
                                                <div class="ca text-left">Tháng này</div>
                                            </div>
                                        </div>
                                        {{-- Tháng trước đây inventory --}}
                                        <div id="last-month-inventory" style="display: none">
                                            <div class="d-flex flex-column all-inventory">
                                                <div class="ca d-flex">
                                                    <div id="ivent2"></div>->
                                                    <div id="ivend2"></div>
                                                </div>
                                                <div class="ca text-left">Tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- 3 Tháng trước đây inventory --}}
                                        <div id="3last-month-inventory" style="display: none">
                                            <div class="d-flex flex-column all-inventory">
                                                <div class="ca d-flex">
                                                    <div id="ivent3"></div>->
                                                    <div id="ivend3"></div>
                                                </div>
                                                <div class="ca text-left">3 tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- Khoảng thời gian inventory --}}
                                        <div id="time-inventory" style="display: none">
                                            <div class="d-flex flex-column all-inventory">
                                                <div class="ca d-flex">
                                                    <div class="start_inventory"></div>
                                                    <div class="muiten-inventory"></div>
                                                    <div class="end_inventory"></div>
                                                </div>
                                                <div class="ca text-left">Khoảng thời gian</div>
                                            </div>
                                        </div>

                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item dropdown-item-inventory " id="btn-all-inventory"
                                            href="#" data-value="0">Tất cả</a>
                                        <a class="dropdown-item dropdown-item-inventory" id="btn-this-month-inventory"
                                            href="#" data-value="1">Tháng này</a>
                                        <a class="dropdown-item dropdown-item-inventory" id="btn-last-month-inventory"
                                            href="#" data-value="2">Tháng trước</a>
                                        <a class="dropdown-item dropdown-item-inventory"
                                            id="btn-3last-month-inventory" href="#" data-value="3">3 tháng
                                            trước</a>
                                        <a class="dropdown-item dropdown-item-inventory" id="btn-time-inventory"
                                            href="#">Khoảng thời
                                            gian</a>
                                    </div>
                                </div>
                                {{-- Chọn khoảng --}}
                                <div class="block-optionss" id="times-inventory-options" style="display:none">
                                    <div class="wrap w-100">

                                        <div class="input-group p-2 justify-content-around">
                                            <div class="start">
                                                <label for="start">Từ ngày</label>
                                                <input type="date" name="date_start"
                                                    class="date_start_inventory rounded">
                                            </div>
                                            <div class="end">
                                                <label for="start">Đến ngày</label>
                                                <input type="date" name="date_end"
                                                    class="date_end_inventory rounded">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-contents-center align-items-baseline p-2">
                                        <button type="button"
                                            class="success-inventory btn btn-primary btn-block mr-2"
                                            value="4">Xác nhận</button>
                                        <button type="button" id="cancel-times-inventory"
                                            class="btn btn-default btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 pt-2 pb-5 info-index">
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#FFF4DF" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M35.0031 18.334C34.2547 18.334 33.5196 18.5309 32.8714 18.9048L22.132 25.1057C21.4838 25.4799 20.9455 26.0181 20.5713 26.6663C20.1971 27.3145 20 28.0498 20 28.7983V41.198C20 42.7219 20.8122 44.1295 22.1325 44.8909L32.8714 51.093C33.4889 51.4493 34.1854 51.6448 34.8971 51.6625C34.932 51.6657 34.9673 51.6673 35.003 51.6673C35.0387 51.6673 35.074 51.6657 35.1088 51.6625C35.8206 51.6449 36.5175 51.4492 37.1351 51.0928L47.8741 44.8922C48.5223 44.518 49.0606 43.9797 49.4348 43.3315C49.8091 42.6833 50.0061 41.948 50.0061 41.1995V28.7983C50.0061 27.2746 49.1936 25.8669 47.8737 25.1054L37.1348 18.9048C36.4866 18.5309 35.7514 18.334 35.0031 18.334ZM46.7112 42.878L36.1659 48.9667V35.6704L47.6803 29.0221V41.1995C47.6803 41.5397 47.5907 41.8739 47.4206 42.1686C47.2505 42.4632 47.0058 42.7079 46.7112 42.878ZM33.8401 48.9666V35.6703L27.7277 32.1411C27.7136 32.1334 27.6997 32.1253 27.6859 32.117L22.3258 29.0221V41.198C22.3258 41.8914 22.6951 42.5305 23.2944 42.8762L33.8401 48.9666ZM30.616 31.1231L42.1371 24.4788L46.5174 27.0079L35.0031 33.6561L30.616 31.1231ZM28.2896 29.7799L23.4888 27.0079L34.0337 20.9194C34.3284 20.7494 34.6629 20.6598 35.0031 20.6598C35.3432 20.6598 35.6778 20.7494 35.9724 20.9194L39.8107 23.1356L28.2896 29.7799Z"
                                                fill="#FF9500" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M23.2981 32.4381C23.7698 31.7073 24.7929 31.4701 25.5833 31.9085L32.2004 35.5785C32.9907 36.0168 33.249 36.9646 32.7773 37.6955C32.3055 38.4264 31.2824 38.6635 30.4921 38.2252L23.8749 34.5552C23.0846 34.1169 22.8263 33.169 23.2981 32.4381Z"
                                                fill="#FF9500" />
                                        </svg>

                                    </div>
                                    <div class="pl-2">
                                        <h5>Sản phẩm tồn kho</h5>
                                        <div class="value text-left" id="inventory_id">
                                            {{ number_format($inventAll['countInventory']) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#FFF4DF" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M34.0416 17.75C34.7221 17.75 35.2737 18.3441 35.2737 19.0769V21.7262H35.8963C38.2114 21.7435 40.3465 23.0742 41.514 25.2274C41.8571 25.8602 41.6589 26.6728 41.0713 27.0424C40.4836 27.4119 39.7291 27.1984 39.386 26.5656C38.6579 25.2227 37.3269 24.3923 35.8832 24.38H34.1446C34.1107 24.3831 34.0763 24.3846 34.0416 24.3846C34.0069 24.3846 33.9726 24.3831 33.9386 24.38L31.8376 24.38C31.8374 24.38 31.8377 24.38 31.8376 24.38C29.8393 24.382 28.1551 25.9873 27.911 28.1233C27.6668 30.2594 28.9391 32.2567 30.8775 32.7803L37.8054 34.6546C37.8052 34.6546 37.8055 34.6547 37.8054 34.6546C40.9499 35.5043 43.0142 38.7445 42.6181 42.2099C42.222 45.6755 39.49 48.28 36.2478 48.2828L35.2737 48.2828V50.9231C35.2737 51.6559 34.7221 52.25 34.0416 52.25C33.3611 52.25 32.8095 51.6559 32.8095 50.9231V48.2828H32.1851C29.8663 48.2615 27.7299 46.9247 26.5641 44.7659C26.222 44.1324 26.4215 43.3202 27.0097 42.9518C27.5979 42.5833 28.3521 42.7982 28.6942 43.4317C29.4218 44.779 30.7544 45.6138 32.2012 45.629H33.8647C33.9225 45.62 33.9816 45.6154 34.0416 45.6154C34.1017 45.6154 34.1607 45.62 34.2185 45.629H36.2458C38.2443 45.6272 39.9282 44.0219 40.1724 41.8857C40.4165 39.7496 39.1443 37.7523 37.2059 37.2287L30.278 35.3544C30.2779 35.3543 30.2781 35.3544 30.278 35.3544C27.1334 34.5047 25.0692 31.2645 25.4653 27.7991C25.8613 24.3335 28.5934 21.729 31.8356 21.7262L32.8095 21.7262V19.0769C32.8095 18.3441 33.3611 17.75 34.0416 17.75Z"
                                                fill="#FF9500" />
                                        </svg>
                                    </div>
                                    <div class="pl-2">
                                        <h5>Tổng tiền tồn kho</h5>
                                        <div class="value text-left" id="inventory_total">
                                            {{ number_format($inventAll['sumInventory']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Công nợ --}}
                <div class="col-lg-6 col-6">
                    <div class="small-box bg-light pt-2">
                        <div class="row px-3 py-3">
                            <div class="col">
                                <div class="title-index">Thông tin công nợ</div>
                            </div>
                            <div class="col d-flex" style="position: relative;height:60px;">
                                <div class="dropdown w-100">
                                    <button class="btn w-100 btn-light border rounded dropdown-toggle" id="debtss"
                                        style="display: flex;
                                        justify-content: space-between;
                                        align-items: center;"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{-- All debt --}}
                                        <div id="all-debt">
                                            <div class="d-flex flex-column all-debt">
                                                <div class="ca d-flex">
                                                    <div id="debtt0">{{ $debts['start_date'] }}</div>->
                                                    <div id="debtd0">{{ $debts['end_date'] }}</div>
                                                </div>
                                                <div class="ca text-left">Tất cả</div>
                                            </div>
                                        </div>
                                        {{-- Tháng này debt --}}
                                        <div id="this-month-debt" style="display: none">
                                            <div class="d-flex flex-column all-debt">
                                                <div class="ca d-flex">
                                                    <div id="debtt1"></div>->
                                                    <div id="debtd1"></div>
                                                </div>
                                                <div class="ca text-left">Tháng này</div>
                                            </div>
                                        </div>
                                        {{-- Tháng trước đây debt --}}
                                        <div id="last-month-debt" style="display: none">
                                            <div class="d-flex flex-column all-debt">
                                                <div class="ca d-flex">
                                                    <div id="debtt2"></div>->
                                                    <div id="debtd2"></div>
                                                </div>
                                                <div class="ca text-left">Tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- 3 Tháng trước đây debt --}}
                                        <div id="3last-month-debt" style="display: none">
                                            <div class="d-flex flex-column all-debt">
                                                <div class="ca d-flex">
                                                    <div id="debtt3"></div>->
                                                    <div id="debtd3"></div>
                                                </div>
                                                <div class="ca text-left">3 tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- Khoảng thời gian debt --}}
                                        <div id="time-debt" style="display: none">
                                            <div class="d-flex flex-column all-debt">
                                                <div class="ca d-flex">
                                                    <div class="start_debt"></div>
                                                    <div class="muiten-debt"></div>
                                                    <div class="end_debt"></div>
                                                </div>
                                                <div class="ca text-left">Khoảng thời gian</div>
                                            </div>
                                        </div>

                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item dropdown-item-debt " id="btn-all-debt" href="#"
                                            data-value="0">Tất cả</a>
                                        <a class="dropdown-item dropdown-item-debt" id="btn-this-month-debt"
                                            href="#" data-value="1">Tháng này</a>
                                        <a class="dropdown-item dropdown-item-debt" id="btn-last-month-debt"
                                            href="#" data-value="2">Tháng trước</a>
                                        <a class="dropdown-item dropdown-item-debt" id="btn-3last-month-debt"
                                            href="#" data-value="3">3 tháng trước</a>
                                        <a class="dropdown-item dropdown-item-debt" id="btn-time-debt"
                                            href="#">Khoảng thời
                                            gian</a>
                                    </div>
                                </div>
                                {{-- Chọn khoảng --}}
                                <div class="block-optionss" id="times-debt-options" style="display:none">
                                    <div class="wrap w-100">

                                        <div class="input-group p-2 justify-content-around">
                                            <div class="start">
                                                <label for="start">Từ ngày</label>
                                                <input type="date" name="date_start"
                                                    class="date_start_debt rounded">
                                            </div>
                                            <div class="end">
                                                <label for="start">Đến ngày</label>
                                                <input type="date" name="date_end" class="date_end_debt rounded">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-contents-center align-items-baseline p-2">
                                        <button type="button" class="success-debt btn btn-primary btn-block mr-2"
                                            value="4">Xác nhận</button>
                                        <button type="button" id="cancel-times-debt"
                                            class="btn btn-default btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 pt-2 pb-5 info-index">
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#FAEBEB" />
                                            <g clip-path="url(#clip0_7857_239054)">
                                                <path
                                                    d="M26.4286 21.4774H24.2857C23.1491 21.4774 22.059 21.9189 21.2553 22.7049C20.4515 23.4909 20 24.557 20 25.6685V47.6722C20 48.7838 20.4515 49.8498 21.2553 50.6358C22.059 51.4218 23.1491 51.8634 24.2857 51.8634H45.7143C46.8509 51.8634 47.941 51.4218 48.7447 50.6358C49.5485 49.8498 50 48.7838 50 47.6722V25.6685C50 24.557 49.5485 23.4909 48.7447 22.7049C47.941 21.9189 46.8509 21.4774 45.7143 21.4774H43.5714V23.573H45.7143C46.2826 23.573 46.8277 23.7937 47.2295 24.1867C47.6314 24.5797 47.8571 25.1128 47.8571 25.6685V47.6722C47.8571 48.228 47.6314 48.761 47.2295 49.154C46.8277 49.547 46.2826 49.7678 45.7143 49.7678H24.2857C23.7174 49.7678 23.1723 49.547 22.7705 49.154C22.3686 48.761 22.1429 48.228 22.1429 47.6722V25.6685C22.1429 25.1128 22.3686 24.5797 22.7705 24.1867C23.1723 23.7937 23.7174 23.573 24.2857 23.573H26.4286V21.4774Z"
                                                    fill="#B23333" />
                                                <path
                                                    d="M38.2143 20.4296C38.4984 20.4296 38.771 20.54 38.9719 20.7365C39.1728 20.933 39.2857 21.1995 39.2857 21.4774V23.573C39.2857 23.8508 39.1728 24.1174 38.9719 24.3139C38.771 24.5104 38.4984 24.6207 38.2143 24.6207H31.7857C31.5016 24.6207 31.229 24.5104 31.0281 24.3139C30.8272 24.1174 30.7143 23.8508 30.7143 23.573V21.4774C30.7143 21.1995 30.8272 20.933 31.0281 20.7365C31.229 20.54 31.5016 20.4296 31.7857 20.4296H38.2143ZM31.7857 18.334C30.9332 18.334 30.1157 18.6652 29.5129 19.2547C28.9101 19.8442 28.5714 20.6437 28.5714 21.4774V23.573C28.5714 24.4066 28.9101 25.2062 29.5129 25.7957C30.1157 26.3852 30.9332 26.7163 31.7857 26.7163H38.2143C39.0668 26.7163 39.8843 26.3852 40.4871 25.7957C41.0899 25.2062 41.4286 24.4066 41.4286 23.573V21.4774C41.4286 20.6437 41.0899 19.8442 40.4871 19.2547C39.8843 18.6652 39.0668 18.334 38.2143 18.334H31.7857Z"
                                                    fill="#B23333" />
                                                <path
                                                    d="M28.5714 40.5245C28.8004 42.5207 30.9118 43.9373 34.126 44.1205V45.5766H35.7394V44.1205C39.2507 43.9062 41.4286 42.3985 41.4286 40.1688C41.4286 38.2648 39.9637 37.1631 36.8562 36.5429L35.7394 36.3189V31.7661C37.4749 31.8978 38.6458 32.6211 38.9413 33.7012H41.2151C40.9583 31.7853 38.833 30.4106 35.7394 30.2585V28.8119H34.126V30.2884C31.1268 30.5638 29.068 32.0511 29.068 34.0677C29.068 35.8088 30.5622 37.041 33.184 37.5607L34.1276 37.7547V42.5817C32.3503 42.3782 31.1268 41.6238 30.8313 40.5245H28.5714ZM33.8167 35.9309C32.2034 35.616 31.3418 34.943 31.3418 33.9958C31.3418 32.8654 32.4307 32.0308 34.126 31.8068V35.992L33.8167 35.9309ZM36.2777 38.1726C38.2684 38.5594 39.1424 39.2013 39.1424 40.291C39.1424 41.6046 37.8647 42.48 35.7394 42.6129V38.0684L36.2777 38.1726Z"
                                                    fill="#B23333" />
                                                <path
                                                    d="M26.4286 21.4774H24.2857C23.1491 21.4774 22.059 21.9189 21.2553 22.7049C20.4515 23.4909 20 24.557 20 25.6685V47.6722C20 48.7838 20.4515 49.8498 21.2553 50.6358C22.059 51.4218 23.1491 51.8634 24.2857 51.8634H45.7143C46.8509 51.8634 47.941 51.4218 48.7447 50.6358C49.5485 49.8498 50 48.7838 50 47.6722V25.6685C50 24.557 49.5485 23.4909 48.7447 22.7049C47.941 21.9189 46.8509 21.4774 45.7143 21.4774H43.5714V23.573H45.7143C46.2826 23.573 46.8277 23.7937 47.2295 24.1867C47.6314 24.5797 47.8571 25.1128 47.8571 25.6685V47.6722C47.8571 48.228 47.6314 48.761 47.2295 49.154C46.8277 49.547 46.2826 49.7678 45.7143 49.7678H24.2857C23.7174 49.7678 23.1723 49.547 22.7705 49.154C22.3686 48.761 22.1429 48.228 22.1429 47.6722V25.6685C22.1429 25.1128 22.3686 24.5797 22.7705 24.1867C23.1723 23.7937 23.7174 23.573 24.2857 23.573H26.4286V21.4774Z"
                                                    stroke="#B23333" stroke-width="0.4" />
                                                <path
                                                    d="M38.2143 20.4296C38.4984 20.4296 38.771 20.54 38.9719 20.7365C39.1728 20.933 39.2857 21.1995 39.2857 21.4774V23.573C39.2857 23.8508 39.1728 24.1174 38.9719 24.3139C38.771 24.5104 38.4984 24.6207 38.2143 24.6207H31.7857C31.5016 24.6207 31.229 24.5104 31.0281 24.3139C30.8272 24.1174 30.7143 23.8508 30.7143 23.573V21.4774C30.7143 21.1995 30.8272 20.933 31.0281 20.7365C31.229 20.54 31.5016 20.4296 31.7857 20.4296H38.2143ZM31.7857 18.334C30.9332 18.334 30.1157 18.6652 29.5129 19.2547C28.9101 19.8442 28.5714 20.6437 28.5714 21.4774V23.573C28.5714 24.4066 28.9101 25.2062 29.5129 25.7957C30.1157 26.3852 30.9332 26.7163 31.7857 26.7163H38.2143C39.0668 26.7163 39.8843 26.3852 40.4871 25.7957C41.0899 25.2062 41.4286 24.4066 41.4286 23.573V21.4774C41.4286 20.6437 41.0899 19.8442 40.4871 19.2547C39.8843 18.6652 39.0668 18.334 38.2143 18.334H31.7857Z"
                                                    stroke="#B23333" stroke-width="0.4" />
                                                <path
                                                    d="M28.5714 40.5245C28.8004 42.5207 30.9118 43.9373 34.126 44.1205V45.5766H35.7394V44.1205C39.2507 43.9062 41.4286 42.3985 41.4286 40.1688C41.4286 38.2648 39.9637 37.1631 36.8562 36.5429L35.7394 36.3189V31.7661C37.4749 31.8978 38.6458 32.6211 38.9413 33.7012H41.2151C40.9583 31.7853 38.833 30.4106 35.7394 30.2585V28.8119H34.126V30.2884C31.1268 30.5638 29.068 32.0511 29.068 34.0677C29.068 35.8088 30.5622 37.041 33.184 37.5607L34.1276 37.7547V42.5817C32.3503 42.3782 31.1268 41.6238 30.8313 40.5245H28.5714ZM33.8167 35.9309C32.2034 35.616 31.3418 34.943 31.3418 33.9958C31.3418 32.8654 32.4307 32.0308 34.126 31.8068V35.992L33.8167 35.9309ZM36.2777 38.1726C38.2684 38.5594 39.1424 39.2013 39.1424 40.291C39.1424 41.6046 37.8647 42.48 35.7394 42.6129V38.0684L36.2777 38.1726Z"
                                                    stroke="#B23333" stroke-width="0.4" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7857_239054">
                                                    <rect x="15" y="15" width="40" height="40" rx="4"
                                                        fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="pl-2">
                                        <h5>Công nợ nhập(+VAT)</h5>
                                        <div class="value text-left" id="debt_import">
                                            {{ number_format($debts['debt_import']) }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#FAEBEB" />
                                            <g clip-path="url(#clip0_7857_239064)">
                                                <path
                                                    d="M26.4286 21.4774H24.2857C23.1491 21.4774 22.059 21.9189 21.2553 22.7049C20.4515 23.4909 20 24.557 20 25.6685V47.6722C20 48.7838 20.4515 49.8498 21.2553 50.6358C22.059 51.4218 23.1491 51.8634 24.2857 51.8634H45.7143C46.8509 51.8634 47.941 51.4218 48.7447 50.6358C49.5485 49.8498 50 48.7838 50 47.6722V25.6685C50 24.557 49.5485 23.4909 48.7447 22.7049C47.941 21.9189 46.8509 21.4774 45.7143 21.4774H43.5714V23.573H45.7143C46.2826 23.573 46.8277 23.7937 47.2295 24.1867C47.6314 24.5797 47.8571 25.1128 47.8571 25.6685V47.6722C47.8571 48.228 47.6314 48.761 47.2295 49.154C46.8277 49.547 46.2826 49.7678 45.7143 49.7678H24.2857C23.7174 49.7678 23.1723 49.547 22.7705 49.154C22.3686 48.761 22.1429 48.228 22.1429 47.6722V25.6685C22.1429 25.1128 22.3686 24.5797 22.7705 24.1867C23.1723 23.7937 23.7174 23.573 24.2857 23.573H26.4286V21.4774Z"
                                                    fill="#B23333" />
                                                <path
                                                    d="M38.2143 20.4296C38.4984 20.4296 38.771 20.54 38.9719 20.7365C39.1728 20.933 39.2857 21.1995 39.2857 21.4774V23.573C39.2857 23.8508 39.1728 24.1174 38.9719 24.3139C38.771 24.5104 38.4984 24.6207 38.2143 24.6207H31.7857C31.5016 24.6207 31.229 24.5104 31.0281 24.3139C30.8272 24.1174 30.7143 23.8508 30.7143 23.573V21.4774C30.7143 21.1995 30.8272 20.933 31.0281 20.7365C31.229 20.54 31.5016 20.4296 31.7857 20.4296H38.2143ZM31.7857 18.334C30.9332 18.334 30.1157 18.6652 29.5129 19.2547C28.9101 19.8442 28.5714 20.6437 28.5714 21.4774V23.573C28.5714 24.4066 28.9101 25.2062 29.5129 25.7957C30.1157 26.3852 30.9332 26.7163 31.7857 26.7163H38.2143C39.0668 26.7163 39.8843 26.3852 40.4871 25.7957C41.0899 25.2062 41.4286 24.4066 41.4286 23.573V21.4774C41.4286 20.6437 41.0899 19.8442 40.4871 19.2547C39.8843 18.6652 39.0668 18.334 38.2143 18.334H31.7857Z"
                                                    fill="#B23333" />
                                                <path
                                                    d="M28.5714 40.5245C28.8004 42.5207 30.9118 43.9373 34.126 44.1205V45.5766H35.7394V44.1205C39.2507 43.9062 41.4286 42.3985 41.4286 40.1688C41.4286 38.2648 39.9637 37.1631 36.8562 36.5429L35.7394 36.3189V31.7661C37.4749 31.8978 38.6458 32.6211 38.9413 33.7012H41.2151C40.9583 31.7853 38.833 30.4106 35.7394 30.2585V28.8119H34.126V30.2884C31.1268 30.5638 29.068 32.0511 29.068 34.0677C29.068 35.8088 30.5622 37.041 33.184 37.5607L34.1276 37.7547V42.5817C32.3503 42.3782 31.1268 41.6238 30.8313 40.5245H28.5714ZM33.8167 35.9309C32.2034 35.616 31.3418 34.943 31.3418 33.9958C31.3418 32.8654 32.4307 32.0308 34.126 31.8068V35.992L33.8167 35.9309ZM36.2777 38.1726C38.2684 38.5594 39.1424 39.2013 39.1424 40.291C39.1424 41.6046 37.8647 42.48 35.7394 42.6129V38.0684L36.2777 38.1726Z"
                                                    fill="#B23333" />
                                                <path
                                                    d="M26.4286 21.4774H24.2857C23.1491 21.4774 22.059 21.9189 21.2553 22.7049C20.4515 23.4909 20 24.557 20 25.6685V47.6722C20 48.7838 20.4515 49.8498 21.2553 50.6358C22.059 51.4218 23.1491 51.8634 24.2857 51.8634H45.7143C46.8509 51.8634 47.941 51.4218 48.7447 50.6358C49.5485 49.8498 50 48.7838 50 47.6722V25.6685C50 24.557 49.5485 23.4909 48.7447 22.7049C47.941 21.9189 46.8509 21.4774 45.7143 21.4774H43.5714V23.573H45.7143C46.2826 23.573 46.8277 23.7937 47.2295 24.1867C47.6314 24.5797 47.8571 25.1128 47.8571 25.6685V47.6722C47.8571 48.228 47.6314 48.761 47.2295 49.154C46.8277 49.547 46.2826 49.7678 45.7143 49.7678H24.2857C23.7174 49.7678 23.1723 49.547 22.7705 49.154C22.3686 48.761 22.1429 48.228 22.1429 47.6722V25.6685C22.1429 25.1128 22.3686 24.5797 22.7705 24.1867C23.1723 23.7937 23.7174 23.573 24.2857 23.573H26.4286V21.4774Z"
                                                    stroke="#B23333" stroke-width="0.4" />
                                                <path
                                                    d="M38.2143 20.4296C38.4984 20.4296 38.771 20.54 38.9719 20.7365C39.1728 20.933 39.2857 21.1995 39.2857 21.4774V23.573C39.2857 23.8508 39.1728 24.1174 38.9719 24.3139C38.771 24.5104 38.4984 24.6207 38.2143 24.6207H31.7857C31.5016 24.6207 31.229 24.5104 31.0281 24.3139C30.8272 24.1174 30.7143 23.8508 30.7143 23.573V21.4774C30.7143 21.1995 30.8272 20.933 31.0281 20.7365C31.229 20.54 31.5016 20.4296 31.7857 20.4296H38.2143ZM31.7857 18.334C30.9332 18.334 30.1157 18.6652 29.5129 19.2547C28.9101 19.8442 28.5714 20.6437 28.5714 21.4774V23.573C28.5714 24.4066 28.9101 25.2062 29.5129 25.7957C30.1157 26.3852 30.9332 26.7163 31.7857 26.7163H38.2143C39.0668 26.7163 39.8843 26.3852 40.4871 25.7957C41.0899 25.2062 41.4286 24.4066 41.4286 23.573V21.4774C41.4286 20.6437 41.0899 19.8442 40.4871 19.2547C39.8843 18.6652 39.0668 18.334 38.2143 18.334H31.7857Z"
                                                    stroke="#B23333" stroke-width="0.4" />
                                                <path
                                                    d="M28.5714 40.5245C28.8004 42.5207 30.9118 43.9373 34.126 44.1205V45.5766H35.7394V44.1205C39.2507 43.9062 41.4286 42.3985 41.4286 40.1688C41.4286 38.2648 39.9637 37.1631 36.8562 36.5429L35.7394 36.3189V31.7661C37.4749 31.8978 38.6458 32.6211 38.9413 33.7012H41.2151C40.9583 31.7853 38.833 30.4106 35.7394 30.2585V28.8119H34.126V30.2884C31.1268 30.5638 29.068 32.0511 29.068 34.0677C29.068 35.8088 30.5622 37.041 33.184 37.5607L34.1276 37.7547V42.5817C32.3503 42.3782 31.1268 41.6238 30.8313 40.5245H28.5714ZM33.8167 35.9309C32.2034 35.616 31.3418 34.943 31.3418 33.9958C31.3418 32.8654 32.4307 32.0308 34.126 31.8068V35.992L33.8167 35.9309ZM36.2777 38.1726C38.2684 38.5594 39.1424 39.2013 39.1424 40.291C39.1424 41.6046 37.8647 42.48 35.7394 42.6129V38.0684L36.2777 38.1726Z"
                                                    stroke="#B23333" stroke-width="0.4" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7857_239064">
                                                    <rect x="15" y="15" width="40" height="40" rx="4"
                                                        fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="pl-2">
                                        <h5>Công nợ xuất</h5>
                                        <div class="value text-left" id="debt_export">
                                            {{ number_format($debts['debt_export']) }}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row box-details justify-content-between pt-4 m-0">
                {{-- Chênh lệch --}}
                <div class="col-lg-6 col-6">
                    <!-- small box -->
                    <div class="small-box bg-light pt-2">
                        <div class="row px-3 py-3">
                            <div class="col">
                                <div class="title-index">Lợi nhuận</div>
                            </div>
                            <div class="col d-flex" style="position: relative;height:60px;">
                                <div class="dropdown w-100">
                                    <button class="btn w-100 btn-light border rounded dropdown-toggle" id="profitt"
                                        style="display: flex;
                                        justify-content: space-between;
                                        align-items: center;"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        {{-- All profit --}}
                                        <div id="all-profit">
                                            <div class="d-flex flex-column all-profit">
                                                <div class="ca d-flex">
                                                    <div id="prot0">{{ $profitAll['start_date'] }}</div>->
                                                    <div id="prod0">{{ $profitAll['end_date'] }}</div>
                                                </div>
                                                <div class="ca text-left">Tất cả</div>
                                            </div>
                                        </div>
                                        {{-- Tháng này profit --}}
                                        <div id="this-month-profit" style="display: none">
                                            <div class="d-flex flex-column all-profit">
                                                <div class="ca d-flex">
                                                    <div id="prot1"></div>->
                                                    <div id="prod1"></div>
                                                </div>
                                                <div class="ca text-left">Tháng này</div>
                                            </div>
                                        </div>
                                        {{-- Tháng trước đây profit --}}
                                        <div id="last-month-profit" style="display: none">
                                            <div class="d-flex flex-column all-profit">
                                                <div class="ca d-flex">
                                                    <div id="prot2"></div>->
                                                    <div id="prod2"></div>
                                                </div>
                                                <div class="ca text-left">Tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- 3 Tháng trước đây profit --}}
                                        <div id="3last-month-profit" style="display: none">
                                            <div class="d-flex flex-column all-profit">
                                                <div class="ca d-flex">
                                                    <div id="prot3"></div>->
                                                    <div id="prod3"></div>
                                                </div>
                                                <div class="ca text-left">3 tháng trước</div>
                                            </div>
                                        </div>
                                        {{-- Khoảng thời gian profit --}}
                                        <div id="time-profit" style="display: none">
                                            <div class="d-flex flex-column all-profit">
                                                <div class="ca d-flex">
                                                    <div class="start_profit"></div>
                                                    <div class="muiten-profit"></div>
                                                    <div class="end_profit"></div>
                                                </div>
                                                <div class="ca text-left">Khoảng thời gian</div>
                                            </div>
                                        </div>

                                    </button>
                                    <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item dropdown-item-profit " id="btn-all-profit"
                                            href="#" data-value="0">Tất cả</a>
                                        <a class="dropdown-item dropdown-item-profit" id="btn-this-month-profit"
                                            href="#" data-value="1">Tháng này</a>
                                        <a class="dropdown-item dropdown-item-profit" id="btn-last-month-profit"
                                            href="#" data-value="2">Tháng trước</a>
                                        <a class="dropdown-item dropdown-item-profit" id="btn-3last-month-profit"
                                            href="#" data-value="3">3 tháng trước</a>
                                        <a class="dropdown-item dropdown-item-profit" id="btn-time-profit"
                                            href="#">Khoảng thời
                                            gian</a>
                                    </div>
                                </div>
                                {{-- Chọn khoảng --}}
                                <div class="block-optionss" id="times-profit-options" style="display:none">
                                    <div class="wrap w-100">

                                        <div class="input-group p-2 justify-content-around">
                                            <div class="start">
                                                <label for="start">Từ ngày</label>
                                                <input type="date" name="date_start"
                                                    class="date_start_profit rounded">
                                            </div>
                                            <div class="end">
                                                <label for="start">Đến ngày</label>
                                                <input type="date" name="date_end"
                                                    class="date_end_profit rounded">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-contents-center align-items-baseline p-2">
                                        <button type="button" class="success-profit btn btn-primary btn-block mr-2"
                                            value="4">Xác nhận</button>
                                        <button type="button" id="cancel-times-profit"
                                            class="btn btn-default btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-3 pt-2 pb-5 info-index">
                            <div class="col-12 col-lg">
                                <div class="d-flex pt-1">
                                    <div class="icon-index d-none d-lg-block">
                                        <svg width="70" height="70" viewBox="0 0 70 70" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M55.1064 0H14.8936C6.6681 0 0 6.6681 0 14.8936V55.1064C0 63.3319 6.6681 70 14.8936 70H55.1064C63.3319 70 70 63.3319 70 55.1064V14.8936C70 6.6681 63.3319 0 55.1064 0Z"
                                                fill="#DEFFE7" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M34.0416 17.75C34.7221 17.75 35.2737 18.3441 35.2737 19.0769V21.7262H35.8963C38.2114 21.7435 40.3465 23.0742 41.514 25.2274C41.8571 25.8602 41.6589 26.6728 41.0713 27.0424C40.4836 27.4119 39.7291 27.1984 39.386 26.5656C38.6579 25.2227 37.3269 24.3923 35.8832 24.38H34.1446C34.1107 24.3831 34.0763 24.3846 34.0416 24.3846C34.0069 24.3846 33.9726 24.3831 33.9386 24.38L31.8376 24.38C31.8374 24.38 31.8377 24.38 31.8376 24.38C29.8393 24.382 28.1551 25.9873 27.911 28.1233C27.6668 30.2594 28.9391 32.2567 30.8775 32.7803L37.8054 34.6546C37.8052 34.6546 37.8055 34.6547 37.8054 34.6546C40.9499 35.5043 43.0142 38.7445 42.6181 42.2099C42.222 45.6755 39.49 48.28 36.2478 48.2828L35.2737 48.2828V50.9231C35.2737 51.6559 34.7221 52.25 34.0416 52.25C33.3611 52.25 32.8095 51.6559 32.8095 50.9231V48.2828H32.1851C29.8663 48.2615 27.7299 46.9247 26.5641 44.7659C26.222 44.1324 26.4215 43.3202 27.0097 42.9518C27.5979 42.5833 28.3521 42.7982 28.6942 43.4317C29.4218 44.779 30.7544 45.6138 32.2012 45.629H33.8647C33.9225 45.62 33.9816 45.6154 34.0416 45.6154C34.1017 45.6154 34.1607 45.62 34.2185 45.629H36.2458C38.2443 45.6272 39.9282 44.0219 40.1724 41.8857C40.4165 39.7496 39.1443 37.7523 37.2059 37.2287L30.278 35.3544C30.2779 35.3543 30.2781 35.3544 30.278 35.3544C27.1334 34.5047 25.0692 31.2645 25.4653 27.7991C25.8613 24.3335 28.5934 21.729 31.8356 21.7262L32.8095 21.7262V19.0769C32.8095 18.3441 33.3611 17.75 34.0416 17.75Z"
                                                fill="#09BD3C" />
                                        </svg>
                                    </div>
                                    <div class="pl-2">
                                        <h5>Tổng lợi nhuận</h5>
                                        <div class="value text-left" id="sum-profit">
                                            {{ number_format($profitAll['countProfit']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
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
    $(document).on('change', '.date_start_export', function(e) {
        e.preventDefault();
        $('.start_exports').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten').text('->');
    })
    $(document).on('change', '.date_end_export', function(e) {
        e.preventDefault();
        $('.end_exports').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten').text('->');
    })
    $(document).on('change', '.date_start_inventory', function(e) {
        e.preventDefault();
        $('.start_inventory').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten-inventory').text('->');
    })
    $(document).on('change', '.date_end_inventory', function(e) {
        e.preventDefault();
        $('.end_inventory').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten-inventory').text('->');
    })
    $(document).on('change', '.date_start_debt', function(e) {
        e.preventDefault();
        $('.start_debt').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten-debt').text('->');
    })
    $(document).on('change', '.date_end_debt', function(e) {
        e.preventDefault();
        $('.end_debt').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten-debt').text('->');
    })
    $(document).on('change', '.date_start_profit', function(e) {
        e.preventDefault();
        $('.start_profit').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten-profit').text('->');
    })
    $(document).on('change', '.date_end_profit', function(e) {
        e.preventDefault();
        $('.end_profit').text(moment($(this).val()).format("DD-MM-YYYY"));
        $('.muiten-profit').text('->');
    })
    // Orders
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

    // exports
    // Tất cả
    $("#btn-all-exports").click(function() {
        $("#all-exports").show();
        $("#this-month-exports").hide();
        $("#last-month-exports").hide();
        $("#3last-month-exports").hide();
        $("#time-exports").hide();
    });
    // Tháng này
    $("#btn-this-month-exports").click(function() {
        $("#this-month-exports").show();
        $("#all-exports").hide();
        $("#last-month-exports").hide();
        $("#3last-month-exports").hide();
        $("#time-exports").hide();
    });
    // Tháng trước
    $("#btn-last-month-exports").click(function() {
        $("#last-month-exports").show();
        $("#all-exports").hide();
        $("#this-month-exports").hide();
        $("#3last-month-exports").hide();
        $("#time-exports").hide();
    });
    // 3 tháng trc
    $("#btn-3last-month-exports").click(function() {
        $("#3last-month-exports").show();
        $("#all-exports").hide();
        $("#this-month-exports").hide();
        $("#last-month-exports").hide();
        $("#time-exports").hide();
    });
    // Khoảng time
    $("#btn-time-exports").click(function() {
        $("#time-exports").show();
        $("#times-exports-options").show();
        $("#all-exports").hide();
        $("#this-month-exports").hide();
        $("#last-month-exports").hide();
        $("#3last-month-exports").hide();
        $('#exports').prop('disabled', true);
    });
    $('#cancel-times-exports').click(function(event) {
        event.preventDefault();
        $('#times-exports-options').hide();
        $('#exports').prop('disabled', false);
    });
    $('.success').click(function(event) {
        event.preventDefault();
        $('#times-exports-options').hide();
        $('#exports').prop('disabled', false);
    });
    // inventory
    // Tất cả
    $("#btn-all-inventory").click(function() {
        $("#all-inventory").show();
        $("#this-month-inventory").hide();
        $("#last-month-inventory").hide();
        $("#3last-month-inventory").hide();
        $("#time-inventory").hide();
    });
    // Tháng này
    $("#btn-this-month-inventory").click(function() {
        $("#this-month-inventory").show();
        $("#all-inventory").hide();
        $("#last-month-inventory").hide();
        $("#3last-month-inventory").hide();
        $("#time-inventory").hide();
    });
    // Tháng trước
    $("#btn-last-month-inventory").click(function() {
        $("#last-month-inventory").show();
        $("#all-inventory").hide();
        $("#this-month-inventory").hide();
        $("#3last-month-inventory").hide();
        $("#time-inventory").hide();
    });
    // 3 tháng trc
    $("#btn-3last-month-inventory").click(function() {
        $("#3last-month-inventory").show();
        $("#all-inventory").hide();
        $("#this-month-inventory").hide();
        $("#last-month-inventory").hide();
        $("#time-inventory").hide();
    });
    // Khoảng time
    $("#btn-time-inventory").click(function() {
        $("#time-inventory").show();
        $("#times-inventory-options").show();
        $("#all-inventory").hide();
        $("#this-month-inventory").hide();
        $("#last-month-inventory").hide();
        $("#3last-month-inventory").hide();
        $('#invento').prop('disabled', true);
    });
    $('#cancel-times-inventory').click(function(event) {
        event.preventDefault();
        $('#times-inventory-options').hide();
        $('#invento').prop('disabled', false);
    });
    $('.success-inventory').click(function(event) {
        event.preventDefault();
        $('#times-inventory-options').hide();
        $('#invento').prop('disabled', false);
    });
    // debt
    // Tất cả
    $("#btn-all-debt").click(function() {
        $("#all-debt").show();
        $("#this-month-debt").hide();
        $("#last-month-debt").hide();
        $("#3last-month-debt").hide();
        $("#time-debt").hide();
    });
    // Tháng này
    $("#btn-this-month-debt").click(function() {
        $("#this-month-debt").show();
        $("#all-debt").hide();
        $("#last-month-debt").hide();
        $("#3last-month-debt").hide();
        $("#time-debt").hide();
    });
    // Tháng trước
    $("#btn-last-month-debt").click(function() {
        $("#last-month-debt").show();
        $("#all-debt").hide();
        $("#this-month-debt").hide();
        $("#3last-month-debt").hide();
        $("#time-debt").hide();
    });
    // 3 tháng trc
    $("#btn-3last-month-debt").click(function() {
        $("#3last-month-debt").show();
        $("#all-debt").hide();
        $("#this-month-debt").hide();
        $("#last-month-debt").hide();
        $("#time-debt").hide();
    });
    // Khoảng time
    $("#btn-time-debt").click(function() {
        $("#time-debt").show();
        $("#times-debt-options").show();
        $("#all-debt").hide();
        $("#this-month-debt").hide();
        $("#last-month-debt").hide();
        $("#3last-month-debt").hide();
        $('#debtss').prop('disabled', true);
    });
    $('#cancel-times-debt').click(function(event) {
        event.preventDefault();
        $('#times-debt-options').hide();
        $('#debtss').prop('disabled', false);
    });
    $('.success-debt').click(function(event) {
        event.preventDefault();
        $('#times-debt-options').hide();
        $('#debtss').prop('disabled', false);
    });

    // profit
    // Tất cả
    $("#btn-all-profit").click(function() {
        $("#all-profit").show();
        $("#this-month-profit").hide();
        $("#last-month-profit").hide();
        $("#3last-month-profit").hide();
        $("#time-profit").hide();
    });
    // Tháng này
    $("#btn-this-month-profit").click(function() {
        $("#this-month-profit").show();
        $("#all-profit").hide();
        $("#last-month-profit").hide();
        $("#3last-month-profit").hide();
        $("#time-profit").hide();
    });
    // Tháng trước
    $("#btn-last-month-profit").click(function() {
        $("#last-month-profit").show();
        $("#all-profit").hide();
        $("#this-month-profit").hide();
        $("#3last-month-profit").hide();
        $("#time-profit").hide();
    });
    // 3 tháng trc
    $("#btn-3last-month-profit").click(function() {
        $("#3last-month-profit").show();
        $("#all-profit").hide();
        $("#this-month-profit").hide();
        $("#last-month-profit").hide();
        $("#time-profit").hide();
    });
    // Khoảng time
    $("#btn-time-profit").click(function() {
        $("#time-profit").show();
        $("#times-profit-options").show();
        $("#all-profit").hide();
        $("#this-month-profit").hide();
        $("#last-month-profit").hide();
        $("#3last-month-profit").hide();
        $('#profitt').prop('disabled', true);
    });
    $('#cancel-times-profit').click(function(event) {
        event.preventDefault();
        $('#times-profit-options').hide();
        $('#profitt').prop('disabled', false);
    });
    $('.success-profit').click(function(event) {
        event.preventDefault();
        $('#times-profit-options').hide();
        $('#profitt').prop('disabled', false);
    });

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

    // window.onload = function() {
    //     $("#btn-all-orders").click();
    //     $("#btn-all-exports").click();
    //     $("#btn-all-inventory").click();
    //     $("#btn-all-debt").click();
    //     $("#btn-all-profit").click();
    // };

    function formatDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1; // Tháng tính từ 0 đến 11, cần +1
        var year = date.getFullYear();

        // Đảm bảo hiển thị 2 chữ số cho ngày và tháng
        day = (day < 10) ? '0' + day : day;
        month = (month < 10) ? '0' + month : month;

        return day + '-' + month + '-' + year;
    }
    // Nhập hàng
    $(document).on('click', '.dropdown-item-orders', function() {
        var dataid = $(this).data('value');
        $.ajax({
            url: "{{ route('count') }}",
            type: "get",
            data: {
                data: dataid
            },
            success: function(data) {
                $('#import_id').text(data.countID);
                if (data.sumTotal > 0) {
                    $('#import_total').text(formatCurrency(data.sumTotal));
                } else {
                    $('#import_total').text(0);
                }
                if (data.start_date && data.end_date) {
                    var stId = '#it' + dataid;
                    var edId = '#id' + dataid;
                    $(stId).text(data.start_date)
                    $(edId).text(data.end_date)
                }
                console.log(data);

            }
        })
    })
    $(document).on('click', '.suscess', function() {
        var data = $(this).val();
        var date_start = $('.date_start').val();
        var date_end = $('.date_end').val();
        $.ajax({
            url: "{{ route('count') }}",
            type: "get",
            data: {
                data: data,
                date_start: date_start,
                date_end: date_end
            },
            success: function(data) {
                $('#import_id').text(data.countID);
                $('#import_total').text(formatCurrency(data.sumTotal));

            }
        })
    })
    // Xuất hàng
    $(document).on('click', '.dropdown-item-export', function() {
        var dataid = $(this).data('value');
        $.ajax({
            url: "{{ route('countExport') }}",
            type: "get",
            data: {
                data: dataid
            },
            success: function(data) {
                $('#export_id').text(data.countExport);
                if (data.sumExport > 0) {
                    $('#export_total').text(formatCurrency(data.sumExport));
                } else {
                    $('#export_total').text(0);
                }
                if (data.start_date && data.end_date) {
                    var stId = '#et' + dataid;
                    var edId = '#ed' + dataid;
                    $(stId).text(data.start_date)
                    $(edId).text(data.end_date)
                }

            }
        })
    })
    $(document).on('click', '.success', function() {
        var data = $(this).val();
        var date_start = $('.date_start_export').val();
        var date_end = $('.date_end_export').val();
        $.ajax({
            url: "{{ route('countExport') }}",
            type: "get",
            data: {
                data: data,
                date_start: date_start,
                date_end: date_end
            },
            success: function(data) {
                $('#export_id').text(data.countExport);
                $('#export_total').text(formatCurrency(data.sumExport));


            }
        })
    })
    // Inventory
    $(document).on('click', '.dropdown-item-inventory', function() {
        var dataid = $(this).data('value');
        $.ajax({
            url: "{{ route('countInventory') }}",
            type: "get",
            data: {
                data: dataid
            },
            success: function(data) {

                $('#inventory_id').text(data.countInventory);
                $('#inventory_total').text(formatCurrency(data.sumInventory));
                if (data.start_date && data.end_date) {
                    var stId = '#ivent' + dataid;
                    var edId = '#ivend' + dataid;
                    $(stId).text(data.start_date)
                    $(edId).text(data.end_date)
                }

            }
        })
    })
    $(document).on('click', '.success-inventory', function() {
        var data = $(this).val();
        var date_start = $('.date_start_inventory').val();
        var date_end = $('.date_end_inventory').val();
        $.ajax({
            url: "{{ route('countInventory') }}",
            type: "get",
            data: {
                data: data,
                date_start: date_start,
                date_end: date_end
            },
            success: function(data) {
                $('#inventory_id').text(data.countInventory);
                $('#inventory_total').text(formatCurrency(data.sumInventory));
            }
        })
    })
    // debt
    $(document).on('click', '.dropdown-item-debt', function() {
        var dataid = $(this).data('value');
        $.ajax({
            url: "{{ route('countDebt') }}",
            type: "get",
            data: {
                data: dataid
            },
            success: function(data) {
                if (data.debt_export != null) {
                    $('#debt_export').text(formatCurrency(data.debt_export));
                } else {
                    $('#debt_export').text(0);
                }
                if (data.debt_import != null) {
                    $('#debt_import').text(formatCurrency(data.debt_import));
                } else {
                    $('#debt_import').text(0);
                }
                if (data.start_date && data.end_date) {
                    var stId = '#debtt' + dataid;
                    var edId = '#debtd' + dataid;
                    $(stId).text(data.start_date)
                    $(edId).text(data.end_date)
                }


            }
        })
    })
    $(document).on('click', '.success-debt', function() {
        var data = $(this).val();
        var date_start = $('.date_start_debt').val();
        var date_end = $('.date_end_debt').val();
        $.ajax({
            url: "{{ route('countDebt') }}",
            type: "get",
            data: {
                data: data,
                date_start: date_start,
                date_end: date_end
            },
            success: function(data) {
                if (data.debt_export > 0) {
                    $('#debt_export').text(formatCurrency(data.debt_export));
                } else {
                    $('#debt_export').text(0);
                }
                if (data.debt_import > 0) {
                    $('#debt_import').text(formatCurrency(data.debt_import));
                } else {
                    $('#debt_import').text(0);
                }


            }
        })
    })
    // profit
    $(document).on('click', '.dropdown-item-profit', function() {
        var dataid = $(this).data('value');
        $.ajax({
            url: "{{ route('countProfit') }}",
            type: "get",
            data: {
                data: dataid
            },
            success: function(data) {
                $('#sum-profit').text(formatCurrency(data.countProfit));
                if (data.start_date && data.end_date) {
                    var stId = '#prot' + dataid;
                    var edId = '#prod' + dataid;
                    $(stId).text(data.start_date)
                    $(edId).text(data.end_date)
                }

            }
        })
    })
    $(document).on('click', '.success-profit', function() {
        var data = $(this).val();
        var date_start = $('.date_start_profit').val();
        var date_end = $('.date_end_profit').val();
        $.ajax({
            url: "{{ route('countProfit') }}",
            type: "get",
            data: {
                data: data,
                date_start: date_start,
                date_end: date_end
            },
            success: function(data) {
                $('#sum-profit').text(formatCurrency(data.countProfit));


            }
        })
    })
</script>

</body>

</html>
