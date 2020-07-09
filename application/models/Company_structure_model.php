<?php

    class Company_structure_model extends CI_Model

    {

    	public $_tableName = "company_structure";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }

        public function get_company_structure_types(){
            
            $this->db->select('*');
            $this->db->from("company_structure_type");
            
            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
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



        
        public function get_all(){
            
            $this->db->select('cs.*, cst.name as type_name, parent_cs.name as parent_name');
            $this->db->from($this->_tableName." cs");
            $this->db->join('company_structure_type cst', 'cs.type = cst.id','left');
            $this->db->join($this->_tableName.' parent_cs', 'cs.parent = parent_cs.id','left');
            $this->db->where("cs.status","active");

            $query = $this->db->get();

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }
        }

        public function get_tree_view_data(){
            
            $data = array();

            $query = $this->db->query("select * from ".$this->_tableName." where parent = '0'");
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