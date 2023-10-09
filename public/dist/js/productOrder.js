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
        var idSN = $(this).find('input[name^="productSN"]');
        productSN.attr('name', 'product_SN' + index + '[]');
        idSN.attr('name', 'productSN' + index + '[]');
        // div_value2.attr('class', 'div_value' + index + '[]');
        div_value2.attr('class', 'div_value' + index);
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
    updateProductSN();
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
        var productQty = $(this).find('.quantity-input').val();
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
// function checkData(e) {
//     var clickedDiv = $(e.target).closest('.modal-dialog');
//     var inputs = clickedDiv.find('.modal-body #table_SNS input[name^="product_SN"]');
//     var values = [];
//     inputs.each(function () {
//         var value = $(this).val().trim();
//         if (value == "") {
//             alert('Vui lòng nhập seri number');
//             e.stopPropagation();
//             return false;
//         }
//         if (values.includes(value)) {
//             alert('Đã nhập trùng seri ' + value);
//             e.stopPropagation();
//             return false;
//         }
//         values.push(value);
//     })
// }

function checkdata(e) {
    var clickedDiv = $(e.target).closest('.modal-dialog');
    var inputs = clickedDiv.find('.modal-body #table_SNS input[name^="product_SN"]');
    var values = [];
    // var isDuplicate = false;
    inputs.each(function () {
        var value = $(this).val().trim();
        if (value != "") {
            if (values.includes(value)) {
                // isDuplicate = true;
                e.stopPropagation();
                alert('Đã nhập trùng seri ' + value);
                return false;
            }
            values.push(value);
        }
        // if (isDuplicate) {
        //     $(e.target).closest('tr').classList.add("highlight");
        // }
    })
}

