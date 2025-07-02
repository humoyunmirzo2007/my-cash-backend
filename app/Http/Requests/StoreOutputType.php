<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOutputType extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "string", "min:3", "max:255", "unique:output_types,name"]
        ];
    }

    public function attributes(): array
    {
        return [
            "name" => t(key: "name", filename: "attributes"),
        ];
    }
}
