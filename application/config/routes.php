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
$route['default_controller'] = 'world';
$route['404_override'] = '';

/*home*/
$route['world'] = 'world/index/0';
$route['world_fr'] = 'world/index/1';
$route['world_cn'] = 'world/index/2';

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

$route['mall_filter/(:any)/(:any)'] = 'mall_filter/index/0/$1/$2';
$route['mall_filter_fr/(:any)/(:any)'] = 'mall_filter/index/1/$1/$2';
$route['mall_filter_cn/(:any)/(:any)'] = 'mall_filter/index/2/$1/$2';

$route['store_details/(:any)'] = 'store_details/index/0/$1';
$route['store_details_fr/(:any)'] = 'store_details/index/1/$1';
$route['store_details_cn/(:any)'] = 'store_details/index/2/$1';

$route['place_details/(:any)/(:any)/(:any)'] = 'place_details/index/0/$1/$2/$3';
$route['place_details_fr/(:any)/(:any)/(:any)'] = 'place_details/index/1/$1/$2/$3';
$route['place_details_cn/(:any)/(:any)/(:any)'] = 'place_details/index/2/$1/$2/$3';

$route['mall_details/(:any)'] = 'mall_details/index/0/$1';
$route['mall_details_fr/(:any)'] = 'mall_details/index/1/$1';
$route['mall_details_cn/(:any)'] = 'mall_details/index/2/$1';

$route['metro_details/(:any)/(:any)/(:any)'] = 'metro_details/index/0/$1/$2/$3';
$route['metro_details_fr/(:any)/(:any)/(:any)'] = 'metro_details/index/1/$1/$2/$3';
$route['metro_details_cn/(:any)/(:any)/(:any)'] = 'metro_details/index/2/$1/$2/$3';

$route['metro_filter/(:any)/(:any)'] = 'metro_filter/index/0/$1/$2';
$route['metro_filter_fr/(:any)/(:any)'] = 'metro_filter/index/1/$1/$2';
$route['metro_filter_cn/(:any)/(:any)'] = 'metro_filter/index/2/$1/$2';

$route['jobs'] = 'jobs/index/0';
$route['jobs_fr'] = 'jobs/index/1';
$route['jobs_cn'] = 'jobs/index/2';

$route['citydata/(:any)/(:any)'] = 'citydata/index/0/$1/$2';
$route['citydata_fr/(:any)/(:any)'] = 'citydata/index/1/$1/$2';
$route['citydata_cn/(:any)/(:any)'] = 'citydata/index/2/$1/$2';

$route['places/(:any)/(:any)/(:any)'] = 'places/index/0/$1/$2/$3';
$route['places_fr/(:any)/(:any)/(:any)'] = 'places/index/1/$1/$2/$3';
$route['places_cn/(:any)/(:any)/(:any)'] = 'places/index/2/$1/$2/$3';

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

//$route['api/(:any)'] = 'api/$1/0';
//$route['api_fr/(:any)'] = 'api/$1/1';
//$route['api_cn/(:any)'] = 'api/$1/2';

$route['api/(:any)/(:any)/(:any)'] = 'api/testapi/0/$1/$2/$3';
$route['api_fr/(:any)/(:any)/(:any)'] = 'api/testapi/1/$1/$2/$3';
$route['api_cn/(:any)/(:any)/(:any)'] = 'api/testapi/2/$1/$2/$3';

$route['api/(:any)/(:any)/(:any)/(:any)'] = 'api/testapi/0/$1/$2/$3/$4';
$route['api_fr/(:any)/(:any)/(:any)/(:any)'] = 'api/testapi/1/$1/$2/$3/$4';
$route['api_cn/(:any)/(:any)/(:any)/(:any)'] = 'api/testapi/2/$1/$2/$3/$4';

//$route['api/(:any)/(:any)/(:any)/(:any)'] = 'api/$3/0/$2/$1/$4';
//$route['api_fr/(:any)/(:any)/(:any)/(:any)'] = 'api/$3/1/$2/$1/$4';
//$route['api_cn/(:any)/(:any)/(:any)/(:any)'] = 'api/$3/2/$2/$1/$4';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
