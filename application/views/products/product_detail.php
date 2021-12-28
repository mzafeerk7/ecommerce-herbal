<!-- Breadcumb area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Product Details</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li class="current"><a href="<?= base_url().'products/1' ?>">Product Details</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb area End -->

<!-- Main Content Wrapper Start -->
<div class="main-content-wrapper">
    <div class="single-products-area section-padding section-md-padding">
        <div class="container">

            <?php if(isset($product) && !empty($product)): ?>
                <!-- Single Product Start -->
                <section class="mirora-single-product pb--80 pb-md--60">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Tab Content Start -->
                            <!-- Product Thumb (first image ) -->
                            <div class="tab-content product-details-thumb-large" id="myTabContent-3">
                                <div class="tab-pane fade show active" id="product-large-one">
                                    <div class="product-details-img easyzoom">
                                        <a class="popup-btn" href="<?= base_url().'assets/img/products/'.$product[0]['p_thumb'] ?>">
                                            <img src="<?= base_url().'assets/img/products/'.$product[0]['p_thumb'] ?>" alt="product">
                                        </a>
                                    </div>
                                </div>
                                <!-- Product Secondary Thumb -->
                                <div class="tab-pane fade" id="product-large-two">
                                    <div class="product-details-img easyzoom">
                                        <a class="popup-btn" href="<?= base_url().'assets/img/products/'.$product[0]['p_second_thumb'] ?>">
                                            <img src="<?= base_url().'assets/img/products/'.$product[0]['p_second_thumb'] ?>" alt="product">
                                        </a>
                                    </div>
                                </div>

                                <!-- Gallery -->
                                <?php if(isset($gallery) && !empty($gallery)): ?>
                                    <?php foreach($gallery as $img): ?>

                                        <div class="tab-pane fade" id="<?= $img['image_id'] ?>">
                                            <div class="product-details-img easyzoom">
                                                <a class="popup-btn" href="<?= base_url().'assets/img/products/'.$img['image'] ?>">
                                                    <img src="<?= base_url().'assets/img/products/'.$img['image'] ?>" alt="product">
                                                </a>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- Tab Content End -->

                            <!-- Product Thumbnail Carousel Start -->
                            <div class="product-details-thumbnail">
                                <div class="thumb-menu product-details-thumb-menu nav-vertical-center"
                                    id="thumbmenu-horizontal">
                                    <!-- Product Thumb (first image ) -->
                                    <div class="thumb-menu-item">
                                        <a href="#product-large-one" data-toggle="tab" class="nav-link active">
                                            <img src="<?= base_url().'assets/img/products/'.$product[0]['p_thumb'] ?>" alt="product thumb">
                                        </a>
                                    </div>
                                    <!-- Product Secondary Thumb -->
                                    <div class="thumb-menu-item">
                                        <a href="#product-large-two" data-toggle="tab" class="nav-link">
                                            <img src="<?= base_url().'assets/img/products/'.$product[0]['p_second_thumb'] ?>" alt="product thumb">
                                        </a>
                                    </div>

                                    <!-- gallery -->
                                    <?php if(isset($gallery) && !empty($gallery)): ?>
                                        <?php foreach($gallery as $img): ?>
                                            <div class="thumb-menu-item">
                                                <a href="#<?= $img['image_id'] ?>" data-toggle="tab" class="nav-link">
                                                    <img src="<?= base_url().'assets/img/products/'.$img['image'] ?>" alt="product thumb">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <!-- Product Thumbnail Carousel End -->
                        </div>
                        <div class="col-lg-6">
                            <!-- Single Product Content Start -->
                            <div class="product-details-content">
                                <div class="product-details-top">
                                    <h2 class="product-details-name"><?= $product[0]['p_title'] ?></h2>
                                    <!-- <div class="ratings-wrap">
                                        <div class="ratings">
                                            <i class="fa fa-star rated"></i>
                                            <i class="fa fa-star rated"></i>
                                            <i class="fa fa-star rated"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span>
                                            <a class="review-btn" href="#singleProductTab">1 Reviews</a>
                                            <a class="review-btn" href="#singleProductTab">write a review</a>
                                        </span>
                                    </div> -->
                                    <ul class="product-details-list list-unstyled">
                                        <li>Category: <a href="#" class="text-uppercase"><?= $product[0]['c_title'] ?></a></li>
                                        <!-- <li>Product Code: Watches</li>
                                        <li>Reward Points: 600</li> -->
                                        <li>Availability: In Stock</li>
                                    </ul>
                                    <div class="product-details-price-wrapper">
                                        <span class="money">$<?= $product[0]['p_price'] ?></span>
                                        <!-- <span class="product-price-old">
                                            <span class="money">$700.00</span>
                                        </span> -->
                                    </div>
                                </div>

                                <div class="product-details-bottom">

                                    <!-- <p class="product-details-availability"><i class="fa fa-check-circle"></i>200 In Stock -->
                                    </p>
                                    <div class="product-details-action-wrapper mb--20">
                                        <div class="product-details-action-top d-flex align-items-center mb--20">
                                            <!-- <div class="quantity">
                                                <span>Qty: </span>
                                                <input type="number" class="quantity-input" name="qty" id="pro_qty"
                                                    value="1" min="1">
                                            </div> -->
                                            <button type="button" onclick="_product.add_to_cart(this);" data-id="<?= encrypt_id($product[0]['p_id']) ?>" class="btn btn-medium btn-style-2 add-to-cart">
                                                Add To Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Product Content End -->
                        </div>
                    </div>
                </section>
                <!-- Single Product End -->

                <!-- Single Product Tab Start -->
                <section class="product-details-tab bg--dark-4 ptb--80 ptb-md--60">
                    <div class="row">
                        <div class="col-12">
                            <ul class="product-details-tab-head nav nav-tab" id="singleProductTab" role="tablist">
                                <li class="nav-item product-details-tab-item">
                                    <a class="nav-link product-details-tab-link active" id="nav-desc-tab" data-toggle="tab"
                                        href="#nav-desc" role="tab" aria-controls="nav-desc"
                                        aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item product-details-tab-item">
                                    <a class="nav-link product-details-tab-link" id="nav-details-tab" data-toggle="tab"
                                        href="#nav-details" role="tab" aria-controls="nav-details"
                                        aria-selected="true">Additional Information</a>
                                </li>

                                <!-- <li class="nav-item product-details-tab-item">
                                    <a class="nav-link product-details-tab-link" id="nav-review-tab" data-toggle="tab"
                                        href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="true">review
                                        (2)</a>
                                </li> -->
                            </ul>
                            <div class="product-details-tab-content tab-content">
                                <div class="tab-pane fade show active" id="nav-desc" role="tabpanel"
                                    aria-labelledby="nav-desc-tab">
                                    <p class="product-details-description text-justify"><?= $product[0]['p_description'] ?></p>
                                   
                                </div>
                                <div class="tab-pane" role="tabpanel" id="nav-details" aria-labelledby="nav-details-tab">
                                    <div class="product-details-additional-info">
                                        <h3>Additional Information</h3>
                                        <div class="table-content table-responsive">
                                            <p class="product-details-description"><?= $product[0]['p_additional_information'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane" role="tabpanel" id="nav-review" aria-labelledby="nav-review-tab">
                                    <div class="product-details-review-wrap">
                                        <h2 class="mb--20">2 REVIEWS FOR ALIQUAM LOBORTIS</h2>
                                        <div class="review mb--40">
                                            <div class="review__single">
                                                <div class="review__meta">
                                                    <p class="review__author">HasTech</p>
                                                    <p class="review__date">October 12, 2014</p>
                                                </div>
                                                <div class="review__content">
                                                    <p class="review__text">
                                                        It’s both good and bad. If Nikon had achieved a high-quality wide
                                                        lens camera with a 1 inch sensor, that would have been a very
                                                        competitive product. So in that sense, it’s good for us. But
                                                        actually, from the perspective of driving the 1 inch sensor market,
                                                        we want to stimulate this market and that means multiple
                                                        manufacturers.
                                                    </p>
                                                    <div class="ratings">
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review__single">
                                                <div class="review__meta">
                                                    <p class="review__author">HasTech</p>
                                                    <p class="review__date">October 12, 2014</p>
                                                </div>
                                                <div class="review__content">
                                                    <p class="review__text">
                                                        It’s both good and bad. If Nikon had achieved a high-quality wide
                                                        lens camera with a 1 inch sensor, that would have been a very
                                                        competitive product. So in that sense, it’s good for us. But
                                                        actually, from the perspective of driving the 1 inch sensor market,
                                                        we want to stimulate this market and that means multiple
                                                        manufacturers.
                                                    </p>
                                                    <div class="ratings">
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                        <i class="fa fa-star rated"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="mb--20">Add a Review</h2>
                                        <form class="form form--review">
                                            <div class="form__group clearfix mb--20">
                                                <label class="form__label d-block">Your Ratings</label>
                                                <div class="rating">
                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                    <label class="full" for="star5" title="Awesome - 5 stars">
                                                    </label>
                                                    <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                                    <label class="half" for="star4half" title="Pretty good - 4.5 stars">
                                                    </label>
                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                    <label class="full" for="star4" title="Pretty good - 4 stars">
                                                    </label>
                                                    <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                                    <label class="half" for="star3half" title="Meh - 3.5 stars">
                                                    </label>
                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                    <label class="full" for="star3" title="Meh - 3 stars">
                                                    </label>
                                                    <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                                    <label class="half" for="star2half" title="Kinda bad - 2.5 stars">
                                                    </label>
                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                    <label class="full" for="star2" title="Kinda bad - 2 stars">
                                                    </label>
                                                    <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                                    <label class="half" for="star1half" title="Meh - 1.5 stars">
                                                    </label>
                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                    <label class="full" for="star1" title="Sucks big time - 1 star">
                                                    </label>
                                                    <input type="radio" id="starhalf" name="rating" value="half" />
                                                    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form__group clearfix mb--20">
                                                <label class="form__label d-block" for="review_name">Name
                                                    <sup>*</sup></label>
                                                <input id="review_name" name="review_name" class="form__input">
                                            </div>
                                            <div class="form__group clearfix mb--20">
                                                <label class="form__label d-block" for="review_email">Email
                                                    <sup>*</sup></label>
                                                <input id="review_email" name="review_email" class="form__input">
                                            </div>
                                            <div class="form__group clearfix mb--20">
                                                <label class="form__label d-block" for="review">Your Review
                                                    <sup>*</sup></label>
                                                <textarea id="review" name="review"
                                                    class="form__input form__input--textarea"></textarea>
                                                <div class="help-block">
                                                    <span>Note: </span>
                                                    HTML is not translated!
                                                </div>
                                            </div>
                                            <div class="form__group text-right">
                                                <button type="submit" class="btn btn-medium btn-style-1">Continue</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Single Product Tab End -->
            <?php else: ?>
                <h2 class="text-center"> Not Found!<h2>
            <?php endif; ?>


            <!-- Related Product Start -->

            <!-- Related Product End -->
        </div>
    </div>
</div>
<!-- Main Content Wrapper End -->