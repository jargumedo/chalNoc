<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Mail\HelloMail;

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
  
    return view('/welcome');
    
});

Route::view("/login", "login")->name("login");


Route::post('/incia-sesion', [LoginController::class, 'login'])->name('incia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get("mail", function(){
    Mail::to("challengenocnoc@gmail.com")
    ->send(new HelloMail());

    return "Mensaje enviado";
});
