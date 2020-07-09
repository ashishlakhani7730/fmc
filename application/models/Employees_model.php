<?php

    class Employees_model extends CI_Model
    {
    	public $_tableName = "company_employee";

        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

	    public function checkUser($data){
    		$this->db->from($this->_tableName);
            $this->db->where('email',$data['email']);         
            $this->db->where('status','active');
            $this->db->where('is_login','yes');
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();               
                
                if($queryResult['password'] == $data['password']){
                    $queryResult["created_at"] = date('d/m/Y H:i:s', strtotime($queryResult['created_at']));
                    $queryResult["modified_at"] = date('d/m/Y H:i:s', strtotime($queryResult['modified_at']));

                    if(!empty($queryResult['profile_picture'])){
                        $queryResult['profile_picture'] = $queryResult['profile_picture'];
                    }else{
                        $queryResult['profile_picture'] = "user_default.png";
                    }
                    return $queryResult;
                }
            }else{
                return false;
            }
	    }

        
        public function checkEmployeeCode($employee_code,$employee_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('employee_code',$employee_code);         
            if(!empty($employee_id)){
                $this->db->where('id !=',$employee_id);
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

        public function checkEmail($email,$fmc_user_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('email',$email);         
            if(!empty($fmc_user_id)){
                $this->db->where('id !=',$fmc_user_id);
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

        public function checkFMCEmployeeID($email,$fmc_user_id = ""){
            $this->db->from($this->_tableName);
            $this->db->where('fmc_employee_id',$email);
            if(!empty($fmc_user_id)){
                $this->db->where('id !=',$fmc_user_id);
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

        public function get_parent_employee($employee_id){
            $query = $this->db->get_where($this->_tableName, array('id' => $employee_id));
            if($this->db->affected_rows() > 0){
                $employee_details = $query->row_array();                
                $query = $this->db->get_where("job_positions", array('id' => $employee_details['job_position']));
                if($this->db->affected_rows() > 0){
                    $job_pos_details = $query->row_array();
                    if($job_pos_details['under_employee_id'] != 0){
                        $query = $this->db->get_where($this->_tableName, array('id' => $job_pos_details['under_employee_id']));
                        if($this->db->affected_rows() > 0){
                            $employee_details_one = $query->row_array();
                            if($employee_details_one['status'] == 'active'){
                                return $employee_details_one;
                            }else{
                                return $this->get_parent_employee($employee_details_one['id']);
                            }
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        
        public function get_details_with_join($id){        
            $query = $this->db->query("SELECT company_employee.*,company_departments.name as department_name,
                company_designation.name as designation_name,
                job_positions.job_title as job_position_title,
                regions.name as kingdom_region_name,
                city.name as kingdom_city_name 
                FROM company_employee LEFT JOIN company_departments ON  company_departments.id = company_employee.department 
                LEFT JOIN company_designation ON  company_designation.id = company_employee.designation 
                LEFT JOIN job_positions ON  job_positions.id = company_employee.job_position 
                LEFT JOIN regions ON  regions.id = company_employee.kingdom_region_id 
                LEFT JOIN city ON  city.id = company_employee.kingdom_city_id 
                WHERE company_employee.id='$id'");
            $row = $query->row();

            if(isset($row)){
                $d = get_object_vars($row);               
                return $d;
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

        public function get_details_by_request_id($request_id){
            $query = $this->db->query("SELECT company_employee.*,company_departments.name as department_name,
                company_designation.name as designation_name,
                job_positions.job_title as job_position,
                regions.name as kingdom_region_name,
                city.name as kingdom_city_name 
                FROM company_employee LEFT JOIN company_departments ON  company_departments.id = company_employee.department 
                LEFT JOIN company_designation ON  company_designation.id = company_employee.designation 
                LEFT JOIN job_positions ON  job_positions.id = company_employee.job_position 
                LEFT JOIN regions ON  regions.id = company_employee.kingdom_region_id 
                LEFT JOIN city ON  city.id = company_employee.kingdom_city_id 
                WHERE company_employee.request_id='$request_id'");
            $row = $query->row();

            if(isset($row)){
                $d = get_object_vars($row);               
                return $d;
            }else{
                return false;
            }   
        }

        public function get_education_request_details_by_request_id($request_id){
            $this->db->from("company_employee_educations_request dv");
            $this->db->where('dv.request_id',$request_id);
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }
        public function get_experience_request_details_by_request_id($request_id){
            $this->db->from("company_employee_work_experience_request dv");
            $this->db->where('dv.request_id',$request_id);
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_draft_details($employee_id){
            $query = $this->db->get_where("company_employee_draft", array('employee_id' => $employee_id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }
        
        public function get_by_filter($client_login_id = "",$employee_filter_array){
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status','active');
            $this->db->where('dv.client_id',$client_login_id);        

            foreach ($employee_filter_array as $key => $value) {
                $this->db->where('dv.'.$key,$value);
            }
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_employee_share_link($employee_id){
            $query = $this->db->get_where("company_employee_share_link", array('employee_id' => $employee_id));           
            if($this->db->affected_rows() > 0){
                return $query->row_array();
            }else{
                return false;
            }
        }
        
        public function check_public_share_link_exist($share_link){
            $this->db->from("company_employee_share_link");
            $this->db->where('share_link',$share_link);         
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();                               
                return $queryResult;
            }else{
                return false;
            }
        }

        public function get_share_link_details($share_link){
            $query = $this->db->get_where("company_employee_share_link", array('share_link' => $share_link));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }
                
        public function update_public_share_link($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("company_employee_share_link",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_public_share_link($employee_id){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_share_link"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_public_share_link($data){
            $query = $this->db->get_where("company_employee_share_link", array('employee_id' => $data['employee_id']));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                $res['share_link'] = $data['share_link'];
                $res['expiry_date'] = $data['expiry_date'];
                $res['status'] = $data['status'];

                $this->db->where('id',$res['id']);
                if($this->db->update("company_employee_share_link",$res))
                {
                    return true;
                }else{
                    return false;
                }                
            }else{
                $this->db->insert("company_employee_share_link", $data);
                if($this->db->affected_rows())
                {
                    $user_id = $this->db->insert_id();
                    if($user_id){
                        return true;
                    }else{
                        return false;
                    }
                }   
            }
        }

        public function get_all($client_login_id = ""){

            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status','active');
            $this->db->where('dv.client_id',$client_login_id);
            $this->db->or_where('dv.status','draft');
            $this->db->or_where('dv.status','in_approval');
            
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

        public function update_draft($data){
            $this->db->where('employee_id',$data['employee_id']);
            if($this->db->update("company_employee_draft",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function company_employees_to_draft($employee_id){
            $query = $this->db->get_where($this->_tableName, array('id' => $employee_id));           
            if($this->db->affected_rows() > 0){
                $employee_details = $query->row_array();

                //Employee Basic Data
                unset($employee_details['id']);
                unset($employee_details['mobile']);
                unset($employee_details['email']);
                unset($employee_details['password']);
                unset($employee_details['joining_date']);
                unset($employee_details['attendance_start_date']);
                unset($employee_details['job_position']);
                unset($employee_details['designation']);
                unset($employee_details['department']);
                unset($employee_details['leave_group']);
                unset($employee_details['holiday_group']);
                unset($employee_details['work_group']);
                unset($employee_details['annual_ctc']);
                unset($employee_details['monthly_salary']);
                unset($employee_details['is_login']);
                unset($employee_details['status']);
                unset($employee_details['request_id']);

                $employee_details['created_at'] = date('Y-m-d H:i:s');
                $employee_details['modified_at'] = date('Y-m-d H:i:s');
                $employee_details['employee_id'] = $employee_id;

                $this->db->insert("company_employee_draft", $employee_details);
                //End Employee Basic Data

                //Emergency Contacts
                $this->db->from("company_employee_emergency_contacts"." dv");
                $this->db->where('dv.employee_id',$employee_id);                        
                $query = $this->db->get();                
                if($this->db->affected_rows() > 0){
                    $results = $query->result_array();                 
                    $this->db->insert_batch("company_employee_emergency_contacts_draft", $results);
                }
                //End Emergency Contacts

                //Educations
                $this->db->from("company_employee_educations"." dv");
                $this->db->where('dv.employee_id',$employee_id);                        
                $query = $this->db->get();                
                if($this->db->affected_rows() > 0){
                    $results = $query->result_array();                 
                    $this->db->insert_batch("company_employee_educations_draft", $results);
                }
                //End Educations

                //Workexperience
                $this->db->from("company_employee_work_experience"." dv");
                $this->db->where('dv.employee_id',$employee_id);                        
                $query = $this->db->get();                
                if($this->db->affected_rows() > 0){
                    $results = $query->result_array();                 
                    $this->db->insert_batch("company_employee_work_experience_draft", $results);
                }
                //End Workexperience


                //Employee Documents
                $this->db->from("company_employee_documents"." dv");
                $this->db->where('dv.employee_id',$employee_id);                        
                $query = $this->db->get();                
                $documents = array();
                if($this->db->affected_rows() > 0){
                    $results = $query->result_array();                 
                    foreach ($results as $value) {
                        unset($value['id']);
                        $documents[] = $value;
                    }
                }
                if(count($documents) > 0){
                    $this->db->insert_batch("company_employee_documents_draft", $documents);
                }
                //End Employee Documents
                


            }else{
                return false;
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

        public function get_employee_benefits($employee_id = ""){
            $this->db->from("company_employee_benefits"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }
        
        public function remove_employee_benefits($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_benefits"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function add_employee_benefits($data){
            $this->db->insert_batch("company_employee_benefits", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }
        
        public function get_emergenct_contacts($employee_id = ""){
            $this->db->from("company_employee_emergency_contacts"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_emergenct_contacts_draft($employee_id = ""){
            $this->db->from("company_employee_emergency_contacts_draft"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }
        
        public function add_emergency_contacts_draft($data){
            $this->db->insert_batch("company_employee_emergency_contacts_draft", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_emergency_contacts_draft($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_emergency_contacts_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function add_emergency_contacts($data){
            $this->db->insert_batch("company_employee_emergency_contacts", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_emergency_contacts($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_emergency_contacts"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_educations($employee_id = ""){
            $this->db->from("company_employee_educations"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_educations_draft($employee_id = ""){
            $this->db->from("company_employee_educations_draft"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }        

        public function add_educations($data){
            $this->db->insert_batch("company_employee_educations", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function add_educations_request($data){
            $this->db->insert_batch("company_employee_educations_request", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function add_educations_draft($data){
            $this->db->insert_batch("company_employee_educations_draft", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_educations($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_educations"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_educations_draft($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_educations_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_work_experience($employee_id = ""){
            $this->db->from("company_employee_work_experience"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_work_experience_draft($employee_id = ""){
            $this->db->from("company_employee_work_experience_draft"." dv");
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function add_work_experience($data){
            $this->db->insert_batch("company_employee_work_experience", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function add_work_experience_request($data){
            $this->db->insert_batch("company_employee_work_experience_request", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function add_work_experience_draft($data){
            $this->db->insert_batch("company_employee_work_experience_draft", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_work_experience($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_work_experience"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_work_experience_draft($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_work_experience_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_salary_components($employee_id = ""){

            $this->db->select('dv.*,sc.name_in_payslip as name_in_payslip,sc.component_type as component_type,sc.calculation_type as calculation_type');
            $this->db->from("company_employee_salary_components"." dv");
            $this->db->join('salary_components sc', 'sc.id = dv.salary_component_id','left');
            $this->db->where('dv.employee_id',$employee_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function add_salary_components($data){
            $this->db->insert_batch("company_employee_salary_components", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_salary_components($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_salary_components"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_all_workshift($employee_id = ""){
            $this->db->from("company_employee_workshift"." dv");
            $this->db->where('dv.employee_id',$employee_id);                    
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function add_workshift($data){
            $this->db->insert_batch("company_employee_workshift", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_workshift($employee_id = ""){
            $this->db->where('employee_id',$employee_id);
            if($this->db->delete("company_employee_workshift"))
            {
                return true;
            }else{
                return false;
            }
        }
    
	}

?>