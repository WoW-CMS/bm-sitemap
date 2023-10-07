<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['sitemap/admin']['get'] = 'sitemap';
$route['sitemap/admin/manage']['get'] = 'sitemap/manage';
$route['sitemap/admin/add'] = 'sitemap/add';
$route['sitemap/admin/edit/(:num)'] = 'sitemap/edit/$1';
$route['sitemap/admin/delete/(:num)'] = 'sitemap/delete/$1';
$route['sitemap/admin/generate']['get'] = 'sitemap/generate';