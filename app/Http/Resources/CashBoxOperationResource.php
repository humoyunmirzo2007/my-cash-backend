<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashBoxOperationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "currency" => $this->currency,
            "amount" => $this->amount,
            "input_type" => $this->whenLoaded("inputType"),
            "output_type" => $this->whenLoaded("outputType"),
        ];
    }
}
