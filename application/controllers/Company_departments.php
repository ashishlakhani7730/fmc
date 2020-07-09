<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_departments extends MY_Controller {

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
        $this->load->model('company_departments_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "Departments";		
		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		$data['items'] = $this->company_departments_model->get_all($client_login_id);
		
		$this->load->view('inc/header',$data);
		$this->load->view('company_departments',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		if($this->input->post()){

			$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

			$insert_data = array(
				'company_id' => $client_login_id,
	            'name' => $this->input->post('name'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->company_departments_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Department has been inserted successfully.'); 
	        	redirect('/company_departments');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Department has not been inserted successfully.');
	            redirect('/company_departments');
	        }

	    }else{
	    	redirect('/company_departments');
	    }
	}

	public function update($id = "")
	{
		if($this->input->post()){

			$this->load->model('departments_model');

			$update_data = array(
				'id' => $this->input->post('id'),
	            'name' => $this->input->post('name'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->company_departments_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Department has been updated successfully.'); 
	        	redirect('/company_departments');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Department has not been updated successfully.');
	            redirect('/company_departments');
	        }

	    }else{
	    	redirect('/company_departments');
	    }	    
	}

	function get(){
		if($this->input->post()){		
			$details = $this->company_departments_model->get_details($this->input->post('id'));

			if($details){
				$data['success'] = "true";				
				$data['data'] = $details;				
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

        $deleted = $this->company_departments_model->delete($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Department has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Department has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
