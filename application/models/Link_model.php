<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class link_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->db2 = $this->load->database('eventDB', TRUE);

    }
    
    // Save the Event in the DB by row
    public function save($link_list) {

        for($x = 0; $x< count($link_list); $x++) {

            $data[] = array(

                'no' => $link_list[$x]['no'],
                'eventname' => $link_list[$x]['eventname'],
                'numberOfPeople' => $link_list[$x]['numberOfPeople'],
                'description' => $link_list[$x]['description'],

            );
        }

        try {

            for($x = 0; $x<count($link_list); $x++) {
                $this->db2->insert('event_data', $data[$x]);
            }

            return 'success';
        } catch(Exception $e) {
            return 'Failed';
        }

    }
}


?>