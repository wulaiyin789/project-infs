<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('upload_file');
        $this->load->model('profile_model');
        $this->load->library('image_lib');
    }

    public function index() {

    	$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if($this->form_validation->run() == TRUE) {

            $data = array(
            	'username' => $this->input->post('username'),
                'email'     =>  $this->input->post('email')
            );

            $update = $this->profile_model->update_profile($this->session->userdata('email'), $data);

            if($update > 0) {

                $session = array (
                    'username' => $data['username'],
                    'email' => $data['email']
                );

                $this->session->set_userdata($session);
                $this->session->set_flashdata('success', 'User Profile has been updated in the database.');
                return redirect(base_url(). "Profile/");

            } else {
                $this->session->set_flashdata('error', 'User Profile cannot update. Please try again.');
                return redirect(base_url(). "Profile/");
            }
        } else {
	        $data['title']='Active! My Account';
	    	$data['page']='profile';
	        $this->load->view('site', $data);
	        $this->load->view('profile');
        }
    }

    // File location
    private $upload_path = "./uploads";

    // Upload Function
	public function upload() {
		if (!empty($_FILES)) {
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			} else {
				$this->resize();
			}
		}
	}

	public function resize() {
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/'.$data['file_name'];
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 100;
		$config['height'] = 100;
		$config['new_image'] = './uploads/'.$data['file_name'];

		$this->image_lib->initialize($config);
		$this->image_lib->resize();

	}

	// Remove image Function
	public function remove() {
		$file = $this->input->post("file");
		if ($file && file_exists($this->upload_path . "/" . $file)) {
			unlink($this->upload_path . "/" . $file);
		}
	}


	// List the file info below the image
	public function list_files() {
		$this->load->helper("file");
		$files = get_filenames($this->upload_path);
		// we need name and size for dropzone mockfile
		foreach ($files as &$file) {
			$file = array(
				'name' => $file,
				'size' => filesize($this->upload_path . "/" . $file)
			);
		}

		header("Content-type: text/json");
		header("Content-type: application/json");
		echo json_encode($files);
	}
}


?>