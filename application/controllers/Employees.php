<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Employees extends MY_Controller {

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

    	//Models
    	$this->load->model('employees_model');
    	$this->load->model('leave_group_model');
    	$this->load->model('salary_components_model');
    	$this->load->model('company_designation_model');
		$this->load->model('job_positions_model');
		$this->load->model('company_departments_model');
		$this->load->model('holidays_group_model');
		$this->load->model('workweek_model');
		$this->load->model('cities_model');
        $this->load->model('regions_model');
		$this->load->model('workshift_model');
		$this->load->model('requests_model');
		$this->load->model('employee_documents_model');
		$this->load->model('requests_threads_model');
		$this->load->model('request_comment_model');
		$this->load->model('common_documents_model');
		$this->load->model('user_model');				
		$this->load->model('notifications_model');
		$this->load->model('medical_categories_model');
		$this->load->model('countries_model');

		//Library
		$this->load->library('upload');
		$this->load->library('excel');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "Company Employees";		
		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		$data['items'] = $this->employees_model->get_all($client_login_id);

		
		$this->load->view('inc/header',$data);
		$this->load->view('company_employees',$data);
		$this->load->view('inc/footer');
	}	

	public function import_excel(){
    	ini_set('memory_limit', '2048M');

    	$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		if(isset($_FILES['excel_file']) && is_uploaded_file($_FILES['excel_file']['tmp_name'])){

			$excel_file_name = "";
			$file_name = $_FILES['excel_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'xls|xlsx';
	        $config['upload_path'] = 'imported_excel/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('excel_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	$this->session->set_flashdata('flashdata',$dataArray);
                	redirect('/employees');
                }
            }else{
            	$excel_file_name = $upload_file_name;
            	$inputFileName = 'imported_excel/' . $excel_file_name;
            	try {
            		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
					$cacheSettings = array( ' memoryCacheSize ' => '8MB');
					PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

            		PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
	                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	                $objReader->setReadDataOnly(true);
	                $objPHPExcel = $objReader->load($inputFileName);
	            } catch (Exception $e) {
	                $this->session->set_flashdata('flashError',$e->getMessage());
	                redirect('/employees');
	            }

	            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);	           
	           

	            $createArray = array('Employee Code', 'Employee Full Name English', 'Employee Full Name Arabic', 'Mobile', 'Joining Date', 'Attendance Start Date','Company Email','Personal Email','Personal Mobile','Gender','Birthdate');

	           
	            
	            $makeArray = array(
	            	'Employee Code' => '',
	            	'Employee Full Name English' => '',
	            	'Employee Full Name Arabic' => '',
	            	'Mobile' => '',
	            	'Joining Date' => '',
	            	'Attendance Start Date' => '',
	            	'Company Email' => '',
	            	'Personal Email' => '',
	            	'Personal Mobile' => '',
	            	'Gender' => '',
	            	'Birthdate' => ''
	           	);
		            
		        $arrayCount = count($allDataInSheet);

		        
		        $SheetDataKey = array();
		        

		        foreach ($allDataInSheet as $dataInSheet) {
	        		foreach ($dataInSheet as $key => $value) {
	            		if (in_array(trim($value), $createArray)) {
	                        //$value = preg_replace('/\s+/', '', $value);
	                        $SheetDataKey[trim($value)] = $key;
	                    }
	             	}
	            }
	            

	            $data = array_diff_key($makeArray, $SheetDataKey);
	            $flag = 0;
	            if (empty($data)) {
	                $flag = 1;
	            }
	            $insert_batch_data = array();
	            if ($flag == 1) {
	            	for ($i = 2; $i <= $arrayCount; $i++) {
                   		$Employee_Code = $SheetDataKey['Employee Code'];
	                    $Employee_Full_Name_English = $SheetDataKey['Employee Full Name English'];
	                    $Employee_Full_Name_Arabic = $SheetDataKey['Employee Full Name Arabic'];
	                    $Mobile = $SheetDataKey['Mobile'];
	                    $Joining_Date = $SheetDataKey['Joining Date'];
	                    $Attendance_Start_Date = $SheetDataKey['Attendance Start Date'];
	                    $Company_Email = $SheetDataKey['Company Email'];
	                    $Personal_Email = $SheetDataKey['Personal Email'];
	                    $Personal_Mobile = $SheetDataKey['Personal Mobile'];
	                    $Gender = $SheetDataKey['Gender'];
	                    $Birthdate = $SheetDataKey['Birthdate'];


	                    $Employee_Code = filter_var(trim($allDataInSheet[$i][$Employee_Code]), FILTER_SANITIZE_STRING);
	                    $Employee_Full_Name_English = filter_var(trim($allDataInSheet[$i][$Employee_Full_Name_English]), FILTER_SANITIZE_STRING);
	                    $Employee_Full_Name_Arabic = filter_var(trim($allDataInSheet[$i][$Employee_Full_Name_Arabic]), FILTER_SANITIZE_STRING);
	                    $Mobile = filter_var(trim($allDataInSheet[$i][$Mobile]), FILTER_SANITIZE_STRING);
	                    $Joining_Date = filter_var(trim($allDataInSheet[$i][$Joining_Date]), FILTER_SANITIZE_STRING);
	                    $Attendance_Start_Date = filter_var(trim($allDataInSheet[$i][$Attendance_Start_Date]), FILTER_SANITIZE_STRING);
	                    $Company_Email = filter_var(trim($allDataInSheet[$i][$Company_Email]), FILTER_SANITIZE_STRING);
	                    $Personal_Email = filter_var(trim($allDataInSheet[$i][$Personal_Email]), FILTER_SANITIZE_STRING);
	                    $Personal_Mobile = filter_var(trim($allDataInSheet[$i][$Personal_Mobile]), FILTER_SANITIZE_STRING);
	                    $Gender = filter_var(trim($allDataInSheet[$i][$Gender]), FILTER_SANITIZE_STRING);
	                    $Birthdate = filter_var(trim($allDataInSheet[$i][$Birthdate]), FILTER_SANITIZE_STRING);
	                    
	                    
	                    if(isset($Employee_Code) && $Employee_Code != NULL){
	                    	
	                    	$is_employee_found = $this->employees_model->checkEmployeeCode($Employee_Code);
		                    $is_employee_code_exist = "no";
		                    if($is_employee_found){
		                    	$is_employee_code_exist = "yes";
		                    }

		                    $is_employee_email_found = $this->employees_model->checkEmail($Company_Email);
		                    $is_employee_email_exist = "no";
		                    if($is_employee_email_found){
		                    	$is_employee_email_exist = "yes";
		                    }

		                    $insert_batch_data[] = array(
		                    	"is_employee_code_exist" => $is_employee_code_exist,
		                    	"is_employee_email_exist" => $is_employee_email_exist,
		                    	"employee_code" => $Employee_Code,
			                    "fullname_english" => $Employee_Full_Name_English,
			                    "fullname_arabic" => $Employee_Full_Name_Arabic,
			                    "mobile" => $Mobile,
			                    "joining_date" => $Joining_Date,
			                    "attendance_start_date" => $Attendance_Start_Date,
			                    "email" => $Company_Email,
			                    "personal_email" => $Personal_Email,
			                    "personal_mobile" => $Personal_Mobile,
			                    "gender" => $Gender,
			                    "birthdate" => $Birthdate
		                    );	
	                    }
	                    
	                }
	               	
	               	$data['employees'] = $insert_batch_data;

	                $this->load->view('inc/header',$data);
					$this->load->view('employee_import_excel',$data);
					$this->load->view('inc/footer');

	            }else{
	            	$this->session->set_flashdata('flashError','Invalid excel format');
            		redirect('/employees');
	            }	          
	            
            }
		}else{
			$this->session->set_flashdata('flashError','Please upload excel file');
            redirect('/employees');
		}
	}
	
	public function import_excel_save_data()
	{			
		if($this->input->post()){

			foreach($this->input->post('employee_code') as $key => $value){
				$insert_data = array(
					"employee_code" => $this->input->post('employee_code')[$key],
                    "fullname_english" => $this->input->post('fullname_english')[$key],
                    "fullname_arabic" => $this->input->post('fullname_arabic')[$key],
                    "mobile" => $this->input->post('mobile')[$key],
                    //"joining_date" => $this->input->post('extra_benifit_title')[$key],
                    //"attendance_start_date" => $this->input->post('extra_benifit_title')[$key],
                    "email" => $this->input->post('email')[$key],
                    "personal_email" => $this->input->post('personal_email')[$key],
                    "personal_mobile" => $this->input->post('personal_mobile')[$key],
                    "gender" => $this->input->post('gender')[$key],
                    //"birthdate" => $this->input->post('extra_benifit_title')[$key]
                    "is_login" => 'no',
                    "status" => 'draft',
                    "created_at" => date('Y-m-d H:i:s'),
	        		"modified_at" => date('Y-m-d H:i:s')
				);	

				$is_insert = "yes";
				$is_employee_found = $this->employees_model->checkEmployeeCode($this->input->post('employee_code')[$key]);
                if($is_employee_found){
                	$is_insert = "no";
                }

                $is_employee_email_found = $this->employees_model->checkEmail($this->input->post('email')[$key]);
                if($is_employee_email_found){
                	$is_insert = "no";
                }
                if($is_insert == "yes"){
                	$is_inserted = $this->employees_model->insert($insert_data);
                }
			}
				
			$this->session->set_flashdata('flashSuccess', 'Employee excel successfully imported.');
			redirect('/employees');	
		}else{
			redirect('/employees');	
		}
	}

	public function get_share_link_ajax() { 
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	    $n = 10;
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	    
	    if($this->employees_model->check_public_share_link_exist($randomString)){
	    	return $this->get_share_link(10);
	    }else{
	    	echo json_encode(array("share_link"=>$randomString));
	    }
	} 

	public function share_public_link()
	{

		//Load Email Helper
		$this->load->helper('email');
				
		if($this->input->post()){
			$employee_id = $this->input->post('employee_id');
			$email = $this->input->post('email');

			//Get Employee Details
			$employee_details = $this->employees_model->get_details($employee_id);			
			if(!$employee_details){
				$this->session->set_flashdata('flashError', 'Employee not found.'); 
            	redirect('employees');	
			}
			//End Get Employee Details

			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."-".$expiry_date[1]."-".$expiry_date[0];
			$share_link = $this->input->post('share_link');
			
			$insert_data = array(
				'employee_id' => $employee_id,
				'email' => $email,
				'expiry_date' => $expiry_date,
				'share_link' => $share_link,
				'status' => "active"
			);

			if($this->employees_model->insert_public_share_link($insert_data)){
				//Send Email
				$email_data = array();
				$email_data['user_fullname_en'] = $employee_details['fullname_english'];
				$email_data['user_fullname_ar'] = $employee_details['fullname_arabic'];
				$email_data['share_link'] = $share_link;
				$email_data['expiry_date'] = $this->input->post('expiry_date');

				$message = $this->load->view('email-templates/share-employee-profile-data-link.php', $email_data,  TRUE);
				$to_email = $email;
				$subject = "FMC - Update Profile Details";
				send_email($to_email,$subject,$message);
		
				//Copy Employee Data to company_employees_draft Table
				$this->employees_model->company_employees_to_draft($employee_id);

	        	$this->session->set_flashdata('flashSuccess', 'Public link shared successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Public link shared not successfully.');
	        }
	        redirect('/employees');			
		}else{
			redirect('/employees');
		}
	}

	public function update_share_public_link()
	{
		if($this->input->post()){

			$employee_id = $this->input->post('employee_id');
			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."-".$expiry_date[1]."-".$expiry_date[0];
			$share_link = $this->input->post('share_link');
			
			$update_data = array(
				'id' => $this->input->post('id'),
				'employee_id' => $employee_id,
				'email' => $this->input->post('email'),
				'expiry_date' => $expiry_date,
				'share_link' => $share_link,
				'status' => "active"
			);
			if($this->employees_model->update_public_share_link($update_data)){
	        	$this->session->set_flashdata('flashSuccess', 'Public link updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Public link not update successfully.');
	        }
			redirect('/employees');
		}else{
			redirect('/employees');
		}
	}
	
	

	public function company_employees_create_step_1($id = "")
	{
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		if($this->input->post()){
			
			$profile_pic = "";
			if(isset($_FILES['profile_pic']) && is_uploaded_file($_FILES['profile_pic']['tmp_name'])){

				$file_name = $_FILES['profile_pic']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if( ! $this->upload->do_upload('profile_pic'))
	            {
	                if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
	                	$this->session->set_flashdata('flashdata',$dataArray);
	                	redirect('/employees');
	                }
	            }else{
	            	$profile_pic = $upload_file_name;
	            }
			}
			
			$joining_date = ($this->input->post('joining_date') != "") ? $this->input->post('joining_date') : '00/00/0000';
			$joining_date = explode("/", $joining_date);
			$joining_date = $joining_date[2]."-".$joining_date[1]."-".$joining_date[0];

			$attendance_start_date = ($this->input->post('attendance_start_date') != "") ? $this->input->post('attendance_start_date') : '00/00/0000';
			$attendance_start_date = explode("/", $attendance_start_date);
			$attendance_start_date = $attendance_start_date[2]."-".$attendance_start_date[1]."-".$attendance_start_date[0];
			
			$is_login = ($this->input->post('is_login')) ? 'yes' : 'no';

			$insert_data = array(
				'client_id' => $client_login_id,
				'employee_code' => $this->input->post('employee_code'),
				'fullname_english' => $this->input->post('fullname_english'),
	            'fullname_arabic' => $this->input->post('fullname_arabic'),
	            'email' => $this->input->post('email'),
	            'mobile' => $this->input->post('mobile'),
	            'password' => $this->input->post('password'),
	            'is_login' => $is_login,
	            'joining_date' => $joining_date,
	            'attendance_start_date' => $attendance_start_date,	        	
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			if(!empty($profile_pic)){
				$insert_data['profile_pic'] = $profile_pic;
			}

			if(!empty($this->input->post('id'))){
				$id = base64_decode($this->input->post('id'));

				$details = $this->employees_model->get_details($id);
				if(empty($details)){
					$this->session->set_flashdata('flashError', 'Employee data not found.');
					redirect('/employees');
				}

				if($is_login == "yes"){
					if($details['job_position'] == 0){
						$this->session->set_flashdata('flashError', 'Assign Job-Position to enable login.');
						redirect('employees/company_employees_create_step_1/'.base64_encode($id));	
					}
				}

				$employee_code = $this->employees_model->checkEmployeeCode($this->input->post('employee_code'),$id);

				if($employee_code){
					$this->session->set_flashdata('flashError', 'Employee Code already exist.');
					redirect('employees/company_employees_create_step_1/'.base64_encode($id));
				}

				$insert_data['id'] = $id;
								
				$is_email_exist = $this->employees_model->checkEmail($this->input->post('email'),$id);

				if($is_email_exist){
					$this->session->set_flashdata('flashError', 'Email already exist.');
					redirect('employees/company_employees_create_step_1/'.base64_encode($id));
				}

				$is_updated = $this->employees_model->update($insert_data);

				if($is_updated){
		        	$this->session->set_flashdata('flashSuccess', 'Account Details has been updated successfully.'); 

		        	if($this->input->post('next_btn')){
		        		redirect('/employees/company_employees_create_step_2/'.base64_encode($id));
		        	}else{
		        		redirect('/employees/company_employees_create_step_1/'.base64_encode($id));
		        	}
		        	
		        }else{
		        	$this->session->set_flashdata('flashError', 'Employee has not been update successfully.');
		            redirect('/employees');
		        }

			}else{
				$insert_data['status'] = 'draft';
				//Check Email exist or not
				if($this->employees_model->checkEmail($this->input->post('email'))){
					$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
					$this->session->set_flashdata('flashError', 'Email already exist.');
		        	redirect('/employees/company_employees_create_step_1');
				}

				$employee_code = $this->employees_model->checkEmployeeCode($this->input->post('employee_code'));

				if($employee_code){
					$this->session->set_flashdata('flashError', 'Employee Code already exist.');
					redirect('employees/company_employees_create_step_1');
				}

				$is_inserted = $this->employees_model->insert($insert_data);

				if($is_inserted){					

					$this->session->unset_userdata('fmc_form_data_session');

		        	$this->session->set_flashdata('flashSuccess', 'Employee has been inserted successfully.'); 

		        	if($this->input->post('next_btn')){
		        		redirect('employees/company_employees_create_step_2/'.base64_encode($is_inserted));
		        	}else{
		        		redirect('employees/company_employees_create_step_1/'.base64_encode($is_inserted));
		        	}
		        	
		        }else{
		        	$this->session->set_flashdata('flashError', 'Employee has not been inserted successfully.');
		            redirect('/employees');
		        }
			}

	    }

	    if(!empty($id)){
	    	$data['title'] = "Update Employee";

	    	$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				$data['details'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}

	    }else{
	    	$data['title'] = "Create Employee";
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_1',$data);
		$this->load->view('inc/footer');

	}


	public function company_employees_create_step_2($id = "")
	{
		$data['title'] = "Employee - Positional Information";
		
		if($this->input->post() && !empty($this->input->post('id'))){
			$id = base64_decode($this->input->post('id'));

			$update_data = array(
				'id' => $id,
				'department' => $this->input->post('department'),
				'designation' => $this->input->post('designation'),
				'job_position' => $this->input->post('job_position'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			$is_updated = $this->employees_model->update($update_data);

			if($is_updated){
				//Update JOB Position To Closed
				if(!empty($this->input->post('job_position'))){
					$update_data = array(
						'id' => $this->input->post('job_position'),
			            'status' => 'closed',
			            'modified_at' => date('Y-m-d H:i:s')
			        );
			        $this->job_positions_model->update($update_data);
				}
	        	$this->session->set_flashdata('flashSuccess', 'Positional Information has been updated successfully.'); 

	        	if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_3/'.base64_encode($id));
	        		exit();
	        	}else{
	        		redirect('/employees/company_employees_create_step_2/'.base64_encode($id));
	        		exit();
	        	}	        	
	        }else{
	        	$this->session->set_flashdata('flashError', 'Positional Information has not been update successfully.');
	            redirect('/employees');
	            exit();
	        }
	    }

	    if(!empty($id)){
	    	$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
				$data['designation'] = $this->company_designation_model->get_all($client_login_id);
				$data['job_positions'] = $this->job_positions_model->get_all($client_login_id);
				$data['departments'] = $this->company_departments_model->get_all($client_login_id);

				$data['details'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_2',$data);
		$this->load->view('inc/footer');
	}

	public function company_employees_create_step_3($id = "")
	{
		$data['title'] = "Employee - Personal Information";
		
		if($this->input->post() && !empty($this->input->post('id'))){
			$id = base64_decode($this->input->post('id'));

			$employees_extra_benefits = array();
			foreach($this->input->post('extra_benifit_title') as $key => $value){
				$employees_extra_benefits[] = array(
					'employee_id' => $id,
 					'extra_benifit_title' => $this->input->post('extra_benifit_title')[$key],
					'extra_benifit_number' => $this->input->post('extra_benifit_number')[$key],
					'extra_benifit_note' => $this->input->post('extra_benifit_note')[$key]
				);	
			}

			if(count($employees_extra_benefits) > 0){
				$this->employees_model->remove_employee_benefits($id);
				$this->employees_model->add_employee_benefits($employees_extra_benefits);
			}

			if(isset($_FILES['medical_documents'])){
				foreach ($_FILES['medical_documents']['name'] as $key => $file) {

					$_FILES['document']['name'] = $_FILES['medical_documents']['name'][$key];
          			$_FILES['document']['type'] = $_FILES['medical_documents']['type'][$key];
          			$_FILES['document']['tmp_name'] = $_FILES['medical_documents']['tmp_name'][$key];
          			$_FILES['document']['error'] = $_FILES['medical_documents']['error'][$key];
          			$_FILES['document']['size'] = $_FILES['medical_documents']['size'][$key];

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
		            	
		            }else{
		            	$document_data = array(
		            		'document_type' => 'employee_medical_documents',
		            		'document_file' => $upload_file_name,
		            		'record_id' => $id
		            	);
		            	$this->common_documents_model->insert($document_data);
		            }
				}
			}
		
			$birthdate = "0000-00-00";
			if(!empty($this->input->post('birthdate'))){
				$birthdate = explode("/", $this->input->post('birthdate'));
				$birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
			}

			$medical_expire_date = "0000-00-00";
			if(!empty($this->input->post('medical_expire_date'))){
				$medical_expire_date = explode("/", $this->input->post('medical_expire_date'));
				$medical_expire_date = $medical_expire_date[2]."-".$medical_expire_date[1]."-".$medical_expire_date[0];
			}

			$update_data = array(
				'id' => $id,
	            'personal_email' => $this->input->post('personal_email'),
	            'personal_mobile' => $this->input->post('personal_mobile'),
	            'gender' => $this->input->post('gender'),
	            'nationality' => $this->input->post('nationality'),
	            'employee_country_id' => $this->input->post('employee_country_id'),
	            'passport_number' => $this->input->post('passport_number'),
	            'passport_issue_place' => $this->input->post('passport_issue_place'),
	            'passport_expiry_date' => $this->input->post('passport_expiry_date'),
	            'gosi_number' => $this->input->post('gosi_number'),
	            'id_number' => $this->input->post('id_number'),
	            'birthdate' => $birthdate,
	            'social_status' => $this->input->post('social_status'),
	            'number_of_dependent' => $this->input->post('number_of_dependent'),
	            'religion' => $this->input->post('religion'),
	            'mother_city_address' => $this->input->post('mother_city_address'),
	            'mother_city_city' => $this->input->post('mother_city_city'),
	            'mother_city_state' => $this->input->post('mother_city_state'),
	            'kingdom_po_box' => $this->input->post('kingdom_po_box'),
	            'kingdom_building_no' => $this->input->post('kingdom_building_no'),
	            'kingdom_street_name' => $this->input->post('kingdom_street_name'),
	            'kingdom_region_id' => $this->input->post('kingdom_region_id'),
	            'kingdom_city_id' => $this->input->post('kingdom_city_id'),
	            'kingdom_zipcode' => $this->input->post('kingdom_zipcode'),
	            'bank_name' => $this->input->post('bank_name'),
	            'bank_iban_number' => $this->input->post('bank_iban_number'),
	            'bank_account_number' => $this->input->post('bank_account_number'),
	            'bank_id_number' => $this->input->post('bank_id_number'),
	            'medical_company_name' => $this->input->post('medical_company_name'),
	            'medical_category_id' => $this->input->post('medical_category_id'),
	            'medical_expire_date' => $medical_expire_date,
	            'modified_at' => date('Y-m-d H:i:s')
	        );

			$is_updated = $this->employees_model->update($update_data);

			if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Personal Details has been updated successfully.'); 

	        	if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_4/'.base64_encode($id));
	        	}else{
	        		redirect('/employees/company_employees_create_step_3/'.base64_encode($id));
	        	}
	        	
	        }else{
	        	$this->session->set_flashdata('flashError', 'Personal Details has not been update successfully.');
	            redirect('/employees');
	        }
	        exit(); 
	    }

	    if(!empty($id)){
	    	$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				$data['details'] = $details;
				$data['regions'] = $this->regions_model->get_all();
				$data['cities'] = $this->cities_model->get_all();
				$data['countries'] = $this->countries_model->get_all();
				$data['medical_categories'] = $this->medical_categories_model->get_all();
				$data['details']['medical_documents'] = $this->common_documents_model->get_all('employee_medical_documents',base64_decode($id)); 
				$data['employee_benefits'] = $this->employees_model->get_employee_benefits(base64_decode($id)); 
				
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');	    	
	    }


	    $this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_3',$data);
		$this->load->view('inc/footer');
	}

	public function company_employees_create_step_4($id = "")
	{
		$data['title'] = "Employee - Emergency Contact";		
	
		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));

			$emergency_contacts = array();
			foreach($this->input->post('contact_name') as $key => $value){
				$emergency_contacts[] = array(
					'employee_id' => $id,
 					'contact_name' => $this->input->post('contact_name')[$key],
					'address' => $this->input->post('address')[$key],
					'relationship' => $this->input->post('relationship')[$key],
					'mobile' => $this->input->post('mobile')[$key]
				);	
			}

			$this->employees_model->remove_emergency_contacts($id);
			$is_inserted = $this->employees_model->add_emergency_contacts($emergency_contacts);
			if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Emergency Contacts has been updated successfully.'); 

	        	if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_5/'.base64_encode($id));
	        	}else{
	        		redirect('/employees/company_employees_create_step_4/'.base64_encode($id));
	        	}
	        	
	        }else{
	        	$this->session->set_flashdata('flashError', 'Emergency Contacts has not been update successfully.');
	            redirect('/employees');
	        }
	        exit();
	    }

	    if(!empty($id)){
	    	$details = $this->employees_model->get_details(base64_decode($id));

			if($details){
				$emergency_contacts = $this->employees_model->get_emergenct_contacts(base64_decode($id));

				$data['details'] = $details;
				$data['emergency_contacts'] = $emergency_contacts;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_4',$data);
		$this->load->view('inc/footer');
	}

	public function company_employees_create_step_5($id = "")
	{
		$data['title'] = "Employee - Qualification";		
		
		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));

			$educations = array();
			foreach($this->input->post('specialization') as $key => $value){
				$educations[] = array(
					'employee_id' => $id,
 					'specialization' => $this->input->post('specialization')[$key],
					'institute_name' => $this->input->post('institute_name')[$key],
					'from_year' => $this->input->post('from_year')[$key],
					'to_year' => $this->input->post('to_year')[$key]
				);	
			}

			$this->employees_model->remove_educations($id);
			$is_inserted = $this->employees_model->add_educations($educations);

			if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Education has been updated successfully.'); 

	        	if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_6/'.base64_encode($id));
	        	}else{
	        		redirect('/employees/company_employees_create_step_5/'.base64_encode($id));
	        	}	        	
	        }else{
	        	$this->session->set_flashdata('flashError', 'Education has not been update successfully.');
	            redirect('/employees');
	        }
	        exit();
	    }

	    if(!empty($id)){
	    	$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				$educations = $this->employees_model->get_educations(base64_decode($id));

				$data['details'] = $details;
				$data['educations'] = $educations;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_5',$data);
		$this->load->view('inc/footer');
	}

	public function company_employees_create_step_6($id = "")
	{
		$data['title'] = "Employee - Work Experience";		
		
		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));

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

			$this->employees_model->remove_work_experience($id);
			$is_inserted = $this->employees_model->add_work_experience($work_experience_items);

			if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Work-Experience has been updated successfully.'); 

	        	if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_7/'.base64_encode($id));
	        	}else{
	        		redirect('/employees/company_employees_create_step_6/'.base64_encode($id));
	        	}	        	
	        }else{
	        	$this->session->set_flashdata('flashError', 'Work-Experience has not been update successfully.');
	            redirect('/employees');
	        }
	        exit();
	    }

	    if(!empty($id)){
	    	$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				$work_experience_items = $this->employees_model->get_work_experience(base64_decode($id));

				$data['details'] = $details;
				$data['work_experience_items'] = $work_experience_items;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_6',$data);
		$this->load->view('inc/footer');
	}

	public function company_employees_create_step_7($id = "")
	{
		$data['title'] = "Employee - Leave Details";

		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));

			$workshift_array = array();
			if($this->input->post('sunday')){
				foreach($this->input->post('sunday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'sunday',
						'shift_id' => $value
					);
				}	
			}
			if($this->input->post('monday')){
				foreach($this->input->post('monday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'monday',
						'shift_id' => $value
					);
				}
			}
			if($this->input->post('tuesday')){
				foreach($this->input->post('tuesday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'tuesday',
						'shift_id' => $value
					);
				}
			}
			if($this->input->post('wednesday')){
				foreach($this->input->post('wednesday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'wednesday',
						'shift_id' => $value
					);
				}
			}
			if($this->input->post('thursday')){
				foreach($this->input->post('thursday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'thursday',
						'shift_id' => $value
					);
				}
			}
			if($this->input->post('friday')){
				foreach($this->input->post('friday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'friday',
						'shift_id' => $value
					);
				}
			}
			if($this->input->post('saturday')){
				foreach($this->input->post('saturday') as $key => $value){
					$workshift_array[] = array(
						'employee_id' => $id,
						'day_name' => 'saturday',
						'shift_id' => $value
					);
				}
			}

			$update_data = array(
				'id' => $id,
				'leave_group' => $this->input->post('leave_group'),
				'holiday_group' => $this->input->post('holiday_group'),
				'work_group' => $this->input->post('work_group'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			$is_updated = $this->employees_model->update($update_data);

			if($is_updated){
				if(count($workshift_array) > 0){
					$this->employees_model->remove_workshift($id);
					$this->employees_model->add_workshift($workshift_array);
				}
				

				$this->session->set_flashdata('flashSuccess', 'Leave Details has been updated successfully.'); 

	        	if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_8/'.base64_encode($id));
	        	}else{
	        		redirect('/employees/company_employees_create_step_7/'.base64_encode($id));
	        	}
	        	
	        }else{
	        	$this->session->set_flashdata('flashError', 'Leave Details has not been update successfully.');
	            redirect('/employees');
	        }
	        exit();
		}

		if(!empty($id)){
	    	$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				//company login id
				$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

				$data['leave_types_groups'] = $this->leave_group_model->get_all(base64_decode($company_login_id));
				$data['holiday_groups'] = $this->holidays_group_model->get_all(base64_decode($company_login_id));
				$data['workweek_groups'] = $this->workweek_model->get_all(base64_decode($company_login_id));
				$data['workshift'] = $this->workshift_model->get_all(base64_decode($company_login_id));

				$data['employee_workshift'] = $this->employees_model->get_all_workshift(base64_decode($id));


				$days = array();
				$days[] = "sunday";
				$days[] = "monday";
				$days[] = "tuesday";
				$days[] = "wednesday";
				$days[] = "thursday";
				$days[] = "friday";
				$days[] = "saturday";

				$data['days'] = $days;

				$data['details'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}
			
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

		$this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_7',$data);
		$this->load->view('inc/footer');		
	}

	public function company_employees_create_step_8($id = "")
	{
		$data['title'] = "Employee - Salary Details";

		if($this->input->post()){
			$id = base64_decode($this->input->post('id'));



			$salary_items = array();
			foreach($this->input->post('salary_component_id') as $value){
				$salary_items[] = array(
					'employee_id' => $id,
					'salary_component_id' => $value,
					'salary_amount' => ($this->input->post('salary_amount_'.$value)), 
					'salary_component_value' => ($this->input->post('value_'.$value)) ? $this->input->post('value_'.$value) : '0'
				);
			}

			$update_data = array(
				'id' => $id,
				'annual_ctc' => $this->input->post('annual_ctc'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'modified_at' => date('Y-m-d H:i:s')
	        );

			$is_updated = $this->employees_model->update($update_data);

			if($is_updated){
				$this->session->set_flashdata('flashSuccess', 'Employee Details has been updated successfully.');

				if(count($salary_items) > 0){
					$this->employees_model->remove_salary_components($id);
					$this->employees_model->add_salary_components($salary_items);
			    }

			    if($this->input->post('next_btn')){
	        		redirect('/employees/company_employees_create_step_9/'.base64_encode($id));
	        	}else{
	        		redirect('/employees/company_employees_create_step_8/'.base64_encode($id));
	        	}

			}else{
				$this->session->set_flashdata('flashError', 'Employee Details has not been update successfully.');
		        redirect('/employees');
			}
	        exit();
		}

		if(!empty($id)){
			$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				//company login id
				$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

				$data['details'] = $details;
				
				$data['salary_components_earning'] = $this->salary_components_model->get_all_by_type(base64_decode($company_login_id),'earning');
				$data['salary_components_deduction'] = $this->salary_components_model->get_all_by_type(base64_decode($company_login_id),'deduction');

				$data['employee_salary_components'] = $this->employees_model->get_salary_components(base64_decode($id));
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

		$this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_8',$data);
		$this->load->view('inc/footer');		
	}

	public function company_employees_create_step_9($id = "")
	{
		$data['title'] = "Employee - Personal Documents";

		if(!empty($id)){
			$details = $this->employees_model->get_details(base64_decode($id));
			
			if($details){
				//company login id
				$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
				$data['details'] = $details;
				$data['documents'] = $this->employee_documents_model->get_all(base64_decode($id));
				
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('employees');	
			}
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
	    	redirect('/employees/company_employees_create_step_1');
	    }

		$this->load->view('inc/header',$data);
		$this->load->view('company_employees_create_step_9',$data);
		$this->load->view('inc/footer');	
	}

	public function add_employee_document()
	{
		$employee_id = $this->input->post('employee_id');
		
		if(empty($employee_id)){
			$this->session->set_flashdata('flashError', 'Invalid request.');
			redirect('/employees');
		}

		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}else{
			redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
		}
		
		if($this->input->post()){			

			$issue_date = ($this->input->post('issue_date') != "") ? $this->input->post('issue_date') : '00/00/0000';
			$issue_date = explode("/", $issue_date);
			$issue_date = $issue_date[2]."/".$issue_date[1]."/".$issue_date[0];

			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];

			$insert_data = array(
				'employee_id' => $this->input->post('employee_id'),
	            'title' => $this->input->post('title'),
	        	'description' => $this->input->post('description'),
	        	'issue_date' => $issue_date,
	        	'expiry_date' => $expiry_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			if(!empty($document_file)){
	        	$insert_data['document_file'] = $document_file;
	        }else{
	        	$this->session->set_flashdata('flashSuccess', 'Document in document file not selected.'); 
				redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));	        	
	        }
	        $is_inserted = $this->employee_documents_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Document has been inserted successfully.');
	        	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
	        }else{
	        	$this->session->set_flashdata('flashError', 'Document has not been inserted successfully.');
	        	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
	        }	        
	    }else{
	    	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
	    }	
	}
	
	public function update_employee_document()
	{
		$employee_id = $this->input->post('employee_id');
		
		if(empty($employee_id)){
			$this->session->set_flashdata('flashError', 'Invalid request.');
			redirect('/employees');
		}

		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}
		
		if($this->input->post()){
			$issue_date = ($this->input->post('issue_date') != "") ? $this->input->post('issue_date') : '00/00/0000';
			$issue_date = explode("/", $issue_date);
			$issue_date = $issue_date[2]."/".$issue_date[1]."/".$issue_date[0];

			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];

			$update_data = array(
				'id' => $this->input->post('id'),
				'employee_id' => $this->input->post('employee_id'),
	            'title' => $this->input->post('title'),
	        	'description' => $this->input->post('description'),
	        	'issue_date' => $issue_date,
	        	'expiry_date' => $expiry_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			if(!empty($document_file)){
	        	$update_data['document_file'] = $document_file;
	        }

	        $is_updated = $this->employee_documents_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Document has been updated successfully.');
	        	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
	        }else{
	        	$this->session->set_flashdata('flashError', 'Document has not been updated successfully.');
	        	redirect('/employees/company_employees_create_step_9/'.base64_encode($employee_id));
	        }
	    }else{
	    	redirect('/employees');
	    }
	}

	public function delete_employee_document(){
		$id = $_POST['id'];
        
        $deleted = $this->employee_documents_model->delete($id);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Documents has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Documents has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

	public function get_employee_document_details()
	{
		if($this->input->post()){
			$details = $this->employee_documents_model->get_details($this->input->post('id'));	
			if($details){
				$details['issue_date'] = date('d/m/Y',strtotime($details['issue_date']));
				$details['expiry_date'] = date('d/m/Y',strtotime($details['expiry_date']));
				$response['success'] = 'true';
				$response['data'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Document has not been found.');
				$response['success'] = 'false';
			}			
		}else{
			$response['success'] = 'false';
		}
		echo json_encode($response);
	}

	public function view($id = "")
	{
		$data['title'] = "Employee - View Details";

		if(!empty($id)){
	    	$details = $this->employees_model->get_details_with_join(base64_decode($id));
			
			if($details){
				if($details['request_id'] != 0){
					$request_details = $this->requests_model->get_details($details['request_id']);
					if(!$request_details){
						$this->session->set_flashdata('flashError', 'Invalid Request for employees-confirmation.');
						redirect('/employees');
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

					$data['request_details'] = $request_details;
					$data['request_threads'] = $request_threads;
				}

				//company login id
				$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

				$data['details'] = $details;
								
				$data['all_requests'] = array();
				$data['overtime_requests'] = array();
				$data['leave_requests'] = array();
				$data['business_trip_requests'] = array();
				$data['eccr_requests'] = array();
				$data['general_requests'] = array();
					
				$this->load->view('inc/header',$data);
				$this->load->view('company_employees_view',$data);
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

	public function view_full_profile($id = "")
	{
		$data['title'] = "Employee - View Full Profile";

		if(!empty($id)){
	    	$details = $this->employees_model->get_details_with_join(base64_decode($id));
			
			if($details){
				//company login id
				$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
				$data['emergency_contacts'] = $this->employees_model->get_emergenct_contacts(base64_decode($id));
				$data['educations'] = $this->employees_model->get_educations(base64_decode($id));
				$data['work_experience_items'] = $this->employees_model->get_work_experience(base64_decode($id));

				$data['workshift'] = $this->workshift_model->get_all(base64_decode($company_login_id));

				$data['employee_workshift'] = $this->employees_model->get_all_workshift(base64_decode($id));
				$data['employee_benefits'] = $this->employees_model->get_employee_benefits(base64_decode($id)); 


				$days = array();
				$days[] = "sunday";
				$days[] = "monday";
				$days[] = "tuesday";
				$days[] = "wednesday";
				$days[] = "thursday";
				$days[] = "friday";
				$days[] = "saturday";

				$data['days'] = $days;

				$data['salary_components_earning'] = $this->salary_components_model->get_all_by_type(base64_decode($company_login_id),'earning');
				$data['salary_components_deduction'] = $this->salary_components_model->get_all_by_type(base64_decode($company_login_id),'deduction');

				$data['employee_salary_components'] = $this->employees_model->get_salary_components(base64_decode($id));

				$data['details'] = $details;
				$data['details']['medical_documents'] = $this->common_documents_model->get_all('employee_medical_documents',base64_decode($id)); 
				
				$this->load->view('inc/header',$data);
				$this->load->view('company_employees_view_full_profile',$data);
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

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->employees_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Employee has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Employee has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

	
	public function send_for_approval($id){

		$data['title'] = "Employee - Send For Approval";


		if(!empty($id)){
			
			
			if($this->input->post()){

				//Load Email Helper
				$this->load->helper('email');

				$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

				$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

				$request_data = array(
					'company_id' => $client_login_id,
					'request_type' => 'employee_confirmation',
					'assigned_fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'created_by_fmc' => $fmc_login_user_id,
					'status' => 'in_approval',
					'created_at' => date('Y-m-d H:i:s'),
					'modified_at' => date('Y-m-d H:i:s')
				);
				
				$is_request_inserted = $this->requests_model->insert($request_data);					

				if(!$is_request_inserted){
					$this->session->set_flashdata('flashError', 'Request has not been created successfully.'); 
					redirect('employees/send-for-approval/'.$id);
				}

				/*Create Request Thread*/
				$insert_request_thread_data = array(
					'request_id' => $is_request_inserted,
					'note' => $this->input->post('note'),
					'log_text' => "Request created",
					'fmc_user_id' => $fmc_login_user_id,
					'status' => 'created',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->requests_threads_model->insert($insert_request_thread_data);
				/*End Create Request Thread*/

				$details = $this->employees_model->get_details_with_join(base64_decode($id));
				
				$update_data = array(
					'id' => base64_decode($id),
					'request_id' => $is_request_inserted,
					'modified_at' => date('Y-m-d H:i:s')
				);
				if($details['status'] == 'draft'){
					$update_data['status'] = 'in_approval';
				}

				$is_updated = $this->employees_model->update($update_data);


				$title_en = "Verify ".$details['fullname_english']."'s' details";
				$title_ar = "تحقق ".$details['fullname_arabic']." تفاصيل";

				//Insert Notification
				$notification_data = array(
					'title_en' => $title_en,
					'title_ar' => $title_ar,
					'company_id' => $client_login_id,
					'fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
					'type' => 'employee_confirmation',
					'request_id' => $is_request_inserted,
					'status' => 'unread',
					'created_at' => date('Y-m-d H:i:s')
				);
				$this->notifications_model->insert($notification_data);
				
				//Send Email
				$assigned_fmc_user_id = $this->input->post('assigned_fmc_user_id');
				$assigned_fmc_user_details = $this->user_model->get_details($assigned_fmc_user_id);

				$email_data = array();
				$email_data['user_fullname'] = $assigned_fmc_user_details['first_name']." ".$assigned_fmc_user_details['last_name']." ".$assigned_fmc_user_details['surname'];
				$email_data['is_request_inserted'] = $is_request_inserted;
				$message = $this->load->view('email-templates/employee_confirmation_request.php', $email_data,  TRUE);

				$to_email = $assigned_fmc_user_details['email'];
				$subject = "FMC - ".$title_en;
				send_email($to_email,$subject,$message);

				if($is_updated){
		        	$this->session->set_flashdata('flashSuccess', 'Verifier has been assigned to employees.');
		        }else{
		        	$this->session->set_flashdata('flashError', 'Verifier has not been assigned to employees.'); 
		        }

		        redirect('employees');
		    }

	    	$details = $this->employees_model->get_details_with_join(base64_decode($id));

	    	if($details){
				//company login id
				$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
				$data['emergency_contacts'] = $this->employees_model->get_emergenct_contacts(base64_decode($id));
				$data['educations'] = $this->employees_model->get_educations(base64_decode($id));
				$data['work_experience_items'] = $this->employees_model->get_work_experience(base64_decode($id));

				$data['workshift'] = $this->workshift_model->get_all(base64_decode($company_login_id));

				$data['employee_workshift'] = $this->employees_model->get_all_workshift(base64_decode($id));


				$days = array();
				$days[] = "sunday";
				$days[] = "monday";
				$days[] = "tuesday";
				$days[] = "wednesday";
				$days[] = "thursday";
				$days[] = "friday";
				$days[] = "saturday";

				$data['days'] = $days;

				$data['salary_components_earning'] = $this->salary_components_model->get_all_by_type(base64_decode($company_login_id),'earning');
				$data['salary_components_deduction'] = $this->salary_components_model->get_all_by_type(base64_decode($company_login_id),'deduction');

				$data['employee_salary_components'] = $this->employees_model->get_salary_components(base64_decode($id));

				$data['employee_benefits'] = $this->employees_model->get_employee_benefits(base64_decode($id)); 

				$data['details'] = $details;
				$data['details']['medical_documents'] = $this->common_documents_model->get_all('employee_medical_documents',base64_decode($id)); 

				$this->load->model('user_model');
				$data['fmc_users'] = $this->user_model->get_all();
				
				$this->load->view('inc/header',$data);
				$this->load->view('company_employees_send_for_approval',$data);
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



	

}
