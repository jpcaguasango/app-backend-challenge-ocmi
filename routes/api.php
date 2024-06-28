<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(["auth.data.request"])->prefix('v1')->group(
    function () {

        Route::prefix('/auth')->group(
            function () {
                Route::controller(AuthController::class)->group(function () {
                    Route::post('login', 'login');
                    Route::get('logout', 'logout')->middleware(['auth:api']);
                });
            }
        );

        Route::prefix('/roles')->group(
            function () {
                Route::controller(RoleController::class)->group(function () {
                    Route::get('', 'index')->middleware(['auth:api', 'scopes:roles.index']);
                    Route::post('', 'store')->middleware(['auth:api', 'scopes:roles.store']);
                    Route::get('{id}', 'show')->middleware(['auth:api', 'scopes:roles.show']);
                    Route::match(['put', 'path'], '{id}', 'update')->middleware(['auth:api', 'scopes:roles.update']);
                    Route::delete('{id}', 'destroy')->middleware(['auth:api', 'scopes:roles.destroy']);
                    Route::match(['put', 'path'], '{id}/permissions', 'updatePermissions')->middleware(['auth:api', 'scopes:roles.update.permissions']);
                });
            }
        );

        Route::prefix('/permissions')->group(
            function () {
                Route::controller(PermissionController::class)->group(function () {
                    Route::get('', 'index')->middleware(['auth:api', 'scopes:permissions.index']);
                    Route::post('', 'store')->middleware(['auth:api', 'scopes:permissions.store']);
                    Route::get('{id}', 'show')->middleware(['auth:api', 'scopes:permissions.show']);
                    Route::match(['put', 'path'], '{id}', 'update')->middleware(['auth:api', 'scopes:permissions.update']);
                    Route::delete('{id}', 'destroy')->middleware(['auth:api', 'scopes:permissions.destroy']);
                });
            }
        );

        Route::prefix('/users')->group(
            function () {
                Route::controller(UserController::class)->group(function () {
                    Route::get('', 'index')->middleware(['auth:api', 'scopes:users.index']);
                    Route::post('', 'store')->middleware(['auth:api', 'scopes:users.store']);
                    Route::get('{id}', 'show')->middleware(['auth:api', 'scopes:users.show']);
                    Route::match(['put', 'path'], '{id}', 'update')->middleware(['auth:api', 'scopes:users.update']);
                    Route::delete('{id}', 'destroy')->middleware(['auth:api', 'scopes:users.destroy']);
                    Route::match(['put', 'path'], '{id}/roles', 'updateRoles')->middleware(['auth:api', 'scopes:users.update.roles']);
                });
            }
        );

        Route::prefix('/clients')->group(
            function () {
                Route::controller(ClientController::class)->group(function () {
                    Route::get('', 'index')->middleware(['auth:api', 'scopes:clients.index']);
                    Route::post('', 'store')->middleware(['auth:api', 'scopes:clients.store']);
                    Route::get('{id}', 'show')->middleware(['auth:api', 'scopes:clients.show']);
                    Route::match(['put', 'path'], '{id}', 'update')->middleware(['auth:api', 'scopes:clients.update']);
                    Route::delete('{id}', 'destroy')->middleware(['auth:api', 'scopes:clients.destroy']);
                });
            }
        );

        Route::prefix('/employees')->group(
            function () {
                Route::controller(EmployeeController::class)->group(function () {
                    Route::get('', 'index')->middleware(['auth:api', 'scopes:employees.index']);
                    Route::post('', 'store')->middleware(['auth:api', 'scopes:employees.store']);
                    Route::get('{id}', 'show')->middleware(['auth:api', 'scopes:employees.show']);
                    Route::match(['put', 'path'], '{id}', 'update')->middleware(['auth:api', 'scopes:employees.update']);
                    Route::delete('{id}', 'destroy')->middleware(['auth:api', 'scopes:employees.destroy']);
                });
            }
        );

        Route::prefix('/timesheets')->group(
            function () {
                Route::controller(TimesheetController::class)->group(function () {
                    Route::get('', 'index')->middleware(['auth:api', 'scopes:timesheets.index']);
                    Route::post('', 'store')->middleware(['auth:api', 'scopes:timesheets.store']);
                    Route::get('{id}', 'show')->middleware(['auth:api', 'scopes:timesheets.show']);
                    Route::match(['put', 'path'], '{id}', 'update')->middleware(['auth:api', 'scopes:timesheets.update']);
                    Route::delete('{id}', 'destroy')->middleware(['auth:api', 'scopes:timesheets.destroy']);
                });
            }
        );
    }
);
