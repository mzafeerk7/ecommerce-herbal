

    <!-- ************************* JS Files ************************* -->

    <!-- jQuery JS -->
    <script src="<?= base_url() ?>assets/js/vendor/jquery.min.js"></script>

    <!-- Bootstrap and Popper Bundle JS -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>

    <!-- All Plugins Js -->
    <script src="<?= base_url() ?>assets/js/plugins.js"></script>
    <!-- Ajax Mail Js -->
    <script src="<?= base_url() ?>assets/js/ajax-mail.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url() ?>assets/js/main.js"></script>


<!-- *************************custom links *************************-->
    <!-- notify alerts  -->
    <script src="<?= base_url() ?>assets/js/notify.js"></script>
    <script src="<?= base_url() ?>assets/js/prettify.js"></script>

    <!-- Custom links -->
    <script src="<?= base_url() ?>assets/ajax/customConfig.js"></script>
    <script src="<?= base_url() ?>assets/ajax/product.js"></script>
    <!-- for account (registeration and login) -->
    <?php if(isset($reg_login_link) && $reg_login_link === true): ?>
        <script src="<?= base_url() ?>assets/ajax/account.js"></script>
    <?php endif;?>

    <!-- cart item count -->
    

    <!-- calculate product price in cart -->
    <?php if(isset($cart_link) && $cart_link === true): ?>
        <script>
            // On Increament or Decreament button click
            $(document).ready(function(){

                $(".inc, .dec").on('click', function () {
                    var r = $(this).closest('.product-cart-box');
                    var rowid = r.attr("data-id");
                    var qty = r.find("#pro_qty").val();
                    //alert(qty);  
                    var request = {
                        url: config.url + "cart/qty",
                        method: "POST",
                        data: {
                            rowid: rowid,
                            qty: qty
                        },
                    }
                    $.ajax(request).done(function (response) {
                        response = $.parseJSON(response);
                        if (response.success) {
                            // $.notify(response.success,
                            //     {
                            //         type: "success",
                            //         align: "left",
                            //         verticalAlign: "middle"
                            //     }
                            // )
                            $('#itemCount').text(response.itemCount);
                            $("#total").html("$" + response.totalPrice.toFixed(2));
                            r.find("#itemSubtotal").html("$<strong>" + response.subtotal.toFixed(2) +"</strong>");
                            //$("#total").html("$" + response.totalPrice.toFixed(2));
                                //_product.calculate();
                        } else if (response.error) {
                            $.notify(response.error,
                                {
                                    type: "danger",
                                    align: "left",
                                    verticalAlign: "middle"
                                }
                            )
                        }
                    });       
                });
            });
        </script>
    <?php endif; ?>