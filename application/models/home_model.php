<!--
This Model is responsible to getting the latest 3 project proposals and a random lecturer
-->
<?php

/**
 * Class home_model
 */
class home_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     * This functions returns the latest project proposals
     *
     * @return array|null
     */
    public function get_latests_proposals()
    {

        $this->db->order_by("proposal_id", "desc");
        //ensures a limit of 3 rows are returned
        $this->db->limit(3);
        $sql = $this->db->get('proposals');

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
     * This function returns a random lecturer profile
     *
     * @return null
     */
    public function get_random_lecturer()
    {
        // uses codeigniter built in function 'RANDOM' to retrieve a random row of the table
        $this->db->order_by('profile_id', 'RANDOM');
        $this->db->join('users', 'users.user_id = profiles.lecturer_id');
        //ensures only one profile is retrieved
        $this->db->limit(1);
        $sql = $this->db->get('profiles');

        if ($sql->num_rows() === 1) {
            return $sql->result();
        } else {
            return NULL;
        }
    }
}
