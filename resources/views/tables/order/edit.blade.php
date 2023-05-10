<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <form action="{{route('insertProduct.update',$order->id)}}" method="POST">
    @csrf
    @method('PUT')
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
    <section>
      <div class="d-flex justify-content-between align-items-center">
        <div class="title">
          <h4>Thông tin nhà cung cấp</h4>
        </div>
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-4">
            <label for="">Công ty</label>
            <input type="text" name="provide_name" value="{{$provide_order[0]->provide_name}}"> <br>
            <label for="">Địa chỉ xuất hóa đơn</label>
            <input type="text" name="provide_address" value="{{$provide_order[0]->provide_address}}"> <br>
            <label for="">Mã số thuế</label>
            <input type="text" name="provide_code" value="{{$provide_order[0]->provide_code}}"> <br>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <label for="">Người đại diện</label>
            <input type="text" name="provide_represent" value="{{$provide_order[0]->provide_represent}}"> <br>
            <label for="">Email</label>
            <input type="text" name="provide_email" value="{{$provide_order[0]->provide_email}}"> <br>
            <label for="">Số điện thoại</label>
            <input type="text" name="provide_phone" value="{{$provide_order[0]->provide_phone}}">
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
              <td><input type="text" name='products_id[]' value="{{$pro->products_id}}"></td>
              <td><input type="text" name="product_name[]" value="{{$pro->product_name}}"> </td>
              <td> <input type="text" name="product_category[]" value=" {{$pro->product_category}}"> </td>
              <td> <input type="text" name="product_unit[]" value="  {{$pro->product_unit}}"> </td>
              <td> <input type="text" name="product_trademark[]" value=" {{$pro->product_trademark}}"> </td>
              <td> <input type="text" name="product_qty[]" value="{{$pro->product_qty}}"> </td>
              <td> <input type="text" name="product_price[]" value="{{$pro->product_price}}"> </td>
              <td><input type="text" name="product_tax[]" value="{{$pro->product_tax}}"></td>
              <td><input type="text" name="product_total[]" value="{{$pro->product_total}}"></td>
              <td><button name="btn_add_SN[]" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$pro->id}}">SN</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div id="list_modal">
        </div>
      </div><!-- /.container-fluid -->
  </form>
  </section>
  <!-- /.content -->
</div>

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
</script>
</body>

</html>