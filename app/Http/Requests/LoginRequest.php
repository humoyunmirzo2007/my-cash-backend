<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "username" => ["required"],
            "password" => ["required"],
        ];
    }

    public function attributes(): array
    {
        return [
            "username" => t(key: "username", filename: "attributes"),
            "password" => t(key: "password", filename: "attributes"),
        ];
    }
}
