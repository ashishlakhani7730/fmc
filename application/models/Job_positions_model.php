<?php

    class Job_positions_model extends CI_Model

    {

    	public $_tableName = "job_positions";



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


        public function get_all_by_status($company_id = "",$status = ""){
            
            $this->db->select('dv.*, desi.name as designation_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('company_designation desi', 'desi.id = dv.designation','left');
            $this->db->where('dv.status',$status);
            $this->db->where('dv.company_id',$company_id);
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }

        }

        
        public function get_all($company_id = ""){
            
            $this->db->select('dv.*, desi.name as designation_name,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,');
            $this->db->from($this->_tableName." dv");
            $this->db->join('company_designation desi', 'desi.id = dv.designation','left');
            $this->db->join('company_employee emp', 'emp.job_position = dv.id','left');
            $this->db->where('dv.status !=','deleted');
            $this->db->where('dv.company_id',$company_id);
            
            $query = $this->db->get();
            
            if($this->db->affected_rows() > 0){
                $result = $query->result_array();
                return $result;
            }else{
                return array();
            }

        }

        public function get_tree_view_data($company_id = ""){

            $data = array();

            $this->db->select('dv.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,emp.profile_pic as emp_profile_pic,emp.id as emp_id,des.name as designation_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('company_employee emp', 'emp.job_position = dv.id','left');
            $this->db->join('company_designation des', 'des.id = dv.designation','left');

            $this->db->where('dv.under_employee_id','0');

            if(!empty($company_id)){
                $this->db->where('dv.company_id',$company_id);
            }

            $query = $this->db->get();

            $results = $query->result_array();

            foreach($results as $value)
            {
                $blank_array = array();
                
                $children = $this->build_child($value['emp_id']);                
                if( !empty($children) ) {                   
                    $value['children'] = $children;
                }else{
                    $value['children'] = array();
                }
                
                $data[] = $value;
            }   
            
            
            return $data;
        }

        public function build_child($parent)
        {
            $data = array();       

            $this->db->select('dv.*,emp.fullname_english as emp_fullname_english,emp.fullname_arabic as emp_fullname_arabic,emp.profile_pic as emp_profile_pic,emp.id as emp_id,des.name as designation_name');
            $this->db->from($this->_tableName." dv");
            $this->db->join('company_employee emp', 'emp.job_position = dv.id','left');
            $this->db->join('company_designation des', 'des.id = dv.designation','left');

            $this->db->where('dv.under_employee_id',$parent);

            $query = $this->db->get();

            $results = $query->result_array();

            foreach($results as $value)
            {
                $blank_array = array();
                
                $children = $this->build_child($value['emp_id']);                
                if( !empty($children) ) {                   
                    $value['children'] = $children;
                }else{
                    $value['children'] = array();
                }
                $data[] = $value;
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

            foreach ($data as $k => $d) {
                
                $job_id = "";
                if(!empty($d['designation'])){
                    $company_id = $d['company_id'];
                    $m_designation = $d['designation'];
                    $designation = $d['designation'];
                    $cond = "true";
                    $i = 0;
                    while($cond == 'true'){
                        $query = $this->db->query("SELECT * FROM `company_designation` WHERE `id`='$designation'");
                        $row = $query->row();
                        $designation = $row->parent;
                        if($designation == "0"){
                            $cond = "false";
                        }
                        $i++;
                    }


                    $this->db->select('dv.*');
                    $this->db->from($this->_tableName." dv");
                    $this->db->like('job_id', $i, 'after');
                    
                    $query = $this->db->get();
                    if($this->db->affected_rows() > 0){
                        $job_positions_no = $this->db->affected_rows();
                        $job_positions_no++;
                    }else{
                        $job_positions_no = "01";
                    }


                    if(strlen($job_positions_no) < 2){
                        $job_positions_no = str_pad($job_positions_no, 2, '0', STR_PAD_LEFT);
                    }
                    
                    $job_id = $i.$job_positions_no;                   
                }
                $d['job_id'] = $job_id;

                $this->db->insert($this->_tableName, $d);
            }
            return true;
        }



        public function delete($id, $status){

            $data = array('status' => $status);
            $this->db->where('id',$id);

            if($this->db->update($this->_tableName,$data))
            {
                return true;
            }

        }


        public function get_parent_employee_by_designation($designation_id){

            $data = array();

            $query = $this->db->get_where("company_designation", array('id' => $designation_id));           
            if($this->db->affected_rows() > 0){
                $res = $query->row_array();                
                if($res && $res['parent'] != 0){
                    $parent_designation_id = $res['parent'];
                    $this->db->select('dv.*');
                    $this->db->from("company_employee dv");
                    $this->db->where('dv.status !=','deleted');
                    $this->db->where('dv.designation',$parent_designation_id);
                    
                    $query = $this->db->get();
                    
                    if($this->db->affected_rows() > 0){
                        $results = $query->result_array();
                        foreach ($results as $key => $value) {
                            $data[] = array(
                                'id' => $value['id'],
                                'fullname_english' => $value['fullname_english'],
                                'fullname_arabic' => $value['fullname_arabic']
                            );
                        }
                    }

                }                
            }
            return $data;
        }

	}

?>