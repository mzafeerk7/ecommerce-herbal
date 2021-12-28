<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        isAdminLoggedIn();
        // loading library

		//  loading Models
        $this->load->model('Products_m');
    }

    /*
	|-----------------------------------------------------
	|	 Index:  Dislay products on home page             |
	|-----------------------------------------------------
    */
    public function index(){
        // get total number of products
        $parameters = array(
            'table' => 'products_tbl'
        );
        $data['total_products'] = $this->Products_m->total_records($parameters);

        // get total number of orders
        $parameters = array(
            'table' => 'orders_tbl'
        );
        $data['total_orders'] = $this->Products_m->total_records($parameters);

        // get total number of users
        $parameters = array(
            'table' => 'users_tbl'
        );
        $data['total_users'] = $this->Products_m->total_records($parameters);

        // get orders  
        $parameters = array(
            'table' => 'orders_tbl',
            'order_by' => 'order_id',
            'order_by_value' => 'DESC',
            'limit' => 5,
            'join' => array(
                'table2' => 'crypto_payments',
                'key2' => 'crypto_payments.orderID',
                'key1' => 'orders_tbl.order_id'
            )
        );
        $columns = 'orders_tbl.*, crypto_payments.txConfirmed, crypto_payments.processed';
        $data['last_5_orders'] = $this->Products_m->get($columns , $parameters);
        //dataTest($data['last_5_orders']);

        $data['page_content'] = 'dashboard/dashboard_contents';
        $this->load->view('dashboard/main_view', $data);
    }

}