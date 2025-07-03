<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class CashBoxOperation extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inputType(): BelongsTo
    {
        return $this->belongsTo(InputType::class);
    }

    public function outputType(): BelongsTo
    {
        return $this->belongsTo(OutputType::class);
    }

    public function getAmountAttribute($value)
    {
        return abs($value);
    }
}
