<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myprofile extends MY_Controller {

	public function __construct() 
	{
        parent::__construct();  

        $this->load->model('employees_model');
    	$this->load->model('employee_documents_model');    	
    	$this->load->model('regions_model');
    	$this->load->model('cities_model');
    	$this->load->model('request_type_model');
    	$this->load->model('requests_model');
    	$this->load->model('leave_types_model');     	
    	$this->load->model('workweek_model');
        $this->load->model('holidays_model');
        $this->load->model('clients_model');
        $this->load->model('requests_leave_model');
        $this->load->model('common_documents_model');
        $this->load->model('requests_threads_model');
        $this->load->model('requests_employee_mapping_model');
        $this->load->model('notifications_model');

        $this->load->library('upload');

        if(!($this->session->userdata['fmc_company_employee_data']['is_login'] || $this->session->userdata['fmc_company_employee_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{		
		$data['title'] = "Basic Profile";
		
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		$data['details'] = $this->employees_model->get_details_with_join($employee_id);
		$data['employee_benefits'] = $this->employees_model->get_employee_benefits($employee_id); 
		$data['details']['medical_documents'] = $this->common_documents_model->get_all('employee_medical_documents',$employee_id); 

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile',$data);
		$this->load->view('inc/footer');		
	}

	public function emergency_contacts()
	{
		$data['title'] = "Emergency-Contacts";

		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		if($this->input->post()){
			$emergency_contacts = array();
			foreach($this->input->post('contact_name') as $key => $value){
				$emergency_contacts[] = array(
					'employee_id' => $employee_id,
						'contact_name' => $this->input->post('contact_name')[$key],
					'address' => $this->input->post('address')[$key],
					'relationship' => $this->input->post('relationship')[$key],
					'mobile' => $this->input->post('mobile')[$key]
				);	
			}	

			$this->employees_model->remove_emergency_contacts($employee_id);
			$this->employees_model->add_emergency_contacts($emergency_contacts);

			$this->session->set_flashdata('flashSuccess', 'Emergency-Contacts saved successfully.'); 
			redirect('/my-profile/emergency-contacts');
		}

		$data['emergency_contacts'] = $this->employees_model->get_emergenct_contacts($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_emergency_contacts',$data);
		$this->load->view('inc/footer');		
	}
	
	public function work_experience()
	{
		$data['title'] = "Work-Experience";
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		$data['work_experience_items'] = $this->employees_model->get_work_experience($employee_id);
		
		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_work_experience',$data);
		$this->load->view('inc/footer');		
	}

	public function add_work_experience(){
		$data['title'] = "Employee - Work Experience";

		if($this->input->post()){
			$id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
			$employee_details = $this->employees_model->get_details($id);
			$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
			$compnay_details = $this->clients_model->get_details($company_id);

			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $id,
				'request_type' => 'work_experience',
				'created_by_company' => $id,
				'status' => 'in_approval',
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);
			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($id);
			
			$is_parent_user = "no";
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
				$is_parent_user = "yes";
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID

			if($is_request_inserted){
				## Insert Work Experience Request
				$work_experience_items = array();
				foreach($this->input->post('position') as $key => $value){
					$from_date = "0000-00-00";
					if(!empty($this->input->post('from_date')[$key])){
						$from_date = explode("/", $this->input->post('from_date')[$key]);
						$from_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];
					}
					$to_date = "0000-00-00";
					if(!empty($this->input->post('to_date')[$key])){
						$to_date = explode("/", $this->input->post('to_date')[$key]);
						$to_date = $to_date[2]."-".$to_date[1]."-".$to_date[0];
					}

					$work_experience_items[] = array(
						'request_id' => $is_request_inserted,
						'employee_id' => $id,
						'position' => $this->input->post('position')[$key],
						'employer_name' => $this->input->post('employer_name')[$key],
						'job_task' => $this->input->post('job_task')[$key],
						'address' => $this->input->post('address')[$key],
						'total_salary' => $this->input->post('total_salary')[$key],
						'from_date' => $from_date,
						'to_date' => $to_date
					);
				}
			}

			$is_inserted = $this->employees_model->add_work_experience_request($work_experience_items);
			if($is_inserted){

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($id,$is_request_inserted);

				//Send Nitifcation & Email
				//Load Email Helper
				$this->load->helper('email');
				$title_en = "New work experience request by ".$employee_details['fullname_english'];
				$title_ar = "New work experience request by ".$employee_details['fullname_english'];

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $company_id,					
					'type' => 'work_experience',
					'request_id' => $is_request_inserted,
					'record_id' => $is_inserted,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);
				if($is_parent_user == 'yes'){
					$notification_data['company_employee_id'] = $parent_employee_details['id'];
					//Insert Notification
					$this->notifications_model->insert($notification_data);

					if($parent_employee_details && $parent_employee_details['email'] != ""){
						$email_data = array();
						$email_data['fullname_english'] = $parent_employee_details['fullname_english'];
						$email_data['fullname_arabic'] = $parent_employee_details['fullname_arabic'];
						$email_data['request_type_ar'] = "Overtime";
						$email_data['request_type_en'] = "Overtime";
						$email_data['request_id'] = $is_request_inserted;						

						$message = $this->load->view('email-templates/company-emp-gen-request', $email_data,  TRUE);

						$to_email = $parent_employee_details['email']; 
						$subject = "FMC -  ".$title_en;
						// send_email($to_email,$subject,$message);
					}					
				}else{
					$notification_data['fmc_user_id'] = $compnay_details['primary_hr'];
					//Insert Notification
					$this->notifications_model->insert($notification_data);

					//Get FMC User Details
					$request_created_user_detail = $this->user_model->get_details($compnay_details['primary_hr']);
					if($request_created_user_detail && $request_created_user_detail['email'] != ""){
						$email_data = array();
						$email_data['user_fullname'] = $request_created_user_detail['first_name']." ".$request_created_user_detail['last_name']." ".$request_created_user_detail['surname'];
						$email_data['request_type_ar'] = "Overtime";
						$email_data['request_type_en'] = "Overtime";
						$email_data['request_id'] = $is_request_inserted;
						$message = $this->load->view('email-templates/fmc-gen-request', $email_data,  TRUE);

						$to_email = $request_created_user_detail['email']; 
						$subject = "FMC -  ".$title_en;
						// send_email($to_email,$subject,$message);
					}
				}
				//End Send Nitifcation & Email	

				$this->session->set_flashdata('flashSuccess', 'Work-Experience has been added successfully.'); 
	        }else{
	        	$this->session->set_flashdata('flashError', 'Work-Experience has not been added successfully.');
	        }
	        redirect('/my-profile/work-experience');
	    }

		$this->load->view('inc/header',$data);
		$this->load->view('add_work_experience',$data);
		$this->load->view('inc/footer');
	}

	public function qualification()
	{
		$data['title'] = "Qualification";
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		$data['educations'] = $this->employees_model->get_educations($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_qualification',$data);
		$this->load->view('inc/footer');		
	}

	public function add_qualification()
	{
		$data['title'] = "Employee - Qualification";		
		
		if($this->input->post()){
			$id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
			$employee_details = $this->employees_model->get_details($id);
			$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
			$compnay_details = $this->clients_model->get_details($company_id);
			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $id,
				'request_type' => 'employee_education',
				'created_by_company' => $id,
				'status' => 'in_approval',
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);
			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($id);
			
			$is_parent_user = "no";
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
				$is_parent_user = "yes";
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID
			if($is_request_inserted){
				## Insert Education Request
				$educations = array();
				foreach($this->input->post('specialization') as $key => $value){
					$educations[] = array(
						'request_id' => $is_request_inserted,
						'employee_id' => $id,
						'specialization' => $this->input->post('specialization')[$key],
						'institute_name' => $this->input->post('institute_name')[$key],
						'from_year' => $this->input->post('from_year')[$key],
						'to_year' => $this->input->post('to_year')[$key]
					);	
				}
			}

			$is_inserted = $this->employees_model->add_educations_request($educations);
			
			if($is_inserted){

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($id,$is_request_inserted);

				//Send Nitifcation & Email
				//Load Email Helper
				$this->load->helper('email');
				$title_en = "New education request by ".$employee_details['fullname_english'];
				$title_ar = "New education request by ".$employee_details['fullname_english'];

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $company_id,					
					'type' => 'employee_education',
					'request_id' => $is_request_inserted,
					'record_id' => $is_inserted,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);
				if($is_parent_user == 'yes'){
					$notification_data['company_employee_id'] = $parent_employee_details['id'];
					//Insert Notification
					$this->notifications_model->insert($notification_data);

					if($parent_employee_details && $parent_employee_details['email'] != ""){
						$email_data = array();
						$email_data['fullname_english'] = $parent_employee_details['fullname_english'];
						$email_data['fullname_arabic'] = $parent_employee_details['fullname_arabic'];
						$email_data['request_type_ar'] = "Overtime";
						$email_data['request_type_en'] = "Overtime";
						$email_data['request_id'] = $is_request_inserted;						

						$message = $this->load->view('email-templates/company-emp-gen-request', $email_data,  TRUE);

						$to_email = $parent_employee_details['email']; 
						$subject = "FMC -  ".$title_en;
						send_email($to_email,$subject,$message);
					}					
				}else{
					$notification_data['fmc_user_id'] = $compnay_details['primary_hr'];
					//Insert Notification
					$this->notifications_model->insert($notification_data);

					//Get FMC User Details
					$request_created_user_detail = $this->user_model->get_details($compnay_details['primary_hr']);
					if($request_created_user_detail && $request_created_user_detail['email'] != ""){
						$email_data = array();
						$email_data['user_fullname'] = $request_created_user_detail['first_name']." ".$request_created_user_detail['last_name']." ".$request_created_user_detail['surname'];
						$email_data['request_type_ar'] = "Overtime";
						$email_data['request_type_en'] = "Overtime";
						$email_data['request_id'] = $is_request_inserted;
						$message = $this->load->view('email-templates/fmc-gen-request', $email_data,  TRUE);

						$to_email = $request_created_user_detail['email']; 
						$subject = "FMC -  ".$title_en;
						send_email($to_email,$subject,$message);
					}
				}
				//End Send Nitifcation & Email	

				$this->session->set_flashdata('flashSuccess', 'Education has been updated successfully.'); 
	        }else{
	        	$this->session->set_flashdata('flashError', 'Education has not been update successfully.');
	        }
	        redirect('/my-profile/qualification');
		}
		
	    $this->load->view('inc/header',$data);
		$this->load->view('add_employee_qualification',$data);
		$this->load->view('inc/footer');
	}	

	public function documents()
	{
		$data['title'] = "Personal Documents";
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		$data['documents'] = $this->employee_documents_model->get_all($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_documents',$data);
		$this->load->view('inc/footer');
	}

	public function leave_balance()
	{
		$data['title'] = "Leave Balance";

		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];

		$employee_details = $this->employees_model->get_details($employee_id);
		if(!$employee_details){
			$this->session->set_flashdata('flashError','Employee details not found.');
			redirect('/dashboard');
		}

		// Calulating totol days from joining
	    $diff = strtotime($employee_details['joining_date']) - strtotime(date('Y-m-d')); 
	    $total_working_days = abs(round($diff / 86400));

		$leave_types = array();
		if($employee_details['leave_group'] != 0){
			$leave_types_tmp = $this->leave_types_model->get_leave_type_by_leave_group($employee_details['leave_group']);

			foreach ($leave_types_tmp as $value) {
				$taken_leaves = $this->requests_leave_model->get_all_approved_leaves($employee_id,$value['leave_type_id']);

				$total_leave_days = 0;
				foreach ($taken_leaves as $leave) {
					if($leave['request_status'] == 'approved'){
						$diff = strtotime($leave['to_date']. ' +1 day') - strtotime($leave['from_date']); 
						$days = round($diff / 86400);
						$total_leave_days = $total_leave_days + $days;
		    		}
				}
				
				$per_day_balance = $value['leave_days'] / 365;
				$opening_balance = round($total_working_days * $per_day_balance);

				$closing_balance = $opening_balance - $total_leave_days;

				$leave_types[] = array(
					'leave_type_name' => $value['leave_type_name'],
					'leave_days' => $value['leave_days'],
					'opening_balance' => $opening_balance,
					'used_leaves' => $total_leave_days,
					'closing_balance' => $closing_balance
				);
			}
		}

		$data['leave_types'] = $leave_types;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_leave_balance',$data);
		$this->load->view('inc/footer');		
	}

	public function job_opening()
	{
		$data['title'] = "Leave Requests";
		
		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_job_opening',$data);
		$this->load->view('inc/footer');
	}

	public function annoucement()
	{
		$data['title'] = "Leave Requests";
		
		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_annoucement',$data);
		$this->load->view('inc/footer');
	}
	
	
	



}
