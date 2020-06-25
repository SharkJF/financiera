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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clientes', 'ClienteControlador@index')
    ->name('clientes.index');
Route::get('/clientes/new', 'ClienteControlador@create')
    ->name('clientes.create');
Route::post('/clientes', 'ClienteControlador@store')
    ->name('clientes.store');
Route::delete('/clientes/{id}', 'ClienteControlador@destroy')
    ->name('clientes.destroy');
Route::get('/clientes/import', 'ClienteControlador@import')
    ->name('clientes.import');    
Route::post('/clientes/import/importado', 'ClienteControlador@ImportExcel')
    ->name('clientes.importExcel');
Route::any('/clientes/edit/{id}', 'ClienteControlador@edit')
    ->name('clientes.edit');
Route::any('/clientes/update/{id}', 'ClienteControlador@update')
    ->name('clientes.update');


Route::get('/prestamos', 'PrestamoControlador@index')
->name('prestamos.index');
Route::get('/prestamos/new', 'PrestamoControlador@create')
->name('prestamos.create');
Route::post('/prestamos', 'PrestamoControlador@store')
->name('prestamos.store');
Route::delete('/prestamos/{id}', 'PrestamoControlador@destroy')
->name('prestamos.destroy');


Route::get('/pagos','PagoControlador@index')
->name('pagos.index');
Route::get('/pagos/{id}', 'PagoControlador@show')
->name('pagos.show');
Route::get('/pagos/action/{id}', 'PagoControlador@action')
->name('pagos.action');
Route::post('/pagos/store/{id}', 'PagoControlador@store')
->name('pagos.store'); 
Route::get('/export-loans-excel', 'PagoControlador@ExportExcel')
->name('pagos.exportExcel');

Route::get('/usuarios/edit', 'UsuarioControlador@edit')
->name('usuarios.edit');
Route::post('/usuarios/editUser', 'UsuarioControlador@updateUser')
->name('usuarios.updateUser');
Route::post('/usuarios/editPass', 'UsuarioControlador@updatePassword')
->name('usuarios.updatePass');