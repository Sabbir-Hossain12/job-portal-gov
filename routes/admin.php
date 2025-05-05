<?php


use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssessmentAnswerController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\AssessmentGradeController;
use App\Http\Controllers\Admin\BasicinfoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrolmentController;
use App\Http\Controllers\Admin\HerobannerController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonMaterialController;
use App\Http\Controllers\Admin\LessonVideoController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\TestimonialSettingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


//Authentication

Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    
    Route::get('/login', [AuthenticationController::class, 'create'])->name('login-view');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login');
    
});

Route::name('admin.')->middleware(['checkAuth'])->group(function ()
{
    Route::post('logout', [AuthenticationController::class, 'destroy'])->name('logout');
    
    //Dashboard
    Route::resource('/', DashboardController::class)->names('dashboard');
    
    //Admin
    Route::resource('/admins', AdminController::class)->names('admin');
    Route::get('/admin/data', [AdminController::class, 'getData'])->name('admin.data');
    Route::post('/change-admin-status', [AdminController::class, 'changeAdminStatus'])->name('admin.status');
    

    //Roles and Permissions
    Route::resource('/roles', RoleController::class)->names('role');
    Route::get('/role/data', [RoleController::class, 'getData'])->name('role.data');
    Route::get('/assign-permission-page/{id}', [RoleController::class, 'assignPermissionsToRolePage'])->name('role.assign-permissions-page');
    Route::put('role/{id}/permission/update', [RoleController::class, 'assignPermissionsToRole'])->name('role.assign-permission-update');
    
    Route::resource('/permissions', PermissionController::class)->names('permission');
    Route::get('/permission/data', [PermissionController::class, 'getData'])->name('permission.data');
    
   
    //basic settings
    Route::resource('/basic-infos', BasicinfoController::class)->names('basicinfo');
    
    
    //Blogs
    Route::resource('/blogs', BlogController::class)->names('blog');
    Route::get('/blog/data', [BlogController::class, 'getData'])->name('blog.data');
    Route::post('/blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
    Route::post('/upload-ckeditor-image', [BlogController::class, 'uploadCkeditorImage'])->name('blog.ckeditor.upload');
    
    //pages
    Route::resource('/pages', PageController::class)->names('page');
});