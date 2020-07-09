<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fmc_leavegroup extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() 
	{
        parent::__construct();         	
        $this->load->model('leave_types_model');     	
		$this->load->model('leave_group_model');
		$this->load->model('holidays_model');
		$this->load->model('holidays_group_model');
		$this->load->model('workweek_model');
		$this->load->model('workshift_model');

        if(!($this->session->userdata['fmc_user_data']['is_login'] || $this->session->userdata['fmc_user_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index($tab="")
	{
		$data['title'] = "Leave Management";
		$data['current_tab'] = ($tab != "") ? $tab : 'leave-group';

		//company login id
		$company_login_id = 0;

		$leave_types = $this->leave_types_model->get_all($company_login_id);
		if($leave_types){
			foreach ($leave_types as $key => $value) {
				$leave_types[$key]['leave_groups'] = $this->leave_types_model->get_leave_group_by_leave_type($value['id']);
			}
		}else{
			$leave_types = array();
		}
		$data['leave_types'] = $leave_types;


		$leave_types_groups = $this->leave_group_model->get_all($company_login_id);

		if($leave_types_groups){
			foreach ($leave_types_groups as $key => $value) {
				$leave_types_groups[$key]['leave_types'] = $this->leave_types_model->get_leave_type_by_leave_group($value['id']);
			}
		}else{
			$leave_types_groups = array();
		}
		$data['leave_types_groups'] = $leave_types_groups;

		$holidays = $this->holidays_model->get_all($company_login_id);
		if($holidays){
			foreach ($holidays as $key => $value) {
				$holidays[$key]['holiday_groups'] = $this->holidays_model->get_holiday_group_by_holiday($value['id']);
			}
		}else{
			$holidays = array();
		}
		$data['holidays'] = $holidays;

		$holiday_groups = $this->holidays_group_model->get_all($company_login_id);
		if($holiday_groups){
			foreach ($holiday_groups as $key => $value) {
				$holiday_groups[$key]['holidays'] = $this->holidays_model->get_holiday_by_holiday_group($value['id']);
			}
		}else{
			$holiday_groups = array();
		}
		$data['holiday_groups'] = $holiday_groups;

		$data['workweek'] = $this->workweek_model->get_all($company_login_id);
		$data['workshift'] = $this->workshift_model->get_all($company_login_id);
		

		$this->load->view('inc/header',$data);
		$this->load->view('fmc_leave_management',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{		
		if($this->input->post()){

			//company login id
			$company_login_id = 0;

			$insert_data = array(
	        	'company_id' => $company_login_id,
	        	'name' => $this->input->post('name'),
	       		'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
	        
	        $is_inserted = $this->leave_group_model->insert($insert_data);

	        if($is_inserted){
	        	if($this->input->post('leave_types')){
	        		$leave_type_group_array = array();
		        	foreach ($this->input->post('leave_types') as $value) {
		        		$leave_type_group_array[] = array(
		        			'leave_type_id' => $value,
		        			'leave_type_group_id' => $is_inserted
		        		);
		        	}
	        		$this->leave_types_model->insert_leave_type_groups_common($leave_type_group_array);
	        	}

	        	$this->session->set_flashdata('flashSuccess', 'Leave Group has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Leave Group has not been inserted successfully.');
	        }	        
	        redirect('/fmc-leave-group');

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/fmc-leave-group');
	    }
	}

	public function update($id = "")
	{

		if($this->input->post()){
			//company login id
			$company_login_id = 0;

			$updateData = array(
				'id' => $this->input->post('id'),
				'company_id' => $company_login_id,
	            'name' => $this->input->post('name'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->leave_group_model->update($updateData);

	        if($is_updated){
	        	if($this->input->post('leave_types')){
	        		$this->leave_types_model->delete_leave_type_groups_common("",$this->input->post('id'));
	        		$leave_type_group_array = array();
		        	foreach ($this->input->post('leave_types') as $value) {
		        		$leave_type_group_array[] = array(
		        			'leave_type_id' => $value,
		        			'leave_type_group_id' => $this->input->post('id')
		        		);
		        	}
	        		$this->leave_types_model->insert_leave_type_groups_common($leave_type_group_array);
	        	}

	        	$this->session->set_flashdata('flashSuccess', 'Leave Group has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Leave Group has not been updated successfully.');
	        }
	        redirect('/fmc-leave-group');
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/fmc-leave-group');
	    }
	}

	function get(){
		if($this->input->post()){
			
			$department_data = $this->leave_group_model->get_details($this->input->post('id'));

			if($department_data){

				$leave_type_data = $this->leave_types_model->get_leave_type_groups_common("",$this->input->post('id'));

				if($leave_type_data){
					$department_data['leave_types'] = $leave_type_data;	
				}else{
					$department_data['leave_types'] = array();	
				}

				$data['success'] = "true";				
				$data['data'] = $department_data;				

			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->leave_group_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Leave Group has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Leave Group has not been deleted successfully.'); 
            echo '0';exit;
        }
	}	
	
}
