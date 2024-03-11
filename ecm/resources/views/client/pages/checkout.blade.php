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
                        <ul>
                            <li>Vegetable’s Package <span>$75.99</span></li>
                            <li>Fresh Vegetable <span>$151.99</span></li>
                            <li>Organic Bananas <span>$53.99</span></li>
                        </ul>
                        <div class="checkout__order__address">Địa Chỉ <span>Số điện thoại</span></div>
                        <ul>
                            <li>Thành Phố Thủ Đức <span>09837763674</span></li>
                        </ul>
                        <div class="checkout__order__subtotal">Tổng tiền<span>1000 VNĐ</span></div>
                        <div class="checkout__order__total">Tổng cộng <span>1000 VNĐ</span></div>
                        <div class="checkout__input__checkbox">
                            <label for="payment">
                                Visa/MasterCard
                                <input type="checkbox" id="payment">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="paypal">
                                Paypal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn">ĐẶT NGAY</button>
                    </div>
                </div>
             </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection