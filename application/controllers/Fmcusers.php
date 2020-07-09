<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fmcusers extends MY_Controller {

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
    	$this->load->library('upload');

    	$this->load->model('user_model');
    	$this->load->model('departments_model');
    	$this->load->model('requests_model');

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
		$data['title'] = "FMC Users";		
		
		$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
		$data['items'] = $this->user_model->get_all($login_user_id);
		
		$this->load->view('inc/header',$data);
		$this->load->view('fmc_users',$data);
		$this->load->view('inc/footer');
	}	

	public function myprofile($id = "")
	{
		$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);

		$data['title'] = "My-profile";		

		//Load department for department dropdown		
		$data['departments'] = $this->departments_model->get_departments();

		
		$details = $this->user_model->get_details($login_user_id);

		if(!$details){
			$this->session->set_flashdata('flashError', 'User not found.');
			redirect('/dashboard');
		}		

		$fmc_user_departments = $this->user_model->get_user_departments($login_user_id);		
		$user_departments = array();
		foreach ($fmc_user_departments as $value) {
			$user_departments[] = $value['department_id'];	
		}
		$details['departments'] = $user_departments;
		$data['details'] = $details;

		if($this->input->post()){
			$fmc_user_id = $login_user_id;

			//Check Email exist or not
			if($this->user_model->checkEmail($this->input->post('email'),$fmc_user_id)){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Email already exist.');
	        	redirect('/fmcusers/myprofile');
			}

			//Check Employee ID exist or not
			if($this->user_model->checkFMCEmployeeID($this->input->post('fmc_employee_id'),$fmc_user_id)){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Employee ID already exist.');
	        	redirect('/fmcusers/myprofile');
			}
			
			$birthdate = explode("/", $this->input->post('birthdate'));
			$birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
			
			$quick_menu = "";
			if($this->input->post('quick_menu')){
				$quick_menu = implode(',', $this->input->post('quick_menu'));
			}
			
			$update_data = array(
				'id' => $fmc_user_id,
	            'first_name' => $this->input->post('first_name'),
	            'last_name' => $this->input->post('last_name'),
	            'surname' => $this->input->post('surname'),
	            'email' => $this->input->post('email'),
	            'mobile' => $this->input->post('mobile'),
	            'alternative_mobile_no' => $this->input->post('alternative_mobile_no'),
	            'birthdate' => $birthdate,
	            'address' => $this->input->post('address'),
	            'quick_menu' => $quick_menu,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			
			if(isset($_FILES['profile_picture']) && is_uploaded_file($_FILES['profile_picture']['tmp_name'])){

				$file_name = $_FILES['profile_picture']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if($this->upload->do_upload('profile_picture'))
	            {
	            	$update_data['profile_picture'] = $upload_file_name;
	            }
			}

	        $updated_data = $this->user_model->update($update_data);

	        if($updated_data){	        
	        	$insert_user_department_data = array();
	        	if($this->input->post('department_ids')){
		        	$department_ids = $this->input->post('department_ids');
		        	foreach ($department_ids as $value) {
		        		$insert_user_department_data[] = array("fmc_user_id"=>$fmc_user_id,"department_id"=>$value);	
		        	}	        	
		        	$this->user_model->remove_user_departments($fmc_user_id);
		        	$this->user_model->insert_user_departments($insert_user_department_data);
		        }

	        	$this->session->set_flashdata('flashSuccess', 'User has been updated successfully.'); 
	        	redirect('/dashboard');
	        }else{
	        	$this->session->set_flashdata('flashError', 'User has not been updated successfully.');
	            redirect('/dashboard');
	        }
	    }

		$this->load->view('inc/header',$data);
		$this->load->view('fmc_users_my_profile',$data);
		$this->load->view('inc/footer');
	}
	
	public function view($id = "")
	{
		$data['title'] = "FMC User View";		
		
		//$data['departments'] = $this->departments_model->get_departments();

		if(!empty($id)){

			$data['details'] = $this->user_model->get_details(base64_decode($id));
			//Load department for department dropdown		
			$data['departments'] = $this->departments_model->get_departments();
			$fmc_user_departments = $this->user_model->get_user_departments(base64_decode($id));

			$user_departments = array();
			foreach ($fmc_user_departments as $value) {
				$user_departments[] = $value['department_id'];	
			}

			$primary_requests = $this->requests_model->get_fmc_primary_requests(base64_decode($id));
			$other_requests = $this->requests_model->get_fmc_other_requests(base64_decode($id));
			$closed_requests = $this->requests_model->get_fmc_closed_requests(base64_decode($id));
			$declined_requests = $this->requests_model->get_fmc_declined_requests(base64_decode($id));

			

			$data['primary_requests'] = $primary_requests;
			$data['other_requests'] = $other_requests;
			$data['closed_requests'] = $closed_requests;
			$data['declined_requests'] = $declined_requests;

			$data['details']['departments'] = $user_departments;
		}
		$this->load->view('inc/header',$data);
		$this->load->view('fmc_users_view',$data);
		$this->load->view('inc/footer');
	}	
	
	public function create()
	{
		//Load Email Helper
		$this->load->helper('email');

		$data['title'] = "Create FMC User";		
	
		//Load department for department dropdown		
		$data['departments'] = $this->departments_model->get_departments();
		
		if($this->input->post()){
			
			//Check Email exist or not
			if($this->user_model->checkEmail($this->input->post('email'))){				
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
				$this->session->set_flashdata('flashError', 'Email already exist.'); 
	        	redirect('/fmcusers/create');
			}

			//Check Employee ID exist or not
			if($this->user_model->checkFMCEmployeeID($this->input->post('fmc_employee_id'))){				
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());				
				$this->session->set_flashdata('flashError', 'Employee ID already exist.'); 
	        	redirect('/fmcusers/create');
			}

			$birthdate = explode("/", $this->input->post('birthdate'));
			$birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
				
			
			$profile_picture = "";
			if(isset($_FILES['profile_picture']) && is_uploaded_file($_FILES['profile_picture']['tmp_name'])){

				$file_name = $_FILES['profile_picture']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if( ! $this->upload->do_upload('profile_picture'))
	            {
	                if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError',$this->upload->display_errors());	                	
	                	redirect('/fmcusers');
	                }
	            }else{
	            	$profile_picture = $upload_file_name;
	            }
			}

			$mobile = $this->input->post('mobile');
			if ($mobile[0] == "+")
	        {
	            $mobile = substr($mobile, 1);
	        }
	        if ($mobile[0] == "9" && $mobile[1] == "6" && $mobile[2] == "6")
	        {
	            $mobile = substr($mobile, 3);
	        }
	        if ($mobile[0] == "0")
	        {
	            $mobile = substr($mobile, 1);
	        }

			$insert_data = array(
	            'fmc_employee_id' => $this->input->post('fmc_employee_id'),
	            'user_type' => $this->input->post('user_type'),	            
	            'profile_picture' => $profile_picture,
	            'first_name' => $this->input->post('first_name'),
	            'last_name' => $this->input->post('last_name'),
	            'surname' => $this->input->post('surname'),
	            'email' => $this->input->post('email'),
	            'password' => $this->input->post('password'),
	            'mobile' => $mobile,
	            'alternative_mobile_no' => $this->input->post('alternative_mobile_no'),
	            'birthdate' => $birthdate,
	            'address' => $this->input->post('address'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );



	        $is_inserted = $this->user_model->insert($insert_data);

	        if($is_inserted){
	        	
        		if($this->session->userdata['fmc_form_data_session'])
        		{
	        		$this->session->unset_userdata('fmc_form_data_session');
	        	}

	        	$insert_user_department_data = array();
	        	$department_ids = $this->input->post('department_ids');
	        	if(empty($department_ids)){
	        		$department_ids = array();
	        	}
	        	foreach ($department_ids as $value) {
	        		$insert_user_department_data[] = array("fmc_user_id"=>$is_inserted,"department_id"=>$value);	
	        	}
	        	if(count($insert_user_department_data) > 0){
	        		$this->user_model->insert_user_departments($insert_user_department_data);
	        	}

	        	//Send Email
	        	if(!empty($this->input->post('email'))){
	        		$email_data = array();
	        		$email_data['user_fullname'] = $this->input->post('first_name')." ".$this->input->post('last_name')." ".$this->input->post('surname');
	        		$email_data['email'] = $this->input->post('email');
	        		$email_data['password'] = $this->input->post('password');
					$message = $this->load->view('email-templates/new_fmc_user.php', $email_data,  TRUE);

					$to_email = $email_data['email']; 
					$subject = "FMC - Welcome ".$email_data['user_fullname'];
					send_email($to_email,$subject,$message);
	        	}
	        	
	        	
	        	$this->session->set_flashdata('flashSuccess', 'User has been added successfully.'); 
	        	redirect('/fmcusers');
	        }else{
	        	$this->session->set_flashdata('flashError', 'User has not been added successfully.');
	            redirect('/fmcusers');
	        }
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('fmc_users_create',$data);
		$this->load->view('inc/footer');
	}

	public function update($id = "")
	{
		$data['title'] = "Update FMC User";		

		//Load department for department dropdown		
		$data['departments'] = $this->departments_model->get_departments();

		if(!empty($id)){
			$data['details'] = $this->user_model->get_details(base64_decode($id));

			$fmc_user_departments = $this->user_model->get_user_departments(base64_decode($id));
			
			$user_departments = array();
			foreach ($fmc_user_departments as $value) {
				$user_departments[] = $value['department_id'];	
			}

			$data['details']['departments'] = $user_departments;

			if(!$data['details']){
				$this->session->set_flashdata('flashError', 'User not found.');
				redirect('/fmcusers');
			}
		}

		if($this->input->post()){
			
			$fmc_user_id = base64_decode($this->input->post('id'));

			//Check Email exist or not
			if($this->user_model->checkEmail($this->input->post('email'),$fmc_user_id)){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Email already exist.');
	        	redirect('/fmcusers/update/'.base64_encode($fmc_user_id));
			}

			//Check Employee ID exist or not
			if($this->user_model->checkFMCEmployeeID($this->input->post('fmc_employee_id'),$fmc_user_id)){
				$this->session->set_userdata('fmc_form_data_session',$this->input->post());
				$this->session->set_flashdata('flashError', 'Employee ID already exist.');
	        	redirect('/fmcusers/update/'.base64_encode($fmc_user_id));
			}
			
			$birthdate = explode("/", $this->input->post('birthdate'));
			$birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
			
			$mobile = $this->input->post('mobile');
			if ($mobile[0] == "+")
	        {
	            $mobile = substr($mobile, 1);
	        }
	        if ($mobile[0] == "9" && $mobile[1] == "6" && $mobile[2] == "6")
	        {
	            $mobile = substr($mobile, 3);
	        }
	        if ($mobile[0] == "0")
	        {
	            $mobile = substr($mobile, 1);
	        }


			$update_data = array(
				'id' => $fmc_user_id,
	            'fmc_employee_id' => $this->input->post('fmc_employee_id'),
	            'user_type' => $this->input->post('user_type'),	            
	            'first_name' => $this->input->post('first_name'),
	            'last_name' => $this->input->post('last_name'),
	            'surname' => $this->input->post('surname'),
	            'email' => $this->input->post('email'),
	            'mobile' => $mobile,
	            'alternative_mobile_no' => $this->input->post('alternative_mobile_no'),
	            'birthdate' => $birthdate,
	            'address' => $this->input->post('address'),
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			
			if(isset($_FILES['profile_picture']) && is_uploaded_file($_FILES['profile_picture']['tmp_name'])){

				$file_name = $_FILES['profile_picture']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if($this->upload->do_upload('profile_picture'))
	            {
	            	$update_data['profile_picture'] = $upload_file_name;
	            }
			}

	        $updated_data = $this->user_model->update($update_data);

	        if($updated_data){	        
	        	$insert_user_department_data = array();
	        	if($this->input->post('department_ids')){
		        	$department_ids = $this->input->post('department_ids');
		        	foreach ($department_ids as $value) {
		        		$insert_user_department_data[] = array("fmc_user_id"=>$fmc_user_id,"department_id"=>$value);	
		        	}	        	
		        	$this->user_model->remove_user_departments($fmc_user_id);
		        	$this->user_model->insert_user_departments($insert_user_department_data);
		        }

	        	$this->session->set_flashdata('flashSuccess', 'User has been updated successfully.'); 
	        	redirect('/fmcusers');
	        }else{
	        	$this->session->set_flashdata('flashError', 'User has not been updated successfully.');
	            redirect('/fmcusers');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('fmc_users_update',$data);
		$this->load->view('inc/footer');
	}

	function get(){
		if($this->input->post()){
			
			$department_data = $this->user_model->get_details($this->input->post('id'));

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

        $deleted = $this->user_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'User has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'User has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	

	
}
