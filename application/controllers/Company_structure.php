<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_structure extends MY_Controller {

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
        $this->load->model('company_structure_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{				
		$data['title'] = "Company Organization Chart";
		$data['items'] = $this->company_structure_model->get_all();

		$this->load->view('inc/header',$data);
		$this->load->view('company_structure',$data);
		$this->load->view('inc/footer');		
	}

	public function create()
	{
		$data['title'] = "Create Company Organization Chart";		
		$data['company_structure_types'] = $this->company_structure_model->get_company_structure_types();
		$data['company_structure'] = $this->company_structure_model->get_all();

		if($this->input->post()){
			if($this->input->post('parent')){
				$parent = $this->input->post('parent');
			}else{
				$parent = '0';
			}

			if($this->input->post('company_id')){
				$company_id = $this->input->post('company_id');
			}else{
				$company_id = '0';
			}

			$insert_data = array(
	            'name' => $this->input->post('name'),
	            'detail' => $this->input->post('detail'),
	        	'type' => $this->input->post('type'),
	        	'parent' => $parent,
	        	'company_id' => $company_id,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->company_structure_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Company Organization Chart has been inserted successfully.'); 
	        	redirect('/company-organization-chart');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company Organization Chart has not been inserted successfully.');
	            redirect('/company-organization-chart');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_structure_create',$data);
		$this->load->view('inc/footer');
	}

	public function update($id = "")
	{
		$data['title'] = "Update Company Organization Chart";		
		$data['company_structure_types'] = $this->company_structure_model->get_company_structure_types();
		$data['company_structure'] = $this->company_structure_model->get_all();

		if(!empty($id)){
			$data['details'] = $this->company_structure_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/company-organization-chart');
			}
		}

		if($this->input->post()){

			if($this->input->post('parent')){
				$parent = $this->input->post('parent');
			}else{
				$parent = '0';
			}

			if($this->input->post('company_id')){
				$company_id = $this->input->post('company_id');
			}else{
				$company_id = '0';
			}
			
			$update_data = array(
				'id' => base64_decode($this->input->post('id')),
	            'name' => $this->input->post('name'),
	            'detail' => $this->input->post('detail'),
	        	'type' => $this->input->post('type'),
	        	'parent' => $parent,
	        	'company_id' => $company_id,
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->company_structure_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Company Organization Chart has been updated successfully.'); 
	        	redirect('/company-organization-chart');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company Organization Chart has not been updated successfully.');
	            redirect('/company-organization-chart');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('company_structure_update',$data);
		$this->load->view('inc/footer');
	}

	public function tree_view()
	{	
		$data['title'] = "Company Organization Chart Tree View";

		$this->load->view('inc/header',$data);
		$this->load->view('company_structure_tree_view',$data);
		$this->load->view('inc/footer');
	}

	public function get_tree_view_data()
	{
		$data['data'] = $this->company_structure_model->get_tree_view_data();
		echo json_encode($data);
	}

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->company_structure_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Company Organization Chart has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Company Organization Chart has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	
}
