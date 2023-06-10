<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 breadcrumb">
            @if ($order->order_status == 1)
                <a href="{{ route('insertProduct.index') }}">
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
                    <span class="ml-1" style="font-size: 16px; font-weight: 500; color: #555555;">Trả về danh
                        sách</span>
                </a>
            @else
                <span><a href="{{ route('insertProduct.index') }}">Nhập hàng</a></span>
                <span class="mx-1"> / </span>
                <span><b>Chi tiết đơn hàng</b></span>
            @endif
        </div>
        <div class="col-sm-6 position-absolute" style="top:63px;right:2%">
            <div class="w-50 position-relative" style="float: right;">
                <div class="justify-content-between d-flex">
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
                    @if ($order->order_status == 1)
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
                    @else
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
                            <p class="p-0 m-0"></p>
                        </span>
                    @endif
                </div>
                <div class="position-absolute" style="top: 32px; z-index: 0;left: 17px">
                    <svg height="4" viewBox="0 0 364 3" fill="none" style="width: 95%"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="0.999268" y1="1.50098" x2="363.001" y2="1.50098" stroke="#FFFFFF"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="justify-content-between d-flex">
                    <b>Tạo đơn</b>
                    <b>Đơn nháp</b>
                    <b>Chốt đơn</b>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('insertProduct.update', $order->id) }}" method="POST" id="form_submit">
        <div class="container-fluided">
            <!-- Content Header (Page header) -->
            @if (Session::has('session'))
                {{ Session::get('session') }}
            @endif

            @csrf
            @method('PUT')
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="provide_id" value="{{ $provide_order[0]->id }}" id="provide_id">
            <section class="content-header">
                <div class="d-flex mb-1 action-don">
                    @if ($order->order_status == 0)
                        @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                            <button class="btn btn-danger text-white" id="add_bill">Duyệt đơn</button>
                            <a href="#" class="btn btn-secondary mx-4" id="deleteBill">Hủy đơn</a>
                        @endif
                    @endif
                    <a href="#" class="btn border border-secondary d-flex align-items-center"><svg
                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9 5C8.46957 5 7.96086 5.21071 7.58579 5.58579C7.21071 5.96086 7 6.46957 7 7V8H17V7C17 6.46957 16.7893 5.96086 16.4142 5.58579C16.0391 5.21071 15.5304 5 15 5H9ZM15 13H9C8.73478 13 8.48043 13.1054 8.29289 13.2929C8.10536 13.4804 8 13.7348 8 14V17C8 17.2652 8.10536 17.5196 8.29289 17.7071C8.48043 17.8946 8.73478 18 9 18H15C15.2652 18 15.5196 17.8946 15.7071 17.7071C15.8946 17.5196 16 17.2652 16 17V14C16 13.7348 15.8946 13.4804 15.7071 13.2929C15.5196 13.1054 15.2652 13 15 13Z"
                                fill="#555555" />
                            <path
                                d="M4 11C4 10.4696 4.21071 9.96086 4.58579 9.58579C4.96086 9.21071 5.46957 9 6 9H18C18.5304 9 19.0391 9.21071 19.4142 9.58579C19.7893 9.96086 20 10.4696 20 11V14C20 14.5304 19.7893 15.0391 19.4142 15.4142C19.0391 15.7893 18.5304 16 18 16H17V14C17 13.4696 16.7893 12.9609 16.4142 12.5858C16.0391 12.2107 15.5304 12 15 12H9C8.46957 12 7.96086 12.2107 7.58579 12.5858C7.21071 12.9609 7 13.4696 7 14V16H6C5.46957 16 4.96086 15.7893 4.58579 15.4142C4.21071 15.0391 4 14.5304 4 14V11ZM6.5 12C6.63261 12 6.75979 11.9473 6.85355 11.8536C6.94732 11.7598 7 11.6326 7 11.5C7 11.3674 6.94732 11.2402 6.85355 11.1464C6.75979 11.0527 6.63261 11 6.5 11C6.36739 11 6.24021 11.0527 6.14645 11.1464C6.05268 11.2402 6 11.3674 6 11.5C6 11.6326 6.05268 11.7598 6.14645 11.8536C6.24021 11.9473 6.36739 12 6.5 12Z"
                                fill="#555555" />
                        </svg>
                        In đơn hàng</a>
                </div>
                <div class="container-fluided">
                    <div class="row my-3">
                        <div class="col">
                            @if ($order->order_status == 0)
                                @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                                    <div class="w-75">
                                        <div class="input-group mb-1 position-relative w-50">
                                            <input type="text" class="form-control"
                                                placeholder="Nhập thông tin khách hàng" aria-label="Username"
                                                aria-describedby="basic-addon1" id="myInput" autocomplete="off">
                                            <div class="position-absolute" style="right: 5px;top: 17%;">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.1835 7.36853C13.0254 5.21049 9.52656 5.21049 7.36853 7.36853C5.21049 9.52656 5.21049 13.0254 7.36853 15.1835C9.52656 17.3415 13.0254 17.3415 15.1835 15.1835C17.3415 13.0254 17.3415 9.52656 15.1835 7.36853ZM16.2441 6.30787C13.5003 3.56404 9.05169 3.56404 6.30787 6.30787C3.56404 9.05169 3.56404 13.5003 6.30787 16.2441C9.05169 18.988 13.5003 18.988 16.2441 16.2441C18.988 13.5003 18.988 9.05169 16.2441 6.30787Z"
                                                        fill="#555555" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.1796 15.1796C15.4725 14.8867 15.9474 14.8867 16.2403 15.1796L19.5303 18.4696C19.8232 18.7625 19.8232 19.2374 19.5303 19.5303C19.2374 19.8232 18.7625 19.8232 18.4696 19.5303L15.1796 16.2403C14.8867 15.9474 14.8867 15.4725 15.1796 15.1796Z"
                                                        fill="#555555" />
                                                </svg>
                                            </div>
                                        </div>
                                        <ul id="myUL" class="bg-white position-absolute w-50 rounded shadow p-0 "
                                            style="z-index: 99;">
                                            @foreach ($provide as $value)
                                                <li <?php if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) {
                                                    echo 'class="d-none"';
                                                } ?>>
                                                    <a href="#"
                                                        class="text-dark d-flex justify-content-between p-2 search-info select_page"
                                                        id="{{ $value->id }}" name="select_page">
                                                        <span>{{ $value->provide_represent }}</span>
                                                        <span class="mr-5">{{ $value->provide_name }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section id="infor_provide" class="bg-white rounded">
            <div class="border-bottom p-3 d-flex justify-content-between">
                <b>Thông tin nhà cung cấp</b>
                @if (Auth::user()->id == $order->users_id)
                    @if ($order->order_status == 0)
                        <button id="btn-addProvide" class="btn btn-primary save_infor d-flex align-items-center">
                            <img src="{{ asset('dist/img/icon/Union.png') }}">
                            <span class="ml-1">Lưu thông tin</span>
                        </button>
                    @endif
                @endif
            </div>
            <div class="row p-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="congty">Công ty:</label>
                        <input required type="text" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_name"
                            placeholder="Nhập thông tin" name="provide_name"
                            value="{{ $provide_order[0]->provide_name }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ xuất hóa đơn:</label>
                        <input required type="text" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_address"
                            placeholder="Nhập thông tin" name="provide_address"
                            value="{{ $provide_order[0]->provide_address }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                    <div class="form-group">
                        <label for="email">Mã số thuế:</label>
                        <input required type="text" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_code"
                            placeholder="Nhập thông tin" name="provide_code"
                            value="{{ $provide_order[0]->provide_code }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">Người đại diện:</label>
                        <input required type="text" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_represent"
                            placeholder="Nhập thông tin" name="provide_represent"
                            value="{{ $provide_order[0]->provide_represent }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input required type="email" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_email"
                            placeholder="Nhập thông tin" name="provide_email"
                            value="{{ $provide_order[0]->provide_email }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                    <div class="form-group">
                        <label for="email">Số điện thoại:</label>
                        <input required type="text" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_phone"
                            placeholder="Nhập thông tin" name="provide_phone"
                            value="{{ $provide_order[0]->provide_phone }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content mt-3">
            <div style="overflow-x: auto;" class="container-fluided">
                <table class="table table-hover bg-white rounded" id="inputContainer">
                    <thead>
                        <tr>
                            @if ($order->order_status == 0)
                                <th><input type="checkbox"></th>
                            @endif
                            <th>Mã / Tên sản phẩm</th>
                            <th>Thông tin sản phẩm</th>
                            <th>Loại hàng</th>
                            <th>Đơn vị tính</th>
                            <th>Số lượng</th>
                            <th>Giá nhập</th>
                            <th>Thuế</th>
                            <th>Thành tiền</th>
                            <th>Ghi chú</th>
                            <th>SN</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($product_order as $pro)
                            <tr>
                                <input type="hidden" name="product_id[]" value="{{ $pro->product_id }}">
                                @if ($order->order_status == 0)
                                    <td><input type="checkbox"></td>
                                @endif
                                <td class="select-wrapper">
                                    <select name="products_id[]" id="" class="list_products form-control"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) disabled @endif>
                                        @foreach ($products as $prod)
                                            <option class="form-control" value="{{ $prod->id }}"
                                                {{ $prod->id == $pro->products_id ? 'selected' : '' }}>
                                                {{ $prod->products_code }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <!-- <td> <input readonly type="text" name='products_id[]' @if ($pro && $pro->getCodeProduct) value="{{ $pro->getCodeProduct->products_code }}" placeholder="{{ $pro->getCodeProduct->products_code }}" @endif></td> -->
                                <td> <input class="form-control" @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif
                                        required @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif
                                        type="text" style="width:auto" name="product_name[]"
                                        value="{{ $pro->product_name }}">
                                </td>
                                <td> <input class="form-control text-center" style="width: 120px"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="text"
                                        name="product_category[]" value="{{ $pro->product_category }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td> <input class="form-control text-center" style="width: 80px"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="text"
                                        name="product_unit[]" value="{{ $pro->product_unit }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td> <input class="form-control quantity-input text-center"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="number"
                                        name="product_qty[]" value="{{ $pro->product_qty }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td> <input class="form-control text-center"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="number"
                                        style="width:140px" name="product_price[]" value="{{ $pro->product_price }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td>
                                    <select name="product_tax[]" id="" class="form-control product_tax"
                                        style="width:80px;" @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) disabled @endif>>
                                        <option value="0" <?php echo $pro->product_tax == 0 ? 'selected' : ''; ?>>0%</option>
                                        <option value="8" <?php echo $pro->product_tax == 8 ? 'selected' : ''; ?>>8%</option>
                                        <option value="10" <?php echo $pro->product_tax == 10 ? 'selected' : ''; ?>>10%</option>
                                        <option value="00" <?php echo $pro->product_tax == 00 ? 'selected' : ''; ?>>NOVAT</option>
                                    </select>
                                </td>
                                <input type="hidden" class="product_tax1">
                                <td> <input class="form-control text-center" style="width:140px" readonly
                                        type="text" name="product_total[]" value="{{ $pro->product_total }}">
                                </td>
                                <td> <input class="form-control" style="width:150px"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif type="text"
                                        name="product_trademark[]" value=" {{ $pro->product_trademark }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td>
                                    <button class="exampleModal" name="btn_add_SN[]" type="button"
                                        class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal{{ $stt }}"
                                        style="background: transparent; border:none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 32 32" fill="none">
                                            <rect width="32" height="32" rx="4" fill="white" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z"
                                                fill="#0095F6" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z"
                                                fill="#0095F6" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z"
                                                fill="#0095F6" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z"
                                                fill="#0095F6" />
                                        </svg>
                                    </button>
                                </td>
                                <td>
                                    @if ($order->order_status != 1)
                                        <a href="javascript:;" class="deleteRow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 32 32" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z"
                                                    fill="#555555" />
                                            </svg>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <?php $stt++; ?>
                        @endforeach
                    </tbody>
                </table>
                @if ($order->order_status == 0)
                    @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                        <div class="mb-2"><a href="javascript:;" class="btn btn-secondary addRow">Thêm sản phẩm</a>
                        </div>
                    @endif
                @endif
            </div>
            <div id="list_modal">
                <?php $stt = 0; ?>
                @foreach ($product_order as $pro)
                    <div class="modal fade" id="exampleModal{{ $stt }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">'
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header align-items-center">
                                    <div>
                                        <h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>
                                        <p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-hover table_list_order">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Mã sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Nhà cung cấp</th>
                                                <th>Loại hàng</th>
                                                <th class="text-right">Số lượng sản phẩm</th>
                                                <th class="text-right">Số lượng S/N</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td class="code_product"></td>
                                                <td class="name_product"></td>
                                                <td class="name_provide"></td>
                                                <td class="type_product"></td>
                                                <td class="qty_product text-right"></td>
                                                <td class="SNCount text-right">1</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h3>Thông tin Serial Number </h3>
                                    <div class="div_value{{ $stt }}">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    @if ($order->order_status == 0)
                                                        <th style="width:2%;"><input type="checkbox">
                                                        </th>
                                                    @endif
                                                    <th style="width:5%;"><span>STT</span></th>
                                                    <th><span>Serial Number</span></th>
                                                    <th style="width:3%;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $st = 1; ?>
                                                @foreach ($seri as $se)
                                                    @if ($pro->product_id == $se->product_orderid)
                                                        <tr>
                                                            @if ($order->order_status == 0)
                                                                @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                                                                    <td><input type="checkbox"
                                                                            id="checkbox_{{ $stt }}"></td>
                                                                @endif
                                                            @endif
                                                            <td><span class="stt_SN"></span></td>
                                                            <td><input type="text" class="form-control w-25"
                                                                    name="product_SN{{ $stt }}[]"
                                                                    value="{{ $se->serinumber }}"
                                                                    onpaste="handlePaste(this)" <?php if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1)) {
                                                                        echo 'readonly';
                                                                    } ?>>
                                                            </td>
                                                            @if ($order->order_status == 0)
                                                                @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                                                                    <td class="deleteRow1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="32" height="32"
                                                                            viewBox="0 0 32 32" fill="none">
                                                                            <path fill-rule="evenodd"
                                                                                clip-rule="evenodd"
                                                                                d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z"
                                                                                fill="#555555" />
                                                                        </svg>
                                                                    </td>
                                                                @endif
                                                            @endif
                                                        </tr>
                                                    @endif
                                                    <?php $st++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($order->order_status == 0)
                                        @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                                            <div class="AddSN btn btn-secondary" style="border:1px solid gray;">Thêm
                                                dòng</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Lưu</button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $stt++; ?>
                @endforeach
            </div>
            <div class="btn-fixed">
                @if ($order->order_status == 0)
                    @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                        <a href="javascript:;" class="btn btn-primary addBillEdit">Lưu</a>
                    @endif
                @endif
                <a href="{{ route('insertProduct.index') }}" class="btn btn-light">Hủy</a>
            </div>
        </section>
        <div class="container">
            <div class="row position-relative">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <div class="mt-4 w-50" style="float: right;">
                        <div class="d-flex justify-content-between">
                            <span><b>Giá trị trước thuế:</b></span>
                            <span id="total-amount-sum">Đ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span><b>Thuế VAT:</b></span>
                            <span id="product-tax">Đ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-primary">Giảm giá:</span>
                            <span>0đ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-primary">Phí vận chuyển:</span>
                            <span>0đ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-lg"><b>Tổng cộng:</b></span>
                            <span><b id="grand-total">đ</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.content -->
