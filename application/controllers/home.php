<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Home
 */
class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct() {

        parent::__construct();

        $this->load->model('home_model');
        $this->load->helper('text');
    }

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()	{

        $data['title'] = 'Project Bazaar';
        //returns the 3 latest project proposals
        $data["proposals"] = $this->home_model->get_latests_proposals();
        //returns a random lecturer profile
        $data["profile"] = $this->home_model->get_random_lecturer();

        $this->load->view('templates/header', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }

    /**
     *This function kills the user session
     */
    public function logout(){

        $this->session->sess_destroy();
        //redirects to home page
        redirect();
    }
}