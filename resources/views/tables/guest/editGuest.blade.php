<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit guests</h1>
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
                            <form action="{{ route('guests.update', $guests->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="email">Guest name:</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_name }}"
                                        name="guest_name" placeholder="Enter guest name" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Guest represent:</label>
                                    <input type="text" class="form-control" value="{{ $guests->guest_represent }}"
                                        name="guest_represent" placeholder="Enter guest represent" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Guest phone:</label>
                                    <input type="number" class="form-control" value="{{ $guests->guest_phone }}"
                                        name="guest_phone" placeholder="Enter guest phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Guest email:</label>
                                    <input type="email" class="form-control" value="{{ $guests->guest_email }}"
                                        name="guest_email" placeholder="Enter guest email" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Guest status:</label>
                                    <select name="guest_status" class="form-control">
                                        <option value="1" <?php if ($guests->guest_status == 1) {
                                            echo 'selected';
                                        } ?>>Active</option>
                                        <option value="0" <?php if ($guests->guest_status == 0) {
                                            echo 'selected';
                                        } ?>>Disable</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update guest</button>
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
