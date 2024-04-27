<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ActiveController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SiteSettingController;


use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;

use App\Http\Controllers\User\WishlsitController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\ReviewController;


use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SocialiteController;



Route::get('/', function () {
    return view('frontend.index');
});


// Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->middleware(['auth', 'verified'])->name('dashboard');



    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';


    //User Middleware Start

    Route::middleware(['auth'])->group(function(){
        Route::get('/dashboard',[UserController::class, 'Dashboard'])->name('dashboard');
        Route::post('/user/profile/store',[UserController::class, 'UserProfileStore'])->name('user.profile.store');
        Route::get('/user/logout',[UserController::class, 'UserDestroy'])->name('user.logout');
        Route::post('/user/password/store',[UserController::class, 'UserPasswordChange'])->name('user.password.change');


    });//User Middleware End

    //Admin Middleware Start

    Route::middleware(['auth','role:admin'])->group(function(){

        Route::get('/admin/dashboard', [AdminController::class,'AdminDashboard'])->name('admin.dashboard');
        Route::get('/admin/logout', [AdminController::class,'AdminDestroy'])->name('admin.logout');
        Route::get('/admin/profile', [AdminController::class,'AdminProfile'])->name('admin.profile');
        Route::post('/admin/profile.store', [AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
        Route::get('/admin/password', [AdminController::class,'AdminPassword'])->name('admin.password');
        Route::post('/admin/password.change', [AdminController::class,'AdminPasswordChange'])->name('admin.password.change');


    });//admin middleware end


//Vendor Middleware Start

Route::middleware(['auth','role:vendor'])->group(function(){

    Route::get('/vendor/dashboard', [VendorController::class,'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class,'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class,'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile.store', [VendorController::class,'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/password', [VendorController::class,'VendorPassword'])->name('vendor.password');
    Route::post('/vendor/password.change', [VendorController::class,'VendorPasswordChange'])->name('vendor.password.change');



    /// Vendor Product Controller Start Here


    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/vendor/all/product','VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product','VendorAddProduct')->name('vendor.add.product');
        Route::post('/vendor/store/product','VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}','VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/product/update','VendorProductUpdate')->name('vendor.product.update');
        Route::post('/vendor/update/product/thumbnail','VendorUpdateThumbnail')->name('vendor.update.product.thumbnail');
        Route::post('/vendor/update/product/multiimage','VendorUpdateMultiImage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/multiimage/delete/{id}','VendorMultiImageDelete')->name('vendor.multiimage.delete');
        Route::get('/vendor/product/inactive/{id}','VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}','VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}','VendorProductDelete')->name('vendor.delete.product');


        //Vendor subcategory Ajax route
        Route::get('/vendor/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');

    });//end Vendor Product Controller


    /// Vendor Order Controller Start Here

    Route::controller(VendorOrderController::class)->group(function(){
        Route::get('/vendor/order','VendorOrder')->name('vendor.order');


    });//end Vendor Order Controller



});//vendor middleware end



Route::get('/admin/login', [AdminController::class,'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class,'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class,'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class,'VendorRegister'])->name('vendor.register');




// Start Admin Group Controller
Route::middleware(['auth','role:admin'])->group(function(){

    //Brand Controller
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand','AllBrand')->name('all.brand');
        Route::get('/add/brand','AddBrand')->name('add.brand');
        Route::post('/store/brand','StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
        Route::post('/update/brand','UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}','DeleteBrand')->name('delete.brand');


    });//end Brand Controller



    //CategoryController

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/store/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','Editcategory')->name('edit.category');
        Route::post('/update/category','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');


    });//end CategoryController


    //SubCategory Controller

    Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');

        //subcategory Ajax route
        Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');


    });//end SubCategoryController


    //Active Inactive Vendor in AdminController

    Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}','InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve','ActiveVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}','ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve','InactiveVendorApprove')->name('inactive.vendor.approve');



    });//end Active Inactive Vendor in AdminController


    //ProductController Controller start
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product','AllProduct')->name('all.product');
        Route::get('/add/product','AddProduct')->name('add.product');
        Route::post('/store/product','StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}','EditProduct')->name('edit.product');
        Route::post('/store/product/update','StoreProductUpdate')->name('store.product.update');
        Route::post('/update/product/thumbnail','UpdateProductThumbnail')->name('update.product.thumbnail');
        Route::post('/update/product/multiimage','UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimage/delete/{id}','MultiImageDelete')->name('product.multiimage.delete');
        Route::get('/product/inactive/{id}','ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}','ProductActive')->name('product.active');
        Route::get('/delete/product/{id}','ProductDelete')->name('delete.product');


        // Product Stock
        Route::get('/product/stock','StockProduct')->name('product.stock');



    });//end ProductController

    //Start SliderController
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider','AllSlider')->name('all.slider');
        Route::get('/add/slider','AddSlider')->name('add.slider');
        Route::post('/store/slider','StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
        Route::post('/update/slider','UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}','DeleteSlider')->name('delete.slider');


    });//end SliderController

    //Banner Controller Start
    Route::controller(BannerController::class)->group(function(){
        Route::get('/all/banner','AllBanner')->name('all.banner');
        Route::get('/add/banner','AddBanner')->name('add.banner');
        Route::post('/store/banner','StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}','EditBanner')->name('edit.banner');
        Route::post('/update/banner','UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}','DeleteBanner')->name('delete.banner');

    });//end Banner Controller


    //Coupon Controller Start
    Route::controller(CouponController::class)->group(function(){
        Route::get('/all/coupon','AllCoupon')->name('all.coupon');
        Route::get('/add/coupon','AddCoupon')->name('add.coupon');
        Route::post('/store/coupon','StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');


    });//end Coupon Controller


    //ShippingAreaController Start
    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/division','AllDivision')->name('all.division');
        Route::get('/add/division' , 'AddDivision')->name('add.division');
        Route::post('/store/division' , 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}' , 'EditDivision')->name('edit.division');
        Route::post('/update/division' , 'UpdateDivision')->name('update.division');
        Route::get('/delete/division/{id}' , 'DeleteDivision')->name('delete.division');

    });//end ShippingAreaController

    //ShippingAreaController Start
    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/district','AllDistrict')->name('all.district');
        Route::get('/add/district' , 'AddDistrict')->name('add.district');
        Route::post('/store/district' , 'StoreDistrict')->name('store.district');
        Route::get('/edit/district/{id}' , 'EditDistrict')->name('edit.district');
        Route::post('/update/district' , 'UpdateDistrict')->name('update.district');
        Route::get('/delete/district/{id}' , 'DeleteDistrict')->name('delete.district');

    });//end ShippingAreaController

    //ShippingAreaController Start
    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/state','AllState')->name('all.state');
        Route::get('/add/state' , 'AddState')->name('add.state');
        Route::post('/store/state' , 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}' , 'EditState')->name('edit.state');
        Route::post('/update/state' , 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}' , 'DeleteState')->name('delete.state');

    });//end ShippingAreaController

    //Admin OrderController Start
    Route::controller(OrderController::class)->group(function(){
        Route::get('/pending/order','PandingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}','AdminOrderDetails')->name('admin.order.details');
        Route::get('/admin/confirmed/order','AdminConfirmOrder')->name('admin.confirmed.order');
        Route::get('/admin/procecing/order','AdminProcecingOrder')->name('admin.procecing.order');
        Route::get('/admin/deliver/order','AdminDeliverOrder')->name('admin.deliver.order');

        Route::get('/pending/confirm/{order_id}','PandingToConfirm')->name('pending-confirm');
        Route::get('/confirm/procecing/{order_id}','ConfirmToProcecing')->name('confirm-procecing');
        Route::get('/procecing/delivered/{order_id}','ProcecingToDelivered')->name('procecing-delivered');
        Route::get('/admin/invoice/download/{order_id}','AdminInvoiceDownload')->name('admin.invoice-download');


    });//end Admin OrderController

    //Admin ReturnController Start
    Route::controller(ReturnController::class)->group(function(){
        Route::get('/return/request','ReturnRequest')->name('return.request');
        Route::get('/return/request/success/{order_id}','ReturnRequestSuccess')->name('return.request.success');
        Route::get('/complete/return/request','ReturnRequestComplete')->name('complete.return.request');



    });//end Admin ReturnController


    //Admin ReportController Start
    Route::controller(ReportController::class)->group(function(){

        Route::get('/report/view','ReportView')->name('report.view');
        Route::post('/search/by/date','SearchByDate')->name('search-by-date');
        Route::post('/search/by/month','SearchByMonth')->name('search-by-month');
        Route::post('/search/by/year','SearchByYear')->name('search-by-year');
        Route::get('/user/report','UserReport')->name('user.report');
        Route::post('/user/by/report','UserByReport')->name('user-by-report');

    });//end Admin ReportController


    //Admin ActiveController Start
    Route::controller(ActiveController::class)->group(function(){

        Route::get('/all/user','AllUser')->name('all.user');

    });//end Admin ActiveController


    //Admin BlogController Start
    Route::controller(BlogController::class)->group(function(){

        Route::get('/all/blog/category','AllBlogCategory')->name('all.blog.category');
        Route::get('/add/blog/category','AddBlogCategory')->name('add.blog.category');
        Route::post('/store/blog/category','StoreBlogCategory')->name('store.blog.category');
        Route::get('/edit/blog/category/{id}','EditBlogCategory')->name('edit.blog.category');
        Route::post('/update/blog/category','UpdateBlogCategory')->name('update.Blog.category');
        Route::get('/delete/blog/category/{id}','DeleteBlogCategory')->name('delete.blog.category');

    });//end Admin BlogController


    //Admin Blog Post in BlogController Start
    Route::controller(BlogController::class)->group(function(){

        Route::get('/all/blog/post','AllBlogPost')->name('all.blog.post');
        Route::get('/add/blog/post','AddBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post','StoreBlogPost')->name('store.blog.post');
        Route::get('/edit/blog/post/{id}','EditBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post','UpdateBlogPost')->name('update.blog.post');
        Route::get('/delete/blog/post/{id}','DeleteBlogPost')->name('delete.blog.post');

    });//end Admin Blog Post BlogController


    // ReviewController Start
    Route::controller(ReviewController::class)->group(function(){

        Route::get('/panding/review','PandingReview')->name('panding.review');
        Route::get('/approve/review/{id}','ApproveReview')->name('approve.review');
        Route::get('/publish/review','PublishReview')->name('publish.review');
        Route::get('/delete/review/{id}','DeleteReview')->name('delete.review');


    });//end  ReviewController


    // SiteSettingController Start
    Route::controller(SiteSettingController::class)->group(function(){

        Route::get('/site/setting','SiteSetting')->name('site.setting');
        Route::post('/site/setting/store','StoreSiteSetting')->name('site.setting.store');


    });//end  SiteSettingController

    // Seo  Start Start Here
     Route::controller(SiteSettingController::class)->group(function(){

        Route::get('/seo/setting','SeoSetting')->name('seo.setting');
        Route::post('/seo/update/store','SeoUpdateStore')->name('seo.update.store');

    });//Seo end Start Here



});// Ends Admin Group Controller



