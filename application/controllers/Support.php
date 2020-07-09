<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends MY_Controller {

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
        $this->load->helper('url', 'form');
		$this->load->model('support_model');
		
        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
        	$this->session->set_flashdata('flashError', 'Please Login to Continue');
        	redirect('/');
        }
	}

	public function index($tab="")
	{
		$data['title'] = "Support";
		
		//company login id
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['items'] = $this->support_model->get_all($client_login_id);

		$this->load->view('inc/header',$data);
		$this->load->view('support',$data);
		$this->load->view('inc/footer');
	}

	public function create()
	{		
		$data['title'] = "Create Support";		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$data['support'] = $this->support_model->get_all($client_login_id);

		$userfile = "";
		if(isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])){
			// $filesCount = count($_FILES['userfile']['name']);
   //          for($i = 0; $i < $filesCount; $i++)
   //          {
			$file_name = $_FILES['userfile']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['upload_path'] = 'uploads/';
            $config['file_name'] = $upload_file_name;
            
            $this->upload->initialize($config);
            
            if( ! $this->upload->do_upload('userfile'))
            {
                if($this->upload->display_errors())
                {
                    $this->session->set_flashdata('flashError',$this->upload->display_errors());
                    $this->session->set_flashdata('flashdata',$dataArray);
                    redirect('/support');
                }
            }else{
                $userfile = $upload_file_name;
            }
          
        }



		if($this->input->post()){
			//company login id
			$company_login_id = $this->session->userdata['fmc_client_login']['client_id'];

			print_r($_FILES);
			exit();
			$insert_data = array(
				//'company_id' => base64_decode($company_login_id),
				'title' => $this->input->post('title'),
				'userfile' => $userfile,
	            'description' => $this->input->post('description'),
	            'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s')
	        );		

	        $is_inserted = $this->support_model->insert($insert_data);

	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Tickets has been inserted successfully.'); 
	        	redirect('/support');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Tickets has not been inserted successfully.');
	            redirect('/support');
	        }
	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('support_create',$data);
		$this->load->view('inc/footer');
	}

	public function update($id = "")
	{
		$data['title'] = "Update Support";		
		
		$client_login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		// $data['designation'] = $this->company_designation_model->get_all($client_login_id);
		// $data['job_positions'] = $this->job_positions_model->get_all_by_status($client_login_id,'open');

		if(!empty($id)){
			$data['details'] = $this->support_model->get_details(base64_decode($id));
			if(!$data['details']){
				redirect('/support');
			}
		}

		if($this->input->post()){
			
			$update_data = array(
				'id' => base64_decode($this->input->post('id')),
	            'title' => $this->input->post('title'),
	            'description' => $this->input->post('description'),
	            'status' => 'active',
	        	'modified_at' => date('Y-m-d H:i:s')
	        );

	        $is_updated = $this->support_model->update($update_data);

	        if($is_updated){
	        	$this->session->set_flashdata('flashSuccess', 'Tickets has been updated successfully.'); 
	        	redirect('/support');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Tickets has not been updated successfully.');
	            redirect('/support');
	        }

	    }

	    $this->load->view('inc/header',$data);
		$this->load->view('support_update',$data);
		$this->load->view('inc/footer');
	}

	

	public function delete($id = "", $status = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->support_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Ticket has been deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Ticket has not been deleted successfully.'); 
            echo '0';exit;
        }
	}	
	
}
