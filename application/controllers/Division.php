<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Division extends MY_Controller {

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
        $this->load->model('division_model');

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
		$data['title'] = "Division";		
		
		$data['items'] = $this->division_model->get_all();
		
		$this->load->view('inc/header',$data);
		$this->load->view('division',$data);
		$this->load->view('inc/footer');
	}

	public function by_department($id = "")
	{

		$data['title'] = "Division";		
		
		$data['items'] = $this->division_model->get_all(base64_decode($id));
		
		$this->load->view('inc/header',$data);
		$this->load->view('division',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		$data['title'] = "Create Division";		
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->get_departments();


		if($this->input->post()){
			
			$insert_data = array(
	            'department_id' => $this->input->post('department_id'),
	            'module_name' => $this->input->post('module_name'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->division_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Department has been inserted successfully.'); 
	        	redirect('/division');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Department has not been inserted successfully.');
	            redirect('/division');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('division_create',$data);
		$this->load->view('inc/footer');

	}

	public function update($id = "")
	{

		$data['title'] = "Update Division";		
		$this->load->model('departments_model');
		$data['departments'] = $this->departments_model->get_departments();

		if(!empty($id)){
			$data['details'] = $this->division_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/division');
			}
		}

		if($this->input->post()){
			
			$departmentData = array(
				'id' => base64_decode($this->input->post('id')),
	            'department_id' => $this->input->post('department_id'),
	            'module_name' => $this->input->post('module_name'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $department_data = $this->division_model->update($departmentData);

	        if($department_data){
	        	$this->session->set_flashdata('flashSuccess', 'Division has been updated successfully.'); 
	        	redirect('/division');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Division has not been updated successfully.');
	            redirect('/division');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('division_update',$data);
		$this->load->view('inc/footer');
	}

	function get(){
		if($this->input->post()){
			
			$department_data = $this->division_model->get_details($this->input->post('id'));

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

        $deleted = $this->division_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Department has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Department has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
