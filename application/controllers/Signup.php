<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('register_model');
	}

    public function index() {

    	$data['title']='Active! Signup';
    	$data['page']='signup';
        $this->load->view('site', $data);
        $this->load->view('signup');
    }

    private function hash_password($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }


    // Registration
    public function register() {

    	$this->load->library('form_validation');

    	$username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cpassword = $this->input->post('cpassword');

        $this->form_validation->set_rules('username', 'Name', 'required|trim');
    	$this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.username]');
    	$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    	$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|min_length[6]|matches[cpassword]');


    	if($this->form_validation->run() == TRUE) {

    		$data = array(
    			'username'	=>	$this->input->post('username'),
    			'email'		=>	$this->input->post('email'),
    			'password'	=>	$this->hash_password($this->input->post('password'))
    		);

            $result = $this->register_model->insert($data);

    		$this->session->set_flashdata("success", "Your account has been registered.");
    		redirect("/login", "refresh");

        } else {
       		$this->session->set_flashdata("error", "Your account cannot register.");
        	redirect("/signup", "refresh");
        }

    } 
}
