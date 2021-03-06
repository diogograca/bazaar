<!--

This Controller is available at index.php/myProposals

This Controllers is responsible to manage the Actions on Lecturers Proposal, such as editing, deleting and confirming deletion

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class MyProposals
 */
class MyProposals extends CI_Controller
{

    /**
     *loads the model globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('proposals_model');
        $this->load->library("pagination");
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        //pagination configuration
        $config = array();
        $config["base_url"] = site_url("/myProposals");
        $config["total_rows"] = $this->proposals_model->record_count_project();
        $config["per_page"] = 1;
        $config["uri_segment"] = 2;
        /* Configuration to integrate pagination style of BootStrap  */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";


        $this->pagination->initialize($config);
        // if segment is NULL then we are on first page, therefore return 0
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data['segment'] = $this->uri->segment(1);
        $data["proposals"] = $this->proposals_model->LecturerProposals($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();



        $data['title'] = 'My Proposals';
        //$data['proposals'] = $this->proposals_model->LecturerProposals();

        $this->load->view('templates/header', $data);
        $this->load->view('myProposals_view', $data);
        $this->load->view('templates/footer');

    }

    /**
     *This function loads the edit_proposal_lecturer_view and passes an id to the model in order to display the information from an specific proposal
     */
    public function editProposal()
    {

        $id = $this->uri->segment(3);

        $auth = $this->proposals_model->checkAuth($id);
        //gets the user_id of the proposal
        if ($auth) {
            $auth = $auth[0]->user_id;
        } else {
            $auth = 0;
        }

        $user = $this->session->userdata('user_id');
        //This checks if the user accessing the webpage is the owner of the proposal, prevents url tampering
        if ($auth == $user) {

            $data['title'] = 'Edit Proposals';
            $data['result'] = $this->proposals_model->getLecturerProposals($id);

            $this->load->view('templates/header_js', $data);
            $this->load->view('edit_proposal_lecturer_view', $data);
            $this->load->view('templates/footer');

        } else {

            $data['title'] = 'Access Denied';

            $this->load->view('templates/header_js', $data);
            $this->load->view('access_denied_view');
            $this->load->view('templates/footer');
        }

    }

    /**
     *This function handles the update of the proposal
     */
    public function applyChanges()
    {

        //form validation
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[3]|max_length[16777215]|xss_clean'); //max length 2 to the of 24(medium text)
        // If there are errors go back to the edit proposal view and displays the errors
        if ($this->form_validation->run() == FALSE) {

            $data['title'] = 'Edit Proposals';
            //No need to fetch the data again, display the data from the POST array
            //The reason not to fetch the data again as it if its an error in the validation, the data reloaded would be the old data
            // from the db and not the one that the user has applied the changes
            $data['result'] = NULL;

            $this->load->view('templates/header_js', $data);
            $this->load->view('edit_proposal_lecturer_view', $data);
            $this->load->view('templates/footer');

        } else {
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $data = array(
                'proposal_title' => $title,
                'proposal_description' => $description
            );
            $id = $this->input->post('proposal_id');
            $this->proposals_model->editLecturerProposal($id, $data);

            redirect('/myProposals');
        }
    }

    /**
     *This functions handles the deletion of the proposal
     */
    public function deleteProposal()
    {
        $id = $this->uri->segment(3);
        //$id = $this->input->post('proposal_id');
        $this->proposals_model->deleteLecturerProposal($id);

        redirect('/myProposals');
    }
}