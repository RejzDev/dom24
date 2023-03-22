
<?php

use App\Http\Controllers\UserAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get('admin/login', [UserAdminController::class, 'create'])->name('admin.login');
Route::get('admin/logout', [UserAdminController::class, 'destroy'])->name('admin.logout');
Route::post('admin/login', [UserAdminController::class, 'store']);

Route::name('admin.')->prefix('admin')->middleware(\App\Http\Middleware\RedirectIfAuthenticated::class)->group(function () {


    Route::get('invoice/template', [\App\Http\Controllers\InvoiceController::class, 'templates'])->name('invoiceTemplate');
    Route::group(['middleware' => ['auth:admin', 'can:invoice'] ], function () {
        Route::resource('invoice', \App\Http\Controllers\InvoiceController::class);
        Route::post('invoice/ajax-delete', [\App\Http\Controllers\InvoiceController::class, 'invoiceAjaxDelete'])->name('invoiceAjaxDelete');
        Route::get('invoice/remove/{id}', [\App\Http\Controllers\InvoiceController::class, 'removeInvoice'])->name('invoiceRemove');
        Route::get('invoice/service-remove/{id}', [\App\Http\Controllers\InvoiceController::class, 'removeInvoiceService'])->name('invoiceServiceRemove');
        Route::get('invoice/create?invoice_id={id}/', [\App\Http\Controllers\InvoiceController::class, 'create'])->name('createInvoiceClone');


    });


    Route::resource('account-transaction', \App\Http\Controllers\AccountTransactionController::class);
    Route::get('account-transaction/create?type=out/', [\App\Http\Controllers\AccountTransactionController::class, 'create'])->name('createOutTransaction');
    Route::get('account-transaction/edit?type=out/', [\App\Http\Controllers\AccountTransactionController::class, 'edit'])->name('editOutTransaction');

    Route::get('/account-transaction/get-user-id/{id}', [\App\Http\Controllers\AccountTransactionController::class, 'getUser'])->name('getUser');
    Route::get('account-transaction/show/{id}/', [\App\Http\Controllers\AccountTransactionController::class, 'show'])->name('showTransaction');



    Route::get('/user-admin/role', [\App\Http\Controllers\RoleController::class, 'index'])->name('roleIndex');
    Route::post('/user-admin/role/saved', [\App\Http\Controllers\RoleController::class, 'save'])->name('roleSave');

    Route::get('/user-admin/create', [\App\Http\Controllers\UserAdminController::class, 'createPage'])->name('userAdmin-create');
    Route::post('/user-admin/create/saved', [\App\Http\Controllers\UserAdminController::class, 'save'])->name('userAdmin-save');
    Route::get('/user-admin/edit/{id}', [\App\Http\Controllers\UserAdminController::class, 'edit'])->name('userAdmin-edit');
    Route::post('/user-admin/edit/{id}/update', [\App\Http\Controllers\UserAdminController::class, 'update'])->name('userAdmin-update');
    Route::get('/user-admin/index', [\App\Http\Controllers\UserAdminController::class, 'index'])->name('userAdmin-index');
    Route::get('/user-admin/delete/{id}', [\App\Http\Controllers\UserAdminController::class, 'delete'])->name('userAdmin-delete');



});



Route::get('/', [\App\Http\Controllers\WebsiteMainController::class, 'index'])->name('websiteMain');
Route::get('/admin-panel', [\App\Http\Controllers\WebsiteMainController::class, 'adminMainPage'])->name('adminMainPage');
Route::post('/save-website-main', [\App\Http\Controllers\WebsiteMainController::class, 'saveWebsiteMain'])->name('saveWebsiteMain');


Route::get('/about', [\App\Http\Controllers\WebsiteAboutController::class, 'index'])->name('websiteAbout');
Route::get('/admin-panel/about', [\App\Http\Controllers\WebsiteAboutController::class, 'adminAboutPage']);
Route::post('/save-website-about', [\App\Http\Controllers\WebsiteAboutController::class, 'saveWebsiteAbout'])->name('saveWebsiteAbout');
Route::get('/remove-website-about-image/{id}', [\App\Http\Controllers\WebsiteAboutController::class, 'removeImageGallery'])->name('removeImageGallery');
Route::get('/remove-website-about-document/{id}', [\App\Http\Controllers\WebsiteAboutController::class, 'removeDocument'])->name('removeDocument');
Route::get('/download-website-about-document/{id}', [\App\Http\Controllers\WebsiteAboutController::class, 'downloadDocument'])->name('downloadDocument');


Route::get('/services', [\App\Http\Controllers\WebsiteServicesController::class, 'index'])->name('websiteServices');
Route::get('/admin-panel/services', [\App\Http\Controllers\WebsiteServicesController::class, 'adminServicesPage'])->name('adminServicesPage');
Route::post('/save-website-services', [\App\Http\Controllers\WebsiteServicesController::class, 'saveWebsiteServices'])->name('saveWebsiteServices');
Route::get('/remove-website-services/{id}', [\App\Http\Controllers\WebsiteServicesController::class, 'removeServices'])->name('removeServices');


Route::get('/contacts', [\App\Http\Controllers\WebsiteContactController::class, 'index'])->name('websiteContacts');;
Route::get('/admin-panel/contacts', [\App\Http\Controllers\WebsiteContactController::class, 'adminContactPage'])->name('websiteContact');
Route::post('/save-website-contacts', [\App\Http\Controllers\WebsiteContactController::class, 'saveWebsiteContact'])->name('saveWebsiteContact');

