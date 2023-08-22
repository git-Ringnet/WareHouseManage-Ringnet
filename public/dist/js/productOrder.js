function updateRowNumbers() {
    $('tbody tr').each(function (index) {
        $(this).find('th:first').text(index + 1);
    });
}

$(document).on('input', '.name_product, .unit_product, .product_price', function () {
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

// Hàm kiểm tra tr có trùng nhau
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
        for (var j = 1; j < 5; j++) {
            // Bỏ qua vị trí td 0 và 3
            if (j === 0 || j === 3) {
                continue;
            }

            var cellValue = "";

            var input = cells[j].querySelector("input[type='text']");
            if (input) {
                cellValue = input.value.trim();
            } else {
                cellValue = cells[j].innerText.trim();
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

// Hàm cập nhật lại thứ tự SN trước khi submit
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
    checkRow();
    setSTT();
});

// Hàm kiểm tra số lượng tr trong table
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


function setSTT() {
    var rows = $('#inputContainer').find('tbody tr');
    for (let i = 0; i < rows.length; i++) {
        $(rows[i]).find('td:eq(0)').text(i + 1);
    }
}


// Hàm tính tổng tiền
function calculateTotals() {
    var totalAmount = 0;
    var totalTax = 0;

    // Lặp qua từng hàng
    $('tr').each(function () {
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
            var rowTotal = Math.round(productQty * productPrice);
            var rowTax = Math.round((rowTotal * taxValue) / 100);
            // Hiển thị kết quả
            $(this).find('.total-amount').val(formatCurrency(rowTotal));
            $(this).find('.product_tax1').text(rowTax);

            // Cộng dồn vào tổng totalAmount và totalTax
            totalAmount += rowTotal;
            totalTax += rowTax;
        }
    });

    // Hiển thị tổng totalAmount và totalTax
    $('#total-amount-sum').text(formatCurrency(totalAmount));
    $('.total_price').val(formatCurrency(totalAmount));
    $('#product-tax').text((formatCurrency(Math.round(totalTax))));

    // Tính tổng thành tiền và thuế
    calculateGrandTotal(totalAmount, totalTax);
}

// Hàm kiểm tra duplicate tr trong table sản phẩm
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

// Format giá tiền
$('body').on('input', '.product_price', function (event) {
    // Lấy giá trị đã nhập
    var value = event.target.value;

    // Xóa các ký tự không phải số và dấu phân thập phân từ giá trị
    var formattedValue = value.replace(/[^0-9.]/g, '');

    // Định dạng số với dấu phân cách hàng nghìn và giữ nguyên số thập phân
    var formattedNumber = numberWithCommas(formattedValue);

    event.target.value = formattedNumber;
});

// Hàm lấy dữ liệu khi người dùng chọn sản phẩm con
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

// Hàm search thông tin sản phẩm con
$(document).ready(function () {
    $("#myInput").on("keyup", function () {
        var value = $(this).val().toUpperCase();
        $("#myUL li").each(function () {
            var text = $(this).find("a").text().toUpperCase();
            $(this).toggle(text.indexOf(value) > -1);
        });
    });
});

// Hàm search thông tin nhà cung cấp
function filterFunction() {
    var filter = $(".search_product").val().toUpperCase();
    var a = $("#dropdown-values ul li");
    a.each(function () {
        var txtValue = $(this).text();
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Hàm kiểm tra Seri trùng trong modal
function checkData(e) {
    var clickedDiv = $(e.target).closest('.modal-dialog');
    var inputs = clickedDiv.find('.modal-body #table_SNS input[name^="product_SN"]');
    var values = [];
    inputs.each(function () {
        var value = $(this).val().trim();
        if (value == "") {
            alert('Vui lòng nhập seri number');
            e.stopPropagation();
            return false;
        }
        if (values.includes(value)) {
            alert('Đã nhập trùng seri ' + value);
            e.stopPropagation();
            return false;
        }
        values.push(value);
    })
}

// Hàm chỉ cho phép nhập số và ký tự - 
function validateNumberInput(input) {
    var regex = /^[0-9][0-9-]*$/;
    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
}

function validateBillInput(input) {
    var regex = /^[0-9]*$/;
    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^0-9]/g, '');
    }
}

// Chặn sự kiên paste
function handlePaste(e) {
    e.preventDefault(); // Chặn sự kiện paste mặc định
}
// Hàm nhập số lượng
function validatQtyInput(input) {
    var regex = /^[1-9][0-9]*$/;
    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^1-9]/g, '');
    }
}


