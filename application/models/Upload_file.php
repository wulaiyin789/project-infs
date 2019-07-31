<?php

class Upload_file extends CI_Model {

	private $upload_path = "./uploads";

	public function upload() {
		if ( ! empty($_FILES)) 
		{
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			}
		}
	}

	public function remove() {
		$file = $this->input->post("file");
		if ($file && file_exists($this->upload_path . "/" . $file)) {
			unlink($this->upload_path . "/" . $file);
		}
	}

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