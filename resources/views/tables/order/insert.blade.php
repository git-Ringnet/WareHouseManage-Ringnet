<x-navbar :title="$title"></x-navbar>
@if (Auth::check() != null)
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="w-75">
                        <div class="">
                            <span>Nhập hàng</span>
                            <span>/</span>
                            <span><b>Đơn hàng mới</b></span>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="btn btn-danger text-white" id="add_bill">Duyệt đơn</a>
                            <a href="#" class="btn btn-secondary ml-4">Hủy đơn</a>
                            <a href="#" class="btn border border-secondary ml-4">In đơn hàng</a>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex">
                                <input type="radio" name="options" id="radio1" checked>
                                <span class="ml-1">Nhà cung cấp cũ</span>
                                <input type="radio" name="options" id="radio2" style="margin-left: 40px;">
                                <span class="ml-1">Nhà cung cấp mới</span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="input-group mb-1 position-relative">
                                <input type="text" class="form-control" placeholder="Nhập thông tin khách hàng" aria-label="Username" aria-describedby="basic-addon1" id="myInput" autocomplete="off">
                                <div class="position-absolute" style="right: 5px;top: 17%;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1835 7.36853C13.0254 5.21049 9.52656 5.21049 7.36853 7.36853C5.21049 9.52656 5.21049 13.0254 7.36853 15.1835C9.52656 17.3415 13.0254 17.3415 15.1835 15.1835C17.3415 13.0254 17.3415 9.52656 15.1835 7.36853ZM16.2441 6.30787C13.5003 3.56404 9.05169 3.56404 6.30787 6.30787C3.56404 9.05169 3.56404 13.5003 6.30787 16.2441C9.05169 18.988 13.5003 18.988 16.2441 16.2441C18.988 13.5003 18.988 9.05169 16.2441 6.30787Z" fill="#555555" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1796 15.1796C15.4725 14.8867 15.9474 14.8867 16.2403 15.1796L19.5303 18.4696C19.8232 18.7625 19.8232 19.2374 19.5303 19.5303C19.2374 19.8232 18.7625 19.8232 18.4696 19.5303L15.1796 16.2403C14.8867 15.9474 14.8867 15.4725 15.1796 15.1796Z" fill="#555555" />
                                    </svg>
                                </div>
                            </div>
                            <ul id="myUL" class="bg-white position-absolute w-100 rounded shadow" style="z-index: 99;">
                                @foreach ($provide as $value)
                                <li>
                                    <a href="#" class="text-dark d-flex justify-content-between p-2 search-info" id="{{ $value->id }}" name="search-info">
                                        <span>{{ $value->provide_represent }}</span>
                                        <span class="mr-5">{{ $value->provide_name }}</span>
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
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="15.6667" cy="15.667" r="13" fill="#09BD3C" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.1072 12.2929C22.4977 12.6834 22.4977 13.3166 22.1072 13.7071L15.4405 20.3738C15.05 20.7643 14.4168 20.7643 14.0263 20.3738L10.0263 16.3738C9.63577 15.9832 9.63577 15.3501 10.0263 14.9596C10.4168 14.569 11.05 14.569 11.4405 14.9596L14.7334 18.2525L20.693 12.2929C21.0835 11.9024 21.7166 11.9024 22.1072 12.2929Z" fill="white" />
                                </svg>
                                <p class="text-center p-0 m-0">
                                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="3" cy="3" r="3" fill="#09BD3C" />
                                    </svg>
                                </p>
                            </span>
                            <span style="z-index: 99">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z" fill="#D6D6D6" />
                                    <path d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z" fill="#D6D6D6" />
                                </svg>
                                <p class="text-center p-0 m-0">
                                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="3" cy="3" r="3" fill="#D6D6D6" />
                                    </svg>
                                </p>
                            </span>
                            <span style="z-index: 99">
                                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z" fill="#D6D6D6" />
                                    <path d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z" fill="#D6D6D6" />
                                </svg>
                                <p class="p-0 m-0"></p>

                            </span>
                        </div>
                        <div class="position-absolute" style="top: 32px; z-index: 0;left: 17px">
                            <svg height="4" viewBox="0 0 364 3" fill="none" style="width: 95%" xmlns="http://www.w3.org/2000/svg">
                                <line x1="0.999268" y1="1.50098" x2="363.001" y2="1.50098" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
    </section>
    <div class="container-fluid">
        <form action="{{ route('insertProduct.store') }}" method="POST" id="form_submit">
            <input type="hidden" id="provide_id" name="provide_id">
            @csrf
            <section id="infor_provide" class="bg-white">
            </section>
            <!-- Main content -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn btn-danger m-2" id="deleteRowTable">Xóa hàng</div>
                <div class="d-flex">
                    <label class="btn btn-default btn-file m-2 d-flex">
                        Import file<input type="file" id="import_file">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z" fill="#555555" />
                            </svg>
                        </div>
                    </label>
                    <button class="btn btn-default m-2 d-flex" id="form_quick">Mẫu nhập nhanh
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z" fill="#555555" />
                            </svg>
                        </div>
                    </button>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid" style="overflow-x: scroll;">
                    <table class="table table-hover" id="inputContainer">
                        <thead>
                            <tr>
                                <td><input type="checkbox" id="checkall"></td>
                                <td>Mã đơn</td>
                                <td>Thông tin sản phẩm</td>
                                <td>Loại hàng</td>
                                <td>Đơn vị tính</td>
                                <td>Số lượng</td>
                                <td>Giá nhập</td>
                                <td>Thuế</td>
                                <td>Thành tiền</td>
                                <td>Ghi chú</td>
                                <td>SN</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div id="list_modal">
                    </div>
                </div><!-- /.container-fluid -->
                <a href="javascript:;" class="btn btn-secondary addRow mt-2">Thêm sản phẩm</a>
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
                <div class="d-flex justify-content-center">
                    <button style="bottom: 0;" type="submit" name="action" class="btn btn-primary mr-2" value="AddProduct">Lưu</button>
                    <a href="{{ route('insertProduct.index') }}" class="btn btn-light">Hủy</a>
                </div>

        </form>
    </div>
    </section>
    <!-- /.content -->
