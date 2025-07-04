<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OutputTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id"      => $this->id,
            "name"    => $this->name,
            "active"  => $this->active,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
