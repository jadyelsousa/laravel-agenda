<?php

use App\Http\Controllers\ContactController;
use App\Http\Requests\Auth\ContactRequest;
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
    $contacts = Contato::where('id_usuario',Auth::user()->id)->paginate(10);
    // $contacts = $contacts->sortBy('nome')->groupBy(function ($item, $key) {
    //     return substr($item['nome'], 0, 1);
    // });

    // dd($contacts);
    // foreach ($contacts as $contact) {
    //     dd($contact);
    // }
    return view('dashboard',compact('contacts'));
})->middleware(['auth'])->name('dashboard');

Route::controller(ContactController::class)->prefix('contact')->group(function () {
    Route::post('/store', 'store')->middleware(['auth'])->name('contact.store');
    Route::get('/searchSuggestion', 'searchSuggestion')->middleware(['auth'])->name('contact.searchSuggestion');
    Route::any('/search', 'search')->middleware(['auth'])->name('contact.search');
    Route::post('/update', 'update')->middleware(['auth'])->name('contact.update');
    Route::delete('/destroy', 'destroy')->middleware(['auth'])->name('contact.destroy');
});

require __DIR__.'/auth.php';
