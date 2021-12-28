<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct(){
		parent::__construct();
		// loading library


		//  loading Models

    }


    /*
	|-----------------------------------------------------
	|	 about Company                                  |
	|-----------------------------------------------------
    */
    public function about(){
        $data['page_content'] = 'contact/about';
        $this->load->view('main_view', $data);
    }
    /*
	|-----------------------------------------------------
	|	 Contact Us                                 |
	|-----------------------------------------------------
    */
    public function contact_us(){
        $data['page_content'] = 'contact/contact_us';
        $this->load->view('main_view', $data);
    }


}