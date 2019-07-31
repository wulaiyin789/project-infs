<?php

class Profile_model extends CI_Model {

	public function update_profile($email, $data) {
		$this->db->set($data)->where('email', $email)->update('users');

		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else{	
			return FALSE;
		}

	}
}

?>