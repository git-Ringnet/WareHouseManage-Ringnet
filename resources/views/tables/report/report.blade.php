<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- TAO COMMENT -->
    <div class="dropdown d-flex">
        <div class="w-100"></div>
        <div class="w-25 border border-secondary rounded">
            <button class="btn w-100 btn-light border rounded dropdown-toggle"
                style="display: flex;
            justify-content: space-between;
            align-items: center;"
                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M21.4838 5.83398C21.9552 5.83398 22.3374 6.21618 22.3374 6.68764V11.2405C22.3374 11.712 21.9552 12.0941 21.4838 12.0941C21.0123 12.0941 20.6301 11.712 20.6301 11.2405V6.68764C20.6301 6.21618 21.0123 5.83398 21.4838 5.83398Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12.3781 5.83398C12.8495 5.83398 13.2317 6.21618 13.2317 6.68764V11.2405C13.2317 11.712 12.8495 12.0941 12.3781 12.0941C11.9066 12.0941 11.5244 11.712 11.5244 11.2405V6.68764C11.5244 6.21618 11.9066 5.83398 12.3781 5.83398Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.83337 14.6544C5.83337 14.183 6.21557 13.8008 6.68703 13.8008H27.1748C27.6463 13.8008 28.0285 14.183 28.0285 14.6544C28.0285 15.1259 27.6463 15.5081 27.1748 15.5081H6.68703C6.21557 15.5081 5.83337 15.1259 5.83337 14.6544Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.75015 9.02811C7.33716 8.4411 8.13331 8.11133 8.96346 8.11133H24.8984C25.7286 8.11133 26.5247 8.4411 27.1117 9.02811C27.6987 9.61511 28.0285 10.4113 28.0285 11.2414V26.0382C28.0285 26.8683 27.6987 27.6645 27.1117 28.2515C26.5247 28.8385 25.7286 29.1682 24.8984 29.1682H8.96346C8.13331 29.1682 7.33716 28.8385 6.75015 28.2515C6.16315 27.6645 5.83337 26.8683 5.83337 26.0382V11.2414C5.83337 10.4113 6.16315 9.61511 6.75015 9.02811ZM8.96346 9.81865C8.58611 9.81865 8.22423 9.96854 7.95741 10.2354C7.69059 10.5022 7.54069 10.8641 7.54069 11.2414V26.0382C7.54069 26.4155 7.69059 26.7774 7.95741 27.0442C8.22423 27.311 8.58612 27.4609 8.96346 27.4609H24.8984C25.2758 27.4609 25.6376 27.311 25.9045 27.0442C26.1713 26.7774 26.3212 26.4155 26.3212 26.0382V11.2414C26.3212 10.8641 26.1713 10.5022 25.9045 10.2354C25.6376 9.96854 25.2758 9.81865 24.8984 9.81865H8.96346Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M22.6334 18.0449C22.7833 18.0443 22.9318 18.0733 23.0704 18.1303C23.209 18.1872 23.335 18.2709 23.4412 18.3767C23.5474 18.4824 23.6316 18.6081 23.6891 18.7465C23.7466 18.8849 23.7762 19.0333 23.7762 19.1831C23.7762 19.4081 23.7095 19.6279 23.5847 19.815C23.4598 20.0021 23.2823 20.148 23.0746 20.2343C22.8669 20.3205 22.6383 20.3434 22.4176 20.2998C22.1969 20.2563 21.9941 20.1483 21.8347 19.9896C21.6754 19.8308 21.5666 19.6285 21.5222 19.408C21.4778 19.1875 21.4996 18.9588 21.5851 18.7507C21.6705 18.5427 21.8157 18.3646 22.0023 18.239C22.1889 18.1133 22.4085 18.0458 22.6334 18.0449Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.9264 18.0703C17.0762 18.0697 17.2247 18.0987 17.3634 18.1557C17.502 18.2126 17.628 18.2963 17.7342 18.4021C17.8403 18.5078 17.9246 18.6335 17.9821 18.7719C18.0396 18.9103 18.0691 19.0587 18.0691 19.2085C18.0691 19.4335 18.0025 19.6533 17.8776 19.8404C17.7528 20.0275 17.5753 20.1734 17.3676 20.2597C17.1598 20.3459 16.9312 20.3687 16.7106 20.3252C16.4899 20.2816 16.2871 20.1737 16.1277 20.015C15.9683 19.8562 15.8596 19.6538 15.8152 19.4334C15.7707 19.2129 15.7926 18.9842 15.8781 18.7761C15.9635 18.568 16.1087 18.39 16.2953 18.2644C16.4819 18.1387 16.7015 18.0712 16.9264 18.0703Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.9264 22.6231C17.0762 22.6225 17.2247 22.6515 17.3634 22.7084C17.502 22.7653 17.628 22.8491 17.7342 22.9548C17.8403 23.0606 17.9246 23.1863 17.9821 23.3246C18.0396 23.463 18.0691 23.6114 18.0691 23.7613C18.0691 23.9862 18.0025 24.2061 17.8776 24.3931C17.7528 24.5802 17.5753 24.7261 17.3676 24.8124C17.1598 24.8987 16.9312 24.9215 16.7106 24.8779C16.4899 24.8344 16.2871 24.7264 16.1277 24.5677C15.9683 24.409 15.8596 24.2066 15.8152 23.9861C15.7707 23.7656 15.7926 23.5369 15.8781 23.3288C15.9635 23.1208 16.1087 22.9427 16.2953 22.8171C16.4819 22.6915 16.7015 22.624 16.9264 22.6231Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.2353 18.0703C11.3852 18.0697 11.5337 18.0987 11.6723 18.1557C11.8109 18.2126 11.9369 18.2963 12.0431 18.4021C12.1493 18.5078 12.2336 18.6335 12.291 18.7719C12.3485 18.9103 12.3781 19.0587 12.3781 19.2085C12.3781 19.4335 12.3115 19.6533 12.1866 19.8404C12.0617 20.0275 11.8842 20.1734 11.6765 20.2597C11.4688 20.3459 11.2402 20.3687 11.0195 20.3252C10.7988 20.2816 10.596 20.1737 10.4367 20.015C10.2773 19.8562 10.1685 19.6538 10.1241 19.4334C10.0797 19.2129 10.1016 18.9842 10.187 18.7761C10.2725 18.568 10.4177 18.39 10.6042 18.2644C10.7908 18.1387 11.0104 18.0712 11.2353 18.0703Z"
                        fill="#555555"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.2353 22.6231C11.3852 22.6225 11.5337 22.6515 11.6723 22.7084C11.8109 22.7653 11.9369 22.8491 12.0431 22.9548C12.1493 23.0606 12.2336 23.1863 12.291 23.3246C12.3485 23.463 12.3781 23.6114 12.3781 23.7613C12.3781 23.9862 12.3115 24.2061 12.1866 24.3931C12.0617 24.5802 11.8842 24.7261 11.6765 24.8124C11.4688 24.8987 11.2402 24.9215 11.0195 24.8779C10.7988 24.8344 10.596 24.7264 10.4367 24.5677C10.2773 24.409 10.1685 24.2066 10.1241 23.9861C10.0797 23.7656 10.1016 23.5369 10.187 23.3288C10.2725 23.1208 10.4177 22.9427 10.6042 22.8171C10.7908 22.6915 11.0104 22.624 11.2353 22.6231Z"
                        fill="#555555"></path>
                </svg>
                <div class="d-flex flex-column">
                    <div class="ca d-flex">
                        <div class="start">ab</div>
                        <div class="end">das</div>
                    </div>
                    <div class="ca">dasd</div>
                </div>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Nhập hàng</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link bg-none" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Xuất hàng</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        {{-- Nhập hàng --}}
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <section class="content-header">
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
                                                    <path d="M29.1667 23.0293V28.3326" stroke="#0095F6"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M35 36.666H23.5417C23.0444 36.666 22.5675 36.4684 22.2159 36.1168C21.8642 35.7652 21.6667 35.2882 21.6667 34.791V27.611C21.667 27.1607 21.7583 26.7151 21.935 26.301L22.8467 24.1676C22.9912 23.8299 23.2317 23.542 23.5384 23.3396C23.845 23.1373 24.2043 23.0294 24.5717 23.0293H33.7617C34.1288 23.0295 34.4879 23.1374 34.7942 23.3398C35.1006 23.5422 35.3408 23.83 35.485 24.1676L36.3984 26.3043C36.5754 26.7184 36.6666 27.164 36.6667 27.6143V34.9993C36.6667 35.4413 36.4911 35.8653 36.1785 36.1778C35.866 36.4904 35.442 36.666 35 36.666Z"
                                                        stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M36.6667 30.0007C36.6667 29.5586 36.4911 29.1347 36.1785 28.8221C35.866 28.5096 35.442 28.334 35 28.334H23.3334C22.8913 28.334 22.4674 28.5096 22.1548 28.8221C21.8423 29.1347 21.6667 29.5586 21.6667 30.0007"
                                                        stroke="#0095F6" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M15.4167 18.334H21.6667" stroke="#0095F6"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M15.4167 11.875H26.6667" stroke="#0095F6"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
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
                                                        <rect width="40" height="40" rx="4"
                                                            fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0">Tổng đơn nhập</p><b
                                                class="m-0">{{ $orders }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ml-4">
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
                                                class="m-0">{{ number_format($sumTotalOrders) }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 ml-4">
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
                                                class="m-0">{{ number_format($sumDebtImportVAT) }}</b>
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
                                {{-- <div class="filter-results">
                                    @foreach ($string as $item)
                                        <span class="filter-group">
                                            {{ $item['label'] }}
                                            <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                                            <a class="delete-item delete-btn-{{ $item['class'] }}"><svg width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </span>
                                    @endforeach
                                </div> --}}
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
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                            <button class="dropdown-item" id="btn-category">Category</button>
                                            <button class="dropdown-item" id="btn-quantity">Số lượng</button>
                                        </div>
                                    </div>
                                    <?php $status = [];
                                    $categoryarr = [];
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
                                    ?>
                                    {{--
                                    <div class="block-options" id="status-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trạng thái</h5>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all">Hủy chọn</a>
                                            </div>

                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags p-0 mb-1 px-2">
                                                    <li>
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(1, $status) ? 'checked' : '' }} name="status[]"
                                                            value="1">
                                                        <label for="status_active">Active</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(0, $status) ? 'checked' : '' }} name="status[]"
                                                            value="0">
                                                        <label for="">Disable</label>
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
                                        <div class="block-options" id="category-options" style="display:none">
                                            <div class="wrap w-100">
                                                <div class="heading-title title-wrap">
                                                    <h5>Vai trò</h5>
                                                </div>
                                                <div
                                                    class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                    <a class="cursor select-all-category mr-auto">Chọn tất cả</a>
                                                    <a class="cursor deselect-all-category">Hủy chọn</a>
                                                </div>
                                                <div class="ks-cboxtags-container">
                                                    <ul class="ks-cboxtags ks-cboxtags p-0 mb-1 px-2">
                                                        @if (!empty($categories))
                                                            @foreach ($categories as $category)
                                                                <li>
                                                                    <input type="checkbox" id="roles_active"
                                                                        {{ in_array($category->id, $categoryarr) ? 'checked' : '' }}
                                                                        name="categoryarr[]"
                                                                        value="{{ $category->id }}">
                                                                    <label
                                                                        for="roles_active">{{ $category->category_name }}</label>
                                                                </li>
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
                                        <div class="block-options" id="quantity-options" style="display:none">
                                            <div class="wrap w-100">
                                                <div class="heading-title title-wrap">
                                                    <h5>Tồn kho</h5>
                                                </div>
                                                <div class="input-group p-2 justify-content-around">
                                                    <select class="comparison_operator" name="comparison_operator"
                                                        style="width: 40%">
                                                        <option value=">=">>=</option>
                                                        <option value="<=">
                                                            <=</option>
                                                    </select>
                                                    <input class="w-50 quantity-input" type="number" name="quantity"
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
                                    </div>
                                      --}}
                                </div>
                                <a class="btn ml-auto btn-delete-filter btn-light"
                                    href="{{ route('guests.index') }}"><span><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z"
                                                fill="#555555" />
                                        </svg>
                                    </span>Tắt bộ lọc</a>
                            </div>

                    </div>
                </div><!-- /.container-fluided -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluided">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example2" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Nhân viên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Vai trò</th>
                                                <th scope="col" class="text-right">Tổng đơn nhập</th>
                                                <th scope="col">
                                                    <p class="text-center m-0">Tổng tiền nhập</p>
                                                    <p class="text-center m-0">(+VAT)</p>
                                                </th>
                                                <th scope="col">
                                                    <p class="text-center m-0">Tổng công nợ </p>
                                                    <p class="text-center m-0">(+VAT)</p>
                                                </th>
                                            </tr>
                                            </form>
                                        </thead>
                                        <tbody>
                                            <?php $stt = 1; ?>
                                            @foreach ($tableorders as $item)
                                                <tr>
                                                    <td><?php echo $stt++; ?></td>
                                                    <td>{{ $item->nhanvien }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->vaitro }}</td>
                                                    <td class="text-right">{{ $item->product_qty_count }}</td>
                                                    <td class="text-center">{{ number_format($item->total_sum) }}</td>
                                                    <td class="text-center">{{ number_format($item->total_debt) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="paginator mt-4 d-flex justify-content-end">
                                {{ $tableorders->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- Xuất hàng --}}
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <section class="content-header">
                <div class="container-fluided">
                    <div class="">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="bg-white rounded">
                                    <div class="d-flex p-2">
                                        <div class="rounded p-2 background-purple-light">
                                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_7866_242716)">
                                                    <path
                                                        d="M33.3333 18.3333V8.33333C33.3333 7.44928 32.9821 6.60143 32.357 5.97631C31.7319 5.35119 30.8841 5 30 5H8.33333C7.44928 5 6.60143 5.35119 5.97631 5.97631C5.35119 6.60143 5 7.44928 5 8.33333V31.6667C5 32.5507 5.35119 33.3986 5.97631 34.0237C6.60143 34.6488 7.44928 35 8.33333 35H16.6667"
                                                        stroke="#556aeb" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M15.4167 25H16.6667" stroke="#556aeb" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M29.1667 23.0293V28.3326" stroke="#556aeb"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M35 36.666H23.5417C23.0444 36.666 22.5675 36.4684 22.2159 36.1168C21.8642 35.7652 21.6667 35.2882 21.6667 34.791V27.611C21.667 27.1607 21.7583 26.7151 21.935 26.301L22.8467 24.1676C22.9912 23.8299 23.2317 23.542 23.5384 23.3396C23.845 23.1373 24.2043 23.0294 24.5717 23.0293H33.7617C34.1288 23.0295 34.4879 23.1374 34.7942 23.3398C35.1006 23.5422 35.3408 23.83 35.485 24.1676L36.3984 26.3043C36.5754 26.7184 36.6666 27.164 36.6667 27.6143V34.9993C36.6667 35.4413 36.4911 35.8653 36.1785 36.1778C35.866 36.4904 35.442 36.666 35 36.666Z"
                                                        stroke="#556aeb" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M36.6667 30.0007C36.6667 29.5586 36.4911 29.1347 36.1785 28.8221C35.866 28.5096 35.442 28.334 35 28.334H23.3334C22.8913 28.334 22.4674 28.5096 22.1548 28.8221C21.8423 29.1347 21.6667 29.5586 21.6667 30.0007"
                                                        stroke="#556aeb" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M15.4167 18.334H21.6667" stroke="#556aeb"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M15.4167 11.875H26.6667" stroke="#556aeb"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M11.25 13C11.4972 13 11.7389 12.9267 11.9445 12.7893C12.15 12.652 12.3102 12.4568 12.4048 12.2284C12.4995 11.9999 12.5242 11.7486 12.476 11.5061C12.4278 11.2637 12.3087 11.0409 12.1339 10.8661C11.9591 10.6913 11.7363 10.5723 11.4939 10.524C11.2514 10.4758 11.0001 10.5005 10.7716 10.5951C10.5432 10.6898 10.348 10.85 10.2107 11.0555C10.0733 11.2611 10 11.5028 10 11.75C10 12.0815 10.1317 12.3995 10.3661 12.6339C10.6005 12.8683 10.9185 13 11.25 13Z"
                                                        fill="#556aeb" />
                                                    <path
                                                        d="M11.25 19.666C11.4972 19.666 11.7389 19.5927 11.9445 19.4553C12.15 19.318 12.3102 19.1228 12.4048 18.8944C12.4995 18.666 12.5242 18.4146 12.476 18.1722C12.4278 17.9297 12.3087 17.7069 12.1339 17.5321C11.9591 17.3573 11.7363 17.2383 11.4939 17.19C11.2514 17.1418 11.0001 17.1666 10.7716 17.2612C10.5432 17.3558 10.348 17.516 10.2107 17.7215C10.0733 17.9271 10 18.1688 10 18.416C10 18.7475 10.1317 19.0655 10.3661 19.2999C10.6005 19.5343 10.9185 19.666 11.25 19.666Z"
                                                        fill="#556aeb" />
                                                    <path
                                                        d="M11.25 26.166C11.4972 26.166 11.7389 26.0927 11.9445 25.9553C12.15 25.818 12.3102 25.6228 12.4048 25.3944C12.4995 25.166 12.5242 24.9146 12.476 24.6722C12.4278 24.4297 12.3087 24.2069 12.1339 24.0321C11.9591 23.8573 11.7363 23.7383 11.4939 23.69C11.2514 23.6418 11.0001 23.6666 10.7716 23.7612C10.5432 23.8558 10.348 24.016 10.2107 24.2215C10.0733 24.4271 10 24.6688 10 24.916C10 25.2475 10.1317 25.5655 10.3661 25.7999C10.6005 26.0343 10.9185 26.166 11.25 26.166Z"
                                                        fill="#556aeb" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_7866_242716">
                                                        <rect width="40" height="40" rx="4"
                                                            fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0">Tổng đơn xuất</p><b
                                                class="m-0">{{ $exports }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-white rounded">
                                    <div class="d-flex p-2">
                                        <div class="rounded p-2 background-purple-light">
                                            <svg width="40" height="40" viewBox="0 0 46 46" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M22.0416 5.75C22.7221 5.75 23.2737 6.34408 23.2737 7.07692V9.72619H23.8963C26.2114 9.74349 28.3465 11.0742 29.514 13.2274C29.8571 13.8602 29.6589 14.6728 29.0713 15.0424C28.4836 15.4119 27.7291 15.1984 27.386 14.5656C26.6579 13.2227 25.3269 12.3923 23.8832 12.38H22.1446C22.1107 12.3831 22.0763 12.3846 22.0416 12.3846C22.0069 12.3846 21.9726 12.3831 21.9386 12.38L19.8376 12.38C19.8375 12.38 19.8378 12.38 19.8376 12.38C17.8393 12.382 16.1551 13.9873 15.911 16.1233C15.6669 18.2594 16.9391 20.2567 18.8775 20.7803L25.8054 22.6546C25.8052 22.6546 25.8055 22.6547 25.8054 22.6546C28.95 23.5043 31.0142 26.7445 30.6181 30.2099C30.222 33.6755 27.49 36.28 24.2478 36.2828L23.2737 36.2828V38.9231C23.2737 39.6559 22.7221 40.25 22.0416 40.25C21.3612 40.25 20.8095 39.6559 20.8095 38.9231V36.2828H20.1851C17.8663 36.2615 15.7299 34.9247 14.5641 32.7659C14.222 32.1324 14.4215 31.3202 15.0097 30.9518C15.598 30.5833 16.3521 30.7982 16.6942 31.4317C17.4218 32.779 18.7544 33.6138 20.2012 33.629H21.8648C21.9225 33.62 21.9816 33.6154 22.0416 33.6154C22.1017 33.6154 22.1607 33.62 22.2185 33.629H24.2458C26.2443 33.6272 27.9283 32.0219 28.1724 29.8857C28.4165 27.7496 27.1443 25.7523 25.2059 25.2287L18.278 23.3544C18.2779 23.3543 18.2782 23.3544 18.278 23.3544C15.1335 22.5047 13.0692 19.2645 13.4653 15.7991C13.8614 12.3335 16.5934 9.72901 19.8356 9.72619L20.8095 9.72619V7.07692C20.8095 6.34408 21.3612 5.75 22.0416 5.75Z"
                                                    fill="#556aeb" />
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0">Tổng tiền xuất</p><b
                                                class="m-0">{{ number_format($sumExport) }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="bg-white rounded">
                                    <div class="d-flex p-2">
                                        <div class="rounded p-2 background-green-light">
                                            <svg width="40" height="40" viewBox="0 0 46 46" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M22.0416 5.75C22.7221 5.75 23.2737 6.34408 23.2737 7.07692V9.72619H23.8963C26.2114 9.74349 28.3465 11.0742 29.514 13.2274C29.8571 13.8602 29.6589 14.6728 29.0713 15.0424C28.4836 15.4119 27.7291 15.1984 27.386 14.5656C26.6579 13.2227 25.3269 12.3923 23.8832 12.38H22.1446C22.1107 12.3831 22.0763 12.3846 22.0416 12.3846C22.0069 12.3846 21.9726 12.3831 21.9386 12.38L19.8376 12.38C19.8375 12.38 19.8378 12.38 19.8376 12.38C17.8393 12.382 16.1551 13.9873 15.911 16.1233C15.6669 18.2594 16.9391 20.2567 18.8775 20.7803L25.8054 22.6546C25.8052 22.6546 25.8055 22.6547 25.8054 22.6546C28.95 23.5043 31.0142 26.7445 30.6181 30.2099C30.222 33.6755 27.49 36.28 24.2478 36.2828L23.2737 36.2828V38.9231C23.2737 39.6559 22.7221 40.25 22.0416 40.25C21.3612 40.25 20.8095 39.6559 20.8095 38.9231V36.2828H20.1851C17.8663 36.2615 15.7299 34.9247 14.5641 32.7659C14.222 32.1324 14.4215 31.3202 15.0097 30.9518C15.598 30.5833 16.3521 30.7982 16.6942 31.4317C17.4218 32.779 18.7544 33.6138 20.2012 33.629H21.8648C21.9225 33.62 21.9816 33.6154 22.0416 33.6154C22.1017 33.6154 22.1607 33.62 22.2185 33.629H24.2458C26.2443 33.6272 27.9283 32.0219 28.1724 29.8857C28.4165 27.7496 27.1443 25.7523 25.2059 25.2287L18.278 23.3544C18.2779 23.3543 18.2782 23.3544 18.278 23.3544C15.1335 22.5047 13.0692 19.2645 13.4653 15.7991C13.8614 12.3335 16.5934 9.72901 19.8356 9.72619L20.8095 9.72619V7.07692C20.8095 6.34408 21.3612 5.75 22.0416 5.75Z"
                                                    fill="#09bd3c" />
                                            </svg>
                                        </div>
                                        <div class="ml-2">
                                            <p class="m-0">Tổng lợi nhuận</p><b
                                                class="m-0">{{ $formattedLoinhuan }}</b>
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
                                            <p class="m-0">Tổng công nợ</p><b
                                                class="m-0">{{ number_format($CongNo) }}</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                {{-- <div class="filter-results">
                                    @foreach ($string as $item)
                                        <span class="filter-group">
                                            {{ $item['label'] }}
                                            <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                                            <a class="delete-item delete-btn-{{ $item['class'] }}"><svg width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </span>
                                    @endforeach
                                </div> --}}
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
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item" id="btn-status">Trạng thái</button>
                                            <button class="dropdown-item" id="btn-category">Category</button>
                                            <button class="dropdown-item" id="btn-quantity">Số lượng</button>
                                        </div>
                                    </div>
                                    <?php $status = [];
                                    $categoryarr = [];
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
                                    ?>
                                    {{--  
                                    <div class="block-options" id="status-options" style="display:none">
                                        <div class="wrap w-100">
                                            <div class="heading-title title-wrap">
                                                <h5>Trạng thái</h5>
                                            </div>
                                            <div
                                                class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                                <a class="cursor deselect-all">Hủy chọn</a>
                                            </div>

                                            <div class="ks-cboxtags-container">
                                                <ul class="ks-cboxtags ks-cboxtags p-0 mb-1 px-2">
                                                    <li>
                                                        <input type="checkbox" id="status_active"
                                                            {{ in_array(1, $status) ? 'checked' : '' }}
                                                            name="status[]" value="1">
                                                        <label for="status_active">Active</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="status_inactive"
                                                            {{ in_array(0, $status) ? 'checked' : '' }}
                                                            name="status[]" value="0">
                                                        <label for="">Disable</label>
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
                                        <div class="block-options" id="category-options" style="display:none">
                                            <div class="wrap w-100">
                                                <div class="heading-title title-wrap">
                                                    <h5>Vai trò</h5>
                                                </div>
                                                <div
                                                    class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                                    <a class="cursor select-all-category mr-auto">Chọn tất cả</a>
                                                    <a class="cursor deselect-all-category">Hủy chọn</a>
                                                </div>
                                                <div class="ks-cboxtags-container">
                                                    <ul class="ks-cboxtags ks-cboxtags p-0 mb-1 px-2">
                                                        @if (!empty($categories))
                                                            @foreach ($categories as $category)
                                                                <li>
                                                                    <input type="checkbox" id="roles_active"
                                                                        {{ in_array($category->id, $categoryarr) ? 'checked' : '' }}
                                                                        name="categoryarr[]"
                                                                        value="{{ $category->id }}">
                                                                    <label
                                                                        for="roles_active">{{ $category->category_name }}</label>
                                                                </li>
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
                                        <div class="block-options" id="quantity-options" style="display:none">
                                            <div class="wrap w-100">
                                                <div class="heading-title title-wrap">
                                                    <h5>Tồn kho</h5>
                                                </div>
                                                <div class="input-group p-2 justify-content-around">
                                                    <select class="comparison_operator" name="comparison_operator"
                                                        style="width: 40%">
                                                        <option value=">=">>=</option>
                                                        <option value="<=">
                                                            <=</option>
                                                    </select>
                                                    <input class="w-50 quantity-input" type="number" name="quantity"
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
                                    </div> --}}
                                </div>
                                <a class="btn ml-auto btn-delete-filter btn-light"
                                    href="{{ route('guests.index') }}"><span><svg width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 5.4643C6 5.34116 6.04863 5.22306 6.13518 5.13599C6.22174 5.04892 6.33913 5 6.46154 5H17.5385C17.6609 5 17.7783 5.04892 17.8648 5.13599C17.9514 5.22306 18 5.34116 18 5.4643V7.32149C18 7.43599 17.9579 7.54645 17.8818 7.63164L13.8462 12.1428V16.6075C13.8461 16.7049 13.8156 16.7998 13.7589 16.8788C13.7022 16.9578 13.6223 17.0168 13.5305 17.0476L10.7612 17.9762C10.6919 17.9994 10.618 18.0058 10.5458 17.9947C10.4735 17.9836 10.4049 17.9554 10.3456 17.9124C10.2863 17.8695 10.238 17.8129 10.2047 17.7475C10.1713 17.682 10.1539 17.6096 10.1538 17.5361V12.1428L6.11815 7.63164C6.0421 7.54645 6.00002 7.43599 6 7.32149V5.4643Z"
                                                fill="#555555" />
                                        </svg>
                                    </span>Tắt bộ lọc</a>
                            </div>
                        </form>
                    </div>
                </div><!-- /.container-fluided -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluided">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example2" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Nhân viên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Vai trò</th>
                                                <th scope="col" class="text-right">Tổng đơn xuất</th>
                                                <th scope="col">
                                                    <p class="text-center m-0">Tổng tiền xuất</p>
                                                </th>
                                                <th scope="col">
                                                    <p class="text-center m-0">Tổng lợi nhuận</p>
                                                </th>
                                                <th scope="col">
                                                    Tổng công nợ
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; ?>
                                            @foreach ($Tableexports as $value)
                                                <tr>
                                                    <td><?php echo $count++; ?></td>
                                                    <td>{{ $value->nhanvien }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->vaitro }}</td>
                                                    <td class="text-right">{{ $value->donxuat }}</td>
                                                    <td class="text-center">{{ number_format($value->tongtienxuat) }}
                                                    </td>
                                                    <td class="text-center">{{ number_format($value->tongloinhuan) }}
                                                    </td>
                                                    <td class="text-center">{{ number_format($value->tongcongno) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    //xóa tất cả thẻ tr rỗng
    const rows = document.querySelectorAll('tr');
    rows.forEach(row => {
        if (row.innerHTML.trim() === '') {
            row.remove();
        }
    });
    let count = 1;
    let btn_menu = document.getElementById("dropdown_item1");
    btn_menu.addEventListener("click", function() {
        if (count === 1) {
            document.getElementById("dropdown_item1").style.transform = "rotate(180deg)";
            count++;
        } else {
            document.getElementById("dropdown_item1").style.transform = "rotate(0deg)";
            count = 1;
        }
    });

    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options').toggle();
        $('#category-options').hide();
    });

    $('#btn-quantity').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#quantity-options').toggle();
        $('#status-options').hide();
    });
    $('#cancel-quantity').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#quantity-options').hide();
    });

    $('#btn-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#category-options').toggle();
        $('#status-options').hide();
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#status-options').hide();
    });
    $('#cancel-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#category-options').hide();
    });
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
</script>
</body>

</html>
