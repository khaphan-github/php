@extends('client.layout.pages-layout')
@section('content')
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product->name }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <a href="{{ route('shop') }}">Cửa hàng</a>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}">
                        </div>
                        @if($product->thumbnail_url)
                        @php
                            $images = explode(',',$product->thumbnail_url);
                        @endphp
                        @foreach($images as $images)
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-imgbigurl="img/product/details/product-details-3.jpg"
                                    src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">
                            @if($product->discount_price)
                                {{$product->discount_price}} VNĐ
                            <del>{{$product->original_price}} VNĐ</del><span> 
                               giảm {{round((($product->original_price - $product->discount_price)/$product->original_price)*100 )}}%</span>
                            @else
                                {{$product->original_price}}
                            @endif
                        </div>
                        <p> {{ $product->description }}</p>
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <!-- <form id="updateCartForm" action="{{ route('updateCart') }}" method="post">
                                        @csrf
                                        <div class="pro-qty">
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="number" name="number_of_item" value="1" onchange="updateQuantity(this)">
                                        </div>
                                    </form> -->
                                </div>
                            </div>
                        <a href="javascript:void(0);" class="primary-btn" data-product-id="{{ $product->id }}" onclick="addToCart({{ $product->id }})">Thêm vào giỏ hàng</a>
                        <ul>
                            <li><b>Availability</b> 
                            <span>
                                @if($product->stock_quentity > 0)
                                    Số lượng: {{ $product->stock_quentity }} - Còn hàng
                                @else
                                    Hết hàng
                                @endif
                            </span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                               {{ $product->detail_info }}
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <div class="contact-form spad">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="contact__form__title">
                                                        <h2>Bình Luận</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" placeholder="Your name">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <input type="text" placeholder="Your Email">
                                                    </div>
                                                    <div class="col-lg-12 text-center">
                                                        <textarea placeholder="Your message"></textarea>
                                                        <button type="submit" class="site-btn">Gửi Đánh Giá</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <!-- <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($rproducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ $product->thumbnail_url }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('shop-details', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                            <h5>{{$product->sell_price}} VNĐ</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section> -->
    <!-- Related Product Section End -->

    <script>
        var addToCartUrl = "{{ route('add-to-cart') }}";
        var csrfToken = "{{ csrf_token() }}";

        function addToCart(productId) {
            fetch(addToCartUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Đảm bảo bạn đã include CSRF token trong blade template của bạn
                },
                body: JSON.stringify({
                    productId: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                
                // Kiểm tra nếu sản phẩm được thêm thành công
                if (data.success) {
                    console.log("Sản phẩm đã được thêm vào giỏ hàng thành công!");
                    alert("Đã Thêm Thành Công!")
                } else {
                    console.log("Có lỗi xảy ra, không thể thêm sản phẩm vào giỏ hàng.");
                    alert("Đã thêm thất bại!")
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert("Đã xảy ra lỗi!")
            });
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