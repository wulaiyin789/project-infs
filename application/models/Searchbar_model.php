<?php

class Searchbar_model extends CI_Model {

	function __construct() {
        parent::__construct();
        $this->db1 = $this->load->database('searchDB', TRUE);

    }

    // Search Bar Function
	public function searchfunction() {

        // Departures unique characters in a string for use in an SQL statement
        $q = $this->input->get('q');

        // Check %$q% whether contained in the DB
        $sql = "SELECT 'name' FROM category WHERE name LIKE '%$q%'";
        $result = $this->db1->query($sql);


        // Get an outcome row to an asssociative array
		foreach($result->result_array() as $row){
		    $link = lcfirst($row['name']);
            echo '<a href="'.$link.'">'.$link.'</a>';
		}
	}
}

?>