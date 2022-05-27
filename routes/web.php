<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Logscontroller;
use App\Http\Controllers\ForgetPasswordController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'mainView'])->name('/');
Route::get('/user-register', [AuthController::class, 'registerView'])->name('user-register');
Route::get('/login/page', [AuthController::class, 'loginView'])->name('login-page');
Route::get('/get-circle', [AuthController::class, 'getCircle'])->name('ajax-circle');
Route::get('/get-ranges', [AuthController::class, 'getRanges'])->name('ajax-ranges');
Route::post('/save/register/user', [AuthController::class, 'saveRegisterUser'])->name('save-register-users');
Route::get('/login-view', [AuthController::class, 'loginview'])->name('login-view');
Route::post('/login-users', [AuthController::class, 'loginUsers'])->name('login-users');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forget-password', [ForgetPasswordController::class, 'getEmail'])->name('forget-password');
Route::post('/forget-password', [ForgetPasswordController::class,  'postEmail'])->name('forget-email');
Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'getPassword'])->name('update-password');
Route::post('/reset-password', [ForgetPasswordController::class,'updatePassword'])->name('reset-password');



Route::group(['prefix' => 'admin', 'middleware' =>['isadmin']], function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('auth.index');
    Route::get('/admin/dashboard', [AdminController::class, 'adminView'])->name('admin-index');
    Route::get('/admin/create/user', [AdminController::class, 'createUserView'])->name('create-user');
    Route::post('/admin/save/user', [AdminController::class, 'createUser'])->name('save-user');
    Route::post('/admin/update/{id}', [AdminController::class, 'updateUser'])->name('update-user');
    Route::get('/manage/users', [AdminController::class, 'manageUsers'])->name('manage-users');
    Route::get('/edit-users/{id}', [AdminController::class, 'editUsers'])->name('edit-users');
    Route::get('/delete-user/{id}',[AdminController::class, 'destroy'])->name('delete-user');
    Route::get('/admin-ajax-circle', [AdminController::class, 'adminGetCircle'])->name('admin-ajax-circle');
    Route::get('/admin-ajax-ranges', [AdminController::class, 'adminGetRanges'])->name('admin-ajax-ranges');
    Route::get('/create-holiday', [AdminController::class, 'createHoliday'])->name('create-holiday');
    Route::post('/save-holiday', [AdminController::class, 'saveHoliday'])->name('save-holiday');
    Route::get('/show/chart', [ChartController::class, 'showChart'])->name('show-chart');
    Route::get('/show/reports', [ChartController::class, 'getDistrict'])->name('show-reports');
    Route::get('/manage/holidays', [AdminController::class, 'manageHolidays'])->name('manage-holidays');
    Route::get('/show/holiday', [AdminController::class, 'showHoliday'])->name('show-holiday');
    Route::get('/edit/holidays/{id}', [AdminController::class, 'editHolidays'])->name('edit-holidays');
    Route::post('/upate/holiday/{id}', [AdminController::class, 'updateHoliday'])->name('updated-holiday');
    Route::get('/show/activites', [AdminController::class, 'viewAllUserActivities'])->name('show-user-activity');
    Route::get('/edit/activity/{id}', [AdminController::class, 'editUserActivity'])->name(('edit-admin-activity'));
    Route::post('/update/activity/{id}', [AdminController::class, 'updateUserActivity'])->name(('update-activity'));
    Route::get('/get/admin/password', [AdminController ::class, 'getAdminPassword'])->name('admin-password');
    Route::post('/save/admin/password', [AdminController::class, 'storeAdminPassword'])->name(('save-admin-password'));
    Route::get('/activity/logs', [Logscontroller::class, 'acitivityLogInLogOut'])->name('activity-logIn-logOut');
    // Route::get('/activity/logIn/logOut', [Logscontroller::class, 'acitivityLogInLogOut'])->name('activity-logIn-logOut');


});




Route::group(['prefix' => 'users', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', [UserController::class, 'usersDashboard'])->name('user.index');
    Route::post('/save-activity', [UserController::class,'saveActivity'])->name(('save-activity'));
    Route::get('/show/allActivities', [UserController::class, 'showAllActivity'])->name('show-activities');
    Route::get('/edit/activity/{id}', [UserController::class, 'editOwnActivity'])->name('edit-activity');
    Route::post('/update/activity/{id}', [UserController::class, 'updateOwnActivity'])->name('update-activity');
    Route::get('/get/password/form', [UserController ::class, 'getPassword'])->name('get-password');
    Route::post('/update/password/form', [UserController ::class, 'storeNewPassword'])->name('save-password');

});


