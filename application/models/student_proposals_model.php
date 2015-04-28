<!--
This Model is responsible to handling the creation of an user and storing the user information into the user session data
-->
<?php

/**
 * Class Student_proposals_model
 */
class Student_proposals_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }
    /**/
    /**
     * This function returns all proposals submitted to that specific lecturer that is logged in and
     * joins with the user table to return the the student information
     *
     * @param $limit
     * @param $start
     * @return array|null
     */
    public function getProposals($limit, $start)
    {

        $user_id = $this->session->userdata('user_id');

        $this->db->where('lecturer_id', $user_id);
        $this->db->join('users', 'users.user_id = student_proposal.student_id');
        $this->db->limit($limit, $start);
        $sql = $this->db->get('student_proposal');
        //returns the proposals
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
     * This function counts how many proposals have been submitted to the lecturer so it can be used for pagination
     *
     * @return mixed
     */
    public function record_count()
    {

        $user_id = $this->session->userdata('user_id');
        $this->db->where('lecturer_id', $user_id);
        return $this->db->count_all_results("student_proposal");
    }
}