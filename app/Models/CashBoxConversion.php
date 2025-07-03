<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class CashBoxConversion extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fromCashbox(): BelongsTo
    {
        return $this->belongsTo(CashBox::class);
    }

    public function toCashBox(): BelongsTo
    {
        return $this->belongsTo(CashBox::class);
    }
}
