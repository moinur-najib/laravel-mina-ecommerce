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
Route::get('/products', 'Frontend\ProductController@index')->name('products');
Route::get('/product/{slug}', 'Frontend\ProductController@show')->name('products.show');
Route::get('/search', 'Frontend\PagesController@search')->name('search');

Route::group(['prefix' => 'products'], function(){
  
  Route::get('/', 'Frontend\ProductController@index')->name('products');
  Route::get('/{slug}', 'Frontend\ProductController@show')->name('products.show');
  Route::get('/search', 'Frontend\PagesController@search')->name('search');

  Route::get('/categories', 'Frontend\CategoriesController@index')->name('categories.index');
  Route::get('/category/{id}', 'Frontend\CategoriesController@show')->name('categories.show');
  
});

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

    Route::group(['prefix' => '/brands'], function(){

      Route::get('/', 'Backend\BrandsController@index')->name('admin.brands');
      Route::get('/create', 'Backend\BrandsController@create')->name('admin.brand.create');
      Route::get('/edit/{id}', 'Backend\BrandsController@edit')->name('admin.brand.edit');
    
      // Post Requests
      Route::post('/brand/store', 'Backend\BrandsController@store')->name('admin.brand.store');
      Route::post('/brand/edit/{id}', 'Backend\BrandsController@update')->name('admin.brand.update');
      Route::post('/brand/delete/{id}', 'Backend\BrandsController@delete')->name('admin.brand.delete');

    });


  
});
