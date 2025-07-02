<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "first_name" => ["required", "string", "min:3", "max:255"],
            "middle_name" => ["nullable", "string", "min:3", "max:255"],
            "last_name" => ["required", "string", "min:3", "max:255"],
            "last_name" => ["required", "string", "min:3", "max:255"],
            "username" => ["required", "string", "min:8", "max:50", "unique:users,username"],
            "password" => ["required", "string", "min:8", "max:50"],
        ];
    }

    public function attributes(): array
    {
        return [
            "first_name" => t(key: "first_name", filename: "attributes"),
            "middle_name" => t(key: "middle_name", filename: "attributes"),
            "last_name" => t(key: "last_name", filename: "attributes"),
            "username" => t(key: "username", filename: "attributes"),
            "password" => t(key: "password", filename: "attributes"),
        ];
    }
}
