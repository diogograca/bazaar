<!--

This Controller is available at index.php/lecturers

This Controllers is responsible to retrieve all the Lecturers Profiles, and controls the page pagination configuration. Also it manages the search profiles queries

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Lecturers
 */
class Lecturers extends CI_Controller
{

    /**
     *loads the models globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {

        parent::__construct();

        $this->load->model('Get_lecturers_model');
        $this->load->library("pagination");
        $this->load->helper('text');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Lecturers';
        //$data['results'] = $this->Get_lecturers_model->getProfiles();
        //pagination configuration
        $config = array();
        $config["base_url"] = site_url("/lecturers");
        $config["total_rows"] = $this->Get_lecturers_model->record_count();
        $config["per_page"] = 2;
        $config["uri_segment"] = 2;
        /* Configuration to integrate paginantion style of BootStrap  */
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
        $data["results"] = $this->Get_lecturers_model->get_profiles($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('lecturers_views', $data);
        $this->load->view('templates/footer');
    }


    /**
     *This functions handles the search query and query the database
     */
    public function searchResults()
    {

        $search = $this->input->post('search_terms');
        $data['title'] = 'Search Results';
        $data['results'] = $this->Get_lecturers_model->searchLecturers($search);

        $this->load->view('templates/header', $data);
        $this->load->view('profiles_search_view', $data);
        $this->load->view('templates/footer');
    }
}