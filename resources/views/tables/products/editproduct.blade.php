<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
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
            <div class="card-header">
              <h3 class="card-title">Sản phẩm / Sửa sản phẩm</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{route('updateProduct',$pro->id)}}" method="post">
              @csrf
              @method('PUT')
              <div class="border-bottom p-3 d-flex justify-content-between">
                <b>Thông tin sản phẩm</b>
              </div>
              <div class="row p-3">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="congty">Mã sản phẩm:</label>
                    <input type="text" readonly class="form-control" value="{{$pro->getNameProducts->products_code}}">
                    <!-- <select class="form-control" name="product_code" id="product_code">
                      @foreach($select as $va)
                      <option value="{{$va->id}}" {{ ( $va->id == $pro->products_id) ? 'selected' : '' }}>{{$va->products_code}}</option>
                      @endforeach
                    </select> -->
                  </div>
                  <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input required type="text" class="form-control" id="product_name" name="product_name" value="{{$pro->product_name}}">
                  </div>
                  <div class="form-group">
                    <label for="email">Loại hàng</label>
                    <input required type="text" class="form-control" id="product_type" name="product_type" value="{{$pro->product_category}}">
                  </div>
                  <div class="form-group">
                    <label for="">Đơn vị tính</label>
                    <input required type="text" class="form-control" id="product_unit" name="product_unit" value="{{$pro->product_unit}}">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="email">Thương hiệu</label>
                    <input required type="text" class="form-control" id="product_trademark" name="product_trademark" value="{{$pro->product_trademark}}">
                  </div>
                  <div class="form-group">
                    <label for="email">Số lượng</label>
                    <input readonly type="number" class="form-control" id="product_qty" name="product_qty" value="{{$pro->product_qty}}">
                  </div>
                  <div class="form-group">
                    <label for="email">Giá nhập</label>
                    <input required type="number" class="form-control" id="product_price" name="product_price" value="{{$pro->product_price}}">
                  </div>
                  <div class="form-group">
                    <label for="">Thuế</label>
                    <input type="number" class="form-control" id="product_tax" name="product_tax" value="{{$pro->tax}}">
                  </div>
                  <div class="form-group">
                  </div>
                </div>
              </div>'
              <button type="submit" class="btn btn-primary">Edit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</body>

</html>