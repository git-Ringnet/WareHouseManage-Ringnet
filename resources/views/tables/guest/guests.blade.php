<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Guests</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ asset('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Guests</li>
                    </ol>
                </div>
            </div>
            <a href="{{ route('guests.create') }}">
                <button type="button" class="btn btn-primary d-flex align-items-center">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6 0C6.38791 -1.97352e-08 6.70237 0.314463 6.70237 0.702373L6.70237 11.2976C6.70237 11.6855 6.38791 12 6 12C5.61209 12 5.29763 11.6855 5.29763 11.2976V0.702373C5.29763 0.314463 5.61209 -1.97352e-08 6 0Z"
                            fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 6C12 6.38791 11.6855 6.70237 11.2976 6.70237H0.702373C0.314463 6.70237 -1.38146e-07 6.38791 0 6C-5.13115e-07 5.61209 0.314463 5.29763 0.702373 5.29763H11.2976C11.6855 5.29763 12 5.61209 12 6Z"
                            fill="white" />
                    </svg>
                    <span class="ml-2">Thêm khách hàng</span>
                </button>
            </a>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã khách hàng</th>
                                        <th>Đơn vị</th>
                                        <th>Đại diện</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($guests as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->guest_name }}</td>
                                            <td>{{ $item->guest_represent }}</td>
                                            <td>{{ $item->guest_phone }}</td>
                                            <td>{{ $item->guest_email }}</td>
                                            <td>
                                                <select class="p-1 px-2 status-select"
                                                    style="border: 1px solid #D6D6D6; <?php if ($item->guest_status == 1) {
                                                        echo 'color:#09BD3C;';
                                                    } else {
                                                        echo 'color:#D6D6D6';
                                                    }
                                                    ?>"
                                                    id="{{ $item->id }}" name="status-select">
                                                    <option value="1" <?php if ($item->guest_status == 1) {
                                                        echo 'selected';
                                                    } ?>>Active</option>
                                                    <option value="0" <?php if ($item->guest_status == 0) {
                                                        echo 'selected';
                                                    } ?>>Disable</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('guests.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                <form onclick="return confirm('Are you sure?')"
                                                    action="{{ route('guests.destroy', $item->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa-solid fa-trash"></i>Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginator mt-4 d-flex justify-content-end">
                                {{ $guests->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    $(document).ready(function() {
        $('.status-select').change(function() {
            var newStatus = $(this).val();
            var idGuest = $(this).attr('id');
            $.ajax({
                url: '{{ route('updateKH') }}',
                type: 'GET',
                data: {
                    newStatus: newStatus,
                    idGuest: idGuest
                },
                success: function() {
                    alert('Cập nhật tình trạng thành công!');
                }
            });
            location.reload();
        });
    });
</script>

</body>

</html>
