<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fmc_calendar extends MY_Controller {

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
        $this->load->model('fmc_calender_event_model');       	

        $this->load->library('upload');

        if(!($this->session->userdata['fmc_user_data']['is_login'] || $this->session->userdata['fmc_user_data']['id']))
        {
            $this->session->set_flashdata('flashError', 'Please Login to Continue');
            redirect('/');
        }        
	}

	public function index()
	{
		$data['title'] = "Calender";

		$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
		$results = $this->fmc_calender_event_model->get_all($login_user_id);
		$events = array();
		foreach ($results as $key => $value) {
			$events[] = array(
				'event_id' => base64_encode($value['id']),
				'title' => $value['event_title'],
				'start' => $value['event_start_date'],
				'end' => $value['event_end_date'],
				'className' => $value['event_color']
			);
	    }

	    $data['events'] = $events;
		$data['items'] = $results;

		$this->load->view('inc/header',$data);
		$this->load->view('fmc_calender',$data);
		$this->load->view('inc/footer');
	}

	public function list_view()
	{
		$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
		$data['items'] = $this->fmc_calender_event_model->get_all($login_user_id);
		
		$data['title'] = "Calender List";

		$this->load->view('inc/header',$data);
		$this->load->view('fmc_calender_list',$data);
		$this->load->view('inc/footer');
		
	}

	public function create_event(){

		$login_user_id = base64_decode($this->session->userdata['fmc_user_data']['id']);
		
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
                	redirect('/fmc_calendar');
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
	            'fmc_user_id' => $login_user_id,
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
	        
	        $is_inserted = $this->fmc_calender_event_model->insert($insert_data);
	        if($is_inserted){
	        	$this->session->set_flashdata('flashSuccess', 'Documents has been inserted successfully.'); 
	        	redirect('/fmc_calendar/list_view');
	        }else{
	        	$this->session->set_flashdata('flashError', 'Company documents has not been inserted successfully.');
	            redirect('/fmc_calendar');
	        }

	    }

		$this->load->view('inc/header',$data);
		$this->load->view('fmc_calendar_create_event',$data);
		$this->load->view('inc/footer');
	}

	public function event_detail($id){
		$data['title'] = "Event Details";
		$id = base64_decode($id);

		$details = $this->fmc_calender_event_model->get_details($id);
		if($details){
        	$data['details'] = $details;
        	$this->load->view('inc/header',$data);
			$this->load->view('fmc_calendar_event_details',$data);
			$this->load->view('inc/footer');    
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Event has not been found.'); 
        	redirect('/fmc_calendar');
        }
	}

	public function delete($id = ""){
		$id = $_POST['id'];
        $status = $_POST['status'];

        $deleted = $this->fmc_calender_event_model->delete($id, $status);

        if($deleted){
        	$this->session->set_flashdata('flashSuccess', 'Event deleted successfully.');
            echo '1';exit;
        }else{
        	$this->session->set_flashdata('flashSuccess', 'Event has not been deleted successfully.'); 
            echo '0';exit;
        }
	}
}
