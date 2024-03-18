@extends('client.layout.pages-layout')
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thanh toán</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="checkout__order">
                        <h4>ĐƠN HÀNG CỦA BẠN</h4>
                        <div class="checkout__order__products">Sản Phẩm <span>Tiền</span></div>
                            <form action="{{ route('paypal') }}" method="POST">
                                @csrf
                                @foreach($cart as $item)
                                    @php
                                        $product = DB::table('product')->where('id', $item->product_id)->first();
                                        $subtotal = $product->sell_price * $item->number_of_item;
                                    @endphp
                                    <ul>
                                        <li>{{ $product->name }}<span>{{ $subtotal }} VNĐ</span></li>
                                    </ul>
                                @endforeach
                                <div class="checkout__order__address">Địa Chỉ <span>Số điện thoại</span></div>
                                <ul>
                                    <li>Thành Phố Thủ Đức <span>09837763674</span></li>
                                </ul>
                                <div class="checkout__order__subtotal">Phí Ship <span>Free Ship</span></div>
                                <div class="checkout__order__total">Tổng cộng <span>{{ $total }} VNĐ</span></div>
                                <input type="hidden" name="total" value="{{ $total }} ">
                                <button type="submit" class="site-btn">THANH TOÁN PAYPAL</button>
                            </form>
                    </div>
                </div>
             </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection