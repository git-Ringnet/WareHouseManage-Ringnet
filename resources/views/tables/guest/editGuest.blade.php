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
                        <div class="card-body p-3 mb-5">
                            <form action="{{ route('guests.update', $guests->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="email">Đơn vị:</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_name }}"
                                        name="guest_name" placeholder="Nhập tên đơn vị" required>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="pwd">Đại diện:</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_represent }}"
                                        name="guest_represent" placeholder="Nhập tên người đại diện" required>
                                </div> --}}
                                <div class="form-group">
                                    <label for="pwd">Số điện thoại:</label>
                                    <input type="text" class="form-control" oninput=validateNumberInput(this)
                                        value="{{ $guests->guest_phone }}" name="guest_phone"
                                        pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$" title="Số điện thoại không hợp lệ"
                                        placeholder="Nhập số điện thoại" required>
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
                                    <input type="text" class="form-control" id="guest_phoneReceiver"
                                        oninput=validateNumberInput(this) placeholder="Nhập Số điện thoại người nhận"
                                        name="guest_phoneReceiver" pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$"
                                        title="Số điện thoại không hợp lệ" value="{{ $guests->guest_phoneReceiver }}"
                                        required="">
                                </div>
                                <div class="form-group">
                                    <label for="email">Ghi chú:</label>
                                    <input type="text" class="form-control" id="guest_note"
                                        placeholder="Nhập ghi chú" name="guest_note" value="{{ $guests->guest_note }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Hình thức thanh toán:</label>
                                    <select class="form-control" name="guest_pay" id="guest_pay" required>
                                        <option value="0" <?php if ($guests->guest_pay == 0) {
                                            echo 'selected';
                                        } ?>>Chuyển khoản</option>
                                        <option value="1" <?php if ($guests->guest_pay == 1) {
                                            echo 'selected';
                                        } ?>>Thanh toán bằng tiền mặt</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Công nợ:</label>
                                    <div class="d-flex align-items-center">
                                        <input type="text" oninput="validateNumberInput(this)"
                                            class="form-control" id="debtInput" value="{{ $guests->debt }}"
                                            name="debt" style="width:15%;">
                                        <span class="ml-2" id="data-debt">ngày</span>
                                        <input type="checkbox" id="debtCheckbox" value="0" name="debt"
                                            class="ml-3" <?php if ($guests->debt == 0) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="ml-2">Thanh toán tiền mặt</span>
                                    </div>
                                </div>
                                @if (Auth::user()->can('isAdmin'))
                                    <div class="form-group">
                                        <label for="email">Người phụ trách:</label>
                                        <select class="form-control" name="user_id" id="user_id" required>
                                            <option value="{{ $guests->user_id ?? Auth::user()->id }}">
                                                {{ Auth::user()->name }}</option>
                                            @foreach ($usersSale as $user)
                                                <option value="{{ $user->id ?? old('user_id') }}"
                                                    {{ $user->id == $guests->user_id ?? old('user_id') ? 'selected' : false }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <input type="hidden" name="user_id" id="user_id"
                                        value="{{ Auth::user()->id }}">
                                @endif
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
