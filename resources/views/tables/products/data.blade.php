<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="d-flex mb-1">
                @can('view-provides')
                    <a href="{{ route('insertProducts') }}">
                        <button type="button" class="custom-btn btn btn-primary d-flex align-items-center">
                            <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                    fill="#ffff" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                    fill="#ffff" />
                            </svg>
                            <span>Thêm sản phẩm</span>
                        </button>
                    </a>
                    <div class="class mx-4">
                        <button onclick="exportToExcel()" type="button"
                            class="custom-btn btn btn-outline-primary d-flex align-items-center">
                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M15.0003 7.80054H16.5001C16.8979 7.80054 17.2794 7.95857 17.5607 8.23984C17.842 8.52112 18 8.9026 18 9.30039V17.1006C18 17.4983 17.842 17.8798 17.5607 18.1611C17.2794 18.4424 16.8979 18.6004 16.5001 18.6004H7.49986C7.10207 18.6004 6.72058 18.4424 6.4393 18.1611C6.15802 17.8798 6 17.4983 6 17.1006V9.30039C6 8.9026 6.15802 8.52112 6.4393 8.23984C6.72058 7.95857 7.10207 7.80054 7.49986 7.80054H8.99972"
                                    stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.99976 11.3997L11.9995 14.3994L15.0003 11.3997" stroke="#0095F6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.0006 3V13.7999" stroke="#0095F6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span>Xuất Excel</span>
                            <!-- </button>
                           <a href="{{ route('export_products') }}" class="custom-btn btn btn-outline-primary btn-file d-flex align-items-center">
                                <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M15.0003 7.80054H16.5001C16.8979 7.80054 17.2794 7.95857 17.5607 8.23984C17.842 8.52112 18 8.9026 18 9.30039V17.1006C18 17.4983 17.842 17.8798 17.5607 18.1611C17.2794 18.4424 16.8979 18.6004 16.5001 18.6004H7.49986C7.10207 18.6004 6.72058 18.4424 6.4393 18.1611C6.15802 17.8798 6 17.4983 6 17.1006V9.30039C6 8.9026 6.15802 8.52112 6.4393 8.23984C6.72058 7.95857 7.10207 7.80054 7.49986 7.80054H8.99972"
                                        stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.99976 11.3997L11.9995 14.3994L15.0003 11.3997" stroke="#0095F6"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M12.0006 3V13.7999" stroke="#0095F6" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <span>Xuất Excel</span>
                                </a> -->
                    </div>
                    <div class="custom-btn btn btn-outline-primary btn-file d-flex align-items-center">
                        <div>
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M8.99972 15.7999H7.49986C7.10207 15.7999 6.72058 15.6419 6.4393 15.3606C6.15802 15.0793 6 14.6979 6 14.3001L6 6.49991C6 6.10212 6.15802 5.72062 6.4393 5.43934C6.72058 5.15806 7.10207 5.00003 7.49986 5.00003L16.5001 5.00003C16.8979 5.00003 17.2794 5.15806 17.5607 5.43934C17.842 5.72062 18 6.10212 18 6.49991V14.3001C18 14.6979 17.842 15.0793 17.5607 15.3606C17.2794 15.6419 16.8979 15.7999 16.5001 15.7999H15.0003"
                                    stroke="#0095F6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15.0005 12.2006L12.0008 9.20092L8.99994 12.2006" stroke="#0095F6"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.9995 20.6003L11.9995 9.80045" stroke="#0095F6" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Nhập Excel</span> <input type="file" id="import_file" onchange="importExcel()"
                            accept=".xlsx">
                    </div>
                @endcan
            </div>

    </section>
    <!-- Main content -->
    <div id="section_products">
        <section class="multiple_action">
            <div class="d-flex justify-content-between align-items-center">
                <span class="count_checkbox mr-5"></span>
                <div class="row action">
                    <!-- <div class="btn-taodon my-2 ml-3">
                        <button type="button" class="btn-group btn btn-light d-flex align-items-center">
                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                    fill="#555555" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                    fill="#555555" />
                            </svg>
                            <span>Tạo đơn bán</span>
                        </button>
                    </div> -->
                    <div class="btn-nhaphang my-2">
                        <!-- <button type="button" class="btn-group btn btn-light d-flex align-items-center ml-4">
                            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                    fill="#555555" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                    fill="#555555" />
                            </svg>
                            <span>Nhập hàng</span>
                        </button> -->
                    </div>
                    <div class="dropdown my-2 ml-4">
                        <button class="custom-btn btn btn-light dropdown-toggle align-items-center d-flex h-100"
                            type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span>Hành động khác</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="#" id="deleteProducts" class="dropdown-item">Xóa sản phẩm</a>
                        </div>
                    </div>
                </div>
                <div class="cancal_action btn ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M18 18L6 6" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M18 6L6 18" stroke="white" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
        </section>
    </div>
    <section class="content">
        <div class="">
            <div class="row">
                <div class="col col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-hover">
                                <thead>
                                    <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                    <input type="hidden" id="sortTypeInput" name="sort-type" value="">
                                    <tr>
                                        @can('view-provides')
                                            <th scope="col" style="width:2%">
                                                <span class="d-flex">
                                                    <input type="checkbox" id="checkall">
                                                </span>
                                            </th>
                                        @endcan
                                        <th>
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="id"
                                                    data-sort-type=""><button class="btn-sort"
                                                        type="submit">ID</button></a>
                                                <div class="icon" id="icon-id"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_code"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Số hóa
                                                        đơn</button></a>
                                                <div class="icon" id="icon-products_code"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_name"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Tên sản
                                                        phẩm</button></a>

                                                <div class="icon" id="icon-products_name"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="products_trademark"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Đang
                                                        giao dịch</button></a>
                                                <div class="icon" id="icon-products_trademark"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="inventory"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Tồn
                                                        kho</button></a>

                                                <div class="icon" id="icon-inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="price_avg"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Đơn giá
                                                        nhập</button></a>

                                                <div class="icon" id="icon-price_avg"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex justify-content-end">
                                                <a href="#" class="sort-link" data-sort-by="price_inventory"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Trị tồn
                                                        kho</button></a>
                                                <div class="icon" id="icon-price_inventory"></div>
                                            </span>
                                        </th>
                                        <th scope="col">
                                            <span class="d-flex">
                                                <a href="#" class="sort-link" data-sort-by="inventory"
                                                    data-sort-type=""><button class="btn-sort" type="submit">Trạng
                                                        thái</button></a>
                                                <div class="icon" id="icon-status"></div>
                                            </span>
                                        </th>
                                        <th scope="col"></th>
                                    </tr>
                                    </form>
                                </thead>
                                <tbody>
                                    @foreach ($products as $value)
                                        <tr>
                                            <td><input type="checkbox"></td>

                                            <td>{{ $value->id }}</td>

                                            <td>{{ $value->product_code }}</td>
                                            <td>{{ $value->product_name }}</td>

                                            <td>{{ $value->product_unit }}</td>

                                            <td>{{ $value->product_qty }}</td>

                                            <td>{{ $value->product_price }}</td>

                                            <td>{{ $value->total }}</td>
                                            <td>
                                                {{$value->status}}
                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="paginator mt-4 d-flex justify-content-end">
                    </div>
                </div>
            </div>

        </div>
    </section>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</div>
