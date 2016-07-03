<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'spartan';
$route['404_override'] = 'my404';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'auth/login/index';
$route['registry'] = 'auth/registry/index';
$route['logout'] = 'auth/login/logout';
$route['forget'] = 'auth/login/forget';
$route['validate'] = 'auth/registry/validate';
$route['sendmail'] = 'auth/registry/sendmail';
$route['validateAccount/(:any)'] = 'auth/login/validateAccount/$1';

//User
$route['spartan'] = 'spartan';
$route['userajax'] = 'admin/UserAjax/index';
$route['hosting'] = 'admin/hosting/index';
$route['user'] = 'admin/User/index';
$route['profile/(:any)'] = 'admin/User/profile/$1';
$route['ip_address'] = 'admin/User/ip_address';
$route['privilage-ajax'] = 'admin/PrivilageAjax/index';

//shopping
$route['shopping/products/(:any)'] = 'shopping/index/products/$1';
$route['shopping/products/(:any)/(:any)'] = 'shopping/index/classProduct/$1/$2';
$route['shopping/viewmore'] = 'shopping/index/viewmore';
$route['shopping/infoOrder'] = 'shopping/index/infoOrder';
$route['shopping'] = 'shopping/index';

$route['shopping/giohang'] = 'shopping/index/giohang';
$route['shopping/buy/(:any)'] = 'shopping/index/buy/$1';


$route['CategoryProduct'] = 'admin/shopping/CategoryProduct';
$route['ClassProduct'] = 'admin/shopping/ClassProduct';
$route['Products'] = 'admin/shopping/Products';

$route['search'] = 'spartan/search';
$route['search/keyword/(:any)/page/(:num)'] = 'spartan/search/keyword/$2/page/$1';

// Admin 
$route['cungtot-article'] = 'admin/cungtot/index';
$route['cungtot-article-add'] = 'admin/cungtot/add';
$route['cungtot-article-frame'] = 'admin/cungtot/youtube';
$route['cungtot-article-all'] = 'admin/cungtot/allArticle';
$route['recycle'] = 'admin/cungtot/recycle';

$route['cungtot-catagory'] = 'admin/Cungtot_catagory/index';
$route['cungtot-catagory-add'] = 'admin/Cungtot_catagory/add';

$route['(:any)'] = 'spartan/detail/$1';
$route['(preview/(:any))'] = 'spartan/preview/$2/$1';
$route['(author/(:any))'] = 'spartan/authorarticle/$1';
$route['(author/(:any)/page/(:num))'] = 'spartan/authorarticle/$1/pages/$2';


