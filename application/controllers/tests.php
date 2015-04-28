<!--
This Controller is available at index.php/tests
This Controller is responsible for the automated tests

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Tests
 */
class Tests extends CI_Controller
{

    /**
     *Index of the Tests Controller
     */
    public function index()
    {
        //loads models
        $this->load->library('unit_test');
        $this->load->model('home_model');
        $this->load->model('get_lecturers_model');
        $this->load->model('projects_summaries_model');
        $this->load->model('proposals_model');
        $this->load->model('users_model');
        $this->load->model('student_proposals_model');

        //Home Page Tests
        $home_proposal = $this->home_model->get_latests_proposals() ;
        $this->unit->run($home_proposal, 'is_array', 'Latest Proposals');
        $home_profile = $this->home_model->get_random_lecturer();
        $this->unit->run($home_profile, 'is_array', 'Random Lecturer');
        //Lecturers Profiles
        $lectures_profile = $this->get_lecturers_model->get_profiles(2, 1);
        $this->unit->run($lectures_profile, 'is_array', 'Lecturers Profiles');
        $results = $this->get_lecturers_model->searchLecturers('');
        $this->unit->run($results, 'is_array', 'Lecturer Search');
        //Lecturer Profile and his current proposals
        $lecturer_profile = $this->get_lecturers_model->lecturerProposals(4);
        $this->unit->run($lecturer_profile, 'is_array', 'Lecturer Profile');
        $lecturer_proposal = $this->get_lecturers_model->getProfile(2);
        $this->unit->run($lecturer_proposal, 'is_array', 'Lecturer Current Proposal');
        //Project Summaries
        $project_summaries = $this->projects_summaries_model->get_Summaries(4, 1);
        $this->unit->run($project_summaries, 'is_array', 'Past Project Summaries');
        //Project Summary
        $project_summary = $this->projects_summaries_model->get_Summary(64);
        $this->unit->run($project_summary, 'is_array', 'Project Summary data');
        //Project Proposals
        $project_proposals = $this->proposals_model->get_proposals(4, 1);
        $this->unit->run($project_proposals, 'is_array', 'Project Proposals');
        $proposals_search = $this->proposals_model->searchProposals('');
        $this->unit->run($proposals_search, 'is_array', 'Project Proposals Search');
        //Project Proposal
        $project_proposal = $this->proposals_model->getProposal(1);
        $this->unit->run($project_proposal, 'is_array', 'Project Proposal Data');
        $proposal_owner = $this->proposals_model->getOwnerProfile(1);
        $this->unit->run($proposal_owner, 'is_array', 'Project Proposal Owner Profile');
        //My Proposals
        $my_proposals = $this->proposals_model->LecturerProposals(1, 1);
        $this->unit->run($my_proposals, 'is_array', 'All Proposals of a Lecturer');
        //User list
        $user_list = $this->users_model->getUsers();
        $this->unit->run($user_list, 'is_array', 'Users List');
        //Student Interest in a lecturer project
        $student_interests = $this->proposals_model->studentInterest(1);
        $this->unit->run($student_interests, 'is_array', 'All students interrested in a Project');
        //Student Proposals Received
        $received_proposals = $this->student_proposals_model->getProposals(1, 1);
        $this->unit->run($received_proposals, 'is_array', 'Proposals Received from Students');

        echo $this->unit->report();

    }
}