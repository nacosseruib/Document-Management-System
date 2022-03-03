<?php

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

//Guest
Route::group(['middleware' => ['guest'], 'middleware' => ['GoToHttps']], function ()
{
    //Auth::routes();
    Route::get('/',                                                 'IndexController@index')->name('index');
    Route::get('/login',                                            'Auth\LoginController@createLogin')->name('login');
    Route::post('/login',                                           'Auth\LoginController@attemptLogin')->name('login');
    Route::get('/logout', 			                                'Auth\LoginController@logout')->name('logout');
    Route::get('/register',                                         'Auth\RegisterController@createRegistration')->name('register');
    Route::post('/register',                                        'Auth\RegisterController@saveRegistration')->name('register');
    Route::get('/registration/completed',                           'Auth\RegisterController@registrationCompleted')->name('registerCompleted');
    //Product Details
    Route::get('product-details/{pid?}',                            'ProductController@index')->name('productDetails');
    //product cart
    Route::get('cart',                                              'ProductController@cart')->name('productCart');
    Route::get('/contact-us',                                       'ContactUsController@index')->name('contactUs');
    Route::post('/contact-us',                                      'ContactUsController@save')->name('contactUs');
    Route::get('/es/{pageRoute?}',                                  'ViewVisitorPagesController@index')->name('viewVisitorPage');

});


//Auth
Route::group(['middleware' => ['auth'], 'middleware' => ['checkUser'], 'middleware' => ['clear-history'], 'middleware' => ['GoToHttps']], function ()
{

    Route::get('/dashboard',                                    'DashboardController@index')->name('dashboard')->middleware('clear-history')->middleware('checkUser');
    Route::get('/home',                                         'HomeController@index')->name('home')->middleware('clear-history')->middleware('checkUser');

    Route::get('/page-content',                                 'PageContentController@index')->name('pageContent')->middleware('clear-history')->middleware('checkUser');
    Route::post('/page-content',                                'PageContentController@save')->name('savePageContent')->middleware('clear-history')->middleware('checkUser');
    Route::post('/get-page-content-by-page-name',               'PageContentController@getPageContentByPageID')->name('getPageContentByID')->middleware('clear-history')->middleware('checkUser');

    Route::get('/list-contact-us',                              'ContactUsController@listContactUs')->name('listContactUs')->middleware('clear-history')->middleware('checkUser');
    Route::get('/delete-contact-us/{id?}',                      'ContactUsController@deleteContactUs')->name('deleteContactUs')->middleware('clear-history')->middleware('checkUser');
    Route::get('/message',                                      'MessageController@index')->name('message')->middleware('clear-history')->middleware('checkUser');
    Route::get('/notification',                                 'NotificationController@index')->name('notification')->middleware('clear-history')->middleware('checkUser');
    Route::get('/contact-support',                              'ContactSupportController@index')->name('contactSupport')->middleware('clear-history')->middleware('checkUser');
    Route::get('/new-account',                                  'NewUserAccountController@index')->name('newAccount')->middleware('clear-history')->middleware('checkUser');
    Route::post('/new-account',                                 'NewUserAccountController@saveUser')->name('saveNewAccount')->middleware('clear-history')->middleware('checkUser');
    Route::get('/list-user',                                    'NewUserAccountController@listUser')->name('listUser')->middleware('clear-history')->middleware('checkUser');
    Route::post('/list-user',                                   'NewUserAccountController@updateUserStatus')->name('updateUserStatus')->middleware('clear-history')->middleware('checkUser');
    Route::get('/audit-tray',                                   'AuditTrayController@index')->name('auditTray')->middleware('clear-history')->middleware('checkUser');
    Route::get('/settings',                                     'settingsController@index')->name('settings')->middleware('clear-history')->middleware('checkUser');
    Route::get('/profile',                                      'ProfileController@index')->name('userProfile')->middleware('clear-history')->middleware('checkUser');
    Route::post('/profile-image',                               'ProfileController@UpdateProfileImage')->name('saveProfileImage')->middleware('clear-history')->middleware('checkUser');
    Route::post('/profile-details',                             'ProfileController@updateProfileDetails')->name('updateProfileDetails')->middleware('clear-history')->middleware('checkUser');
    Route::post('/profile-security',                            'ProfileController@updateProfileSecurity')->name('updateProfileSecurity')->middleware('clear-history')->middleware('checkUser');
    Route::get('/create-folder',                                'FolderController@index')->name('createFolder')->middleware('clear-history')->middleware('checkUser');
    Route::post('/create-folder',                               'FolderController@saveAndCreateDirectory')->name('saveFolder')->middleware('clear-history')->middleware('checkUser');
    Route::get('/list-folder',                                  'FolderController@listFolder')->name('listFolder')->middleware('clear-history')->middleware('checkUser');
    Route::get('/delete-folder/{id?}',                          'FolderController@deleteFolder')->name('deleteFolder')->middleware('clear-history')->middleware('checkUser');
    Route::get('/assign-folder',                                'AssignFolderController@index')->name('assignFolder')->middleware('clear-history')->middleware('checkUser');
    Route::post('/assign-folder',                               'AssignFolderController@saveAssignFolderToUser')->name('saveAssignFolder')->middleware('clear-history')->middleware('checkUser');
    Route::get('/delete-assign-folder/{id?}',                   'AssignFolderController@deleteAssignFolder')->name('deleteAssignFolder')->middleware('clear-history')->middleware('checkUser');
    Route::get('/my-folder',                                    'FolderController@userAssignedFolder')->name('myFolder')->middleware('clear-history')->middleware('checkUser');
    Route::get('/my-file/{id?}',                                 'FolderController@userAssignedFolderFile')->name('myFile')->middleware('clear-history')->middleware('checkUser');

});

