<!--

This Controller is available at index.php/proposal/(:num)

This Controllers is responsible to load on an specific Proposal and Allow students to express interest in the proposal

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Proposal
 */
class Proposal extends CI_Controller
{

    /**
     *loads the models globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('proposals_model');
        $this->load->model('proposal_interest_model');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Proposal';
        $id = $this->uri->segment(2);
        $data['proposal'] = $this->proposals_model->getProposal($id);
        $data['profile'] = $this->proposals_model->getOwnerProfile($id);

        $this->load->view('templates/header', $data);
        $this->load->view('proposal_view', $data);
        $this->load->view('templates/footer');
    }

    /**
     *This functions handles the student interest in the proposal
     */
    public function proposal_interest()
    {
        //Grabs the user_d from the session data
        $logged_in = $this->session->userdata('loggedin');
        //If user is logged in send the interest to the model
        if ($logged_in) {

            $result = $this->proposal_interest_model->create_interest();
            //If interest is submitted, loads the successful view
            if ($result) {

                $data['title'] = 'Interest Submitted';

                $this->load->view('templates/header', $data);
                $this->load->view('interest_submitted_view');
                $this->load->view('templates/footer');
            } else {
                //This should never happen, unless there is an error with the database
                $data['title'] = 'Interest Submission Failed';

                $this->load->view('templates/header', $data);
                $this->load->view('interest_submitted_failed_view');
                $this->load->view('templates/footer');
            }
        } else {
            //user is not logged in
            $data['title'] = 'Not Logged in';

            $this->load->view('templates/header', $data);
            $this->load->view('interest_submitted_failed_view');
            $this->load->view('templates/footer');
        }
    }
}
