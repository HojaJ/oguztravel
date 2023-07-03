<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\TurkmenistanController;
use App\Http\Controllers\Front\WebController;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\Panel\AboutController;
use App\Http\Controllers\Panel\AboutImageController;
use App\Http\Controllers\Panel\BannerController;
use App\Http\Controllers\Panel\BirthdayController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\ClientController;
use App\Http\Controllers\Panel\ContactController;
use App\Http\Controllers\Panel\CountryController;
use App\Http\Controllers\Panel\CoverController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\MessageController;
use App\Http\Controllers\Panel\ServiceController;
use App\Http\Controllers\Panel\ServiceRequestController;
use App\Http\Controllers\Panel\SubjectController;
use App\Http\Controllers\Panel\TourController;
use App\Http\Controllers\Panel\TourImageController;
use App\Http\Controllers\Panel\TourRequestController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', [WebController::class, 'index'])->name('index');

        Route::get('services', [App\Http\Controllers\Front\ServiceController::class, 'index'])->name('services.index');
        Route::get('services/{service:slug}', [App\Http\Controllers\Front\ServiceController::class, 'show'])->name('services.show');
        Route::post('services/{service:slug}', [App\Http\Controllers\Front\ServiceController::class, 'store'])->name('services.store');
        Route::get('contacts', [App\Http\Controllers\Front\ContactController::class, 'index'])->name('contact.index');
        Route::post('contacts/message', [App\Http\Controllers\Front\ContactController::class, 'send'])->name('contact.message');
        Route::get('about', [WebController::class, 'about'])->name('about.index');
        Route::get('turkmenistan', [TurkmenistanController::class, 'index'])->name('turkmenistan.index');
        Route::get('turkmenistan/{tour}', [TurkmenistanController::class, 'show'])->name('turkmenistan.show');
        Route::post('turkmenistan', [App\Http\Controllers\Front\TurkmenistanController::class, 'store'])->name('turkmenistan.store');
        Route::get('tours', [App\Http\Controllers\Front\TourController::class, 'index'])->name('tours.index');
        Route::get('tours/{tour}', [App\Http\Controllers\Front\TourController::class, 'show'])->name('tours.show');
        Route::post('tours', [App\Http\Controllers\Front\TourController::class, 'store'])->name('tours.store');

        Route::prefix('panel')->group(function () {
            Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
            Route::post('login', [LoginController::class, 'login']);

            Route::middleware('auth')->group(function () {
                Route::post('logout', [LoginController::class, 'logout'])->name('logout');

                Route::name('panel.')->group(function () {
                    Route::get('/', [DashboardController::class, 'index'])->name('index');
                    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
                    Route::patch('profile', [DashboardController::class, 'profileUpdate'])->name('profile.update');

                    Route::get('banners/order', [BannerController::class, 'orderForm'])->name('banners.order.form');
                    Route::post('banners/order', [BannerController::class, 'order'])->name('banners.order');
                    Route::resource('banners', BannerController::class)->except('show');

                    Route::resource('about', AboutController::class)->except('show');
                    Route::get('tours_index',[AboutController::class,'tours_index'])->name('tours_index');
                    Route::get('turkmenistan_index',[AboutController::class,'turkmenistan_index'])->name('turkmenistan_index');
                    Route::get('about/{about}/images', [AboutImageController::class, 'create'])->name('about.images.create');
                    Route::post('about/{about}/images', [AboutImageController::class, 'store'])->name('about.images.store');
                    Route::get('about/{about}/order', [AboutImageController::class, 'order'])->name('about.images.order');
                    Route::patch('about/{about}/order', [AboutImageController::class, 'orderUpdate'])->name('about.images.order.update');
                    Route::delete('about/images/{image}', [AboutImageController::class, 'destroy'])->name('about.images.destroy');

                    Route::resource('contact', ContactController::class)->except('show');

                    Route::resource('services', ServiceController::class)->only('index', 'edit', 'update');

                    Route::resource('covers', CoverController::class)->only('index', 'edit', 'update');

                    Route::resource('clients', ClientController::class)->except('show');


                    Route::post('/import',[ClientController::class, 'importClients'])->name('import');
                    Route::get('/export-clients',[ClientController::class, 'exportClients'])->name('export-clients');
                    Route::get('/export-mailchimp',[ClientController::class, 'exportMailchimp'])->name('export-mailchimp');

                    Route::resource('categories', CategoryController::class)->except('show');

                    Route::resource('tours', TourController::class);
                    Route::get('tours/{tour}/images', [TourImageController::class, 'create'])->name('tours.images.create');
                    Route::post('tours/{tour}/images', [TourImageController::class, 'store'])->name('tours.images.store');
                    Route::get('tours/{tour}/order', [TourImageController::class, 'order'])->name('tours.images.order');
                    Route::patch('tours/{tour}/order', [TourImageController::class, 'orderUpdate'])->name('tours.images.order.update');
                    Route::delete('tours/images/{image}', [TourImageController::class, 'destroy'])->name('tours.images.destroy');

                    Route::resource('subjects', SubjectController::class)->except('show');
                    Route::resource('messages', MessageController::class)->only('index', 'show', 'destroy');

                    Route::get('tour_requests', [TourRequestController::class, 'index'])->name('tour_requests.index');
                    Route::get('tour_requests/{tour}', [TourRequestController::class, 'show'])->name('tour_requests.show');
                    Route::delete('tour_requests/{tour}', [TourRequestController::class, 'delete'])->name('tour_requests.destroy');

                    Route::get('service_requests', [ServiceRequestController::class, 'index'])->name('service_requests.index');
                    Route::get('service_requests/{service}', [ServiceRequestController::class, 'show'])->name('service_requests.show');
                    Route::delete('service_requests/{service}', [ServiceRequestController::class, 'delete'])->name('service_requests.destroy');
                    Route::get('service_requests-download-zip-file/{service}/{file_type}', [ServiceRequestController::class, 'downloadZip'])->name('service_requests.download.zip');

                    Route::resource('countries', CountryController::class)->except('show');

                    Route::get('/birthday',[BirthdayController::class,'index'])->name('birthday.index');
                    Route::put('/birthday/{person}',[BirthdayController::class,'send'])->name('birthday.send');

                    Route::post('/mark-as-read', [DashboardController::class, 'markNotification'])->name('admin.markNotification');

                });
            });
        });
    }
);

Route::post('send_api',[GatewayController::class,'send_api']);
Route::post('status_api',[GatewayController::class,'status_api']);