function deletedata(e) {
    var clickedDiv = $(e.target).closest('.modal-dialog');
    var inputs = clickedDiv.find('.modal-body #table_SNS input[name^="product_SN"]');
    inputs.each(function () {
        $(this).val("");
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

function validateQtyInput1(input) {
    var regex = /^[0-9]*\.?[0-9]*$/;
    if (!regex.test(input.value)) {
        input.value = input.value.replace(/[^\d.]/g, '');

        var parts = input.value.split('.');
        if (parts.length > 2) {
            input.value = parts[0] + '.' + parts.slice(1).join('');
        }
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
var rowCount = $('#inputContainer tbody tr').length;


// Hàm tạo ra các input
function createInput() {
    var addSNBtns = $('.AddSN');
    for (let i = 0; i <= addSNBtns.length; i++) {
        $(addSNBtns[i]).off('click').on('click', function () {
            var SLProduct, SLTr;
            SLProduct = $(addSNBtns[i]).closest('.modal-dialog').find('.qty_product').text();
            SLTr = $(addSNBtns[i]).closest('.modal-dialog').find('#table_SNS tbody tr').length;
            if (SLTr < SLProduct) {
                var currentIndex = addSNBtns[i].closest('.modal-body').querySelector('#table_SNS').closest('div').className.match(/\d+/)[0];
                var modal_body = addSNBtns[i].closest('.modal-body');
                var newtr = document.createElement('tr');
                var newtd1 = document.createElement('td');
                var newtd2 = document.createElement('td');
                var newtd3 = document.createElement('td');
                var newtd4 = document.createElement('td');
                var newDiv = document.createElement("input");
                var checkbox = document.createElement("input");
                var stt = document.createElement("span");
                var checkboxes = modal_body.querySelectorAll('input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                checkbox.setAttribute("type", "checkbox");
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
            } else if (SLTr > SLProduct) {
                // Code để xóa hàng dư
                var $tableBody = $(addSNBtns[i]).closest('.modal-dialog').find('#table_SNS tbody');
                var rowsToRemove = SLTr - SLProduct;
                $tableBody.find('tr').slice(-rowsToRemove).remove();
                if (modal_body) {
                    modal_body.querySelector('.SNCount').textContent = SLProduct;
                }
            }
        });
    }
}

function createInput1() {
    var addSNBtns = $('.AddSN1');
    for (let i = 0; i <= addSNBtns.length; i++) {
        $(addSNBtns[i]).off('click').on('click', function () {
            var SLProduct, SLTr;
            SLProduct = $(addSNBtns[i]).closest('.modal-dialog').find('.qty_product').text();
            SLTr = $(addSNBtns[i]).closest('.modal-dialog').find('#table_SNS tbody tr').length;
            if (SLTr < SLProduct) {
                var currentIndex = addSNBtns[i].closest('.modal-body').querySelector('#table_SNS').closest('div').className.match(/\d+/)[0];
                var modal_body = addSNBtns[i].closest('.modal-body');
                var newtr = document.createElement('tr');
                var newtd1 = document.createElement('td');
                var newtd2 = document.createElement('td');
                var newtd3 = document.createElement('td');
                var newtd4 = document.createElement('td');
                var newDiv = document.createElement("input");
                var checkbox = document.createElement("input");
                var stt = document.createElement("span");
                var checkboxes = modal_body.querySelectorAll('input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                checkbox.setAttribute("type", "checkbox");
                newtd1.append(checkbox);
                newDiv.setAttribute("type", "text");
                newDiv.setAttribute("class", "form-control w-25");
                newDiv.setAttribute("name", "product_SN_new" + currentIndex + "[]");
                newDiv.setAttribute("onpaste", "handlePaste1(this)");
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
            } else if (SLTr > SLProduct) {
                // Code để xóa hàng dư
                var $tableBody = $(addSNBtns[i]).closest('.modal-dialog').find('#table_SNS tbody');
                var rowsToRemove = SLTr - SLProduct;
                $tableBody.find('tr').slice(-rowsToRemove).remove();
                if (modal_body) {
                    modal_body.querySelector('.SNCount').textContent = SLProduct;
                }
            }
        });
    }
}

// Xử lý tạo Tr, modal
$('.addRow').on('click', function () {
    var tr = '<tr>' +
        '<td class="STT"></td>' +
        '<td>' +
        '<input id="search" type="text" placeholder="Nhập tên sản phẩm" name="product_name[]" class="form-control name_product" onkeyup="filterFunction()"> ' +
        '</td>' +
        '<td><input required type="text" class="form-control text-center unit_product" name="product_unit[]"></td>' +
        '<td><input required type="text" oninput="validateQtyInput1(this)" name="product_qty[]" class="quantity-input form-control text-center"></td>' +
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
        '<td>' +
        '<button class="exampleModal" name="btn_add_SN[]" type="button" data-toggle="modal" data-target="#exampleModal' +
        rowCount + '" style="background:transparent; border:none;">' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="4" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z" fill="#0095F6"/></svg>' +
        '</button>' +
        '</td>' +
        '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
        '</tr>';
    $('#inputContainer tbody').append(tr);
    checkRow();
    setSTT();


    var modal = '<div class="modal fade" id="exampleModal' + rowCount +
        '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header align-items-center">' +
        '<div> ' +
        '<h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>' +
        '<p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>' +
        '</div>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true" onclick="checkdata(event)">&times;</span>' +
        '</button>' +
        '</div>' +
        '<div class="modal-body">' +
        ' <table class="table table-hover"> ' +
        '<thead> ' +
        '<tr>' +
        '<th>Tên sản phẩm</th>' +
        '<th style="text-align:right;">Số lượng</th>' +
        '<th></th>' +
        '<th style="width:10%;">Số lượng S/N</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>' +
        '<tr>' +
        '<td class="name_product"></td>' +
        '<td class="qty_product text-right"></td>' +
        '<td></td>' +
        '<td class="SNCount text-right">1</td>' +
        '</tr>' +
        '</tbody>' +
        '</table>' +
        '<h3>Thông tin Serial Number </h3>' +
        '<div class="div_value' + rowCount + '" style="padding:10px;">' +
        '<table class="table" id="table_SNS">' +
        '<thead class="thead-light"><tr> ' +
        '<th style="width:2%"><input type="checkbox"></th> ' +
        '<th style="width:5%;">STT</th>' +
        '<th> <span>Serial Number</span></th> <th style="width:3%;"></th>' +
        '</tr> </thead>' +
        '<tbody> ' +
        '<tr>' +
        '<td><input type="checkbox" id="checkbox_1"> </td>' +
        '<td><span >1</span></td>' +
        '<td><input class="form-control w-25" type="text" name="product_SN' + rowCount +
        '[]" onpaste="handlePaste(this)"></td>' +
        '<td class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></td>' +
        '</tr>' +
        '</tbody>' +
        '</table>' +
        '</div>' +
        '<div class="AddSN btn btn-secondary" style="border:1px solid gray;" >Thêm dòng</div>' +
        // '<div class="btn btn-danger ml-2" id="deleteSNS"> Xóa SN </div>' +
        '</div>' +
        '<div class="modal-footer">' +
        // '<button type="button" class="btn btn-secondary" onclick="checkData(event)" data-dismiss="modal">Lưu</button>' +
        '<div class="d-flex justify-content-center w-100"> <button type="button" class="btn btn-primary mr-2" data-dismiss="modal" onclick="checkdata(event)">Lưu</button>' +
        // '<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="deletedata(event)">Hủy</button> 
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#list_modal').append(modal);
    rowCount++;
    createInput();
    updateProductSN();
    fillDataToModal();
});


$('.addRow1').on('click', function () {
    var tr = '<tr>' +
        '<td class="STT"></td>' +
        '<td>' +
        '<input id="search" type="text" placeholder="Nhập tên sản phẩm" name="product_name[]" class="form-control name_product" onkeyup="filterFunction()"> ' +
        '</td>' +
        '<td><input required type="text" class="form-control text-center unit_product" name="product_unit[]"></td>' +
        '<td><input required type="text" oninput="validateQtyInput1(this)" name="product_qty[]" class="quantity-input form-control text-center"></td>' +
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
        '<td>' +
        '<button class="exampleModal" name="btn_add_SN[]" type="button" data-toggle="modal" data-target="#exampleModal' +
        rowCount + '" style="background:transparent; border:none;">' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><rect width="32" height="32" rx="4" fill="white"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z" fill="#0095F6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z" fill="#0095F6"/></svg>' +
        '</button>' +
        '</td>' +
        '<td><a href="javascript:;" class="deleteRow"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></a></td>' +
        '</tr>';
    $('#inputContainer tbody').append(tr);
    checkRow();
    setSTT();


    var modal = '<div class="modal fade" id="exampleModal' + rowCount +
        '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">' +
        '<div class="modal-dialog" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header align-items-center">' +
        '<div> ' +
        '<h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>' +
        '<p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>' +
        '</div>' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
        '<span aria-hidden="true" onclick="checkdata(event)">&times;</span>' +
        '</button>' +
        '</div>' +
        '<div class="modal-body">' +
        ' <table class="table table-hover"> ' +
        '<thead> ' +
        '<tr>' +
        '<th>Tên sản phẩm</th>' +
        '<th style="text-align:right;">Số lượng</th>' +
        '<th></th>' +
        '<th style="width:10%;">Số lượng S/N</th>' +
        '</tr>' +
        '</thead>' +
        '<tbody>' +
        '<tr>' +
        '<td class="name_product"></td>' +
        '<td class="qty_product text-right"></td>' +
        '<td></td>' +
        '<td class="SNCount text-right">1</td>' +
        '</tr>' +
        '</tbody>' +
        '</table>' +
        '<h3>Thông tin Serial Number </h3>' +
        '<div class="div_value' + rowCount + '" style="padding:10px;">' +
        '<table class="table" id="table_SNS">' +
        '<thead class="thead-light"><tr> ' +
        '<th style="width:2%"><input type="checkbox"></th> ' +
        '<th style="width:5%;">STT</th>' +
        '<th> <span>Serial Number</span></th> <th style="width:3%;"></th>' +
        '</tr> </thead>' +
        '<tbody> ' +
        '<tr>' +
        '<td><input type="checkbox" id="checkbox_1"> </td>' +
        '<td><span >1</span></td>' +
        '<td><input class="form-control w-25" type="text" name="product_SN_new' + rowCount +
        '[]" onpaste="handlePaste1(this)"></td>' +
        '<td class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></td>' +
        '</tr>' +
        '</tbody>' +
        '</table>' +
        '</div>' +
        '<div class="AddSN1 btn btn-secondary" style="border:1px solid gray;" >Thêm dòng</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<div class="d-flex justify-content-center w-100"> <button type="button" class="btn btn-primary mr-2" data-dismiss="modal" onclick="checkdata(event)">Lưu</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>'
    $('#list_modal').append(modal);
    rowCount++;
    createInput1();
    fillDataToModal();
});

function fillDataToModal() {
    var info = document.querySelectorAll('.exampleModal');
    for (let k = 0; k < info.length; k++) {
        info[k].addEventListener('click', function () {
            var productName = $(this).closest('tr').find('[name^="product_name"]').val();
            var productType = $(this).closest('tr').find('[name^="product_unit"]').val();
            var productQty = $(this).closest('tr').find('[name^="product_qty"]').val();
            var provide_name = $('#provide_id').val().trim() == "" ? $('#provide_name_new').val() : $('#provide_name').val();
            var countTR = $('.div_value' + k).find('tbody tr');
            for (let i = 0; i < countTR.length; i++) {
                countTR.closest('table').find('thead tr th').length == 4 ? $(countTR[i]).find('td:eq(1)').text(i + 1) : $(countTR[i]).find('td:eq(0)').text(i + 1);
            }
            $('.SNCount').text(countTR.length);
            $('.name_product').text(productName);
            $('.name_provide').text(provide_name);
            $('.type_product').text(productType);
            $('.qty_product').text(productQty);
        })
    }
}


// Hàm xử lý paste cột từ file excel
function handlePaste(input) {
    var SLProduct = parseInt($(input).closest('.modal-dialog').find('.qty_product').text());
    var rowCount = $(input).attr('name').match(/\d+/)[0];
    var clipboardData = event.clipboardData || window.clipboardData;
    var pastedData = clipboardData.getData('Text');
    var rows = pastedData.trim().split('\n');
    // var parent_div = $('.div_value' + rowCount + ' table tbody');

    var table = document.querySelector('.div_value' + rowCount).querySelector('table');
    var currentInput = 2;
    if (rows.length > 1) {
        for (var i = 0; i < rows.length; i++) {
            var rowData = rows[i].trim();
            var SLTR = $(input).closest('.modal-dialog').find('#table_SNS tbody tr').length;
            if (rowData === '') {
                continue;
            }
            if (SLTR <= SLProduct) {
                var newRow = table.insertRow($(input).closest('tr').index() + currentInput);
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);

                // Tạo checkbox
                var checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                var checkboxes = document.querySelectorAll('.div_value' + rowCount +
                    ' table tbody input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                checkbox.setAttribute("id", "checkbox_" + checkboxCount);

                // Tạo span stt
                var stt = document.createElement("span");
                stt.innerHTML = checkboxCount;

                // Tạo input
                var newDiv = document.createElement('input');
                newDiv.setAttribute("type", "text");
                newDiv.setAttribute("class", "form-control w-25");
                newDiv.setAttribute("name", "product_SN" + rowCount + "[]");
                newDiv.setAttribute("onpaste", "handlePaste(this)");
                newDiv.value = rows[i].trim();

                // Tạo svg delete
                cell4.setAttribute('class', 'deleteRow1');
                cell4.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';

                // Thêm các đối tượng vào table
                cell1.append(checkbox);
                cell2.appendChild(stt);
                cell3.append(newDiv);
                currentInput++;
            }
        }

        var parentTable = $(input).closest('table');
        $(input).closest('.modal-dialog').find('.SNCount').text(SLTR);
        $(input).parent().parent().remove();
        var remainingRows = parentTable.find('tbody tr');
        remainingRows.each(function (index) {
            $(this).find('td').eq(1).text(index + 1);
        });
    }
}


function handlePaste1(input) {
    var SLProduct = parseInt($(input).closest('.modal-dialog').find('.qty_product').text());
    var rowCount = $(input).attr('name').match(/\d+/)[0];
    var clipboardData = event.clipboardData || window.clipboardData;
    var pastedData = clipboardData.getData('Text');
    var rows = pastedData.trim().split('\n');
    var parent_div = $('.div_value' + rowCount + ' table tbody');

    var table = document.querySelector('.div_value' + rowCount).querySelector('table');
    var currentInput = 2;
    if (rows.length > 1) {
        for (var i = 0; i < rows.length; i++) {
            var rowData = rows[i].trim();
            if (rowData === '') {
                continue;
            }
            var SLTR = $(input).closest('.modal-dialog').find('#table_SNS tbody tr').length;
            if (SLTR <= SLProduct) {
                var newRow = table.insertRow($(input).closest('tr').index() + currentInput);
                var cell1 = newRow.insertCell(0);
                var cell2 = newRow.insertCell(1);
                var cell3 = newRow.insertCell(2);
                var cell4 = newRow.insertCell(3);

                // Tạo checkbox
                var checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                var checkboxes = document.querySelectorAll('.div_value' + rowCount +
                    ' table tbody input[type="checkbox"]');
                var checkboxCount = checkboxes.length;
                checkbox.setAttribute("id", "checkbox_" + checkboxCount);

                // Tạo span stt
                var stt = document.createElement("span");
                stt.innerHTML = checkboxCount;

                // Tạo input
                var newDiv = document.createElement('input');
                newDiv.setAttribute("type", "text");
                newDiv.setAttribute("class", "form-control w-25");
                newDiv.setAttribute("name", "product_SN_new" + rowCount + "[]");
                newDiv.setAttribute("onpaste", "handlePaste(this)");
                newDiv.value = rows[i].trim();

                // Tạo svg delete

                cell4.setAttribute('class', 'deleteRow1');
                cell4.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg>';

                // Thêm các đối tượng vào table
                cell1.append(checkbox);
                cell2.appendChild(stt);
                cell3.append(newDiv);
                currentInput++;
            }
        }
        var parentTable = $(input).closest('table');
        $(input).closest('.modal-dialog').find('.SNCount').text(SLTR);
        $(input).parent().parent().remove();
        var remainingRows = parentTable.find('tbody tr');
        remainingRows.each(function (index) {
            $(this).find('td').eq(1).text(index + 1);
        });
    }
}



function getInputName(input, olddata) {
    var currentName = $(input).val();
    var matches = $(input).attr('name').match(/\d/g);
    $(input).on('change', function () {
        if (currentName == olddata) {
            $(input).attr('name', 'product_SN' + matches + '[]');
        } else {
            $(input).attr('name', 'product_SN_new' + matches + '[]');
        }
    })
}



// Hàm kiểm tra nhập số lượng sản phẩm và số lượng SN
function checkInputSN(id, countProduct) {
    var result = {
        check: false,
        msg: ""
    }
    var isEmpty = false;
    var SN1 = $(id).find('.modal-body #table_SNS tbody tr td .form-control.w-25');
    var count = 0;
    var countSN = 0;
    SN1.each(function () {
        if ($(this).val().trim() !== "") {
            isEmpty = true;
            return false;
        }
    });
    if (countProduct == 0) {
        result.check = true;
        result.msg = "Vui lòng nhập số lượng sản phẩm";
    }
    if (isEmpty) {
        SN1.each(function () {
            if ($(this).val().trim() !== "") {
                countSN++;
            }
        });
        if (countSN < SN1.length) {
            result.check = true;
            result.msg = "Vui lòng nhập đủ số lượng SN";
        }
        if (SN1.length != countProduct) {
            // Kiểm tra số lượng sản phẩm và SN
            $('#inputContainer tbody tr td .quantity-input').each(function () {
                var inputValue = parseFloat($(this).val().trim()) || 0;
                if (inputValue % 1 !== 0) {
                    count += Math.ceil(inputValue);
                } else {
                    count += inputValue;
                }
            });
            if ($('.form-control.w-25').length > count) {
                result.check = true;
                result.msg = "Vui lòng kiểm tra lại số lượng sản phẩm và số lượng SN";
            } else {
                result.check = true;
                result.msg = "Vui lòng nhập đủ số lượng SN";
            }
        } else {
            isEmpty = false;
            check = false;
        }
    }
    return result;
}



function checkSNNull() {
    var check = false;
    $('.form-control.w-25').each(function () {
        if ($(this).val() == '') {
            check = true;
        }
    })
    return check;
}


























