<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_m extends CI_Model{
    
    /*
	|-----------------------------------------------------
	|	 Login Verification         					 |
	|-----------------------------------------------------
	*/
    public function login_auth($username, $password){
        if($username && $password){
            $this->db->select();
            $this->db->from('users_tbl');

            //$where = "status = '1'  AND  email ='".$username."'  OR  i_code ='".$username."'  OR  passport_number ='".$username."' ";
            $this->db->where('username', $username);
            $query = $this->db->get();
            if($query->num_rows() === 1){
                $data = $query->result_array();
                $hash = $data[0]['user_password'];
                if(password_verify($password, $hash)){
                    unset($data[0]['user_password']);
                    return $data;
                }else{
                    return false;
                }    
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /*
	|-----------------------------------------------------
	|check username Existence for new Registration       |
	|-----------------------------------------------------
    */
    public function checkUsername($username){
        if($username){
            $query = $this->db->get_where('users_tbl', array('username' => $username));
            if($query->num_rows() === 1){
                return true;
            }else{
                return false;
            }
        }
    }

    /*
    |-----------------------------------------------------
    |	Registarion of user                              |
    |-----------------------------------------------------
    */
    public function register($data){
        if($data){
            if($this->db->insert('users_tbl', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    public function currentPasswordCheck($password, $acc_id){
        if($password){
            $this->db->select('user_password');
            $query = $this->db->get_where('users_tbl', array('user_id' => $acc_id));
            if($query->num_rows() === 1){
                $data = $query->row();
                $hash = $data->user_password;
                if(password_verify($password, $hash)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	Change Password                                  |
    |-----------------------------------------------------
    */
    public function change_password($id, $hash){
        if($id){
            $this->db->where('user_id', $id);
            $this->db->update('users_tbl', array('user_password' => $hash));
            if($this->db->affected_rows() === 1){
                return true;
            }else{
                return false;
            }
        }
    }


    // --------------------- Admin Area ----------------//
    /*
	|-----------------------------------------------------
	|	 Login Verification of admin        			 |
	|-----------------------------------------------------
	*/
    public function login_auth_admin($username, $password){
        if($username && $password){
            $this->db->select();
            $this->db->from('accounts_tbl');

            //$where = "status = '1'  AND  email ='".$username."'  OR  i_code ='".$username."'  OR  passport_number ='".$username."' ";
            $this->db->where('username', $username);
            $query = $this->db->get();
            if($query->num_rows() === 1){
                $data = $query->result_array();
                $hash = $data[0]['password'];
                if(password_verify($password, $hash)){
                    unset($data[0]['password']);
                    return $data;
                }else{
                    return false;
                }    
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /*
    |-----------------------------------------------------
    |	Change Password   of admin                        |
    |-----------------------------------------------------
    */
    public function change_password_admin($id, $hash){
        if($id){
            $this->db->where('acc_id', $id);
            $this->db->update('accounts_tbl', array('password' => $hash));
            if($this->db->affected_rows() === 1){
                return true;
            }else{
                return false;
            }
        }
    }
    /*
    |-----------------------------------------------------
    |	Check current password of admin                  |
    |-----------------------------------------------------
    */
    public function currentPasswordCheck_admin($password, $acc_id){
        if($password){
            $this->db->select('password');
            $query = $this->db->get_where('accounts_tbl', array('acc_id' => $acc_id));
            if($query->num_rows() === 1){
                $data = $query->row();
                $hash = $data->password;
                if(password_verify($password, $hash)){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

}