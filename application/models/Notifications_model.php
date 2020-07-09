<?php

    class Notifications_model extends CI_Model
    {

    	public $_tableName = "notifications";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

	    
        public function insert($data){
            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }
        
        public function get_employee_unread_fmc_notifications($employee_id){
            $this->db->from($this->_tableName." dv");
            
            $this->db->where('dv.status=','unread');
            $this->db->where('dv.company_employee_id',$employee_id);
            $this->db->order_by('dv.created_at','DESC');
            $this->db->limit(5);
                        
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $results = $query->result_array();             
                return $results;
            }else{
                return array();
            }
        }

        public function get_unread_fmc_notifications($fmc_user_id){
            $this->db->from($this->_tableName." dv");
            
            $this->db->where('dv.status=','unread');
            $this->db->where('dv.fmc_user_id',$fmc_user_id);
            $this->db->order_by('dv.created_at','ASC');
            $this->db->limit(0, 5);

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $results = $query->result_array();             
                return $results;
            }else{
                return array();
            }
        }

        public function get_all_fmc_notifications($fmc_user_id){
            $this->db->from($this->_tableName." dv");
            
            $this->db->where('dv.fmc_user_id',$fmc_user_id);
                        
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){                
                $results = $query->result_array();             
                
                $this->db->where('fmc_user_id',$fmc_user_id);
                $this->db->update($this->_tableName,array('status'=>'read'));

                return $results;
            }else{
                return array();
            }
        }
        
	}

?>