<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    //get method သည် form page ကို ယူဖို့ဘဲ ဘာ action မှမလုပ်ဘူး
    //first register->route
    //second register->controller ထဲက function name

    Route::post('register', 'registerSave')->name('register.save');
    //Import! method 2 ခု မတူရပါ -> post method သည် form မှာ action လုပ်ဖို့
    //1. browser မှာ ရိုက်ထည့်ရမဲ့ path name (Browser)
    //2. AuthController အောက်က Method Name (Controller)
    //3. Blade File ရဲ့ form ထဲက action မှာ ရေးရမဲ့ route name (Blade)
    //(eg.,form action={{route('register.save')}})

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('/logout', 'logout')->middleware('auth')->name('logout');
});
//Route::get('/home',[HomeController::class,'index'] )->name('home');
//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
 
//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
});
