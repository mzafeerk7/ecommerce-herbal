<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct(){
		parent::__construct();
		// loading library
		$this->load->library('form_validation');

		// loading Models
		$this->load->model('Account_m');
	}

	/*
	|-----------------------------------------------------
	|	 Login                            			     |
	|-----------------------------------------------------
	*/
	public function login(){
		if(isset($_SESSION['adminloggedIn']) && $_SESSION['adminloggedIn'] === true && isset($_SESSION['acc_id'])){
            redirect('admin/dashboard', 'refresh');
		}
		$config= array(
			array(
				"field" => "username",
				"label" => "Username",
				"rules" => "required",
			),
			array(
				"field" => "password",
				"label" => "Password",
				"rules" => "required",
			),
		);
		$this->form_validation->set_rules($config);
		//$this->form_validation->set_error_delimiters('<span>', '</span>');
		if($this->form_validation->run() == FALSE){
			if(validation_errors()){
				$errors = array();
				foreach($this->input->post() as $key => $val){
					$errors[$key] = form_error($key);
				}
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
			}
        	$this->load->view('dashboard/account/login');
		}else{

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$adminData = $this->Account_m->login_auth_admin($username, $password);
			if($adminData){
				
				$session_data = array(
					"acc_id" => $adminData[0]['acc_id'],
					"username" => $adminData[0]['username'],
					"adminloggedIn" => true	
				);

				$this->session->set_userdata($session_data);

				exit(json_encode(['success' => true, 'url' => base_url().'admin/dashboard' ]));
			}else{
				exit(json_encode(['invalid_error' => true, 'error_message' => 'Invalid']));
			}
		}
	
	}
	/*
	|-----------------------------------------------------
	|	 Change Password     			                 |
	|-----------------------------------------------------
    */
    public function change_password(){
		isAdminLoggedIn();
        $validate = array(
            array(
                "field" => "current_password",
                "label" => "Current Password",
                "rules" => "required|callback_checkCurrentPassword"
            ),
            array(
                "field" => "new_password",
                "label" => "New Password",
                "rules" => "required|min_length[6]"
            ),
            array(
                "field" => "confirm_password",
                "label" => "Confirm Password",
                "rules" => "required|matches[new_password]"
            ),
        );
		$this->form_validation->set_rules($validate);
		// $this->form_validation->set_error_delimiters('<span>', '</span>');
        if($this->form_validation->run() === FALSE){
            if(validation_errors()){
                $errors = array();
				foreach($this->input->post() as $key => $val){
					$errors[$key] = form_error($key);
				}
				exit(json_encode(['error'=> true, 'error_message' => $errors ]));
			}

			$data['active'] = 'settings';
			$data['page_content'] = 'dashboard/account/change_password';
			$this->load->view('dashboard/main_view', $data);
        }else{
            $acc_id = $_SESSION['acc_id'];
            $newPassword = $this->input->post('new_password');
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $status = $this->Account_m->change_password_admin($acc_id, $hash);
            if($status){
                exit(json_encode(['success'=> true, 'message' => 'Password has been changed']));
            }  
        }
       
    }
    /*
	|---------------------------------------------------
	|     Check Current Password: valid or Not     	   |
	|---------------------------------------------------
	*/
	public function checkCurrentPassword(){
		isAdminLoggedIn();
        $acc_id = $_SESSION['acc_id'];
        $currentPassword = $this->input->post('current_password');
		if($this->Account_m->currentPasswordCheck_admin($currentPassword, $acc_id)){
			return TRUE;
		}else{
            $this->form_validation->set_message('checkCurrentPassword', 'Invalid Current Password');
			return FALSE;
		}
	}
	/*
	|-----------------------------------------------------
	|	 logout											 |
	|-----------------------------------------------------
	*/
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin/login', 'refresh');
	}
	

}