<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::get('/logout',function(){

    return view('login.index');
});
Route::get('/login', function () {
    if (Auth::user()) {
        Auth::logout();
    }
    return redirect(url('/'));
})->name('login');
Route::get('/', function () {
    return view('login.index');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', function () {
        if (auth()->user()) {
            return view('admin.layouts.app');
        } else {
            Auth::logout();
            return redirect(url('/'));
        }
    });

    Route::any('/admin/{page?}', function () {
        if (auth()->user()) {
            return view('admin.layouts.app');
        } else {
            return redirect(url('/'));
        }
    })->where('page', '(.*)');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
