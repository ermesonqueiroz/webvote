<?php

use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Route;
use App\Models\Option;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'firstOption' => Option::query()->find(1),
        'secondOption' => Option::query()->find(2)
    ]);
});

Route::prefix('option')->group(function () {
    Route::patch('/{id}', [OptionController::class, 'update']);
})->name('option.');
