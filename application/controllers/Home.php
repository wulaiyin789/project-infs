<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database('default', TRUE);

    }

    public function index() {

    	$data['title']='Active!';
    	$data['page']='home';
        $this->load->view('site', $data);
    }


    // Logout session
    public function logout() {

		session_unset();
    	session_destroy();

    	redirect(base_url() . "Home/");
    }

    // Search Bar Function
    public function searchbar() {

    	$this->load->database('searchDB', TRUE);

    	if(!empty($this->input->get('q'))) {

    		$this->load->model('Searchbar_model');

    		$this->Searchbar_model->searchfunction();

	    }
    }
}


?>