// Frontend Related Product Details All Route

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);

Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);


// product view ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// Add To Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// add to mini cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);

// mini cart remove
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'MiniCartRemove']);


// product details addToCart
Route::post('/dcart/data/store/{id}', [CartController::class, 'ProductDetailsAddtoCart']);

// product details addToCart
Route::post('/add-to-wishlist/{product_id}', [WishlsitController::class, 'AddToWishlist']);

// product details addToCart
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);




/// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);


// Check Out page
Route::get('/check/out', [CartController::class, 'CheckOut'])->name('check.out');



//Cart Controller Start
Route::controller(CartController::class)->group(function(){
    Route::get('/mycart','MyCart')->name('mycart');
    Route::get('/get-cart-product','GetCartProduct');
    Route::get('/cart-remove/{rowId}','CartRemove');


    Route::get('/cart-decrement/{rowId}','CartDecrement');
    Route::get('/cart-increment/{rowId}','CartIncrement');


});//end Cart Controller

//frontend Blog Post in BlogController Start
Route::controller(BlogController::class)->group(function(){

    Route::get('/home/blog','HomeBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}' , 'BlogDetails');
    Route::get('/blog/category/slug/{id}/{slug}' , 'BlogCategory');

});//end Frontend Blog Post BlogController


//frontend ReviewController Start
Route::controller(ReviewController::class)->group(function(){

    Route::post('/store/review','StoreReview')->name('store.review');


});//end Frontend ReviewController


