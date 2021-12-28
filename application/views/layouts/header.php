<header class="header headery-style-1">
            <!-- <div class="header-top header-top-1">
                <div class="container">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-8 d-flex align-items-center flex-column flex-lg-row">
                            <ul class="social social-round mr--20">
                                <li class="social__item">
                                    <a href="twitter.com" class="social__link">
                                    <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="plus.google.com" class="social__link">
                                    <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="facebook.com" class="social__link">
                                    <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="youtube.com" class="social__link">
                                    <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="instagram.com" class="social__link">
                                    <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                            <p class="header-text">Free shipping on all domestic orders with coupon code <span>“Watches2018”</span></p>
                        </div>
                        <div class="col-lg-4">
                            <div class="header-top-nav d-flex justify-content-lg-end justify-content-center">
                                <div class="language-selector header-top-nav__item">
                                    <div class="dropdown header-top__dropdown">
                                        <a class="dropdown-toggle" id="languageID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            EN-GB
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="languageID">
                                            <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/img/header/1.jpg" alt="English"> English</a>
                                            <a class="dropdown-item" href="#"><img src="<?= base_url() ?>assets/img/header/2.jpg" alt="Français"> Français</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="currency-selector header-top-nav__item">
                                    <div class="dropdown header-top__dropdown">
                                        
                                        <a class="dropdown-toggle" id="currencyID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            USD
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="currencyID">
                                            <a class="dropdown-item" href="#">&euro; Uro</a>
                                            <a class="dropdown-item" href="#">&pound; Pound Sterling</a>
                                            <a class="dropdown-item" href="#">&dollar; Us Dollar</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-info header-top-nav__item ">
                                    <div class="dropdown header-top__dropdown">
                                        <a class="dropdown-toggle" id="userID" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            My Account
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="userID">
                                            <a class="dropdown-item" href="login-register.html">Register</a>
                                            <a class="dropdown-item" href="login-register.html">Log In</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="header-middle header-top-1">
                <div class="container">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-5 col-sm-6 order-lg-1 order-2">
                            <div class="contact-info">
                                <img src="<?= base_url() ?>assets/img/icons/delivery-icon.png" alt="Phone Icon">
                                <!-- <p>Call us <br> Free Support: (012) 800 456 789</p> -->
                                <p>We deliver at your doorstep</p>
                            </div>
                        </div>
                        <div class="col-lg-2 col-12 order-lg-2 order-1 text-center">
                            <a href="<?= base_url() ?>" class="logo-box mb-md--30">
                                <img src="<?= base_url() ?>assets/img/logo/logo.png" alt="logo">
                            </a>
                        </div>
                        <div class="col-lg-5 col-md-7 col-sm-6 order-lg-3 order-3">
                            <div class="header-toolbar">
                                <div class="search-form-wrapper search-hide">
                                    <form action="<?= base_url().'products/search' ?>" method="get" class="search-form">
                                        <input type="text" name="p" id="p" class="search-form__input" placeholder="Search product here.." required>
                                        <button type="submit" class="search-form__submit">
                                            <i class="icon_search"></i>
                                        </button>
                                    </form>
                                </div>
                                <ul class="header-toolbar-icons">
                                    <li class="search-box">
                                        <a href="#" class="bordered-icon search-btn" aria-expanded="false"><i class="icon_search"></i></a>
                                    </li>
                                    <li class="wishlist-icon">
                                        <!-- <a href="wishlist.html" class="bordered-icon"><i class="fa fa-heart"></i></a> -->
                                    </li>
                                    <li class="mini-cart-icon mr-3">
                                        <div class="mini-cart mini-cart--1">
                                            <a class="mini-cart__dropdown-toggle bordered-icon" id="cartDropdown">
                                                <span class="mini-cart__count" id="itemCount"><?php echo $this->cart->total_items(); ?></span>
                                                <i class="icon_cart_alt mini-cart__icon"></i>
                                                <span class="mini-cart__ammount"><i class="fa fa-angle-down"></i></span>
                                            </a>
                                            <div class="mini-cart__dropdown-menu">
                                                <div class="mini-cart__content" id="miniCart">

                                                    <div class="mini-cart__btn">
                                                        <a href="<?= base_url().'cart/view' ?>" class="btn btn-fullwidth btn-style-1">View Cart</a>
                                                        <a href="<?= base_url().'cart/checkout' ?>" class="btn btn-fullwidth btn-style-1">Checkout</a>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- user account -->
                                    <?php if(isset($_SESSION['userloggedIn']) && $_SESSION['userloggedIn'] === true ): ?>
                                    <li class="mini-cart-icon">
                                        <div class="mini-cart mini-cart--1">
                                            <a href="<?= base_url().'account/profile' ?>" data-toggle="tooltip" title="User Account" class="mini-cart__dropdown-toggle bordered-icon">
                                                <span class="fa fa-user"></span>
                                            </a>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <li class="mini-cart-icon">
                                        <div class="mini-cart mini-cart--1">
                                            <?php if(isset($_SESSION['userloggedIn']) && $_SESSION['userloggedIn'] === true ): ?>
                                                <a href="<?= base_url().'account/logout' ?>" data-toggle="tooltip" title="Logout" class="mini-cart__dropdown-toggle bordered-icon">
                                                    <span class="fa fa-power-off"></span>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?= base_url().'account/login' ?>" data-toggle="tooltip" title="Login to account" class="mini-cart__dropdown-toggle bordered-icon">
                                                    <span class="fa fa-lock"></span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="header-bottom header-top-1 position-relative navigation-wrap fixed-header">
                <div class="container position-static">
                    <div class="row">
                        <div class="col-12 position-static text-center">
                            <nav class="main-navigation">
                                <ul class="mainmenu">
                                    <li class="mainmenu__item">
                                        <a href="<?= base_url() ?>" class="mainmenu__link">Home</a>
                                    </li>
                                    <?php if(isset($categories) && !empty($categories)): ?>
                                        <?php 
                                            $xCount = 0;
                                            if(count($categories) > 7){
                                                $xCount = 7;
                                            }elseif(count($categories) <= 7){
                                                $xCount = count($categories);
                                            }    
                                        ?>
                                        <?php for($x = 0; $x < $xCount; $x ++ ): ?>

                                            <?php 
                                                $menu_class = '';
                                                if(isset($categories[$x]['sub_category']) && !empty($categories[$x]['sub_category'])){
                                                    $menu_class = 'menu-item-has-children has-children';
                                                }    
                                            ?>

                                            <li class="mainmenu__item <?= $menu_class ?>">
                                                <a class="mainmenu__link" href="<?= base_url().'products/catalog/'.encrypt_id($categories[$x]['c_id']) ?>" class="text-capitalize"><?= $categories[$x]['c_title'] ?></a>
                                                <?php if(isset($categories[$x]['sub_category']) && !empty($categories[$x]['sub_category'])): ?>
                                                    <ul class="sub-menu">
                                                        <?php foreach($categories[$x]['sub_category'] as $sub_category): ?>
                                                            <li><a href="<?= base_url().'products/catalog/'.encrypt_id($sub_category['c_id']) ?>" class="text-capitalize"><?= $sub_category['c_title'] ?></a></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if(count($categories) > 7): ?>
                                            <li class="mainmenu__item menu-item-has-children has-children">
                                                <a href="javascript:void(0);" class="mainmenu__link">More</a>
                                                <ul class="sub-menu">
                                                        <?php for($x = 7; $x < count($categories); $x ++ ): ?>
                                                            <li><a href="<?= base_url().'products/catalog/'.encrypt_id($categories[$x]['c_id']) ?>" class="text-capitalize"><?= $categories[$x]['c_title'] ?></a></li>
                                                        <?php endfor; ?>
                                                    
                                                </ul>
                                            </li>
                                        <?php endif; ?>

                                    <?php endif;?>
                                    
                                    
                                    <!-- <li class="mainmenu__item menu-item-has-children active">
                                        <a href="shop.html" class="mainmenu__link">Shop</a>
                                        <ul class="megamenu five-column">
                                            <li>
                                                <a class="megamenu-title" href="#">Shop Grid</a>
                                                <ul>
                                                    <li>
                                                        <a href="shop.html">Left Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-right-sidebar.html">Right Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-fullwidth.html">Three Column</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-fullwidth-4-column.html">Four Column</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="megamenu-title" href="#">Shop List</a>
                                                <ul>
                                                    <li>
                                                        <a href="shop-list-left-sidebar.html">Left Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-list-right-sidebar.html">Right Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="shop-list.html">Full width</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a class="megamenu-title" href="#">Single Product</a>
                                                <ul>
                                                    <li>
                                                        <a href="product-details.html">Standard Product</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-details-variable.html">Variable Product</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-details-group.html">Group Product</a>
                                                    </li>
                                                    <li>
                                                        <a href="product-details-affiliate.html">Affiliate Product</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li> -->
                                    <!-- <li class="mainmenu__item">
                                        <a href="<?= base_url(),'about' ?>" class="mainmenu__link">About Us</a>
                                    </li>
                                    <li class="mainmenu__item">
                                        <a href="<?= base_url(),'contact' ?>" class="mainmenu__link">contact Us</a>
                                    </li> -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>