<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');

//Item Categories
Route::resource('itemCategories', 'ItemCategoryController');
Route::post('/api/ItemCategory/categories', 'ItemCategoryController@ApiCategories');


//Item Brands
Route::get('/itembrand/{itemBrand}/edit', 'ItemBrandController@edit');
Route::post('/api/itembrand/brands', 'ItemBrandController@ApiBrands');
Route::get('/itembrand/index', 'ItemBrandController@index');
Route::get('/itembrand/create', 'ItemBrandController@create');
Route::post('/itembrand/store', 'ItemBrandController@store');
Route::put('/itembrand/{itemBrand}/update','ItemBrandController@update');
Route::delete('/itembrand/{itemBrand}/delete', 'ItemBrandController@destroy');

//Item Units
Route::get('/itemunit/index', 'ItemUnitController@index');
Route::post('/api/itemunit/units', 'ItemUnitController@ApiUnits');
Route::get('/itemunit/create', 'ItemUnitController@create');
Route::post('/itemunit/store', 'ItemUnitController@store');
Route::get('/itemunit/{itemUnit}/edit', 'ItemUnitController@edit');
Route::put('/itemunit/{itemUnit}/update', 'ItemUnitController@update');
Route::delete('/itemunit/{itemUnit}/delete', 'ItemUnitController@destroy');

//Items
Route::get('/item/index', 'ItemController@index');
Route::post('/api/item/items', 'ItemController@ApiItems');
Route::get('/item/create', 'ItemController@create');
Route::post('/item/store', 'ItemController@store');
Route::get('/item/{item}/edit', 'ItemController@edit');
Route::put('/item/{item}/update', 'ItemController@update');
Route::delete('/item/{item}/delete', 'ItemController@destroy');

//Suppliers
Route::get('/supplier/index', 'SupplierController@index');
Route::post('/api/supplier/suppliers', 'SupplierController@ApiSuppliers');
Route::get('/supplier/create', 'SupplierController@create');
Route::post('/supplier/store', 'SupplierController@store');
Route::get('/supplier/{supplier}/edit', 'SupplierController@edit');
Route::put('/supplier/{supplier}/update', 'SupplierController@update');
Route::delete('/supplier/{supplier}/delete', 'SupplierController@destroy');

//Customers
Route::get('/customer/index', 'CustomerController@index');
Route::post('/api/customer/customers', 'CustomerController@ApiCustomers');
Route::get('/customer/create', 'CustomerController@create');
Route::post('/customer/store', 'CustomerController@store');
Route::get('/customer/{customer}/edit', 'CustomerController@edit');
Route::put('/customer/{customer}/update', 'CustomerController@update');
Route::delete('/customer/{customer}/delete', 'CustomerController@destroy');
Route::get('/api/selection/customers', 'CustomerController@ApiCustomersSelection');

//Warehouses
Route::get('/warehouse/index', 'WarehouseController@index');
Route::post('/api/warehouse/warehouses', 'WarehouseController@ApiWarehouses');
Route::get('/warehouse/create', 'WarehouseController@create');
Route::post('warehouse/store', 'WarehouseController@store');
Route::get('/warehouse/{warehouse}/edit', 'WarehouseController@edit');
Route::put('/warehouse/{warehouse}/update', 'WarehouseController@update');
Route::delete('/warehouse/{warehouse}/delete', 'WarehouseController@destroy');

//Stocks
Route::resource('stockHeaders', 'StockHeaderController');
Route::post('/api/stockheader/stockheaders', 'StockHeaderController@ApiStockHeaders');

//Stock Items
Route::resource('stockItems', 'StockItemController');
Route::get('stockItems/{stockHeaderid}/create', 'StockItemController@create');

//Sales
Route::resource('sales', 'SaleController');
Route::post('/api/sales/sales', 'SaleController@ApiSales');

// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
