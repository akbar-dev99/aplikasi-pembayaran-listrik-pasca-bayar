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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller'] = 'welcome';

$route['pelanggan/logout'] = 'csmr/Login/logout';
$route['pelanggan'] = 'csmr/Dashboard/index';
$route['pelanggan/masuk'] = 'csmr/Login';
$route['pelanggan/post-masuk'] = 'csmr/Login/create';
$route['pelanggan/daftar'] = 'csmr/Register';
$route['pelanggan/post-daftar'] = 'csmr/Register/create';
$route['pelanggan/profile'] = 'csmr/Profile';
$route['pelanggan/profile/ubah-password'] = 'csmr/Profile/change_password';


$route['pelanggan/penggunaan'] = 'csmr/UsageCustomer';
$route['pelanggan/penggunaan/input'] = 'csmr/UsageCustomer/create';
$route['pelanggan/penggunaan/ubah/(:any)'] = 'csmr/UsageCustomer/update/$1';
$route['pelanggan/penggunaan/hapus/(:any)'] = 'csmr/UsageCustomer/delete/$1';

$route['pelanggan/tagihan'] = 'csmr/BillCustomer';
$route['pelanggan/tagihan/(:any)'] = 'csmr/BillCustomer/detail/$1';
$route['pelanggan/tagihan/(:any)/bayar'] = 'csmr/PaymentCustomer/create/$1';

$route['pelanggan/pembayaran'] = 'csmr/PaymentCustomer';


$route['administrator'] = 'admin/DashboardAdmin/index';
$route['administrator/logout'] = 'admin/Login/logout';
$route['administrator/masuk'] = 'admin/Login';
$route['administrator/profile'] = 'admin/ProfileAdmin';
$route['administrator/profile/update'] = 'admin/ProfileAdmin/update';
$route['administrator/post-masuk'] = 'admin/Login/create';


$route['administrator/petugas'] = 'admin/User';
$route['administrator/petugas/delete/(:any)'] = 'admin/User/delete/$1';
$route['administrator/petugas/ubah/(:any)'] = 'admin/User/update/$1';
$route['administrator/petugas/tambah'] = 'admin/User/create';

$route['administrator/pelanggan'] = 'admin/Customer';
$route['administrator/pelanggan/tambah'] = 'admin/Customer/create';
$route['administrator/pelanggan/ubah/(:any)'] = 'admin/Customer/update/$1';
$route['administrator/pelanggan/hapus/(:any)'] = 'admin/Customer/delete/$1';

$route['administrator/tarif'] = 'admin/Tariff/index';
$route['administrator/tarif/create'] = 'admin/Tariff/create';
$route['administrator/tarif/delete/(:any)'] = 'admin/Tariff/delete/$1';
$route['administrator/tarif/update/(:any)'] = 'admin/Tariff/getUpdate/$1';
$route['administrator/tarif/post-update/(:any)'] = 'admin/Tariff/update/$1';

$route['administrator/penggunaan'] = 'admin/Usage/index';
$route['administrator/penggunaan/hapus/(:any)'] = 'admin/Usage/delete/$1';

$route['administrator/tagihan'] = 'admin/Bill/index';
$route['administrator/tagihan/(:any)'] = 'admin/Bill/detail/$1';
$route['administrator/tagihan/(:any)/pembayaran'] = 'admin/Payment/create/$1';
$route['administrator/pembayaran/konfirmasi'] = 'admin/Payment/confirm';
$route['administrator/pembayaran/tolak'] = 'admin/Payment/reject';
$route['administrator/pembayaran'] = 'admin/Payment';

// $route['test/tariff'] = 'test/TariffTest/test_get_tarif';
// $route['test/pelanggan/tariff'] = 'test/CustomerTest/getCustomerTariff';
// $route['test/pelanggan'] = 'test/CustomerTest/test_get_customer';
// $route['test/pelanggan/nokwh'] = 'test/CustomerTest/test_customer_by_no_kwh';


$route['akses/block'] = 'Util/block';
$route['404_override'] = 'Custom404/index404';
$route['translate_uri_dashes'] = false;
