<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AddNewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

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

// admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin'], function (){
    Route::resource('/news', AdminNewsController::class);
    Route::resource('/category', AdminCategoryController::class);
});

// news routes
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/news/{id}', [NewsController::class, 'show'])
    ->where('id','\d+')
    ->name('news.show');

// index routes
Route::get('/index', [IndexController::class, 'index'])
    ->name('index.index');

// auth routes
Route::get('/auth', [AuthController::class, 'index'])
    ->name('auth.index');

// addNews routes
Route::get('/addNews', [AddNewsController::class, 'index'])
    ->name('addNews.index');

// category routes
Route::get('/category', [CategoryController::class, 'index'])
    ->name('category.index');