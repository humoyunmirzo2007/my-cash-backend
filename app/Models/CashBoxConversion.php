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

    public function fromCashBox(): BelongsTo
    {
        return $this->belongsTo(CashBox::class);
    }

    public function toCashBox(): BelongsTo
    {
        return $this->belongsTo(CashBox::class);
    }

    public function getToAmountAttribute($value)
    {
        $to_amount = (float) $value;
        return ($to_amount == floor($to_amount)) ? (int) $to_amount : $to_amount;
    }

    public function getExchangeRateAttribute($value)
    {
        $exchange_rate = (float) $value;
        return ($exchange_rate == floor($exchange_rate)) ? (int) $exchange_rate : $exchange_rate;
    }
}   
