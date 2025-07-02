<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateInputType extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => ["required", "exists:input_types,id"],
            "name" => [
                "required",
                "string",
                "min:3",
                "max:255",
                Rule::unique("input_types", "name")->ignore($this->route("id"))
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
            'id' => $this->route('id'),
        ]);
    }
}
