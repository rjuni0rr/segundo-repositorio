<?php

use App\Http\Controllers\Employee\editProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use Maatwebsite\Excel\Facades\Excel;

// guest routes
Route::middleware(['guest', 'throttle:login'])->group(function (){

    // authentication (login)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');


    Route::get('/forgot-password', [PasswordController::class, 'forgetPassword'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'forgetPasswordSubmit'])->name('password.email');

    Route::get('/reset-password/{token}', [PasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'resetPasswordSubmit'])->name('password.update');
});


// auth routes (apenas para o admin)
Route::middleware(['auth', 'can:sys-admin', 'throttle:general'])->group(function () {

    // Homepage
    Route::get('/admin', [UserController::class, 'index'])->name('user.home');

    // Create user
    Route::get('/user/create', [UserController::class, 'createUser'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'createUserSubmit'])->name('user.create.submit');

    // Show user
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');

    // Edit User
    Route::get('/user/{user}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::put('/user/{user}', [UserController::class, 'editUserSubmit'])->name('users.edit.submit');

    // Delete User
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // PDF
    Route::get('/users/export/pdf', [UserController::class, 'exportPdf'])->middleware('throttle:export')->name('users.export.pdf');

});


// auth routes (para o manager) (ESTA SEM GATES can:client-admin POR CAUSA DO SHOW)
Route::middleware(['auth', 'throttle:general'])->group(function () {

    // Homepage
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.home');

    // Create user
    Route::get('/manager/users/create', [ManagerController::class, 'createUser'])->name('manager.create');
    Route::post('/manager/users/create', [ManagerController::class, 'createUserSubmit'])->name('manager.create.submit');

    // Show user (PROVISÓRIO, pois é do user??)
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');

    // Edit User
    Route::get('/manager/{user}/edit', [ManagerController::class, 'editUser'])->name('manager.edit');
    Route::put('/manager/{user}', [ManagerController::class, 'editUserSubmit'])->name('manager.edit.submit');

    // Delete User (PROVISÓRIO, pois é do user(ou manager)??)
    Route::delete('/users/{id}', [ManagerController::class, 'destroy'])->name('users.destroy');

    // PDF
    Route::get('/manager/export/pdf', [ManagerController::class, 'exportPdf'])->middleware('throttle:export')->name('manager.export.pdf');

});




// auth routes (para o employee)
Route::middleware(['auth', 'can:client-user', 'throttle:general'])->group(function () {

    // Homepage
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.home');

    Route::get('/employee/profile', [editProfileController::class, 'profile'])->name('employee.profile');
    Route::post('/employee/profile', [editProfileController::class, 'updateProfile'])->name('employee.profile.update');
});



// auth routes
Route::middleware(['auth', 'throttle:general'])->group(function () {

    // Alterar senha
    Route::get('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePasswordSubmit'])->name('password.update.submit');

    // Logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

});




// Limpar cache
Route::get('/clear-app', function () {

    Artisan::call('storage:unlink');
    Artisan::call('storage:link');

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear'); # Remove cache = resetar

    dd("ola");
});
