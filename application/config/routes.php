<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "users";
$route['404_override'] = '';

//Yes, the routing file is stupid enough to need this declaration
$route['users/sign-in'] = "users/sign_in";

//Setting up RESTful Routing
$route['users/(:num)'] = "users/show/$1";
$route['books/(:num)'] = "books/show/$1";

//end of routes.php