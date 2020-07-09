<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holidays extends MY_Controller {

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

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
        	$this->session->set_flashdata('flashError', 'Please Login to Continue');
        	redirect('/');
        }
	}

	public function index($tab="")
	{
		$data['title'] = "Holidays Management";
		$data['current_tab'] = ($tab != "") ? $tab : 'holidays';

		//company login id
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

		$leave_types = $this->leave_types_model->get_all(base64_decode($company_login_id));
		if($leave_types){
			foreach ($leave_types as $key => $value) {
				$leave_types[$key]['leave_groups'] = $this->leave_types_model->get_leave_group_by_leave_type($value['id']);
			}
		}else{
			$leave_types = array();
		}
		$data['leave_types'] = $leave_types;


		$leave_types_groups = $this->leave_group_model->get_all(base64_decode($company_login_id));

		if($leave_types_groups){
			foreach ($leave_types_groups as $key => $value) {
				$leave_types_groups[$key]['leave_types'] = $this->leave_types_model->get_leave_type_by_leave_group($value['id']);
			}
		}else{
			$leave_types_groups = array();
		}
		$data['leave_types_groups'] = $leave_types_groups;

		$holidays = $this->holidays_model->get_all(base64_decode($company_login_id));
		if($holidays){
			foreach ($holidays as $key => $value) {
				$holidays[$key]['holiday_groups'] = $this->holidays_model->get_holiday_group_by_holiday($value['id']);
			}
		}else{
			$holidays = array();
		}
		$data['holidays'] = $holidays;

		$holiday_groups = $this->holidays_group_model->get_all(base64_decode($company_login_id));
		if($holiday_groups){
			foreach ($holiday_groups as $key => $value) {
				$holiday_groups[$key]['holidays'] = $this->holidays_model->get_holiday_by_holiday_group($value['id']);
			}
		}else{
			$holiday_groups = array();
		}
		$data['holiday_groups'] = $holiday_groups;

		$data['workweek'] = $this->workweek_model->get_all(base64_decode($company_login_id));
		$data['workshift'] = $this->workshift_model->get_all(base64_decode($company_login_id));
		
		$this->load->view('inc/header',$data);
		$this->load->view('leave_management',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{		
		if($this->input->post()){

			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			$date = explode("/", $this->input->post('date'));
			$date = $date[2]."-".$date[1]."-".$date[0];

			$insert_data = array(
	        	'company_id' => base64_decode($company_login_id),
	        	'name' => $this->input->post('name'),
	        	'date' => $date,
	        	'description' => $this->input->post('description'),
	       		'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
	        
	        if($this->holidays_model->checkDuplicate($date)){
	        	$this->session->set_flashdata('flashError', 'Holiday date already exist.');
	        	redirect('/holidays');
	        }

	        $is_inserted = $this->holidays_model->insert($insert_data);

	        if($is_inserted){
	        	if($this->input->post('holiday_groups')){
	        		$holiday_group_array = array();
		        	foreach ($this->input->post('holiday_groups') as $value) {
		        		$holiday_group_array[] = array(
		        			'holiday_id' => $is_inserted,
		        			'holiday_group_id' => $value
		        		);
		        	}
	        		$this->holidays_model->insert_holiday_groups_common($holiday_group_array);
	        	}

	        	$this->session->set_flashdata('flashSuccess', 'Holiday has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Holiday has not been inserted successfully.');
	        }	        
	        redirect('/holidays');

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/holidays');
	    }
	}

	public function update($id = "")
	{

		if($this->input->post()){
			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			$date = explode("/", $this->input->post('date'));
			$date = $date[2]."-".$date[1]."-".$date[0];

			$updateData = array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
	        	'date' => $date,
	        	'description' => $this->input->post('description'),
	       		'modified_at' => date('Y-m-d H:i:s')
	        );

	        if($this->holidays_model->checkDuplicate($date,$this->input->post('id'))){
	        	$this->session->set_flashdata('flashError', 'Holiday date already exist.');
	        	redirect('/holidays');
	        }

	        $is_updated = $this->holidays_model->update($updateData);

	        if($is_updated){

	        	if($this->input->post('holiday_groups')){
	        		$this->holidays_model->delete_holiday_groups_common($this->input->post('id'),"");
	        		$holiday_group_array = array();
		        	foreach ($this->input->post('holiday_groups') as $value) {
		        		$holiday_group_array[] = array(
		        			'holiday_id' => $this->input->post('id'),
		        			'holiday_group_id' => $value
		        		);
		        	}
	        		$this->holidays_model->insert_holiday_groups_common($holiday_group_array);
	        	}

	        	$this->session->set_flashdata('flashSuccess', 'Holiday has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Holiday has not been updated successfully.');
	        }
	        redirect('/holidays');
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/holidays');
	    }
	}

	function get(){
		if($this->input->post()){
			
			$department_data = $this->holidays_model->get_details($this->input->post('id'));

			if($department_data){

				$holiday_group_data = $this->holidays_model->get_holiday_groups_common($this->input->post('id'),"");

				if(!$holiday_group_data){
					$holiday_group_data = array();	
				}

				$data['success'] = "true";				
				$department_data_arr = array(
					'id' => $department_data['id'],
					'name' => $department_data['name'],
					'date' => date('d/m/y', strtotime($department_data['date'])),
					'description' => $department_data['description'],
					'holiday_groups' => $holiday_group_data
				);
				$data['data'] = $department_data_arr;				
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

        $deleted = $this->holidays_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Holiday has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Holiday has not been deleted successfully.'); 
            echo '0';exit;
        }
	}	
	
}
