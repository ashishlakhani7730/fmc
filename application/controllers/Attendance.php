<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class attendance extends MY_Controller {

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
        $this->load->library('excel');

        if (!defined('CAL_GREGORIAN')){
        	define('CAL_GREGORIAN', 1);	
        }
		


		$this->load->model('employees_model');
		$this->load->model('attendance_model');
		$this->load->model('company_designation_model');
		$this->load->model('company_departments_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
        	$this->session->set_flashdata('flashError', 'Please Login to Continue');
        	redirect('/');
        }
	}

	public function index($tab="")
	{
		$data['title'] = "Manage Attendance";
		//company login id
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		if($this->session->userdata('attendance_year')){
			$year = $this->session->userdata('attendance_year');
		}else{
			$year = date('Y');
		}

		if($this->session->userdata('attendance_month')){
			$month = $this->session->userdata('attendance_month');
		}else{
			$month = date('m');
		}

		$month_days = date('t', mktime(0, 0, 0, $month, 1, date('Y'))); 
		//$month_days = cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));

		if($year > date('Y')){
			$this->session->set_flashdata('flashError',"Year should not greater than current-year");
			$this->session->unset_userdata('attendance_month');
			$this->session->unset_userdata('attendance_year');
        	redirect('/attendance');
		}

		if($year == date('Y') && $month > date('m')){
			$this->session->set_flashdata('flashError',"Month should not greater than current-month");
			$this->session->unset_userdata('attendance_month');
			$this->session->unset_userdata('attendance_year');
        	redirect('/attendance');
		}
		
		$employee_filter_array = array();
		if($this->session->userdata('attendance_department')){
			$attendance_department = $this->session->userdata('attendance_department');
			$employee_filter_array['department'] = $attendance_department;
			$data['attendance_department'] = $attendance_department;
		}
		if($this->session->userdata('attendance_designation')){
			$attendance_designation = $this->session->userdata('attendance_designation');
			$employee_filter_array['designation'] = $attendance_designation;
			$data['attendance_designation'] = $attendance_designation;
		}				
			
		$data['items'] = $this->attendance_model->get_all($client_login_id,$year,$month,$employee_filter_array);

		$data['year'] = $year;
		$data['month'] = $month;
		$data['month_days'] = $month_days;

		$data['departments'] = $this->company_departments_model->get_all($client_login_id);
		$data['designation'] = $this->company_designation_model->get_all($client_login_id);

		$this->load->view('inc/header',$data);
		$this->load->view('attendance',$data);
		$this->load->view('inc/footer');
	}
	
	public function import_excel(){
    	ini_set('memory_limit', '2048M');

    	$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		if(isset($_FILES['excel_file']) && is_uploaded_file($_FILES['excel_file']['tmp_name'])){

			$month = $_POST['month'];
			$year = $_POST['year'];
			$month_days = date('t', mktime(0, 0, 0, $month, 1, date('Y'))); 
			//$month_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
			
			if($this->attendance_model->is_company_attendance_exist($client_login_id,$year,$month)){
				$this->session->set_flashdata('flashError',"Attendance already added for ".$month."-".$year);
				redirect('/attendance');	
			}

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
                	redirect('/attendance');
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
	                redirect('/attendance');
	            }

	            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);	           
	           

	            $createArray = array('Employee Code', '1', '2', '3', '4', '5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

	            $makeArray['Employee Code'] = 'Employee Code';
	            for ($i=1; $i <= $month_days; $i++) { 
	            	$makeArray[$i] = $i;
	            }
	            
	            $makeArray = array(
	            	'Employee Code' => 'Employee Code', 
	            	'1' => '1', 
	            	'2' => '2', 
	            	'3' => '3', 
	            	'4' => '4', 
	            	'5' => '5', 
	            	'6' => '6', 
	            	'7' => '7', 
	            	'8' => '8', 
	            	'9' => '9', 
	            	'10' => '10', 
	            	'11' => '11', 
	            	'12' => '12', 
	            	'13' => '13', 
	            	'14' => '14', 
	            	'15' => '15', 
	            	'16' => '16', 
	            	'17' => '17', 
	            	'18' => '18', 
	            	'19' => '19', 
	            	'20' => '20', 
	            	'21' => '21', 
	            	'22' => '22', 
	            	'23' => '23', 
	            	'24' => '24', 
	            	'25' => '25', 
	            	'26' => '26', 
	            	'27' => '27', 
	            	'28' => '28', 
	            	'29' => '29', 
	            	'30' => '30', 
	            	'31' => '31'
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
	                    $Day_1 = $SheetDataKey['1'];
	                    $Day_2 = $SheetDataKey['2'];
	                    $Day_3 = $SheetDataKey['3'];
	                    $Day_4 = $SheetDataKey['4'];
	                    $Day_5 = $SheetDataKey['5'];
	                    $Day_6 = $SheetDataKey['6'];
	                    $Day_7 = $SheetDataKey['7'];
	                    $Day_8 = $SheetDataKey['8'];
	                    $Day_9 = $SheetDataKey['9'];
	                    $Day_10 = $SheetDataKey['10'];
	                    $Day_11 = $SheetDataKey['11'];
	                    $Day_12 = $SheetDataKey['12'];
	                    $Day_13 = $SheetDataKey['13'];
	                    $Day_14 = $SheetDataKey['14'];
	                    $Day_15 = $SheetDataKey['15'];
	                    $Day_16 = $SheetDataKey['16'];
	                    $Day_17 = $SheetDataKey['17'];
	                    $Day_18 = $SheetDataKey['18'];
	                    $Day_19 = $SheetDataKey['19'];
	                    $Day_20 = $SheetDataKey['20'];
	                    $Day_21 = $SheetDataKey['21'];
	                    $Day_22 = $SheetDataKey['22'];
	                    $Day_23 = $SheetDataKey['23'];
	                    $Day_24 = $SheetDataKey['24'];
	                    $Day_25 = $SheetDataKey['25'];
	                    $Day_26 = $SheetDataKey['26'];
	                    $Day_27 = $SheetDataKey['27'];
	                    $Day_28 = $SheetDataKey['28'];
	                    $Day_29 = $SheetDataKey['29'];
	                    $Day_30 = $SheetDataKey['30'];
	                    $Day_31 = $SheetDataKey['31'];


	                    $Employee_Code = filter_var(trim($allDataInSheet[$i][$Employee_Code]), FILTER_SANITIZE_STRING);
	                    $Day_1 = filter_var(trim($allDataInSheet[$i][$Day_1]), FILTER_SANITIZE_STRING);
	                    $Day_2 = filter_var(trim($allDataInSheet[$i][$Day_2]), FILTER_SANITIZE_STRING);
	                    $Day_3 = filter_var(trim($allDataInSheet[$i][$Day_3]), FILTER_SANITIZE_STRING);
	                    $Day_4 = filter_var(trim($allDataInSheet[$i][$Day_4]), FILTER_SANITIZE_STRING);
	                    $Day_5 = filter_var(trim($allDataInSheet[$i][$Day_5]), FILTER_SANITIZE_STRING);
	                    $Day_6 = filter_var(trim($allDataInSheet[$i][$Day_6]), FILTER_SANITIZE_STRING);
	                    $Day_7 = filter_var(trim($allDataInSheet[$i][$Day_7]), FILTER_SANITIZE_STRING);
	                    $Day_8 = filter_var(trim($allDataInSheet[$i][$Day_8]), FILTER_SANITIZE_STRING);
	                    $Day_9 = filter_var(trim($allDataInSheet[$i][$Day_9]), FILTER_SANITIZE_STRING);
	                    $Day_10 = filter_var(trim($allDataInSheet[$i][$Day_10]), FILTER_SANITIZE_STRING);
	                    $Day_11 = filter_var(trim($allDataInSheet[$i][$Day_11]), FILTER_SANITIZE_STRING);
	                    $Day_12 = filter_var(trim($allDataInSheet[$i][$Day_12]), FILTER_SANITIZE_STRING);
	                    $Day_13 = filter_var(trim($allDataInSheet[$i][$Day_13]), FILTER_SANITIZE_STRING);
	                    $Day_14 = filter_var(trim($allDataInSheet[$i][$Day_14]), FILTER_SANITIZE_STRING);
	                    $Day_15 = filter_var(trim($allDataInSheet[$i][$Day_15]), FILTER_SANITIZE_STRING);
	                    $Day_16 = filter_var(trim($allDataInSheet[$i][$Day_16]), FILTER_SANITIZE_STRING);
	                    $Day_17 = filter_var(trim($allDataInSheet[$i][$Day_17]), FILTER_SANITIZE_STRING);
	                    $Day_18 = filter_var(trim($allDataInSheet[$i][$Day_18]), FILTER_SANITIZE_STRING);
	                    $Day_19 = filter_var(trim($allDataInSheet[$i][$Day_19]), FILTER_SANITIZE_STRING);
	                    $Day_20 = filter_var(trim($allDataInSheet[$i][$Day_20]), FILTER_SANITIZE_STRING);
	                    $Day_21 = filter_var(trim($allDataInSheet[$i][$Day_21]), FILTER_SANITIZE_STRING);
	                    $Day_22 = filter_var(trim($allDataInSheet[$i][$Day_22]), FILTER_SANITIZE_STRING);
	                    $Day_23 = filter_var(trim($allDataInSheet[$i][$Day_23]), FILTER_SANITIZE_STRING);
	                    $Day_24 = filter_var(trim($allDataInSheet[$i][$Day_24]), FILTER_SANITIZE_STRING);
	                    $Day_25 = filter_var(trim($allDataInSheet[$i][$Day_25]), FILTER_SANITIZE_STRING);
	                    $Day_26 = filter_var(trim($allDataInSheet[$i][$Day_26]), FILTER_SANITIZE_STRING);
	                    $Day_27 = filter_var(trim($allDataInSheet[$i][$Day_27]), FILTER_SANITIZE_STRING);
	                    $Day_28 = filter_var(trim($allDataInSheet[$i][$Day_28]), FILTER_SANITIZE_STRING);
	                    $Day_29 = filter_var(trim($allDataInSheet[$i][$Day_29]), FILTER_SANITIZE_STRING);
	                    $Day_30 = filter_var(trim($allDataInSheet[$i][$Day_30]), FILTER_SANITIZE_STRING);
	                    $Day_31 = filter_var(trim($allDataInSheet[$i][$Day_31]), FILTER_SANITIZE_STRING);

	                    $is_employee_found = $this->attendance_model->get_employee_by_empcode($Employee_Code);

	                    if($is_employee_found){
	                    	$employee_id = $is_employee_found['id'];
	                    	$employee_id = $is_employee_found['id'];

	                    	$tem_insert_data = array(
								'company_id' => $client_login_id,
								'employee_id' => $employee_id,
								'fullname_english' => $is_employee_found['fullname_english'],
								'fullname_arabic' => $is_employee_found['fullname_arabic'],
								'year' => $year,
								'month' => $month,
	                    		'date_1' => $Day_1,
								'date_2' => $Day_2,
								'date_3' => $Day_3,
								'date_4' => $Day_4,
								'date_5' => $Day_5,
								'date_6' => $Day_6,
								'date_7' => $Day_7,
								'date_8' => $Day_8,
								'date_9' => $Day_9,
								'date_10' => $Day_10,
								'date_11' => $Day_11,
								'date_12' => $Day_12,
								'date_13' => $Day_13,
								'date_14' => $Day_14,
								'date_15' => $Day_15,
								'date_16' => $Day_16,
								'date_17' => $Day_17,
								'date_18' => $Day_18,
								'date_19' => $Day_19,
								'date_20' => $Day_20,
								'date_21' => $Day_21,
								'date_22' => $Day_22,
								'date_23' => $Day_23,
								'date_24' => $Day_24,
								'date_25' => $Day_25,
								'date_26' => $Day_26,
								'date_27' => $Day_27,
								'date_28' => $Day_28,
								'date_29' => $Day_29,
								'date_30' => $Day_30,
								'date_31' => $Day_31
							);	                    	
							$insert_batch_data[] = $tem_insert_data;
	                    }	                    
	                }
	               

	                $data['month'] = $month;
	                $data['year'] = $year;
	                $data['month_days'] = $month_days;
	                $data['employees'] = $insert_batch_data;

	                $this->load->view('inc/header',$data);
					$this->load->view('attendance_import_excel',$data);
					$this->load->view('inc/footer');

	            }else{
	            	$this->session->set_flashdata('flashError','Invalid excel format');
            		redirect('/attendance');
	            }	          
            }
		}else{
			$this->session->set_flashdata('flashError','Please upload excel file');
            redirect('/attendance');
		}
	}

	public function update($id = "")
	{
		if($this->input->post()){
			$attendance_document_id = $this->input->post('attendance_document_id');
			$attendance_id = $this->input->post('attendance_id');
	        $attendance_day = $this->input->post('attendance_day');
	        $attendance_status = $this->input->post('attendance_status');
	        $description = $this->input->post('description');

	        $date = ($this->input->post('date') != "") ? $this->input->post('date') : '00/00/0000';
			$date = explode("/", $date);
			$date = $date[2]."-".$date[1]."-".$date[0];

	        $document = "";
			if(isset($_FILES['document']) && is_uploaded_file($_FILES['document']['tmp_name'])){

				$file_name = $_FILES['document']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg|doc|docx|pdf';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if( ! $this->upload->do_upload('document'))
	            {
	                if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
	                	$this->session->set_flashdata('flashdata',$dataArray);
	                	redirect('/attendance');
	                }
	            }else{
	            	$document = $upload_file_name;
	            }
			}

	        $data = array(
	        	'id' => $attendance_id
	        );

	        $data["date_".$attendance_day] = $attendance_status;

	        $is_updated = $this->attendance_model->update($data);

	        if($is_updated){

	        	if($description != "" || $document != ""){
	        		$data = array(
	        			'attendance_id' => $attendance_id,
	        			'date' => $date,	        			
	        			'description' => $description
	        		);
	        		if(!empty($document)){
	        			$data['document'] = $document;
	        		}
	        		if(!empty($attendance_document_id)){
	        			$data['id'] = $attendance_document_id;
	        			$this->attendance_model->update_attendance_document($data);	
	        		}else{
	        			$this->attendance_model->insert_attendance_document($data);	
	        		}
	        	}

	        	$this->session->set_flashdata('flashSuccess', 'Attendance has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashSuccess', 'Department has not been updated successfully.'); 
	        }
	        redirect('/attendance');
        }else{
	    	redirect('/attendance');
	    }
	}

	function get_attendance_document(){
		if($this->input->post()){
			$attendance_id = $this->input->post('attendance_id');
			
			$date = ($this->input->post('date') != "") ? $this->input->post('date') : '00/00/0000';
			$date = explode("/", $date);
			$date = $date[2]."-".$date[1]."-".$date[0];

			$attendance_doc = $this->attendance_model->get_attendance_doc_details($attendance_id,$date);

			if($attendance_doc){

				$data['success'] = "true";				
				$data['data'] = $attendance_doc;				

			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

	public function set_filter_session(){
		if($this->input->post()){
			$attendance_month = $this->input->post('attendance_month');
			$attendance_year = $this->input->post('attendance_year');
			$designation = $this->input->post('designation');
			$department = $this->input->post('department');
			
			$this->session->set_userdata('attendance_month',$attendance_month);
			$this->session->set_userdata('attendance_year',$attendance_year);
			if(!empty($designation)){
				$this->session->set_userdata('attendance_designation',$designation);
			}else{
				$this->session->unset_userdata('attendance_designation');
			}
			if(!empty($department)){
				$this->session->set_userdata('attendance_department',$department);
			}else{
				$this->session->unset_userdata('attendance_department');
			}
			$data['success'] = "true";
		}else{
	    	$data['success'] = "false";
	    }
	    echo json_encode($data);
	}
	
	public function add(){
		$data['title'] = "Add Attendance";
		//company login id
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['year'] = date('Y');
		$data['month'] = date('m');

		$data['departments'] = $this->company_departments_model->get_all($client_login_id);
		$data['designation'] = $this->company_designation_model->get_all($client_login_id);

		$this->load->view('inc/header',$data);
		$this->load->view('attendance_add',$data);
		$this->load->view('inc/footer');	
	}

	public function confirm(){
		if($this->input->post()){
			$data['title'] = "Confirm Attendance";
			//company login id
			$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

			$attendance_month = ($this->input->post('month')) ? $this->input->post('month') : "";
			$attendance_year = ($this->input->post('year')) ? $this->input->post('year') : "";
			
			if(empty($attendance_month)){
				$this->session->set_flashdata('flashError',"Month should not blank.");
				redirect('/attendance');
			}

			if(empty($attendance_year)){
				$this->session->set_flashdata('flashError',"Year should not blank.");
				redirect('/attendance');
			}

			if($this->attendance_model->is_company_attendance_exist($client_login_id,$attendance_year,$attendance_month)){
				$this->session->set_flashdata('flashError',"Attendance already added for ".$attendance_month."-".$attendance_year);
				redirect('/attendance/add');	
			}

			$data['year'] = $attendance_year;
			$data['month'] = $attendance_month;
			$data['month_days'] = date('t', mktime(0, 0, 0, $attendance_month, 1, $attendance_year)); 
			//$data['month_days'] = cal_days_in_month(CAL_GREGORIAN,$attendance_month,$attendance_year);

			$data['employees'] = $this->attendance_model->get_employee_with_full_details($client_login_id,$attendance_month,$attendance_year);

			$this->load->view('inc/header',$data);
			$this->load->view('attendance_add_confirm',$data);
			$this->load->view('inc/footer');
		}else{
			redirect('/');
		}		
	}
	
	public function save_data(){

		if($this->input->post()){
			$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

			$employees = $this->input->post('employee_id');
			$attendance_month = ($this->input->post('attendance_month')) ? $this->input->post('attendance_month') : "";
			$attendance_year = ($this->input->post('attendance_year')) ? $this->input->post('attendance_year') : "";
			if(empty($attendance_month)){
				$this->session->set_flashdata('flashError', 'Attendance month should not blank');
				redirect('attendance/add');
			}
			if(empty($attendance_year)){
				$this->session->set_flashdata('flashError', 'Attendance year should not blank');
				redirect('attendance/add');
			}
			$today = date('Y-m-d H:i:s');
			$attendance_array = array();
			foreach ($employees as $value) {
				$blank_arry = array();
				$blank_arry['company_id'] = $client_login_id;
				$blank_arry['employee_id'] = $value;
				$blank_arry['year'] = $attendance_year;
				$blank_arry['month'] = $attendance_month;
				$blank_arry['created_at'] = $today;
				$blank_arry['modified_at'] = $today;

				$month_days = date('t', mktime(0, 0, 0, $attendance_month, 1, $attendance_year)); 
				//$month_days = cal_days_in_month(CAL_GREGORIAN,$attendance_month,$attendance_year);
				for ($i=1; $i <= $month_days; $i++) { 
					$date_field = "date_".$i;
					if(isset($_POST[$value.'-'.$date_field])){
						$attendance_value = $_POST[$value.'-'.$date_field];
					}else{
						$attendance_value = "";
					}   
					$blank_arry[$date_field] = $attendance_value;
                }
                $attendance_array[] = $blank_arry;
			}

			if($this->attendance_model->insert_batch_data($attendance_array)){
				$this->session->set_flashdata('flashSuccess','Attendance added successfully.');
			}else{				
				$this->session->set_flashdata('flashError','Attendance not added successfully.');
			}	
			redirect('attendance');		
		}else{
			redirect('/');
		}
		exit();
	}
}
