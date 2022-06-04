<?php

use App\Http\Controllers\ContactController;
use App\Models\Contato;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    $contacts = Contato::with('telefone','endereco','email')->where('id_usuario', Auth::user()->id)->paginate(10);
    return view('dashboard',compact('contacts'));
})->middleware(['auth'])->name('dashboard');

Route::controller(ContactController::class)->prefix('contact')->group(function () {
    Route::post('/store', 'store')->middleware(['auth'])->name('contact.store');
});

require __DIR__.'/auth.php';
