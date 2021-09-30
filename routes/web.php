<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::get('profile/password', ['as' => 'profile.edit-password', 'uses' => 'App\Http\Controllers\ProfileController@editPassword']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	//quotation
	Route::get('create', 'App\Http\Controllers\CreateQuotationController@index')->name('create');
	Route::post('/quotation/store', 'App\Http\Controllers\CreateQuotationController@store');

	Route::get('quotation', 'App\Http\Controllers\QuotationController@index')->name('quotation');

	Route::patch('/update/quotation/{quotation_id}', 'App\Http\Controllers\EditQuotationController@update');
	Route::get('/editquotation/{id}', 'App\Http\Controllers\EditQuotationController@editpage')->name('edit-controller');
	Route::delete('/delete/quotation/{quotation_id}', 'App\Http\Controllers\EditQuotationController@delete');

	//invoice
	Route::get('create-invoice', 'App\Http\Controllers\CreateInvoiceController@index')->name('create-invoice');
	Route::post('/invoice/store', 'App\Http\Controllers\CreateInvoiceController@store');

	Route::get('invoice', 'App\Http\Controllers\InvoiceController@index')->name('invoice');

	Route::patch('/update/invoice/{invoice_id}', 'App\Http\Controllers\EditInvoiceController@update');
	Route::get('/editinvoice/{id}', 'App\Http\Controllers\EditInvoiceController@editpage')->name('edit-invoice-controller');
	Route::delete('/delete/invoice/{invoice_id}', 'App\Http\Controllers\EditInvoiceController@delete');

	//item
	Route::get('/create/items/{id}', 'App\Http\Controllers\ItemController@index')->name('create-items');
	Route::get('/edit-items/{quotation_id}/{id}', 'App\Http\Controllers\ItemController@edit_item')->name('edit-item');
	Route::post('/item/store/{id}', 'App\Http\Controllers\ItemController@create');
	Route::delete('/delete/item/{id}', 'App\Http\Controllers\ItemController@delete');
	Route::patch('/update/item/{quotation_id}/{id}', 'App\Http\Controllers\ItemController@update');
	

});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');





