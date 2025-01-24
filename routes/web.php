<?php

use App\Http\Controllers\HuisdierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EigenaarController;
use App\Http\Controllers\OppasController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\BerichtController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ModeratieController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

// Test dashboard
Route::get('/test-dashboard', [TestController::class, 'index'])->name('test.dashboard');

// Huisdier routes
Route::get('/mijn-huisdieren', [HuisdierController::class, 'mijnHuisdieren'])->name('huisdieren.mijn');
Route::get('/huisdieren/aanmaken', [HuisdierController::class, 'create'])->name('huisdieren.create');
Route::post('/huisdieren/aanmaken', [HuisdierController::class, 'store'])->name('huisdieren.store');
Route::get('/huisdieren', [HuisdierController::class, 'index'])->name('huisdieren.index');
Route::get('/huisdieren/sorteren/{type}', [HuisdierController::class, 'index'])->name('huisdieren.sorteren');

// Oppassen routes
Route::get('/sitters', [PublicProfileController::class, 'index'])->name('sitters.index');
Route::get('/sitters/my-profile', [PublicProfileController::class, 'myProfile'])->name('sitters.myProfile');
Route::post('/sitters/my-profile', [PublicProfileController::class, 'update'])->name('sitters.updateProfilePost');
Route::put('/sitters/my-profile', [PublicProfileController::class, 'updateMyProfile'])->name('sitters.updateProfilePut');
Route::get('/sitters/{id}', [PublicProfileController::class, 'show'])->name('sitters.show');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Eigenaar dashboard
Route::get('/eigenaar-dashboard', [EigenaarController::class, 'index']);

// Oppas dashboard
Route::get('/oppas-dashboard', [OppasController::class, 'index']);

// Profiel routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Bericht routes
Route::post('/berichten', [BerichtController::class, 'store'])->name('berichten.store');
Route::post('/huisdieren/{huisdier}/berichten', [HuisdierController::class, 'storeBericht'])->name('huisdieren.berichten.store');
Route::post('/berichten/accept', [BerichtController::class, 'accept'])->name('berichten.accept');
Route::post('/berichten/reject', [BerichtController::class, 'reject'])->name('berichten.reject');

// Review routes
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Moderatie routes
Route::get('/moderatie', [ModeratieController::class, 'index'])->name('moderatie.index');
Route::delete('/moderatie/user/{id}', [ModeratieController::class, 'deleteUser'])->name('moderatie.deleteUser');
Route::delete('/moderatie/huisdier/{id}', [ModeratieController::class, 'deleteHuisdier'])->name('moderatie.deleteHuisdier');

require __DIR__.'/auth.php';