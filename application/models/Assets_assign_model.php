<?php

    class Assets_assign_model extends CI_Model

    {

        public $_tableName = "assets_assign";



        function __construct() 
        {
            parent::__construct();
            $this->load->database();
        }

        public function check_item_by_employe_id($item_id,$employee_id){
            $query = $this->db->get_where($this->_tableName, 
                array(
                    'assets_item_id' => $item_id,
                    'employee_id' => $employee_id
                )
            );           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }   
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
            
            $this->db->select('dv.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,ass_item.item_name as item_name,ass_item.item_name as item_name,ass_item.item_id as item_id,ass_item.serial_number as serial_number,ass_item.conditions as assets_item_conditions');

            $this->db->from($this->_tableName." dv");

            $this->db->join('company_employee emp', 'dv.employee_id = emp.id','left');
            $this->db->join('assets_item ass_item', 'dv.assets_item_id = ass_item.id','left');

            $this->db->where('dv.status','active');  

            if(!empty($company_id)){
                $this->db->where('dv.company_id',$company_id);    
            }      

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }
        }

        public function get_full_details($id = ""){
            
            $this->db->select('dv.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,ass_item.item_name as item_name,ass_item.item_name as item_name,ass_item.item_id as item_id,ass_item.serial_number as serial_number,ass_item.conditions as assets_item_conditions');

            $this->db->from($this->_tableName." dv");

            $this->db->join('company_employee emp', 'dv.employee_id = emp.id','left');
            $this->db->join('assets_item ass_item', 'dv.assets_item_id = ass_item.id','left');

            $this->db->where('dv.status','active');  

            if(!empty($id)){
                $this->db->where('dv.id',$id);    
            }      

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->row_array();
                return $result;
            }
        }

        public function assets_assign_current($employee_id = ""){
            
            $this->db->select('dv.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,ass_item.item_name as item_name,ass_item.item_name as item_name,ass_item.item_id as item_id,ass_item.serial_number as serial_number,ass_item.conditions as assets_item_conditions');

            $this->db->from($this->_tableName." dv");

            $this->db->join('company_employee emp', 'dv.employee_id = emp.id','left');
            $this->db->join('assets_item ass_item', 'dv.assets_item_id = ass_item.id','left');

            $this->db->where('dv.status','active');  

            if(!empty($employee_id)){
                $this->db->where('dv.employee_id',$employee_id);    
            }      
            $this->db->where('dv.is_return','no');
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }
        }

        public function assets_assign_past($employee_id = ""){
            
            $this->db->select('dv.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,ass_item.item_name as item_name,ass_item.item_name as item_name,ass_item.item_id as item_id,ass_item.serial_number as serial_number,ass_item.conditions as assets_item_conditions');

            $this->db->from($this->_tableName." dv");

            $this->db->join('company_employee emp', 'dv.employee_id = emp.id','left');
            $this->db->join('assets_item ass_item', 'dv.assets_item_id = ass_item.id','left');

            $this->db->where('dv.status','active');  

            if(!empty($employee_id)){
                $this->db->where('dv.employee_id',$employee_id);    
            }      
            $this->db->where('dv.is_return','yes'); 

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