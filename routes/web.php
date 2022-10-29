<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

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

Route::group(['middleware' => ['role:Employee,Administrator']],function () {

Route::resource('customer','App\Http\Controllers\CustomerController');
Route::get('/customers', [
      'uses' => 'CustomerController@getCustomers',
       'as' => 'getCustomers'
]);
Route::get('/customer/restore/{id}','CustomerController@restore')->name('customer.restore');

Route::resource('employee','App\Http\Controllers\EmployeeController');
Route::get('/employees', [
      'uses' => 'EmployeeController@getEmployees',
       'as' => 'getEmployees'
]);

Route::resource('pets','App\Http\Controllers\PetsController');
Route::get('/pets', [
      'uses' => 'PetsController@getPets',
       'as' => 'getPets'
]);

Route::resource('services','App\Http\Controllers\ServicesController');
Route::get('/services', [
      'uses' => 'ServicesController@getServices',
       'as' => 'getServices'
]);

Route::resource('consultation','App\Http\Controllers\ConsultationController');
Route::get('/consultations', [
      'uses' => 'ConsultationController@getConsultations',
       'as' => 'getConsultations'
]);

});

Route::post('/customer/import', 'CustomerController@import')->name('customerImport');
Route::post('/pet/import', 'PetsController@import')->name('petImport');
Route::post('/employee/import', 'EmployeeController@import')->name('employeeImport');
Route::post('/service/import', 'ServicesController@import')->name('serviceImport');


Route::group(['middleware' => ['role:Customer,Employee,Administrator']],function () {

Route::resource('customer','App\Http\Controllers\CustomerController')->only(['edit','update']);
Route::resource('pets','App\Http\Controllers\PetsController')->only(['create','store']);


Route::get('/shop', [
    'uses' => 'ServicesController@index',
    'as' => 'shop.index'
    ]);

Route::get('add-to-cart/{id}',[
  'uses' => 'ServicesController@getAddToCart',
  'as' => 'service.addToCart'
]);

Route::get('shopping-cart', [
  'uses' => 'ServicesController@getCart',
  'as' => 'service.shoppingCart'
    // 'middleware' =>'role:customer'
]);

Route::get('checkout',[
  'uses' => 'ServicesController@postCheckout',
  'as' => 'checkout',
  // 'middleware' =>'role:customer'
]);

Route::get('reduce/{id}',[
  'uses' => 'ServicesController@getReduceByOne',
  'as' => 'service.reduceByOne'
]);

Route::get('remove/{id}',[
  'uses'=>'ServicesController@getRemoveItem',
  'as' => 'service.remove'
]);

});

Route::resource('comment','CommentController');
// Route::get('/comment/edit/{id}','CommentController@edit')->name('comment.edit');
Route::post('/comment/storeComment/{id}','CommentController@storeComment')->name('comment.storeComment');

Route::get('/search/{search?}', [SearchController::class, 'search'])->name('search');
Route::get('/show-pet/{id}',[
        'uses' => 'PetsController@show',
        'as' => 'pets.shows'
]);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/Chart/groom','GroomedchartController@index')->name('chart.groomed');
Route::get('/Chart/date','GroomedchartController@date')->name('chart.date');
Route::get('/Chart/show','GroomedchartController@showdate')->name('chart.show');
Route::get('/Chart/pett','DiseaseschartController@index')->name('chart.pett');



