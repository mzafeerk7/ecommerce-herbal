<!-- Breadcumb area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Cart</h1>
                <ul class="breadcrumb justify-content-center">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li class="current"><a href="<?= base_url().'cart/view' ?>">Cart</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb area End -->

<!-- Main content wrapper start -->

<div class="main-content-wrapper">
    <div class="cart-area pt--40 pb--80 pt-md--30 pb-md--60">
        <div class="container">
            <div class="cart-wrapper bg--2 mb--80 mb-md--60">
                <div class="row">
                    <div class="col-12">
                        <!-- Cart Area Start -->
                        <form action="#" class="form cart-form">
                            <div class="cart-table table-content table-responsive">
                                <table class="table mb--30">
                                    <thead>
                                        <tr>
                                            <th>remove</th>
                                            <th>Images</th>
                                            <th>Product</th>
                                            <th>Unit Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                            <?php foreach($this->cart->contents() as $item): ?>
                                                    <tr class="product-cart-box" data-id="<?= $item['rowid'] ?>">
                                                        <td><a class="delete" href="javascript:void(0)" onclick="_product.remove_from_cart(this)"><i
                                                                    class="fa fa-times"></i></a></td>
                                                        <td>
                                                            <a href="<?= base_url().'products/view/'.encrypt_id($item['id'])?>">
                                                                <img src="<?= base_url().'assets/img/products/'.$item['options']['image'] ?>" alt="product">
                                                            </a>
                                                        </td>
                                                        <td class="wide-column">
                                                            <h3><a href="<?= base_url().'products/view/'.encrypt_id($item['id'])?>"
                                                                    class="text-capitalize"><?= $item['name'] ?></a></h3>
                                                        </td>
                                                        <!-- unit price -->
                                                        <td class="cart-product-price" id="product-unit-price"><strong>$<?= number_format($item['price'], 2) ?></strong>
                                                        </td>
                                                        <!-- qty -->
                                                        <td>
                                                            <div class="quantity">
                                                                <input type="number" class="quantity-input" name="qty" id="pro_qty" value="<?= $item['qty'] ?>" min="1">
                                                            </div>
                                                        </td>
                                                        <!-- total -->
                                                        <td class="cart-product-price" id="itemSubtotal" data-price="<?= $item['price'] ?>">
                                                            <strong>$<?= number_format($item['subtotal'], 2) ?></strong></td>
                                                    </tr>
                                            <?php endforeach; ?>
                                        
                        
                                    </tbody>
                                </table>
                            </div>
                        
                        
                        </form>
                        <!-- Cart Area End -->
                    </div>
                </div>
            </div>
            <div class="cart-page-total-wrapper">
                <div class="row justify-content-end">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="cart-page-total bg--dark-3">
                            <!-- <h2>Cart Totals</h2> -->
                            <div class="cart-calculator-table table-content table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr class="cart-total">
                                            <th>TOTAL</th>
                                            <td><span class="price-ammount" id="total">$<?= number_format($this->cart->total(), 2)?></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="<?= base_url().'cart/checkout' ?>" class="btn btn-medium btn-style-3">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main content wrapper end -->