Route::get('/admin-panel/house-index', [\App\Http\Controllers\HouseController::class, 'index'])->name('adminHouseIndex');
Route::get('/admin-panel/house-show/{id}', [\App\Http\Controllers\HouseController::class, 'show'])->name('adminHouseShow');
Route::get('/admin-panel/house-edit/{id}', [\App\Http\Controllers\HouseController::class, 'edit'])->name('adminHouseEdit');
Route::post('/admin-panel/house-update/{id}', [\App\Http\Controllers\HouseController::class, 'update'])->name('adminHouseUpdate');
Route::get('/admin-panel/house-create', [\App\Http\Controllers\HouseController::class, 'create'])->name('adminHouseCreate');
Route::post('/admin-panel/house-save', [\App\Http\Controllers\HouseController::class, 'save'])->name('saveHouse');
Route::get('/admin-panel/house-remove/{id}', [\App\Http\Controllers\HouseController::class, 'removeHouse'])->name('adminHouseRemove');
Route::get('/admin-panel/house-flour-remove/{id}', [\App\Http\Controllers\HouseController::class, 'removeHouseFlour'])->name('adminHouseFlourRemove');
Route::get('/admin-panel/house-section-remove/{id}', [\App\Http\Controllers\HouseController::class, 'removeSectionFlour'])->name('adminHouseSectionRemove');
Route::get('/admin-panel/get-house-id/{id}', [\App\Http\Controllers\HouseController::class, 'houseId'])->name('getHouses');
Route::get('/admin-panel/get-section-id/{id}', [\App\Http\Controllers\HouseController::class, 'sectionId'])->name('getHouseSection');



Route::get('/admin-panel/apartaments-create', [\App\Http\Controllers\ApartamentsController::class, 'create'])->name('adminApartamentsCreate');
Route::get('/admin-panel/apartaments-edit/{id}', [\App\Http\Controllers\ApartamentsController::class, 'edit'])->name('adminApartamentsEdit');
Route::post('/admin-panel/apartaments-update/{id}', [\App\Http\Controllers\ApartamentsController::class, 'updates'])->name('adminApartamentsUpdate');
Route::get('/admin-panel/apartaments-index', [\App\Http\Controllers\ApartamentsController::class, 'index'])->name('adminApartamentsIndex');
Route::get('/admin-panel/apartaments-show/{id}', [\App\Http\Controllers\ApartamentsController::class, 'show'])->name('adminApartamentsShow');
Route::post('/admin-panel/apartaments-house', [\App\Http\Controllers\ApartamentsController::class, 'getHouse'])->name('adminApartamentsHouse');
Route::post('/admin-panel/apartaments-save', [\App\Http\Controllers\ApartamentsController::class, 'save'])->name('saveApartaments');
Route::get('/admin-panel/apartaments-remove/{id}', [\App\Http\Controllers\ApartamentsController::class, 'remove'])->name('adminApartamentsRemove');
Route::get('/admin-panel/get-apartaments-id/{id}', [\App\Http\Controllers\ApartamentsController::class, 'getApartments'])->name('getApartments');


Route::get('/admin-panel/user-create', [\App\Http\Controllers\UserController::class, 'create'])->name('userCreate');
Route::get('/admin-panel/user-edit/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('userEdit');
Route::post('/admin-panel/user-save', [\App\Http\Controllers\UserController::class, 'save'])->name('saveUser');
Route::post('/admin-panel/user-update/{id}', [\App\Http\Controllers\UserController::class, 'updates'])->name('updateUser');
Route::get('/admin-panel/user-index', [\App\Http\Controllers\UserController::class, 'index'])->name('userIndex');
Route::get('/admin-panel/user-show/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('userShow');
Route::get('/admin-panel/user-remove/{id}', [\App\Http\Controllers\UserController::class, 'remove'])->name('userRemove');



Route::get('/admin-panel/service-edit', [\App\Http\Controllers\ServiceController::class, 'edit'])->name('serviceEdit');
Route::post('/admin-panel/service-save', [\App\Http\Controllers\ServiceController::class, 'saveService'])->name('saveService');
Route::get('/admin-panel/service-remove/{id}', [\App\Http\Controllers\ServiceController::class, 'removeServices'])->name('serviceRemove');
Route::get('/admin-panel/unit-remove/{id}', [\App\Http\Controllers\ServiceController::class, 'removeUnit'])->name('unitRemove');
Route::get('/admin-panel/ajax-service-units/{id}', [\App\Http\Controllers\ServiceController::class, 'ajaxServiceUnits'])->name('ajax-service-units');

Route::resource('tariff', \App\Http\Controllers\TariffController::class);
Route::get('/tariff/create?tariff_id={id}/', [\App\Http\Controllers\TariffController::class, 'create'])->name('createClone');
Route::get('/tariff/service-remove/{id}', [\App\Http\Controllers\TariffController::class, 'removeTariffServices'])->name('tariffServiceRemove');
Route::get('/tariff/get-tariff-id/{id}', [\App\Http\Controllers\TariffController::class, 'getTariffId'])->name('getTariffId');

Route::resource('personalAccount', \App\Http\Controllers\PersonalAccountController::class);
Route::get('/personalAccount-remove/{id}', [\App\Http\Controllers\PersonalAccountController::class, 'delete'])->name('PersonalAccountRemove');
Route::get('/personalAccount-get-id/{number}', [\App\Http\Controllers\PersonalAccountController::class, 'getAccount'])->name('getAccount');


