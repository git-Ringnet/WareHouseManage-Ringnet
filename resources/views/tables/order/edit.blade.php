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
                    <span class="ml-1" style="font-size: 16px; font-weight: 500; color: #555555;">Quay lại danh
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
                </div>
                <div class="container-fluided">
                    <div class="row my-3">
                        <div class="col">
                            @if ($order->order_status == 0)
                                @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                                    <div class="w-75">
                                        <div class="input-group mb-1 position-relative w-50">
                                            <input type="text" class="form-control"
                                                placeholder="Nhập thông tin nhà cung cấp" aria-label="Username"
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
                                        <ul id="myUL"
                                            class="bg-white position-absolute w-50 rounded shadow p-0 scroll-data "
                                            style="z-index: 99;">
                                            @foreach ($provide as $value)
                                                <li <?php if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) {
                                                    echo 'class="d-none"';
                                                } ?>>
                                                    <a href="#"
                                                        class="text-dark d-flex justify-content-between p-2 search-info select_page"
                                                        id="{{ $value->id }}" name="select_page">
                                                        <span class="w-50">{{ $value->provide_represent }}</span>
                                                        <span class="w-50">{{ $value->provide_name }}</span>
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
                        <input required oninput="validateNumberInput(this)" type="text" class="form-control"
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
                        <input oninput="validateNumberInput(this)" required type="text" class="form-control"
                            @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif id="provide_phone"
                            placeholder="Nhập thông tin" name="provide_phone"
                            value="{{ $provide_order[0]->provide_phone }}"
                            @if ($order->order_status == 1) <?php echo 'readonly'; ?> @endif>
                    </div>
                    <div class="form-group">
                        <label for="email">Công nợ:</label>
                        <div class="d-flex align-items-center" style="width:101%;"> <input name="provide_debt" id="debtInput" class="form-control" type="text" name="debt" style="width:15%;" value="{{$provide_order[0]->debt}}">
                        <span class="ml-2" id="data-debt" style="color: rgb(29, 28, 32);">ngày</span>
                        <input type="checkbox" id="debtCheckbox" value="0" <?php echo $provide_order[0]->debt == 0 ? "checked" : "" ?> style="margin-left:10%;" >
                        <span class="ml-2">Thanh toán tiền mặt</span> </div>
                        </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <div class="container-fluided">
            <div class="d-flex justify-content-between align-items-center my-2">
                <div class="d-flex">
                    <input type="text" name="product_code" class="form-control"
                        value="{{ $order->product_code }}">
                    <input type="date" name="product_create" class="form-control ml-2"
                        value="{{ $order->created_at->format('Y-m-d') }}">
                </div>
                <div class="d-flex">
                    <label class="btn btn-default btn-file m-2 d-flex">
                        Import file
                        <input type="file" id="import_file" class="import_file" accept=".xml">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z"
                                    fill="#555555" />
                            </svg>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <section class="content mt-3">
            <div style="overflow-x: auto;" class="container-fluided">
                <table class="table table-hover bg-white rounded" id="inputContainer">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>ĐVT</th>
                            <th>Số lượng</th>
                            <th>Giá nhập</th>
                            <th>Thuế</th>
                            <th>Thành tiền</th>
                            <th>Ghi chú</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product_order as $pro)
                            <tr>
                                <td class="STT"></td>
                                <input type="hidden" name="product_id[]" value="{{ $pro->id }}">
                                <td> <input class="form-control name_product"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif type="text"
                                        style="width:auto" name="product_name[]" value="{{ $pro->product_name }}">
                                </td>
                                <td> <input class="form-control text-center unit_product" style="width: 80px"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="text"
                                        name="product_unit[]" value="{{ $pro->product_unit }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td> <input oninput="validatQtyInput(this)"
                                        class="form-control quantity-input text-center"
                                        oninput="validateNumberInput(this)"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="text"
                                        name="product_qty[]" value="{{ $pro->product_qty }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td> <input class="form-control text-center product_price"
                                        @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif required type="text"
                                        style="width:140px" name="product_price[]"
                                        value="{{ number_format($pro->product_price) }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
                                <td>
                                    <select name="product_tax[]" id="" class="form-control product_tax"
                                        style="width:100px;" @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) disabled @endif>>
                                        <option value="0" <?php echo $pro->product_tax == 0 ? 'selected' : ''; ?>>0%</option>
                                        <option value="8" <?php echo $pro->product_tax == 8 ? 'selected' : ''; ?>>8%</option>
                                        <option value="10" <?php echo $pro->product_tax == 10 ? 'selected' : ''; ?>>10%</option>
                                    </select>
                                </td>
                                <input type="hidden" class="product_tax1">
                                <td> <input class="form-control text-center total-amount" style="width:140px" readonly
                                        type="text" name="product_total[]" value="{{ $pro->product_total }}">
                                </td>
                                <td> <input class="form-control" @if ($order->order_status != 0 || (Auth::user()->id != $order->users_id && !Auth::user()->can('isAdmin'))) readonly @endif
                                        type="text" name="product_trademark[]"
                                        value=" {{ $pro->product_trademark }}"
                                        @if (Auth::user()->id != $order->users_id && Auth::user()->roleid != 1) <?php echo 'readonly'; ?> @endif> </td>
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

            <div class="btn-fixed">
                @if ($order->order_status == 0)
                    @if (Auth::user()->id == $order->users_id || Auth::user()->can('isAdmin'))
                        <a href="javascript:;" class="btn btn-primary addBillEdit">Lưu</a>
                    @endif
                @endif
                <a href="{{ route('insertProduct.index') }}" class="btn btn-light">Hủy</a>
            </div>
        </section>
        <div class="row position-relative footer-total">
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
                        <span class="text-lg"><b>Tổng cộng:</b></span>
                        <span><b id="grand-total">đ</b></span>
                        <input type="hidden" name="total_import" class="total_import">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.content -->
