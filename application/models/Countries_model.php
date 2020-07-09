<?php

    class Countries_model extends CI_Model

    {

    	public $_tableName = "countries";



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

        public function checkDuplicateName($country_name = "",$id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('country_name',$country_name);
            if(!empty($id)){
                $this->db->where('id !=',$id);
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

        public function checkDuplicateCode($country_code = "",$id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('country_code',$country_code);
            if(!empty($id)){
                $this->db->where('id !=',$id);
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

        
        public function get_all(){
            
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }

        }

        public function update($data){

            if($data['is_default'] == 1){
                $update_data = array('is_default' => 0);
                $this->db->where('is_default',1);
                $this->db->update($this->_tableName,$update_data);
            }

            $this->db->where('id',$data['id']);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }



        public function insert($data){

            if($data['is_default'] == 1){
                $update_data = array('is_default' => 0);
                $this->db->where('is_default',1);
                $this->db->update($this->_tableName,$update_data);
            }

            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }

        }



      /*  public function delete($id, $status){

            $data = array('status' => $status);
            $this->db->where('id',$id);
            if($this->db->delete($this->_tableName))
            {
                return true;
            }else{
                return false;
            }

        }*/


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