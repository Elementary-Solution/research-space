<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//raja route
//post route
Route::post('webs/signup', [App\Http\Controllers\MobileApp\MainWebController::class, 'SignUp']);
Route::post('webs/signupwithsocial', [App\Http\Controllers\MobileApp\MainWebController::class, 'signupWithSocial']);

Route::post('webs/loginwithsocial', [App\Http\Controllers\MobileApp\MainWebController::class, 'loginWithSocial']);

Route::post('webs/signin', [App\Http\Controllers\MobileApp\MainWebController::class, 'SignIn']);
Route::post('webs/profile-setting',[App\Http\Controllers\MobileApp\MainWebController::class, 'ProfileSetting']);
Route::post('webs/change-password',[App\Http\Controllers\MobileApp\MainWebController::class, 'ChangePassword']);
Route::post('webs/contact',[App\Http\Controllers\MobileApp\MainWebController::class, 'Contact']);
Route::post('webs/newsletter-subscribe', [App\Http\Controllers\MobileApp\MainWebController::class, 'NewsletterSubscribe']);
Route::post('webs/order', [App\Http\Controllers\MobileApp\MainWebController::class, 'postOrder']);
Route::post('webs/in-papers', [App\Http\Controllers\MobileApp\MainWebController::class, 'postPaper']);
Route::post('webs/single-paper', [App\Http\Controllers\MobileApp\MainWebController::class, 'singlePaper']);
Route::post('webs/reaction-post',[App\Http\Controllers\MobileApp\MainWebController::class, 'ReactionPost']);
Route::post('webs/single-subscription', [App\Http\Controllers\MobileApp\MainWebController::class, 'singleSubscription']);
Route::post('webs/single-custom-order', [App\Http\Controllers\MobileApp\MainWebController::class, 'singleCustomOrder']);
Route::post('webs/view-subscription', [App\Http\Controllers\MobileApp\MainWebController::class, 'viewSubscription']);
Route::post('webs/coupon-discount', [App\Http\Controllers\MobileApp\MainWebController::class, 'couponDiscount']);
Route::post('webs/get-orders', [App\Http\Controllers\MobileApp\MainWebController::class, 'getOrder']);
Route::post('webs/fetch-orders', [App\Http\Controllers\MobileApp\MainWebController::class, 'fetchOrder']);
Route::post('webs/single-order', [App\Http\Controllers\MobileApp\MainWebController::class, 'singleOrder']);
Route::post('webs/inquire-now', [App\Http\Controllers\MobileApp\MainWebController::class, 'inquireNow']);
Route::post('webs/user-permissions', [App\Http\Controllers\MobileApp\MainWebController::class, 'userPermissions']);
Route::get('webs/order-config', [App\Http\Controllers\MobileApp\MainWebController::class, 'orderConfig']);
Route::post('webs/create-order', [App\Http\Controllers\MobileApp\MainWebController::class, 'create_orders']);
Route::post('webs/manage-files', [App\Http\Controllers\MobileApp\MainWebController::class, 'manageFiles']);
Route::post('webs/fetch-order', [App\Http\Controllers\MobileApp\MainWebController::class, 'fetchOrderByOrderId']);
Route::post('webs/manage-status', [App\Http\Controllers\MobileApp\MainWebController::class, 'manageStatus']);
Route::post('webs/update-config', [App\Http\Controllers\MobileApp\MainWebController::class, 'manageConfig']);
Route::post('webs/fetch-files', [App\Http\Controllers\MobileApp\MainWebController::class, 'fetchFiles']);


//get route
Route::get('web/react-items',[App\Http\Controllers\MobileApp\MainWebController::class, 'Wishlisted_items']);
Route::get('webs/subscription', [App\Http\Controllers\MobileApp\MainWebController::class, 'discountSubscription']);
Route::get('webs/get-papers', [App\Http\Controllers\MobileApp\MainWebController::class, 'Paper']);
Route::get('webs/get-order-settings', [App\Http\Controllers\MobileApp\MainWebController::class, 'getOrderSettings']);
Route::get('webs/get-site-settings', [App\Http\Controllers\MobileApp\MainWebController::class, 'GetSiteSetting']);
