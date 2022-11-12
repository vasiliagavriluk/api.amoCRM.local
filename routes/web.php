<?php

use App\Http\Controllers\AmoCRMController;
use App\Http\Controllers\CompaniesController;
use \App\Http\Controllers\LeadsController;
use App\Http\Controllers\PipelinesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\UsersController;
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

/* Main */

Route::get('/',         [LeadsController::class, 'index'])->name('main.index');
Route::get('/users',    [UsersController::class, 'index'])->name('users.index');
Route::get('/pipelines',[PipelinesController::class, 'index'])->name('pipelines.index');
Route::get('/companies',[CompaniesController::class, 'index'])->name('companies.index');
Route::get('/statuses', [StatusesController::class, 'index'])->name('statuses.index');

/* End Main */
/* AmoCRM */
Route::get('/getAuthorize',[AmoCRMController::class, 'index'])->name('amocrm.index');
Route::get('/callback',[AmoCRMController::class, 'index'])->name('amocrm.callback');

/* End AmoCRM */







Route::get('/leads',[AmoCRMController::class, 'leads'])->name('amocrm.leads');
