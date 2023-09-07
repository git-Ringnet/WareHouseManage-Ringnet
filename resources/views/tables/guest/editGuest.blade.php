<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper padding-112">
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
                            <form action="{{ route('guests.update', $guests->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="required-label" for="email">Công ty</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_name }}"
                                        name="guest_name" placeholder="Nhập tên công ty" required>
                                </div>
                                <div class="mb-3">
                                    <label class="required-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="guest_address"
                                        placeholder="Nhập địa chỉ" name="guest_address"
                                        value="{{ $guests->guest_address }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="required-label">Mã số thuế</label>
                                    <input type="number" class="form-control" id="guest_code"
                                        placeholder="Nhập mã số thuế" name="guest_code"
                                        value="{{ $guests->guest_code }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="" for="pwd">Email</label>
                                    <input type="email" class="form-control" value="{{ $guests->guest_email }}"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/" name="guest_email"
                                        placeholder="Nhập email">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="pwd">Số điện thoại</label>
                                    <input type="text" class="form-control" oninput=validateNumberInput(this)
                                        value="{{ $guests->guest_phone }}" name="guest_phone"
                                        pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$" title="Số điện thoại không hợp lệ"
                                        placeholder="Nhập số điện thoại">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="email">Người nhận hàng</label>
                                    <input type="text" class="form-control" id="guest_receiver"
                                        placeholder="Nhập người nhận hàng" name="guest_receiver"
                                        value="{{ $guests->guest_receiver }}">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="pwd">Email cá nhân:</label>
                                    <input type="email" class="form-control" name="guest_email_personal"
                                        pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/"
                                        value="{{ $guests->guest_email_personal }}" placeholder="Nhập email cá nhân">
                                </div>
                                <div class="mb-3">
                                    <label class="" for="email">SĐT người nhận</label>
                                    <input type="text" class="form-control" id="guest_phoneReceiver"
                                        oninput=validateNumberInput(this) placeholder="Nhập số điện thoại người nhận"
                                        name="guest_phoneReceiver" pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$"
                                        title="Số điện thoại không hợp lệ" value="{{ $guests->guest_phoneReceiver }}">
                                </div>
                                <div class="mb-3">
                                    <label>Công nợ</label>
                                    <div class="d-flex align-items-center">
                                        <input type="text" oninput="validateNumberInput(this)" class="form-control"
                                            id="debtInput" value="{{ $guests->debt }}" name="debt"
                                            style="width:15%;">
                                        <span class="ml-2" id="data-debt">ngày</span>
                                        <input type="checkbox" id="debtCheckbox" value="0" name="debt"
                                            class="ml-3" <?php if ($guests->debt == 0) {
                                                echo 'checked';
                                            } ?>>
                                        <span class="ml-2">Thanh toán tiền mặt</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Ghi chú:</label>
                                    <input type="text" class="form-control" id="guest_note"
                                        placeholder="Nhập ghi chú" name="guest_note"
                                        value="{{ $guests->guest_note }}">
                                </div>
                                @if (Auth::user()->can('isAdmin'))
                                    <div class="mb-3">
                                        <label class="required-label" for="email">Người phụ trách</label>
                                        <select class="form-control" name="user_id" id="user_id" required>
                                            <option value="{{ $user->id ?? Auth::user()->id }}">
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
                                <div class="mb-3 d-none">
                                    <label for="pwd">Trạng thái</label>
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
