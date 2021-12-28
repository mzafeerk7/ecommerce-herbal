<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once  "application/libraries/cryptobox/cryptobox.class.php";

class Account extends CI_Controller {

    public function __construct(){
		parent::__construct();
		// loading library
		$this->load->library('form_validation');

		// loading Models
		$this->load->model('Account_m');
		$this->load->model('Products_m');


	}
	/*
	|-----------------------------------------------------
	|	 Login                            			     |
	|-----------------------------------------------------
	*/
	public function login(){

		if(!empty($_SERVER['HTTP_REFERER']) && ($_SERVER['HTTP_REFERER'] != base_url('account/login')) && ($_SERVER['HTTP_REFERER'] != base_url('account/logout'))){
			$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
		}
		//dataTest($_SESSION['url']);
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
		$this->form_validation->set_error_delimiters('<span>', '</span>');
		if($this->form_validation->run() == FALSE){
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

			$data['reg_login_link'] = true;
			$data['page_content'] = 'account/login';
        	$this->load->view('main_view', $data);
		}else{
			
			if(empty($_SESSION['url'])){
				$_SESSION['url'] = base_url().'account/profile';
			}

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$userData = $this->Account_m->login_auth($username, $password);
			if($userData){
				
				$session_data = array(
					"user_id" => $userData[0]['user_id'],
					"username" => $userData[0]['username'],
					"userloggedIn" => true	
				);

				$this->session->set_userdata($session_data);

				exit(json_encode(['success' => true, 'url' => $_SESSION['url'] ]));
			}else{
				exit(json_encode(['invalid_error' => true, 'error_message' => 'Invalid Username/Password']));
			}
		}
	
	}
	/*
	|-----------------------------------------------------
	|	 User Registeration                 		     |
	|-----------------------------------------------------
    */
    public function register(){
		$validate = array(
            array(
                "field" => "username",
                "label" => "Username",
                "rules" => "required|callback_checkUsername",
            ),
            array(
                "field" => "password",
                "label" => "Password",
                "rules" => "required|min_length[6]",
			),
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
            $password = $this->input->post("password");
            $hash = password_hash($password, PASSWORD_DEFAULT);

			$account_data = array(
				'username' => $this->input->post("username"),
				'user_password' => $hash,
			);
			
			$status = $this->Account_m->register($account_data);
			if($status){
				$url = base_url().'account/login';
				$message = 'Your account has been created.';
				exit(json_encode(['success' => true, 'message' => $message]));
			
			}else{
				exit(json_encode(['error' => true, 'error_message' => 'Registration failed' ]));
			} 
		}
	}
	/*
	|---------------------------------------------------
	|     check username existence 					   |
	|---------------------------------------------------
	*/
	public function checkUsername($username){
		if($this->Account_m->checkUsername($username)){
			$this->form_validation->set_message('checkUsername', 'This username already exist');
			return FALSE;
		}else{
			return TRUE;
		}
	}
	/*
	|-----------------------------------------------------
	|	 User Profile (dashboard)                        |
	|-----------------------------------------------------
	*/
	public function user_profile(){
		isUserLoggedIn();
		// get categories
		$parameters = array(
			'table' => 'categories_tbl'
		);
		$data['categories'] = $this->Products_m->get(null, $parameters);

		// get user orders by user id (for acconunt)
		$parameters = array(
			'table' => 'orders_tbl',
			'search_column' => 'order_user_id',
			'search_value' =>  $_SESSION['user_id'],
			'join' => array(
				'table2' => 'crypto_payments',
				'key2' => 'crypto_payments.orderID',
				'key1' => 'orders_tbl.order_id'
			)
		);
		$columns = 'orders_tbl.*, crypto_payments.txConfirmed, crypto_payments.processed';
		$data['user_orders'] = $this->Products_m->get($columns, $parameters);
		//datatest($data['user_orders']);

		$data['reg_login_link'] = true;
		$data['page_content'] = 'account/user_profile';
        $this->load->view('main_view', $data);
	}


