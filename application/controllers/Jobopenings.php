<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobopenings extends MY_Controller {

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
		$this->load->model('job_openings_model');		
		$this->load->model('job_positions_model');
		$this->load->model('employees_model');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
        	$this->session->set_flashdata('flashError', 'Please Login to Continue');
        	redirect('/');
        }
	}

	public function index($tab="")
	{
		$data['title'] = "Jon Openings";
		
		//company login id
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['items'] = $this->job_openings_model->get_all($client_login_id);

		$this->load->view('inc/header',$data);
		$this->load->view('job_openings',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{		
		$data['title'] = "Create Job-Opening";		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['designation'] = $this->company_designation_model->get_all($client_login_id);
		$data['job_positions'] = $this->job_positions_model->get_all_by_status($client_login_id,'open');

		if($this->input->post()){
			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			$job_position = "";
			foreach ($this->input->post('job_position') as $value) {
				if($job_position == ""){
					$job_position .= $value;
				}else{
					$job_position .= ",".$value;
				}
			}

			$insert_data = array(
				'company_id' => base64_decode($company_login_id),
				'job_title' => $this->input->post('job_title'),
				'job_position' => $job_position,
	            'job_designation' => $this->input->post('job_designation'),
	            'job_description' => $this->input->post('job_description'),
	            'no_of_vacancy' => $this->input->post('no_of_vacancy'),
	            'status' => $this->input->post('status'),
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );		

	        $is_inserted = $this->job_openings_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Job-Opening has been inserted successfully.'); 
	        	redirect('/jobopenings');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Job-Opening has not been inserted successfully.');
	            redirect('/jobopenings');
	        }
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('job_opening_create',$data);
		$this->load->view('inc/footer');
	}

	public function update($id = "")
	{
		$data['title'] = "Update Job-Opening";		
		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['designation'] = $this->company_designation_model->get_all($client_login_id);
		$data['job_positions'] = $this->job_positions_model->get_all_by_status($client_login_id,'open');

		if(!empty($id)){
			$data['details'] = $this->job_openings_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/jobopenings');
			}
		}

		if($this->input->post()){
			
			$job_position = "";
			foreach ($this->input->post('job_position') as $value) {
				if($job_position == ""){
					$job_position .= $value;
				}else{
					$job_position .= ",".$value;
				}
			}

			$update_data = array(
				'id' => base64_decode($this->input->post('id')),
	            'job_title' => $this->input->post('job_title'),
				'job_position' => $job_position,
	            'job_designation' => $this->input->post('job_designation'),
	            'job_description' => $this->input->post('job_description'),
	            'no_of_vacancy' => $this->input->post('no_of_vacancy'),
	            'status' => $this->input->post('status'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->job_openings_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Job-Opening has been updated successfully.'); 
	        	redirect('/jobopenings');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Job-Opening has not been updated successfully.');
	            redirect('/jobopenings');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('job_opening_update',$data);
		$this->load->view('inc/footer');
	}

	

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->job_openings_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Job-Opening has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Job-Opening has not been deleted successfully.'); 
            echo '0';exit;
        }
	}	
	
}
