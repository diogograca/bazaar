<!--
This Model is responsible to handling the updates on the Lecturers Profiles
-->
<?php

/**
 * Class Edit_profile_model
 */
class Edit_profile_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     * This functions updates the profile into the profiles table
     *
     * @param $id
     * @param $data
     * @return bool
     */
    public function editProfile($id, $data)
    {

        $this->db->where('profile_id', $id);
        $this->db->update('profiles', $data);

        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function returns the profile of the current logged in user for editing
     *
     * @return null
     */
    public function getProfile()
    {

        $user = $this->session->userdata('user_id');
        $this->db->where('lecturer_id', $user);
        $sql = $this->db->get('profiles');

        if ($sql->num_rows() === 1) {
            return $sql->result();
        } else {
            return NULL;
        }
    }
}