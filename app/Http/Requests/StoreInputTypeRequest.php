<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreInputTypeRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
                Rule::unique("input_types", "name")->where(function ($query) {
                    return $query->where("user_id", Auth::id());
                }),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => t(key: "name", filename: "attributes"),
        ];
    }
}
