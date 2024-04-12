<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
 * Category Routes
 */

Route::prefix('categories')->group(function () {
    Route::get('/', [App\Http\Controllers\CategoryController::class, 'getCategories']);
    Route::get('/leaf', [App\Http\Controllers\CategoryController::class, 'getLeafSubCategories']);
    Route::get('/{id}', [App\Http\Controllers\CategoryController::class, 'getCategory']);
    Route::post('/', [App\Http\Controllers\CategoryController::class, 'storeCategory']);
    Route::post('/{id}', [App\Http\Controllers\CategoryController::class, 'updateCategory']);
    Route::delete('/{id}', [App\Http\Controllers\CategoryController::class, 'destroyCategory']);
});


/*
 * Item Routes
 */
Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'getItems']);
    Route::post('/', [App\Http\Controllers\ItemController::class, 'storeItem']);
    Route::post('/{id}', [App\Http\Controllers\ItemController::class, 'updateItem']);
    Route::delete('/{id}', [App\Http\Controllers\ItemController::class, 'destroyItem']);
});

/*
 * Discount Routes
 */
Route::prefix('discounts')->group(function () {
    Route::get('/', [App\Http\Controllers\DiscountController::class, 'getDiscounts']);
    Route::post('/', [App\Http\Controllers\DiscountController::class, 'storeDiscount']);
    Route::post('/{id}', [App\Http\Controllers\DiscountController::class, 'updateDiscount']);
    Route::delete('/{id}', [App\Http\Controllers\DiscountController::class, 'destroyDiscount']);
});
