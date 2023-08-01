{{-- <!DOCTYPE html>
<html>
<head>
    <title>Danh sách các tệp backup</title>
</head>
<body>
    <h1>Danh sách các tệp backup</h1>

    @if (count($files) > 0)
    <ul>
        @foreach ($files as $file)
            <li>
                {{ $file }}
                <a href="{{ route('downloadBackup', ['file' => $file]) }}" download>Tải xuống</a>
            </li>
        @endforeach
    </ul>
@else
    <p>Không có tệp backup nào.</p>
@endif
</body>
</html> --}}

<x-navbar :title="$title"></x-navbar>
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluided">
            <div class="row mb-4">
                <a href="{{ route('exportDatabase') }}" class="ml-auto mr-2">
                    <button type="button" class="custom-btn btn btn-primary d-flex align-items-center h-100 mr-2">
                        <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 6C12.3879 6 12.7024 6.31446 12.7024 6.70237L12.7024 17.2976C12.7024 17.6855 12.3879 18 12 18C11.6121 18 11.2976 17.6855 11.2976 17.2976V6.70237C11.2976 6.31446 11.6121 6 12 6Z"
                                fill="#ffff" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18 12C18 12.3879 17.6855 12.7024 17.2976 12.7024H6.70237C6.31446 12.7024 6 12.3879 6 12C6 11.6121 6.31446 11.2976 6.70237 11.2976H17.2976C17.6855 11.2976 18 11.6121 18 12Z"
                                fill="#ffff" />
                        </svg>
                        <span>Tạo bản sao lưu</span>
                    </button>
                </a>
                <form action="{{ route('importDatabase') }}" enctype="multipart/form-data" method="POST"
                    id="restore_data" class="btn btn-default d-flex align-items-center h-100 custom-btn">
                    @csrf
                    <label class="btn-file mb-0 wf-500" style="color:#0095F6; font-weight : 500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" class="mr-1">
                            <path
                                d="M6.78565 11.9915C7.26909 11.9915 7.71035 11.9915 8.1516 11.9915C8.23486 11.9915 8.31812 11.9899 8.40082 11.9926C8.5923 11.9987 8.72995 12.0903 8.80599 12.2657C8.88425 12.445 8.84429 12.6071 8.71108 12.7425C8.40082 13.0589 8.08666 13.3713 7.77362 13.6855C7.28519 14.1762 6.79731 14.6679 6.30721 15.1569C6.03135 15.4322 5.81489 15.4322 5.54125 15.158C4.75809 14.3737 3.97771 13.5873 3.19344 12.8047C3.03969 12.6509 2.94423 12.4861 3.03581 12.2679C3.13016 12.0431 3.31666 11.9871 3.54367 11.9899C4.02822 11.996 4.51221 11.9915 5.01619 11.9915C5.03173 11.7812 5.04227 11.5769 5.0617 11.3732C5.33145 8.55805 6.6752 6.39617 9.13957 5.02744C14.0156 2.31941 19.6492 5.27333 20.8021 10.2814C21.7784 14.5225 19.0442 18.8202 14.7788 19.7643C12.3693 20.2977 10.1664 19.8015 8.1838 18.3334C7.74531 18.0087 7.65762 17.4681 7.964 17.0546C8.26983 16.6422 8.80821 16.5761 9.25003 16.9114C10.4556 17.825 11.811 18.2396 13.3223 18.1885C16.042 18.0969 18.502 16.0228 19.0726 13.3219C19.8113 9.82465 17.4652 6.4217 13.9246 5.85334C10.641 5.32605 7.4134 7.66055 6.89777 10.9414C6.84504 11.28 6.8245 11.6241 6.78565 11.9915Z"
                                fill="#0095F6" />
                            <path
                                d="M12.129 10.7643C12.129 10.2315 12.1274 9.69806 12.1296 9.16522C12.1312 8.74062 12.406 8.44811 12.7945 8.44922C13.183 8.45033 13.4567 8.74339 13.4578 9.17022C13.4606 10.091 13.4617 11.0118 13.4556 11.9326C13.4545 12.0675 13.4955 12.143 13.6132 12.2118C14.4075 12.6758 15.1973 13.1476 15.9876 13.6183C16.238 13.7676 16.3568 13.9952 16.3246 14.281C16.2935 14.5602 16.1342 14.7733 15.8572 14.8244C15.6868 14.8555 15.4692 14.8433 15.3238 14.7606C14.398 14.2344 13.485 13.6855 12.5714 13.1382C12.2767 12.9611 12.1279 12.6925 12.129 12.3434C12.1301 11.8166 12.129 11.2905 12.129 10.7643Z"
                                fill="#0095F6" />
                        </svg>
                        Khôi phục<input type="file" style="display: none;" id="file_restore" accept=".sql"
                            name="file">
                    </label>
                </form>
            </div>
        </div><!-- /.container-fluided -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-hover">
                            <thead>
                                <tr>
                                    <input type="hidden" id="perPageinput" name="perPageinput"
                                        value="{{ request()->perPageinput ?? 10 }}">
                                    <input type="hidden" id="sortByInput" name="sort-by" value="id">
                                    {{-- <input type="hidden" id="sortTypeInput" name="sort-type"
                                        value="{{ $sortType }}"> --}}
                                    <th>Tên file</th>
                                    <th>Ngày tạo</th>
                                    <th>Kích cỡ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (count($files) > 0)
                                <tbody>
                                    @foreach ($files as $file)
                                        <tr>
                                            <td> {{ $file }}</td>
                                            <td>{{ date('d-m-Y H:i:s', filectime(storage_path('app/backupdata/' . $file))) }}
                                            </td>
                                            <td>{{ round(filesize(storage_path('app/backupdata/' . $file)) / 1024, 2) }}
                                                KB</td>
                                            <td class="d-flex align-items-baseline"><a
                                                    href="{{ route('downloadBackup', ['file' => $file]) }}"
                                                    download><svg width="32" height="32" viewBox="0 0 32 32"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M20.0004 10.4023H22.0002C22.5306 10.4023 23.0392 10.613 23.4143 10.9881C23.7893 11.3631 24 11.8718 24 12.4021V22.8024C24 23.3328 23.7893 23.8414 23.4143 24.2165C23.0392 24.5915 22.5306 24.8022 22.0002 24.8022H9.99982C9.46943 24.8022 8.96077 24.5915 8.58573 24.2165C8.21069 23.8414 8 23.3328 8 22.8024V12.4021C8 11.8718 8.21069 11.3631 8.58573 10.9881C8.96077 10.613 9.46943 10.4023 9.99982 10.4023H11.9996"
                                                            stroke="#555555" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M11.9996 15.1992L15.9993 19.1988L20.0004 15.1992"
                                                            stroke="#555555" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M16.0007 4V18.3999" stroke="#555555"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </a>

                                                <form onclick="return confirm('Bạn có chắc chắn muốn xoá !!')"
                                                    action="{{ route('deleteBackup', ['file' => $file]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn ml-1 btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                            height="32" viewBox="0 0 32 32" fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M14.0606 6.66675C13.6589 6.66675 13.3333 6.99236 13.3333 7.39402C13.3333 7.79568 13.6589 8.12129 14.0606 8.12129H17.9394C18.341 8.12129 18.6667 7.79568 18.6667 7.39402C18.6667 6.99236 18.341 6.66675 17.9394 6.66675H14.0606ZM8 10.3031C8 9.90143 8.32561 9.57582 8.72727 9.57582H10.1818H21.8182H23.2727C23.6744 9.57582 24 9.90143 24 10.3031C24 10.7048 23.6744 11.0304 23.2727 11.0304H22.5455V22.6667C22.5455 24.2819 21.2158 25.5758 19.6179 25.5758H12.3452C11.9637 25.5755 11.5854 25.4997 11.2333 25.3528C10.8812 25.2059 10.5617 24.9908 10.2931 24.7199C10.0244 24.449 9.81206 24.1276 9.66816 23.7743C9.52463 23.4219 9.45204 23.0447 9.45455 22.6642V11.0304H8.72727C8.32561 11.0304 8 10.7048 8 10.3031ZM10.9091 22.6723V11.0304H21.0909V22.6667C21.0909 23.4623 20.4288 24.1213 19.6179 24.1213H12.3458C12.1562 24.1211 11.9684 24.0834 11.7934 24.0104C11.6183 23.9374 11.4595 23.8304 11.3259 23.6958C11.1924 23.5611 11.0868 23.4013 11.0153 23.2257C10.9437 23.05 10.9076 22.8619 10.9091 22.6723ZM17.9394 13.4546C18.3411 13.4546 18.6667 13.7802 18.6667 14.1819V20.9698C18.6667 21.3714 18.3411 21.6971 17.9394 21.6971C17.5377 21.6971 17.2121 21.3714 17.2121 20.9698V14.1819C17.2121 13.7802 17.5377 13.4546 17.9394 13.4546ZM14.7879 14.1819C14.7879 13.7802 14.4623 13.4546 14.0606 13.4546C13.6589 13.4546 13.3333 13.7802 13.3333 14.1819V20.9698C13.3333 21.3714 13.6589 21.6971 14.0606 21.6971C14.4623 21.6971 14.7879 21.3714 14.7879 20.9698V14.1819Z"
                                                                fill="#555555"></path>
                                                        </svg></button>
                                                </form>
                                            </td>
                                    @endforeach
                                    </tr>
                                </tbody>
                            @else
                                <tfoot>
                                    <td>
                                        Không có tệp backup nào
                                    </td>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
</div>
</section>
</div>
<script>
        $(document).on('change','#file_restore',function(e){
            e.preventDefault();
            $('#restore_data')[0].submit();
        })
</script>
</body>

</html>
