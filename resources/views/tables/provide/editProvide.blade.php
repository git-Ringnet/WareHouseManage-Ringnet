<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Provides</h1>
                </div>
            </div>
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
                            <form action="{{ route('provides.update', $provides->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="email">Provide name:</label>
                                    <input type="text" class="form-control" value="{{ $provides->provide_name }}"
                                        name="provide_name" placeholder="Enter provide name" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide represent:</label>
                                    <input type="text" class="form-control"
                                        value="{{ $provides->provide_represent }}" name="provide_represent"
                                        placeholder="Enter provide represent" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide phone:</label>
                                    <input type="number" class="form-control" value="{{ $provides->provide_phone }}"
                                        name="provide_phone" placeholder="Enter provide phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide email:</label>
                                    <input type="email" class="form-control" value="{{ $provides->provide_email }}"
                                        name="provide_email" placeholder="Enter provide email" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide status:</label>
                                    <select name="provide_status" class="form-control">
                                        <option value="1" <?php if ($provides->provide_status == 1) {
                                            echo 'selected';
                                        } ?>>Active</option>
                                        <option value="0" <?php if ($provides->provide_status == 0) {
                                            echo 'selected';
                                        } ?>>Disable</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update provide</button>
                            </form>
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
</body>

</html>