	/*
	|-----------------------------------------------------
	|	 Change Password     			                 |
	|-----------------------------------------------------
    */
    public function change_password(){
		isUserLoggedIn();
        $validate = array(
            array(
                "field" => "cur_password",
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
            $user_id = $_SESSION['user_id'];
            $newPassword = $this->input->post('new_password');
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $status = $this->Account_m->change_password($user_id, $hash);
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
		isUserLoggedIn();
        $acc_id = $_SESSION['user_id'];
        $currentPassword = $this->input->post('cur_password');
		if($this->Account_m->currentPasswordCheck($currentPassword, $acc_id)){
			return TRUE;
		}else{
            $this->form_validation->set_message('checkCurrentPassword', 'Invalid Current Password');
			return FALSE;
		}
	}


	/*
	|-----------------------------------------------------
	|	Redirect for payment after placing the order     |
	|-----------------------------------------------------
    */
	public function pay(){
		isUserLoggedIn();
		if($this->uri->segment(3)){
			//echo "segment set";
			$order_id = decrypt_id($this->uri->segment(3));
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
			$columns = 'orders_tbl.*, crypto_payments.txConfirmed, crypto_payments.processed';
			$data['order_detail'] = $this->Products_m->get($columns, $parameters);
			//dataTest($data['order_detail']);
			if($data['order_detail']){
				if($data['order_detail'][0]['txConfirmed'] == 0 && $data['order_detail'][0]['processed'] == 0 ){
					$this->load->view('account/payment', $data);
				}else{
					redirect('account/profile', 'refresh');
				}
			}else{
				redirect('products', 'refresh');
			}
			
		}else{
			//echo "nothing set";
			redirect('account/profile', 'refresh');
		}
	}
	/*
	|---------------------------------------------------
	| When payment confirmed then redirect to this page|
	| to display confirmation message				   |
	|---------------------------------------------------
	*/
	public function paymentConfirmed(){
		isUserLoggedIn();
        $data['page_content'] = 'account/payment_confirmed_msg';
        $this->load->view('main_view', $data);
	}
	/*
	|---------------------------------------------------
	| When payment made then redirect to this page     |
	| to display processing	 message				   |
	|---------------------------------------------------
	*/
	public function payment_processing_message(){
		isUserLoggedIn();
        $data['page_content'] = 'account/payment_processing_msg';
        $this->load->view('main_view', $data);
	}
	/*
	|-----------------------------------------------------
	|	 IPN (instant payment notification from gateway) |
	|-----------------------------------------------------
	*/
	public function IPNcallback(){
        /**
         * ##########################################
         * ###  PLEASE DO NOT MODIFY THIS FILE !  ###
         * ##########################################
         *
         *
         * Cryptobox Server Callbacks
         *
         * @package     Cryptobox callbacks
         * @copyright   2014-2020 Delta Consultants
         * @category    Libraries
         * @website     https://gourl.io
         * @version     2.2.1
         *
         *
         * This file processes call-backs from Cryptocoin Payment Box server when new payment
         * from your users comes in. Please link this file in your cryptobox configuration on
         * gourl.io - Callback url: http://yoursite.com/cryptobox.callback.php
         *
         * Usually user will see on bottom of payment box button 'Click Here if you have already sent coins'
         * and when he will click on that button, script will connect to our remote cryptocoin payment box server
         * and check user payment.
         *
         * As backup, our server will also inform your server automatically every time when payment is
         * received through this callback file. I.e. if the user does not click on button, your website anyway
         * will receive notification about a given user and save it in your database. And when your user next time
         * comes on your website/reload page he will automatically will see message that his payment has been
         * received successfully.
         *
         *
         */


        if(!defined("CRYPTOBOX_WORDPRESS")) define("CRYPTOBOX_WORDPRESS", false);

        // if (!CRYPTOBOX_WORDPRESS) require_once( "cryptobox.class.php" );
        // elseif (!defined('ABSPATH')) exit; // Exit if accessed directly in wordpress


        // a. check if private key valid
        $valid_key = false;
        if (isset($_POST["private_key_hash"]) && strlen($_POST["private_key_hash"]) == 128 && preg_replace('/[^A-Za-z0-9]/', '', $_POST["private_key_hash"]) == $_POST["private_key_hash"])
        {
            $keyshash = array();
            $arr = explode("^", CRYPTOBOX_PRIVATE_KEYS);
            foreach ($arr as $v) $keyshash[] = strtolower(hash("sha512", $v));
            if (in_array(strtolower($_POST["private_key_hash"]), $keyshash)) $valid_key = true;
        }


        // b. alternative - ajax script send gourl.io json data
        if (!$valid_key && isset($_POST["json"]) && $_POST["json"] == "1")
        {
            $data_hash = $boxID = "";
            if (isset($_POST["data_hash"]) && strlen($_POST["data_hash"]) == 128 && preg_replace('/[^A-Za-z0-9]/', '', $_POST["data_hash"]) == $_POST["data_hash"]) { $data_hash = strtolower($_POST["data_hash"]); unset($_POST["data_hash"]); }
            if (isset($_POST["box"]) && is_numeric($_POST["box"]) && $_POST["box"] > 0) $boxID = intval($_POST["box"]);

            if ($data_hash && $boxID)
            {
                $private_key = "";
                $arr = explode("^", CRYPTOBOX_PRIVATE_KEYS);
                foreach ($arr as $v) if (strpos($v, $boxID."AA") === 0) $private_key = $v;

                if ($private_key)
                {
                    $data_hash2 = strtolower(hash("sha512", $private_key.json_encode($_POST).$private_key));
                    if ($data_hash == $data_hash2) $valid_key = true;
                }
                unset($private_key);
            }

            if (!$valid_key) die("Error! Invalid Json Data sha512 Hash!");

        }


        // c.
        if ($_POST) foreach ($_POST as $k => $v) if (is_string($v)) $_POST[$k] = trim($v);



        // d.
        if (isset($_POST["plugin_ver"]) && !isset($_POST["status"]) && $valid_key)
        {
            echo "cryptoboxver_" . (CRYPTOBOX_WORDPRESS ? "wordpress_" . GOURL_VERSION : "php_" . CRYPTOBOX_VERSION);
            die;
        }


        // e.
        if (isset($_POST["status"]) && in_array($_POST["status"], array("payment_received", "payment_received_unrecognised")) &&
                $_POST["box"] && is_numeric($_POST["box"]) && $_POST["box"] > 0 && $_POST["amount"] && is_numeric($_POST["amount"]) && $_POST["amount"] > 0 && $valid_key)
        {

            foreach ($_POST as $k => $v)
            {
                if ($k == "datetime") 						$mask = '/[^0-9\ \-\:]/';
                elseif (in_array($k, array("err", "date", "period")))		$mask = '/[^A-Za-z0-9\.\_\-\@\ ]/';
                else								$mask = '/[^A-Za-z0-9\.\_\-\@]/';
                if ($v && preg_replace($mask, '', $v) != $v) 	$_POST[$k] = "";
            }

            if (!$_POST["amountusd"] || !is_numeric($_POST["amountusd"]))	$_POST["amountusd"] = 0;
            if (!$_POST["confirmed"] || !is_numeric($_POST["confirmed"]))	$_POST["confirmed"] = 0;


            $dt			= gmdate('Y-m-d H:i:s');
            $obj 		= run_sql("select paymentID, txConfirmed from crypto_payments where boxID = ".intval($_POST["box"])." && orderID = '".addslashes($_POST["order"])."' && userID = '".addslashes($_POST["user"])."' && txID = '".addslashes($_POST["tx"])."' && amount = ".floatval($_POST["amount"])." && addr = '".addslashes($_POST["addr"])."' limit 1");


            $paymentID		= ($obj) ? $obj->paymentID : 0;
            $txConfirmed	= ($obj) ? $obj->txConfirmed : 0;

            // Save new payment details in local database
            if (!$paymentID)
            {
                $sql = "INSERT INTO crypto_payments (boxID, boxType, orderID, userID, countryID, coinLabel, amount, amountUSD, unrecognised, addr, txID, txDate, txConfirmed, txCheckDate, recordCreated)
                        VALUES (".intval($_POST["box"]).", '".addslashes($_POST["boxtype"])."', '".addslashes($_POST["order"])."', '".addslashes($_POST["user"])."', '".addslashes($_POST["usercountry"])."', '".addslashes($_POST["coinlabel"])."', ".floatval($_POST["amount"]).", ".floatval($_POST["amountusd"]).", ".($_POST["status"]=="payment_received_unrecognised"?1:0).", '".addslashes($_POST["addr"])."', '".addslashes($_POST["tx"])."', '".addslashes($_POST["datetime"])."', ".intval($_POST["confirmed"]).", '$dt', '$dt')";

                $paymentID = run_sql($sql);

                $box_status = "cryptobox_newrecord";
            }
            // Update transaction status to confirmed
            elseif ($_POST["confirmed"] && !$txConfirmed)
            {
                $sql = "UPDATE crypto_payments SET txConfirmed = 1, txCheckDate = '$dt' WHERE paymentID = ".intval($paymentID)." LIMIT 1";
                run_sql($sql);

                $box_status = "cryptobox_updated";
            }
            else
            {
                $box_status = "cryptobox_nochanges";
            }


            /**
             *  User-defined function for new payment - cryptobox_new_payment(...)
             *  For example, send confirmation email, update database, update user membership, etc.
             *  You need to modify file - cryptobox.newpayment.php
             *  Read more - https://gourl.io/api-php.html#ipn
                 */

            if (in_array($box_status, array("cryptobox_newrecord", "cryptobox_updated")) && function_exists('cryptobox_new_payment'))cryptobox_new_payment($paymentID, $_POST, $box_status);
        }

        else
            $box_status = "Only POST Data Allowed";


            echo $box_status; // don't delete it     

        
    }// function end



	/*
	|-----------------------------------------------------
	|	 logout											 |
	|-----------------------------------------------------
	*/
	public function logout(){
		$this->session->sess_destroy();
		redirect('account/login', 'refresh');
	}
	

}