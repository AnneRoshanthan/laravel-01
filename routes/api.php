<?php

use App\Http\Controllers\BlockPostController;
use App\Http\Controllers\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\WebSocketHandlers\CustomWebSocketHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('chat',[ChatController::class,'store'])->name('chat');

Route::post('blog', [BlockPostController::class,'createBlockPost']);

WebSocketsRouter::webSocket('/websocket',CustomWebSocketHandler::class);


//STRIPE
Route::get('stripe', [StripeController::class,'retrieveProduct']);
Route::get('stripe/buy', [StripeController::class,'buyProduct']);
Route::get('stripe/charge', [StripeController::class,'chargeProduct']);
Route::get('stripe/buystripe', [StripeController::class,'buyStripeProduct']);
Route::get('stripe/retrieve', [StripeController::class,'retrieve']);