</div>

<script>
    function handlePaste(input) {
        var rowCount = $(input).attr('name').match(/\d+/)[0];
        var clipboardData = event.clipboardData || window.clipboardData;
        var pastedData = clipboardData.getData('Text');
        var rows = pastedData.trim().split('\n');
        var parent_div = $('.div_value' + rowCount + ' table tbody');
        for (var i = 0; i < rows.length; i++) {
            var rowData = rows[i].trim();
            if (rowData === '') {
                continue;
            }
            var newtr = document.createElement('tr');
            var newtd1 = document.createElement('td');
            var newtd2 = document.createElement('td');
            var newtd3 = document.createElement('td');
            var newtd4 = document.createElement('td');
            var newDiv = document.createElement('input');
            var checkbox = document.createElement("input");
            var stt = document.createElement("span");
            var div1 = document.createElement("div");
            checkbox.setAttribute("type", "checkbox");
            newtd1.append(checkbox);
            newDiv.setAttribute("type", "text");
            newDiv.setAttribute("class", "form-control w-25");
            newDiv.setAttribute("name", "product_SN" + rowCount + "[]");
            newDiv.setAttribute("onpaste", "handlePaste(this)");
            newtd3.append(newDiv);
            newtd4.setAttribute('class', 'deleteRow1');
            newtd4.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';
            newtd2.appendChild(stt);
            newtr.append(newtd1);
            newtr.append(newtd2);
            newtr.append(newtd3);
            newtr.append(newtd4);
            var checkboxes = document.querySelectorAll('.div_value' + rowCount + ' table tbody input[type="checkbox"]');
            var checkboxCount = checkboxes.length;
            stt.innerHTML = checkboxCount;
            checkbox.setAttribute("id", "checkbox_" + checkboxCount);
            $('.SNCount').text(checkboxCount);
            newDiv.value = rows[i].trim();
            parent_div[0].appendChild(newtr);
        }
        $(input).parent().parent().remove();
        // $(input).closest('div').remove();
    }

    $(document).ready(function() {
        calculateTotals();
    })

    $(document).on('input', '.quantity-input, [name^="product_price"], .product_tax', function() {
        calculateTotals();
    });

    function calculateTotals() {
        var totalAmount = 0;
        var totalTax = 0;

        // Lặp qua từng hàng
        $('tr').each(function() {
            var productQty = parseInt($(this).find('.quantity-input').val());
            var productPrice = 0;
            var taxValue = $(this).find('.product_tax option:selected').val();
            $(this).find('[name^="product_price"]').each(function() {
                productPrice += parseFloat($(this).val());
            });

            if (!isNaN(productQty) && !isNaN(productPrice) && !isNaN(taxValue)) {
                var rowTotal = productQty * productPrice;
                var rowTax = (productQty * productPrice * taxValue) / 100;

                // Hiển thị kết quả
                $(this).find('[name^="product_total"]').val(rowTotal);
                $(this).find('.product_tax1').text(rowTax);

                // Cộng dồn vào tổng totalAmount và totalTax
                totalAmount += rowTotal;
                totalTax += rowTax;
            }
        });

        // Hiển thị tổng totalAmount và totalTax
        $('#total-amount-sum').text(totalAmount);
        $('#product-tax').text(totalTax);

        // Tính tổng thành tiền và thuế
        calculateGrandTotal(totalAmount, totalTax);
    }

    function calculateGrandTotal(totalAmount, totalTax) {
        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(grandTotal);
    }

    // Hủy đơn hàng
    $(document).on('click', '#deleteBill', function(e) {
        e.preventDefault();
        var order_id = <?php echo $order->id; ?>;
        var deleteUrl = "{{ route('deleteBill', ['order_id' => '']) }}".replace('order_id', order_id);
        $('#form_submit').attr('action', deleteUrl);
        $('#form_submit').submit();
    });

    // Update productSN trước khi thêm dữ liệu
    function updateProductSN() {
        $('.modal-body').each(function(index) {
            var productSN = $(this).find('input[name^="product_SN"]');
            var div_value2 = $(this).find('div[class^="div_value"]');
            productSN.attr('name', 'product_SN' + index + '[]');
            div_value2.attr('class', 'div_value' + index + '[]');
        });
    }

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

    // Chuyển hướng form để thêm dữ liệu
    $(document).on('click', '.addBillEdit', function(e) {
        e.preventDefault();
        if ($('#form_submit')[0].checkValidity()) {
            $('#form_submit').attr('action', '{{ route('addBillEdit') }}');
            $('input[name="_method"]').remove();
            updateProductSN()
            $('#form_submit').submit();
        } else {
            $('#form_submit')[0].reportValidity();
        }

    });

    function updateRowNumbers() {
        $('#table_SNS tbody tr').each(function(index) {
            $(this).find('td').eq(1).text(index + 1);
        });
    }

    function chekckRow() {
        var rowLength = $('#inputContainer tbody tr').length;
        if (rowLength < 1) {
            return false;
        } else {
            return true;
        }
    }

    // Kiểm tra dữ liệu trước khi submit
    $(document).on('submit', '#form_submit', function(e) {
        e.preventDefault();
        var error = false;
        if (chekckRow() == false) {
            error = true;
            alert('Vui lòng nhập ít nhất 1 sản phẩm');
        }
        $('input[name="product_name[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Vui lòng nhập tên sản phẩm')
            }
        });
        $('input[name^="product_total[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Tổng tiền không hợp lệ')
                error = true;
            } else if (isNaN($(this).val())) {
                error = true;
                alert('Tổng tiền phải là số')
            }
        })
        $('input[name="product_qty[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Vui lòng nhập số lượng sản phẩm')
                error = true;
            } else if (isNaN($(this).val())) {
                error = true;
                alert('Số lượng phải là số')
            }
        });

        $('input[name="product_price[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Vui lòng nhập giá sản phẩm')
                error = true;
            } else if (isNaN($(this).val())) {
                alert('Giá phải là số');
                error = true;
            }
        });

        $('input[name="product_SN[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Vui lòng nhập seri number');
                error = true;
            }
        });

        $('input[name^="product_qty[]"]').each(function(index) {
            var qty = $(this).val();
            var sn_count = $('input[name="product_SN' + index + '[]"]').length;
            if (qty != sn_count) {
                error = true;
                alert('Số lượng và seri number không hợp lệ');
            }
        });
        if ($('#provide_id').val().trim() == '' && $('#radio1').prop('checked') == true) {
            error = true;
            alert('Vui lòng chọn nhà cung cấp');
        }
        if (error) {
            return false;
        }
        updateProductSN();
        $(this).off('submit');
        this.submit();
    });

    var rowCount = $('.table_list_order tbody tr').length;
    var last = "<?php echo $lastId; ?>";
    $('.addRow').on('click', function() {
        last++;
        updateRowNumbers();
        var tr = '<tr>' +
            // '<input type="hidden" name="product_id[]" value="' + last + '">' +
            '<td scope="row"><input type="checkbox" id=' + rowCount + '" class="cb-element"></td>' +
            '<td>' +
            '<select name="products_id[]" class="list_products form-control">' +
            '<option value="">Lựa chọn mã sản phẩm  </option> ' +
            '@foreach ($products as $va)' +
            '<option value="{{ $va->id }}">{{ $va->products_code }}</option>' +
            '@endforeach' +
            '</select> ' +
            '</td>' +
            '<td>' +
            '<input id="search" type="text" placeholder="Nhập thông tin sản phẩm" name="product_name[]" class="search_product form-control" onkeyup="filterFunction()"> ' +
            '<div id="dropdown-values" class="dropdown-values"><ul id="myUL1" class="myUL1 bg-white position-absolute rounded shadow" style="padding:0 10px; cursor:pointer;"> </ul>  </div>' +
            '</td>' +
            '<td><input required type="text" class="form-control text-center" style="width:120px" name="product_category[]"></td>' +
            '<td><input required type="text" class="form-control text-center" style="width:80px" name="product_unit[]"></td>' +
            '<td><input required type="number" name="product_qty[]" class="quantity-input form-control text-center"></td>' +
            '<td><input required type="number" class="form-control text-center" style="width:140px" name="product_price[]"></td>' +
            // '<td><input required type="number" name="product_tax[]" class="product_tax form-control" style="width:50px"></td>' +
            '<td>' +
            '<select name="product_tax[]" class="product_tax form-control" style="width:80px">' +
            '<option value="10">10%</option>' +
            '<option value="0">0%</option>' +
            '<option value="8">8%</option>' +
            '<option value="00">NOVAT</option>' +
            '</select>' +
            '</td>' +
            '<td><input readonly type="text" class="form-control text-center" style="width:140px" name="product_total[]"></td>' +
            '<td><input type="text" class="form-control" style="width:140px" name="product_trademark[]"></td>' +
            '<td>' +
            '<button class="exampleModal" name="btn_add_SN[]" type="button" data-toggle="modal" data-target="#exampleModal' +
            rowCount + '" style="background:transparent; border:none;">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="4" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z" fill="#0095F6"/></svg>' +
            '</button>' +
            '</td>' +
            '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
            '</tr>';
        $('#inputContainer tbody').append(tr);
        var modal = '<div class="modal fade" id="exampleModal' + rowCount +
            '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header align-items-center">' +
            '<div> ' +
            '<h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>' +
            '<p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>' +
            '</div>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>' +
            '<div class="modal-body">' +
            ' <table class="table table-hover"> ' +
            '<thead> ' +
            '<tr>' +
            '<th>ID</th>' +
            '<th>Mã sản phẩm</th>' +
            '<th>Tên sản phẩm</th>' +
            '<th>Nhà cung cấp</th>' +
            '<th>Loại hàng</th>' +
            '<th>Số lượng sản phẩm</th>' +
            '<th>Số lượng S/N</th>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr>' +
            '<td>' + rowCount + '</td>' +
            '<td class="code_product"></td>' +
            '<td class="name_product"></td>' +
            '<td class="name_provide"></td>' +
            '<td class="type_product"></td>' +
            '<td class="qty_product"></td>' +
            '<td class="SNCount">1</td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '<h3>Thông tin Serial Number </h3>' +
            '<div class="div_value' + rowCount + '" style="padding:10px;">' +
            '<table class="table" id="table_SNS">' +
            '<thead class="thead-light"> <tr> <th style="width:5%;"><input type="checkbox" ></th> <th style="width:5%;">STT</th> <th> Serial Number</th> <th style="width:3%;"></th> </tr> </thead>' +
            '<tbody> ' +
            '<tr>' +
            '<td><input class="mr-5" type="checkbox" id="checkbox_1"> </td>' +
            '<td><span class="mr-5" >1</span></td>' +
            '<td><input class="mr-5 form-control w-25" required type="text" name="product_SN' + rowCount +
            '[]" onpaste="handlePaste(this)"></td>' +
            '<td class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '</div>' +
            '<div class="AddSN btn btn-secondary" style="border:1px solid gray;">Thêm dòng</div>' +
            '<div class="btn btn-danger ml-2" id="deleteSNS"> Xóa SN </div>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Lưu</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        $('#list_modal').append(modal);

        var addSNBtns = $('.AddSN');
        for (let i = 0; i < addSNBtns.length; i++) {
            $(addSNBtns[i]).off('click').on('click', function() {
                var newtr = document.createElement('tr');
                var newtd1 = document.createElement('td');
                var newtd2 = document.createElement('td');
                var newtd3 = document.createElement('td');
                var newtd = document.createElement('td');
                var newtd4 = document.createElement('td');
                var newDiv = document.createElement("input");
                var checkbox = document.createElement("input");
                var stt = document.createElement("span");
                var div1 = document.createElement("div");
                var div = document.createElement("div");
                var divDelete = document.createElement("div");
                var div_value1 = document.querySelector('.div_value' + i + ' table tbody');
                var checkboxes = document.querySelectorAll('.div_value' + i +
                    ' input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                checkbox.setAttribute("type", "checkbox");
                newtd1.append(checkbox);
                newDiv.setAttribute("type", "text");
                newDiv.setAttribute("class", "form-control w-25");
                newDiv.setAttribute("name", "product_SN" + i + "[]");
                newDiv.setAttribute("onpaste", "handlePaste(this)");
                newtd3.append(newDiv);
                newtd4.setAttribute('class', 'deleteRow1');
                newtd4.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';
                newtd2.appendChild(stt);
                newtr.append(newtd1);
                newtr.append(newtd2);
                newtr.append(newtd3);
                newtr.append(newtd4);
                div_value1.appendChild(newtr);
                stt.innerHTML = checkboxCount;
                checkbox.setAttribute("id", "checkbox_" + checkboxCount);
                document.querySelector('.div_value' + i).parentNode.querySelector('.SNCount')
                    .textContent = checkboxCount;
            });
        }
        rowCount++;

        var list_search = document.querySelectorAll('.search_product');
        if (list_search) {
            for (let i = 0; i < list_search.length; i++) {
                list_search[i].addEventListener('click', function() {
                    var div_show = document.querySelectorAll('.dropdown-values');
                    div_show[i].classList.add("show1");
                });
            }
        }

        addDataToModal();
        chekckRow();
    });

    function addDataToModal() {
        var info = document.querySelectorAll('.exampleModal');
        for (let k = 0; k < info.length; k++) {
            info[k].addEventListener('click', function() {
                var productCode = $(this).closest('tr').find('.list_products option:selected').text();
                var productName = $(this).closest('tr').find('[name^="product_name"]').val();
                var productType = $(this).closest('tr').find('[name^="product_category"]').val();
                var productQty = $(this).closest('tr').find('[name^="product_qty"]').val();
                var provide_name = $('#provide_name').val();
                $('.name_provide').text(provide_name);
                $('.code_product').text(productCode);
                $('.name_product').text(productName);
                $('.type_product').text(productType);
                $('.qty_product').text(productQty);
                var id_modal = $(info[k]).attr('data-target').match(/\d+/)[0];
                var div_value = $('.div_value'+id_modal);
                div_value.closest('.modal-body').find('.SNCount').text(div_value.find('table tbody .stt_SN').length);
                var setSTT = div_value.closest('.modal-body').find('.stt_SN');
                for (let i = 0; i < setSTT.length; i++) {
                    $(setSTT[i]).eq(0).text(i + 1);
                }
            })
        }
    }
    addDataToModal();

    // Hiển thị sản phẩm con 
    $(document).on('change', '.list_products', function(e) {
        e.preventDefault();
        var id = $(this).val();
        var row = $(this).closest('tr');
        var childSelect = row.find('.myUL1');
        var name = row.find('input[name="product_name[]"]');
        name.val("");
        if (id) {
            $.ajax({
                url: "{{ route('showProduct') }}",
                type: "get",
                data: {
                    id: id,
                },
                success: function(data) {
                    childSelect.empty();
                    data.forEach(function(item) {
                        var op = '<li onclick="setValueOfInput(this)">' + item
                            .product_name + '</li>';
                        childSelect.append(op);
                    });
                    childSelect.addClass("show1");
                }
            });
        }
    });

    // Ẩn danh sách sản phẩm con khi click ra ngoài
    $(document).click(function(event) {
        if (!$(event.target).closest(".search_product").length) {
            $(".dropdown-values").removeClass("show1");
        }
    });

    function filterFunction() {
        var filter = $(".search_product").val().toUpperCase();
        var a = $("#dropdown-values ul li");
        a.each(function() {
            var txtValue = $(this).text();
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function setValueOfInput(e) {
        var selectedProductName = $(e).text();
        var row = $(e).closest('tr');
        var productNameInput = row.find('input[name="product_name[]"]');
        productNameInput.val(selectedProductName);
        $(".dropdown-values").removeClass("show1");
    }

    var addSNBtns = $('.AddSN');
    for (let i = 0; i < addSNBtns.length; i++) {
        $(addSNBtns[i]).off('click').on('click', function() {
            var newtr = document.createElement('tr');
            var newtd1 = document.createElement('td');
            var newtd2 = document.createElement('td');
            var newtd3 = document.createElement('td');
            var newtd = document.createElement('td');
            var newtd4 = document.createElement('td');
            var newDiv = document.createElement("input");
            var checkbox = document.createElement("input");
            var stt = document.createElement("span");
            var div1 = document.createElement("div");
            var div = document.createElement("div");
            var divDelete = document.createElement("div");
            var div_value1 = document.querySelector('.div_value' + i + ' table tbody');
            var checkboxes = document.querySelectorAll('.div_value' + i + ' input[type="checkbox"]');
            var checkboxCount = checkboxes.length;
            checkbox.setAttribute("type", "checkbox");
            newtd1.append(checkbox);
            newDiv.setAttribute("type", "text");
            newDiv.setAttribute("class", "form-control w-25");
            newDiv.setAttribute("name", "product_SN" + i + "[]");
            newDiv.setAttribute("onpaste", "handlePaste(this)");
            newtd3.append(newDiv);
            newtd4.setAttribute('class', 'deleteRow1');
            newtd4.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';
            newtd2.appendChild(stt);
            newtr.append(newtd1);
            newtr.append(newtd2);
            newtr.append(newtd3);
            newtr.append(newtd4);
            div_value1.appendChild(newtr);
            stt.innerHTML = checkboxCount;
            checkbox.setAttribute("id", "checkbox_" + checkboxCount);
            document.querySelector('.div_value' + i).parentNode.querySelector('.SNCount').textContent =
                checkboxCount;
        });
    }

    // Xóa hàng trong form
    $('body').on('click', '.deleteRow', function() {
        var parentTr = $(this).closest('tr');
        var targetId = $(this).closest('tr').find('button[name="btn_add_SN[]"]').attr('data-target');
        $(targetId).remove();
        parentTr.remove();
        calculateTotals();
        updateRowNumbers();
        chekckRow();
    });

    // AJAX hiển thị thông tin nhà cung cấp 
    $('.search-info').click(function() {
        var provides_id = $(this).attr('id');
        $('#radio1').prop('checked', true);
        $.ajax({
            url: "{{ route('show_provide') }}",
            type: "get",
            data: {
                provides_id: provides_id,
            },
            success: function(data) {
                $('#infor_provide').html(
                    // '<input type="hidden" name="provide_id" id="provide_id" value="' + data.id +
                    // '">  ' +
                    '<div class="border-bottom p-3 d-flex justify-content-between">' +
                    '<b>Thông tin nhà cung cấp</b>' +
                    '<button id="btn-addCustomer" class="btn btn-primary d-flex align-items-center">' +
                    '<img src="../dist/img/icon/Union.png">' +
                    '<span class="ml-1">Lưu thông tin</span></button></div>' +
                    '<div class="row p-3">' +
                    '<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<label for="congty">Công ty:</label>' +
                    '<input required type="text" class="form-control" id="provide_name" placeholder="Nhập thông tin" name="provide_name" value="' +
                    data.provide_name + '">' +
                    '</div>' + '<div class="form-group">' +
                    '<label>Địa chỉ xuất hóa đơn:</label>' +
                    '<input required type="text" class="form-control" id="provide_address" placeholder="Nhập thông tin" name="provide_address" value="' +
                    data.provide_address + '">' +
                    '</div>' + '<div class="form-group">' +
                    '<label for="email">Mã số thuế:</label>' +
                    '<input required type="text" class="form-control" id="provide_code" placeholder="Nhập thông tin" name="provide_code" value="' +
                    data.provide_code + '">' +
                    '</div>' + '<div class="form-group">' +
                    '</div>' + '</div>' + '<div class="col-sm-6">' +
                    '<div class="form-group">' +
                    '<label for="email">Người đại diện:</label>' +
                    '<input required type="text" class="form-control" id="provide_represent" placeholder="Nhập thông tin" name="provide_represent" value="' +
                    data.provide_represent + '">' +
                    '</div>' + '<div class="form-group">' +
                    '<label for="email">Email:</label>' +
                    '<input required type="email" class="form-control" id="provide_email" placeholder="Nhập thông tin" name="provide_email" value="' +
                    data.provide_email + '">' +
                    '</div>' + '<div class="form-group">' +
                    '<label for="email">Số điện thoại:</label>' +
                    '<input required type="text" class="form-control" id="provide_phone" placeholder="Nhập thông tin" name="provide_phone" value="' +
                    data.provide_phone + '">' +
                    '</div>' + '<div class="form-group">' +
                    '</div>' + '<div class="form-group">' +
                    '</div>' + '<div class="form-group">' +
                    '</div></div></div>'
                );
                $('#provide_id').val(data.id);
            }
        });
    })

    // Ajax thay đổi thông tin khách hàng
    $(document).on('click', '#btn-addProvide', function(e) {
        e.preventDefault();
        var provides_id = $('#provide_id').val();
        var provide_name = $('#provide_name').val();
        var provide_address = $('#provide_address').val();
        var provide_represent = $('#provide_represent').val();
        var provide_email = $('#provide_email').val();
        var provide_phone = $('#provide_phone').val();
        var provide_code = $('#provide_code').val();
        $.ajax({
            url: "{{ route('update_provide') }}",
            type: "get",
            data: {
                provides_id: provides_id,
                provide_name: provide_name,
                provide_address: provide_address,
                provide_represent: provide_represent,
                provide_email: provide_email,
                provide_phone: provide_phone,
                provide_code: provide_code
            },
            success: function(data) {
                alert('Lưu thông tin thành công');
            }
        })
    })

    // Xóa hàng SN
    $(document).on('click', '.deleteRow1', function() {
        var div = $(this).parent('tr');
        var parentTable = div.closest('table');
        div.parent().parent().parent().parent().find('.SNCount').text(div.parent().find(
            'input[type="checkbox"]').length - 1);
        div.remove();
        var remainingRows = parentTable.find('tbody tr');
        remainingRows.each(function(index) {
            $(this).find('td').eq(1).text(index + 1);
        });
    })
</script>
</body>

</html>
