<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('admin.userslist') }}">Nhân viên</a></span>
        <span class="px-1">/</span>
        <span><b>Chỉnh sửa nhân viên</b></span>
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
                        @if ($errors->any())
                            <div class="alert alert-danger">Dữ liệu nhập vào không đúng</div>
                        @endif
                        <div class="card-body p-3">
                            <form action="{{ route('admin.edituser') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                                        value="{{ old('name') ?? $userDetail->name }}">
                                    @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Nhập email"
                                        value="{{ old('email') ?? $userDetail->email }}">
                                    @error('email')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu"
                                        value="{{ old('password') ?? $userDetail->password }}">
                                    @error('password')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Vai trò</label>
                                    <select class="form-control" name="role" id="">
                                        {{-- <option value="{{ old('role')?? $userDetail->roleid }}">Chức vụ</option> --}}
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ old('role') ?? $userDetail->roleid == $role->id ? 'selected' : false }}>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="form-control" name="phonenumber"
                                        placeholder="Số điện thoại"
                                        value="{{ old('phonenumber') ?? $userDetail->phonenumber }}">
                                    @error('phonenumber')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Trạng thái:</label>
                                    <select name="status" class="form-control">
                                        <option value="1" <?php if ($userDetail->status == 1) {
                                            echo 'selected';
                                        } ?>>Active</option>
                                        <option value="0" <?php if ($userDetail->status == 0) {
                                            echo 'selected';
                                        } ?>>Disable</option>
                                    </select>
                                </div>
                                <div class="btn-fixed">
                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                <a href="{{ route('admin.userslist') }}" class="btn btn-default">Hủy</a>
                              </div>
                            </form>
                        </div>
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
