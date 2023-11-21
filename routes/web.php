<?php

use Illuminate\Support\Facades\Route;

//raja routes
use App\Http\Controllers\Management\SubscriptionController;
use App\Http\Controllers\Management\ManageOrderController;
use App\Http\Controllers\Management\CouponController;
use App\Http\Controllers\Management\CategoriesController;
use App\Http\Controllers\Management\PaperController;
use App\Http\Controllers\Management\CoupenDiscountController;
use App\Http\Controllers\Management\CustomConfigController;
use App\Http\Controllers\Management\CustomController;
use App\Http\Controllers\Management\OrderController;
use App\Http\Controllers\Management\InquireNowController;
use App\Models\OrderConfig;

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

Route::fallback(function () {
    return view("404");
});

Route::get('/', function () {
    return redirect('admin/home');
//    return view('Frontend.home.index');
});

Route::middleware(['auth'])
    ->group(function () {
//Route::group(['middleware' => ['auth']], function() {
        Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('admin/roles', App\Http\Controllers\RoleController::class);
        Route::resource('admin/permissions', App\Http\Controllers\PermissionsController::class);
        Route::resource('admin/users', App\Http\Controllers\UserController::class);
        Route::resource('admin/products', App\Http\Controllers\ProductController::class);
        Route::resource('admin/dashboard',App\Http\Controllers\HomeController::class);
        Route::resource('admin/countries',CountryController::class);

        //categories
        Route::resource('admin/categories',CategoriesController::class);

        //keyword
        Route::resource('admin/keyword',App\Http\Controllers\Management\KeywordController::class);

        //blog
        Route::resource('admin/post',BlogController::class);

        //Store
        Route::resource('admin/store',StoreController::class);

        //video
        Route::resource('admin/videos',VideoshowController::class);

        //slider
        Route::resource('admin/slider',SliderController::class);

        //testimonial
        Route::resource('admin/testimonial',App\Http\Controllers\Management\TestimonialController::class);

        //userinfo
        Route::resource('admin/user-info',UserinfoController::class);

        //pages
        Route::resource('admin/pages',PageController::class);

        //contact
        Route::resource('admin/contacts',App\Http\Controllers\Management\ContactController::class);

        //subscriber
        Route::get('admin/subscriber',[App\Http\Controllers\Management\ContactController::class,'subscriber']);

        //coupon
        Route::resource('admin/coupon',CouponController::class);
        Route::resource('admin/theme-setting', App\Http\Controllers\Management\ThemeSettingsController::class);
        Route::post('admin/theme-setting-fields', [App\Http\Controllers\Management\ThemeSettingsController::class,'theme_setting_fields']);


        //raja routes
        //subscription
        Route::resource('admin/subscription',SubscriptionController::class);
        Route::resource('admin/orders',ManageOrderController::class);
        Route::resource('admin/custom-order-config',CustomConfigController::class);
        Route::resource('admin/custom-order',CustomController::class);

        //paper
        Route::resource('admin/paper',PaperController::class);

        //coupon-discount
        Route::resource('admin/coupon-discount',CoupenDiscountController::class);

        //view-order
        Route::resource('admin/view-order',OrderController::class);

        //inquire-now
        Route::resource('admin/inquire-now',InquireNowController::class);



    });

//Order Setting
Route::resource('academic_level', App\Http\Controllers\Management\OrderSettings\AcademicLevel\AcademicLevelController::class);
Route::resource('paper_type', App\Http\Controllers\Management\OrderSettings\PaperType\PaperTypeController::class);
Route::resource('subject_type', App\Http\Controllers\Management\OrderSettings\SubjectType\SubjectTypeController::class);
Route::resource('citation_style', App\Http\Controllers\Management\OrderSettings\Citation_Style\Citation_StyleController::class);
Route::resource('document_type', App\Http\Controllers\Management\OrderSettings\DocumentType\DocumentTypeController::class);
Route::resource('paper_format', App\Http\Controllers\Management\OrderSettings\PaperFormat\PaperFormatController::class);
Route::resource('language_style', App\Http\Controllers\Management\OrderSettings\LanguageStyle\LanguageStyleController::class);


Auth::routes();

