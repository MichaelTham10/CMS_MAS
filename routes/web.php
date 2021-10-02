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

	Route::get('profile/password', ['as' => 'profile.edit-password', 'uses' => 'App\Http\Controllers\ProfileController@editPassword']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	//quotation

	Route::get('quotation/test', 'App\Http\Controllers\Quotation\QuotationController@index')->name('quotation');

	Route::get('quotation/list', 'App\Http\Controllers\Quotation\QuotationController@list')->name('test');

	Route::get('create', 'App\Http\Controllers\Quotation\QuotationController@create')->name('create');
	Route::post('/quotation/store', 'App\Http\Controllers\Quotation\QuotationController@store');

	Route::patch('/update/quotation/{quotation_id}', 'App\Http\Controllers\Quotation\QuotationController@update');
	Route::get('/editquotation/{id}', 'App\Http\Controllers\Quotation\QuotationController@editpage')->name('edit-controller');
	Route::delete('/delete/quotation/{quotation_id}', 'App\Http\Controllers\Quotation\QuotationController@delete');

	//invoice
	Route::get('create-invoice', 'App\Http\Controllers\Invoice\InvoiceController@create')->name('create-invoice');
	Route::post('/invoice/store', 'App\Http\Controllers\Invoice\InvoiceController@store');

	Route::get('invoice', 'App\Http\Controllers\Invoice\InvoiceController@index')->name('invoice');

	Route::patch('/update/invoice/{invoice_id}', 'App\Http\Controllers\Invoice\InvoiceController@update');
	Route::get('/editinvoice/{id}', 'App\Http\Controllers\Invoice\InvoiceController@editpage')->name('edit-invoice-controller');
	Route::delete('/delete/invoice/{invoice_id}', 'App\Http\Controllers\Invoice\InvoiceController@delete');

	//item
	Route::get('/create/items/{id}', 'App\Http\Controllers\ItemController@index')->name('create-items');
	Route::get('/edit-items/{quotation_id}/{id}', 'App\Http\Controllers\ItemController@edit_item')->name('edit-item');
	Route::post('/item/store/{id}', 'App\Http\Controllers\ItemController@create');
	Route::delete('/delete/item/{id}', 'App\Http\Controllers\ItemController@delete');
	Route::patch('/update/item/{quotation_id}/{id}', 'App\Http\Controllers\ItemController@update');
	
	//pdf
	Route::get('/quotation/item/export-pdf/{id}', 'App\Http\Controllers\ExportPDFController@pdf');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');





