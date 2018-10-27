<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends MY_Controller {

var $current_user;   
var $current_user_id;
var $current_building_id;
var $current_user_role;

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('global_model'); 
        $this->load->model('Calendar_model');

        // If user is not logged in -> redirect to user_login controller 
        if(!$this->_is_logged_in('user_id')) 
        {
            _redirect('user_login');
        }  

        $this->current_user = $this->global_model->select_single('users',['user_id'=>$this->_is_logged_in('user_id')]);
        
        $this->current_user_id = $this->current_user['user_id'];
        $this->current_building_id = $this->current_user['building_id'];
        $this->current_user_role = $this->current_user['user_role'];
        
    }


	/*Home page Calendar view  */
	Public function index()
	{
		$this->load->view('users/calendar');
	}

	/*Get all Events */

	Public function getEvents()
	{
		$result=$this->Calendar_model->getEvents();
		echo json_encode($result);
	}
	/*Add new event */
	Public function addEvent()
	{
		$result=$this->Calendar_model->addEvent();
		echo $result;
	}
	/*Update Event */
	Public function updateEvent()
	{
		$result=$this->Calendar_model->updateEvent();
		echo $result;
	}
	/*Delete Event*/
	Public function deleteEvent()
	{
		$result=$this->Calendar_model->deleteEvent();
		echo $result;
	}
	Public function dragUpdateEvent()
	{	

		$result=$this->Calendar_model->dragUpdateEvent();
		echo $result;
	}



}
