<?php

    class User_model extends CI_Model
    {

    	public $_tableName = "fmc_users";

        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

	    public function checkUser($data){
    		$this->db->from($this->_tableName);
            $this->db->where('email',$data['email']);         
            $this->db->where('status','active');
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();               
                
                if($queryResult['password'] == $data['password']){
                    $queryResult["created_at"] = date('d/m/Y H:i:s', strtotime($queryResult['created_at']));
                    $queryResult["modified_at"] = date('d/m/Y H:i:s', strtotime($queryResult['modified_at']));
                    /*
                    if(!empty($queryResult['profile_picture'])){
                        $queryResult['profile_picture'] = 'uploads/'.$queryResult['profile_picture'];
                    }else{
                        $queryResult['profile_picture'] = "assets/profiles/user_default.png";
                    }*/
                    return $queryResult;
                }
            }else{
                return false;
            }
	    }

        public function checkEmail($email,$fmc_user_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('email',$email);
            $this->db->where('status','active');
            if(!empty($fmc_user_id)){
                $this->db->where('id !=',$fmc_user_id);
            }
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();                               
                return $queryResult;
            }else{
                return false;
            }
        }

        public function checkFMCEmployeeID($email,$fmc_user_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('fmc_employee_id',$email);
            $this->db->where('status','active');
            if(!empty($fmc_user_id)){
                $this->db->where('id !=',$fmc_user_id);
            }
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();
                return $queryResult;
            }else{
                return false;
            }
        }


        public function insert_login_log($data){

            $this->db->insert("fmc_user_login_log", $data);

            if($this->db->affected_rows())
            {
                $insert_id = $this->db->insert_id();
                if($insert_id){
                    return $insert_id;
                }else{
                    return false;
                }
            }
        }
        

        public function get_details($id){
            
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.id',$id);      

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            } 

        }

        public function get_user_departments($id){

            $this->db->from("fmc_users_department"." dv");
            $this->db->where('dv.fmc_user_id',$id);        

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_all($login_user_id = ""){
            
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status','active');        
            if(!empty($login_user_id)){
                $this->db->where('dv.id !=',$login_user_id);
            }

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }

        }

        public function update($data){

            $this->db->where('id',$data['id']);

            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }

        public function insert($data){

            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                $user_id = $this->db->insert_id();
                if($user_id){
                    return $user_id;
                }else{
                    return false;
                }
            }
        }

        public function insert_user_departments($data){

            $this->db->insert_batch("fmc_users_department", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }   


        public function remove_user_departments($fmc_user_id = ""){
            $this->db->where('fmc_user_id',$fmc_user_id);
            if($this->db->delete("fmc_users_department"))
            {
                return true;
            }else{
                return false;
            }
        }       

        public function delete($id, $status){

            $data = array('status' => $status);
            $this->db->where('id',$id);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }
        }

	}

?>