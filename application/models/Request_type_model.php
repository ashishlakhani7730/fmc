<?php

    class Request_type_model extends CI_Model

    {

    	public $_tableName = "request_types";



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
            
            $this->db->select('ds.*, parent.name as parent_request_type');
            $this->db->from($this->_tableName." ds");
            $this->db->join($this->_tableName.' parent', 'ds.parent = parent.id','left');

            $this->db->where("ds.company_id",$company_id);
            $this->db->where("ds.status","active");
            

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }
        }

        public function build_child($parent)
        {
            $data = array();       

            $query = $this->db->query("select * from ".$this->_tableName." where parent = '".$parent."'");
            $results = $query->result();

            foreach($results as $value)
            {
                $blank_array = array();
                $blank_array['id'] = $value->id;
                $blank_array['text'] = $value->name; 

                $children = $this->build_child($value->id);                
                if( !empty($children) ) {                   
                    $blank_array['nodes'] = $children;
                }
                $data[] = $blank_array;
            }
            return $data;
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