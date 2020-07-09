<?php

    class Support_model extends CI_Model
    {

    	public $_tableName = "tickets";

        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
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
            
            // $this->db->select('dv.*, desi.name as designation_name');
            // $this->db->from($this->_tableName." dv");
            // $this->db->join('company_designation desi', 'desi.id = dv.job_designation','left');
            // $this->db->where('dv.status !=','deleted');
            // $this->db->where('dv.company_id',$company_id);
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.status','active');
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