<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateOutputTypeActive extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "id" => ["required", "exists:output_types,id"],
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
