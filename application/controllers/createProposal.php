<!--

This Controller is available at index.php/createProposal

This Controllers is responsible to manage the Creation of Lecturers Proposals

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class CreateProposal
 */
class CreateProposal extends CI_Controller
{

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Proposals';

        $this->load->view('templates/header_js', $data);
        $this->load->view('proposal_create_view');
        $this->load->view('templates/footer');
    }

    /**
     *This functions handles the creation of the Lecturer Proposal
     */
    public function create_Proposal()
    {
        //form validation
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'required|min_length[3]|max_length[16777215]|xss_clean'); //max length 2 to the of 24(medium text)
        // If there are errors go back to the create proposal view and displays the errors
        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Proposals';

            $this->load->view('templates/header_js', $data);
            $this->load->view('proposal_create_view');
            $this->load->view('templates/footer');
        } else {
            //If there are no errors call the model and display the successful view
            $this->load->model('proposal_create_model');
            $result = $this->proposal_create_model->create_proposal();

            if ($result) {

                $this->load->model('create_profile_model');

                $data['title'] = 'Proposal Created';
                $data['result'] = $this->create_profile_model->getProfile();
                $data['alert'] = 'Your proposal has been created!';

                $this->load->view('templates/header', $data);
                $this->load->view('profile_view', $data);
                $this->load->view('templates/footer');

            } else {
                // This should never happen as the data has been validated prior to the submission to the model, therefore it should always return TRUE
                //However this might happen if MySQL is down, which shouldn't happen
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
}
