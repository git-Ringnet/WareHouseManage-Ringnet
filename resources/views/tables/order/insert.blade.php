<x-navbar :title="$title"></x-navbar>
@if (Auth::check() != null)
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 breadcrumb">
            <span> <a href="{{ route('insertProduct.index') }}"> Nhập hàng</a></span>
            <span class="px-1"> / </span>
            <span><b>Đơn hàng mới</b></span>
        </div>
        <div class="col-sm-6 position-absolute" style="top:63px;right:2%">
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="d-flex mb-1 action-don">
            <a href="#" class="btn btn-danger text-white" id="add_bill">Duyệt đơn</a>
            <a href="#" class="btn btn-secondary mx-4">Hủy đơn</a>
        </div>
        <div class="container-fluided">
            <div class="row my-3">
                <div class="col">
                    <div class="w-75">
                        <div class="d-flex mb-2">
                            <input type="radio" name="options" id="radio1" checked>
                            <span class="ml-1">Nhà cung cấp cũ</span>
                            <input type="radio" name="options" id="radio2" style="margin-left: 40px;">
                            <span class="ml-1">Nhà cung cấp mới</span>
                        </div>
                        <div class="input-group mb-1 position-relative w-50">
                            <input type="text" class="form-control" placeholder="Nhập thông tin nhà cung cấp" aria-label="Username" aria-describedby="basic-addon1" id="myInput" autocomplete="off">
                            <div class="position-absolute" style="right: 5px;top: 17%;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1835 7.36853C13.0254 5.21049 9.52656 5.21049 7.36853 7.36853C5.21049 9.52656 5.21049 13.0254 7.36853 15.1835C9.52656 17.3415 13.0254 17.3415 15.1835 15.1835C17.3415 13.0254 17.3415 9.52656 15.1835 7.36853ZM16.2441 6.30787C13.5003 3.56404 9.05169 3.56404 6.30787 6.30787C3.56404 9.05169 3.56404 13.5003 6.30787 16.2441C9.05169 18.988 13.5003 18.988 16.2441 16.2441C18.988 13.5003 18.988 9.05169 16.2441 6.30787Z" fill="#555555" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1796 15.1796C15.4725 14.8867 15.9474 14.8867 16.2403 15.1796L19.5303 18.4696C19.8232 18.7625 19.8232 19.2374 19.5303 19.5303C19.2374 19.8232 18.7625 19.8232 18.4696 19.5303L15.1796 16.2403C14.8867 15.9474 14.8867 15.4725 15.1796 15.1796Z" fill="#555555" />
                                </svg>
                            </div>
                        </div>
                        <ul id="myUL" class="bg-white position-absolute w-50 rounded shadow p-0 scroll-data" style="z-index: 99;">
                            @foreach ($provide as $value)
                            <li>
                                <a href="#" class="text-dark d-flex justify-content-between p-2 search-info" id="{{ $value->id }}" name="search-info">
                                    <span class="w-50">{{ $value->provide_represent }}</span>
                                    <span class="w-50">{{ $value->provide_name }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
    </section>
    <div class="container-fluided">
        <form action="{{ route('insertProduct.store') }}" method="POST" id="form_submit">
            <input type="hidden" id="provide_id" name="provide_id">
            @csrf
            <section id="infor_provide" class="bg-white rounded">
            </section>
            <!-- Main content -->
            <div class="d-flex justify-content-between align-items-center my-2">
                <div class="btn btn-danger" id="deleteRowTable" style="opacity: 0;">Xóa hàng</div>
                <div class="d-flex">
                    <label class="btn btn-default btn-file m-2 d-flex">
                        Import file
                        <input type="file" id="import_file" class="import_file" accept=".xml">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.23123 9.23123C7.53954 8.92292 8.03941 8.92292 8.34772 9.23123L12 12.8835L15.6523 9.23123C15.9606 8.92292 16.4605 8.92292 16.7688 9.23123C17.0771 9.53954 17.0771 10.0394 16.7688 10.3477L12.5582 14.5582C12.2499 14.8665 11.7501 14.8665 11.4418 14.5582L7.23123 10.3477C6.92292 10.0394 6.92292 9.53954 7.23123 9.23123Z" fill="#555555" />
                            </svg>
                        </div>
                    </label>
                </div>
            </div>
            <section class="content">
                <div class="container-fluided" style="overflow-x: auto;">
                    <table class="table table-hover bg-white rounded" id="inputContainer">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkall"></th>
                                <th>Mã sản phẩm</th>
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
                        </tbody>
                    </table>
                    <div class="mb-2"><a href="javascript:;" class="btn btn-secondary addRow">Thêm sản phẩm</a>
                    </div>
                    <div id="list_modal">
                    </div>
                </div><!-- /.container-fluided -->
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
                <div class="d-flex justify-content-center btn-fixed">
                    <button style="bottom: 0;" type="submit" name="action" class="btn btn-primary mr-2" value="AddProduct">Lưu</button>
                    <a href="{{ route('insertProduct.index') }}" class="btn btn-light" onclick="return confirm('Bạn có muốn quay lại ?');">Hủy</a>
                </div>
        </form>
    </div>
    </section>
    <!-- /.content -->
</div>
<script src="{{ asset('dist/js/productOrder.js') }}"></script>
<script>
    var rowCount = $('tbody tr').length;

    $(document).on('input', '.quantity-input, [name^="product_price"]', function(e) {
        var productQty = parseInt($(this).closest('tr').find('.quantity-input').val());
        var productPrice = parseFloat($(this).closest('tr').find('input[name^="product_price"]').val().replace(/[^0-9.-]+/g, ""));
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
        var productQty = parseInt(row.find('.quantity-input').val());
        var productPrice = parseFloat(row.find('input[name^="product_price"]').val().replace(/[^0-9.-]+/g, ""));
        var taxValue = parseFloat(row.find('.product_tax').val());
        if (taxValue == 99) {
            taxValue = 0;
        }
        if (!isNaN(productQty) && !isNaN(productPrice) && !isNaN(taxValue)) {
            var totalAmount = productQty * productPrice;
            var taxAmount = (totalAmount * taxValue) / 100;

            row.find('.product_tax1').text(taxAmount);
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
        $('#product-tax').text(formatCurrency(totalTax));

        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        var totalAmount = parseFloat($('#total-amount-sum').text().replace(/[^0-9.-]+/g, ""));
        var totalTax = parseFloat($('#product-tax').text().replace(/[^0-9.-]+/g, ""));

        var grandTotal = totalAmount + totalTax;
        $('#grand-total').text(formatCurrency(grandTotal));

        // Update data-value attribute
        $('#grand-total').attr('data-value', grandTotal);
        $('#total').val(formatCurrency(grandTotal));
    }


    $(document).on('click', '#deleteRowTable', function() {
        $('tbody input[type="checkbox"]:checked').closest('tr').remove();
    });

    $("#radio1").on("click", function() {
        $('#infor_provide').empty();
    });

    $("#radio2").on("click", function() {
        $('#provide_id').val("");
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
            '<input required type="text" class="form-control" id="provide_name_new" placeholder="Nhập thông tin" name="provide_name_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label>Địa chỉ xuất hóa đơn:</label>' +
            '<input required type="text" class="form-control" id="provide_address_new" placeholder="Nhập thông tin" name="provide_address_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Mã số thuế:</label>' +
            '<input required type="text" class="form-control" oninput="validateNumberInput(this)" id="provide_code_new" placeholder="Nhập thông tin" name="provide_code_new" value="">' +
            '</div>' + '</div>' + '<div class="col-sm-6">' +
            '<div class="form-group">' +
            '<label for="email">Người đại diện:</label>' +
            '<input required type="text" class="form-control" id="provide_represent_new" placeholder="Nhập thông tin" name="provide_represent_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Email:</label>' +
            '<input required type="email" class="form-control" id="provide_email_new" placeholder="Nhập thông tin" name="provide_email_new" value="">' +
            '</div>' + '<div class="form-group">' +
            '<label for="email">Số điện thoại:</label>' +
            '<input required type="number" class="form-control" id="provide_phone_new" placeholder="Nhập thông tin" name="provide_phone_new" value="">' +
            '</div></div></div>'
        );
    });


    var add_bill = document.getElementById('add_bill');
    add_bill.addEventListener('click', function(e) {
        this.classList.add('disabled');
        var countDown = 10;
        var countdownInterval = setInterval(function() {
            countDown--;
            if (countDown <= 0) {
                clearInterval(countdownInterval);
                add_bill.classList.remove('disabled');
            }
        }, 100);

        e.preventDefault();
        var error = false;
        var isDuplicate = false;
        if (checkRow() == false) {
            alert('Vui lòng nhập ít nhất 1 sản phẩm');
            error = true;
        }
        $('select[name="products_id[]"]').each(function() {
            if ($(this).val() === "") {
                error = true;
                alert('Vui lòng chọn sản phẩm cần thêm');
            }
        });

        if ($('#provide_id').val().trim() == '' && $('#radio1').prop('checked') == true) {
            isDuplicate = true;
            alert('Vui lòng chọn nhà cung cấp');
        }

        // AJAX Kiểm tra Serial number đã tồn tại chưa
        var listSN = [];
        var products_id = [];
        $('select[name^="products_id[]"]').each(function() {
            products_id.push($(this).val());
        })
        $('input[name^="product_SN"]').each(function() {
            if ($(this).val() == "") {
                error = true;
                alert('Vui lòng nhập seri number');
                return false;
            } else {
                var sn = $(this).val();
                if (sn !== "") {
                    listSN.push(sn);
                }
            }

        });

        // Kiểm tra xem các giá trị SN có giống nhau hay không
        var duplicateSerialNumbers = {};
        var listProducts = {};
        for (var i = 0; i < listSN.length; i++) {
            var product_id = products_id[i];
            var snValues = [];
            $('input[name^="product_SN' + i + '"]').each(function() {
                var snValue = $(this).val();
                snValues.push(snValue);
            });

            if (!listProducts[product_id]) {
                listProducts[product_id] = [];
            }

            var productData = {
                sn: snValues
            };

            listProducts[product_id].push(productData);

            if (!duplicateSerialNumbers[product_id]) {
                duplicateSerialNumbers[product_id] = new Set();
            } else {
                for (var j = 0; j < listProducts[product_id].length - 1; j++) {
                    var previousSnValues = listProducts[product_id][j].sn;
                    for (var k = 0; k < snValues.length; k++) {
                        if (previousSnValues.includes(snValues[k])) {
                            var duplicateSn = snValues[k];
                            isDuplicate = true;
                            alert("Seri number " + duplicateSn + " đã tồn tại");
                            break;
                        }
                    }
                    if (isDuplicate) {
                        break;
                    }
                }
            }
        }

        var countQTY = 0;
        // Kiểm tra số lượng và seri number
        $('input[name^="product_qty"]').each(function() {
            countQTY += parseInt($(this).val());
        })

        if (listSN.length != countQTY) {
            error = true;
            alert("Số lượng sản phẩm và serial number không hợp lệ !");
        }

        if (isDuplicate == false) {
            $.ajax({
                url: "{{route('checkSN')}}",
                type: "get",
                data: {
                    listSN: listSN,
                    products_id: products_id
                },
                success: function(data) {
                    if (data.success == false) {
                        error = true;
                        alert("Seri number" + data.existingSN + "đã tồn tại");
                    } else {
                        updateProductSN();
                        var provides_id = document.getElementById('form_submit');
                        provides_id.setAttribute('action', '{{ route("addBill") }}');
                        provides_id.submit();
                    }
                }
            })
        }
    });


    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
        updateMultipleActionVisibility();
    });

    $('.cb-element').change(function() {
        updateMultipleActionVisibility();
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    });

    function updateMultipleActionVisibility() {
        if ($('.cb-element:checked').length > 0) {
            $('#deleteRowTable').css('opacity', 1);
        } else {
            $('#deleteRowTable').css('opacity', 0);
        }
    }

    // Xử lý tạo Tr, modal
    $('.addRow').on('click', function() {
        var tr = '<tr>' +
            '<td scope="row"><input type="checkbox" id=' + rowCount + '" class="cb-element"></td>' +
            '<td>' +
            '<select name="products_id[]" class="list_products form-control">' +
            '<option value="">Lựa chọn mã sản phẩm </option> ' +
            '@foreach ($products as $va)' +
            '<option value="{{ $va->id }}">{{ $va->products_code }}</option>' +
            '@endforeach' +
            '</select> ' +
            '</td>' +
            '<td>' +
            '<input id="search" type="text" placeholder="Nhập thông tin sản phẩm" name="product_name[]" class="search_product form-control name_product" onkeyup="filterFunction()"> ' +
            '<div id="dropdown-values" class="dropdown-values"><ul id="myUL1" class="myUL1 bg-white position-absolute rounded shadow" style="padding:0 10px; cursor:pointer;"> </ul>  </div>' +
            '</td>' +
            '<td><input required type="text" class="form-control type_product" style="width:120px" name="product_category[]"></td>' +
            '<td><input required type="text" class="form-control text-center unit_product" style="width:70px" name="product_unit[]"></td>' +
            '<td><input required type="text" oninput="validatQtyInput(this)" name="product_qty[]" class="quantity-input form-control text-center"></td>' +
            '<td><input required type="text" class="form-control text-center product_price" style="width:140px"" name="product_price[]" ></td>' +
            '<td>' +
            '<input type="hidden" class="product_tax1">' +
            '<select name="product_tax[]" style="width:80px" class="product_tax form-control">' +
            '<option value="10">10%</option>' +
            '<option value="0">0%</option>' +
            '<option value="8">8%</option>' +
            '<option value="99">NOVAT</option>' +
            '</select>' +
            '</td>' +
            '<td><input readonly type="text" class="form-control total-amount text-center" style="width:140px" name="product_total[]"></td>' +
            '<td><input type="text" class="form-control" style="width:150px" name="product_trademark[]"></td>' +
            '<td>' +
            '<button class="exampleModal" name="btn_add_SN[]" type="button" data-toggle="modal" data-target="#exampleModal' +
            rowCount + '" style="background:transparent; border:none;">' +
            '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="4" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z" fill="#0095F6"/></svg>' +
            '</button>' +
            '</td>' +
            '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
            '</tr>';
        $('#inputContainer tbody').append(tr);
        updateRowNumbers();
        var modal = '<div class="modal fade" id="exampleModal' + rowCount +
            '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">' +
            '<div class="modal-dialog" role="document">' +
            '<div class="modal-content">' +
            '<div class="modal-header align-items-center">' +
            '<div> ' +
            '<h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>' +
            '<p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>' +
            '</div>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
            '<span aria-hidden="true" onclick="checkData(event)">&times;</span>' +
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
            '<td class="sttRowTable"></td>' +
            '<td class="code_product"></td>' +
            '<td class="name_product"></td>' +
            '<td class="provide_name"></td>' +
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
            '<td><span class="mr-5 stt_SN" ></span></td>' +
            '<td><input class="mr-5 form-control w-25" type="text" name="product_SN' + rowCount +
            '[]" onpaste="handlePaste(this)"></td>' +
            '<td class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></td>' +
            '</tr>' +
            '</tbody>' +
            '</table>' +
            '</div>' +
            '<div class="AddSN btn btn-secondary" style="border:1px solid gray;">Thêm dòng</div>' +
            // '<div class="btn btn-danger ml-2" id="deleteSNS"> Xóa SN </div>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-secondary" onclick="checkData(event)" data-dismiss="modal">Lưu</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>'
        $('#list_modal').append(modal);
        createInput();
        checkRow();
        $(document).on('click', '#deleteSNS', function() {
            for (let i = 0; i <= addSNBtns.length; i++) {
                $('.div_value' + i + ' input[type="checkbox"]:checked').parent().parent()
                    .remove();
            }
        });
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
        fillDataToModal();
    });

    // Hàm tạo ra các input
    function createInput() {
        var addSNBtns = $('.AddSN');
        for (let i = 0; i <= addSNBtns.length; i++) {
            $(addSNBtns[i]).off('click').on('click', function() {
                var currentIndex = addSNBtns[i].closest('.modal-body').querySelector('#table_SNS')
                    .closest('div')
                    .className.match(/\d+/)[0];
                var modal_body = addSNBtns[i].closest('.modal-body');
                var newtr = document.createElement('tr');
                var newtd1 = document.createElement('td');
                var newtd2 = document.createElement('td');
                var newtd3 = document.createElement('td');
                var newtd4 = document.createElement('td');
                var newDiv = document.createElement("input");
                var checkbox = document.createElement("input");
                var stt = document.createElement("span");
                var div1 = document.createElement("div");
                var div = document.createElement("div");
                var divDelete = document.createElement("div");
                var div_value1 = document.querySelector('.div_value' + i + ' table tbody');
                var checkboxes = modal_body.querySelectorAll('input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                checkbox.setAttribute("type", "checkbox");
                stt.setAttribute('class','stt_SN');
                newtd1.append(checkbox);
                newDiv.setAttribute("type", "text");
                newDiv.setAttribute("class", "form-control w-25");
                newDiv.setAttribute("name", "product_SN" + currentIndex + "[]");
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
                modal_body.querySelector('#table_SNS tbody').appendChild(newtr);
                stt.innerHTML = checkboxCount;
                checkbox.setAttribute("id", "checkbox_" + checkboxCount);
                modal_body.querySelector('.SNCount').textContent = checkboxCount;
            });
        }
    }

    // Hiển thị sản phẩm con 
    $(document).on('change', '.list_products', function(e) {
        e.preventDefault();
        var id = $(this).val();
        var row = $(this).closest('tr');
        var childSelect = row.find('.myUL1');
        var name = row.find('input[name="product_name[]"]');
        // name.val("");
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

    // Hàm xử lý paste cột từ file excel
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
            var checkboxes = document.querySelectorAll('.div_value' + rowCount +
                ' table tbody input[type="checkbox"]');
            var checkboxCount = checkboxes.length;
            stt.innerHTML = checkboxCount;
            checkbox.setAttribute("id", "checkbox_" + checkboxCount);
            $('.SNCount').text(checkboxCount);
            newDiv.value = rows[i].trim();
            parent_div[0].appendChild(newtr);
        }
        var parentTable = $(input).closest('table')
        $(input).parent().parent().remove();
        var remainingRows = parentTable.find('tbody tr');
        remainingRows.each(function(index) {
            $(this).find('td').eq(1).text(index + 1);
        });

    }

    // Chỉnh sửa thông tin nhà cung cấp
    $(document).on('click', '#btn-addProvide', function(e) {
        e.preventDefault();
        var err = false;
        if ($('#provide_name').val() == "") {
            err = true;
            alert("Vui lòng nhập tên công ty");
        } else if ($('#provide_address').val() == "") {
            err = true;
            alert("Vui lòng nhập địa chỉ xuất hóa đơn");
        } else if ($('#provide_represent').val == "") {
            err = true;
            alert("Vui lòng nhập người đại diện");
        } else if ($('#provide_email').val() == "") {
            err = true;
            alert("Vui lòng nhập email");
        } else if ($('#provide_phone').val() == "") {
            err = true;
            alert("Vui lòng nhập số điện thoại");
        } else if ($('#provide_code').val() == "") {
            err = true;
            alert("Vui lòng nhập mã số thuế");
        }
        if (err === false) {
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
        }
    })

    // Hiển thị danh sách nhà cung cấp cũ
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
                    '<button id="btn-addProvide" class="btn btn-primary d-flex align-items-center">' +
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
                    '<input required type="text" class="form-control" oninput="validateNumberInput(this)" id="provide_code" placeholder="Nhập thông tin" name="provide_code" value="' +
                    data.provide_code + '">' +
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
                    '</div></div></div>'
                );
                $('#provide_id').val(data.id);
            }
        });
    })


    // Kiểm tra dữ liệu trước khi submit
    $(document).on('submit', '#form_submit', function(e) {
        $(e.target).find('.btn.btn-primary.mr-2').prop('disabled', true);
        var countDown = 10;
        var countdownInterval = setInterval(function() {
            countDown--;
            if (countDown <= 0) {
                clearInterval(countdownInterval);
                $(e.target).find('.btn.btn-primary.mr-2').prop('disabled', false);
            }
        }, 100);

        e.preventDefault();
        var error = false;
        if (checkRow() == false) {
            alert('Vui lòng nhập ít nhất 1 sản phẩm');
            error = true;
        }

        $('select[name="products_id[]"]').each(function() {
            if ($(this).val() === "") {
                error = true;
                alert('Vui lòng chọn sản phẩm cần thêm');
            }
        });

        if ($('#provide_id').val().trim() == '' && $('#radio1').prop('checked') == true) {
            error = true;
            alert('Vui lòng chọn nhà cung cấp');
        }

        // AJAX Kiểm tra Serial number đã tồn tại chưa
        var listSN = [];
        var products_id = [];
        // var listProducts = {};
        $('select[name^="products_id[]"]').each(function() {
            products_id.push($(this).val());
        })
        $('input[name^="product_SN"]').each(function() {
            if ($(this).val() == "") {
                error = true;
                alert('Vui lòng nhập seri number');
                return false;
            } else {
                var sn = $(this).val();
                if (sn !== "") {
                    listSN.push(sn);
                }
            }
        });

        var countQTY = 0;
        // Kiểm tra số lượng và seri number
        $('input[name^="product_qty"]').each(function() {
            countQTY += parseInt($(this).val());
        })

        if (listSN.length != countQTY) {
            error = true;
            alert("Số lượng sản phẩm và serial number không hợp lệ !");
        }

        if (checkDuplicateRows()) {
            alert('Sản phẩm đã tồn tại');
            error = true;
        }

        if (error) {
            return false;
        }

        // Kiểm tra xem các giá trị SN có giống nhau hay không
        var isDuplicate = false;

        for (var i = 0; i < listSN.length - 1; i++) {
            for (var j = i + 1; j < listSN.length; j++) {
                if (listSN[i].trim() === listSN[j].trim()) {
                    isDuplicate = true;
                    alert("Đã nhập trùng serial number " + " " + listSN[j]);
                    break;
                }
            }
            if (isDuplicate) {
                break;
            }
        }
        // var duplicateSerialNumbers = {};
        // for (var i = 0; i < listSN.length; i++) {
        //     var product_id = products_id[i];
        //     var snValues = [];
        //     $('input[name^="product_SN' + i + '"]').each(function() {
        //         var snValue = $(this).val();
        //         snValues.push(snValue);
        //     });

        //     if (!listProducts[product_id]) {
        //         listProducts[product_id] = [];
        //     }

        //     var productData = {
        //         sn: snValues
        //     };

        //     listProducts[product_id].push(productData);

        //     if (!duplicateSerialNumbers[product_id]) {
        //         duplicateSerialNumbers[product_id] = new Set();
        //     } else {
        //         for (var j = 0; j < listProducts[product_id].length - 1; j++) {
        //             var previousSnValues = listProducts[product_id][j].sn;
        //             for (var k = 0; k < snValues.length; k++) {
        //                 if (previousSnValues.includes(snValues[k])) {
        //                     var duplicateSn = snValues[k];
        //                     isDuplicate = true;
        //                     alert("Seri number " + duplicateSn + " đã tồn tại ");
        //                     break;
        //                 }
        //             }
        //             if (isDuplicate) {
        //                 break;
        //             }
        //         }
        //     }
        // }
        if (isDuplicate == false) {
            $.ajax({
                url: "{{route('checkSN')}}",
                type: "get",
                data: {
                    listSN: listSN,
                    products_id: products_id
                },
                success: function(data) {
                    if (data.success == false) {
                        error = true;
                        alert("Seri number " + data.existingSN + " đã tồn tại");
                    } else {
                        updateProductSN();
                        $('#form_submit')[0].submit();
                    }
                }
            })
        }
    });

    // Thêm nhanh nhà cung cấp
    $(document).on('click', '#btn-addCustomer', function(e) {
        e.preventDefault();
        var provide_name = $('#provide_name_new').val();
        var provide_address = $('#provide_address_new').val();
        var provide_represent = $('#provide_represent_new').val();
        var provide_email = $('#provide_email_new').val();
        var provide_phone = $('#provide_phone_new').val();
        var provide_code = $('#provide_code_new').val();
        var check = false;
        if (provide_name == "") {
            alert('Vui lòng nhập tên công ty');
            check = true;
        } else if (provide_address == "") {
            alert('Vui lòng nhập địa chỉ xuất hóa đơn');
            check = true;
        } else if (provide_represent == "") {
            alert('Vui lòng nhập người đại diện');
            check = true;
        } else if (provide_email == "") {
            alert('Vui lòng nhập email');
            check = true;
        } else if (provide_phone == "") {
            alert('Vui lòng nhập số điện thoại');
            check = true;
        } else if (provide_code == "") {
            alert('Vui lòng nhập mã số thuế');
            check = true;
        }
        if (check == false) {
            $.ajax({
                url: "{{ route('add_newProvide') }}",
                type: "get",
                data: {
                    provide_name: provide_name,
                    provide_address: provide_address,
                    provide_represent: provide_represent,
                    provide_email: provide_email,
                    provide_phone: provide_phone,
                    provide_code: provide_code
                },
                success: function(data) {
                    if (data.success) {
                        alert(data.msg);
                        $('#provide_id').val(data.data.id);
                    }
                }
            })
        }

    })

    // Import file XML
    var fileImport = document.getElementById('import_file');
    if (fileImport) {
        fileImport.addEventListener('change', function(event) {
            var reader = new FileReader();
            var fileInput = this;
            var file = fileInput.files[0];
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
                        tax = 99;
                    } else {
                        tax = parseInt(TSuat[i].textContent.match(/\d+/)[0]);
                    }
                    var titlesValue = THHDVu[i].textContent;
                    var numberssValue = Math.floor(SLuong[i].textContent).toString();
                    var typeValue = DVTinh[i].textContent;
                    var price = formatCurrency(Math.floor(DGia[i].textContent).toString());
                    var totalPrice = formatCurrency(numberssValue * (price.replace(/[^0-9.-]+/g, "")));
                    var tr = '<tr>' +
                        '<td scope="row"><input type="checkbox" id=' + rowCount + '" class="cb-element"></td>' +
                        '<td>' +
                        '<select class="form-control w-auto" name="products_id[]">' +
                        '<option value="">Lựa chọn mã sản phẩm</option>' +
                        '@foreach ($products as $va)' +
                        '<option value="{{ $va->id }}">{{ $va->products_code }}</option>' +
                        '@endforeach' +
                        '</select> ' +
                        '</td>' +
                        '<td><input required type="text" class="search_product form-control" name="product_name[]" value="' + titlesValue +
                        '"></td>' +
                        '<td><input required type="text" class="form-control" style="width:120px" name="product_category[]"></td>' +
                        '<td><input required type="text" class="form-control text-center" style="width:70px" name="product_unit[]" value="' + typeValue +
                        '"></td>' +
                        '<td><input required type="text" oninput="validatQtyInput(this)" name="product_qty[]" class="quantity-input form-control text-center" value="' +
                        numberssValue + '"></td>' +
                        '<td><input required type="text" class="form-control product_price text-center" style="width:140px" name="product_price[]" value="' + price + '"></td>' +
                        '<input type="hidden" class="product_tax1">' +
                        '<td>' +
                        '<select style="width:80px;" name="product_tax[]"class="product_tax form-control" >' +
                        '<option value="10"' + (tax == 10 ? "selected" : "") + '>10%</option>' +
                        '<option value="0" ' + (tax == 0 ? "selected" : "") + '>0%</option>' +
                        '<option value="8" ' + (tax == 8 ? "selected" : "") + '>8%</option>' +
                        '<option value="99" ' + (tax == 99 ? "selected" : "") + '>NOVAT</option>' +
                        '</select' +
                        '</td>' +
                        '<td><input readonly type="text" style="width:140px" class="form-control text-center total-amount" name="product_total[]" value=""></td>' +
                        '<td><input type="text" class="form-control" style="width:150px" name="product_trademark[]"></td>' +
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
                        '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">' +
                        '<div class="modal-dialog" role="document">' +
                        '<div class="modal-content">' +
                        '<div class="modal-header align-items-center">' +
                        '<div> ' +
                        '<h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>' +
                        '<p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>' +
                        '</div>' +
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                        '<span aria-hidden="true" onclick="checkData(event)">&times;</span>' +
                        '</button>' +
                        '</div>' +
                        '<div class="modal-body">' +
                        ' <table class="table table-hover"> ' +
                        '<thead> ' +
                        '<tr>' +
                        '<td>ID</td>' +
                        '<td>Mã sản phẩm</td>' +
                        '<td>Tên sản phẩm</td>' +
                        '<td>Nhà cung cấp</td>' +
                        '<td>Loại hàng</td>' +
                        '<td>Số lượng sản phẩm</td>' +
                        '<td>Số lượng S/N</td>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>' +
                        '<tr>' +
                        '<td>' + rowCount + '</td>' +
                        '<td class="code_product"></td>' +
                        '<td class="name_product"></td>' +
                        '<td class="provide_name"></td>' +
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
                        '<td><input class="mr-5 form-control w-25" type="text" name="product_SN' + rowCount +
                        '[]" onpaste="handlePaste(this)"></td>' +
                        '<td class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></td>' +
                        '</tr>' +
                        '</tbody>' +
                        '</table>' +
                        '</div>' +
                        '<div class="AddSN btn btn-secondary" style="border:1px solid gray;">Thêm dòng</div>' +
                        // '<div class="btn btn-danger ml-2" id="deleteSNS"> Xóa SN </div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-secondary" onclick="checkData(event)" data-dismiss="modal">Lưu</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    $('#list_modal').append(modal);
                    createInput();
                    deleteDuplicateTr();
                    rowCount++;
                    fillDataToModal();
                    calculateTotals();
                }
            };
            reader.readAsText(file);
            fileImport.value = "";
            checkRow();
        });
    }
    $(document).on('keypress', 'form', function(event) {
            return event.keyCode != 13; 
        });
</script>
@endif
</body>

</html>