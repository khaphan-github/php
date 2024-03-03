@extends('client.layout.pages-layout')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="/client/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
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
                                    @foreach ($category as $cat)
                                    <label for="large" onclick="findProductByCategoryId({{ $cat->id }})">
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
                                    <select>
                                        <option value="0">Giá tăng dần</option>
                                        <option value="0">Giá giảm dần</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
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
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

<script>
    // Gửi yêu cầu lọc sản phẩm
        function findProductByCategoryId(categoryId) {
            fetch(`/api/product-by-category-id?category_id=${categoryId}&page=${page}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data)
                    updateProductsView(data);
                    pagination(page, data.totalPages, categoryId);
                    // renderItems(data, 'productsByCategoryDisplayListContainer');
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
    }

    function updateProductsView(products) {
            const container = document.querySelector('.product__item___display');
            container.innerHTML = ''; // Xóa các sản phẩm hiện tại

            products.forEach(product => {
                const productHTML = `
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item__pic set-bg" data-setbg="${product.thumbnail_url}" style="background-image: url(${product.thumbnail_url});">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">${product.name}</a></h6>
                                    <h5>${product.sell_price} VND</h5>
                                </div>
                    </div>
                `;
                container.innerHTML += productHTML;
            });
        }
    
    function pagination(currentPage, totalPages, categoryId) {
        const paginationContainer = document.querySelector('.product__pagination');
        paginationContainer.innerHTML = ''; // Xóa phân trang hiện tại

        // Thêm nút "Trước" nếu không phải trang đầu tiên
        if (currentPage > 1) {
            paginationContainer.innerHTML += `<a href="#" onclick="findProductByCategoryId(${categoryId}, ${currentPage - 1})">Trước</a>`;
        }

        // Tạo các số trang
        for (let i = 1; i <= totalPages; i++) {
            paginationContainer.innerHTML += `<a href="#" class="${i === currentPage ? 'active' : ''}" onclick="findProductByCategoryId(${categoryId}, ${i})">${i}</a>`;
        }

        // Thêm nút "Sau" nếu không phải trang cuối cùng
        if (currentPage < totalPages) {
            paginationContainer.innerHTML += `<a href="#" onclick="findProductByCategoryId(${categoryId}, ${currentPage + 1})">Sau</a>`;
        }
    }

</script>
@endsection
