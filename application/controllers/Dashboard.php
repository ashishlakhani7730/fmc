<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

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

	public function __construct() {
		parent::__construct();

		$is_login = "false";
		if(isset($this->session->userdata['fmc_user_data']) && $this->session->userdata['fmc_user_data']['is_login']){
			$is_login = "true";
		}else if(isset($this->session->userdata['fmc_client_login']) && $this->session->userdata['fmc_client_login']['is_client_login']){
			$is_login = "true";
		}else if(isset($this->session->userdata['fmc_company_employee_data']) && $this->session->userdata['fmc_company_employee_data']['is_login']){
			$is_login = "true";
		}

        if($is_login == "false")
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
            exit();
        }

        $this->load->model('requests_model');
        $this->load->model('clients_model');
        $this->load->model('user_model');
    }

    public function rtl()
	{
		$this->load->view('rtl');
	}

    public function change_language($language = "")
	{
		
		if($language == "english"){
			$language = "english";
		}else if($language == "arabic"){
			$language = "arabic";
		}else{
			$language = "english";
		}
		set_cookie("fmc_language",$language,86400);
		redirect('/dashboard');
	}
    

	public function index()
	{
		$data['title'] = "Dashboard";		

		$primary_requests = array();
		$other_requests = array();
		$closed_requests = array();
		$declined_requests = array();


		//FMC User Login
		if($this->session->userdata('fmc_user_data') && $this->session->userdata['fmc_user_data']['is_login']){

			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
			
			$primary_requests = $this->requests_model->get_fmc_primary_requests($fmc_login_user_id);
			
			$other_requests = $this->requests_model->get_fmc_other_requests($fmc_login_user_id);
			$closed_requests = $this->requests_model->get_fmc_closed_requests();
			$declined_requests = $this->requests_model->get_fmc_declined_requests();

			

			$data['primary_requests'] = $primary_requests;
			$data['other_requests'] = $other_requests;
			$data['closed_requests'] = $closed_requests;
			$data['declined_requests'] = $declined_requests;
		}

		//Compnay Employee Login
		if($this->session->userdata('fmc_company_employee_data') && $this->session->userdata['fmc_company_employee_data']['is_login']){
			$company_employee_login_id = base64_decode($this->session->userdata['fmc_company_employee_data']['id']);

			$primary_requests = $this->requests_model->get_compamy_employee_primary_request($company_employee_login_id);
			$other_requests = $this->requests_model->get_compamy_employee_other_request($company_employee_login_id);
			
			$data['primary_requests'] = $primary_requests;
			$data['other_requests'] = $other_requests;
		}
		
		
		$this->load->view('inc/header',$data);
		if(($this->session->userdata('fmc_user_data') && $this->session->userdata['fmc_user_data']['is_login']) && ($this->session->userdata('fmc_client_login') && $this->session->userdata['fmc_client_login']['is_client_login']))
        {
        	$this->load->view('company_dashboard',$data);
		}else if($this->session->userdata('fmc_user_data') && $this->session->userdata['fmc_user_data']['is_login']){
			$this->load->view('dashboard',$data);
		}else if($this->session->userdata('fmc_client_login') && $this->session->userdata['fmc_client_login']['is_client_login']){
			$this->load->view('company_dashboard',$data);
		}else if($this->session->userdata('fmc_company_employee_data') && $this->session->userdata['fmc_company_employee_data']['is_login']){
			$this->load->view('company_employee_dashboard',$data);
		}

		$this->load->view('inc/footer');
	}

	public function client_logout(){
		$this->session->unset_userdata('fmc_client_login');
        redirect('/dashboard');
	}	

	public function logout(){	

		if(isset($this->session->userdata['fmc_user_data'])){
			$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);	
	 		$fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";
	        if($fmc_language == "english"){
	        	$fmc_language == 'english';
	        }else if ($fmc_language == 'arabic') {
	        	$fmc_language == 'arabic';
	        }else{
	        	$fmc_language == 'english';
	        }
	       
	        $update_data = array(
				'id' => $fmc_login_user_id,
				'last_login_language' => $fmc_language
			);

	        $updated_data = $this->user_model->update($update_data);
	        $this->session->unset_userdata('fmc_user_data');
		}		               
        
		if($this->session->userdata['fmc_client_login'])
        {
        	$this->session->unset_userdata('fmc_client_login');   
        }
	
		if($this->session->userdata['fmc_company_employee_data'])
        {
        	$this->session->unset_userdata('fmc_company_employee_data');   
        }
		
        $this->session->sess_destroy();
        

		redirect('/');
	}

	public function start_client_login(){
		$this->load->model('clients_model');

		if($this->input->post()){
			$details = $this->clients_model->get_details($this->input->post('id'));
			if($details){

				$clientSession = array();
	            $clientSession['is_client_login'] = true;
	            $clientSession['client_id'] = base64_encode($details['id']);
	            $clientSession['company_name_english'] = $details['company_name_english'];
	            $clientSession['company_name_arabic'] = ucwords($details['company_name_arabic']);

	            $this->session->set_userdata('fmc_client_login',$clientSession);
				$data['success'] = "true";

			}else{
				$data['success'] = "false";
			}

	    }else{
	    	$data['success'] = "false";
	    }
		
		echo json_encode($data);
	}

		
}
