<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ExcelController;
use Inertia\Inertia;
use Laravel\Jetstream\Rules\Role;

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
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/agencies', [AgencyController::class, 'index'])->name('agencies.index');
Route::post('/agencies', [AgencyController::class, 'store'])->name('agencies.store');
Route::get('/agencies/create', [AgencyController::class, 'create'])->name('agencies.create');
Route::get('/agencies/{agency}/edit', [AgencyController::class, 'edit'])->name('agencies.edit');
Route::put('/agencies/{agency}/restore', [AgencyController::class, 'restore'])->name('agencies.restore');
Route::get('/agencies/{agency}', [AgencyController::class, 'show'])->name('agencies.show');
Route::put('/agencies/{agency}', [AgencyController::class, 'update'])->name('agencies.update');
Route::delete('/agencies/{agency}', [AgencyController::class, 'destroy'])->name('agencies.destroy');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
