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
//     return view('welcome');
// });
Route::get('/',  [ 'as' => '/', 'uses' => 'App\Http\Controllers\AuthController@index']);
Route::post('/admin/login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\AuthController@login']);
Route::get('/user', [ 'as' => 'user', 'uses' => 'App\Http\Controllers\AuthController@user']);
Route::post('/user', [ 'as' => 'user', 'uses' => 'App\Http\Controllers\AuthController@store']);
Route::get('/admin/logout', 'App\Http\Controllers\AuthController@logout');
Route::group(['prefix' => 'admin', 'middleware' => ['CheckSession']], function(){

    Route::get('/profile', 'App\Http\Controllers\Users\UserController@profileDetail');
    Route::post('/profile/change-password', 'App\Http\Controllers\Users\UserController@changePassword');
    Route::group(['middleware' => ['CheckPermission']], function(){

        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');
        Route::get('/menu/{id}', 'App\Http\Controllers\DashboardController@menu');

        Route::get('/users', 'App\Http\Controllers\Users\UserController@index');
        Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
        Route::get('/user/add', 'App\Http\Controllers\Users\UserController@add');
        Route::post('/user/create', 'App\Http\Controllers\Users\UserController@store');
        Route::post('/user/update', 'App\Http\Controllers\Users\UserController@update');
        Route::get('/user/delete/{id}', 'App\Http\Controllers\Users\UserController@destroy');

        //===========Planning

        Route::get('/planning-dashboard', 'App\Http\Controllers\DashboardController@planning');

        // Route::get('/planning-daily', 'App\Http\Controllers\Planning\DailyController@index');
        Route::get('/planning-daily/edit/{id}', 'App\Http\Controllers\Planning\DailyController@show');
        Route::get('/planning-daily', 'App\Http\Controllers\Planning\DailyController@add');
        Route::get('/planning-daily/status/{status}/{id}', ['uses' => 'App\Http\Controllers\Planning\DailyController@status', 'as' => 'planning-daily.status']);
        Route::post('/planning-daily/store', 'App\Http\Controllers\Planning\DailyController@store');
        Route::get('/planning-monthly/edit/{id}', 'App\Http\Controllers\Planning\DailyController@show');
        Route::post('/planning-daily/update/{id}', 'App\Http\Controllers\Planning\DailyController@update');
        Route::post('/planning-daily/import', 'App\Http\Controllers\Planning\DailyController@import');


        Route::get('/planning-monthly', 'App\Http\Controllers\Planning\MonthlyController@index');
        Route::get('/planning-monthly/edit/{id}', 'App\Http\Controllers\Planning\MonthlyController@show');
        Route::get('/planning-monthly/add', 'App\Http\Controllers\Planning\MonthlyController@add');
        Route::post('/planning-monthly/store', 'App\Http\Controllers\Planning\MonthlyController@store');
        Route::post('/planning-monthly/update/{id}', 'App\Http\Controllers\Planning\MonthlyController@update');
        Route::post('/planning-monthly/import', 'App\Http\Controllers\Planning\MonthlyController@import');
        Route::get('/planning-monthly/status/{status}/{id}', ['uses' => 'App\Http\Controllers\Planning\MonthlyController@status', 'as' => 'planning-monthly.status']);

        //Maintenance
        Route::get('/maintenance', 'App\Http\Controllers\MaintenanceController@index');
        Route::post('/maintenance/update', 'App\Http\Controllers\MaintenanceController@update');
        Route::post('/maintenance/store', 'App\Http\Controllers\MaintenanceController@store');

        //Analytic
        Route::get('/production-analytic', 'App\Http\Controllers\ProductionAnalyticController@index');

        //KPI
        Route::get('/kpi-dashboard', 'App\Http\Controllers\MachineKpi\MachineKpiController@index');
        Route::get('/kpi-dashboard/detail/{id}', 'App\Http\Controllers\MachineKpi\MachineKpiController@detail');
        Route::get('/kpi/detail', 'App\Http\Controllers\KPIController@detail');
        Route::get('/kpi/all', 'App\Http\Controllers\MachineKpi\MachineKpiController@all');
    });

});
