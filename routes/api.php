<?php

use App\Helpers\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    echo __("validation.test");
});


Route::fallback(function () {
    return Response::error(t("not_found", "Route"), null, 404);
});
