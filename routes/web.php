<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['throttle' => 'login']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Routes pour les catégories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    
    // Routes pour les prestataires
    Route::get('/providers', [ProviderController::class, 'index'])->name('providers.index');
    Route::get('/providers/{id}', [ProviderController::class, 'show'])->name('providers.show');
    
    // Routes pour le profil prestataire
    Route::middleware(['provider'])->group(function () {
        Route::get('/provider/profile', [ProviderController::class, 'profile'])->name('provider.profile');
        Route::get('/provider/edit', [ProviderController::class, 'edit'])->name('provider.edit');
        Route::post('/provider/update', [ProviderController::class, 'update'])->name('provider.update');
        Route::post('/provider/toggle-availability', [ProviderController::class, 'toggleAvailability'])->name('provider.toggle-availability');
    });
    
    // Routes pour le profil client
    Route::middleware(['client'])->group(function () {
        Route::get('/client/profile', [ClientController::class, 'profile'])->name('client.profile');
        Route::get('/client/edit', [ClientController::class, 'edit'])->name('client.edit');
        Route::post('/client/update', [ClientController::class, 'update'])->name('client.update');
    });
    
    // Routes pour les messages avec fonctionnalités avancées
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/create/{receiver_id?}', [MessageController::class, 'create'])->name('create');
        Route::post('/', [MessageController::class, 'store'])->name('store')->middleware('throttle:messages');
        Route::get('/conversation/{user_id}', [MessageController::class, 'conversation'])->name('conversation');
        Route::post('/{id}/mark-read', [MessageController::class, 'markAsRead'])->name('mark-read');
        Route::get('/mark-all-read', [MessageController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::get('/unread-count', [MessageController::class, 'getUnreadCount'])->name('unread-count');
        Route::get('/search-users', [MessageController::class, 'searchUsers'])->name('search-users');
        Route::delete('/{id}/delete', [MessageController::class, 'deleteMessage'])->name('delete');
        
        // Routes héritées pour compatibilité
        Route::get('/{id}', [MessageController::class, 'show'])->name('show');
        Route::get('/{id}/reply', [MessageController::class, 'reply'])->name('reply');
    });
    
    // Routes pour les évaluations avec rate limiting
    Route::middleware(['client'])->group(function () {
        Route::get('/ratings/create/{provider_id}', [RatingController::class, 'create'])->name('ratings.create');
        Route::post('/ratings/{provider_id}', [RatingController::class, 'store'])->name('ratings.store')->middleware('throttle:ratings');
    });
});
