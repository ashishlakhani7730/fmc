<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leavemanagement extends MY_Controller {

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
		$this->load->model('employees_model');

		if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function get_all_leave_types_by_leavegroup_ajax(){
		
		$data_array = array();
		if($this->input->post()){
			$leave_group_id = $this->input->post('leave_group_id');
			$leave_types_groups = $this->leave_types_model->get_leave_type_by_leave_group($leave_group_id);
			foreach ($leave_types_groups as $value) {
				$data_array[] = array(
					'title' => $value['leave_type_name'],
					'value' => $value['leave_days']
				);
			}
		}

		$data['data'] = $data_array;
		$data['success'] = "true";
		echo json_encode($data);
	}

	public function get_all_holidays_by_holidaygroup_ajax(){
		
		$data_array = array();
		if($this->input->post()){
			$holiday_group_id = $this->input->post('holiday_group_id');
			
			$holidays = $this->holidays_model->get_holiday_by_holiday_group($holiday_group_id);			

			foreach ($holidays as $value) {
				$holiday_date = explode("-", $value['holiday_date']);
				$holiday_date = $holiday_date[2]."/".$holiday_date[1]."/".$holiday_date[0];
				if($holiday_date == '00/00/0000'){
					$holiday_date = "";
				}

				$data_array[] = array(
					'holiday_name' => $value['holiday_name'],
					'holiday_date' => $holiday_date
				);
			}

		}

		$data['data'] = $data_array;
		$data['success'] = "true";
		echo json_encode($data);
	}

	public function get_all_workdays_by_workgroup_ajax(){
		
		$data_array = array();
		$workdays = array();
		if($this->input->post()){
			$workgroup_id = $this->input->post('workgroup_id');			
			$workdays = $this->workweek_model->get_details($workgroup_id);
		}

		$data['data'] = $workdays;
		$data['success'] = "true";
		echo json_encode($data);
	}

	public function get_all_workdays_html_by_workgroup_ajax(){
		$html = "";
		if($this->input->post()){
			$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

			$employee_id = base64_decode($this->input->post('employee_id'));
			
			$update_data = array(
				'id' => $employee_id,
				'leave_group' => $this->input->post('leave_group'),
				'holiday_group' => $this->input->post('holiday_group'),
				'work_group' => $this->input->post('work_group'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			$is_updated = $this->employees_model->update($update_data);

			if($is_updated){
				$this->employees_model->remove_workshift($employee_id);
				$data['success'] = "true";
			}else{
				$data['success'] = "false";
			}
      
			
		}else{
			$data['success'] = "false";
		}
		echo json_encode($data);
	}
	
	

	public function index($tab="")
	{
		$data['title'] = "Leave Management";
		$data['current_tab'] = ($tab != "") ? $tab : 'leave-type';

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

	
	function get_leave_type(){
		if($this->input->post()){
			
			$leave_type_data = $this->leave_types_model->get_details($this->input->post('id'));

			if($leave_type_data){

				$leave_type_group_data = $this->leave_types_model->get_leave_type_groups_common($this->input->post('id'),"");
				
				$leave_type_data['leave_types_groups'] = $leave_type_group_data;

				$data['success'] = "true";				
				$data['data'] = $leave_type_data;				
			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}
	
	public function create_leave_type(){
		
		if($this->input->post()){

			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			$insert_data = array(
	            'name' => $this->input->post('name'),
	            'days' => $this->input->post('days'),
	            'leave_type_color' => $this->input->post('leave_type_color'),
	        	'company_id' => base64_decode($company_login_id),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
	        
	        $is_inserted = $this->leave_types_model->insert($insert_data);

	        if($is_inserted){	        	
	        	if($this->input->post('leave_type_group')){
	        		$leave_type_group_array = array();
		        	foreach ($this->input->post('leave_type_group') as $value) {
		        		$leave_type_group_array[] = array(
		        			'leave_type_id' => $is_inserted,
		        			'leave_type_group_id' => $value
		        		);
		        	}
	        		$this->leave_types_model->insert_leave_type_groups_common($leave_type_group_array);
	        	}
	        	$this->session->set_flashdata('flashSuccess', 'Leave Type has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Leave Type has not been inserted successfully.');
	        }	        
	        redirect('/leavemanagement');

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/leavemanagement');
	    }

	}

	public function update_leave_type(){
		
		if($this->input->post()){

			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			$update_data = array(
				'id' => $this->input->post('id'),
	            'name' => $this->input->post('name'),
	            'days' => $this->input->post('days'),
	            'leave_type_color' => $this->input->post('leave_type_color'),
	        	'company_id' => base64_decode($company_login_id),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->leave_types_model->update($update_data);

	        if($is_updated){
	        	if($this->input->post('leave_type_group')){
	        		$this->leave_types_model->delete_leave_type_groups_common($this->input->post('id'),"");

	        		$leave_type_group_array = array();
		        	foreach ($this->input->post('leave_type_group') as $value) {
		        		$leave_type_group_array[] = array(
		        			'leave_type_id' => $this->input->post('id'),
		        			'leave_type_group_id' => $value
		        		);
		        	}
	        		$this->leave_types_model->insert_leave_type_groups_common($leave_type_group_array);
	        	}

	        	$this->session->set_flashdata('flashSuccess', 'Leave Type has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Leave Type has not been updated successfully.');
	        }	        
	        redirect('/leavemanagement');

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/leavemanagement');
	    }

	}

	public function delete_leave_type($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->leave_types_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Leave Type has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Leave Type has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	

	

	
}
