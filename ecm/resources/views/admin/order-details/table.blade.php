@extends('layouts.user_type.auth')

@section('content')
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
                            <div class="row">   
                                    
`                                <div class=" col col-auto icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                                   <a href="/admin/orders"><</a>  
                                </div>
    <div class="col">

                                <h5 class="mb-0">
                                    Danh sach chi tiết đơn hàng
                                </h5>
    </div>

                            </div>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center">
                        <div class="col-md-4">
                            <div class="input-group">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex ">
                                <div class="row">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                                        Ảnh sản phẩm
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giá bán
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số lượng
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày
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
                                        <img src="{{ $item->thumbnail_url }}" class="avatar avatar-sm me-3">
                                    </td>

                                          <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->sell_price }}</p>
                                    </td>
                                          <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">1</p>
                                    </td>
                                        <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $item->created_at }}</p>
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

@endsection

