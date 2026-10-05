<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function() {
Route::controller(AdminController::class)->group(function(){
    Route::get('/overview','renderOverview')->name('overview');
   
    Route::get('/modules','renderModules')->name('modules.index');
    Route::post('/modules/store','storeModule')->name('modules.store');
    
    Route::get('/inscriptions','renderInscriptions')->name('inscriptions.index');
    Route::get('/settings','renderSettings')->name('settings');
    Route::get('/annonces','renderAnnonces')->name('annonces.index');

    Route::get('/formations','renderFormations')->name('formations.index');
    Route::post('/formations/store','storeFormation')->name('formations.store');
    Route::get('/formations/create','createFormation')->name('formations.create');
    Route::get('/formations/edit/{id}','editFormation')->name('formations.edit');
    Route::put('/formations/{id}','updateFormation')->name('formations.update');
    Route::delete('/formations/destroy/{id}','destroyFormation')->name('formations.destroy');

    Route::get('/formateurs','renderFormateurs')->name('formateurs.index');
    Route::get('/formateurs/create','createFormateur')->name('formateurs.create');
    Route::post('/formateurs','storeFormateur')->name('formateurs.store');
    Route::get('/formateurs/edit/{id}','editFormateur')->name('formateurs.edit');
    Route::put('/formateurs/{id}','updateFormateur')->name('formateurs.update');
    Route::delete('/formateurs/destroy/{id}','destroyFormateur')->name('formateurs.destroy');
});
});


Route::controller(CustomerController::class)->group(function(){
    Route::get('/customer/formations','showFormation')->name('customer.formations.index');
    Route::get('/customer/annonces','showAnnonces')->name('customer.annonces.index');


});