<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'pages/index';

/**
 * Authentication Routes  
 */
$route['login'] = 'auth/show_login';
$route['register'] = 'auth/show_register';
$route['login/user'] = 'auth/login';
$route['register/user'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['profile'] = 'auth/show_profile';
$route['profile/picture/update'] = 'auth/upload_profile_picture';
$route['profile/update'] = 'auth/update_profile';

/**
 * Tasks Routes
 */

$route['dashboard'] = 'tasks/index';
$route['api/v1/tasks'] = 'tasks/get_all_by_user';
$route['api/v1/tasks/store'] = 'tasks/store';
$route['api/v1/tasks/clear/(:any)'] = 'tasks/destroy_all/$1';
$route['api/v1/tasks/edit/(:any)'] = 'tasks/edit/$1';
$route['api/v1/tasks/update/(:any)'] = 'tasks/update/$1';
$route['api/v1/tasks/(:any)'] = 'tasks/show/$1';
$route['api/v1/tasks/delete/(:any)'] = 'tasks/destroy/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
