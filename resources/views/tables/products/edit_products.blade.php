<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="breadcrumb">
        <span>Sản phẩm</span>
        <span>/</span>
        <span><b>Chỉnh sửa sản phẩm</b></span>
    </div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-2">
            </div>
        </div><!-- /.container-fluided -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('data.update', $products->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row details-products">
                        <div class="col-md-2">
                            <div class="title-edit">Hình ảnh sản phẩm</div>
                            {{-- <img src="{{ asset('dist/img') }}/{{ $products->products_image }}" alt="">
                            <input type="file" value="" name="products_img"> --}}
                            <div class="file-upload">
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" name="products_img" type='file' value=""
                                        onchange="readURL(this);" accept="image/*" />
                                    <div class="drag-text">
                                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M26.334 2.66675C26.8863 2.66675 27.334 3.11446 27.334 3.66675V9.00008C27.334 9.55237 26.8863 10.0001 26.334 10.0001C25.7817 10.0001 25.334 9.55237 25.334 9.00008V3.66675C25.334 3.11446 25.7817 2.66675 26.334 2.66675Z"
                                                fill="#1D1C20" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M22.667 6.3335C22.667 5.78121 23.1147 5.3335 23.667 5.3335H29.0003C29.5526 5.3335 30.0003 5.78121 30.0003 6.3335C30.0003 6.88578 29.5526 7.3335 29.0003 7.3335H23.667C23.1147 7.3335 22.667 6.88578 22.667 6.3335Z"
                                                fill="#1D1C20" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.66699 9.00016C2.66699 6.97454 4.30804 5.3335 6.33366 5.3335H18.3337C18.8859 5.3335 19.3337 5.78121 19.3337 6.3335C19.3337 6.88578 18.8859 7.3335 18.3337 7.3335H6.33366C5.41261 7.3335 4.66699 8.07911 4.66699 9.00016V25.0002C4.66699 25.9212 5.41261 26.6668 6.33366 26.6668H23.667C24.588 26.6668 25.3337 25.9212 25.3337 25.0002V14.3335C25.3337 13.7812 25.7814 13.3335 26.3337 13.3335C26.8859 13.3335 27.3337 13.7812 27.3337 14.3335V25.0002C27.3337 27.0258 25.6926 28.6668 23.667 28.6668H6.33366C4.30804 28.6668 2.66699 27.0258 2.66699 25.0002V9.00016Z"
                                                fill="#1D1C20" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M17.4948 14.3081C17.3628 14.0695 17.0166 14.082 16.9015 14.3269L15.3987 17.5205C15.2578 17.82 14.9778 18.0303 14.6509 18.0823C14.324 18.1343 13.9926 18.0212 13.7657 17.7801L12.3324 16.2575C12.1834 16.0992 11.9243 16.1236 11.8076 16.3083C11.8076 16.3083 11.8077 16.3082 11.8076 16.3083L9.80248 19.4893C9.66248 19.7113 9.82099 20.0001 10.0845 20.0001H20.0739C20.3276 20.0001 20.4887 19.7274 20.3666 19.505L17.4948 14.3081ZM15.0917 13.4756C15.902 11.7527 18.3236 11.6747 19.2449 13.34L22.1171 18.5377C22.9757 20.0939 21.8493 22.0001 20.0739 22.0001H10.0845C8.24679 22.0001 7.13076 19.9768 8.11056 18.4228C8.11052 18.4229 8.1106 18.4228 8.11056 18.4228L10.1159 15.2415C10.9299 13.9516 12.743 13.7757 13.7887 14.8866C13.7886 14.8866 13.7887 14.8866 13.7887 14.8866L14.2147 15.3393L15.0917 13.4756C15.0917 13.4755 15.0917 13.4757 15.0917 13.4756Z"
                                                fill="#1D1C20" />
                                        </svg>
                                        @if(Auth::user()->can('view-provides'))
                                        <h3>Upload</h3>
                                        @endif
                                    </div>
                                </div>
                                <input class="url-img" type="hidden" value="{{ asset('dist/img') }}/">
                                <div class="file-upload-content">
                                    <img class="file-upload-image"
                                        src="{{ asset('dist/img') }}/{{ $products->products_image }}"
                                        alt="your image" />
                                    <div class="image-title-wrap">
                                        @if(Auth::user()->can('view-provides'))
                                        <button type="button" onclick="removeUpload()"
                                            class="remove-image btn btn-danger">Remove</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="title-edit">Thông tin sản phẩm</div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product_name">
                                        <div class="title-edit-item">Tên sản phẩm</div>
                                        <input type="text" name="products_name" value="{{ $products->products_name }}"
                                            @if(!Auth::user()->can('view-provides')) readonly @endif class="form-control
                                        mb-4">
                                    </div>
                                    <div class="product_code">
                                        <div class="title-edit-item">Mã sản phẩm</div>
                                        <input type="text" name="products_code" value="{{ $products->products_code }}"
                                            @if(!Auth::user()->can('view-provides')) readonly @endif class="form-control
                                        mb-4">
                                    </div>
                                    <!-- <div class="product_id">
                                            <div class="title-edit-item">ID</div>
                                            <input type="text" name="products_id" value="{{ $products->id }}"
                                                readonly style="background: #D6D6D6;" class="form-control mb-4">
                                        </div> -->
                                </div>
                                <div class="col-md-3">
                                    <div class="product_category">
                                        <div class="title-edit-item">Danh mục</div>
                                        <input required type="text" name="product_category"
                                            @if(!Auth::user()->can('view-provides')) readonly @endif class="form-control
                                        mb-4" value="{{$products->ID_category}}">
                                    </div>
                                    <div class="product_trademark">
                                        <div class="title-edit-item">Thương hiệu</div>
                                        <input type="text" name="products_trademark"
                                            value="{{ $products->products_trademark }}"
                                            @if(!Auth::user()->can('view-provides')) readonly @endif class="form-control
                                        mb-4">
                                    </div>
                                    <!-- <div class="product_unit">
                                            <div class="title-edit-item">Đơn vị</div>
                                            <input type="text" name="products_unit"
                                                value="" class="form-control mb-4">
                                        </div> -->
                                </div>
                                <div class="col-md-6">
                                    <div class="title-edit-item">Mô tả</div>
                                    <textarea name="products_description" id=""
                                        @if(!Auth::user()->can('view-provides')) readonly @endif placeholder="Nhập mô tả của sản phẩm" cols="30"
                                            rows="8" class="form-control">{{ $products->products_description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    </table>
                    <div class="btn-fixed">
                        @if(Auth::user()->can('view-provides'))
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        @endif
                        <a href="{{ asset('./data') }}" class="btn btn-default">Hủy</a>
                    </div>


                </form>
                <div class="title-edit">Chủng loại sản phẩm</div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sản phẩm / Sửa sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Thông tin hóa đơn</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Loại hàng</th>
                                    <th>ĐVT</th>
                                    <th>Số lượng</th>
                                    <th>Đang giao dịch</th>
                                    <th>Giá nhập</th>
                                    <th>Thuế</th>
                                    <th>Tổng tiền</th>
                                    <th>Ghi chú</th>
                                    <th>S/N</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0; ?>
                                @foreach ($listProduct as $va)
                                <tr>
                                    <td>{{ $va->id }}</td>
                                    <td>{{ $va->getNameProducts->products_code }}</td>
                                    <td>{{ $va->product_name }}</td>
                                    <td>Nhà cung cấp</td>
                                    <td>{{ $va->product_category }}</td>
                                    <td>{{ $va->product_unit }}</td>
                                    <td>{{ $va->product_qty }}</td>
                                    <td>DGD</td>
                                    <td>{{ $va->product_price }}</td>
                                    <td>{{ $va->tax }}</td>
                                    <td>{{ $va->total }}</td>
                                    <td>{{ $va->product_trademark }}</td>
                                    <td>
                                        <button class="exampleModal" name="btn_add_SN[]" type="button"
                                            data-toggle="modal" data-target="#exampleModal{{$stt}}"
                                            style="background: transparent; border:none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                viewBox="0 0 32 32" fill="none">
                                                <rect width="32" height="32" rx="4" fill="white"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9062 10.643C11.9062 10.2092 12.258 9.85742 12.6919 9.85742H24.2189C24.6528 9.85742 25.0045 10.2092 25.0045 10.643C25.0045 11.0769 24.6528 11.4286 24.2189 11.4286H12.6919C12.258 11.4286 11.9062 11.0769 11.9062 10.643Z"
                                                    fill="#0095F6"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9062 16.4707C11.9062 16.0368 12.258 15.6851 12.6919 15.6851H24.2189C24.6528 15.6851 25.0045 16.0368 25.0045 16.4707C25.0045 16.9045 24.6528 17.2563 24.2189 17.2563H12.6919C12.258 17.2563 11.9062 16.9045 11.9062 16.4707Z"
                                                    fill="#0095F6"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9062 22.2978C11.9062 21.8639 12.258 21.5122 12.6919 21.5122H24.2189C24.6528 21.5122 25.0045 21.8639 25.0045 22.2978C25.0045 22.7317 24.6528 23.0834 24.2189 23.0834H12.6919C12.258 23.0834 11.9062 22.7317 11.9062 22.2978Z"
                                                    fill="#0095F6"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6.6665 10.6431C6.6665 9.91981 7.25282 9.3335 7.97607 9.3335C8.69932 9.3335 9.28563 9.91981 9.28563 10.6431C9.28563 11.3663 8.69932 11.9526 7.97607 11.9526C7.25282 11.9526 6.6665 11.3663 6.6665 10.6431ZM6.6665 16.4705C6.6665 15.7473 7.25282 15.161 7.97607 15.161C8.69932 15.161 9.28563 15.7473 9.28563 16.4705C9.28563 17.1938 8.69932 17.7801 7.97607 17.7801C7.25282 17.7801 6.6665 17.1938 6.6665 16.4705ZM7.97607 20.9884C7.25282 20.9884 6.6665 21.5747 6.6665 22.298C6.6665 23.0212 7.25282 23.6075 7.97607 23.6075C8.69932 23.6075 9.28563 23.0212 9.28563 22.298C9.28563 21.5747 8.69932 20.9884 7.97607 20.9884Z"
                                                    fill="#0095F6"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <?php $stt++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="list_modal">
                            <?php $st = 0; ?>
                            @foreach ($listProduct as $va)
                            <div class="modal fade" id="exampleModal{{$st}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-modal="true" style="padding-right: 8px;">'
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header align-items-center">
                                            <div>
                                                <h5 class="modal-title" id="exampleModalLabel">Serial Number</h5>
                                                <p>Thông tin chi tiết về số S/N của mỗi sản phẩm </p>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Thông tin Serial Number </h3>
                                            <div class="div_value0">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td style="width:2%;"><input type="checkbox"></td>
                                                            <td style="width:5%;"><span>STT</span></td>
                                                            <td><span>Serial Number</span></td>
                                                            <td style="width:3%;"></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input type="checkbox" id="checkbox_0"></td>
                                                            <td><span class="stt_SN">{{$st}}</span></td>
                                                            <td><input type="text" value="{{$va->serinumber}}"></td>
                                                            <td></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $st++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="paginator mt-4 d-flex justify-content-end">
                    {{ $listProduct->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function handleExistingImage() {
    if ($('.file-upload-image').attr('src') != $('.url-img').val()) {
        $('.image-upload-wrap').hide();
        $('.file-upload-content').show();
    }
}
$(document).ready(function() {
    handleExistingImage();
});

$('.file-upload-image').on('load', function() {
    handleExistingImage();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.image-upload-wrap').hide();
            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        removeUpload();
    }
}

function removeUpload() {
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
    $('.file-upload-image').removeAttr('src');
}
$('.image-upload-wrap').bind('dragover', function() {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function() {
    $('.image-upload-wrap').removeClass('image-dropping');
});
</script>
</body>

</html>