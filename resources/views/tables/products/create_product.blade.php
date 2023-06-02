<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
            <div class="card-header">
              <h3 class="card-title">Sản phẩm / Tạo sản phẩm</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <h2>Hình ảnh sản phẩm</h2>
                  <input type="file" value="">
                </div>
                <div class="col-md-9">
                  <h2>Thông tin sản phẩm</h2>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="product_name">
                        <h4>Tên sản phẩm</h4>
                        <input type="text" value="{{$products->products_name}}" class="form-control">
                      </div>
                      <div class="product_code">
                        <h4>Mã sản phẩm</h4>
                        <input type="text" value="{{$products->products_code}}">
                      </div>
                      <div class="product_id">
                        <h4>ID</h4>
                        <input type="text" value="{{$products->id}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="product_category">
                        <h4>Danh mục</h4>
                        <input type="text" value="{{$products->getCategory->category_name}}">
                      </div>
                      <div class="product_trademark">
                        <h4>Thương hiệu</h4>
                        <input type="text" value="{{$products->products_trademark}}">
                      </div>
                      <div class="product_unit">
                        <h4>Đơn vị</h4>
                        <input type="text" value="{{$products->products_unit}}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <h4>Mô tả</h4>
                      <textarea name="" id="" cols="30" rows="8">{{$products->products_description}}</textarea>
                    </div>
                    <div class="col-md-2"></div>
                  </div>
                </div>
              </div>
              </table>
            </div>
          </div>
          <h3>Chủng loại sản phẩm</h3>
          <form action="{{route('data.store')}}" method="post">
            @csrf
            <table class="table" id="myTable">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Mã sản phẩm</th>
                  <th scope="col">SN</th>
                  <th scope="col">Tên sản phẩm</th>
                  <th scope="col">Nhà cung cấp</th>
                  <th scope="col">Loại hàng</th>
                  <th scope="col">Danh mục</th>
                  <th scope="col">Số lượng</th>
                  <th scope="col">Giá gốc</th>
                  <th scope="col">Tổng tiền</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <input hidden type="text" value="{{$products->id}}" name="product_id">
                  <th scope="row">1</th>
                  <td><input type="text" value="{{$products->products_code}}" readonly></td>
                  <td>
                    <button name="btn_add_SN[]" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      SN
                    </button>
                  </td>
                  <td><input type="text" name="product_name[]"></td>
                  <td>
                    <select name="product_provide[]" id="">
                      @foreach($provide as $va)
                      <option value="{{$va->id}}">{{$va->provide_name}}</option>
                      @endforeach
                    </select>
                  </td>
                  <td><input type="text" name="product_category[]"></td>
                  <td><input type="text" name="product_trademark[]"></td>
                  <td><input type="text" name="product_qty[]"></td>
                  <td><input type="text" name="product_price[]"></td>
                  <td><input type="text" name="product_total[]"></td>
                </tr>
              </tbody>

            </table>

            <button id="add_products">Thêm sản phẩm</button>
            <button type="submit">Thêm</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="div_value">
                      <input type="text" name="product_SN[]">
                    </div>
                    <button data-target="div_value" class="addNew_SN">Thêm SN</button>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
                  </div>
                </div>
              </div>
            </div>
            <div id="list_modal">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

