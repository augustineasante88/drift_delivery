<?php

use App\Http\Controllers\FrontendController;
use App\Http\Livewire\Admin\BikersPage;
use App\Http\Livewire\Admin\FoodCategories;
use App\Http\Livewire\Admin\FoodCentres;
use App\Http\Livewire\Admin\FoodOrders;
use App\Http\Livewire\Admin\Foods;
use App\Http\Livewire\Admin\Hostels;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\User\Restaurants;
use App\Models\FoodCentre;
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

// Route::get('/', function () {
//     $foodCenters = FoodCentre::all();
//     //dd($foodCenters);
//     return view('new-home', compact('foodCenters'));
// });

Route::get('/', [FrontendController::class, 'index'])->name('home-index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
    // admin routes
Route::middleware(['isStaff', 'isAdmin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/food-centres', FoodCentres::class)->name('food-centres');
    Route::get('/food-category', FoodCategories::class)->name('food-category');
    Route::get('/food-orders', FoodOrders::class)->name('food-orders');
    Route::get('/foods', Foods::class)->name('foods');
    Route::get('/users', Users::class)->name('users');
    Route::get('/hostels', Hostels::class)->name('hostels');
});

// user routes
    Route::get('/orders', [FrontendController::class, 'getOrders'])->name('orders');
    Route::get('/orders-history', [FrontendController::class, 'getOrdersHistory'])->name('ordersHistory');
    Route::get('/profile', [FrontendController::class, 'getProfile'])->name('profile');
    Route::get('/user-dashboard', [FrontendController::class, 'getUserDashboard'])->name('userDashboard');
    Route::put('/update_profile/{user}', [FrontendController::class, 'updateProfile'])->name('update_profile');
    Route::put('/update_password/{user}', [FrontendController::class, 'updatePassword'])->name('update_password');
});

Route::get('/locations', [FrontendController::class, 'getLocations'])->name('locations');
Route::get('/bikers', BikersPage::class)->name('bikers');
Route::get('/details/{center:slug}', [FrontendController::class, 'getDetails'])->name('details');
Route::get('/checkout', [FrontendController::class, 'getCheckout'])->name('checkout');
Route::get('/thank-you', [FrontendController::class, 'getThankYouPage'])->name('thanks');
Route::get('/bikers-info', [FrontendController::class, 'getBikers'])->name('bikersInfo');
Route::get('/eating-places', [FrontendController::class, 'getEatingPlaces'])->name('eatingPlaces');
// Route::get('/places', Restaurants::class)->name('places');

Route::get('auth/google', [FrontendController::class, 'redirect'])->name('goodle-auth-redirect');
Route::get('auth/google/call-back', [FrontendController::class, 'googleCallback']);

