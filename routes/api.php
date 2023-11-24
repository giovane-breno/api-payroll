<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoleController;
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
use App\Models\AdminRole;
use App\Models\Benefit;
use App\Models\BenefitType;
use App\Models\Company;
use App\Models\Division;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you middleware register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/token', function (Request $request) {
    $response = User::with('company', 'role', 'division')->find(Auth::id());
    return response()->json(['status' => 'success', 'data' => $response], 200);
});

Route::middleware('auth:sanctum')->group(
    function () {
        Route::prefix('l')->group(
            function () {
                Route::get('/companies', function () {
                    $response = Company::orderByDesc('id')->get(['id', 'name', 'cnpj']);
                    return response()->json(['status' => 'success', 'data' => $response], 200);
                });

                Route::get('/workers', function () {
                    $response = User::filter()->orderByDesc('id')->get(['id', 'full_name']);
                    return response()->json(['status' => 'success', 'data' => $response], 200);
                });

                Route::get('/divisions', function () {
                    $response = Division::filter()->orderByDesc('id')->get(['id', 'name']);
                    return response()->json(['status' => 'success', 'data' => $response], 200);
                });

                Route::get('/roles', function () {
                    $response = Role::filter()->orderByDesc('id')->get(['id', 'name']);
                    return response()->json(['status' => 'success', 'data' => $response], 200);
                });

                Route::get('/roles/a', function () {
                    $response = AdminRole::orderByDesc('id')->get(['id', 'name']);
                    return response()->json(['status' => 'success', 'data' => $response], 200);
                });
                Route::get('/benefits', function () {
                    $response = BenefitType::orderByDesc('id')->get(['id', 'name']);
                    return response()->json(['status' => 'success', 'data' => $response], 200);
                });
            }
        );
        Route::prefix('user')->group(
            function () {

                Route::prefix('a')->group(
                    function () {
                        Route::get('/', [AdminController::class, 'ListAdmins'])->middleware('ability:isAdmin');
                        Route::get('/{id}', [AdminController::class, 'findAdmin'])->middleware('ability:isAdmin');
                        Route::put('/{id}', [AdminController::class, 'promoteAdmin'])->middleware('ability:promoteAdmin');
                        Route::delete('/{id}', [AdminController::class, 'demoteAdmin'])->middleware('ability:demoteAdmin');
                    }
                );

                Route::get('/', [UserController::class, 'listActiveUsers']);
                Route::get('/{id}', [UserController::class, 'findUser'])->middleware('ability:isOperator');
                Route::post('/', [UserController::class, 'createUser'])->middleware('ability:createUser');
                Route::put('/{id}', [UserController::class, 'updateUser'])->middleware('ability:updateUser');
                Route::delete('/{id}', [UserController::class, 'deleteUser'])->middleware('ability:deleteUser');
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
                Route::get('/', [RoleController::class, 'listActiveRoles'])->middleware('ability:isOperator');
                Route::get('/{id}', [RoleController::class, 'findRole'])->middleware('ability:isOperator');
                Route::post('/', [RoleController::class, 'createRole'])->middleware('ability:createRole');
                Route::put('/{id}', [RoleController::class, 'updateRole'])->middleware('ability:updateRole');
                Route::delete('/{id}', [RoleController::class, 'deleteRole'])->middleware('ability:deleteRole');
            }
        );

        Route::prefix('admin_role')->group(
            function () {
                Route::get('/', [AdminRoleController::class, 'ListActiveAdminRole'])->middleware('ability:isOperator');
                Route::get('/{id}', [AdminRoleController::class, 'findAdminRole'])->middleware('ability:isOperator');
                Route::post('/', [AdminRoleController::class, 'createAdminRole'])->middleware('ability:createAdminRole');
                Route::put('/{id}', [AdminRoleController::class, 'updateAdminRole'])->middleware('ability:updateAdminRole');
                Route::delete('/{id}', [AdminRoleController::class, 'deleteAdminRole'])->middleware('ability:deleteAdminRole');
            }
        );

        Route::prefix('company')->group(
            function () {
                Route::get('/', [CompanyController::class, 'listActiveCompanies'])->middleware('ability:isOperator');
                Route::get('/{id}', [CompanyController::class, 'findCompany'])->middleware('ability:isOperator');
                Route::post('/', [CompanyController::class, 'createCompany'])->middleware('ability:createCompany');
                Route::put('/{id}', [CompanyController::class, 'updateCompany'])->middleware('ability:updateCompany');
                Route::delete('/{id}', [CompanyController::class, 'deleteCompany'])->middleware('ability:deleteCompany');
            }
        );

        Route::prefix('finance')->group(
            function () {
                Route::prefix('payment')->group(
                    function () {
                        Route::get('/', [FinanceController::class, 'listActivePayrolls'])->middleware('ability:isOperator');
                        Route::get('/p', [FinanceController::class, 'doPayment'])->middleware('ability:doPayment');
                        Route::get('/p/{id}', [FinanceController::class, 'doIndividualPayment'])->middleware('ability:doPayment');
                        Route::get('/{id}', [FinanceController::class, 'findPayroll']);
                        Route::delete('/{id}', [FinanceController::class, 'deletePayroll'])->middleware('ability:deletePayroll');

                    }
                );
            }
        );

        Route::prefix('vacation')->group(
            function () {
                Route::get('/', [VacationController::class, 'listActiveVacations'])->middleware('ability:isOperator');
                Route::get('/{id}', [VacationController::class, 'findVacation'])->middleware('ability:isOperator');
                Route::post('/', [VacationController::class, 'createVacation'])->middleware('ability:createVacation');
                Route::put('/{id}', [VacationController::class, 'updateVacation'])->middleware('ability:updateVacation');
                Route::delete('/{id}', [VacationController::class, 'deleteVacation'])->middleware('ability:deleteVacation');
            }
        );

        Route::prefix('gratification')->group(
            function () {
                Route::get('/', [GratificationController::class, 'listActiveGratifications'])->middleware('ability:isOperator');
                Route::get('/{id}', [GratificationController::class, 'findGratification'])->middleware('ability:isOperator');
                Route::post('/', [GratificationController::class, 'createGratification'])->middleware('ability:createGratification');
                Route::put('/{id}', [GratificationController::class, 'updateGratification'])->middleware('ability:updateGratification');
                Route::delete('/{id}', [GratificationController::class, 'deleteGratification'])->middleware('ability:deleteGratification');
            }
        );

        Route::prefix('incident')->group(
            function () {
                Route::get('/', [IncidentController::class, 'listActiveIncidents'])->middleware('ability:isOperator');
                Route::get('/{id}', [IncidentController::class, 'findIncident'])->middleware('ability:isOperator');
                Route::post('/', [IncidentController::class, 'createIncident'])->middleware('ability:createIncident');
                Route::put('/{id}', [IncidentController::class, 'updateIncident'])->middleware('ability:updateIncident');
                Route::delete('/{id}', [IncidentController::class, 'deleteIncident'])->middleware('ability:deleteIncident');
            }
        );

        Route::prefix('benefit')->group(
            function () {
                Route::prefix('t')->group(
                    function () {
                        Route::get('/', [BenefitTypeController::class, 'listActiveBenefitTypes'])->middleware('ability:isOperator');
                        Route::get('/{id}', [BenefitTypeController::class, 'findBenefit'])->middleware('ability:isOperator');
                        Route::post('/', [BenefitTypeController::class, 'createBenefit'])->middleware('ability:createBenefit');
                        Route::put('/{id}', [BenefitTypeController::class, 'updateBenefit'])->middleware('ability:updateBenefit');
                        Route::delete('/{id}', [BenefitTypeController::class, 'deleteBenefit'])->middleware('ability:deleteBenefit');

                    }
                );
                Route::get('/', [BenefitController::class, 'listActiveBenefit'])->middleware('ability:isOperator');
                Route::get('/{id}', [BenefitController::class, 'findBenefit'])->middleware('ability:isOperator');
                Route::post('/', [BenefitController::class, 'createBenefit'])->middleware('ability:createBenefit');
                Route::put('/{id}', [BenefitController::class, 'updateBenefit'])->middleware('ability:updateBenefit');
                Route::delete('/{id}', [BenefitController::class, 'deleteBenefit'])->middleware('ability:deleteBenefit');
            }
        );
    }
);

