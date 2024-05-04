<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MenuLabelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SoftwareSettingsController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\UserThemeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SubcategorieController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PricerangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GuestLoginContoller;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\CupponController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\AddProductToTrendController;
use App\Http\Controllers\GuestOrderController;
use App\Http\Controllers\SliderController;
// fronted 
use App\Http\Controllers\FrontendController;


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

// fronted 
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index');    
    Route::get('/shop', 'shop');
    Route::get('/about', 'about'); 
    Route::get('/contact', 'contact');
    Route::post('/sendMessage', 'sendMessage');
});

Route::get('/registration',[FrontendController::class,'registration']);
Route::get('/login_guest',[FrontendController::class,'login_guest']);
Route::post('/guestLoginAttempt',[GuestLoginContoller::class,'guestLoginAttempt']);
Route::get('/guestLogout',[GuestLoginContoller::class,'guestLogout']);
Route::get('/shop_details/{id}',[FrontendController::class,'shop_details']);
Route::get('/categorie_product/{id}',[FrontendController::class,'categorie_product']);
Route::get('/sub_categorie_product/{id}',[FrontendController::class,'sub_categorie_product']);
Route::post('/submitOrder',[FrontendController::class,'submitOrder']);

Route::get('guest_dashboard',[FrontendController::class,'guest_dashboard']);
Route::get('check_order',[FrontendController::class,'check_order']);
Route::get('updateinformation',[FrontendController::class,'updateinformation']);


Route::post('productCart',[FrontendController::class,'productCart']);
Route::post('AddWishList',[FrontendController::class,'AddWishList']);

Route::post('/register_guest',[FrontendController::class,'register_guest']);
Route::post('/guest_user_update',[FrontendController::class,'guest_user_update']);
Route::get('/loadCheckoutData',[FrontendController::class,'loadCheckoutData']);
Route::post('/loadDistrict',[FrontendController::class,'loadDistrict']);
Route::post('/loadUpazila',[FrontendController::class,'loadUpazila']);
Route::post('/shipingCostUpdate',[FrontendController::class,'shipingCostUpdate']);
Route::post('/updateCupponAmount',[FrontendController::class,'updateCupponAmount']);

Route::get('/add_cart_user/{id}',[FrontendController::class,'add_cart_user']);
Route::get('/checkout/{id}',[FrontendController::class,'checkout']);


Route::post('filterCatProductByColor',[FrontendController::class,'filterCatProductByColor']);
Route::post('filterCatProductBySize',[FrontendController::class,'filterCatProductBySize']);
Route::post('filterProductByRange',[FrontendController::class,'filterProductByRange']);

Route::post('filterSubCatProductByColor',[FrontendController::class,'filterSubCatProductByColor']);
Route::post('filterSubCatProductBySize',[FrontendController::class,'filterSubCatProductBySize']);
Route::post('filterSubCatProductByRange',[FrontendController::class,'filterSubCatProductByRange']);
Route::post('/change_lang',[BackendCotroller::class,'change_lang']);

Route::get('getProductCart',[FrontendController::class,'getProductCart']);
Route::get('getCartData',[FrontendController::class,'getCartData']);
Route::get('productQtyUpdate/{id}',[FrontendController::class,'productQtyUpdate']);
Route::get('deleteProduct/{id}',[FrontendController::class,'deleteProduct']);

Route::get('totalWishList',[FrontendController::class,'totalWishList']);
Route::get('/wishlist/{id}',[FrontendController::class,'wishlist']);
Route::get('/wishListToCart/{id}',[FrontendController::class,'wishListToCart']);
Route::get('getWishList',[FrontendController::class,'getWishList']);
Route::get('WishListDelete/{id}',[FrontendController::class,'WishListDelete']);

Route::resources([
    'categorie'    => CategorieController::class,
    'sub_categorie'    => SubcategorieController::class,
    'brand'    => BrandController::class,
    'size_setting'    => SizeController::class,
    'color'    => ColorController::class,
    'price_range'    => PricerangeController::class,
    'product'=> ProductController::class,
    'shipping'=> ShippingController::class,
    'cuppon'=> CupponController::class,
    'trend'=> TrendController::class,
    'user_order'=> GuestOrderController::class,
    'add_product_to_trend'=>AddProductToTrendController::class,
    'slider'=>SliderController::class,
]);


