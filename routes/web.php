<?php

use App\Events\SendMessages;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\WebSocketHandlers\CustomWebSocketHandler;
use Illuminate\Support\Facades\Auth;
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
Route::get('/',[StripeController::class,'buyStripeProduct']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/c', function () {
    $user = Auth::user();
    broadcast(new SendMessages($user,'64feef9ac3a88007bb028292'))->toOthers();

});

// $webSocketRouter = resolve(Router::class);
// $webSocketRouter->webSocket('/clock', CustomWebSocketHandler::class);

require __DIR__.'/auth.php';
