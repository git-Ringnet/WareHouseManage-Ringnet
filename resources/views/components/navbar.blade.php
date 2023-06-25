<!-- Kiểm tra login -->
@if (Auth::guest())
    <?php header('Location: ' . route('login'));
    exit(); ?>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @if (!empty($title))
            {{ $title }}
        @endif
    </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/icon/favicon.ico') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <script src="https://kit.fontawesome.com/774b78ff1e.js" crossorigin="anonymous"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <a href="../../public/"></a>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Việt css -->
    <link rel="stylesheet" href="{{ asset('dist/css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/tuan.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light w-100">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">

                    <a class="nav-link p-0 d-flex align-items-center" data-widget="pushmenu" href="#"
                        role="button"><svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="48" height="48" rx="8" fill="white" />
                            <path d="M16 19H32" stroke="#212529" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M16 24H32" stroke="#212529" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M16 29H32" stroke="#212529" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a href="#" class="title">
                        @if (!empty($title))
                            {{ $title }}
                        @endif
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown d-none">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    @if (Route::has('login'))
                        @auth
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="block px-4 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>
                                    <hr>
                                    <a class="px-4 text-sm" href="{{ route('profile.show') }}"> {{ __('Profile') }}
                                    </a>
                                    <form class="px-4" method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <button class="btn btn-primary text-sm" type="submit">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>

                                </div>
                            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Đăng nhập</a>
    @endauth
    @endif
    </li>

    </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4" style="top:57px">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup('dashboard') }}">
                            <svg class="stroke" width="32" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 11.7455V20C3 20.5523 3.44772 21 4 21H8.75C9.30229 21 9.75 20.5523 9.75 20V15.7692C9.75 15.2169 10.1977 14.7692 10.75 14.7692H13.25C13.8023 14.7692 14.25 15.2169 14.25 15.7692V20C14.25 20.5523 14.6977 21 15.25 21H20C20.5523 21 21 20.5523 21 20V11.7455C21 11.4664 20.8834 11.2 20.6783 11.0107L12.6783 3.6261C12.2952 3.27251 11.7048 3.27251 11.3217 3.6261L3.32172 11.0107C3.11664 11.2 3 11.4664 3 11.7455Z"
                                    stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <p>
                                Trang chủ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('data.index') }}"
                            class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup(['data.index', 'data.edit', 'editProduct', 'insertProducts']) }}">
                            <svg class="fill" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M11.6516 4C11.2699 4 10.895 4.10041 10.5644 4.29114L5.08731 7.45356C4.75673 7.64442 4.48222 7.91893 4.29136 8.2495C4.1005 8.58007 4.00001 8.95508 4 9.3368V15.6607C4 16.4378 4.41424 17.1557 5.08756 17.544L10.5644 20.7071C10.8794 20.8889 11.2347 20.9886 11.5978 20.9976C11.6155 20.9992 11.6334 21 11.6516 21C11.6697 21 11.6876 20.9992 11.7054 20.9976C12.0684 20.9886 12.4239 20.8888 12.7389 20.707L18.2158 17.5447C18.5464 17.3538 18.8209 17.0793 19.0118 16.7488C19.2026 16.4182 19.3031 16.0432 19.3031 15.6614V9.3368C19.3031 8.55972 18.8888 7.84177 18.2156 7.45341L12.7387 4.29114C12.4082 4.10041 12.0332 4 11.6516 4ZM17.6227 16.5175L12.2447 19.6227V12.8416L18.117 9.45097V15.6614C18.117 15.8349 18.0713 16.0054 17.9845 16.1557C17.8978 16.3059 17.773 16.4307 17.6227 16.5175ZM11.0585 19.6227V12.8415L7.94211 11.0422C7.93429 11.0379 7.92656 11.0334 7.91893 11.0288L5.18617 9.45094V15.6607C5.18617 16.0143 5.3745 16.3402 5.68017 16.5165L11.0585 19.6227ZM9.41421 10.5225L15.29 7.13387L17.5239 8.42372L11.6516 11.8143L9.41421 10.5225ZM8.22775 9.83741L5.77929 8.4237L11.1572 5.31856C11.3075 5.23189 11.4781 5.18617 11.6516 5.18617C11.8251 5.18617 11.9957 5.23189 12.146 5.31856L14.1035 6.44882L8.22775 9.83741Z"
                                    fill="#555555" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.52127 12.2537C5.72909 11.8954 6.18803 11.7734 6.54633 11.9812L9.54633 13.7212C9.90464 13.9291 10.0266 14.388 9.81882 14.7463C9.611 15.1046 9.15206 15.2266 8.79376 15.0188L5.79376 13.2788C5.43545 13.071 5.31345 12.612 5.52127 12.2537Z"
                                    fill="#55555" />
                            </svg>
                            <p>
                                Sản phẩm
                            </p>
                        </a>
                    </li>
                    @can('view-orders')
                        <li class="nav-item">
                            <a href="{{ route('insertProduct.index') }}"
                                class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup(['insertProduct.index', 'insertProduct.create', 'insertProduct.edit']) }}">
                                <svg class="stroke" width="32" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6062_36566)">
                                        <path
                                            d="M20 11V5C20 4.46957 19.7893 3.96086 19.4142 3.58579C19.0391 3.21071 18.5304 3 18 3H5C4.46957 3 3.96086 3.21071 3.58579 3.58579C3.21071 3.96086 3 4.46957 3 5V19C3 19.5304 3.21071 20.0391 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H10"
                                            stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.25 15H10" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M17.5 13.818V17" stroke="#555555" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M21 22H14.125C13.8266 22 13.5405 21.8815 13.3295 21.6705C13.1185 21.4595 13 21.1734 13 20.875V16.567C13.0002 16.2968 13.055 16.0295 13.161 15.781L13.708 14.501C13.7947 14.2983 13.939 14.1256 14.123 14.0042C14.307 13.8828 14.5226 13.818 14.743 13.818H20.257C20.4773 13.8181 20.6927 13.8829 20.8765 14.0043C21.0603 14.1257 21.2045 14.2984 21.291 14.501L21.839 15.783C21.9452 16.0314 22 16.2988 22 16.569V21C22 21.2652 21.8946 21.5196 21.7071 21.7071C21.5196 21.8946 21.2652 22 21 22Z"
                                            stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 18C22 17.7348 21.8946 17.4804 21.7071 17.2929C21.5196 17.1054 21.2652 17 21 17H14C13.7348 17 13.4804 17.1054 13.2929 17.2929C13.1054 17.4804 13 17.7348 13 18"
                                            stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.25 11H13" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.25 7.125H16" stroke="#555555" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M6.75 7.79999C6.89834 7.79999 7.04334 7.756 7.16668 7.67359C7.29001 7.59118 7.38614 7.47404 7.44291 7.337C7.49967 7.19995 7.51453 7.04915 7.48559 6.90367C7.45665 6.75818 7.38522 6.62455 7.28033 6.51966C7.17544 6.41477 7.0418 6.34334 6.89632 6.3144C6.75083 6.28546 6.60003 6.30031 6.46299 6.35708C6.32594 6.41384 6.20881 6.50997 6.1264 6.63331C6.04399 6.75664 6 6.90165 6 7.04999C6 7.2489 6.07902 7.43967 6.21967 7.58032C6.36032 7.72097 6.55109 7.79999 6.75 7.79999Z"
                                            fill="#555555" />
                                        <path
                                            d="M6.75 11.8C6.89834 11.8 7.04334 11.756 7.16668 11.6736C7.29001 11.5912 7.38614 11.474 7.44291 11.337C7.49967 11.2 7.51453 11.0492 7.48559 10.9037C7.45665 10.7582 7.38522 10.6245 7.28033 10.5197C7.17544 10.4148 7.0418 10.3433 6.89632 10.3144C6.75083 10.2855 6.60003 10.3003 6.46299 10.3571C6.32594 10.4138 6.20881 10.51 6.1264 10.6333C6.04399 10.7566 6 10.9017 6 11.05C6 11.2489 6.07902 11.4397 6.21967 11.5803C6.36032 11.721 6.55109 11.8 6.75 11.8Z"
                                            fill="#555555" />
                                        <path
                                            d="M6.75 15.7C6.89834 15.7 7.04334 15.656 7.16668 15.5736C7.29001 15.4912 7.38614 15.3741 7.44291 15.237C7.49967 15.1 7.51453 14.9492 7.48559 14.8037C7.45665 14.6582 7.38522 14.5246 7.28033 14.4197C7.17544 14.3148 7.0418 14.2434 6.89632 14.2144C6.75083 14.1855 6.60003 14.2003 6.46299 14.2571C6.32594 14.3139 6.20881 14.41 6.1264 14.5333C6.04399 14.6567 6 14.8017 6 14.95C6 15.1489 6.07902 15.3397 6.21967 15.4803C6.36032 15.621 6.55109 15.7 6.75 15.7Z"
                                            fill="#555555" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6062_36566">
                                            <rect width="24" height="24" rx="4" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p>
                                    Nhập hàng
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('view-exports')
                        <li class="nav-item">
                            <a href="{{ route('exports.index') }}"
                                class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup('exports.index,exports.create,exports.edit') }}">
                                <svg class="stroke" width="32" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_6062_36566)">
                                        <path
                                            d="M20 11V5C20 4.46957 19.7893 3.96086 19.4142 3.58579C19.0391 3.21071 18.5304 3 18 3H5C4.46957 3 3.96086 3.21071 3.58579 3.58579C3.21071 3.96086 3 4.46957 3 5V19C3 19.5304 3.21071 20.0391 3.58579 20.4142C3.96086 20.7893 4.46957 21 5 21H10"
                                            stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.25 15H10" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M17.5 13.818V17" stroke="#555555" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M21 22H14.125C13.8266 22 13.5405 21.8815 13.3295 21.6705C13.1185 21.4595 13 21.1734 13 20.875V16.567C13.0002 16.2968 13.055 16.0295 13.161 15.781L13.708 14.501C13.7947 14.2983 13.939 14.1256 14.123 14.0042C14.307 13.8828 14.5226 13.818 14.743 13.818H20.257C20.4773 13.8181 20.6927 13.8829 20.8765 14.0043C21.0603 14.1257 21.2045 14.2984 21.291 14.501L21.839 15.783C21.9452 16.0314 22 16.2988 22 16.569V21C22 21.2652 21.8946 21.5196 21.7071 21.7071C21.5196 21.8946 21.2652 22 21 22Z"
                                            stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M22 18C22 17.7348 21.8946 17.4804 21.7071 17.2929C21.5196 17.1054 21.2652 17 21 17H14C13.7348 17 13.4804 17.1054 13.2929 17.2929C13.1054 17.4804 13 17.7348 13 18"
                                            stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.25 11H13" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M9.25 7.125H16" stroke="#555555" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M6.75 7.79999C6.89834 7.79999 7.04334 7.756 7.16668 7.67359C7.29001 7.59118 7.38614 7.47404 7.44291 7.337C7.49967 7.19995 7.51453 7.04915 7.48559 6.90367C7.45665 6.75818 7.38522 6.62455 7.28033 6.51966C7.17544 6.41477 7.0418 6.34334 6.89632 6.3144C6.75083 6.28546 6.60003 6.30031 6.46299 6.35708C6.32594 6.41384 6.20881 6.50997 6.1264 6.63331C6.04399 6.75664 6 6.90165 6 7.04999C6 7.2489 6.07902 7.43967 6.21967 7.58032C6.36032 7.72097 6.55109 7.79999 6.75 7.79999Z"
                                            fill="#555555" />
                                        <path
                                            d="M6.75 11.8C6.89834 11.8 7.04334 11.756 7.16668 11.6736C7.29001 11.5912 7.38614 11.474 7.44291 11.337C7.49967 11.2 7.51453 11.0492 7.48559 10.9037C7.45665 10.7582 7.38522 10.6245 7.28033 10.5197C7.17544 10.4148 7.0418 10.3433 6.89632 10.3144C6.75083 10.2855 6.60003 10.3003 6.46299 10.3571C6.32594 10.4138 6.20881 10.51 6.1264 10.6333C6.04399 10.7566 6 10.9017 6 11.05C6 11.2489 6.07902 11.4397 6.21967 11.5803C6.36032 11.721 6.55109 11.8 6.75 11.8Z"
                                            fill="#555555" />
                                        <path
                                            d="M6.75 15.7C6.89834 15.7 7.04334 15.656 7.16668 15.5736C7.29001 15.4912 7.38614 15.3741 7.44291 15.237C7.49967 15.1 7.51453 14.9492 7.48559 14.8037C7.45665 14.6582 7.38522 14.5246 7.28033 14.4197C7.17544 14.3148 7.0418 14.2434 6.89632 14.2144C6.75083 14.1855 6.60003 14.2003 6.46299 14.2571C6.32594 14.3139 6.20881 14.41 6.1264 14.5333C6.04399 14.6567 6 14.8017 6 14.95C6 15.1489 6.07902 15.3397 6.21967 15.4803C6.36032 15.621 6.55109 15.7 6.75 15.7Z"
                                            fill="#555555" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_6062_36566">
                                            <rect width="24" height="24" rx="4" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p>
                                    Xuất hàng
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('view-exports')
                        <li class="nav-item">
                            <a href="{{ route('debt.index') }}"
                                class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup('debt.index,debt.edit') }}">
                                <svg class="fill" width="32" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_7479_53634)">
                                    <path d="M6.85714 3.88603H5.57143C4.88944 3.88603 4.23539 4.15097 3.75315 4.62257C3.27092 5.09417 3 5.73379 3 6.40074V19.6029C3 20.2699 3.27092 20.9095 3.75315 21.3811C4.23539 21.8527 4.88944 22.1176 5.57143 22.1176H18.4286C19.1106 22.1176 19.7646 21.8527 20.2468 21.3811C20.7291 20.9095 21 20.2699 21 19.6029V6.40074C21 5.73379 20.7291 5.09417 20.2468 4.62257C19.7646 4.15097 19.1106 3.88603 18.4286 3.88603H17.1429V5.14338H18.4286C18.7696 5.14338 19.0966 5.27585 19.3377 5.51165C19.5788 5.74745 19.7143 6.06727 19.7143 6.40074V19.6029C19.7143 19.9364 19.5788 20.2562 19.3377 20.492C19.0966 20.7278 18.7696 20.8603 18.4286 20.8603H5.57143C5.23044 20.8603 4.90341 20.7278 4.66229 20.492C4.42117 20.2562 4.28571 19.9364 4.28571 19.6029V6.40074C4.28571 6.06727 4.42117 5.74745 4.66229 5.51165C4.90341 5.27585 5.23044 5.14338 5.57143 5.14338H6.85714V3.88603Z" fill="#555555"/>
                                    <path d="M13.9286 3.25735C14.0991 3.25735 14.2626 3.32359 14.3831 3.44149C14.5037 3.55939 14.5714 3.71929 14.5714 3.88603V5.14338C14.5714 5.31012 14.5037 5.47002 14.3831 5.58792C14.2626 5.70582 14.0991 5.77206 13.9286 5.77206H10.0714C9.90093 5.77206 9.73742 5.70582 9.61686 5.58792C9.4963 5.47002 9.42857 5.31012 9.42857 5.14338V3.88603C9.42857 3.71929 9.4963 3.55939 9.61686 3.44149C9.73742 3.32359 9.90093 3.25735 10.0714 3.25735H13.9286ZM10.0714 2C9.55994 2 9.0694 2.19871 8.70772 2.55241C8.34605 2.9061 8.14286 3.38582 8.14286 3.88603V5.14338C8.14286 5.64359 8.34605 6.12331 8.70772 6.47701C9.0694 6.83071 9.55994 7.02941 10.0714 7.02941H13.9286C14.4401 7.02941 14.9306 6.83071 15.2923 6.47701C15.654 6.12331 15.8571 5.64359 15.8571 5.14338V3.88603C15.8571 3.38582 15.654 2.9061 15.2923 2.55241C14.9306 2.19871 14.4401 2 13.9286 2H10.0714Z" fill="#555555"/>
                                    <path d="M8.14286 15.3143C8.28021 16.512 9.54706 17.362 11.4756 17.4719V18.3456H12.4436V17.4719C14.5504 17.3433 15.8571 16.4387 15.8571 15.1009C15.8571 13.9585 14.9782 13.2975 13.1137 12.9253L12.4436 12.791V10.0593C13.4849 10.1383 14.1875 10.5723 14.3648 11.2203H15.7291C15.575 10.0708 14.2998 9.24595 12.4436 9.1547V8.28676H11.4756V9.17266C9.67606 9.33791 8.44077 10.2303 8.44077 11.4402C8.44077 12.4849 9.33731 13.2242 10.9104 13.536L11.4766 13.6524V16.5487C10.4102 16.4265 9.67606 15.9739 9.4988 15.3143H8.14286ZM11.29 12.5582C10.322 12.3692 9.80507 11.9654 9.80507 11.3971C9.80507 10.7188 10.4584 10.2181 11.4756 10.0837V12.5948L11.29 12.5582ZM12.7666 13.9032C13.9611 14.1353 14.4854 14.5204 14.4854 15.1742C14.4854 15.9624 13.7188 16.4876 12.4436 16.5673V13.8407L12.7666 13.9032Z" fill="#555555"/>
                                    <path d="M6.85714 3.88603H5.57143C4.88944 3.88603 4.23539 4.15097 3.75315 4.62257C3.27092 5.09417 3 5.73379 3 6.40074V19.6029C3 20.2699 3.27092 20.9095 3.75315 21.3811C4.23539 21.8527 4.88944 22.1176 5.57143 22.1176H18.4286C19.1106 22.1176 19.7646 21.8527 20.2468 21.3811C20.7291 20.9095 21 20.2699 21 19.6029V6.40074C21 5.73379 20.7291 5.09417 20.2468 4.62257C19.7646 4.15097 19.1106 3.88603 18.4286 3.88603H17.1429V5.14338H18.4286C18.7696 5.14338 19.0966 5.27585 19.3377 5.51165C19.5788 5.74745 19.7143 6.06727 19.7143 6.40074V19.6029C19.7143 19.9364 19.5788 20.2562 19.3377 20.492C19.0966 20.7278 18.7696 20.8603 18.4286 20.8603H5.57143C5.23044 20.8603 4.90341 20.7278 4.66229 20.492C4.42117 20.2562 4.28571 19.9364 4.28571 19.6029V6.40074C4.28571 6.06727 4.42117 5.74745 4.66229 5.51165C4.90341 5.27585 5.23044 5.14338 5.57143 5.14338H6.85714V3.88603Z" fill="#555555" stroke-width="0.4"/>
                                    <path d="M13.9286 3.25735C14.0991 3.25735 14.2626 3.32359 14.3831 3.44149C14.5037 3.55939 14.5714 3.71929 14.5714 3.88603V5.14338C14.5714 5.31012 14.5037 5.47002 14.3831 5.58792C14.2626 5.70582 14.0991 5.77206 13.9286 5.77206H10.0714C9.90093 5.77206 9.73742 5.70582 9.61686 5.58792C9.4963 5.47002 9.42857 5.31012 9.42857 5.14338V3.88603C9.42857 3.71929 9.4963 3.55939 9.61686 3.44149C9.73742 3.32359 9.90093 3.25735 10.0714 3.25735H13.9286ZM10.0714 2C9.55994 2 9.0694 2.19871 8.70772 2.55241C8.34605 2.9061 8.14286 3.38582 8.14286 3.88603V5.14338C8.14286 5.64359 8.34605 6.12331 8.70772 6.47701C9.0694 6.83071 9.55994 7.02941 10.0714 7.02941H13.9286C14.4401 7.02941 14.9306 6.83071 15.2923 6.47701C15.654 6.12331 15.8571 5.64359 15.8571 5.14338V3.88603C15.8571 3.38582 15.654 2.9061 15.2923 2.55241C14.9306 2.19871 14.4401 2 13.9286 2H10.0714Z" fill="#555555" stroke-width="0.4"/>
                                    <path d="M8.14286 15.3143C8.28021 16.512 9.54706 17.362 11.4756 17.4719V18.3456H12.4436V17.4719C14.5504 17.3433 15.8571 16.4387 15.8571 15.1009C15.8571 13.9585 14.9782 13.2975 13.1137 12.9253L12.4436 12.791V10.0593C13.4849 10.1383 14.1875 10.5723 14.3648 11.2203H15.7291C15.575 10.0708 14.2998 9.24595 12.4436 9.1547V8.28676H11.4756V9.17266C9.67606 9.33791 8.44077 10.2303 8.44077 11.4402C8.44077 12.4849 9.33731 13.2242 10.9104 13.536L11.4766 13.6524V16.5487C10.4102 16.4265 9.67606 15.9739 9.4988 15.3143H8.14286ZM11.29 12.5582C10.322 12.3692 9.80507 11.9654 9.80507 11.3971C9.80507 10.7188 10.4584 10.2181 11.4756 10.0837V12.5948L11.29 12.5582ZM12.7666 13.9032C13.9611 14.1353 14.4854 14.5204 14.4854 15.1742C14.4854 15.9624 13.7188 16.4876 12.4436 16.5673V13.8407L12.7666 13.9032Z" fill="#555555" stroke-width="0.4"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_7479_53634">
                                    <rect width="24" height="24" rx="4" fill="white"/>
                                    </clipPath>
                                    </defs>
                                    </svg>
                                <p>
                                    Công nợ
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('isAdmin')
                        <li class="nav-item">
                            <a href="{{ route('admin.userslist') }}"
                                class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup('admin.userslist,admin.add,admin.edit') }}">
                                <svg class="fill" width="32" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 3.75C9.81196 3.75 7.71354 4.61919 6.16637 6.16637C4.61919 7.71354 3.75 9.81196 3.75 12C3.75 14.188 4.61919 16.2865 6.16637 17.8336C7.71354 19.3808 9.81196 20.25 12 20.25C14.188 20.25 16.2865 19.3808 17.8336 17.8336C19.3808 16.2865 20.25 14.188 20.25 12C20.25 9.81196 19.3808 7.71354 17.8336 6.16637C16.2865 4.61919 14.188 3.75 12 3.75ZM5.10571 5.10571C6.93419 3.27723 9.41414 2.25 12 2.25C14.5859 2.25 17.0658 3.27723 18.8943 5.10571C20.7228 6.93419 21.75 9.41414 21.75 12C21.75 14.5859 20.7228 17.0658 18.8943 18.8943C17.0658 20.7228 14.5859 21.75 12 21.75C9.41414 21.75 6.93419 20.7228 5.10571 18.8943C3.27723 17.0658 2.25 14.5859 2.25 12C2.25 9.41414 3.27723 6.93419 5.10571 5.10571Z"
                                        fill="#555555" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.9394 8.18934C11.2207 7.90804 11.6022 7.75 12.0001 7.75C12.3979 7.75 12.7794 7.90804 13.0607 8.18934C13.3421 8.47065 13.5001 8.85219 13.5001 9.25001C13.5001 9.64784 13.3421 10.0294 13.0607 10.3107C12.7794 10.592 12.3979 10.75 12.0001 10.75C11.6022 10.75 11.2207 10.592 10.9394 10.3107C10.6581 10.0294 10.5001 9.64784 10.5001 9.25001C10.5001 8.85219 10.6581 8.47065 10.9394 8.18934ZM12.0001 6.25C12.7957 6.25 13.5588 6.56607 14.1214 7.12868C14.684 7.6913 15.0001 8.45436 15.0001 9.25001C15.0001 10.0457 14.684 10.8087 14.1214 11.3713C13.5588 11.934 12.7957 12.25 12.0001 12.25C11.2044 12.25 10.4414 11.934 9.87874 11.3713C9.31613 10.8087 9.00006 10.0457 9.00006 9.25001C9.00006 8.45436 9.31613 7.6913 9.87874 7.12868C10.4414 6.56607 11.2044 6.25 12.0001 6.25ZM13.4573 13.338L10.5441 13.338C9.67413 13.3391 8.83217 13.6506 8.17135 14.2164C7.51054 14.7822 7.07327 15.5652 6.93816 16.4245C6.87384 16.8337 7.1534 17.2176 7.56259 17.2819C7.97178 17.3462 8.35564 17.0667 8.41996 16.6575C8.49961 16.1509 8.75738 15.6893 9.14692 15.3558C9.53634 15.0224 10.0319 14.8388 10.5446 14.838H13.4554C13.9681 14.839 14.4636 15.0226 14.853 15.356C15.2426 15.6896 15.5004 16.1511 15.5802 16.6577C15.6446 17.0669 16.0286 17.3463 16.4378 17.2819C16.8469 17.2174 17.1264 16.8335 17.0619 16.4243C16.9266 15.5651 16.4893 14.7823 15.8286 14.2166C15.1679 13.6509 14.3271 13.3394 13.4573 13.338Z"
                                        fill="#555555" />
                                </svg>

                                <p>
                                    Nhân viên
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('view-provides')
                        <li class="nav-item">
                            <a href="{{ route('provides.index') }}"
                                class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup('provides.index,provides.create,provides.edit') }}">
                                <svg class="fill" width="32" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 3.75C9.81196 3.75 7.71354 4.61919 6.16637 6.16637C4.61919 7.71354 3.75 9.81196 3.75 12C3.75 14.188 4.61919 16.2865 6.16637 17.8336C7.71354 19.3808 9.81196 20.25 12 20.25C14.188 20.25 16.2865 19.3808 17.8336 17.8336C19.3808 16.2865 20.25 14.188 20.25 12C20.25 9.81196 19.3808 7.71354 17.8336 6.16637C16.2865 4.61919 14.188 3.75 12 3.75ZM5.10571 5.10571C6.93419 3.27723 9.41414 2.25 12 2.25C14.5859 2.25 17.0658 3.27723 18.8943 5.10571C20.7228 6.93419 21.75 9.41414 21.75 12C21.75 14.5859 20.7228 17.0658 18.8943 18.8943C17.0658 20.7228 14.5859 21.75 12 21.75C9.41414 21.75 6.93419 20.7228 5.10571 18.8943C3.27723 17.0658 2.25 14.5859 2.25 12C2.25 9.41414 3.27723 6.93419 5.10571 5.10571Z"
                                        fill="#555555" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.9394 8.18934C11.2207 7.90804 11.6022 7.75 12.0001 7.75C12.3979 7.75 12.7794 7.90804 13.0607 8.18934C13.3421 8.47065 13.5001 8.85219 13.5001 9.25001C13.5001 9.64784 13.3421 10.0294 13.0607 10.3107C12.7794 10.592 12.3979 10.75 12.0001 10.75C11.6022 10.75 11.2207 10.592 10.9394 10.3107C10.6581 10.0294 10.5001 9.64784 10.5001 9.25001C10.5001 8.85219 10.6581 8.47065 10.9394 8.18934ZM12.0001 6.25C12.7957 6.25 13.5588 6.56607 14.1214 7.12868C14.684 7.6913 15.0001 8.45436 15.0001 9.25001C15.0001 10.0457 14.684 10.8087 14.1214 11.3713C13.5588 11.934 12.7957 12.25 12.0001 12.25C11.2044 12.25 10.4414 11.934 9.87874 11.3713C9.31613 10.8087 9.00006 10.0457 9.00006 9.25001C9.00006 8.45436 9.31613 7.6913 9.87874 7.12868C10.4414 6.56607 11.2044 6.25 12.0001 6.25ZM13.4573 13.338L10.5441 13.338C9.67413 13.3391 8.83217 13.6506 8.17135 14.2164C7.51054 14.7822 7.07327 15.5652 6.93816 16.4245C6.87384 16.8337 7.1534 17.2176 7.56259 17.2819C7.97178 17.3462 8.35564 17.0667 8.41996 16.6575C8.49961 16.1509 8.75738 15.6893 9.14692 15.3558C9.53634 15.0224 10.0319 14.8388 10.5446 14.838H13.4554C13.9681 14.839 14.4636 15.0226 14.853 15.356C15.2426 15.6896 15.5004 16.1511 15.5802 16.6577C15.6446 17.0669 16.0286 17.3463 16.4378 17.2819C16.8469 17.2174 17.1264 16.8335 17.0619 16.4243C16.9266 15.5651 16.4893 14.7823 15.8286 14.2166C15.1679 13.6509 14.3271 13.3394 13.4573 13.338Z"
                                        fill="#555555" />
                                </svg>

                                <p>
                                    Nhà cung cấp
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('view-guests')
                        <li class="nav-item">
                            <a href="{{ route('guests.index') }}"
                                class="nav-link {{ App\Helpers\Helper::isActiveRouteGroup('guests.index,guests.create,guests.edit') }}">
                                <svg class="fill" width="32" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12 3.75C9.81196 3.75 7.71354 4.61919 6.16637 6.16637C4.61919 7.71354 3.75 9.81196 3.75 12C3.75 14.188 4.61919 16.2865 6.16637 17.8336C7.71354 19.3808 9.81196 20.25 12 20.25C14.188 20.25 16.2865 19.3808 17.8336 17.8336C19.3808 16.2865 20.25 14.188 20.25 12C20.25 9.81196 19.3808 7.71354 17.8336 6.16637C16.2865 4.61919 14.188 3.75 12 3.75ZM5.10571 5.10571C6.93419 3.27723 9.41414 2.25 12 2.25C14.5859 2.25 17.0658 3.27723 18.8943 5.10571C20.7228 6.93419 21.75 9.41414 21.75 12C21.75 14.5859 20.7228 17.0658 18.8943 18.8943C17.0658 20.7228 14.5859 21.75 12 21.75C9.41414 21.75 6.93419 20.7228 5.10571 18.8943C3.27723 17.0658 2.25 14.5859 2.25 12C2.25 9.41414 3.27723 6.93419 5.10571 5.10571Z"
                                        fill="#555555" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.9394 8.18934C11.2207 7.90804 11.6022 7.75 12.0001 7.75C12.3979 7.75 12.7794 7.90804 13.0607 8.18934C13.3421 8.47065 13.5001 8.85219 13.5001 9.25001C13.5001 9.64784 13.3421 10.0294 13.0607 10.3107C12.7794 10.592 12.3979 10.75 12.0001 10.75C11.6022 10.75 11.2207 10.592 10.9394 10.3107C10.6581 10.0294 10.5001 9.64784 10.5001 9.25001C10.5001 8.85219 10.6581 8.47065 10.9394 8.18934ZM12.0001 6.25C12.7957 6.25 13.5588 6.56607 14.1214 7.12868C14.684 7.6913 15.0001 8.45436 15.0001 9.25001C15.0001 10.0457 14.684 10.8087 14.1214 11.3713C13.5588 11.934 12.7957 12.25 12.0001 12.25C11.2044 12.25 10.4414 11.934 9.87874 11.3713C9.31613 10.8087 9.00006 10.0457 9.00006 9.25001C9.00006 8.45436 9.31613 7.6913 9.87874 7.12868C10.4414 6.56607 11.2044 6.25 12.0001 6.25ZM13.4573 13.338L10.5441 13.338C9.67413 13.3391 8.83217 13.6506 8.17135 14.2164C7.51054 14.7822 7.07327 15.5652 6.93816 16.4245C6.87384 16.8337 7.1534 17.2176 7.56259 17.2819C7.97178 17.3462 8.35564 17.0667 8.41996 16.6575C8.49961 16.1509 8.75738 15.6893 9.14692 15.3558C9.53634 15.0224 10.0319 14.8388 10.5446 14.838H13.4554C13.9681 14.839 14.4636 15.0226 14.853 15.356C15.2426 15.6896 15.5004 16.1511 15.5802 16.6577C15.6446 17.0669 16.0286 17.3463 16.4378 17.2819C16.8469 17.2174 17.1264 16.8335 17.0619 16.4243C16.9266 15.5651 16.4893 14.7823 15.8286 14.2166C15.1679 13.6509 14.3271 13.3394 13.4573 13.338Z"
                                        fill="#555555" />
                                </svg>

                                <p>
                                    Khách hàng
                                </p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <div class="alert notification d-flex justify-content-center align-items-center m-0">
        <div class="success" style="position: absolute;top: 60px;">
            @if (Session::has('msg'))
                <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert"
                    style="z-index: 999999;">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 4.38462C7.79374 4.38462 4.38462 7.79374 4.38462 12C4.38462 16.2063 7.79374 19.6154 12 19.6154C16.2063 19.6154 19.6154 16.2063 19.6154 12C19.6154 7.79374 16.2063 4.38462 12 4.38462ZM3 12C3 7.02903 7.02903 3 12 3C16.971 3 21 7.02903 21 12C21 16.971 16.971 21 12 21C7.02903 21 3 16.971 3 12Z"
                                fill="#ffff" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.1818 9.66432C16.4522 9.93468 16.4522 10.373 16.1818 10.6434L11.5664 15.2588C11.2961 15.5291 10.8577 15.5291 10.5874 15.2588L7.81813 12.4895C7.54777 12.2192 7.54777 11.7808 7.81813 11.5105C8.08849 11.2401 8.52684 11.2401 8.7972 11.5105L11.0769 13.7902L15.2027 9.66432C15.4731 9.39396 15.9115 9.39396 16.1818 9.66432Z"
                                fill="#ffff" />
                        </svg>
                    </div>
                    <div class="message pl-3">
                        {{ Session::get('msg') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="d-flex" aria-hidden="true"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 18L6 6" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18 6L6 18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
        </div>
        <div class="warning" style="position: absolute;top: 60px;">
            @if (Session::has('warning'))
                <div id="notification" class="alert alert-warning alert-dismissible fade show m-0" role="alert"
                    style="z-index: 999999;">
                    <div class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 4.38462C7.79374 4.38462 4.38462 7.79374 4.38462 12C4.38462 16.2063 7.79374 19.6154 12 19.6154C16.2063 19.6154 19.6154 16.2063 19.6154 12C19.6154 7.79374 16.2063 4.38462 12 4.38462ZM12 21C7.02903 21 3 16.971 3 12C3 7.02903 7.02903 3 12 3C16.971 3 21 7.02903 21 12C21 16.971 16.971 21 12 21Z"
                                fill="#ffff" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 7.15384C12.3824 7.15384 12.6923 7.4638 12.6923 7.84615V12.4615C12.6923 12.8439 12.3824 13.1538 12 13.1538C11.6177 13.1538 11.3077 12.8439 11.3077 12.4615V7.84615C11.3077 7.4638 11.6177 7.15384 12 7.15384Z"
                                fill="#ffff" />
                            <circle cx="12" cy="15.6923" r="0.923077" fill="#ffff" />
                        </svg>
                    </div>
                    <div class="message pl-3">
                        {{ Session::get('warning') }}
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="d-flex" aria-hidden="true"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 18L6 6" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M18 6L6 18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#notification').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 4000);
        });
    </script>
