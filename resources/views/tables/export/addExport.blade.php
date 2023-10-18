<x-navbar :title="$title"></x-navbar>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<div class="content-wrapper export-add padding-112">
    <div class="row">
        <div class="col-sm-6 breadcrumb">
            <span><a href="{{ route('exports.index') }}">Xuất hàng</a></span>
            <span class="px-1">/</span>
            <span><b>Đơn hàng mới</b></span>
        </div>
        <div class="col-sm-6 position-absolute responsive-export" style="top:63px;right:2%">
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
        <input type="hidden" name="checkguest" value="" id="checkguest">
        <div id="selectedSerialNumbersContainer"></div>
        <section class="content">
            <div class="d-flex mb-1 action-don">
                <button type="submit" class="btn btn-danger text-white mr-3" id="chot_don" name="submitBtn"
                    value="action1" onclick="validateAndSubmit(event)">Chốt đơn</button>
                {{-- <a href="#" class="btn btn-secondary ml-4">Hủy đơn</a> --}}
                {{-- <a href="#" class="btn border border-secondary mx-4">Xuất file</a> --}}
            </div>
            <div class="container-fluided position-relative">
                <div class="row my-3">
                    <div class="col">
                        <div class="w-75">
                            <div class="d-flex mb-2">
                                <input type="radio" name="options" id="radio1" checked>
                                <span class="ml-1">Khách hàng cũ</span>
                                <input type="radio" name="options" id="radio2" style="margin-left: 40px;">
                                <span class="ml-1">Khách hàng mới</span>
                            </div>
                            <div class="input-group mb-1 position-relative w-50">
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
                            <ul id="myUL" class="bg-white position-absolute rounded shadow p-0 scroll-data"
                                style="z-index: 999;width:37%;">
                                @foreach ($customer as $item)
                                    {{-- @if (Auth::user()->id == $item->user_id || Auth::user()->can('isAdmin')) --}}
                                    <li class="p-2 search-info" id="{{ $item->id }}" name="search-info">
                                        <a href="#" class="text-dark justify-content-between p-2">
                                            <span class="w-50">{{ $item->guest_name }}</span>
                                        </a>
                                    </li>
                                    {{-- @endif --}}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Form thông tin khách hàng --}}
            <section id="data-container" class="container-fluided bg-white rounded"></section>
            <div class="d-flex align-items-center my-2">
                <div class="">
                    <p class="m-0" style="padding: 0.375rem 0.75rem;"><b>Số hóa đơn</b></p>
                    <input type="number" value="" name="export_code" class="form-control"
                        placeholder="Nhập thông tin">
                </div>
                <div class="pl-3">
                    <p class="m-0" style="padding: 0.375rem 0.75rem;"><b>Ngày hóa đơn</b></p>
                    <input type="date" value="" name="export_create" class="form-control">
                </div>
            </div>
            {{-- Bảng thêm sản phẩm --}}
            <div class="mt-4" style="overflow-x: scroll !important; height: 45vh !important;">
                <table class="table table-hover bg-white rounded" id="sourceTable">
                    <thead class="sticky-head">
                        <tr>
                            <th style="width:3%;">STT</th>
                            <th style="width:30%;">Tên sản phẩm</th>
                            <th style="width:8%;">ĐVT</th>
                            <th style="width:8%">Số lượng</th>
                            <th style="width:12%;">Giá bán</th>
                            <th style="width:8%;">Thuế</th>
                            <th style="width:15%;">Thành tiền</th>
                            <th style="width:13%;">Ghi chú</th>
                            <th style="width:10%;">S/N</th>
                            <th style="width:10%;"></th>
                            <th style="width:10%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="dynamic-fields"></tr>
                    </tbody>
                </table>
                <div class="mb-2"> <span class="btn btn-secondary" id="add-field-btn">Thêm sản phẩm</span>
                </div>
            </div>
            <div class="row position-relative footer-total">
                <div class="col-sm-6">
                    {{-- <div class="mt-4 w-75" style="float: left;">
                        <b class="pl-2">*Ghi chú báo giá</b>
                        <div class="position-relative">
                            <input type="hidden" name="creator" id="creator" value="{{ Auth::user()->id }}">
                            <textarea name="note_form" id="note_form" class="form-control" rows="8">{{ Auth::user()->note_form }}</textarea>
                            <div id="btn-addNoteForm" class="disable">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.43364 3H8.07596H15.1555H15.3069C15.6265 3 15.943 3.06298 16.2382 3.18535C16.5335 3.30771 16.8017 3.48706 17.0276 3.71314L19.53 6.2155C19.9864 6.67177 20.2429 7.2907 20.243 7.93604V17.8227C20.243 18.4681 19.9866 19.0871 19.5303 19.5435C19.0739 19.9999 18.4549 20.2563 17.8095 20.2563L16.0466 20.2563H7.19724L5.52568 20.2563C4.8834 20.2563 4.26716 20.0024 3.8113 19.55C3.35544 19.0975 3.09692 18.4832 3.0921 17.8409L3.00007 5.45183C2.99767 5.13073 3.05883 4.81228 3.18005 4.51493C3.30127 4.21757 3.48014 3.94713 3.70636 3.71922C3.93258 3.4913 4.20167 3.31041 4.49812 3.18698C4.79456 3.06354 5.11253 2.99999 5.43364 3ZM7.86094 18.9289H15.3829V12.7662C15.3829 12.5041 15.17 12.2918 14.9095 12.2918H8.33527C8.07351 12.2918 7.86094 12.5044 7.86094 12.7662V18.9289ZM16.7103 18.9289V12.7662C16.7103 11.7716 15.9038 10.9644 14.9095 10.9644H8.33527C7.34041 10.9644 6.53354 11.7713 6.53354 12.7662V18.9289H5.52566C5.2337 18.9289 4.95359 18.8135 4.74638 18.6078C4.53918 18.4022 4.42167 18.1229 4.41947 17.831L4.32744 5.44187C4.32634 5.29591 4.35415 5.15118 4.40924 5.01601C4.46434 4.88085 4.54565 4.75792 4.64848 4.65432C4.7513 4.55072 4.87362 4.4685 5.00837 4.41239C5.14312 4.35629 5.28764 4.3274 5.43361 4.32741H7.41226V7.12292C7.41226 7.53364 7.57542 7.92755 7.86585 8.21797C8.15627 8.5084 8.55018 8.67156 8.9609 8.67156H14.2705C14.6812 8.67156 15.0751 8.5084 15.3656 8.21797C15.656 7.92755 15.8192 7.53364 15.8192 7.12292V4.45331C15.9184 4.50525 16.0094 4.57211 16.0889 4.65158L18.5915 7.15426C18.799 7.36162 18.9155 7.64302 18.9156 7.93632V17.8227C18.9156 18.1161 18.7991 18.3974 18.5916 18.6049C18.3842 18.8123 18.1028 18.9289 17.8095 18.9289H16.7103ZM14.4918 7.12292V4.32741H8.73967V7.12292C8.73967 7.18159 8.76297 7.23787 8.80446 7.27936C8.84595 7.32085 8.90223 7.34415 8.9609 7.34415H14.2705C14.3292 7.34415 14.3855 7.32085 14.427 7.27936C14.4684 7.23787 14.4918 7.18159 14.4918 7.12292Z"
                                        fill="#D6D6D6" />
                                </svg>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="col-sm-6">
                    <div class="mt-4 w-50" style="float: right;">
                        <div class="d-flex justify-content-between">
                            <span><b>Giá trị trước thuế:</b></span>
                            <span id="total-amount-sum">{{ number_format(0) }}đ</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2 align-items-center">
                            <span><b>Thuế VAT:</b></span>
                            <span id="product-tax">{{ number_format(0) }}đ</span>
                        </div>
                        {{-- <div class="d-flex justify-content-between mt-2">
                            <span class="text-primary">Giảm giá:</span>
                            <span>0đ</span>
                        </div> --}}
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="text-primary">Phí vận chuyển:</span>
                            <div class="w-50">
                                <input type="text" class="form-control text-right" name="transport_fee"
                                    id="transport_fee">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-lg"><b>Tổng cộng:</b></span>
                            <span><b id="grand-total" data-value="0">{{ number_format(0) }}đ</b></span>
                            <input type="text" hidden name="totalValue" value="0" id="total">
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-fixed">
                <button type="submit" name="submitBtn" value="action2" class="btn btn-primary mr-1"
                    onclick="validateAndSubmit(event)" id="luu">Lưu</button>
                <a href="{{ route('exports.index') }}"><span class="btn border-secondary ml-1">Hủy</span></a>
            </div>
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
                        <div class="modal-body" style="word-wrap: break-word">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal S/N --}}
            <div class="modal fade" id="snModal" tabindex="-1" role="dialog"
                aria-labelledby="productModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document" style="max-width: 85%;">
                    <div class="modal-content">
                        <div class="modal-header align-items-center">
                            <div>
                                <h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>
                                <p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>
                            </div>

                            <div class="close">

                            </div>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer text-center d-block">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
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
    });

    //form thong tin khach hang xuất hàng
    var radio1 = document.getElementById("radio1");
    var radio2 = document.getElementById("radio2");

    $("#radio1").on("click", function() {
        $('#data-container').empty();
        $('#checkguest').val(1);
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

        $('#checkguest').val(2);
        //Công nợ
        $(document).on('change', '#debtCheckbox', function() {
            if ($(this).is(':checked')) {
                $('#debtInput').prop('disabled', true);
                $('#debtInput').val(0);
                $("#data-debt").css("color", "#D6D6D6");
            } else {
                $('#debtInput').prop('disabled', false);
                $("#data-debt").css("color", "#1D1C20");
            }
        });
    });

    //nhập số
    function validateNumberInput(input) {
        var regex = /^[0-9][0-9-]*$/;
        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    }

    // function validateNumberInput(input) {
    //     var regex = /^[0-9]*$/;
    //     if (!regex.test(input.value)) {
    //         input.value = input.value.replace(/[^0-9]/g, '');
    //     }
    // }

    //add sản phẩm
    let fieldCounter = 1;
    var selectedSerialNumbers = [];
    $(document).ready(function() {
        $("#add-field-btn").click(function() {
            let nextSoTT = $(".soTT").length + 1;
            // Tạo các phần tử HTML mới
            const newRow = $("<tr>", {
                "id": `dynamic-row-${fieldCounter}`
            });
            const MaInput = $("<td>", {
                "class": "soTT",
                "text": nextSoTT
            });
            const ProInput = $("<td>" +
                "<select class='child-select p-1 productName form-control js-stools-field-filter' required name='product_id[]'>" +
                "<option value=''>Lựa chọn sản phẩm</option>" +
                '@foreach ($product as $value)' +
                "<option value='{{ $value->id }}'>{{ $value->product_name }}</option>" +
                '@endforeach' +
                "</select>" +
                "</td>");
            const dvtInput = $(
                "<td><input type='text' readonly id='product_unit' class='product_unit form-control' name='product_unit[]' required></td>"
            );
            const slInput = $(
                "<td>" +
                "<div class='d-flex'>" +
                "<input type='text' oninput='limitMaxValue(this)' id='product_qty' class='quantity-input form-control' name='product_qty[]' required style='min-width:70px;'>" +
                "<input type='text' readonly class='quantity-exist form-control' required style='min-width:70px;background:#D6D6D6;border:none;'>" +
                "</div>" +
                "</td>"
            );
            const giaInput = $(
                "<td><input type='text' class='product_price form-control text-center' style='min-width:140px' id='product_price' name='product_price[]' required></td>"
            );
            const ghichuInput = $(
                "<td><input type='text' class='note_product form-control' style='width:120px' name='product_note[]'></td>"
            );
            const thueInput = $("<td>" +
                "<select disabled name='product_tax[]' class='product_tax p-1 form-control' style='width:80px' id='product_tax' required>" +
                "<option value='0'>0%</option>" +
                "<option value='8'>8%</option>" +
                "<option value='10'>10%</option>" +
                "<option value='99'>NOVAT</option>" +
                "</select>" +
                "</td>");
            const thanhTienInput = $(
                "<td><input readonly class='total-amount form-control text-center' value='' style='min-width:120px;'></td>"
            );
            const sn = $(
                "<td data-toggle='modal' data-target='#snModal' class='sn'><img src='../dist/img/icon/list.png'></td>"
            );
            const info = $(
                "<td data-toggle='modal' data-target='#productModal'><img src='../dist/img/icon/Group.png'></td>"
            );
            const deleteBtn = $("<td><img src='../dist/img/icon/vector.png'></td>", {
                "class": "delete-row-btn"
            });
            const option = $(
                "<td style='display:none;'><input type='text' class='price_import'></td>" +
                "<td style='display:none;'><input type='text' class='tonkho'></td>" +
                "<td style='display:none;'><input type='text' class='loaihang'></td>" +
                "<td style='display:none;'><input type='text' class='dangGD'></td>" +
                "<td style='display:none;'><input type='text' class='product_tax1'></td>"
            );
            const snPro = $("<td style='display:none;'><ul class ='seri_pro'></ul></td>");

            //Xóa sản phẩm
            deleteBtn.click(function() {
                var row = $(this).closest("tr");
                var selectedID = row.find('.child-select').val();
                var productCode = $(this).closest('tr').find('.productName').val();

                // Kiểm tra nếu ID sản phẩm đang bị xóa có trong mảng selectedProductIDs
                var index = selectedProductIDs.indexOf(selectedID);
                if (index !== -1) {
                    selectedProductIDs.splice(index, 1); // Xóa ID sản phẩm khỏi mảng
                }
                row.remove();
                fieldCounter--;
                calculateTotalAmount();
                calculateTotalTax();
                calculateGrandTotal();
                updateRowNumbers();
                var taxAmount = parseFloat(row.find('.product_tax1').text());
                var totalTax = parseFloat($('#product-tax').text());
                totalTax -= taxAmount;
                $('#product-tax').text(totalTax);

                // Xóa các trường input ẩn selected_serial_numbers[] có data-product-id khớp với sản phẩm đang bị xóa
                $('input[name="selected_serial_numbers[]"][data-product-id="' + productCode +
                    '"]').remove();
            });

            //xem S/N sản phẩm
            sn.click(function() {
                var qty = $(this).closest('tr').find('.quantity-exist').val();
                qty = qty.replace('/', '');
                var qty_enter = $(this).closest('tr').find('.quantity-input').val();
                var productCode = $(this).closest('tr').find('.productName').val();
                var productCode1 = $(this).closest('tr').find('.maProduct option:selected')
                    .text();
                var productName = $(this).closest('tr').find('.productName option:selected')
                    .text();
                var productId = $(this).closest('tr').find('.productName').val();
                var selectedSerialNumbersForProduct = selectedSerialNumbers[productCode] || [];
                $.ajax({
                    url: "{{ route('getSN') }}",
                    method: 'GET',
                    data: {
                        productCode: productCode,
                    },
                    success: function(response) {
                        var modalBody = $('#snModal').find('.modal-body');
                        var modalFooter = $('#snModal').find('.modal-footer');
                        var closeBtn = $('#snModal').find('.close');
                        let count = 1;
                        modalBody.empty();
                        modalFooter.empty();
                        closeBtn.empty();
                        var snList = $('<table class="table table-hover">' +
                            '<thead><tr><th style="width: 20px;"><input type="checkbox" name="all" id="checkall"></th><th>STT</th><th>Serial Number</th></tr></thead>' +
                            '<tbody class="bg-white-sn">'
                        );
                        var product = $('<table class="table table-hover">' +
                            '<thead><tr><th>Tên sản phẩm</th><th class="text-right">Số lượng sản phẩm</th><th class="text-right">Số lượng S/N</th></tr></thead>' +
                            '<tbody><tr>' + '<td>' + productName +
                            '</td>' + '<td class="text-right">' + qty_enter +
                            '</td>' +
                            '<td class="text-right" id="resultCell">' + 0 +
                            '</td>' +
                            '</tr</tbody>' + '</table>' +
                            '<h3>Thông tin Serial Number </h3>');
                        response.forEach(function(sn) {
                            var snId = parseInt(sn.id);
                            var selectedSerialNumbersForProductInt =
                                selectedSerialNumbersForProduct.map(
                                    function(value) {
                                        return parseInt(value);
                                    });
                            if (selectedSerialNumbersForProductInt.includes(
                                    snId)) {
                                var isChecked = true;
                            } else {
                                var isChecked = false;
                            }
                            var checkbox = $(
                                '<td><input type="checkbox" ' + (
                                    isChecked ? 'checked' : '') +
                                ' class="check-item" data-quantity="1" name="export_seri[]" value="' +
                                sn.id + '"></td>'
                            );
                            var countCell = $('<td>').text(count);
                            var snItemCell = $('<td>').text(sn.serinumber);
                            var row = $('<tr>').append(checkbox,
                                countCell,
                                snItemCell);
                            snList.append(row);
                            count++;
                            if (selectedSerialNumbersForProduct.includes(sn
                                    .id)) {
                                checkbox.find('input[type="checkbox"]')
                                    .prop('checked', true);
                            }
                        });
                        modalBody.append(product, snList);
                        var footer = $(
                            '<a class="btn btn-primary mr-1 check-seri" data-dismiss="">Lưu</a>'
                        );
                        var btnClose = $(
                            '<div class="btnclose cursor-pointer" data-dismiss=""><span aria-hidden="true">&times;</span></div>'
                        );
                        modalFooter.append(footer);
                        closeBtn.append(btnClose);

                        function countCheckedCheckboxes() {
                            var numberOfCheckedCheckboxes = $('.check-item:checked')
                                .length;
                            $('#resultCell').text(numberOfCheckedCheckboxes);
                        }
                        countCheckedCheckboxes();
                        $('tr').click(function(event) {
                            var checkedCheckboxesInRow = $(this).find(
                                '.check-item:checked').length;
                            var checkbox = $(this).find('input:checkbox');
                            checkbox.prop('checked', !checkbox.prop(
                                'checked'));
                            checkbox.change();
                        });

                        $('tr input:checkbox').click(function(event) {
                            event.stopPropagation();
                        });

                        //limit checkbox
                        $('.check-item').on('change', function() {
                            event.stopPropagation();
                            var checkedCheckboxes = $('.check-item:checked')
                                .length;
                            var serialNumberId = $(this).val();

                            if (checkedCheckboxes > qty_enter) {
                                $(this).prop('checked', false);
                            } else {
                                if ($(this).is(':checked')) {
                                    if (!selectedSerialNumbers[
                                            productCode]) {
                                        selectedSerialNumbers[
                                            productCode] = [];
                                    }
                                    selectedSerialNumbers[productCode].push(
                                        serialNumberId);

                                    // Tạo một trường input ẩn mới và đặt giá trị
                                    var newInput = $('<input>', {
                                        type: 'hidden',
                                        name: 'selected_serial_numbers[]',
                                        value: serialNumberId,
                                        'data-product-id': productCode,
                                    });

                                    // Thêm trường input mới vào container
                                    $('#selectedSerialNumbersContainer')
                                        .append(newInput);
                                } else {
                                    // Nếu checkbox bị bỏ chọn, loại bỏ Serial Number khỏi danh sách cho sản phẩm
                                    if (selectedSerialNumbers[
                                            productCode]) {
                                        selectedSerialNumbers[productCode] =
                                            selectedSerialNumbers[
                                                productCode]
                                            .filter(function(item) {
                                                return item !==
                                                    serialNumberId;
                                            });

                                        // Xóa trường input ẩn tương ứng
                                        $('input[name="selected_serial_numbers[]"][value="' +
                                                serialNumberId + '"]')
                                            .remove();
                                    }
                                }
                                countCheckedCheckboxes();
                            }
                        });

                        //kiểm tra số lượng seri
                        $('.check-seri').on('click', function() {
                            var checkedCheckboxes = $('.check-item:checked')
                                .length;
                            var check_item = $('.check-item');
                            if (check_item.length > 0) {
                                if (checkedCheckboxes < qty_enter) {
                                    alert(
                                        'Vui lòng chọn đủ serial number theo số lượng xuất!'
                                    );
                                } else if (checkedCheckboxes == qty_enter) {
                                    // Kiểm tra xem nút được nhấn có class 'check-seri' không
                                    if ($(this).hasClass('check-seri')) {
                                        $(this).attr('data-dismiss',
                                            'modal');
                                    }
                                }
                            } else {
                                $(this).attr('data-dismiss', 'modal');
                            }
                        });

                        $('.btnclose').on('click', function() {
                            var checkedCheckboxes = $('.check-item:checked')
                                .length;
                            var check_item = $('.check-item');
                            if (check_item.length > 0) {
                                if (checkedCheckboxes < qty_enter) {
                                    alert(
                                        'Vui lòng chọn đủ serial number theo số lượng xuất!'
                                    );
                                } else if (checkedCheckboxes == qty_enter) {
                                    $('.btnclose').attr('data-dismiss',
                                        'modal');
                                }
                            } else {
                                $('.btnclose').attr('data-dismiss',
                                    'modal');
                            }
                        });
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
                var ghiChu = $(this).closest('tr').find('.note_product')
                    .val();
                var thue = $(this).closest('tr').find('.product_tax')
                    .val();
                var giaNhap = $(this).closest('tr').find('.price_import').val();
                var tonKho = $(this).closest('tr').find('.tonkho').val();
                var loaihang = $(this).closest('tr').find('.loaihang').val();
                var dangGD = $(this).closest('tr').find('.dangGD').val();
                $('#productModal').find('.modal-body').html('<b>Tên sản phẩm: </b> ' +
                    productName + '<br>' +
                    '<b>Tồn kho: </b>' + tonKho + '<br>' + '<b>Đang giao dịch: </b>' +
                    dangGD +
                    '<br>' + '<b>Giá nhập: </b>' + giaNhap + '<br>' + '<b>Thuế: </b>' +
                    (thue == 99 || thue == null ? "NOVAT" : thue + '%'));
            });
            // Gắn các phần tử vào hàng mới
            newRow.append(MaInput, ProInput, dvtInput, slInput,
                giaInput, thueInput, thanhTienInput, ghichuInput, sn, info, deleteBtn, option, snPro
            );
            $("#dynamic-fields").before(newRow);
            // Tăng giá trị fieldCounter
            fieldCounter++;

            function updateMultipleActionVisibility() {
                if ($('.cb-element:checked').length > 0) {
                    $('#deleteRowTable').css('opacity', 1);
                } else {
                    $('#deleteRowTable').css('opacity', 0);
                }
            }
            $(document).ready(function() {
                $('.child-select').select2();
            });
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
            //biến cập nhật
            $('#checkguest').val(1);
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
    $(document).ready(function() {
        //Công nợ
        var isChecked = $('#debtCheckbox').is(':checked');
        // Đặt trạng thái của input dựa trên checkbox
        $('#debtInput').prop('disabled', isChecked);
        // Xử lý sự kiện khi checkbox thay đổi
        $(document).on('change', '#debtCheckbox', function() {
            var isChecked = $(this).is(':checked');
            $('#debtInput').prop('disabled', isChecked);
        });
    });

    //Giới hạn số lượng
    function limitMaxValue(input) {
        // Làm sạch giá trị đầu vào bằng cách loại bỏ tất cả các ký tự không phải số hoặc "."
        input.value = input.value.replace(/[^\d.]/g, '');

        // Loại bỏ các dấu "." ngoài dấu "." đầu tiên
        var parts = input.value.split('.');
        if (parts.length > 2) {
            input.value = parts[0] + '.' + parts.slice(1).join('');
        }

        // Kiểm tra nếu giá trị đầu vào bắt đầu bằng "0" và không phải là "0." thì loại bỏ các số 0 không cần thiết
        if (input.value.startsWith("0") && input.value !== "0.") {
            input.value = parseFloat(input.value).toString();
        }

        var value = parseFloat(input.value);
        var product_id = $(input).closest('tr').find('.productName').val();

        var inputExist = $(input).closest('tr').find(".quantity-exist").val();

        // Sử dụng phương thức replace để loại bỏ ký tự /
        var valueWithoutSlash = inputExist.replace('/', '');

        var maxLimit = parseFloat(valueWithoutSlash);
        if (!isNaN(maxLimit) && value > maxLimit) {
            input.value = maxLimit;
            calculateTotalTax();
            calculateGrandTotal();
            calculateTotalAmount();
        }
    }

    //cập nhật thông tin khách hàng
    $(document).on('click', '#btn-customer', function(e) {
        $("#sourceTable input, #sourceTable select").removeAttr("required");
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
        var guest_phone = $('#guest_phone').val();
        var guest_email_personal = $('#guest_email_personal').val();
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
                guest_email_personal,
                guest_note,
                updateClick,
                debt
            },
            success: function(data) {
                if (data.hasOwnProperty('message')) {
                    alert(data.message); // Hiển thị thông báo đã tồn tại
                } else if (data.hasOwnProperty('id')) {
                    alert('Lưu thông tin thành công');
                }
                $("#sourceTable input:not([name='product_note[]']):not(.price_import):not(.tonkho):not(.loaihang):not(.dangGD):not(.product_tax1), #sourceTable select:not([name='product_note[]']):not(.price_import):not(.tonkho):not(.loaihang):not(.dangGD):not(.product_tax1)")
                    .attr("required", "required");
            }
        })
    })
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

    //thêm thông tin khách hàng
    $(document).on('click', '#btn-addCustomer', function(e) {
        $("#sourceTable input, #sourceTable select").prop("required", false);
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
                guest_email_personal,
                guest_note,
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
                $("#sourceTable input:not([name='product_note[]']):not(.price_import):not(.tonkho):not(.loaihang):not(.dangGD):not(.product_tax1), #sourceTable select:not([name='product_note[]']):not(.price_import):not(.tonkho):not(.loaihang):not(.dangGD):not(.product_tax1)")
                    .attr("required", "required");
            }
        });
    });

    //lấy thông tin sản phẩm con từ tên sản phẩm con
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
            var ulElement = $(this).closest('tr').find(".seri_pro");

            $(this).closest('tr').find('.quantity-input').val(null);
            if (!isNaN(selectedID)) {
                $.ajax({
                    url: "{{ route('getProduct') }}",
                    type: "get",
                    data: {
                        idProduct: selectedID,
                    },
                    success: function(response) {
                        if (response) {
                            productNameElement.val(response.product_name);
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
                            thue.val(response.product_tax == null ? 99 : response
                                .product_tax);
                            // Tính lại tổng số tiền và tổng số thuế
                            calculateTotalTax();
                            calculateGrandTotal();
                            $.ajax({
                                url: "{{ route('getAllSN') }}",
                                method: 'GET',
                                data: {
                                    idProduct: selectedID,
                                },
                                success: function(response2) {
                                    response2.forEach(function(sn) {
                                        var product_id = sn.product_id;
                                        var liElement = $("<li>").text(
                                            product_id.toString());
                                        ulElement.append(liElement);
                                    });
                                },
                            });
                        }
                    },
                });
            } else {
                $(this).val(null).trigger('change');
                var productNameElement = $(this).closest('tr').find('.product_name');
                productNameElement.prop('disabled', true);
                $(this).data('previous-id', null);
            }

            // Kiểm tra nếu ID sản phẩm đã chọn đã có trong danh sách các sản phẩm đã chọn
            if (selectedProductIDs.includes(selectedID)) {
                // Xóa lựa chọn hiện tại và vô hiệu hóa tên sản phẩm
                $(this).val(null).trigger('change');
                var productNameElement = $(this).closest('tr').find('.product_name');
                productNameElement.prop('disabled', true);

                // Thông báo cho người dùng rằng sản phẩm đã được thêm trước đó
                alert('Sản phẩm này đã được thêm trước đó, vui lòng chọn sản phẩm khác');

                // Kiểm tra nếu giá trị data-previous-id không null, thì xóa sản phẩm trước đó khỏi mảng
                var previousID = $(this).data('previous-id');
                if (previousID !== null) {
                    var index = selectedProductIDs.indexOf(previousID);
                    if (index !== -1) {
                        selectedProductIDs.splice(index, 1);
                    }
                }

                // Đặt giá trị data-previous-id thành null để cho phép chọn lại sản phẩm ban đầu
                $(this).data('previous-id', null);
            } else {
                // Nếu sản phẩm chưa được chọn trước đó, thực hiện các bước sau
                var previousID = $(this).data('previous-id');

                if (previousID && previousID !== selectedID) {
                    var index = selectedProductIDs.indexOf(previousID);
                    if (index !== -1) {
                        selectedProductIDs.splice(index, 1);
                        $('input[name="selected_serial_numbers[]"][data-product-id="' + previousID +
                            '"]').remove();
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

    // Xử lý sự kiện khi nhấn nút Backspace trong ô tìm kiếm
    $(document).on('keydown', '.selectize-input input', function(event) {
        if (event.keyCode === 8) { // 8 là mã nút Backspace
            var inputValue = $(this).val();
            if (inputValue === '') {
                var removedID = $(this).closest('.child-select').val();
                var index = selectedProductIDs.indexOf(removedID);
                if (index !== -1) {
                    selectedProductIDs.splice(index, 1); // Xóa ID khỏi mảng khi xóa tùy chọn
                }
            }
        }
    });

    //tính thành tiền của sản phẩm
    $(document).on('input', '.quantity-input, [name^="product_price"]', function(e) {
        var productQty = parseFloat($(this).closest('tr').find('.quantity-input').val()) || 0;
        var productPrice = parseFloat($(this).closest('tr').find('input[name^="product_price"]').val().replace(
            /[^0-9.-]+/g, "")) || 0;
        updateTaxAmount($(this).closest('tr'));

        if (!isNaN(productQty) && !isNaN(productPrice)) {
            var totalAmount = productQty * productPrice;
            $(this).closest('tr').find('.total-amount').val(formatCurrency(totalAmount));
            calculateTotalAmount();
            calculateTotalTax();
        }
    });

    $(document).on('change', '.product_tax', function() {
        updateTaxAmount($(this).closest('tr'));
        calculateTotalAmount();
        calculateTotalTax();
    });

    function updateTaxAmount(row) {
        var productQty = parseFloat(row.find('.quantity-input').val());
        var productPrice = parseFloat(row.find('input[name^="product_price"]').val().replace(/[^0-9.-]+/g, ""));
        var taxValue = parseFloat(row.find('.product_tax').val());
        if (taxValue == 99) {
            taxValue = 0;
        }
        if (!isNaN(productQty) && !isNaN(productPrice) && !isNaN(taxValue)) {
            var totalAmount = productQty * productPrice;
            var taxAmount = (totalAmount * taxValue) / 100;

            row.find('.product_tax1').text(Math.round(taxAmount));
        }
    }

    function calculateTotalAmount() {
        var totalAmount = 0;
        $('tr').each(function() {
            var rowTotal = parseFloat(String($(this).find('.total-amount').val()).replace(/[^0-9.-]+/g, ""));
            if (!isNaN(rowTotal)) {
                totalAmount += rowTotal;
            }
        });
        totalAmount = Math.round(totalAmount); // Làm tròn thành số nguyên
        $('#total-amount-sum').text(formatCurrency(totalAmount));
        calculateTotalTax();
        calculateGrandTotal();
    }

    function calculateTotalTax() {
        var totalTax = 0;
        $('tr').each(function() {
            var rowTax = parseFloat($(this).find('.product_tax1').text().replace(/[^0-9.-]+/g, ""));
            if (!isNaN(rowTax)) {
                totalTax += rowTax;
            }
        });
        totalTax = Math.round(totalTax); // Làm tròn thành số nguyên
        $('#product-tax').text(formatCurrency(totalTax));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var totalAmount = parseFloat($('#total-amount-sum').text().replace(/[^0-9.-]+/g, ""));
        var totalTax = parseFloat($('#product-tax').text().replace(/[^0-9.-]+/g, ""));

        var grandTotal = totalAmount + totalTax;
        grandTotal = Math.round(grandTotal); // Làm tròn thành số nguyên
        $('#grand-total').text(formatCurrency(grandTotal));

        // Update data-value attribute
        $('#grand-total').attr('data-value', grandTotal);
        $('#total').val(totalAmount);
    }

    function formatCurrency(value) {
        value = Math.round(value * 100) / 100;

        var parts = value.toString().split(".");
        var integerPart = parts[0];
        var formattedValue = "";

        var count = 0;
        for (var i = integerPart.length - 1; i >= 0; i--) {
            formattedValue = integerPart.charAt(i) + formattedValue;
            count++;
            if (count % 3 === 0 && i !== 0) {
                formattedValue = "," + formattedValue;
            }
        }

        if (parts.length > 1) {
            formattedValue += "." + parts[1];
        }

        return formattedValue;
    }

    let canSubmitForm = true;

    function checkRequiredConditions() {
        var inputQty = $('.quantity-input').val();
        var inputPrice = $('.product_price').val();
        if (inputQty === '' || inputPrice === '') {
            alert('Lỗi: Trường nhập liệu không được để trống!');
            return false;
        }
        return true;
    }

    // Hàm kiểm tra và submit form
    function validateAndSubmit(event) {
        var formGuest = $('#form-guest');
        var productList = $('.productName');

        if (formGuest.length && productList.length > 0) {
            $('.quantity-input, [name^="product_price"], #transport_fee').each(function() {
                var newValue = $(this).val().replace(/,/g, '');
                $(this).val(newValue);
            });
            // Kiểm tra các trường có rỗng
            if (checkRequiredConditions()) {
                var selects = document.getElementsByTagName("select");
                for (var j = 0; j < selects.length; j++) {
                    selects[j].removeAttribute("disabled");
                }
            }

            const productRows = document.querySelectorAll('tr');
            // Mảng chứa tên sản phẩm có số lượng = 0
            let mismatchedProducts = [];
            // Kiểm tra số lượng lớn hơn 0
            for (let i = 0; i < productRows.length; i++) {
                const qtyInput = productRows[i].querySelector('.quantity-input');
                const productNameSelect = productRows[i].querySelector('.productName');

                if (qtyInput !== null && productNameSelect !== null) {
                    const selectedOption = productNameSelect.options[productNameSelect.selectedIndex];

                    if (parseFloat(qtyInput.value) == 0) {
                        const productName = selectedOption.textContent;
                        mismatchedProducts.push(productName);
                    }
                }
            }

            // Tạo thông báo
            let alertMessage = "Các sản phẩm sau đây phải lớn hơn 0:\n";
            if (mismatchedProducts.length > 0) {
                alertMessage += mismatchedProducts.join('\n');
                alert(alertMessage);
                event.preventDefault();
            }

            let missProducts = [];
            const productsRows = document.querySelectorAll('tbody tr');

            for (let j = 0; j < productsRows.length; j++) {
                const ulElement = productsRows[j].querySelector(".seri_pro");
                const numberOfLiElements = ulElement ? ulElement.querySelectorAll('li').length : 0;

                if (numberOfLiElements > 0) {
                    // Chỉ push vào mảng khi có ít nhất một phần tử <li> trong <ul>
                    const qty = productsRows[j].querySelector('.quantity-input');
                    const productNameElement = productsRows[j].querySelector('.productName');

                    if (qty !== null) {
                        const idProduct = productNameElement.value;
                        const numberOfInputs = $(
                            `input[name="selected_serial_numbers[]"][data-product-id="${idProduct}"]`
                        ).length;

                        if (parseInt(qty.value) !== numberOfInputs) {
                            const selectedOption1 = productNameElement.options[
                                productNameElement.selectedIndex
                            ];
                            const productName1 = selectedOption1.textContent;

                            if (!missProducts.includes(productName1)) {
                                missProducts.push(productName1);
                            }
                        }
                    }
                }
            }
            // Tạo thông báo
            let alertMessage1 = "Số lượng xuất chưa trùng với số lượng S/N:\n";
            if (missProducts.length > 0) {
                alertMessage1 += missProducts.join('\n');
                alert(alertMessage1);
                event.preventDefault();
            }
        } else {
            if (formGuest.length === 0) {
                alert('Lỗi: Chưa nhập thông tin khách hàng!');
            } else if (productList.length === 0) {
                alert('Lỗi: Chưa thêm sản phẩm!');
            }
            event.preventDefault();
        }
    }

    //ngăn chặn click
    $(document).ready(function() {
        $('#chot_don').on('click', function(event) {
            var $button = $(this);

            if (!$button.hasClass('disabled')) {
                $button.addClass('disabled');
                setTimeout(function() {
                    $button.removeClass('disabled');
                }, 1000);
            }
        });

        $('#luu').on('click', function() {
            var $button = $(this);

            if (!$button.hasClass('disabled')) {
                $button.addClass('disabled');
                setTimeout(function() {
                    $button.removeClass('disabled');
                }, 1000);
            }
        });
    });

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

    // $(document).on('keypress', 'form', function(event) {
    //         return event.keyCode != 13; 
    //     });

    //xử lý tạo đơn
    var currentURL = window.location.href;
    var productsParam = getUrlParameter(currentURL, "products");
    var products = productsParam.split(",");

    function getUrlParameter(currentURL, name) {
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
        var results = regex.exec(currentURL);
        if (!results) return null;
        if (!results[2]) return "";
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    function formatNumber(number) {
        const parts = number.toString().split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    }

    $(document).ready(function() {
        $('.child-select').select2();
    });

    for (let j = 0; j < products.length; j++) {
        // Tạo các phần tử HTML mới
        const newRow = $("<tr>", {
            "id": `dynamic-row-${fieldCounter}`
        });
        const MaInput = $("<td>", {
            "class": "soTT",
            "text": `${fieldCounter}`
        });
        var productList = @json($product);
        var selectedProducts = products.slice();

        const ProInput = $(
            "<td><select class='child-select p-1 productName form-control' required name='product_id[]'></select></td>"
        );

        const dvtInput = $(
            "<td><input type='text' id='product_unit' class='product_unit form-control' name='product_unit[]' required></td>"
        );

        const slInput = $(
            "<td>" +
            "<div class='d-flex'>" +
            "<input type='text' oninput='limitMaxValue(this)' id='product_qty' class='quantity-input form-control' name='product_qty[]' required style='min-width:70px;'>" +
            "<input type='text' readonly class='quantity-exist form-control' required style='min-width:70px;background:#D6D6D6;border:none;'>" +
            "</div>" +
            "</td>"
        );
        const giaInput = $(
            "<td><input type='text' class='product_price form-control text-center' style='min-width:140px' id='product_price' name='product_price[]' required></td>"
        );
        const ghichuInput = $(
            "<td><input type='text' class='note_product form-control' style='width:120px' name='product_note[]'></td>"
        );
        const thueInput = $("<td>" +
            "<select disabled name='product_tax[]' class='product_tax p-1 form-control' style='width:80px' id='product_tax' required>" +
            "<option value='0'>0%</option>" +
            "<option value='8'>8%</option>" +
            "<option value='10'>10%</option>" +
            "<option value='99'>NOVAT</option>" +
            "</select>" +
            "</td>");
        const thanhTienInput = $(
            "<td><input readonly class='total-amount form-control text-center' value='' style='min-width:120px;'></td>"
        );
        const sn = $(
            "<td data-toggle='modal' data-target='#snModal' class='sn'><img src='../dist/img/icon/list.png'></td>"
        );
        const info = $(
            "<td data-toggle='modal' data-target='#productModal'><img src='../dist/img/icon/Group.png'></td>"
        );
        const deleteBtn = $("<td><img src='../dist/img/icon/vector.png'></td>", {
            "class": "delete-row-btn"
        });
        const option = $(
            "<td style='display:none;'><input type='text' class='price_import'></td>" +
            "<td style='display:none;'><input type='text' class='tonkho'></td>" +
            "<td style='display:none;'><input type='text' class='loaihang'></td>" +
            "<td style='display:none;'><input type='text' class='dangGD'></td>" +
            "<td style='display:none;'><input type='text' class='product_tax1'></td>"
        );

        const snPro = $("<td style='display:none;'><ul class='seri_pro'></ul></td>");

        for (let i = 0; i < productList.length; i++) {
            let option = $("<option>", {
                "value": productList[i].id,
                "text": productList[i].product_name,
            });

            let dvt = $("<input>", {
                "value": productList[i].product_unit,
                "class": "product_unit form-control",
                "name": "product_unit[]",
                "readonly": "readonly"
            });

            let thue = productList[i].product_tax;

            if (selectedProducts[j].includes(productList[i].id.toString())) {
                option.prop('selected', true);
            }

            ProInput.find('select').append(option);
            if (productList[i].id == products[j]) {
                dvtInput.find('input').replaceWith(dvt);
                slInput.find('.quantity-exist').val("/" + productList[i].qty_exist);
                thueInput.find('select').val(thue);
            }
            if (productList[i].id == products[j]) {
                $.ajax({
                    url: "{{ route('getAllSN') }}",
                    method: 'GET',
                    data: {
                        idProduct: products[j],
                    },
                    success: function(response2) {
                        var ulElement = newRow.find(".seri_pro");
                        response2.forEach(function(sn) {
                            var product_id = sn.product_id;
                            var liElement = $("<li>").text(product_id.toString());
                            ulElement.append(liElement);
                        });
                    },
                });
            }
        }

        //Xóa sản phẩm
        deleteBtn.click(function() {
            var row = $(this).closest("tr");
            var selectedID = row.find('.child-select').val();

            // Kiểm tra nếu ID sản phẩm đang bị xóa có trong mảng selectedProductIDs
            var index = selectedProductIDs.indexOf(selectedID);
            if (index !== -1) {
                selectedProductIDs.splice(index, 1); // Xóa ID sản phẩm khỏi mảng
            }
            row.remove();
            fieldCounter--;
            calculateTotalAmount();
            calculateTotalTax();
            calculateGrandTotal();
            updateRowNumbers();
            var taxAmount = parseFloat(row.find('.product_tax1').text());
            var totalTax = parseFloat($('#product-tax').text());
            totalTax -= taxAmount;
            $('#product-tax').text(totalTax);
        });

        //xem S/N sản phẩm
        sn.click(function() {
            var qty = $(this).closest('tr').find('.quantity-exist').val();
            qty = qty.replace('/', '');
            var qty_enter = $(this).closest('tr').find('.quantity-input').val();
            var productCode = $(this).closest('tr').find('.productName').val();
            var productCode1 = $(this).closest('tr').find('.maProduct option:selected')
                .text();
            var productName = $(this).closest('tr').find('.productName option:selected')
                .text();
            var productId = $(this).closest('tr').find('.productName').val();
            var selectedSerialNumbersForProduct = selectedSerialNumbers[productCode] || [];
            $.ajax({
                url: "{{ route('getSN') }}",
                method: 'GET',
                data: {
                    productCode: productCode,
                },
                success: function(response) {
                    var modalBody = $('#snModal').find('.modal-body');
                    var modalFooter = $('#snModal').find('.modal-footer');
                    var closeBtn = $('#snModal').find('.close');
                    let count = 1;
                    modalBody.empty();
                    modalFooter.empty();
                    closeBtn.empty();
                    var snList = $('<table class="table table-hover">' +
                        '<thead><tr><th style="width: 20px;"><input type="checkbox" name="all" id="checkall"></th><th>STT</th><th>Serial Number</th></tr></thead>' +
                        '<tbody class="bg-white-sn">'
                    );
                    var product = $('<table class="table table-hover">' +
                        '<thead><tr><th>Tên sản phẩm</th><th class="text-right">Số lượng sản phẩm</th><th class="text-right">Số lượng S/N</th></tr></thead>' +
                        '<tbody><tr>' + '<td>' + productName +
                        '</td>' + '<td class="text-right">' + qty_enter +
                        '</td>' +
                        '<td class="text-right" id="resultCell">' + 0 +
                        '</td>' +
                        '</tr</tbody>' + '</table>' +
                        '<h3>Thông tin Serial Number </h3>');
                    response.forEach(function(sn) {
                        var snId = parseInt(sn.id);
                        var selectedSerialNumbersForProductInt =
                            selectedSerialNumbersForProduct.map(
                                function(value) {
                                    return parseInt(value);
                                });
                        if (selectedSerialNumbersForProductInt.includes(
                                snId)) {
                            var isChecked = true;
                        } else {
                            var isChecked = false;
                        }
                        var checkbox = $(
                            '<td><input type="checkbox" ' + (
                                isChecked ? 'checked' : '') +
                            ' class="check-item" data-quantity="1" name="export_seri[]" value="' +
                            sn.id + '"></td>'
                        );
                        var countCell = $('<td>').text(count);
                        var snItemCell = $('<td>').text(sn.serinumber);
                        var row = $('<tr>').append(checkbox, countCell,
                            snItemCell);
                        snList.append(row);
                        count++;
                        if (selectedSerialNumbersForProduct.includes(sn
                                .id)) {
                            checkbox.find('input[type="checkbox"]')
                                .prop('checked', true);
                        }
                    });
                    modalBody.append(product, snList);
                    var footer = $(
                        '<a class="btn btn-primary mr-1 check-seri" data-dismiss="">Lưu</a>'
                    );
                    var btnClose = $(
                        '<div class="btnclose cursor-pointer" data-dismiss=""><span aria-hidden="true">&times;</span></div>'
                    );
                    modalFooter.append(footer);
                    closeBtn.append(btnClose);

                    function countCheckedCheckboxes() {
                        var numberOfCheckedCheckboxes = $('.check-item:checked')
                            .length;
                        $('#resultCell').text(numberOfCheckedCheckboxes);
                    }
                    countCheckedCheckboxes();
                    $('tr').click(function(event) {
                        var checkedCheckboxesInRow = $(this).find(
                            '.check-item:checked').length;
                        var checkbox = $(this).find('input:checkbox');
                        checkbox.prop('checked', !checkbox.prop(
                            'checked'));
                        checkbox.change();
                    });

                    $('tr input:checkbox').click(function(event) {
                        event.stopPropagation();
                    });
                    //limit checkbox
                    $('.check-item').on('change', function() {
                        var checkedCheckboxes = $('.check-item:checked')
                            .length;
                        var serialNumberId = $(this).val();

                        // Check if checked checkboxes exceed qty_enter
                        if (checkedCheckboxes > qty_enter) {
                            // Prevent checking more checkboxes than allowed
                            $(this).prop('checked', false);
                        } else {
                            if ($(this).is(':checked')) {
                                // Nếu checkbox được chọn và không vượt quá giới hạn, thêm Serial Number vào danh sách cho sản phẩm
                                if (!selectedSerialNumbers[
                                        productCode]) {
                                    selectedSerialNumbers[
                                        productCode] = [];
                                }
                                selectedSerialNumbers[productCode].push(
                                    serialNumberId);

                                // Tạo một trường input ẩn mới và đặt giá trị
                                var newInput = $('<input>', {
                                    type: 'hidden',
                                    name: 'selected_serial_numbers[]',
                                    value: serialNumberId,
                                    'data-product-id': productCode,
                                });

                                // Thêm trường input mới vào container
                                $('#selectedSerialNumbersContainer')
                                    .append(newInput);
                            } else {
                                // Nếu checkbox bị bỏ chọn, loại bỏ Serial Number khỏi danh sách cho sản phẩm
                                if (selectedSerialNumbers[
                                        productCode]) {
                                    selectedSerialNumbers[productCode] =
                                        selectedSerialNumbers[
                                            productCode]
                                        .filter(function(item) {
                                            return item !==
                                                serialNumberId;
                                        });

                                    // Xóa trường input ẩn tương ứng
                                    $('input[name="selected_serial_numbers[]"][value="' +
                                            serialNumberId + '"]')
                                        .remove();
                                }
                            }
                            countCheckedCheckboxes();
                        }
                    });
                    //thay đổi số lượng nhập
                    $('.quantity-input').on('change', function() {
                        var newQty = parseInt($(this).val());
                        var selectedCheckboxes = $(
                            '.check-item:checked');
                        selectedCheckboxes.prop('checked', false);
                        // Lặp qua tất cả các ô đã chọn và hủy chúng
                        selectedCheckboxes.each(function() {
                            $(this).prop('checked', false);
                            var serialNumberId = $(this).val();
                            // Loại bỏ Serial Number khỏi danh sách đã chọn cho sản phẩm
                            if (selectedSerialNumbers[
                                    productId]) {
                                selectedSerialNumbers[
                                        productId] =
                                    selectedSerialNumbers[
                                        productId]
                                    .filter(function(item) {
                                        return item !==
                                            serialNumberId;
                                    });
                                // Xóa trường input ẩn tương ứng
                                $('input[name="selected_serial_numbers[]"][value="' +
                                        serialNumberId + '"]')
                                    .remove();
                            }
                        });
                    });
                    //kiểm tra số lượng seri
                    $('.check-seri').on('click', function() {
                        var checkedCheckboxes = $('.check-item:checked')
                            .length;
                        var check_item = $('.check-item');
                        if (check_item.length > 0) {
                            if (checkedCheckboxes < qty_enter) {
                                alert(
                                    'Vui lòng chọn đủ serial number theo số lượng xuất!'
                                );
                            } else if (checkedCheckboxes == qty_enter) {
                                // Kiểm tra xem nút được nhấn có class 'check-seri' không
                                if ($(this).hasClass('check-seri')) {
                                    $(this).attr('data-dismiss',
                                        'modal');
                                }
                            }
                        } else {
                            $(this).attr('data-dismiss', 'modal');
                        }
                    });

                    $('.btnclose').on('click', function() {
                        var checkedCheckboxes = $('.check-item:checked')
                            .length;
                        var check_item = $('.check-item');
                        if (check_item.length > 0) {
                            if (checkedCheckboxes < qty_enter) {
                                alert(
                                    'Vui lòng chọn đủ serial number theo số lượng xuất!'
                                );
                            } else if (checkedCheckboxes == qty_enter) {
                                $('.btnclose').attr('data-dismiss',
                                    'modal');
                            }
                        } else {
                            $('.btnclose').attr('data-dismiss',
                                'modal');
                        }
                    });
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
                    $('#productModal').find('.modal-body').html('<b>Tên sản phẩm: </b> ' +
                        productName +
                        '<br>' +
                        '<b>Tồn kho: </b>' + response.product_qty + '<br>' +
                        '<b>Đang giao dịch: </b>' +
                        (response.product_trade == null ? 0 : response.product_trade) +
                        '<br>' + '<b>Giá nhập: </b>' + formattedPrice + '<br>' +
                        '<b>Thuế: </b>' +
                        (thue == 99 || thue == null ? "NOVAT" : thue + '%'));
                },
            });
        });
        // Gắn các phần tử vào hàng mới
        newRow.append(MaInput, ProInput, dvtInput, slInput,
            giaInput, thueInput, thanhTienInput, ghichuInput, sn, info, deleteBtn, option, snPro);
        $("#dynamic-fields").before(newRow);
        // Tăng giá trị fieldCounter
        fieldCounter++;
    }

    function updateRowNumbers() {
        $('.soTT').each(function(index) {
            $(this).text(index + 1);
        });
    }
</script>
</body>

</html>
