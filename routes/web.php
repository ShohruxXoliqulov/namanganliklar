<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TegController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', [PagesController::class, 'welcome'])->name('welcome');

Route::auto('/pages', PagesController::class);

// ADMIN

Route::prefix('admin/')->middleware('auth')->name('admin.')->group(function(){
    Route::get('dashboard', function(){
        return view('admin.layouts.dashboard');
    })->middleware('auth')->name('dashboard');

    Route::resources([
        'categories' => CategoryController::class,
        'posts' => PostController::class,
        'tegs' => TegController::class,
        'users' => UserController::class,
        'roles' => RoleController::class,
    ]);
    
    Route::resource('messages', MessageController::class)->only('index', 'show', 'destroy');
    Route::resource('audits', AuditController::class)->only('index', 'show', 'destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
