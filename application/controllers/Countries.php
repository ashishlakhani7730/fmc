<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Countries extends MY_Controller {

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

        $this->load->model('countries_model');
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
		$data['title'] = "Manage Countries";
		
		
		$data['items'] = $this->countries_model->get_all();
		
		$this->load->view('inc/header',$data);
		$this->load->view('countries',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{
		if($this->input->post()){

			//Check Name exist or not
			if($this->countries_model->checkDuplicateName($this->input->post('country_name'))){				
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
				$this->session->set_flashdata('flashError', 'Country Name already exist.'); 
	        	redirect('/countries');
			}
			//check country code
			if($this->countries_model->checkDuplicateCode($this->input->post('country_code'))){				
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
				$this->session->set_flashdata('flashError', 'Country Code already exist.'); 
	        	redirect('/countries');
			}

			if($this->input->post('is_default')){
				$is_default = 1;
			}else{
				$is_default = 0;
			}
			$insert_data = array(
	            'country_code' => $this->input->post('country_code'),
	        	'country_name' => $this->input->post('country_name'),
	        	'is_default' => $is_default
	        );

	        $is_inserted = $this->countries_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Country has been inserted successfully.'); 
	        	redirect('/countries');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Country has not been inserted successfully.');
	            redirect('/countries');
	        }

	    }else{
	    	redirect('/countries');
	    }
	}

	public function update()
	{
		if($this->input->post()){
			//Check Name exist or not
			if($this->countries_model->checkDuplicateName($this->input->post('country_name'),$this->input->post('id'))){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Country Name already exist.');
	        	redirect('/Countries');
			}
			//check Country code 
			if($this->countries_model->checkDuplicateCode($this->input->post('country_code'),$this->input->post('id'))){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Country Code already exist.');
	        	redirect('/Countries');
			}
			if($this->input->post('is_default')){
				$is_default = 1;
			}else{
				$is_default = 0;
			}
			$update_data = array(
				'id' => $this->input->post('id'),
	            'country_code' => $this->input->post('country_code'),
	        	'country_name' => $this->input->post('country_name'),
	        	'is_default' => $is_default
	        );
		
	        $is_updated = $this->countries_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Country has been updated successfully.'); 
	        	redirect('/countries');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Country has not been updated successfully.');
	            redirect('/countries');
	        }

	    }else{
	    	redirect('/countries');
	    }
	}

	function get(){
		if($this->input->post()){
			$item_data = $this->countries_model->get_details($this->input->post('id'));

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

        $deleted = $this->countries_model->delete($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Country has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Country has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
