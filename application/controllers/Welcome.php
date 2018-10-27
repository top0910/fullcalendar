<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('global_model'); 

	}

	public function index()
	{
		$data['landing_p'] = $this->global_model->select_single('main_landing_page',['id'=>'1']);

        $data['building_dashboard'] = $this->global_model->select_single('building_dashboard',['building_id'=>'1']);


        $data['msg']= $this->session->flashdata('msg');
        $data['alert_class']= $this->session->flashdata('alert_class');
		$this->load->view('users/common/header');
		$this->load->view('home',$data);             // Home Page
		$this->load->view('users/common/footer');
		
	}


	public function view_faq()
	{
		$data['landing_p'] = $this->global_model->select_single('main_landing_page',['id'=>'1']);

		$this->load->view('users/common/header');
		$this->load->view('faq',$data);             // Home Page
		$this->load->view('users/common/footer');
		
	}

	public function building()
	{
		$building_name = $this->uri->segment(1); // Get building name from URL

		$data['building_data'] = 
		$this->global_model->select_single('building_data',['building_name'=>$building_name,'status'=>'1']);

		if($data['building_data'])
		{
			$building_id = $data['building_data']['id'];

            $data['building_login'] = $this->global_model->select_single('building_data',['id'=>$building_id]);
	            
	        $data['msg']= $this->session->flashdata('msg');
	        $data['alert_class']= $this->session->flashdata('alert_class');
	    	$this->load->view('users/common/header');
	    	$this->load->view('users/login',$data);
	    	$this->load->view('users/common/footer');
			
		}
		else{

			_redirect('welcome'); // Home Page

		}

	}

	public function adminlte()
	{
		
		$this->load->view('welcome_message');
	}


}
