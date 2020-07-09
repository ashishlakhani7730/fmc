<?php

    class Warning_categories_model extends CI_Model

    {

        public $_tableName = "warning_category";



        function __construct() 
        {
            parent::__construct();
            $this->load->database();
        }

        public function checkDuplicateName($title_en = "",$title_ar = "",$warning_category_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('title_en',$title_en);
            $this->db->where('title_ar',$title_ar);
            if(!empty($warning_category_id)){
                $this->db->where('warning_category_id !=',$warning_category_id);
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
        
        public function get_details($warning_category_id){

            $query = $this->db->get_where($this->_tableName, array('warning_category_id' => $warning_category_id));           
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

            $this->db->order_by("dv.created_at", "desc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();              
                return $result;
            }

        }

        public function update($data){

            $this->db->where('warning_category_id',$data['warning_category_id']);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }

        public function insert($data){

            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }

        }


        public function delete($warning_category_id, $status){

            $data = array('status' => $status);
            $this->db->where('warning_category_id',$warning_category_id);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }
        }

    }

?>