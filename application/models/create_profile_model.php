<!--
This Model is responsible to handling the creation of the Lecturer Profile
and Getting the Profile of the logged in Lecturer
-->
<?php

/**
 * Class Create_profile_model
 */
class Create_profile_model extends CI_Model
{

    /**
     * calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     * This functions inserts the lecturer profile into the database
     *
     * @return bool
     */
    public function create_lecturer_profile()
    {
        //grabs the values from the POST array and user session
        $description = $this->input->post('description');
        $areas = $this->input->post('areas');
        $support = $this->input->post('support');
        $user = $this->session->userdata('user_id');


        $data = array(
            'profile_description' => $description,
            'specialist_areas' => $areas,
            'lecturer_id' => $user,
            'support_projects' => $support
        );
        $this->db->insert('profiles', $data);
        //If insertion is successfully returns true
        if ($this->db->affected_rows() === 1) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    /**
     * This function returns the profile of the current logged in user
     *
     * @return object|null
     */
    public function getProfile()
    {

        $user = $this->session->userdata('user_id');
        $this->db->where('lecturer_id', $user);
        $sql = $this->db->get('profiles');
        //If user has a Profile return the data, else returns false
        if ($sql->num_rows() === 1) {
            return $sql->result();
        } else {
            return NULL;
        }
    }
}
