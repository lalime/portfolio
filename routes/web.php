<?php

use App\Http\Livewire\Biography;
use App\Http\Livewire\Clients;
use App\Http\Livewire\ContactMe;
use App\Http\Livewire\Pages;
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

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->prefix('/dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/biography', Biography::class)->name('dashboard.biography');
    Route::get('/messages', ContactMe::class)->name('dash.message');
    Route::get('/customers', Clients::class)->name('dash.customers');
    Route::get('/pages', Pages::class)->name('dashboard.pages');
    Route::get('/posts', Clients::class)->name('dashboard.posts');
    // Route::get('messages', ContactMe::class);

});



// Route::get('/contact', [ContactUsFormController::class, 'createForm']);

// Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');
// Leol@l1;3