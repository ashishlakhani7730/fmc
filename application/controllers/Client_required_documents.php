<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_required_documents extends MY_Controller {

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

        $this->load->model('client_required_documents_model');

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
		$data['title'] = "Client - Required Documents";
		
		
		$data['items'] = $this->client_required_documents_model->get_all();
		
		$this->load->view('inc/header',$data);
		$this->load->view('client_required_documents',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		if($this->input->post()){

			//Check Name exist or not
			if($this->client_required_documents_model->checkDuplicateName($this->input->post('name'))){				
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
				$this->session->set_flashdata('flashError', 'Name already exist.'); 
	        	redirect('/client-required-documents/create');
			}

			if($this->input->post('is_required')){
				$is_required = 'yes';
			}else{
				$is_required = 'no';
			}

			$insert_data = array(
	            'name' => $this->input->post('name'),
	            'is_required' => $is_required,
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->client_required_documents_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Client-Required-Documents has been inserted successfully.'); 
	        	redirect('/client-required-documents');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Client-Required-Documents has not been inserted successfully.');
	            redirect('/client-required-documents');
	        }

	    }else{
	    	redirect('/client-required-documents');
	    }
	}

	public function update()
	{
		if($this->input->post()){

			//Check Name exist or not
			if($this->client_required_documents_model->checkDuplicateName($this->input->post('name'),$fmc_user_id)){
				$this->session->set_flashdata('flashError', 'Name already exist.');
	        	redirect('/client-required-documents/create');
			}			

			if($this->input->post('is_required')){
				$is_required = 'yes';
			}else{
				$is_required = 'no';
			}

			$update_data = array(
				'id' => $this->input->post('id'),
	            'name' => $this->input->post('name'),
	            'is_required' => $is_required,
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );
		
	        $is_updated = $this->client_required_documents_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Client-Required-Documents has been updated successfully.'); 
	        	redirect('/client-required-documents');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Client-Required-Documents has not been updated successfully.');
	            redirect('/client-required-documents');
	        }

	    }else{
	    	redirect('/client-required-documents');
	    }
	}

	function get(){
		if($this->input->post()){
			$item_data = $this->client_required_documents_model->get_details($this->input->post('id'));

			if($item_data){
				$data['success'] = "true";				
				$data['data'] = $item_data;				
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

        $deleted = $this->client_required_documents_model->delete($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Client-Required-Documents has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Client-Required-Documents has not been deleted successfully.'); 
            echo '0';exit;
        }
	}	
}
