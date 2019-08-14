<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/

Route::prefix('v1')->group(function () {
    Route::namespace('Api\V1')->group(function () {
        Route::namespace('Auth')->group(function () {
            Route::post('login', 'AuthController@login')->name('login');
            Route::post('forgot-password', 'ForgotPasswordController@sendResetLinkEmail')
                ->name('forgot-password');
            Route::post('reset-password', 'ResetPasswordController@reset')->name('reset-password');
            Route::group(['middleware' => ['auth:api']], function () {
                Route::post('logout', 'AuthController@logout')->name('logout');
            });
        });

        Route::group(['middleware' => ['auth:api']], function () {
            Route::get('user', 'UserController@loggedInUser')->name('logged-in-user');
            Route::group(['middleware' => ['validateAdmin']], function () {
                Route::resource('users', 'UserController');
                Route::get('chart-reports', 'ChannelPerformanceController@show')->name('chart-reports');
            });
            Route::get('bookings', 'BookingController@show')->name('bookings');
            Route::get('tickets', 'TicketController@show')->name('tickets');
            Route::get('to-dos', 'ToDoController@details')->name('todo-details');
            Route::get('monthly-target', 'BookingController@monthlyTarget')->name('monthly-target');
        });
    });

    Route::fallback(function(){
        return response()->json([
            'message' => "Page Not Found. We're sorry, we couldn't find the page you requested."], Response::HTTP_NOT_FOUND);
    });
});
