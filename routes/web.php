<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AkademController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\GlavController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;




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

Route::get('/', [GlavController::class, 'index'])->name('glav');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/catalog', [CatalogController::class, 'getProducts'])->name('catalog');
Route::get('/akadem', [AkademController::class, 'index'])->name('akadem');
Route::post('/add-task', [AkademController::class, 'addTask']);
Route::get('/product/{id}', [ProductController::class, 'index'])->name('product');
Route::get('/where', function(){
    return view('where');
})->name('where');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'is-admin'])->group(function() {
    Route::get('/product-create', [ProductController::class, 'createProductView']); #create
    Route::post('/product-create', [ProductController::class, 'createProduct']); #create
    Route::get('/products', [ProductController::class, 'getProducts'])->name('admin.products'); #read
    Route::get('/product-edit/{id}', [ProductController::class, 'getProductById']); #update
    Route::patch('/product-update/{id}', [ProductController::class, 'editProduct']); #update
    Route::delete('/product-delete/{id}', [ProductController::class, 'deleteProduct']); #delete

    Route::get('/category-create', [CategoriesController::class, 'createCategoryView']); #create
    Route::post('/category-create', [CategoriesController::class, 'createCategory']); #create
    Route::get('/categories', [CategoriesController::class, 'getCategories'])->name('admin.categories'); #read
    Route::get('/category-edit/{id}', [CategoriesController::class, 'getCategoryById']); #update
    Route::patch('/category-update/{id}', [CategoriesController::class, 'editCategory']); #update
    Route::delete('/category-delete/{id}', [CategoriesController::class, 'deleteCategory']); #delete

    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'getOrders'])->name('admin.orders'); #Read
    Route::patch('/order-status/{action}/{number}', [App\Http\Controllers\OrderController::class, 'editOrderStatus']); #Update
    Route::patch('/order-cancel/{number}', [App\Http\Controllers\OrderController::class, 'cancelOrder'])->name('admin.orders.cancel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user', [ProfileController::class, 'index'])->name('user');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/changeqty/{param}/{id}', [CartController::class, 'changeQty']);
    Route::get('/create-order', [App\Http\Controllers\OrderController::class, 'index'])->name('create-order');
    Route::post('/create-order', [App\Http\Controllers\OrderController::class, 'createOrder']);
    Route::delete('/order-delete/{number}', [App\Http\Controllers\OrderController::class, 'deleteOrder']);

    Route::get('/send-confirmation-code', [App\Http\Controllers\OrderController::class, 'sendConfirmationCode'])->name('send-confirmation-code');
    Route::post('/verify-confirmation-code', [App\Http\Controllers\OrderController::class, 'verifyConfirmationCode'])->name('verify-confirmation-code');

});

Route::get('/catalog', [CatalogController::class, 'getProducts'])->name('catalog');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');




require __DIR__.'/auth.php';
