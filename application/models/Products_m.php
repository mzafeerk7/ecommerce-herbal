<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_m extends CI_Model{

    public function __construct(){
		parent::__construct();
        
        
    }
    private $allowed_tables = array(
                                'categories_tbl',
                                'products_tbl', 
                                'product_gallery_tbl',
                                'orders_tbl', 
                                'order_items_tbl', 
                                'users_tbl', 
                                'crypto_payments', 
                                'country_charges_tbl',
                                'shipping_address_tbl', 
                                'category_subcategory_tbl'
                            );

    /*
    |-----------------------------------------------------
    |	         INSERT                                  |
    |-----------------------------------------------------
    */
    public function insert($params = null){
        if (in_array($params['table'], $this->allowed_tables)){
            if($this->db->insert($params['table'], $params['data'])){
                return true;
            }else{
                return false;
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	         GET                                     |
    |-----------------------------------------------------
    */
    public function get($columns = null, $params = null){
        if (in_array($params['table'], $this->allowed_tables)){
            if(isset($columns) && !empty($columns)){
                $this->db->select($columns);
            }
            $this->db->from($params['table']);

            /*-------------- Join with other table------------ */
            if(isset($params['join']) ){
                //$this->db->join('accounts_tbl', 'accounts_tbl.acc_id = clinics_tbl.clinic_acc_id', 'left');
                $this->db->join($params["join"]["table2"], ''.$params["join"]["key2"] .'='. $params["join"]["key1"].'', 'left'); 
            }
            /*-------------- end of Join with other table----- */

            if(isset($params['search_column']) && !empty($params['search_column'])){
                $this->db->where($params['search_column'], $params['search_value']);
            }
            // check status
            if(isset($params['status']) && $params['status'] != ''){
                $this->db->where($params['status'], $params['status_value']);
            }

            // conditon
            if(isset($params['condition']) && $params['condition'] != ''){
                $this->db->where($params['condition']);
            }

            // order by
            if(isset($params['order_by']) && !empty($params['order_by'])){
                $this->db->order_by($params['order_by'], $params['order_by_value']);
            }

            // limits 
            if(isset($params['limit']) && !empty($params['limit']) ){
                $this->db->limit($params['limit']);
            }

            $query = $this->db->get();
            if($query){
                return $query->result_array();
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /* 
    |-----------------------------------------------------
    |	        UPDATE                                   |
    |-----------------------------------------------------
    */
    public function update($params = null){
        if(in_array($params['table'], $this->allowed_tables)){
            if(isset($params['search_column']) && !empty($params['search_column'])){
                $this->db->where($params['search_column'], $params['search_value']);
            }else{
                return false;
            }
            $this->db->update($params['table'], $params['data']);
            if($this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }
        }
    }
    /* 
    |-----------------------------------------------------
    |	        DELETE                                   |
    |-----------------------------------------------------
    */
    public function delete($params = null){
        if(in_array($params['table'], $this->allowed_tables)){
            if(isset($params['search_column']) && !empty($params['search_column'])){
                $this->db->where($params['search_column'], $params['search_value']);
            }else{
                return false;
            }
            if($this->db->delete($params['table'], $params['data'])){
                return true;
            }else{
                return false;
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	Get Products or single product detail            |
    |-----------------------------------------------------
    */
    public function get_products($columns = null, $params = null){
        if(isset($columns) && !empty($columns)){
            $this->db->select($columns);
        }
        $this->db->from('products_tbl');
        // join with categories_tbl
        $this->db->join('categories_tbl', 'categories_tbl.c_id = products_tbl.p_c_id', 'left');

        if(isset($params['search_column']) && !empty($params['search_column']) ){
            $this->db->where($params['search_column'], $params['search_value']);
        }

        // limits (for pagination)
        if(isset($params['limit']) && !empty($params['limit']) ){
            $this->db->limit($params['limit'],$params['offset']);
        }
        // check status
        if(isset($params['status']) && $params['status'] != ''){
            $this->db->where($params['status'], $params['status_value']);
        }

        // for searching
        if(isset($params['search_query']) && $params['search_query'] != ''){
            $this->db->like('products_tbl.p_title', $params['search_query']);
            $this->db->or_like('products_tbl.p_description', $params['search_query']);
            $this->db->or_like('products_tbl.p_additional_information', $params['search_query']);
            $this->db->or_like('categories_tbl.c_title', $params['search_query']);
        }

        $query = $this->db->get();

        // return total number of records if required
        if(isset($params['total_rows']) && $params['total_rows'] === true ){
            if($query){
                return $query->num_rows();
            }else{
                return false;
            }
        }

        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }
    /*
    |-----------------------------------------------------
    |	Place order, Save Order detail                   |
    |-----------------------------------------------------
    */
    public function place_order_items($data){
        if($data){
            if($this->db->insert('order_items_tbl', $data)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	Place order items, Save items detail             |
    |-----------------------------------------------------
    */
    public function place_order($data){
        if($data){
            if($this->db->insert('orders_tbl', $data)){
                return $this->db->insert_id();
            }else{
                return false;
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	Get order detail ( with joins, all detail)       |
    |-----------------------------------------------------
    */
    public function get_order_detail($columns = null, $params = null){
        if(isset($columns) && !empty($columns)){
            $this->db->select($columns);
        }
        $this->db->from('orders_tbl');
        // join with order_items_tbl
        $this->db->join('order_items_tbl', 'order_items_tbl.oi_order_id = orders_tbl.order_id', 'left');
        // join with products_tbl
        $this->db->join('products_tbl', 'products_tbl.p_id = order_items_tbl.oi_p_id', 'left');

        if(isset($params['search_column']) && !empty($params['search_column']) ){
            $this->db->where($params['search_column'], $params['search_value']);
        }

        if(isset($params['search_column2']) && !empty($params['search_column2']) ){
            $this->db->where($params['search_column2'], $params['search_value2']);
        }

        // check status
        if(isset($params['status']) && $params['status'] != ''){
            $this->db->where($params['status'], $params['status_value']);
        }

        $query = $this->db->get();
        if($query){
            return $query->result_array();
        }else{
            return false;
        }
    }

    /*
    |-----------------------------------------------------
    |	Get total nunmber of records                      |
    |-----------------------------------------------------
    */
    public function total_records($params = null){
        if(isset($params['table']) && !empty($params['table'])){
            if (in_array($params['table'], $this->allowed_tables)){

                $this->db->from($params['table']);
               
                if(isset($params['search_column']) && !empty($params['search_column']) ){
                    $this->db->where($params['search_column'], $params['search_value']);
                }

                // check status
                if(isset($params['status']) && $params['status'] != ''){
                    $this->db->where($params['status'], $params['status_value']);
                }
                
                $query = $this->db->get();
                return $query->num_rows();
            }
        }else{
            return false;
        }
    }
    
}  // end of class
