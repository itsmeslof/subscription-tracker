<?php

use App\Http\Controllers\Subscriptions\ActivateSubscriptionController;
use App\Http\Controllers\Subscriptions\CancelSubscriptionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UpdateIPRestrictionController;
use App\Http\Controllers\UpdateUserSettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPasswordController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('subscriptions.index');
});

Route::middleware('auth')->prefix('account')->group(function () {
    Route::get('/', [UserController::class, 'edit'])->name('user.settings');
    Route::patch('/update', [UserController::class, 'update'])->name('user.update');
    Route::patch('/password/update', [UserPasswordController::class, 'update'])->name('user.password.update');

    Route::patch('/settings/general/update', UpdateUserSettingsController::class)->name('user.settings.update');
    Route::patch('/settings/ipaccess/update', UpdateIPRestrictionController::class)->name('user.settings.ipaccess.update');
});

Route::middleware('auth')->prefix('subscriptions')->group(function () {
    Route::get('/', [SubscriptionController::class, 'index'])->middleware(['auth'])->name('subscriptions.index');
    Route::get('/{subscription:slug}/edit', [SubscriptionController::class, 'edit'])->name('subscriptions.edit');
    Route::get('/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::patch('/{subscription:slug}/update', [SubscriptionController::class, 'update'])->name('subscriptions.update');
    Route::delete('/{subscription:slug}/delete', [SubscriptionController::class, 'destroy'])->name('subscriptions.destroy');

    Route::post('/{subscription:slug}/cancel', CancelSubscriptionController::class)->name('subscriptions.cancel');
    Route::post('/{subscription:slug}/activate', ActivateSubscriptionController::class)->name('subscriptions.activate');
});

require __DIR__ . '/auth.php';
