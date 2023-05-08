<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
     <a href="{{route('insertProduct.create')}}"> <div class="btn btn-primary">Tạo đơn</div></a>
      <div class="btn">Xuất Excel</div>
    </div><!-- /.container-fluid -->
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
            <td>Nhà cung cấp</td>
            <td>Chỉnh sửa cuối</td>
            <td>Người tạo</td>
            <td>Tổng tiền</td>
            <td>Trạng thái</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
        @foreach($order as $va)
          <tr>
            <td><input type="checkbox"></td>
            <td>{{$va->id}}</td>
            <td></td>
            <td>{{$va->updated_at}}</td>
            <td>{{$va->users_id}}</td>
            <td>56.000.000</td>
            <td>
            {{$va->order_status}}
            </td>
            <td class="d-flex justify-content-between">
              <div class="edit">
                <a href="{{route('insertProduct.edit',$va->id)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7833 6.79458C18.9872 6.71003 19.2058 6.6665 19.4265 6.6665C19.6472 6.6665 19.8658 6.71003 20.0697 6.79458C20.2736 6.87914 20.4588 7.00306 20.6147 7.15927L21.9609 8.50539C22.117 8.66141 22.241 8.84668 22.3255 9.05063C22.41 9.25457 22.4536 9.47318 22.4536 9.69394C22.4536 9.9147 22.41 10.1333 22.3255 10.3373C22.241 10.5412 22.117 10.7265 21.9609 10.8825L20.281 12.5623C20.2712 12.5734 20.2611 12.5842 20.2505 12.5948C20.2399 12.6054 20.2291 12.6155 20.218 12.6253L11.5609 21.2825C11.4259 21.4175 11.2427 21.4933 11.0518 21.4933H8.34662C7.94899 21.4933 7.62665 21.171 7.62665 20.7734V18.0682C7.62665 17.8772 7.70251 17.6941 7.83755 17.5591L16.489 8.90836C16.5005 8.89507 16.5126 8.88211 16.5252 8.86949C16.5378 8.85686 16.5508 8.84479 16.5641 8.8333L18.2383 7.15927C18.3941 7.00328 18.5797 6.87905 18.7833 6.79458ZM17.0356 10.3981L9.0666 18.3664V20.0534H10.7536L18.7222 12.0847L17.0356 10.3981ZM19.7404 11.0665L18.0539 9.37997L19.2574 8.1766C19.2796 8.15436 19.3059 8.13672 19.3349 8.12468C19.364 8.11265 19.3951 8.10645 19.4265 8.10645C19.4579 8.10645 19.4891 8.11265 19.5181 8.12468C19.5471 8.13672 19.5739 8.1548 19.5961 8.17704L20.9429 9.52386C20.9653 9.54615 20.9832 9.57291 20.9953 9.60204C21.0074 9.63117 21.0136 9.6624 21.0136 9.69394C21.0136 9.72549 21.0074 9.75671 20.9953 9.78584C20.9832 9.81498 20.9653 9.84173 20.9429 9.86402L19.7404 11.0665ZM6.66669 24.6132C6.66669 24.2156 6.98903 23.8932 7.38666 23.8932H24.666C25.0636 23.8932 25.386 24.2156 25.386 24.6132C25.386 25.0108 25.0636 25.3332 24.666 25.3332H7.38666C6.98903 25.3332 6.66669 25.0108 6.66669 24.6132Z" fill="#555555" />
                </svg>
                </a>
              </div>
              <div class="dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M9.64162 12.3083C10.0527 11.8972 10.7192 11.8972 11.1303 12.3083L16 17.178L20.8697 12.3083C21.2808 11.8972 21.9473 11.8972 22.3583 12.3083C22.7694 12.7194 22.7694 13.3859 22.3583 13.797L16.7443 19.411C16.3332 19.8221 15.6667 19.8221 15.2557 19.411L9.64162 13.797C9.23054 13.3859 9.23054 12.7194 9.64162 12.3083Z" fill="#555555" />
                </svg>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
</script>
</body>

</html>