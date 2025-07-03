<?php

use App\Helpers\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashBoxController;
use App\Http\Controllers\CashBoxOperationController;
use App\Http\Controllers\InputTypeController;
use App\Http\Controllers\OutputTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("auth")->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);
    Route::get("get-me", [AuthController::class, "getUser"])->middleware(["auth:sanctum"]);
    Route::post("logout", [AuthController::class, "logout"])->middleware(["auth:sanctum"]);
});

Route::prefix("input-types")->middleware(["auth:sanctum"])->group(function () {
    Route::get("get-all", [InputTypeController::class, "getAll"]);
    Route::get("get-all-active", [InputTypeController::class, "getAllActives"]);
    Route::get("get-by-id/{id}", [InputTypeController::class, "getById"]);
    Route::post("create", [InputTypeController::class, "create"]);
    Route::put("update/{id}", [InputTypeController::class, "update"]);
    Route::put("update-active/{id}", [InputTypeController::class, "updateActive"]);
});

Route::prefix("output-types")->middleware(["auth:sanctum"])->group(function () {
    Route::get("get-all", [OutputTypeController::class, "getAll"]);
    Route::get("get-all-active", [OutputTypeController::class, "getAllActives"]);
    Route::get("get-by-id/{id}", [OutputTypeController::class, "getById"]);
    Route::post("create", [OutputTypeController::class, "create"]);
    Route::put("update/{id}", [OutputTypeController::class, "update"]);
    Route::put("update-active/{id}", [OutputTypeController::class, "updateActive"]);
});

Route::prefix("cash-boxes")->middleware(["auth:sanctum"])->group(function () {
    Route::get("get-all", [CashBoxController::class, "getAll"]);
    Route::get("get-by-id/{id}", [CashBoxController::class, "getById"]);
    Route::post("create", [CashBoxController::class, "create"]);
});

Route::prefix("cash-box-operations")->middleware(["auth:sanctum"])->group(function () {
    Route::get("get-incomes", [CashBoxOperationController::class, "getIncomes"]);
    Route::get("get-outputs", [CashBoxOperationController::class, "getOutputs"]);
    Route::get("get-income-by-id/{id}", [CashBoxOperationController::class, "getIncomeById"]);
    Route::get("get-output-by-id/{id}", [CashBoxOperationController::class, "getOutputById"]);
    Route::post("create", [CashBoxOperationController::class, "create"]);
    Route::put("update/{id}", [CashBoxOperationController::class, "update"]);
    Route::delete("delete/{id}", [CashBoxOperationController::class, "delete"]);
});

Route::fallback(function () {
    return Response::error(t("not_found", "Route"), null, 404);
});
