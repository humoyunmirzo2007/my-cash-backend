<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function register(array $data);
    public function login(string $username);
    public function getUser();
    public function logout();
}
