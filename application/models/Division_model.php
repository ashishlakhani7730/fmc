<?php

    class Division_model extends CI_Model

    {

    	public $_tableName = "department_module";



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



        
        public function get_all($department_id = ""){
            
            $this->db->select('dv.*, dp.department_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('departments dp', 'dv.department_id = dp.id','left');
            if(!empty($department_id)){
                $this->db->where('dv.department_id',$department_id);            
            }
            $this->db->where('dv.status','active');        

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
                return true;
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