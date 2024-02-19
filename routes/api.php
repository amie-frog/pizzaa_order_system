<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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
//get
Route::get('product/list',[RouteController::class,'productList']);//read
Route::get('category',[RouteController::class,'category']);
Route::get('category/list',[RouteController::class,'categoryList']);


//post
Route::post('category/create',[RouteController::class,'categoryCreate']);//create
Route::get('category/delete/{id}',[RouteController::class,'categoryDelete']);//delete
// Rote::post('category/delete',[RouteController::class,'categoryDelete']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);//update



/**http://127.0.0.1:8000/api/category/list[get]//read
 * 
 *http://127.0.0.1:8000/api/category/create[post]//create
 body{
    'name' :
 }
 *http://127.0.0.1:8000/api/category/update[post]//update
 *key=>name,category_id
 *
 *
 *
 *http://127.0.0.1:8000/api/category/delete/5[get]//delete
 http://127.0.0.1:8000/api/category/delete[post]//delete
 *
 *
 *
 *
 *
 *
 */
