<x-navbar></x-navbar>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><a href="{{route('insertProducts')}}" class="btn btn-primary">Thêm</a></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
            <div class="row m-auto filter pt-2">
                <form class="w-100" action="" method="get" id='search-filter'>
                    <div class="row">
                        <div class="col-5">
                            <input type="search" name="keywords" class="form-control" value="{{request()->keywords}}"
                                placeholder="Tìm kiếm đơn vị, đại diện hoặc email">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                        </div>
                        <a class="btn btn-primary ml-auto" href="{{route('guests.index')}}">Tắt bộ lọc</a>
                    </div>
                    <div class="row d-flex justify-contents-center align-items-center mr-auto pt-2">
                        <div class="icon-filter mr-3 ml-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.66667 18C8.66667 17.7348 8.75446 17.4804 8.91074 17.2929C9.06702 17.1054 9.27899 17 9.5 17H14.5C14.721 17 14.933 17.1054 15.0893 17.2929C15.2455 17.4804 15.3333 17.7348 15.3333 18C15.3333 18.2652 15.2455 18.5196 15.0893 18.7071C14.933 18.8946 14.721 19 14.5 19H9.5C9.27899 19 9.06702 18.8946 8.91074 18.7071C8.75446 18.5196 8.66667 18.2652 8.66667 18ZM5.33333 12C5.33333 11.7348 5.42113 11.4804 5.57741 11.2929C5.73369 11.1054 5.94565 11 6.16667 11H17.8333C18.0543 11 18.2663 11.1054 18.4226 11.2929C18.5789 11.4804 18.6667 11.7348 18.6667 12C18.6667 12.2652 18.5789 12.5196 18.4226 12.7071C18.2663 12.8946 18.0543 13 17.8333 13H6.16667C5.94565 13 5.73369 12.8946 5.57741 12.7071C5.42113 12.5196 5.33333 12.2652 5.33333 12ZM2 6C2 5.73478 2.0878 5.48043 2.24408 5.29289C2.40036 5.10536 2.61232 5 2.83333 5H21.1667C21.3877 5 21.5996 5.10536 21.7559 5.29289C21.9122 5.48043 22 5.73478 22 6C22 6.26522 21.9122 6.51957 21.7559 6.70711C21.5996 6.89464 21.3877 7 21.1667 7H2.83333C2.61232 7 2.40036 6.89464 2.24408 6.70711C2.0878 6.51957 2 6.26522 2 6Z"
                                    fill="#555555" />
                            </svg>
                        </div>
                        <div class="filter-results">
                            @foreach ($string as $item)
                            <span class="filter-group">
                                {{ $item['label'] }}:
                                <span class="filter-values">{{ implode(', ', $item['values']) }}</span>
                                <a class="delete-item delete-btn-{{ $item['class'] }}"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 18L6 6" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M18 6L6 18" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </span>
                            @endforeach
                        </div>
                        <div class="filter-options">
                            <div class="dropdown">
                                <button class="ml-2 btn btn-filter" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                                fill="#555555" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                                fill="#555555" />
                                        </svg>
                                        Thêm bộ lọc
                                    </span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <button class="dropdown-item" id="btn-status">Status</button>
                                    <button class="dropdown-item" id="btn-category">Category</button>
                                    <button class="dropdown-item" id="btn-quantity">Số lượng</button>
                                </div>
                            </div>
                            <?php  $status = [];
                        $categoryarr=[];
                      if (isset(request()->status)) {
                        $status= request()->status;
                      }
                      else {
                        $status = [];
                      }
                      if (isset(request()->categoryarr)) {
                        $categoryarr= request()->categoryarr;
                      }
                      else {
                        $categoryarr = [];
                      }
                    ?>
                            <div class="block-options" id="status-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Trạng thái:</h5>
                                    </div>
                                    <div
                                        class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags p-0 m-0 px-2">
                                        <li>
                                            <input type="checkbox" id="status_active" {{ in_array(1, $status)
                                                ? 'checked' : '' }} name="status[]" value="1">
                                            <label for="status_active">Active</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="status_inactive" {{ in_array(0, $status)
                                                ? 'checked' : '' }} name="status[]" value="0">
                                            <label for="status_inactive">Disable</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-status"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                            <div class="block-options" id="category-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Vai trò:</h5>
                                    </div>
                                    <div
                                        class="select-checkbox d-flex justify-contents-center align-items-baseline pb-2 px-2">
                                        <a class="cursor select-all-category mr-auto">Chọn tất cả</a>
                                        <a class="cursor deselect-all-category">Hủy chọn</a>
                                    </div>
                                    <ul class="ks-cboxtags p-0 m-0 px-2">
                                        @if(!empty($categories))
                                        @foreach($categories as $category)
                                        <li>
                                            <input type="checkbox" id="roles_active" {{ in_array($category->id,
                                            $categoryarr) ? 'checked' : '' }}
                                            name="categoryarr[]" value="{{$category->id}}">
                                            <label for="roles_active">{{$category->category_name}}</label>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    <div class="d-flex justify-contents-center align-items-baseline px-2">
                                        <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                        <button type="button" id="cancel-category"
                                            class="btn btn-secondary btn-block">Hủy</button>
                                    </div>
                                </div>
                            </div>
                            <div class="block-options" id="quantity-options" style="display:none">
                                <div class="wrap w-100">
                                    <div class="heading-title py-3 px-2">
                                        <h5>Tồn kho:</h5>
                                    </div>
                                    <div class="input-group pt-2 justify-content-around">
                                        <select class="comparison_operator" name="comparison_operator" style="width: 40%">
                                          <option value=">=">>=</option>
                                          <option value="<="><=</option>
                                        </select>
                                        <input class="w-50 quantity-input" type="number" name="quantity" placeholder="Số lượng">
                                      </div>
                                </div>
                                <div class="d-flex justify-contents-center align-items-baseline px-2">
                                    <button type="submit" class="btn btn-primary btn-block mr-2">Xác Nhận</button>
                                    <button type="button" id="cancel-quantity"
                                        class="btn btn-secondary btn-block">Hủy</button>
                                </div>
                            </div>
                        </div>
                </form>
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
                            <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:7%;">#</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Thương hiệu</th>
                                        <th scope="col">Tồn kho</th>
                                        <th scope="col">Trị trung bình</th>
                                        <th scope="col">Trị tồn kho</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Action</th>
                                        <th scope=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $value)
                                        <tr>
                                            <td scope="row">{{ $value->id }}</td>
                                            <th><a
                                                    href="{{ route('data.show', $value->id) }}">{{ $value->products_code }}</a>
                                            </th>
                                            <td>{{ $value->products_name }}</td>
                                            <td>
                                                <select class="product_category" name="product_category"
                                                    id="{{ $value->id }}">
                                                    @foreach ($category as $va)
                                                        <option value="{{ $va->id }}"
                                                            {{ $va->id == $value->ID_category ? 'selected' : '' }}>
                                                            {{ $va->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>{{ $value->products_trademark }}</td>
                                            <td>
                                                @if ($value->inventory == 0)
                                                    0
                                                @endif
                                                {{ $value->inventory }}
                                            </td>
                                            <td>{{ number_format($value->price_avg) }}</td>
                                            <td>{{ number_format($value->price_inventory) }}</td>
                                            <td class="p-0 text-center">
                                                @if ($value->inventory == 0)
                                                    <div class="py-1 rounded mt-3 pb-1 bg-danger">
                                                        <span class="text-light">Hết hàng</span>
                                                    </div>
                                                @elseif($value->inventory < 5)
                                                    <div class="py-1 rounded mt-3 pb-1 bg-warning">
                                                        <span class="text-light">Gần hết</span>
                                                    </div>
                                                @else
                                                    <div class="py-1 rounded mt-3 pb-1 bg-success">
                                                        <span class="text-light">Sẵn hàng</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="icon">
                                                    <a href="{{ route('data.edit', $value->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" viewBox="0 0 32 32" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                                                fill="#555555" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div id="dropdown_item{{ $value->id }}" data-toggle="collapse"
                                                    data-target="#product-details-<?php echo $value->id; ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                        height="32" viewBox="0 0 32 32" fill="none">
                                                        <rect width="32" height="32" rx="4"
                                                            fill="white" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M22.3582 19.6917C21.9471 20.1028 21.2806 20.1028 20.8695 19.6917L15.9998 14.822L11.1301 19.6917C10.719 20.1028 10.0526 20.1028 9.64148 19.6917C9.2304 19.2806 9.2304 18.6141 9.64148 18.203L15.2555 12.589C15.6666 12.1779 16.3331 12.1779 16.7442 12.589L22.3582 18.203C22.7693 18.6141 22.7693 19.2806 22.3582 19.6917Z"
                                                            fill="#555555" />
                                                    </svg>
                                                </div>
                                            </td>
                                        </tr>
                                        @foreach ($product as $item)
                                            <tr id="product-details-{{ $value->id }}" class="collapse">
                                                @if ($value->id == $item->products_id)
                                                    <td>{{ $value->id }} - {{ $item->id }}</td>
                                                    <td>{{ $value->products_code }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td><p>Loại hàng</p>{{ $item->product_category }}</td>
                                                    <td>{{ $item->product_trademark }}</td>
                                                    <td>{{ $item->product_qty }}</td>
                                                    <td>{{ number_format($item->product_price) }}</td>
                                                    <td>{{ number_format($item->total) }}</td>
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                                    @foreach ($qtySums as $value)
                                    <tr>
                                        <td scope="row">{{ $value->id }}</td>
                                        <th><a href="{{ route('data.show', $value->id) }}">{{ $value->products_code
                                                }}</a>
                                        </th>
                                        <td>{{ $value->products_name }}</td>
                                        <td>
                                            <select class="product_category" name="product_category"
                                                id="{{ $value->id }}">
                                                @foreach ($categories as $va)
                                                <option value="{{ $va->id }}" {{ $va->id == $value->ID_category ?
                                                    'selected' : '' }}>
                                                    {{ $va->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{ $value->products_trademark }}</td>
                                        <td>
                                            @if ($value->qty_sum == 0)
                                            0
                                            @endif
                                            {{ $value->qty_sum }}
                                        </td>
                                        <td>{{ number_format($value->price_avg) }}</td>
                                        <td>{{ number_format($value->total_sum) }}</td>
                                        <td class="p-0 text-center">
                                            @if ($value->qty_sum == 0)
                                            <div class="py-1 rounded mt-3 pb-1 bg-danger">
                                                <span class="text-light">Hết hàng</span>
                                            </div>
                                            @elseif($value->qty_sum < 5) <div class="py-1 rounded mt-3 pb-1 bg-warning">
                                                <span class="text-light">Gần hết</span>
                        </div>
                        @else
                        <div class="py-1 rounded mt-3 pb-1 bg-success">
                            <span class="text-light">Sẵn hàng</span>
                        </div>
                        @endif
                        </td>
                        <td>
                            <div class="icon">
                                <a href="{{ route('data.edit', $value->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                        fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.7832 6.79483C18.987 6.71027 19.2056 6.66675 19.4263 6.66675C19.6471 6.66675 19.8656 6.71027 20.0695 6.79483C20.2734 6.87938 20.4586 7.00331 20.6146 7.15952L21.9607 8.50563C22.1169 8.66165 22.2408 8.84693 22.3253 9.05087C22.4099 9.25482 22.4534 9.47342 22.4534 9.69419C22.4534 9.91495 22.4099 10.1336 22.3253 10.3375C22.2408 10.5414 22.1169 10.7267 21.9607 10.8827L20.2809 12.5626C20.2711 12.5736 20.2609 12.5844 20.2503 12.595C20.2397 12.6056 20.2289 12.6158 20.2178 12.6256L11.5607 21.2827C11.4257 21.4177 11.2426 21.4936 11.0516 21.4936H8.34644C7.94881 21.4936 7.62647 21.1712 7.62647 20.7736V18.0684C7.62647 17.8775 7.70233 17.6943 7.83737 17.5593L16.4889 8.9086C16.5003 8.89532 16.5124 8.88235 16.525 8.86973C16.5376 8.8571 16.5506 8.84504 16.5639 8.83354L18.2381 7.15952C18.394 7.00352 18.5795 6.8793 18.7832 6.79483ZM17.0354 10.3984L9.06641 18.3667V20.0536H10.7534L18.7221 12.085L17.0354 10.3984ZM19.7402 11.0668L18.0537 9.38022L19.2572 8.17685C19.2794 8.15461 19.3057 8.13696 19.3348 8.12493C19.3638 8.11289 19.3949 8.10669 19.4263 8.10669C19.4578 8.10669 19.4889 8.11289 19.5179 8.12493C19.5469 8.13697 19.5737 8.15504 19.5959 8.17728L20.9428 9.52411C20.9651 9.5464 20.9831 9.57315 20.9951 9.60228C21.0072 9.63141 21.0134 9.66264 21.0134 9.69419C21.0134 9.72573 21.0072 9.75696 20.9951 9.78609C20.9831 9.81522 20.9651 9.84197 20.9428 9.86426L19.7402 11.0668ZM6.6665 24.6134C6.6665 24.2158 6.98885 23.8935 7.38648 23.8935H24.6658C25.0634 23.8935 25.3858 24.2158 25.3858 24.6134C25.3858 25.0111 25.0634 25.3334 24.6658 25.3334H7.38648C6.98885 25.3334 6.6665 25.0111 6.6665 24.6134Z"
                                            fill="#555555" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                        <td>
                            <div id="dropdown_item{{ $value->id }}" data-toggle="collapse"
                                data-target="#product-details-<?php echo $value->id; ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"
                                    fill="none">
                                    <rect width="32" height="32" rx="4" fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M22.3582 19.6917C21.9471 20.1028 21.2806 20.1028 20.8695 19.6917L15.9998 14.822L11.1301 19.6917C10.719 20.1028 10.0526 20.1028 9.64148 19.6917C9.2304 19.2806 9.2304 18.6141 9.64148 18.203L15.2555 12.589C15.6666 12.1779 16.3331 12.1779 16.7442 12.589L22.3582 18.203C22.7693 18.6141 22.7693 19.2806 22.3582 19.6917Z"
                                        fill="#555555" />
                                </svg>
                            </div>
                        </td>
                        </tr>
                        @foreach ($product as $item)
                        <tr id="product-details-{{ $value->id }}" class="collapse">
                            @if ($value->id == $item->products_id)
                            <td>{{ $item->id }}</td>
                            <td>{{ $value->products_code }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->product_category }}</td>
                            <td>{{ $item->product_trademark }}</td>
                            <td>{{ $item->product_qty }}</td>
                            <td>{{ number_format($item->product_price) }}</td>
                            <td>{{ number_format($item->total) }}</td>
                            <td></td>
                            <td></td>
                            @endif
                        </tr>
                        @endforeach
                        {{-- <tr id="sub_product_1"></tr> --}}
                        @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script>
    $('.product_category').change(function() {
        var product_id = $(this).attr('id');
        var category_id = $(this).val();
        var newRow = $('<tr>');
        newRow.attr('id', 'newRow');
        $('#example2').append(newRow);
        $.ajax({
            url: "{{ route('ajax') }}",
            type: "get",
            data: {
                product_id: product_id,
                category_id: category_id
            },
            success: function(data) {
                alert('Thay đổi thành công');
            }
        });
    })
   
    //xóa tất cả thẻ tr rỗng
    const rows = document.querySelectorAll('tr');
    rows.forEach(row => {
        if (row.innerHTML.trim() === '') {
            row.remove();
        }
    });
    let count = 1;
    let btn_menu = document.getElementById("dropdown_item1");
    btn_menu.addEventListener("click", function() {
        if (count === 1) {
            document.getElementById("dropdown_item1").style.transform = "rotate(180deg)";
            count++;
        } else {
            document.getElementById("dropdown_item1").style.transform = "rotate(0deg)";
            count = 1;
        }
    });

    $('#btn-status').click(function(event) {
    event.preventDefault();
    $('#status-options').toggle();
    $('#category-options').hide();

});

$('#btn-quantity').click(function(event) {
    event.preventDefault();
    $('#quantity-options').toggle();
    $('#status-options').hide();
});
$('#cancel-quantity').click(function(event) {
    event.preventDefault();
    $('#quantity-options').hide();
});

$('#btn-category').click(function(event) {
    event.preventDefault();
    $('#category-options').toggle();
    $('#status-options').hide();
});
$('#cancel-status').click(function(event) {
    event.preventDefault();
    $('#status-options').hide();
});
$('#cancel-category').click(function(event) {
    event.preventDefault();
    $('#category-options').hide();
});
$(document).ready(function() {
  // Chọn tất cả các checkbox
  $('.select-all-category').click(function() {
    $('#category-options input[type="checkbox"]').prop('checked', true);
  });

  // Hủy tất cả các checkbox
  $('.deselect-all-category').click(function() {
    $('#category-options input[type="checkbox"]').prop('checked', false);
  });
});
$(document).ready(function() {
  // Chọn tất cả các checkbox
  $('.select-all').click(function() {
    $('#status-options input[type="checkbox"]').prop('checked', true);
  });

  // Hủy tất cả các checkbox
  $('.deselect-all').click(function() {
    $('#status-options input[type="checkbox"]').prop('checked', false);
  });
});

$(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-status', function() {
            $('.deselect-all').click();
            document.getElementById('search-filter').submit();
        });
    });
    $(document).ready(function() {
        $('.filter-results').on('click', '.delete-btn-category', function() {
            $('.deselect-all-category').click();
            document.getElementById('search-filter').submit();
        });
    });
</script>
</body>

</html>