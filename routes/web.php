<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\MediaAjaxController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\Front\StreamingController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();


Route::group(['middleware' => 'admin_auth','as' => 'admin.','prefix'=>'admin'],function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('services',ServiceController::class);
    Route::resource('media-lists',MediaAjaxController::class);
    Route::resource('projects',ProjectController::class);
    Route::resource('coupons',CouponController::class);
    Route::resource('orders',OrderController::class);
    Route::resource('categories',CategoryController::class);
    Route::get('child_categories/{id}',[CategoryController::class,'child_categories'])->name('categories.child_categories');
    Route::resource('applications',ApplicationController::class);
    Route::get('applications/by_categories/{main_category_id}/{child_category_id?}',[ApplicationController::class,'applications_by_categories']);
    Route::resource('services-orders',ServiceOrderController::class);
    Route::resource('customers',CustomerController::class);
    Route::resource('discussions',DiscussionController::class);
    Route::resource('proposals',ProposalController::class);
    Route::get('customers/services-orders/{id}' ,[CustomerController::class,'services_orders'])->name('customers.services-orders');
    Route::get('customers/products-orders/{id}',[CustomerController::class,'products_orders'])->name('customers.products-orders');
    Route::resource('payments',PaymentController::class);
    Route::resource('reviews',ReviewController::class);
    Route::group(['as' => 'settings.'],function(){
        Route::resource('pages'   ,PageController::class);
    });

    Route::controller(SettingController::class)->group(function(){
        Route::get('settings/general' ,'settings_general')->name('settings.general');
        Route::post('settings/general/store','save_general_setting')->name('settings.general.store');
        Route::get('settings/payments','settings_payments')->name('settings.payments');
        Route::post('settings/payments/store','save_settings_payments')->name('settings.payments.store');
    });

    Route::delete('medias/delete-all',[MediaController::class,'delete_all'])->name('medias.delete_all');
    Route::resource('medias',MediaController::class);
});

Route::get('/search',[ServiceController::class, 'search'])->name('search');
Route::get('/filter',[ServiceController::class, 'filter'])->name('filter');


Route::get('/',[FrontController::class,'index'])->name('home');
Route::get('/projects',[FrontController::class,'projects_show'])->name('projects_show');
Route::get('/project/{slug}',[FrontController::class,'single_project'])->name('single_project');
Route::get('/services',[FrontController::class,'services'])->name('services');
Route::get('/service/{slug}',[FrontController::class,'single_service'])->name('single_service');
Route::get('/contact-us',[FrontController::class,'contact_us'])->name('contact-us');

Route::group(['middleware' => ['auth','verified']],function(){
    Route::get('/application-form/{application_id}/{selected_id}/{selected}',[FrontController::class,'application_form'])->name('application_form');
    Route::post('application-submit/{application_id}/{selected_id}/{selected}',[FrontController::class,'application_submit'])->name('application-submit');

    Route::get('my-account',[FrontController::class,'my_account'])->name('my-account');
    Route::get('my-orders',[FrontController::class,'my_orders'])->name('my-orders');
    Route::get('my-payments',[FrontController::class,'my_payments'])->name('my-payments');
    Route::get('order-single/{order_id}/{section?}',[FrontController::class,'single_order'])->name('order-single');
    Route::post('accept-proposal/{proposal_id}',[FrontController::class,'accept_proposal'])->name('accept-proposal');
    Route::post('refuse-proposal/{proposal_id}',[FrontController::class,'refuse_proposal'])->name('refuse-proposal');
    Route::get('setting-account',[FrontController::class,'setting_account'])->name('setting-account');
    Route::post('update-account',[FrontController::class,'update_account'])->name('update-account');
    Route::post('send-message',[FrontController::class,'send_message'])->name('send_message');
});

Route::get('ajax-paginate-review-lists',[FrontController::class,'ajax_paginate_review_lists'])->name('ajax-paginate-review-lists');
Route::post('send-email',[FrontController::class,'post_contact_us'])->name('send-email');
Route::post('send-news-letter',[FrontController::class,'post_news_letter'])->name('send-news-letter');

Route::get('search-ajax',[FrontController::class,'search_ajax'])->name('search-ajax');
Route::get('search',[FrontController::class,'search'])->name('search');

Route::post('ajax-apply-coupon',[FrontController::class,'ajax_apply_coupon'])->name('ajax-apply-coupon');

Route::get('generate/sitemap',[FrontController::class,'generate_sitemap']);

Route::get('/{slug}',[FrontController::class,'custom_page']);

// Route::get('test-more',function(){
    
// });


