@extends('client.layout.pages-layout')
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Giỏ hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
           @if($cart->count() > 0)
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $item)
                                @php
                                    $product = DB::table('product')->where('id', $item->product_id)->first();
                                @endphp
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}">
                                        <h5>{{ $product->name }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                       {{ $product->sell_price }} VNĐ
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <form id="updateCartForm">
                                            <div class="quantity">
                                               <form id="updateCartForm" action="{{ route('updateCart') }}" method="post">
                                                    @csrf
                                                    <div class="pro-qty">
                                                        <input type="hidden" name="id" value="{{ $item->product_id }}">
                                                        <input type="number" name="number_of_item" value="{{ $item->number_of_item }}" onchange="updateQuantity(this)">
                                                    </div>
                                                </form>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{ $product->sell_price * $item->number_of_item }} VNĐ
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="#" onclick="return confirmAction('{{ route('removeFromCart', ['id' => $item->product_id]) }}');" class="icon_close"></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
                <div class="col-md-12 text-center">
                    <h2>Bạn chưa có sản phẩm trong giỏ hàng!</h2>
                    <h5 class="mt-3">Thêm sản phẩm vào giỏ hàng.</h5>
                    <a href="{{ route('shop') }}" class="btn btn-warning mt-5">Mua Ngay</a>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <form id="updateCartForm">
                        <div class="shoping__cart__btns">
                            <a href="{{ route('shop') }}" class="primary-btn cart-btn">TIẾP TỤC MUA SẮM</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Thanh toán </h5>
                        <ul>
                            <li>Phí Ship <span>Free Ship</span></li>
                            <li>Tổng số tiền <span>{{$total}} VNĐ</span></li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Shoping Cart Section End -->
    <script>
        function confirmAction(route) {
            if (confirm("Bạn có chắc muốn xoá sản phẩm này trong giỏ hàng?") == true) {
                text = "Xoá";
                window.location.href = route;
            } else {
                text = "Huỷ!";
                return false; // Prevent the default action
            }
        }

        function updateQuantity(inputField) {
            var formData = new FormData();
            formData.append('id', inputField.closest('form').querySelector('input[name="id"]').value);
            formData.append('number_of_item', inputField.value);

            fetch('{{ route('updateCart') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                // Xử lý dữ liệu phản hồi (nếu cần)
                console.log(data);
            })
            .catch(error => {
                console.error('There was an error!', error);
            });
        }
    </script>
@endsection