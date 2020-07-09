<?php
    class Medical_categories_model extends CI_Model
    {
        public $_tableName = "medical_categories";

        function __construct() 
        {
            parent::__construct();
            $this->load->database();
        }

        public function checkDuplicateName($name = "",$medical_category_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('name',$name);
            if(!empty($medical_category_id)){
                $this->db->where('medical_category_id !=',$medical_category_id);
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
        
        public function get_details($medical_category_id){

            $query = $this->db->get_where($this->_tableName, array('medical_category_id' => $medical_category_id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }



        
        public function get_all(){
            
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status','active');        

            $this->db->order_by("dv.created_at", "asc");

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

            $this->db->where('medical_category_id',$data['medical_category_id']);
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


        public function delete($medical_category_id, $status){

            $data = array('status' => $status);
            $this->db->where('medical_category_id',$medical_category_id);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }
        }

    }

?>