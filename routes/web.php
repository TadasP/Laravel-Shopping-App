<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/roles/asign-permissions', 'Back\RoleController@asignPermission')->name('roles.asign-permission');
Route::post('admin/roles/store-permissions', 'Back\RoleController@storePermission')->name('roles.store-permission');
Route::get('admin/roles/asign-roles', 'Back\RoleController@asignRole')->name('roles.asign-role');
Route::post('admin/roles/store-roles', 'Back\RoleController@storeRole')->name('roles.store-role');
Route::get('admin/categories/post-categories', 'Back\CategoryController@postCategories')->name('categories.post-categories');
Route::get('admin/roles/product-categories', 'Back\CategoryController@productCategories')->name('categories.product-categories');
Route::get('frontproducts/own-products', 'Front\FrontProductController@ownProducts')->name('frontproducts.own-products');
Route::get('frontposts/own-posts', 'Front\FrontPostController@ownPosts')->name('frontposts.own-posts');
Route::get('front/products/{id}', 'Back\CategoryController@showFrontProducts')->name('home.products'); 
Route::get('frontposts/list/{id}', 'Back\CategoryController@showPosts')->name('frontposts.post-list');
Route::get('shopping/own-shops', 'Front\FrontShopController@ownShops')->name('shopping.own-shops');
Route::get('search-result', 'SearchController@frontResults')->name('search.result');
Route::post('search', 'SearchController@ajaxSearch')->name('ajax.search');
Route::post('comment-form', 'CommentsController@editForm')->name('edit.form');
Route::post('update-review', 'CommentsController@updateReview')->name('update.review');
Route::post('forum-comment-form', 'CommentsController@forumEditForm')->name('forum.edit.form');
Route::post('update-comment', 'CommentsController@updateComment')->name('update.comment');



Route::resources([
	'admin/products' => 'Back\ProductController',
	'frontproducts' => 'Front\FrontProductController',
	'admin/categories' => 'Back\CategoryController',
	'admin/roles' => 'Back\RoleController',
	'admin/permissions' => 'Back\PermissionController',
	'admin/shops' => 'Back\ShopController',
	'shopping' => 'Front\FrontShopController',
	'admin/posts' => 'Back\PostController',
	'frontposts' => 'Front\FrontPostController',
	'admin/users' => 'Back\UserController',
	'frontusers' => 'Front\FrontUserController',
	'comments' => 'CommentsController'
]);

