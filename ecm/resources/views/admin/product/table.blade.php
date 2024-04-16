@extends('layouts.user_type.auth')

@section('content')
<div class="modal fade" id="fullScreenModal" tabindex="-1" aria-labelledby="fullScreenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bolder mb-0">
                    Quản lý chi tiết</h5>
                <p class="mb-0 text-sm"></p>
            </div>
            <div class="modal-body">
                <p class="mb-0 text"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
{{-- Full screen modal --}}

<!-- Modal Create-->
<div class="modal fade" id="createDataModal" tabindex="-1" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{  url('/admin/products/store')}}" method="POST">
                {!! csrf_field() !!}

                <div class="modal-header">
                    <h5 class="font-weight-bolder mb-0">Thêm mới</h5>
                    <p class="mb-0 text-sm"></p>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>

                    <div class="mb-3">
                        <label for="sell_price" class="form-label">Giá bán</label>
                        <input type="text" class="form-control" id="sell_price" name="sell_price">
                    </div>

                    <div class="mb-3">
                        <label for="stock_quentity" class="form-label">Số lượng tồn</label>
                        <input type="text" class="form-control" id="stock_quentity" name="stock_quentity">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">--Trống--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="original_price" class="form-label">Giá gốc</label>
                        <input type="text" class="form-control" id="original_price" name="original_price">
                    </div>

                    <div class="mb-3">
                        <label for="discount_price" class="form-label">Giá giảm</label>
                        <input type="text" class="form-control" id="discount_price" name="discount_price">
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_url" class="form-label">URL ảnh đại diện</label>
                        <input type="text" class="form-control" id="thumbnail_url" name="thumbnail_url">
                    </div>

                    <div class="mb-3">
                        <label for="detail_info" class="form-label">Thông tin chi tiết</label>
                        <input type="text" class="form-control" id="detail_info" name="detail_info">
                    </div>

                    <div class="mb-3">
                        <label for="created_at" class="form-label">Ngày tạo</label>
                        <input type="text" class="form-control" id="created_at" name="created_at">
                    </div>

                    <div class="mb-3">
                        <label for="updated_at" class="form-label">Ngày cập nhật</label>
                        <input type="text" class="form-control" id="updated_at" name="updated_at">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Create-->

<!-- Modal Update -->
<div class="modal fade" id="updateDataModal" tabindex="-1" aria-labelledby="updateDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="updateForm" action="{{ url('admin/products/store') }}" method="POST">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <h5 class="font-weight-bolder mb-0">Chỉnh sửa thông tin</h5>
                    <p class="mb-0 text-sm"></p>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="update_form_id" name="id">

                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="update_form_name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <input type="text" class="form-control" id="update_form_description" name="description">
                    </div>

                    <div class="mb-3">
                        <label for="sell_price" class="form-label">Giá bán</label>
                        <input type="text" class="form-control" id="update_form_sell_price" name="sell_price">
                    </div>

                    <div class="mb-3">
                        <label for="stock_quentity" class="form-label">Số lượng tồn</label>
                        <input type="text" class="form-control" id="update_form_stock_quentity" name="stock_quentity">
                    </div>

                    <div class="mb-3">
                           <label for="update_form_category_id" class="form-label">Danh mục</label>
                        <select class="form-select" id="update_form_category_id" name="category_id">
                            <option value="">--Trống--</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="original_price" class="form-label">Giá gốc</label>
                        <input type="text" class="form-control" id="update_form_original_price" name="original_price">
                    </div>

                    <div class="mb-3">
                        <label for="discount_price" class="form-label">Giá giảm</label>
                        <input type="text" class="form-control" id="update_form_discount_price" name="discount_price">
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_url" class="form-label">URL ảnh đại diện</label>
                        <input type="text" class="form-control" id="update_form_thumbnail_url" name="thumbnail_url">
                    </div>

                    <div class="mb-3">
                        <label for="detail_info" class="form-label">Thông tin chi tiết</label>
                        <input type="text" class="form-control" id="update_form_detail_info" name="detail_info">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Update -->

<!-- Confirm Delete -->
<div class="modal fade" id="deleteDataModal" tabindex="-1" aria-labelledby="deleteDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bolder mb-0">Xác nhận xóa thông tin</h5>
                <p class="mb-0 text-sm"></p>
            </div>
            <div class="modal-body">
                <p class="mb-0 text">Dữ liệu sau khi xóa sẽ không được phục hồi</p>
                <input type="hidden" id="delete_form_id" name="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="confirmDelete()">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirm Delete -->



