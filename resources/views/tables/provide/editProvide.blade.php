<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('provides.index') }}">Nhà cung cấp</a></span>
        <span class="px-1">/</span>
        <span><b>Chỉnh sửa nhà cung cấp</b></span>
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluided -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluided">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-3">
                            <form action="{{ route('provides.update', $provides->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="required-label" for="email">Công ty</label>
                                    <input type="text" class="form-control" value="{{ $provides->provide_name }}"
                                        name="provide_name" placeholder="Nhập tên nhà cung cấp" required>
                                </div>
                                <div class="mb-3">
                                    <label class="required-label" for="pwd">Địa chỉ xuất hóa đơn</label>
                                    <input type="text" class="form-control" value="{{ $provides->provide_address }}"
                                        name="provide_address" placeholder="Nhập địa chỉ" required="">
                                </div>
                                <div class="mb-3">
                                    <label class="required-label" for="pwd">Mã số thuế</label>
                                    <input type="text" class="form-control" name="provide_code"
                                        oninput=validateNumberInput(this) value="{{ $provides->provide_code }}"
                                        placeholder="Nhập mã số thuế" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd">Người đại diện</label>
                                    <input type="text" class="form-control"
                                        value="{{ $provides->provide_represent }}" name="provide_represent"
                                        placeholder="Nhập tên người đại diện" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd">Email</label>
                                    <input type="email" class="form-control" value="{{ $provides->provide_email }}"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" name="provide_email"
                                        placeholder="Nhập email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd">Số điện thoại</label>
                                    <input type="text" class="form-control" oninput=validateNumberInput(this)
                                        pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$" value="{{ $provides->provide_phone }}"
                                        name="provide_phone" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="pwd">Trạng thái:</label>
                                    <select name="provide_status" class="form-control">
                                        <option value="1" <?php if ($provides->provide_status == 1) {
                                            echo 'selected';
                                        } ?>>Active</option>
                                        <option value="0" <?php if ($provides->provide_status == 0) {
                                            echo 'selected';
                                        } ?>>Disable</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd">Công nợ:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="text" oninput="validateNumberInput(this)" class="form-control"
                                            id="debtInput" value="{{ $provides->debt }}" name="debt"
                                            style="width:15%;" required="" disabled="">
                                        <span class="ml-2" id="data-debt">ngày</span>
                                        <input type="checkbox" id="debtCheckbox" value="0" name="debt"
                                            class="ml-3" <?php if ($provides->debt == 0) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="ml-2">Thanh toán tiền mặt</span>
                                    </div>
                                </div>
                                <div class="btn-fixed">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    <a href="{{ asset('./provides') }}" class="btn btn-default">Hủy</a>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluided -->
    </section>
    <!-- /.content -->
</div>
<script>
    //cho phép nhập số 
    function validateNumberInput(input) {
        const regex = /^[-+]?[0-9]{1,3}(?:,?[0-9]{3})*(?:\.[0-9]+)?$/;
        const value = input.value.replace(/,/g, '');
        if (!regex.test(value)) {
            input.value = '';
        }
    }
    var isChecked = $('#debtCheckbox').is(':checked');
    // Đặt trạng thái của input dựa trên checkbox
    $('#debtInput').prop('disabled', isChecked);
    $('#debtInput').val(0);
    // Xử lý sự kiện khi checkbox thay đổi
    $(document).on('change', '#debtCheckbox', function() {
        var isChecked = $(this).is(':checked');
        $('#debtInput').prop('disabled', isChecked);
        $('#debtInput').val(0);
    });
</script>
</body>

</html>
