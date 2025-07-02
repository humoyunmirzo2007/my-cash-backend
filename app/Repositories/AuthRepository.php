<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        return User::create([
            "first_name" => $data["first_name"],
            "middle_name" => $data["middle_name"],
            "last_name" => $data["last_name"],
            "username" => $data["username"],
            "password" => Hash::make($data["password"]),
        ]);
    }
    public function login(string $username)
    {
        return User::where("username", $username)->first();
    }
    public function getUser() {}
    public function logout() {}
}
