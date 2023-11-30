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

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/datademo', function () { //to check if fillable worked
    $inhabitants = DB::select('select count(*) from inhabitants where sex_id=1');

    // $user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['Marie', 'mariekoy@gmail.com', 'monalisa']);
    // $inhabitants = DB::update("update inhabitants set created_at='2023-11-27 16:38:26' where last_name='jeric'");
    // $user = DB::delete('delete from users where id=2');
    dd($inhabitants);
});
