<?php
class MY_Controller extends CI_Controller {

	function __construct() {
        parent::__construct();
        
        $this->load->model('user_model');

        if(isset($this->session->userdata['fmc_user_data']) && $this->session->userdata['fmc_user_data']['is_login']){
            $this->session->userdata['fmc_user_data']['login_time'] = date('Y-m-d H:i:s');
            $this->check_fmc_login_id();
        }

        if(isset($this->session->userdata['fmc_company_employee_data']) && $this->session->userdata['fmc_company_employee_data']['is_login']){
            $this->session->userdata['fmc_company_employee_data']['login_time'] = date('Y-m-d H:i:s');
        }
        
    }
    
    public function check_fmc_login_id() {
        $login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
        $last_login_id = $this->session->userdata['fmc_user_data']['last_login_id'];
        $user_data = $this->user_model->get_details($login_user_id);
        if($user_data['last_login_id'] != $last_login_id){
            $this->session->unset_userdata('fmc_user_data');
            if(isset($this->session->userdata['fmc_client_login']) && $this->session->userdata['fmc_client_login']['is_client_login']){
                $this->session->unset_userdata('fmc_client_login');    
            }
            redirect('/');
        }
    }
    
}