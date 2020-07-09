<?php

    class Company_payroll_model extends CI_Model
    {

    	public $_tableName = "company_payroll";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

        public function get_details_by_request_id($request_id){

            $query = $this->db->get_where($this->_tableName, array('request_id' => $request_id));           
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
            
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");            
            
            if($company_id == ""){
                $this->db->where('dv.company_id',$company_id);
            }
            
            $this->db->order_by("dv.modified_at", "desc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
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
                $user_id = $this->db->insert_id();
                if($user_id){
                    return $user_id;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }

        public function delete($id, $status){

            $data = array('status' => $status);
            $this->db->where('id',$id);
            if($this->db->delete($this->_tableName))
            {
                return true;
            }else{
                return false;
            }

        }

        public function add_payroll_components($data){
            $this->db->insert_batch("company_employee_payroll_components", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }
       
        public function get_employee_salary_component($employee_id = ""){

            $this->db->select('dv.*,sal_com.component_type as salary_component_type,sal_com.name_in_payslip as name_in_payslip,sal_com.calculation_type as calculation_type');
            $this->db->from("company_employee_salary_components"." dv");
            $this->db->join('salary_components sal_com', 'sal_com.id = dv.salary_component_id','left');

            $this->db->where('dv.employee_id',$employee_id);

            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function insert_company_payroll_employees_components($data){
            $this->db->insert_batch("company_payroll_employees_component", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }        

        public function insert_company_payroll_employees($data){
            $this->db->insert_batch("company_payroll_employees", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_employee_payroll($payroll_id){
            
            $this->db->select('dv.*,emp.fullname_english,emp.fullname_arabic,emp.monthly_salary');
            $this->db->from("company_payroll_employees"." dv");            
            $this->db->join('company_employee emp', 'emp.id = dv.employee_id','left');

            $this->db->where('dv.payroll_id',$payroll_id);

            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $results = $query->result_array();
                $response_arr = array();
                foreach ($results as $value) {
                    $this->db->select('dv.*');
                    $this->db->from("company_payroll_employees_component"." dv");            
                    $this->db->where('dv.payroll_id',$payroll_id);
                    $this->db->where('dv.employee_id',$value['employee_id']);
                    $component_query = $this->db->get()->result_array();
                    $value['components'] = $component_query;
                    $response_arr[] = $value;                    
                }
                return $response_arr;
            }else{
                return array();
            }   
        }

        public function check_duplicate_payroll($company_id,$month,$year){
            $query = $this->db->get_where("company_payroll", array('company_id' => $company_id,'month' => $month,'year' => $year));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }   
        }

        public function update_employee_payroll_status_to_draft($payroll_id){
            $this->db->where('payroll_id',$payroll_id);
            if($this->db->update("company_payroll_employees",array('status'=>'draft')))
            {
                return true;
            }else{
                return false;
            }
        }
        
        public function update_employee_payroll($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("company_payroll_employees",$data))
            {
                return true;
            }else{
                return false;
            }
        }
        public function update_employee_payroll_component($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("company_payroll_employees_component",$data))
            {
                return true;
            }else{
                return false;
            }
        }
        
	}

?>