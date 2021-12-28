<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct(){
		parent::__construct();
        // loading library
        $this->load->library('pagination');


		//  loading Models
        $this->load->model('Products_m');
    }

    /*
	|-----------------------------------------------------
	|	 Index:  Dislay products on home page             |
	|-----------------------------------------------------
    */
    public function index(){
        // get categories
        $parameters = array(
            'table' => 'categories_tbl',
            'status' => 'c_status',
            'status_value' => '1',
            'condition' => array('subcategory_status' => '0')
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        //---------------------------------------
        foreach($data['categories'] as $key => $category){
            $parameters = array(
                'table' => 'category_subcategory_tbl',
                'search_column' => 'cate_id',
                'search_value' => $category['c_id']
            );
            $sub_cate_data = $this->Products_m->get(null, $parameters);
            if($sub_cate_data){
                foreach($sub_cate_data as $key2 => $value){
                    $parameters = array(
                        'table' => 'categories_tbl',
                        'search_column' => 'c_id',
                        'search_value' => $value['sub_cate_id'],
                        'status' => 'c_status',
                        'status_value' => '1',
                        'condition' => array('subcategory_status' => '1')
                    );
                    $columns = 'c_id, c_title';
                    $sub_category= $this->Products_m->get($columns, $parameters);
                    if($sub_category){
                        $data['categories'][$key]['sub_category'][$key2]['c_id']= $sub_category[0]['c_id'];
                        $data['categories'][$key]['sub_category'][$key2]['c_title']= $sub_category[0]['c_title'];
                    }
                }
            }
        }

        //---------------------------------------
        //dataTest($data['categories']);
        $param = array(
            'table' => 'products_tbl',
            'status' => 'p_status',
            'status_value' => 1
        );
        $parameters = array(
            'url' => base_url().'products/index',
            'perPageRec' => 12,
            'segment' => 3,
            'totalRec' => $this->Products_m->total_records($param)
        );
        
        $detail = $this->pagination($parameters);
        $data['products'] = $detail['products'];
        //dataTest($data['products']);
        $data['pagination_links'] = $detail['pagination_links'];
        
        $data['page_content'] = 'products/products';
        $this->load->view('main_view', $data);
    }
    /*
	|-----------------------------------------------------
	|	 Pagination                                      |
	|-----------------------------------------------------
    */
    public function pagination($params = null){
        $config=[
            'base_url' => $params['url'],
            'per_page' => $params['perPageRec'],
            'total_rows' => $params['totalRec'],
            // 'full_tag_open' => '<ul>',
            // 'full_tag_close' => '</ul>',
            'first_link' => '|&lt;',
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_link' => '&gt;|',
            'last_tag_open' => '<li>',
            'last_tag_close' => '</li>',
            'next_tag_open' => '<li class="next">',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li class="prev">',
            'prev_tag_close' => '</li>',
            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',
            'cur_tag_open' => '<li><a class="current">',
            'cur_tag_close' => '</a></li>',
            ];

            $this->pagination->initialize($config);

            if($this->uri->segment($params['segment']))
            {
                $page = $this->uri->segment($params['segment']);
            }else{
                $page = 0;
            }

            // fetching items with limit
            // get products
            $parameters = array(
                'limit' => $config['per_page'],
                'offset' => $page,
                'status' => 'products_tbl.p_status',
                'status_value' => 1
            );
            if(isset($params['search_column']) && !empty($params['search_column'])){
                $parameters['search_column'] = $params['search_column'];
                $parameters['search_value'] = $params['search_value'];
            }

            // for searching by query
            if(isset($params['search_query']) && !empty($params['search_query'])){
                $parameters['search_query'] = $params['search_query'];
            }
            $data['products'] = $this->Products_m->get_products(null, $parameters);
            $data['pagination_links'] = $this->pagination->create_links();

            return $data;
    }


    /*
	|-----------------------------------------------------
	|	 Single Product Detail                           |
	|-----------------------------------------------------
    */
    public function product_detail(){
        //$product_id = $this->encryption->decrypt(urldecode($this->uri->segment(3)));
        $product_id = decrypt_id($this->uri->segment(3));
        // get product
        $parameters = array(
            'search_column' => 'products_tbl.p_id',
            'search_value' => $product_id
        ); 
        $data['product'] = $this->Products_m->get_products(null, $parameters);

        // get product gallery
        $parameters = array(
            'table' => 'product_gallery_tbl',
            'search_column' => 'product_id',
            'search_value' => $product_id
        );
        $data['gallery'] = $this->Products_m->get(null, $parameters);

        // get categories
        $parameters = array(
            'table' => 'categories_tbl'
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        $data['page_content'] = 'products/product_detail';
        $this->load->view('main_view', $data);
    }

    /*
	|-----------------------------------------------------
	|	 Searching Result, Categoized detail of products |
	|-----------------------------------------------------
    */
    public function products_categorized_catalog(){
        $c_id =  decrypt_id($this->uri->segment(3));

        // get categories
        $parameters = array(
            'table' => 'categories_tbl'
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        // get category wthich are searched
        $parameters = array(
            'table' => 'categories_tbl',
            'search_column' => 'c_id',
            'search_value' => $c_id
        );
        $data['searched_category'] = $this->Products_m->get(null, $parameters);

        $param = array(
            'table' => 'products_tbl',
            'search_column' => 'p_c_id',
            'search_value' => $c_id,
            'status' => 'p_status',
            'status_value' => 1
            
        );

        $parameters = array(
            'url' => base_url().'products/catalog/'.encrypt_id($c_id),
            'perPageRec' => 12,
            'segment' => 4,
            'totalRec' => $this->Products_m->total_records($param),
            'search_column' => 'categories_tbl.c_id',
            'search_value' => $c_id
        );
       
        $detail = $this->pagination($parameters);
        $data['products'] = $detail['products'];
        $data['pagination_links'] = $detail['pagination_links'];
        //dataTest($data['pagination_links']);
        $data['page_content'] = 'products/product_search';
        $this->load->view('main_view', $data);
    }
    /*
	|-----------------------------------------------------
	|	 Searching Result, by user query                 |
	|-----------------------------------------------------
    */
    public function search_products_by_query(){
        $text = $this->input->get('p');
        if($text != ''){
            // search query
            $this->session->set_userdata(array('search_text' => $text));

            // total record count
            $parameters = array(
                'search_query' => $this->session->userdata('search_text'),
                'total_rows' => true,
                'status' => 'products_tbl.p_status',
                'status_value' => 1
            );
            $columns = 'products_tbl.p_id';
            $this->session->set_userdata(array('total_rec_count' => $this->Products_m->get_products($columns, $parameters)));
            //dataTest($this->session->userdata());
            
            $this->s_catalog();
        }else{
            redirect('products', 'refresh');
        }
    }
    /*
	|-----------------------------------------------------
    |	 Searching Result, with pagination,              |
    |    searched catalog                                |
	|-----------------------------------------------------
    */
    public function s_catalog(){
        // get categories
        $parameters = array(
            'table' => 'categories_tbl'
        );
        $data['categories'] = $this->Products_m->get(null, $parameters);

        // get products by search with pagination
        $parameters = array(
            'url' => base_url().'products/s_catalog/',
            'perPageRec' => 12,
            'segment' => 3,
            'totalRec' => $this->session->userdata('total_rec_count'),
            'search_query' => $this->session->userdata('search_text')
        );
       
        $detail = $this->pagination($parameters);
        $data['products'] = $detail['products'];
        $data['pagination_links'] = $detail['pagination_links'];
        //dataTest($data['pagination_links']);
        $data['page_content'] = 'products/product_search';
        $this->load->view('main_view', $data);
    }



}