<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends MY_Controller {

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
        $this->load->model('calender_event_model');       	
		$this->load->model('holidays_model');

        $this->load->library('upload');

        if(!($this->session->userdata['fmc_client_login']['is_client_login'] || $this->session->userdata['fmc_client_login']['client_id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }
	}

	public function index()
	{
		$data['title'] = "Calender";

		$login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);

		$results = $this->calender_event_model->get_all($login_id);				
		$holidays = $this->holidays_model->get_all($login_id);

		

		$events = array();
		// 
		$events[] = array();
		foreach ($results as $key => $value) {
			$events[] = array(
				'event_id' => base64_encode($value['id']),
				'title' => $value['event_title'],
				'start' => $value['event_start_date'],
				'end' => $value['event_end_date'],
				'className' => $value['event_color']
			);		            
	    }

	    foreach ($holidays as $key => $value) {
	    	$events[] = array(
				'title' => $value['name'],
				'start' => $value['date'],
				'end' => $value['date'],
				'className' => 'bg-success'
			);	    	
	    }

		$data['events'] = $events;
		$data['items'] = $results;

		$this->load->view('inc/header',$data);
		$this->load->view('calender',$data);
		$this->load->view('inc/footer');
		
	}

	public function list_view()
	{
		$login_id = base64_decode($this->session->userdata['fmc_client_login']['client_id']);
		$data['items'] = $this->calender_event_model->get_all();
		
		$data['title'] = "Calender List";

		$this->load->view('inc/header',$data);
		$this->load->view('calender_list',$data);
		$this->load->view('inc/footer');
		
	}

	public function create_event(){

		$login_id = $this->session->userdata['fmc_client_login']['client_id'];
		
		$data['title'] = "Create Event";
		$document_file = "";
		if(isset($_FILES['document_file']) && is_uploaded_file($_FILES['document_file']['tmp_name'])){

			$file_name = $_FILES['document_file']['name'];
            $upload_file_name = preg_replace('/\s+/', '_', $file_name);
            $upload_file_name = rtrim($upload_file_name, '\\/<>?*:"<>|');
            $upload_file_name = time()."_".$upload_file_name;

            $config = array();
	        $config['allowed_types'] = 'jpg|png|jpeg|gif';
	        $config['upload_path'] = 'uploads/';
	        $config['file_name'] = $upload_file_name;
        	
        	$this->upload->initialize($config);
        	if( ! $this->upload->do_upload('document_file'))
            {
                if($this->upload->display_errors())
                {
                	$this->session->set_flashdata('flashError',$this->upload->display_errors());
                	//$this->session->set_flashdata('flashdata',$dataArray);
                	redirect('/calender');
                }
            }else{
            	$document_file = $upload_file_name;
            }
		}
		if($this->input->post()){
			
			$event_start_date = ($this->input->post('event_start_date') != "") ? $this->input->post('event_start_date') : '00/00/0000';
			$event_start_date = explode("/", $event_start_date);
			$event_start_date = $event_start_date[2]."/".$event_start_date[1]."/".$event_start_date[0];
			
			$event_end_date = ($this->input->post('event_end_date') != "") ? $this->input->post('event_end_date') : '00/00/0000';
			$event_end_date = explode("/", $event_end_date);
			$event_end_date = $event_end_date[2]."/".$event_end_date[1]."/".$event_end_date[0];

			$insert_data = array(
	            'company_id' => base64_decode($login_id),
	            'event_start_time' => $this->input->post('event_start_time'),
	            'event_end_time'=> $this->input->post('event_end_time'),
	        	'event_title' => $this->input->post('event_title'),
	        	'discriptions' => $this->input->post('discriptions'),
	        	'event_color' => $this->input->post('event_color'),
	        	'document_file' => $document_file,
	        	'event_start_date' => $event_start_date,
	        	'event_end_date' => $event_end_date,
	        	'status' => 'active',
	        	'created_at' => date('Y-m-d H:i:s'),
	        	'modified_at' => date('Y-m-d H:i:s'),
	        	
	        );

			if(!empty($document_file)){
	        	$insert_data['document_file'] = $document_file;
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashSuccess', 'Document file not selected.'); 
	        	//redirect('/calender');
	        }
	        
	        $is_inserted = $this->calender_event_model->insert($insert_data);
	  //       print_r($_POST);
			// exit();
	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Documents has been inserted successfully.'); 
	        	redirect('/calender/list_view');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company documents has not been inserted successfully.');
	            redirect('/calender');
	        }

	    }

		$this->load->view('inc/header',$data);
		$this->load->view('create_event',$data);
		$this->load->view('inc/footer');
	}

	public function event_detail($id){
		$data['title'] = "Event Details";
		$id = base64_decode($id);

		$details = $this->calender_event_model->get_details($id);
		if($details){
        	$data['details'] = $details;
        	$this->load->view('inc/header',$data);
			$this->load->view('calendar_event_details',$data);
			$this->load->view('inc/footer');    
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Event has not been found.'); 
        	redirect('/calender');
        }
	}

	public function delete($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->calender_event_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Event deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Event has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
