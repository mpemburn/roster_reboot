<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CovenController;
use App\Http\Controllers\MembersController;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Firebase\JWT\JWT;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'api'], function () {
    Route::post('/member', MembersController::class . '@store');
    Route::post('/member_email', MembersController::class . '@addEmailToMember');
    Route::post('/member_coven', MembersController::class . '@addMemberToCoven');
    Route::put('member_update/{member_id}', [MembersController::class, 'updateMember']);

    Route::get('/members', MembersController::class . '@show');
    Route::get('/get_member/{id}', function ($id) {
        return new MemberResource(Member::findOrFail($id));
    });

    Route::get('/covens', CovenController::class . '@show');
    Route::get('/get_auth', AuthController::class . '@getAuthToken');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', AuthController::class . '@login');
    Route::post('signup', AuthController::class . '@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', AuthController::class . '@logout');
        Route::get('user', AuthController::class . '@user');
    });
});
