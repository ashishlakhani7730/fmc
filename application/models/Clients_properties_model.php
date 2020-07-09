<?php

    class Clients_properties_model extends CI_Model
    {

    	public $_tableName = "clients_property_information";
        public $_tableNameDraft = "clients_property_information_draft";        

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

        public function get_all_draft($clients_draft_id = ""){
            $this->db->select('dv.*,counry.country_name as nationality_name');
            $this->db->from($this->_tableNameDraft." dv");
            $this->db->where('dv.client_draft_id',$clients_draft_id);
            $this->db->join('countries counry', 'counry.id = dv.nationality','left');            
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                return $draft_data = $query->result_array();
            }else{
                return array();
            }
        }

        public function get_all($client_id = ""){            
            //Get Original Data
            $this->db->select('dv.*,counry.country_name as nationality_name');
            $this->db->from($this->_tableName." dv");
            $this->db->where('dv.client_id',$client_id);
            $this->db->join('countries counry', 'counry.id = dv.nationality','left');            
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                return $query->result_array();                
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
        
        public function remove_all_draft($client_draft_id = ""){
            $this->db->where('client_draft_id',$client_draft_id);
            if($this->db->delete($this->_tableNameDraft))
            {
                return true;
            }else{
                return false;
            }
        }

        public function remove_all($client_id = ""){
            $this->db->where('client_id',$client_id);
            if($this->db->delete($this->_tableName))
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_batch($data){
            $this->db->insert_batch($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

        public function insert_batch_draft($data){
            $this->db->insert_batch($this->_tableNameDraft, $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }


	}

?>