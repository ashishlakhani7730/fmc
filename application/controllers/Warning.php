<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warning extends MY_Controller {

	public function __construct() 
	{
        parent::__construct();  
        $this->load->model('warning_categories_model');
        $this->load->model('warning_model');
        $this->load->model('employees_model');
        $this->load->model('common_documents_model');

        $this->load->library('upload');
        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
        $data['title'] = "Employee Warning";
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
		
		$data['warning_list'] = $this->warning_model->get_all(base64_decode($company_login_id));
		$this->load->view('inc/header',$data);
		$this->load->view('warning',$data);
		$this->load->view('inc/footer');
    }

    public function create(){
		
		$data['title'] = "Warning - Create new";
		$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		if($this->input->post()){
			
            $date_time = ($this->input->post('date_time') != "") ? $this->input->post('date_time') : '00/00/0000';
			$insert_data = array(
				'company_id' => $company_login_id,
	            'employee_id' => $this->input->post('employee_id'),
	            'warning_category_id' => $this->input->post('warning_category_id'),
	            'title' => $this->input->post('title'),
	            'date_time' => date('Y-m-d H:i:s',strtotime($date_time)),
	            'description' => $this->input->post('description'),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s')
	        );
            $is_inserted = $this->warning_model->insert($insert_data);
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
			            		'document_type' => 'employee_warning',
			            		'document_file' => $upload_file_name,
			            		'record_id' => $is_inserted
                            );
                            $this->common_documents_model->insert($document_data);
			            }
					}
				}

	        	$this->session->set_flashdata('flashSuccess', 'Warning created successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Warning has not created successfully.');
	        }
	        exit();
	    }

	    $data['categories'] = $this->warning_categories_model->get_all();
        $data['employees'] = $this->employees_model->get_all($company_login_id);
        
	    $this->load->view('inc/header',$data);
		$this->load->view('warning_create',$data);
		$this->load->view('inc/footer');
    }

    public function update($employee_warning_id = "")
	{
		$data['title'] = "Assets - Update Assigned Item";
		$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		if($this->input->post()){			
			
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
		            		'document_type' => 'employee_warning',
		            		'document_file' => $upload_file_name,
		            		'record_id' => base64_decode($employee_warning_id)
		            	);
		            	$this->common_documents_model->insert($document_data);
		            }
				}
			}

			$date_time = ($this->input->post('date_time') != "") ? $this->input->post('date_time') : '00/00/0000';
			$update_data = array(
                'employee_warning_id'=> base64_decode($employee_warning_id),
				'company_id' => base64_decode($company_login_id),
	            'employee_id' => $this->input->post('employee_id'),
	            'warning_category_id' => $this->input->post('warning_category_id'),
	            'title' => $this->input->post('title'),
	            'date_time' => date('Y-m-d H:i:s',strtotime($date_time)),
	            'description' => $this->input->post('description'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->warning_model->update($update_data);

            if($is_updated){
	        	
	        	$this->session->set_flashdata('flashSuccess', 'Employee warning has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Employee warning has not been updated successfully.');
	        }	        
	        exit();
	    }

        $details = $this->warning_model->get_details(base64_decode($employee_warning_id));
        
		if(!$details){
			$this->session->set_flashdata('flashError', 'Employee Warning not found.');
			redirect('/warning');
		}

		$details['documents'] = $this->common_documents_model->get_all('employee_warning',base64_decode($employee_warning_id)); //get uploaded documents		
	    $data['categories'] = $this->warning_categories_model->get_all();
        $data['employees'] = $this->employees_model->get_all($company_login_id);
        $data['details'] = $details;
        
	    $this->load->view('inc/header',$data);
		$this->load->view('warning_update',$data);
		$this->load->view('inc/footer');
    }
    
    public function delete_document(){
		$id = $_POST['id'];

		$data = array();
		$details = $this->common_documents_model->get_details($id);
		if($details){
			unlink('uploads/'.$details['document_file']);
			$this->common_documents_model->delete($id);			
			echo '1';exit;
		}else{
			echo '0';exit;
		}
    }
    
    public function delete($employee_warning_id = ""){
		$employee_warning_id = $_POST['employee_warning_id'];
        $status = $_POST['status'];
        $update_array = array('employee_warning_id'=> $employee_warning_id, 'status'=> $status,'modified_at' => date("Y-m-d H:i:s"));
        $deleted = $this->warning_model->update($update_array);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Employee Warning has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Employee Warning has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

}