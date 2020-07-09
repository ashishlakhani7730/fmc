<?php

    class Requests_model extends CI_Model

    {

    	public $_tableName = "requests";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

        /* New Structure */

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

        public function update($data){
            $this->db->where('id',$data['id']);
            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }
        }

        public function get_details($id){

             $query = $this->db->query("SELECT requests.*,company_employee.fullname_english as emp_fullname_english,company_employee.fullname_arabic as emp_fullname_arabic,clients.company_name_english as company_name_english,clients.company_name_arabic as company_name_arabic FROM requests 
                LEFT JOIN company_employee ON  company_employee.id = requests.employee_id 
                LEFT JOIN clients ON  clients.id = requests.company_id 
                WHERE requests.id='$id'");

            $row = $query->row();

            if(isset($row)){
                $d = get_object_vars($row);               
                return $d;
            }else{
                return false;
            }             
        } 

        public function get_compamy_employee_primary_request($employee_id){
            $this->db->select('dv.*,client.company_name_english as company_name_english,client.company_name_arabic as company_name_arabic,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic');
            $this->db->from($this->_tableName." dv");


            $this->db->join('clients client', 'client.id = dv.company_id','left');
            $this->db->join('company_employee emp', 'emp.id = dv.employee_id','left');

            $this->db->where('dv.assigned_company_user_id',$employee_id);
            $this->db->where('dv.status !=','approved');
            $this->db->where('dv.status !=','declined');
            $this->db->where('dv.status !=','deleted');
            
            $this->db->order_by("dv.modified_at", "desc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_compamy_employee_other_request($employee_id){

            //Select Fields
            $this->db->select('req.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,emp.fullname_arabic as emp_fullname_arabic');
            //From Table
            $this->db->from("requests_employees_mapping dv");
            //Join Tables            
            $this->db->join('requests req', 'req.id = dv.request_id','left');
            $this->db->join('company_employee emp', 'emp.id = req.employee_id','left');

            //Conditions
            $this->db->where('dv.employee_id',$employee_id);
            $this->db->where('req.assigned_company_user_id !=',$employee_id);
            $this->db->where('req.status !=','approved');
            $this->db->where('req.status !=','declined');
            $this->db->where('req.status !=','deleted');

            //Sort Order
            $this->db->order_by("req.modified_at", "desc");

            //Execute Query
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                return $query->result_array();
            }else{
                return array();
            }
        }

        public function get_fmc_primary_requests($fmc_login_user_id = ""){
            
            $this->db->select('dv.*,client.company_name_english as company_name_english,client.company_name_arabic as company_name_arabic,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic');
            $this->db->from($this->_tableName." dv");

            $this->db->join('clients client', 'client.id = dv.company_id','left');
            $this->db->join('company_employee emp', 'emp.id = dv.employee_id','left');

            $this->db->where('dv.assigned_fmc_user_id',$fmc_login_user_id);        
            $this->db->where('dv.status','in_approval');  

            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }

        }

         public function get_fmc_other_requests($fmc_login_user_id = ""){
            $this->db->select('dv.*,client.company_name_english as company_name_english,client.company_name_arabic as company_name_arabic,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic');
            $this->db->from($this->_tableName." dv");

            $this->db->join('clients client', 'client.id = dv.company_id','left');
            $this->db->join('company_employee emp', 'emp.id = dv.employee_id','left');

            $this->db->where('dv.assigned_fmc_user_id !=',0);
            $this->db->where('dv.assigned_fmc_user_id !=',$fmc_login_user_id);
            $this->db->where('dv.status','in_approval');        

            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_fmc_closed_requests($fmc_login_user_id = ""){
            $this->db->select('dv.*,client.company_name_english as company_name_english,client.company_name_arabic as company_name_arabic,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic');
            $this->db->from($this->_tableName." dv");

            $this->db->join('clients client', 'client.id = dv.company_id','left');
            $this->db->join('company_employee emp', 'emp.id = dv.employee_id','left');

            if(!empty($fmc_login_user_id)){
                $this->db->where('dv.assigned_fmc_user_id',$fmc_login_user_id);
            }
            
            $this->db->where('dv.status','approved');
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function get_fmc_declined_requests($fmc_login_user_id = ""){
            $this->db->select('dv.*,client.company_name_english as company_name_english,client.company_name_arabic as company_name_arabic,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic');
            $this->db->from($this->_tableName." dv");

            $this->db->join('clients client', 'client.id = dv.company_id','left');
            $this->db->join('company_employee emp', 'emp.id = dv.employee_id','left');
            
            if(!empty($fmc_login_user_id)){
                $this->db->where('dv.assigned_fmc_user_id',$fmc_login_user_id);
            }            
            $this->db->where('dv.assigned_fmc_user_id !=',0);
            $this->db->where('dv.status','declined');
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        /* End New Structure */


        public function get_details_old($id){
            
            $query = $this->db->query("SELECT requests.*,
                clients.company_name_english as company_name_english,
                clients.company_name_arabic as company_name_arabic,
                company_employee.fullname_english as emp_fullname_english,
                company_employee.fullname_arabic as emp_fullname_arabic,
                com_emp.fullname_english as created_by_company_english,
                com_emp.fullname_arabic as created_by_company_arabic,
                fmc_user.first_name as fmc_user_first_name,
                fmc_user.last_name as fmc_user_last_name,
                fmc_user.surname as fmc_user_surname

                FROM requests LEFT JOIN clients ON  clients.id = requests.company_id 
                LEFT JOIN company_employee ON  company_employee.id = requests.employee_id 
                LEFT JOIN company_employee as com_emp ON  com_emp.id = requests.created_by_company 
                LEFT JOIN fmc_users as fmc_user ON  fmc_user.id = requests.assigned_fmc_user_id 
                WHERE requests.id='$id'");
            $row = $query->row();

            if(isset($row)){
                $d = get_object_vars($row);               
                return $d;
            }else{
                return false;
            }
        }

        
       

       



        
        public function get_all($from_user_id = "",$to_user_id = "",$request_type = "",$status = "",$limit = ""){
            
            $this->db->select('dv.*');
            $this->db->from("request dv");

            if(!empty($from_user_id)){
                $this->db->where('dv.from_user_id',$from_user_id);        
            }
            if(!empty($to_user_id)){
                $this->db->where('dv.to_user_id',$to_user_id);        
            }
            if(!empty($request_type)){
                $this->db->where('dv.request_type',$request_type);        
            }            
            if(!empty($status)){
                $this->db->where('dv.status',$status);        
            }

            $this->db->order_by("dv.modified_at", "asc");

            if(!empty($limit)){
                $this->db->limit($limit);
            }

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }

        }

        


        public function insert_request_threads($data){

            $this->db->insert('requests_threads', $data);

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

        public function get_all_employee_request($employee_id = ""){
            $this->db->select('dv.*');
            $this->db->from("requests dv");
            
            //$this->db->where('dv.employee_id',$employee_id);        
            $this->db->where('dv.status !=','deleted');     

            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }
        
        public function update_overtime($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("request_overtime",$data))
            {
                return true;
            }else{
                return false;
            }
        }
        
        public function get_overtime_details($id){
            $query = $this->db->get_where('request_overtime', array('id' => $id));

            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }

        public function insert_overtime($data){

            $this->db->insert("request_overtime", $data);

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

        public function get_all_overtime_request_for_employee($employee_id){

            $this->db->select('dv.status as request_status,req.*');
            $this->db->from("requests dv");
            $this->db->join('request_overtime req', 'req.id = dv.record_id','left');

            $this->db->where('req.employee_id',$employee_id);
            $this->db->where('dv.request_type','overtime');
            
            //$this->db->where('dv.status !=','deleted');        
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function insert_bussiness_trip($data){

            $this->db->insert("request_bussiness_trip", $data);

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

        public function get_business_trip_details($id){
            $query = $this->db->get_where('request_bussiness_trip', array('id' => $id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }

        public function update_business_trip($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("request_bussiness_trip",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_all_business_trip_request_for_employee($employee_id){

            $this->db->select('dv.status as request_status,req.*');
            $this->db->from("requests dv");
            $this->db->join('request_bussiness_trip req', 'req.id = dv.record_id','left');

            $this->db->where('req.employee_id',$employee_id);
            $this->db->where('dv.request_type','business_trip');
            
            //$this->db->where('dv.status !=','deleted');        
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
           
        }


        public function insert_leave($data){

            $this->db->insert("request_leave", $data);

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

        public function update_leave($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("request_leave",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_leave_details($id){

            $query = $this->db->query("SELECT request_leave.*,
                leave_types.name as leave_type_name
                FROM request_leave LEFT JOIN leave_types ON  leave_types.id = request_leave.leave_type_id 
                WHERE request_leave.id='$id'");
            $row = $query->row();

            if(isset($row)){
                $d = get_object_vars($row);

                $this->db->select('dv.*');
                $this->db->from("request_leave_dates dv");                
                $this->db->where('dv.request_leave_id',$d['id']);
                
                $query = $this->db->get();

                if($this->db->affected_rows() > 0){
                    $leave_dates = $query->result_array();                    
                }else{
                    $leave_dates = array();
                }
                $d['leave_dates'] = $leave_dates;

                return $d;
            }else{
                return false;
            }
        }

        public function get_all_leave_request_for_employee($employee_id){
            $this->db->select('dv.status as request_status,req.*');
            $this->db->from("requests dv");
            $this->db->join('request_leave req', 'req.id = dv.record_id','left');

            $this->db->where('req.employee_id',$employee_id);
            $this->db->where('dv.request_type','leave');
            
            //$this->db->where('dv.status !=','deleted');        
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        

        public function insert_eccr($data){

            $this->db->insert("request_eccr", $data);
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

        public function update_eccr($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("request_eccr",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_eccr_details($id){
            $query = $this->db->get_where('request_eccr', array('id' => $id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }

        public function get_all_eccr_request_for_employee($employee_id){
            $this->db->select('dv.status as request_status,req.*');
            $this->db->from("requests dv");
            $this->db->join('request_eccr req', 'req.id = dv.record_id','left');

            $this->db->where('req.employee_id',$employee_id);
            $this->db->where('dv.request_type','eccr');
            
            //$this->db->where('dv.status !=','deleted');        
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

        public function insert_general($data){
            $this->db->insert("request_general", $data);
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

        public function get_general_details($id){
            $query = $this->db->query("SELECT request_general.*,
                request_types.name as request_types_name
                FROM request_general LEFT JOIN request_types ON  request_types.id = request_general.request_type_id 
                WHERE request_general.id='$id'");
            $row = $query->row();

            if(isset($row)){
                $d = get_object_vars($row);               
                return $d;
            }else{
                return false;
            }
        }

        public function update_general($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("request_general",$data))
            {
                return true;
            }else{
                return false;
            }
        }

        public function get_all_general_request_for_employee($employee_id){
            $this->db->select('dv.status as request_status,req.*');
            $this->db->from("requests dv");
            $this->db->join('request_general req', 'req.id = dv.record_id','left');

            $this->db->where('req.employee_id',$employee_id);
            $this->db->where('dv.request_type','general');
            
            //$this->db->where('dv.status !=','deleted');        
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }
        }

	}

?>