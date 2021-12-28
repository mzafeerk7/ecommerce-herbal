

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Refine Search Start -->
                            <!-- Refine Search End -->

                            <!-- Shop Toolbar Start -->
                            <div class="shop-toolbar">
                                <div class="product-view-mode" data-default="3">
                                    <a class="grid-2" data-target="gridview-2" data-toggle="tooltip" data-placement="top" title="2">2</a>
                                    <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="3">3</a>
                                    <a class="grid-4" data-target="gridview-4" data-toggle="tooltip" data-placement="top" title="4">4</a>
                                    <a class="grid-5" data-target="gridview-5" data-toggle="tooltip" data-placement="top" title="5">5</a>
                                    <!-- <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="5">List</a> -->
                                </div>
                                <!-- <span class="product-pages">Showing 1 to 9 of 11 (2 Pages)</span>
                                <div class="product-showing">
                                    <label class="select-label">Show:</label>
                                    <select class="short-select nice-select">
                                        <option value="1">9</option>
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                        <option value="1">5</option>
                                        <option value="1">9</option>
                                    </select>
                                </div>
                                <div class="product-short">
                                    <label class="select-label">Short By:</label>
                                    <select class="short-select nice-select">
                                        <option value="1">Relevance</option>
                                        <option value="2">Name, A to Z</option>
                                        <option value="3">Name, Z to A</option>
                                        <option value="4">Price, low to high</option>
                                        <option value="5">Price, high to low</option>
                                    </select>
                                </div> -->
                            </div>
                            <!-- Shop Toolbar End -->
                        </div>
                    </div>
                    
                    <!-- Main Shop wrapper Start -->
                    <div class="shop-product-wrap grid gridview-3 row no-gutters">
                    
                    <?php if(isset($products) && !empty($products)): ?>
                        <?php foreach($products as $product): ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                            <div class="mirora-product mb-md--10">
                                <div class="product-img">
                                    <img src="<?= base_url().'assets/img/products/'.$product['p_thumb'] ?>" alt="Product" class="primary-image" />
                                    <img src="<?= base_url().'assets/img/products/'.$product['p_second_thumb'] ?>" alt="Product" class="secondary-image" />
                                    <div class="product-img-overlay">
                                        <span class="product-label discount">
                                            <!-- -7% -->
                                        </span>
                                        <a href="<?= base_url().'products/view/'.encrypt_id($product['p_id']) ?>" class="btn btn-transparent btn-fullwidth btn-medium btn-style-1">Detail</a>
                                    </div>
                                </div>
                                <div class="product-content text-center">
                                    <span class="text-uppercase"><?= $product['c_title'] ?></span>
                                    <h4 class="text-capitalize"><?= $product['p_title'] ?></h4>
                                    <div class="product-price-wrapper">
                                        <span class="money">$<?= $product['p_price'] ?></span>
                                        <!-- <span class="product-price-old">
                                            <span class="money">$700.00</span>
                                        </span> -->
                                    </div>
                                </div>
                                <div class="mirora_product_action text-center position-absolute">
                                    <!-- <div class="product-rating">
                                        <span>
                                            <i class="fa fa-star theme-star"></i>
                                            <i class="fa fa-star theme-star"></i>
                                            <i class="fa fa-star theme-star"></i>
                                            <i class="fa fa-star theme-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div> -->
                                    <p>
                                    <?= maxStringLength($product['p_description'], 80); ?>
                                    </p>
                                    <div class="product-action">
                                        <!-- <a class="same-action" href="wishlist.html" title="wishlist">
                                            <i class="fa fa-heart-o"></i>
                                        </a> -->
                                        <a class="add_cart cart-item action-cart" href="javascript:void(0)" onclick="_product.add_to_cart(this);" data-id="<?= encrypt_id($product['p_id']) ?>" title="wishlist"><span>Add to cart</span></a>
                                        <!-- <a class="same-action compare-mrg" href="<?= base_url().'products/1' ?>" href="compare.html">
                                            <i class="fa fa-sliders fa-rotate-90"></i>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>



                    </div>
                    <!-- Main Shop wrapper End -->
                    <!-- Pagination Start -->
                    
                    <?php if(isset($pagination_links) && !empty($pagination_links)): ?>
                        <div class="pagination-wrap mt--15 mt-md--10">
                        <p class="page-ammount"></p>
                            <ul class="pagination">
                                <?= $pagination_links; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <!-- Pagination End -->

                    <!-- Pagination Start -->
                    <!-- <div class="pagination-wrap mt--15 mt-md--10">
                        <p class="page-ammount">Showing 1 to 9 of 15 (2 Pages)</p>
                        <ul class="pagination">
                            <li><a href="#" class="first">|&lt;</a></li>
                            <li><a href="#" class="prev">&lt;</a></li>
                            <li><a href="#" class="current">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#" class="next">&gt;</a></li>
                            <li><a href="#" class="next">&gt;|</a></li>
                        </ul>
                    </div> -->
                    <!-- Pagination End -->
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Main Content Wrapper Start -->