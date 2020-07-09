<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_documents extends MY_Controller {

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

        $this->load->model('company_documents_model');
        $this->load->model('document_categories_model');
        $this->load->library('upload');
        /*if(!($this->session->userdata['fmc_user_data']['is_login'] || $this->session->userdata['fmc_user_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
        if($this->session->userdata('fmc_client_login') && $this->session->userdata['fmc_client_login']['is_client_login'])
        {
            $this->session->set_flashdata('flashError', 'Please logout from client login');
            redirect('/dashboard');
        }*/
	}

	public function index()
	{
		$data['title'] = "Manage Company documents";
		
		$document_category_id = "";
		if($this->input->post()){			
			$document_category_id = $this->input->post('document_category_id');
			
		}
		if(!empty($document_category_id)){
			$data['items'] = $this->company_documents_model->get_all_by_category($document_category_id);
		}else{
			$data['items'] = $this->company_documents_model->get_all();
		}
		
		$data['document_categories'] = $this->document_categories_model->get_all();
		
		$this->load->view('inc/header',$data);
		$this->load->view('company_documents',$data);
		$this->load->view('inc/footer');

		
	}

	public function create()
	{

		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'doc|docx|pdf';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	$this->session->set_flashdata('flashdata',$dataArray);
                	redirect('/company_documents');
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}

		if($this->input->post()){
			
			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];

			$insert_data = array(
	            'document_category_id' => $this->input->post('document_category_id'),
	        	'title' => $this->input->post('title'),
	        	'descriptions' => $this->input->post('descriptions'),
	        	//'document_file' => $this->input->post('document_file'),
	        	'expiry_date' => $expiry_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s'),
	        	
	        );
			if(!empty($document_file)){
	        	$insert_data['document_file'] = $document_file;
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashSuccess', 'Company documents in document file not selected.'); 
	        	redirect('/company_documents');
	        }
	        $is_inserted = $this->company_documents_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Company documents has been inserted successfully.'); 
	        	redirect('/company_documents');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company documents has not been inserted successfully.');
	            redirect('/company_documents');
	        }

	    }else{
	    	redirect('/company_documents');
	    }
	}

	public function update()
	{	
		//echo $document_file;
		//print_r($_FILES);
		//exit();
		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'doc|docx|pdf';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	$this->session->set_flashdata('flashdata',$dataArray);
                	redirect('/company_documents');
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}

		if($this->input->post()){

			$expiry_date = ($this->input->post('expiry_date') != "") ? $this->input->post('expiry_date') : '00/00/0000';
			$expiry_date = explode("/", $expiry_date);
			$expiry_date = $expiry_date[2]."/".$expiry_date[1]."/".$expiry_date[0];

			
			$update_data = array(
				'id' => $this->input->post('id'),
	            'document_category_id' => $this->input->post('document_category_id'),
	        	'title' => $this->input->post('title'),
	        	'descriptions' => $this->input->post('descriptions'),
	        	//'document_file' => $this->input->post('document_file'),
	        	'expiry_date' => $expiry_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s'),
	        	
	        
	        );
			if(!empty($document_file)){
	        	$insert_data['document_file'] = $document_file;
	        }
	        $is_updated = $this->company_documents_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Company Documents has been updated successfully.'); 
	        	redirect('/company_documents');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company Documents has not been updated successfully.');
	            redirect('/company_documents');
	        }

	    }else{
	    	redirect('/company_documents');
	    }
	}

	function get(){
		if($this->input->post()){
			$item_data = $this->company_documents_model->get_details($this->input->post('id'));

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

        $deleted = $this->company_documents_model->delete($id, $status);
        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Comapny Documents has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Company Documents has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