//Auth
Route::group(['middleware' => ['auth'], 'middleware' => ['checkUser']], function ()
{
    Route::get('/export-excel-insurance-registration/{id?}',         'PendingSellersReportController@exportToExcel')->name('exportToExcel')->middleware('clear-history')->middleware('checkUser');

});




// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth',              'FaceBookController@loginUsingFacebook')->name('facebookLogin');
    Route::get('callback',          'FaceBookController@callbackFromFacebook')->name('callback');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


// <a href="{{ route('facebook.login') }}" class="btn btn-facebook btn-user btn-block">
// <i class="fab fa-facebook-f fa-fw"></i>
// Login with Facebook
// </a>


/////////////////////////////////////////ROLE AND PERMISSION/////////////////////////////////////////////
    //Module and SubModule Set up
    Route::get('/create-route-module',                            'ModuleController@createRouteModule')->name('createModule');
    Route::post('/create-route-module',                           'ModuleController@saveModule')->name('addModule');
    Route::get('/remove/module/{id?}',                            'ModuleController@removeModule')->name('removeModule');
    Route::get('/edit/module/{id?}',                              'ModuleController@editModule')->name('editModule');
    Route::get('/cancel-module-editing',                          'ModuleController@cancelEditModule')->name('cancelEditModule');
    //SubModule and SubModule Set up
    Route::get('/create-route-submodule',                         'SubModuleController@createRouteSubModule')->name('createSubModule');
    Route::post('/create-route-submodule',                        'SubModuleController@saveSubModule')->name('addSubModule');
    Route::get('/remove/submodule/{id?}',                         'SubModuleController@removeSubModule')->name('removeSubModule');
    Route::get('/edit/submodule/{id?}',                           'SubModuleController@editSubModule')->name('editSubModule');
    Route::get('/cancel-submodule-editing',                       'SubModuleController@cancelEditSubModule')->name('cancelEditSubModule');
    //Role and Permission
    Route::get('/create-update-role',                             'RolePermissionController@createRole')->name('createRole');
    Route::post('/create-update-role',                            'RolePermissionController@saveRole')->name('saveRole');
    Route::get('/remove-role/{id?}',                              'RolePermissionController@removeRole')->name('removeRole');
    Route::get('/edit-role/{id?}',                                'RolePermissionController@editRole')->name('editRole');
    Route::get('/cancel-role-editing',                            'RolePermissionController@cancelEditRole')->name('cancelEditRole');
    Route::get('/assigning-submodule-to-role',                    'RolePermissionController@createSubmoduleToRole')->name('createSubmoduleAssignment');
    Route::post('/assigning-submodule-to-role',                   'RolePermissionController@saveSubmoduleToRole')->name('postSubmoduleAssignment');
    Route::get('/assigning-role-to-user',                         'RolePermissionController@createRole');
    Route::post('/assigning-role-to-user',                        'RolePermissionController@assignRoleToUser')->name('assignRoleToUser');
/////////////////////////////////////////ROLE AND PERMISSION/////////////////////////////////////////////
