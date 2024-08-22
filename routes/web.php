<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceOwnerController;
use App\Http\Controllers\BusinessOwnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

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

// Redirect to the appropriate dashboard based on the user's role
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'space_owner') {
        return redirect()->route('space.dashboard');
    } elseif ($user->role === 'business_owner') {
        return redirect()->route('business.dashboard');
    } else {
        abort(403, 'Unauthorized');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Space Owner Dashboard Route
Route::get('/space/dashboard', [SpaceOwnerController::class, 'index'])
    ->name('space.dashboard')
    ->middleware(['auth', 'verified', 'role:space_owner']);

// Business Owner Dashboard Route
Route::get('/business/dashboard', [BusinessOwnerController::class, 'index'])
    ->name('business.dashboard')
    ->middleware(['auth', 'verified', 'role:business_owner']);

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
