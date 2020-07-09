<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sharelink extends MY_Controller {

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
    	$this->load->model('employees_model');
    	$this->load->model('employee_documents_model');
    	
    	$this->load->model('regions_model');
    	$this->load->model('cities_model');
    	
		//Library
		$this->load->library('upload');        
	}

	public function index($share_link = "")
	{
		$share_link_details = $this->employees_model->get_share_link_details($share_link);
		if(!empty($share_link_details)){
			$data['title'] = "Employe Public Link";

			$employee_id = $share_link_details['employee_id'];
			$data['details'] = $this->employees_model->get_draft_details($employee_id);
			$data['emergency_contacts'] = $this->employees_model->get_emergenct_contacts_draft($employee_id);
			$data['educations'] = $this->employees_model->get_educations_draft($employee_id);
			$data['work_experience_items'] = $this->employees_model->get_work_experience_draft($employee_id);
			$data['documents'] = $this->employee_documents_model->get_all_draft($employee_id);

			$data['share_link_details'] = $share_link_details;
			
			$data['regions'] = $this->regions_model->get_all();
			$data['cities'] = $this->cities_model->get_all();

			$this->load->view('inc/header',$data);
			$this->load->view('company_employees_public_link',$data);
			$this->load->view('inc/footer');

		}else{
			$this->session->set_flashdata('flashError', 'Public link found.');
			redirect('/');
		}
	}

	public function save_employee_data()
	{
		if($this->input->post()){

			$profile_pic = "";
			if(isset($_FILES['profile_pic']) && is_uploaded_file($_FILES['profile_pic']['tmp_name'])){

				$file_name = $_FILES['profile_pic']['name'];
	            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
	            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
	            $upload_file_name = time()."_".$upload_file_name;

	            $config = array();
		        $config['allowed_types'] = 'png|jpg|jpeg';
		        $config['upload_path'] = 'uploads/';
		        $config['file_name'] = $upload_file_name;
	        	
	        	$this->upload->initialize($config);
	        	if($this->upload->do_upload('profile_pic'))
	            {
	            	$profile_pic = $upload_file_name;
	            }
			}

			$birthdate = "0000-00-00";
			if(!empty($this->input->post('birthdate'))){
				$birthdate = explode("/", $this->input->post('birthdate'));
				$birthdate = $birthdate[2]."-".$birthdate[1]."-".$birthdate[0];
			}

			$employee_id = $this->input->post('employee_id');

			$update_data = array(
				'employee_id' => $this->input->post('employee_id'),
	            'fullname_english' => $this->input->post('fullname_english'),
	            'fullname_arabic' => $this->input->post('fullname_arabic'),
	            'personal_email' => $this->input->post('personal_email'),
	            'personal_mobile' => $this->input->post('personal_mobile'),
	            'gender' => $this->input->post('gender'),
	            'nationality' => $this->input->post('nationality'),
	            'passport_number' => $this->input->post('passport_number'),
	            'passport_issue_place' => $this->input->post('passport_issue_place'),
	            'passport_expiry_date' => $this->input->post('passport_expiry_date'),
	            'gosi_number' => $this->input->post('gosi_number'),
	            'id_number' => $this->input->post('id_number'),
	            'birthdate' => $birthdate,
	            'social_status' => $this->input->post('social_status'),
	            'number_of_dependent' => $this->input->post('number_of_dependent'),
	            'religion' => $this->input->post('religion'),
	            'mother_city_address' => $this->input->post('mother_city_address'),
	            'mother_city_city' => $this->input->post('mother_city_city'),
	            'mother_city_state' => $this->input->post('mother_city_state'),
	            'kingdom_po_box' => $this->input->post('kingdom_po_box'),
	            'kingdom_building_no' => $this->input->post('kingdom_building_no'),
	            'kingdom_street_name' => $this->input->post('kingdom_street_name'),
	            'kingdom_region_id' => $this->input->post('kingdom_region_id'),
	            'kingdom_city_id' => $this->input->post('kingdom_city_id'),
	            'kingdom_zipcode' => $this->input->post('kingdom_zipcode'),	            
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			if(!empty($profile_pic)){
				$update_data['profile_pic'] = $profile_pic;
			}


			$emergency_contacts = array();
			foreach($this->input->post('contact_name') as $key => $value){
				$emergency_contacts[] = array(
					'employee_id' => $employee_id,
 					'contact_name' => $this->input->post('contact_name')[$key],
					'address' => $this->input->post('address')[$key],
					'relationship' => $this->input->post('relationship')[$key],
					'mobile' => $this->input->post('mobile')[$key]
				);	
			}

			$educations = array();
			foreach($this->input->post('specialization') as $key => $value){
				$educations[] = array(
					'employee_id' => $employee_id,
 					'specialization' => $this->input->post('specialization')[$key],
					'institute_name' => $this->input->post('institute_name')[$key],
					'from_year' => $this->input->post('from_year')[$key],
					'to_year' => $this->input->post('to_year')[$key]
				);	
			}

			$work_experience_items = array();
			foreach($this->input->post('position') as $key => $value){
				$from_date = "0000-00-00";
				if(!empty($this->input->post('from_date')[$key])){
					$from_date = explode("/", $this->input->post('from_date')[$key]);
					$from_date = $from_date[2]."-".$from_date[1]."-".$from_date[0];
				}
				$to_date = "0000-00-00";
				if(!empty($this->input->post('to_date')[$key])){
					$to_date = explode("/", $this->input->post('to_date')[$key]);
					$to_date = $to_date[2]."-".$to_date[1]."-".$to_date[0];
				}

				$work_experience_items[] = array(
					'employee_id' => $employee_id,
 					'position' => $this->input->post('position')[$key],
					'employer_name' => $this->input->post('employer_name')[$key],
					'job_task' => $this->input->post('job_task')[$key],
					'address' => $this->input->post('address')[$key],
					'total_salary' => $this->input->post('total_salary')[$key],
					'from_date' => $from_date,
					'to_date' => $to_date
				);
			}

			$is_updated = $this->employees_model->update_draft($update_data);
			
			if($is_updated){					
				$this->employees_model->remove_emergency_contacts_draft($employee_id);
				$this->employees_model->add_emergency_contacts_draft($emergency_contacts);

				$this->employees_model->remove_educations_draft($employee_id);
				$this->employees_model->add_educations_draft($educations);


				$this->employees_model->remove_work_experience_draft($employee_id);
				$this->employees_model->add_work_experience_draft($work_experience_items);

				$this->session->set_flashdata('flashSuccess', 'Your details saved successfully.'); 

				if($this->input->post('save_submit')){
					$details = $this->employees_model->get_draft_details($employee_id);
					$details['id'] = $employee_id;
					unset($details['employee_id']);
					$this->employees_model->update($details);

					$emergency_contacts_tmp = $this->employees_model->get_emergenct_contacts_draft($employee_id);
					$emergency_contacts = array();
					foreach ($emergency_contacts_tmp as $key => $value) {
						unset($value['id']);
						$emergency_contacts[] = $value;
					}
					$this->employees_model->remove_emergency_contacts($employee_id);
					$this->employees_model->add_emergency_contacts($emergency_contacts);
					$this->employees_model->remove_emergency_contacts_draft($employee_id);
										
					$educations_tmp = $this->employees_model->get_educations_draft($employee_id);
					$educations = array();
					foreach ($educations_tmp as $key => $value) {
						unset($value['id']);
						$educations[] = $value;
					}
					$this->employees_model->remove_educations($employee_id);
					$this->employees_model->add_educations($educations);
					$this->employees_model->remove_educations_draft($employee_id);

					$work_experience_items_tmp = $this->employees_model->get_work_experience_draft($employee_id);
					$work_experience_items = array();
					foreach ($work_experience_items_tmp as $key => $value) {
						unset($value['id']);
						$work_experience_items[] = $value;
					}
					$this->employees_model->remove_work_experience($employee_id);
					$this->employees_model->add_work_experience($work_experience_items);
					$this->employees_model->remove_work_experience_draft($employee_id);
					
					$documents = $this->employee_documents_model->get_all_draft($employee_id);
					foreach ($documents as $value) {
						unset($value['id']);
						$this->employee_documents_model->insert($value);
					}			
					$this->employee_documents_model->delete_all_draft($employee_id);

					$this->employees_model->remove_public_share_link($employee_id);
					redirect('/');
				}else{
					redirect('/');
				}
			}else{
				$this->session->set_flashdata('flashError', 'Your details not saved successfully.');
				redirect('/');
			}			
		}else{
			$this->session->set_flashdata('flashError', 'Invalid request.');
			redirect('/');	
		}
		exit();
	}

	public function save_employee_document()
	{
		$share_link_id = $this->input->post('share_link_id');

		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	redirect('/employee-public-link/'.$share_link_id);
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}else{
			redirect('/employee-public-link/'.$share_link_id);
		}
		
		if($this->input->post()){

			$issue_date = ($this->input->post('issue_date') != "") ? $this->input->post('issue_date') : '00/00/0000';
			$issue_date = explode("/", $issue_date);
			$issue_date = $issue_date[2]."/".$issue_date[1]."/".$issue_date[0];

			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];

			$insert_data = array(
				'employee_id' => $this->input->post('employee_id'),
	            'title' => $this->input->post('title'),
	        	'description' => $this->input->post('description'),
	        	'issue_date' => $issue_date,
	        	'expiry_date' => $expiry_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			if(!empty($document_file)){
	        	$insert_data['document_file'] = $document_file;
	        }else{
	        	$this->session->set_flashdata('flashError', 'Document in document file not selected.'); 
	        	redirect('/employee-public-link/'.$share_link_id);
	        }
	        $is_inserted = $this->employee_documents_model->insert_draft($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Document has been inserted successfully.'); 
	        	redirect('/employee-public-link/'.$share_link_id);
	        }else{
	        	$this->session->set_flashdata('flashError', 'Document has not been inserted successfully.');
	            redirect('/employee-public-link/'.$share_link_id);
	        }
	    }else{
	    	redirect('/');
	    }	
	}

	public function update_employee_document()
	{
		$share_link_id = $this->input->post('share_link_id');

		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'doc|docx|pdf|jpg|jpeg|png';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	redirect('/employee-public-link/'.$share_link_id);
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}
		
		if($this->input->post()){			

			$issue_date = ($this->input->post('issue_date') != "") ? $this->input->post('issue_date') : '00/00/0000';
			$issue_date = explode("/", $issue_date);
			$issue_date = $issue_date[2]."/".$issue_date[1]."/".$issue_date[0];

			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];

			$update_data = array(
				'id' => $this->input->post('id'),
				'employee_id' => $this->input->post('employee_id'),
	            'title' => $this->input->post('title'),
	        	'description' => $this->input->post('description'),
	        	'issue_date' => $issue_date,
	        	'expiry_date' => $expiry_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

			if(!empty($document_file)){
	        	$update_data['document_file'] = $document_file;
	        }

	        $is_updated = $this->employee_documents_model->update_draft($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Document has been updated successfully.');
	        	redirect('/employee-public-link/'.$share_link_id);
	        }else{
	        	$this->session->set_flashdata('flashError', 'Document has not been updated successfully.');
	            redirect('/employee-public-link/'.$share_link_id);
	        }
	    }else{
	    	redirect('/');
	    }	
	}

	public function get_document_details()
	{
		if($this->input->post()){
			$details = $this->employee_documents_model->get_details_draft($this->input->post('id'));	
			if($details){
				$details['issue_date'] = date('d/m/Y',strtotime($details['issue_date']));
				$details['expiry_date'] = date('d/m/Y',strtotime($details['expiry_date']));
				$response['success'] = 'true';
				$response['data'] = $details;
			}else{
				$this->session->set_flashdata('flashError', 'Document has not been found.');
				$response['success'] = 'false';
			}			
		}else{
			$response['success'] = 'false';
		}
		echo json_encode($response);
	}
		
	public function delete_document_draft(){
		$id = $_POST['id'];
        
        $deleted = $this->employee_documents_model->delete_draft($id);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Documents has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Documents has not been deleted successfully.'); 
            echo '0';exit;
        }
	}

}
