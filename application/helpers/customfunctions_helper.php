<?php



/*
|-------------------------------------------------------
|	Check login                                    	   |
|-------------------------------------------------------
*/
function isUserLoggedIn(){
    if(isset($_SESSION['userloggedIn']) && $_SESSION['userloggedIn'] === true ){
        return true;
    }else{
        redirect('account/login', 'refresh');
    }
}


/*
|-------------------------------------------------------
|	Check Admin login                                   |
|-------------------------------------------------------
*/
function isAdminLoggedIn(){
    if(isset($_SESSION['adminloggedIn']) && $_SESSION['adminloggedIn'] === true && isset($_SESSION['acc_id'])){
            return true;
    }else{
        redirect('admin/login', 'refresh');
    }
}


/*
|---------------------------------------------------
|                Max Lenght of String              |
|---------------------------------------------------
*/

function maxStringLength($string, $length) {
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . '...';
    } else {
        return $string;
    }
}

/*
|---------------------------------------------------
|                Encrypt Id for url                |
|---------------------------------------------------
*/
function encrypt_id($id) {
    if($id != ''){
        //get main CodeIgniter object
        // because we can't access outside from class
        // there first we get instance of CI Object
        $ci =& get_instance();

       $enc_id =  urlencode($ci->encryption->encrypt($id));
       return str_replace(array('+', '/', '%'), array('-', '_', '~'), $enc_id);
    }else{
        return false;
    }
}
/*
|---------------------------------------------------
|                Decrypt Id                        |
|---------------------------------------------------
*/
function decrypt_id($id){
    if($id != ''){
        //get main CodeIgniter object
        // because we can't access outside from class
        // there first we get instance of CI Object
        $ci =& get_instance();
       $dec_id =  str_replace(array('-', '_', '~'), array('+', '/', '%'),  $id);
       return $ci->encryption->decrypt(urldecode($dec_id));
    }else{
        return false;
    }
}

/*
|-------------------------------------------------------
|	General Purpose Function, which save image Or file |
|    pass the required parameter in form of array	   |
|-------------------------------------------------------
*/
function save_image_file($param_data){
    //get main CodeIgniter object
    // because we can't access outside from class
    // there first we get instance of CI Object
    $ci =& get_instance();

    
    $config['upload_path'] = $param_data['path'];
    $config['allowed_types'] = $param_data['types'];
    $config['max_size'] = $param_data['size'];
    if(isset($param_data['rename']) && !empty($param_data['rename']) && $param_data['rename'] === true){
        $config['encrypt_name'] = true;
    }
    
    

    $ci->load->library('upload', $config);
    // re initailize for another call
    $ci->upload->initialize($config);
    if(!$ci->upload->do_upload($param_data['input_field_name'])){
        $errors = array();
        $errors[$param_data['input_field_name']] = $ci->upload->display_errors();
       // print_r($errors);
        exit(json_encode(['error'=> true, 'error_message' => $errors ]));
    }else{
        $data = $ci->upload->data();
        // image name
        return $data['raw_name'].$data['file_ext'];
    }
}


/*
|-------------------------------------------------------
|	For Test only (view data)                    	   |
|-------------------------------------------------------
*/
function dataTest($testData){
    echo "<pre>";
    print_r($testData);
    echo "<pre>";
    exit();
}


/*
|-------------------------------------------------------
|	For new payment recieved and confirmation          |
|-------------------------------------------------------
*/
function cryptobox_new_payment($paymentID = 0, $payment_details = array(), $box_status = ""){
    /*
	// Save new Bitcoin payment in database table `user_orders`
	$recordExists = run_sql("select paymentID as nme FROM `user_orders` WHERE paymentID = ".intval($paymentID));
	if (!$recordExists) run_sql("INSERT INTO `user_orders` VALUES(".intval($paymentID).",'".addslashes($payment_details["user"])."','".addslashes($payment_details["order"])."',".floatval($payment_details["amount"]).",".floatval($payment_details["amountusd"]).",'".addslashes($payment_details["coinlabel"])."',".intval($payment_details["confirmed"]).",'".addslashes($payment_details["status"])."')");

	
	// Received second IPN notification (optional) - Bitcoin payment confirmed (6+ transaction confirmations)
	if ($recordExists && $box_status == "cryptobox_updated")  run_sql("UPDATE `user_orders` SET txconfirmed = ".intval($payment_details["confirmed"])." WHERE paymentID = ".intval($paymentID));
	*/


	// Onetime action when payment confirmed (6+ transaction confirmations)
	$processed = run_sql("select processed as nme FROM `crypto_payments` WHERE paymentID = ".intval($paymentID)." LIMIT 1");
	if (!$processed && $payment_details["confirmed"])
	{
		// ... Your code ...

        $ci =& get_instance();
		// ... and update status in default table where all payments are stored - https://github.com/cryptoapi/Payment-Gateway#mysql-table
		// $sql = "UPDATE crypto_payments SET processed = 1, processedDate = '".gmdate("Y-m-d H:i:s")."' WHERE paymentID = ".intval($paymentID)." LIMIT 1";
        // run_sql($sql);

        // update crypto_payments table because payment has confirmed
        $parameters = array(
            'table' => 'crypto_payments',
            'search_column' => 'paymentID',
            'search_value' => $paymentID,
            'data' => array(
                'processed' => 1,
                'processedDate' => gmdate("Y-m-d H:i:s")
            )
        );
        $ci->Products_m->update($parameters);

        
        // update orders_tbl
        $parameters = array(
            'table' => 'orders_tbl',
            'search_column' => 'order_id',
            'search_value' => $payment_details["order"],
            'data' => array(
                'order_status' => 'processing'
            )
        );
        $ci->Products_m->update($parameters);
        // $sql = "UPDATE orders_tbl SET order_status = 'processing' WHERE order_id = ".$payment_details["order"]." LIMIT 1";
		// run_sql($sql);
	}

     



	// Debug - new payment email notification for webmaster
	// Uncomment lines below and make any test payment
	// --------------------------------------------
	// $email = "....your email address....";
	// mail($email, "Payment - " . $paymentID . " - " . $box_status, " \n Payment ID: " . $paymentID . " \n\n Status: " . $box_status . " \n\n Details: " . print_r($payment_details, true));

	/* my custom code */
	//if(isset($_POST) && $_POST['status'] == 'payment_received' && $_POST['confirmed'] == '1'){
		

        

		
	//}
    return true;        
}


/*
|-------------------------------------------------------
|	Prepend 0 before any number                        | 
|   $input is number                                   |
|   $value how much you want to put                    |
|-------------------------------------------------------
*/
function prefix_zero($input = null, $value = null ){
    if($input){
        return str_pad($input, $value, "0", STR_PAD_LEFT);
    }else{
        return false;
    }
    
}
