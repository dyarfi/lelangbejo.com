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

$route['default_controller'] = "home";
$route['404_override'] = '';

/*
 * PAGE ACCOUNT CUSTOM
 */
$route['logout'] = "account/logout";
$route['profile'] = "account/profile";
$route['catatan-belanja'] = "account/bidding";
$route['kotak-surat'] = "account/inbox";

/*
 * PAGE HOME CUSTOM
 */
$route['blocked'] = "home/blocked";
$route['notfound'] = "home/notfound";
$route['step1'] = "home/step1";
$route['step2'] = "home/step2";
$route['step3'] = "home/step3";
$route['step4'] = "home/step4";
$route['dompet'] = "home/dompet";

$route['gagal'] = "home/gagal";
$route['berhasil'] = "home/berhasil";

$route['dagangan-laku'] = "home/items";
$route['detail-dagangan-laku/(:num)/(:any)'] = "home/detail_item/$1/$2";
$route['detail-dagangan-laku/(:num)'] = "home/detail_item/$1";
$route['detail-dagangan-laku'] = "home/detail_item/0";

/*
 * PAGE STATIC CUSTOM
 */
$route['mekanisme-lelang'] = "page/lelang";
$route['mekanisme-koin'] = "page/koin";
$route['syarat-ketentuan'] = "page/syarat";
$route['kebijakan-privasi'] = "page/kebijakan";
$route['lokasi-penjualan'] = "page/lokasi_penjualan";
$route['cara-lelang'] = "page/cara_lelang";


/* End of file routes.php */
/* Location: ./application/config/routes.php */