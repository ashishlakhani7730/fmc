<?php

    class Warning_model extends CI_Model

    {

        public $_tableName = "employee_warning";



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
        
        public function get_details($employee_warning_id){

            $query = $this->db->get_where($this->_tableName, array('employee_warning_id' => $employee_warning_id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }



        
        public function get_all($company_id){
            
            $this->db->select('dv.*,emp.fullname_english,emp.fullname_arabic,wc.title_en,wc.title_ar');
            $this->db->from($this->_tableName." dv");
            $this->db->join('warning_category as wc','dv.warning_category_id = wc.warning_category_id','left');
            $this->db->join('company_employee emp', 'dv.employee_id = emp.id','left');
            $this->db->where('dv.company_id',$company_id);        
            $this->db->where('dv.status','active');        

            $this->db->order_by("dv.created_at", "desc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();              
                return $result;
            }

        }

        public function get_all_by_employee($condition){
            $offset = $condition['skip'];
            $limit = $condition['limit']; 
            $this->db->select('dv.*,emp.fullname_english,emp.fullname_arabic,wc.title_en,wc.title_ar');
            $this->db->from($this->_tableName." dv");
            $this->db->join('warning_category as wc','dv.warning_category_id = wc.warning_category_id','left');
            $this->db->join('company_employee emp', 'dv.employee_id = emp.id','left');
            $this->db->where('dv.employee_id',$condition['employee_id']);        
            $this->db->where('dv.status','active');        

            $this->db->order_by("dv.created_at", "desc");
            if(!empty($limit)){
                $this->db->limit($limit, $offset);
            }

            $query = $this->db->get();
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();   
                foreach($result as $key => $value){
                    $result[$key]['document'] = $this->get_document_list('employee_warning',$value['employee_warning_id']);
                }          
                return $result;
            }

        }

        public function get_document_list($document_type,$record_id){
            $this->db->select('dv.document_file');
            $this->db->from("common_documents as dv");
            $this->db->where('dv.document_type',$document_type);        
            $this->db->where('dv.record_id',$record_id);
            $query = $this->db->get();
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();           
                return $result;
            }
        }

        public function update($data){

            $this->db->where('employee_warning_id',$data['employee_warning_id']);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }

        public function insert($data){

            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return $this->db->insert_id();
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