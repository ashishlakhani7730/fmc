<?php

    class Leave_types_model extends CI_Model

    {

    	public $_tableName = "leave_types";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

        public function get_details($id){

            $query = $this->db->get_where($this->_tableName, array('id' => $id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }
        
        public function get_all($company_id = ""){
            
            $this->db->select('*');
            $this->db->from($this->_tableName);
            $this->db->where('status','active');  
            $this->db->where('company_id',$company_id);    

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
                $inserted_id = $this->db->insert_id();
                if($inserted_id){
                    return $inserted_id;
                }else{
                    return false;
                }
            }

        }

        public function insert_batch($data){

            $this->db->insert_batch($this->_tableName, $data);

            if($this->db->affected_rows())
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

        public function insert_leave_type_groups_common($data){

            $this->db->insert_batch("leave_type_group_common", $data);

            if($this->db->affected_rows())
            {
                $inserted_id = $this->db->insert_id();
                if($inserted_id){
                    return $inserted_id;
                }else{
                    return false;
                }
            }

        }

        public function delete_leave_type_groups_common($leave_type_id="",$leave_type_group_id="")
        {
            if(!empty($leave_type_id)){
                $this->db->where('leave_type_id',$leave_type_id);
            }
            if(!empty($leave_type_group_id)){
                $this->db->where('leave_type_group_id',$leave_type_group_id);
            }

            if($this->db->delete("leave_type_group_common"))
            {
                return true;
            }
        }

        public function get_leave_type_groups_common($leave_type_id="",$leave_type_group_id="")
        {
            $this->db->select('*');
            $this->db->from("leave_type_group_common");
            if(!empty($leave_type_id)){
                $this->db->where('leave_type_id',$leave_type_id);      
            }
            if(!empty($leave_type_group_id)){
                $this->db->where('leave_type_group_id',$leave_type_group_id);      
            }
            
            $query = $this->db->get();
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }   
        }

        public function get_leave_group_by_leave_type($leave_type_id="")
        {
            $this->db->select('ltg.name as leave_type_group_name,ltg.id as leave_type_group_id');
            $this->db->from("leave_type_group_common ltgc");
            $this->db->join("leave_type_groups ltg", 'ltg.id = ltgc.leave_type_group_id','left');
            $this->db->where('ltgc.leave_type_id',$leave_type_id);      

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }    
        }

        public function get_leave_type_by_leave_group($leave_type_group_id="")
        {
            $this->db->select('lt.name as leave_type_name,lt.id as leave_type_id,lt.days as leave_days');
            $this->db->from("leave_type_group_common ltgc");
            $this->db->join("leave_types lt", 'lt.id = ltgc.leave_type_id','left');
            $this->db->where('ltgc.leave_type_group_id',$leave_type_group_id);      

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }    
        }
        

	}

?>