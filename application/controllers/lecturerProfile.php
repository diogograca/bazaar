<!--

This Controller is available at index.php/lecturerProfile

This Controllers is responsible to displaying a specific lecturer profile

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class LecturerProfile
 */
class LecturerProfile extends CI_Controller
{

    /**
     *Loads the models globally, making it available in all functions
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('get_lecturers_model');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {
        //grabs the profile id and passes to the model to retrieve the right lecturer profile
        $id = $this->uri->segment(2);
        $data['profile'] = $this->get_lecturers_model->getProfile($id);
        //gets the lecturer id from the proposal and returns the proposals of that lecturer
        $lecturer_id = $data['profile'][0]->lecturer_id;
        $data['proposals'] = $this->get_lecturers_model->lecturerProposals($lecturer_id);

        $data['title'] = 'Lecturer Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('lecturer_profile_view', $data);
        $this->load->view('templates/footer');

    }
}
