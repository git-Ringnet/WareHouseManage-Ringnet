<!-- Công nợ -->
<x-navbar :title="$title"></x-navbar>
<div class="content-wrapper padding-112">
    <div class="breadcrumb">
        <span><a href="{{ route('debt_import.index') }}">Công nợ nhập</a></span>
        <span class="px-1">/</span>
        <span><b>Đơn Hàng</b></span>
        <span class="ml-1"><b>{{ $debts->madon }}</b></span>
    </div>
    <form action="{{ route('debt_import.update', $debts->id) }}" method="POST">
        @csrf
        @method('PUT')
        <section class="content">
            @if ($debts->debt_status != 1)
                <div class="d-flex mb-1 action-don">
                    <button type="submit" class="btn btn-danger text-white" name="submitBtn" value="action1"
                        onclick="" onkeydown="return event.key != 'Enter';">Thanh Toán</button>
                </div>
            @endif
            <div class="row  mt-2">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Số PO</div>
                        <input type="text" class="form-control" value="{{ $debts->po }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Hóa đơn vào</div>
                        <input type="text" class="form-control" value="{{ $debts->madon }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Ngày nhập hóa đơn</div>
                        <input type="text" class="form-control"
                            value="{{ date_format(new DateTime($debts->created_at), 'd-m-Y') }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Nhà cung cấp</div>
                        <input type="text" class="form-control" value="{{ $debts->nhacungcap }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Nhân viên</div>
                        <input type="text" class="form-control" value="{{ $debts->nhanvien }}" name=""
                            id="" readonly>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                        <div class="labelform">Tổng tiền nhập(+VAT)</div>
                        <input type="text" class="form-control" value="{{ number_format($debts->total_import) }}"
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
                                        <th class="text-left">Tên Sản Phẩm</th>
                                        <th class="text-center">Đơn vị tính</th>
                                        <th class="text-right">Số lượng</th>
                                        <th class="text-right">Giá nhập</th>
                                        <th class="text-right">Thành tiền</th>
                                        <th class="text-center">Thuế</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 0; ?>
                                    @foreach ($product as $item)
                                        <tr>
                                            <td><?php echo $stt += 1; ?></td>
                                            <td class="text-left">{{ $item->tensanpham }}</td>
                                            <td class="text-center">{{ $item->dvt }}</td>
                                            <td class="text-right">{{ $item->soluong }}</td>
                                            <td class="text-right">{{ number_format($item->gianhap) }}</td>
                                            <td class="text-right">
                                                {{ number_format($item->soluong * $item->gianhap) }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->thue == 99)
                                                    NOVAT
                                                @else
                                                    {{ $item->thue }}%
                                                @endif
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
                    <input type="text" oninput="validateNumberInput(this)" class="form-control text-center mr-1"
                        style="width: 50px" name="debt_debt" id="daysToAdd"
                        @if ($debts->debt_status == 1) readonly @endif value="{{ $debts->debt }}">
                </div>
                <span>ngày</span>
                <div class="checkbox ml-5"><input type="checkbox" id="debtCheckbox" value="0"><span
                        class="ml-2">Thanh toán tiền mặt</span></div>
            </div>
            <div class="form-group d-flex align-items-center">
                <div class="leftspacing">
                </div>
                <div class="d-flex align-items-center ml-4">
                    <input type="date" @if ($debts->debt_status == 1) readonly @endif
                        class="form-control text-center mr-1" name="date_start" id="startDate"
                        value="{{ strftime('%Y-%m-%d', strtotime($debts->date_start)) }}">
                    <input type="date" class="form-control text-center mr-1" name="date_end" id="endDate"
                        value="{{ strftime('%Y-%m-%d', strtotime($debts->date_end)) }}" readonly>
                </div>
            </div>
            <div class="form-group d-flex">
                <div class="leftspacing">
                    <div class="labelform16">Ghi chú:</div>
                </div>
                <div class="d-flex align-items-center ml-4">
                    <textarea name="debt_note" id="" class="form-control" @if ($debts->debt_status == 1) disabled @endif
                        cols="50" rows="8">{{ $debts->debt_note }}</textarea>
                </div>
            </div>
        </section>
        <div class="btn-fixed">
            @if ($debts->debt_status != 1)
                <button class="btn btn-primary" type="submit" name="submitBtn" value="action2"
                    onkeydown="return event.key != 'Enter';">Lưu</button>
            @endif
            <a href="{{ route('debt_import.index') }}"><span class="btn border-secondary ml-1">Hủy</span></a>
        </div>
    </form>
    <script>
        // Checkbox
        $(document).on('change', '#debtCheckbox', function() {
            if ($(this).is(':checked')) {
                $('#daysToAdd').prop('disabled', true);
                $('#daysToAdd').val(0);
                $('#startDate').prop('disabled', true);
            } else {
                $('#daysToAdd').prop('disabled', false);
                $('#startDate').prop('disabled', false);
            }
        });
        $('#daysToAdd').on('change', function() {
            var daysToAddValue = $(this).val();
            console.log(daysToAddValue);
            if (daysToAddValue == 0) {
                $('#debtCheckbox').prop('checked', true).trigger('change');
            } else {
                $('#debtCheckbox').prop('checked', false).trigger('change');
            }
        });


        $(document).ready(function() {
            // Bắt sự kiện thay đổi giá trị của daysToAdd và startDate
            $("#daysToAdd, #startDate").change(function() {
                var daysToAdd = parseInt($("#daysToAdd").val(), 10);
                var startDate = new Date($("#startDate").val());

                // Kiểm tra tính hợp lệ của giá trị nhập vào
                if (isNaN(daysToAdd) || isNaN(startDate.getTime())) {
                    return;
                }

                var count = 0;
                var currentDay = new Date(startDate);

                while (count < daysToAdd) {
                    currentDay.setDate(currentDay.getDate() + 1);
                    count++;
                }

                // Cập nhật giá trị của endDate
                $("#endDate").val(formatDate(currentDay));
            });

            // Hàm chuyển đổi ngày thành chuỗi ngày/tháng/năm (dd/mm/yyyy)
            function formatDate(date) {
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();

                return year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
            }
        });


        function validateNumberInput(input) {
            var regex = /^[0-9]*$/;
            if (!regex.test(input.value)) {
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        }
        $(document).on('keypress', 'form', function(event) {
            return event.keyCode != 13;
        });
    </script>
