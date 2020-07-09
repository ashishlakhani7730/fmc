<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets extends MY_Controller {

	public function __construct() 
	{
        parent::__construct();  
        $this->load->model('assets_type_model');
        $this->load->model('assets_manufacturer_model');
        $this->load->model('assets_item_model');
        $this->load->model('assets_assign_model');
        $this->load->model('clients_model');
        $this->load->model('employees_model');

        $this->load->library('upload');
		
		
        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index($tab="")
	{		
		$data['title'] = "Assets Management";
		$data['current_tab'] = ($tab != "") ? $tab : 'assets-type';

		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
		
		$assets_type = $this->assets_type_model->get_all(base64_decode($company_login_id));
		$assets_item = $this->assets_item_model->get_all(base64_decode($company_login_id));
		$assets_manufacturer = $this->assets_manufacturer_model->get_all(base64_decode($company_login_id));
		$assets_assign = $this->assets_assign_model->get_all(base64_decode($company_login_id));		
		$employees = $this->employees_model->get_all(base64_decode($company_login_id));
	
		
		$data['employees'] = $employees;
		$data['assets_type'] = $assets_type;
		$data['assets_item'] = $assets_item;
		$data['assets_manufacturer'] = $assets_manufacturer;
		$data['assets_assign'] = $assets_assign;		

		$this->load->view('inc/header',$data);
		$this->load->view('assets',$data);
		$this->load->view('inc/footer');		
	}

	function get_assets_type(){
		if($this->input->post()){
			
			$assets_type_data = $this->assets_type_model->get_details($this->input->post('id'));

			if($assets_type_data){

				$data['success'] = "true";				
				$data['data'] = $assets_type_data;				
			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

	public function create_assets_type(){
		if($this->input->post()){
			//company login id
			$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

			$insert_data = array(
				'company_id' => $company_login_id,
	            'name' => $this->input->post('name'),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
	        
	        $is_inserted = $this->assets_type_model->insert($insert_data);

	        if($is_inserted){	        	
	        	
	        	$this->session->set_flashdata('flashSuccess', 'Assets Type has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Assets Type has not been inserted successfully.');
	        }	        
	        redirect('/assets-management');
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/assets-management');
	    }
	}

	public function update_assets_type(){		
		if($this->input->post()){
			$update_data = array(
				'id' => $this->input->post('id'),
	            'name' => $this->input->post('name'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->assets_type_model->update($update_data);

	        if($is_updated){
	        	
	        	$this->session->set_flashdata('flashSuccess', 'Assets Type has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Assets Type has not been updated successfully.');
	        }	        
	        redirect('/assets-management');
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/assets-management');
	    }
	}
	
	public function delete_assets_type($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->assets_type_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Assets Type has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Assets Type has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

	
}
