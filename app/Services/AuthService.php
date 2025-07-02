<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $repository)
    {
        $this->authRepository = $repository;
    }

    public function register(array $data)
    {
        $user = $this->authRepository->register($data);
        $token = $user->createToken("api-token")->plainTextToken;
        return [
            "user" => $user,
            "token" => $token,
        ];
    }

    public function login(array $data)
    {
        $user = $this->authRepository->login($data["username"]);

        if (!$user || !Hash::check($data["password"], $user->password)) {
            return [];
        }

        $token = $user->createToken("api-token")->plainTextToken;

        return [
            "user" => $user,
            "token" => $token,
        ];
    }

    public function getUser()
    {
        return Auth::user();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
}
