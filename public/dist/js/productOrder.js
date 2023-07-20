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

// $(document).click(function (e) {
//     if (!$(e.target).closest(".modal-content").length) {
//         var clickedDiv = $(e.target).closest('.modal-dialog');
//         var inputs = clickedDiv.find('.modal-body #table_SNS input[name^="product_SN"]');
//         var values = [];
//         inputs.each(function () {
//             var value = $(this).val().trim();
//             if (value == "") {
//                 e.stopPropagation();
//                 alert('Vui lòng nhập seri number');
//                 return false;
//             }
//             if (values.includes(value)) {
//                 e.stopPropagation();
//                 alert('Đã nhập trùng seri ' + value);
//                 return false;
//             }
//             values.push(value);
//         })
//     }
// });

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















