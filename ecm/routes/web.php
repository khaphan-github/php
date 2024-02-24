<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    // conssole.logt(ussername, passwrod);
    // Kha: logic login;
    // repnse: -> Quynfh hieern thij

    
    return view('welcome');
});


Route::get('/register', function () {
    return view('admin/welcome');
});
