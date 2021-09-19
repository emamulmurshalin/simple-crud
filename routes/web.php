<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return view('crud.dashboard.dashboard');
})->name('dashboard');

Route::get('/employees', function () {
    return view('crud.users.all-employee');
})->name('employee');

Route::get('/soft-delete-employees', function () {
    return view('crud.users.trash-employee');
})->name('employee');

Route::resource('employee', EmployeeController::class);
Route::post('/employee-update/{id}', [EmployeeController::class, 'updateEmployee'])
    ->name('update.employee');
Route::get('/trash-employee', [EmployeeController::class, 'trashEmployee'])
    ->name('trash.employee');

require __DIR__.'/auth.php';
