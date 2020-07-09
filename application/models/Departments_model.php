<?php

    class Departments_model extends CI_Model

    {

    	public $_tableName = "departments";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

	    
        public function get_department_details($id){

            $query = $this->db->get_where($this->_tableName, array('id' => $id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }



        
        public function get_departments(){

            $this->db->select('*');
            $this->db->from($this->_tableName);
            $this->db->where('status','active');        

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }

        }

        public function update_department($data){

            $this->db->where('id',$data['id']);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }



        public function insert_department($data){

            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }

        }



        public function delete_department($id, $status){

            $data = array('status' => $status);
            $this->db->where('id',$id);

            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }

	}

?>