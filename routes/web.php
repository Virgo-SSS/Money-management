<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\SettingsController;

use App\Http\Controllers\TodoListController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ChangePasswordController;

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
   

    // todolist category routes
    Route::controller(TodoListController::class)->group(function (){
        Route::prefix('todolist')->group(function () {
            Route::get('/',                   'index')->name('todolist');
            Route::get('/create',             'create')->name('todolist.create');
            Route::post('/store',             'store')->name('todolist.store');
            Route::post('/edit',              'edit')->name('todolist.edit');
            Route::post('/update/{todolist}', 'update')->name('todolist.update');
            Route::post('/action',            'action')->name('todolist.action');
        });

        Route::prefix('todolist/category')->group(function () {
            Route::post('/add',     'addCategory')->name('todolist.add.category');
            Route::post('/update',  'updateCategory')->name('todolist.update.category');
            Route::post('/delete',  'deleteCategory')->name('todolist.delete.category');
        });
    });


    //  Investment
    Route::get('/investment', [InvestmentController::class, 'index'])->name('investment');

    // Revenue
    Route::controller(RevenueController::class)->prefix('revenue')->group(function () {
        Route::get('/',                  'index')->name('revenue');
        Route::get('/create',            'create')->name('revenue.create');
        Route::post('/store',            'store')->name('revenue.store');
        Route::get('/edit/{revenue}',    'edit')->name('revenue.edit');
        Route::put('/update/{revenue}',  'update')->name('revenue.update');
        Route::delete('/delete/{revenue}',         'destroy')->name('revenue.delete');
    });

    // expense
    Route::controller(ExpenseController::class)->prefix('expense')->group(function () {
        Route::get('/',                 'index')->name('expense');
        Route::get('/create',           'create')->name('expense.create');
        Route::post('/store',           'store')->name('expense.store');
        Route::get('/edit/{expense}',   'edit')->name('expense.edit');
        Route::put('/update/{expense}', 'update')->name('expense.update');
        Route::delete('/delete/{expense}',        'destroy')->name('expense.delete');

    });

});
