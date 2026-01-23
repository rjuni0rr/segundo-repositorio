<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;


// guest routes
Route::middleware(['guest'])->group(function (){

    // authentication (login)
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');

});



// auth routes
Route::middleware(['auth'])->group(function () {

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
