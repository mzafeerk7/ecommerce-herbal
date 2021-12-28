
var _product = {

    /*
	|--------------------------------------------
	|	     add item to cart           		|
	|--------------------------------------------
    */
    add_to_cart: function (_this) {
        product_id = $(_this).attr("data-id");
        //alert(product_id);
        var request = {
            url: config.url + "cart/add",
            method: "POST",
            data: {
                id: product_id
            },
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                $.notify(response.success,
                    {
                        type: "success",
                        align: "right",
                        verticalAlign: "middle"
                    }
                )
                $('#itemCount').text(response.itemCount)
            } else if (response.error) {
                $.notify(response.error,
                    {
                        type: "danger",
                        align: "right",
                        verticalAlign: "middle"
                    }
                )
            }
        });
    },
    /*
	|--------------------------------------------
	|	     Remove item from cart          	|
	|--------------------------------------------
    */
    remove_from_cart: function (_this) {
        r_id = $(_this).closest(".product-cart-box");
        var request = {
            url: config.url + "cart/remove",
            method: "POST",
            data: {
                id: r_id.attr("data-id")
            },
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                r_id.slideUp("slow", function () {
                    r_id.remove();
                    $.notify(response.success,
                        {
                            type: "success",
                            align: "left",
                            verticalAlign: "middle"
                        }
                    )
                    $('#itemCount').text(response.itemCount);
                    $("#total").html("$" + response.totalPrice.toFixed(2));
                    //_product.calculate();
                });
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
    },
    /*
	|--------------------------------------------
	|Calculate Product subtotal and total (cart)|
	|--------------------------------------------
    */
    calculate: function (totalPrice) {
        $("#total").html("$" + totalPrice);
        var totalPrice = 0;
        $("#product-total-price").each(function (index) {
            totalPrice += eval($(this).attr("data-price"));
        });
        $("#total").html("$" + totalPrice);
    },

    /*
	|--------------------------------------------
	|   Select Country and get delivery charges |
	|--------------------------------------------
    */
    get_delivery_charges: function(){
        country_id  = $("select").val();
        
        if(country_id != 'false'){
            var request = {
                url: config.url + "cart/get_shipping_charges",
                method: "POST",
                data: { id :  country_id }
            }
            $.ajax(request).done(function (response) {
                response = $.parseJSON(response);
                if (response.success) {
                    $('#shipping-charges').text(response.charges);
                    $('#order-total-ammount').text(response.total);
                    _alert.remove_errors();
                } else if (response.error) {
                    _alert.error(response.error_message);
                }
            });
        }
       
    },

    /*
	|--------------------------------------------
	|   Place Order                             |
	|--------------------------------------------
    */
    place_order: function () {
        form = $("#place-order-form");
        var request = {
            url: config.url + 'cart/order',
            method: 'post',
            data: form.serialize(),
            beforeSend: function () {
                $("#btn-submit").hide();
                $("#btn-loader").show();
            },
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                // $.notify(response.success,
                //     {
                //         type: "success",
                //         align: "bottom",
                //         verticalAlign: "middle"
                //     }
                // )
                window.location.replace(response.url);
            } else if (response.error) {
                $("#btn-submit").show();
                $("#btn-loader").hide();
                _alert.display_errors(response.error_message);
            }
        });
    },
    /*
	|--------------------------------------------
	|   View single order detail                |
	|--------------------------------------------
    */
    view_order: function (_this) {
        r_id = $(_this).closest(".order-box");
        var request = {
            url: config.url + "cart/order_view",
            method: "POST",
            data: {
                id: r_id.attr("data-id")
            },
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                var html = '';

                var i = 1;
                $.each(response.data, function (key, value) {

                    html += '<tr>';
                    html += '<td>' + i + '</td>';
                    html += '<td class="wide-column">' + value['p_title'] + '</td>';
                    html += '<td class="text-capitalize">' + value['oi_qty'] + '</td>';
                    html += '<td class="wide-column">$' + value['oi_subtotal'] + '</td>';
                    html += '</tr>';

                    i++;
                });
                $("#order-items-detail").html("");
                $("#order-items-detail").append(html);

                $("#view-order-detail-modal").modal("show");
            }
        });
    },

} // end of class product