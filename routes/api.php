<?php

use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\ShoppingItemController;
use App\Http\Controllers\Api\ShoppingListController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::any('dist', [\App\Http\Controllers\Api\DistanceController::class, 'dist']);

Route::prefix('users')->name('users.')->group(function () {
    Route::post('token', [UserController::class, 'token'])->name('token');

    Route::get('', [UserController::class, 'index'])->name('index');
    Route::post('', [UserController::class, 'create'])->name('create');

    Route::get('{user}', [UserController::class, 'read'])->name('read');
    Route::put('{user}', [UserController::class, 'update'])->name('update');
    Route::delete('{user}', [UserController::class, 'delete'])->name('delete');
});

Route::prefix('consumers')->name('consumers.')->group(function () {
    Route::get('', [ConsumerController::class, 'index'])->name('index');
    Route::post('', [ConsumerController::class, 'create'])->name('create');

    Route::get('{consumer}', [ConsumerController::class, 'read'])->name('read');
    Route::put('{consumer}', [ConsumerController::class, 'update'])->name('update');
    Route::delete('{consumer}', [ConsumerController::class, 'delete'])->name('delete');
});

Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::get('', [JobController::class, 'index'])->name('index');
    Route::post('', [JobController::class, 'create'])->name('create');

    Route::get('{job}', [JobController::class, 'read'])->name('read');
    Route::put('{job}', [JobController::class, 'update'])->name('update');
    Route::delete('{job}', [JobController::class, 'delete'])->name('delete');
});

Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::post('', [ProductController::class, 'create'])->name('create');

    Route::get('{product}', [ProductController::class, 'read'])->name('read');
    Route::put('{product}', [ProductController::class, 'update'])->name('update');
    Route::delete('{product}', [ProductController::class, 'delete'])->name('delete');
});

Route::prefix('shops')->name('shops.')->group(function () {
    Route::get('', [ShopController::class, 'index'])->name('index');
    Route::post('', [ShopController::class, 'create'])->name('create');

    Route::get('{shop}', [ShopController::class, 'read'])->name('read');
    Route::put('{shop}', [ShopController::class, 'update'])->name('update');
    Route::delete('{shop}', [ShopController::class, 'delete'])->name('delete');
});

Route::prefix('shopping-items')->name('shopping-items.')->group(function () {
    Route::get('', [ShoppingItemController::class, 'index'])->name('index');
    Route::post('', [ShoppingItemController::class, 'create'])->name('create');

    Route::get('{shoppingItem}', [ShoppingItemController::class, 'read'])->name('read');
    Route::put('{shoppingItem}', [ShoppingItemController::class, 'update'])->name('update');
    Route::delete('{shoppingItem}', [ShoppingItemController::class, 'delete'])->name('delete');
});

Route::prefix('shopping-lists')->name('shopping-lists.')->group(function () {
    Route::get('', [ShoppingListController::class, 'index'])->name('index');
    Route::post('', [ShoppingListController::class, 'create'])->name('create');

    Route::get('{shoppingList}', [ShoppingListController::class, 'read'])->name('read');
    Route::put('{shoppingList}', [ShoppingListController::class, 'update'])->name('update');
    Route::delete('{shoppingList}', [ShoppingListController::class, 'delete'])->name('delete');
});

Route::prefix('suppliers')->name('suppliers.')->group(function () {
    Route::get('', [SupplierController::class, 'index'])->name('index');
    Route::post('', [SupplierController::class, 'create'])->name('create');

    Route::get('{supplier}', [SupplierController::class, 'read'])->name('read');
    Route::put('{supplier}', [SupplierController::class, 'update'])->name('update');
    Route::delete('{supplier}', [SupplierController::class, 'delete'])->name('delete');
});
