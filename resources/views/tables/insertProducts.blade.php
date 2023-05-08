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
            <form action="{{route('storeProducts')}}" method="POST">
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
                          <h4>Tên sản phẩm</h4>
                          <input type="text" name="products_name" >
                        </div>
                        <div class="product_code">
                          <h4>Mã sản phẩm</h4>
                          <input type="text" name="products_code">
                        </div>
                        <div class="product_id">
                          <h4>ID</h4>
                          <input type="text" name="products_id" readonly>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="product_category">
                          <h4>Danh mục</h4>
                          <select name="product_category" id="">
                            @foreach($cate as $va)
                            <option value="{{$va->id}}">{{$va->category_name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="product_trademark">
                          <h4>Thương hiệu</h4>
                          <input type="text" name="products_trademark" >
                        </div>
                        <div class="product_unit">
                          <h4>Đơn vị</h4>
                          <input type="text" name="products_unit">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <h4>Mô tả</h4>
                        <textarea name="products_description" id="" cols="30" rows="8"></textarea>
                      </div>
                      <div class="col-md-2"></div>
                    </div>
                  </div>
                </div>
                </table>
              </div>
              <button type="submit">Thêm</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</body>

</html>