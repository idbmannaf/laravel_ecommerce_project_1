<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\testControl\testControl;
use App\Http\Controllers\testController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('home/add/user', [App\Http\Controllers\HomeController::class, 'insert_user']);
Route::get('download/invoice/{order_id}', [App\Http\Controllers\HomeController::class, 'download_invoice']);

Route::get('test', [testController::class, 'Test']);
Route::get('testc', [App\Http\Controllers\testControl\testControl::class,'testControl']); // From Folder to Folder
Route::get('about', [FontendController::class,'About']);
Route::get('contact', [FontendController::class,'Contact']);
Route::get('protfolio', [FontendController::class,'Portfolio']);
Route::get('category',[CategoryController::class, 'index']);
Route::post('category/insert',[CategoryController::class, 'insert']); // for insert Category Item
Route::get('category/del/{catId}', [CategoryController::class, 'delete']); //Delete Category
Route::get('category/edit/{catId}', [CategoryController::class, 'edit']); //Edit Category
Route::post('category/update', [CategoryController::class, 'update']); //Edit Category


Route::get('catpractice', [App\Http\Controllers\CatPracticeController::class, 'index']);
Route::post('catpractice/insert', [App\Http\Controllers\CatPracticeController::class, 'insert']);

Route::get('subcategory',[SubCategoryController::class,'index'] );
Route::POST('subcategory/insert',[SubCategoryController::class,'insert'] );
Route::get('subcategory/del/{del}',[SubCategoryController::class,'delete'] );
Route::get('subcategory/edit/{edit}',[SubCategoryController::class,'edit'] );
Route::post('subcategory/update',[SubCategoryController::class,'update'] );
Route::get('subcategory/restore/{restore}',[SubCategoryController::class,'restore'] );
Route::get('subcategory/pdelete/{pdelete}',[SubCategoryController::class,'permanenetDelete'] );
Route::post('subcategory/mark/delete',[SubCategoryController::class,'markDelete'] );

//Send mail Admin
Route::get('mail',[FontendController::class,'mailmenu']);
// Profile
Route::get('profile', [ProfileController::class,'Profile']);
Route::get('profile/editprofile', [ProfileController::class,'editprofile']);
Route::post('profile/update', [ProfileController::class,'update']);
Route::post('profile/password/change', [ProfileController::class,'passwordChange']);
Route::post('profile/photo/change', [ProfileController::class,'imageChange']);


//Product
Route::get('product', [ProductController::class,'Product']);
Route::post('product/insert', [ProductController::class,'insert']);
Route::get('product/del/{del}', [ProductController::class,'softdelete']);

//Font End Design
Route::get('/', [App\Http\Controllers\FontendController::class, 'index']);
Route::get('product/details/{detailsid}', [FontendController::class,'product_details']);
Route::get('testimonial', [FontendController::class,'testimonialIndex']);
Route::post('testmonial/insert', [FontendController::class,'testimonialInsert']);
Route::get('myorder', [FontendController::class,'myorder']);
//Download Secthon
Route::get('download/invoices/{order_id}', [FontendController::class, 'download_invoice']);
Route::get('send/invoices/{order_id}', [FontendController::class, 'send_mail_invoice']);
Route::post('send/email', [FontendController::class, 'sendemail']);

//Search
Route::get('search', [FontendController::class,'search']);

//Shop

Route::get('shop', [FontendController::class,'shop']);
Route::get('shop/category/{category_id}', [FontendController::class,'shop_category']);
Route::post('add/cart/', [CartController::class,'addToCart']);
Route::get('cart/delete/{cart_id}',[CartController::class,'deletecart']);
Route::get('cart',[CartController::class,'cart']);
Route::post('cart/update/qty/',[CartController::class,'updatequantity']);
Route::get('cart/{coupon_code}',[CartController::class,'cart']);  //Coupon


//Coupon
Route::get('coupon',[CouponController::class,'index']);
Route::post('coupon/insert',[CouponController::class,'insert'])->name('insertCoupon');
Route::get('coupon/delete/{copun_id}',[CouponController::class,'delete_coupon']);

// Email verify
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Checkout
Route::get('checkout',[CartController::class,'checkout'])->middleware('verified');

//Using Ajax request start
Route::post('/getCityList',[CartController::class,'getCityList']);
//Using Ajax request start

//Order
Route::post('order',[CartController::class,'order']);


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/online/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


//Wishlist
Route::get('wishlist/add/{produc_id}',[WishlistController::class,'add_wishlist']);
Route::get('wishlist/',[WishlistController::class,'index']);
Route::get('wishlist/delete/{product_id}',[WishlistController::class,'delete_wishlist']);
