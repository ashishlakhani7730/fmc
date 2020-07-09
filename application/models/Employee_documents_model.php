<?php

    class Employee_documents_model extends CI_Model
    {
        public $_tableName = "company_employee_documents";

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

        public function get_details_draft($id){
            $query = $this->db->get_where("company_employee_documents_draft", array('id' => $id));
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }
        
        
        public function get_all($employee_id){
            
            $this->db->select('*');
            $this->db->from($this->_tableName);
            
            $this->db->where('employee_id',$employee_id);  
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_all_draft($employee_id){
            
            $this->db->select('*');
            $this->db->from("company_employee_documents_draft");
            
            $this->db->where('employee_id',$employee_id);  
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        
        public function update_draft($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("company_employee_documents_draft",$data))
            {
                return true;
            }else{
                return false;
            }
        }
        

        public function update($data){
            $this->db->where('id',$data['id']);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }else{
                return false;
            }
        }

        

        public function insert_draft($data){

            $this->db->insert("company_employee_documents_draft", $data);

            if($this->db->affected_rows())
            {
                $inserted_id = $this->db->insert_id();
                if($inserted_id){
                    return $inserted_id;
                }else{
                    return false;
                }
            }else{
                return false;
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
            }else{
                return false;
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

        public function delete_draft($id){
            $this->db->where('id',$id);
            if($this->db->delete("company_employee_documents_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function delete($id){
            $this->db->where('id',$id);
            if($this->db->delete($this->_tableName))
            {
                return true;
            }else{
                return false;
            }
        }

        public function delete_all_draft($employee_id){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_documents_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

    }

?>