// Search All Route
Route::controller(IndexController::class)->group(function(){

    Route::post('/search' , 'ProductSearch')->name('product.search');
    Route::post('/search-product' , 'SearchProduct');

   });





// Start User Group Controller
Route::middleware(['auth','role:user'])->group(function(){

    //WishlsitController Start
    Route::controller(WishlsitController::class)->group(function(){
        Route::get('/wishlist','AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product' , 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}' , 'WishlistProductRemove');

    });//end WishlsitController


    //CompareController Start
    Route::controller(CompareController::class)->group(function(){
        Route::get('/compare','AllCompare')->name('compare');
        Route::get('/get-compare-product' , 'GetCompareProduct');
        Route::get('/compare-remove/{id}' , 'CompareProductRemove');

    });//end CompareController


    //CheckOutController Start
    Route::controller(CheckOutController::class)->group(function(){
        Route::get('/division-get/ajax/{division_id}','GetDivision');
        Route::get('/district-get/ajax/{district_id}','GetDistrict');


        Route::post('/store/checkout','StoreCheckOut')->name('store.checkout');

        //cash order page
        Route::post('/cash/order' , 'CashOrder')->name('cash.order');


    });//end CheckOutController

    //AllUserController Start
    Route::controller(AllUserController::class)->group(function(){
        Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
        Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');
        Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');

        Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');
        Route::get('/user/invoice_download/{order_id}' , 'UserInvoiceDownload');
        Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');
        Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');

        // Tracking Order page
        Route::get('/user/tracking/order' , 'UserOrderTracking')->name('user.tracking.order');
        Route::post('/order/track' , 'OrderTrack')->name('order.track');



    });//end AllUserController



});// Ends User Group Controller




// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


// Google Socialite
Route::get('/login/google', [SocialiteController::class, 'RedirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [SocialiteController::class, 'CallbackToGoogle']);


