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
                                    <input type="number" class="form-control" name="guest_phone"
                                        placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Email:</label>
                                    <input type="email" class="form-control" name="guest_email"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" placeholder="Nhập email" required>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ xuất hóa đơn:</label>
                                    <input type="text" class="form-control" id="guest_addressInvoice"
                                        placeholder="Nhập địa chỉ xuất hóa đơn" name="guest_addressInvoice" value=""
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label>Mã số thuế:</label>
                                    <input type="number" class="form-control" id="guest_code"
                                        placeholder="Nhập mã số thuế" name="guest_code" value="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Địa chỉ giao hàng:</label>
                                    <input type="text" class="form-control" id="guest_addressDeliver"
                                        placeholder="Nhập địa chỉ giao hàng" name="guest_addressDeliver" value=""
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Người nhận hàng:</label>
                                    <input type="text" class="form-control" id="guest_receiver"
                                        placeholder="Nhập người nhận hàng" name="guest_receiver" value=""
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">SĐT người nhận:</label>
                                    <input type="number" class="form-control" id="guest_phoneReceiver"
                                        placeholder="Nhập số điện thoại người nhận" name="guest_phoneReceiver" value=""
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Ghi chú:</label>
                                    <input type="text" class="form-control" id="guest_note"
                                        placeholder="Nhập ghi chú" name="guest_note" value="">
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
</body>

</html>
