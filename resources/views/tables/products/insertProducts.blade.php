<x-navbar></x-navbar>
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
              <h3 class="card-title">Sản phẩm / Thêm sản phẩm</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{route('storeProducts')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <h2>Hình ảnh sản phẩm</h2>
                    <input type="file" value="" name="products_img">
                  </div>
                  <div class="col-md-9">
                    <h2>Thông tin sản phẩm</h2>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="product_name">
                          <h5>Tên sản phẩm</h5>
                          <input required type="text" name="products_name" class="w-100 p-1 form-control">
                        </div>
                        <div class="product_code">
                          <h5>Mã sản phẩm</h5>
                          <input required type="text" name="products_code" class="w-100 p-1 form-control">
                        </div>
                        <div class="product_id">
                          <h5>ID</h5>
                          <input type="text" name="products_id" readonly class="w-100 p-1 form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="product_category">
                          <h5>Danh mục</h5>
                          <select name="product_category" id="" class="w-100 form-control" style="height: 35.56px;">
                            @foreach($cate as $va)
                            <option value="{{$va->id}}">{{$va->category_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="product_trademark">
                          <h5>Thương hiệu</h5>
                          <input required type="text" name="products_trademark" class="w-100 p-1 form-control">
                        </div>
                        <div class="product_unit">
                          <h5>Đơn vị</h5>
                          <input required type="text" name="products_unit" class="w-100 p-1 form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <h5>Mô tả</h5>
                        <textarea name="products_description" id="" cols="30" rows="7" class="w-100 form-control"></textarea>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                </div>
                </table>
              </div>
              <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</body>

</html>