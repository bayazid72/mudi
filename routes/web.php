<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\beheerder\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Alleen beheerder mag gebruikers maken
Route::middleware(['auth', 'beheerder'])->prefix('beheerder')->name('beheerder.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

        // Alleen invoerder mag melding maken
        Route::middleware(['auth', 'role:invoerder'])
            ->prefix('invoerder')
            ->name('invoerder.')
            ->group(function () {
                Route::get('/meldingen/create', [MeldingController::class, 'create'])
                    ->name('meldingen.create');

                Route::post('/meldingen', [MeldingController::class, 'store'])
                    ->name('meldingen.store');
            });


        // Alleen ophaler en beheerder mogen meldingen zien
        Route::middleware(['auth', 'role:ophaler,beheerder'])
            ->prefix('ophaler')
            ->name('ophaler.')
            ->group(function () {
                Route::get('/meldingen', [MeldingController::class, 'index'])
                    ->name('meldingen.index');
            });





require __DIR__.'/auth.php';
