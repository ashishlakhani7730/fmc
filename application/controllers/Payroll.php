<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends MY_Controller {

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
        $this->load->model('company_payroll_model');
        $this->load->model('employees_model');
        $this->load->model('attendance_model');
        $this->load->model('salary_components_model');
        $this->load->model('requests_model');        
        $this->load->model('requests_threads_model');
        $this->load->model('common_documents_model');
        $this->load->model('request_comment_model');
        $this->load->model('notifications_model');
        $this->load->model('clients_model');
        $this->load->model('user_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "Payroll";		
		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['items'] = $this->company_payroll_model->get_all($client_login_id);

		
		$this->load->view('inc/header',$data);
		$this->load->view('payroll',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		$data['title'] = "Payroll - Generate";

		if($this->input->post()){
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$description = $this->input->post('description');
			$employees = (isset($_POST['employee_id']) && $_POST['employee_id']) ? $_POST['employee_id'] : [];

			$is_duplicate_payroll = $this->company_payroll_model->check_duplicate_payroll($client_login_id,$month,$year);
			if($is_duplicate_payroll){
				$this->session->set_flashdata('flashError', 'Payroll alredy exist for '.$month.'-'.$year);
				redirect('payroll/create');
				exit();
			}

			$payroll_obj = array(
				'company_id' => $client_login_id,
				'month' => $month,
				'year' => $year,
				'description' => $description,
				'status' => 'draft',
				'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
			);

			$is_payroll_insert = $this->company_payroll_model->insert($payroll_obj);
			if($is_payroll_insert){
				$payroll_employee_arr = array();
				foreach ($employees as $value) {
					$salary_components = $this->company_payroll_model->get_employee_salary_component($value);

					$payroll_component = array();
					foreach ($salary_components as $com_value) {
						$payroll_component[] = array(
							'payroll_id' => $is_payroll_insert,
							'employee_id' => $value,
							'salary_component_id' => $com_value['salary_component_id'],
							'salary_component_value' => $com_value['salary_component_value'],
							'salary_component_calc_type' => $com_value['calculation_type'],
							'salary_component_title' => $com_value['name_in_payslip'],
							'salary_component_type' => $com_value['salary_component_type'],
							'salary_component_amount' => $com_value['salary_amount']
							
						);	
					}
					$this->company_payroll_model->insert_company_payroll_employees_components($payroll_component);

					$payroll_employee_arr[] = array(
						'payroll_id' => $is_payroll_insert,
						'employee_id' => $value,
						'year' => $year,
						'month' => $month,
						'description' => '',
						'status' => 'draft',
						'created_at' => date('Y-m-d H:i:s'),
	        			'modified_at' => date('Y-m-d H:i:s')
					);	
				}

				$this->company_payroll_model->insert_company_payroll_employees($payroll_employee_arr);

				redirect('payroll/confirm/'.base64_encode($is_payroll_insert));
				
			}else{
				$this->session->set_flashdata('flashError', 'Payroll has not been generated successfully.');
				redirect('payroll');
			}
			exit();
		}

		$data['year'] = date('Y');
		$data['month'] = date('m');
		$data['employees'] = $this->employees_model->get_all($client_login_id);

		$this->load->view('inc/header',$data);
		$this->load->view('payroll_create',$data);
		$this->load->view('inc/footer');
	}

	public function confirm($id = "")
	{
		$data['title'] = "Payroll Confirm";		

		if(!empty($id)){
			$id = base64_decode($id);
			$details = $this->company_payroll_model->get_details($id);
			if($details){				
				//Get Request Details IF
				if(isset($details['request_id']) && $details['request_id'] != "0"){
					$request_details = $this->requests_model->get_details($details['request_id']);
					if($request_details){
						$request_threads = $this->requests_threads_model->get_all($details['request_id']);

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

						$data['request_details'] = $request_details;
						$data['request_threads'] = $request_threads;
					}
				}

				$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);				
				$data['fmc_users'] = $this->user_model->get_all($login_user_id);

				$data['employees_payroll'] = $this->company_payroll_model->get_employee_payroll($id);
				$data['details'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Payroll has not been found.');
				redirect('payroll');
			}
		}else{
			redirect('payroll');
		}

		$this->load->view('inc/header',$data);
		$this->load->view('payroll_confirm',$data);
		$this->load->view('inc/footer');
	}

	public function create_salary_component(){
		if($this->input->post()){
			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
			
			$insert_data = array(
				'company_id' => base64_decode($company_login_id),
				'component_type' => $this->input->post('component_type'),
	            'name' => $this->input->post('name'),
	            'name_in_payslip' => $this->input->post('name_in_payslip'),
	            'calculation_type' => $this->input->post('calculation_type'),
	            'value' => $this->input->post('value'),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
			
	        $is_inserted = $this->salary_components_model->insert($insert_data);

	        if($is_inserted){
	        	$salary_items = array();
	        	$salary_items[] = array(
					'employee_id' => $this->input->post('employee_id'),
					'salary_component_id' => $is_inserted,
					'salary_amount' => ($this->input->post('value')) ? $this->input->post('value') : '0',
					'salary_component_value' => ($this->input->post('value')) ? $this->input->post('value') : '0'
				);

				$this->employees_model->add_salary_components($salary_items);
				
	        	$this->session->set_flashdata('flashSuccess', 'Salary-Component has been inserted successfully.'); 
	        }else{
	        	$this->session->set_flashdata('flashError', 'Salary-Component has not been inserted successfully.');
	        }
		}
		echo '1';exit;
	}	

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->company_payroll_model->delete($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Department has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Department has not been deleted successfully.'); 
            echo '0';exit;
        }
	}


	public function get_employee_details(){
		$employee_id = $_POST['employee_id'];

		$employee_details = $this->employees_model->get_details($this->input->post('employee_id'));

		$data = array();

		if(!$employee_details){
			$this->session->set_flashdata('flashError', 'Employee details not found.'); 
        	$data['success'] = 'false';
		}else{
			if($employee_details['attendance_start_date'] == "0000-00-00"){
				$this->session->set_flashdata('flashError', 'Employee attendance start date not set.');
	        	$data['success'] = 'false';
			}else{

				$payroll_list = $this->company_payroll_model->get_all($employee_id);
				if(count($payroll_list) > 0){
					$data['last_payroll_date'] = date('d/m/Y',strtotime($payroll_list[0]['to_date']));
				}else{
					$data['last_payroll_date'] = "";
				}
				

				$employee_details['attendance_start_date'] = date('d/m/Y',strtotime($employee_details['attendance_start_date']));
				$data['employee_details'] = $employee_details;
				$data['success'] = 'true';
			}
		}
		echo json_encode($data);
	}

	public function confirm_employee_payroll(){
		if(!isset($_POST['employees_payroll_id']) && $_POST['employees_payroll_id'] == ""){
			$this->session->set_flashdata('flashError', 'Payroll confirmation request faild'); 
            echo '0';exit;
		}
		$employees_payroll_id = $_POST['employees_payroll_id'];
		$total_earning_value = (isset($_POST['total_earning_value']) && $_POST['total_earning_value'] != "") ? $_POST['total_earning_value'] : 0;
		$total_deduction_value = (isset($_POST['total_deduction_value']) && $_POST['total_deduction_value'] != "") ? $_POST['total_deduction_value'] : 0;
		$final_salary = (isset($_POST['final_salary']) && $_POST['final_salary'] != "") ? $_POST['final_salary'] : 0;
		$components = (isset($_POST['components'])) ? $_POST['components'] : array();

		$employees_payroll_data = array(
			'id' => $employees_payroll_id,
			'total_earning' => $total_earning_value,
			'total_deduction' => $total_deduction_value,
			'final_salary' => $final_salary,
			'status' => 'confirmed'
		);
		$is_updated = $this->company_payroll_model->update_employee_payroll($employees_payroll_data);
		if($is_updated){
			foreach ($components as $value) {
				$update_data = array(
					'id' => $value['component_id'],
					'salary_component_amount' =>$value['component_value']
				);
				$this->company_payroll_model->update_employee_payroll_component($update_data);
			}
			$this->session->set_flashdata('flashSuccess', 'Payroll has been successfully confirmed'); 
			echo '1';exit;
		}else{
			$this->session->set_flashdata('flashError', 'Payroll confirmation request faild'); 
            echo '0';exit;
		}
	}

	public function send_for_approval(){
		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));

			$details = $this->company_payroll_model->get_details($id);
			if($details){
				$this->load->helper('email');
				
				$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
				$company_details = $this->clients_model->get_original_details($company_login_id);
				$fmc_login_user_id = $this->session->userdata['fmc_user_data']['id'];
				$assigned_fmc_user_id = $this->input->post('assigned_fmc_user_id');
				$assigned_fmc_user_details = $this->user_model->get_details($assigned_fmc_user_id);

				$request_data = array(
					'company_id' => $company_login_id,
					'request_type' => 'payroll_confirmation',
					'assigned_fmc_user_id' => $assigned_fmc_user_id,
					'created_by_fmc' => base64_decode($fmc_login_user_id),
					'status' => 'in_approval',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);

				$is_request_inserted = $this->requests_model->insert($request_data);
				if(!$is_request_inserted){
					$this->session->set_flashdata('flashError', 'Request has not been created successfully.');
					redirect('payroll/confirm/'.base64_encode($id));
				}

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => "Request created - ".$this->input->post('note'),
					'log_text' => "Request created - ".$this->input->post('note'),
					'company_id' => $company_login_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				$update_draft_data = array(
					'id' => $id,
					'request_id' => $is_request_inserted,
					'status' => 'in_approval',
					'modified_at' => date('Y-m-d H:i:s')
				);
				$is_updated = $this->company_payroll_model->update($update_draft_data);
				if($is_updated){
					$title_en = "Verify ".$company_details['company_name_english']."'s' payroll for ".$details['month'].'-'.$details['year'];
					$title_ar = "Verify ".$company_details['company_name_english']."'s' payroll for ".$details['month'].'-'.$details['year'];

					//Insert Notification
					$notification_data = array(
						'title_en' => $title_en,
						'title_ar' => $title_ar,
						'company_id' => base64_decode($id),
						'fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
						'type' => 'payroll_confirmation',
						'request_id' => $is_request_inserted,
						'status' => 'unread',
						'created_at' => date('Y-m-d H:i:s')
					);
					$this->notifications_model->insert($notification_data);
					
					//Send Email
					$email_data = array();
	        		$email_data['user_fullname'] = $assigned_fmc_user_details['first_name']." ".$assigned_fmc_user_details['last_name']." ".$assigned_fmc_user_details['surname'];
	        		$email_data['is_request_inserted'] = $is_request_inserted;
	        		$message = $this->load->view('email-templates/company_payroll_confirmation', $email_data,  TRUE);

	        		$to_email = $assigned_fmc_user_details['email'];
					$subject = "FMC - ".$title_en;
					send_email($to_email,$subject,$message);
					
		        	$this->session->set_flashdata('flashSuccess', 'Payroll has been successfully send for approval.');
		        	redirect('payroll');
				}else{

				}
			}else{
				$this->session->set_flashdata('flashError', 'Payroll not found'); 
				redirect('payroll');	
			}
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request'); 
			redirect('payroll');
		}
	}

	public function send_for_reapproval(){
		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));
			$request_id = base64_decode($this->input->post('request_id'));

			$details = $this->company_payroll_model->get_details($id);
			if($details){
				$this->load->helper('email');
				
				$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
				$company_details = $this->clients_model->get_original_details($company_login_id);
				$fmc_login_user_id = $this->session->userdata['fmc_user_data']['id'];
				$assigned_fmc_user_id = $this->input->post('assigned_fmc_user_id');
				$assigned_fmc_user_details = $this->user_model->get_details($assigned_fmc_user_id);

				/*Update Request*/
				$request_update_data = array(
					'id' => $request_id,
					'status' => 'in_approval',
					'modified_at' => date('Y-m-d H:i:s')
				);

				$this->requests_model->update($request_update_data);
				/*End Update Request*/

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $request_id,
					'note' => "Request re-open - ".$this->input->post('note'),
					'log_text' => "Request re-open - ".$this->input->post('note'),
					'company_id' => $company_login_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				$update_draft_data = array(
					'id' => $id,
					'request_id' => $request_id,
					'status' => 'in_approval',
					'modified_at' => date('Y-m-d H:i:s')
				);
				$is_updated = $this->company_payroll_model->update($update_draft_data);
				if($is_updated){
					$title_en = "Verify ".$company_details['company_name_english']."'s' payroll for ".$details['month'].'-'.$details['year'];
					$title_ar = "Verify ".$company_details['company_name_english']."'s' payroll for ".$details['month'].'-'.$details['year'];

					//Insert Notification
					$notification_data = array(
						'title_en' => $title_en,
						'title_ar' => $title_ar,
						'company_id' => base64_decode($id),
						'fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
						'type' => 'payroll_confirmation',
						'request_id' => $request_id,
						'status' => 'unread',
						'created_at' => date('Y-m-d H:i:s')
					);
					$this->notifications_model->insert($notification_data);
					
					//Send Email
					$email_data = array();
	        		$email_data['user_fullname'] = $assigned_fmc_user_details['first_name']." ".$assigned_fmc_user_details['last_name']." ".$assigned_fmc_user_details['surname'];
	        		$email_data['is_request_inserted'] = $is_request_inserted;
	        		$message = $this->load->view('email-templates/company_payroll_confirmation', $email_data,  TRUE);

	        		$to_email = $assigned_fmc_user_details['email'];
					$subject = "FMC - ".$title_en;
					send_email($to_email,$subject,$message);
					
		        	$this->session->set_flashdata('flashSuccess', 'Payroll has been successfully send for approval.');
		        	redirect('payroll');
				}else{

				}
			}else{
				$this->session->set_flashdata('flashError', 'Payroll not found'); 
				redirect('payroll');	
			}
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request'); 
			redirect('payroll');
		}
	}
	
	
}
