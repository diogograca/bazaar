<!-- This controller is used to redirect the user to a custom 404 error message page -->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class NotFound
 */
class NotFound extends CI_Controller
{

    /**
     *tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $data['title'] = 'Page Not Found';

        $this->load->view('templates/header', $data);
        $this->load->view('not_found_view');
        $this->load->view('templates/footer');
    }
}