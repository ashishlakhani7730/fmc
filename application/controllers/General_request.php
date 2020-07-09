<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_request extends MY_Controller {

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
        $this->load->model('general_request_model');
        $this->load->model('request_type_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "General Request";		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		
		$data['items'] = $this->general_request_model->get_all($client_login_id);
		$data['request'] = $this->request_type_model->get_all($client_login_id);

		$this->load->view('inc/header',$data);
		$this->load->view('general_request',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		//company login id
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

		$data['title'] = "Create rgeneral_equest";		
		$data['general_request'] = $this->general_request_model->get_all(base64_decode($company_login_id));

		if($this->input->post()){
			// if($this->input->post('parent')){
			// 	$parent = $this->input->post('parent');
			// }else{
			// 	$parent = '0';
			// }
			
			
			$insert_data = array(
				'req_type_id' => $this->input->post('req_type_id'),
	            'title' => $this->input->post('title'),
	            'descriptions' => $this->input->post('descriptions'),
	            //'company_id' => base64_decode($company_login_id),
	            'created_by' => base64_decode($company_login_id),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->general_request_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'General Request has been inserted successfully.'); 
	        	redirect('/general_request');
	        }else{
	        	$this->session->set_flashdata('flashError', 'General Request has not been inserted successfully.');
	            redirect('/general_request');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('general_request_create',$data);
		$this->load->view('inc/footer');

	}

	public function update($id = "")
	{

		$data['title'] = "Update general_request";		
		$data['general_request'] = $this->general_request_model->get_all();
		
		
		if(!empty($id)){
			$data['details'] = $this->general_request_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/general_request');
			}
		}

		if($this->input->post()){
			
			$updateData = array(
				'id' => base64_decode($this->input->post('id')),
	            'request_name' => $this->input->post('request_name'),
	            'parent' => $parent,
	            'descriptions' => $this->input->post('descriptions'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->general_request_model->update($updateData);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'General request has been updated successfully.'); 
	        	redirect('/general_request');
	        }else{
	        	$this->session->set_flashdata('flashError', 'General request has not been updated successfully.');
	            redirect('/general_request');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('general_request_update',$data);
		$this->load->view('inc/footer');
	}

	function get(){
		if($this->input->post()){
			
			$general_request_data = $this->general_request_model->get_details($this->input->post('id'));

			if($general_request_data){
				$data['success'] = "true";				
				$data['data'] = $general_request_data;				
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

        $deleted = $this->general_request_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'General request has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'General request has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
