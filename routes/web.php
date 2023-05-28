<?php

use Illuminate\Support\Facades\Auth;
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
// Route::get('/', [App\Http\Controllers\HomeController::class, 'welcomeData']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/add-cities', [App\Http\Controllers\UserCityController::class, 'storeCity'])->name('addCities');

Route::get('/weather', [App\Http\Controllers\WeatherCheckController::class, 'index']);
Route::post('/temp-limit', [App\Http\Controllers\WeatherCheckController::class, 'storeTempLimit']);

Route::get('/city-record', [App\Http\Controllers\WeatherReportController::class, 'index']);

Route::get('send-mail', [App\Http\Controllers\UserCityController::class, 'MailSend']);