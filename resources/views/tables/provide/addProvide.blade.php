<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('provides.index') }}">Nhà cung cấp</a></span>
        <span class="px-1">/</span>
        <span><b>Thêm nhà cung cấp</b></span>
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
                            <form action="{{ route('provides.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="required-label" for="email">Đơn vị cung cấp:</label>
                                    <input type="text" class="form-control" name="provide_name"
                                        placeholder="Nhập đơn vị cung cấp" required>
                                </div>
                                <div class="form-group">
                                    <label class="required-label" for="pwd">Đại diện:</label>
                                    <input type="text" class="form-control" name="provide_represent"
                                        placeholder="Nhập tên đại diện" required>
                                </div>
                                <div class="form-group">
                                    <label class="required-label" for="pwd">Số điện thoại:</label>
                                    <input type="text" class="form-control" name="provide_phone"
                                        oninput=validateNumberInput(this) pattern="^(?:\+?84|0)(?:\d{9}|\d{10})$"
                                        placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <label class="required-label" for="pwd">Email:</label>
                                    <input type="email" pattern="/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/"
                                        class="form-control" name="provide_email" placeholder="Nhập email" required>
                                </div>
                                <div class="form-group">
                                    <label class="required-label" for="pwd">Địa chỉ:</label>
                                    <input type="text" class="form-control" name="provide_address"
                                        placeholder="Nhập địa chỉ" required>
                                </div>
                                <div class="form-group">
                                    <label class="required-label" for="pwd">Mã số thuế:</label>
                                    <input type="text" class="form-control" name="provide_code"
                                        oninput=validateNumberInput(this) placeholder="Nhập mã số thuế" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Trạng thái:</label>
                                    <select name="provide_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                                <div class="btn-fixed">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
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
</script>
</body>

</html>
