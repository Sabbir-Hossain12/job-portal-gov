<?php


use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdmitCardController;
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
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonMaterialController;
use App\Http\Controllers\Admin\LessonVideoController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PositionController;
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
    
    //Job Post
    Route::resource('/job-posts', JobPostController::class)->names('jobpost');
    Route::get('/job-post/data', [JobPostController::class, 'getData'])->name('jobpost.data');
    Route::post('/change-job-post-status', [JobPostController::class, 'changeJobPostStatus'])->name('jobpost.status');
    
    //Job Position
    Route::get('/positions/{id}', [PositionController::class, 'index'])->name('position.index');
    Route::get('/positions/{id}/create', [PositionController::class, 'create'])->name('position.create');
    Route::get('/positions/{id}/edit', [PositionController::class, 'edit'])->name('position.edit');
    Route::put('/positions/{id}/update', [PositionController::class, 'update'])->name('position.update');
    Route::post('/positions/store', [PositionController::class, 'store'])->name('position.store');
    Route::delete('/positions/{id}', [PositionController::class, 'destroy'])->name('position.destroy');
    Route::post('/change-position-status', [PositionController::class, 'changePositionStatus'])->name('position.status');
    
    //Job Applications
    Route::get('/job-applications/{id}', [JobApplicationController::class, 'index'])->name('jobapplication.index');
    Route::get('/job-applications/{id}/create', [JobApplicationController::class, 'create'])->name('jobapplication.create');
    Route::get('/job-applications/{id}/edit', [JobApplicationController::class, 'edit'])->name('jobapplication.edit');
    Route::put('/job-applications/{id}/update', [JobApplicationController::class, 'update'])->name('jobapplication.update');
    Route::post('/job-applications/store', [JobApplicationController::class, 'store'])->name('jobapplication.store');
    Route::delete('/job-applications/{id}', [JobApplicationController::class, 'destroy'])->name('jobapplication.destroy');
    Route::post('/change-job-application-status', [JobApplicationController::class, 'changeJobApplicationStatus'])->name('jobapplication.status');

    //Admit Card
    Route::get('/preview-admit-cards/{id}', [AdmitCardController::class, 'previewAdminCard'])->name('admitcard.preview');

    //import 
    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import-save', [ImportController::class, 'import'])->name('import.store');
    
});