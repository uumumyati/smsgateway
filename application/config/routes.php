<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller']            = 'home';
$route['404_override']                  = '';
$route['translate_uri_dashes']          = FALSE;

$route['logout']                        = 'login/logout';

$route['inbox/(:num)']                  = 'inbox/index/$1';

$route['outbox/(:num)']                 = 'outbox/index/$1';

$route['sent/(:num)']                   = 'sent/index/$1';

$route['phonebook-group']               = 'phonebookgroup/index';
$route['phonebook-group/create']        = 'phonebookgroup/create';
$route['phonebook-group/edit/(:num)']   = 'phonebookgroup/edit/$1';
$route['phonebook-group/delete']        = 'phonebookgroup/delete';

$route['phonebook-contact']             = 'phonebookcontact/index';
$route['phonebook-contact/(:num)']      = 'phonebookcontact/index/$1';
$route['phonebook-contact/create']      = 'phonebookcontact/create';
$route['phonebook-contact/edit/(:num)'] = 'phonebookcontact/edit/$1';
$route['phonebook-contact/delete']      = 'phonebookcontact/delete';

$route['sms/create']                    = 'sms/create';

$route['sms-signature/create']          = 'smssignature/create';

$route['sms-group/create']              = 'smsgroup/create';

$route['sms-broadcast/create']          = 'smsbroadcast/create';

$route['sms-flash/create']              = 'smsflash/create';

$route['sms-scheduled']                 = 'smsscheduled/index';
$route['sms-scheduled/(:num)']          = 'smsscheduled/index/$1';
$route['sms-scheduled/create']          = 'smsscheduled/create';
$route['sms-scheduled/delete']          = 'smsscheduled/delete';

