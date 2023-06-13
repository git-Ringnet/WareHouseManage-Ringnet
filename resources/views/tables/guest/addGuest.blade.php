<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('guests.index') }}">Khách hàng</a></span>
        <span class="px-1">/</span>
        <span><b>Chỉnh sửa khách hàng</b></span>
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
                            <form action="{{ route('guests.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Đơn vị:</label>
                                    <input type="text" class="form-control" name="guest_name"
                                        placeholder="Nhập đơn vị" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Đại diện:</label>
                                    <input type="text" class="form-control" name="guest_represent"
                                        placeholder="Nhập đại diện" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="guest_phone" oninput=validateNumberInput(this)
                                        placeholder="Nhập số điện thoại" pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$" title="Số điện thoại không hợp lệ" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Email:</label>
                                    <input type="email" class="form-control" name="guest_email"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" placeholder="Nhập email" required>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ xuất hóa đơn:</label>
                                    <input type="text" class="form-control" id="guest_addressInvoice"
                                        placeholder="Nhập địa chỉ xuất hóa đơn" name="guest_addressInvoice"
                                        value="" required>
                                </div>
                                <div class="form-group">
                                    <label>Mã số thuế:</label>
                                    <input type="number" class="form-control" id="guest_code" oninput=validateNumberInput(this)
                                        placeholder="Nhập mã số thuế" name="guest_code" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Địa chỉ giao hàng:</label>
                                    <input type="text" class="form-control" id="guest_addressDeliver"
                                        placeholder="Nhập địa chỉ giao hàng" name="guest_addressDeliver" value=""
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Người nhận hàng:</label>
                                    <input type="text" class="form-control" id="guest_receiver"
                                        placeholder="Nhập người nhận hàng" name="guest_receiver" value=""
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="email">SĐT người nhận:</label>
                                    <input type="text" class="form-control" id="guest_phoneReceiver" value="" oninput=validateNumberInput(this)
                                        placeholder="Nhập Số điện thoại người nhận" name="guest_phoneReceiver" pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$" title="Số điện thoại không hợp lệ" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Ghi chú:</label>
                                    <input type="text" class="form-control" id="guest_note"
                                        placeholder="Nhập ghi chú" name="guest_note" value="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Hình thức thanh toán:</label>
                                    <select name="guest_pay" class="form-control" name="guest_pay" id="guest_pay" required>
                                        <option value="0">Chuyển khoản</option>
                                        <option value="1">Thanh toán bằng tiền mặt</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Trạng thái:</label>
                                    <select name="guest_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                                <div class="btn-fixed">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                    <a href="{{ asset('./guests') }}" class="btn btn-default">Hủy</a>
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
</script>
</body>

</html>
