<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileEditController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

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
    return Redirect::route('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get   ('/profile', [ProfileController::class, 'edit']   )->name('profile.edit');
    Route::patch ('/profile', [ProfileController::class, 'update'] )->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get   ('/profile/e/{target}/promote/', [ProfileEditController::class, 'promote']   )->name('profile.promote');
    Route::get   ('/profile/e/{target}/demote/',  [ProfileEditController::class, 'demote' ]   )->name('profile.demote');
    Route::get   ('/profile/e/{target}/',         [ProfileEditController::class, 'edit'   ]   )->name('profile.modify');
});

require __DIR__.'/auth.php';
