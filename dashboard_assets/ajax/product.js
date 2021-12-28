var categories_table;
var shipping_charges_table;
var orders_table;

var _product = {

    //--------------- categories-----------------//
    /*
    |-----------------------------------------------------
    |	 add Category                                    |
    |-----------------------------------------------------
    */
    add_category: function () {
        form = $("#add-category-form");
        var request = {
            url: config.url + 'products/add_category',
            method: "POST",
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.success(response.message);
                
                $("#add-category-form")[0].reset();
                _alert.remove_errors();
                $("#add-category").modal("hide");
                categories_table.ajax.reload();
            } else if (response.error) {
                //_alert.display_errors(response.error_message);
                $('input[name="title"]').next().html(response.error_message);
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Get list of  categories                         |
    |    by ajax,   for datatables                       |
    |-----------------------------------------------------
    */
    get_categories: function () {
        categories_table = $('#categories').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            serverSide: true,
            ajax: {
                url: config.url + 'products/get_categories',
                type: 'POST',
            },
            autoWidth: false
        })
    },
    /*
    |-----------------------------------------------------
    |	 view single Category (for Update)               |
    |-----------------------------------------------------
    */
    view_category: function (_this) {
        var cate_id = $(_this).attr('id');
        var request = {
            url: config.url + 'products/view_category',
            method: "post",
            data: { id: cate_id },
        }
        $.ajax(request).done(function (response) {

            response = $.parseJSON(response);
            if (response.success) {
                var html = '';
                $.each(response.data, function (key, value) {

                    html += '<input type="hidden" id="category_id" name="category_id" value="' + value['c_id'] + '">';
                    html += '<div class="form-group">';
                    html += '<label for="title">Title</label>';
                    html += '<input type="text" class="form-control error" name="title" id="title" value="' + value['c_title'] + '" placeholder="Title">';
                    html += '<span class="small text-danger"></span>';
                    html += '</div>';

                });
                $("#update-category-form").html("");
                $("#update-category-form").append(html);

                $("#update-category").modal("show");
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Update  Category                                |
    |-----------------------------------------------------
    */
    update_category: function () {
        form = $("#update-category-form");
        var request = {
            url: config.url + 'products/update_category',
            method: "POST",
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.remove_errors();
                $("#update-category").modal("hide");
                _alert.success(response.message);
                categories_table.ajax.reload();
            } else if (response.error) {
                $('input[name="title"]').next().html(response.error_message);
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Delete  Category                                |
    |-----------------------------------------------------
    */
    delete_category: function (_this) {
        $.confirm({
            text: "Are you sure you want to delete?",
            title: "Confirmation required",
            confirm: function(button) {

                // ---------------ajax code------------
                var cate_id = $(_this).attr('id');
                var request = {
                    url: config.url + 'products/delete_category',
                    method: "POST",
                    data: { id: cate_id },
                }
                $.ajax(request).done(function (response) {
                    response = $.parseJSON(response);
                    if (response.success) {
                        _alert.success(response.message);
                        categories_table.ajax.reload();
                    }
                });
                // -------------ajax code-------------
                
            },
            cancel: function(button) {
               
            },
            confirmButton: "Yes I am",
            cancelButton: "No",
            post: false,
            submitForm: false,
            confirmButtonClass: "btn-danger btn-lg",
            cancelButtonClass: "btn-default btn-lg",
            dialogClass: "modal-dialog modal-sm" // Bootstrap classes for large modal
        });
        
    },


    // ------------------- Shipping ------------------------//
    /*
    |-----------------------------------------------------
    |	 add Shipping Charges                             |
    |-----------------------------------------------------
    */
    add_shipping_charges: function () {
        form = $("#add-shipping-charge-form");
        var request = {
            url: config.url + 'products/add_shipping_charge',
            method: "POST",
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.success(response.message);

                $("#add-shipping-charge-form")[0].reset();
                _alert.remove_errors();
                $("#add-shipping-charge").modal("hide");
                shipping_charges_table.ajax.reload();
            } else if (response.error) {
                _alert.remove_errors();
                //$('input[name="title"]').next().html(response.error_message);
                _alert.display_errors(response.error_message);
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Get list of  countries and charges              |
    |    by ajax,   for datatables                       |
    |-----------------------------------------------------
    */
    get_shipping_charges: function () {
        shipping_charges_table = $('#shipping').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            serverSide: true,
            ajax: {
                url: config.url + 'products/get_shipping_charges',
                type: 'POST',
            },
            autoWidth: false
        })
    },
    /*
    |-----------------------------------------------------
    |	 view single shipping charges (for Update)       |
    |-----------------------------------------------------
    */
    view_shipping_charge: function (_this) {
        var country_id = $(_this).attr('id');
        var request = {
            url: config.url + 'products/view_shipping_charge',
            method: "post",
            data: { id: country_id },
        }
        $.ajax(request).done(function (response) {

            response = $.parseJSON(response);
            if (response.success) {
                var html = '';
                $.each(response.data, function (key, value) {

                    
                    html += '<div class="form-group">';
                    html += '<label for="title">Country Title</label>';
                    html += '<input type="text" class="form-control error" name="title" id="title" value="' + value['country_title'] + '" placeholder="Title">';
                    html += '<span class="small text-danger"></span>';
                    html += '</div>';

                    html += '<div class="form-group">';
                    html += '<label for="title">Shipping Charges ($)</label>';
                    html += '<input type="text" class="form-control error" name="charge" id="charge" value="' + value['country_charges'] + '" placeholder="$">';
                    html += '<span class="small text-danger"></span>';
                    html += '</div>';

                    html += '<input type="hidden" id="country_id" name="country_id" value="' + value['country_id'] + '">';

                });
                $("#update-shipping-charge-form").html("");
                $("#update-shipping-charge-form").append(html);

                $("#update-shipping-charge").modal("show");
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Update  shipping charge                               |
    |-----------------------------------------------------
    */
    update_shipping_charge: function () {
        form = $("#update-shipping-charge-form");
        var request = {
            url: config.url + 'products/update_shipping_charge',
            method: "POST",
            data: form.serialize(),
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.remove_errors();
                $("#update-shipping-charge").modal("hide");
                _alert.success(response.message);
                shipping_charges_table.ajax.reload();
            } else if (response.error) {
                _alert.remove_errors();
                //$('input[name="title"]').next().html(response.error_message);
                _alert.display_errors(response.error_message);
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Delete  shipping charges                        |
    |-----------------------------------------------------
    */
    delete_shipping_charge: function (_this) {
        $.confirm({
            text: "Are you sure you want to delete?",
            title: "Confirmation required",
            confirm: function (button) {

                // ---------------ajax code------------
                var country_id = $(_this).attr('id');
                var request = {
                    url: config.url + 'products/delete_shipping_charge',
                    method: "POST",
                    data: { id: country_id },
                }
                $.ajax(request).done(function (response) {
                    response = $.parseJSON(response);
                    if (response.success) {
                        _alert.success(response.message);
                        shipping_charges_table.ajax.reload();
                    }
                });
                // -------------ajax code-------------

            },
            cancel: function (button) {

            },
            confirmButton: "Yes I am",
            cancelButton: "No",
            post: false,
            submitForm: false,
            confirmButtonClass: "btn-danger btn-lg",
            cancelButtonClass: "btn-default btn-lg",
            dialogClass: "modal-dialog modal-sm" // Bootstrap classes for large modal
        });

    },


    // ------------------- orders ------------------------//
    /*
    |-----------------------------------------------------
    |	 Get list of  orders                             |
    |    by ajax,   for datatables                       |
    |-----------------------------------------------------
    */
    get_orders: function () {
        orders_table = $('#orders').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            serverSide: true,
            ajax: {
                url: config.url + 'products/get_orders',
                type: 'POST',
            },
            autoWidth: false,
            language: {
                searchPlaceholder: "Search order id"
            }
        })
    },
    /*
    |-----------------------------------------------------
    |	 view single order (for Update)                  |
    |-----------------------------------------------------
    */
    view_order: function (_this) {
        var id = $(_this).attr('id');
        var request = {
            url: config.url + 'products/view_order',
            method: "post",
            data: { id: id },
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                
                if (response.order) {
                    var html = '';
                    var order = response.order;
                    var alertClass = '';
                    //console.log(order[0]);
                    if (order[0]['order_status'] == 'pending') {
                        alertClass = 'alert-warning';
                    } else if (order[0]['order_status'] == 'delivered') {
                        alertClass = 'alert-success';
                    } else if (order[0]['order_status'] == 'processing') {
                        alertClass = 'alert-info';
                    } else if (order[0]['order_status'] == 'cancelled') {
                        alertClass = 'alert-danger';
                    }

                    
                    
                    html += '<div class="col-sm-12">';
                    html += '<div class="alert ' + alertClass + ' text-capitalize text-center" role="alert">' + order[0]['order_status'] + '</div>';
                    html += '</div>';
                    html += '<div class="col-md-6">';
                    html += '<p>';
                    html += '<strong>Order ID#' + order[0]['order_id'] + '</strong><br>';
                    html += '<strong>User ID#' + order[0]['order_user_id'] + '</strong><br>';

                    // if invoice paid
                    if (order[0]['txConfirmed'] == 1 && order[0]['processed'] == 1) {
                        html += '<strong>Invoice  :<span style="font-size: 1.3em; font-weight: 600; color: #00bf3b;">' + ' Paid' + '</span></strong><br>';
                    } else if ((order[0]['txConfirmed'] == 0 || order[0]['processed'] == 0) || (order[0]['txConfirmed'] == null || order[0]['processed'] == null)) {
                        html += '<strong>Invoice  :<span style="font-size: 1.3em; font-weight: 600; color: #fb1919;">' + ' Unpaid' + '</span></strong><br>';
                    }

                   
                    html += '</p>';
                    html += '</div>';
                    html += '<div class="col-md-6">';
                    html += '<div class="text-right">';
                    html += '<p>';
                    html += '<strong>Subtotal : $' + response.subtotal + '</strong><br>';
                    html += '<strong>Shipping : $' + order[0]['shipping_charges'] + '</strong><br>';
                    html += '<strong>Total    : $' + order[0]['order_total_amount'] + '</strong><br>';
                    html += '<strong>BTC      :' + order[0]['amount'] + '</strong><br>';
                    html += '</p>';
                    html += '</div>';
                    html += '</div>';
                    // shipping Address
                    html += '<div class="col-md-12">';
                    html += '<p><span style="font-weight: 600;">Shipping Address: </span>'+ response.address +'</p>';
                    html += '</div>';
                    $("#order-d").html("");
                    $("#order-d").append(html);
                }
                


                var html = '';
                $.each(response.data, function (key, value) {

                    html += '<tr>';
                    html += '<td>' + value['p_title'] + '</td>';
                    html += '<td>' + value['oi_qty'] + '</td>';
                    html += '<td>$' + value['oi_subtotal'] + '</td>';
                    html += '</tr>';

                });
                $("#order-item-detail").html("");
                $("#order-item-detail").append(html);

                $("#order-input-id").html("");
                $("#order-input-id").append('<input type="hidden" name="order_id" id="order_id" value="' + response.order_id_protected + '">')

                $("#update-order").modal("show");
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Update  Order Status                             |
    |-----------------------------------------------------
    */
    update_order_status: function () {
        form = $("#change-status-form");
        if($('select').val() === 'delivered'){
            $.confirm({
                text: "Are you sure you want to change Status to delivered? Shipping address will be deleted.",
                title: "Confirmation required",
                confirm: function(button) {
    
                    // ---------------ajax code------------
                    var request = {
                        url: config.url + 'products/update_order_status',
                        method: "POST",
                        data: form.serialize(),
                    }
                    $.ajax(request).done(function (response) {
                        response = $.parseJSON(response);
                        if (response.success) {
                            _alert.remove_errors();
                            $("#update-order").modal("hide");
                            _alert.success(response.message);
                            if(response.url){
                                window.location.replace(response.url);
                            }else{
                                orders_table.ajax.reload();
                            }
                            
                        }
                    });
                    // -------------ajax code-------------
                    
                },
                cancel: function(button) {
                   
                },
                confirmButton: "Yes I am",
                cancelButton: "No",
                post: false,
                submitForm: false,
                confirmButtonClass: "btn-danger btn-lg",
                cancelButtonClass: "btn-default btn-lg",
                dialogClass: "modal-dialog modal-sm" // Bootstrap classes for large modal
            });
        }else{
            var request = {
                url: config.url + 'products/update_order_status',
                method: "POST",
                data: form.serialize(),
            }
            $.ajax(request).done(function (response) {
                response = $.parseJSON(response);
                if (response.success) {
                    _alert.remove_errors();
                    $("#update-order").modal("hide");
                    _alert.success(response.message);
                    if(response.url){
                        window.location.replace(response.url);
                    }else{
                        orders_table.ajax.reload();
                    }
                    
                }
            });
        }
        
    },
    /*
    |-----------------------------------------------------
    |	 Delete  order                                   |
    |-----------------------------------------------------
    */
    delete_order: function (_this) {
        $.confirm({
            text: "Are you sure you want to delete?",
            title: "Confirmation required",
            confirm: function(button) {

                // ---------------ajax code------------
                var id = $(_this).attr('id');
                var request = {
                    url: config.url + 'products/delete_order',
                    method: "POST",
                    data: { id: id },
                }
                $.ajax(request).done(function (response) {
                    response = $.parseJSON(response);
                    if (response.success) {
                        _alert.success(response.message);
                        orders_table.ajax.reload();
                    }
                });
                // -------------ajax code-------------
                
            },
            cancel: function(button) {
               
            },
            confirmButton: "Yes I am",
            cancelButton: "No",
            post: false,
            submitForm: false,
            confirmButtonClass: "btn-danger btn-lg",
            cancelButtonClass: "btn-default btn-lg",
            dialogClass: "modal-dialog modal-sm" // Bootstrap classes for large modal
        });
    },


    // ------------------- Products ------------------------//
    /*
    |-----------------------------------------------------
    |	 add product                                    |
    |-----------------------------------------------------
    */
    add_product: function () {
        form = $("#add-product-form");
        var formData = new FormData($('#add-product-form')[0]);
        var request = {
            url: config.url + 'products/add_product',
            method: "POST",
            // data: form.serialize(),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.success(response.message);

                $("#add-product-form")[0].reset();
                _alert.remove_errors();


                // reset dropify
                var drEvent = $('#second_thumb').dropify();
                drEvent = drEvent.data('dropify');
                drEvent.clearElement();

                var drEvent = $('#thumb').dropify();
                drEvent = drEvent.data('dropify');
                drEvent.clearElement();

            } else if (response.error) {
                _alert.remove_errors();
                //$('input[name="title"]').next().html(response.error_message);
                _alert.display_errors(response.error_message);
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 update product                                    |
    |-----------------------------------------------------
    */
    update_product: function () {
        form = $("#update-product-form");
        var formData = new FormData($('#update-product-form')[0]);
        var request = {
            url: config.url + 'products/update_product',
            method: "POST",
            // data: form.serialize(),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.success(response.message);

                _alert.remove_errors();

                // reset dropify
                var drEvent = $('#second_thumb').dropify();
                drEvent = drEvent.data('dropify');
                drEvent.clearElement();

                var drEvent = $('#thumb').dropify();
                drEvent = drEvent.data('dropify');
                drEvent.clearElement();
                
                window.location.replace(response.url);
            } else if (response.error) {
                _alert.remove_errors();
                //$('input[name="title"]').next().html(response.error_message);
                _alert.display_errors(response.error_message);
            }
        });
    },
    /*
    |-----------------------------------------------------
    |	 Delete  Product                                 |
    |-----------------------------------------------------
    */
    delete_product: function (_this) {
        $.confirm({
            text: "Are you sure you want to delete?",
            title: "Confirmation required",
            confirm: function (button) {

                // ---------------ajax code------------
                r_id = $(_this).closest(".product-box");
                var request = {
                    url: config.url + "products/delete_product",
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
                            _alert.success(response.message);
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
                // -------------ajax code-------------

            },
            cancel: function (button) {

            },
            confirmButton: "Yes I am",
            cancelButton: "No",
            post: false,
            submitForm: false,
            confirmButtonClass: "btn-danger btn-lg",
            cancelButtonClass: "btn-default btn-lg",
            dialogClass: "modal-dialog modal-sm" // Bootstrap classes for large modal
        });
    },

    /*
    |-----------------------------------------------------
    |	 Change Product status                           |
    |-----------------------------------------------------
    */
   change_product_status: function(_this){
       r_id = $(_this).closest(".product-box").attr("data-id");
       value = $(_this).closest(".product-box").find("select").val();
    //    alert(value);
    //    return;
       
       var request = {
            url: config.url + "update-product-status",
            method: "POST",
            data: {
                value: value, id :  r_id
            },
        }
        $.ajax(request).done(function (response) {
            response = $.parseJSON(response);
            if (response.success) {
                _alert.success(response.message);
            } else if (response.error) {
                _alert.error(response.error_message);
            }
        });
   }



} // end of class product