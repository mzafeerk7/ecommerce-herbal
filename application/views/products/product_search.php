        <!-- Breadcumb area Start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Shop</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <?php if(isset($searched_category) && !empty($searched_category)): ?>
                                <li class="current"><a href="javascript:void(0);" class="text-capitalize"><?= $searched_category[0]['c_title'] ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb area End -->

        <!-- Main Content Wrapper Start -->
        <div class="main-content-wrapper">
            <div class="shop-area pt--40 pb--80 pt-md--30 pb-md--60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 order-lg-2 mb-md--30">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Refine Search Start -->
                                    <!-- Refine Search End -->

                                    <!-- Shop Toolbar Start -->
                                    <div class="shop-toolbar">
                                        <div class="product-view-mode" data-default="list">
                                            <a class="grid-2" data-target="gridview-2" data-toggle="tooltip" data-placement="top" title="2">2</a>
                                            <a class="grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="3">3</a>
                                            <a class="grid-4" data-target="gridview-4" data-toggle="tooltip" data-placement="top" title="4">4</a>
                                            <a class="grid-5" data-target="gridview-5" data-toggle="tooltip" data-placement="top" title="5">5</a>
                                            <a class="active list" data-target="listview" data-toggle="tooltip" data-placement="top" title="5">List</a>
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
                            <div class="shop-product-wrap listview row no-gutters">

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
                                                        <!-- <a class="same-action compare-mrg" data-toggle="modal" data-target="#productModal" href="compare.html">
                                                            <i class="fa fa-sliders fa-rotate-90"></i>
                                                        </a> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mirora-product-list">
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
                                                <div class="product-content">
                                                    <span class="text-uppercase"><?= $product['c_title'] ?></span>
                                                    <h4 class="text-capitalize"><?= $product['p_title'] ?></h4>
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
                                                    <div class="product-price-wrapper">
                                                        <span class="money">$<?= $product['p_price'] ?></span>
                                                        <!-- <span class="product-price-old">
                                                            <span class="money">$700.00</span>
                                                        </span> -->
                                                    </div>
                                                    <div class="product-action">
                                                        <a class="add_cart cart-item action-cart" href="javascript:void(0)" onclick="_product.add_to_cart(this);" data-id="<?= encrypt_id($product['p_id']) ?>" title="wishlist"><span>Add to cart</span></a>
                                                        <!-- <a class="same-action" href="wishlist.html" title="wishlist">
                                                            <i class="fa fa-heart-o"></i>
                                                        </a> -->
                                                        <!-- <a class="same-action compare-mrg" data-toggle="modal" data-target="#productModal" href="compare.html">
                                                            <i class="fa fa-sliders fa-rotate-90"></i>
                                                        </a> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h2 class="ml-5">Not Found!</h2>
                                <?php endif; ?>

                            </div>
                            <!-- Main Shop wrapper End -->

                            <!-- Pagination Start -->
                            <div class="pagination-wrap mt--15 mt-md--10">
                            <p class="page-ammount"></p>
                                <ul class="pagination">
                                    <?php 
                                        if(isset($pagination_links)){ 
                                            echo $pagination_links; 
                                        }
                                    ?>
                                </ul>
                            </div>
                            <!-- Pagination End -->
                        </div>
                        <div class="col-lg-3 order-lg-1">
                            <aside class="shop-sidebar">
                                <div class="search-filter">
                                    <!-- <div class="filter-layered">
                                        <h3 class="filter-heading">Layered Navigation</h3>
                                        <ul class="filter-list">
                                            <li><span>Diamonds</span><a href="#"><i class="fa fa-times-circle"></i></a></li>
                                            <li><span>Brown</span><a href="#"><i class="fa fa-times-circle"></i></a></li>
                                            <li><span>Christian Dior</span><a href="#"><i class="fa fa-times-circle"></i></a></li>
                                        </ul>
                                    </div> -->
                                    <!-- <div class="filter-price">
                                        <h3 class="filter-heading">Price</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-1" checked>
                                                    <label for="pricerange-1">$55 - $100 (3)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-2">
                                                    <label for="pricerange-2">$55 - $200 (2)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-3">
                                                    <label for="pricerange-3">$300 - $500 (6)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-radio">
                                                    <input type="radio" name="pricerange" id="pricerange-4">
                                                    <label for="pricerange-4">$700 - $1000 (2)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                    
                                    <div class="filter-categories">
                                        <h3 class="filter-heading">Categories</h3>
                                        <ul class="filter-list">
                                            <?php if(isset($categories) && !empty($categories)): ?>
                                                <?php foreach($categories as $category): ?>
                                                    <?php 
                                                        if(isset($searched_category) && !empty($searched_category)){
                                                            if($searched_category[0]['c_id'] === $category['c_id']){
                                                                $attr = 'style="color: #a8741a;"';
                                                            }else{
                                                                $attr = 'style="color: #f9f7f7;"';
                                                            }
                                                        }else{
                                                            $attr = 'style="color: #f9f7f7;"';
                                                        }
                                                    ?>
                                                    <li class="current">
                                                        <a href="<?= base_url().'products/catalog/'.encrypt_id($category['c_id']) ?>" <?= $attr ?> ><i class="fa fa-angle-double-right mr-2" aria-hidden="true"></i> <?= ucwords($category['c_title']) ?></a>
                                                        <!-- <div class="filter-input filter-checkbox">
                                                            
                                                            <input type="checkbox" name="<?= $category['c_title'] ?>" id="<?= $category['c_title'] ?>" <?php if($attr === true){ echo 'checked'; } ?> >
                                                            <label for="<?= $category['c_title'] ?>"><?= ucwords($category['c_title']) ?></label>
                                                        </div> -->
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <!-- <div class="filter-color">
                                        <h3 class="filter-heading">Color</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="black" id="black">
                                                    <label for="black">black (3)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="blue" id="blue">
                                                    <label for="blue">blue (6)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="brown" id="brown">
                                                    <label for="brown">brown (7)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="white" id="white">
                                                    <label for="white">white (4)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="red" id="red">
                                                    <label for="red">red (1)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="filter-color">
                                        <h3 class="filter-heading">Manufacturer</h3>
                                        <ul class="filter-list">
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="ferragamo" id="ferragamo">
                                                    <label for="ferragamo">ferragamo (11)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="hermes" id="hermes">
                                                    <label for="hermes">hermes (9)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="louis" id="louis">
                                                    <label for="louis">louis vuitton (11)</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="filter-input filter-checkbox">
                                                    <input type="checkbox" name="christian" id="christian">
                                                    <label for="christian">Christian Dior (8)</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div> -->
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Wrapper Start -->