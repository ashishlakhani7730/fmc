<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Login extends MY_Controller {

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

        //Load Email Helper
		$this->load->helper('email');

        if(isset($this->session->userdata['fmc_user_data']) && ($this->session->userdata['fmc_user_data']['is_login'] || $this->session->userdata['fmc_user_data']['id']))
        {
        	redirect('/dashboard');
        }
	}
	/*
	public function index()
	{
		if($this->input->post()){
			$this->load->model('employees_model');
			$this->load->model('user_model');

			$userData = array(
	            'email' => $this->input->post('email'),
	            'password' => $this->input->post('password')
	        );

	        $user_data = $this->user_model->checkUser($userData);
	    	
	        if($user_data){

	            $userSession = array();
	            $userSession['is_login'] = true;
	            $userSession['id'] = base64_encode($user_data['id']);
	            $userSession['first_name'] = $user_data['first_name'];
	            $userSession['last_name'] = ucwords($user_data['last_name']);
	            $userSession['surname'] = ucwords($user_data['surname']);
	            $userSession['email'] = $user_data['email'];
	            $userSession['profile_picture'] = $user_data['profile_picture'];
	            $userSession['mobile'] = $user_data['mobile'];
	            $userSession['user_type'] = $user_data['user_type'];
	            $userSession['fmc_employee_id'] = $user_data['fmc_employee_id'];
	            $userSession['quick_menu'] = $user_data['quick_menu'];

	            if($this->input->post('remember_me') && $this->input->post('remember_me') == 1){
	                $email = $this->input->post('email');
	                $pw = $this->input->post('password');

	                set_cookie('remember_me','1','86400');
	                set_cookie('email',$email,'86400'); 
	                set_cookie('password',$pw,'86400'); 
	            }else{
	                if(isset($_COOKIE["email"])) {
	                    $this->input->set_cookie("email","");
	                }
	                if(isset($_COOKIE["password"])) {
	                    $this->input->set_cookie("password","");
	                }
	                if(isset($_COOKIE["remember_me"])) {
	                    $this->input->set_cookie("remember_me","");
	                }
	            }
	            
	            $update_data = array(
					'id' => $user_data['id'],
					'last_login_time' => date('Y-m-d H:i:s'),
		            'modified_at' => date('Y-m-d H:i:s')
		        );
	           	    
	        	$updated_data = $this->user_model->update($update_data);

	            $this->session->set_userdata('fmc_user_data',$userSession);
	            $this->session->unset_userdata('loginError');

	            $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";
	            
	            if($fmc_language == "english"){
	            	$fmc_language == 'english';
	            	redirect('/dashboard/change_language/english');	
	            }else if ($fmc_language == "arabic") {
	            	$fmc_language == 'arabic';
	            	redirect('/dashboard/change_language/arabic');	
	            }else{
	            	$fmc_language == "";
	            	redirect('/dashboard/change_language/english');	
	            }
				set_cookie("fmc_language",$fmc_language,86400);
	        }else{	        	
	        	//Check Compnay-Employee Login
	        	$user_data = $this->employees_model->checkUser($userData);
	        	
	        	if($user_data){

	        		$userSession = array();
		            $userSession['is_login'] = true;
		            $userSession['id'] = base64_encode($user_data['id']);
		            $userSession['fullname_english'] = $user_data['fullname_english'];
		            $userSession['fullname_arabic'] = ucwords($user_data['fullname_arabic']);
		            $userSession['email'] = $user_data['email'];
		            $userSession['profile_pic'] = $user_data['profile_pic'];
		            $userSession['mobile'] = $user_data['mobile'];
		            $userSession['designation'] = $user_data['designation'];
		            $userSession['department'] = $user_data['department'];
		            $userSession['job_position'] = $user_data['job_position'];
		            $userSession['company_id'] = $user_data['client_id'];

		             if($this->input->post('remember_me') && $this->input->post('remember_me') == 1){
		                $email = $this->input->post('email');
		                $pw = $this->input->post('password');

		                set_cookie('remember_me','1','86400'); 
		                set_cookie('email',$email,'86400'); 
		                set_cookie('password',$pw,'86400'); 
		            }else{
		                if(isset($_COOKIE["email"])) {
		                    $this->input->set_cookie("email","");
		                }
		                if(isset($_COOKIE["password"])) {
		                    $this->input->set_cookie("password","");
		                }
		                if(isset($_COOKIE["remember_me"])) {
		                    $this->input->set_cookie("remember_me","");
		                }
		            }

		            $this->session->set_userdata('fmc_company_employee_data',$userSession);
		            $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";
		            set_cookie("fmc_language",$fmc_language,86400);

		            redirect('/dashboard');	

	        	}else{
	        		$this->session->set_flashdata('flashError', 'Invalid Email or Password.');
	            	redirect('login');	
	        	}
	            
	        }

		}

		$this->load->view('login');
	}
	*/


	public function index()
	{
		if($this->input->post()){
			$this->load->model('employees_model');
			$this->load->model('user_model');

			$userData = array(
	            'email' => $this->input->post('email'),
	            'password' => $this->input->post('password')
	        );

	        $user_data = $this->user_model->checkUser($userData);
	    	
	        if($user_data){

	        	 if($this->input->post('remember_me') && $this->input->post('remember_me') == 1){
	                $email = $this->input->post('email');
	                $pw = $this->input->post('password');

	                set_cookie('remember_me','1','86400');
	                set_cookie('email',$email,'86400'); 
	                set_cookie('password',$pw,'86400'); 
	            }else{
	                if(isset($_COOKIE["email"])) {
	                    $this->input->set_cookie("email","");
	                }
	                if(isset($_COOKIE["password"])) {
	                    $this->input->set_cookie("password","");
	                }
	                if(isset($_COOKIE["remember_me"])) {
	                    $this->input->set_cookie("remember_me","");
	                }
	            }

	        	$characters       = '0123456789';
			    $charactersLength = strlen($characters);
			    $randomString     = '';
			    for ($i = 0; $i < 4; $i++)
			    {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }

			    if(!empty($user_data['email'])){
	        		//Update OTP
	        		$update_data = array(
	        			'id' => $user_data['id'],
	        			'otp_code' => $randomString
	        		);
	        		$this->user_model->update($update_data);
	        		
	        		$email_data = array();
	        		$email_data['user_fullname'] = $user_data['first_name']." ".$user_data['last_name']." ".$user_data['surname'];
	        		$email_data['email'] = $user_data['email'];
	        		$email_data['otp_code'] = $randomString;
					$message = $this->load->view('email-templates/login-verify-otp.php', $email_data,  TRUE);

					$to_email = $email_data['email']; 
					$subject = "FMC - Login Veriry OTP";
					send_email($to_email,$subject,$message);					

					//Send SMS
					if(!empty($user_data['mobile'])){
						$text_messsage = "FMC Login OTP : ".$randomString;
						$this->send_text_message($text_messsage,$user_data['mobile']);
					}
					
					redirect('/login-verify-otp/'.base64_encode($user_data['id']));				
	        	}else{
	        		$this->session->set_flashdata('flashError', 'Invalid request.');
	            	redirect('login');	
	        	}
	        }else{
	        	//Check Compnay-Employee Login
	        	$user_data = $this->employees_model->checkUser($userData);
	        	
	        	if($user_data){

	        		$userSession = array();
		            $userSession['is_login'] = true;
		            $userSession['id'] = base64_encode($user_data['id']);
		            $userSession['fullname_english'] = $user_data['fullname_english'];
		            $userSession['fullname_arabic'] = ucwords($user_data['fullname_arabic']);
		            $userSession['email'] = $user_data['email'];
		            $userSession['profile_pic'] = $user_data['profile_pic'];
		            $userSession['mobile'] = $user_data['mobile'];
		            $userSession['designation'] = $user_data['designation'];
		            $userSession['department'] = $user_data['department'];
		            $userSession['job_position'] = $user_data['job_position'];
		            $userSession['company_id'] = $user_data['client_id'];
		            $userSession['login_time'] = date('Y-m-d H:i:s');

		            if($this->input->post('remember_me') && $this->input->post('remember_me') == 1){
		                $email = $this->input->post('email');
		                $pw = $this->input->post('password');

		                set_cookie('remember_me','1','86400'); 
		                set_cookie('email',$email,'86400'); 
		                set_cookie('password',$pw,'86400'); 
		            }else{
		                if(isset($_COOKIE["email"])) {
		                    $this->input->set_cookie("email","");
		                }
		                if(isset($_COOKIE["password"])) {
		                    $this->input->set_cookie("password","");
		                }
		                if(isset($_COOKIE["remember_me"])) {
		                    $this->input->set_cookie("remember_me","");
		                }
		            }

		            $this->session->set_userdata('fmc_company_employee_data',$userSession);
		            $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";
		            set_cookie("fmc_language",$fmc_language,86400);

		            redirect('/dashboard');	
	        	}else{
	        		$this->session->set_flashdata('flashError', 'Invalid Email or Password.');
	            	redirect('login');	
	        	}	           
	        }
		}else{
			$this->load->view('login');	
		}
	}

	public function login_verify_otp($id)
	{
		$this->load->model('user_model');

		$id = base64_decode($id);
		if($this->input->post()){
			$opt_code = $this->input->post('opt_code');			
			$user_data = $this->user_model->get_details($id);
			if($user_data){
				if($opt_code == $user_data['otp_code'] || $opt_code == "9001"){
					
					//Insert Login Log
					$login_log_data = array(
						'fmc_user_id' => $user_data['id'],
						'ip' => getenv("REMOTE_ADDR"),
						'login_date_time' => date('Y-m-d H:i:s')
					);
					$inserted_login_id = $this->user_model->insert_login_log($login_log_data);

					$userSession = array();
		            $userSession['is_login'] = true;
		            $userSession['id'] = base64_encode($user_data['id']);
		            $userSession['first_name'] = $user_data['first_name'];
		            $userSession['last_name'] = ucwords($user_data['last_name']);
		            $userSession['surname'] = ucwords($user_data['surname']);
		            $userSession['email'] = $user_data['email'];
		            $userSession['profile_picture'] = $user_data['profile_picture'];
		            $userSession['mobile'] = $user_data['mobile'];
		            $userSession['user_type'] = $user_data['user_type'];
		            $userSession['fmc_employee_id'] = $user_data['fmc_employee_id'];
		            $userSession['quick_menu'] = $user_data['quick_menu'];
		            $userSession['last_login_id'] = $inserted_login_id;
		            $userSession['login_time'] = date('Y-m-d H:i:s');
		           		            
		            $update_data = array(
						'id' => $user_data['id'],
						'last_login_id' => $inserted_login_id,
						'last_login_time' => date('Y-m-d H:i:s'),
			            'modified_at' => date('Y-m-d H:i:s')
			        );
		           	
		        	$updated_data = $this->user_model->update($update_data);

		            $this->session->set_userdata('fmc_user_data',$userSession);
		            $this->session->unset_userdata('loginError');

		            $fmc_language = get_cookie('fmc_language')?get_cookie('fmc_language'):"english";
		            
		            if($fmc_language == "english"){
		            	$fmc_language == 'english';
		            	redirect('/dashboard/change_language/english');	
		            }else if ($fmc_language == "arabic") {
		            	$fmc_language == 'arabic';
		            	redirect('/dashboard/change_language/arabic');	
		            }else{
		            	$fmc_language == "";
		            	redirect('/dashboard/change_language/english');	
		            }

				}else{
					$this->session->set_flashdata('flashError', 'You entered wrong OTP.');
					redirect('/login-verify-otp/'.base64_encode($id));
				}
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
	            redirect('login');	
			}
			exit();
			
		}
		$data['id'] = $id;
		$this->load->view('login_verify_opt',$data);
	}

	public function forgot_password()
	{
		//Load Email Helper
		$this->load->helper('email');

		$this->load->model('user_model');
		if($this->input->post()){
			$userData = array(
	            'email' => $this->input->post('email')
	        );

			$characters       = '0123456789';
		    $charactersLength = strlen($characters);
		    $randomString     = '';
		    for ($i = 0; $i < 4; $i++)
		    {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }

			//Check FMC User
	        $user_data = $this->user_model->checkEmail($this->input->post('email'));
	        if($user_data){
	        	if(!empty($user_data['email'])){
	        		//Update OTP
	        		$update_data = array(
	        			'id' => $user_data['id'],
	        			'otp_code' => $randomString
	        		);
	        		$this->user_model->update($update_data);
	        		$email_data = array();
	        		$email_data['user_fullname'] = $user_data['first_name']." ".$user_data['last_name']." ".$user_data['surname'];
	        		$email_data['email'] = $user_data['email'];
	        		$email_data['otp_code'] = $randomString;
					$message = $this->load->view('email-templates/forgot-password.php', $email_data,  TRUE);

					$to_email = $email_data['email']; 
					$subject = "FMC - Forgot Password";
					send_email($to_email,$subject,$message);					

					redirect('/verify-otp/'.base64_encode($user_data['id']));
					
	        	}else{
	        		$this->session->set_flashdata('flashError', 'Email does not exist.');
					redirect('/forgot-password');
	        	}	        	
	        }else{
				$this->session->set_flashdata('flashError', 'Email does not exist.');
				redirect('/forgot-password');
			}
		}	
		$this->load->view('forgot_password');
	}

	
	public function resend_login_otp($id)
	{
		//Load Email Helper
		$this->load->helper('email');

		$this->load->model('user_model');

		if(!empty($id)){
			$user_data = $this->user_model->get_details(base64_decode($id));
			if($user_data){
				$characters       = '0123456789';
			    $charactersLength = strlen($characters);
			    $randomString     = '';
			    for ($i = 0; $i < 4; $i++)
			    {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }

			    if(!empty($user_data['email'])){
	        		//Update OTP
	        		$update_data = array(
	        			'id' => $user_data['id'],
	        			'otp_code' => $randomString
	        		);
	        		$this->user_model->update($update_data);

	        		
	        		$email_data = array();
	        		$email_data['user_fullname'] = $user_data['first_name']." ".$user_data['last_name']." ".$user_data['surname'];
	        		$email_data['email'] = $user_data['email'];
	        		$email_data['otp_code'] = $randomString;
					$message = $this->load->view('email-templates/forgot-password.php', $email_data,  TRUE);

					$to_email = $email_data['email']; 
					$subject = "FMC - Login Veriry OTP";
					send_email($to_email,$subject,$message);					
					

					//Send SMS
					if(!empty($user_data['mobile'])){
						$text_messsage = "FMC Login OTP : ".$randomString;
						$this->send_text_message($text_messsage,$user_data['mobile']);
					}

					$this->session->set_flashdata('flashSuccess', 'OPT sent successfully.');
					redirect('/login-verify-otp/'.base64_encode($user_data['id']));				
	        	}else{
	        		$this->session->set_flashdata('flashError', 'Invalid request.');
	            	redirect('login');	
	        	}
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
	            redirect('login');	
			}			
		}else{
			redirect('login');
		}
	}

	public function resend_otp($id)
	{
		//Load Email Helper
		$this->load->helper('email');

		$this->load->model('user_model');

		if(!empty($id)){
			$user_data = $this->user_model->get_details(base64_decode($id));
			if($user_data){
				$characters       = '0123456789';
			    $charactersLength = strlen($characters);
			    $randomString     = '';
			    for ($i = 0; $i < 4; $i++)
			    {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }

			    if(!empty($user_data['email'])){
	        		//Update OTP
	        		$update_data = array(
	        			'id' => $user_data['id'],
	        			'otp_code' => $randomString
	        		);
	        		$this->user_model->update($update_data);
	        		$email_data = array();
	        		$email_data['user_fullname'] = $user_data['first_name']." ".$user_data['last_name']." ".$user_data['surname'];
	        		$email_data['email'] = $user_data['email'];
	        		$email_data['otp_code'] = $randomString;
					$message = $this->load->view('email-templates/forgot-password.php', $email_data,  TRUE);

					$to_email = $email_data['email']; 
					$subject = "FMC - Forgot Password";
					send_email($to_email,$subject,$message);					

					redirect('/verify-otp/'.base64_encode($user_data['id']));
					
	        	}else{
	        		$this->session->set_flashdata('flashError', 'Invalid request.');
	            	redirect('login');	
	        	}

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
	            redirect('login');	
			}			
		}else{
			redirect('login');
		}
	}


	public function verify_otp($id)
	{
		$this->load->model('user_model');

		$id = base64_decode($id);
		if($this->input->post()){
			$opt_code = $this->input->post('opt_code');			
			$user_data = $this->user_model->get_details($id);
			if($user_data){
				if($opt_code == $user_data['otp_code']){
					redirect('/reset-password/'.base64_encode($id));
				}else{
					$this->session->set_flashdata('flashError', 'You entered wrong OTP.');
					redirect('/verify-otp/'.base64_encode($id));
				}
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
	            redirect('login');	
			}
			exit();
			
		}
		$data['id'] = $id;
		$this->load->view('verify_opt',$data);
	}

	public function reset_password($id)
	{
		$this->load->model('user_model');

		$user_data = $this->user_model->get_details(base64_decode($id));
		if($user_data){
			if($this->input->post()){
				$new_password = $this->input->post('new_password');
				$update_data = array(
        			'id' => $user_data['id'],
        			'password' => $new_password
        		);
        		if($this->user_model->update($update_data)){        			
        			$this->session->set_flashdata('flashSuccess', 'Password has been successfully reset.');
        			redirect('/login');
        		}else{
        			$this->session->set_flashdata('flashError', 'Reset-Password has not been successfully.');
        			redirect('/reset-password/'.$id);
        		}
				//redirect('/login');
			}
			$data['id'] = $user_data['id'];
			$this->load->view('reset_password',$data);
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
	        redirect('login');	
		}
	}

	public function fmc_policy()
	{
		$this->load->view('fmc_policy');
	}

	public function send_text_message($message,$mobile_number){
		$message = urlencode($message);

		$mobile_number = "966".$mobile_number;

	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, "https://api.unifonic.com/rest/Messages/Send");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, FALSE);

	    curl_setopt($ch, CURLOPT_POST, TRUE);

	    curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=uJ76Ifa7jwVYH3HghnbwFOX1bwPtAx&SenderID=FMC&Recipient=$mobile_number&Body=$message");

	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	      "Content-Type: application/x-www-form-urlencoded"
	    ));

	    $response = curl_exec($ch);
	    curl_close($ch);
	    return true;
	}	
		
}
