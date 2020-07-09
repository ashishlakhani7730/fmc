<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_types extends MY_Controller {

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
        $this->load->model('request_type_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "Request Type";		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		
		$data['items'] = $this->request_type_model->get_all($client_login_id);
		
		$this->load->view('inc/header',$data);
		$this->load->view('request_type',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		//company login id
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

		$data['title'] = "Create Request_type";		
		$data['request_type'] = $this->request_type_model->get_all(base64_decode($company_login_id));

		if($this->input->post()){
			if($this->input->post('parent')){
				$parent = $this->input->post('parent');
			}else{
				$parent = '0';
			}
			
			
			$insert_data = array(
				'company_id' => base64_decode($company_login_id),
				'name' => $this->input->post('name'),
	            'parent' => $parent,
	            'description' => $this->input->post('description'),

	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->request_type_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Request-Type has been added successfully.'); 
	        	redirect('/request_types');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Request-Type has not been added successfully.');
	            redirect('/request_types');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('request_type_create',$data);
		$this->load->view('inc/footer');

	}

	public function update($id = "")
	{

		$data['title'] = "Update Request_type";

		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
				
		$data['request_type'] = $this->request_type_model->get_all($client_login_id);
		
		
		if(!empty($id)){
			$data['details'] = $this->request_type_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/request_types');
			}
		}

		if($this->input->post()){
			if($this->input->post('parent')){
				$parent = $this->input->post('parent');
			}else{
				$parent = '0';
			}

			$updateData = array(
				'id' => base64_decode($this->input->post('id')),
	            'name' => $this->input->post('name'),
	            'parent' => $parent,
	            'description' => $this->input->post('description'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->request_type_model->update($updateData);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Request-Type has been updated successfully.'); 
	        	redirect('/request_types');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Request-Type has not been updated successfully.');
	            redirect('/request_types');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('request_type_update',$data);
		$this->load->view('inc/footer');
	}

	function get(){
		if($this->input->post()){
			
			$request_type_data = $this->request_type_model->get_details($this->input->post('id'));

			if($request_type_data){
				$data['success'] = "true";				
				$data['data'] = $request_type_data;				
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

        $deleted = $this->request_type_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Request-Type has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Request-Type has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
