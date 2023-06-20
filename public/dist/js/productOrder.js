function updateRowNumbers() {
    $('tbody tr').each(function (index) {
        $(this).find('th:first').text(index + 1);
    });
}

$(document).on('input', '.name_product, .type_product, .product_price', function () {
    if (checkAllValuesEntered()) {
        checkDuplicateRows();
    }
});

function checkAllValuesEntered() {
    var allValuesEntered = true;
    var inputs = document.querySelectorAll('.name_product, .type_product, .product_price');

    for (var i = 1; i < inputs.length; i++) {
        if (inputs[i].value === '') {
            allValuesEntered = false;
            break;
        }
    }

    return allValuesEntered;
}

$(document).on('change', '.list_products', function (e) {
    if (checkAllValuesEntered()) {
        checkDuplicateRows();
    }
})

function checkDuplicateRows() {
    var table = document.getElementById("inputContainer");
    var rows = table.getElementsByTagName("tr");
    var values = [];

    // Lặp qua từng hàng trừ hàng tiêu đề
    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var rowValues = [];
        var isDuplicate = false;

        // Lặp qua từng ô dữ liệu trong hàng
        for (var j = 1; j < 7; j++) {
            // Bỏ qua vị trí td 4 và 5
            if (j === 4 || j === 5) {
                continue;
            }

            var cellValue = "";

            var input = cells[j].querySelector("input[type='text']");
            if (input) {
                cellValue = input.value;
            } else {
                cellValue = cells[j].innerText;
            }

            var select = cells[j].getElementsByTagName("select")[0];
            if (select) {
                cellValue = select.value;
            }

            rowValues.push(cellValue);
        }

        var rowValue = rowValues.join("|");

        if (values.includes(rowValue)) {
            isDuplicate = true;
        }

        if (isDuplicate) {
            rows[i].classList.add("highlight");
        } else {
            rows[i].classList.remove("highlight");
        }

        values.push(rowValue);
    }

    return isDuplicate;
}

function updateProductSN() {
    $('.modal-body').each(function (index) {
        var productSN = $(this).find('input[name^="product_SN"]');
        var div_value2 = $(this).find('div[class^="div_value"]');
        productSN.attr('name', 'product_SN' + index + '[]');
        div_value2.attr('class', 'div_value' + index + '[]');
    });
}

// Xóa hàng SN
$(document).on('click', '.deleteRow1', function () {
    var div = $(this).parent('tr');
    var parentTable = div.closest('table');
    div.parent().parent().parent().parent().find('.SNCount').text(div.parent().find(
        'input[type="checkbox"]').length - 1);
    div.remove();
    var remainingRows = parentTable.find('tbody tr');
    remainingRows.each(function (index) {
        $(this).find('td').eq(1).text(index + 1);
    });
})

// Xóa hàng trong form
$('body').on('click', '.deleteRow', function () {
    var parentTr = $(this).closest('tr');
    var targetId = $(this).closest('tr').find('button[name="btn_add_SN[]"]').attr('data-target');
    $(targetId).remove();
    parentTr.remove();
    calculateTotals();
    updateRowNumbers();
    checkRow();
});

function checkRow() {
    var rowLength = $('#inputContainer tbody tr').length;
    if (rowLength < 1) {
        return false;
    } else {
        return true;
    }
}

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

// Định dạng lại giá trị thành tiền
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

    // Trả về kết quả đã định dạng
    return formattedValue;
}

function fillDataToModal() {
    var info = document.querySelectorAll('.exampleModal');
    for (let k = 0; k < info.length; k++) {
        info[k].addEventListener('click', function () {
            var productCode = $(this).closest('tr').find('.list_products option:selected').text();
            var productName = $(this).closest('tr').find('[name^="product_name"]').val();
            var productType = $(this).closest('tr').find('[name^="product_category"]').val();
            var productQty = $(this).closest('tr').find('[name^="product_qty"]').val();
            var provide_name = $('#provide_name').val();
            $('.code_product').text(productCode);
            $('.name_product').text(productName);
            $('.provide_name').text(provide_name);
            $('.type_product').text(productType);
            $('.qty_product').text(productQty);
        })
    }
}

