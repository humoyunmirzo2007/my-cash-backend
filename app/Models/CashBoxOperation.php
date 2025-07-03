<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
    protected static function booted()
    {
        static::creating(function ($operation) {
            if (empty($operation->user_id)) {
                $operation->user_id = Auth::id();
            }

            if (!empty($operation->output_type_id)) {
                $operation->amount = -abs($operation->amount);

                $residue = DB::table('cash_boxes')
                    ->where('user_id', $operation->user_id)
                    ->where('currency', $operation->currency)
                    ->value('residue');

                if ($residue < abs($operation->amount)) {
                    throw new HttpResponseException(response()->json([
                        'message' => t("validation_error", "validation"),
                        'errors' => [
                            t("not_enough_amount_in_cash")
                        ]
                    ], 422));
                }
            }

            if (!empty($operation->input_type_id)) {
                $operation->amount = abs($operation->amount);
            }
        });

        static::updating(function ($operation) {
            if (empty($operation->user_id)) {
                $operation->user_id = Auth::id();
            }

            $residue = DB::table('cash_boxes')
                ->where('user_id', $operation->user_id)
                ->where('currency', $operation->currency)
                ->value('residue');

            $oldAmount = $operation->getOriginal('amount');

            if (!empty($operation->output_type_id)) {
                $operation->amount = -abs($operation->amount);

                $originalResidue = $residue + $oldAmount - abs($operation->amount);

                if ($originalResidue < 0) {
                    throw new HttpResponseException(response()->json([
                        'message' => t("validation_error", "validation"),
                        'errors' => [
                            t("not_enough_amount_in_cash")
                        ]
                    ], 422));
                }
            }

            if (!empty($operation->input_type_id)) {
                $operation->amount = abs($operation->amount);
            }
        });
    }
}
