<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('index');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['namespace' => 'Report', 'prefix' => 'reports'], function () {
        Route::get('/', [\App\Http\Controllers\Report\IndexController::class, '__invoke'])->name('report.index');
        Route::get('/{organization_slug}/{report_slug}', [\App\Http\Controllers\Report\ShowController::class, "__invoke"])->name('report.show');
//        Route::post('/{organization_slug}/{report_slug}/show', [\App\Http\Controllers\Report\ShowController::class, "__invoke"])->name('report.show');
    });

    Route::group(['namespace' => 'Menuboard', 'prefix' => 'menuboards'], function () {
        Route::get('/', [\App\Http\Controllers\Menuboard\IndexController::class, '__invoke'])->name('menuboard.index');
        Route::get('/{organization_slug}/{id}', [\App\Http\Controllers\Menuboard\ShowController::class, '__invoke'])->name('menuboard.show');
    });

    Route::group(['namespace' => 'Nomenclature', 'prefix' => 'nomenclatures'], function () {
        Route::get('/', [\App\Http\Controllers\Nomenclature\IndexController::class, '__invoke'])->name('nomenclature.index');
        Route::get('/update', [\App\Http\Controllers\Nomenclature\UpdateController::class, '__invoke'])->name('nomenclature.update');
    });

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

        Route::group(['namespace' => 'Report', 'prefix' => 'reports'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\Report\IndexController::class, "__invoke"])->name('admin.report.index');
            Route::get('/{report}', [\App\Http\Controllers\Admin\Report\ShowController::class, "__invoke"])->name('admin.report.show');
        });


        Route::group(['namespace' => 'Organization', 'prefix' => 'organizations'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\Organization\IndexController::class, "__invoke"])->name('admin.organization.index');
            Route::get('/create', [\App\Http\Controllers\Admin\Organization\CreateController::class, "__invoke"])->name('admin.organization.create');
            Route::post('/', [\App\Http\Controllers\Admin\Organization\StoreController::class, "__invoke"])->name('admin.organization.store');
            Route::get('/{organization}', [\App\Http\Controllers\Admin\Organization\ShowController::class, "__invoke"])->name('admin.organization.show');
            Route::patch('/{organization}', [\App\Http\Controllers\Admin\Organization\UpdateController::class, "__invoke"])->name('admin.organization.update');
            Route::put('/{organization}', [\App\Http\Controllers\Admin\Organization\UpdateController::class, "update"])->name('admin.organization.update.password');
            Route::delete('/{organization}', [\App\Http\Controllers\Admin\Organization\DeleteController::class, "__invoke"])->name('admin.organization.delete');
        });

        Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {

            Route::group(['namespace' => 'Report', 'prefix' => 'reports'], function () {
                Route::get('/', [\App\Http\Controllers\Admin\User\Report\IndexController::class, "__invoke"])->name('admin.user.report.index');
                Route::get('/create', [\App\Http\Controllers\Admin\User\Report\CreateController::class, "__invoke"])->name('admin.user.report.create');
                Route::post('/', [\App\Http\Controllers\Admin\User\Report\StoreController::class, "__invoke"])->name('admin.user.report.store');
                Route::get('/{report}', [\App\Http\Controllers\Admin\User\Report\ShowController::class, "__invoke"])->name('admin.user.report.show');
                Route::patch('/{report}', [\App\Http\Controllers\Admin\User\Report\UpdateController::class, "__invoke"])->name('admin.user.report.update');
                Route::delete('/{report}', [\App\Http\Controllers\Admin\User\Report\DeleteController::class, "__invoke"])->name('admin.user.report.delete');
            });

            Route::group(['namespace' => 'Menuboard', 'prefix' => 'menuboards'], function () {
                Route::get('/', [\App\Http\Controllers\Admin\User\Menuboard\IndexController::class, "__invoke"])->name('admin.user.menuboard.index');
                Route::get('/create', [\App\Http\Controllers\Admin\User\Menuboard\CreateController::class, "__invoke"])->name('admin.user.menuboard.create');
                Route::post('/', [\App\Http\Controllers\Admin\User\Menuboard\StoreController::class, "__invoke"])->name('admin.user.menuboard.store');
                Route::get('/{menuboard}', [\App\Http\Controllers\Admin\User\Menuboard\ShowController::class, "__invoke"])->name('admin.user.menuboard.show');
                Route::patch('/{menuboard}', [\App\Http\Controllers\Admin\User\Menuboard\UpdateController::class, "__invoke"])->name('admin.user.menuboard.update');
                Route::delete('/{menuboard}', [\App\Http\Controllers\Admin\User\Menuboard\DeleteController::class, "__invoke"])->name('admin.user.menuboard.delete');
            });

            Route::get('/', [\App\Http\Controllers\Admin\User\IndexController::class, "__invoke"])->name('admin.user.index');
            Route::get('/create', [\App\Http\Controllers\Admin\User\CreateController::class, "__invoke"])->name('admin.user.create');
            Route::post('/', [\App\Http\Controllers\Admin\User\StoreController::class, "__invoke"])->name('admin.user.store');
            Route::get('/{user}', [\App\Http\Controllers\Admin\User\ShowController::class, "__invoke"])->name('admin.user.show');
            Route::patch('/{user}', [\App\Http\Controllers\Admin\User\UpdateController::class, "__invoke"])->name('admin.user.update');
            Route::put('/{user}', [\App\Http\Controllers\Admin\User\UpdateController::class, "update"])->name('admin.user.update.password');
            Route::delete('/{user}', [\App\Http\Controllers\Admin\User\DeleteController::class, "__invoke"])->name('admin.user.delete');

        });
    });
});

require __DIR__.'/auth.php';
