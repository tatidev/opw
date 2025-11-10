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
$route['default_controller'] = 'home';
//$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['site'] = 'home/index/1';
$route['site/(:any)'] = 'home/index/1';
$route['home/(:num)'] = 'home/index/$1';
$route['faq'] = 'home/faq';
$route['terms'] = 'home/terms';
$route['warranty'] = 'home/warranty';
$route['cleanings'] = 'home/cleanings';
$route['search'] = 'search/index';
$route['about'] = 'about/index';
$route['portfolio'] = 'portfolio/index';
$route['showrooms'] = 'about/showrooms';
$route['showrooms/(:any)'] = 'about/showrooms/$1';

$route['item/specsheet/(:any)/(:any)'] = 'product/item_specsheet/$1/$2';
	
$route['closeout'] = 'product/closeout';
$route['product/specsheet/(:any)'] = 'product/specsheet/$1';
$route['product/(:any)'] = 'product/index'; // Called by fabrics as 'product/name'
$route['product/(:any)/(:any)'] = 'product/index'; // Called by Digital Styles as 'product/digital/name'
$route['pattern/(:any)'] = 'pattern/index';

$route['digital/grounds/specsheet/(:any)'] = 'digital/ground_specsheet/$1';
$route['digital/grounds/get_ground_info'] = 'digital/get_ground_info';
$route['digital/grounds/drapery'] = 'digital/gr_drapery';
$route['digital/grounds/upholstery'] = 'digital/gr_upholstery';
$route['digital/grounds/sheers'] = 'digital/gr_sheers';
$route['digital/grounds/(:any)'] = 'digital/grounds';
$route['digital/grounds'] = 'digital/grounds';
$route['digital/view-all'] = 'pattern/index';
$route['digital/(:any)'] = 'pattern/index';

//$route['screenprints/grounds/drapery'] = 'screenprints/gr_drapery';
//$route['screenprints/grounds/upholstery'] = 'screenprints/gr_upholstery';
//$route['screenprints/grounds/(:any)'] = 'screenprints/grounds';
//$route['screenprints/archive'] = 'screenprints/index';

$route['collection/viewall'] = 'collection/viewall';
$route['collection/new-arrivals'] = 'collection/newarrivals';
$route['collection/drapery'] = 'collection/drapery';
$route['collection/upholstery'] = 'collection/upholstery';
$route['collection/outdoors'] = 'collection/outdoors';
$route['collection/performance'] = 'collection/performance';
$route['collection/vinyls'] = 'collection/vinyls';
$route['collection/prints'] = 'collection/prints';
$route['collection/sheers'] = 'collection/sheers';
$route['collection/(:any)'] = 'collection/index/$1';
$route['weave/(:any)'] = 'weave/index';
$route['content/(:any)'] = 'content/index';
$route['colorway/(:any)'] = 'colorway/index';
$route['firecode/(:any)'] = 'collection/firecode/$1';
//$route['30-under'] = 'collection/under30';