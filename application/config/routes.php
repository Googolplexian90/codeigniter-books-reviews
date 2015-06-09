<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "main";
$route['404_override'] = '';

//Making our human-friendly urls work
$route['sign-in'] = "users/sign_in";
$route['sign-up'] = "users/create";
$route['sign-out'] = "users/sign_out";

//Setting up some RESTful Routing
$route['users/(:num)'] = "users/show/$1";
$route['books/(:num)'] = "books/show/$1";

//end of routes.php