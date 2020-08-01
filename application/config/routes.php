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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// main
$route['/'] = 'main/index';
$route['calendar'] = 'main/calendar';
$route['artikel'] = 'main/artikel';
$route['artikel/(:any)'] = 'main/artikelSingle/$1';
// route auth
$route['auth'] = 'auth/index';
$route['login'] = 'auth/login';
$route['gen'] = 'auth/gen';
// route admin
$route['admin'] = 'admin/index';
$route['admin/logout'] = 'admin/logout';
$route['admin/user'] = 'admin/user';
$route['admin/user/add'] = 'admin/addUser';
$route['admin/user/edit/(:num)'] = 'admin/updateUser/$1';
$route['admin/kegiatan'] = 'admin/kegiatanList';
$route['admin/kegiatan/add'] = 'admin/addKegiatan';
$route['admin/kegiatan/edit/(:num)'] = 'admin/updateKegiatan/$1';
$route['admin/kegiatan/review/(:num)'] = 'admin/addReview/$1';
$route['admin/jenis/add'] = 'admin/addJenis';
// route admin artikel
$route['admin/artikel'] = 'admin/artikelList';
$route['admin/artikel/add'] = 'admin/addArtikel';
$route['admin/artikel/edit/(:num)'] = 'admin/updateArtikel/$1';
$route['admin/artikel/delete/(:num)'] = 'admin/deleteArtikel/$1';
// route subadmin
$route['home'] = 'home/index';
$route['home/kegiatan'] = 'home/kegiatanList';
$route['home/kegiatan/add'] = 'home/addKegiatan';
$route['home/kegiatan/edit/(:num)'] = 'home/updateKegiatan/$1';
$route['home/kegiatan/review/(:num)'] = 'home/addReview/$1';
$route['home/user/profile'] = 'Home/updateProfile';
$route['home/logout'] = 'home/logout';
// route calendar
$route['api/calendar'] = 'calendar/kegiatan';