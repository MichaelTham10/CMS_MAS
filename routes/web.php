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
    return view('auth.login');
})->middleware('guest');

Route::get('/unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorized'])->name('unauthorized');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	// Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

	// Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	// Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);

	// Route::get('profile/password', ['as' => 'profile.edit-password', 'uses' => 'App\Http\Controllers\ProfileController@editPassword']);
	// Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	//quotation
	Route::get('quotation', 'App\Http\Controllers\Quotation\QuotationController@index')->name('quotation')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('quotation/list', 'App\Http\Controllers\Quotation\QuotationController@list')->name('test')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('create', 'App\Http\Controllers\Quotation\QuotationController@create')->name('create')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::post('/quotation/store', 'App\Http\Controllers\Quotation\QuotationController@store')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::patch('/update/quotation/{quotation_id}', 'App\Http\Controllers\Quotation\QuotationController@update')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('/editquotation/{id}', 'App\Http\Controllers\Quotation\QuotationController@editpage')->name('edit-controller')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::delete('/delete/quotation/{quotation_id}', 'App\Http\Controllers\Quotation\QuotationController@delete')->middleware('role:Superadmin,Admin,Sales,Finance');
	
	//old quotation
	Route::get('/old/quotation', 'App\Http\Controllers\Quotation\OldQuotationController@index')->name('old-quotation')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('/old/quotation/list', 'App\Http\Controllers\Quotation\OldQuotationController@list')->name('old-quotation-data')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('/create/old/quotation', 'App\Http\Controllers\Quotation\OldQuotationController@create')->name('create-old-quotation')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::post('/old/quotation/store', 'App\Http\Controllers\Quotation\OldQuotationController@store')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('/edit/old/quotation/{id}', 'App\Http\Controllers\Quotation\OldQuotationController@edit')->name('edit-old-quotation')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::delete('/delete/old/quotation/{id}', 'App\Http\Controllers\Quotation\OldQuotationController@delete')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::patch('/update/old/quotation/{id}', 'App\Http\Controllers\Quotation\OldQuotationController@update')->middleware('role:Superadmin,Admin,Sales,Finance');

	//invoice
	Route::get('create-invoice', 'App\Http\Controllers\Invoice\InvoiceController@create')->name('create-invoice')->middleware('role:Superadmin,Admin,Finance');
	Route::post('/invoice/store', 'App\Http\Controllers\Invoice\InvoiceController@store')->middleware('role:Superadmin,Admin,Finance');
	Route::get('invoice', 'App\Http\Controllers\Invoice\InvoiceController@index')->name('invoice')->middleware('role:Superadmin,Admin,Finance');
	Route::get('invoice/list', 'App\Http\Controllers\Invoice\InvoiceController@list')->name('invoiceData')->middleware('role:Superadmin,Admin,Finance');
	Route::patch('/update/invoice/{invoice_id}', 'App\Http\Controllers\Invoice\InvoiceController@update')->middleware('role:Superadmin,Admin,Finance');
	Route::get('/editinvoice/{id}', 'App\Http\Controllers\Invoice\InvoiceController@editpage')->name('edit-invoice-controller')->middleware('role:Superadmin,Admin,Finance');
	Route::delete('/delete/invoice/{invoice_id}', 'App\Http\Controllers\Invoice\InvoiceController@delete')->middleware('role:Superadmin,Admin,Finance');

	Route::get('invoice/po', 'App\Http\Controllers\Invoice\InvoicePOController@index')->name('invoice-po');
	Route::get('invoice/po/list', 'App\Http\Controllers\Invoice\InvoicePOController@list')->name('invoicePOData');
	Route::get('create-invoice-po', 'App\Http\Controllers\Invoice\InvoicePOController@create')->name('create-invoice-po');
	Route::post('/invoice-po/store', 'App\Http\Controllers\Invoice\InvoicePOController@store');
	Route::get('/editinvoice-po/{id}', 'App\Http\Controllers\Invoice\InvoicePOController@editpage')->name('edit-invoice-controller-po');
	Route::patch('/update/invoice-po/{invoice_id}', 'App\Http\Controllers\Invoice\InvoicePOController@update');
	Route::delete('/delete/invoice-po/{invoice_id}', 'App\Http\Controllers\Invoice\InvoicePOController@delete');

	//item
	Route::get('/create/items/{id}', 'App\Http\Controllers\ItemController@index')->name('create-items')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('/edit-items/{quotation_id}/{id}', 'App\Http\Controllers\ItemController@edit_item')->name('edit-item')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::post('/item/store/{id}', 'App\Http\Controllers\ItemController@create')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::delete('/delete/item/{id}', 'App\Http\Controllers\ItemController@delete')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::patch('/update/item/{quotation_id}/{id}', 'App\Http\Controllers\ItemController@update')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('item/list/{quotation_id}', 'App\Http\Controllers\ItemController@list')->name('item-list')->middleware('role:Superadmin,Admin,Sales,Finance');
	
	//pdf
	Route::get('/quotation/item/export-pdf/{id}', 'App\Http\Controllers\ExportPDFController@pdf')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::get('/invoice/item/export-pdf/{id}', 'App\Http\Controllers\ExportPDFController@pdf_invoice')->middleware('role:Superadmin,Admin,Finance');

	//purchase in
	Route::get('/edit_po_in/{id}', 'App\Http\Controllers\PurchaseInController@edit')->name('edit_po_in')->middleware('role:Superadmin,Admin');
	Route::patch('/edit_po_in/update/{id}', 'App\Http\Controllers\PurchaseInController@update')->middleware('role:Superadmin,Admin');
	Route::get('/po_in', 'App\Http\Controllers\PurchaseInController@show')->name('po_in')->middleware('role:Superadmin,Admin');
	Route::get('/po_in/list', 'App\Http\Controllers\PurchaseInController@list')->name('po_in_data')->middleware('role:Superadmin,Admin');
	Route::delete('/delete/po_in/{id}', 'App\Http\Controllers\PurchaseInController@delete')->middleware('role:Superadmin,Admin');
	Route::get('/po_in/create/form','App\Http\Controllers\PurchaseInController@index_create')->middleware('role:Superadmin,Admin');
	Route::post('/po_in/create', 'App\Http\Controllers\PurchaseInController@create')->middleware('role:Superadmin,Admin');
	//po_in Item
	Route::get('/po_in/item/list/{id}', 'App\Http\Controllers\PurchaseInController@item_list')->middleware('role:Superadmin,Admin');
	Route::get('/po_in/create/item/{id}', 'App\Http\Controllers\PurchaseInController@create_item')->middleware('role:Superadmin,Admin');
	Route::post('/po_in/store_item/{id}', 'App\Http\Controllers\PurchaseInController@store_item')->middleware('role:Superadmin,Admin');
	Route::get('/po_in/edit/item/{po_in_id}/{id}', 'App\Http\Controllers\PurchaseInController@edit_item_page')->middleware('role:Superadmin,Admin');
	Route::patch('/po_in/update/item/{po_in_id}/{id}','App\Http\Controllers\PurchaseInController@update_item_po_in')->middleware('role:Superadmin,Admin');
	Route::delete('/po_in/delete/{id}', 'App\Http\Controllers\PurchaseInController@delete_item_po_in')->middleware('role:Superadmin,Admin');
	//po_out
	Route::get('/po-out', 'App\Http\Controllers\PO_Out\PurchaseOutController@index')->name('po-out')->middleware('role:Superadmin,Admin');
	Route::get('/po-out/list', 'App\Http\Controllers\PO_Out\PurchaseOutController@list')->name('po-outData')->middleware('role:Superadmin,Admin');
	Route::get('/create-po-out', 'App\Http\Controllers\PO_Out\PurchaseOutController@create')->name('create-po-out')->middleware('role:Superadmin,Admin');
	Route::post('/po-out/store', 'App\Http\Controllers\PO_Out\PurchaseOutController@store')->middleware('role:Superadmin,Admin');
	Route::patch('/update/po-out/{po_id}', 'App\Http\Controllers\PO_Out\PurchaseOutController@update')->middleware('role:Superadmin,Admin');
	Route::get('/edit-po-out/{id}', 'App\Http\Controllers\PO_Out\PurchaseOutController@editpage')->name('edit-po-out-controller')->middleware('role:Superadmin,Admin');
	Route::delete('/delete/po-out/{po_id}', 'App\Http\Controllers\PO_Out\PurchaseOutController@delete')->middleware('role:Superadmin,Admin');

	//old po_out
	Route::get('/old/po-out', 'App\Http\Controllers\OldPurchaseOutController@index')->name('old-po-out')->middleware('role:Superadmin,Admin');
	Route::get('/old/po-out/list', 'App\Http\Controllers\OldPurchaseOutController@list')->name('old-po-out-data')->middleware('role:Superadmin,Admin');
	Route::get('/create/old/po-out', 'App\Http\Controllers\OldPurchaseOutController@create')->name('create-old-po-out')->middleware('role:Superadmin,Admin');
	Route::post('/old/po-out/store', 'App\Http\Controllers\OldPurchaseOutController@store')->middleware('role:Superadmin,Admin');
	Route::get('/edit/old/po-out/{id}', 'App\Http\Controllers\OldPurchaseOutController@edit')->name('edit-old-po-out')->middleware('role:Superadmin,Admin');
	Route::delete('/delete/old/po-out/{id}', 'App\Http\Controllers\OldPurchaseOutController@delete')->middleware('role:Superadmin,Admin');
	Route::patch('/update/old/po-out/{id}', 'App\Http\Controllers\OldPurchaseOutController@update')->middleware('role:Superadmin,Admin');

	//po_out item
	Route::get('/po-out-item/list/{po_out_id}', 'App\Http\Controllers\PO_Out_Item\PurchaseOutItemController@list')->name('po-out-item-data')->middleware('role:Superadmin,Admin');
	Route::get('/create/po_out_item/{id}', 'App\Http\Controllers\PO_Out_Item\PurchaseOutItemController@index')->name('create-po-out-item')->middleware('role:Superadmin,Admin');
	Route::post('/po_out_item/store/{po_out_id}', 'App\Http\Controllers\PO_Out_Item\PurchaseOutItemController@create')->name('store-po-out-item')->middleware('role:Superadmin,Admin');
	Route::get('/edit/po_out_item/{po_out_id}/{id}', 'App\Http\Controllers\PO_Out_Item\PurchaseOutItemController@edit_item')->name('edit-po-out-item')->middleware('role:Superadmin,Admin');
	Route::patch('/update/po_out_item/{po_out_id}/{id}', 'App\Http\Controllers\PO_Out_Item\PurchaseOutItemController@update')->middleware('role:Superadmin,Admin');
	Route::delete('/delete/po_out_item/{id}', 'App\Http\Controllers\PO_Out_Item\PurchaseOutItemController@delete')->middleware('role:Superadmin,Admin');

	//roles buat kebutuhan nanti
	// Route::get('/roles/index', 'App\Http\Controllers\RolesController@index');
	// Route::get('/roles/list', 'App\Http\Controllers\RolesController@list')->name('roles_data');
	// Route::patch('/update/role/{id}', 'App\Http\Controllers\RolesController@update');

	//user
	Route::get('/user', 'App\Http\Controllers\UserController@index')->middleware('role:Superadmin');
	Route::get('/user/list', 'App\Http\Controllers\UserController@list')->name('user_data')->middleware('role:Superadmin');
	Route::get('/create/user', 'App\Http\Controllers\UserController@create')->name('create-user')->middleware('role:Superadmin');
	Route::post('/store/user', 'App\Http\Controllers\UserController@store')->name('store-user')->middleware('role:Superadmin');
	Route::get('/edit-user/{id}', 'App\Http\Controllers\UserController@edit')->name('edit-user')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::patch('/update-user/{id}', 'App\Http\Controllers\UserController@update')->middleware('role:Superadmin,Admin,Sales,Finance');
	Route::delete('/delete-user/{id}', 'App\Http\Controllers\UserController@delete')->middleware('role:Superadmin');
	
});


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');