<div class="modal fade" id="formExcel" tabindex="-1" aria-labelledby="formExcelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bolder mb-0">Tải từ file</h5>
                <p class="mb-0 text-sm"></p>
            </div>
            <div class="modal-body">
                <form action="/admin/products/upload-excel" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="excel_file">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                        <h5> {{ $error }}</h5>
                        @endforeach
                    </div>
                    @endif
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Danh sách
                            </h5>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Tìm kiếm" onkeypress="search(event)" value="{{ $searchQuery }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex ">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#createDataModal">
                                            Thêm
                                        </button>
                                    </div>

                                    <div class="col">
                                        <button type="button" class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#formExcel">
                                            Excel
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class=" d-flex align-item-center justify-content-end">
                                <div class="pagination">
                                    <button onclick="goToPreviousPage({{ $page }})" class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">‹</button>
                                    <span class="text-xs font-weight-bold mb-0">Trang: {{ $page }} /
                                        {{ $totalPages }}</span>
                                    <button onclick="goToNextPage({{ $page }},   {{ $totalPages }})" class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">›</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Thứ tự
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tên
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mô tả
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giá bán
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số lượng tồn
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID Danh mục
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giá gốc
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giá giảm
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        URL ảnh đại diện
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Thông tin chi tiết
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hành động
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($listItem->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn.dribbble.com%2Fusers%2F761451%2Fscreenshots%2F2936225%2F404_error_page.jpg%3Fcompress%3D1%26resize%3D600x450&f=1&nofb=1&ipt=14d500fde399814a48606532bd307e0df97a674679a541721adf9048ef03b516&ipo=images" alt="">
                                    </td>
                                </tr>
                                @else
                                @foreach ($listItem as $index => $item)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">STT.{{ $index + 1 }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->description }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->sell_price }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->stock_quentity }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->category_id }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->original_price }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->discount_price }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->thumbnail_url }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->detail_info }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->created_at }}</p>
                                    </td>

                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->updated_at }}</p>
                                    </td>


                                    <td class="text-center">
                                        <span class="mx-1" onclick="handleUpdateData({{ json_encode($item) }})" data-bs-toggle="modal" data-bs-target="#updateDataModal" data-bs-original-title="Chỉnh sửa thông tin">
                                            <i class="fas fa-edit text-secondary">
                                            </i>
                                        </span>
                                        <span>
                                            <span onclick="handleDeleteData({{ json_encode($item) }})" class="mx-1" data-bs-toggle="modal" data-bs-target="#deleteDataModal" data-bs-original-title="Xóa thông tin">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                        </span>
                                        <span>
                                         <a href="{{ route('product_reviews.filter', ['id' => $item->id]) }}"><i class="fas fa-eye"></i></a>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle update
    function handleUpdateData(item) {
        setTimeout(() => {
            document.getElementById('update_form_id').value = item.id;
            document.getElementById('update_form_name').value = item.name;
            document.getElementById('update_form_description').value = item.description;
            document.getElementById('update_form_sell_price').value = item.sell_price;
            document.getElementById('update_form_stock_quentity').value = item.stock_quentity;
            document.getElementById('update_form_category_id').value = item.category_id;
            document.getElementById('update_form_original_price').value = item.original_price;
            document.getElementById('update_form_discount_price').value = item.discount_price;
            document.getElementById('update_form_thumbnail_url').value = item.thumbnail_url;
            document.getElementById('update_form_detail_info').value = item.detail_info;
            document.getElementById('update_form_created_at').value = item.created_at;
            document.getElementById('update_form_updated_at').value = item.updated_at;

        }, 200);
    }

    function handleDeleteData(item) {
        setTimeout(() => {
            document.getElementById('delete_form_id').value = item.id;
        }, 200);
    }

    function confirmDelete() {
        window.location.href = "/admin/products/delete/" + document.getElementById('delete_form_id').value;
    }

    function goToPreviousPage(currentPage) {
        if (currentPage > 1) {
            window.location.href = "{{ route('products.filter') }}?page=" + (currentPage - 1) +
                "&size={{ $perPage }}&s={{ $searchQuery }}";
        }
    }

    function goToNextPage(currentPage, totalPages) {
        if (currentPage < totalPages) {
            window.location.href = "{{ route('products.filter') }}?page=" + (currentPage + 1) +
                "&size={{ $perPage }}&s={{ $searchQuery }}";
        }
    }

    function search(query) {
        if (query.target.value) {
            let url = "{{ route('products.filter') }}";
            let queryParams = new URLSearchParams(window.location.search);
            queryParams.set('s', query.target.value);
            queryParams.delete('page');
            window.location.href = url + '?' + queryParams.toString();
        } else {
            window.location.href = "{{ route('products.filter') }}";
        }
    }
</script>
@endsection