</div>
<script src="{{ asset('dist/js/productOrder.js') }}"></script>
<script>
       var isChecked = $('#debtCheckbox').is(':checked');
    // Đặt trạng thái của input dựa trên checkbox
    $('#debtInput').prop('disabled', isChecked);
    // Xử lý sự kiện khi checkbox thay đổi
    $(document).on('change', '#debtCheckbox', function() {
        var isChecked = $(this).is(':checked');
        $('#debtInput').prop('disabled', isChecked);
        $('#debtInput').val(0);
    });

    $(document).ready(function() {
        calculateTotals();
    })

    $(document).on('input', '.quantity-input, [name^="product_price"], .product_tax', function() {
        calculateTotals();
    });


    function calculateGrandTotal(totalAmount, totalTax) {
        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(formatCurrency(grandTotal));
        $('.total_import').val(formatCurrency(grandTotal));
    }

    // Hủy đơn hàng
    $(document).on('click', '#deleteBill', function(e) {
        this.classList.add('disabled');
        var countDown = 10;
        var countdownInterval = setInterval(function() {
            countDown--;
            if (countDown <= 0) {
                clearInterval(countdownInterval);
                $('#deleteBill').removeClass('disabled');
            }
        }, 100);

        e.preventDefault();
        if (myFunction()) {
            var order_id = <?php echo $order->id; ?>;
            var deleteUrl = "{{ route('deleteBill', ['order_id' => '']) }}".replace('order_id', order_id);
            $('#form_submit').attr('action', deleteUrl);
            $('#form_submit').submit();
        }
    });

    // Kiểm tra dữ liệu trước khi submit
    var checkSubmit = false;

    // Chuyển hướng form để thêm dữ liệu
    $(document).on('click', '.addBillEdit', function(e) {
        this.classList.add('disabled');
        var countDown = 10;
        var countdownInterval = setInterval(function() {
            countDown--;
            if (countDown <= 0) {
                clearInterval(countdownInterval);
                $('.addBillEdit').removeClass('disabled');
            }
        }, 100);

        e.preventDefault();
        if ($('#form_submit')[0].checkValidity()) {
            var er = false;
            if (checkRow() == false) {
                er = true;
                alert('Vui lòng nhập ít nhất 1 sản phẩm');
            }

            // Kiểm tra trùng sản phẩm con
            if (checkDuplicateRows()) {
                alert('Sản phẩm đã tồn tại');
            }

            // Kiểm tra có lỗi hay không
            var hasErrors = checkRow() === false ||
                checkDuplicateRows() === true || er === true;

            if (hasErrors) {
                return false;
            } else {
                $('#form_submit').attr('action', '{{ route('addBillEdit') }}');
                $('input[name="_method"]').remove();
                updateProductSN()
                $('#form_submit')[0].submit();
            }
        } else {
            $('#form_submit')[0].reportValidity();
        }
    });

    var rowCount = $('.table_list_order tbody tr').length;
    $('.addRow').on('click', function() {
        updateRowNumbers();
        var tr = '<tr>' +
            '<td class="STT"></td>' +
            '<td>' +
            '<input id="search" type="text" placeholder="Nhập thông tin sản phẩm" name="product_name[]" class="search_product form-control name_product" onkeyup="filterFunction()"> ' +
            '</td>' +
            '<td><input required type="text" class="form-control text-center unit_product" style="width:80px" name="product_unit[]"></td>' +
            '<td><input required type="text" oninput="validatQtyInput(this)" name="product_qty[]" class="quantity-input form-control text-center"></td>' +
            '<td><input required type="text" class="form-control text-center product_price" style="width:140px" name="product_price[]"></td>' +
            '<td>' +
            '<select name="product_tax[]" class="product_tax form-control" style="width:100px">' +
            '<option value="10">10%</option>' +
            '<option value="0">0%</option>' +
            '<option value="8">8%</option>' +
            '<option value="99">NOVAT</option>' +
            '</select>' +
            '</td>' +
            '<td><input readonly type="text" class="form-control text-center total-amount" style="width:140px" name="product_total[]"></td>' +
            '<td><input type="text" class="form-control" style="width:150px" name="product_trademark[]"></td>' +
            '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
            '</tr>';
        $('#inputContainer tbody').append(tr);
        setSTT();
        rowCount++;
        checkRow();
    });
    setSTT();
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

    $('#add_bill').on('click', function(e) {
        this.classList.add('disabled');
        var countDown = 10;
        var countdownInterval = setInterval(function() {
            countDown--;
            if (countDown <= 0) {
                clearInterval(countdownInterval);
                $('#add_bill').removeClass('disabled');
            }
        }, 100);

        e.preventDefault();
        if (myFunction()) {
            if ($('#form_submit')[0].checkValidity()) {
                var er = false;
                if (checkRow() == false) {
                    er = true;
                    alert('Vui lòng nhập ít nhất 1 sản phẩm');
                }

                // Kiểm tra trùng sản phẩm con
                if (checkDuplicateRows()) {
                    er = true;
                    alert('Sản phẩm đã tồn tại');
                }
                if (er) {
                    return false;
                } else {
                    $('#form_submit')[0].submit();
                }
                // Kiểm tra có lỗi hay không
                var hasErrors = isDuplicate || listSNOld.length != countQTY || checkRow() === false ||
                    checkDuplicateRows() === true || er === true;
            } else {
                $('#form_submit')[0].reportValidity();
            }
        }
    })

    // Hàm kiểm tra xác nhận người dùng
    function myFunction() {
        let text = "Bạn có muốn thực hiện thao tác không ?";
        if (confirm(text) == true) {
            return true
        } else {
            return false
        }
    }

    var fileImport = document.getElementById('import_file');
    if (fileImport) {
        fileImport.addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var xmlContent = e.target.result;
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(xmlContent, 'text/xml');
                var THHDVu = xmlDoc.getElementsByTagName('THHDVu');
                var SLuong = xmlDoc.getElementsByTagName('SLuong');
                var DVTinh = xmlDoc.getElementsByTagName('DVTinh');
                var DGia = xmlDoc.getElementsByTagName('DGia');
                var TSuat = xmlDoc.getElementsByTagName('TSuat');
                // $('tbody tr').remove();
                // Tạo các ô input mới và đặt giá trị của chúng
                for (var i = 0; i < THHDVu.length; i++) {
                    var tax = 0;
                    if (TSuat[i].textContent == "KCT") {
                        tax = 0;
                    } else {
                        tax = parseInt(TSuat[i].textContent.match(/\d+/)[0]);
                    }
                    var titlesValue = THHDVu[i].textContent;
                    var numberssValue = Math.floor(SLuong[i].textContent).toString();
                    var typeValue = DVTinh[i].textContent;
                    var price = formatCurrency(Math.floor(DGia[i].textContent).toString());
                    var totalPrice = formatCurrency(numberssValue * (price.replace(/[^0-9.-]+/g, "")));
                    var tr = '<tr>' +
                        '<td class="STT"></td>' +
                        '<td><input required type="text" class="search_product form-control" name="product_name[]" value="' +
                        titlesValue +
                        '"></td>' +
                        '<td><input required type="text" class="form-control text-center" style="width:80px" name="product_unit[]" value="' +
                        typeValue +
                        '"></td>' +
                        '<td><input required type="text" oninput="validatQtyInput(this)" name="product_qty[]" class="quantity-input form-control text-center" value="' +
                        numberssValue + '"></td>' +
                        '<td><input required type="text" class="form-control product_price text-center" style="width:140px" name="product_price[]" value="' +
                        price + '"></td>' +
                        '<input type="hidden" class="product_tax1">' +
                        '<td>' +
                        '<select style="width:100px;" name="product_tax[]"class="product_tax form-control" >' +
                        '<option value="10"' + (tax == 10 ? "selected" : "") + '>10%</option>' +
                        '<option value="0" ' + (tax == 0 ? "selected" : "") + '>0%</option>' +
                        '<option value="8" ' + (tax == 8 ? "selected" : "") + '>8%</option>' +
                        '<option value="99" ' + (tax == 99 ? "selected" : "") + '>8%</option>' +
                        '</select' +
                        '</td>' +
                        '<td><input readonly type="text" style="width:140px" class="form-control text-center total-amount" name="product_total[]" value=""></td>' +
                        '<td><input style="with:150px;" type="text" class="form-control" style="width:140px" name="product_trademark[]"></td>' +
                        '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
                        '</tr>';
                    $('#inputContainer tbody').append(tr);
                    deleteDuplicateTr();
                    rowCount++;
                    calculateTotals();
                    setSTT();
                }
            };
            reader.readAsText(file);
            checkRow();
            fileImport.value = "";
        });
    }
    $(document).on('keypress', 'form', function(event) {
        return event.keyCode != 13;
    });
</script>
</body>

</html>