Route::get('backend/user_order/order_details/{order_id}',[GuestOrderController::class,'OrderDetails'])->name('user_order.order_detials');
Route::post('backend/user_order/update_status',[GuestOrderController::class,'UpdateStatus'])->name('user_order.update_status');

Route::get('categorieStatusChange/{id}',[CategorieController::class,'categorieStatusChange']);
Route::get('categorie_trash_list',[CategorieController::class,'trash_list'])->name('categorie.trash_list');
Route::get('categorie_restore/{id}',[CategorieController::class,'restore'])->name('categorie.restore');
Route::get('categorie_delete/{id}',[CategorieController::class,'delete'])->name('categorie.delete');

Route::get('subcategorieStatusChange/{id}',[SubcategorieController::class,'subcategorieStatusChange']);
Route::get('subcategorie_trash_list',[SubcategorieController::class,'trash_list'])->name('subcategorie.trash_list');
Route::get('subcategorie_restore/{id}',[SubcategorieController::class,'restore'])->name('subcategorie.restore');
Route::get('subcategorie_delete/{id}',[SubcategorieController::class,'delete'])->name('subcategorie.delete');

Route::get('brandStatusChange/{id}',[BrandController::class,'brandStatusChange']);
Route::get('brand_trash_list',[BrandController::class,'trash_list'])->name('brand.trash_list');
Route::get('brand_restore/{id}',[BrandController::class,'restore'])->name('brand.restore');
Route::get('brand_delete/{id}',[BrandController::class,'delete'])->name('brand.delete');

Route::get('sizeStatusChange/{id}',[SizeController::class,'sizeStatusChange']);
Route::get('size_setting_trash_list',[SizeController::class,'trash_list'])->name('size_setting.trash_list');
Route::get('size_setting_restore/{id}',[SizeController::class,'restore'])->name('size_setting.restore');
Route::get('size_setting_delete/{id}',[SizeController::class,'delete'])->name('size_setting.delete');

Route::get('colorStatusChange/{id}',[ColorController::class,'colorStatusChange']);
Route::get('color_trash_list',[ColorController::class,'trash_list'])->name('color.trash_list');
Route::get('color_restore/{id}',[ColorController::class,'restore'])->name('color.restore');
Route::get('color_delete/{id}',[ColorController::class,'delete'])->name('color.delete');

Route::get('pricerangeStatusChange/{id}',[PricerangeController::class,'pricerangeStatusChange']);
Route::get('price_range_trash_list',[PricerangeController::class,'trash_list'])->name('price_range.trash_list');
Route::get('price_range_restore/{id}',[PricerangeController::class,'restore'])->name('price_range.restore');
Route::get('price_range_delete/{id}',[PricerangeController::class,'delete'])->name('price_range.delete');

Route::get('cupponStatusChange/{id}',[CupponController::class,'cupponStatusChange']);
Route::get('retrive_cuppon/{id}',[CupponController::class,'retrive_cuppon']);
Route::get('cuppon_per_delete/{id}',[CupponController::class,'cuppon_per_delete']);

Route::get('trendStatusChange/{id}',[TrendController::class,'trendStatusChange']);
Route::get('retrive_trend/{id}',[TrendController::class,'retrive_trend']);
Route::get('trend_per_delete/{id}',[TrendController::class,'trend_per_delete']);

Route::get('GetSelectProduct/{cat_id}',[AddProductToTrendController::class,'GetSelectProduct']);

Route::get('GetSubCategorie/{cat_id}',[ProductController::class,'GetSubCategorie']);
Route::get('productStatusChange/{id}',[ProductController::class,'productStatusChange']);
Route::get('retrive_product/{id}',[ProductController::class,'retrive_product']);
Route::get('product_per_delete/{id}',[ProductController::class,'product_per_delete']);

Route::get('GetDistrict/{division_id}',[ShippingController::class,'GetDistrict']);
Route::get('GetUpazila/{district_id}',[ShippingController::class,'GetUpazila']);
Route::get('shippingStatusChange/{id}',[ShippingController::class,'shippingStatusChange']);

// fronted end 

// Route::get('/', function () {
    //return date('h:i:s a');
    // return(config('app.locale'));
    // return Hash::make('super@123');
    // return redirect('/login');

