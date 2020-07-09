<?php
    
    class Email_notifications_model extends CI_Model
    {

    	public $_tableName = "email_notifications";

        function __construct() 
	    {
            parent::__construct();
            $this->load->database();
	    }
	    
        public function insert($data){
            $this->db->insert($this->_tableName, $data);

            if($this->db->affected_rows())
            {
                return true;
            }else{
                return false;
            }
        }

	}

?>