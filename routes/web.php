<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AdminController::class)->group(function(){
Route::get('/overview','renderOverview')->name('overview');

});