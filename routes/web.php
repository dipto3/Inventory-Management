<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\Admin\Auth\AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [App\Http\Controllers\Admin\Auth\AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
    Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::post('/category/update-ordering', 'updateOrdering')->name('category.updateOrdering');
    });
    Route::delete('/product/image/{id}', [App\Http\Controllers\Admin\ProductController::class, 'deleteImage'])->name('product.image.delete');
    Route::resource('brand', App\Http\Controllers\Admin\BrandController::class);
    Route::resource('unit', App\Http\Controllers\Admin\UnitController::class);
    Route::resource('variant', App\Http\Controllers\Admin\VariantController::class);
    Route::get('admin/variants/{variant}/values', [App\Http\Controllers\Admin\VariantController::class, 'getValues']);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('supplier', App\Http\Controllers\Admin\SupplierController::class);
    Route::get('/product-details/{productID}/{variantID}', [App\Http\Controllers\Admin\ProductController::class, 'viewDetails'])->name('view.details');
    Route::get('/expired-products', [App\Http\Controllers\Admin\ProductController::class, 'expiredProducts'])->name('expired.products');

    Route::resource('purchase-order', App\Http\Controllers\Admin\PurchaseOrderController::class);
    Route::get('/insert-table-column', [App\Http\Controllers\Admin\AdminController::class, 'insertData'])->name('insert-data');

    Route::resource('purchase', App\Http\Controllers\Admin\PurchaseController::class);
    Route::get('/create-grn/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'createGrn'])->name('create.grn');
    Route::post('/store-grn/{id}', [App\Http\Controllers\Admin\PurchaseController::class, 'storeGrn'])->name('store.grn');

    Route::post('purchase-payment-store', [App\Http\Controllers\Admin\PurchasePaymentController::class, 'storePayment'])->name('purchase.payment.store');
    Route::get('purchase-payment-view/{id}', [App\Http\Controllers\Admin\PurchasePaymentController::class, 'viewPayment'])->name('purchase.payment.view');

    Route::resource('return-reason', App\Http\Controllers\Admin\ReturnReasonController::class);
});
