<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CashBoxConversionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "user_id" => $this->user_id,
            "amount" => $this->to_amount,
            "exchange_rate" => $this->exchange_rate,
            "from_cash_box" => $this->whenLoaded("fromCashBox"),
            "to_cash_box" => $this->whenLoaded("toCashBox"),
        ];
    }
}
