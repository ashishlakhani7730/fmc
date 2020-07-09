<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends MY_Controller {

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

        $this->load->model('notifications_model');
	}

	public function index()
	{
		$data['title'] = "Notifications";

		$fmc_login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
        $data['items'] = $this->notifications_model->get_all_fmc_notifications($fmc_login_user_id);

		$this->load->view('inc/header',$data);
		$this->load->view('notifications',$data);
		$this->load->view('inc/footer');		
	}	
	
}
