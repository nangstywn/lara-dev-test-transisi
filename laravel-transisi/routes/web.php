<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
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

Route::middleware(['guest'])->group(
    function () {
        Route::get('/', function () {
            return view('auth.login');
        })->name('login');
        route::post('login', [AuthController::class, 'proses_login']);
    }
);

Route::middleware(['auth'])->group(
    function () {
        Route::get('/home', function () {
            return view('home');
        });
        route::get('logout', [AuthController::class, 'proses_logout'])->name('logout');

        //ajax
        route::get('getCompanies', [EmployeesController::class, 'getCompanies']);


        route::get('export/pdf', [EmployeesController::class, 'exportPdf']);
        route::get('export/excel', [EmployeesController::class, 'exportExcel']);
        route::post('import/excel', [EmployeesController::class, 'importExcel']);

        Route::resource('company', CompaniesController::class);
        Route::resource('employee', EmployeesController::class);
    }
);
