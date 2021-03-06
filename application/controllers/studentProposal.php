<!--

This Controller is available at index.php/studentProposal

This Controllers is responsible to send Students Proposals to Lecturers

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class StudentProposal
 */
class StudentProposal extends CI_Controller
{

    /**
     *loads the model globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('proposal_create_model');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Student Proposal';
        $data['names'] = $this->proposal_create_model->getNames();

        $this->load->view('templates/header_js', $data);
        $this->load->view('student_proposal_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     *This functions validates the form inputs and inserts the proposal into the database
     */
    public function submitProposal()
    {
        //form validation, this allows to check if the user has inserted valid data without having to send a SQL request
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]|max_length[16777215]|xss_clean'); //max length 2 to the of 24(medium text)
        $this->form_validation->set_rules('lecturer', 'Lecturer', 'required|callback_lecturer_selected');
        // If there are errors go back to the Student proposal view and displays the errors
        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Student Proposal';
            $data['names'] = $this->proposal_create_model->getNames();

            $this->load->view('templates/header_js', $data);
            $this->load->view('student_proposal_view', $data);
            $this->load->view('templates/footer');
        } else {
            //If validation is TRUE, calls the model function to insert the proposal into the database
            $result = $this->proposal_create_model->student_proposal();

            if ($result) {

                $this->load->model('create_profile_model');

                $data['title'] = 'Project Submitted';
                $data['result'] = $this->create_profile_model->getProfile();
                $data['alert'] = 'Your proposal has been submitted to your lecturer!';

                $this->load->view('templates/header', $data);
                $this->load->view('profile_view', $data);
                $this->load->view('templates/footer');
            } else {
                //This should never happen as validation is done prior to sending the request to the model
                $this->load->model('create_profile_model');

                $data['title'] = 'Proposal Failed';
                $data['result'] = $this->create_profile_model->getProfile();
                $data['insert_error'] = 'Proposal Creation Failed!Please contact admin!';

                $this->load->view('templates/header', $data);
                $this->load->view('profile_view', $data);
                $this->load->view('templates/footer');
            }
        }
    }

    /**
     * This function checks if a lecturer has been selected on the form
     *
     * @param $value
     * @return bool
     */
    public function lecturer_selected($value)
    {

        if ($value !== '0') {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
