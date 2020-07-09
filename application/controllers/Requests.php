<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends MY_Controller {

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
        $this->load->model('employees_model');
        $this->load->model('requests_model');
        $this->load->model('leave_types_model');
        $this->load->model('request_type_model');
        $this->load->model('user_model'); //fmc users
        $this->load->model('workweek_model');
        $this->load->model('holidays_model');
        $this->load->model('requests_threads_model');
        $this->load->model('requests_overtime_model');
        $this->load->model('requests_employee_mapping_model');
        $this->load->model('requests_leave_model');
        $this->load->model('requests_business_trip_model');
        $this->load->model('requests_eccr_model');
        $this->load->model('requests_general_model');
        $this->load->model('request_comment_model');     
        $this->load->model('common_documents_model');     
        $this->load->model('salary_components_model');
        $this->load->model('workshift_model');
        $this->load->model('clients_model');
        $this->load->model('clients_properties_model');
        $this->load->model('notifications_model');
        $this->load->model('company_payroll_model');
        

        $is_login = "false";
		if($this->session->userdata['fmc_user_data'] && $this->session->userdata['fmc_user_data']['is_login']){
			$is_login = "true";
		}else if($this->session->userdata['fmc_client_login'] && $this->session->userdata['fmc_client_login']['is_client_login']){
			$is_login = "true";
		}

        if($is_login == "false")
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
            exit();
        }
	}

	public function index()
	{
		$data['title'] = "Manage Requests";
		
		$primary_requests = array();
		$other_requests = array();
		$closed_requests = array();
		$declined_requests = array();

		//FMC User Login
		if($this->session->userdata('fmc_user_data') && $this->session->userdata['fmc_user_data']['is_login']){

			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
			
			$primary_requests = $this->requests_model->get_fmc_primary_requests($fmc_login_user_id);
			
			$other_requests = $this->requests_model->get_fmc_other_requests($fmc_login_user_id);
			$closed_requests = $this->requests_model->get_fmc_closed_requests();
			$declined_requests = $this->requests_model->get_fmc_declined_requests();
		}
		
		$data['primary_requests'] = $primary_requests;
		$data['other_requests'] = $other_requests;
		$data['closed_requests'] = $closed_requests;
		$data['declined_requests'] = $declined_requests;

		$this->load->view('inc/header',$data);
		$this->load->view('requests',$data);
		$this->load->view('inc/footer');
	}

	public function overtime($employee_id = "")
	{
		$data['title'] = "Request Overtime";

		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

		if($this->input->post()){			
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
	                	redirect('/requests/overtime/'.base64_encode($this->input->post('employee_id')));
	                }
	            }else{
	            	$document_file = $upload_file_name;
	            }
			}

			$insert_data = array(
				'company_id' => $client_login_id,
				'employee_id' => $this->input->post('employee_id'),
				'date' => $date,
				'from_time' => $this->input->post('from_time'),
				'to_time' => $this->input->post('to_time'),
				'description' => $this->input->post('description'),
				'document_file' => $document_file,
				'created_by' => $fmc_login_user_id,
				'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
			);

			$is_inserted = $this->requests_model->insert_overtime($insert_data);
			
			if($is_inserted){

				$request_data = array(
					'record_id' => $is_inserted,
					'request_type' => 'overtime',
					'assigned_fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'created_by_fmc' => $fmc_login_user_id,
					'status' => 'open',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);

				$this->requests_model->insert($request_data);

		        $this->session->set_flashdata('flashSuccess', 'Overtime has been inserted successfully.');
		    }else{
		        $this->session->set_flashdata('flashError', 'Overtime has been insert failed.');
		    }

		    redirect('/employees/view/'.base64_encode($this->input->post('employee_id')));
		    exit();			
		}

		$data['employee_id'] = base64_decode($employee_id);
		$data['employees'] = $this->employees_model->get_all($client_login_id);
		$data['fmc_users'] = $this->user_model->get_all(); //get all fmc users


		$this->load->view('inc/header',$data);
		$this->load->view('request_overtime',$data);
		$this->load->view('inc/footer');	
	}

	public function leave($employee_id = "")
	{
		$data['title'] = "Request Leave";
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

		if($this->input->post()){
			
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
	                	redirect('/requests/leave/'.base64_encode($this->input->post('employee_id')));
	                }
	            }else{
	            	$document_file = $upload_file_name;
	            }
			}

			$insert_data = array(
				'company_id' => $client_login_id,
				'employee_id' => $this->input->post('employee_id'),
				'from_date' => $from_date,
				'to_date' => $to_date,
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'leave_type_id' => $this->input->post('leave_type_id'),
				'is_entry_visa_required' => ($this->input->post('is_entry_visa_required')) ? 'yes' : 'no',
				'is_exit_visa_required' => ($this->input->post('is_exit_visa_required')) ? 'yes' : 'no',
				'is_travel_ticket_required' => ($this->input->post('is_travel_ticket_required')) ? 'yes' : 'no',
				'document_file' => $document_file,
				'created_by' => $fmc_login_user_id,
				'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
			);

			$is_inserted = $this->requests_model->insert_leave($insert_data);
			
			if($is_inserted){
				$leave_arr = array();
				foreach($this->input->post('leave_date') as $key => $value){
					$leave_date = ($value != "") ? $value : '00/00/0000';
					$leave_date = explode("/", $leave_date);
					$leave_date = $leave_date[2]."-".$leave_date[1]."-".$leave_date[0];

					$leave_arr[] = array(
						'request_leave_id' => $is_inserted,
						'employee_id' => $this->input->post('employee_id'),
						'leave_date' => $leave_date,
						'leave_type' => $this->input->post('leave_type')[$key]
	 				);
				}

				$this->requests_model->insert_leave_dates($leave_arr);


				$request_data = array(
					'company_id' => $client_login_id,
					'employee_id' => $this->input->post('employee_id'),
					'record_id' => $is_inserted,
					'request_type' => 'leave',
					'assigned_fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'created_by_fmc' => $fmc_login_user_id,
					'status' => 'open',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);

				$this->requests_model->insert($request_data);

		        $this->session->set_flashdata('flashSuccess', 'Leave-Request has been inserted successfully.');
		    }else{
		        $this->session->set_flashdata('flashError', 'Leave-Request has been insert failed.');
		    }

		    redirect('/employees/view/'.base64_encode($this->input->post('employee_id')));
		    exit();			
		}		

		//Employee Details
		$employee_details = $this->employees_model->get_details(base64_decode($employee_id));

		if(empty($employee_details)){
			$this->session->set_flashdata('flashError','Employee not found');
            redirect('/employees');
		}

		//Check Workgroup Details
		if($employee_details['work_group'] == '0'){
			$this->session->set_flashdata('flashError','Employee workgroup not selected');
			redirect('/requests/leave/'.base64_encode($this->input->post('employee_id')));
		}

		$workweek_details = $this->workweek_model->get_details($employee_details['work_group']);

		if(empty($workweek_details)){
			$this->session->set_flashdata('flashError','Employee workgroup not found');
            redirect('/requests/leave/'.base64_encode($this->input->post('employee_id')));
		}
		//End Check Workgroup Details
		
		//Check Holiday Group Details
		if($employee_details['holiday_group'] == '0'){
			$this->session->set_flashdata('flashError','Employee holiday-group not selected');
			redirect('/requests/leave/'.base64_encode($this->input->post('employee_id')));
		}

		$holidays = $this->holidays_model->get_holiday_by_holiday_group($employee_details['holiday_group']);

		if(empty($holidays)){
			$this->session->set_flashdata('flashError','Employee workgroup not found');
            redirect('/requests/leave/'.base64_encode($this->input->post('employee_id')));
		}
		//End Check Holiday Group Details

		$data['employee_id'] = base64_decode($employee_id);
		$data['employees'] = $this->employees_model->get_all($client_login_id);
		$data['employee_workweel_details'] = $workweek_details;
		$data['holidays'] = $holidays;
		

		$data['leave_types'] = $this->leave_types_model->get_all(base64_decode($client_login_id));
		$data['fmc_users'] = $this->user_model->get_all(); //get all fmc users


		$this->load->view('inc/header',$data);
		$this->load->view('request_leave',$data);
		$this->load->view('inc/footer');	
	}

	public function delete($id = "", $status = ""){
		
	}

	public function eccr($employee_id = "")
	{

		$data['title'] = "Request Employee Contract & Change Role";

		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

		if($this->input->post()){
			
			$insert_data = array(
				'company_id' => $client_login_id,
				'employee_id' => $this->input->post('employee_id'),
				'request_type' => $this->input->post('request_type'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'created_by' => $fmc_login_user_id,
				'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
			);

			$is_inserted = $this->requests_model->insert_eccr($insert_data);

			if($is_inserted){

				$request_data = array(
					'record_id' => $is_inserted,
					'request_type' => 'eccr',
					'assigned_fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'created_by_fmc' => $fmc_login_user_id,
					'status' => 'open',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);

				$this->requests_model->insert($request_data);

		        $this->session->set_flashdata('flashSuccess', 'ECCR request has been inserted successfully.'); 
		    }else{
		        $this->session->set_flashdata('flashError', 'ECCR request has been inserted successfully.');
		            
		    }

		    redirect('/employees/view/'.base64_encode($this->input->post('employee_id')));
		    exit();
		}

		$data['employee_id'] = base64_decode($employee_id);
		$data['employees'] = $this->employees_model->get_all($client_login_id);
		$data['fmc_users'] = $this->user_model->get_all(); //get all fmc users

		$this->load->view('inc/header',$data);
		$this->load->view('request_eccr',$data);
		$this->load->view('inc/footer');	
	}	

	public function bussiness_trip($employee_id = "")
	{	
		$data['title'] = "Request Bissuness Trip";

		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

		if($this->input->post()){
			
			$from_date = ($this->input->post('from_date') != "") ? $this->input->post('from_date') : '00/00/0000';
			$from_date = explode("/", $from_date);
			$from_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];

			$to_date = ($this->input->post('to_date') != "") ? $this->input->post('to_date') : '00/00/0000';
			$to_date = explode("/", $to_date);
			$to_date = $to_date[2]."-".$to_date[1]."-".$to_date[0];

			$insert_data = array(
				'company_id' => $client_login_id,
				'employee_id' => $this->input->post('employee_id'),
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
				'created_by' => $fmc_login_user_id,
				'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
			);


			$is_inserted = $this->requests_model->insert_bussiness_trip($insert_data);

			if($is_inserted){

				$request_data = array(
					'record_id' => $is_inserted,
					'request_type' => 'business_trip',
					'assigned_fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'created_by_fmc' => $fmc_login_user_id,
					'status' => 'open',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);

				$this->requests_model->insert($request_data);

		        $this->session->set_flashdata('flashSuccess', 'Bussiness Trip has been insrted successfully.'); 
		    }else{
		        $this->session->set_flashdata('flashError', 'Bussiness Trip has been insrted successfully.');
		            
		    }

		    redirect('/employees/view/'.base64_encode($this->input->post('employee_id')));
		    exit();
		}

		$data['employee_id'] = base64_decode($employee_id);
		$data['employees'] = $this->employees_model->get_all($client_login_id);
		$data['fmc_users'] = $this->user_model->get_all(); //get all fmc users
		

		$this->load->view('inc/header',$data);
		$this->load->view('request_bussiness_trip',$data);
		$this->load->view('inc/footer');	
	}

	public function general($employee_id = "")
	{
		$data['title'] = "Request General";
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

		if($this->input->post()){
			$insert_data = array(
				'company_id' => $client_login_id,
				'employee_id' => $this->input->post('employee_id'),
				'request_type_id' => $this->input->post('request_type_id'),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'created_by' => $fmc_login_user_id,
				'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
			);

			$is_inserted = $this->requests_model->insert_general($insert_data);

			if($is_inserted){

				$request_data = array(
					'record_id' => $is_inserted,
					'request_type' => 'general',
					'assigned_fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'created_by_fmc' => $fmc_login_user_id,
					'status' => 'open',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);

				$this->requests_model->insert($request_data);
				
		        $this->session->set_flashdata('flashSuccess', 'General request has been inserted successfully.'); 
		    }else{
		        $this->session->set_flashdata('flashError', 'General request has been inserted successfully.');
		    }

		    redirect('/employees/view/'.base64_encode($this->input->post('employee_id')));
		    exit();
		}

		$data['employee_id'] = base64_decode($employee_id);
		$data['employees'] = $this->employees_model->get_all($client_login_id);
		$data['reuests_types'] = $this->request_type_model->get_all($client_login_id);
		$data['fmc_users'] = $this->user_model->get_all(); //get all fmc users

		$this->load->view('inc/header',$data);
		$this->load->view('request_general',$data);
		$this->load->view('inc/footer');	
	}
	
	public function fmc_request_details($id = "")
	{
		$data['title'] = "Request Approve/Decline";

		//Decode encrypeted id
		$id = base64_decode($id);

		//Get Request Details
		$request_details = $this->requests_model->get_details($id);
		if(!$request_details){
			$this->session->set_flashdata('flashError', 'Request details not found.');
			redirect('/dashboard');
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
				$fmc_user_details = $this->user_model->get_details($value['fmc_user_id']);				
				$comment_by = $fmc_user_details['first_name']." ".$fmc_user_details['last_name']." ".$fmc_user_details['surname'];
			}
			$request_comments[] = array(
				'comment_by' => $comment_by,
				'documents' => $documents,
				'description' => $value['description'],
				'created_at' => $value['created_at']
			);
		}
		
		$request_details['request_comments'] = $request_comments;
		
		if($request_details['request_type'] == 'overtime'){
			//Get Overtime Request Details
			$overtime_details = $this->requests_overtime_model->get_details_by_request_id($id);
			if(!$overtime_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['overtime_request_details'] = $overtime_details;
		}

		if($request_details['request_type'] == 'leave'){
			//Get Leave Request Details
			$leave_details = $this->requests_leave_model->get_details_by_request_id($id);
			if(!$leave_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['leave_request_details'] = $leave_details;			
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

		if($request_details['request_type'] == 'employee_education'){
			//Get Education Request Details
			$education_details = $this->employees_model->get_education_request_details_by_request_id($id);
			if(!$education_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['education_request_details'] = $education_details;			
		}
		if($request_details['request_type'] == 'work_experience'){
			//Get Education Request Details
			$experience_details = $this->employees_model->get_experience_request_details_by_request_id($id);
			if(!$experience_details){
				$this->session->set_flashdata('flashError', 'Request details not found.');
				redirect('/dashboard');
			}
			$data['experience_request_details'] = $experience_details;			
		}

		//Get Request Threads
		$request_threads = $this->requests_threads_model->get_all($request_details['id']);

		$data['request_details'] = $request_details;
		$data['request_threads'] = $request_threads;

		//Get Employee List For Dropdown
		$data['employees'] = $this->employees_model->get_all($request_details['company_id']);

		$this->load->view('inc/header',$data);
		$this->load->view('fmc_request_details',$data);
		$this->load->view('inc/footer');		
	}
	

	public function approve_decline()
	{
		if($this->input->post()){				
			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);			
			$request_id = base64_decode($this->input->post('request_id')); 
			$status = $this->input->post('status'); 			

			if($status == "approved"){
				$status = "approved";
				$log_text = "Approved by FMC";
			}elseif($status == "declined"){
				$status = "declined";
				$log_text = "Declined by FMC";
			}else{
				$status = "in_approval";
				$log_text = "Required Company Re-Approval By FMC";
			
			}
			if($status == "in_approval" && empty($this->input->post('employee_id'))){
				$this->session->set_flashdata('flashError', 'Employee details required.');
				redirect("compnay-request-details/".base64_encode($request_id));
			}

			/*Create Request Thread*/
			$insert_request_thread_data = array(
				'request_id' => $request_id,
				'note' => $this->input->post('description'),
				'log_text' => $log_text,
				'fmc_user_id' => $fmc_login_user_id,
				'status' => $status,
				'created_at' => date('Y-m-d H:i:s')
			);
			
			$this->requests_threads_model->insert($insert_request_thread_data);
			/*End Create Request Thread*/			
			
			/*Update Request*/
			$request_update_data = array(
				'id' => $request_id,
				'status' => $status,
				'modified_at' => date('Y-m-d H:i:s')
			);
			if($status == "in_approval"){
				$re_approval_employee_id = $this->input->post('employee_id');
				$request_update_data['is_re_approval_from_fmc'] = 'yes';
				$request_update_data['assigned_company_user_id'] = $this->input->post('employee_id');
				$request_update_data['assigned_fmc_user_id'] = 0;
			}
			$this->requests_model->update($request_update_data);
			/*End Update Request*/	


			//Send Notification & Email
			$this->load->helper('email');
			$request_details = $this->requests_model->get_details($request_id);
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
				if($status == "approved"){
					## Move Qualification 
					$educations = array();
					foreach($education_details as $key => $value){
						$educations[] = array(
							'employee_id' => $value['employee_id'],
							'specialization' => $value['specialization'],
							'institute_name' => $value['institute_name'],
							'from_year' => $value['from_year'],
							'to_year' => $value['to_year']
						);	
					}
					$this->employees_model->add_educations($educations);
				}
				$record_id = $education_details[0]['id'];
			}

			
			if($status == 'in_approval'){
				$re_approval_employee_details = $this->employees_model->get_details($re_approval_employee_id);
				
				$title_en = "Re-Approval required for ".$request_type." request";
				$title_ar = "Re-Approval required for ".$request_type." request";


				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $request_details['company_id'],				
					'company_employee_id' => $re_approval_employee_details['id'],
					'type' => $notification_type_update,
					'request_id' => $request_details['id'],
					'record_id' => $record_id,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->notifications_model->insert($notification_data);
				
				if($re_approval_employee_details && $re_approval_employee_details['email'] != ""){
					
					
					$email_data = array();
					$email_data['fullname_english'] = $re_approval_employee_details['fullname_english'];
					$email_data['fullname_arabic'] = $re_approval_employee_details['fullname_arabic'];
					$email_data['request_type'] = $request_type;
					$email_data['request_id'] = $request_id;					

					$message = $this->load->view('email-templates/company-emp-request-re-app', $email_data,  TRUE);
					
					$to_email = $re_approval_employee_details['email'];
					$subject = "FMC - ".$title_en;
					send_email($to_email,$subject,$message);
				}

			}else{
				$title_en = "Your ".$request_type." request is ".$status;
				$title_ar = "Your ".$request_type." request is ".$status;

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $request_details['company_id'],					
					'company_employee_id' => $request_details['employee_id'],
					'type' => $notification_type_update,
					'request_id' => $request_details['id'],
					'record_id' => $record_id,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->notifications_model->insert($notification_data);

				$request_employee_details = $this->employees_model->get_details($request_details['employee_id']);
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

			$this->session->set_flashdata('flashSuccess', 'Request has been update successfully.');
			redirect('/dashboard');
			exit();
		}else{
			redirect('/dashboard');
		}
	}

	public function approve_decline_employee_confirm_request(){
		if($this->input->post()){
			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);			
			$request_id = base64_decode($this->input->post('request_id')); 
			$status = $this->input->post('status'); 			

			$employee_details = $this->employees_model->get_details_by_request_id($request_id);
			if(!$employee_details){				
				$this->session->set_flashdata('flashError', 'Employee details not found.');
				redirect('/requests/confirm_employee_request_details/'.base64_encode($request_id));
			}

			if($status == "approved"){
				$status = "approved";
				$log_text = "Approved by FMC";
			}else{
				$status = "declined";
				$log_text = "Declined by FMC";
			}

			/*Create Request Thread*/
			$insert_request_thread_data = array(
				'request_id' => $request_id,
				'note' => $this->input->post('description'),
				'log_text' => $log_text,
				'fmc_user_id' => $fmc_login_user_id,
				'status' => $status,
				'created_at' => date('Y-m-d H:i:s')
			);
			
			$this->requests_threads_model->insert($insert_request_thread_data);
			/*End Create Request Thread*/		

			/*Update Request*/
			$request_update_data = array(
				'id' => $request_id,
				'status' => $status,
				'modified_at' => date('Y-m-d H:i:s')
			);

			$this->requests_model->update($request_update_data);
			/*End Update Request*/

			if($employee_details['status'] == 'in_approval'){
				$update_data = array(
					'id' => $employee_details['id'],
					'status' => 'active',
					'request_id' => $request_id,
					'modified_at' => date('Y-m-d H:i:s')
				);
				$this->employees_model->update($update_data);
			}

			$request_details = $this->requests_model->get_details($request_id);
			$client_id = $request_details['company_id'];			
			$created_by_fmc = $request_details['created_by_fmc'];

			$title_en = "Your employee confirmation request for ".$employee_details['fullname_english']." is ".$status;
			$title_ar = "Your employee confirmation request for ".$employee_details['fullname_arabic']." is ".$status;

			//Insert Notification
			$notification_data = array(
				'title_en' => $title_en,
				'title_ar' => $title_ar,
				'company_id' => $client_id,
				'fmc_user_id' => $created_by_fmc,
				'type' => 'employee_confirmation_request_update',
				'request_id' => $request_id,
				'status' => 'unread',
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->notifications_model->insert($notification_data);

			//Load Email Helper
			$this->load->helper('email');
			//Get FMC User Details
			$request_created_user_detail = $this->user_model->get_details($created_by_fmc);
			if($request_created_user_detail && $request_created_user_detail['email'] != ""){
				$email_data = array();
				$email_data['user_fullname'] = $request_created_user_detail['first_name']." ".$request_created_user_detail['last_name']." ".$request_created_user_detail['surname'];
				$email_data['request_description_en'] = $title_en;
				$email_data['request_description_ar'] = $title_ar;
				$message = $this->load->view('email-templates/request_updated.php', $email_data,  TRUE);

				$to_email = $request_created_user_detail['email']; 
				$subject = "FMC -  ".$title_en;
				send_email($to_email,$subject,$message);
			}

			$this->session->set_flashdata('flashSuccess', 'Request has been update successfully.');
			redirect('/dashboard');
		}else{
			redirect('/dashboard');
		}
	}

	public function approve_decline_client_confirm_request(){
		if($this->input->post()){
			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);			
			$request_id = base64_decode($this->input->post('request_id')); 
			$status = $this->input->post('status'); 			

			if($status == "approved"){
				$client_status = 'confirmed';
				$status = "approved";
				$log_text = "Approved by FMC";
			}else{
				$client_status = 'declined';
				$status = "declined";
				$log_text = "Declined by FMC";
			}

			/*Create Request Thread*/
			$insert_request_thread_data = array(
				'request_id' => $request_id,
				'note' => $this->input->post('description'),
				'log_text' => $log_text,
				'fmc_user_id' => $fmc_login_user_id,
				'status' => $status,
				'created_at' => date('Y-m-d H:i:s')
			);
			
			$this->requests_threads_model->insert($insert_request_thread_data);
			/*End Create Request Thread*/			
			
			/*Update Request*/
			$request_update_data = array(
				'id' => $request_id,
				'status' => $status,
				'modified_at' => date('Y-m-d H:i:s')
			);

			$this->requests_model->update($request_update_data);
			/*End Update Request*/

			$request_details = $this->requests_model->get_details($request_id);
			$client_id = $request_details['company_id'];			
			$client_draft_details = $this->clients_model->get_draft_details_by_client_id($client_id);
			$client_draft_id = $client_draft_details['id'];
			$original_details = $this->clients_model->get_original_details($client_id);
			$created_by_fmc = $request_details['created_by_fmc'];
			

			$title_en = "Your client confirmation request for ".$original_details['company_name_english']." is ".$status;
			$title_ar = "Your client confirmation request for ".$original_details['company_name_english']." is ".$status;

			//Insert Notification
			$notification_data = array(
				'title_en' => $title_en,
				'title_ar' => $title_ar,
				'company_id' => $client_id,
				'fmc_user_id' => $created_by_fmc,
				'type' => 'client_confirmation_request_update',
				'request_id' => $request_id,
				'status' => 'unread',
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->notifications_model->insert($notification_data);

			//Load Email Helper
			$this->load->helper('email');
			//Get FMC User Details
			$request_created_user_detail = $this->user_model->get_details($created_by_fmc);
			if($request_created_user_detail && $request_created_user_detail['email'] != ""){
				$email_data = array();
				$email_data['user_fullname'] = $request_created_user_detail['first_name']." ".$request_created_user_detail['last_name']." ".$request_created_user_detail['surname'];
				$email_data['request_description_en'] = $title_en;
				$email_data['request_description_ar'] = $title_ar;
				$message = $this->load->view('email-templates/request_updated.php', $email_data,  TRUE);

				$to_email = $request_created_user_detail['email']; 
				$subject = "FMC -  ".$title_en;
				send_email($to_email,$subject,$message);
			}
			

			if($status == 'approved'){
				$client_draft_data = $this->clients_model->get_draft_details_by_client_id($client_id);

				unset($client_draft_data['request_id']);
				unset($client_draft_data['client_id']);
				unset($client_draft_data['legal_entity_name']);
				unset($client_draft_data['main_activity_name']);
				unset($client_draft_data['country_name']);
				unset($client_draft_data['region_name']);
				unset($client_draft_data['city_name']);


				$client_draft_data['id'] = $client_id;
				$client_draft_data['status'] = $client_status;
				$client_draft_data['modified_at'] = date('Y-m-d H:i:s');
				
				if($this->clients_model->update($client_draft_data)){
				
					//Update Client Draft Record
					$update_draft_data = array(
						'id' => $client_draft_id,
						'client_id' => $client_id,
						'status' => $client_status,
						'modified_at' => date('Y-m-d H:i:s')
					);
					$this->clients_model->update_draft($update_draft_data);

					//Client Properties
						$client_properties = $this->clients_properties_model->get_all_draft($client_draft_id);
						$client_properties_array = array();

						foreach ($client_properties as $key => $value) {
							unset($value['nationality_name']);
							unset($value['client_draft_id']);
							$client_properties_array[] = $value;
						}

						if(count($client_properties_array) > 0){
							$this->clients_properties_model->remove_all($client_id);
							$this->clients_properties_model->insert_batch($client_properties_array);
						}
						
					//End Client Properties

					//Executives Management
						$executives = $this->clients_model->get_executives_draft($client_draft_id);
						$executives_arr = array();
						
						foreach ($executives as $value) {
							unset($value['client_draft_id']);
							$executives_arr[] = $value;
						}

						if(count($executives) > 0){
							$this->clients_model->remove_all_executives($client_id);
							$this->clients_model->insert_executives($executives_arr);
						}								
					//End Executives Management
												
					//Branches
						$branches = $this->clients_model->get_branches_draft($client_draft_id);
						$branches_array = array();

						foreach ($branches as $key => $value) {
							unset($value['region_name']);
							unset($value['city_name']);
							unset($value['client_draft_id']);
							$branches_array[] = $value;
						}

						if(count($branches_array) > 0){
							$this->clients_model->remove_all_branches($client_id);
							$this->clients_model->insert_branches($branches_array);
						}
					//End Branches
					
					//Documents 
					$documents = $this->clients_model->get_documents_draft($client_draft_id);
					$documents_arr = array();
					foreach ($documents as $value) {
						unset($value['client_draft_id']);
						unset($value['created_by_first_name']);
						unset($value['created_by_last_name']);
						unset($value['created_by_surname']);
						$documents_arr[] = $value;
					}
					if(count($documents_arr) > 0){
						$this->clients_model->remove_all_documents($client_id);
						$this->clients_model->insert_document_batch($documents_arr);
					}
				}
			}

			if($status == 'declined'){
				$original_details = $this->clients_model->get_original_details($client_id);

				$update_data = array(
					'id' => $client_draft_id,
					'status' => 'declined'
				);
				$this->clients_model->update_draft($update_data);

				if($original_details['status'] == 'in_confirmation'){
					$update_data = array(
						'id' => $client_id,
						'status' => 'declined',
						'modified_at' => date('Y-m-d H:i:s')
					);
					$this->clients_model->update($update_data);
				}
			}

			$this->session->set_flashdata('flashSuccess', 'Request has been update successfully.');
			redirect('/dashboard');
			exit();
		}else{
			redirect('/dashboard');
		}
	}
	
	public function create_request_comment(){

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);			
		if($this->input->post()){
			$insert_data = array(
					'request_id' => $this->input->post('request_id'),
		            'description' => $this->input->post('description'),
		            'fmc_user_id' => $fmc_login_user_id,
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


	public function confirm_employee_request_details($request_id){
		$data['title'] = "Employee - Confirm Request";

		if(!empty($request_id)){
			
			$request_details = $this->requests_model->get_details(base64_decode($request_id));
			if(!$request_details){
				$this->session->set_flashdata('flashError', 'Request not found.');
				redirect('/dashboard');
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
					$fmc_user_details = $this->user_model->get_details($value['fmc_user_id']);				
					$comment_by = $fmc_user_details['first_name']." ".$fmc_user_details['last_name']." ".$fmc_user_details['surname'];
				}
				$request_comments[] = array(
					'comment_by' => $comment_by,
					'documents' => $documents,
					'description' => $value['description'],
					'created_at' => $value['created_at']
				);
			}
			
			$request_details['request_comments'] = $request_comments;
			//End Get Request Comments
			
			//Get Request Threads
			$request_threads = $this->requests_threads_model->get_all($request_details['id']);

			$details = $this->employees_model->get_details_by_request_id($request_details['id']);

	    	if($details){
				//company login id
				$data['emergency_contacts'] = $this->employees_model->get_emergenct_contacts(base64_decode($details['id']));
				$data['educations'] = $this->employees_model->get_educations($details['id']);
				$data['work_experience_items'] = $this->employees_model->get_work_experience($details['id']);

				$data['workshift'] = $this->workshift_model->get_all($details['client_id']);

				$data['employee_workshift'] = $this->employees_model->get_all_workshift($details['id']);


				$days = array();
				$days[] = "sunday";
				$days[] = "monday";
				$days[] = "tuesday";
				$days[] = "wednesday";
				$days[] = "thursday";
				$days[] = "friday";
				$days[] = "saturday";

				$data['days'] = $days;

				$data['salary_components_earning'] = $this->salary_components_model->get_all_by_type($details['client_id'],'earning');
				$data['salary_components_deduction'] = $this->salary_components_model->get_all_by_type($details['client_id'],'deduction');

				$data['employee_salary_components'] = $this->employees_model->get_salary_components($details['id']);
				$data['employee_benefits'] = $this->employees_model->get_employee_benefits($details['id']); 
				
				$data['request_details'] = $request_details;
				$data['request_threads'] = $request_threads;
				$data['details'] = $details;
				$data['details']['medical_documents'] = $this->common_documents_model->get_all('employee_medical_documents',$details['id']); 

				$this->load->model('user_model');
				$data['fmc_users'] = $this->user_model->get_all();
				
				$this->load->view('inc/header',$data);
				$this->load->view('company_employees_confirm_request',$data);
				$this->load->view('inc/footer');	

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}	    	

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees');
	    }

	}

	public function confirm_client_details_request($request_id = ""){		
		if(!empty($request_id)){
			$request_details = $this->requests_model->get_details(base64_decode($request_id));
			if(!$request_details){
				$this->session->set_flashdata('flashError', 'Request not found.');
				redirect('/dashboard');
			}

			if($request_details['status'] != 'in_approval'){
				$this->session->set_flashdata('flashError', 'Request is not open.');
				redirect('/dashboard');
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
					$fmc_user_details = $this->user_model->get_details($value['fmc_user_id']);				
					$comment_by = $fmc_user_details['first_name']." ".$fmc_user_details['last_name']." ".$fmc_user_details['surname'];
				}
				$request_comments[] = array(
					'comment_by' => $comment_by,
					'documents' => $documents,
					'description' => $value['description'],
					'created_at' => $value['created_at']
				);
			}
			$request_details['request_comments'] = $request_comments;
						
			$client_draft_details = $this->clients_model->get_draft_details_by_client_id($request_details['company_id']);
			if($client_draft_details){
				$data['title'] = "Confirm Client Details Request";
				$data['details'] = $client_draft_details;
				$client_draft_id = $client_draft_details['id'];

				$data['properties'] = $this->clients_properties_model->get_all_draft($client_draft_id);
				$data['executives'] = $this->clients_model->get_executives_draft($client_draft_id);
				$data['branches'] = $this->clients_model->get_branches_draft($client_draft_id);
				$data['documents'] = $this->clients_model->get_documents_draft($client_draft_id);
				$data['request_id'] = base64_decode($request_id);
			
				//Get Request Threads
				$request_threads = $this->requests_threads_model->get_all($request_details['id']);

				$data['request_details'] = $request_details;
				$data['request_threads'] = $request_threads;			    

				$this->load->view('inc/header',$data);
				$this->load->view('clients_confirm_request_details',$data);
				$this->load->view('inc/footer');
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('clients');
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            //redirect('clients');
		}
	}

	public function client_request_details($request_id = ""){		
		if(!empty($request_id)){
			$request_details = $this->requests_model->get_details(base64_decode($request_id));
			
			if(!$request_details){
				$this->session->set_flashdata('flashError', 'Request not found.');
				redirect('/dashboard');
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
					$fmc_user_details = $this->user_model->get_details($value['fmc_user_id']);				
					$comment_by = $fmc_user_details['first_name']." ".$fmc_user_details['last_name']." ".$fmc_user_details['surname'];
				}
				$request_comments[] = array(
					'comment_by' => $comment_by,
					'documents' => $documents,
					'description' => $value['description'],
					'created_at' => $value['created_at']
				);
			}
			$request_details['request_comments'] = $request_comments;
						
			$client_draft_details = $this->clients_model->get_draft_details_by_request_id($request_details['id']);
			if($client_draft_details){
				$data['title'] = "Confirm Client Details Request";
				$data['details'] = $client_draft_details;
				$client_draft_id = $client_draft_details['id'];

				$data['properties'] = $this->clients_properties_model->get_all_draft($client_draft_id);
				$data['executives'] = $this->clients_model->get_executives_draft($client_draft_id);
				$data['branches'] = $this->clients_model->get_branches_draft($client_draft_id);
				$data['documents'] = $this->clients_model->get_documents_draft($client_draft_id);
				$data['request_id'] = base64_decode($request_id);
			
				//Get Request Threads
				$request_threads = $this->requests_threads_model->get_all($request_details['id']);

				$data['request_details'] = $request_details;
				$data['request_threads'] = $request_threads;			    

				$this->load->view('inc/header',$data);
				$this->load->view('clients_request_details',$data);
				$this->load->view('inc/footer');
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('dashboard');
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('dashboard');
		}
	}

	public function payroll_request_details($request_id = ""){		
		if(!empty($request_id)){
			
			$request_details = $this->requests_model->get_details(base64_decode($request_id));
			
			if(!$request_details){
				$this->session->set_flashdata('flashError', 'Request not found.');
				redirect('/dashboard');
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
					$fmc_user_details = $this->user_model->get_details($value['fmc_user_id']);				
					$comment_by = $fmc_user_details['first_name']." ".$fmc_user_details['last_name']." ".$fmc_user_details['surname'];
				}
				$request_comments[] = array(
					'comment_by' => $comment_by,
					'documents' => $documents,
					'description' => $value['description'],
					'created_at' => $value['created_at']
				);
			}
			$request_details['request_comments'] = $request_comments;
						
			$payroll_details = $this->company_payroll_model->get_details_by_request_id($request_details['id']);
			if($payroll_details){
				$data['title'] = "Confirm Payroll Request";

				$data['employees_payroll'] = $this->company_payroll_model->get_employee_payroll($payroll_details['id']);
				$data['details'] = $payroll_details;
				
				
				$data['request_id'] = base64_decode($request_id);
			
				//Get Request Threads
				$request_threads = $this->requests_threads_model->get_all($request_details['id']);

				$data['request_details'] = $request_details;
				$data['request_threads'] = $request_threads;			    

				$this->load->view('inc/header',$data);
				$this->load->view('fmc_payroll_request_details',$data);
				$this->load->view('inc/footer');
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('dashboard');
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('dashboard');
		}
	}

	public function approve_decline_payroll_confirm_request(){
		if($this->input->post()){
			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);			
			$request_id = base64_decode($this->input->post('request_id')); 
			$status = $this->input->post('status'); 			

			$payroll_details = $this->company_payroll_model->get_details_by_request_id($request_id);
			if(!$payroll_details){				
				$this->session->set_flashdata('flashError', 'Employee details not found.');
				redirect('/requests/confirm_employee_request_details/'.base64_encode($request_id));
			}

			if($status == "approved"){
				$status = "approved";
				$log_text = "Approved by FMC";
			}else{
				$status = "declined";
				$log_text = "Declined by FMC";
			}

			/*Create Request Thread*/
			$insert_request_thread_data = array(
				'request_id' => $request_id,
				'note' => $this->input->post('description'),
				'log_text' => $log_text,
				'fmc_user_id' => $fmc_login_user_id,
				'status' => $status,
				'created_at' => date('Y-m-d H:i:s')
			);
			
			$this->requests_threads_model->insert($insert_request_thread_data);
			/*End Create Request Thread*/		

			/*Update Request*/
			$request_update_data = array(
				'id' => $request_id,
				'status' => $status,
				'modified_at' => date('Y-m-d H:i:s')
			);

			$this->requests_model->update($request_update_data);
			/*End Update Request*/

			if($payroll_details['status'] == 'in_approval'){
				$update_data = array(
					'id' => $payroll_details['id'],
					'status' => $status,
					'request_id' => $request_id,
					'modified_at' => date('Y-m-d H:i:s')
				);
				$this->company_payroll_model->update($update_data);
			}

			if($status == 'declined'){
				$this->company_payroll_model->update_employee_payroll_status_to_draft($payroll_details['id']);
			}

			$company_details = $this->clients_model->get_original_details($payroll_details['company_id']);
			$request_details = $this->requests_model->get_details($request_id);
			$client_id = $request_details['company_id'];			
			$created_by_fmc = $request_details['created_by_fmc'];

			$title_en = "Your payroll confirmation request for ".$company_details['company_name_english']." is ".$status;
			$title_ar = "Your payroll confirmation request for ".$company_details['company_name_arabic']." is ".$status;

			//Insert Notification
			$notification_data = array(
				'title_en' => $title_en,
				'title_ar' => $title_ar,
				'company_id' => $client_id,
				'fmc_user_id' => $created_by_fmc,
				'type' => 'payroll_confirmation_request_update',
				'request_id' => $request_id,
				'status' => 'unread',
				'created_at' => date('Y-m-d H:i:s')
			);
			$this->notifications_model->insert($notification_data);

			//Load Email Helper
			$this->load->helper('email');
			//Get FMC User Details
			$request_created_user_detail = $this->user_model->get_details($created_by_fmc);
			if($request_created_user_detail && $request_created_user_detail['email'] != ""){
				$email_data = array();
				$email_data['user_fullname'] = $request_created_user_detail['first_name']." ".$request_created_user_detail['last_name']." ".$request_created_user_detail['surname'];
				$email_data['request_description_en'] = $title_en;
				$email_data['request_description_ar'] = $title_ar;
				$message = $this->load->view('email-templates/request_updated.php', $email_data,  TRUE);

				$to_email = $request_created_user_detail['email']; 
				$subject = "FMC -  ".$title_en;
				send_email($to_email,$subject,$message);
			}

			$this->session->set_flashdata('flashSuccess', 'Request has been update successfully.');
			redirect('/dashboard');
		}else{
			redirect('/dashboard');
		}
	}
	
}
