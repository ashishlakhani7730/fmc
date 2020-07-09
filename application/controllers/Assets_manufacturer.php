<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets_manufacturer extends MY_Controller {

	public function __construct() 
	{
        parent::__construct();  
        
        $this->load->model('assets_type_model');
        $this->load->model('assets_manufacturer_model');
        $this->load->model('assets_item_model');
        $this->load->model('assets_assign_model');        
        $this->load->model('clients_model');
        $this->load->library('upload');


        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index($tab="")
	{
		
		$data['title'] = "Manufacturer Management";
		$data['current_tab'] = ($tab != "") ? $tab : 'assets-manufacturer';

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


	function get_assets_manufacturer(){
		if($this->input->post()){
			
			$assets_manufacturer_data = $this->assets_manufacturer_model->get_details($this->input->post('id'));

			if($assets_manufacturer_data){

				$data['success'] = "true";				
				$data['data'] = $assets_manufacturer_data;				
			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

	public function create(){
		
		if($this->input->post()){

			//company login id
			$company_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

			$insert_data = array(
				'company_id' => $company_login_id,
	            'name' => $this->input->post('name'),
	            'note' => $this->input->post('note'),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
	        
	        $is_inserted = $this->assets_manufacturer_model->insert($insert_data);

	        if($is_inserted){	        	
	        	
	        	$this->session->set_flashdata('flashSuccess', 'Manufacturer has been inserted successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Manufacturer has not been inserted successfully.');
	        }	        
	        redirect('/assets_manufacturer');

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/assets_manufacturer');
	    }

	}

	public function update(){
		
		if($this->input->post()){

			$update_data = array(
				'id' => $this->input->post('id'),
	            'name' => $this->input->post('name'),
	            'note' => $this->input->post('note'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->assets_manufacturer_model->update($update_data);

	        if($is_updated){
	        	
	        	$this->session->set_flashdata('flashSuccess', 'Manufacturer has been updated successfully.');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Manufacturer has not been updated successfully.');
	        }	        
	        redirect('/assets_manufacturer');

	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request');
	    	redirect('/assets_manufacturer');
	    }

	}

	public function delete($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->assets_manufacturer_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Manufacturer has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Manufacturer has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	
}
