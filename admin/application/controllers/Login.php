<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
	public function index()
	{
		if($this->input->post()){
			redirect('/dashboard');
		}	
		$this->load->view('login');
	}

	public function forgot_password()
	{
		if($this->input->post()){
			redirect('/reset-password');
		}	
		$this->load->view('forgot_password');
	}

	public function reset_password()
	{
		if($this->input->post()){
			redirect('/login');
		}
		$this->load->view('reset_password');
	}

	public function fmc_policy()
	{
		$this->load->view('fmc_policy');
	}

	
	
}
