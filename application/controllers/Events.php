<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('eventDB', TRUE);

    }
    
    public function index() {

    	$data['title']='Active! Add Events';
    	$data['page']='events';
        $this->load->view('site', $data);
        $this->load->view('events');
    }

    // Save the Event to the DB
    public function save() {

    	$link_data = $this->input->post('event_table');

    	$this->load->model('link_model');
    	$status = $this->link_model->save($link_data);

    	$this->output->set_content_type('application/json');
    	echo json_encode(array('status' => $status));
    }

}


?>