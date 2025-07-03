<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreCashBoxRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "currency" => [
                "required",
                "in:USD,UZS",
                Rule::unique("cash_boxes")->where(
                    fn($query) =>
                    $query->where("user_id", Auth::id())
                ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            "currency.unique" => t("cash_box_exists_by_currency"),
            "currency.in" => t("valid_currencies"),
        ];
    }

    public function attributes(): array
    {
        return [
            "currency" => t("currency", "attributes"),
        ];
    }
}
