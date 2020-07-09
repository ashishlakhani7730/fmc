<?php

    class Requests_threads_model extends CI_Model
    {
    	public $_tableName = "requests_threads";

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

        public function get_all($request_id = ""){
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");
            if(!empty($request_id)){
                $this->db->where('dv.request_id',$request_id);
            }
            $this->db->order_by("dv.created_at", "asc");
            
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