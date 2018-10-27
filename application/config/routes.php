<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';

$route['welcome'] = 'welcome';
$route['building_data'] = 'building_data';

$route['user'] = 'user';
$route['user_login'] = 'user_login';

$route['calendar'] = 'calendar';

$route['email'] = 'email';




$route[':any'] = 'welcome/building';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
