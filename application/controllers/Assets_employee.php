<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assets_employee extends MY_Controller {

	public function __construct() 
	{
        parent::__construct();  
        $this->load->model('assets_type_model');
        $this->load->model('assets_manufacturer_model');
        $this->load->model('assets_item_model');
        $this->load->model('assets_assign_model');
        $this->load->model('clients_model');
        $this->load->model('employees_model');
        $this->load->model('common_documents_model');
        
        if(!($this->session->userdata['fmc_company_employee_data']['is_login'] || $this->session->userdata['fmc_company_employee_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index($tab="")
	{		
        $employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
		$data['title'] = "Assets Management";
		$data['current_tab'] = ($tab != "") ? $tab : 'current';
        
		$assets_assign_current = $this->assets_assign_model->assets_assign_current($employee_id);		
		$assets_assign_past = $this->assets_assign_model->assets_assign_past($employee_id);	

		$data['assets_assign_current'] = $assets_assign_current;
        $data['assets_assign_past'] = $assets_assign_past;
        
		$this->load->view('inc/header',$data);
		$this->load->view('assets_employee',$data);
		$this->load->view('inc/footer');		
    }
    
    public function view($id="")
	{		
		$data['title'] = "Assets View";
		$data['current_tab'] = ($tab != "") ? $tab : 'current';
        
        $assets_details = $this->assets_assign_model->get_full_details(base64_decode($id));
        $assets_details['assets_item_assign_document'] = $this->common_documents_model->get_all('assets_item_assign',base64_decode($id)); //get uploaded documents		
        $assets_details['assets_item_return_document'] = $this->common_documents_model->get_all('assets_item_return',base64_decode($id)); //get uploaded documents
        $data['assets_details'] = $assets_details;
        
		$this->load->view('inc/header',$data);
		$this->load->view('assets_details',$data);
		$this->load->view('inc/footer');		
	}

	
}
