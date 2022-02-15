<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\NewsController;

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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/account', AccountController::class)
        ->name('account');

    Route::get('/account/logout', function() {
        \Auth::logout();
        return redirect()->route('login');
    })->name('account.logout');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function (){
        Route::view('/', 'admin.index')->name('index');
        Route::get('/parser', ParserController::class)->name('parser');
        Route::resource('/profiles', ProfileController::class);
        Route::resource('/news', AdminNewsController::class);
        Route::resource('/categories', AdminCategoryController::class);
    });
});

// news routes
Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])
    ->where('news','\d+')
    ->name('news.show');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'guest', 'prefix' => 'auth', 'as' => 'social.'], function () {
    Route::get('/{network}/redirect', [SocialController::class, 'redirect'])
        ->name('redirect');
    Route::get('/{network}/callback', [SocialController::class, 'callback'])
        ->name('callback');;
});
