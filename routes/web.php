<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admin',[AuthenticatedSessionController::class,'showAdminLoginForm'])->name('admin.login-view')->middleware('guest:admin');
Route::post('/admin',[AuthenticatedSessionController::class,'adminLogin'])->name('admin.login');
Route::get('/affiliate',[AuthenticatedSessionController::class,'showAffiliateLoginForm'])->name('affiliate.login-view')->middleware('guest:affiliate');
Route::post('/affiliate',[AuthenticatedSessionController::class,'affiliateLogin'])->name('affiliate.login');

Route::get('/registerAdmin',[RegisteredUserController::class,'registerAdmin'])->name('admin.register-view');
Route::post('/registerAdmin',[RegisteredUserController::class,'storeAdmin'])->name('admin.register');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin/dashboard', [HomeController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/admin/affiliate/create', [HomeController::class, 'affiliateCreate'])->name('affiliateCreate');

    Route::post('/admin/affiliate/store', [HomeController::class, 'affiliateStore'])->name('affiliateStore');
    Route::get('/recharge', [HomeController::class, 'recharge'])->name('recharge');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'adminDestroy'])->name('admin.logout');

});

Route::group(['middleware' => 'affiliate'], function() {

    Route::get('/affiliate/dashboard', [HomeController::class, 'affiliateIndex'])->name('affiliate.dashboard');
    Route::get('/admin/subAffiliate/create', [HomeController::class, 'subAffiliateCreate'])->name('subAffiliateCreate');
    Route::post('/admin/subAffiliate/store', [HomeController::class, 'subAffiliateStore'])->name('subAffiliateStore');
    Route::get('/commission', [HomeController::class, 'commission'])->name('commission');
    Route::post('/affiliate/logout', [AuthenticatedSessionController::class, 'affiliateDestroy'])->name('affiliate.logout');

});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/addMoney', [HomeController::class, 'addMoney'])->name('addMoney');
    Route::post('/storeMoney', [HomeController::class, 'storeMoney'])->name('storeMoney');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/transection', [HomeController::class, 'transection'])->name('transection');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
