<?php

namespace App\Services;

use App\Interfaces\CashBoxConversionInterface;
use App\Interfaces\CashBoxConversionRepositoryInterface;
use App\Models\CashBox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashBoxConversionService
{
    protected CashBoxConversionRepositoryInterface $repository;

    public function __construct(CashBoxConversionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(Request $request)
    {
        return $this->repository->getAll($request);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $userId = Auth::id();

            $fromCashBox = CashBox::where('id', $data['from_cash_box_id'])
                ->where('user_id', $userId)
                ->firstOrFail();

            $toCashBox = CashBox::where('id', $data['to_cash_box_id'])
                ->where('user_id', $userId)
                ->firstOrFail();

            $fromAmount = $data['from_amount'];
            $exchangeRate = $data['exchange_rate'];

            $fromCurrency = $fromCashBox->currency;
            $toCurrency = $toCashBox->currency;

            if ($fromCurrency === 'UZS' && $toCurrency === 'USD') {
                $toAmount = round($fromAmount / $exchangeRate, 2);
            } elseif ($fromCurrency === 'USD' && $toCurrency === 'UZS') {
                $toAmount = round($fromAmount * $exchangeRate, 2);
            } else {
                $toAmount = $fromAmount;
            }

            return $this->repository->create([
                'user_id' => $userId,
                'from_cash_box_id' => $fromCashBox->id,
                'to_cash_box_id' => $toCashBox->id,
                'from_amount' => $fromAmount,
                'to_amount' => $toAmount,
                'exchange_rate' => $exchangeRate,
                'comment' => $data['comment'] ?? null,
            ]);
        });
    }
}
