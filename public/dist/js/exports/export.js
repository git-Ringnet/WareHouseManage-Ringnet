//form thong tin khach hang xuất hàng
var radio1 = document.getElementById("radio1");
var radio2 = document.getElementById("radio2");
$("#radio1").on("click", function() {
    $('#data-container').empty();
});
$("#radio2").on("click", function() {
    $('#data-container').html(
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
        '<input type="text" class="form-control" id="guest_name" placeholder="Nhập thông tin" name="guest_name" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label>Địa chỉ xuất hóa đơn:</label>' +
        '<input type="text" class="form-control" id="guest_address" placeholder="Nhập thông tin" name="guest_address" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Mã số thuế:</label>' +
        '<input type="text" class="form-control" id="guest_code" placeholder="Nhập thông tin" name="guest_code" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Địa chỉ giao hàng:</label>' +
        '<input type="text" class="form-control" id="guest_addressDeliver" placeholder="Nhập thông tin" name="guest_addressDeliver" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Người nhận hàng:</label>' +
        '<input type="text" class="form-control" id="guest_receiver" placeholder="Nhập thông tin" name="guest_receiver" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">SĐT người nhận:</label>' +
        '<input type="text" class="form-control" id="guest_phoneReceiver" placeholder="Nhập thông tin" name="guest_phoneReceiver" value="">' +
        '</div>' + '</div>' + '<div class="col-sm-6">' +
        '<div class="form-group">' +
        '<label for="email">Người đại diện:</label>' +
        '<input type="text" class="form-control" id="guest_represent" placeholder="Nhập thông tin" name="guest_represent" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Email:</label>' +
        '<input type="email" class="form-control" id="guest_email" placeholder="Nhập thông tin" name="guest_email" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Số điện thoại:</label>' +
        '<input type="text" class="form-control" id="guest_phone" placeholder="Nhập thông tin" name="guest_phone" value="">' +
        '</div>' + '<div class="form-group">' +
        ' <label for="email">Hình thức thanh toán:</label>' +
        '<input type="text" class="form-control" id="guest_pay" placeholder="Nhập thông tin" name="guest_pay" value="">' +
        '</div>' + '<div class="form-group">' +
        '<label for="email">Ghi chú:</label>' +
        '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="">' +
        '</div></div></div>'
    );
});
//add sản phẩm
$(document).ready(function() {
    let fieldCounter = 1;

    $("#add-field-btn").click(function() {
        const newRow = $("<tr>", {
            "id": `dynamic-row-${fieldCounter}`
        });
        const checkbox = $("<td><input type='checkbox'></td>");
        const MaInput = $("<td>", {
            "text": `${fieldCounter}`
        });
        const TenInput = $("<td>" +
            "<select id='maProduct' class='p-1 pr-5' name='products_id'>" +
            '@foreach ($products as $value)' +
            "<option value='{{ $value->id }}'>{{ $value->products_code }}</option>" +
            '@endforeach' +
            "</select>"
        );
        const ProInput = $("<td>" +
            "<select class='child-select p-1 pr-5' name='product_id'>" +
            "<option value=''>Lựa chọn sản phẩm</option>" +
            "</select>" +
            "</td>");
        const dvtInput = $(
            "<td><input type='text' id='product_unit' class='product_unit' name='product_unit'></td>"
        );
        const slInput = $(
            "<td><input type='number' id='product_qty' class='quantity-input' name='product_qty'></td>"
        );
        const giaInput = $(
            "<td><input type='number' id='product_price' name='product_price'></td>");
        const ghichuInput = $("<td><input type='text' id='' name='product_note'></td>");
        const thueInput = $("<td>" +
            "<input type='number' id='product_tax' class='product_tax' name='product_tax'>" +
            "</td>");
        const thanhTienInput = $("<td><span class='px-5 total-amount'>0</span></td>");
        const sn = $("<td><img src='../dist/img/icon/list.png'></td>");
        const info = $("<td><img src='../dist/img/icon/Group.png'></td>");
        const deleteBtn = $("<td><img src='../dist/img/icon/vector.png'></td>", {
            "class": "delete-row-btn"
        });
        deleteBtn.click(function() {
            $(this).closest("tr").remove();
        });
        newRow.append(checkbox, MaInput, TenInput, ProInput, dvtInput, slInput,
            giaInput, ghichuInput, thueInput, thanhTienInput, sn, info, deleteBtn);
        $("#dynamic-fields").after(newRow);
        fieldCounter++;
    });
    //xóa sản phẩm
    $(document).on("click", ".delete-row-btn", function() {
        $(this).closest("tr").remove();
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
            url: '{{ route("searchExport") }}',
            type: 'GET',
            data: {
                idCustomer: idCustomer
            },
            success: function(data) {
                $('#data-container').html(
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
                    '<input type="text" class="form-control" placeholder="Nhập thông tin" id="guest_address" name="guest_address" value="' +
                    data.guest_address + '">' +
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
                    '<label for="email">Ghi chú:</label>' +
                    '<input type="text" class="form-control" id="guest_note" placeholder="Nhập thông tin" name="guest_note" value="' +
                    data.guest_note + '">' +
                    '</div></div></div>'
                );
            }
        });
    });
});
//lấy tên sản phẩm từ mã sản phẩm
//cập nhật thông tin khách hàng
$(document).on('click', '#btn-customer', function(e) {
    e.preventDefault();
    var id = $('#id').val();
    var guest_name = $('#guest_name').val();
    var guest_address = $('#guest_address').val();
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
            guest_address,
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
    var guest_address = $('#guest_address').val();
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
            guest_address,
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
//lấy thông tin sản phẩm từ mã sản phẩm
$(document).ready(function() {
    $(document).on('change', '#maProduct', function() {
        var idProducts = $(this).val();
        var childSelect = $(this).closest('tr').find('.child-select');
        if (idProducts) {
            $.ajax({
                url: "{{ route('nameProduct') }}",
                type: "get",
                data: {
                    idProducts: idProducts,
                },
                success: function(response) {
                    // Update the child select with the new options
                    childSelect.empty();
                    childSelect.append('<option value="">Lựa chọn sản phẩm</option>');
                    $.each(response, function(index, product) {
                        childSelect.append(
                            `<option value="${product.id}">${product.product_name}</option>`
                        );
                    });
                }
            });
        } else {
            // Clear the child select if no parent is selected
            childSelect.empty();
            childSelect.append('<option value="">Lựa chọn sản phẩm</option>');
        }
    });
});
//lấy thông tin sản phẩm con từ tên sản phẩm con
$(document).on('change', '.child-select', function() {
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
});
//Kiểm tra số lượng rỗng hoặc nhỏ hơn hoặc bằng 0
$(document).on('blur', '.quantity-input', function() {
    var input = $(this);
    var quantity = input.val();
    if (isNaN(quantity) || quantity <= 0) {
        alert('Số lượng không hợp lệ');
    }
});
//gán tổng số tiền vào input
document.addEventListener('DOMContentLoaded', function() {
    var spanElement = document.getElementById('spanValue');
    var inputElement = document.getElementById('inputValue');
    var value = spanElement.getAttribute('data-value');
    inputElement.value = value;
});
//tính thành tiền của sản phẩm
$(document).on('input', '.quantity-input, [name="product_price"]', function() {
    // Lấy giá trị từ trường số lượng (product_qty)
    var productQty = parseInt($(this).closest('tr').find('.quantity-input').val());
    // Lấy giá trị từ trường giá sản phẩm (product_price)
    var productPrice = parseFloat($(this).closest('tr').find('[name="product_price"]').val());
    // Kiểm tra xem productQty và productPrice có phải là số hợp lệ không
    if (!isNaN(productQty) && !isNaN(productPrice)) {
        // Thực hiện phép tính
        var totalAmount = productQty * productPrice;
        // Hiển thị kết quả
        $(this).closest('tr').find('.total-amount').text(totalAmount);
        // Tính toán lại tổng thành tiền
        calculateTotalAmount();
    }
});

function calculateTotalAmount() {
    var totalAmount = 0;
    // Lặp qua từng hàng
    $('tr').each(function() {
        var rowTotal = parseFloat($(this).find('.total-amount').text());
        // Kiểm tra xem rowTotal có phải là một số hợp lệ không
        if (!isNaN(rowTotal)) {
            // Cộng dồn vào tổng totalAmount
            totalAmount += rowTotal;
        }
    });
    // Hiển thị tổng total-amount-sum
    $('#total-amount-sum').text(totalAmount);
}
$(document).on('input', '.product_tax', function() {
    // Lấy giá trị từ trường thuế
    var taxValue = parseFloat($(this).val());
    // Lấy giá trị từ trường số lượng (product_qty)
    var productQty = parseInt($(this).closest('tr').find('.quantity-input').val());
    // Lấy giá trị từ trường giá sản phẩm (product_price)
    var productPrice = parseFloat($(this).closest('tr').find('[name="product_price"]').val());
    // Kiểm tra xem taxValue, productQty và productPrice có phải là số hợp lệ không
    if (!isNaN(taxValue) && !isNaN(productQty) && !isNaN(productPrice)) {
        // Tính toán tổng thuế cho hàng hiện tại
        var taxAmount = (productQty * productPrice * taxValue) / 100;
        // Hiển thị kết quả thuế cho hàng hiện tại
        $(this).closest('tr').find('.product_tax').text(taxAmount);
        // Tính toán lại tổng thuế
        calculateTotalTax();
    }
});

function calculateTotalTax() {
    var totalTax = 0;
    // Lặp qua từng hàng
    $('tr').each(function() {
        var rowTax = parseFloat($(this).find('.product_tax').text());
        // Kiểm tra xem rowTax có phải là một số hợp lệ không
        if (!isNaN(rowTax)) {
            // Cộng dồn vào tổng totalTax
            totalTax += rowTax;
        }
    });
    // Hiển thị tổng totalTax
    $('#product-tax').text(totalTax);
}
//tính tổng cộng 
function calculateSum() {
    // Lấy giá trị từ các thẻ span
    var value1 = parseFloat($('#total-amount-sum').text());
    var value2 = parseFloat($('#product-tax').text());

    // Kiểm tra xem value1 và value2 có phải là số hợp lệ không
    if (!isNaN(value1) && !isNaN(value2)) {
        // Thực hiện phép cộng
        var sum = value1 + value2;

        // Hiển thị kết quả
        $('#spanValue').text(sum);
    }
}
$('#total-amount-sum, #product-tax').on('input', calculateSum);