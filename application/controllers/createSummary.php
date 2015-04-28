<!--

This Controller is available at index.php/CreateSummary

This Controllers is responsible to create projects summaries, and handles the images uploads

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class CreateSummary
 */
class CreateSummary extends CI_Controller
{

    /**
     *Loads the model globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->model('projects_summaries_model');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Create Summary';

        $this->load->view('templates/header_js', $data);
        $this->load->view('create_summary_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     *This functions handles with the creation of a new project Summary
     */
    public function create_Summary()
    {

        /*these 3 variables are used to created an unique image name
        by using the session id, username and a random number (8-10 digits)
        */
        $username = $this->session->userdata('username');
        $session_id = $this->session->userdata('session_id');
        $img = mt_rand();
        //upload configuration
        $config['upload_path'] = './uploads/';
        $config['file_name'] = $session_id . $username . $img;
        $config['overwrite'] = FALSE;
        $config['allowed_types'] = 'jpg|png';
        $config['max_size'] = '2048000';
        $config['max_width'] = '10240';
        $config['max_height'] = '7680';

        $this->load->library('upload', $config);

        //form validation
        $this->form_validation->set_rules('title', 'Project Title', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('description', 'Project Summary', 'required|min_length[3]|max_length[16777215]|xss_clean'); //max length 2 to the of 24(medium text)
        //If there are validation errors go back to the page and display errors
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Create Summary';

            $this->load->view('templates/header_js', $data);
            $this->load->view('create_summary_view');
            $this->load->view('templates/footer');
        } else {

            //uploads are optional, therefore check if any of the 3 images have been uploaded
            //each file has to be uploaded individual as CodeIgniter does not support multiple uploads
            if (!$this->upload->do_upload('image')) {
                $image = '';

            } else {
                //gets the file name from the upload data
                $data = $this->upload->data();
                $image = $data['file_name'];
            }

            if (!$this->upload->do_upload('image2')) {
                $image2 = '';

            } else {
                $data = $this->upload->data();
                $image2 = $data['file_name'];
            }

            if (!$this->upload->do_upload('image3')) {
                $image3 = '';

            } else {
                $data = $this->upload->data();
                $image3 = $data['file_name'];
            }

            //If there are no errors call the model and display the successful view
            $result = $this->projects_summaries_model->create_summary($image, $image2, $image3);

            if ($result) {

                $this->load->model('create_profile_model');

                $data['title'] = 'Summary Created';
                $data['result'] = $this->create_profile_model->getProfile();
                $data['alert'] = 'Your summary has been created!';

                $this->load->view('templates/header', $data);
                $this->load->view('profile_view', $data);
                $this->load->view('templates/footer');

            } else {
                // This should never happen as the data has been validated prior to the submission to the model, therefore it should always return TRUE
                //However this might happen if MySQL is down, which shouldn't happen
                $this->load->model('create_profile_model');

                $data['title'] = 'Summary Failed';
                $data['result'] = $this->create_profile_model->getProfile();
                $data['insert_error'] = 'Project Summary has not been created, please contact the admin!';

                $this->load->view('templates/header', $data);
                $this->load->view('profile_view', $data);
                $this->load->view('templates/footer');
            }
        }
    }
}