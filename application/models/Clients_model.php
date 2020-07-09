<?php

    class Clients_model extends CI_Model
    {

    	public $_tableName = "clients";

        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }	

        public function create_draft_company_if_not_exist($client_id){
             //$query = $this->db->get_where("clients_draft", array('client_id' => $id));
            $query_check = $this->db->query("SELECT * FROM `clients_draft` WHERE `client_id`='$client_id' AND `status`!='declined' AND `status`!='confirmed' ORDER BY `id` DESC LIMIT 0,1");

            if ($query_check->num_rows() > 0){
                $results = $query_check->result_array();
                $client_draft_id = $results[0]['id'];
                return $client_draft_id;
            }else{

                //Create If Not Exist
                $this->db->select('dv.*');
                $this->db->from($this->_tableName." dv");
                $this->db->where('dv.id',$client_id);

                $query = $this->db->get();

                if($this->db->affected_rows() > 0){
                    $result = $query->result_array();
                    $result = $result[0];

                    $result['client_id'] = $client_id;
                    $result['status'] = "draft";
                    unset($result['id']);
                    
                    $this->db->insert("clients_draft", $result);
                    if($this->db->affected_rows())
                    {
                        $client_draft_id = $this->db->insert_id();

                        //Get Executives
                        $this->db->from("clients_executives_details"." dv");
                        $this->db->where('dv.client_id',$client_id);
                        $query = $this->db->get();
                        if($this->db->affected_rows() > 0){
                            $executives = $query->result_array();
                            $executives_arr = array();
                            foreach ($executives as $value) {
                                unset($value['id']);
                                $value['client_draft_id'] = $client_draft_id;
                                $executives_arr[] = $value;    
                            }
                        }
                        if(count($executives_arr) > 0){
                            $this->db->insert_batch("clients_executives_details_draft", $executives_arr);
                        }

                        //Get Properties
                        $this->db->from("clients_property_information"." dv");
                        $this->db->where('dv.client_id',$client_id);
                        $query = $this->db->get();
                        if($this->db->affected_rows() > 0){
                            $properties = $query->result_array();
                            $properties_arr = array();
                            foreach ($properties as $value) {
                                unset($value['id']);
                                $value['client_draft_id'] = $client_draft_id;
                                $properties_arr[] = $value;    
                            }
                        }
                        if(count($properties_arr) > 0){
                            $this->db->insert_batch("clients_property_information_draft", $properties_arr);
                        }  

                        //Get Documents
                        $this->db->from("clients_documents"." dv");
                        $this->db->where('dv.client_id',$client_id);
                        $query = $this->db->get();
                        if($this->db->affected_rows() > 0){
                            $documents = $query->result_array();
                            $documents_arr = array();
                            foreach ($documents as $value) {
                                unset($value['id']);
                                $value['client_draft_id'] = $client_draft_id;
                                $documents_arr[] = $value;    
                            }
                        }
                        if(count($documents_arr) > 0){
                            $this->db->insert_batch("clients_documents_draft", $documents_arr);
                        } 

                        //Get Branches
                        $this->db->from("clients_branches"." dv");
                        $this->db->where('dv.client_id',$client_id);
                        $query = $this->db->get();
                        if($this->db->affected_rows() > 0){
                            $branches = $query->result_array();
                            $branches_arr = array();
                            foreach ($branches as $value) {
                                unset($value['id']);
                                $value['client_draft_id'] = $client_draft_id;
                                $branches_arr[] = $value;
                            }
                        }
                        if(count($branches_arr) > 0){
                            $this->db->insert_batch("clients_branches_draft", $branches_arr);
                        }

                        return $client_draft_id;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }

        public function get_draft_details($clients_draft_id){
            $this->db->select('dv.*,le.name as legal_entity_name,me.name as main_activity_name,counry.country_name as country_name,region.name as region_name,ct.name as city_name');
            $this->db->from("clients_draft dv");
            $this->db->join('legal_entity le', 'le.id = dv.legal_entity','left');
            $this->db->join('main_activity me', 'me.id = dv.main_activity','left');
            $this->db->join('regions region', 'region.id = dv.region_id','left');
            $this->db->join('city ct', 'ct.id = dv.city_id','left');
            $this->db->join('countries counry', 'counry.id = dv.country_of_origin','left');

            $this->db->where('dv.id',$clients_draft_id);

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
        }

        public function get_draft_details_by_client_id($client_id){
            $query_check = $this->db->query("SELECT * FROM `clients_draft` WHERE `client_id`='$client_id' AND `status`!='declined' AND `status`!='confirmed' ORDER BY `id` DESC LIMIT 0,1");

            if ($query_check->num_rows() > 0){
                //If Found In Draft Table
                $results = $query_check->result_array();
                
                $clients_draft_id = $results[0]['id'];

                $this->db->select('dv.*,le.name as legal_entity_name,me.name as main_activity_name,counry.country_name as country_name,region.name as region_name,ct.name as city_name');
                $this->db->from("clients_draft dv");
                $this->db->join('legal_entity le', 'le.id = dv.legal_entity','left');
                $this->db->join('main_activity me', 'me.id = dv.main_activity','left');
                $this->db->join('regions region', 'region.id = dv.region_id','left');
                $this->db->join('city ct', 'ct.id = dv.city_id','left');
                $this->db->join('countries counry', 'counry.id = dv.country_of_origin','left');

                $this->db->where('dv.id',$clients_draft_id);

                $query = $this->db->get();

                if($this->db->affected_rows() > 0){
                    $result = $query->result_array();
                    return $result[0];
                }else{
                    return false;
                }

            }else{
                return false;                
            }
        }

        public function get_draft_details_by_request_id($request_id){
            $query_check = $this->db->query("SELECT * FROM `clients_draft` WHERE `request_id`='$request_id'");

            if ($query_check->num_rows() > 0){
                //If Found In Draft Table
                $results = $query_check->result_array();
                
                $clients_draft_id = $results[0]['id'];

                $this->db->select('dv.*,le.name as legal_entity_name,me.name as main_activity_name,counry.country_name as country_name,region.name as region_name,ct.name as city_name');
                $this->db->from("clients_draft dv");
                $this->db->join('legal_entity le', 'le.id = dv.legal_entity','left');
                $this->db->join('main_activity me', 'me.id = dv.main_activity','left');
                $this->db->join('regions region', 'region.id = dv.region_id','left');
                $this->db->join('city ct', 'ct.id = dv.city_id','left');
                $this->db->join('countries counry', 'counry.id = dv.country_of_origin','left');

                $this->db->where('dv.id',$clients_draft_id);

                $query = $this->db->get();

                if($this->db->affected_rows() > 0){
                    $result = $query->result_array();
                    return $result[0];
                }else{
                    return false;
                }

            }else{
                return false;                
            }
        }
        
        
        public function get_details($id){
            
            //If Not Found In Draft Table
            $this->db->select('dv.*,le.name as legal_entity_name,me.name as main_activity_name,counry.country_name as country_name,region.name as region_name,ct.name as city_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('legal_entity le', 'le.id = dv.legal_entity','left');
            $this->db->join('main_activity me', 'me.id = dv.main_activity','left');
            $this->db->join('regions region', 'region.id = dv.region_id','left');
            $this->db->join('city ct', 'ct.id = dv.city_id','left');
            $this->db->join('countries counry', 'counry.id = dv.country_of_origin','left');

            $this->db->where('dv.id',$id);

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
            
        }

        public function get_original_details($id){
            //If Not Found In Draft Table
            $this->db->select('dv.*,le.name as legal_entity_name,me.name as main_activity_name,counry.country_name as country_name,region.name as region_name,ct.name as city_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('legal_entity le', 'le.id = dv.legal_entity','left');
            $this->db->join('main_activity me', 'me.id = dv.main_activity','left');
            $this->db->join('regions region', 'region.id = dv.region_id','left');
            $this->db->join('city ct', 'ct.id = dv.city_id','left');
            $this->db->join('countries counry', 'counry.id = dv.country_of_origin','left');

            $this->db->where('dv.id',$id);

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result[0];
            }else{
                return false;
            }
        }

        public function get_clients_for_drodown(){
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status','active');
            $this->db->or_where('dv.status','confirmed');
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }
        }

        public function get_all(){
            
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status !=','deleted');
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $results = $query->result_array();
                foreach ($results as $value) {
                    
                }
                return $results;
            }else{
                return array();
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

        public function update_draft($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("clients_draft",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert($data){

            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                $client_id = $this->db->insert_id();
                if($client_id){
                    
                    /*Start Salary Component*/
                    $this->db->select('*');
                    $this->db->from("salary_components");
                    $this->db->where('status','active');        
                    $this->db->where('company_id',0);                    
                    $salary_componenet_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $salary_components_arr = array();
                        $salary_components = $salary_componenet_query->result_array();
                        foreach ($salary_components as $value) {
                            $salary_components_arr[] = array(
                                'company_id' => $client_id,
                                'component_type' => $value['component_type'],
                                'name' => $value['name'],
                                'name_in_payslip' => $value['name_in_payslip'],
                                'calculation_type' => $value['calculation_type'],
                                'value' => $value['value'],
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("salary_components", $salary_components_arr);
                    }
                    /*End Salary Component*/

                    /*Start Leave Type*/
                    $this->db->select('*');
                    $this->db->from("leave_types");
                    $this->db->where('status','active');  
                    $this->db->where('company_id',0);    
                    $leave_type_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $leave_types_arr = array();
                        $leave_types = $leave_type_query->result_array();
                        foreach ($leave_types as $value) {
                            $leave_types_arr[] = array(
                                'name' => $value['name'],
                                'days' => $value['days'],
                                'leave_type_color' => $value['leave_type_color'],
                                'company_id' => $client_id,
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("leave_types", $leave_types_arr);
                    }
                    /*End Leave Type*/

                    /*Start Leave Group*/
                    $this->db->select('*');
                    $this->db->from("leave_type_groups");
                    $this->db->where('status','active');  
                    $this->db->where('company_id',0);    
                    $leave_type_group_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $leave_types_group_arr = array();
                        $leave_types_group = $leave_type_group_query->result_array();
                        foreach ($leave_types_group as $value) {
                            $leave_types_group_arr[] = array(
                                'name' => $value['name'],
                                'company_id' => $client_id,
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("leave_type_groups", $leave_types_group_arr);
                    }
                    /*End Leave Group*/

                    /*Start Holiday*/
                    $this->db->select('*');
                    $this->db->from("holidays");
                    $this->db->where('status','active');  
                    $this->db->where('company_id',0);    
                    $holiday_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $holiday_arr_new = array();
                        $holiday_arr = $holiday_query->result_array();
                        foreach ($holiday_arr as $value) {
                            $holiday_arr_new[] = array(
                                'name' => $value['name'],
                                'company_id' => $client_id,
                                'date' => $value['date'],
                                'description' => $value['description'],
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("holidays", $holiday_arr_new);
                    }
                    /*End Holiday*/


                     /*Start Holiday Group*/
                    $this->db->select('*');
                    $this->db->from("holidays_groups");
                    $this->db->where('status','active');  
                    $this->db->where('company_id',0);    
                    $holiday_group_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $holiday_group_arr_new = array();
                        $holiday_group_arr = $holiday_group_query->result_array();
                        foreach ($holiday_group_arr as $value) {
                            $holiday_group_arr_new[] = array(
                                'name' => $value['name'],
                                'company_id' => $client_id,
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("holidays_groups", $holiday_group_arr_new);
                    }
                    /*End Holiday Group*/

                    /*Start Workweek*/
                    $this->db->select('*');
                    $this->db->from("workweek");
                    $this->db->where('status','active');  
                    $this->db->where('company_id',0);    
                    $workweek_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $workweek_arr_new = array();
                        $workweek_arr = $workweek_query->result_array();
                        foreach ($workweek_arr as $value) {
                            $workweek_arr_new[] = array(                                
                                'company_id' => $client_id,
                                'name' => $value['name'],
                                'sunday' => $value['sunday'],
                                'monday' => $value['monday'],
                                'tuesday' => $value['tuesday'],
                                'wednesday' => $value['wednesday'],
                                'thursday' => $value['thursday'],
                                'friday' => $value['friday'],
                                'saturday' => $value['saturday'],
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("workweek", $workweek_arr_new);
                    }
                    /*End Workweek*/

                    /*Start Work Shift*/
                    $this->db->select('*');
                    $this->db->from("company_workshift");
                    $this->db->where('status','active');
                    $this->db->where('company_id',0);
                    $worshift_query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $workshift_arr_new = array();
                        $workshift_arr = $worshift_query->result_array();
                        foreach ($workshift_arr as $value) {
                            $workshift_arr_new[] = array(
                                'company_id' => $client_id,
                                'start_time' => $value['start_time'],
                                'end_time' => $value['end_time'],
                                'shift_name' => $value['shift_name'],
                                'status' => 'active',
                                'created_at' => date('Y-m-d H:i:s'),
                                'modified_at' => date('Y-m-d H:i:s')
                            );
                        }
                        $this->db->insert_batch("company_workshift", $workshift_arr_new);
                    }
                    /*End Work Shift*/
                    
                    //Insert Default Departments
                    $company_departments_data = array();
                    $company_departments_data[] = array(
                        'company_id' => $client_id,
                        'name' => "Department 1",
                        'status' => 'active',
                        'created_at' => date('Y-m-d H:i:s'),
                        'modified_at' => date('Y-m-d H:i:s')
                    );
                    $company_departments_data[] = array(
                        'company_id' => $client_id,
                        'name' => "Department 2",
                        'status' => 'active',
                        'created_at' => date('Y-m-d H:i:s'),
                        'modified_at' => date('Y-m-d H:i:s')
                    );
                    $company_departments_data[] = array(
                        'company_id' => $client_id,
                        'name' => "Department 3",
                        'status' => 'active',
                        'created_at' => date('Y-m-d H:i:s'),
                        'modified_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert_batch("company_departments", $company_departments_data);
                    //End Insert Default Departments

                    //Add Data to Draft Client
                    $data['client_id'] = $client_id;
                    $data['status'] = 'draft';
                    $this->db->insert("clients_draft", $data);
                    if($this->db->affected_rows())
                    {
                        $client_draft_id = $this->db->insert_id();
                        return $client_draft_id;
                    }else{
                        return false;
                    }
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

        public function delete_draft($id){

            $this->db->where('client_id', $id);
            if($this->db->delete('clients_draft')){
                return true;
            }else{
                return false;
            }
        }    

        public function insert_contract($data){

            $this->db->insert("clients_contract_details", $data);

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

        public function get_contract_details($client_id){
            $query = $this->db->get_where("clients_contract_details", array('id' => $id));
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }

        public function get_executives_draft($client_draft_id = ""){
            //Get Draft Data
            $this->db->from("clients_executives_details_draft"." dv");
            $this->db->where('dv.client_draft_id',$client_draft_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                return $query->result_array();
            }else{
                return array();
            }
        }

        public function get_executives($client_id = ""){
            //Get Original Data
            $this->db->from("clients_executives_details"." dv");
            $this->db->where('dv.client_id',$client_id);        
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                return $query->result_array();
            }else{
                return array();
            }
        }

        public function remove_all_executives($client_id = ""){
            $this->db->where('client_id',$client_id);
            if($this->db->delete("clients_executives_details"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_all_executives_draft($client_draft_id = ""){
            $this->db->where('client_draft_id',$client_draft_id);
            if($this->db->delete("clients_executives_details_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_executives($data){            
            $this->db->insert_batch("clients_executives_details", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_executives_draft($data){
            $this->db->insert_batch("clients_executives_details_draft", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_branches_draft($client_draft_id = ""){  
            $this->db->select('dv.*,region.name as region_name,ct.name as city_name');
            $this->db->from("clients_branches_draft"." dv");
            $this->db->where('dv.client_draft_id',$client_draft_id);        
            $this->db->join('regions region', 'region.id = dv.region_id','left');
            $this->db->join('city ct', 'ct.id = dv.city_id','left');

            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                return $query->result_array();
            }else{
                return array();
            }
        }

        public function get_branches($client_id = ""){  

            //Get Original Data
            $this->db->select('dv.*,region.name as region_name,ct.name as city_name');
            $this->db->from("clients_branches"." dv");
            $this->db->where('dv.client_id',$client_id);        
            $this->db->join('regions region', 'region.id = dv.region_id','left');
            $this->db->join('city ct', 'ct.id = dv.city_id','left');

            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                return $query->result_array();
            }else{
                return array();
            }
        }

        public function remove_all_branches($client_id = ""){
            $this->db->where('client_id',$client_id);
            if($this->db->delete("clients_branches"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_all_branches_draft($client_draft_id = ""){
            $this->db->where('client_draft_id',$client_draft_id);
            if($this->db->delete("clients_branches_draft"))
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_branches($data){
            $this->db->insert_batch("clients_branches", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_branches_draft($data){
            $this->db->insert_batch("clients_branches_draft", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_documents($client_id = ""){
            
            $this->db->select('dv.*, fmc.first_name as created_by_first_name, fmc.last_name as created_by_last_name, fmc.surname as created_by_surname');
            $this->db->from("clients_documents"." dv");
            $this->db->join('fmc_users fmc', 'fmc.id = dv.client_id','left');
            $this->db->where('dv.client_id',$client_id);
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_documents_draft($client_draft_id = ""){
            $this->db->select('dv.*, fmc.first_name as created_by_first_name, fmc.last_name as created_by_last_name, fmc.surname as created_by_surname');
            $this->db->from("clients_documents_draft"." dv");
            $this->db->join('fmc_users fmc', 'fmc.id = dv.client_id','left');
            $this->db->where('dv.client_draft_id',$client_draft_id);
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function remove_all_documents($client_id){
            $this->db->where('client_id',$client_id);
            if($this->db->delete("clients_documents"))
            {
                return true;
            }else{
                return false;
            }            
        }

        public function insert_document_batch($data){
            $this->db->insert_batch("clients_documents", $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_document($data){
            $this->db->insert("clients_documents", $data);
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

        public function insert_document_draft($data){
            $this->db->insert("clients_documents_draft", $data);
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

        public function delete_document_draft($id, $status){

            $data = array('status' => $status);
            $this->db->where('id',$id);
            if($this->db->update("clients_documents_draft",$data))
            {
                return true;
            }else{
                return false;
            }
        }        


	}

?>