<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {

        //start page
        Route::get('dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');


        Route::middleware(['admin_auth'])->group(function(){
                //admin category
                Route::prefix('category')->group(function(){
                    Route::get('list',[CategoryController::class,'list'])->name('category#list');
                    Route::get('category/page',[CategoryController::class,'categoryCreatePage'])->name('category#create');
                    Route::post('create',[CategoryController::class,'create'])->name('createCategory');
                    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
                    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
                    Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
                });

                //admin change password
                Route::prefix('admin')->group(function(){
                    //password
                   Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
                   Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

                   //account detail
                   Route::get('account/detail',[AdminController::class,'accountDetail'])->name('admin#accountDetail');

                   //edit profile
                   Route::get('account/edit',[AdminController::class,'edit'])->name('edit#account');

                   //update profile
                   Route::post('update,{id}',[AdminController::class,'update'])->name('update#account');

                   //admin list
                   Route::get('list',[AdminController::class,'list'])->name('admin#list');

                   //adminDelete
                   Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');

                   //change role
                   Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
                   Route::post('changeRoleFun/{id}',[AdminController::class,'changeRoleFun'])->name('admin#changeRoleFun');
                   Route::get('ajax/change/role',[AdminController::class,'ajaxChangeRole'])->name('admin#ajaxChangeRole');
                });

                //product
                Route::prefix('product')->group(function(){
                   Route::get('list',[ProductController::class,'listPage'])->name('product#listPage');
                   Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
                   Route::post('create',[ProductController::class,'productCreate'])->name('product#create');
                   Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
                   Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
                   Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
                   Route::post('update',[ProductController::class,'update'])->name('product#update');
                });

                //admin control user list
                Route::prefix('user')->group(function(){
                      Route::get('list',[UserController::class,'userList'])->name('admin#userList');
                      Route::get('role/change',[UserController::class,'changeRole'])->name('admin#changeRole');
                      Route::get('contactListPage',[ContactController::class,'contactListPage'])->name('admin#contactListPage');
                      Route::get('contactDelete/{id}',[ContactController::class,'delete'])->name('admin#contactDelete');
                      Route::get('userListEditPage,{id}',[ContactController::class,'userListEditPage'])->name('admin#userListEditPage');
                      Route::post('userListEdit/{id}',[ContactController::class,'userListEdit'])->name('admin#userListEdit');
                      Route::get('userListDelete/{id}',[ContactController::class,'userListDelete'])->name('admin#userListDelete');
                });


                //admin order control
                Route::prefix('order')->group(function(){
                    Route::get('list',[OrderController::class,'list'])->name('admin#orderList');
                    Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
                    Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
                    Route::get('list/Info/{orderCode}',[OrderController::class,'orderListInfo'])->name('admin#orderListInfo');
                 });


        });



    //user
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
       Route::get('home',[UserController::class,'home'])->name('user#home');
       Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
       Route::get('cart/History',[UserController::class,'cartHistory'])->name('user#cartHistory');
       Route::get('contact',[ContactController::class,'contact'])->name('user#contact');
       Route::post('contact',[ContactController::class,'contactData'])->name('user#contactData');

       Route::prefix('password')->group(function(){
        Route::get('passwordChange',[UserController::class,'passwordChangePage'])->name('account#passwordChangePage');
        Route::post('passwordChange',[UserController::class,'passwordChange'])->name('user#changePassword');

       });

       Route::prefix('pizza')->group(function(){
           Route::get('detail/{id}',[UserController::class,'pizzaDetail'])->name('user#pizzaDetail');
       });


       Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
       });

       Route::prefix('account')->group(function(){
        Route::get('accountPage',[UserController::class,'accountDetailPage'])->name('account#detailPage');
        Route::post('accountEdit/{id}',[UserController::class,'accountEdit'])->name('user#accountEdit');
       });

       Route::prefix('ajax')->group(function(){
        Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
        Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
        Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
        Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#cartClear');
        Route::get('clear/btnCart',[AjaxController::class,'clearBtnCart'])->name('ajax#cartBtnClear');
        Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('user#increaseViewCount');
       });
    });

});

//pizza order system

// Route::get('login',function(){
//     return view('login');
// });

// Route::get('register',function(){
// return view('register');
// });

//login,register
Route::middleware(['admin_auth'])->group(function(){
         Route::redirect('/', 'loginPage');
            Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
            Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});

