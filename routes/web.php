<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
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
// })-> name('/home');

Route::get('/', function () {
    if(Auth::check()) {
        return redirect('/home');
        echo Auth::user();
    } else {
        return view('login');
    }
});

// Route::get('/login', function () {
//     return view('login');
// });

Route::get('/home',[AuthManager::class, 'home']);


Route::get('/register',[AuthManager::class,'register'])->name(name: 'register');
Route::post('/register',[AuthManager::class,'registerpost'])->name(name: 'register.post');

Route::post('/login',[AuthManager::class, 'loginpost'])->name(name: 'login.post');
Route::get('/login',[AuthManager::class, 'login'])->name( name: 'login');
Route::get('/logout',[AuthManager::class, 'logout'])-> name(name: 'logout');


