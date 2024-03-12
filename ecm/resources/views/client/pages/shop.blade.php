@extends('client.layout.pages-layout')
@section('content')

    <section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Cửa hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục</h4>
                            <div class="sidebar__item__size">
                                @foreach ($category_categories as $cat)
                                    <label for="large"
                                        onclick="filterProducts({{ json_encode([
                                            'categoryId' => $cat->id ?? '',
                                            'orderBy' => $orderBy ?? 'id',
                                            'page' => $page ?? 10,
                                            'size' => $size ?? 0,
                                            'searchString' => $searchString ?? '',
                                        ]) }})">
                                        {{ $cat->name }}</label>
                                @endforeach
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm liên quan</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/client/img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/client/img/latest-product/lp-2.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/client/img/latest-product/lp-3.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/client/img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/client/img/latest-product/lp-2.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/client/img/latest-product/lp-3.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp theo</span>
                                    <select name="orderby" id="orderby" onchange="changeSortOrder()">
                                        <option value="price_asc" {{ request('orderby') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                        <option value="price_desc" {{ request('orderby') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $total }}</span> Sản Phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product__item___display">
                    </div>
                    <div class="product__pagination" id="paginationContainer">
                        <a
                            onclick="filterProducts({{ json_encode([
                                'categoryId' => $categoryId ?? '',
                                'orderBy' => $orderBy ?? 'id',
                                'page' => $page - 1 ?? 10,
                                'size' => $size ?? 0,
                                'searchString' => $searchString ?? '',
                            ]) }})"><i
                                class="fa fa-long-arrow-left"></i></a>
                        <a>{{ $page }}</a>
                        <a
                            onclick="filterProducts({{ json_encode([
                                'categoryId' => $categoryId ?? '',
                                'orderBy' => $orderBy ?? 'id',
                                'page' => $page + 1 ?? 10,
                                'size' => $size ?? 0,
                                'searchString' => $searchString ?? '',
                            ]) }})"><i
                                class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Modal HTML -->
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            filterProducts({
                categoryId: '',
                orderBy: 'id',
                page: 1,
                size: 10,
                searchString: ''
            });
        });

        // Gửi yêu cầu lọc sản phẩm
        function updateProductsView(products) {
            const container = document.querySelector('.product__item___display');
            container.innerHTML = ''; // Xóa các sản phẩm hiện tại

            products.forEach(product => {
                const productHTML = `
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item__pic set-bg" data-setbg="${product.thumbnail_url}" style="background-image: url(${product.thumbnail_url});">
                                <ul class="product__item__pic__hover">
                                     <li><a href="javascript:void(0);" class="add-to-cart-btn" data-product-id="${product.id}" onclick="addToCart(${product.id})"><i class="fa fa-shopping-cart"></i>Thêm Sản Phẩm Vào Giỏ Hàng</a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">${product.name}</a></h6>
                                <h5>${product.sell_price} VNĐ</h5>
                            </div>
            `;
                container.innerHTML += productHTML;
            });
        }

        function filterProducts(inputJson) {
            console.log(inputJson);

            // Parse the input JSON object
            const {
                categoryId,
                orderby,
                page,
                size,
                searchString
            } = inputJson;

            // Define the URL of your Laravel API endpoint
            const apiUrl = 'api/product/filter';

            // Encode the parameters into a query string
            const requestData = new URLSearchParams({
                categoryId: categoryId ?? '',
                orderby: orderby ?? 'id',
                page: page ?? 1,
                size: size ?? 10,
                search_string: searchString ?? ''
            }).toString();
            // Send a GET request to the API using Fetch
            return fetch(apiUrl + '?' + new URLSearchParams(requestData))
                .then(response => {
                    // Check if the request was successful
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Parse the JSON response
                    return response.json();
                })
                .then(data => {
                    // Return the data from the API
                    updateProductsView(data.products);
                    return data;
                })
                .catch(error => {
                    // Handle errors that occur during the fetch request
                    updateProductsView([]);
                    console.error('There was a problem with your fetch operation:', error);
                    // Return an error object
                    return {
                        error: error.message
                    };
                });
        }

        function changeSortOrder() {
            var orderby = document.getElementById('orderby').value;
            // Define parameters based on the selected sort order
            var params = {
                orderby: orderby,
            };
            filterProducts(params); // Call filterProducts function with the new parameters
        }

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
    </script>
@endsection


