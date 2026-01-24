<?php

use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;


use Maatwebsite\Excel\Facades\Excel;

// guest routes
Route::middleware(['guest', 'throttle:login'])->group(function (){

    // authentication (login)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');

});



// auth routes (apenas admin)
Route::middleware(['auth', 'can:admin', 'throttle:general'])->group(function () {

    // Homepage
    Route::get('/', [UserController::class, 'index'])->name('home');

    // Create user
    Route::get('/user/create', [UserController::class, 'createUser'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'createUserSubmit'])->name('user.create.submit');

    // Show user
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name('users.show');

    // Edit User
    Route::get('/user/{user}/edit', [UserController::class, 'editUser'])->name('users.edit');
    Route::put('/user/{user}', [UserController::class, 'editUserSubmit'])->name('users.edit.submit');

    // Delete User
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // PDF
    Route::get('/users/export/pdf', [UserController::class, 'exportPdf'])->middleware('throttle:export')->name('users.export.pdf');

});



// auth routes (apenas manager)
Route::middleware(['auth', 'can:manager', 'throttle:general'])->group(function (){

    // Homepage
    Route::get('/', [ManagerController::class, 'index'])->name('manager.home');

});







// auth routes
Route::middleware(['auth', 'can:manager', 'throttle:general'])->group(function () {

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
