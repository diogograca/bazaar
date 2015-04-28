<!--

This Controller is available at index.php/receivedProposals

This Controllers is responsible to load all proposals that were submitted to a specific lecturer

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class ReceivedProposals
 */
class ReceivedProposals extends CI_Controller
{

    /**
     *loads the models globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model('student_proposals_model');
        $this->load->library("pagination");
        $this->load->helper('text');

    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Received Proposals';

        //pagination configuration
        $config = array();
        $config["base_url"] = site_url("/receivedProposals");
        $config["total_rows"] = $this->student_proposals_model->record_count();
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
        $data["proposals"] = $this->student_proposals_model->getProposals($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('received_proposals_view', $data);
        $this->load->view('templates/footer');
    }
}