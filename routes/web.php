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

Route::post('/finalizar-pagamento', 'App\Http\Controllers\PaymentController@payment');

Route::get('/obrigado', function () {
    return view('thankyou');
})->name('obrigado');

Route::get('/ops', function () {
    return view('error');
})->name('erro');
