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

Route::get('/', 'App\Http\Controllers\ExportController@index')->name('exports.index');
Route::post('/exports', 'App\Http\Controllers\ExportController@store')->name('exports.store');
Route::get('/exports/{export}', 'App\Http\Controllers\ExportController@show')->name('exports.show');

Route::get('/imports', 'App\Http\Controllers\ImportController@index')->name('imports.index');
Route::post('/imports', 'App\Http\Controllers\ImportController@store')->name('imports.store');
Route::get('/imports/{import}', 'App\Http\Controllers\ImportController@show')->name('imports.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
