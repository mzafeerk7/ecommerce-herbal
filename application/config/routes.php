<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


//  single product detail routing
$route['products/view/(:any)'] = 'products/product_detail/$1';

//A URL containing the word “about” in the first segment will be remapped to the “contact/about” class/method.
$route['about'] = 'contact/about';
$route['contact'] = 'contact/contact_us';


//  for searching and product catalog, (.+) catch multiple segments at once
$route['products/catalog/(.+)'] = 'products/products_categorized_catalog/$1';

// searching products by user query
$route['products/search'] = 'products/search_products_by_query';

//  Add Item to cart
$route['cart/add'] = 'cart/add_item_to_cart';
//  view cart detail
$route['cart/view'] = 'cart/cart_view';
// remove item from cart
$route['cart/remove'] = 'cart/remove_item_from_cart';
//proceed to checkout
$route['cart/checkout'] = 'cart/proceed_to_checkout';
// placing order
$route['cart/order'] = 'cart/place_order';

// get cart item list by json
$route['cart/list'] ='cart/get_cart_items_list';

// update the qty of item
$route['cart/qty'] = 'cart/update_item_qty';

// user profile dashboard
$route['account/profile'] = 'account/user_profile';

// Order message after placing order
$route['cart/omessage'] = 'cart/order_message';

// view order detail withs items, qty, title etch
$route['cart/order_view'] = 'cart/view_order_detail';

// IPN ( after payment callback url)
$route['payment-callback'] = 'account/ipncallback';

//  when payment made then processing message
$route['account/payment-process'] = 'account/payment_processing_message';
//================================================ Routing for Dashboard =======================//

// login
$route['admin/login'] = 'admin/account/login';
// logout
$route['admin/logout'] = 'admin/account/logout';

// manage categories
$route['admin/products/categories'] = 'admin/products/manage_categories';


// mange products
$route['admin/manage-products-list'] = 'admin/products/manage_products';
// add product
$route['admin/add-product'] = 'admin/products/add_product';
// update product
$route['admin/update-product/(:any)'] = 'admin/products/update_product/$1';

// change product status
$route['admin/update-product-status'] = 'admin/products/update_product_status';

// Shipping Charges
$route['admin/manage-shipping-charges'] = 'admin/products/manage_shipping_charges';


// manage orders
$route['admin/products/orders/(:any)'] = 'admin/products/manage_orders/$1';
// change password
$route['admin/change-password'] = 'admin/account/change_password';

$route['default_controller'] = 'products';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
