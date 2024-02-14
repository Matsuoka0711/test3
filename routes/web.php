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

Route::get('/', function () {return view('welcome');});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/index', function () {return view('page.index');})->name('index');

Route::get('/list', [App\Http\Controllers\ProductController::class, 'showList'])->name('list');

Route::get('/regist',[App\Http\Controllers\ProductController::class, 'showRegistForm'])->name('regist');

Route::post('/regist',[App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

Route::get('/update/{id}',[App\Http\Controllers\ProductController::class, 'showUpdate'])->name('show.update');

Route::post('/update/{id}',[App\Http\Controllers\ProductController::class, 'productUpdate'])->name('product.update');

Route::delete('/delete/{id}', [App\Http\Controllers\ProductController::class, 'productDestroy'])->name('product.destroy');

Route::get('/search', [App\Http\Controllers\ProductController::class, 'searchPost'])->name('searchPost');