// });

Route::get('/agent',[BackendController::class,'agent']);

Route::post('changeLocale',[LanguageController::class,'changeLocale']);

// use change password
Route::get('reset_pass',[UserController::class,'reset_pass'])->name('user.reset_pass');
Route::post('submit_email',[UserController::class,'submit_email'])->name('user.submit_email');
Route::get('check_otp/{email}',[UserController::class,'check_otp'])->name('user.check_otp');
Route::get('checkingOtp/{otp}/{email}',[UserController::class,'checkingOtp']);
Route::get('resend_otp/{email}',[UserController::class,'resend_otp'])->name('user.resend_otp');
Route::post('submit_otp/{email}',[UserController::class,'submit_otp'])->name('user.submit_otp');
Route::get('new_pass/{email}',[UserController::class,'new_pass'])->name('user.new_pass');
Route::post('submit_pass',[UserController::class,'submit_pass'])->name('user.submit_pass');

Route::group(['middleware' => ['can:Dashboard index']], function () {

Route::post('webcamStore',[BackendController::class,'webcam'])->name('webcam.capture');

Route::get('/dashboard',[BackendController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('getQuickMenu',[UserController::class,'getQuickMenu']);

    Route::resources([
        'menu_label'    => MenuLabelController::class,
        'user'          => UserController::class,
        'role'          => RoleController::class,
        'branch'        => BranchController::class,
        'menu'          => MenuController::class,
        'software_info' => SoftwareSettingsController::class,
        'user_theme' => UserThemeController::class,
   ]);
   
    /*
    menu label extra routes are below
    */
    Route::get('menu_label_trash_list',[MenuLabelController::class,'trash_list'])->name('menu_label.trash_list');
    Route::get('menu_label_restore/{id}',[MenuLabelController::class,'restore'])->name('menu_label.restore');
    Route::get('menu_label_delete/{id}',[MenuLabelController::class,'delete'])->name('menu_label.delete');
    Route::get('menu_label_properties/{id}',[MenuLabelController::class,'properties'])->name('menu_label.properties');
    /* ==== */

    /*
    role extra routes are below
    */
    Route::get('role_trash_list',[RoleController::class,'trash_list'])->name('role.trash_list');
    Route::get('role_restore/{id}',[RoleController::class,'restore'])->name('role.restore');
    Route::get('role_delete/{id}',[RoleController::class,'delete'])->name('role.delete');
    Route::get('role_properties/{id}',[RoleController::class,'properties'])->name('role.properties');
    Route::post('role_permission/{id}',[RoleController::class,'permission'])->name('role.permission');
    /* ==== */


    /*
    branch extra routes are below
    */
    Route::get('branch_trash_list',[BranchController::class,'trash_list'])->name('branch.trash_list');
    Route::get('branch_restore/{id}',[BranchController::class,'restore'])->name('branch.restore');
    Route::get('branch_delete/{id}',[BranchController::class,'delete'])->name('branch.delete');
    Route::get('branch_properties/{id}',[BranchController::class,'properties'])->name('branch.properties');
    /* ==== */


    /*
    user extra routes are below
    */
    Route::get('user_trash_list',[UserController::class,'trash_list'])->name('user.trash_list');
    Route::get('user_restore/{id}',[UserController::class,'restore'])->name('user.restore');
    Route::get('user_delete/{id}',[UserController::class,'delete'])->name('user.delete');
    Route::get('user_properties/{id}',[UserController::class,'properties'])->name('user.properties');
    Route::post('user_image_upload',[UserController::class,'user_image_upload'])->name('user.image_update');
    Route::post('user_activity',[UserController::class,'user_activity'])->name('user.activity');

    /* ==== */


    /*
    menu extra routes are below
    */
    Route::post('menu_status_change',[MenuController::class,'status'])->name('menu.status');
    Route::get('menu_trash_list',[MenuController::class,'trash_list'])->name('menu.trash_list');
    Route::get('menu_restore/{id}',[MenuController::class,'restore'])->name('menu.restore');
    Route::get('menu_delete/{id}',[MenuController::class,'delete'])->name('menu.delete');
    Route::get('menu_properties/{id}',[MenuController::class,'properties'])->name('menu.properties');

    /* ==== */

});

require __DIR__.'/auth.php';
