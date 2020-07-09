<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobpositions extends MY_Controller {

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
		$data['title'] = "Job Positions";
		
		//company login id
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['items'] = $this->job_positions_model->get_all($client_login_id);
		$data['tree_view_data'] = $this->job_positions_model->get_tree_view_data($client_login_id);	

		$this->load->view('inc/header',$data);
		$this->load->view('job_positions',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		$data['title'] = "Create Job-Position";		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['designation'] = $this->company_designation_model->get_all($client_login_id);
		//$data['employees'] = $this->employees_model->get_all($client_login_id);

		if($this->input->post()){
			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			if($this->input->post('no_of_positions')){
				$no_of_positions = $this->input->post('no_of_positions');
			}else{
				$no_of_positions = 1;
			}
			
			$insert_data_arr = array();
			for ($i=1; $i <= $no_of_positions; $i++) { 

				$job_title = $this->input->post('job_title');
				if($no_of_positions > 1){
					$job_title .= " ".$i;
				}
				

				$insert_data_arr[] = array(
					'company_id' => base64_decode($company_login_id),
					'job_title' => $job_title,
		            'designation' => $this->input->post('designation'),
		            'under_employee_id' => ($this->input->post('under_employee_id')) ? $this->input->post('under_employee_id') : 0,
		            'status' => 'open',
		        	'created_at' => date('Y-m-d H:i:s'),
		        	'modified_at' => date('Y-m-d H:i:s')
		        );	
			}
			
			$is_inserted = $this->job_positions_model->insert($insert_data_arr);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Job-Position has been inserted successfully.'); 
	        	redirect('/jobpositions');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Job-Position has not been inserted successfully.');
	            redirect('/jobpositions');
	        }
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('job_positions_create',$data);
		$this->load->view('inc/footer');
	}

	public function update($id = "")
	{
		$data['title'] = "Update Job-Position";		
		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['designation'] = $this->company_designation_model->get_all($client_login_id);
		$data['employees'] = $this->employees_model->get_all($client_login_id);

		if(!empty($id)){
			$data['details'] = $this->job_positions_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/jobpositions');
			}
		}

		if($this->input->post()){
			
			$update_data = array(
				'id' => base64_decode($this->input->post('id')),
	            'job_title' => $this->input->post('job_title'),
	            'designation' => $this->input->post('designation'),
	            'under_employee_id' => $this->input->post('under_employee_id'),
	            'status' => $this->input->post('status'),
	            'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->job_positions_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Job-Position has been updated successfully.'); 
	        	redirect('/jobpositions');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Job-Position has not been updated successfully.');
	            redirect('/jobpositions');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('job_positions_update',$data);
		$this->load->view('inc/footer');
	}

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->job_positions_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Job-Position has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Job-Position has not been deleted successfully.'); 
            echo '0';exit;
        }
	}	

	public function get_employee_by_designation(){
		$designation_id = $_POST['designation_id'];
		$data = $this->job_positions_model->get_parent_employee_by_designation($designation_id);
		echo json_encode($data);
	}
	
}
