<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('data.index') }}">Sản phẩm</a></span>
        <span class="px-1">/</span>
        <span><b>Thông tin sản phẩm con</b></span>
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
        <div class="container-fluided bg-white rounded">
            <div class="row">
                <div class="col-12">
                    <div class="card-header">
                        <h3 class="card-title">Sản phẩm / Sửa sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{ route('updateProduct', $pro->id) }}" method="post" id="form_submit">
                        @csrf
                        @method('PUT')
                        <div class="border-bottom p-3 d-flex justify-content-between">
                            <b>Thông tin sản phẩm</b>
                        </div>
                        <div class="row p-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="congty">Mã sản phẩm:</label>
                                    <input type="text" readonly class="form-control"
                                        value="{{ $pro->getNameProducts->products_code }}">
                                    <!-- <select class="form-control" name="product_code" id="product_code">
                      @foreach ($select as $va)
<option value="{{ $va->id }}" {{ $va->id == $pro->products_id ? 'selected' : '' }}>{{ $va->products_code }}</option>
@endforeach
                    </select> -->
                                </div>
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required type="text" class="form-control" id="product_name"
                            <?php if(!Auth::user()->can('view-provides')) echo 'readonly' ?>
                                        name="product_name" value="{{ $pro->product_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Loại hàng</label>
                                    <input required type="text" class="form-control" id="product_type"
                            <?php if(!Auth::user()->can('view-provides')) echo 'readonly' ?>
                                        name="product_type" value="{{ $pro->product_category }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Đơn vị tính</label>
                                    <input required type="text" class="form-control" id="product_unit"
                            <?php if(!Auth::user()->can('view-provides')) echo 'readonly' ?>
                                        name="product_unit" value="{{ $pro->product_unit }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Ghi chú</label>
                                    <input type="text" class="form-control" id="product_trademark"
                            <?php if(!Auth::user()->can('view-provides')) echo 'readonly' ?>
                                        name="product_trademark" value="{{ $pro->product_trademark }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Số lượng</label>
                                    <input readonly type="number" class="form-control" id="product_qty"
                                        name="product_qty" value="{{ $pro->product_qty }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Giá nhập</label>
                                    <input required type="number" class="form-control" id="product_price"
                            <?php if(!Auth::user()->can('view-provides')) echo 'readonly' ?>
                                        name="product_price" value="{{ $pro->product_price }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Thuế</label>
                                    <input type="number" class="form-control"  readonly
                                    id="product_tax" name="product_tax" value="{{ $pro->tax }}">
                                </div>
                                <div class="form-group">
                                </div>
                            </div>
                        </div>
                        <div class="btn-fixed">
                            @if (Auth::user()->can('view-provides'))
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            @endif
                            <a class="btn btn-default" href="{{ route('data.index') }}">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
</body>

</html>
