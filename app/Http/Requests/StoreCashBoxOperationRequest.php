<?php

namespace App\Http\Requests;

use App\Models\InputType;
use App\Models\OutputType;
use Illuminate\Support\Facades\Auth;

class StoreCashBoxOperationRequest extends BaseRequest
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
            ],
            "input_type_id" => [
                "nullable",
                "exists:input_types,id",
            ],
            "output_type_id" => [
                "nullable",
                "exists:output_types,id",
            ],
            "amount" => [
                "required",
                "numeric",
                "min:1"
            ],
            "comment" => [
                "nullable",
                "string",
                "max:500"
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $hasInput = filled($this->input('input_type_id'));
            $hasOutput = filled($this->input('output_type_id'));

            if (!$hasInput && !$hasOutput) {
                $validator->errors()->add('input_type_id', t('input_or_output_required'));
            }

            if ($hasInput && $hasOutput) {
                $validator->errors()->add('input_type_id', t('only_one_of_input_or_output'));
            }

            if ($hasInput) {
                $inputType = InputType::where('id', $this->input('input_type_id'))
                    ->where('user_id', Auth::id())
                    ->first();

                if (!$inputType) {
                    $validator->errors()->add('input_type_id', t("not_belongs_to_user", "messages", ['input_type_id']));
                }
            }

            if ($hasOutput) {
                $outputType = OutputType::where('id', $this->input('output_type_id'))
                    ->where('user_id', Auth::id())
                    ->first();

                if (!$outputType) {
                    $validator->errors()->add('output_type_id', t('not_belongs_to_user', "messages", ['output_type_id']));
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            "currency.required" => t("required", "validation", ["currency"]),
            "currency.in" => t("valid_currencies", "validation"),
            "input_type_id.exists" => t("exists", "validation", ["input_type_id"]),
            "output_type_id.exists" => t("exists", "validation", ["output_type_id"]),
            "amount.required" => t("required", "validation", ["amount"]),
            "amount.numeric" => t("numeric", "validation", ["amount"]),
            "amount.min" => t("min.string", "validation", ["amount"]),
            "comment.max" => t("max.string", "validation", ["comment"]),
        ];
    }

    public function attributes(): array
    {
        return [
            "currency" => t("currency", "attributes"),
            "input_type_id" => t("input_type_id", "attributes"),
            "output_type_id" => t("output_type_id", "attributes"),
            "amount" => t("amount", "attributes"),
            "comment" => t("comment", "attributes"),
        ];
    }
}
