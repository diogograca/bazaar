<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
//custom 404 route
$route['404_override'] = 'notFound';
//proposals route
$route['proposals/(:num)'] = "proposals/index/$1";
$route['proposal/(:num)'] = "proposal/index/$1";
//profile routes
$route['profile/(:any)'] = "profile/index/$1";
//proposal and summaries route
//$route['myProposals/(:num)'] = "myProposals/editProposal/$1";
$route['MySummaries/(:num)'] = "MySummaries/index/$1";
$route['myProposals/(:num)'] = "myProposals/index/$1";
//Lecturer profiles routs
$route['lecturers/(:num)'] = "lecturers/index/$1";
//project summaries route
$route['projectsSummaries/(:num)'] = "projectsSummaries/index/$1";
//project summary route
$route['ProjectSummary/(:num)'] = "projectSummary/index/$1";
//lecturer profile route
$route['lecturerProfile/(:num)'] = "lecturerProfile/index/$1";
//student interests route
$route['StudentInterests/(:num)'] = "studentInterests/index/$1";
//student proposals received route
$route['receivedProposals/(:num)'] = "receivedProposals/index/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */