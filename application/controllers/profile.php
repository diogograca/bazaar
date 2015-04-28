<!--

This Controller is available at index.php/profile/(:username)

This Controllers is responsible to display the user profile

-->
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class Profile
 */
class Profile extends CI_Controller
{

    /**
     *Tells the controller what views to load when this controller is accessed
     */
    public function index()
    {

        $this->load->model('create_profile_model');
        $data['title'] = 'My Profile';
        $data['result'] = $this->create_profile_model->getProfile();

        $this->load->view('templates/header', $data);
        $this->load->view('profile_view', $data);
        $this->load->view('templates/footer');
    }
}