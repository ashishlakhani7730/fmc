<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends MY_Controller {

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

        if(!($this->session->userdata['fmc_user_data']['is_login'] || $this->session->userdata['fmc_user_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }

        if($this->session->userdata('fmc_client_login') && $this->session->userdata['fmc_client_login']['is_client_login'])
        {
            $this->session->set_flashdata('flashError', 'Please logout from client login');
            redirect('/dashboard');
        }
	}

	public function index()
	{
		$data['title'] = "Departments";
		$this->load->model('departments_model');
		
		$data['departments'] = $this->departments_model->get_departments();
		
		$this->load->view('inc/header',$data);
		$this->load->view('departments',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		if($this->input->post()){

			$this->load->model('departments_model');

			$departmentData = array(
	            'department_name' => $this->input->post('department_name'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $department_data = $this->departments_model->insert_department($departmentData);

	        if($department_data){
	        	$this->session->set_flashdata('flashSuccess', 'Department has been inserted successfully.'); 
	        	redirect('/departments');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Department has not been inserted successfully.');
	            redirect('/departments');
	        }

	    }else{
	    	redirect('/departments');
	    }
	}

	public function update()
	{
		if($this->input->post()){

			$this->load->model('departments_model');

			$departmentData = array(
				'id' => $this->input->post('id'),
	            'department_name' => $this->input->post('department_name'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $department_data = $this->departments_model->update_department($departmentData);

	        if($department_data){
	        	$this->session->set_flashdata('flashSuccess', 'Department has been updated successfully.'); 
	        	redirect('/departments');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Department has not been updated successfully.');
	            redirect('/departments');
	        }

	    }else{
	    	redirect('/departments');
	    }
	}

	function get(){
		if($this->input->post()){
			$this->load->model('departments_model');
			$department_data = $this->departments_model->get_department_details($this->input->post('id'));

			if($department_data){
				$data['success'] = "true";				
				$data['data'] = $department_data;				
			}else{
				$data['success'] = "false";
			}
	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $this->load->model('departments_model');
        $deleted = $this->departments_model->delete_department($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Department has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Department has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
