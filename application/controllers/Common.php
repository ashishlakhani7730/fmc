<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();  
	}

	public function check_login_inactive_time(){
		$now = date('Y-m-d H:i:s');
		if(isset($this->session->userdata['fmc_user_data'])){
			$login_time = $this->session->userdata['fmc_user_data']['login_time'];						
		}
		if(isset($this->session->userdata['fmc_company_employee_data'])){
			$login_time = $this->session->userdata['fmc_company_employee_data']['login_time'];
		}

		$dateDiff = intval((strtotime($now)-strtotime($login_time))/60);
		$minutes = $dateDiff%60;
		if($minutes >= 20){
			redirect('dashboard/logout');
		}
	}
	
}
