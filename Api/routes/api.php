<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\MainController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\PurchaseController;

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

// user creation when register
Route::post('/users/create',[UserController::class,'store']); 
// get user status before login
Route::get('/user/status/{email}',[UserController::class,'getStatus']);
//get admin role id
Route::get('/AdminRole',[UserController::class,'getAdminRole']);
// Send contact mail 
Route::post('/mail',[ContactController::class,'store']);

Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::resource('/users',UserController::class);
    //show products cards
    Route::get('/products',[MainController::class,'index']);

    // product resources
    Route::resource('/product',ProductController::class);

    //user enable and disable
    Route::post('/user/enable/{user}',[UserController::class,'enableUser']);
    Route::post('/user/disable/{user}',[UserController::class,'disableUser']);
    
    //manipulating purchases
    Route::post('/purchase/{product}',[PurchaseController::class,'store']);
    Route::put('/purchase/quantity/{product}',[PurchaseController::class,'updateCount']);
    Route::put('/purchase/quantityReduce/{product}',[PurchaseController::class,'minusCount']);
    Route::get('/purchase/cart',[PurchaseController::class,'index']);
    Route::delete('/purchase/delete/{purchase}/product/{product}',[PurchaseController::class,'destroy']);

    //products count
    Route::get('/purchase/count/{product}',[PurchaseController::class,'countProduct']);
    //managing comments
    Route::post('/comment/{product}',[CommentController::class,'store']);
    Route::get('/comments',[CommentController::class,'index']);

    // get sum of products in a cart
    Route::get('/cart/sumProducts',[PurchaseController::class,'sumProductsPrice']);
    // showing all categories
    Route::get('/categories',[MainController::class,'showCategories']);

    
});
