<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends MY_Controller {

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
        $this->load->model('company_designation_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "Position-Title";		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		
		$data['items'] = $this->company_designation_model->get_all($client_login_id);
		
		$this->load->view('inc/header',$data);
		$this->load->view('designation',$data);
		$this->load->view('inc/footer');
	}

	public function by_department($id = "")
	{

		$data['title'] = "Position-Title";		
		
		$data['items'] = $this->company_designation_model->get_all(base64_decode($id));
		
		$this->load->view('inc/header',$data);
		$this->load->view('designation',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		//company login id
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

		$data['title'] = "Create Position-Title";		
		$data['designation'] = $this->company_designation_model->get_all(base64_decode($company_login_id));

		if($this->input->post()){

			
			
			$insert_data = array(
				'name' => $this->input->post('name'),
	            'parent' => $this->input->post('parent'),
	            'detail' => $this->input->post('detail'),
	            'company_id' => base64_decode($company_login_id),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_inserted = $this->company_designation_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Position-Title has been inserted successfully.'); 
	        	redirect('/position-titles');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Position-Title has not been inserted successfully.');
	            redirect('/position-titles');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('designation_create',$data);
		$this->load->view('inc/footer');

	}

	public function update($id = "")
	{
		$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];
		$data['title'] = "Update Position-Title";		
		$data['designation'] = $this->company_designation_model->get_all(base64_decode($company_login_id));

		if(!empty($id)){
			$data['details'] = $this->company_designation_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/position-titles');
			}
		}

		if($this->input->post()){
			
			$updateData = array(
				'id' => base64_decode($this->input->post('id')),
	            'name' => $this->input->post('name'),
	            'parent' => $this->input->post('parent'),
	            'detail' => $this->input->post('detail'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->company_designation_model->update($updateData);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Position-Title has been updated successfully.'); 
	        	redirect('/position-titles');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Position-Title has not been updated successfully.');
	            redirect('/position-titles');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('designation_update',$data);
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

        $deleted = $this->company_designation_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Position-Title has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Position-Title has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

	public function get_tree_view_data()
	{
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		$data['data'] = $this->company_designation_model->get_tree_view_data($client_login_id);
		echo json_encode($data);
	}
}
