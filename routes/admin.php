<?php


use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\FlashSaleController;

/** Admin Routes */
Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');

#profile routes
Route::get('profile',[profileController::class,'index'])->name('profile');
Route::post('profile/update',[profileController::class,'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[profileController::class,'updatePassword'])->name('password.update');
//Route::delete('slider/{slider}', [SliderController::class, 'destroy'])->name('slider.destroy');

/** slider route */
Route::resource('slider', SliderController::class);

/** Category route */
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);
/**Sub Category route */
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);
/**child Category route */
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

/**Brand routes */
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

/**Vendor Profile routes */
Route::resource('vendor-profile', AdminVendorProfileController::class);

/**Product routes */
Route::get('product/get-subcategories',[ProductController::class,'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories',[ProductController::class,'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);

/** Products image gallery route */
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/** Products variant route */
Route::put('brand/change-status/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

/** Products variant item route */
Route::get('products-variant-item/{productId}/{variantId}',[ProductVariantItemController::class, 'index'])->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}',[ProductVariantItemController::class, 'create'])->name('products-variant-item.create');

Route::post('products-variant-item',[ProductVariantItemController::class, 'store'])->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}',[ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}',[ProductVariantItemController::class, 'update'])->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}',[ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

Route::put('products-variant-item-status',[ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');

/** Seller Product routes */

Route::get('seller-products',[SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products',[SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

/** Flash Sale Routes */
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/status-change', [FlashSaleController::class, 'chageShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-status');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destory'])->name('flash-sale.destory');
