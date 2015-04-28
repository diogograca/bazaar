<!--
This Model is responsible to returning all the users and updating a student account to a lecturer account
-->
<?php

/**
 * Class Users_model
 */
class Users_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     * This functions returns all the users
     *
     * @return array|null
     */
    public function getUsers()
    {
        $this->db->where('admin !=', 1);
        $sql = $this->db->get('users');
        //returns all the users
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            return NULL;
        }
    }

    /**
     * This function updates a student account to a lecturer account
     *
     * @param $user_id
     * @param $data
     * @return bool
     */
    public function changePermission($user_id, $data)
    {

        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);

        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }
}
