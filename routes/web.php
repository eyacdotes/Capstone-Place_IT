<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceOwnerController;
use App\Http\Controllers\BusinessOwnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CreateListingController;

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

Route::get('register/space', [RegisteredUserController::class, 'createSpaceOwner'])->name('space.register');
Route::post('register/space', [RegisteredUserController::class, 'storeSpaceOwner'])->name('space.register.post');

Route::get('register/business', [RegisteredUserController::class, 'createBusinessOwner'])->name('business.register');
Route::post('register/business', [RegisteredUserController::class, 'storeBusinessOwner'])->name('business.register.post');

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

// display modal places/location
Route::get('/business/place/{location}', [BusinessOwnerController::class, 'showByLocation'])
    ->name('place.showByLocation');

// View details for a specific listing/spaces
Route::get('/business/place/detail/{listingID}', [BusinessOwnerController::class, 'detail'])
    ->name('place.detail');

//Space Owner Navbars
Route::get('/space/newspaces', [SpaceOwnerController::class, 'newspaces'])
    ->name('space.newspaces')
    ->middleware(['auth', 'verified', 'role:space_owner']);

//create new listing
Route::middleware('auth')->group(function () {
    Route::post('/space/dashboard', [CreateListingController::class, 'store'])->name('space.new.store');
});    

// SPACE NEGOTIATIONS
Route::get('/space/negotiations', [App\Http\Controllers\NegotiationController::class, 'index'])->name('space.negotiations');

Route::get('space/negotiations/{negotiationID}', [App\Http\Controllers\NegotiationController::class, 'show'])->name('negotiation.show');

// SPACE FEEDBACK
Route::get('/space/feedback', [SpaceOwnerController::class, 'feedback'])
    ->name('space.feedback')
    ->middleware(['auth', 'verified', 'role:space_owner']);

Route::post('space/negotiations/store', [App\Http\Controllers\NegotiationController::class, 'store'])->name('negotiation.store');

// SPACE OWNER NEGOTIATIONS
Route::get('/negotiations/{negotiationID}/reply', [App\Http\Controllers\NegotiationController::class, 'getMessages'])->name('negotiation.reply');

Route::post('space/negotiations/{negotiationID}/reply', [App\Http\Controllers\NegotiationController::class, 'reply'])->name('negotiation.reply');

// space owner update status
Route::post('space/negotiations/{negotiationID}/status', [App\Http\Controllers\NegotiationController::class, 'updateStatus'])->name('negotiation.updateStatus');

//business owner agreement
Route::post('business/negotiations/{negotiationID}/rent-agreement', [App\Http\Controllers\NegotiationController::class, 'rentAgree'])->name('negotiation.rentAgree');


// BUSINESS OWNER NEGOTIATIONS
Route::get('/business/negotiations', [App\Http\Controllers\NegotiationController::class, 'index'])->name('business.negotiations');

Route::get('business/negotiations/{negotiationID}', [App\Http\Controllers\NegotiationController::class, 'show'])->name('negotiation.show');

Route::post('business/negotiations/{negotiationID}/reply', [App\Http\Controllers\NegotiationController::class, 'reply'])->name('negotiation.reply');

Route::get('/business/bookinghistory', [BusinessOwnerController::class, 'bookinghistory'])
    ->name('business.bookinghistory')
    ->middleware(['auth', 'verified', 'role:business_owner']);

Route::get('/business/feedback', [BusinessOwnerController::class, 'feedback'])
    ->name('business.feedback')
    ->middleware(['auth', 'verified', 'role:business_owner']);

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
