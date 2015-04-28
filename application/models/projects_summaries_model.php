<!--
This Model is responsible to
-->
<?php

/**
 * Class Projects_summaries_model
 */
class Projects_summaries_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     * This functions inserts a new project summary into the database
     *
     * @param $image
     * @param $image2
     * @param $image3
     * @return bool
     */
    public function create_summary($image, $image2, $image3)
    {

        //grabs the values from the POST array and user session
        $title = $this->input->post('title');
        $summary = $this->input->post('description');
        $user = $this->session->userdata('user_id');

        $data = array(
            'user_id' => $user,
            'project_title' => $title,
            'project_summary' => $summary,
            'image' => $image,
            'image2' => $image2,
            'image3' => $image3
        );
        //inserts the data into the database
        $this->db->insert('projects_summaries', $data);
        //If insertion is successfully returns true
        if ($this->db->affected_rows() === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function counts how many proposals are in the proposals table so it can be used for the pagination
     *
     * @return mixed
     */
    public function record_count()
    {
        return $this->db->count_all("projects_summaries");
    }


    /**
     * This function receives 2 parameters with determine how many records to return and where to start from, used for pagination
     *
     * @param $limit
     * @param $start
     * @return array|null
     */
    public function get_Summaries($limit, $start)
    {
        $this->db->limit($limit, $start);
        $sql = $this->db->get("projects_summaries");

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
     * This function returns the user id of the summary to be used for authentication
     *
     * @param $id
     * @return null
     */
    public function checkAuth($id)
    {

        $this->db->select('user_id');
        $this->db->where('summary_id', $id);
        $sql = $this->db->get("projects_summaries");

        if ($sql->num_rows() === 1) {
            return $sql->result();
        } else {
            return NULL;
        }
    }


    /**
     * This function receives 1 parameters which determines which project to retrieve
     *
     * @param $id
     * @return null
     */
    public function get_Summary($id)
    {

        $this->db->where('summary_id', $id);
        $sql = $this->db->get("projects_summaries");

        if ($sql->num_rows() === 1) {
            return $sql->result();
        } else {
            return NULL;
        }
    }

    /**
     * This function returns all summaries that belongs to the user that is logged in
     *
     * @param $limit
     * @param $start
     * @return array|null
     */
    public function LecturerSummaries($limit, $start)
    {

        $id = $this->session->userdata('user_id');
        $this->db->where('user_id', $id);
        $this->db->limit($limit, $start);
        $sql = $this->db->get('projects_summaries');

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
    public function record_count_summary()
    {

        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results("projects_summaries");
    }

    /**
     * This function takes two variables which updates a summary, it takes the summary id and the data that needs to be updated
     *
     * @param $id
     * @param $data
     * @return bool
     */
    public function editLecturerSummary($id, $data)
    {

        $this->db->where('summary_id', $id);
        $this->db->update('projects_summaries', $data);

        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function takes the summary id and deletes that summary from the projects_summaries table
     *
     * @param $id
     * @return bool
     */
    public function deleteLecturerSummary($id)
    {

        $this->db->where('summary_id', $id);
        $this->db->delete('projects_summaries');

        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            return false;
        }
    }
}