</div>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script>
    $('.ks-cboxtags-trademark li').on('click', function(event) {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-category li').on('click', function() {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });
    $('.ks-cboxtags-status li').on('click', function() {
        if (event.target.tagName !== 'INPUT') {
            var checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')); // Đảo ngược trạng thái checked
        }
    });

    // Xuất file excel
    function exportToExcel() {
        // Lấy dữ liệu từ bảng HTML
        var table = document.getElementById("example2");

        // Tạo một workbook mới
        var wb = XLSX.utils.table_to_book(table);

        // Chuyển đổi workbook thành dạng tệp Excel
        var wbout = XLSX.write(wb, {
            bookType: "xlsx",
            type: "array"
        });

        // Tạo một Blob từ dữ liệu Excel
        var blob = new Blob([wbout], {
            type: "application/octet-stream"
        });

        // Tạo URL tạm thời và tải xuống tệp Excel
        var url = URL.createObjectURL(blob);
        var a = document.createElement("a");
        a.href = url;
        a.download = "data.xlsx";
        a.click();

        // Giải phóng URL tạm thời
        setTimeout(function() {
            URL.revokeObjectURL(url);
        }, 1000);
    }


    // Import file excel
    function importExcel() {
        var input = document.getElementById("import_file");
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = XLSX.read(data, {
                type: "array"
            });
            var worksheet = workbook.Sheets[workbook.SheetNames[0]];
            var jsonData = XLSX.utils.sheet_to_json(worksheet, {
                header: 1
            });

            var formattedData = [];
            var headers = jsonData[0];

            for (var i = 1; i < jsonData.length; i++) {
                var row = jsonData[i];
                var formattedRow = {};

                for (var j = 0; j < headers.length; j++) {
                    var header = headers[j];
                    formattedRow[header] = row[j];
                }

                formattedData.push(formattedRow);
            }
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch("/import_products", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": csrfToken
                    },
                    body: JSON.stringify(formattedData),
                })
                .then(function(response) {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra trong quá trình import.');
                    }
                })
                .catch(function(error) {
                    console.log("Lỗi: " + error);
                });
        };
        reader.readAsArrayBuffer(file);
    }

    // Checkbox
    $('#checkall').change(function() {
        $('.cb-element').prop('checked', this.checked);
        updateMultipleActionVisibility()
    });
    $('.cb-element').change(function() {
        updateMultipleActionVisibility();
        if ($('.cb-element:checked').length == $('.cb-element').length) {
            $('#checkall').prop('checked', true);
        } else {
            $('#checkall').prop('checked', false);
        }
    });

    $(document).on('click', '.cancal_action', function(e) {
        e.preventDefault();
        $('.cb-element:checked').prop('checked', false);
        $('#checkall').prop('checked', false);
        updateMultipleActionVisibility()
    })

    // Hiển thị form multiple action
    function updateMultipleActionVisibility() {
        if ($('.cb-element:checked').length > 0) {
            $('.multiple_action').show();
            $('.count_checkbox').text('Đã chọn ' + $('.cb-element:checked').length);
        } else {
            $('.multiple_action').hide();
        }
    }

    $(document).on('click', '#deleteProducts', function(e) {
        e.preventDefault();
        const list_id = [];
        $('input[name="ids[]"]').each(function() {
            if ($(this).is(':checked')) {
                var value = $(this).val();
                list_id.push(value);

            }
        });
        $.ajax({
            url: "{{ route('deleteProducts') }}",
            type: "get",
            data: {
                list_id: list_id,
            },
            success: function(data) {
                if (data.success == true) {
                    var id = data.ids;
                    for (let i = 0; i < id.length; i++) {
                        $('.' + id[i]).remove();
                    }
                    updateMultipleActionVisibility();
                    location.reload();
                } else {
                    location.reload();
                }
            }
        })
    })


    $('.product_category').change(function() {
        var product_id = $(this).attr('id');
        var category_id = $(this).val();
        var newRow = $('<tr>');
        newRow.attr('id', 'newRow');
        $('#example2').append(newRow);
        $.ajax({
            url: "{{ route('ajax') }}",
            type: "get",
            data: {
                product_id: product_id,
                category_id: category_id
            },
            success: function(data) {
                alert('Thay đổi thành công');
            }
        });
    })

    $('#btn-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#status-options').toggle();
        $('#category-options').hide();
        $('#status-options input').addClass('status-checkbox');
    });
    //Trademarks
    $('#btn-trademark').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#trademark-options').toggle();
        $('#trademark-options input').addClass('trademark-checkbox');
    });
    $('#cancel-trademark').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#trademark-options input[type="checkbox"]').prop('checked', false);
        $('#trademark-options').hide();
    });

    $('#btn-id').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#id-options').toggle();
    });
    $('#cancel-id').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.products_name-input').val('');
        $('#id-options').hide();
    });
    //Code
    $('#btn-code').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#code-options').toggle();
    });
    $('#cancel-code').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.code-input').val('');
        $('#code-options').hide();
    });
    $('#btn-price_inven').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#price_inven-options').toggle();
    });
    $('#cancel-price_inven').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.price_inven-input').val('');
        $('#price_inven-options').hide();
    });
    $('#btn-avg').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#avg-options').toggle();
    });
    $('#cancel-avg').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.avg-input').val('');
        $('#avg-options').hide();
    });
    $('#btn-quantity').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#quantity-options').toggle();
    });
    $('#cancel-quantity').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('.quantity-input').val('');
        $('#quantity-options').hide();
    });
    $('#btn-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', true);
        $('#category-options').toggle();
        $('#category-options input').addClass('category-checkbox');
    });
    $('#cancel-status').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#status-options input[type="checkbox"]').prop('checked', false);
        $('#status-options').hide();
    });
    $('#cancel-category').click(function(event) {
        event.preventDefault();
        $('.btn-filter').prop('disabled', false);
        $('#category-options input[type="checkbox"]').prop('checked', false);
        $('#category-options').hide();
    });

    //Xử lí tìm kiếm bộ lọc tổng
    function filterFunction() {
        var input = $("#myInput");
        var filter = input.val().toUpperCase();
        var buttons = $("#dropdown-menu button");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterTrademark() {
        var input = $("#myInput-trademark");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-trademark li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterCategory() {
        var input = $("#myInput-category");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-category li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    function filterStatus() {
        var input = $("#myInput-status");
        var filter = input.val().toUpperCase();
        var buttons = $(".ks-cboxtags-status li");

        buttons.each(function() {
            var text = $(this).text();
            if (text.toUpperCase().indexOf(filter) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    //Sort
    $(document).ready(function() {
        // Khôi phục trạng thái icon khi tải lại trang
        restoreIconState();
        localStorage.clear();
        $('.sort-link').on('click', function() {
            var sortBy = $(this).data('sort-by');
            var sortType = $(this).data('sort-type');
            var iconId = 'icon-' + sortBy;
            var iconElement = $('#' + iconId);
            var svgHTML =
                "<svg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'>";
            if (sortType === 'desc') {
                svgHTML +=
                    "<path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 5C11.6332 5 11.7604 5.05268 11.8542 5.14645C11.948 5.24021 12.0006 5.36739 12.0006 5.5V17.293L15.1466 14.146C15.2405 14.0521 15.3679 13.9994 15.5006 13.9994C15.6334 13.9994 15.7607 14.0521 15.8546 14.146C15.9485 14.2399 16.0013 14.3672 16.0013 14.5C16.0013 14.6328 15.9485 14.7601 15.8546 14.854L11.8546 18.854C11.8082 18.9006 11.753 18.9375 11.6923 18.9627C11.6315 18.9879 11.5664 19.0009 11.5006 19.0009C11.4349 19.0009 11.3697 18.9879 11.309 18.9627C11.2483 18.9375 11.1931 18.9006 11.1466 18.854L7.14663 14.854C7.05274 14.7601 7 14.6328 7 14.5C7 14.3672 7.05274 14.2399 7.14663 14.146C7.24052 14.0521 7.36786 13.9994 7.50063 13.9994C7.63341 13.9994 7.76075 14.0521 7.85463 14.146L11.0006 17.293V5.5C11.0006 5.36739 11.0533 5.24021 11.1471 5.14645C11.2408 5.05268 11.368 5 11.5006 5Z' fill='#555555'/>";
            } else {
                svgHTML +=
                    "<path fill-rule='evenodd' clip-rule='evenodd' d='M11.5006 19.0009C11.6332 19.0009 11.7604 18.9482 11.8542 18.8544C11.948 18.7607 12.0006 18.6335 12.0006 18.5009V6.70789L15.1466 9.85489C15.2405 9.94878 15.3679 10.0015 15.5006 10.0015C15.6334 10.0015 15.7607 9.94878 15.8546 9.85489C15.9485 9.76101 16.0013 9.63367 16.0013 9.50089C16.0013 9.36812 15.9485 9.24078 15.8546 9.14689L11.8546 5.14689C11.8082 5.10033 11.753 5.06339 11.6923 5.03818C11.6315 5.01297 11.5664 5 11.5006 5C11.4349 5 11.3697 5.01297 11.309 5.03818C11.2483 5.06339 11.1931 5.10033 11.1466 5.14689L7.14663 9.14689C7.10014 9.19338 7.06327 9.24857 7.03811 9.30931C7.01295 9.37005 7 9.43515 7 9.50089C7 9.63367 7.05274 9.76101 7.14663 9.85489C7.24052 9.94878 7.36786 10.0015 7.50063 10.0015C7.63341 10.0015 7.76075 9.94878 7.85463 9.85489L11.0006 6.70789V18.5009C11.0006 18.6335 11.0533 18.7607 11.1471 18.8544C11.2408 18.9482 11.368 19.0009 11.5006 19.0009Z' fill='#555555'/>"
            }
            svgHTML += "</svg>";
            // Hiển thị icon tương ứng
            iconElement.html(svgHTML);
            // Hiển thị icon tương ứng
            iconElement.html(svgHTML);

            // Lưu trạng thái của mũi tên vào localStorage
            localStorage.setItem(iconId, svgHTML);

            // Cập nhật giá trị sort-by và sort-type
            $('#sortByInput').val(sortBy);
            $('#sortTypeInput').val(sortType);
        });

        function restoreIconState() {
            // Khôi phục trạng thái của mũi tên từ localStorage
            $('.icon').each(function() {
                var iconId = $(this).attr('id');
                var iconHTML = localStorage.getItem(iconId);
                if (iconHTML) {
                    $(this).html(iconHTML);
                }
            });
        }
    });

    // Xóa tất cả các dữ liệu trong Local Storage
    $('.delete-filter').on('click', function() {
        localStorage.clear();
    });

    function updateDeleteItemValue(label) {
        document.getElementById('delete-item-input').value = label;
    }

    var dropdownItems = $('[id^="dropdown_item"]');
    dropdownItems.each(function() {
        $(this).on('click', function() {
            var isActive = $(this).hasClass('dropdown-item-active');
            var svgElement = $(this).find('svg');
            var parentElement = $(this).parent().parent();
            console.log(parentElement);
            if (isActive) {
                $(this).removeClass('dropdown-item-active');
                parentElement.css('background', '#E9ECEF');
                svgElement.css({
                    transform: 'rotate(0deg)',
                    transition: 'transform 0.3s ease'
                });
            }
            if (!isActive) {
                $(this).addClass('dropdown-item-active');
                parentElement.css('background', '#ADB5BD');
                svgElement.css({
                    transform: 'rotate(180deg)',
                    transition: 'transform 0.3s ease'
                });
            }
        });
    });

    // Tắt bộ lọc commit by nqv
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-category').click(function() {
            $('#category-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-category').click(function() {
            $('#category-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all').click(function() {
            $('#status-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all').click(function() {
            $('#status-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        // Chọn tất cả các checkbox
        $('.select-all-trademark').click(function() {
            $('#trademark-options input[type="checkbox"]').prop('checked', true);
        });

        // Hủy tất cả các checkbox
        $('.deselect-all-trademark').click(function() {
            $('#trademark-options input[type="checkbox"]').prop('checked', false);
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status', function() {
            $('.deselect-all').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-category', function() {
            $('.deselect-all-category').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-trademark', function() {
            $('.deselect-all-trademark').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-quantity', function() {
            $('.quantity-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-avg', function() {
            $('.avg-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-price_inven', function() {
            $('.price_inven-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-id', function() {
            $('.deselect-all-id').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-code', function() {
            $('.code-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-products_name', function() {
            $('.products_name-input').val('');
            document.getElementById('search-filter').submit();
        });
    });
</script>
</body>

</html>
