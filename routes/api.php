<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(
    function () {
        Route::get('/', [UserController::class, 'listActiveUsers']);
        Route::get('/{id}', [UserController::class, 'findUser']);
        Route::post('/', [UserController::class, 'createUser']);
        Route::put('/{id}', [UserController::class, 'updateUser']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
    }
);

Route::prefix('division')->group(
    function () {
        Route::get('/', [DivisionController::class, 'listActiveDivisions']);
        Route::get('/{id}', [DivisionController::class, 'findDivision']);
        Route::post('/', [DivisionController::class, 'createDivision']);
        Route::put('/{id}', [DivisionController::class, 'updateDivision']);
        Route::delete('/{id}', [DivisionController::class, 'deleteDivision']);
    }
);

Route::prefix('role')->group(
    function () {
        Route::get('/', [RoleController::class, 'listActiveRoles']);
        Route::get('/{id}', [RoleController::class, 'findRole']);
        Route::post('/', [RoleController::class, 'createRole']);
        Route::put('/{id}', [RoleController::class, 'updateRole']);
        Route::delete('/{id}', [RoleController::class, 'deleteRole']);
    }
);

Route::prefix('company')->group(
    function () {
        Route::get('/', [CompanyController::class, 'listActiveCompanies']);
        Route::get('/{id}', [CompanyController::class, 'findCompany']);
        Route::post('/', [CompanyController::class, 'createCompany']);
        Route::put('/{id}', [CompanyController::class, 'updateCompany']);
        Route::delete('/{id}', [CompanyController::class, 'deleteCompany']);
    }
);

Route::prefix('finance')->group(
    function () {
        Route::prefix('payment')->group(
            function () {
                Route::get('/', [FinanceController::class, 'doPayment']);
                Route::get('/{id}', [FinanceController::class, 'doIndividualPayment']);
            }
        );
    }
);