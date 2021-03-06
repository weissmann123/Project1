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

// Route::get('/', function () {
//     return view('layout');
// });

Auth::routes();
//Employee
Route::get('/','EmployeesController@index');
Route::get('/employees','EmployeesController@create')->name('employee.create');
Route::post('/employees','EmployeesController@store')->name('employee.store');
Route::post('/', 'EmployeesController@index')->name('employee.index');

Route::get('/employees/edit/{employee}','EmployeesController@edit')->name('employee.edit');
Route::post('/employees/update/{employee}','EmployeesController@update')->name('employee.update');
Route::get('/employees/delete/{employee}','EmployeesController@destroy')->name('employee.destroy');

Route::post('UserDataTable','EmployeesController@UserDataTable')->name('UserDataTable');

//Role
Route::get('/roles','RolesController@create')->name('role.create');
Route::post('/roles','RolesController@store')->name('role.store');
Route::get('/rlindex', 'RolesController@index')->name('role.index');

Route::get('/roles/edit/{role}','RolesController@edit')->name('role.edit');
Route::post('/roles/update/{role}','RolesController@update')->name('role.update');
Route::get('/roles/delete/{role}','RolesController@destroy')->name('role.destroy');

Route::post('RoleDataTable','RolesController@RoleDataTable')->name('RoleDataTable');


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index')->name('home1');

//Species
// Route::get('/SpeciesIndex', 'SpeciesController@index');
Route::get('/spcindex', 'SpeciesController@index')->name('species.index');

Route::get('/Species', 'SpeciesController@create')->name('species.create');
Route::post('/Species', 'SpeciesController@store')->name('species.store');
Route::get('/Species/edit/{species}', 'SpeciesController@edit')->name('species.edit');
Route::post('/Species/edit/{species}', 'SpeciesController@update')->name('species.update');
Route::get('/Species/delete/{species}', 'SpeciesController@destroy')->name('species.destroy');

Route::post('SpeciesDataTable','SpeciesController@SpeciesDataTable')->name('SpeciesDataTable');

//Pets
Route::get('/ptindex', 'PetsController@index')->name('pet.index');

Route::get('/Pets', 'PetsController@create')->name('pet.create');
Route::post('/Pets', 'PetsController@store')->name('pet.store');

Route::post('PetDataTable','PetsController@PetDataTable')->name('PetDataTable');
// Route::get('/Pets/edit/{pet}', 'PetsController@edit')->name('pet.edit');
// Route::post('/Pets/edit/{pet}', 'PetsController@update')->name('pet.update');
// Route::get('/Pets/delete/{pet}', 'PetsController@destroy')->name('pet.destroy');

//PetNames
Route::get('/pnindex', 'PetNamesController@index')->name('petname.index');

Route::get('/PNames', 'PetNamesController@create')->name('petname.create');
Route::post('/PNames', 'PetNamesController@store')->name('petname.store');
Route::get('/PetName/edit/{petName}', 'PetNamesController@edit')->name('petname.edit');
Route::post('/PetName/update/{petName}', 'PetNamesController@update')->name('petname.update');
Route::get('/PetName/delete/{petName}', 'PetNamesController@destroy')->name('petname.destroy');

Route::post('PetNameDataTable','PetNamesController@PetNameDataTable')->name('PetNameDataTable');