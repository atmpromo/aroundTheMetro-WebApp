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
$route['default_controller'] = 'home';
$route['404_override'] = '';

/*home*/
$route['home'] = 'home/index/0';
$route['home_fr'] = 'home/index/1';
$route['home_cn'] = 'home/index/2';

$route['home/search'] = 'home/search/0';
$route['home_fr/search'] = 'home/search/1';
$route['home_cn/search'] = 'home/search/2';

$route['map'] = 'map/index/0';
$route['map_fr'] = 'map/index/1';
$route['map_cn'] = 'map/index/2';

$route['map/content'] = 'map/content/0';
$route['map_fr/content'] = 'map/content/1';
$route['map_cn/content'] = 'map/content/2';

$route['stores/(:any)'] = 'stores/index/0/$1';
$route['stores_fr/(:any)'] = 'stores/index/1/$1';
$route['stores_cn/(:any)'] = 'stores/index/2/$1';

$route['store_details/(:any)'] = 'store_details/index/0/$1';
$route['store_details_fr/(:any)'] = 'store_details/index/1/$1';
$route['store_details_cn/(:any)'] = 'store_details/index/2/$1';

$route['mall_details/(:any)'] = 'mall_details/index/0/$1';
$route['mall_details_fr/(:any)'] = 'mall_details/index/1/$1';
$route['mall_details_cn/(:any)'] = 'mall_details/index/2/$1';

$route['jobs'] = 'jobs/index/0';
$route['jobs_fr'] = 'jobs/index/1';
$route['jobs_cn'] = 'jobs/index/2';

$route['hotels'] = 'hotels/index/0';
$route['hotels_fr'] = 'hotels/index/1';
$route['hotels_cn'] = 'hotels/index/2';

$route['events'] = 'events/index/0';
$route['events_fr'] = 'events/index/1';
$route['events_cn'] = 'events/index/2';

$route['promotions'] = 'promotions/index/0';
$route['promotions_fr'] = 'promotions/index/1';
$route['promotions_cn'] = 'promotions/index/2';

$route['about'] = 'about/index/0';
$route['about_fr'] = 'about/index/1';
$route['about_cn'] = 'about/index/2';

$route['contact'] = 'contact/index/0';
$route['contact_fr'] = 'contact/index/1';
$route['contact_cn'] = 'contact/index/2';
/* End of file routes.php */
/* Location: ./application/config/routes.php */
