<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends MY_Controller {

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
        
        //Models
        $this->load->model('clients_model');
        $this->load->model('salary_components_model');               
        $this->load->model('cities_model');
        $this->load->model('regions_model');
        $this->load->model('clients_properties_model');
        $this->load->model('user_model');
        $this->load->model('company_departments_model');
        $this->load->model('leave_types_model');
        $this->load->model('client_required_documents_model');
        $this->load->model('notifications_model');
        $this->load->model('email_notifications_model');
        $this->load->model('requests_model');        
        $this->load->model('requests_threads_model');
        $this->load->model('common_documents_model');
        $this->load->model('request_comment_model');
        $this->load->model('legalentity_model');
		$this->load->model('mainactivity_model');
		$this->load->model('countries_model');

        //Library
        $this->load->library('upload');

        //Helper
        $this->load->helper('email');        

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
		$data['title'] = "Clients";		
		
		$data['items'] = $this->clients_model->get_all();
		
		$this->load->view('inc/header',$data);
		$this->load->view('clients',$data);
		$this->load->view('inc/footer');
	}

	public function create_draft_client($id = "")
	{
		$client_draft_id = $this->clients_model->create_draft_company_if_not_exist(base64_decode($id));
		if($client_draft_id){
			redirect('/clients/create_general_information/'.base64_encode($client_draft_id));
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.'); 
            redirect('clients');
		}
	}

	public function create_general_information($id = "")
	{
		$data['title'] = "Create Clients | General Information";		

		if(!empty($id)){
			//Create Draft Company From Company details
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);
			if($details){
				$data['details'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('clients');
			}
		}

		if($this->input->post()){
			$cr_number_from_date = ($this->input->post('cr_number_from_date') != "") ? $this->input->post('cr_number_from_date') : '00/00/0000';

			$cr_number_from_date = explode("/", $cr_number_from_date);
			$cr_number_from_date = $cr_number_from_date[2]."-".$cr_number_from_date[1]."-".$cr_number_from_date[0];

			$cr_number_issue_date = ($this->input->post('cr_number_issue_date') != "") ? $this->input->post('cr_number_issue_date') : '00/00/0000';
			$cr_number_issue_date = explode("/", $cr_number_issue_date);
			$cr_number_issue_date = $cr_number_issue_date[2]."-".$cr_number_issue_date[1]."-".$cr_number_issue_date[0];

			$cr_number_expiry_date = ($this->input->post('cr_number_expiry_date') != "") ? $this->input->post('cr_number_expiry_date') : '00/00/0000';
			$cr_number_expiry_date = explode("/", $cr_number_expiry_date);
			$cr_number_expiry_date = $cr_number_expiry_date[2]."-".$cr_number_expiry_date[1]."-".$cr_number_expiry_date[0];

			$established_date = ($this->input->post('established_date') != "") ? $this->input->post('established_date') : '00/00/0000';
			$established_date = explode("/", $established_date);
			$established_date = $established_date[2]."-".$established_date[1]."-".$established_date[0];
			
			$fmc_login_user_id = $this->session->userdata['fmc_user_data']['id'];

			$insert_data = array(
				'primary_hr' => $this->input->post('primary_hr'),
	            'company_name_english' => $this->input->post('company_name_english'),
	            'company_name_arabic' => $this->input->post('company_name_arabic'),
	            'all_cis' => $this->input->post('all_cis'),
	            'cr_number' => $this->input->post('cr_number'),
	            'cr_number_from_date' => $cr_number_from_date,
	            'cr_number_issue_date' => $cr_number_issue_date,
	            'cr_number_expiry_date' => $cr_number_expiry_date,
	            'legal_entity' => $this->input->post('legal_entity'),
	            'established_date' => $established_date,
	            'main_activity' => $this->input->post('main_activity'),
	            'country_of_origin' => $this->input->post('country_of_origin'),
	            'about_company' => $this->input->post('about_company'),
	            'created_by' => base64_decode($fmc_login_user_id),	        	
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        
			if(isset($_FILES['company_logo']) && is_uploaded_file($_FILES['company_logo']['tmp_name'])){

				$file_name = $_FILES['company_logo']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        		        	
	        	$this->upload->initialize($config);
	        	if($this->upload->do_upload('company_logo'))
	            {
	            	$insert_data['company_logo'] = $upload_file_name;
	            }else{
	            	if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
	                	$this->session->set_flashdata('flashdata',$dataArray);
	                	if(!empty($this->input->post('id'))){
	                		redirect('/clients/create_general_information/'.$this->input->post('id'));
	                	}else{
	                		redirect('/clients/create_general_information');
	                	}	                	
	                	exit();
	                }
	            }
			}

	        if(!empty($this->input->post('id'))){
	        	$client_draft_id = base64_decode($this->input->post('id'));
	        	//Get Draft Details
	        	$details = $this->clients_model->get_draft_details($client_draft_id);
	        	$client_original_details = $this->clients_model->get_original_details($details['client_id']);

	        	if($client_original_details['status'] == 'declined'){
	        		$update_original_data = array(
	        			'id' => $client_id,
	        			'status' => 'draft',
	        			'modified_at' => date('Y-m-d H:i:s')
	        		);
	        		$this->clients_model->update($update_original_data);
	        	}

	        	$insert_data['id'] = $client_draft_id;
	        	$is_updated = $this->clients_model->update_draft($insert_data);
	        	if($is_updated){
		        	$this->session->set_flashdata('flashSuccess', 'Client has been updated successfully.'); 
		        	redirect('/clients/create_contract_details/'.base64_encode($client_draft_id));
		        }else{
		        	$this->session->set_flashdata('flashError', 'Client not been update successfully.');
		            redirect('/create_general_information');
		        }

	        }else{
	        	$insert_data['status'] = "draft";

	        	$client_draft_id = $this->clients_model->insert($insert_data);
	        	if($client_draft_id){
					$this->session->set_flashdata('flashSuccess', 'Client been inserted successfully.');
		        	redirect('/clients/create_contract_details/'.base64_encode($client_draft_id));
		        }else{
		        	$this->session->set_flashdata('flashError', 'Client not been inserted successfully.');
		            redirect('/create_general_information');
		        }
	        }	        			
	    }

	    //All Data
	    $data['fmc_users'] = $this->user_model->get_all();	    
	    $data['legal_entities'] = $this->legalentity_model->get_all();
		$data['main_activities'] = $this->mainactivity_model->get_all();
		$data['countries'] = $this->countries_model->get_all();

	    $this->load->view('inc/header',$data);
		$this->load->view('clients_create_step_1',$data);
		$this->load->view('inc/footer');
	}

	public function create_contract_details($id = "")
	{
		if(!empty($id)){
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);
			
			if($details){
				$data['title'] = "Clients | Contract Details";
				$data['details'] = $details;

				if($this->input->post()){

					$contract_agreement_file = "";
					if(isset($_FILES['contract_agreement_file']) && is_uploaded_file($_FILES['contract_agreement_file']['tmp_name'])){

						$file_name = $_FILES['contract_agreement_file']['name'];
			            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
			            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
			            $upload_file_name = time()."_".$upload_file_name;

			            $config = array();
				        $config['allowed_types'] = 'pdf|odt|xls|xlsx|ppt|txt|doc|docx|jpg|jpeg|png';
				        $config['upload_path'] = 'uploads/';
				        $config['file_name'] = $upload_file_name;

			        	$this->upload->initialize($config);
			        	if( ! $this->upload->do_upload('contract_agreement_file'))
			            {
			                if($this->upload->display_errors())
			                {
			                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
			                	$this->session->set_flashdata('flashdata',$dataArray);
			                	redirect('/clients/create_contract_details/'.$id);
			                	exit();
			                }
			            }else{
			            	$contract_agreement_file = $upload_file_name;
			            }
					}
					
					$contract_date = explode("/", $this->input->post('contract_date'));
					$contract_date = $contract_date[2]."-".$contract_date[1]."-".$contract_date[0];

					$contract_start_date = explode("/", $this->input->post('contract_start_date'));
					$contract_start_date = $contract_start_date[2]."-".$contract_start_date[1]."-".$contract_start_date[0];

					$contract_end_date = explode("/", $this->input->post('contract_end_date'));
					$contract_end_date = $contract_end_date[2]."-".$contract_end_date[1]."-".$contract_end_date[0];

					$update_data = array(
						"id" => $client_draft_id,
						"contract_number" => $this->input->post("contract_number"),
						"contract_date" => $contract_date,
						"contract_start_date" => $contract_start_date,
						"contract_end_date" => $contract_end_date,
						"contract_created_by" => $this->input->post("contract_created_by"),
						"contract_signed_by_fmc" => $this->input->post("contract_signed_by_fmc"),
						"contract_signed_by_client" => $this->input->post("contract_signed_by_client"),
						"contract_signed_location" => $this->input->post("contract_signed_location"),
						"contract_notes" => $this->input->post("contract_notes")
					);
					
					if(!empty($contract_agreement_file)){
						$update_data['contract_agreement_file'] = $contract_agreement_file;
					}

					$is_updated = $this->clients_model->update_draft($update_data);

		        	if($is_updated){
			        	$this->session->set_flashdata('flashSuccess', 'Client been updated successfully.'); 

			        	if($this->input->post('next_btn')){
			        		redirect('/clients/create_contact_information/'.$id);
			        		exit();
			        	}else{
			        		redirect('/clients/create_contract_details/'.$id);
			        		exit();
			        	}
			        }else{
			        	$this->session->set_flashdata('flashError', 'Client not been update successfully.');
			            redirect('/create_general_information');
			        }
			    }

			    $this->load->view('inc/header',$data);
				$this->load->view('clients_create_step_2',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('clients');	
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.'); 
            redirect('clients');
		}
	}

	public function create_contact_information($id = "")
	{
		if(!empty($id)){		
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);

			if($details){
				$data['title'] = "Clients | Contact Information";
				$data['details'] = $details;
				$data['regions'] = $this->regions_model->get_all();
				$data['cities'] = $this->cities_model->get_all();
				

				if($this->input->post()){
					
					$update_data = array(
						"id" => $client_draft_id,
						"post_box_no" => $this->input->post("post_box_no"),
						"building_no" => $this->input->post("building_no"),
						"street_name" => $this->input->post("street_name"),
						"region_id" => $this->input->post("region_id"),
						"city_id" => $this->input->post("city_id"),
						"zip_code" => $this->input->post("zip_code"),
						"addional_no" => $this->input->post("addional_no"),
						"longitude" => $this->input->post("longitude"),
						"telephone_no" => $this->input->post("telephone_no"),
						"fax_no" => $this->input->post("fax_no"),
						"email" => $this->input->post("email"),
						"website" => $this->input->post("website"),
						"contact_person_name" => $this->input->post("contact_person_name"),
						"contact_person_mobile" => $this->input->post("contact_person_mobile"),
						"contact_person_email" => $this->input->post("contact_person_email"),
						"contact_person_tel_ext" => $this->input->post("contact_person_tel_ext")
					);

					$is_updated = $this->clients_model->update_draft($update_data);

		        	if($is_updated){
			        	$this->session->set_flashdata('flashSuccess', 'Contact-Information been updated successfully.'); 
			        	
			        	if($this->input->post('next_btn')){
			        		redirect('/clients/create_property_information/'.$id);
			        		exit();
			        	}else{
			        		redirect('/clients/create_contact_information/'.$id);
			        		exit();
			        	}
			        }else{
			        	$this->session->set_flashdata('flashError', 'Client not been update successfully.');
			            redirect('/create_general_information');
			        }
			    }			    

			    $this->load->view('inc/header',$data);
				$this->load->view('clients_create_step_3',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('clients');	
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.'); 
            redirect('clients');
		}
	}

	public function create_property_information($id = "")
	{
		$this->load->model('countries_model');

		if(!empty($id)){		
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);
			
			if($details){
				$data['title'] = "Clients | Property Information";
				$data['details'] = $details;
				$data['countries'] = $this->countries_model->get_all();
				$data['properties'] = $this->clients_properties_model->get_all_draft($client_draft_id);

				if($this->input->post()){
					$property_information_arr = array();
					foreach($this->input->post('owner_name') as $key => $value){

						$birthdate = "";
						if(!empty($this->input->post('birthdate')[$key])){
							$birthdate = explode("/", $this->input->post('birthdate')[$key]);
							$birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
						}						

						$property_information_arr[] = array(
							'client_draft_id' => $client_draft_id,
							'client_id' => $details['client_id'],
		 					'owner_name' => $this->input->post('owner_name')[$key],
							'nationality' => $this->input->post('nationality')[$key],
							'company_status' => $this->input->post('company_status')[$key],
							'property_percentage' => $this->input->post('property_percentage')[$key]
						);	
					}
					
					$this->clients_properties_model->remove_all_draft($client_draft_id);
					$is_updated = $this->clients_properties_model->insert_batch_draft($property_information_arr);

		        	if($is_updated){
		        		$this->session->set_flashdata('flashSuccess', 'Client property information updated successfully.');

		        		if($this->input->post('next_btn')){
			        		redirect('/clients/create_executive_management/'.$id);
			        		exit();
			        	}else{
		        			redirect('/clients/create_property_information/'.$id);
			        		exit();
			        	}
		        	}else{
		        		$this->session->set_flashdata('flashError', 'Client property information not been update successfully.');
			            redirect('/clients/create_property_information');
		        	}
					
				}

			    $this->load->view('inc/header',$data);
				$this->load->view('clients_create_step_4',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('clients');	
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.'); 
            redirect('clients');
		}
	}

	public function create_executive_management($id = "")
	{
		if(!empty($id)){		
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);

			if($details){
				$data['title'] = "Clients | Executive Management";
				$data['details'] = $details;
				$data['executives'] = $this->clients_model->get_executives_draft(base64_decode($id));

				if($this->input->post()){

					$executives_arr = array();
					foreach($this->input->post('executive_name') as $key => $value){

						$executives_arr[] = array(
							'client_draft_id' => $client_draft_id,
							'client_id' => $details['client_id'],
		 					'executive_name' => $this->input->post('executive_name')[$key],
							'job_position' => $this->input->post('job_position')[$key]
						);	
					}

					$this->clients_model->remove_all_executives_draft($client_draft_id);
					$is_updated = $this->clients_model->insert_executives_draft($executives_arr);

		        	if($is_updated){
		        		$this->session->set_flashdata('flashSuccess', 'Client property information updated successfully.');
		        		if($this->input->post('next_btn')){
			        		redirect('/clients/create_branch_subsidiary/'.$id);
			        		exit();
			        	}else{
		        			redirect('/clients/create_executive_management/'.$id);
			        		exit();
			        	}
			        	exit();
		        	}else{
		        		$this->session->set_flashdata('flashError', 'Client property information not been update successfully.');
			            redirect('/clients/create_executive_management');
		        	}

			    }

			    $this->load->view('inc/header',$data);
				$this->load->view('clients_create_step_5',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('clients');	
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.'); 
            redirect('clients');
		}

	}

	public function create_branch_subsidiary($id = "")
	{
		
		if(!empty($id)){		
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);

			if($details){
				$data['title'] = "Clients | Branch/Subsidiary Information";
				$data['details'] = $details;
				$data['regions'] = $this->regions_model->get_all();
				$data['cities'] = $this->cities_model->get_all();
				$data['branches'] = $this->clients_model->get_branches_draft($client_draft_id);

				if($this->input->post()){
					$trading_name_arr = $this->input->post('trading_name');
					$branches_arr = array();
					if($trading_name_arr && count($trading_name_arr) > 0){
						foreach($this->input->post('trading_name') as $key => $value){
							$branches_arr[] = array(
								'client_draft_id' => $client_draft_id,
								'client_id' => $details['client_id'],
			 					'trading_name' => $this->input->post('trading_name')[$key],
								'branch_type' => $this->input->post('branch_type')[$key],
								'po_box' => $this->input->post('po_box')[$key],
								'building_no' => $this->input->post('building_no')[$key],
								'street_name' => $this->input->post('street_name')[$key],
								'region_id' => $this->input->post('region_id')[$key],
								'city_id' => $this->input->post('city_id')[$key],
								'zip_code' => $this->input->post('zip_code')[$key],
								'addional_no' => $this->input->post('addional_no')[$key],
								'latitude' => $this->input->post('latitude')[$key],
								'longitude' => $this->input->post('longitude')[$key],
								'tel_no' => $this->input->post('tel_no')[$key],
								'fax_no' => $this->input->post('fax_no')[$key],
								'email' => $this->input->post('email')[$key],
								'website' => $this->input->post('website')[$key],
								'contact_person_name' => $this->input->post('contact_person_name')[$key],
								'contact_person_mobile' => $this->input->post('contact_person_mobile')[$key],
								'contact_person_email' => $this->input->post('contact_person_email')[$key],
								'contact_person_tel_ext' => $this->input->post('contact_person_tel_ext')[$key]
							);	
						}
					}

					$this->clients_model->remove_all_branches_draft($client_draft_id);
					if(count($branches_arr) > 0){
						$is_updated = $this->clients_model->insert_branches_draft($branches_arr);
						if($is_updated){
			        		$this->session->set_flashdata('flashSuccess', 'Client property information updated successfully.');		        		
			        		if($this->input->post('next_btn')){
				        		redirect('/clients/create_company_documents/'.$id);
				        		exit();
				        	}else{
			        			redirect('/clients/create_branch_subsidiary/'.$id);
				        		exit();
				        	}
			        	}else{
			        		$this->session->set_flashdata('flashError', 'Client property information not been update successfully.');
			        		redirect('/clients/create_branch_subsidiary/'.$id);
			        	}
					}else{
						$this->session->set_flashdata('flashSuccess', 'Client property information updated successfully.');		        		
		        		if($this->input->post('next_btn')){
			        		redirect('/clients/create_company_documents/'.$id);
			        		exit();
			        	}else{
		        			redirect('/clients/create_branch_subsidiary/'.$id);
			        		exit();
			        	}
					}
			    }

			    $this->load->view('inc/header',$data);
				$this->load->view('clients_create_step_6',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.'); 
            	redirect('clients');	
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.'); 
            redirect('clients');
		}
	}

	public function create_company_documents($id = "")
	{

		if(!empty($id)){
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);

			if($details){
				$data['title'] = "Clients | Company Documents";
				$data['details'] = $details;
				$data['required_documents'] = $this->client_required_documents_model->get_all();
				$data['documents'] = $this->clients_model->get_documents_draft(base64_decode($id));

				$this->load->view('inc/header',$data);
				$this->load->view('clients_create_step_7',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('clients');
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('clients');
		}
	}

	public function delete_document($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->clients_model->delete_document_draft($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Document has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Document has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

	public function upload_document(){
		if($this->input->post()){
			$response = array();
			$client_id = base64_decode($this->input->post('client_id'));
			$client_draft_id = base64_decode($this->input->post('client_draft_id'));

			if(isset($_FILES['document']) && is_uploaded_file($_FILES['document']['tmp_name'])){

				$file_name = $_FILES['document']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'pdf|odt|xls|xlsx|ppt|txt|doc|docx|jpg|jpeg|png';
		        $config['upload_path'] = 'uploads/';
		        $config['max_size']  = 15000;
		        
		        $config['file_name'] = $upload_file_name;
	        	
	        	$document_file = "";
	        	$this->upload->initialize($config);
	        	if( ! $this->upload->do_upload('document'))
	            {
	                if($this->upload->display_errors())
	                {
	                	$this->session->set_flashdata('flashError', $this->upload->display_errors());
	                	$response['status'] = "false";
	        			echo json_encode($response);
	        			exit();
	                }
	            }else{
	            	$document_file = $upload_file_name;
	            }

	            $date = explode("/", $this->input->post('date'));
				$date = $date[2]."-".$date[1]."-".$date[0];

				$expire_date = explode("/", $this->input->post('expire_date'));
				$expire_date = $expire_date[2]."-".$expire_date[1]."-".$expire_date[0];

				$fmc_login_user_id = $this->session->userdata['fmc_user_data']['id'];

				if($this->input->post('document_title_type') == "other"){
					$title = $this->input->post('title');
				}else{
					$title = $this->input->post('document_title_type');
				}

				$insert_data = array(
					"client_id" => $client_id,
					"client_draft_id" => $client_draft_id,
					"title" => $title,
					"date" => $date,
					"expire_date" => $expire_date,
					"note" => $this->input->post('note'),
					"document_file" => $document_file,
					"created_by" => base64_decode($fmc_login_user_id),
					"status" => "draft",
					"created_at" => date('Y-m-d H:i:s'),
			        "modified_at" => date('Y-m-d H:i:s')
				);
				
				$is_updated = $this->clients_model->insert_document_draft($insert_data);

	        	if($is_updated){
	        		$this->session->set_flashdata('flashSuccess', 'Client document uploaded successfully.');		        		
	        		$response['status'] = "true";
	        	}else{
	        		$this->session->set_flashdata('flashError', 'Client document has not been upload successfully.');
	        		$response['status'] = "false";
	        	}
				echo json_encode($response);
				//redirect('/clients/create_company_documents/'.base64_encode($client_draft_id));
			}else{
				$this->session->set_flashdata('flashError', 'Document not uploaded.');
				$response['status'] = "false";
				echo json_encode($response);
			}
	    }else{
	    	$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('clients');
	    }
	}

	public function test_email(){
		//Send Email
		$email_data = array();
		$email_data['user_fullname'] = "Hiren";
		$email_data['is_request_inserted'] = "";
		$message = $this->load->view('email-templates/client_confirmation_request.php', $email_data,  TRUE);

		$to_email = "hiren@kalpcorporate.com";
		$subject = "FMC - Title";
		send_email($to_email,$subject,$message);
	}

	public function confirm_client_details($id = ""){		
		if(!empty($id)){
			//Load Email Helper
			$this->load->helper('email');

			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);
			$client_id = $details['client_id'];
			$original_details = $this->clients_model->get_original_details($client_id);

			if($details){
				$data['title'] = "Confirm Client Details";
				$data['details'] = $details;

				$data['properties'] = $this->clients_properties_model->get_all_draft($client_draft_id);
				$data['executives'] = $this->clients_model->get_executives_draft($client_draft_id);
				$data['branches'] = $this->clients_model->get_branches_draft($client_draft_id);

				$required_documents_tmp = $this->client_required_documents_model->get_all();
				$required_documents = array();
				foreach ($required_documents_tmp as $value) {
					$required_documents[] = $value['name'];	
				}
				$data['required_documents'] = $required_documents;
				$data['documents'] = $this->clients_model->get_documents_draft($client_draft_id);

				$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
				$this->load->model('user_model');
				$data['fmc_users'] = $this->user_model->get_all($login_user_id);

				//Get Request Details IF
				if(isset($details['request_id']) && $details['request_id'] != "0"){
					$request_details = $this->requests_model->get_details($details['request_id']);
					$request_threads = $this->requests_threads_model->get_all($details['request_id']);

					//Get Request Comments
					$request_comments_tmp = $this->request_comment_model->get_all($request_details['id']);
					$request_comments = array();
					foreach ($request_comments_tmp as $value) {
						$documents = $this->common_documents_model->get_all('request_comment',$value['id']);
						if(empty($documents)){
							$documents = array();
						}
						
						$comment_by = "";
						if($value['employee_id'] != 0){
							$employee_details = $this->employees_model->get_details($value['employee_id']);				
							$comment_by = $employee_details['fullname_english'];
						}
						if($value['fmc_user_id'] != 0){
							$comment_by = "FMC";
						}
						$request_comments[] = array(
							'comment_by' => $comment_by,
							'documents' => $documents,
							'description' => $value['description'],
							'created_at' => $value['created_at']
						);
					}
					$request_details['request_comments'] = $request_comments;

					$data['request_details'] = $request_details;
					$data['request_threads'] = $request_threads;
				}
								
				if($this->input->post()){
					$fmc_login_user_id = $this->session->userdata['fmc_user_data']['id'];
					$assigned_fmc_user_id = $this->input->post('assigned_fmc_user_id');
					$assigned_fmc_user_details = $this->user_model->get_details($assigned_fmc_user_id);

					$request_data = array(
						'company_id' => $client_id,
						'request_type' => 'client_confirmation',
						//'note' => $this->input->post('note'),
						'assigned_fmc_user_id' => $assigned_fmc_user_id,
						'created_by_fmc' => base64_decode($fmc_login_user_id),
						'status' => 'in_approval',
						'created_at' => date('Y-m-d H:i:s'),
						'modified_at' => date('Y-m-d H:i:s')
					);

					
					$is_request_inserted = $this->requests_model->insert($request_data);					

					if(!$is_request_inserted){
						$this->session->set_flashdata('flashError', 'Request has not been created successfully.'); 
						redirect('clients/confirm_client_details/'.$id);
					}
					
					/*Create Request Thread*/
					$insert_request_thread_data = array(
						'request_id' => $is_request_inserted,
						'note' => "Request created - ".$this->input->post('note'),
						'log_text' => "Request created - ".$this->input->post('note'),
						'company_id' => base64_decode($id),
						'status' => 'created',
						'created_at' => date('Y-m-d H:i:s')
					);
					$this->requests_threads_model->insert($insert_request_thread_data);
					/*End Create Request Thread*/

					$update_draft_data = array(
						'id' => $client_draft_id,
						'request_id' => $is_request_inserted,
						'status' => 'in_confirmation',
						'modified_at' => date('Y-m-d H:i:s')
					);
					$is_updated = $this->clients_model->update_draft($update_draft_data);

					if($original_details['status'] == 'detail_validated'){
						$update_data = array(
							'id' => $client_id,
							'status' => 'in_confirmation',
							'modified_at' => date('Y-m-d H:i:s')
						);
						$this->clients_model->update($update_data);
					}

					if($is_updated){

						$title_en = "Verify ".$original_details['company_name_english']."'s' details";
						$title_ar = "تحقق ".$original_details['company_name_arabic']." تفاصيل";

						//Insert Notification
						$notification_data = array(
							'title_en' => $title_en,
							'title_ar' => $title_ar,
							'company_id' => base64_decode($id),
							'fmc_user_id' => $this->input->post('assigned_fmc_user_id'),
							'type' => 'client_confirmation',
							'request_id' => $is_request_inserted,
							'status' => 'unread',
							'created_at' => date('Y-m-d H:i:s')
						);
						$this->notifications_model->insert($notification_data);
						
						//Send Email
						$email_data = array();
		        		$email_data['user_fullname'] = $assigned_fmc_user_details['first_name']." ".$assigned_fmc_user_details['last_name']." ".$assigned_fmc_user_details['surname'];
		        		$email_data['is_request_inserted'] = $is_request_inserted;
		        		$message = $this->load->view('email-templates/client_confirmation_request.php', $email_data,  TRUE);

		        		$to_email = $assigned_fmc_user_details['email'];
						$subject = "FMC - ".$title_en;
						send_email($to_email,$subject,$message);
						
			        	$this->session->set_flashdata('flashSuccess', 'Verifier has been assigned to client.');			
			        }else{
			        	$this->session->set_flashdata('flashError', 'Verifier has not been assigned to client.'); 
			        }

			        redirect('clients');
			    }

				$this->load->view('inc/header',$data);
				$this->load->view('clients_confirm_details',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('clients');
			}
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('clients');
		}	
	}

	

	public function validate_client_detail($id = ""){
		if(!empty($id)){
			$client_draft_id = base64_decode($id);
			$details = $this->clients_model->get_draft_details($client_draft_id);
			$client_id = $details['client_id'];
			$original_details = $this->clients_model->get_original_details($client_id);

			if($details){

				if($this->input->post()){
					$update_data = array(
						'id' => $client_draft_id,
						'status' => 'detail_validated',
						'modified_at' => date('Y-m-d H:i:s')
					);

					$is_updated = $this->clients_model->update_draft($update_data);

					if($original_details['status'] == 'draft'){
						$update_data = array(
							'id' => $client_id,
							'status' => 'detail_validated',
							'modified_at' => date('Y-m-d H:i:s')
						);
						$this->clients_model->update($update_data);
					}

					if($is_updated){
			        	$this->session->set_flashdata('flashSuccess', 'Client Detail has been confirmed successfully.');			            
			        }else{
			        	$this->session->set_flashdata('flashSuccess', 'Client Detail has not been confirmed successfully.'); 
			        }
			        redirect('clients/confirm_client_details/'.$id);
			    }

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('clients');
			}

		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('clients');
		}
	}
	
	public function view($id = ""){
		$data = array();
		
		if(!empty($id)){			
			$details = $this->clients_model->get_details(base64_decode($id));
			if($details){
				$data['title'] = "Client Details";
				$data['details'] = $details;
				$data['properties'] = $this->clients_properties_model->get_all(base64_decode($id));
				$data['executives'] = $this->clients_model->get_executives(base64_decode($id));
				$data['branches'] = $this->clients_model->get_branches(base64_decode($id));
				$data['documents'] = $this->clients_model->get_documents(base64_decode($id));

				$this->load->view('inc/header',$data);
				$this->load->view('clients_view',$data);
				$this->load->view('inc/footer');

			}else{
				$this->session->set_flashdata('flashError', 'Invalid request.');
            	redirect('clients');
			}
			
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
            redirect('clients');
		}
	}
	
	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->clients_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Client has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Client has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
	
}
