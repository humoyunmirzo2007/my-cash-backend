<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateOutputTypeActiveRequest extends BaseRequest
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
                "exists:output_types,id",
                Rule::exists("output_types", "id")->where("user_id", Auth::id())
            ],
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            "id" => $this->route("id"),
        ]);
    }
}
