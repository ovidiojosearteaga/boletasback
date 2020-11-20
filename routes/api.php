<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\UserTicketController;
use App\Http\Controllers\API\ConfigurationController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function() {
    Route::get('logout', [RegisterController::class, 'logout']);

    Route::get('tickets/available', [UserTicketController::class, 'getAvailableTickets']);

    Route::resource('tickets', TicketController::class, ['except' => ['store', 'update']]);
    
    Route::resource('tickets', TicketController::class, ['only' => ['store']])->middleware('checkNumberTickets');
    
    Route::get('tickets/fromuser/{user}', [UserTicketController::class, 'get']);

    Route::get('tickets/{ticket}/user', [UserTicketController::class, 'getUser']);

    Route::resource('users', UserController::class, ['except' => ['store', 'destroy']]);

    Route::resource('users', UserController::class, ['only', ['store', 'destroy']])->middleware('checkRoleAdmin');

    Route::resource('configuration', ConfigurationController::class, ['except' => ['destroy']])->middleware('checkRoleAdmin');;
});