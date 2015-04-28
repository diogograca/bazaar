<!--

This Controller is available at index.php/createProfile

This Controllers is responsible to create Lecturer Profiles and handle Profile Picture Uploads (Lecturers Only)

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class CreateProfile
 */
class CreateProfile extends CI_Controller
{

    /**
     * Constructor
     */
    function _construct()
    {
        parent::__construct();
        $this->load->helper('form');

    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Create Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('create_profile_view');
        $this->load->view('templates/footer');
    }

    /**
     *This function handles the creation of Lecturer profile
     */
    public function create_profile()
    {

        //form validation
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]|max_length[65535]|xss_clean');
        $this->form_validation->set_rules('areas', 'Specialist Areas', 'trim|required|min_length[10]|max_length[65535]|xss_clean');
        // If there are errors go back to the create profile view and displays the errors
        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Create Profile';

            $this->load->view('templates/header', $data);
            $this->load->view('create_profile_view');
            $this->load->view('templates/footer');
        } else {
            //If Validation is TRUE loads the model and calls the create_lecturer_profile function
            $this->load->model('create_profile_model');
            $result = $this->create_profile_model->create_lecturer_profile();
            //If insertion is successful,redirect user to profile page
            if ($result) {

                $username = $this->session->userdata('username');
                redirect('/profile/' . $username);
            } else {
                // This should never happen as the data has been validated prior to the submission to the model, therefore it should always return TRUE
                //However this might happen if MySQL is down, which shouldn't happen
                $data['title'] = 'Error creating Profile';

                $this->load->view('templates/header', $data);
                $this->load->view('create_profile_view');
                $this->load->view('templates/footer');
            }
        }
    }

    /**
     *This function handles the upload of the Profile Picture and saves into /uploads file
     */
    public function do_upload()
    {

        $username = $this->session->userdata('username');
        /*
        Although the upload has overwritten on, it does not overwrite different file format, e.g.
        username.jpg wont overwrite username.png, therefore we need to delete the current picture before uploading
        a new one
        */
        if (file_exists("uploads/" . $username . ".jpg")) {
            unlink("uploads/" . $username . ".jpg");
        } elseif (file_exists("uploads/" . $username . ".png")) {
            unlink("uploads/" . $username . ".png");
        }
        //upload configuration
        $config['upload_path'] = './uploads/';
        $config['file_name'] = $username;
        $config['overwrite'] = TRUE;
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $data['title'] = 'error';
            /*This had to be added as if there was an error with the upload, the lecturer profile would not show up
            as its a different page, therefor a php error appeared*/
            $this->load->model('create_profile_model');
            $data['result'] = $this->create_profile_model->getProfile();

            $this->load->view('templates/header', $data);
            $this->load->view('profile_view', $error, $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->session->userdata('username');
            redirect('/profile/' . $username);
        }
    }
}