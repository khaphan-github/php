@extends('client.layout.pages-layout')
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Báo Lỗi</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Thông Báo</span>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                       <h2>Thanh toán không thành công!</h2>
                        <h5 class="mt-3">Quý khách vui lòng kiểm tra lại số dư tài khoản!</h5>
                         <a href="{{ route('cart') }}" class="btn btn-warning mt-5">Quay Lại</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection