<x-navbar :title="$title"></x-navbar>
<div class="content-wrapper export-add">
    <div class="row">
        <div class="col-sm-6 breadcrumb">
            @if ($exports->export_status == 2)
                <a href="{{ route('exports.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                            fill="#555555" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M17 11.9999C17 12.3289 16.7513 12.5956 16.4444 12.5956L7.55557 12.5956C7.24875 12.5956 7.00002 12.3289 7.00002 11.9999C7.00002 11.671 7.24875 11.4043 7.55557 11.4043L16.4444 11.4043C16.7513 11.4043 17 11.671 17 11.9999Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M11.1244 8.17446C11.3413 8.40707 11.3413 8.78421 11.1244 9.01683L8.34199 12L11.1244 14.9832C11.3413 15.2158 11.3413 15.5929 11.1244 15.8255C10.9074 16.0582 10.5557 16.0582 10.3387 15.8255L7.16349 12.4212C6.94653 12.1886 6.94653 11.8114 7.16349 11.5788L10.3387 8.17446C10.5557 7.94185 10.9074 7.94185 11.1244 8.17446Z"
                            fill="white" />
                    </svg>
                    <span class="ml-1" style="font-size: 16px; font-weight: 500; color: #555555;">Quay lại danh
                        sách</span>
                </a>
            @else
                <span><a href="{{ route('exports.index') }}">Xuất hàng</a></span>
                <span class="px-1">/</span>
                <span><b>Chi tiết đơn hàng</b></span>
            @endif
        </div>
        <div class="col-sm-6 position-absolute" style="top:63px;right:2%">
            <div class="w-50 position-relative" style="float: right;">
                <div class="justify-content-between d-flex">
                    @if ($exports->export_status == 0)
                        <span style="z-index: 99">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z"
                                    fill="#D6D6D6" />
                                <path
                                    d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z"
                                    fill="#D6D6D6" />
                            </svg>
                        </span>
                    @else
                        <span style="z-index: 99">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15.6667" cy="15.667" r="13" fill="#09BD3C" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.1072 12.2929C22.4977 12.6834 22.4977 13.3166 22.1072 13.7071L15.4405 20.3738C15.05 20.7643 14.4168 20.7643 14.0263 20.3738L10.0263 16.3738C9.63577 15.9832 9.63577 15.3501 10.0263 14.9596C10.4168 14.569 11.05 14.569 11.4405 14.9596L14.7334 18.2525L20.693 12.2929C21.0835 11.9024 21.7166 11.9024 22.1072 12.2929Z"
                                    fill="white" />
                            </svg>
                            <p class="text-center p-0 m-0">
                                <svg width="6" height="6" viewBox="0 0 6 6" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="3" r="3" fill="#09BD3C" />
                                </svg>
                            </p>
                        </span>
                    @endif
                    @if ($exports->export_status == 0)
                        <span style="z-index: 99">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z"
                                    fill="#D6D6D6" />
                                <path
                                    d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z"
                                    fill="#D6D6D6" />
                            </svg>
                        </span>
                    @else
                        <span style="z-index: 99">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15.6667" cy="15.667" r="13" fill="#09BD3C" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.1072 12.2929C22.4977 12.6834 22.4977 13.3166 22.1072 13.7071L15.4405 20.3738C15.05 20.7643 14.4168 20.7643 14.0263 20.3738L10.0263 16.3738C9.63577 15.9832 9.63577 15.3501 10.0263 14.9596C10.4168 14.569 11.05 14.569 11.4405 14.9596L14.7334 18.2525L20.693 12.2929C21.0835 11.9024 21.7166 11.9024 22.1072 12.2929Z"
                                    fill="white" />
                            </svg>
                            <p class="text-center p-0 m-0">
                                <svg width="6" height="6" viewBox="0 0 6 6" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="3" r="3" fill="#09BD3C" />
                                </svg>
                            </p>
                        </span>
                    @endif
                    @if ($exports->export_status == 1 || $exports->export_status == 0)
                        <span style="z-index: 99">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z"
                                    fill="#D6D6D6" />
                                <path
                                    d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z"
                                    fill="#D6D6D6" />
                            </svg>
                        </span>
                    @elseif($exports->export_status == 2)
                        <span style="z-index: 99">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="15.6667" cy="15.667" r="13" fill="#09BD3C" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M22.1072 12.2929C22.4977 12.6834 22.4977 13.3166 22.1072 13.7071L15.4405 20.3738C15.05 20.7643 14.4168 20.7643 14.0263 20.3738L10.0263 16.3738C9.63577 15.9832 9.63577 15.3501 10.0263 14.9596C10.4168 14.569 11.05 14.569 11.4405 14.9596L14.7334 18.2525L20.693 12.2929C21.0835 11.9024 21.7166 11.9024 22.1072 12.2929Z"
                                    fill="white" />
                            </svg>
                            <p class="text-center p-0 m-0">
                                <svg width="6" height="6" viewBox="0 0 6 6" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="3" r="3" fill="#09BD3C" />
                                </svg>
                            </p>
                        </span>
                    @endif
                </div>
                @if ($exports->export_status != 0)
                    <div class="position-absolute" style="top: 32px; z-index: 0;left: 17px">
                        <svg height="4" viewBox="0 0 364 3" fill="none" style="width: 95%"
                            xmlns="http://www.w3.org/2000/svg">
                            <line x1="0.999268" y1="1.50098" x2="363.001" y2="1.50098" stroke="#FFFFFF"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                @endif
                <div class="justify-content-between d-flex">
                    <b>Tạo đơn</b>
                    <b>Đơn nháp</b>
                    <b>Chốt đơn</b>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('exports.update', $exports->id) }}" method="POST" id="export_form">
        @csrf
        @method('PUT')
        <input type="hidden" name="checkguest" value="" id="checkguest">
        <section class="content">
            <div class="d-flex mb-1 action-don">
                @if ($exports->export_status == 1)
                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                        <button type="submit" class="btn btn-danger text-white" name="submitBtn" value="action1"
                            onclick="validateAndSubmit(event)" id="chot_don">Chốt đơn</button>
                        <button type="submit" class="btn btn-secondary mx-4" name="submitBtn" value="action2"
                            onclick="validateAndSubmit(event)" id="huy">Hủy đơn</button>
                    @endif
                @endif
                @if ($exports->export_status == 2)
                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                        @if ($check->debt_status != 1)
                            <a class="btn btn-secondary text-white" id="chinhsua"
                                href="{{ route('editEx', ['id' => $exports->id]) }}">Chỉnh sửa</a>
                        @endif
                        @if ($exports->export_status != 0)
                            <button type="submit" class="btn btn-secondary <?php if ($check->debt_status != 1) {
                                echo 'mx-4';
                            } ?>"
                                onclick="validateAndSubmit(event)" id="huydon" name="submitBtn"
                                value="action4">Hủy đơn</button>
                        @endif
                    @endif
                @endif
                @if ($exports->export_status == 0)
                    <button type="submit" class="btn btn-danger text-white" name="submitBtn" value="action6"
                        onclick="validateAndSubmit(event)" id="chot_don">Xóa đơn</button>
                @endif
                {{-- <a href="#" class="btn border border-secondary mr-4">Xuất file</a> --}}
            </div>
            <div class="container-fluided position-relative">
                <div class="row my-3">
                    <div class="col">
                        <div class="w-75">
                            @if ($exports->export_status == 1)
                                @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                                    <div class="d-flex mb-2">
                                        <input type="radio" name="options" id="radio1" checked>
                                        <span class="ml-1">Khách hàng cũ</span>
                                        <input type="radio" name="options" id="radio2"
                                            style="margin-left: 40px;">
                                        <span class="ml-1">Khách hàng mới</span>
                                    </div>
                                    <div class="input-group mb-1 position-relative w-50">
                                        <input type="text" class="form-control"
                                            placeholder="Nhập thông tin khách hàng" aria-label="Username"
                                            aria-describedby="basic-addon1" id="myInput" autocomplete="off">
                                        <div class="position-absolute" style="right: 5px;top: 17%;">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M15.1835 7.36853C13.0254 5.21049 9.52656 5.21049 7.36853 7.36853C5.21049 9.52656 5.21049 13.0254 7.36853 15.1835C9.52656 17.3415 13.0254 17.3415 15.1835 15.1835C17.3415 13.0254 17.3415 9.52656 15.1835 7.36853ZM16.2441 6.30787C13.5003 3.56404 9.05169 3.56404 6.30787 6.30787C3.56404 9.05169 3.56404 13.5003 6.30787 16.2441C9.05169 18.988 13.5003 18.988 16.2441 16.2441C18.988 13.5003 18.988 9.05169 16.2441 6.30787Z"
                                                    fill="#555555" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M15.1796 15.1796C15.4725 14.8867 15.9474 14.8867 16.2403 15.1796L19.5303 18.4696C19.8232 18.7625 19.8232 19.2374 19.5303 19.5303C19.2374 19.8232 18.7625 19.8232 18.4696 19.5303L15.1796 16.2403C14.8867 15.9474 14.8867 15.4725 15.1796 15.1796Z"
                                                    fill="#555555" />
                                            </svg>
                                        </div>
                                    </div>
                                    <ul id="myUL"
                                        class="bg-white position-absolute rounded shadow p-0 scroll-data"
                                        style="z-index: 99;width:37%;">
                                        @foreach ($customer as $item)
                                            @if (Auth::user()->id == $item->user_id || Auth::user()->can('isAdmin'))
                                                <li class="p-2 search-info" id="{{ $item->id }}"
                                                    name="search-info"">
                                                    <a href="#" class="text-dark justify-content-between p-2">
                                                        <span class="w-50">{{ $item->guest_name }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- Form thông tin khách hàng --}}
            <section id="data-container" class="container-fluided bg-white rounded"></section>
            <section class="container-fluided bg-white rounded" id="form-edit">
                <div id="form-guest">
                    <div class="border-bottom p-3 d-flex justify-content-between align-items-center">
                        <b>Thông tin khách hàng</b>
                        @if ($exports->export_status == 1)
                            @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                                <button id="btn-customer" type="submit" class="btn btn-primary">
                                    <img src="../../dist/img/icon/Union.png">
                                    <span>Lưu thông tin</span></button>
                            @endif
                        @endif
                    </div>
                    <div class="row p-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="congty" class="required-label">Công ty:</label>
                                <input type="text" class="form-control" id="guest_name" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_name" value="{{ $guest->guest_name }}"
                                    required>
                                <input type="text" hidden class="form-control" id="id" name="id"
                                    value="{{ $guest->id }}">
                                <input type="hidden" name="updateClick" id="updateClick" value="">
                            </div>
                            <div class="form-group">
                                <label class="required-label">Địa chỉ:</label>
                                <input type="text" class="form-control" placeholder="Nhập thông tin"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> id="guest_address" name="guest_address"
                                    value="{{ $guest->guest_address }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="required-label">Mã số thuế:</label>
                                <input type="text" class="form-control" id="guest_code" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_code" value="{{ $guest->guest_code }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="guest_email" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_email"
                                    value="{{ $guest->guest_email }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Số điện thoại:</label>
                                <input type="text" class="form-control"
                                    pattern="^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$"
                                    id="guest_phone" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> placeholder="Nhập thông tin"
                                    name="guest_phone" value="{{ $guest->guest_phone }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Người nhận hàng:</label>
                                <input type="text" class="form-control" id="guest_receiver" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_receiver"
                                    value="{{ $guest->guest_receiver }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email cá nhân:</label>
                                <input type="text" class="form-control" id="guest_email_personal"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> placeholder="Nhập thông tin" name="guest_email_personal"
                                    value="{{ $guest->guest_email_personal }}">
                            </div>
                            <div class="form-group">
                                <label for="email">SĐT người nhận:</label>
                                <input type="text" class="form-control" id="guest_phoneReceiver"
                                    pattern="^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> placeholder="Nhập thông tin" name="guest_phoneReceiver"
                                    value="{{ $guest->guest_phoneReceiver }}">
                            </div>
                            <div class="form-group">
                                <label>Công nợ:</label>
                                <div class="d-flex align-items-center" style="width:101%;">
                                    <input type="text" class="form-control" id="debtInput" name="debt"
                                        value="{{ $guest->debt }}" style="width:15%;" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?>>
                                    <span class="ml-2" id="data-debt">ngày</span>
                                    <input type="checkbox" id="debtCheckbox" name="debt" <?php if ($guest->debt == 0) {
                                        echo 'checked';
                                    } ?>
                                        value="0" style="margin-left:10%;" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'disabled';
                                        } ?>>
                                    <span class="ml-2">Thanh toán tiền mặt</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Ghi chú:</label>
                                <input type="text" class="form-control" id="guest_note" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_note" value="{{ $guest->guest_note }}">
                            </div>
                        </div>
                    </div>
                    <div>
            </section>
            <div class="d-flex align-items-center my-2">
                <div class="">
                    <p class="m-0"><b>Số hóa đơn</b></p>
                    <input type="number" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                        echo 'readonly';
                    } ?> value="{{ $exports->export_code }}"
                        name="export_code" class="form-control" placeholder="Nhập thông tin">
                </div>
                <div class="pl-3">
                    <p class="m-0"><b>Ngày hóa đơn</b></p>
                    <input type="date" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                        echo 'readonly';
                    } ?> value="{{ $exports->created_at->format('Y-m-d') }}"
                        name="export_create" class="form-control">
                </div>
            </div>
            {{-- Bảng thêm sản phẩm --}}
            <div class="mt-4" style="overflow-x: auto;">
                <table class="table" id="sourceTable">
                    <thead class="bg-white border-0 rounded-top">
                        <tr>
                            <th style="width:3%;">STT</th>
                            <th style="width:30%;">Tên sản phẩm</th>
                            <th style="width:8%;">ĐVT</th>
                            <th style="width:8%">Số lượng</th>
                            <th style="width:12%;">Giá bán</th>
                            <th style="width:8%;">Thuế</th>
                            <th style="width:15%;">Thành tiền</th>
                            <th style="width:13%;">Ghi chú</th>
                            <th style="width:10%;"></th>
                            @if ($exports->export_status != 2)
                                <th style="width:10%;"></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 1; ?>
                        @foreach ($productExport as $index => $value_export)
                            <tr>
                                <td class="soTT"><?php echo $stt++; ?></td>
                                <td>
                                    @if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin')))
                                        <input type="text" title="{{ $value_export->product_name }}"
                                            class="form-control" readonly value="{{ $value_export->product_name }}">
                                        <select class="child-select p-1 form-control productName <?php if ($exports->export_status != 1) {
                                            echo 'd-none';
                                        } ?>"
                                            name="product_id[]" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                                echo 'disabled';
                                            } ?>>
                                            <option value="{{ $value_export->product_id }}">
                                                {{ $value_export->product_name }}
                                            </option>
                                            @foreach ($product_code as $value_code)
                                                <option value="{{ $value_code->id }}" class="<?php if ($value_code->id === $value_export->product_id) {
                                                    echo 'd-none';
                                                } ?>">
                                                    {{ $value_code->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                    @if ($exports->export_status == 1)
                                        <select class="child-select p-1 form-control productName" name="product_id[]"
                                            <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                                echo 'disabled';
                                            } ?>>
                                            <option value="{{ $value_export->product_id }}">
                                                {{ $value_export->product_name }}
                                            </option>
                                            @foreach ($product_code as $value_code)
                                                <option value="{{ $value_code->id }}" class="<?php if ($value_code->id === $value_export->product_id) {
                                                    echo 'd-none';
                                                } ?>">
                                                    {{ $value_code->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" id="product_unit" readonly
                                        class="product_unit form-control text-center" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?>
                                        value="{{ $value_export->product_unit }}" name="product_unit[]"
                                        required="">
                                </td>
                                <td>
                                    <div class='d-flex'>
                                        <input type="text" oninput="limitMaxEdit(this)" id="product_qty"
                                            class="quantity-input form-control text-center" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                                echo 'readonly';
                                            } ?>
                                            value="{{ $value_export->product_qty }}" name="product_qty[]"
                                            required="" style="width:50px;">
                                        <input type="text" readonly="" class="quantity-exist form-control"
                                            required=""
                                            value="/{{ $value_export->tonkho + $value_export->product_qty }}"
                                            style="width:50px;background:#D6D6D6;border:none;" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                                echo 'hidden';
                                            } ?>>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" id="product_price" name="product_price[]"
                                        class="form-control text-center product_price" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?>
                                        value=@if (fmod($value_export->product_price, 1) == 0) {{ number_format($value_export->product_price, 0, '.', ',') }}
                                        @else
                                        {{ number_format($value_export->product_price, 2, '.', ',') }} @endif
                                        required="">
                                </td>
                                <td>
                                    <select disabled name="product_tax[]" class="product_tax form-control text-center"
                                        style="width: 100px;" id="product_tax" required <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'disabled';
                                        } ?>>
                                        <option value="0" <?php if ($value_export->thue == 0) {
                                            echo 'selected';
                                        } ?>>0%</option>
                                        <option value="8" <?php if ($value_export->thue == 8) {
                                            echo 'selected';
                                        } ?>>8%</option>
                                        <option value="10" <?php if ($value_export->thue == 10) {
                                            echo 'selected';
                                        } ?>>10%</option>
                                        <option value="99" <?php if ($value_export->thue == 99) {
                                            echo 'selected';
                                        } ?>>NOVAT</option>
                                    </select>
                                </td>
                                <td><span class="total-amount form-control text-center"
                                        style="background:#e9ecef;">0</span>
                                </td>
                                <td>
                                    <input type="text" id="" name="product_note[]" class="form-control"
                                        <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?> value="{{ $value_export->product_note }}">
                                </td>
                                <td data-toggle='modal' data-target='#productModal' class='productMD'><img
                                        src="../../dist/img/icon/Group.png"></td>
                                @if ($exports->export_status == 1)
                                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                                        <td @if ($exports->export_status != 2) class="delete-row-btn" @endif>
                                            <img src="../../dist/img/icon/vector.png">
                                        </td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                        @if ($exports->export_status != 2)
                            <tr id="dynamic-fields"></tr>
                        @endif
                    </tbody>
                </table>
                @if ($exports->export_status == 1)
                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                        <div class="mb-2">
                            <span class="btn btn-secondary" id="add-field-btn">Thêm sản phẩm</span>
                        </div>
                    @endif
                @endif
            </div>
            <div class="row position-relative footer-total">
                <div class="col-sm-6">
                    {{-- <div class="mt-4 w-75" style="float: left;">
                        <b class="pl-2">*Ghi chú báo giá</b>
                        <div class="position-relative">
                            <input type="hidden" name="creator" id="creator" value="{{ Auth::user()->id }}">
                            <textarea name="note_form" id="note_form" class="form-control" rows="8" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                echo 'readonly';
                            } ?>>{{ $exports->note_form }}</textarea>
                            @if ($exports->export_status == 1)
                                <div id="btn-addNoteForm" class="disable">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.43364 3H8.07596H15.1555H15.3069C15.6265 3 15.943 3.06298 16.2382 3.18535C16.5335 3.30771 16.8017 3.48706 17.0276 3.71314L19.53 6.2155C19.9864 6.67177 20.2429 7.2907 20.243 7.93604V17.8227C20.243 18.4681 19.9866 19.0871 19.5303 19.5435C19.0739 19.9999 18.4549 20.2563 17.8095 20.2563L16.0466 20.2563H7.19724L5.52568 20.2563C4.8834 20.2563 4.26716 20.0024 3.8113 19.55C3.35544 19.0975 3.09692 18.4832 3.0921 17.8409L3.00007 5.45183C2.99767 5.13073 3.05883 4.81228 3.18005 4.51493C3.30127 4.21757 3.48014 3.94713 3.70636 3.71922C3.93258 3.4913 4.20167 3.31041 4.49812 3.18698C4.79456 3.06354 5.11253 2.99999 5.43364 3ZM7.86094 18.9289H15.3829V12.7662C15.3829 12.5041 15.17 12.2918 14.9095 12.2918H8.33527C8.07351 12.2918 7.86094 12.5044 7.86094 12.7662V18.9289ZM16.7103 18.9289V12.7662C16.7103 11.7716 15.9038 10.9644 14.9095 10.9644H8.33527C7.34041 10.9644 6.53354 11.7713 6.53354 12.7662V18.9289H5.52566C5.2337 18.9289 4.95359 18.8135 4.74638 18.6078C4.53918 18.4022 4.42167 18.1229 4.41947 17.831L4.32744 5.44187C4.32634 5.29591 4.35415 5.15118 4.40924 5.01601C4.46434 4.88085 4.54565 4.75792 4.64848 4.65432C4.7513 4.55072 4.87362 4.4685 5.00837 4.41239C5.14312 4.35629 5.28764 4.3274 5.43361 4.32741H7.41226V7.12292C7.41226 7.53364 7.57542 7.92755 7.86585 8.21797C8.15627 8.5084 8.55018 8.67156 8.9609 8.67156H14.2705C14.6812 8.67156 15.0751 8.5084 15.3656 8.21797C15.656 7.92755 15.8192 7.53364 15.8192 7.12292V4.45331C15.9184 4.50525 16.0094 4.57211 16.0889 4.65158L18.5915 7.15426C18.799 7.36162 18.9155 7.64302 18.9156 7.93632V17.8227C18.9156 18.1161 18.7991 18.3974 18.5916 18.6049C18.3842 18.8123 18.1028 18.9289 17.8095 18.9289H16.7103ZM14.4918 7.12292V4.32741H8.73967V7.12292C8.73967 7.18159 8.76297 7.23787 8.80446 7.27936C8.84595 7.32085 8.90223 7.34415 8.9609 7.34415H14.2705C14.3292 7.34415 14.3855 7.32085 14.427 7.27936C14.4684 7.23787 14.4918 7.18159 14.4918 7.12292Z"
                                            fill="#D6D6D6" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div> --}}
                </div>
                <div class="col-sm-6">
                    <div class="mt-4 w-50" style="float: right;">
                        <div class="d-flex justify-content-between">
                            <span><b>Giá trị trước thuế:</b></span>
                            <span id="total-amount-sum">0</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span><b>Thuế VAT:</b></span>
                            <span id="product-tax">0</span>
                        </div>
                        {{-- <div class="d-flex justify-content-between mt-2">
                            <span class="text-primary">Giảm giá:</span>
                            <span>0đ</span>
                        </div> --}}
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="text-primary">Phí vận chuyển:</span>
                            <div class="w-50">
                                <input type="text" class="form-control text-right"
                                    value="{{ number_format($exports->transport_fee) }}" name="transport_fee"
                                    id="transport_fee" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?>>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-lg"><b>Tổng cộng:</b></span>
                            <span><b id="grand-total" data-value="0">{{ number_format(0) }}</b></span>
                            <input type="text" hidden name="totalValue" value="" id="total">
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-fixed">
                @if ($exports->export_status == 1)
                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                        <button type="submit" value="action3" name="submitBtn" class="btn btn-primary mr-1"
                            onclick="validateAndSubmit(event)" id="luu">Lưu</button>
                    @endif
                @endif
                <a href="{{ route('exports.index') }}"><span class="btn border-secondary ml-1">Hủy</span></a>
            </div>
        </section>
    </form>
