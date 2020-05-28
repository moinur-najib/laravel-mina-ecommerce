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

Route::get('/', 'Frontend\PagesController@index')->name('index');
Route::get('/contact', 'Frontend\PagesController@contact')->name('contact');
Route::get('/products', 'Frontend\PagesController@products')->name('products');
Route::get('/product/{$slug}', 'Frontend\PagesController@show')->name('products.show');

Route::group(['prefix' => 'admin'], function(){
  Route::get('/', 'Backend\PagesController@index')->name('admin.index');

  // Product
    Route::group(['prefix' => '/product'], function(){
      Route::get('/', 'Backend\ProductController@index')->name('admin.products');
      Route::get('/create', 'Backend\ProductController@create')->name('admin.product.create');
      Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('admin.products.edit');
    
      // Post Requests
      Route::post('/store', 'Backend\ProductController@store')->name('admin.product.store');
      Route::post('/delete/{id}', 'Backend\ProductController@delete')->name('admin.products.delete');

    });

    Route::group(['prefix' => '/categories'], function(){

      Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories');
      Route::get('/create', 'Backend\CategoriesController@create')->name('admin.category.create');
      Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('admin.category.edit');
    
      // Post Requests
      Route::post('/category/store', 'Backend\CategoriesController@store')->name('admin.category.store');
      Route::post('/category/edit/{id}', 'Backend\CategoriesController@update')->name('admin.category.update');
      Route::post('/category/delete/{id}', 'Backend\CategoriesController@delete')->name('admin.category.delete');

    });


  
});
