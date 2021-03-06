<!--

This Controller is available at index.php/ProjectSummary

This Controllers is responsible to displaying a single project summary

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class ProjectSummary
 */
class ProjectSummary extends CI_Controller
{

    /**
     *loads the model globally, making it available in all functions, so there's no need to load the model multiple times
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('projects_summaries_model');

    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Project Summary';
        $id = $this->uri->segment(2);
        $data['result'] = $this->projects_summaries_model->get_Summary($id);


        $this->load->view('templates/header', $data);
        $this->load->view('project_summary_view', $data);
        $this->load->view('templates/footer');
    }

}