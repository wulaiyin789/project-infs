<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
    
    // Authenicate email and password
	public function authenticate($data) {
		// $this->db->select('password');
	 //    $this->db->from('users');
	 //    $this->db->where('email', $data['email']);
	 //    $this->db->limit(1);
	 //    $query = $this->db->get();

	 //    if ($query->num_rows() == 1) {
	 //        $record = $query->row_array();
	 //        return password_verify($data['password'], $record['password']);
	 //    } else {
	 //        return false;
	 //    }

		$sql = $this->db->where($data)->get('users');

		if($sql->num_rows() > 0) {
			return $sql;
		} else {
			return FALSE;
		}
	}
}

?>