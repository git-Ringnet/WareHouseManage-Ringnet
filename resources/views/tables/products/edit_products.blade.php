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
            <form action="{{route('data.update',$products->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <h2>Hình ảnh sản phẩm</h2>
                    <img src="{{url('dist/img')}}/{{$products->products_image}}.png" alt="">
                    <input type="file" value="" name="products_img">
                  </div>
                  <div class="col-md-9">
                    <h2>Thông tin sản phẩm</h2>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="product_name">
                          <h4>Tên sản phẩm</h4>
                          <input type="text" name="products_name" value="{{$products->products_name}}" class="form-control">
                        </div>
                        <div class="product_code">
                          <h4>Mã sản phẩm</h4>
                          <input type="text" name="products_code" value="{{$products->products_code}}" class="form-control">
                        </div>
                        <div class="product_id">
                          <h4>ID</h4>
                          <input type="text" name="products_id" value="{{$products->id}}" readonly style="background: #D6D6D6;" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="product_category">
                          <h4>Danh mục</h4>
                          <select name="product_category" id="" class="form-control">
                            @foreach($cate as $va)
                            <option value="{{$va->id}}" {{ ( $va->id == $products->getCategory->id) ? 'selected' : '' }}>{{$va->category_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="product_trademark">
                          <h4>Thương hiệu</h4>
                          <input type="text" name="products_trademark" value="{{$products->products_trademark}}" class="form-control">
                        </div>
                        <div class="product_unit">
                          <h4>Đơn vị</h4>
                          <input type="text" name="products_unit" value="{{$products->products_unit}}" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <h4>Mô tả</h4>
                        <textarea name="products_description" id="" cols="30" rows="8" class="form-control">{{$products->products_description}}</textarea>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                </div>
                </table>
              </div>
              <button type="submit" class="btn btn-primary">Edit</button>
            </form>
          </div>
          <h3>Thông tin sản phẩm</h3>
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại hàng</th>
                <th>Đơn vị tính</th>
                <th>Ghi chú</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
                <th>Thuế</th>
                <th>Tổng tiền</th>
              </tr>
            </thead>
            <tbody>
              @foreach($listProduct as $va)
              <tr>
                <th>{{$va->id}}</th>
                <th>{{$va->getNameProducts->products_code}}</th>
                <th>{{$va->product_name}}</th>
                <th>{{$va->product_category}}</th>
                <th>{{$va->product_unit}}</th>
                <th>{{$va->product_trademark}}</th>
                <th>{{$va->product_qty}}</th>
                <th>{{$va->product_price}}</th>
                <th>{{$va->tax}}</th>
                <th>{{$va->total}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
</body>

</html>