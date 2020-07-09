<?php

    class Requests_eccr_model extends CI_Model
    {
    	public $_tableName = "request_eccr";
        
        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
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
            $query = $this->db->get_where($this->_tableName, array('id' => $id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }

        public function get_details_by_request_id($id){
            $query = $this->db->get_where($this->_tableName, array('request_id' => $id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();
                return $res;
            }else{
                return false;
            }
        }
        
        

	}

?>