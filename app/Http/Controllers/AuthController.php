<?php

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $service)
    {
        $this->authService = $service;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request->validated());

        return Response::success(
            t("register_success"),
            $data
        );
    }

    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request->validated());

        if (!$user) {
            return Response::error(
                message: t("invalid_credentials"),
                status: 401
            );
        }
        return Response::success(
            t("login_success"),
            $user
        );
    }

    public function getUser()
    {
        $user = $this->authService->getUser();

        return Response::success(
            data: $user
        );
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);

       return Response::success(t("logout_success"));
    }
}
