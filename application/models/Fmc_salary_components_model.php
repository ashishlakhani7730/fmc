<?php

    class Fmc_salary_components_model extends CI_Model
    {

    	public $_tableName = "salary_components";

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

        
        public function get_all_by_type($company_id = "",$component_type = ""){
            
            $this->db->select('*');
            $this->db->from($this->_tableName);
            $this->db->where('status','active');        
            $this->db->where('company_id',$company_id);
            $this->db->where('component_type',$component_type);
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
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

	}

?>