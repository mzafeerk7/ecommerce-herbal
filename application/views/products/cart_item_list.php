<?php if(isset($cart_products) && !empty($cart_products)): ?>
    <?php foreach($cart_products as $data): ?>
        <?php foreach($data as $product): ?>
            <tr class="product-cart-box" data-productId="<?= encrypt_id($product['p_id']) ?>">
                <td><a class="delete" href="javascript:void(0)" onclick="_product.remove_from_cart(this)"><i
                            class="fa fa-times"></i></a></td>
                <td>
                    <a href="<?= base_url().'products/view/'.encrypt_id($product['p_id'])?>">
                        <img src="<?= base_url().'assets/img/products/'.$product['p_thumb'] ?>" alt="product">
                    </a>
                </td>
                <td class="wide-column">
                    <h3><a href="<?= base_url().'products/view/'.encrypt_id($product['p_id'])?>"
                            class="text-capitalize"><?= $product['p_title'] ?></a></h3>
                </td>
                <!-- unit price -->
                <td class="cart-product-price" id="product-unit-price"><strong>$<?= $product['p_price'] ?></strong>
                </td>
                <!-- qty -->
                <td>
                    <div class="quantity">
                        <input type="number" class="quantity-input" name="qty" id="pro_qty" value="1" min="1">
                    </div>
                </td>
                <!-- total -->
                <td class="cart-product-price" id="product-total-price" data-price="<?= $product['p_price'] ?>">
                    <strong>$<?= $product['p_price'] ?></strong></td>
            </tr>
        <?php endforeach; ?>
    <?php endforeach; ?>
<?php endif; ?>