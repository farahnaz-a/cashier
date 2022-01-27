<?php

use App\Http\Controllers\GitPushController;
use App\Http\Controllers\SubscriptionController;
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
    return view('welcome');
});

Route::get('/my-git-push', [GitPushController::class, 'index']);
Route::get('/my-scrape', [GitPushController::class, 'scrape']);
Route::stripeWebhooks('stripe-webhook');
Route::webhooks('github-webhook');

Route::get('/fiscal', [GitPushController::class, 'fiscal'])->name('fiscal');
Route::get('/get-result', [GitPushController::class, 'getresult'])->name('getresult');
Route::get('/check', [GitPushController::class, 'check'])->name('check');
Route::get('/result', [GitPushController::class, 'res'])->name('res');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/subscription/create', [SubscriptionController::class, 'index'])->name('subscription.create.id');
Route::get('/subscription/create/{id}', [SubscriptionController::class, 'indexx'])->name('subscription.create');
Route::post('order-post', [SubscriptionController::class, 'orderPost'])->name('order-post');
Route::post('/stripe/webhook', [SubscriptionController::class, 'webhook'])->name('webhook');

// Route::get('/seller/subscribe', [SubscriptionController::class, 'showSubscription']);
// Route::post('/seller/subscribe', [SubscriptionController::class, 'processSubscription']);
//       // welcome page only for subscribed users
// Route::get('/welcome', [SubscriptionController::class, 'showWelcome'])->middleware('subscribed');