function calculateTotals() {
    var totalAmount = 0;
    var totalTax = 0;

    // Lặp qua từng hàng
    $('tr').each(function () {
        var productQty = parseInt($(this).find('.quantity-input').val());
        var productPriceElement = $(this).find('[name^="product_price"]');
        var productPrice = 0;
        var taxValue = parseFloat($(this).find('.product_tax option:selected').val());
        if(taxValue == 99){
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
            // Hiển thị kết quả
            $(this).find('.total-amount').val(formatCurrency(rowTotal));
            $(this).find('.product_tax1').text(rowTax.toFixed(2));

            // Cộng dồn vào tổng totalAmount và totalTax
            totalAmount += rowTotal;
            totalTax += rowTax;
        }
    });

    // Hiển thị tổng totalAmount và totalTax
    $('#total-amount-sum').text(formatCurrency(totalAmount));
    $('#product-tax').text((formatCurrency(totalTax)));

    // Tính tổng thành tiền và thuế
    calculateGrandTotal(totalAmount, totalTax);
}

function deleteDuplicateTr() {
    var table = document.getElementById("inputContainer");
    var rows = table.getElementsByTagName("tr");
    var values = [];

    for (var i = 1; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var rowValues = [];
        var isDuplicate = false;

        for (var j = 1; j < 7; j++) {

            if (j === 1 || j === 3) {
                continue;
            }
            var cellValue = "";

            var input = cells[j].querySelector("input[type='text']");
            if (input) {
                cellValue = input.value;
            } else {
                cellValue = cells[j].innerText;
            }

            rowValues.push(cellValue);
        }

        var rowValue = rowValues.join("|");
        if (values.includes(rowValue)) {
            isDuplicate = true;
        }

        if (isDuplicate) {
            rows[i].remove();
        }

        values.push(rowValue);

    }
    return isDuplicate;
}


var fileImport = document.getElementById('import_file');
if (fileImport) {
    fileImport.addEventListener('change', function (event) {
        var reader = new FileReader();
        var fileInput = this;
        var file = fileInput.files[0];
        reader.onload = function (e) {
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
                    '<td><input required type="number" name="product_qty[]" class="quantity-input form-control text-center" value="' +
                    numberssValue + '"></td>' +
                    '<td><input required type="text" class="form-control product_price text-center" style="width:140px" name="product_price[]" value="' + price + '"></td>' +
                    // '<td><input required type="number" name="product_tax[]" class="product_tax form-control" style="width:80px" value=' + tax + '></td>' +
                    '<input type="hidden" class="product_tax1">' +
                    '<td>' +
                    '<select style="width:80px;" name="product_tax[]"class="product_tax form-control" >' +
                    '<option value="10"' + (tax == 10 ? "selected" : "") + '>10%</option>' +
                    '<option value="0" ' + (tax == 0 ? "selected" : "") + '>0%</option>' +
                    '<option value="8" ' + (tax == 8 ? "selected" : "") + '>8%</option>' +
                    '<option value="00" ' + (tax == 0 ? "selected" : "") + '>NOVAT</option>' +
                    '</select' +
                    '</td>' +
                    '<td><input readonly type="text" style="width:140px" class="form-control text-center total-amount" name="product_total[]" value=""></td>' +
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
                    '<div class="btn btn-danger ml-2" id="deleteSNS"> Xóa SN </div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Lưu</button>' +
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


$('body').on('input', '.product_price', function (event) {
    // Lấy giá trị đã nhập
    var value = event.target.value;

    // Xóa các ký tự không phải số và dấu phân thập phân từ giá trị
    var formattedValue = value.replace(/[^0-9.]/g, '');

    // Định dạng số với dấu phân cách hàng nghìn và giữ nguyên số thập phân
    var formattedNumber = numberWithCommas(formattedValue);

    event.target.value = formattedNumber;
});

function setValueOfInput(e) {
    var selectedProductName = $(e).text();
    var row = $(e).closest('tr');
    var productNameInput = row.find('input[name="product_name[]"]');
    productNameInput.val(selectedProductName);
    $(".dropdown-values").removeClass("show1");
}


// Ẩn danh sách sản phẩm con khi click ra ngoài
$(document).click(function (event) {
    if (!$(event.target).closest(".search_product").length) {
        $(".dropdown-values").removeClass("show1");
    }
});


//hiện danh sách khách hàng khi click trường tìm kiếm
$("#myUL").hide();
$("#myInput").on("click", function () {
    $("#myUL").show();
});

//ẩn danh sách khách hàng
$(document).click(function (event) {
    if (!$(event.target).closest("#myInput").length) {
        $("#myUL").hide();
    }
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



// Hàm chỉ cho phép nhập số
function validateNumberInput(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9-]/.test(ch))) {
        evt.preventDefault();
    }
}









