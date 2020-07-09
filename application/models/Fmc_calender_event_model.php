<?php

    class Fmc_calender_event_model extends CI_Model

    {

        public $_tableName = "fmc_calendar_events";



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

        
        public function get_all($id = ""){
            
            $this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");
            
            if(!empty($id)){
                $this->db->where('dv.fmc_user_id',$id);  
            }

            $this->db->where('dv.status','active');  
            $this->db->order_by("dv.modified_at", "asc");

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
                return true;
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

    }

?>