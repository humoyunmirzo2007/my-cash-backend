<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CashBox;

class StoreCashBoxConversionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "from_cash_box_id" => [
                "required",
                "integer",
                Rule::exists("cash_boxes", "id")->where("user_id", $this->user()->id),
                "different:to_cash_box_id",
            ],
            "to_cash_box_id" => [
                "required",
                "integer",
                Rule::exists("cash_boxes", "id")->where("user_id", $this->user()->id),
            ],
            "from_amount" => ["required", "numeric", "gt:0"],
            "exchange_rate" => ["required", "numeric", "gt:0"],
            "comment" => ["nullable", "string", "max:1000"],
        ];
    }

    public function messages(): array
    {
        return [
            "from_cash_box_id.required" => t("from_cash_box_id_required", "messages"),
            "to_cash_box_id.required" => t("to_cash_box_id_required", "messages"),
            "from_cash_box_id.different" => t("from_cash_box_id_different", "messages"),
            "from_amount.gt" => t("from_amount_gt", "messages"),
            "exchange_rate.gt" => t("exchange_rate_gt", "messages"),
        ];
    }
}
