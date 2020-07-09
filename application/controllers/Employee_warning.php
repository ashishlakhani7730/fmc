<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_warning extends MY_Controller {

	public function __construct() 
	{
        parent::__construct();  

        $this->load->model('warning_categories_model');
        $this->load->model('warning_model');
        $this->load->model('employees_model');
        $this->load->model('common_documents_model');

        $this->load->library('upload');

        if(!($this->session->userdata['fmc_company_employee_data']['is_login'] || $this->session->userdata['fmc_company_employee_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index(){
        
		$data['title'] = "Employee Warning";
		$this->load->view('inc/header',$data);
		$this->load->view('employee_warning',$data);
		$this->load->view('inc/footer');		
    }

    public function get_warning_list(){
        $employee_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);
        $page = $this->input->post('offset');
        // $record_per_page = 10;
        $record_per_page = "";

        $conditions['skip'] = ($page * $record_per_page) - $record_per_page;
        $conditions['limit'] = $record_per_page;
        $conditions['employee_id'] = $employee_id;

        $result['warning_list'] = $this->warning_model->get_all_by_employee($conditions);
        if(!empty($result['warning_list'])){
            $return['warning_list'] = $result['warning_list'];
            $return['status'] = 'true';
        }else{
            $return['status'] = 'false';
        }
        echo json_encode($return);
    }
    
}