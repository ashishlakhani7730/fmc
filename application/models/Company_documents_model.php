<?php

    class Company_documents_model extends CI_Model

    {

        public $_tableName = "company_documents";



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


    

        public function get_all_by_category($document_category_id = ""){
            
            $this->db->select('dv.*,doc.name as document_category_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('document_categories doc', 'doc.id = dv.document_category_id','left');
            $this->db->where('dv.document_category_id',$document_category_id);

            $query = $this->db->get();
            

            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }
            
        }
        
        public function get_all(){
            
            /*$this->db->select('dv.*');
            $this->db->from($this->_tableName." dv");*/
            $this->db->select('dv.*,doc.name as document_category_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('document_categories doc', 'doc.id = dv.document_category_id','left');

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
            if($this->db->delete($this->_tableName))
            {
                return true;
            }else{
                return false;
            }

        }

    }

?>