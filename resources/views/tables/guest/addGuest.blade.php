<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Guests</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ asset('index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Guests</li>
                    </ol>
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
                            <form action="{{route('guests.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Guest name:</label>
                                    <input type="text" class="form-control" name="guest_name" placeholder="Enter guest name" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide represent:</label>
                                    <input type="text" class="form-control" name="guest_represent" placeholder="Enter guest represent" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide phone:</label>
                                    <input type="number" class="form-control" name="guest_phone" placeholder="Enter guest phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide email:</label>
                                    <input type="email" class="form-control" name="guest_email" placeholder="Enter guest email" required>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Provide status:</label>
                                    <select name="guest_status" class="form-control">
                                        <option value="0">Active</option>
                                        <option value="1">Disable</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add guest</button>
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
