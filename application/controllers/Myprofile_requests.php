<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myprofile_requests extends MY_Controller {

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
        $this->load->model('requests_threads_model');
        $this->load->model('requests_overtime_model');
        $this->load->model('requests_employee_mapping_model');
        $this->load->model('requests_leave_model');
        $this->load->model('requests_business_trip_model');
        $this->load->model('requests_eccr_model');        
        $this->load->model('requests_general_model');        
        $this->load->model('request_comment_model');     
        $this->load->model('common_documents_model');     
        $this->load->model('notifications_model');
        $this->load->model('user_model'); //fmc users

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
		
		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_requests',$data);
		$this->load->view('inc/footer');		
	}
	
	public function request_details($id)
	{
		$data['title'] = "Request Details";

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Request Details
		$request_details = $this->requests_model->get_details($id);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'Request details not found.');
			redirect('/dashboard');
		}
		
		if($request_details['request_type'] == 'overtime'){
			//Get Overtime Request Details
			$overtime_details = $this->requests_overtime_model->get_details_by_request_id($id);
			if(!$overtime_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['overtime_request_details'] = $overtime_details;
		}

		//Get Request Comments
		$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
		$request_comments = array();
		foreach ($request_comments_tmp as $value) {
			$documents = $this->common_documents_model->get_all('request_comment',$value['id']);
			if(empty($documents)){
				$documents = array();
			}
			
			$comment_by = "";
			if($value['employee_id'] != 0){
				$employee_details = $this->employees_model->get_details($value['employee_id']);				
				$comment_by = $employee_details['fullname_english'];
			}
			if($value['fmc_user_id'] != 0){
				$comment_by = "FMC";
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}
		$request_details['request_comments'] = $request_comments;

		if($request_details['request_type'] == 'leave'){
			//Get Leave Request Details
			$leave_details = $this->requests_leave_model->get_details_by_request_id($id);
			if(!$leave_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['leave_request_details'] = $leave_details;			
		}

		if($request_details['request_type'] == 'employee_education'){
			//Get Education Request Details
			$education_details = $this->employees_model->get_education_request_details_by_request_id($id);
			if(!$education_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['education_request_details'] = $education_details;			
		}

		if($request_details['request_type'] == 'business_trip'){
			//Get Business-Trip Request Details
			$business_trip_details = $this->requests_business_trip_model->get_details_by_request_id($id);
			if(!$business_trip_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['business_trip_request_details'] = $business_trip_details;			
		}

		if($request_details['request_type'] == 'eccr'){
			//Get ECCR Request Details
			$eccr_details = $this->requests_eccr_model->get_details_by_request_id($id);
			if(!$eccr_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['eccr_request_details'] = $eccr_details;			
		}

		if($request_details['request_type'] == 'general'){
			//Get General Request Details
			$general_details = $this->requests_general_model->get_details_by_request_id($id);
			if(!$general_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['general_request_details'] = $general_details;			
		}

		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$data['request_details'] = $request_details;
		$data['request_threads'] = $request_threads;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_request_details',$data);
		$this->load->view('inc/footer');

	}

	public function approve_decline()
	{
		if($this->input->post()){
			$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
			$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];

			$request_id = base64_decode($this->input->post('request_id')); 

			//Get Request Details
			$request_details = $this->requests_model->get_details($request_id);
			if(!$request_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			

			//Get Login Employee Details
			$employee_details = $this->employees_model->get_details($employee_id);
			if(!$employee_details){
				$this->session->set_flashdata('flashError', 'Employees details not found.');
				redirect('/dashboard');
			}

			//Get Client Details
			$compnay_details = $this->clients_model->get_details($company_id);
			if(!$compnay_details){
				$this->session->set_flashdata('flashError', 'Compnay Details not found.');
				redirect('/dashboard');
			}

			if($this->input->post('approve')){
				$status = "approved";
				$log_text = "Approved by ".$employee_details['fullname_english'];
			}else{
				$status = "declined";
				$log_text = "Declined by ".$employee_details['fullname_english'];
			}	

			/*Create Request Thread*/
			$insert_request_thread_data = array(
				'request_id' => $request_id,
				'note' => $this->input->post('description'),
				'log_text' => $log_text,
				'company_user_id' => $employee_id,
				'status' => $status,
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->requests_threads_model->insert($insert_request_thread_data);
			/*End Create Request Thread*/

			//If Request In Re-Approval From FMC
			if($request_details['is_re_approval_from_fmc'] == 'yes'){
				/*Update Request*/
				$request_update_data = array(
					'id' => $request_id,
					'status' => ($status == 'declined') ? $status : 'in_approval',
					'is_re_approval_from_fmc' => 'no',
					'modified_at' => date('Y-m-d H:i:s')
				);				
				$request_update_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
				$request_update_data['assigned_company_user_id'] = 0;
				$this->requests_model->update($request_update_data);
				/*End Update Request*/
			}else{ 
				$assigned_company_user_id = "";
				$assigned_fmc_user_id = "";
				/*Update Request Employee Mapping*/
				if($status == 'approved'){
					//Get Parent Employees
					$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
					if($parent_employee_details){
						$assigned_company_user_id = $parent_employee_details['id'];
					}else{
						$assigned_fmc_user_id = $compnay_details['primary_hr'];
					}
				}
				/*End Update Request Employee Mapping*/
				
				/*Update Request*/
				$request_update_data = array(
					'id' => $request_id,
					'status' => ($status == 'declined') ? $status : 'in_approval',
					'modified_at' => date('Y-m-d H:i:s')
				);
				if(!empty($assigned_company_user_id)){
					$request_update_data['assigned_company_user_id'] = $assigned_company_user_id;
				}
				if(!empty($assigned_fmc_user_id)){
					$request_update_data['assigned_fmc_user_id'] = $assigned_fmc_user_id;
					$request_update_data['assigned_company_user_id'] = 0;
				}

				$this->requests_model->update($request_update_data);
				/*End Update Request*/

				//Update Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->remove_mapping($request_id);
				if($status == 'approved'){
					$this->requests_employee_mapping_model->insert_mapping($employee_id,$request_id);
				}
			}
			
			//Send Notification & Email
			//Load Email Helper
			$this->load->helper('email');
			$request_type = "";
			$notification_type = "";
			$notification_type_update = "";
			$record_id = 0;
			if($request_details['request_type'] == 'leave'){
				$request_type = "Leave";
				$notification_type = "leave_request";
				$notification_type_update = "leave_request_update";
				$leave_details = $this->requests_leave_model->get_details_by_request_id($request_id);
				$record_id = $leave_details['id'];
			}
			if($request_details['request_type'] == 'overtime'){
				$request_type = "Overtime";
				$notification_type = "overtime_request";
				$notification_type_update = "overtime_request_update";
				$overtime_details = $this->requests_overtime_model->get_details_by_request_id($request_id);
				$record_id = $overtime_details['id'];
			}
			if($request_details['request_type'] == 'business_trip'){
				$request_type = "Business-Trip";
				$notification_type = "business_trip";
				$notification_type_update = "business_trip_update";
				$business_trip_details = $this->requests_business_trip_model->get_details_by_request_id($request_id);
				$record_id = $business_trip_details['id'];
			}
			if($request_details['request_type'] == 'eccr'){
				$request_type = "ECCR";
				$notification_type = "eccr";
				$notification_type_update = "eccr_update";
				$eccr_details = $this->requests_eccr_model->get_details_by_request_id($request_id);
				$record_id = $eccr_details['id'];
			}
			if($request_details['request_type'] == 'general'){
				$request_type = "General";
				$notification_type = "general";
				$notification_type_update = "general_update";
				$general_details = $this->requests_general_model->get_details_by_request_id($id);
				$record_id = $general_details['id'];
			}
			if($request_details['request_type'] == 'employee_education'){
				$request_type = "Education";
				$notification_type = "employee_education";
				$notification_type_update = "employee_education_update";
				$education_details = $this->employees_model->get_education_request_details_by_request_id($request_id);
				$record_id = $education_details[0]['id'];
			}

			//Get Request Employee Details
			$request_employee_details = $this->employees_model->get_details($request_details['employee_id']);
						
			if($status == 'approved'){
				$title_en = "New employee ".$request_type." request by ".$request_employee_details['fullname_english'];
				$title_ar = "New employee ".$request_type." request by ".$request_employee_details['fullname_english'];
				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $company_id,					
					'type' => $notification_type,
					'request_id' => $request_details['id'],
					'record_id' => $record_id,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);

				//Get Parent Employees
				$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
				if($parent_employee_details){
					$notification_data['company_employee_id'] = $parent_employee_details['id'];
					//Insert Notification
					$this->notifications_model->insert($notification_data);

					if($parent_employee_details && $parent_employee_details['email'] != ""){
						$email_data = array();
						$email_data['fullname_english'] = $parent_employee_details['fullname_english'];
						$email_data['fullname_arabic'] = $parent_employee_details['fullname_arabic'];
						$email_data['request_type_ar'] = $request_type;
						$email_data['request_type_en'] = $request_type;
						$email_data['request_id'] = $request_details['id'];						

						$message = $this->load->view('email-templates/company-emp-gen-request', $email_data,  TRUE);

						$to_email = $parent_employee_details['email']; 
						$subject = "FMC -  ".$title_en;
						send_email($to_email,$subject,$message);
					}

				}else{
					$assigned_fmc_user_id = $compnay_details['primary_hr'];
					$notification_data['fmc_user_id'] = $assigned_fmc_user_id;
					//Insert Notification
					$this->notifications_model->insert($notification_data);

					//Get FMC User Details
					$request_created_user_detail = $this->user_model->get_details($assigned_fmc_user_id);
					if($request_created_user_detail && $request_created_user_detail['email'] != ""){
						$email_data = array();
						$email_data['user_fullname'] = $request_created_user_detail['first_name']." ".$request_created_user_detail['last_name']." ".$request_created_user_detail['surname'];
						$email_data['request_type_ar'] = "Overtime";
						$email_data['request_type_en'] = "Overtime";
						$email_data['request_id'] = $request_details['id'];
						$message = $this->load->view('email-templates/fmc-gen-request', $email_data,  TRUE);
						
						$to_email = $request_created_user_detail['email']; 
						$subject = "FMC -  ".$title_en;
						send_email($to_email,$subject,$message);
					}
				}
			}else{
				$title_en = "Your ".$request_type." request is ".$status;
				$title_ar = "Your ".$request_type." request is ".$status;

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $company_id,					
					'company_employee_id' => $request_employee_details['id'],
					'type' => $notification_type_update,
					'request_id' => $request_details['id'],
					'record_id' => $record_id,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->notifications_model->insert($notification_data);

				if($request_employee_details && $request_employee_details['email'] != ""){
					
					$email_data = array();
					$email_data['fullname_english'] = $request_employee_details['fullname_english'];
					$email_data['fullname_arabic'] = $request_employee_details['fullname_arabic'];
					$email_data['request_description_ar'] = $title_ar;
					$email_data['request_description_en'] = $title_en;

					$message = $this->load->view('email-templates/company-emp-request-update', $email_data,  TRUE);

					$to_email = $request_employee_details['email']; 
					$subject = "FMC - ".$title_en;
					send_email($to_email,$subject,$message);
				}
			}								
			//End Send Notification & Email
			
			$this->session->set_flashdata('flashSuccess', 'Request has been update successfully.');
			redirect('/dashboard');
			exit();
		}else{
			redirect('/dashboard');
		}
	}
	

	public function overtime_requests()
	{
		$data['title'] = "Overtime Requests";

		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$data['overtime_requests'] = $this->requests_overtime_model->get_all($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_overtime_requests',$data);
		$this->load->view('inc/footer');
	}

	public function create_overtime_request()
	{
		$data['title'] = "Overtime Requests";
				
		$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		
		$employee_details = $this->employees_model->get_details($employee_id);
		if(!$employee_details){
			$this->session->set_flashdata('flashError', 'Employee details not found.');
			redirect('/overtime-requests/create');
		}
		
		if($this->input->post()){			
			//Get Client Details
			$compnay_details = $this->clients_model->get_details($company_id);
			if(!$compnay_details){
				$this->session->set_flashdata('flashError', 'Compnay Details not found.');
				redirect('/overtime-requests/create');
			}
			
			$date = ($this->input->post('date') != "") ? $this->input->post('date') : '00/00/0000';
			$date = explode("/", $date);
			$date = $date[2]."-".$date[1]."-".$date[0];

			$document_file = "";

			if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

				$file_name = $_FILES['document_file']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if( ! $this->upload->do_upload('document_file'))
	            {
	                if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
	                	$this->session->set_flashdata('flashdata',$dataArray);
	                	redirect('/overtime-requests');
	                }
	            }else{
	            	$document_file = $upload_file_name;
	            }
			}
			
			
			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $employee_id,
				'request_type' => 'overtime',
				'created_by_company' => $employee_id,
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);

			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
			$is_parent_user = 'no';
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
				$is_parent_user = 'yes';
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID
						
			if($is_request_inserted){
				/*Insert Overtime Request Data*/
				$insert_data = array(
					'request_id' => $is_request_inserted,
					'company_id' => $company_id,
					'employee_id' => $employee_id,
					'date' => $date,
					'from_time' => $this->input->post('from_time'),
					'to_time' => $this->input->post('to_time'),
					'description' => $this->input->post('description'),
					'document_file' => $document_file,
					'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
				);				
				$record_id = $this->requests_overtime_model->insert($insert_data);
				/*End Insert Overtime Request Data*/

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $employee_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($employee_id,$is_request_inserted);
				
				//Send Nitifcation & Email
				//Load Email Helper
				$this->load->helper('email');
				$title_en = "New overtime request by ".$employee_details['fullname_english'];
				$title_ar = "New overtime request by ".$employee_details['fullname_english'];

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $company_id,					
					'type' => 'overtime_request',
					'request_id' => $is_request_inserted,
					'record_id' => $record_id,
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

		        $this->session->set_flashdata('flashSuccess', 'Overtime has been inserted successfully.');
		    }else{
		    	$this->session->set_flashdata('flashError', 'Overtime has been insert failed.');
		    }

		    redirect('/overtime-requests');
		    exit();			
		}

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_overtime_requests_create',$data);
		$this->load->view('inc/footer');
	}

	public function overtime_request_details($id)
	{
		$data['title'] = "Overtime Request Details";

		$details = array();

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Overtime Request Details
		$details = $this->requests_overtime_model->get_details($id);
		if(!$details){
			$this->session->set_flashdata('flashError', 'Overtime request details not found.');
			redirect('/overtime-requests');
		}

		//Get Request Details
		$request_details = $this->requests_model->get_details($details['request_id']);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'Overtime request details not found.');
			redirect('/overtime-requests');
		}

		//Get Request Comments
		$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
		$request_comments = array();
		foreach ($request_comments_tmp as $value) {
			$documents = $this->common_documents_model->get_all('request_comment',$value['id']);			
			if(empty($documents)){
				$documents = array();
			}
			
			$comment_by = "";
			if($value['employee_id'] != 0){
				$employee_details = $this->employees_model->get_details($value['employee_id']);				
				$comment_by = $employee_details['fullname_english'];
			}
			if($value['fmc_user_id'] != 0){
				$comment_by = "FMC";
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}
		
		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$details['request_comments'] = $request_comments;
		$details['request_details'] = $request_details;
		$details['request_threads'] = $request_threads;

		$data['details'] = $details;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_overtime_requests_details',$data);
		$this->load->view('inc/footer');
	}
		

	public function leave_requests()
	{
		$data['title'] = "Leave Requests";
		
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		$data['leave_requests'] = $this->requests_leave_model->get_all($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_leave_requests',$data);
		$this->load->view('inc/footer');
	}

	public function create_leave_request()
	{
		$data['title'] = "Overtime Requests";
		
		$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
		

		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$employee_details = $this->employees_model->get_details($employee_id);
		if(!$employee_details){
			$this->session->set_flashdata('flashError', 'Employee details not found.');
			redirect('/overtime-requests/create');
		}

		if($this->input->post()){
			
			$compnay_details = $this->clients_model->get_details($company_id);
			if(!$compnay_details){
				$this->session->set_flashdata('flashError', 'Compny details not found.');
				redirect('/leave-requests');
				exit();
			}

			$from_date = ($this->input->post('from_date') != "") ? $this->input->post('from_date') : '00/00/0000';
			$from_date = explode("/", $from_date);
			$from_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];

			$to_date = ($this->input->post('to_date') != "") ? $this->input->post('to_date') : '00/00/0000';
			$to_date = explode("/", $to_date);
			$to_date = $to_date[2]."-".$to_date[1]."-".$to_date[0];

			
			$document_file = "";

			if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

				$file_name = $_FILES['document_file']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if( ! $this->upload->do_upload('document_file'))
	            {
	                if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
	                	$this->session->set_flashdata('flashdata',$dataArray);
	                	redirect('/leave-requests/create');
	                }
	            }else{
	            	$document_file = $upload_file_name;
	            }
			}


			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $employee_id,
				'request_type' => 'leave',
				'created_by_company' => $employee_id,
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);

			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
			$is_parent_user = "no";
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
				$is_parent_user = "yes";
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID
						
			if($is_request_inserted){
				
				/*Insert Leave Request Data*/
				$insert_data = array(
					'request_id' => $is_request_inserted,
					'company_id' => $company_id,
					'employee_id' => $employee_id,
					'from_date' => $from_date,
					'to_date' => $to_date,
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'leave_type_id' => $this->input->post('leave_type_id'),
					'is_entry_visa_required' => ($this->input->post('is_entry_visa_required')) ? 'yes' : 'no',
					'is_exit_visa_required' => ($this->input->post('is_exit_visa_required')) ? 'yes' : 'no',
					'is_travel_ticket_required' => ($this->input->post('is_travel_ticket_required')) ? 'yes' : 'no',
					'document_file' => $document_file,
					'created_by' => $employee_id,
					'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
				);

				$request_leave_id = $this->requests_leave_model->insert($insert_data);


				$leave_arr = array();
				if($request_leave_id){
					foreach($this->input->post('leave_date') as $key => $value){
						$leave_date = ($value != "") ? $value : '00/00/0000';
						$leave_date = explode("/", $leave_date);
						$leave_date = $leave_date[2]."-".$leave_date[1]."-".$leave_date[0];

						$leave_arr[] = array(
							'request_leave_id' => $request_leave_id,
							'employee_id' => $employee_id,
							'leave_date' => $leave_date,
							'leave_type' => $this->input->post('leave_type')[$key]
		 				);
					}

					$this->requests_leave_model->insert_leave_dates($leave_arr);
				}				
				/*End Insert Leave Request Data*/

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $employee_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($employee_id,$is_request_inserted);

				//Send Nitifcation & Email
				//Load Email Helper
				$this->load->helper('email');
				$title_en = "New leave request by ".$employee_details['fullname_english'];
				$title_ar = "New leave request by ".$employee_details['fullname_english'];

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $company_id,					
					'type' => 'leave_request',
					'request_id' => $is_request_inserted,
					'record_id' => $request_leave_id,
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
				
		        $this->session->set_flashdata('flashSuccess', 'Leave has been inserted successfully.');
		    }else{
		    	$this->session->set_flashdata('flashError', 'Leave has been insert failed.');
		    }
		    			
		    redirect('/leave-requests');
		    exit();			
		}

		//Employee Details
		$employee_details = $this->employees_model->get_details($employee_id);
		$leave_types = array();
		if($employee_details['leave_group'] != 0){
			$leave_types = $this->leave_types_model->get_leave_type_by_leave_group($employee_details['leave_group']);
		}
		$data['leave_types'] = $leave_types;

		//Check Workgroup Details
		if($employee_details['work_group'] == '0'){
			$this->session->set_flashdata('flashError','Workgroup not assigned.');
			redirect('/leave-requests');
		}

		$workweek_details = $this->workweek_model->get_details($employee_details['work_group']);

		if(empty($workweek_details)){
			$this->session->set_flashdata('flashError','Employee workgroup not found');
            redirect('/leave-requests');
		}
		//End Check Workgroup Details

		//Check Holiday Group Details
		if($employee_details['holiday_group'] == '0'){
			$this->session->set_flashdata('flashError','Holiday-group not assigned');
			redirect('/leave-requests');
		}

		$holidays = $this->holidays_model->get_holiday_by_holiday_group($employee_details['holiday_group']);

		if(empty($holidays)){
			//$this->session->set_flashdata('flashError','Holidays not found');
            //redirect('/leave-requests');
		}
		//End Check Holiday Group Details

		$data['employee_workweel_details'] = $workweek_details;
		$data['holidays'] = $holidays;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_leave_requests_create',$data);
		$this->load->view('inc/footer');
	}

	public function leave_request_details($id)
	{
		$data['title'] = "Leave Request Details";

		$details = array();

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Leave Request Details
		$details = $this->requests_leave_model->get_details($id);
		if(!$details){
			$this->session->set_flashdata('flashError', 'Leave request details not found.');
			redirect('/leave-requests');
		}
		//Get Request Details
		$request_details = $this->requests_model->get_details($details['request_id']);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'Leave request details not found.');
			redirect('/leave-requests');
		}

		//Get Request Comments
		$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
		$request_comments = array();
		foreach ($request_comments_tmp as $value) {
			$documents = $this->common_documents_model->get_all('request_comment',$value['id']);			
			if(empty($documents)){
				$documents = array();
			}
			
			$comment_by = "";
			if($value['employee_id'] != 0){
				$employee_details = $this->employees_model->get_details($value['employee_id']);				
				$comment_by = $employee_details['fullname_english'];
			}
			if($value['fmc_user_id'] != 0){
				$comment_by = "FMC";
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}

		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$details['request_comments'] = $request_comments;
		$details['request_details'] = $request_details;
		$details['request_threads'] = $request_threads;

		$data['details'] = $details;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_leave_requests_details',$data);
		$this->load->view('inc/footer');
	}

	public function business_trip_requests()
	{
		$data['title'] = "Leave Requests";
		
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$data['business_trip_requests'] = $this->requests_business_trip_model->get_all($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_business_trip_requests',$data);
		$this->load->view('inc/footer');
	}

	public function create_business_trip_requests()
	{
		$data['title'] = "Overtime Requests";
		
		$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		if($this->input->post()){			
			$from_date = ($this->input->post('from_date') != "") ? $this->input->post('from_date') : '00/00/0000';
			$from_date = explode("/", $from_date);
			$from_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];

			$to_date = ($this->input->post('to_date') != "") ? $this->input->post('to_date') : '00/00/0000';
			$to_date = explode("/", $to_date);
			$to_date = $to_date[2]."-".$to_date[1]."-".$to_date[0];


			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $employee_id,
				'request_type' => 'business_trip',
				'created_by_company' => $employee_id,
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);

			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID
						
			if($is_request_inserted){

				/*Insert Business-Trip Request Data*/
				$insert_data = array(
					'request_id' => $is_request_inserted,
					'company_id' => $company_id,
					'employee_id' => $employee_id,
					'from_date' => $from_date,
					'to_date' => $to_date,
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'project_name' => $this->input->post('project_name'),
					'trip_route' => $this->input->post('trip_route'),
					'destination' => $this->input->post('destination'),
					'is_exit_visa_required' => ($this->input->post('is_exit_visa_required')) ? 'yes' : 'no',
					'is_entry_visa_required' => ($this->input->post('is_entry_visa_required')) ? 'yes' : 'no',
					'is_on_hand_cash_required' => ($this->input->post('is_on_hand_cash_required')) ? 'yes' : 'no',
					'cash_amount' => ($this->input->post('cash_amount')) ? $this->input->post('cash_amount') : '0',
					'is_accommodation_required' => ($this->input->post('is_accommodation_required')) ? 'yes' : 'no',
					'is_travel_ticket_required' => ($this->input->post('is_travel_ticket_required')) ? 'yes' : 'no',
					'is_car_required' => ($this->input->post('is_car_required')) ? 'yes' : 'no',
					'created_by' => $employee_id,
					'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
				);
				$this->requests_business_trip_model->insert($insert_data);
				/*End Insert Business-Trip Request Data*/

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $employee_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($employee_id,$is_request_inserted);
				
		        $this->session->set_flashdata('flashSuccess', 'Bussiness Trip has been insrted successfully.'); 
			}else{
				$this->session->set_flashdata('flashError', 'Bussiness Trip has been insrted successfully.');
			}

		    redirect('/business-trip-requests');
		    exit();
		}

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_business_trip_requests_create',$data);
		$this->load->view('inc/footer');
	}

	public function business_trip_request_details($id)
	{
		$data['title'] = "Business-Trip Request Details";

		$details = array();

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Overtime Request Details
		$details = $this->requests_business_trip_model->get_details($id);
		if(!$details){
			$this->session->set_flashdata('flashError', 'Business-Trip request details not found.');
			redirect('/business-trip-requests');
		}

		//Get Request Details
		$request_details = $this->requests_model->get_details($details['request_id']);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'Business-Trip request details not found.');
			redirect('/business-trip-requests');
		}

		//Get Request Comments
		$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
		$request_comments = array();
		foreach ($request_comments_tmp as $value) {
			$documents = $this->common_documents_model->get_all('request_comment',$value['id']);			
			if(empty($documents)){
				$documents = array();
			}
			
			$comment_by = "";
			if($value['employee_id'] != 0){
				$employee_details = $this->employees_model->get_details($value['employee_id']);				
				$comment_by = $employee_details['fullname_english'];
			}
			if($value['fmc_user_id'] != 0){
				$comment_by = "FMC";
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}

		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$details['request_comments'] = $request_comments;
		$details['request_details'] = $request_details;
		$details['request_threads'] = $request_threads;

		$data['details'] = $details;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_business_trip_requests_details',$data);
		$this->load->view('inc/footer');
	}
	

	public function eccr_requests()
	{
		$data['title'] = "Leave Requests";
		
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$data['eccr_requests'] = $this->requests_eccr_model->get_all($employee_id);
		

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_eccr_requests',$data);
		$this->load->view('inc/footer');
	}

	public function create_eccr_request()
	{
		$data['title'] = "Overtime Requests";
		
		$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		if($this->input->post()){			
		
			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $employee_id,
				'request_type' => 'eccr',
				'created_by_company' => $employee_id,
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);

			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID
						
			if($is_request_inserted){

				/*Insert ECCR Request Data*/
				$insert_data = array(
					'request_id' => $is_request_inserted,
					'company_id' => $company_id,
					'employee_id' => $employee_id,
					'request_type' => $this->input->post('request_type'),
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'created_by' => $employee_id,
					'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
				);
				$this->requests_eccr_model->insert($insert_data);
				/*End Insert ECCR Request Data*/

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $employee_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($employee_id,$is_request_inserted);
				
		        $this->session->set_flashdata('flashSuccess', 'ECCR request has been insrted successfully.'); 
			}else{
				$this->session->set_flashdata('flashError', 'ECCR request has been insrted successfully.');
			}

		    redirect('/eccr-requests');
		    exit();
		}

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_eccr_requests_create',$data);
		$this->load->view('inc/footer');
	}
	
	public function eccr_request_details($id)
	{
		$data['title'] = "ECCR Request Details";

		$details = array();

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Overtime Request Details
		$details = $this->requests_eccr_model->get_details($id);
		if(!$details){
			$this->session->set_flashdata('flashError', 'ECCR request details not found.');
			redirect('/eccr-requests');
		}

		//Get Request Details
		$request_details = $this->requests_model->get_details($details['request_id']);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'ECCR request details not found.');
			redirect('/eccr-requests');
		}


		//Get Request Comments
		$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
		$request_comments = array();
		foreach ($request_comments_tmp as $value) {
			$documents = $this->common_documents_model->get_all('request_comment',$value['id']);			
			if(empty($documents)){
				$documents = array();
			}
			
			$comment_by = "";
			if($value['employee_id'] != 0){
				$employee_details = $this->employees_model->get_details($value['employee_id']);				
				$comment_by = $employee_details['fullname_english'];
			}
			if($value['fmc_user_id'] != 0){
				$comment_by = "FMC";
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}

		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$details['request_comments'] = $request_comments;
		$details['request_details'] = $request_details;
		$details['request_threads'] = $request_threads;

		$data['details'] = $details;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_eccr_requests_details',$data);
		$this->load->view('inc/footer');
	}

	public function general_requests()
	{
		$data['title'] = "Leave Requests";
			
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$data['general_requests'] = $this->requests_general_model->get_all($employee_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_general_requests',$data);
		$this->load->view('inc/footer');
	}

	public function create_general_request()
	{
		$data['title'] = "Overtime Requests";
		
		$company_id = $this->session->userdata['fmc_company_employee_data']['company_id'];
		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		if($this->input->post()){			
		
			$request_data = array(
				'company_id' => $company_id,
				'employee_id' => $employee_id,
				'request_type' => 'general',
				'created_by_company' => $employee_id,
				'created_at' => date('Y-m-d H:i:s'),
				'modified_at' => date('Y-m-d H:i:s')
			);

			//Get Parent Employees
			$parent_employee_details = $this->employees_model->get_parent_employee($employee_id);
			if($parent_employee_details){
				$request_data['assigned_company_user_id'] = $parent_employee_details['id'];
			}else{
				$request_data['assigned_fmc_user_id'] = $compnay_details['primary_hr'];
			}
			$is_request_inserted = $this->requests_model->insert($request_data);//Request Insderted & Return Inserted ID
						
			if($is_request_inserted){

				/*Insert ECCR Request Data*/
				$insert_data = array(
					'request_id' => $is_request_inserted,
					'company_id' => $company_id,
					'employee_id' => $employee_id,
					'request_type_id' => $this->input->post('request_type_id'),
					'title' => $this->input->post('title'),
					'description' => $this->input->post('description'),
					'created_by' => $employee_id,
					'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
				);
				$this->requests_general_model->insert($insert_data);
				/*End Insert ECCR Request Data*/

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created",
					'log_text' => "Request created",
					'company_user_id' => $employee_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				//Insert Employee Mapping For Visible request to up line employee
				$this->requests_employee_mapping_model->insert_mapping($employee_id,$is_request_inserted);
				
		        $this->session->set_flashdata('flashSuccess', 'ECCR request has been insrted successfully.'); 
			}else{
				$this->session->set_flashdata('flashError', 'ECCR request has been insrted successfully.');
			}

		    redirect('/general-requests');
		    exit();
		}


		$data['request_types'] = $this->request_type_model->get_all($company_id);

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_general_requests_create',$data);
		$this->load->view('inc/footer');
	}

	public function general_request_details($id)
	{
		$data['title'] = "General Request Details";

		$details = array();

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Overtime Request Details
		$details = $this->requests_general_model->get_details($id);
		if(!$details){
			$this->session->set_flashdata('flashError', 'General request details not found.');
			redirect('/general-requests');
		}

		//Get Request Details
		$request_details = $this->requests_model->get_details($details['request_id']);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'General request details not found.');
			redirect('/general-requests');
		}

		//Get Request Comments
		$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
		$request_comments = array();
		foreach ($request_comments_tmp as $value) {
			$documents = $this->common_documents_model->get_all('request_comment',$value['id']);			
			if(empty($documents)){
				$documents = array();
			}
			
			$comment_by = "";
			if($value['employee_id'] != 0){
				$employee_details = $this->employees_model->get_details($value['employee_id']);				
				$comment_by = $employee_details['fullname_english'];
			}
			if($value['fmc_user_id'] != 0){
				$comment_by = "FMC";
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}

		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$details['request_comments'] = $request_comments;
		$details['request_details'] = $request_details;
		$details['request_threads'] = $request_threads;

		$data['details'] = $details;

		$this->load->view('inc/header',$data);
		$this->load->view('employee_my_profile_general_requests_details',$data);
		$this->load->view('inc/footer');
	}


	public function create_request_comment(){

		$employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

		if($this->input->post()){
			$insert_data = array(
					'request_id' => $this->input->post('request_id'),
		            'description' => $this->input->post('description'),
		            'employee_id' => $employee_id,
		            'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
		    );

			$is_inserted = $this->request_comment_model->insert($insert_data);

		    if($is_inserted){

	        	if(isset($_FILES['documents'])){
					foreach ($_FILES['documents']['name'] as $key => $file) {

						$_FILES['document']['name'] = $_FILES['documents']['name'][$key];
	          			$_FILES['document']['type'] = $_FILES['documents']['type'][$key];
	          			$_FILES['document']['tmp_name'] = $_FILES['documents']['tmp_name'][$key];
	          			$_FILES['document']['error'] = $_FILES['documents']['error'][$key];
	          			$_FILES['document']['size'] = $_FILES['documents']['size'][$key];


	          			$file_name = $_FILES['document']['name'];
			            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
			            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
			            $upload_file_name = time()."_".$upload_file_name;

			            $config = array();
				        $config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg';
				        $config['upload_path'] = 'uploads/';
				        $config['file_name'] = $upload_file_name;

				        $this->upload->initialize($config);
			        	if( ! $this->upload->do_upload('document'))
			            {
			                if($this->upload->display_errors())
			                {
			                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
			                	$this->session->set_flashdata('flashdata',$dataArray);
			                }
			            }else{
			            	$upload_file = $upload_file_name;
			            	$document_data = array(
			            		'document_type' => 'request_comment',
			            		'document_file' => $upload_file_name,
			            		'record_id' => $is_inserted
			            	);
			            	$this->common_documents_model->insert($document_data);
			            }
					}
				}
	        	$this->session->set_flashdata('flashSuccess', 'Request-Comment Item has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Request-Comment has not been inserted successfully.');
	        }
		}
	}
			
}

