<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                            <form action="{{route('guests.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Đơn vị:</label>
                                    <input type="text" class="form-control" name="guest_name" placeholder="Enter guest name" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Đại diện:</label>
                                    <input type="text" class="form-control" name="guest_represent" placeholder="Enter guest represent" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Số điện thoại:</label>
                                    <input type="number" class="form-control" name="guest_phone" placeholder="Enter guest phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Email:</label>
                                    <input type="email" class="form-control" name="guest_email" placeholder="Enter guest email" required>
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
