<?php

use App\Helpers\Response;
use App\Http\Controllers\AuthController;
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

Route::fallback(function () {
    return Response::error(t("not_found", "Route"), null, 404);
});
