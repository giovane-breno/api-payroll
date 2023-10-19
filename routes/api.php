<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\BenefitTypeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\GratificationController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacationController;
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


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(

    function () {
        Route::prefix('user')->group(
            function () {

                Route::prefix('a')->group(
                    function () {
                        Route::get('/', [AdminController::class, 'ListAdmins'])->can('isAdmin');
                        Route::get('/{id}', [AdminController::class, 'findAdmin'])->can('isAdmin');
                        Route::post('/', [AdminController::class, 'promoteAdmin'])->can('promoteAdmin');
                        Route::delete('/{id}', [AdminController::class, 'demoteAdmin'])->can('demoteAdmin');
                    }
                );

                Route::get('/', [UserController::class, 'listActiveUsers'])->can('isOperator');
                Route::get('/{id}', [UserController::class, 'findUser'])->can('isOperator');
                Route::post('/', [UserController::class, 'createUser'])->can('createUser');
                Route::put('/{id}', [UserController::class, 'updateUser'])->can('deleteUser');
                Route::delete('/{id}', [UserController::class, 'deleteUser'])->can('updateUser');
            }
        );

        Route::prefix('division')->group(
            function () {
                Route::get('/', [DivisionController::class, 'listActiveDivisions'])->middleware('ability:isOperator');
                Route::get('/{id}', [DivisionController::class, 'findDivision'])->middleware('ability:isOperator');
                Route::post('/', [DivisionController::class, 'createDivision'])->middleware('ability:createDivision');
                Route::put('/{id}', [DivisionController::class, 'updateDivision'])->middleware('ability:updateDivision');
                Route::delete('/{id}', [DivisionController::class, 'deleteDivision'])->middleware('ability:deleteDivision');
            }
        );

        Route::prefix('role')->group(
            function () {
                Route::get('/', [RoleController::class, 'listActiveRoles'])->can('isOperator');
                Route::get('/{id}', [RoleController::class, 'findRole'])->can('isOperator');
                Route::post('/', [RoleController::class, 'createRole'])->can('createRole');
                Route::put('/{id}', [RoleController::class, 'updateRole'])->can('updateRole');
                Route::delete('/{id}', [RoleController::class, 'deleteRole'])->can('deleteRole');
            }
        );

        Route::prefix('company')->group(
            function () {
                Route::get('/', [CompanyController::class, 'listActiveCompanies'])->can('isOperator');
                Route::get('/{id}', [CompanyController::class, 'findCompany'])->can('isOperator');
                Route::post('/', [CompanyController::class, 'createCompany'])->can('createCompany');
                Route::put('/{id}', [CompanyController::class, 'updateCompany'])->can('updateCompany');
                Route::delete('/{id}', [CompanyController::class, 'deleteCompany'])->can('deleteCompany');
            }
        );

        Route::prefix('finance')->group(
            function () {
                Route::prefix('payment')->group(
                    function () {
                        Route::get('/{id}', [FinanceController::class, 'findPayroll']);
                        Route::get('/', [FinanceController::class, 'listActivePayrolls'])->can('isOperator');
                        Route::get('/p', [FinanceController::class, 'doPayment'])->can('doPayment');
                        Route::get('/p/{id}', [FinanceController::class, 'doIndividualPayment'])->can('doPayment');
                        Route::delete('/{id}', [FinanceController::class, 'deletePayroll'])->can('deletePayroll');

                    }
                );
            }
        );

        Route::prefix('vacation')->group(
            function () {
                Route::get('/', [VacationController::class, 'listActiveVacations'])->can('isOperator');
                Route::get('/{id}', [VacationController::class, 'findVacation'])->can('isOperator');
                Route::post('/', [VacationController::class, 'createVacation'])->can('createVacation');
                Route::put('/{id}', [VacationController::class, 'updateVacation'])->can('updateVacation');
                Route::delete('/{id}', [VacationController::class, 'deleteVacation'])->can('deleteVacation');
            }
        );

        Route::prefix('gratification')->group(
            function () {
                Route::get('/', [GratificationController::class, 'listActiveGratifications'])->can('isOperator');
                Route::get('/{id}', [GratificationController::class, 'findGratification'])->can('isOperator');
                Route::post('/', [GratificationController::class, 'createGratification'])->can('createGratification');
                Route::put('/{id}', [GratificationController::class, 'updateGratification'])->can('updateGratification');
                Route::delete('/{id}', [GratificationController::class, 'deleteGratification'])->can('deleteGratification');
            }
        );

        Route::prefix('incident')->group(
            function () {
                Route::get('/', [IncidentController::class, 'listActiveIncidents'])->can('isOperator');
                Route::get('/{id}', [IncidentController::class, 'findIncident'])->can('isOperator');
                Route::post('/', [IncidentController::class, 'createIncident'])->can('createIncident');
                Route::put('/{id}', [IncidentController::class, 'updateIncident'])->can('updateIncident');
                Route::delete('/{id}', [IncidentController::class, 'deleteIncident'])->can('deleteIncident');
            }
        );

        Route::prefix('benefit')->group(
            function () {
                Route::prefix('t')->group(
                    function () {
                        Route::get('/', [BenefitTypeController::class, 'listActiveBenefitTypes'])->can('isOperator');
                        Route::get('/{id}', [BenefitTypeController::class, 'findBenefit'])->can('isOperator');
                        Route::post('/', [BenefitTypeController::class, 'createBenefit'])->can('createBenefit');
                        Route::put('/{id}', [BenefitTypeController::class, 'updateBenefit'])->can('updateBenefit');
                        Route::delete('/{id}', [BenefitTypeController::class, 'deleteBenefit'])->can('deleteBenefit');

                    }
                );
                Route::get('/', [BenefitController::class, 'listActiveBenefit'])->can('isOperator');
                Route::get('/{id}', [BenefitController::class, 'findBenefit'])->can('isOperator');
                Route::post('/', [BenefitController::class, 'createBenefit'])->can('createBenefit');
                Route::put('/{id}', [BenefitController::class, 'updateBenefit'])->can('updateBenefit');
                Route::delete('/{id}', [BenefitController::class, 'deleteBenefit'])->can('deleteBenefit');
            }
        );
    }
);

