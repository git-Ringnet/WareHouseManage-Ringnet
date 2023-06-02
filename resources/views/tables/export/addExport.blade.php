<x-navbar :title="$title"></x-navbar>
<div class="content-wrapper export-add">
    <section class="content">
        <div class="container-fluid position-relative">
            <div class="row">
                <div class="col-sm-6">
                    <div class="w-75">
                        <div class="">
                            <span>Xuất hàng</span>
                            <span>/</span>
                            <span><b>Đơn hàng mới</b></span>
                        </div>
                        <div class="mt-3">
                            {{-- <a href="#" class="btn btn-danger text-white">Chốt đơn</a>
                            <a href="#" class="btn btn-secondary ml-4">Hủy đơn</a> --}}
                            <a href="#" class="btn border border-secondary ml-4">Xuất file</a>
                            <button class="btn border border-secondary ml-4" onclick="toggleDiv()">
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
                            </button>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex">
                                <input type="radio" name="options" id="radio1" checked>
                                <span class="ml-1">Khách hàng cũ</span>
                                <input type="radio" name="options" id="radio2" style="margin-left: 40px;">
                                <span class="ml-1">Khách hàng mới</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="input-group mb-1 position-relative">
                                <input type="text" class="form-control" placeholder="Nhập thông tin khách hàng"
                                    aria-label="Username" aria-describedby="basic-addon1" id="myInput"
                                    autocomplete="off">
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
                            <ul id="myUL" class="bg-white position-absolute w-100 rounded shadow"
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
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
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
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z"
                                        fill="#D6D6D6" />
                                    <path
                                        d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z"
                                        fill="#D6D6D6" />
                                </svg>
                                <p class="text-center p-0 m-0">
                                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="3" cy="3" r="3" fill="#D6D6D6" />
                                    </svg>
                                </p>
                            </span>
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
            <form action="{{ route('exports.store') }}" method="POST" id="export_form">
                @csrf
                {{-- Form thông tin khách hàng --}}
                <section id="data-container" class="container-fluid bg-white"></section>
                {{-- Bảng thêm sản phẩm --}}
                <div class="mt-4" style="overflow-x: scroll;">
                    <table class="table" id="sourceTable">
                        <thead class="bg-white border-0 rounded-top">
                            <tr>
                                <th><input type="checkbox"></th>
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
                            <tr id="dynamic-fields"></tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <span class="btn btn-secondary" id="add-field-btn">Thêm sản phẩm</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row position-relative">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="mt-4 w-50" style="float: right;">
                            <div class="d-flex justify-content-between">
                                <span><b>Giá trị trước thuế:</b></span>
                                <span id="total-amount-sum">{{ number_format(0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span><b>Thuế VAT:</b></span>
                                <span id="product-tax">{{ number_format(0) }}</span>
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
                                <span><b id="grand-total" data-value="0">{{ number_format(0) }}</b></span>
                                <input type="text" hidden name="totalValue" value="0" id="total">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" name="action" class="btn btn-primary mr-1"
                        onclick="validateAndSubmit(event)">Lưu</button>
                    <a href="{{ route('exports.index') }}"><span class="btn border-secondary ml-1">Hủy</span></a>
                </div>
            </form>
            {{-- Modal Product --}}
            <div class="modal fade" id="productModal" tabindex="-1" role="dialog"
                aria-labelledby="productModalLabel" aria-hidden="true">
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
            <div class="modal fade" id="snModal" tabindex="-1" role="dialog"
                aria-labelledby="productModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
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
        </div>
    </section>
</div>
<div id="print-price">
    <div class="container">
        <div class="text-center">
            <img src='../dist/img/print/Print1.jpg' width="100%">
        </div>
        <div class="text-center my-4">
            <h1><b>ĐƠN ĐẶT HÀNG</b></h1>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class>
                    <span>Kính gửi:</span>
                    <span><b>CÔNG TY THƯƠNG MẠI DỊCH VỤ ABC</b></span>
                </div>
                <div class>
                    <span>Địa chỉ:</span>
                    <span>38 Út Tịch, P4, Quận Tân Bình</span>
                </div>
                <div class>
                    <span>MST:</span>
                    <span>0123496575</span>
                </div>
                <div class>
                    <span>
                        Người liên hệ:
                    </span>
                    <span>
                        <b>Trần Nguyễn Mai A</b>
                    </span>
                    <span>-</span>
                    <span>Phone:</span>
                    <span><b>0123496575</b></span>
                </div>
                <div class>
                    <span><b><u><i>Kính gửi:</i></u></b></span>
                    <span><b>Quý khách hàng</b></span>
                    <p>Công ty Khang Yến trân trọng gởi đến quý khách
                        hàng
                        báo giá chi tiết sau:</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class>
                    <span><i>Date:</i></span>
                    <span><i>30/03/2023</i></span>
                </div>
                <div class>
                    <span><i>From:</i></span>
                    <span><i>Sale 1</i></span>
                </div>
                <div class>
                    <span><i>Email:</i></span>
                </div>
                <div class>
                    <span><i>Mobile:</i></span>
                    <span><i>0934567814</i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <table id="destinationTable">
            <thead>
                <tr>
                    <th class="text-center">P/N</th>
                    <th class="text-center">CHI TIẾT CẤU HÌNH KỸ THUẬT</th>
                    <th class="text-center">SL</th>
                    <th class="text-center">ĐƠN GIÁ</th>
                    <th class="text-center">THÀNH TIỀN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td>Cisco Catalyst 9800-CL Wireless Controller for Cloud</td>
                    <td class="text-center">3</td>
                    <td class="text-right">5,600,000</td>
                    <td class="text-right">16,800,000</td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Thiết bị quản lý không dây Cisco Catalyst 9800-CL</td>
                    <td class="text-center">4</td>
                    <td class="text-right">4,750,000</td>
                    <td class="text-right">19,000,000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center">
                        <b style="color: #EC212D;">Tổng cộng tiền hàng:</b>
                    </td>
                    <td style="color: #EC212D;" class="text-right"><b>35,800,000</b></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center" style="color: #EC212D;">
                        <b>Thuế VAT 10%:</b>
                    </td>
                    <td style="color: #EC212D;" class="text-right"><b>3,580,000</b></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center"><b style="color: #EC212D;">Thành tiền:</b></td>
                    <td style="color: #EC212D;" class="text-right"><b>39,380,000</b></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-center">
                        <b>(Bằng chữ: Ba mươi chín triệu ba trăm tám mươi
                            ngàn đồng chẵn).
                        </b>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="mt-4">
            <p class="p-0 m-0"><b><u><i>*Ghi chú:</i></u></b></p>
            <ul>
                <li>1. Bảng giá chào hàng này có giá trị trong vòng 15 ngày.</li>
                <li>2. Giá trên đã bao gồm thuế VAT 10%.</li>
                <li>3. Thời gian giao hàng: 01 ngày.</li>
                <li>4. Hình thức thanh toán: Thanh toán 100% sau khi duyệt đặt hàng.</li>
                <li>5. Phương thức thanh toán: Chuyển khoản.</li>
                <li>6. Hàng đầy đủ CO, CQ.</li>
            </ul>
        </div>
        <div class="p-4" style="border: 2px solid black;">
            <div class="text-center"><b>Công ty TNHH Công Nghệ Khanh Yến</b></div>
            <div class="text-center">Số tài khoản: 3334449988</div>
            <div class="text-center">Tại: Ngân hàng ACB - CN Tây Sài Gòn</div>
        </div>
        <div class="d-flex justify-content-between p-5">
            <span><b><i>Khách hàng xác nhận đặt hàng</i></b></span>
            <span><b>Nhân viên</b></span>
        </div>
    </div>
</div>
<script>
    //form thong tin khach hang xuất hàng
    var radio1 = document.getElementById("radio1");
    var radio2 = document.getElementById("radio2");
    $("#radio1").on("click", function() {
        $('#data-container').empty();
    });
    $("#radio2").on("click", function() {
        $('#data-container').html(
            '<div id="form-guest">' +
            '<div class="border-bottom p-3 d-flex justify-content-between">' +
            '<b>Thông tin khách hàng</b>' +
            '<button id="btn-addCustomer" class="btn btn-primary">' +
            '<img src="../dist/img/icon/Union.png">' +
            '<span>Lưu thông tin</span></button></div>' +
            '<div class="row p-3">' +
            '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<input type="text" hidden class="form-control" name="id" value="{{ (int) $guest_id->id }}">' +
            '<label for="congty">Công ty:</label>' +
            '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label>Địa chỉ xuất hóa đơn:</label>' +
            '<input type="text" class="form-control" id="guest_addressInvoice" placeholder="Nhập thông tin" name="guest_addressInvoice" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Mã số thuế:</label>' +
            '<input type="text" class="form-control" id="guest_code" placeholder="Nhập thông tin" name="guest_code" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Địa chỉ giao hàng:</label>' +
            '<input type="text" class="form-control" id="guest_addressDeliver" placeholder="Nhập thông tin" name="guest_addressDeliver" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Người nhận hàng:</label>' +
            '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">SĐT người nhận:</label>' +
            '<input type="text" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="" required>' +
            '</div>' + '</div>' + '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<label for="email">Người đại diện:</label>' +
            '<input type="text" class="form-control" id="guest_represent" placeholder="Nhập thông tin" name="guest_represent" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Email:</label>' +
            '<input type="email" class="form-control" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Số điện thoại:</label>' +
            '<input type="text" class="form-control" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="" required>' +
            '</div>' + '<div class="form-group">' +
            ' <label for="email">Hình thức thanh toán:</label>' +
            '<input type="text" class="form-control" id="guest_pay" placeholder="Nhập thông tin" name="guest_pay" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Điều kiện thanh toán:</label>' +
            '<input type="text" class="form-control" id="guest_payTerm" placeholder="Nhập thông tin" name="guest_payTerm" value="" required>' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Ghi chú:</label>' +
            '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="" required>' +
            '</div></div></div></div>'
        );
    });
    //add sản phẩm
    $(document).ready(function() {
        let fieldCounter = 1;
        let isFirstClick = true;
        $("#add-field-btn").click(function() {
            if (!isFirstClick) {
                var maProduct = $('.maProduct:last').val();
                var productUnit = $('.product_unit:last').val();
                var productQty = $('.quantity-input:last').val();
                var productPrice = $('.product_price:last').val();
                var productTax = $('.product_tax:last').val();
                if (!maProduct || !productUnit || !productQty || !productPrice || !productTax) {
                    alert('Vui lòng nhập đủ thông tin sản phẩm.');
                    return;
                }
            }
            // Tạo các phần tử HTML mới
            const newRow = $("<tr>", {
                "id": `dynamic-row-${fieldCounter}`
            });
            const checkbox = $("<td><input type='checkbox'></td>");
            const MaInput = $("<td>", {
                "text": `${fieldCounter}`
            });
            const TenInput = $("<td>" +
                "<select id='maProduct' class='p-1 pr-5 maProduct' name='products_id[]'>" +
                "<option value=''>Lựa chọn sản phẩm</option>" +
                '@foreach ($products as $value)' +
                "<option value='{{ $value->id }}'>{{ $value->products_code }}</option>" +
                '@endforeach' +
                "</select>"
            );
            const ProInput = $("<td>" +
                "<select class='child-select p-1 pr-5 productName' name='product_id[]'>" +
                "<option value=''>Lựa chọn sản phẩm</option>" +
                "</select>" +
                "</td>");
            const dvtInput = $(
                "<td><input type='text' id='product_unit' class='product_unit' name='product_unit[]' required></td>"
            );
            const slInput = $(
                "<td><input type='number' id='product_qty' class='quantity-input' name='product_qty[]' required></td>"
            );
            const giaInput = $(
                "<td><input type='number' class='product_price' id='product_price' name='product_price[]' required></td>"
            );
            const ghichuInput = $(
                "<td><input type='text' class='note_product' name='product_note[]'></td>");
            const thueInput = $("<td>" +
                "<input type='number' id='product_tax' class='product_tax' name='product_tax[]' required>" +
                "</td>");
            const thanhTienInput = $("<td><span class='px-5 total-amount'>0</span></td>");
            const sn = $(
                "<td data-toggle='modal' data-target='#snModal' class='sn'><img src='../dist/img/icon/list.png'></td>"
            );
            const info = $(
                "<td data-toggle='modal' data-target='#productModal'><img src='../dist/img/icon/Group.png'></td>"
            );
            const deleteBtn = $("<td><img src='../dist/img/icon/vector.png'></td>", {
                "class": "delete-row-btn"
            });
            //Xóa sản phẩm
            deleteBtn.click(function() {
                $(this).closest("tr").remove();
                calculateTotalAmount();
                calculateGrandTotal();
                isFirstClick = true;
            });
            //lấy S/N
            sn.click(function() {
                var qty = $(this).closest('tr').find('.quantity-input').val();
                var productCode = $(this).closest('tr').find('.productName').val();
                console.log(productCode);
                $.ajax({
                    url: "{{ route('getSN') }}",
                    method: 'GET',
                    data: {
                        qty: qty,
                        productCode: productCode,
                    },
                    success: function(response) {
                        var modalBody = $('#snModal').find(
                            '.modal-body');
                        modalBody.empty();
                        var snList = $('<ul>');
                        response.forEach(function(sn) {
                            var snItem = $('<li>').text(sn
                                .serinumber);
                            snList.append(snItem);
                        });
                        modalBody.append(snList);
                        $('#snModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
            //xem thông tin sản phẩm
            info.click(function() {
                var productCode = $(this).closest('tr').find('.maProduct option:selected')
                    .text();
                var productName = $(this).closest('tr').find('.productName option:selected')
                    .text();
                var dvt = $(this).closest('tr').find('.product_unit').val();
                var soluong = $(this).closest('tr').find('.quantity-input')
                    .val();
                var giaBan = $(this).closest('tr').find('.product_price')
                    .val();
                var ghiChu = $(this).closest('tr').find('.note_product')
                    .val();
                var thue = $(this).closest('tr').find('.product_tax')
                    .val();
                var thanhTien = $(this).closest('tr').find('.total-amount')
                    .text();
                $('#productModal').find('.modal-body').html('<b>Mã sản phẩm:</b> ' +
                    productCode +
                    '<br>' + '<b>Tên sản phẩm:</b> ' + productName + '<br>' +
                    '<b>ĐVT:</b> ' + dvt + '<br>' + '<b>Số lượng: </b>' + soluong + '<br>' +
                    '<b>Giá bán: </b>' + giaBan + '<br>' + '<b>Ghi chú: </b>' + ghiChu +
                    '<br>' + '<b>Thuế:</b> ' + thue + '<br>' + '<b>Thành tiền:</b> ' +
                    thanhTien);
            });
            // Gắn các phần tử vào hàng mới
            newRow.append(checkbox, MaInput, TenInput, ProInput, dvtInput, slInput,
                giaInput, ghichuInput, thueInput, thanhTienInput, sn, info, deleteBtn);
            $("#dynamic-fields").before(newRow);
            // Tăng giá trị fieldCounter
            fieldCounter++;
            isFirstClick = false;
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
                        '<div class="border-bottom p-3 d-flex justify-content-between">' +
                        '<b>Thông tin khách hàng</b>' +
                        '<button id="btn-customer" class="btn btn-primary">' +
                        '<img src="../dist/img/icon/Union.png">' +
                        '<span>Lưu thông tin</span></button></div>' +
                        '<div class="row p-3">' +
                        '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<input type="text" hidden class="form-control" id="id" name="id" value="' +
                        data.id + '" required>' +
                        '<label for="congty">Công ty:</label>' +
                        '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="' +
                        data.guest_name + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label>Địa chỉ xuất hóa đơn:</label>' +
                        '<input type="text" class="form-control" placeholder="Nhập thông tin" id="guest_addressInvoice" name="guest_addressInvoice" value="' +
                        data.guest_addressInvoice + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Mã số thuế:</label>' +
                        '<input type="text" class="form-control" id="guest_code" placeholder="Nhập thông tin" name="guest_code" value="' +
                        data.guest_code + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Địa chỉ giao hàng:</label>' +
                        '<input type="text" class="form-control" id="guest_addressDeliver" placeholder="Nhập thông tin" name="guest_addressDeliver" value="' +
                        data.guest_addressDeliver + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Người nhận hàng:</label>' +
                        '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="' +
                        data.guest_receiver + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">SĐT người nhận:</label>' +
                        '<input type="text" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="' +
                        data.guest_phoneReceiver + '">' +
                        '</div>' + '</div>' + '<div class="col-sm-6">' +
                        '<div class="form-group">' +
                        '<label for="email">Người đại diện:</label>' +
                        '<input type="text" class="form-control" id="guest_represent" placeholder="Nhập thông tin" name="guest_represent" value="' +
                        data.guest_represent + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Email:</label>' +
                        '<input type="email" class="form-control" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="' +
                        data.guest_email + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Số điện thoại:</label>' +
                        '<input type="text" class="form-control" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="' +
                        data.guest_phone + '" required>' +
                        '</div>' + '<div class="form-group">' +
                        ' <label for="email">Hình thức thanh toán:</label>' +
                        '<input type="text" class="form-control" id="guest_pay" placeholder="Nhập thông tin" name="guest_pay" value="' +
                        data.guest_pay + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Điều kiện thanh toán:</label>' +
                        '<input type="text" class="form-control" id="guest_payTerm" placeholder="Nhập thông tin" name="guest_payTerm" value="' +
                        data.guest_payTerm + '">' +
                        '</div>' + '<div class="form-group">' +
                        '<label for="email">Ghi chú:</label>' +
                        '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="' +
                        data.guest_note + '">' +
                        '</div></div></div><div>'
                    );
                }
            });
        });
    });
    //cập nhật thông tin khách hàng
    $(document).on('click', '#btn-customer', function(e) {
        e.preventDefault();
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
        var guest_payTerm = $('#guest_payTerm').val();
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
                guest_payTerm,
                guest_note
            },
            success: function(data) {
                alert('Lưu thông tin thành công');
            }
        })
    })
    //thêm thông tin khách hàng
    $(document).on('click', '#btn-addCustomer', function(e) {
        e.preventDefault();
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
        var guest_payTerm = $('#guest_payTerm').val();
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
                guest_payTerm,
                guest_note
            },
            success: function(data) {
                alert('Thêm thông tin thành công');
            }
        })
    })
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
            if (idProduct) {
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    type: "get",
                    data: {
                        idProduct: idProduct,
                    },
                    success: function(response) {
                        productUnitElement.val(response.product_unit);
                    },
                });
            }

            // Check if the selected product name is already in use
            if (selectedProductNames.includes(selectedName)) {
                $(this).val('');
            } else {
                selectedProductNames.push(selectedName);
            }

            // Hide the selected product name from other child select options
            hideSelectedProductNames(row);
        });

        // Function to hide selected product names from other child select options
        function hideSelectedProductNames(row) {
            var selectedNames = row.find('.child-select').map(function() {
                return $(this).val();
            }).get();

            row.find('.child-select').each(function() {
                var currentName = $(this).val();
                $(this).find('option').each(function() {
                    if ($(this).val() !== currentName && selectedNames.includes($(this)
                            .val())) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            });
        }
    });
    //Kiểm tra số lượng rỗng hoặc nhỏ hơn hoặc bằng 0
    $(document).on('blur', '.quantity-input', function() {
        var input = $(this);
        var quantity = input.val();
        if (quantity < 0) {
            input.val('');
            alert('Số lượng không hợp lệ');
        }
    });
    //tính thành tiền của sản phẩm
    $(document).on('input', '.quantity-input, [name^="product_price"], .product_tax', function() {
        var productQty = parseInt($(this).closest('tr').find('.quantity-input').val());
        var productPrice = 0;
        var grandTotal = parseFloat($('#grand-total').text());
        $('#grand-total').attr('data-value', grandTotal);
        $('#inputValue').val(grandTotal);
        $(this).closest('tr').find('[name^="product_price"]').each(function() {
            productPrice += parseFloat($(this).val());
        });
        var taxValue = parseFloat($(this).closest('tr').find('.product_tax').val());

        if (!isNaN(productQty) && !isNaN(productPrice) && !isNaN(taxValue)) {
            var totalAmount = productQty * productPrice;
            var taxAmount = (productQty * productPrice * taxValue) / 100;

            $(this).closest('tr').find('.total-amount').text(totalAmount);
            $(this).closest('tr').find('.product_tax').text(taxAmount);

            calculateTotalAmount();
            calculateTotalTax();
        }
    });

    function calculateTotalAmount() {
        var totalAmount = 0;
        $('tr').each(function() {
            var rowTotal = parseFloat($(this).find('.total-amount').text());
            if (!isNaN(rowTotal)) {
                totalAmount += rowTotal;
            }
        });
        $('#total-amount-sum').text(totalAmount);

        // Tính toán lại tổng thành tiền và tổng thuế
        calculateTotalTax();
        calculateGrandTotal();
    }

    function calculateTotalTax() {
        var totalTax = 0;
        $('tr').each(function() {
            var rowTax = parseFloat($(this).find('.product_tax').text());
            if (!isNaN(rowTax)) {
                totalTax += rowTax;
            }
        });
        $('#product-tax').text(totalTax);

        // Tính toán lại tổng thành tiền và tổng thuế
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var totalAmount = parseFloat($('#total-amount-sum').text());
        var totalTax = parseFloat($('#product-tax').text());

        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(grandTotal.toFixed(2));

        // Cập nhật giá trị data-value
        $('#grand-total').attr('data-value', grandTotal.toFixed(2));
        $('#total').val(grandTotal.toFixed(2));
    }
    //hàm kiểm tra submit
    function validateAndSubmit(event) {
        var formGuest = $('#form-guest');

        if (formGuest.length) {
            var requiredInputs = formGuest.find(':input[required]');
            var isValid = true;

            // Kiểm tra tất cả các trường required
            requiredInputs.each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    return false; // Dừng vòng lặp nếu có trường không hợp lệ
                }
            });
            var maProduct = $('.maProduct:last').val();
            var productUnit = $('.product_unit:last').val();
            var productQty = $('.quantity-input:last').val();
            var productPrice = $('.product_price:last').val();
            var productTax = $('.product_tax:last').val();
            if (!maProduct || !productUnit || !productQty || !productPrice || !productTax) {
                alert('Vui lòng nhập đủ thông tin sản phẩm.');
                return;
            }
            else if (isValid) {
                $('#export_form').submit();
                $('#btn-addCustomer').click();
            } else {
                alert('Lỗi: Vui lòng điền đầy đủ thông tin!');
                event.preventDefault();
            }
        } else {
            alert('Lỗi: Chưa chọn nhà cung cấp!');
            event.preventDefault();
        }
    }
    //in báo giá
    function toggleDiv() {
        var sourceTable = document.getElementById('sourceTable');
        var destinationTable = document.getElementById('destinationTable');

        // Clear the content of the destination table
        destinationTable.innerHTML = '';

        // Clone the <thead> section from the source table
        var sourceHeader = sourceTable.querySelector('thead');
        var destinationHeader = sourceHeader.cloneNode(true);
        destinationTable.appendChild(destinationHeader);

        // Get the rows from the source table
        var rows = sourceTable.tBodies[0].rows;

        // Clone the data rows from the source table to the destination table
        for (var i = 0; i < rows.length; i++) {
            var row = document.createElement('tr');

            // Get the <select> element from the source table
            var selectElement = rows[i].querySelector('select');

            // Check if a <select> element exists
            if (selectElement) {
                // Get the selected option from the <select> element
                var selectedOption = selectElement.value;

                // Create a new <td> element for the selected option
                var cell1 = document.createElement('td');
                cell1.textContent = selectedOption;

                // Clone the other cells in the row
                var cell2 = rows[i].cells[2].cloneNode(true); // Column "Mã sản phẩm"
                var cell3 = rows[i].cells[3].cloneNode(true); // Column "Tên sản phẩm"
                var cell4 = rows[i].cells[5].cloneNode(true); // Column "Số lượng"
                var cell5 = rows[i].cells[6].cloneNode(true); // Column "Giá bán"
                var cell6 = rows[i].cells[9].cloneNode(true); // Column "Thành tiền"

                // Append the cells to the row
                row.appendChild(cell1);
                row.appendChild(cell2);
                row.appendChild(cell3);
                row.appendChild(cell4);
                row.appendChild(cell5);
                row.appendChild(cell6);

                // Append the row to the destination table
                destinationTable.tBodies[0].appendChild(row);
            }
        }

        // Print the content
        window.print();
    }
</script>
</body>

</html>
