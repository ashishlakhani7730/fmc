<?php

    class Requests_leave_model extends CI_Model
    {
    	public $_tableName = "request_leave";
        
        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

        public function insert_leave_dates($data){
            $this->db->insert_batch("request_leave_dates", $data);

            if($this->db->affected_rows())
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
                $inserted_id = $this->db->insert_id();
                if($inserted_id){
                    return $inserted_id;
                }else{
                    return false;
                }                
            }else{
                return false;
            }
        }

        public function get_all_approved_leaves($employee_id = "",$leave_type_id = ""){
            $this->db->select('req.status as request_status,dv.*');
            $this->db->from($this->_tableName." dv");
            $this->db->join('requests req', 'req.id = dv.request_id','left');

            if($employee_id != ""){
                $this->db->where('dv.employee_id',$employee_id);
            }
            if($leave_type_id != ""){
                $this->db->where('dv.leave_type_id',$leave_type_id);
            }            
            $this->db->where('req.status','approved');            
            
            $this->db->order_by("dv.modified_at", "asc");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }   
        }

        public function get_all($employee_id = ""){

            $this->db->select('req.status as request_status,dv.*');
            $this->db->from($this->_tableName." dv");
            $this->db->join('requests req', 'req.id = dv.request_id','left');

            if($employee_id != ""){
                $this->db->where('dv.employee_id',$employee_id);
            }
            
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

        public function get_details($id){
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

        public function get_details_by_request_id($id){
            $query = $this->db->query("SELECT request_leave.*,
                leave_types.name as leave_type_name
                FROM request_leave LEFT JOIN leave_types ON  leave_types.id = request_leave.leave_type_id 
                WHERE request_leave.request_id='$id'");
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
        
        

	}

?>