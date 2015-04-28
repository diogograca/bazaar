<!--
This Model is responsible to handling the login request
-->
<?php

/**
 * Class User_login_model
 */
class User_login_model extends CI_Model
{

    /**
     *calls the constructor
     */
    function _construct()
    {
        parent::__construct();
    }

    /**
     * this function is responsible to check if username and password matches
     *
     * @return string
     */
    function user_login()
    {
        //grabs the values from the POST array
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = sha1($password);

        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->limit(1);

        $result = $this->db->get();
        $row = $result->row();

        if ($result->num_rows() === 1) {
            //if login is successfully, sets the user data into the session user data
            if ($row->password === $password) {

                $session_data = array(
                    'user_id' => $row->user_id,
                    'username' => $row->username,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'email' => $row->email,
                    'lecturer' => $row->lecturer,
                    'loggedin' => 1,
                    'admin' => $row->admin
                );
                $this->session->set_userdata($session_data);

                return 'successfully';
            } else {
                return 'wrong password';
            }
        } else {
            return 'username not found';
        }
    }
}
