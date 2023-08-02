<x-navbar></x-navbar>
<div class="content-wrapper">
    <section class="content">
        <div class="">
            <div class="row">
                <div class="col col-12">
                   
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                             <div class="table-container">
                            <table id="example2" class="table table-hover" style="overflow-x: scroll">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>ĐVT</th>
                                        <th>Số lượng</th>
                                        <th>Giá nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->product_unit}}</td>
                                        <td>{{$item->product_qty}}</td>
                                        <td>{{$item->product_price}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                              </div>
                        </div>
                    </div>
              
            </div>
    </section>
</div>
</div>
