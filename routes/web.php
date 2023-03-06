<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\FrontController;


Route::get('/cache-clear', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return 'Cache is cleared';
});

//----- Frontend Routes -----//

Route::get('/', [FrontController::class, 'index']);
Route::get('/lang/change', [FrontController::class, 'lang']);
Route::get('/single-product/{id}', [FrontController::class, 'singleProductDetails']);
Route::get('/login',[FrontController::class,'indexLogin']);
Route::post('/login',[FrontController::class,'login']);
Route::get('/logout',[FrontController::class,'logout']);
Route::get('/register',[FrontController::class, 'indexRegister']);
Route::post('/register',[FrontController::class, 'register']);
Route::post('/product-click-add',[FrontController::class, 'clickAddForProduct']);
Route::post('/certificate-click-add',[FrontController::class, 'clickAddForCertificate']);
Route::get('/category/{id}',[FrontController::class, 'categoryProduct']);
Route::get('/faq',[FrontController::class, 'faq']);
Route::get('/privacy-policy',[FrontController::class, 'privacyPolicy']);
Route::get('/about-us',[FrontController::class, 'about']);
Route::get('/certificates',[FrontController::class, 'certificate']);
Route::get('/contact-us',[FrontController::class, 'contact']);
Route::get('/site-map',[FrontController::class, 'sitemap']);
Route::get('/shop',[FrontController::class, 'shop']);
Route::get('/cart',[FrontController::class, 'cart']);
Route::get('/checkout',[FrontController::class, 'checkout']);
// Route::get('/favorite',[FrontController::class, 'favorite']);
// Route::post('/add-to-favorite',[FrontController::class, 'AddToFavorite']);
Route::post('/add-favorite-link',[FrontController::class, 'addToFavoriteLink']);
Route::post('/delete-favorite-link',[FrontController::class, 'deleteToFavoriteLink']);
Route::post('/add-to-cart',[FrontController::class, 'addToCart']);
Route::post('/edit-cart',[FrontController::class, 'editCart']);
Route::post('/edit-cart-submit',[FrontController::class, 'editCartSubmit']);
Route::post('/delete-cart',[FrontController::class, 'deleteCart']);
Route::post('/show-cart-detail-in-icon',[FrontController::class, 'cartDetails']);
Route::post('/cart-count',[FrontController::class, 'cartCount']);
Route::post('/cart-with-register',[FrontController::class, 'cartWithRegister']);
Route::post('/cart-for-registered-user',[FrontController::class, 'cartForRegisterUser']);















//----- Admin Routes -----//