</div>
<style>
    #list_modal .modal-dialog {
        max-width: 1200px !important;
    }
</style>
<script>
    var rowCount = $('tbody tr').length;
    var last = "<?php echo $lastId; ?>";

    $(document).on('click', '#deleteRowTable', function() {
        $('tbody input[type="checkbox"]:checked').closest('tr').remove();
    });

    function updateRowNumbers() {
        $('tbody tr').each(function(index) {
            $(this).find('th:first').text(index + 1);
        });
    }

    document.getElementById('import_file').addEventListener('change', function(event) {
        updateRowNumbers();
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var xmlContent = e.target.result;
            var parser = new DOMParser();
            var xmlDoc = parser.parseFromString(xmlContent, 'text/xml');
            var titles = xmlDoc.getElementsByTagName('THHDVu');
            var number = xmlDoc.getElementsByTagName('SLuong');
            $('tbody tr').remove();

            // Tạo các ô input mới và đặt giá trị của chúng
            for (var i = 0; i < titles.length; i++) {
                var titlesValue = titles[i].textContent;
                var numberssValue = number[i].textContent;
                var tr = '<tr>' +
                    '<input type="hidden" name="product_id[]" value="' + last + '">' +
                    '<td scope="row">' + rowCount + '</td>' +
                    '<td>' +
                    '<select name="products_id[]">' +
                    '@foreach ($products as $va)' +
                    '<option value="{{ $va->id }}">{{ $va->products_code }}</option>' +
                    '@endforeach' +
                    '</select> ' +
                    '</td>' +
                    '<td><input required type="text" name="product_name[]" value="' + titlesValue +
                    '"></td>' +
                    '<td><input required type="text" name="product_category[]"></td>' +
                    '<td><input required type="text" name="product_unit[]"></td>' +
                    '<td><input required type="number" name="product_qty[]" class="quantity-input" value="' +
                    numberssValue + '"></td>' +
                    '<td><input required type="number" name="product_price[]"></td>' +
                    '<td><input required type="number" name="product_tax[]" class="product_tax"></td>' +
                    '<td><input readonly type="text" name="product_total[]"></td>' +
                    '<td><input required type="text" name="product_trademark[]"></td>' +
                    '<td>' +
                    '<button name="btn_add_SN[]" type="button" data-toggle="modal" data-target="#exampleModal' +
                    rowCount + '" style="background:transparent; border:none;">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="4" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z" fill="#0095F6"/></svg>' +
                    '</button>' +
                    '</td>' +
                    '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
                    '</tr>';
                $('tbody').append(tr);
                updateRowNumbers();
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
                    '<td>ID</td>' +
                    '<td>Mã sản phẩm</td>' +
                    '<td>Tên sản phẩm</td>' +
                    '<td>Loại hàng</td>' +
                    '<td>Số lượng sản phẩm</td>' +
                    '<td>Số lượng S/N</td>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td>' + rowCount + '</td>' +
                    '<td>Mã sản phẩm </td>' +
                    '<td>Tên sản phẩm</td>' +
                    '<td>Loại hàng</td>' +
                    '<td>Số lượng 1</td>' +
                    '<td id="SNCount">1</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>' +
                    '<h3>Thông tin Serial Number </h3>' +
                    '<div class="d-flex" style="background:#E9ECEF; padding:10px 10px;">  <input type="checkbox" class="mr-5"> <span class="mr-5">STT</span> <span class="mr-5">Serial Number</span> </div>' +
                    '<div class="div_value' + rowCount + '" style="padding:10px;">' +
                    '<div class="delete d-flex justify-content-between">' +
                    '<div>' +
                    '<input class="mr-5" type="checkbox">' +
                    '<span class="mr-5">1</span>' +
                    '<input class="mr-5" required type="text" name="product_SN' + rowCount + '[]" onpaste="handlePaste(this)">' +
                    '</div>' +
                    '<div class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="AddSN btn btn-secondary" style="border:1px solid gray;">Thêm dòng</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                $('#list_modal').append(modal);

                var addSNBtns = $('.AddSN');
                for (let i = 0; i < addSNBtns.length; i++) {
                    $(addSNBtns[i]).off('click').on('click', function() {
                        var newDiv = document.createElement("input");
                        var checkbox = document.createElement("input");
                        var stt = document.createElement("span");
                        var div1 = document.createElement("div");
                        stt.setAttribute("class", "mr-5");
                        checkbox.setAttribute("type", "checkbox");
                        checkbox.setAttribute("class", "mr-5");
                        newDiv.setAttribute("type", "text");
                        newDiv.setAttribute("name", "product_SN" + i + "[]");
                        newDiv.setAttribute('onpaste', 'handlePaste(this)');
                        newDiv.setAttribute("class", "mr-5");
                        const div = document.createElement("div");
                        const divDelete = document.createElement("div");
                        divDelete.setAttribute('class', 'deleteRow1');
                        divDelete.innerHTML =
                            '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';
                        div.setAttribute('class', 'delete d-flex justify-content-between');
                        div1.appendChild(checkbox);
                        div1.appendChild(stt);
                        div1.appendChild(newDiv);
                        div.appendChild(div1);
                        div.appendChild(divDelete);
                        var div_value1 = document.querySelector('.div_value' + i);
                        div_value1.style.padding = '10px';
                        div_value1.appendChild(div);
                        var checkboxes = document.querySelectorAll('.div_value' + i + ' input[type="checkbox"]');
                        var checkboxCount = checkboxes.length;
                        stt.innerHTML = checkboxCount;
                        checkbox.setAttribute("id", "checkbox_" + checkboxCount);
                        $('#SNCount').text(checkboxCount);
                    });

                }
                rowCount++;
            }
        };
        reader.readAsText(file);
    });


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

            $(this).closest('tr').find('[name^="product_total"]').val(totalAmount);
            $(this).closest('tr').find('.product_tax').text(taxAmount);

            calculateTotalAmount();
            calculateTotalTax();
        }
    });

    function calculateTotalAmount() {
        var totalAmount = 0;
        $('tr').each(function() {
            var rowTotal = parseFloat($(this).find('[name^="product_total"]').val());
            if (!isNaN(rowTotal)) {
                totalAmount += rowTotal;
            }
        });
        $('#total-amount-sum').text(totalAmount);
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
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var totalAmount = parseFloat($('#total-amount-sum').text());
        var totalTax = parseFloat($('#product-tax').text());
        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(grandTotal.toFixed(2));
        $('#grand-total').attr('data-value', grandTotal.toFixed(2));
    }

    $("#radio1").on("click", function() {
        $('#infor_provide').empty();
    });

    $("#radio2").on("click", function() {
        $('#infor_provide').html(
            '<div class="border-bottom p-3 d-flex justify-content-between">' +
            '<b>Thông tin nhà cung cấp</b>' +
            '<button id="btn-addCustomer" class="btn btn-primary">' +
            '<span>Lưu thông tin</span></button></div>' +
            '<div class="row p-3">' +
            '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<label for="congty">Công ty:</label>' +
            '<input required type="text" class="form-control" id="provide_name_new" placeholder="Nhập thông tin" name="provide_name_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label>Địa chỉ xuất hóa đơn:</label>' +
            '<input required type="text" class="form-control" id="provide_address_new" placeholder="Nhập thông tin" name="provide_address_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Mã số thuế:</label>' +
            '<input required type="text" class="form-control" id="provide_code_new" placeholder="Nhập thông tin" name="provide_code_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '</div>' + '</div>' + '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<label for="email">Người đại diện:</label>' +
            '<input required type="text" class="form-control" id="provide_represent_new" placeholder="Nhập thông tin" name="provide_represent_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Email:</label>' +
            '<input required type="email" class="form-control" id="provide_email_new" placeholder="Nhập thông tin" name="provide_email_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Số điện thoại:</label>' +
            '<input required type="text" class="form-control" id="provide_phone_new" placeholder="Nhập thông tin" name="provide_phone_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '</div>' + '<div class="form-group">' +
            '</div>' + '<div class="form-group">' +
            '</div></div></div>'
        );
    });


    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toUpperCase();
            $("#myUL li").each(function() {
                var text = $(this).find("a").text().toUpperCase();
                $(this).toggle(text.indexOf(value) > -1);
            });
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

    var add_bill = document.getElementById('add_bill');
    add_bill.addEventListener('click', function(e) {
        e.preventDefault();
        var error = false;
        if (rowCount < 1) {
            alert('Vui lòng nhập ít nhất 1 sản phẩm');
            error = true;
        }
        $('input[name="product_name[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Vui lòng nhập tên sản phẩm')
            }
        });
        $('input[name^="product_total"]').each(function() {
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
        var provides_id = document.getElementById('form_submit');
        provides_id.setAttribute('action', '{{ route("addBill") }}');
        provides_id.submit();
    });


    function updateProductSN() {
        $('.modal-body').each(function(index) {
            var productSN = $(this).find('input[name^="product_SN"]');
            var div_value2 = $(this).find('div[class^="div_value"]');
            productSN.attr('name', 'product_SN' + index + '[]');
            div_value2.attr('class', 'div_value' + index + '[]');
        });
    }

    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
    });

    $('.cb-element').change(function() {
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    });

    $('.addRow').on('click', function() {
        last++;
        var tr = '<tr>' +
            '<input type="hidden" name="product_id[]" value="' + last + '">' +
            '<td scope="row"><input type="checkbox" id=' + rowCount + '" class="cb-element"></td>' +
            '<td>' +
            '<select name="products_id[]" id="list_products">' +
            '<option value="">Lựa chọn mã sản phẩm  </option> ' +
            '@foreach ($products as $va)' +
            '<option value="{{ $va->id }}">{{ $va->products_code }}</option>' +
            '@endforeach' +
            '</select> ' +
            '</td>' +
            // '<td><input required type="text" name="product_name[]"></td>' +
            '<td>' +
            '<select id="myUL1"> <option> <input type="text"> </option> </select>' +
            '</td>' +
            '<td><input required type="text" name="product_category[]"></td>' +
            '<td><input required type="text" name="product_unit[]"></td>' +
            '<td><input required type="number" name="product_qty[]" class="quantity-input"></td>' +
            '<td><input required type="number" name="product_price[]"></td>' +
            '<td><input required type="number" name="product_tax[]" class="product_tax"></td>' +
            '<td><input readonly type="text" name="product_total[]"></td>' +
            '<td><input required type="text" name="product_trademark[]"></td>' +
            '<td>' +
            '<button name="btn_add_SN[]" type="button" data-toggle="modal" data-target="#exampleModal' +
            rowCount + '" style="background:transparent; border:none;">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="4" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z" fill="#0095F6"/></svg>' +
            '</button>' +
            '</td>' +
            '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
            '</tr>';
        $('#inputContainer tbody').append(tr);
        updateRowNumbers();
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
            '<td>ID</td>' +
            '<td>Mã sản phẩm</td>' +
            '<td>Tên sản phẩm</td>' +
            '<td>Loại hàng</td>' +
            '<td>Số lượng sản phẩm</td>' +
            '<td>Số lượng S/N</td>' +
            '</tr>' +
            '</thead>' +
            '<tbody>' +
            '<tr>' +
            '<td>' + rowCount + '</td>' +
            '<td>Mã sản phẩm </td>' +
            '<td id="product_name">Tên sản phẩm</td>' +
            '<td>Loại hàng</td>' +
            '<td>Số lượng 1</td>' +
            '<td id="SNCount">1</td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '<h3>Thông tin Serial Number </h3>' +
            '<div class="d-flex" style="background:#E9ECEF; padding:10px 10px;">  <input type="checkbox" class="mr-5"> <span class="mr-5">STT</span> <span class="mr-5">Serial Number</span> </div>' +
            '<div class="div_value' + rowCount + '" style="padding:10px;">' +
            '<div class="delete d-flex justify-content-between">' +
            '<div>' +
            '<input class="mr-5" type="checkbox" id="checkbox_1">' +
            '<span class="mr-5" >1</span>' +
            '<input class="mr-5" required type="text" name="product_SN' + rowCount + '[]" onpaste="handlePaste(this)">' +
            '</div>' +
            '<div class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></div>' +
            '</div>' +
            '</div>' +
            '<div class="AddSN btn btn-secondary" style="border:1px solid gray;">Thêm dòng</div>' +
            '<div class="btn btn-danger ml-2" id="deleteSNS"> Xóa SN </div>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        $('#list_modal').append(modal);

        var addSNBtns = $('.AddSN');
        for (let i = 0; i < addSNBtns.length; i++) {
            $(addSNBtns[i]).off('click').on('click', function() {
                var newDiv = document.createElement("input");
                var checkbox = document.createElement("input");
                var stt = document.createElement("span");
                var div1 = document.createElement("div");
                stt.setAttribute("class", "mr-5");
                checkbox.setAttribute("type", "checkbox");
                checkbox.setAttribute("class", "mr-5");
                newDiv.setAttribute("type", "text");
                newDiv.setAttribute("name", "product_SN" + i + "[]");
                newDiv.setAttribute('onpaste', 'handlePaste(this)');
                newDiv.setAttribute("class", "mr-5");
                const div = document.createElement("div");
                const divDelete = document.createElement("div");
                divDelete.setAttribute('class', 'deleteRow1');
                divDelete.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';
                div.setAttribute('class', 'delete d-flex justify-content-between');
                div1.appendChild(checkbox);
                div1.appendChild(stt);
                div1.appendChild(newDiv);
                div.appendChild(div1);
                div.appendChild(divDelete);
                var div_value1 = document.querySelector('.div_value' + i);
                div_value1.style.padding = '10px';
                div_value1.appendChild(div);
                var checkboxes = document.querySelectorAll('.div_value' + i + ' input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                stt.innerHTML = checkboxCount;
                checkbox.setAttribute("id", "checkbox_" + checkboxCount);
                $('#SNCount').text(checkboxCount);
            });
        }
        $(document).on('click', '#deleteSNS', function() {
            for (let i = 0; i <= addSNBtns.length; i++) {
                $('.div_value' + i + ' input[type="checkbox"]:checked').parent().parent().remove();
            }
        });
        rowCount++;
    });

    // function getData(value) {
    //     console.log($(this));
    //     // $('#product_name').text(value);
    //     // console.log(value);
    // }

    $(document).on('change', '#list_products', function(e) {
        e.preventDefault();
        var id = $(this).val();
        $.ajax({
            url: "{{ route('showProduct') }}",
            type: "get",
            data: {
                id: id,
            },
            success: function(data) {
                // $('#myUL1').find('option').remove();
                data.forEach(function(item) {
                    var op = '<option> ' + item.product_name + '</option> ';
                    $('#myUL1').append(op);
                });

            }
        })
    })


    // Hàm xử lý paste cột từ file excel
    function handlePaste(input) {
        var rowCount = $(input).attr('name').match(/\d+/)[0];
        var clipboardData = event.clipboardData || window.clipboardData;
        var pastedData = clipboardData.getData('Text');
        var rows = pastedData.trim().split('\n');
        var parent_div = $('.div_value' + rowCount);
        for (var i = 0; i < rows.length; i++) {
            var rowData = rows[i].trim();
            if (rowData === '') {
                continue;
            }
            var newDiv = document.createElement('input');
            var checkbox = document.createElement("input");
            var stt = document.createElement("span");
            var div1 = document.createElement("div");
            const div = document.createElement("div");
            const divDelete = document.createElement("div");
            stt.setAttribute("class", "mr-5");
            checkbox.setAttribute("type", "checkbox");
            checkbox.setAttribute("class", "mr-5");
            newDiv.setAttribute("type", "text");
            newDiv.setAttribute("name", "product_SN" + rowCount + "[]");
            newDiv.setAttribute('onpaste', 'handlePaste(this)');
            newDiv.setAttribute("class", "mr-5");
            divDelete.className = 'deleteRow1';
            divDelete.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';
            div.className = 'delete d-flex justify-content-between';
            div1.appendChild(checkbox);
            div1.appendChild(stt);
            div1.appendChild(newDiv);
            div.appendChild(div1);
            div.appendChild(divDelete);
            var checkboxes = document.querySelectorAll('.div_value' + rowCount + ' input[type="checkbox"]');
            var checkboxCount = checkboxes.length;
            stt.innerHTML = checkboxCount;
            checkbox.setAttribute("id", "checkbox_" + checkboxCount);
            $('#SNCount').text(checkboxCount);
            newDiv.value = rows[i].trim();
            parent_div[0].style.padding = '10px';
            parent_div[0].appendChild(div);

        }
        $(input).parent().parent().remove();
    }


    $(document).on('click', '.deleteRow1', function() {
        var div = $(this).parent('div');
        $(div).remove();
    })

    $('body').on('click', '.deleteRow', function() {
        var parentTr = $(this).closest('tr');
        var targetId = $(this).closest('tr').find('button[name="btn_add_SN[]"]').attr('data-target');
        $(targetId).remove();
        parentTr.remove();
        updateRowNumbers();
    });

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
                    '<button id="btn-addProvide" class="btn btn-primary">' +
                    '<span>Lưu thông tin</span></button></div>' +
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
    // Kiểm tra dữ liệu trước khi submit
    $(document).on('submit', '#form_submit', function(e) {
        e.preventDefault();
        var error = false;
        if (rowCount < 1) {
            alert('Vui lòng nhập ít nhất 1 sản phẩm');
            error = true;
        }
        $('input[name="product_name[]"]').each(function() {
            if ($(this).val() === '') {
                alert('Vui lòng nhập tên sản phẩm')
            }
        });
        $('input[name^="product_total"]').each(function() {
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

    $(document).on('click', '#form_quick', function(e) {
        e.preventDefault();
    });
    // $(document).on('click', '#Cancel', function(e) {
    //   e.preventDefault();
    // })
</script>
@endif
</body>

</html>