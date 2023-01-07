<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::prefix('validation')->name('validation.')->group(function () {
        Route::post('register_validation', [RegisterController::class, 'register_validation'])->name('register.check');
    });
});

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', function(){
        return redirect()->route('home');
    });

    // Setting
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/appearance', [SettingsController::class, 'appearance'])->name('settings.appearance');
    Route::post('/change-password', [ChangePasswordController::class, 'reset'])->name('settings.change-password');

    // Todo List
    Route::get('/todolist', [TodoListController::class, 'index'])->name('todolist');
    Route::get('/todolist/create', [TodoListController::class, 'create'])->name('todolist.create');
    Route::post('/todolist/store', [TodoListController::class, 'store'])->name('todolist.store');

    // todolist category routes
    Route::post('/todolist/category/add', [TodoListController::class, 'addCategory'])->name('todolist.add.category');
    Route::post('/todolist/category/update', [TodoListController::class, 'updateCategory'])->name('todolist.update.category');
    Route::post('/todolist/category/delete', [TodoListController::class, 'deleteCategory'])->name('todolist.delete.category');

    //  Investment
    Route::get('/investment', [InvestmentController::class, 'index'])->name('investment');

});
