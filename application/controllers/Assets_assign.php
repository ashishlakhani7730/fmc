<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets_assign extends MY_Controller {

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
        $this->load->model('assets_type_model');
        $this->load->model('assets_manufacturer_model');
        $this->load->model('assets_item_model');
        $this->load->model('assets_assign_model');
        $this->load->model('employees_model');
        $this->load->model('common_documents_model');
        

        $this->load->library('upload');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index($tab="")
	{	
		$data['title'] = "Assets Assign";
		$data['current_tab'] = ($tab != "") ? $tab : 'assigned-assets';

		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
		
		$assets_type = $this->assets_type_model->get_all(base64_decode($company_login_id));
		$assets_item = $this->assets_item_model->get_all(base64_decode($company_login_id));
		$assets_manufacturer = $this->assets_manufacturer_model->get_all(base64_decode($company_login_id));
		$assets_assign = $this->assets_assign_model->get_all(base64_decode($company_login_id));

		$data['assets_type'] = $assets_type;
		$data['assets_item'] = $assets_item;
		$data['assets_manufacturer'] = $assets_manufacturer;
		$data['assets_assign'] = $assets_assign;		
		
		$this->load->view('inc/header',$data);
		$this->load->view('assets',$data);
		$this->load->view('inc/footer');		
	}

	function get_assets_assign(){
		if($this->input->post()){
			
			$assets_assign_data = $this->assets_assign_model->get_details($this->input->post('id'));

			if($assets_assign_data){

				$data['success'] = "true";				
				$data['data'] = $assets_assign_data;				
			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

	public function create(){
		
		$data['title'] = "Assets - Create new item";
		$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		
		if($this->input->post()){
			
			$assign_date = ($this->input->post('assign_date') != "") ? $this->input->post('assign_date') : '00/00/0000';
			$assign_date = explode("/", $assign_date);
			$assign_date = $assign_date[2]."/".$assign_date[1]."/".$assign_date[0];
			
			$insert_data = array(
				'company_id' => $company_login_id,
	            'employee_id' => $this->input->post('employee_id'),
	            'assets_item_id' => $this->input->post('assets_item_id'),
	            'conditions' => $this->input->post('conditions'),
	            'assign_date' => $assign_date,
	            'note' => $this->input->post('note'),
	            'is_return' => 'no',
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
	        
	        $is_inserted = $this->assets_assign_model->insert($insert_data);
	        if($is_inserted){

	        	$update_data = array(
	        		'id' => $this->input->post('assets_item_id'),
	        		'status_assign' => 'yes',
	        		'modified_at' => date('Y-m-d H:i:s')
	        	);
	        	$this->assets_item_model->update($update_data);

	        	
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
			            		'document_type' => 'assets_item_assign',
			            		'document_file' => $upload_file_name,
			            		'record_id' => $is_inserted
			            	);
			            	$this->common_documents_model->insert($document_data);
			            }
					}
				}

	        	$this->session->set_flashdata('flashSuccess', 'Assets assign has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Assets assign has not been inserted successfully.');
	        }
	        exit();
	    }

	    $data['assets_item'] = $this->assets_item_model->get_all($company_login_id);
	    $data['employees'] = $this->employees_model->get_all($company_login_id);

	    $this->load->view('inc/header',$data);
		$this->load->view('assets_assign_create',$data);
		$this->load->view('inc/footer');
	}

	public function update($id = "")
	{
		$data['title'] = "Assets - Update Assigned Item";
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

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
		            		'document_type' => 'assets_item_assign',
		            		'document_file' => $upload_file_name,
		            		'record_id' => base64_decode($id)
		            	);
		            	$this->common_documents_model->insert($document_data);
		            }
				}
			}

			$assign_date = ($this->input->post('assign_date') != "") ? $this->input->post('assign_date') : '00/00/0000';
			$assign_date = explode("/", $assign_date);
			$assign_date = $assign_date[2]."/".$assign_date[1]."/".$assign_date[0];
			
			$update_data = array(
				'id' => base64_decode($id),
	            'employee_id' => $this->input->post('employee_id'),
	            'assets_item_id' => $this->input->post('assets_item_id'),
	            'conditions' => $this->input->post('conditions'),
	            'assign_date' => $assign_date,
	            'note' => $this->input->post('note'),
	            'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->assets_assign_model->update($update_data);

	        if($is_updated){
	        	
	        	$this->session->set_flashdata('flashSuccess', 'Assets assign has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Assets assign has not been updated successfully.');
	        }	        
	        exit();
	    }

	    $details = $this->assets_assign_model->get_details(base64_decode($id));

		if(!$details){
			$this->session->set_flashdata('flashError', 'Assets assign not found.');
			redirect('/assets-assign');
		}

		$details['documents'] = $this->common_documents_model->get_all('assets_item_assign',base64_decode($id)); //get uploaded documents		

	    $data['assets_item'] = $this->assets_item_model->get_all(base64_decode($company_login_id));

	    $data['employees'] = $this->employees_model->get_all(base64_decode($company_login_id));
	    $data['details'] = $details;

	    $this->load->view('inc/header',$data);
		$this->load->view('assets_assign_update',$data);
		$this->load->view('inc/footer');
	}

	public function delete_assets_assign($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->assets_assign_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Assets assign has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Assets assign has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

}
