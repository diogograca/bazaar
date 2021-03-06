<!--
This Model is responsible to handling the interest of the student in a proposal
-->
<?php

/**
 * Class Proposal_interest_model
 */
class Proposal_interest_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     *  This functions inserts the student interest in a project into the proposal_interest
     *
     * @return bool
     */
    public function create_interest()
    {
        //grabs the values from the POST array
        $proposal_id = $this->input->post('proposal_id');
        $user_id = $this->session->userdata('user_id');
        $data = array(
            'proposal_id' => $proposal_id,
            'user_id' => $user_id
        );
        $this->db->insert('proposal_interests',$data);

        //If insertion is successfully returns true
        if ($this->db->affected_rows() === 1) {
            return TRUE;
        } else {
            return false;
        }
    }
}