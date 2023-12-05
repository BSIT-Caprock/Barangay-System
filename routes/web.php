<?php

use Illuminate\Support\Facades\Route;
use App\Models\Inhabitant;

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
    // $age = DB::select('select age from inhabitants');

    // // $user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['Marie', 'mariekoy@gmail.com', 'monalisa']);
    // // $user = DB::update("update users set email='monalisa@gmail.com' where id=2");
    // // $user = DB::delete('delete from users where id=2');
    // dd($age);
    // $inhabitants = DB::select('select * from inhabitants');
    // dd($inhabitants);
    // $infant = DB::select("SELECT COUNT(*) AS age_0_1_count FROM inhabitants WHERE DATE('20' || SUBSTR(birth_date, 7, 2) || '-' || SUBSTR(birth_date, 4, 2) || '-' || SUBSTR(birth_date, 1, 2)) BETWEEN CURRENT_DATE - INTERVAL 1 YEAR AND CURRENT_DATE");

    // dd($infant);
    // $adultCount = Inhabitant::where('age', 21)->count();
    // $marriedCount = Inhabitant::where('civil_status_id', 2)->count();
    // $widowedCount = Inhabitant::where('civil_status_id', 3)->count();
    // $separatedCount = Inhabitant::where('civil_status_id', 4)->count();
    // dd($adultCount);

    $birthdays = DB::select('select birth_date from inhabitants');
    dd($birthdays);

});
