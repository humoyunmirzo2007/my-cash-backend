<?php

use App\Helpers\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputTypeController;
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

Route::fallback(function () {
    return Response::error(t("not_found", "Route"), null, 404);
});
