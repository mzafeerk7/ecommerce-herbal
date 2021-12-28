<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  "application/libraries/cryptobox/cryptobox.class.php";
class Cart extends CI_Controller {

    public function __construct(){
		parent::__construct();
        // loading library
		$this->load->library('form_validation');
        $this->load->library('cart');
       // $this->load->library('Crypto');


		//  loading Models
        $this->load->model('Products_m');
    }
    /*
	|-----------------------------------------------------
	|	 View Cart                                       |
	|-----------------------------------------------------
    */
    public function cart_view(){
        // get categories
        $parameters = array(
            'table' => 'categories_tbl'
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        
        $data['cart_link'] = true;
        $data['page_content'] = 'products/cart';
        $this->load->view('main_view', $data);
    }
    /*
	|-----------------------------------------------------
	|	 add item to cart                                |
	|-----------------------------------------------------
    */
    public function add_item_to_cart(){
        $product_id = decrypt_id($this->input->post('id'));

        $parameters = array(
            'search_column' => 'products_tbl.p_id',
            'search_value' => $product_id
        );
        $columns =  'products_tbl.p_id, products_tbl.p_title, products_tbl.p_price, products_tbl.p_thumb';
        $product = $this->Products_m->get_products($columns, $parameters);

        // here using the cart library
        if($product){
            $data = array(
                'id'      => $product[0]['p_id'],
                'qty'     => 1,
                'price'   => $product[0]['p_price'],
                'name'    => $product[0]['p_title'],
                'options' => array('image' => $product[0]['p_thumb'])
            );
            $this->cart->insert($data);
            exit(json_encode(["success" => "Product successfully added to cart.", "itemCount" => $this->cart->total_items()]));     
        }else{
            exit(json_encode(['error' => 'Select a valid product']));
        }
    }
    /*
	|-----------------------------------------------------
	|	 Remove item from cart                           |
	|-----------------------------------------------------
    */
    public function remove_item_from_cart(){
        $rowid = $this->input->post('id');

        if($this->cart->remove($rowid)){
            exit(json_encode(["success" => "Product has been removed.", "itemCount" => $this->cart->total_items() , "totalPrice" => $this->cart->total()])); 
        }else{
            exit(json_encode(['error' => 'Select a valid product']));
        }
    }
    /*
	|-----------------------------------------------------
	|	 Update qty of item                              |
	|-----------------------------------------------------
    */
    public function update_item_qty(){
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        
        if($this->cart->update($data)){
            $item_data = $this->cart->get_item($rowid);
            $item_subtotal = $item_data['subtotal'];
            exit(json_encode([ "success" => true, "itemCount" => $this->cart->total_items() , "totalPrice" => $this->cart->total(), "subtotal" => $item_subtotal])); 
        }
    }

    /*
	|-----------------------------------------------------
	|	 Checkout                                        |
	|-----------------------------------------------------
    */
    public function proceed_to_checkout(){
        // get categories
        $parameters = array(
            'table' => 'categories_tbl'
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        // Get Countries list and charges
        $parameters = array(
            'table' => 'country_charges_tbl'
        );
        $data['countries'] = $this->Products_m->get(null, $parameters);

        // // get products detail for checkout
        // $cart_products = array();
        // foreach($_SESSION["cart"] as $product_id){
        //     $parameters = array(
        //         'search_column' => 'products_tbl.p_id',
        //         'search_value' => $product_id
        //     );
        //     $columns =  'products_tbl.p_title, products_tbl.p_price';
        //     $cart_products[] = $this->Products_m->get_products($columns, $parameters);
        // }
        // $data['cart_products'] = $cart_products;

        $data['page_content'] = 'products/checkout';
        $this->load->view('main_view', $data);
    }
    /*
	|-----------------------------------------------------
	|	 Get shippping charges against country           |
	|-----------------------------------------------------
    */
    public function get_shipping_charges(){
        $country_id = decrypt_id($this->input->post('id'));
        if(isset($country_id) && !empty($country_id)){
            $parameters = array(
                'table' => 'country_charges_tbl',
                'search_column' => 'country_id',
                'search_value' => $country_id
            );
            $charges = $this->Products_m->get(null, $parameters);
            if($charges){
                $_SESSION['country']['id'] = $charges[0]['country_id'];
                $_SESSION['country']['charges'] = $charges[0]['country_charges'];
                $total = number_format($this->cart->total() + $charges[0]['country_charges'], 2);
                exit(json_encode(["success" => true, "charges" => $charges[0]['country_charges'], 'total' => $total ])); 
            }
        }        
    }
    /*
	|-----------------------------------------------------
	|	 place order                                     |
	|-----------------------------------------------------
    */
    public function place_order(){
        isUserLoggedIn();

        if(empty($_SESSION['country']['charges']) || $_SESSION['country']['charges'] == ''){
            $errors['country-charge'] = '<span>Select Country</span>';
            exit(json_encode(['error'=> true, 'error_message' => $errors ]));  
        }

        $validate = array(
            array(
                "field" => "shipping_address",
                "label" => "Shipping Address",
                "rules" => "required",
            )
        );
		$this->form_validation->set_rules($validate);
		$this->form_validation->set_error_delimiters('<span>', '</span>');
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
				$errors = array();
				foreach($this->input->post() as $key => $val){
                    $errors[$key] = form_error($key);
                }
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
            }
		}else{
            $act = $this->input->post('act');
            if($act === 'place_ord'){
                // get shipping charges 
                $parameters = array(
                    'table' => 'country_charges_tbl',
                    'search_column' => 'country_id',
                    'search_value' => $_SESSION['country']['id']
                );
                $charges = $this->Products_m->get(null, $parameters);
                if($charges){
                    if($this->cart->contents()){
                        $order_data = array(
                            'order_user_id' => $_SESSION['user_id'],
                            'shipping_charges' => $charges[0]['country_charges'],
                            'order_total_amount' => $this->cart->total() + $charges[0]['country_charges'],
                            'order_status' => 'pending',
                            'order_date' => date('Y-m-d')
                        );
                        $order_id =  $this->Products_m->place_order($order_data);
                        if($order_id){
                            foreach($this->cart->contents() as $item){
                                $items_data = array(
                                    'oi_p_id' => $item['id'],
                                    'oi_order_id' => $order_id,
                                    'oi_qty' => $item['qty'],
                                    'oi_subtotal' => $item['subtotal']
                                );
                                $status =  $this->Products_m->place_order_items($items_data);
                                //$_SESSION['order_id'] = $order_id;
                            }
                            $shipping_detail = array(
                                'table' => 'shipping_address_tbl',
                                'data' => array(
                                    'shipping_order_id' => $order_id,
                                    'shipping_user_id' => encrypt_id($_SESSION['user_id']),
                                    'shipping_address' => encrypt_id($this->input->post('shipping_address'))
                                )
                            );
                            $this->Products_m->insert($shipping_detail);
                            unset($_SESSION['country']);
                            $this->cart->destroy();
                            exit(json_encode(['success' => 'Order has been placed successfully', 'url' => base_url().'account/pay/'.encrypt_id($order_id) ]));
                        }
                    }
                }

                
            }
        }
    }
    /*
	|-----------------------------------------------------
	|	 message after placing order                     |
	|-----------------------------------------------------
    */
    public function order_message(){
        isUserLoggedIn();
        $data['page_content'] = 'products/order_message';
        $this->load->view('main_view', $data);
    }
    /*
	|-----------------------------------------------------
	|	 View orders detail with qty, subtotal, item etc |
	|-----------------------------------------------------
    */
    public function view_order_detail(){
        isUserLoggedIn();
        $order_id = decrypt_id($this->input->post('id'));
        if($order_id){
            // for testing, get order detail with item
            $parameters = array(
                'search_column' => 'orders_tbl.order_user_id',
                'search_value' =>  $_SESSION['user_id'],
                'search_column2' => 'order_items_tbl.oi_order_id',
                'search_value2' =>  $order_id
            );
            $columns = 'order_items_tbl.oi_subtotal, order_items_tbl.oi_qty, products_tbl.p_title';
            $data = $this->Products_m->get_order_detail($columns, $parameters);
            if($data){
                exit(json_encode(['success' => true, 'data' => $data]));
            }
            //dataTest($data['order_detail']);
        }
    }
 





}