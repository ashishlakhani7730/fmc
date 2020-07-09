<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_structure_type extends MY_Controller {

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

        $this->load->model('company_structure_type_model');
        
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
		$data['title'] = "Manage Company structure type";
		
		$data['items'] = $this->company_structure_type_model->get_all();
				
		$this->load->view('inc/header',$data);
		$this->load->view('company_structure_type',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		if($this->input->post()){
			//Check Name exist or not
			if($this->company_structure_type_model->checkDuplicateName($this->input->post('name'))){				
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
				$this->session->set_flashdata('flashError', 'Name already exist.'); 
	        	redirect('/company_structure_type');
			}

			if($this->input->post('is_default')){
				$is_default = 1;
			}else{
				$is_default = 0;
			}
			$insert_data = array(
	            'name' => $this->input->post('name'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s'),
	        	'is_default' => $is_default
	        );

	        $is_inserted = $this->company_structure_type_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Company structure type has been inserted successfully.'); 
	        	redirect('/company_structure_type');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company structure type has not been inserted successfully.');
	            redirect('/company_structure_type');
	        }

	    }else{
	    	redirect('/company_structure_type');
	    }
	}

	public function update()
	{
		if($this->input->post()){
			//Check Name exist or not
			if($this->company_structure_type_model->checkDuplicateName($this->input->post('name'),$this->input->post('id'))){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Name already exist.');
	        	redirect('/company_structure_type');
			}

			if($this->input->post('is_default')){
				$is_default = 1;
			}else{
				$is_default = 0;
			}
			$update_data = array(
				'id' => $this->input->post('id'),
	        	'name' => $this->input->post('name'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s'),
	        	'is_default' => $is_default
	        );
		
	        $is_updated = $this->company_structure_type_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Company structure type has been updated successfully.'); 
	        	redirect('/company_structure_type');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company structure type has not been updated successfully.');
	            redirect('/company_structure_type');
	        }

	    }else{
	    	redirect('/company_structure_type');
	    }
	}

	function get(){
		if($this->input->post()){
			$item_data = $this->company_structure_type_model->get_details($this->input->post('id'));

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

        $deleted = $this->company_structure_type_model->delete($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Company structure type has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Company structure type has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	public function updatesortorder(){
        $ids = $_POST['ids'];
        $i=1;
        foreach($ids as $value){
            $update_data = array(
                'id' => $value,
                'display_order' => $i
            );      
            $is_updated = $this->company_structure_type_model->updateOrder($update_data);
            $i++;
        }
        $this->session->set_flashdata('flashSuccess', 'Display Order has been updated successfully.'); 
    }
}
