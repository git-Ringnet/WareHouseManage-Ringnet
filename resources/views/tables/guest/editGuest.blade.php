<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('guests.index') }}">Khách hàng</a></span>
        <span class="px-1">/</span>
        <span><b>Thêm khách hàng</b></span>
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
                            <form action="{{ route('guests.update', $guests->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="email">Đơn vị:</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_name }}"
                                        name="guest_name" placeholder="Nhập tên đơn vị" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Đại diện:</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_represent }}"
                                        name="guest_represent" placeholder="Nhập tên người đại diện" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Số điện thoại:</label>
                                    <input type="number" class="form-control" value="{{ $guests->guest_phone }}"
                                        name="guest_phone" placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Email:</label>
                                    <input type="email" class="form-control" value="{{ $guests->guest_email }}"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" name="guest_email"
                                        placeholder="Nhập email" required>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ xuất hóa đơn:</label>
                                    <input type="text" class="form-control" id="guest_addressInvoice"
                                        placeholder="Nhập địa chỉ xuất hóa đơn" name="guest_addressInvoice"
                                        value="{{ $guests->guest_addressInvoice }}" required="">
                                </div>
                                <div class="form-group">
                                    <label>Mã số thuế:</label>
                                    <input type="number" class="form-control" id="guest_code"
                                        placeholder="Nhập mã số thuế" name="guest_code"
                                        value="{{ $guests->guest_code }}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Địa chỉ giao hàng:</label>
                                    <input type="text" class="form-control" id="guest_addressDeliver"
                                        placeholder="Nhập địa chỉ giao hàng" name="guest_addressDeliver"
                                        value="{{ $guests->guest_addressDeliver }}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Người nhận hàng:</label>
                                    <input type="text" class="form-control" id="guest_receiver"
                                        placeholder="Nhập người nhận hàng" name="guest_receiver"
                                        value="{{ $guests->guest_receiver }}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">SĐT người nhận:</label>
                                    <input type="number" class="form-control" id="guest_phoneReceiver"
                                        placeholder="Nhập Số điện thoại người nhận" name="guest_phoneReceiver"
                                        value="{{ $guests->guest_phoneReceiver }}" required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Ghi chú:</label>
                                    <input type="text" class="form-control" id="guest_note"
                                        placeholder="Nhập ghi chú" name="guest_note" value="{{ $guests->guest_note }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Hình thức thanh toán:</label>
                                    <select name="guest_pay" class="form-control" name="guest_pay" id="guest_pay"
                                        equired>
                                        <option value="0" <?php if ($guests->guest_pay == 0) {
                                            echo 'selected';
                                        } ?>>Chuyển khoản</option>
                                        <option value="1" <?php if ($guests->guest_pay == 1) {
                                            echo 'selected';
                                        } ?>>Thanh toán bằng tiền mặt</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Điều kiện thanh toán:</label>
                                    <textarea class="form-control" name="guest_payTerm" id="guest_payTerm">{{ $guests->guest_payTerm }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Trạng thái:</label>
                                    <select name="guest_status" class="form-control">
                                        <option value="1" <?php if ($guests->guest_status == 1) {
                                            echo 'selected';
                                        } ?>>Active</option>
                                        <option value="0" <?php if ($guests->guest_status == 0) {
                                            echo 'selected';
                                        } ?>>Disable</option>
                                    </select>
                                </div>
                                <div class="btn-fixed">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
</body>

</html>
