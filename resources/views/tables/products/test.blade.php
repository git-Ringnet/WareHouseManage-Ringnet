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
                        <input type="text" value="{{$products->products_name}}">
                      </div>
                      <div class="product_code">
                        <h4>Mã sản phẩm</h4>
                        <input type="text" value="{{$products->products_code}}" readonly>
                      </div>
                      <div class="product_id">
                        <h4>ID</h4>
                        <input type="text" value="{{$products->id}}" readonly>
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
          <form action="{{route('data.store')}}" method="post" id="myform" style="overflow-x: scroll">
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
            <a href="javacript:;" class="btn btn-info addRow">+</a>
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
                    <div class="div_value0">
                      <div class="delete d-flex justify-content-between">
                        <input type="text" name="product_SN0[]">
                        <div class="deleteRow1">delete</div>
                      </div>
                    </div>
                    <div class="AddSN btn btn-primary" style="border:1px solid gray;">add SN</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>
                  </div>
                </div>
              </div>
            </div>
            <div id="list_modal"></div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<style>
  .error {
    border: 2px solid red;
  }
</style>
<script>
  function updateRowNumbers() {
    $('tbody tr').each(function(index) {
      $(this).find('th:first').text(index + 1);
    });
  }

  function updateProductSN() {
    $('.modal-body').each(function(index) {
      var productSN = $(this).find('input[name^="product_SN"]');
      var div_value2 = $(this).find('div[class^="div_value"]');
      productSN.attr('name', 'product_SN' + index + '[]');
      div_value2.attr('class', 'div_value' + index + '[]');
    });

  }
  var btn_add_products = document.getElementById('myform');
  btn_add_products.addEventListener('submit', function(e) {
    e.preventDefault();
    var error = false;
    $('input[name="product_name[]"]').each(function() {
      if ($(this).val() === '') {
        $(this).addClass('error');
        error = true;
      } else {
        $(this).removeClass('error');
      }
    });
    $('input[name="product_qty[]"]').each(function() {
      if ($(this).val() === '') {
        $(this).addClass('error');
        error = true;
      } else {
        $(this).removeClass('error');
      }
    });
    $('input[name="product_SN[]"]').each(function() {
      if ($(this).val() === '') {
        $(this).addClass('error');
        error = true;
      } else {
        $(this).removeClass('error');
      }
    });

    $('input[name^="product_qty[]"]').each(function(index) {
      var qty = $(this).val();
      var sn_count = $('input[name="product_SN' + index + '[]"]').length;
      if (qty != sn_count) {
        error = true;
      }
    });
    if (error) {
      return false;
    }
    updateProductSN();
    $(this).submit();
  });
  var rowCount = $('tbody tr').length;
  $('.addRow').on('click', function() {
    var tr = '<tr>' +
      '<input hidden type="text" value="{{$products->id}}" name="product_id">' +
      '<th scope="row">' + rowCount + '</th>' +
      '<td><input type="text" value="{{$products->products_code}}" readonly></td>' +
      '<td>' +
      '<button name="btn_add_SN[]" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' + rowCount + '">' +
      'SN' +
      '</button>' +
      '</td>' +
      '<td><input type="text" name="product_name[]"></td>' +
      '<td>' +
      '<select name="product_provide[]" id="">' +
      '@foreach($provide as $va)' +
      '<option value="{{$va->id}}">{{$va->provide_name}}</option>' +
      '@endforeach' +
      '</select>' +
      '</td>' +
      '<td><input type="text" name="product_category[]"></td>' +
      '<td><input type="text" name="product_trademark[]"></td>' +
      '<td><input type="text" name="product_qty[]"></td>' +
      '<td><input type="text" name="product_price[]"></td>' +
      '<td><input type="text" name="product_total[]"></td>' +
      '<td><a href="javascript:;" class="btn btn-info deleteRow">-</a></td>' +
      '</tr>';
    $('tbody').append(tr);
    updateRowNumbers();
    var modal = '<div class="modal fade" id="exampleModal' + rowCount + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">' +
      '<div class="modal-dialog" role="document">' +
      '<div class="modal-content">' +
      '<div class="modal-header">' +
      '<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>' +
      '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
      '<span aria-hidden="true">&times;</span>' +
      '</button>' +
      '</div>' +
      '<div class="modal-body">' +
      '<div class="div_value' + rowCount + '">' +
      '<div class="delete d-flex justify-content-between">' +
      '<input type="text" name="product_SN' + rowCount + '[]">' +
      '<div class="deleteRow1">delete</div>' +
      '</div>' +
      '</div>' +
      '<div class="AddSN btn btn-primary" style="border:1px solid gray;">add SN</div>' +
      '</div>' +
      '<div class="modal-footer">' +
      '<button type="button" class="btn btn-secondary" data-dismiss="modal">Save</button>' +
      '</div>' +
      '</div>' +
      '</div>' +
      '</div>'
    $('#list_modal').append(modal);
    rowCount++;

    var addSNBtns = $('.AddSN')
    for (let i = 1; i < addSNBtns.length; i++) {
      $(addSNBtns[i]).off('click').on('click', function() {
        var newDiv = document.createElement("input");
        newDiv.setAttribute("type", "text");
        newDiv.setAttribute("name", "product_SN" + i + "[]");
        var div_value1 = document.querySelector('.div_value' + i);
        div_value1.appendChild(newDiv);
      });
    }
  });

  var AddSN = document.querySelectorAll('.AddSN');
  AddSN[0].addEventListener('click', function() {
    var newDiv = document.createElement("input");
    newDiv.setAttribute("type", "text");
    newDiv.setAttribute("name", "product_SN0[]");
    var div_value = document.querySelector('.div_value0');
    div_value.appendChild(newDiv);
  })

  $('body').on('click', '.deleteRow', function() {
    var parentTr = $(this).closest('tr');
    var targetId = $(this).closest('tr').find('button[name="btn_add_SN[]"]').attr('data-target');
    $(targetId).remove();
    parentTr.remove();
    updateRowNumbers();
  });
</script>



</body>

</html>