</div>
</form>
{{-- Modal Product --}}
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Thông tin sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="word-wrap: break-word">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
</section>
</div>
<script>
    // Thay đổi màu nút save note_form
    $(document).ready(function() {
        $('#note_form').on('input', function() {
            if ($(this).val().trim() !== '') {
                // Thêm class cho nút
                $('#btn-addNoteForm').removeClass('disable');
                $('#btn-addNoteForm').addClass('active');
            } else {
                $('#btn-addNoteForm').addClass('disable');
                $('#btn-addNoteForm').removeClass('active');
            }
        });
        if ($('#radio1:checked').length > 0) {
            $('#click').val(2);
            $('#updateClick').val(2);
            $('#checkguest').val(1);
        }
    });
    //Thêm form ghi chú cho nhân viên
    $(document).on('click', '#btn-addNoteForm', function(e) {
        e.preventDefault()
        var note_form = $('#note_form').val();
        var creator = $('#creator').val();
        $.ajax({
            url: '{{ route('addNoteFormSale') }}',
            type: 'GET',
            data: {
                note_form: note_form,
                creator: creator,
            },
            success: function(data) {
                alert('Lưu biểu mẫu thành công!');
            }
        });
    });
    //hiển thị thông tin sản phảm
    $('.productMD').on('click', function() {
        var idProduct = $(this).closest('tr').find('.productName').val();
        var productCode = $(this).closest('tr').find('.maProduct option:selected')
            .text();
        var productName = $(this).closest('tr').find('.productName option:selected')
            .text();
        var dvt = $(this).closest('tr').find('.product_unit').val();
        var ghiChu = $(this).closest('tr').find('.note_product')
            .val();
        var thue = $(this).closest('tr').find('.product_tax')
            .val();
        $.ajax({
            url: "{{ route('getProduct') }}",
            type: "get",
            data: {
                idProduct: idProduct,
            },
            success: function(response) {
                console.log(response);
                var productPrice = parseFloat(response.product_price);
                var formattedPrice;
                if (Number.isInteger(productPrice)) {
                    formattedPrice = numeral(productPrice).format('0,0');
                } else {
                    formattedPrice = numeral(productPrice).format('0,0.00');
                }
                $('#productModal').find('.modal-body').html('<b>Tên sản phẩm: </b> ' + productName +
                    '<br>' +
                    '<b>Tồn kho: </b>' + response.product_qty + '<br>' +
                    '<b>Đang giao dịch: </b>' +
                    (response.product_trade == null ? 0 : response.product_trade) +
                    '<br>' + '<b>Giá nhập: </b>' + formattedPrice + '<br>' + '<b>Thuế: </b>' +
                    (thue == 99 ? "NOVAT" : thue + "%"));
            },
        });
    });
    //form thong tin khach hang xuất hàng
    var radio1 = document.getElementById("radio1");
    var radio2 = document.getElementById("radio2");
    $("#radio1").on("click", function() {
        $('#data-container').empty();
        $('#form-edit').show();
        $('#form-guest').remove();
    });
    $("#radio2").on("click", function() {
        $('#data-container').html(
            '<div id="form-guest">' +
            '<div class="border-bottom p-3 d-flex justify-content-between align-items-center">' +
            '<b>Thông tin khách hàng</b>' +
            '<button id="btn-addCustomer" type="submit" class="btn btn-primary d-flex align-items-center">' +
            '<img src="../../dist/img/icon/Union.png">' +
            '<span class="ml-1">Lưu thông tin</span></button></div>' +
            '<input type="hidden" name="click" id="click" value="">' +
            '<div class="row p-3">' +
            '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<input type="text" hidden class="form-control" name="id" value="">' +
            '<label for="congty" class="required-label">Công ty:</label>' +
            '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label class="required-label">Địa chỉ:</label>' +
            '<input type="text" class="form-control" id="guest_address" placeholder="Nhập thông tin" name="guest_address" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label class="required-label">Mã số thuế:</label>' +
            '<input type="text" oninput="validateNumberInput(this)" class="form-control" id="guest_code" inputmode="numeric" placeholder="Nhập thông tin" name="guest_code" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Email:</label>' +
            '<input type="email" class="form-control" pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label>Số điện thoại:</label>' +
            '<input type="text" class="form-control" oninput="validateNumberInput(this)" pattern="/^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$/" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="">' +
            '</div>' + '</div>' + '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<label for="email">Người nhận hàng:</label>' +
            '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Email cá nhân:</label>' +
            '<input type="text" class="form-control" id="guest_email_personal" placeholder="Nhập thông tin" name="guest_email_personal" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">SĐT người nhận:</label>' +
            '<input type="text" oninput="validateNumberInput(this)" pattern="/^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$/" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="">' +
            '</div>' +
            '<div class="form-group">' +
            '<label>Công nợ:</label>' +
            '<div class="d-flex align-items-center" style="width:101%;">' +
            '<input type="text" oninput="validateNumberInput(this)" class="form-control" id="debtInput" value="0" name="debt" style="width:15%;">' +
            '<span class="ml-2" id="data-debt">ngày</span>' +
            '<input type="checkbox" checked id="debtCheckbox" value="0" style="margin-left:10%;">' +
            '<span class="ml-2">Thanh toán tiền mặt</span>' +
            '</div>' + '</div>' +
            '<div class="form-group">' +
            '<label for="email">Ghi chú:</label>' +
            '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="">' +
            '</div>' + '</div></div></div>'
        );
        //Công nợ
        var isChecked = $('#debtCheckbox').is(':checked');
        // Đặt trạng thái của input dựa trên checkbox
        $('#debtInput').prop('disabled', isChecked);
        // Xử lý sự kiện khi checkbox thay đổi
        $(document).on('change', '#debtCheckbox', function() {
            var isChecked = $(this).is(':checked');
            $('#debtInput').prop('disabled', isChecked);
            $('#debtInput').val(0);
        });
        $('#click').val(2);
        $('#updateClick').val(2);
        $('#checkguest').val(2);
        //Công nợ
        $(document).on('change', '#debtCheckbox', function() {
            if ($(this).is(':checked')) {
                $('#debtInput').prop('readonly', true);
                $('#debtInput').val(0);
                $("#data-debt").css("color", "#D6D6D6");
            } else {
                $('#debtInput').prop('readonly', false);
                $("#data-debt").css("color", "#1D1C20");
            }
        });
        $('#form-edit').remove();
    });
    //add sản phẩm
    $(document).ready(function() {
        let fieldCounter = 1;
        $("#add-field-btn").click(function() {
            let nextSoTT = $(".soTT").length + 1;
            const newRow = $("<tr>", {
                "id": `dynamic-row-${fieldCounter}`
            });
            const MaInput = $("<td>", {
                "class": "soTT",
                "text": nextSoTT
            });
            const ProInput = $("<td>" +
                "<select class='child-select p-1 productName form-control' required name='product_id[]'>" +
                "<option value=''>Lựa chọn sản phẩm</option>" +
                '@foreach ($product_code as $value)' +
                "<option value='{{ $value->id }}'>{{ $value->product_name }}</option>" +
                '@endforeach' +
                "</select>" +
                "</td>");
            const dvtInput = $(
                "<td><input type='text' readonly id='product_unit' class='product_unit form-control text-center' style='width:80px' name='product_unit[]' required></td>"
            );
            const slInput = $(
                "<td>" +
                "<div class='d-flex'>" +
                "<input type='text' oninput='limitMaxValue(this)' id='product_qty' class='quantity-input form-control text-center' name='product_qty[]' required style='width:50px;'>" +
                "<input type='text' readonly class='quantity-exist' required style='width:50px;background:#D6D6D6;border:none;'>" +
                "</div>" +
                "</td>"
            );
            const giaInput = $(
                "<td><input type='text' class='product_price form-control text-center' style='width:140px;' id='product_price' name='product_price[]' required></td>"
            );
            const thueInput = $("<td>" +
                "<select disabled name='product_tax[]' class='product_tax p-1 form-control text-center' style='width:100px' id='product_tax' required>" +
                "<option value='0'>0%</option>" +
                "<option value='8'>8%</option>" +
                "<option value='10'>10%</option>" +
                "<option value='99'>NOVAT</option>" +
                "</select>" +
                "</td>");
            const thanhTienInput = $(
                "<td><span class='total-amount form-control text-center' style='background:#e9ecef; width:140px'>0</span></td>"
            );
            const ghichuInput = $(
                "<td><input type='text' class='note_product form-control text-left' name='product_note[]'></td>"
            );
            const info = $(
                "<td data-toggle='modal' data-target='#productModal'><img src='../../dist/img/icon/Group.png'></td>"
            );
            const deleteBtn = $("<td><img src='../../dist/img/icon/vector.png'></td>", {
                "class": "delete-row-btn"
            });
            const option = $(
                "<td style='display:none;'><input type='number' class='price_import'></td>" +
                "<td style='display:none;'><input type='text' class='tonkho'></td>" +
                "<td style='display:none;'><input type='text' class='loaihang'></td>" +
                "<td style='display:none;'><input type='text' class='dangGD'></td>" +
                "<td style='display:none;'><input type='text' class='product_tax1'></td>"
            );
            deleteBtn.click(function() {
                var row = $(this).closest("tr");
                var selectedID = row.find('.child-select').val();

                // Kiểm tra nếu ID sản phẩm đang bị xóa có trong mảng selectedProductIDs
                var index = selectedProductIDs.indexOf(selectedID);
                if (index !== -1) {
                    selectedProductIDs.splice(index, 1); // Xóa ID sản phẩm khỏi mảng
                }
                row.remove();
                $(this).closest("tr").remove();
                updateSTT();
                calculateGrandTotal();
                calculateTotals();
                var selectedID = row.find('.child-select').val();

                // Kiểm tra nếu ID sản phẩm đang bị xóa có trong mảng selectedProductIDs
                var index = selectedProductIDs.indexOf(selectedID);
                if (index !== -1) {
                    selectedProductIDs.splice(index, 1); // Xóa ID sản phẩm khỏi mảng
                }
            });
            //xem thông tin sản phẩm
            info.click(function() {
                var idProduct = $(this).closest('tr').find('.productName').val();
                var productCode = $(this).closest('tr').find('.maProduct option:selected')
                    .text();
                var productName = $(this).closest('tr').find('.productName option:selected')
                    .text();
                var dvt = $(this).closest('tr').find('.product_unit').val();
                var ghiChu = $(this).closest('tr').find('.note_product')
                    .val();
                var thue = $(this).closest('tr').find('.product_tax')
                    .val();
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    type: "get",
                    data: {
                        idProduct: idProduct,
                    },
                    success: function(response) {
                        var productPrice = parseFloat(response.product_price);
                        var formattedPrice;
                        if (Number.isInteger(productPrice)) {
                            formattedPrice = numeral(productPrice).format('0,0');
                        } else {
                            formattedPrice = numeral(productPrice).format('0,0.00');
                        }
                        $('#productModal').find('.modal-body').html(
                            '<b>Tên sản phẩm: </b> ' + productName +
                            '<br>' +
                            '<b>Tồn kho: </b>' + response.product_qty + '<br>' +
                            '<b>Đang giao dịch: </b>' +
                            (response.product_trade == null ? 0 : response
                                .product_trade) +
                            '<br>' + '<b>Giá nhập: </b>' + formattedPrice +
                            '<br>' + '<b>Thuế: </b>' +
                            (thue == 99 || thue == null ? "NOVAT" : thue + '%'));
                    },
                });
            });
            newRow.append(MaInput, ProInput, dvtInput, slInput,
                giaInput, thueInput, thanhTienInput, ghichuInput, info, deleteBtn, option);
            $("#dynamic-fields").before(newRow);
            fieldCounter++;
        });

        function updateSTT() {
            $(".soTT").each(function(index) {
                $(this).text(index + 1);
            });
        }
        //xóa sản phẩm
        $(document).on("click", ".delete-row-btn", function() {
            var grandTotal = parseFloat($('#grand-total').attr('data-value'));
            var deletedAmount = parseFloat($(this).closest('tr').find('.total-amount').text());
            $(this).closest('tr').remove();
            var newGrandTotal = grandTotal - deletedAmount;
            $('#grand-total').text(newGrandTotal.toFixed(2));
            $('#grand-total').attr('data-value', newGrandTotal.toFixed(2));
            updateSTT();
            calculateGrandTotal();
            calculateTotals();
            var row = $(this).closest("tr");
            var selectedID = row.find('.child-select').val();

            // Kiểm tra nếu ID sản phẩm đang bị xóa có trong mảng selectedProductIDs
            var index = selectedProductIDs.indexOf(selectedID);
            if (index !== -1) {
                selectedProductIDs.splice(index, 1); // Xóa ID sản phẩm khỏi mảng
            }
            row.remove();
        });

        //hiện danh sách khách hàng khi click trường tìm kiếm
        $("#myUL").hide();
        $("#myInput").on("click", function() {
            $("#myUL").show();
        });
        //ẩn danh sách khách hàng
        $(document).click(function(event) {
            if (!$(event.target).closest("#myInput").length) {
                $("#myUL").hide();
            }
        });
    });

    //cho phép nhập số 
    function validateNumberInput(input) {
        var regex = /^[0-9]*$/;
        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    }

    //giới hạn số lượng nhập của thêm sản phẩm mới
    function limitMaxValue(input) {
        var regex = /^[1-9][0-9]*$/;
        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^1-9]*$/g, '');
        }
        var value = input.value;
        var product_id = $(input).closest('tr').find('.productName').val();
        if (isNaN(value) || value <= 0) {
            return;
        }

        // Gửi dữ liệu qua AJAX
        $.ajax({
            url: "{{ route('limit_qty') }}",
            type: 'GET',
            data: {
                product_id: product_id,
            },
            success: function(response) {
                var maxLimit = response.qty_exist;
                if (value > maxLimit) {
                    input.value = maxLimit;
                }
            }
        });
    }
    //giới hạn số lượng nhập của edit sản phẩm
    function limitMaxEdit(input) {
        var regex = /^[1-9][0-9]*$/;
        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^1-9]*$/g, '');
        }
        var value = input.value;
        var product_id = $(input).closest('tr').find('.productName').val();
        var qty_exist = $(input).closest('tr').find('.quantity-exist').val();
        qty_exist = qty_exist.replace('/', '');
        if (isNaN(value) || value <= 0) {
            return;
        }
        var maxLimit = parseInt(qty_exist);
        if (value > maxLimit) {
            input.value = maxLimit;
        }
    }

    //search thông tin khách hàng
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#myUL li").each(function() {
                var text = $(this).find("a").text().toUpperCase();
                $(this).toggle(text.indexOf(value) > -1);
            });
        });
    });
    //hiển thị thông tin khách hàng
    $(document).ready(function() {
        $('.search-info').click(function() {
            var idCustomer = $(this).attr('id');
            $('#checkguest').val(1);
            $('#form-edit').remove();
            $('#radio1').prop('checked', true);
            $.ajax({
                url: '{{ route('searchExport') }}',
                type: 'GET',
                data: {
                    idCustomer: idCustomer
                },
                success: function(data) {
                    $('#data-container').html(
                        '<div id="form-guest">' +
                        '<div class="border-bottom p-3 d-flex justify-content-between align-items-center">' +
                        '<b>Thông tin khách hàng</b>' +
                        '<button id="btn-customer" type="submit" class="btn btn-primary d-flex align-items-center">' +
                        '<img src="../../dist/img/icon/Union.png">' +
                        '<span class="ml-1">Lưu thông tin</span></button></div>' +
                        '<div class="row p-3">' +
                        '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<input type="text" hidden class="form-control" id="id" name="id" value="' +
                        data.id + '" required>' +
                        '<input type="hidden" name="updateClick" id="updateClick" value="">' +
                        '<label for="congty" class="required-label">Công ty:</label>' +
                        '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="' +
                        data.guest_name + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label class="required-label">Địa chỉ:</label>' +
                        '<input type="text" class="form-control" placeholder="Nhập thông tin" id="guest_address" name="guest_address" value="' +
                        data.guest_address + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email" class="required-label">Mã số thuế:</label>' +
                        '<input type="text" oninput="validateNumberInput(this)" class="form-control" inputmode="numeric" id="guest_code" placeholder="Nhập thông tin" name="guest_code" value="' +
                        data.guest_code + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Email:</label>' +
                        '<input type="email" class="form-control" pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="' +
                        (data.guest_email == null ? '' : data.guest_email) + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label>Số điện thoại:</label>' +
                        '<input type="text" class="form-control" oninput="validateNumberInput(this)" pattern="/^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$/" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="' +
                        (data.guest_phone == null ? '' : data.guest_phone) + '">' +
                        '</div>' + '</div>' + '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<label for="email">Người nhận hàng:</label>' +
                        '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="' +
                        (data.guest_receiver == null ? '' : data.guest_receiver) +
                        '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Email cá nhân:</label>' +
                        '<input type="text" class="form-control" id="guest_email_personal" placeholder="Nhập thông tin" name="guest_email_personal" value="' +
                        (data.guest_email_personal == null ? '' : data
                            .guest_email_personal) + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">SĐT người nhận:</label>' +
                        '<input type="text" oninput="validateNumberInput(this)" pattern="/^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$/" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="' +
                        (data.guest_phoneReceiver == null ? '' : data
                            .guest_phoneReceiver) + '">' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label>Công nợ:</label>' +
                        '<div class="d-flex align-items-center" style="width:101%;">' +
                        '<input type="text" name="debt" oninput="validateNumberInput(this)" class="form-control" pattern="^[0-9]+$" id="debtInput" value="' +
                        (data.debt) + '" style="width:15%;">' +
                        '<span class="ml-2" id="data-debt">ngày</span>' +
                        '<input type="checkbox" id="debtCheckbox" value="0" ' + (data
                            .debt == 0 ? 'checked' : '') +
                        ' style="margin-left:10%;">' +
                        '<span class="ml-2">Thanh toán tiền mặt</span>' +
                        '</div>' + '</div>' + '<div class="form-group">' +
                        '<label for="email">Ghi chú:</label>' +
                        '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="' +
                        (data.guest_note == null ? '' : data.guest_note) + '">' +
                        '</div>' + '</div></div><div>'
                    );
                    $('#click').val(null);
                    $('#updateClick').val(2);
                    //Công nợ
                    var isChecked = $('#debtCheckbox').is(':checked');
                    // Đặt trạng thái của input dựa trên checkbox
                    $('#debtInput').prop('disabled', isChecked);
                    // Xử lý sự kiện khi checkbox thay đổi
                    $(document).on('change', '#debtCheckbox', function() {
                        var isChecked = $(this).is(':checked');
                        $('#debtInput').prop('disabled', isChecked);
                        $('#debtInput').val(0);
                    });
                }
            });
        });
    });
    //Công nợ
    var isChecked = $('#debtCheckbox').is(':checked');
    // Đặt trạng thái của input dựa trên checkbox
    $('#debtInput').prop('disabled', isChecked);
    // Xử lý sự kiện khi checkbox thay đổi
    $(document).on('change', '#debtCheckbox', function() {
        var isChecked = $(this).is(':checked');
        $('#debtInput').prop('disabled', isChecked);
        $('#debtInput').val(0);
    });
    //cập nhật thông tin khách hàng
    $(document).on('click', '#btn-customer', function(e) {
        e.preventDefault();
        var form = $('#export_form')[0];
        if (!form.reportValidity()) {
            return;
        }
        $('#updateClick').val(1);
        var updateClick = $('#updateClick').val();
        var id = $('#id').val();
        var guest_name = $('#guest_name').val();
        var guest_address = $('#guest_address').val();
        var guest_code = $('#guest_code').val();
        var guest_addressDeliver = $('#guest_addressDeliver').val();
        var guest_receiver = $('#guest_receiver').val();
        var guest_phoneReceiver = $('#guest_phoneReceiver').val();
        var guest_email = $('#guest_email').val();
        var guest_email_personal = $('#guest_email_personal').val();
        var guest_phone = $('#guest_phone').val();
        var guest_pay = $('#guest_pay').val();
        var guest_note = $('#guest_note').val();
        var debt = "";
        if ($('#debtCheckbox').is(':checked')) {
            debt = "0";
            $('#debtInput').prop('disabled', true);
            $('#debtInput').val(0);
        } else {
            debt = $('#debtInput').val();
            $('#debtInput').prop('disabled', false);
        }

        $.ajax({
            url: "{{ route('updateCustomer') }}",
            type: "get",
            data: {
                id: id,
                guest_name,
                guest_address,
                guest_code,
                guest_addressDeliver,
                guest_receiver,
                guest_phoneReceiver,
                guest_email,
                guest_phone,
                guest_pay,
                guest_note,
                guest_email_personal,
                updateClick,
                debt
            },
            success: function(data) {
                if (data.hasOwnProperty('message')) {
                    alert(data.message); // Hiển thị thông báo đã tồn tại
                } else if (data.hasOwnProperty('id')) {
                    alert('Lưu thông tin thành công');
                }
            }
        })
    })
    //thêm thông tin khách hàng
    $(document).on('click', '#btn-addCustomer', function(e) {
        e.preventDefault();
        var form = $('#export_form')[0];
        if (!form.reportValidity()) {
            return;
        }
        $('#click').val(1);
        var click = $('#click').val();
        var guest_name = $('#guest_name').val();
        var guest_address = $('#guest_address').val();
        var guest_code = $('#guest_code').val();
        var guest_addressDeliver = $('#guest_addressDeliver').val();
        var guest_receiver = $('#guest_receiver').val();
        var guest_phoneReceiver = $('#guest_phoneReceiver').val();
        var guest_email = $('#guest_email').val();
        var guest_phone = $('#guest_phone').val();
        var guest_email_personal = $('#guest_email_personal').val();
        var guest_pay = $('#guest_pay').val();
        var guest_note = $('#guest_note').val();
        var debt = "";
        if ($('#debtCheckbox').is(':checked')) {
            debt = "0";
            $('#debtInput').prop('disabled', true);
            $('#debtInput').val(0);
        } else {
            debt = $('#debtInput').val();
            $('#debtInput').prop('disabled', false);
        }

        $.ajax({
            url: "{{ route('addCustomer') }}",
            type: "get",
            data: {
                guest_name,
                guest_address,
                guest_code,
                guest_addressDeliver,
                guest_receiver,
                guest_phoneReceiver,
                guest_email,
                guest_phone,
                guest_pay,
                guest_note,
                guest_email_personal,
                click,
                debt
            },
            success: function(data) {
                if (data.hasOwnProperty('message')) {
                    alert(data.message); // Hiển thị thông báo đã tồn tại
                } else if (data.hasOwnProperty('id')) {
                    alert('Thêm thông tin thành công');
                    $('#form-guest input[name="id"]').val(data.id);
                }
            }
        });
    });
    //lấy thông tin sản phẩm
    var selectedProductIDs = [];
    $(document).ready(function() {
        // Lấy tất cả các phần tử đang được chọn theo class "productName"
        var selectedProducts = document.querySelectorAll(".productName");
        // Lặp qua từng phần tử và lấy giá trị của nó
        selectedProducts.forEach(function(product) {
            selectedProductIDs.push(product.value);
        });

        $(document).on('change', '.child-select', function() {
            var selectedID = $(this).val();
            var row = $(this).closest('tr');
            var productNameElement = $(this).closest('tr').find('.product_name');
            var productUnitElement = $(this).closest('tr').find('.product_unit');
            var qty_exist = $(this).closest('tr').find('.quantity-exist');
            var price_import = $(this).closest('tr').find('.price_import');
            var tonkho = $(this).closest('tr').find('.tonkho');
            var loaihang = $(this).closest('tr').find('.loaihang');
            var dangGD = $(this).closest('tr').find('.dangGD');
            var thue = $(this).closest('tr').find('.product_tax');
            $(this).closest('tr').find('.quantity-input').val(null);
            if (selectedID) {
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    type: "get",
                    data: {
                        idProduct: selectedID,
                    },
                    success: function(response) {
                        productNameElement.val(response
                            .product_name); // Hiển thị tên sản phẩm đã chọn trong ô input
                        productUnitElement.val(response.product_unit);
                        qty_exist.val("/" + response.qty_exist);
                        var productPrice = parseFloat(response.product_price);
                        var formattedPrice;
                        if (Number.isInteger(productPrice)) {
                            formattedPrice = numeral(productPrice).format('0,0');
                        } else {
                            formattedPrice = numeral(productPrice).format('0,0.00');
                        }
                        price_import.val(formattedPrice);
                        tonkho.val(response.product_qty);
                        loaihang.val(response.product_category);
                        dangGD.val(response.product_trade == null ? 0 : response
                            .product_trade);
                        thue.val(response.product_tax);
                        calculateGrandTotal();
                        calculateGrandTotalWithTransportFee();
                    },
                });
            }

            // Kiểm tra nếu ID sản phẩm đã chọn đã có trong danh sách các sản phẩm đã chọn
            if (selectedProductIDs.includes(selectedID)) {
                $(this).val(''); // Đặt giá trị của tùy chọn thành trống
                var productNameElement = $(this).closest('tr').find('.product_name');
                productNameElement.prop('disabled', true); // Disable ô input chứa tên sản phẩm
                alert('Sản phẩm này đã được thêm trước đó, vui lòng chọn sản phẩm khác');

                // Kiểm tra nếu giá trị data-previous-id là null, thì bỏ qua bước kiểm tra tiếp theo
                if ($(this).data('previous-id') !== null) {
                    var previousID = $(this).data('previous-id'); // Lấy ID trước đó của tùy chọn
                    var index = selectedProductIDs.indexOf(previousID);
                    if (index !== -1) {
                        selectedProductIDs.splice(index, 1); // Xóa ID trước đó khỏi mảng
                    }
                }

                // Đặt giá trị data-previous-id thành null để cho phép chọn lại sản phẩm ban đầu
                $(this).data('previous-id', null);
            } else {
                var previousID = $(this).data('previous-id'); // Lấy ID trước đó của tùy chọn
                if (previousID && previousID !== selectedID) {
                    var index = selectedProductIDs.indexOf(previousID);
                    if (index !== -1) {
                        selectedProductIDs.splice(index, 1); // Xóa ID trước đó khỏi mảng
                    }
                }

                selectedProductIDs.push(selectedID); // Lưu ID sản phẩm đã chọn vào mảng
                $(this).data('previous-id',
                    selectedID); // Lưu ID hiện tại vào thuộc tính data của tùy chọn

                hideSelectedProductNames(row); // Ẩn tên sản phẩm đã chọn từ các tùy chọn khác
            }
        });

        // Function to hide selected product names from other child select options
        function hideSelectedProductNames(row) {
            var selectedIDs = row.find('.child-select').map(function() {
                return $(this).val();
            }).get();

            row.find('.child-select').each(function() {
                var currentID = $(this).val();
                $(this).find('option').each(function() {
                    if ($(this).val() !== currentID && selectedIDs.includes($(this).val())) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        }
    });
    //tính thành tiền của sản phẩm
    $(document).ready(function() {
        calculateTotals();
        calculateGrandTotalWithTransportFee();
    });

    $(document).on('input', '.quantity-input, [name^="product_price"], .product_tax', function() {
        calculateTotals();
        calculateGrandTotalWithTransportFee();
    });

    function calculateTotals() {
        var totalAmount = 0;
        var totalTax = 0;

        // Lặp qua từng hàng
        $('tr').each(function() {
            var productQty = parseInt($(this).find('.quantity-input').val());
            var productPriceElement = $(this).find('[name^="product_price"]');
            var productPrice = 0;
            var taxValue = parseFloat($(this).find('.product_tax option:selected').val());
            if (taxValue == 99) {
                taxValue = 0;
            }
            if (productPriceElement.length > 0) {
                var rawPrice = productPriceElement.val();
                if (rawPrice !== "") {
                    productPrice = parseFloat(rawPrice.replace(/,/g, ''));
                }
            }

            if (!isNaN(productQty) && !isNaN(productPrice) && !isNaN(taxValue)) {
                var rowTotal = productQty * productPrice;
                var rowTax = (rowTotal * taxValue) / 100;

                // Làm tròn từng thuế
                rowTax = Math.round(rowTax);
                $(this).find('.product_tax1').text(formatCurrency(rowTax));

                // Hiển thị kết quả
                $(this).find('.total-amount').text(formatCurrency(Math.round(rowTotal)));

                // Cộng dồn vào tổng totalAmount và totalTax
                totalAmount += rowTotal;
                totalTax += rowTax;
            }
        });

        // Hiển thị tổng totalAmount và totalTax
        $('#total-amount-sum').text(formatCurrency(Math.round(totalAmount)));
        $('#product-tax').text(formatCurrency(Math.round(totalTax)));

        // Tính tổng thành tiền và thuế
        calculateGrandTotal(totalAmount, totalTax);
    }

    function calculateGrandTotal(totalAmount, totalTax) {
        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(formatCurrency(Math.round(grandTotal)));

        // Cập nhật giá trị data-value
        $('#grand-total').attr('data-value', grandTotal);
        $('#total').val(totalAmount);
    }

    function calculateGrandTotalWithTransportFee() {
        var totalAmount = parseFloat($('#total-amount-sum').text().replace(/[^0-9.-]+/g, ''));
        var totalTax = parseFloat($('#product-tax').text().replace(/[^0-9.-]+/g, ''));

        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(formatCurrency(grandTotal.toFixed(2)));

        // Update the input value with the grand total
        $('#total').val(totalAmount);
    }

    function formatCurrency(value) {
        // Làm tròn đến 2 chữ số thập phân
        value = Math.round(value * 100) / 100;

        // Xử lý phần nguyên
        var parts = value.toString().split(".");
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
        }

        return formattedValue;
    }

    var isSubmitting = false;

    // Hàm chặn alert trong phạm vi trang hiện tại
    function blockAlertInCurrentPage() {
        var backupAlert = window.alert;
        window.alert = function() {
            return true;
        };
        return backupAlert;
    }

    function validateAndSubmit(event) {
        var formGuest = $('#form-guest');
        var productList = $('.productName');
        var checkguest = $('#checkguest').val();

        if (formGuest.length && productList.length > 0) {
            $('.product_price, [name^="product_price"], #transport_fee').each(function() {
                var newValue = $(this).val().replace(/,/g, '');
                $(this).val(newValue);
            });

            // Đánh dấu trạng thái đang submit
            isSubmitting = true;
            var restoreAlert = blockAlertInCurrentPage();
            $('#btn-customer').click();

            // Đánh dấu trạng thái đã hoàn thành submit
            isSubmitting = false;
            window.alert = restoreAlert;
        } else {
            if (formGuest.length === 0) {
                alert('Lỗi: Chưa nhập thông tin khách hàng!');
            } else if (productList.length === 0) {
                alert('Lỗi: Chưa thêm sản phẩm!');
            }
            event.preventDefault();
        }
    }

    // Hàm kiểm tra khi có alert được gọi
    function checkAlert() {
        // Chặn alert nếu đang trong quá trình submit
        if (isSubmitting) {
            return true;
        } else {
            // Nếu không đang submit, cho phép alert bình thường
            return false;
        }
    }

    // Gán hàm kiểm tra alert vào window.alert
    window.alert = checkAlert;

    //format giá
    var inputElement = document.getElementById('product_price');
    $('body').on('input', '.product_price,#transport_fee', function(event) {
        // Lấy giá trị đã nhập
        var value = event.target.value;

        // Xóa các ký tự không phải số và dấu phân thập phân từ giá trị
        var formattedValue = value.replace(/[^0-9.]/g, '');

        // Định dạng số với dấu phân cách hàng nghìn và giữ nguyên số thập phân
        var formattedNumber = numberWithCommas(formattedValue);

        event.target.value = formattedNumber;
    });

    function numberWithCommas(number) {
        // Chia số thành phần nguyên và phần thập phân
        var parts = number.split('.');
        var integerPart = parts[0];
        var decimalPart = parts[1];

        // Định dạng phần nguyên số với dấu phân cách hàng nghìn
        var formattedIntegerPart = integerPart.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        // Kết hợp phần nguyên và phần thập phân (nếu có)
        var formattedNumber = decimalPart !== undefined ? formattedIntegerPart + '.' + decimalPart :
            formattedIntegerPart;

        return formattedNumber;
    }

    //ngăn chặn click
    $(document).ready(function() {
        $('#chot_don').on('click', function() {
            var selects = document.getElementsByTagName("select");

            for (var j = 0; j < selects.length; j++) {
                selects[j].removeAttribute("disabled");
            }
            var $button = $(this);

            if (!$button.hasClass('disabled')) {
                $button.addClass('disabled');
                setTimeout(function() {
                    $button.removeClass('disabled');
                }, 1000);
            } else {
                event.preventDefault();
            }
        });
        $('#luu').on('click', function() {
            var selects = document.getElementsByTagName("select");

            for (var j = 0; j < selects.length; j++) {
                selects[j].removeAttribute("disabled");
            }
            var $button = $(this);

            if (!$button.hasClass('disabled')) {
                $button.addClass('disabled');
                setTimeout(function() {
                    $button.removeClass('disabled');
                }, 1000);
            } else {
                event.preventDefault();
            }
        });
        $('#huy').on('click', function() {
            var selects = document.getElementsByTagName("select");

            for (var j = 0; j < selects.length; j++) {
                selects[j].removeAttribute("disabled");
            }
            var $button = $(this);

            if (!$button.hasClass('disabled')) {
                $button.addClass('disabled');
                setTimeout(function() {
                    $button.removeClass('disabled');
                }, 1000);
            } else {
                event.preventDefault();
            }
        });
        $('#huydon').on('click', function() {
            var selects = document.getElementsByTagName("select");

            for (var j = 0; j < selects.length; j++) {
                selects[j].removeAttribute("disabled");
            }
            var $button = $(this);

            if (!$button.hasClass('disabled')) {
                $button.addClass('disabled');
                setTimeout(function() {
                    $button.removeClass('disabled');
                }, 1000);
            } else {
                event.preventDefault();
            }
        });
    });
</script>
</body>

</html>
