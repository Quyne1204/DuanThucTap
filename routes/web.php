<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\BookController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category-{id}-{slug}', [HomeController::class, 'category'])->name('cate.load');
Route::get('/author-{key}-{slug}', [HomeController::class, 'author'])->name('author.load');

//Show BOOK
Route::get('/books', [BookController::class, 'index'])->name('book.load');
Route::get('/book-detail/{id}', [BookController::class, 'bookDetail'])->name('book.detail');


// User login
Route::get('/signin', [ClientUserController::class, 'signin'])->name('signin');
Route::post('/signin', [ClientUserController::class, 'signinPost'])->name('signin.post');
Route::get('/signup', [ClientUserController::class, 'signup'])->name('signup');
Route::post('/signup', [ClientUserController::class, 'signupPost'])->name('signup.post');
Route::get('/logout', [ClientUserController::class, 'logout'])->name('logout');

route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart', [CartController::class, 'store'])->name('client.carts.add');
    Route::get('/deleteCart/{id}', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::get('/deleteCart', [CartController::class, 'deleteCartAll'])->name('cart.delete.all');
    Route::put('/updateCart/{id}', [CartController::class, 'updateCart'])->name('cart.updateCart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/thank', [CartController::class, 'thank'])->name('thank');
    Route::post('/process-payment', [CartController::class, 'processCheckout'])->name('checkout.proccess');
    Route::post('/VNPayMent', [CartController::class, 'vnpay_payment'])->name('vnpay_payment');

    //review
    Route::match(['get', 'post'], '/post-review', [ReviewController::class, 'postReview'])->name('post.review');

    //view_acc
    Route::get('/view_acc', [ClientUserController::class, 'viewacc'])->name('view.acc');
    Route::get('/view_edit', [ClientUserController::class, 'viewedit'])->name('view.edit');
    Route::post('/view_edit/{id}', [ClientUserController::class, 'vieweditPost'])->name('view.edit.post');
    Route::get('/view_historyOrder', [ClientUserController::class, 'vieworder'])->name('view.his');
    Route::get('/view_historyOrder/{id}', [ClientUserController::class, 'viewhuy'])->name('view.his.huy');
});

// login admin
Route::get('/loginAdmin', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'loginPost'])->name('login.post');
Route::get('/logoutAdmin', [AdminController::class, 'logout'])->name('logoutAdmin');

////Admin
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', function () {
        return view('HomeDashboard');
    })->name('homeadmin');
    //Category
    Route::get('/category-list', [CategoryController::class, 'index'])->name('cate.list');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('cate.create');
    Route::post('/category-create', [CategoryController::class, 'createPost'])->name('cate.create.post');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('cate.edit');
    Route::post('/category-edit/{id}', [CategoryController::class, 'editPost'])->name('cate.edit.post');
    Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])->name('cate.delete');

    //Book
    Route::get('/Book-list', [ProductController::class, 'index'])->name('book.list');
    Route::get('/Book-show/{id}', [ProductController::class, 'show'])->name('book.show');
    Route::get('/Book-create', [ProductController::class, 'create'])->name('book.create');
    Route::post('/Book-create', [ProductController::class, 'createPost'])->name('book.create.post');
    Route::get('/Book-edit/{id}', [ProductController::class, 'edit'])->name('book.edit');
    Route::post('/Book-edit/{id}', [ProductController::class, 'editPost'])->name('book.edit.post');
    Route::get('/Book-delete/{id}', [ProductController::class, 'delete'])->name('book.delete');

    //User
    Route::get('/User-list', [UserController::class, 'index'])->name('user.list');
    Route::get('/User-show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/User-create', [UserController::class, 'create'])->name('user.create');
    Route::post('/User-create', [UserController::class, 'createPost'])->name('user.create.post');
    Route::get('/User-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/User-edit/{id}', [UserController::class, 'editPost'])->name('user.edit.post');
    Route::get('/User-delete/{id}', [UserController::class, 'delete'])->name('user.delete');


    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::post('/order/{id}', [OrderController::class, 'edit'])->name('order.index.post');
});
