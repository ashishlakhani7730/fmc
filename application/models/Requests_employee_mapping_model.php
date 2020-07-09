<?php

    class Requests_employee_mapping_model extends CI_Model
    {

    	public $_tableName = "requests_employees_mapping";



        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }


        public function insert($data){
            $this->db->insert($this->_tableName,$data);   
        }

	    public function insert_mapping($employee_id,$request_id){
            $query = $this->db->get_where("company_employee", array('id' => $employee_id));
            if($this->db->affected_rows() > 0){
                $employee_details = $query->row_array();                
                $query = $this->db->get_where("job_positions", array('id' => $employee_details['job_position']));
                if($this->db->affected_rows() > 0){
                    $job_pos_details = $query->row_array();
                    if($job_pos_details['under_employee_id'] != 0){
                        $query = $this->db->get_where("company_employee", array('id' => $job_pos_details['under_employee_id']));
                        if($this->db->affected_rows() > 0){
                            $employee_details_one = $query->row_array();

                            $this->db->insert($this->_tableName, array(
                                'request_id' => $request_id,
                                'employee_id' => $employee_details_one['id']
                            ));

                            $this->insert_mapping($employee_details_one['id'],$request_id);
                        }else{
                            return true;
                        }
                    }else{
                        return true;
                    }
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }

        public function remove_mapping($request_id = ""){
            $this->db->where('request_id',$request_id);
            if($this->db->delete($this->_tableName))
            {
                return true;
            }else{
                return false;
            }
        }
	}

?>