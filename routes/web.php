<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AuthenticationController;

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

Route::get('/', [StaterkitController::class, 'home'])->name('home');
Route::get('home', [StaterkitController::class, 'home'])->name('home');
Route::get('shop', [StaterkitController::class, 'shop'])->name('shop');
// Route Components
Route::get('layouts/collapsed-menu', [
    StaterkitController::class,
    'collapsed_menu',
])->name('collapsed-menu');
Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name(
    'layout-full'
);
Route::get('layouts/without-menu', [
    StaterkitController::class,
    'without_menu',
])->name('without-menu');
Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name(
    'layout-empty'
);
Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name(
    'layout-blank'
);

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::group(['prefix' => 'app'], function () {
    Route::get('ecommerce/shop', [
        StaterkitController::class,
        'ecommerce_shop',
    ])->name('app-ecommerce-shop');
    Route::get('ecommerce/details/{id}', [
        StaterkitController::class,
        'ecommerce_details',
    ])->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', [
        StaterkitController::class,
        'ecommerce_wishlist',
    ])->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', [
        StaterkitController::class,
        'ecommerce_checkout',
    ])->name('app-ecommerce-checkout');
});
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardsController::class, 'card_basic'])->name(
        'card-basic'
    );
    Route::get('advance', [CardsController::class, 'card_advance'])->name(
        'card-advance'
    );
    Route::get('statistics', [CardsController::class, 'card_statistics'])->name(
        'card-statistics'
    );
    Route::get('analytics', [CardsController::class, 'card_analytics'])->name(
        'card-analytics'
    );
    Route::get('actions', [CardsController::class, 'card_actions'])->name(
        'card-actions'
    );
});
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'table'])->name('table');
    Route::get('datatable/basic', [
        TableController::class,
        'datatable_basic',
    ])->name('datatable-basic');
    Route::get('datatable/advance', [
        TableController::class,
        'datatable_advance',
    ])->name('datatable-advance');
});
Route::get('/app/ecommerce/shop/search', [
    StaterkitController::class,
    'search',
])->name('search');
Route::get('/app/ecommerce/shop/whishlist', [
    StaterkitController::class,
    'whishlist',
])->name('whishlist');
Route::get('/app/ecommerce/wishlist-details', [
    StaterkitController::class,
    'wishlist_details',
])->name('wishlist_details');
Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('postlogin', [AuthenticationController::class, 'postlogin'])->name(
    'postlogin'
);
Route::get('register', [AuthenticationController::class, 'register'])->name(
    'register'
);
Route::post('postsignup', [
    AuthenticationController::class,
    'postsignup',
])->name('postsignup');
Route::get('signout', [AuthenticationController::class, 'signOut'])->name(
    'signout'
);