Route::group(['prefix' => 'admin'], function(){
    Route::get('/pass',[LoginController::class,'pass']);
    Route::get('/login',[LoginController::class,'adminLoginIndex']);
    Route::post('/login-submit',[LoginController::class,'adminLogin']);
    Route::get('/logout',[LoginController::class,'adminLogout']);
    Route::group(['middleware' => ['admin_auth']],function(){
        Route::get('/dashboard',[DashboardController::class, 'index']);

        //----- Category -----//
        Route::get('/category',[CategoryController::class, 'index']);
        Route::get('/category/add',[CategoryController::class,'indexAddCategory']);
        Route::post('/category/store',[CategoryController::class,'storeCategory']);
        Route::get('/category/edit/{id}',[CategoryController::class,'indexEditCategory']);
        Route::post('category/update',[CategoryController::class,'updateCategory']);
        Route::get('/category/status',[CategoryController::class,'status']);
        Route::get('/category/delete/{id}',[CategoryController::class,'destroyCategory']);

        //----- Admin Sub-category -----
        Route::get('/sub-category/{id}',[CategoryController::class,'indexSubCategory']);
        Route::get('/sub-category/add/{id}',[CategoryController::class,'indexAddSubCategory']);
        Route::post('/sub-category/store',[CategoryController::class,'storeSubCategory']);
        Route::get('/sub-category/edit/{id}',[CategoryController::class,'indexEditSubCategory']);
        Route::post('/sub-category/update',[CategoryController::class,'updateSubCategory']);
        Route::get('/sub-category/delete/{id}/{parent_id}',[CategoryController::class,'destroySubCategory']);
    
        //----- Product -----//
        Route::get('/product',[ProductController::class, 'index']);
        Route::get('/product/add',[ProductController::class,'indexAddProduct']);
        Route::post('/product/store',[ProductController::class,'storeProduct']);
        Route::get('/product/edit/{id}',[ProductController::class,'indexEditProduct']);
        Route::post('product/update',[ProductController::class,'updateProduct']);
        Route::post('/product-delete',[ProductController::class,'destroyProduct']);
        Route::post('/product-image-gallery/delete',[ProductController::class,'productImageGalleryDelete']);
        Route::post('/product-authorize-change',[ProductController::class,'productAuthorizeChange']);
        Route::get('/product-click-change/{id}',[ProductController::class,'productClickChange']);
        Route::post('/product/sub-category-value',[ProductController::class,'getSubCategoryValue']);
        Route::get('/product/export',[ProductController::class,'productExport']);
        // Route::post('/show-all-to-level-c',[ProductController::class,'showAllToLevelC']);
        Route::get('/show-all-to-level-c',[ProductController::class,'showAllToLevelC']);
        Route::post('/batch-upload',[ProductController::class,'batchUpload']);

        //----- Member -----//
        Route::get('/member',[MemberController::class, 'index']);
        Route::get('/member-delete/{id}',[MemberController::class, 'destroyMember']);
        Route::get('/member-approve',[MemberController::class, 'memberApprove']);
        Route::post('/member-record',[MemberController::class, 'memberRecord']);

        //----- faq -----//
        Route::get('/faq',[FaqController::class, 'index']);
        Route::get('/faq/add',[FaqController::class,'indexAddFaq']);
        Route::post('/faq/store',[FaqController::class,'storeFaq']);
        Route::get('/faq/edit/{id}',[FaqController::class,'indexEditFaq']);
        Route::post('faq/update',[FaqController::class,'updateFaq']);
        Route::get('/faq/status',[FaqController::class,'status']);
        Route::get('/faq/delete/{id}',[FaqController::class,'destroyFaq']);

        //----- Contact -----//
        Route::get('/contact/add',[FaqController::class,'indexAddContact']);
        Route::post('/contact/store',[FaqController::class,'storeContact']);
        Route::get('/contact/edit/{id}',[FaqController::class,'indexEditContact']);
        Route::post('contact/update',[FaqController::class,'updateContact']);
        Route::get('/contact/delete/{id}',[FaqController::class,'destroyContact']);
        Route::post('/contact-approve',[FaqController::class,'contactApprove']);

        //----- Certificate -----//
        Route::get('/certificate/add',[FaqController::class,'indexAddCertificate']);
        Route::post('/certificate/store',[FaqController::class,'storeCertificate']);
        Route::get('/certificate/edit/{id}',[FaqController::class,'indexEditCertificate']);
        Route::post('certificate/update',[FaqController::class,'updateCertificate']);
        Route::get('/certificate/delete/{id}',[FaqController::class,'destroyCertificate']);
        Route::post('/certificate-approve',[FaqController::class,'certificateApprove']);

        //----- Slider -----//
        Route::get('/slider',[SliderController::class,'index']);
        Route::get('/slider/add',[SliderController::class,'indexAddSlider']);
        Route::post('/slider/store',[SliderController::class,'storeSlider']);
        Route::get('/slider/edit/{id}',[SliderController::class,'indexEditSlider']);
        Route::post('slider/update',[SliderController::class,'updateSlider']);
        Route::get('/slider/delete/{id}',[SliderController::class,'destroySlider']);

        //----- Privacy -----//
        Route::get('/privacy/edit/{id}',[SliderController::class,'indexEditPrivacy']);
        Route::post('privacy/update',[SliderController::class,'updatePrivacy']);

        //----- About -----//
        Route::get('/about/edit/{id}',[FaqController::class,'indexEditAbout']);
        Route::post('about/update',[FaqController::class,'updateAbout']);

        //----- Sitemap -----//
        Route::get('/sitemap/add',[SliderController::class,'indexAddSitemap']);
        Route::post('/sitemap/store',[SliderController::class,'storeSitemap']);
        Route::get('/sitemap/edit/{id}',[SliderController::class,'indexEditSitemap']);
        Route::post('sitemap/update',[SliderController::class,'updateSitemap']);
        Route::get('/sitemap/delete/{id}',[SliderController::class,'destroySitemap']);
        Route::post('/sitemap-approve',[SliderController::class,'sitemapApprove']);

        //----- Trash -----//
        Route::get('/trash',[TrashController::class,'index']);
        Route::post('/trash-category-recover',[TrashController::class,'recoverTrashCategory']);
        Route::post('/trash-product-recover',[TrashController::class,'recoverTrashProduct']);
        Route::post('/trash-member-recover',[TrashController::class,'recoverTrashMember']);
        Route::post('/trash-category-delete',[TrashController::class,'destroyTrashCategory']);
        Route::post('/trash-product-delete',[TrashController::class,'destroyTrashProduct']);
        Route::post('/trash-member-delete',[TrashController::class,'destroyTrashMember']);

        //----- Inquiry Cart -----//
        Route::get('/inquiry-cart',[FaqController::class,'indexInquiryCart']);
        Route::get('/inquiry-cart-view/{id}',[FaqController::class,'viewCart']);
    });
   
});