</div>
<script>
  var add_products = document.getElementById('add_products');
  if (add_products) {
    add_products.addEventListener('click', function(e) {
      e.preventDefault();
      var table = document.getElementById("myTable");
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      var sttCell = row.insertCell(0);
      var codeCell = row.insertCell(1);
      var snCell = row.insertCell(2);
      var nameCell = row.insertCell(3);
      var provideCell = row.insertCell(4);
      var typeCell = row.insertCell(5);
      var categoryCell = row.insertCell(6);
      var qtyCell = row.insertCell(7);
      var priceCell = row.insertCell(8);
      var totalCell = row.insertCell(9);
      var deleteCell = row.insertCell(10);
      var divCell = document.getElementById('list_modal');

      sttCell.innerHTML = rowCount;
      codeCell.innerHTML = '<input value="{{$products->products_code}}" readonly type="text" name="product_code' + rowCount + '">';
      snCell.innerHTML = ' <button name="btn_add_SN[]" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal'+rowCount+'"> SN </button>';
      nameCell.innerHTML = '<input type="text" name="product_name[]">';
      provideCell.innerHTML = '  <td><select name="product_provide[]" id=""> @foreach($provide as $va)<option value="{{$va->id}}">{{$va->provide_name}}</option> @endforeach </select>';
      typeCell.innerHTML = '<input type="text" name="product_category[]">';
      categoryCell.innerHTML = '<input type="text" name="product_trademark[]">';
      qtyCell.innerHTML = '<input type="text" name="product_qty[]">';
      priceCell.innerHTML = '<input type="text" name="product_price[]">';
      totalCell.innerHTML = '<input type="text" name="product_total[]">';
      deleteCell.innerHTML = '<div class="delete_row"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.6665C13.6589 6.6665 13.3333 6.99212 13.3333 7.39378C13.3333 7.79544 13.6589 8.12105 14.0606 8.12105H17.9394C18.341 8.12105 18.6667 7.79544 18.6667 7.39378C18.6667 6.99212 18.341 6.6665 17.9394 6.6665H14.0606ZM8 10.3029C8 9.90119 8.32561 9.57558 8.72727 9.57558H10.1818H21.8182H23.2727C23.6744 9.57558 24 9.90119 24 10.3029C24 10.7045 23.6744 11.0301 23.2727 11.0301H22.5455V22.6665C22.5455 24.2816 21.2158 25.5756 19.6179 25.5756H12.3452C11.9637 25.5752 11.5854 25.4995 11.2333 25.3526C10.8812 25.2057 10.5617 24.9906 10.2931 24.7197C10.0244 24.4488 9.81206 24.1274 9.66816 23.7741C9.52463 23.4217 9.45204 23.0444 9.45455 22.6639V11.0301H8.72727C8.32561 11.0301 8 10.7045 8 10.3029ZM10.9091 22.672V11.0301H21.0909V22.6665C21.0909 23.462 20.4288 24.121 19.6179 24.121H12.3458C12.1562 24.1209 11.9684 24.0832 11.7934 24.0102C11.6183 23.9371 11.4595 23.8302 11.3259 23.6955C11.1924 23.5608 11.0868 23.4011 11.0153 23.2254C10.9437 23.0498 10.9076 22.8617 10.9091 22.672ZM17.9394 13.4544C18.3411 13.4544 18.6667 13.78 18.6667 14.1817V20.9695C18.6667 21.3712 18.3411 21.6968 17.9394 21.6968C17.5377 21.6968 17.2121 21.3712 17.2121 20.9695V14.1817C17.2121 13.78 17.5377 13.4544 17.9394 13.4544ZM14.7879 14.1817C14.7879 13.78 14.4623 13.4544 14.0606 13.4544C13.6589 13.4544 13.3333 13.78 13.3333 14.1817V20.9695C13.3333 21.3712 13.6589 21.6968 14.0606 21.6968C14.4623 21.6968 14.7879 21.3712 14.7879 20.9695V14.1817Z" fill="#555555"/></svg></div>';
      divCell.innerHTML = '<div class="modal fade" id="exampleModal'+rowCount +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Modal title</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="div_value"><input type="text" name="product_SN[]"></div><button data-target="div_value'+rowCount+'" class="addNew_SN">Thêm SN</button></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button></div></div></div></div>'
    });
  }
  $('.addNew_SN').click(function(e) {
  e.preventDefault();
  var inputWrapper = $(".input-wrapper");
  var newInput = $("<input>").attr("type", "text").attr("name", "product_SN[]");
  var targetDiv = $(this).data('target');
  var div = $('.' + targetDiv);
  div.append(newInput);
});


 // var addNew_SN = document.querySelectorAll('.addNew_SN');
  // if (addNew_SN) {
  //   for (let i = 0; i < addNew_SN.length; i++) {
  //     addNew_SN[i].addEventListener('click', function(e) {
  //       e.preventDefault();
  //       var inputWrapper = document.querySelector(".input-wrapper");
  //       var newInput = document.createElement("input");
  //       newInput.type = "text";
  //       newInput.name = "product_SN[]";
  //       var div = document.querySelector('.div_value');
  //       div.append(newInput);
  //     })
  //   }
  // }
</script>
</body>

</html>