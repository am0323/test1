<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PresentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ImageController;

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

Route::get('/flower', [FlowerController::class, 'index']);
Route::get('/flower/show', [FlowerController::class, 'show']);
Route::get('/flower/edit', [FlowerController::class, 'edit']);
Route::post('/flower/edit', [FlowerController::class, 'update']);

Route::get('/player', [PlayerController::class, 'index']);
Route::get('/player/show', [PlayerController::class, 'show']);
Route::get('/player/add', [PlayerController::class, 'add']);
Route::post('/player/add', [PlayerController::class, 'create']);
Route::get('/player/del', [PlayerController::class, 'del']);
Route::post('/player/del', [PlayerController::class, 'remove']);
Route::get('/player/edit', [PlayerController::class, 'edit']);
Route::post('/player/edit', [PlayerController::class, 'update']);

Route::get('/map', [MapController::class, 'index']);
Route::get('/map/show', [MapController::class, 'show']);
Route::get('/map/add', [MapController::class, 'add']);
Route::post('/map/add', [MapController::class, 'create']);
Route::get('/map/edit', [MapController::class, 'edit']);
Route::post('/map/edit', [MapController::class, 'update']);
Route::get('/map/del', [MapController::class, 'del']);
Route::post('/map/del', [MapController::class, 'remove']);

Route::post('/map/confirm', [MapController::class, 'postImageComplete']);

Route::get('/present', [PresentController::class, 'index']);
Route::get('/present/show', [PresentController::class, 'show']);
Route::get('/present/add', [PresentController::class, 'add']);
Route::post('/present/add', [PresentController::class, 'create']);
Route::get('/present/edit', [PresentController::class, 'edit']);
Route::post('/present/edit', [PresentController::class, 'update']);
Route::get('/present/del', [PresentController::class, 'del']);
Route::post('/present/del', [PresentController::class, 'remove']);

Route::get('/person', [PersonController::class, 'index']);

Route::get('/image_input', [ImageController::class, 'getImageInput']);
Route::post('/image_confirm', [ImageController::class, 'postImageConfirm']);
Route::post('/image_complete', [ImageController::class, 'postImageComplete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/person/auth', [PersonController::class, 'getAuth']);
Route::post('/person/auth', [PersonController::class, 'postAuth']);


