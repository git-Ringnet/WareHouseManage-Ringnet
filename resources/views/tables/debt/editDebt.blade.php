<!-- Công nợ -->
<x-navbar></x-navbar>
<div class="content-wrapper">
    <div class="breadcrumb">
        <span><a href="{{ route('admin.userslist') }}">Công Nợ</a></span>
        <span class="px-1">/</span>
        <span><b>Đơn Hàng</b></span>
        <span class="ml-1">{{ $debts->id }}</span>
    </div>
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluided -->
    </section>
    <form action="{{ route('debt.update', $debts->id) }}" method="POST">
        @csrf
        @method('PUT')
        <section class="content">
            @if ($debts->debt_status != 1)
                <div class="d-flex mb-1 action-don">
                    <button type="submit" class="btn btn-danger text-white" name="submitBtn" value="action1"
                        onclick="">Thanh Toán</button>
                </div>
            @endif
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Mã đơn</div>
                        <input type="text" class="form-control" value="{{ $debts->id }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Khách hàng</div>
                        <input type="text" class="form-control" value="{{ $debts->guest_id }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Nhân viên</div>
                        <input type="text" class="form-control" value="{{ $debts->user_id }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Tổng tiền bán</div>
                        <input type="text" class="form-control" value="{{ number_format($debts->total_sales) }}"
                            name="" id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Tổng tiền nhập</div>
                        <input type="text" class="form-control" value="{{ number_format($debts->total_import) }}"
                            name="" id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Phí vận chuyển</div>
                        <input type="text" class="form-control"
                            value="{{ number_format($debts->debt_transport_fee) }}" name="" id=""
                            readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Tổng tiền chênh lệch</div>
                        <input type="text" class="form-control"
                            value="{{ number_format($debts->total_sales - $debts->total_import - $debts->debt_transport_fee) }}"
                            name="" id="" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Mã Sản Phẩm</th>
                                        <th class="text-right">Số lượng</th>
                                        <th class="text-right">Giá bán</th>
                                        <th class="text-right">Giá nhập</th>
                                        <th class="text-center">Chênh lệch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td><?php echo $stt += 1; ?></td>
                                            <td>{{ $item->maSanPham }}</td>
                                            <td class="text-right">{{ $item->soluong }}</td>
                                            <td class="text-right">{{ number_format($item->giaban) }}</td>
                                            <td class="text-right">{{ number_format($item->gianhap) }}</td>
                                            <td class="text-center">
                                                {{ number_format($item->giaban * $item->soluong - $item->gianhap * $item->soluong) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
            <div class="form-group d-flex align-items-center">
                <div class="leftspacing">
                    <div class="labelform16">Công nợ:</div>
                </div>
                <div class="d-flex align-items-center ml-4">
                    <input type="text" class="form-control text-center mr-1" style="width: 50px" name="debt"
                        id="" value="{{ $debts->debt }}">
                </div>
                <span>ngày</span>
            </div>
            <div class="form-group d-flex align-items-center">
                <div class="leftspacing">
                </div>
                <div class="d-flex align-items-center ml-4">
                    <input type="date" class="form-control text-center mr-1" name="" id=""
                        value="">
                    <input type="date" class="form-control text-center mr-1" name="" id=""
                        value="">
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="leftspacing">
                    <div class="labelform16">Ghi chú:</div>
                </div>
                <div class="d-flex align-items-center ml-4">
                    <textarea name="debt_note" id="" class="form-control" cols="50" rows="8">{{ $debts->debt_note }}</textarea>
                </div>
            </div>
        </section>
        <div class="btn-fixed">
            @if ($debts->debt_status != 1)
                <button class="btn btn-primary" type="submit" name="submitBtn" value="action2">Lưu</button>
            @endif
            <a href="{{ route('debt.index') }}"><span class="btn border-secondary ml-1">Hủy</span></a>
        </div>
    </form>
