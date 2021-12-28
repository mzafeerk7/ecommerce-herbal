<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){
        parent::__construct();
        isAdminLoggedIn();
        
        $this->load->library('form_validation');


		//  loading Models
        $this->load->model('Products_m');
    }
    private $allowed_status = array('pending','processing', 'delivered','cancelled');

    /*
	|-----------------------------------------------------
	|	 Manage Categories                               |
	|-----------------------------------------------------
    */
    public function manage_categories(){
        // get categories
        $parameters = array(
            'table' => 'categories_tbl'
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        $data['active'] = 'categories';
        $data['categories_link'] = true;
        $data['datatables_link'] = true;
        $data['page_content'] = 'dashboard/categories/manage_categories';
        $this->load->view('dashboard/main_view', $data);
    }
    /*
	|-----------------------------------------------------
    |	Get Categories list by ajax call                 |
    |   for datatables                                   |
	|-----------------------------------------------------
    */
    public function get_categories(){
        //---- these are parameters of array , for the use of common function (made by me) ---///
        $parameters = array(
            'tableName' => 'categories_tbl',    // must
            'columns' => array('c_id', 'c_title'),        //optional, or *
            //'status' => 'ac_status',                        //optional
            'order_by' => 'c_id',                          //must
            'order_by_value' => 'ASC',
            'search_title' => 'c_title',                   // must
            'model_name' => 'Functions_m',                   //  must 
            'update_function' => '_product.view_category(this);', //must 
            'delete_function' => '_product.delete_category(this);', // must       
        );
        //  columns for datatable and for geting result from DB 
        $table_columns = array('c_title');
       echo  get_data($parameters, $table_columns);
    }
    /*
	|-----------------------------------------------------
	|	Add  Category                		             |
	|-----------------------------------------------------
    */
    public function add_category(){
        $validate = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
                exit(json_encode(['error' => true, 'error_message' => validation_errors() ]));
            }
        }else{
            $parameters = array(
                'table' => 'categories_tbl',
                'data' => array(
                    'c_title' => $this->input->post('title')
                )
            );
            $status = $this->Products_m->insert($parameters);
            if($status){
                exit(json_encode(['success' => true, 'message' => 'Category has been added'] ));
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	 view single  Category (for Update)              |
    |-----------------------------------------------------
    */
    public function view_category(){
        $category_id = decrypt_id($this->input->post('id'));
        $parameters = array(
            'table' => 'categories_tbl',
            'search_column' => 'c_id',
            'search_value' => $category_id
        );
        $data = $this->Products_m->get(null, $parameters);
        if($data){
            $data[0]['c_id'] = encrypt_id($data[0]['c_id']);
            //dataTest($data);
            exit(json_encode(['success' => true, 'data' => $data]));
        }
    }
    /*
    |-----------------------------------------------------
    |	 Update  Category                                |
    |-----------------------------------------------------
    */
    public function update_category(){
        $validate = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
                exit(json_encode(['error' => true, 'error_message' => validation_errors()]));
            }
        }else{
            $category_id = decrypt_id($this->input->post('category_id'));
            if($category_id){
                $parameters = array(
                    'table' => 'categories_tbl',
                    'search_column' => 'c_id',
                    'search_value' => $category_id,
                    'data' => array(
                        'c_title' => $this->input->post('title')
                    )
                );
                $status = $this->Products_m->update($parameters);
                if($status){
                    exit(json_encode(['success' => true, 'message' => 'Category has been udpated' ]));
                }
            }
            
        }   
    }
    /*
    |-----------------------------------------------------
    |	Delete  Category                                 |
    |-----------------------------------------------------
    */
    public function delete_category(){
        $category_id =  decrypt_id($this->input->post('id'));
        if($category_id){
            $parameters = array(
                'table' => 'categories_tbl',
                'search_column' => 'c_id',
                'search_value' => $category_id,
                'data' => array(
                    'c_id' => $category_id
                )
            );
            $status = $this->Products_m->delete($parameters);
            if($status){
                exit(json_encode(['success' => true, 'message' => 'Category has been deleted' ]));
            }
        } 
    }


    // -----------------------Shipping Charges -------------------//
    /*
	|-----------------------------------------------------
	|	 Manage shipping Charges                         |
	|-----------------------------------------------------
    */
    public function manage_shipping_charges(){
        // get countries and charges
        $parameters = array(
            'table' => 'country_charges_tbl',
        );
        $data['countries'] = $this->Products_m->get(null, $parameters);

        $data['active'] = 'shipping';
        $data['shipping_link'] = true;
        $data['datatables_link'] = true;
        $data['page_content'] = 'dashboard/shipping/manage_shipping_charges';
        $this->load->view('dashboard/main_view', $data);
    }
    /*
	|-----------------------------------------------------
    |	Get Shipping charges list by ajax call           |
    |   for datatables, (countries, charges)             |
	|-----------------------------------------------------
    */
    public function get_shipping_charges(){
        //---- these are parameters of array , for the use of common function (made by me) ---///
        $parameters = array(
            'tableName' => 'country_charges_tbl',    // must
            'columns' => array('country_id', 'country_title', 'country_charges'),        //optional, or *
            //'status' => 'ac_status',                        //optional
            'order_by' => 'country_id',                          //must
            'order_by_value' => 'ASC',
            'search_title' => 'country_title',                   // must
            'model_name' => 'Functions_m',                   //  must 
            'update_function' => '_product.view_shipping_charge(this);', //must 
            'delete_function' => '_product.delete_shipping_charge(this);', // must       
        );
        //  columns for datatable and for geting result from DB 
        $table_columns = array('country_title', 'country_charges');
       echo  get_data($parameters, $table_columns);
    }
    /*
	|-----------------------------------------------------
	|	Add  Shipping Charges               		     |
	|-----------------------------------------------------
    */
    public function add_shipping_charge(){
        $validate = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required"
            ),
            array(
                "field" => "charge",
                "label" => "Shipping Charges",
                "rules" => "required|numeric"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
				$errors = array();
				foreach($this->input->post() as $key => $val){
                    $errors[$key] = form_error($key);
                }
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
            }
        }else{
            $parameters = array(
                'table' => 'country_charges_tbl',
                'data' => array(
                    'country_title' => $this->input->post('title'),
                    'country_charges' => $this->input->post('charge'),
                    
                )
            );
            $status = $this->Products_m->insert($parameters);
            if($status){
                exit(json_encode(['success' => true, 'message' => 'Shipping Charges has been added'] ));
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	 view single  Shipping Charge (for Update)       |
    |-----------------------------------------------------
    */
    public function view_shipping_charge(){
        $country_id = decrypt_id($this->input->post('id'));
        $parameters = array(
            'table' => 'country_charges_tbl',
            'search_column' => 'country_id',
            'search_value' => $country_id
        );
        $data = $this->Products_m->get(null, $parameters);
        if($data){
            $data[0]['country_id'] = encrypt_id($data[0]['country_id']);
            //dataTest($data);
            exit(json_encode(['success' => true, 'data' => $data]));
        }
    }
    /*
    |-----------------------------------------------------
    |	 Update shipping charge                              |
    |-----------------------------------------------------
    */
    public function update_shipping_charge(){
        $validate = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required"
            ),
            array(
                "field" => "charge",
                "label" => "Shipping Charges",
                "rules" => "required|numeric"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
				$errors = array();
				foreach($this->input->post() as $key => $val){
                    $errors[$key] = form_error($key);
                }
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
            }
        }else{
            $country_id = decrypt_id($this->input->post('country_id'));
            if($country_id){
                $parameters = array(
                    'table' => 'country_charges_tbl',
                    'search_column' => 'country_id',
                    'search_value' => $country_id,
                    'data' => array(
                        'country_title' => $this->input->post('title'),
                        'country_charges' => $this->input->post('charge'),
                    )
                );
                $status = $this->Products_m->update($parameters);
                if($status){
                    exit(json_encode(['success' => true, 'message' => 'Shipping charges has been udpated' ]));
                }
            }
            
        }   
    }
    /*
    |-----------------------------------------------------
    |	Delete  shipping charges                         |
    |-----------------------------------------------------
    */
    public function delete_shipping_charge(){
        $country_id =  decrypt_id($this->input->post('id'));
        if($country_id){
            $parameters = array(
                'table' => 'country_charges_tbl',
                'search_column' => 'country_id',
                'search_value' => $country_id,
                'data' => array(
                    'country_id' => $country_id
                )
            );
            $status = $this->Products_m->delete($parameters);
            if($status){
                exit(json_encode(['success' => true, 'message' => 'Shipping charges has been deleted' ]));
            }
        } 
    }



    // -----------------------Orders -------------------//
    /*
	|-----------------------------------------------------
	|	 Manage orders                                    |
	|-----------------------------------------------------
    */
    public function manage_orders(){
       $act = $this->uri->segment(4);

        if (in_array($act, $this->allowed_status)){
            $data['table_title'] = $act;
            $this->session->set_userdata(array('order_condition' => $act));
        }else{
            $data['table_title'] = 'all';
            $this->session->set_userdata(array('order_condition' => 'all'));
        }
        $data['active'] = 'orders';
        $data['orders_link'] = true;
        $data['datatables_link'] = true;
        $data['page_content'] = 'dashboard/orders/manage_orders';
        $this->load->view('dashboard/main_view', $data);
    }
    /*
	|-----------------------------------------------------
    |	Get orders list by ajax call                     |
    |   for datatables                                   |
	|-----------------------------------------------------
    */
    public function get_orders(){
        //---- these are parameters of array , for the use of common function (made by me) ---///
        $parameters = array(
            'tableName' => 'orders_tbl',    // must
            'columns' => array('order_id', 'order_total_amount', 'order_status', 'order_date'),//optional, or *
            //'status' => 'ac_status',                        //optional
            'order_by' => 'order_id',                          //must
            'order_by_value' => 'DESC',
            'search_title' => 'order_id',                   // must
            'model_name' => 'Functions_m',                   //  must 
            'update_function' => '_product.view_order(this);', //must 
            'delete_function' => '_product.delete_order(this);', // must  
            //'condition' => array('order_status' => 'processing')     
        );
        if($this->session->has_userdata('order_condition') && $this->session->userdata('order_condition') != 'all'){
            $parameters['condition'] = array('order_status' => $this->session->userdata('order_condition'));
        }
        //dataTest($parameters);
        // columns for datatable and for geting result from DB 
        $table_columns = array('order_id', 'order_status', 'order_total_amount', 'order_date');
       echo  get_data($parameters, $table_columns);
    }
    /*
    |-----------------------------------------------------
    |	 view single  order (for Update)                 |
    |-----------------------------------------------------
    */
    public function view_order(){
        $order_id = decrypt_id($this->input->post('id'));
        if($order_id){
            $parameters = array(
                'search_column' => 'orders_tbl.order_id',
                'search_value' =>  $order_id
            );
            $columns = 'order_items_tbl.oi_subtotal, order_items_tbl.oi_qty, products_tbl.p_title';
            //$columns .= 'orders_tbl.*';
            $data = $this->Products_m->get_order_detail($columns, $parameters);
            if($data){
                // calculating order subtotal without shipping charges
                $subtotal = 00.0;
                foreach($data as $item){
                    $subtotal += $item['oi_subtotal'];
                }
                $parameters = array(
                    'table' => 'orders_tbl',
                    'search_column' => 'order_id',
                    'search_value' =>  $order_id,
                    'join' => array(
                        'table2' => 'crypto_payments',
                        'key2' => 'crypto_payments.orderID',
                        'key1' => 'orders_tbl.order_id'
                    )
                );
                $columns = 'orders_tbl.*, crypto_payments.txConfirmed, crypto_payments.processed, crypto_payments.amount';
                $order_data = $this->Products_m->get($columns, $parameters);

                // get shipping address
                $parameters = array(
                    'table' => 'shipping_address_tbl',
                    'search_column' => 'shipping_order_id',
                    'search_value' => $order_id,
                    'limit' => 1
                );
                $columns = 'shipping_address_tbl.shipping_address';
                $shipping_data = $this->Products_m->get($columns, $parameters);
                if($shipping_data){
                    $address = decrypt_id($shipping_data[0]['shipping_address']);
                }else{
                    $address = '';
                }
                //dataTest($address);
                exit(json_encode([
                    'success' => true, 
                    'data' => $data, 
                    'order' => $order_data, 
                    'order_id_protected' => encrypt_id($order_data[0]['order_id']), 
                    'address' => $address,
                    'subtotal' => number_format($subtotal, 2)
                    ]));
            }
        }
        
    }
    /*
    |-----------------------------------------------------
    |	 Update  order status                            |
    |-----------------------------------------------------
    */
    public function update_order_status(){
        $validate = array(
            array(
                "field" => "order_status",
                "label" => "Status",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
                exit(json_encode(['error' => true, 'error_message' => validation_errors()]));
            }
        }else{
            $order_id = decrypt_id($this->input->post('order_id'));
            $status = $this->input->post('order_status');
            if($order_id){
                if (in_array($status, $this->allowed_status)){
                    $parameters = array(
                        'table' => 'orders_tbl',
                        'search_column' => 'order_id',
                        'search_value' => $order_id,
                        'data' => array(
                            'order_status' => $status
                        )
                    );
                    $status_check = $this->Products_m->update($parameters);
                    if($status_check){

                        // if product delivered then delete shipping address
                        if($status == 'delivered'){
                            $parameters = array(
                                'table' => 'shipping_address_tbl',
                                'search_column' => 'shipping_order_id',
                                'search_value' => $order_id,
                                'data' => array(
                                    'shipping_order_id' => $order_id
                                )
                            );
                            $this->Products_m->delete($parameters);
                        }
                        if($this->input->post('act') && $this->input->post('act') =='recent_order'){
                            exit(json_encode(['success' => true, 'message' => 'Order status has been udpated', 'url' => base_url().'admin/dashboard' ]));
                        }else{
                            exit(json_encode(['success' => true, 'message' => 'Order status has been udpated' ]));
                        }
                        
                    }
                } 
            }
        }   
    }
    /*
    |-----------------------------------------------------
    |	Delete  order                                    |
    |-----------------------------------------------------
    */
    public function delete_order(){
        $order_id =  decrypt_id($this->input->post('id'));
        if($order_id){
            // delete from order_items_tbl
            $parameters = array(
                'table' => 'order_items_tbl',
                'search_column' => 'oi_order_id',
                'search_value' => $order_id,
                'data' => array(
                    'oi_order_id' => $order_id
                )
            );
            $status = $this->Products_m->delete($parameters);

            // delete from orders_tbl
            if($status){
                $parameters = array(
                    'table' => 'orders_tbl',
                    'search_column' => 'order_id',
                    'search_value' => $order_id,
                    'data' => array(
                        'order_id' => $order_id
                    )
                );
                $status = $this->Products_m->delete($parameters);
                if($status){
                    exit(json_encode(['success' => true, 'message' => 'Order detail has been deleted' ]));
                }
            }
            
        } 
    }


    // -----------------------Orders -------------------//
    /*
	|-----------------------------------------------------
	|	 Manage Products                                 |
	|-----------------------------------------------------
    */
    public function manage_products(){
        // get products
        $columns = 'products_tbl.p_id, products_tbl.p_title, products_tbl.p_thumb, products_tbl.p_status,';
        $columns .='products_tbl.p_price, categories_tbl.c_title';
        $data['products'] = $this->Products_m->get_products($columns, null);
        //dataTest($data['products']);

        $data['active'] = 'products';
        $data['products_link'] = true;
        $data['datatables_link'] = true;
        $data['page_content'] = 'dashboard/products/manage_products';
        $this->load->view('dashboard/main_view', $data);
     }
     /*
	|-----------------------------------------------------
	|	Add  Product                   		             |
	|-----------------------------------------------------
    */
    public function add_product(){
        $validate = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required"
            ),
            array(
                "field" => "price",
                "label" => "Price",
                "rules" => "required|numeric"
            ),
            array(
                "field" => "description",
                "label" => "Description",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
				$errors = array();
				foreach($this->input->post() as $key => $val){
                    $errors[$key] = form_error($key);
                }
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
			}
            // get categories
            $parameters = array(
                'table' => 'categories_tbl'
            );
            $data['categories'] = $this->Products_m->get(null, $parameters);

            $data['active'] = 'products';
            $data['products_link']['add_product'] = true;
            $data['dropify'] = true;
            $data['page_content'] = 'dashboard/products/add_product';
            $this->load->view('dashboard/main_view', $data);  
        }else{
            $parameters = array(
                'table' => 'products_tbl',
                'data' => array(
                    'p_c_id' => $this->input->post('category'),
                    'p_title' => $this->input->post('title'),
                    'p_description' => $this->input->post('description'),
                    'p_additional_information' => $this->input->post('additional_info'),
                    'p_price' => $this->input->post('price')
                )
            );


            // if any of file is not uploaded then prevent upload file
            // for product thumb (image)
            if(is_uploaded_file($_FILES['thumb']['tmp_name'])){

                // for product second thumb (image)
                if(is_uploaded_file($_FILES['second_thumb']['tmp_name'])){

                    // for product thumb (image)
                    // pass the array of parameters
                    $img_parameters = array(
                        'path' => './assets/img/products', 
                        'size' => 5024, 
                        'types' => 'gif|png|jpg|jpeg',
                        'input_field_name' => 'thumb',
                        'rename' => true, 
                    ); 
                    $parameters["data"]["p_thumb"] = save_image_file($img_parameters);
                    
                    if($parameters["data"]["p_thumb"]){
                        // for product second thumb (image)
                        // pass the array of parameters
                        $img_parameters = array(
                            'path' => './assets/img/products', 
                            'size' => 5024, 
                            'types' => 'gif|png|jpg|jpeg',
                            'input_field_name' => 'second_thumb',
                            'rename' => true, 
                        ); 
                        $parameters["data"]["p_second_thumb"] = save_image_file($img_parameters);
                    }

                    
                }else{
                    $errors['second_thumb'] = 'Upload the product secondary thumb (image)';
                    exit(json_encode(['error'=> true, 'error_message' => $errors ])); 
                }
            }else{
                $errors['thumb'] = 'Upload the product thumb (image)';
                exit(json_encode(['error'=> true, 'error_message' => $errors ])); 
            }


            //dataTest($parameters);
            $status = $this->Products_m->insert($parameters);
            if($status){
                exit(json_encode(['success' => true, 'message' => 'Product has been added'] ));
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	 Update  Product                                 |
    |-----------------------------------------------------
    */
    public function update_product(){
        $product_id = decrypt_id($this->uri->segment(3));
        $validate = array(
            array(
                "field" => "title",
                "label" => "Title",
                "rules" => "required"
            ),
            array(
                "field" => "price",
                "label" => "Price",
                "rules" => "required|numeric"
            ),
            array(
                "field" => "description",
                "label" => "Description",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($validate);
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
				$errors = array();
				foreach($this->input->post() as $key => $val){
                    $errors[$key] = form_error($key);
                }
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
            }
            // get categories
            $parameters = array(
                'table' => 'categories_tbl'
            );
            $data['categories'] = $this->Products_m->get(null, $parameters);


            // get product
            $parameters = array(
                'search_column' => 'products_tbl.p_id',
                'search_value' => $product_id
            );
            $columns = 'products_tbl.*, categories_tbl.c_id, categories_tbl.c_title';
            $data['product'] = $this->Products_m->get_products($columns, $parameters);

            $data['active'] = 'products';
            $data['products_link']['add_product'] = true;
            $data['dropify'] = true;
            $data['page_content'] = 'dashboard/products/update_product';
            $this->load->view('dashboard/main_view', $data); 
            
            
        }else{

            $product_id = decrypt_id($this->input->post('id'));

            // get product's thumb for delete after update the detail
            $parameters = array(
                'search_column' => 'products_tbl.p_id',
                'search_value' => $product_id
            );
            $columns = 'products_tbl.p_thumb, products_tbl.p_second_thumb';
            $product = $this->Products_m->get_products($columns, $parameters);

            if($product){
                $parameters = array(
                    'table' => 'products_tbl',
                    'search_column' => 'p_id',
                    'search_value' => $product_id,
                    'data' => array(
                        'p_c_id' => $this->input->post('category'),
                        'p_title' => $this->input->post('title'),
                        'p_description' => $this->input->post('description'),
                        'p_additional_information' => $this->input->post('additional_info'),
                        'p_price' => $this->input->post('price')
                    )
                );

                // if any of file is not uploaded then prevent upload file
                // for product thumb (image)
                if(is_uploaded_file($_FILES['thumb']['tmp_name'])){
                    // for product thumb (image)
                    // pass the array of parameters
                    $img_parameters = array(
                        'path' => './assets/img/products', 
                        'size' => 5024, 
                        'types' => 'gif|png|jpg|jpeg',
                        'input_field_name' => 'thumb',
                        'rename' => true, 
                    ); 
                    $parameters["data"]["p_thumb"] = save_image_file($img_parameters);
                    if($parameters["data"]["p_thumb"]){
                        $_SESSION['product_thumb_1'] = $product[0]['p_thumb']; 
                    }
                }
                // for product second thumb (image)
                if(is_uploaded_file($_FILES['second_thumb']['tmp_name'])){
                    // for product second thumb (image)
                    // pass the array of parameters
                    $img_parameters = array(
                        'path' => './assets/img/products', 
                        'size' => 5024, 
                        'types' => 'gif|png|jpg|jpeg',
                        'input_field_name' => 'second_thumb',
                        'rename' => true, 
                    ); 
                    $parameters["data"]["p_second_thumb"] = save_image_file($img_parameters);
                    if($parameters["data"]["p_second_thumb"]){
                        $_SESSION['product_thumb_2'] = $product[0]['p_second_thumb']; 
                    }
                }
                
                $status = $this->Products_m->update($parameters);
                if($status){
                    // delete from hard drive
                    if(isset($_SESSION['product_thumb_1'])){
                        unlink('assets/img/products/'.$_SESSION['product_thumb_1']);
                        unset($_SESSION['product_thumb_1']);
                    }

                    if(isset($_SESSION['product_thumb_2'])){
                        unlink('assets/img/products/'.$_SESSION['product_thumb_2']);
                        unset($_SESSION['product_thumb_2']);
                    }

                    exit(json_encode(['success' => true, 'message' => 'Product has been updated', 'url' => base_url().'admin/manage-products-list'] ));
                }
            } // end of if($product)   
            
        }   
    }
    /*
    |-----------------------------------------------------
    |	Delete  product                                  |
    |-----------------------------------------------------
    */
    public function delete_product(){
        $product_id =  decrypt_id($this->input->post('id'));
        if($product_id){
           
            // get product's thumb for delete after update the detail
            $parameters = array(
                'search_column' => 'products_tbl.p_id',
                'search_value' => $product_id
            );
            $columns = 'products_tbl.p_thumb, products_tbl.p_second_thumb';
            $product = $this->Products_m->get_products($columns, $parameters);

            if($product){
                $_SESSION['product_thumb_1'] = $product[0]['p_thumb']; 
                $_SESSION['product_thumb_2'] = $product[0]['p_second_thumb'];

                // delete from products_tbl
                $parameters = array(
                    'table' => 'products_tbl',
                    'search_column' => 'p_id',
                    'search_value' => $product_id,
                    'data' => array(
                        'p_id' => $product_id
                    )
                );
                $status = $this->Products_m->delete($parameters);
                if($status){
                    if(isset($_SESSION['product_thumb_1']) && isset($_SESSION['product_thumb_2'])){
                        unlink('assets/img/products/'.$_SESSION['product_thumb_1']);
                        unlink('assets/img/products/'.$_SESSION['product_thumb_2']);
                        unset($_SESSION['product_thumb_1']);
                        unset($_SESSION['product_thumb_2']);
                    }
                    exit(json_encode(['success' => true, 'message' => 'Product detail has been deleted' ]));
                }
            }
            
        } 
    }
    /*
    |-----------------------------------------------------
    |	Change product status                           |
    |-----------------------------------------------------
    */
    public function update_product_status(){
            $product_id = decrypt_id($this->input->post('id'));
            if($product_id){
                $status = $this->input->post('value');
                $allowed_check = array('1', '0');
                if(in_array($status, $allowed_check)){
                    $parameters = array(
                        'table' => 'products_tbl',
                        'search_column' => 'p_id',
                        'search_value' => $product_id,
                        'data' => array(
                            'p_status' => $status
                        )
                    );
                    $status = $this->Products_m->update($parameters);
                    if($status){
                        exit(json_encode(['success' => true, 'message' => 'Product status has been udpated' ]));
                    } 
                }
                 
            }
              
    }
    

    


}