$("#radio1").on("click", function () {
    $('#infor_provide').empty();
});

$("#radio2").on("click", function () {
    $('#provide_id').val("");
    $('#infor_provide').html(
        '<div class="border-bottom p-3 d-flex justify-content-between">' +
        '<b>Thông tin nhà cung cấp</b>' +
        '<button id="btn-addCustomer" class="btn btn-primary d-flex align-items-center">' +
        '<img src="../../dist/img/icon/Union.png">' +
        '<span class="ml-1">Lưu thông tin</span></button></div>' +
        '<div class="row p-3">' +
        '<div class="col-sm-6">' +
        '<div class="form-group">' +
        '<label for="congty" class="required-label">Công ty:</label>' +
        '<input required type="text" class="form-control" id="provide_name_new" placeholder="Nhập thông tin" name="provide_name_new" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label class="required-label">Địa chỉ xuất hóa đơn:</label>' +
        '<input required type="text" class="form-control" id="provide_address_new" placeholder="Nhập thông tin" name="provide_address_new" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email" class="required-label">Mã số thuế:</label>' +
        '<input required type="text" class="form-control" oninput="validateNumberInput(this)" id="provide_code_new" placeholder="Nhập thông tin" name="provide_code_new" value="">' +
        '</div>' + '</div>' + '<div class="col-sm-6">' +
        '<div class="form-group">' +
        '<label for="email">Người đại diện:</label>' +
        '<input type="text" class="form-control" id="provide_represent_new" placeholder="Nhập thông tin" name="provide_represent_new" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Email:</label>' +
        '<input type="email" class="form-control" id="provide_email_new" placeholder="Nhập thông tin" name="provide_email_new" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Số điện thoại:</label>' +
        '<input type="number" class="form-control" id="provide_phone_new" placeholder="Nhập thông tin" name="provide_phone_new" value="">' +
        '</div>' +
        '<div class="form-group">' +
        '<label for="email">Công nợ:</label>' +
        '<div class="d-flex align-items-center" style="width:101%;"> <input id="debtInput" class="form-control" type="text" name="provide_debt" style="width:15%;">' +
        '<span class="ml-2" id="data-debt" style="color: rgb(29, 28, 32);">ngày</span>' +
        '<input type="checkbox" id="debtCheckbox" value="0" style="margin-left:10%;" checked>' +
        '<span class="ml-2">Thanh toán tiền mặt</span> </div>' +
        '</div>' +
        '</div></div>'
    );
    var isChecked = $('#debtCheckbox').is(':checked');
    // Đặt trạng thái của input dựa trên checkbox
    $('#debtInput').val(0);
    $('#debtInput').prop('disabled', isChecked);
    // Xử lý sự kiện khi checkbox thay đổi
    $(document).on('change', '#debtCheckbox', function () {
        var isChecked = $(this).is(':checked');
        $('#debtInput').prop('disabled', isChecked);
        $('#debtInput').val(0);
    });
})

// Xử lý tạo Tr, modal
$('.addRow').on('click', function () {
    var tr = '<tr>' +
        '<td class="STT"></td>' +
        '<td>' +
        '<input id="search" type="text" placeholder="Nhập tên sản phẩm" name="product_name[]" class="form-control name_product" onkeyup="filterFunction()"> ' +
        '</td>' +
        '<td><input required type="text" class="form-control text-center unit_product" name="product_unit[]"></td>' +
        '<td><input required type="text" oninput="validatQtyInput(this)" name="product_qty[]" class="quantity-input form-control text-center"></td>' +
        '<td><input required type="text" class="form-control text-center product_price" name="product_price[]" ></td>' +
        '<td>' +
        '<input type="hidden" class="product_tax1">' +
        '<select name="product_tax[]" style="width:100px" class="product_tax form-control">' +
        '<option value="10">10%</option>' +
        '<option value="0">0%</option>' +
        '<option value="8">8%</option>' +
        '<option value="99">NOVAT</option> ' +
        '</select>' +
        '</td>' +
        '<td><input readonly type="text" class="form-control total-amount text-center" name="product_total[]"></td>' +
        '<td><input type="text" class="form-control product_trademark" name="product_trademark[]"></td>' +
        '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
        '</tr>';
    $('#inputContainer tbody').append(tr);
    checkRow();
    setSTT();
});













