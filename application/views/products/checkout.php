<!-- Breadcumb area Start -->
<div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h1 class="page-title">Checkout</h1>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li class="current"><a href="<?= base_url().'cart/checkout' ?>">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb area End --> 

        <!-- Main content wrapper start -->
        <div class="main-content-wrapper">
            <div class="checkout-area pt--40 pb--80 pt-md--30 pb-md--60">
                <div class="container">
                    <div class="row">
                        <div class="col-6 offset-sm-3">
                            <!-- Checkout Area Start -->
                            <?php if($this->cart->contents()): ?>
                            <div class="checkout-wrapper bg--2" style="min-width: 22em;">
                                <div class="row">
                                    <div class="col-sm-12 mt-md--30">
                                        <div class="order-details">
                                            <h3 class="heading-tertiary">Your Order</h3>
                                            <div class="order-table table-content table-responsive mb--30">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php foreach($this->cart->contents() as $item): ?>
                                                            <tr>
                                                                <td class="text-capitalize"><?= $item['name'] ?></td>
                                                                <td>$<?= number_format($item['subtotal'], 2) ?> , (qty: <?= $item['qty'] ?>)</td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                     
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="cart-subtotal">
                                                            <th>Subtotal</th>
                                                            <td>$<?= number_format($this->cart->total(), 2) ?></td>
                                                        </tr>
                                                        <tr class="shipping">
                                                            <th>Shipping</th>
                                                            <td>
                                                                <div>
                                                                    <!-- <label class="select-label">Select Country:</label> -->
                                                                    <div class="country-charge error"></div>
                                                                    <span class="small text-danger"></span>
                                                                    <select class="w-100 form-control" onchange="_product.get_delivery_charges();" style="font-size: 0.9em; background-color: #2e2e2e; color: #afafaf;">
                                                                        <option value="false">--Select Country--</option>
                                                                        <?php if(isset($countries) && !empty($countries)): ?>
                                                                            <?php foreach($countries as $country): ?>
                                                                                <?php 
                                                                                    $select = '';
                                                                                    if(isset($_SESSION['country']['id']) && ($_SESSION['country']['id'] == $country['country_id'])){
                                                                                        $select = 'selected';
                                                                                    }
                                                                                ?>
                                                                                <option <?= $select ?> value="<?= encrypt_id($country['country_id']) ?>"><?= ucwords($country['country_title']) ?></option>
                                                                            <?php endforeach; ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                    
                                                                </div>
                                                                <div class="mt-2">
                                                                    <?php 
                                                                        $shipping_charges = 00.00;
                                                                        if(isset($_SESSION['country']['charges'])){
                                                                            $shipping_charges = $_SESSION['country']['charges'];
                                                                        }
                                                                    ?>
                                                                    <p>$<span id="shipping-charges"><?= $shipping_charges ?></span></p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>Order Total</th>
                                                            <?php 
                                                                $shipping_charges = 00.00;
                                                                if(isset($_SESSION['country']['charges'])){
                                                                    $shipping_charges = $_SESSION['country']['charges'];
                                                                }
                                                            ?>
                                                            <td><span class="order-total-ammount">$<span id="order-total-ammount"><?= number_format($this->cart->total() + $shipping_charges, 2) ?></span></span></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="checkout-payment">
                                                <form id="place-order-form" class="payment-form">
                                                    <div class="payment-group">
                                                        <!-- <div class="custom-radio payment-radio">
                                                            <input type="radio" value="paypal" name="payment-method" id="paypal">
                                                            <label class="payment-label" for="paypal">
                                                                Paypal 
                                                                <img src="<?= base_url() ?>assets/img/others/AM_mc_vs_ms_ae_UK.png" alt="payment">
                                                                <a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                                            </label>
                                                        </div> -->
                                                        <?php if(isset($_SESSION['userloggedIn']) && $_SESSION['userloggedIn'] === true ): ?>
                                                            <div class="form__group mb--20">
                                                                <label class="form__label" for="register_email">
                                                                    Shipping address <span>*</span> <small>(Secured with end-to-end encryption)</small>
                                                                </label>
                                                                <input type="text" name="shipping_address" id="shipping_address" class="form__input form__input--2 error">
                                                                <span class="small text-danger"></span>
                                                                <input type="hidden" name="act" id="act" value="place_ord" class="form__input form__input--2">
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <!-- <div class="payment-group">
                                                        <div class="custom-checkbox">
                                                            <input type="checkbox" name="termscondition" id="termscondition" class="form__checkbox">
                                                            
                                                            <label for="termscondition" class="terms-condition-label payment-label">I have read and agree to the website <a href="index.html">terms and conditions.</a></label>
                                                        </div>
                                                    </div> -->
                                                    <?php if($this->cart->contents()): ?>
                                                        <div class="payment-btn-group">
                                                            <?php if(isset($_SESSION['userloggedIn']) && $_SESSION['userloggedIn'] === true ): ?>
                                                                <button id="btn-loader" style="display: none;" class="btn btn-style-3" disabled><i class="fa fa-spinner fa-spin"></i>Processing</button>
                                                                <button id="btn-submit" type="button" onclick="_product.place_order();" class="btn btn-style-3">Proceed to pay</button>
                                                            <?php else: ?>
                                                                <a href="<?= base_url().'account/login' ?>" class="btn btn-style-3">Login to checkout</a>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="text-center">
                                <h2>Cart is empty!</h2>
                            </div>
                            <?php endif; ?>
                            <!-- Checkout Area End -->
                        </div>
                    </div>
                </div>     
            </div>
        </div>
        <!-- Main content wrapper end -->