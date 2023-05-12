<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <form action="{{route('insertProduct.update',$order->id)}}" method="POST" id="form_submit">
    @csrf
    @method('PUT')
    <input type="hidden" name="order_id" value="{{$order->id}}">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <div class="w-75">
              <div class="">
                <span>Nhập hàng</span>
                <span>/</span>
                <span><b>Đơn nhập hàng mới</b></span>
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-danger text-white">Duyệt đơn</button>
                <a href="#" class="btn btn-secondary ml-4">Hủy đơn</a>
                <a href="#" class="btn border border-secondary ml-4">In đơn hàng</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="w-50 position-relative" style="float: right;">
              <div class="justify-content-between d-flex">
                <span style="z-index: 99">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15.6667" cy="15.667" r="13" fill="#09BD3C" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.1072 12.2929C22.4977 12.6834 22.4977 13.3166 22.1072 13.7071L15.4405 20.3738C15.05 20.7643 14.4168 20.7643 14.0263 20.3738L10.0263 16.3738C9.63577 15.9832 9.63577 15.3501 10.0263 14.9596C10.4168 14.569 11.05 14.569 11.4405 14.9596L14.7334 18.2525L20.693 12.2929C21.0835 11.9024 21.7166 11.9024 22.1072 12.2929Z" fill="white" />
                  </svg>
                  <p class="text-center p-0 m-0">
                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="3" cy="3" r="3" fill="#09BD3C" />
                    </svg>
                  </p>
                </span>
                <span style="z-index: 99">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z" fill="#D6D6D6" />
                    <path d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z" fill="#D6D6D6" />
                  </svg>
                  <p class="text-center p-0 m-0">
                    <svg width="6" height="6" viewBox="0 0 6 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="3" cy="3" r="3" fill="#D6D6D6" />
                    </svg>
                  </p>
                </span>
                <span style="z-index: 99">
                  <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 5C9.92487 5 5 9.92487 5 16C5 22.0751 9.92487 27 16 27C22.0751 27 27 22.0751 27 16C27 9.92487 22.0751 5 16 5ZM3 16C3 8.8203 8.8203 3 16 3C23.1797 3 29 8.8203 29 16C29 23.1797 23.1797 29 16 29C8.8203 29 3 23.1797 3 16Z" fill="#D6D6D6" />
                    <path d="M22.1578 15.9997C22.1578 19.4006 19.4008 22.1576 15.9999 22.1576C12.599 22.1576 9.84204 19.4006 9.84204 15.9997C9.84204 12.5988 12.599 9.8418 15.9999 9.8418C19.4008 9.8418 22.1578 12.5988 22.1578 15.9997Z" fill="#D6D6D6" />
                  </svg>
                  <p class="p-0 m-0"></p>

                </span>
              </div>
              <div class="position-absolute" style="top: 32px; z-index: 0;left: 17px">
                <svg height="4" viewBox="0 0 364 3" fill="none" style="width: 95%" xmlns="http://www.w3.org/2000/svg">
                  <line x1="0.999268" y1="1.50098" x2="363.001" y2="1.50098" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
              <div class="justify-content-between d-flex">
                <b>Tạo đơn</b>
                <b>Đơn nháp</b>
                <b>Chốt đơn</b>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content-header">
      <div class="container-fluid">
        <select id="select_page" style="width:200px;" class="operator" name="provide_id">
          @foreach($provide as $value)
          <option value="{{$value->id}}" {{ ( $order->provide_id == $value->id) ? 'selected' : '' }}> {{$value->provide_name}} </option>
          @endforeach
        </select>
      </div>
    </section>
    <section id="infor_provide">
      <div class="d-flex justify-content-between align-items-center">
        <div class="title">
          <h4>Thông tin nhà cung cấp</h4>
        </div>
        <div class="save_infor btn btn-secondary">Lưu thông tin</div>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-4">
            <label for="">Công ty</label>
            <input type="text" id="provide_name" name="provide_name" value="{{$provide_order[0]->provide_name}}"> <br>
            <label for="">Địa chỉ xuất hóa đơn</label>
            <input type="text" id="provide_address" name="provide_address" value="{{$provide_order[0]->provide_address}}"> <br>
            <label for="">Mã số thuế</label>
            <input type="text" id="provide_code" name="provide_code" value="{{$provide_order[0]->provide_code}}"> <br>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <label for="">Người đại diện</label>
            <input type="text" id="provide_represent" name="provide_represent" value="{{$provide_order[0]->provide_represent}}"> <br>
            <label for="">Email</label>
            <input type="text" id="provide_email" name="provide_email" value="{{$provide_order[0]->provide_email}}"> <br>
            <label for="">Số điện thoại</label>
            <input type="text" id="provide_phone" name="provide_phone" value="{{$provide_order[0]->provide_phone}}">
          </div>
        </div>
      </div>`
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td>Mã đơn</td>
              <td>Thông tin sản phẩm</td>
              <td>Loại hàng</td>
              <td>Đơn vị tính</td>
              <td>Thương hiệu</td>
              <td>Số lượng</td>
              <td>Giá nhập</td>
              <td>Thuế</td>
              <td>Thành tiền</td>
              <td>SN</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @foreach($product_order as $pro)
            <tr>
              <input type="hidden" name="product_id[]" value="{{$pro->product_id}}">
              <td><input readonly type="text" name='products_id[]' value="{{$pro->products_id}}"></td>
              <td><input type="text" name="product_name[]" value="{{$pro->product_name}}"> </td>
              <td> <input type="text" name="product_category[]" value=" {{$pro->product_category}}"> </td>
              <td> <input type="text" name="product_unit[]" value="  {{$pro->product_unit}}"> </td>
              <td> <input type="text" name="product_trademark[]" value=" {{$pro->product_trademark}}"> </td>
              <td> <input type="text" name="product_qty[]" value="{{$pro->product_qty}}"> </td>
              <td> <input type="text" name="product_price[]" value="{{$pro->product_price}}"> </td>
              <td><input type="text" name="product_tax[]" value="{{$pro->product_tax}}"></td>
              <td><input type="text" name="product_total[]" value="{{$pro->product_total}}"></td>
              <td><button name="btn_add_SN[]" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$pro->id}}">SN</button></td>
              <td><a href="javascript:;" class="btn btn-info deleteRow">-</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div id="list_modal">
          @foreach($product_order as $pro)
          <div class="modal fade" id="exampleModal{{$pro->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">'
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="div_value{{$pro->id}}">
                    <div class="delete d-flex justify-content-between">
                      <input type="text" name="product_SN{{$pro->id}}[]">
                      <div class="deleteRow1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555" />
                        </svg>
                      </div>
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
          @endforeach
        </div>
        <a href="javascript:;" class="btn btn-info addRow">Thêm sản phẩm</a>
        <a href="javascript:;" class="btn btn-primary addBillEdit">Lưu</a>
      </div><!-- /.container-fluid -->
  </form>
  </section>
  <!-- /.content -->
</div>

<script>
  // Update productSN trước khi thêm dữ liệu
  function updateProductSN() {
    $('.modal-body').each(function(index) {
      var productSN = $(this).find('input[name^="product_SN"]');
      var div_value2 = $(this).find('div[class^="div_value"]');
      productSN.attr('name', 'product_SN' + index + '[]');
      div_value2.attr('class', 'div_value' + index + '[]');
    });
  }

  // Chuyển hướng form để thêm dữ liệu
  $(document).on('click', '.addBillEdit', function(e) {
    e.preventDefault();
    $('#form_submit').attr('action', '{{route("addBillEdit")}}');
    $('input[name="_method"]').remove();
    updateProductSN()
    $('#form_submit').submit();
  });

  function updateRowNumbers() {
    $('tbody tr').each(function(index) {
      $(this).find('th:first').text(index + 1);
    });
  }


  var rowCount = $('tbody tr').length;
  var last = "<?php echo $lastId; ?>";
  $('.addRow').on('click', function() {
    last++;
    var tr = '<tr>' +
      '<input type="hidden" name="product_id[]" value="' + last + '">' +
      '<td>' +
      '<select name="products_id[]">' +
      '@foreach($products as $va)' +
      '<option value="{{$va->id}}">{{$va->products_code}}</option>' +
      '@endforeach' +
      '</select> ' +
      '</td>' +
      '<td><input type="text" name="product_name[]"></td>' +
      '<td><input type="text" name="product_category[]"></td>' +
      '<td><input type="text" name="product_unit[]"></td>' +
      '<td><input type="text" name="product_trademark[]"></td>' +
      '<td><input type="text" name="product_qty[]"></td>' +
      '<td><input type="text" name="product_price[]"></td>' +
      '<td><input type="text" name="product_tax[]"></td>' +
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
      '<div class="deleteRow1"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z" fill="#555555"/></svg></div>' +
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


    var addSNBtns = $('.AddSN')
    for (let i = 0; i < addSNBtns.length; i++) {
      $(addSNBtns[i]).off('click').on('click', function() {
        var newDiv = document.createElement("input");
        newDiv.setAttribute("type", "text");
        newDiv.setAttribute("name", "product_SN" + i + "[]");
        var div_value1 = document.querySelector('.div_value' + i);
        div_value1.appendChild(newDiv);
      });
    }
    rowCount++;
  });

  $('body').on('click', '.deleteRow', function() {
    var parentTr = $(this).closest('tr');
    var targetId = $(this).closest('tr').find('button[name="btn_add_SN[]"]').attr('data-target');
    $(targetId).remove();
    parentTr.remove();
    updateRowNumbers();
  });


  $('#select_page').change(function() {
    var infor_provide = "";
    var provides_id = $('#select_page').val();
    $('#infor_provide').empty();
    $.ajax({
      url: "{{ route('show_provide') }}",
      type: "get",
      data: {
        provides_id: provides_id,
      },
      success: function(data) {
        infor_provide += ` <div class="d-flex justify-content-between align-items-center">
          <div class="title"><h4>Thông tin nhà cung cấp</h4></div>
          <div class="save_infor btn btn-secondary">Lưu thông tin</div>
           </div>
          <div class="content">
          <div class="row">
          <div class="col-md-4">
          <input type="hidden" id="provide_id" name="provide_id" value="` + data.id + `"> <br>
          <label for="">Công ty</label>
          <input type="text" id="provide_name" name="provide_name" value="` + data.provide_name + `"> <br>
          <label for="">Địa chỉ xuất hóa đơn</label>
          <input type="text" id="provide_address" name="provide_address" value="` + data.provide_address + `"> <br>
          <label for="">Mã số thuế</label>
          <input type="text" id="provide_code" name="provide_code" value="` + data.provide_code + `"> <br>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
          <label for="">Người  đại diện</label>
          <input type="text" id="provide_represent" name="provide_represent" value="` + data.provide_represent + `"> <br>
          <label for="">Email</label>
          <input type="text" id="provide_email" name="provide_email" value="` + data.provide_email + `"> <br>
          <label for="">Số điện thoại</label>
          <input type="text" id="provide_phone" name="provide_phone" value="` + data.provide_phone + `">
          </div>
          </div>
          </div>`
        $('#infor_provide').append(infor_provide);
      }
    });
  });


  $(document).on('click', '.save_infor', function(e) {
    e.preventDefault();
    var provides_id = $('#select_page').val();
    var provide_name = $('#provide_name').val();
    var provide_address = $('#provide_address').val();
    var provide_represent = $('#provide_represent').val();
    var provide_email = $('#provide_email').val();
    var provide_phone = $('#provide_phone').val();
    var provide_code = $('#provide_code').val();
    $.ajax({
      url: "{{ route('update_provide') }}",
      type: "get",
      data: {
        provides_id: provides_id,
        provide_name: provide_name,
        provide_address: provide_address,
        provide_represent: provide_represent,
        provide_email: provide_email,
        provide_phone: provide_phone,
        provide_code: provide_code
      },
      success: function(data) {
        alert('Lưu thông tin thành công');
      }
    })
  })
</script>
</body>

</html>