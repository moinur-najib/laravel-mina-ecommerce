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

use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmail;


Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/contacts', 'Frontend\PagesController@contact')->name('contacts');
Route::get('/products', 'Frontend\ProductController@index')->name('products');
Route::get('/product/{slug}', 'Frontend\ProductController@show')->name('products.show');

Route::group(['prefix' => 'products'], function () {

  Route::get('/', 'Frontend\ProductController@index')->name('products');
  Route::get('/{slug}', 'Frontend\ProductController@show')->name('products.show');
  Route::get('/new/search', 'Frontend\PagesController@search')->name('search');

  Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');
  Route::get('/category/{id}', 'Frontend\CategoriesController@show')->name('categories.show');

});
// User Routes

Route::group(['prefix' => 'admin'], function () {
  Route::get('/', 'Backend\PagesController@index')->name('admin.index');
  Route::get('/login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login');
  Route::post('/login/submit', 'Auth\Admin\LoginController@login')->name('admin.login.submit');
  Route::post('/logout/submit', 'Auth\Admin\LoginController@logout')->name('admin.logout');

  // Password Email send
  Route::get('/password/reset', 'Auth\Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
  Route::post('/password/resetPost', 'Auth\Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

  // Password Reset
  Route::get('/password/reset/{token}', 'Auth\Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
  Route::post('/password/reset', 'Auth\Admin\ResetPasswordController@reset')->name('admin.password.reset.post');


  // Product
  Route::group(['prefix' => '/product'], function () {
    Route::get('/', 'Backend\ProductController@index')->name('admin.products');
    Route::get('/create', 'Backend\ProductController@create')->name('admin.product.create');
    Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('admin.products.edit');

    // Post Requests
    Route::post('/store', 'Backend\ProductController@store')->name('admin.product.store');
    Route::post('/delete/{id}', 'Backend\ProductController@delete')->name('admin.products.delete');
  });

  Route::group(['prefix' => '/orders'], function () {

    Route::get('/', 'Backend\OrdersController@index')->name('admin.orders');
    Route::get('/view/{id}', 'Backend\OrdersController@show')->name('admin.order.show');
    Route::post('/delete/{id}', 'Backend\OrdersController@delete')->name('admin.order.delete');
    Route::post('/completed/{id}', 'Backend\OrdersController@completed')->name('admin.order.completed');
    Route::post('/paid/{id}', 'Backend\OrdersController@paid')->name('admin.order.paid');
  });

  Route::group(['prefix' => '/categories'], function () {

    Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories');
    Route::get('/create', 'Backend\CategoriesController@create')->name('admin.category.create');
    Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('admin.category.edit');

    // Post Requests
    Route::post('/category/store', 'Backend\CategoriesController@store')->name('admin.category.store');
    Route::post('/category/edit/{id}', 'Backend\CategoriesController@update')->name('admin.category.update');
    Route::post('/category/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.category.delete');
  });


  Route::group(['prefix' => '/brands'], function () {

    Route::get('/', 'Backend\BrandsController@index')->name('admin.brands');
    Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');
    Route::get('/edit/{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');

    // Post Requests
    Route::post('/brand/store', 'Backend\BrandsController@store')->name('admin.brand.store');
    Route::post('/brand/edit/{id}', 'Backend\BrandsController@update')->name('admin.brand.update');
    Route::post('/brand/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');
  });

  Route::group(['prefix' => '/divisions'], function () {

    Route::get('/', 'Backend\DivisionsController@index')->name('admin.divisions');
    Route::get('/create', 'Backend\DivisionsController@create')->name('admin.division.create');
    Route::get('/edit/{id}', 'Backend\DivisionsController@edit')->name('admin.division.edit');

    // Post Requests
    Route::post('/division/store', 'Backend\DivisionsController@store')->name('admin.division.store');
    Route::post('/division/edit/{id}', 'Backend\DivisionsController@update')->name('admin.division.update');
    Route::post('/division/delete/{id}', 'Backend\DivisionsController@delete')->name('admin.division.delete');
  });

  Route::group(['prefix' => '/district'], function () {

    Route::get('/', 'Backend\DistrictsController@index')->name('admin.districts');
    Route::get('/create', 'Backend\DistrictsController@create')->name('admin.district.create');
    Route::get('/edit/{id}', 'Backend\DistrictsController@edit')->name('admin.district.edit');

    // Post Requests
    Route::post('/district/store', 'Backend\DistrictsController@store')->name('admin.district.store');
    Route::post('/district/edit/{id}', 'Backend\DistrictsController@update')->name('admin.district.update');
    Route::post('/district/delete/{id}', 'Backend\DistrictsController@delete')->name('admin.district.delete');
  });
});
Route::group(['prefix' => '/user'], function () {
  Route::get('/token/{token}', 'Frontend\VerificationController@verify')->name('user.verification');
  Route::get('/dashboard', 'Frontend\UsersController@dashboard')->name('user.dashboard');
  Route::get('/profile', 'Frontend\UsersController@profile')->name('user.profile');
  Route::post('/profile/update', 'Frontend\UsersController@profileUpdate')->name('user.profile.update');
});

Route::group(['prefix' => '/cart'], function () {
  Route::get('/', 'Frontend\CartsController@index')->name('carts');

  Route::post('/store', 'Frontend\CartsController@store')->name('carts.store');
  Route::post('/update/{id}', 'Frontend\CartsController@update')->name('carts.update');
  Route::post('/delete/{id}', 'Frontend\CartsController@destroy')->name('carts.delete');
});

Route::group(['prefix' => '/checkout'], function () {
  Route::get('/', 'Frontend\CheckoutsController@index')->name('checkouts');
  Route::post('/store', 'Frontend\CheckoutsController@store')->name('checkouts.store');
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
