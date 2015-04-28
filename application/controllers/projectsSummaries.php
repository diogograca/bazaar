<!--

This Controller is available at index.php/ProjectsSummaries

This Controllers is responsible to displaying projects summaries, and handling the pagination

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class ProjectsSummaries
 */
class ProjectsSummaries extends CI_Controller
{

    /**
     *loads the model globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('projects_summaries_model');
        $this->load->library('pagination');
        //Needed to use word_limiter() function on view
        $this->load->helper('text');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Projects Summaries';

        //pagination configuration
        $config = array();
        $config["base_url"] = site_url("/projectsSummaries");
        $config["total_rows"] = $this->projects_summaries_model->record_count();
        $config["per_page"] = 4;
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
        $data['results'] = $this->projects_summaries_model->get_Summaries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('templates/header', $data);
        $this->load->view('projects_summaries_view', $data);
        $this->load->view('templates/footer');
    }

}