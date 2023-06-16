<x-navbar :title="$title"></x-navbar>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 breadcrumb">
            <span><a href="{{ route('exports.index') }}">Xuất hàng</a></span>
            <span class="px-1">/</span>
            <span><b>Chi tiết đơn hàng</b></span>
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
        <section class="content">
            <div class="d-flex mb-1 action-don">
                @if ($exports->export_status == 1)
                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                        <button type="submit" class="btn btn-danger text-white" name="submitBtn"
                            value="action1" onclick="validateAndSubmit(event)">Chốt
                            đơn</button>
                        <button type="submit" class="btn btn-secondary mx-4" name="submitBtn" value="action2" onclick="validateAndSubmit(event)">Hủy
                            đơn</button>
                    @endif
                @endif
                {{-- <a href="#" class="btn border border-secondary mr-4">Xuất file</a> --}}
                <a href="#" class="btn border border-secondary mr-4">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 5C8.46957 5 7.96086 5.21071 7.58579 5.58579C7.21071 5.96086 7 6.46957 7 7V8H17V7C17 6.46957 16.7893 5.96086 16.4142 5.58579C16.0391 5.21071 15.5304 5 15 5H9ZM15 13H9C8.73478 13 8.48043 13.1054 8.29289 13.2929C8.10536 13.4804 8 13.7348 8 14V17C8 17.2652 8.10536 17.5196 8.29289 17.7071C8.48043 17.8946 8.73478 18 9 18H15C15.2652 18 15.5196 17.8946 15.7071 17.7071C15.8946 17.5196 16 17.2652 16 17V14C16 13.7348 15.8946 13.4804 15.7071 13.2929C15.5196 13.1054 15.2652 13 15 13Z"
                            fill="#555555" />
                        <path
                            d="M4 11C4 10.4696 4.21071 9.96086 4.58579 9.58579C4.96086 9.21071 5.46957 9 6 9H18C18.5304 9 19.0391 9.21071 19.4142 9.58579C19.7893 9.96086 20 10.4696 20 11V14C20 14.5304 19.7893 15.0391 19.4142 15.4142C19.0391 15.7893 18.5304 16 18 16H17V14C17 13.4696 16.7893 12.9609 16.4142 12.5858C16.0391 12.2107 15.5304 12 15 12H9C8.46957 12 7.96086 12.2107 7.58579 12.5858C7.21071 12.9609 7 13.4696 7 14V16H6C5.46957 16 4.96086 15.7893 4.58579 15.4142C4.21071 15.0391 4 14.5304 4 14V11ZM6.5 12C6.63261 12 6.75979 11.9473 6.85355 11.8536C6.94732 11.7598 7 11.6326 7 11.5C7 11.3674 6.94732 11.2402 6.85355 11.1464C6.75979 11.0527 6.63261 11 6.5 11C6.36739 11 6.24021 11.0527 6.14645 11.1464C6.05268 11.2402 6 11.3674 6 11.5C6 11.6326 6.05268 11.7598 6.14645 11.8536C6.24021 11.9473 6.36739 12 6.5 12Z"
                            fill="#555555" />
                    </svg>
                    In báo giá
                </a>
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
                                    <ul id="myUL" class="bg-white position-absolute w-50 rounded shadow p-0"
                                        style="z-index: 99;">
                                        @foreach ($customer as $item)
                                            <li>
                                                <a href="#"
                                                    class="text-dark d-flex justify-content-between p-2 search-info"
                                                    id="{{ $item->id }}" name="search-info">
                                                    <span>{{ $item->guest_represent }}</span>
                                                    <span class="mr-5">{{ $item->guest_name }}</span>
                                                </a>
                                            </li>
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
                                <input type="text" hidden class="form-control" id="id" name="id"
                                    value="{{ $guest->id }}" required>
                                <label for="congty">Công ty:</label>
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
                                <label>Địa chỉ xuất hóa đơn:</label>
                                <input type="text" class="form-control" placeholder="Nhập thông tin"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> id="guest_addressInvoice" name="guest_addressInvoice"
                                    value="{{ $guest->guest_addressInvoice }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Mã số thuế:</label>
                                <input type="text" class="form-control" id="guest_code" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_code" value="{{ $guest->guest_code }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Địa chỉ giao hàng:</label>
                                <input type="text" class="form-control" id="guest_addressDeliver"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> placeholder="Nhập thông tin" name="guest_addressDeliver"
                                    value="{{ $guest->guest_addressDeliver }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Người nhận hàng:</label>
                                <input type="text" class="form-control" id="guest_receiver" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_receiver"
                                    value="{{ $guest->guest_receiver }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">SĐT người nhận:</label>
                                <input type="text" class="form-control" id="guest_phoneReceiver"
                                    pattern="^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> placeholder="Nhập thông tin" name="guest_phoneReceiver"
                                    value="{{ $guest->guest_phoneReceiver }}" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">Người đại diện:</label>
                                <input type="text" class="form-control" id="guest_represent" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_represent"
                                    value="{{ $guest->guest_represent }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="guest_email" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                    echo 'readonly';
                                } ?>
                                    placeholder="Nhập thông tin" name="guest_email"
                                    value="{{ $guest->guest_email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Số điện thoại:</label>
                                <input type="text" class="form-control"
                                    pattern="^(0|\+84)(3[2-9]|5[2689]|7[0|6-9]|8[1-9]|9[0-9])\d{7,9}$"
                                    id="guest_phone" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'readonly';
                                    } ?> placeholder="Nhập thông tin"
                                    name="guest_phone" value="{{ $guest->guest_phone }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Hình thức thanh toán:</label>
                                <select name="guest_pay" required class="form-control" id="guest_pay"
                                    <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                        echo 'disabled';
                                    } ?>>
                                    <option value="0" <?php if ($guest->guest_pay == 0) {
                                        echo 'selected';
                                    } ?>>Chuyển khoản</option>
                                    <option value="1" <?php if ($guest->guest_pay == 1) {
                                        echo 'selected';
                                    } ?>>Thanh toán bằng tiền mặt</option>
                                </select>
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
            {{-- Bảng thêm sản phẩm --}}
            <div class="mt-4" style="overflow-x: auto;">
                <table class="table">
                    <thead class="bg-white border-0 rounded-top">
                        <tr>
                            @if ($exports->export_status == 1)
                                @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                                    <th><input type="checkbox"></th>
                                @endif
                            @endif
                            <th>STT</th>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>ĐVT</th>
                            <th>Số lượng</th>
                            <th>Giá bán</th>
                            <th>Ghi chú</th>
                            <th>Thuế</th>
                            <th>Thành tiền</th>
                            <th>S/N</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 1; ?>
                        @foreach ($productExport as $index => $value_export)
                            <tr id="dynamic-row-{{ $index }}">
                                @if ($exports->export_status == 1)
                                    @if (Auth::user()->id == $exports->user_id || Auth::user()->can('isAdmin'))
                                        <td><input type="checkbox"></td>
                                    @endif
                                @endif
                                <td class="soTT"><?php echo $stt++; ?></td>
                                <td>
                                    <select id="maProduct" class="p-1 maProduct form-control" name="products_id[]"
                                        <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'disabled';
                                        } ?>>
                                        @foreach ($product_code as $value_code)
                                            <option value="{{ $value_code->id }}"
                                                @if ($value_export->products_id == $value_code->id) selected @endif>
                                                {{ $value_code->products_code }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="child-select p-1 form-control productName" name="product_id[]"
                                        <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'disabled';
                                        } ?>>
                                        <option value="{{ $value_export->product_id }}">
                                            {{ $value_export->product_name }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="product_unit" style="width: 80px"
                                        class="product_unit form-control text-center" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?>
                                        value="{{ $value_export->product_unit }}" name="product_unit[]"
                                        required="">
                                </td>
                                <td>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        id="product_qty" class="quantity-input form-control text-center"
                                        <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?> value="{{ $value_export->product_qty }}"
                                        name="product_qty[]" required="">
                                </td>
                                <td>
                                    <input type="text" id="product_price" name="product_price[]"
                                        class="form-control text-center product_price" style="width: 140px"
                                        <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?> value={{ number_format($value_export->product_price) }}
                                        required="">
                                </td>
                                <td>
                                    <input type="text" id="" name="product_note[]" class="form-control"
                                        style="width: 140px" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'readonly';
                                        } ?>
                                        value="{{ $value_export->product_note }}">
                                </td>
                                <td>
                                    <select name="product_tax[]" class="product_tax form-control"
                                        style="width: 100px;" id="product_tax" required <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                            echo 'disabled';
                                        } ?>>
                                        <option value="0" <?php if ($value_export->product_tax == 0) {
                                            echo 'selected';
                                        } ?>>0%</option>
                                        <option value="8" <?php if ($value_export->product_tax == 8) {
                                            echo 'selected';
                                        } ?>>8%</option>
                                        <option value="10" <?php if ($value_export->product_tax == 10) {
                                            echo 'selected';
                                        } ?>>10%</option>
                                        <option value="00" <?php if ($value_export->product_tax == 00) {
                                            echo 'selected';
                                        } ?>>NOVAT</option>
                                    </select>
                                </td>
                                <td><span class="total-amount form-control text-center"
                                        style="background:#e9ecef; width:140px">0</span>
                                </td>
                                @if ($exports->export_status == 2)
                                    <td data-toggle='modal' data-target='#snModal' class='sn'><img
                                            src="../../dist/img/icon/list.png"></td>
                                @elseif($exports->export_status == 0)
                                    <td data-toggle='modal' data-target='#snModal' class='sn1'><img
                                            src="../../dist/img/icon/list.png"></td>
                                @else
                                    <td data-toggle='modal' data-target='#snModal' class='sn2'><img
                                            src="../../dist/img/icon/list.png"></td>
                                @endif
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
                    <div class="mt-4 w-75" style="float: left;">
                        <b class="pl-2">*Ghi chú báo giá</b>
                        <div class="position-relative">
                            <input type="hidden" name="creator" id="creator" value="{{ Auth::user()->id }}">
                            <textarea name="note_form" id="note_form" class="form-control" rows="8" <?php if ($exports->export_status != 1 || (Auth::user()->id != $exports->user_id && !Auth::user()->can('isAdmin'))) {
                                echo 'readonly';
                            } ?>>{{ $exports->note_form }}</textarea>
                            @if ($exports->export_status == 1)
                                <div id="btn-addNoteForm">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5.43364 3H8.07596H15.1555H15.3069C15.6265 3 15.943 3.06298 16.2382 3.18535C16.5335 3.30771 16.8017 3.48706 17.0276 3.71314L19.53 6.2155C19.9864 6.67177 20.2429 7.2907 20.243 7.93604V17.8227C20.243 18.4681 19.9866 19.0871 19.5303 19.5435C19.0739 19.9999 18.4549 20.2563 17.8095 20.2563L16.0466 20.2563H7.19724L5.52568 20.2563C4.8834 20.2563 4.26716 20.0024 3.8113 19.55C3.35544 19.0975 3.09692 18.4832 3.0921 17.8409L3.00007 5.45183C2.99767 5.13073 3.05883 4.81228 3.18005 4.51493C3.30127 4.21757 3.48014 3.94713 3.70636 3.71922C3.93258 3.4913 4.20167 3.31041 4.49812 3.18698C4.79456 3.06354 5.11253 2.99999 5.43364 3ZM7.86094 18.9289H15.3829V12.7662C15.3829 12.5041 15.17 12.2918 14.9095 12.2918H8.33527C8.07351 12.2918 7.86094 12.5044 7.86094 12.7662V18.9289ZM16.7103 18.9289V12.7662C16.7103 11.7716 15.9038 10.9644 14.9095 10.9644H8.33527C7.34041 10.9644 6.53354 11.7713 6.53354 12.7662V18.9289H5.52566C5.2337 18.9289 4.95359 18.8135 4.74638 18.6078C4.53918 18.4022 4.42167 18.1229 4.41947 17.831L4.32744 5.44187C4.32634 5.29591 4.35415 5.15118 4.40924 5.01601C4.46434 4.88085 4.54565 4.75792 4.64848 4.65432C4.7513 4.55072 4.87362 4.4685 5.00837 4.41239C5.14312 4.35629 5.28764 4.3274 5.43361 4.32741H7.41226V7.12292C7.41226 7.53364 7.57542 7.92755 7.86585 8.21797C8.15627 8.5084 8.55018 8.67156 8.9609 8.67156H14.2705C14.6812 8.67156 15.0751 8.5084 15.3656 8.21797C15.656 7.92755 15.8192 7.53364 15.8192 7.12292V4.45331C15.9184 4.50525 16.0094 4.57211 16.0889 4.65158L18.5915 7.15426C18.799 7.36162 18.9155 7.64302 18.9156 7.93632V17.8227C18.9156 18.1161 18.7991 18.3974 18.5916 18.6049C18.3842 18.8123 18.1028 18.9289 17.8095 18.9289H16.7103ZM14.4918 7.12292V4.32741H8.73967V7.12292C8.73967 7.18159 8.76297 7.23787 8.80446 7.27936C8.84595 7.32085 8.90223 7.34415 8.9609 7.34415H14.2705C14.3292 7.34415 14.3855 7.32085 14.427 7.27936C14.4684 7.23787 14.4918 7.18159 14.4918 7.12292Z"
                                            fill="#D6D6D6" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
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
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-primary">Phí vận chuyển:</span>
                            <span>0đ</span>
                        </div> --}}
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
                            onclick="validateAndSubmit(event)">Lưu</button>
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
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal S/N --}}
<div class="modal fade" id="snModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Danh sách Serial Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

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
                var productPrice = parseFloat(response.product_price);
                var formattedPrice;
                if (Number.isInteger(productPrice)) {
                    formattedPrice = numeral(productPrice).format('0,0');
                } else {
                    formattedPrice = numeral(productPrice).format('0,0.00');
                }
                $('#productModal').find('.modal-body').html('<b>Mã sản phẩm: </b> ' +
                    productCode +
                    '<br>' + '<b>Tên sản phẩm: </b> ' + productName + '<br>' +
                    '<b>Loại hàng: </b> ' + response.product_category + '<br>' +
                    '<b>Tồn kho: </b>' + response.product_qty + '<br>' +
                    '<b>Đang giao dịch: </b>' +
                    response.trading +
                    '<br>' + '<b>Giá nhập: </b>' + formattedPrice + '<br>' + '<b>Thuế: </b>' +
                    thue + '%');
            },
        });
    });
    //hiển thị thông tin S/N chốt đơn
    $('.sn').on('click', function() {
        var qty = $(this).closest('tr').find('.quantity-input').val();
        var productCode = $(this).closest('tr').find('.productName').val();
        var productCode1 = $(this).closest('tr').find('.maProduct option:selected')
            .text();
        var productName = $(this).closest('tr').find('.productName option:selected')
            .text();
        var dvt = $(this).closest('tr').find('.product_unit').val();
        var giaBan = $(this).closest('tr').find('.product_price')
            .val();
        var ghiChu = $(this).closest('tr').find('.note_product')
            .val();
        var thue = $(this).closest('tr').find('.product_tax')
            .val();
        var thanhTien = $(this).closest('tr').find('.total-amount')
            .text();
        var giaNhap = $(this).closest('tr').find('.price_import').val();
        var tonKho = $(this).closest('tr').find('.tonkho').val();
        $.ajax({
            url: '{{ route('getSN1') }}',
            type: 'GET',
            data: {
                qty: qty,
                productCode: productCode,
            },
            success: function(response) {
                console.log(response);
                var modalBody = $('#snModal').find('.modal-body');
                let count = 1;
                modalBody.empty();
                var snList = $('<table class="table table-hover">' +
                    '<thead><tr><td>STT</td><td>Serial Number</td></tr></thead>' +
                    '<tbody>'
                );
                var product = $('<table class="table table-hover">' +
                    '<thead><tr><td>ID</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Số lượng sản phẩm</td><td>Số lượng S/N</td></tr></thead>' +
                    '<tbody><tr>' + '<td>1</td>' + '<td>' +
                    productCode1 + '</td>' + '<td>' + productName +
                    '</td>' + '<td>' + qty + '</td>' + '<td>' + qty +
                    '</td>' +
                    '</tr</tbody>' + '</table>' +
                    '<h5>Thông tin Serial Number </h5>');
                response.forEach(function(sn) {
                    var countCell = $('<td>').text(count);
                    var snItemCell = $('<td>').text(sn.serinumber);
                    var row = $('<tr>').append(countCell,
                        snItemCell);
                    snList.append(row);
                    count++;
                });
                modalBody.append(product, snList);
                $('#snModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    //hiển thị thông tin S/N hủy đơn
    $('.sn1').on('click', function() {
        var qty = $(this).closest('tr').find('.quantity-input').val();
        var productCode = $(this).closest('tr').find('.productName').val();
        var productCode1 = $(this).closest('tr').find('.maProduct option:selected')
            .text();
        var productName = $(this).closest('tr').find('.productName option:selected')
            .text();
        var dvt = $(this).closest('tr').find('.product_unit').val();
        var giaBan = $(this).closest('tr').find('.product_price')
            .val();
        var ghiChu = $(this).closest('tr').find('.note_product')
            .val();
        var thue = $(this).closest('tr').find('.product_tax')
            .val();
        var thanhTien = $(this).closest('tr').find('.total-amount')
            .text();
        var giaNhap = $(this).closest('tr').find('.price_import').val();
        var tonKho = $(this).closest('tr').find('.tonkho').val();
        $.ajax({
            url: '{{ route('getSN') }}',
            type: 'GET',
            data: {
                qty: qty,
                productCode: productCode,
            },
            success: function(response) {
                console.log(response);
                var modalBody = $('#snModal').find('.modal-body');
                let count = 1;
                modalBody.empty();
                var snList = $('<table class="table table-hover">' +
                    '<thead><tr><td>STT</td><td>Serial Number</td></tr></thead>' +
                    '<tbody>'
                );
                var product = $('<table class="table table-hover">' +
                    '<thead><tr><td>ID</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Số lượng sản phẩm</td><td>Số lượng S/N</td></tr></thead>' +
                    '<tbody><tr>' + '<td>1</td>' + '<td>' +
                    productCode1 + '</td>' + '<td>' + productName +
                    '</td>' + '<td>' + qty + '</td>' + '<td>' + qty +
                    '</td>' +
                    '</tr</tbody>' + '</table>' +
                    '<h5>Thông tin Serial Number </h5>');
                response.forEach(function(sn) {
                    var countCell = $('<td>').text(count);
                    var snItemCell = $('<td>').text(sn.serinumber);
                    var row = $('<tr>').append(countCell,
                        snItemCell);
                    snList.append(row);
                    count++;
                });
                modalBody.append(product, snList);
                $('#snModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    //hiển thị thông tin S/N cho duyet
    $('.sn2').on('click', function() {
        var qty = $(this).closest('tr').find('.quantity-input').val();
        var productCode = $(this).closest('tr').find('.productName').val();
        var productCode1 = $(this).closest('tr').find('.maProduct option:selected')
            .text();
        var productName = $(this).closest('tr').find('.productName option:selected')
            .text();
        var dvt = $(this).closest('tr').find('.product_unit').val();
        var giaBan = $(this).closest('tr').find('.product_price')
            .val();
        var ghiChu = $(this).closest('tr').find('.note_product')
            .val();
        var thue = $(this).closest('tr').find('.product_tax')
            .val();
        var thanhTien = $(this).closest('tr').find('.total-amount')
            .text();
        var giaNhap = $(this).closest('tr').find('.price_import').val();
        var tonKho = $(this).closest('tr').find('.tonkho').val();
        $.ajax({
            url: '{{ route('getSN2') }}',
            type: 'GET',
            data: {
                qty: qty,
                productCode: productCode,
            },
            success: function(response) {
                console.log(response);
                var modalBody = $('#snModal').find('.modal-body');
                let count = 1;
                modalBody.empty();
                var snList = $('<table class="table table-hover">' +
                    '<thead><tr><td>STT</td><td>Serial Number</td></tr></thead>' +
                    '<tbody>'
                );
                var product = $('<table class="table table-hover">' +
                    '<thead><tr><td>ID</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Số lượng sản phẩm</td><td>Số lượng S/N</td></tr></thead>' +
                    '<tbody><tr>' + '<td>1</td>' + '<td>' +
                    productCode1 + '</td>' + '<td>' + productName +
                    '</td>' + '<td>' + qty + '</td>' + '<td>' + qty +
                    '</td>' +
                    '</tr</tbody>' + '</table>' +
                    '<h5>Thông tin Serial Number </h5>');
                response.forEach(function(sn) {
                    var countCell = $('<td>').text(count);
                    var snItemCell = $('<td>').text(sn.serinumber);
                    var row = $('<tr>').append(countCell,
                        snItemCell);
                    snList.append(row);
                    count++;
                });
                modalBody.append(product, snList);
                $('#snModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    //form thong tin khach hang xuất hàng
    var radio1 = document.getElementById("radio1");
    var radio2 = document.getElementById("radio2");
    $("#radio1").on("click", function() {
        $('#data-container').empty();
        $('#form-edit').show();
    });
    $("#radio2").on("click", function() {
        $('#data-container').html(
            '<div id="form-guest">' +
            '<div class="border-bottom p-3 d-flex justify-content-between align-items-center">' +
            '<b>Thông tin khách hàng</b>' +
            '<button id="btn-addCustomer" type="submit" class="btn btn-primary d-flex align-items-center">' +
            '<img src="../dist/img/icon/Union.png">' +
            '<span class="ml-1">Lưu thông tin</span></button></div>' +
            '<input type="hidden" name="click" id="click" value="">' +
            '<div class="row p-3">' +
            '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<input type="text" hidden class="form-control" name="id" value="">' +
            '<label for="congty">Công ty:</label>' +
            '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label>Địa chỉ xuất hóa đơn:</label>' +
            '<input type="text" class="form-control" id="guest_addressInvoice" placeholder="Nhập thông tin" name="guest_addressInvoice" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label>Mã số thuế:</label>' +
            '<input type="text" oninput="validateNumberInput(this)" class="form-control" id="guest_code" inputmode="numeric" placeholder="Nhập thông tin" name="guest_code" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Địa chỉ giao hàng:</label>' +
            '<input type="text" class="form-control" id="guest_addressDeliver" placeholder="Nhập thông tin" name="guest_addressDeliver" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Người nhận hàng:</label>' +
            '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">SĐT người nhận:</label>' +
            '<input type="text" pattern="/^((\+84)|(0[1-9]))\d{8}$/" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="" required>' +
            '</div>' + '</div>' + '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<label for="email">Người đại diện:</label>' +
            '<input type="text" class="form-control" id="guest_represent" placeholder="Nhập thông tin" name="guest_represent" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Email:</label>' +
            '<input type="email" class="form-control" pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label>Số điện thoại:</label>' +
            '<input type="text" class="form-control" pattern="/^((\+84)|(0[1-9]))\d{8}$/" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="" required>' +
            '</div>' + '<div class="form-group">' +
            ' <label for="email">Hình thức thanh toán:</label>' +
            '<select name="guest_pay" class="form-control" id="guest_pay">' +
            '<option value="0">Chuyển khoản</option>' +
            '<option value="1">Thanh toán bằng tiền mặt</option>' +
            '</select>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Ghi chú:</label>' +
            '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="" required>' +
            '</div>' + '</div></div></div>'
        );
        $('#form-edit').hide();
    });
    //add sản phẩm
    $(document).ready(function() {
        let fieldCounter = 1;
        $("#add-field-btn").click(function() {
            let nextSoTT = $(".soTT").length + 1;
            const newRow = $("<tr>", {
                "id": `dynamic-row-${fieldCounter}`
            });
            const checkbox = $("<td><input type='checkbox'></td>");
            const MaInput = $("<td>", {
                "class": "soTT",
                "text": nextSoTT
            });
            const TenInput = $("<td>" +
                "<select id='maProduct' class='p-1 maProduct form-control' name='products_id[]' required>" +
                "<option value=''>Lựa chọn sản phẩm</option>" +
                '@foreach ($product_code as $value)' +
                "<option value='{{ $value->id }}'>{{ $value->products_code }}</option>" +
                '@endforeach' +
                "</select>"
            );
            const ProInput = $("<td>" +
                "<select class='child-select p-1 productName form-control' name='product_id[]' required>" +
                "<option value=''>Lựa chọn sản phẩm</option>" +
                "</select>" +
                "</td>");
            const dvtInput = $(
                "<td><input type='text' id='product_unit' class='product_unit form-control text-center' style='width:80px' name='product_unit[]' required></td>"
            );
            const slInput = $(
                "<td>" +
                "<div class='d-flex'>" +
                "<input type='number' oninput='limitMaxValue(this)' id='product_qty' class='quantity-input form-control text-center' name='product_qty[]' required style='width:50px;'>" +
                "<input type='text' readonly class='quantity-exist' required style='width:50px;background:#D6D6D6;border:none;'>" +
                "</div>" +
                "</td>"
            );
            const giaInput = $(
                "<td><input type='text' class='product_price form-control text-center' style='width:140px;' id='product_price' name='product_price[]' required></td>"
            );
            const ghichuInput = $(
                "<td><input type='text' class='note_product form-control text-center' name='product_note[]'></td>"
            );
            const thueInput = $("<td>" +
                "<select name='product_tax[]' class='product_tax p-1 form-control text-center' style='width:100px' id='product_tax' required>" +
                "<option value='0'>0%</option>" +
                "<option value='8'>8%</option>" +
                "<option value='10'>10%</option>" +
                "<option value='0'>NOVAT</option>" +
                "</select>" +
                "</td>");
            const thanhTienInput = $("<td><span class='total-amount form-control text-center'>0</span></td>");
            const sn = $(
                "<td data-toggle='modal' data-target='#snModal'><img src='../../dist/img/icon/list.png'></td>"
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
                $(this).closest("tr").remove();
                updateSTT();
                calculateGrandTotal();
                calculateTotals();
            });
            //lấy S/N
            sn.click(function() {
                var qty = $(this).closest('tr').find('.quantity-input').val();
                var productCode = $(this).closest('tr').find('.productName').val();
                var productCode1 = $(this).closest('tr').find('.maProduct option:selected')
                    .text();
                var productName = $(this).closest('tr').find('.productName option:selected')
                    .text();
                var dvt = $(this).closest('tr').find('.product_unit').val();
                var giaBan = $(this).closest('tr').find('.product_price')
                    .val();
                var ghiChu = $(this).closest('tr').find('.note_product')
                    .val();
                var thue = $(this).closest('tr').find('.product_tax')
                    .val();
                var thanhTien = $(this).closest('tr').find('.total-amount')
                    .text();
                var giaNhap = $(this).closest('tr').find('.price_import').val();
                var tonKho = $(this).closest('tr').find('.tonkho').val();
                $.ajax({
                    url: "{{ route('getSN') }}",
                    method: 'GET',
                    data: {
                        qty: qty,
                        productCode: productCode,
                    },
                    success: function(response) {
                        var modalBody = $('#snModal').find('.modal-body');
                        let count = 1;
                        modalBody.empty();
                        var snList = $('<table class="table table-hover">' +
                            '<thead><tr><td>STT</td><td>Serial Number</td></tr></thead>' +
                            '<tbody>'
                        );
                        var product = $('<table class="table table-hover">' +
                            '<thead><tr><td>ID</td><td>Mã sản phẩm</td><td>Tên sản phẩm</td><td>Số lượng sản phẩm</td><td>Số lượng S/N</td></tr></thead>' +
                            '<tbody><tr>' + '<td>1</td>' + '<td>' +
                            productCode1 + '</td>' + '<td>' + productName +
                            '</td>' + '<td>' + qty + '</td>' + '<td>' + qty +
                            '</td>' +
                            '</tr</tbody>' + '</table>' +
                            '<h5>Thông tin Serial Number </h5>');
                        response.forEach(function(sn) {
                            var countCell = $('<td>').text(count);
                            var snItemCell = $('<td>').text(sn.serinumber);
                            var row = $('<tr>').append(countCell,
                                snItemCell);
                            snList.append(row);
                            count++;
                        });
                        modalBody.append(product, snList);
                        $('#snModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
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
                            '<b>Mã sản phẩm: </b> ' +
                            productCode +
                            '<br>' + '<b>Tên sản phẩm: </b> ' + productName +
                            '<br>' +
                            '<b>Loại hàng: </b> ' + response.product_category +
                            '<br>' +
                            '<b>Tồn kho: </b>' + response.product_qty + '<br>' +
                            '<b>Đang giao dịch: </b>' +
                            response.trading +
                            '<br>' + '<b>Giá nhập: </b>' + formattedPrice +
                            '<br>' + '<b>Thuế: </b>' +
                            thue + '%');
                    },
                });
            });
            newRow.append(checkbox, MaInput, TenInput, ProInput, dvtInput, slInput,
                giaInput, ghichuInput, thueInput, thanhTienInput, sn, info, deleteBtn, option);
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
        const regex = /^[-+]?[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]+)?$/;
        const value = input.value.replace(/,/g, '');
        if (!regex.test(value)) {
            input.value = '';
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
                        '<img src="../dist/img/icon/Union.png">' +
                        '<span class="ml-1">Lưu thông tin</span></button></div>' +
                        '<div class="row p-3">' +
                        '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<input type="text" hidden class="form-control" id="id" name="id" value="' +
                        data.id + '" required>' +
                        '<input type="hidden" name="updateClick" id="updateClick" value="">' +
                        '<label for="congty">Công ty:</label>' +
                        '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="' +
                        data.guest_name + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label>Địa chỉ xuất hóa đơn:</label>' +
                        '<input type="text" class="form-control" placeholder="Nhập thông tin" id="guest_addressInvoice" name="guest_addressInvoice" value="' +
                        data.guest_addressInvoice + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Mã số thuế:</label>' +
                        '<input type="text" oninput="validateNumberInput(this)" class="form-control" inputmode="numeric" id="guest_code" placeholder="Nhập thông tin" name="guest_code" value="' +
                        data.guest_code + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Địa chỉ giao hàng:</label>' +
                        '<input type="text" class="form-control" id="guest_addressDeliver" placeholder="Nhập thông tin" name="guest_addressDeliver" value="' +
                        data.guest_addressDeliver + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Người nhận hàng:</label>' +
                        '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="' +
                        data.guest_receiver + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">SĐT người nhận:</label>' +
                        '<input type="text" pattern="/^((\+84)|(0[1-9]))\d{8}$/" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="' +
                        data.guest_phoneReceiver + '" required>' +
                        '</div>' + '</div>' + '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<label for="email">Người đại diện:</label>' +
                        '<input type="text" class="form-control" id="guest_represent" placeholder="Nhập thông tin" name="guest_represent" value="' +
                        data.guest_represent + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Email:</label>' +
                        '<input type="email" class="form-control" pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="' +
                        data.guest_email + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label>Số điện thoại:</label>' +
                        '<input type="text" class="form-control" pattern="/^((\+84)|(0[1-9]))\d{8}$/" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="' +
                        data.guest_phone + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Hình thức thanh toán:</label>' +
                        '<select name="guest_pay" class="form-control" id="guest_pay" required>' +
                        '<option value="0"' + (data.guest_pay == 0 ? ' selected' : '') +
                        '>Chuyển khoản</option>' +
                        '<option value="1"' + (data.guest_pay == 1 ? ' selected' : '') +
                        '>Thanh toán bằng tiền mặt</option>' +
                        '</select>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Ghi chú:</label>' +
                        '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="' +
                        (data.guest_note == null ? '' : data.guest_note) + '">' +
                        '</div>' + '</div></div><div>'
                    );
                }
            });
        });
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
        var guest_addressInvoice = $('#guest_addressInvoice').val();
        var guest_code = $('#guest_code').val();
        var guest_addressDeliver = $('#guest_addressDeliver').val();
        var guest_receiver = $('#guest_receiver').val();
        var guest_phoneReceiver = $('#guest_phoneReceiver').val();
        var guest_represent = $('#guest_represent').val();
        var guest_email = $('#guest_email').val();
        var guest_phone = $('#guest_phone').val();
        var guest_pay = $('#guest_pay').val();
        var guest_note = $('#guest_note').val();

        $.ajax({
            url: "{{ route('updateCustomer') }}",
            type: "get",
            data: {
                id: id,
                guest_name,
                guest_addressInvoice,
                guest_code,
                guest_addressDeliver,
                guest_receiver,
                guest_phoneReceiver,
                guest_represent,
                guest_email,
                guest_phone,
                guest_pay,
                guest_note,
                updateClick
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
        e.preventDefault()
        var form = $('#export_form')[0];
        if (!form.reportValidity()) {
            return;
        }
        $('#click').val(1);
        var click = $('#click').val();
        var guest_name = $('#guest_name').val();
        var guest_addressInvoice = $('#guest_addressInvoice').val();
        var guest_code = $('#guest_code').val();
        var guest_addressDeliver = $('#guest_addressDeliver').val();
        var guest_receiver = $('#guest_receiver').val();
        var guest_phoneReceiver = $('#guest_phoneReceiver').val();
        var guest_represent = $('#guest_represent').val();
        var guest_email = $('#guest_email').val();
        var guest_phone = $('#guest_phone').val();
        var guest_pay = $('#guest_pay').val();
        var guest_note = $('#guest_note').val();

        $.ajax({
            url: "{{ route('addCustomer') }}",
            type: "get",
            data: {
                guest_name,
                guest_addressInvoice,
                guest_code,
                guest_addressDeliver,
                guest_receiver,
                guest_phoneReceiver,
                guest_represent,
                guest_email,
                guest_phone,
                guest_pay,
                guest_note,
                click,
            },
            success: function(data) {
                if (data.hasOwnProperty('message')) {
                    alert(data.message); // Hiển thị thông báo đã tồn tại
                } else if (data.hasOwnProperty('id')) {
                    alert('Thêm thông tin thành công');
                    $('#form-guest input[name="id"]').val(data.id);
                }
            }
        })
    })
    //lấy thông tin sản phẩm từ mã sản phẩm
    $(document).ready(function() {
        //lấy thông tin sản phẩm từ mã sản phẩm
        var selectedProductNames = [];
        $(document).on('change', '.maProduct', function() {
            var row = $(this).closest('tr');
            var childSelect = row.find('.child-select');
            var idProducts = $(this).val();

            if (idProducts) {
                $.ajax({
                    url: "{{ route('nameProduct') }}",
                    type: "GET",
                    data: {
                        idProducts: idProducts,
                        selectedProductIds: selectedProductNames
                    },
                    success: function(response) {
                        childSelect.empty();
                        childSelect.append('<option value="">Lựa chọn sản phẩm</option>');
                        $.each(response, function(index, product) {
                            childSelect.append(
                                `<option value="${product.id}">${product.product_name}</option>`
                            );
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle errors (if any)
                        console.log(error);
                    }
                });
            } else {
                childSelect.empty();
                childSelect.append('<option value="">Lựa chọn sản phẩm</option>');
            }
        });
        //lấy thông tin sản phẩm con từ tên sản phẩm con
        $(document).on('change', '.child-select', function() {
            var selectedName = $(this).val();
            var row = $(this).closest('tr');
            var idProduct = $(this).val();
            var productUnitElement = $(this).closest('tr').find('.product_unit');
            var qty_exist = $(this).closest('tr').find('.quantity-exist');
            var price_import = $(this).closest('tr').find('.price_import');
            var tonkho = $(this).closest('tr').find('.tonkho');
            var loaihang = $(this).closest('tr').find('.loaihang');
            var dangGD = $(this).closest('tr').find('.dangGD');
            var thue = $(this).closest('tr').find('.product_tax');
            if (idProduct) {
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    type: "get",
                    data: {
                        idProduct: idProduct,
                    },
                    success: function(response) {
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
                        dangGD.val(response.trading);
                        thue.val(response.tax);
                        // Tính lại tổng số tiền và tổng số thuế
                        calculateTotalTax();
                        calculateGrandTotal();
                    },
                });
            }

            // Check if the selected product name is already in use
            // if (selectedProductNames.includes(selectedName)) {
            //     $(this).val('');
            // } else {
            //     selectedProductNames.push(selectedName);
            // }
        });

        // Function to hide selected product names from other child select options
        // function hideSelectedProductNames(row) {
        //     var selectedNames = row.find('.child-select').map(function() {
        //         return $(this).val();
        //     }).get();

        //     row.find('.child-select').each(function() {
        //         var currentName = $(this).val();
        //         $(this).find('option').each(function() {
        //             if ($(this).val() !== currentName && selectedNames.includes($(this)
        //                     .val())) {
        //                 $(this).hide();
        //             } else {
        //                 $(this).show();
        //             }
        //         });
        //     });
        // }
    });
    //tính thành tiền của sản phẩm
    $(document).ready(function() {
        calculateTotals();
    });

    $(document).on('input', '.quantity-input, [name^="product_price"], .product_tax', function() {
        calculateTotals();
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

            if (productPriceElement.length > 0) {
                var rawPrice = productPriceElement.val();
                if (rawPrice !== "") {
                    productPrice = parseFloat(rawPrice.replace(/,/g, ''));
                }
            }

            if (!isNaN(productQty) && !isNaN(productPrice) && !isNaN(taxValue)) {
                var rowTotal = productQty * productPrice;
                var rowTax = (rowTotal * taxValue) / 100;

                // Hiển thị kết quả
                $(this).find('.total-amount').text(formatCurrency(rowTotal.toFixed(2)));
                $(this).find('.product_tax1').text(rowTax.toFixed(2));

                // Cộng dồn vào tổng totalAmount và totalTax
                totalAmount += rowTotal;
                totalTax += rowTax;
            }
        });

        // Hiển thị tổng totalAmount và totalTax
        $('#total-amount-sum').text(formatCurrency(totalAmount.toFixed(2)));
        $('#product-tax').text(formatCurrency(totalTax.toFixed(2)));

        // Tính tổng thành tiền và thuế
        calculateGrandTotal(totalAmount, totalTax);
    }

    function calculateGrandTotal(totalAmount, totalTax) {
        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(formatCurrency(grandTotal.toFixed(2)));

        // Cập nhật giá trị data-value
        $('#grand-total').attr('data-value', grandTotal.toFixed(2));
        $('#total').val(grandTotal.toFixed(2));
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

    //hàm kiểm tra submit
    function validateAndSubmit(event) {
        var formGuest = $('#form-guest');
        var productList = $('.productName');

        if (formGuest.length && productList.length > 0) {
            $('.product_price, [name^="product_price"]').each(function() {
                var newValue = $(this).val().replace(/,/g, '');
                $(this).val(newValue);
            });
        } else {
            if (formGuest.length === 0) {
                alert('Lỗi: Chưa nhập thông tin khách hàng!');
            } else if (productList.length === 0) {
                alert('Lỗi: Chưa thêm sản phẩm!');
            }
            event.preventDefault();
        }
    }

    //format giá
    var inputElement = document.getElementById('product_price');
    $('body').on('input', '.product_price', function(event) {
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
</script>
</body>

</html>
