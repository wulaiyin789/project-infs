<?php

class Register_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function insert($data) {
		return $this->db->insert('users', $data);
	}
}
?>