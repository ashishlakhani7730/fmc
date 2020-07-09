<?php

    class Attendance_model extends CI_Model
    {

    	public $_tableName = "company_employee_attendance";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

        public function get_employee_with_full_details($client_login_id = "",$attendance_month,$attendance_year){

            $month = $attendance_month;
            $year = $attendance_year;
            $month_days = date('t', mktime(0, 0, 0, $attendance_month, 1, $attendance_year)); 
            //$month_days = cal_days_in_month(CAL_GREGORIAN,$attendance_month,$attendance_year);

            $this->db->from("company_employee dv");
            $this->db->where('dv.status','active');
            $this->db->where('dv.client_id',$client_login_id);        

            $query = $this->db->get();
            
            $employee_array = array();
            if($this->db->affected_rows() > 0){
                $results = $query->result_array();

                foreach ($results as $value) {
                    $employee_id = $value['id'];
                    $holiday_group = $value['holiday_group'];
                    $work_group = $value['work_group'];
                    $attendance_start_date = $value['attendance_start_date'];
                    

                    $workweek_details = array(
                        'sunday' => 'no',
                        'monday' => 'no',
                        'tuesday' => 'no',
                        'wednesday' => 'no',
                        'thursday' => 'no',
                        'friday' => 'no',
                        'saturday' => 'no'
                    );

                    $workweek_query = $this->db->get_where("workweek", array('id' => $work_group));
                    if($this->db->affected_rows() > 0){
                        $workweek_details = $workweek_query->row_array();
                    }

                    $holidays = array();
                   
                    $this->db->select('h.name as holiday_name,h.id as holiday_id,h.date as holiday_date');
                    $this->db->from("holiday_group_common hgc");
                    $this->db->join("holidays h", 'h.id = hgc.holiday_id','left');
                    $this->db->where('hgc.holiday_group_id',$holiday_group);      
                    $query_holiday = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $holidays_tmp = $query_holiday->result_array();
                        foreach ($holidays_tmp as $h_value) {
                            $holidays[$h_value['holiday_date']] = $h_value['holiday_name'];
                        }
                    }

                    $leaves = array();
                    $this->db->select('dv.*');
                    $this->db->from("request_leave dv");
                    $this->db->join('requests req', 'req.id = dv.request_id','left');
                    $this->db->where('dv.employee_id',$employee_id);
                    $this->db->where('req.status','approved');
                    $this->db->order_by("dv.modified_at", "asc");
                    $query_leave = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $leaves_tmp = $query_leave->result_array();
                        foreach ($leaves_tmp as $l_value) {
                            $this->db->select('ld.*');
                            $this->db->from("request_leave_dates ld");
                            $this->db->where('ld.request_leave_id',$l_value['id']);      
                            $query_leave_days = $this->db->get();
                            $leaves_days = $query_leave_days->result_array();
                            foreach ($leaves_days as $l_d_value) {
                                $leaves[$l_d_value['leave_date']] = $l_d_value['leave_type'];
                            }
                        }
                    }

                    $attendance = array();
                    for ($i=1; $i <= $month_days; $i++) { 
                        $date_field = "date_".$i;
                        $current_date = $year."-".$month."-".str_pad($i, 2, 0, STR_PAD_LEFT);                        

                        $day_name = strtolower(date('l',strtotime($current_date)));
                        
                        $is_attendance = "no";
                        if($attendance_start_date != "0000-00-00"){
                            if(strtotime($attendance_start_date) <= strtotime($current_date)){
                                $is_attendance = "yes";
                            }
                        }
                        $attendance_value = '';
                        if($is_attendance == 'yes'){
                            $attendance_value = 'P';
                            
                            //check working day
                            if($workweek_details[$day_name] == 'no'){
                                $attendance_value = 'OFF';
                            }

                            //check holiday day
                            if (array_key_exists($current_date, $holidays)) {
                                $attendance_value = 'H';
                            }

                            //Check Leaves 
                            if (array_key_exists($current_date, $leaves)) {
                                if($leaves[$current_date] == 'full_leave'){
                                    $attendance_value = 'FL';
                                }
                                if($leaves[$current_date] == 'half_leave'){
                                    $attendance_value = 'HL';
                                }
                            }
                            
                        }
                        $attendance[$date_field] = $attendance_value; 
                    }
                    $value['attendance'] = $attendance;
                    $employee_array[] = $value;                    
                }
            }
            return $employee_array;
        }

        public function get_employee_by_empcode($employee_code){
            $this->db->from("company_employee");
            $this->db->where('employee_code',$employee_code);         
            
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();                               
                return $queryResult;
            }else{
                return false;
            }
        }

        public function is_company_attendance_exist($company_id = "",$year = "",$month = ""){

            $this->db->from($this->_tableName);            
            $this->db->where('company_id',$company_id);         

            if(!empty($year)){
                $this->db->where('year',$year);
            }
            if(!empty($month)){
                $this->db->where('month',$month);
            }
            $query = $this->db->get();

            if($this->db->affected_rows() > '0')
            {
                $queryResult = $query->row_array();                               
                return true;
            }else{
                return false;
            }
        }

        public function get_all($company_id = "",$year = "",$month = "",$employee_filter_array){
            $this->db->select('dv.*, dp.fullname_english as employee_fullname_english,dp.attendance_start_date as attendance_start_date,dp.id as employee_id');
            $this->db->from($this->_tableName." dv");
            $this->db->join('company_employee dp', 'dv.employee_id = dp.id','left');
            
            $this->db->where('dv.company_id',$company_id);        

            if(!empty($year)){
                $this->db->where('dv.year',$year);        
            }

            if(!empty($month)){
                $this->db->where('dv.month',$month);        
            }

            foreach ($employee_filter_array as $key => $value) {
                $this->db->where('dp.'.$key,$value);
            }

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
            }else{
                return false;
            }

        }
     
        public function insert_batch_data($data){
            $this->db->insert_batch($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
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

        
        public function update_attendance_document($data){
            $this->db->where('id',$data['id']);
            if($this->db->update("company_employee_attendance_document",$data))
            {
                return true;
            }else{
                return false;
            }
        }
         
        public function insert_attendance_document($data){
            $this->db->insert("company_employee_attendance_document", $data);

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

        public function get_attendance_doc_details($attendance_id,$date){
            $query = $this->db->get_where("company_employee_attendance_document", array('attendance_id' => $attendance_id,'date' => $date));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }

	}

?>