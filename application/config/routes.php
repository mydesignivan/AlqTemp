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
| 	example.com/class/method/id/
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
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "index";
$route['scaffolding_trigger'] = "";

$route['casas'] = "index/casas";
$route['departamentos'] = "index/departamentos";
$route['cabanias'] = "index/cabanias";
$route['otros'] = "index/otros";

$route['casas/page'] = "index/casas/page/";
$route['casas/page/:num'] = "index/casas/page/$1";

$route['departamentos/page'] = "index/departamentos/page/";
$route['departamentos/pagge/:num'] = "index/departamentos/page/$1";

$route['cabanias/page'] = "index/cabanias/page/";
$route['cabanias/page/:num'] = "index/cabanias/page/$1";

$route['otros/page'] = "index/otros/page/";
$route['otros/page/:num'] = "index/otros/page/$1";

$route['checkout_success/:any'] = "checkout_success/index/$1";
$route['checkout_cancel/:any'] = "checkout_cancel/index/$1";

$route['searcher/:any'] = "index/searcher/$1";
$route['display/:any'] = "index/display/$1";

$route['paneluser/propiedades/page/:any'] = "paneluser/propiedades/index/page/$1";
$route['paneluser/propiedades/page'] = "paneluser/propiedades/index/page";

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */