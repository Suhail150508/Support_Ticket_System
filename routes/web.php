<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
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

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login-store', [HomeController::class, 'loginStore'])->name('login.store');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register-store', [HomeController::class, 'registerStore'])->name('register.store');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::get('/tickets', [TicketController::class, 'tickets'])->name('tickets');
// Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets-edit/{id}', [TicketController::class, 'edit']);
Route::put('/tickets-update/{id}', [TicketController::class, 'update'])->name('update');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::get('/tickets-view/{id}', [TicketController::class, 'view'])->name('tickets.view');
Route::delete('/admin-tickets-delete/{id}', [TicketController::class, 'delete']);
Route::delete('/customer-tickets-delete/{id}', [TicketController::class, 'customerTicketDelete']);
Route::post('/tickets/{ticket}/close', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');


Route::get('/admin-ticket', [TicketController::class, 'adminTicket']);
Route::get('/customer-ticket', [TicketController::class, 'customerTicket']);
