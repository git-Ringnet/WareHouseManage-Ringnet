<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="btn btn-primary">Tạo đơn</div>
      <div class="btn">Xuất Excel</div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content-header">
    <div class="container-fluid">
      <input type="checkbox" name="check" onclick="onlyOne(this)"> <label for="">Nhà cung cấp cũ</label>
      <input type="checkbox" name="check" onclick="onlyOne(this)"> <label for="">Nhà cung cấp mới</label>
    </div>
  </section>
  <section class="content-header">
    <div class="container-fluid">
      <input type="text">
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <td><input type="checkbox"></td>
            <td>Mã đơn</td>
            <td>Thông tin hóa đơn</td>
            <td>Loại hàng</td>
            <td>Nhà cung cấp</td>
            <td>Số lượng</td>
            <td>Giá nhập</td>
            <td>Thuế</td>
            <td>Thành tiền</td>
            <td>SN</td>
            <td></td>
          </tr>
        </thead>
        <tbody >

        </tbody>
      </table>
      <a href="javacript:;" class="btn btn-info addRow">+</a>
      <div id="list_modal">
      <div class="modal fade" id="exampleModal0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<script>
  function onlyOne(checkbox) {
    var checkboxes = document.getElementsByName('check')
    checkboxes.forEach((item) => {
      if (item !== checkbox) item.checked = false
    })
  }
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
  var rowCount = $('tbody tr').length;
  $('.addRow').on('click', function() {
    var tr = '<tr>' +
      '<input hidden type="text" name="product_id">' +
      '<th scope="row">' + rowCount + '</th>' +
      '<td><input type="text" readonly></td>' +
      '<td>' +
      '<select name="product_provide[]" id="">' +
      '@foreach($provide as $va)' +
      '<option value="{{$va->id}}">{{$va->provide_name}}</option>' +
      '@endforeach' +
      '</select>' +
      '</td>' +
      '<td><input type="text" name="product_name[]"></td>' +
      '<td><input type="text" name="product_category[]"></td>' +
      '<td><input type="text" name="product_trademark[]"></td>' +
      '<td><input type="text" name="product_qty[]"></td>' +
      '<td><input type="text" name="product_price[]"></td>' +
      '<td><input type="text" name="product_total[]"></td>' +
      '<td>' +
      '<button name="btn_add_SN[]" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal' + rowCount + '">' +
      'SN' +
      '</button>' +
      '</td>' +
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
  });

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