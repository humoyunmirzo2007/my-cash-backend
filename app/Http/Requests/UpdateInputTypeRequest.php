<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateInputTypeRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => [
                "required",
                "exists:input_types,id",
                Rule::exists("input_types", "id")->where("user_id", Auth::id())
            ],
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
                Rule::unique("input_types", "name")
                    ->ignore($this->route("id"))
                    ->where(function ($query) {
                        return $query->where("user_id", Auth::id());
                    }),
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => t(key: "name", filename: "attributes"),
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            "id" => $this->route("id"),
        ]);
    }
}
