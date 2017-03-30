<?php defined ('BASEPATH') OR exit ('No direct script access allowed');

Route::root ('main');

// $route['admin'] = "admin/main";

Route::get ('/login', 'platform@login');
Route::get ('/logout', 'platform@logout');
Route::get ('/platform/index', 'platform@login');
Route::get ('/platform', 'platform@login');












Route::get ('admin', 'admin/main@index');
Route::group ('admin', function () {
  Route::resourcePagination (array ('deploys'), 'deploys');
  Route::resourcePagination (array ('articles'), 'articles');
  Route::resourcePagination (array ('youtubes'), 'youtubes');
  Route::resourcePagination (array ('albums'), 'albums');
  Route::resourcePagination (array ('path_infos'), 'path_infos');
  Route::resourcePagination (array ('homes'), 'homes');
  Route::resourcePagination (array ('authors'), 'authors');
  Route::resourcePagination (array ('licenses'), 'licenses');
  Route::resourcePagination (array ('album', 'images'), 'album_images');
  Route::resourcePagination (array ('users'), 'users');
});

Route::group ('api', function () {
});
// echo '<meta http-equiv="Content-type" content="text/html; charset=utf-8" /><pre>';
// print_r (Route::getRoute ());
// exit ();

// $route['main/index/(:num)/(:num)'] = "main/aaa/$1/$2";
// Route::get ('main/index/(:num)/(:num)', 'main@aaa($1, $2)');
// Route::post ('main/index/(:num)/(:num)', 'main@aaa($1, $2)');
// Route::put ('main/index/(:num)/(:num)', 'main@aaa($1, $2)');
// Route::delete ('main/index/(:num)/(:num)', 'main@aaa($1, $2)');
// Route::controller ('main', 'main');
  // whit get、post、put、delete prefix

/* End of file routes.php */
/* Location: ./application/config/routes.php */