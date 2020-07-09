<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salarycomponents extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('salary_components_model');

		if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index($tab="")
	{
		$data['title'] = "Salary Components";

		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];	
				
		$data['items'] = $this->salary_components_model->get_all(base64_decode($company_login_id));
		
		$this->load->view('inc/header',$data);
		$this->load->view('salary_components',$data);
		$this->load->view('inc/footer');		
	}

	public function create($tab="")
	{
		$data['title'] = "Create Salary Components";
		
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
	        	$this->session->set_flashdata('flashSuccess', 'Salary-Component has been inserted successfully.'); 
	        	redirect('/salarycomponents');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Salary-Component has not been inserted successfully.');
	            redirect('/salarycomponents');
	        }
		}

		$this->load->view('inc/header',$data);
		$this->load->view('salary_components_create',$data);
		$this->load->view('inc/footer');		
	}	

	public function update($id = "")
	{

		$data['title'] = "Update Salary Components";		
		
		if(!empty($id)){
			$data['details'] = $this->salary_components_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/salarycomponents');
			}
		}

		if($this->input->post()){
			
			$update_data = array(
				'id' => base64_decode($this->input->post('id')),
				'component_type' => $this->input->post('component_type'),
	            'name' => $this->input->post('name'),
	            'name_in_payslip' => $this->input->post('name_in_payslip'),
	            'calculation_type' => $this->input->post('calculation_type'),
	            'value' => $this->input->post('value'),
	            'modified_at' => date('Y-m-d H:i:s')
	        );
			
	        $is_updated = $this->salary_components_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Salary-Component has been updated successfully.'); 
	        	redirect('/salarycomponents');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Salary-Component has not been updated successfully.');
	            redirect('/salarycomponents');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('salary_components_update',$data);
		$this->load->view('inc/footer');
	}

	public function delete($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->salary_components_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Salary-Component has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Salary-Component Type has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	
}
