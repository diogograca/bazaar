<!--

This Controller is available at index.php/login

This Controllers is responsible to manage the Login form

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Login
 */
class Login extends CI_Controller
{

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Login';

        $this->load->view('templates/header', $data);
        $this->load->view('login_view');
        $this->load->view('templates/footer');
    }

    /**
     *This functions handles the Login form
     */
    public function user_login()
    {
        //form validation, this allows to check if the user has inserted valid data without having to send a SQL request
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]|xss_clean');
        // If there are errors go back to the Login view and displays the errors
        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Login';

            $this->load->view('templates/header', $data);
            $this->load->view('login_view');
            $this->load->view('templates/footer');
        } else {
            //If validation is TRUE, loads the model
            $this->load->model('user_login_model');
            $result = $this->user_login_model->user_login();
            //checks if the username and password are corrected and displays the necessary views for each case
            switch ($result) {
                //Password and username matches
                case 'successfully':

                    $username = $this->session->userdata('username');
                    redirect('/profile/' . $username);
                    break;
                //Wrong Password
                case 'wrong password':

                    $data['title'] = 'Password and Username does not match';
                    $data['error'] = 1;

                    $this->load->view('templates/header', $data);
                    $this->load->view('login_view');
                    $this->load->view('templates/footer');
                    break;
                //Username is not registered
                case 'username not found':

                    $data['title'] = 'Password and Username does not match';
                    $data['error'] = 1;

                    $this->load->view('templates/header', $data);
                    $this->load->view('login_view');
                    $this->load->view('templates/footer');
                    break;
            }
        }
    }
}