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
                        <div class="card-body p-3 mb-5">
                            <form action="{{ route('guests.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="mb-3">
                                    <label class="required-label" for="email">Đơn vị</label>
                                    <input type="text" class="form-control" name="guest_name"
                                        placeholder="Nhập đơn vị" required>
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="pwd">Đại diện:</label>
                                    <input type="text" class="form-control" name="guest_represent"
                                        placeholder="Nhập đại diện" required>
                                </div> --}}
                                <div class="mb-3">
                                    <label class="" for="pwd">Số điện thoại</label>
                                    <input type="text" class="form-control" name="guest_phone"
                                        oninput=validateNumberInput(this) placeholder="Nhập số điện thoại"
                                        pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$" title="Số điện thoại không hợp lệ">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="pwd">Email</label>
                                    <input type="email" class="form-control" name="guest_email"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" placeholder="Nhập email">
                                </div>
                                <div class="mb-3">
                                    <label class="required-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="guest_address"
                                        placeholder="Nhập địa chỉ" name="guest_address" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label class="required-label">Mã số thuế</label>
                                    <input type="number" class="form-control" id="guest_code"
                                        oninput=validateNumberInput(this) placeholder="Nhập mã số thuế"
                                        name="guest_code" value="" required>
                                </div>
                                <div class="mb-3">
                                    <label class="" for="email">Người nhận hàng</label>
                                    <input type="text" class="form-control" id="guest_receiver"
                                        placeholder="Nhập người nhận hàng" name="guest_receiver" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="email">SĐT người nhận</label>
                                    <input type="text" class="form-control" id="guest_phoneReceiver" value=""
                                        oninput=validateNumberInput(this) placeholder="Nhập số điện thoại người nhận"
                                        name="guest_phoneReceiver" pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$"
                                        title="Số điện thoại không hợp lệ">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="pwd">Email cá nhân:</label>
                                    <input type="email" class="form-control" name="guest_email_personal"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" placeholder="Nhập email cá nhân">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Ghi chú</label>
                                    <input type="text" class="form-control" id="guest_note"
                                        placeholder="Nhập ghi chú" name="guest_note" value="">
                                </div>
                                <div class="mb-3">
                                    <label class="required-label">Công nợ</label>
                                    <div class="d-flex align-items-center">
                                        <input type="text" oninput="validateNumberInput(this)" class="form-control"
                                            id="debtInput" value="" name="debt" style="width:15%;" required>
                                        <span class="ml-2" id="data-debt">ngày</span>
                                        <input type="checkbox" id="debtCheckbox" value="0" name="debt"
                                            class="ml-3">
                                        <span class="ml-2">Thanh toán tiền mặt</span>
                                    </div>
                                </div>
                                <div class="mb-3 d-none">
                                    <label for="pwd">Trạng thái</label>
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
        var regex = /^[0-9]*$/;
        if (!regex.test(input.value)) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }
    }
    //Công nợ
    var isChecked = $('#debtCheckbox').is(':checked');
    // Đặt trạng thái của input dựa trên checkbox
    $('#debtInput').prop('disabled', isChecked);
    // Xử lý sự kiện khi checkbox thay đổi
    $(document).on('change', '#debtCheckbox', function() {
        var isChecked = $(this).is(':checked');
        $('#debtInput').prop('disabled', isChecked);
    });
</script>
</body>

</html>
