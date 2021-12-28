<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions_m extends CI_Model{
    
    public function __construct(){
        parent::__construct();
        
    }
    
    private $allowed_tables = array('categories_tbl','products_tbl', 'product_gallery_tbl','orders_tbl');
    
    /*
	|-----------------------------------------------------
    |	                NOTE                             |
    |    This is a general purpose Model          		 |
    |    Which will use for common functions             |
    |                                                    |
	|-----------------------------------------------------
    */

    ///------------- for Datatables --------------////

    /*
    |-----------------------------------------------------
    |	Make a common query 							 |
    |-----------------------------------------------------
    */
    public function make_query($parameters){
        $this->db->select($parameters['columns']);
        $this->db->from($parameters['tableName']);
        if(isset($parameters['status']) &&  !empty($parameters['status'])){
            $this->db->where($parameters['status'], $parameters['status_value']);
        }
        if(isset($_POST['search']['value'])){
            $this->db->like($parameters['search_title'], $_POST['search']['value']);
        }
        if(isset($parameters['condition']) &&  !empty($parameters['condition'])){
            $this->db->where($parameters['condition']);
        } 

        if(isset($parameters['order_by']) && !empty($parameters['order_by'])){
            $this->db->order_by($parameters['order_by'], $parameters['order_by_value']);
        }

        
         
    }
    
    /*
    |-----------------------------------------------------
    |	Common function to get data					     |
    |-----------------------------------------------------
    */
    public function data_for_datatables($parameters){
        $this->make_query($parameters);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']); 
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    /*
    |-----------------------------------------------------
    |	Get number of records or row(s) filter 			 |
    |-----------------------------------------------------
    */
    public function get_filtered_data($parameters){
        $this->make_query($parameters);
        $query = $this->db->get();
        return $query->num_rows();
    } 
    /*
    |-----------------------------------------------------
    |	Get Number of total records  				     |
    |-----------------------------------------------------
    */
    public function get_total_record_count($parameters){
        $this->db->select("*");
        $this->db->from($parameters['tableName']);
        if(isset($parameters['status']) &&  !empty($parameters['status'])){
            $this->db->where($parameters['status'], $parameters['status_value']);
        } 
        if(isset($parameters['condition']) &&  !empty($parameters['condition'])){
            $this->db->where($parameters['condition']);
        }  
        return $this->db->count_all_results();  
    }

    ///-------------end of, for Datatables --------------////
    


}

?>